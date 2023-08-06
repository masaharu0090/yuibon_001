<?php
include('../includes/dbConfig.php');

if (isset($_POST['submit'])) {
    $targetDirectory = '../assets/images/';
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileType = $_FILES['file']['type'];
    $fileSize = $_FILES['file']['size'];

    
    // データベース内で同じファイル名が存在するか確認
    $sql = "SELECT * FROM images WHERE file_name = :file_name";
    $sth = $db->prepare($sql);
    $sth->bindValue(':file_name', $fileName, PDO::PARAM_STR);
    $sth->execute();
    $existingImage = $sth->fetch();

    if ($existingImage) {
        // 同じファイル名の画像が既に存在する場合は保存を中止
        echo "同じファイル名の画像が既に存在します。別のファイル名を指定してください。";
        exit;
    }

    // 画像の保存
    $uploadPath = $targetDirectory . $fileName;
    move_uploaded_file($fileTmpName, $uploadPath);

    // データベースへの保存
    $sql = "INSERT INTO images (file_name, type, size) VALUES (:file_name, :type, :size)";
    $sth = $db->prepare($sql);
    $sth->bindValue(':file_name', $fileName, PDO::PARAM_STR);
    $sth->bindValue(':type', $fileType, PDO::PARAM_STR);
    $sth->bindValue(':size', $fileSize, PDO::PARAM_INT);
    $sth->execute();

    // 保存後の処理（例：リダイレクトなど）
    // ...

}
?>