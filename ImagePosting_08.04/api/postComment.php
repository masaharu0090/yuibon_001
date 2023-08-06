<?php
include('dbConfig.php');

if (isset($_POST['comment']) && isset($_POST['title']) && isset($_GET['image_id'])) {
    $comment = $_POST['comment'];
    $title = $_POST['title'];
    $imageId = $_GET['image_id'];

    // 既存のコメントを検索
    $sql = "SELECT * FROM comments WHERE image_id = " . $imageId;
    $sth = $db->prepare($sql);
    $sth->execute();
    $existingComment = $sth->fetch();

    if ($existingComment) {
        // 既存のコメントがある場合は更新
        $commentId = $existingComment['id'];
        $sql = "UPDATE comments SET title = :title, comment = :comment WHERE id = :id";
        $sth = $db->prepare($sql);
        $sth->bindParam(':id', $commentId, PDO::PARAM_INT);
        $sth->bindParam(':title', $title, PDO::PARAM_STR);
        $sth->bindParam(':comment', $comment, PDO::PARAM_STR);
        $sth->execute();
    } else {
        // 既存のコメントがない場合は新しいコメントを追加
        $sql = "INSERT INTO comments (image_id, title, comment) VALUES (:image_id, :title, :comment)";
        $sth = $db->prepare($sql);
        $sth->bindParam(':image_id', $imageId, PDO::PARAM_INT);
        $sth->bindParam(':title', $title, PDO::PARAM_STR);
        $sth->bindParam(':comment', $comment, PDO::PARAM_STR);
        $sth->execute();
    }

    // 成功したら詳細ページにリダイレクト
    header("Location: ./html/imageDetail.php?id=" . $imageId);
    exit();
} else {
    // エラー処理（コメントやタイトルが入力されていない場合など）
    echo "エラー：コメントとタイトルを入力してください。";
}
?>