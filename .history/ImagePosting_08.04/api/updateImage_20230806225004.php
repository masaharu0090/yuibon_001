<?php

include('../includes/dbConfig.php');

$targetDirectory = '../assets/images/';
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDirectory . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
$imageId = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($fileName)) {
    $arrImageTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (in_array($fileType, $arrImageTypes)) {
        $sql = "SELECT file_name FROM images WHERE id = " . $imageId;

        $sth = $db->prepare($sql);
        $sth->execute();
        $getImageName = $sth->fetch();

        $deleteImage = unlink($targetDirectory . $getImageName['file_name']);

        if ($deleteImage) {
            $uploadImageForServer = move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);

            if($uploadImageForServer) {
                $update = $db->query("UPDATE images SET file_name = '" . $fileName . "' WHERE id = " . $imageId);

                header('Location: ' . '../', true, 303);
                exit();
            }
        }
    }
}