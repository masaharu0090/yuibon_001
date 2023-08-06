<?php

include('dbConfig.php');

if (isset($_POST['comment_id'])) {
    $commentId = $_POST['comment_id'];
    
    // コメントの削除
    $sql = "DELETE FROM comments WHERE id = :comment_id";
    $sth = $db->prepare($sql);
    $sth->bindValue(':comment_id', $commentId, PDO::PARAM_INT);
    $sth->execute();

    // 削除が成功したら元のページにリダイレクトする
    header('Location: ./html/imageDetail.php?id=' . $_POST['image_id']);
    exit();
} else {
    // comment_idが指定されていない場合はエラーメッセージを表示
    echo "コメントIDが指定されていません。";
}