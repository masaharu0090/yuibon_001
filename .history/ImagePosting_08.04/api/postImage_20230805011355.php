<?php
include('../includes/dbConfig.php');

if (isset($_POST['submit'])) {
    $targetDirectory = '../assets/images/';
    $fileName = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileType = $_FILES['image']['type'];
    $fileSize = $_FILES['image']['size'];



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