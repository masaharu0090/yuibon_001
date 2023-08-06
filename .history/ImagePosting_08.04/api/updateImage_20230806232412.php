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
        $sql = "SELECT file_name FROM images WHERE id = :id";
        $sth = $db->prepare($sql);
        $sth->bindParam(':id', $imageId, PDO::PARAM_INT);
        $sth->execute();
        $getImageName = $sth->fetch();

        if (!$getImageName) {
            echo "該当する画像が見つかりませんでした。";
            exit;
        }

        $fileToDelete = $targetDirectory . $getImageName['file_name'];

        if (!file_exists($fileToDelete)) {
            echo "削除するファイルが存在しません： " . $fileToDelete;
            exit;
        }

        $deleteImage = unlink($fileToDelete);

        if (!$deleteImage) {
            echo "画像の削除に失敗しました。";
            exit;
        }

        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
            $updateSql = "UPDATE images SET file_name = :fileName WHERE id = :id";
            $updateStm = $db->prepare($updateSql);
            $updateStm->bindParam(':fileName', $fileName, PDO::PARAM_STR);
            $updateStm->bindParam(':id', $imageId, PDO::PARAM_INT);
            
            if ($updateStm->execute()) {
                header('Location: ' . '../html/index.php', true, 303);
                exit();
            } else {
                echo "データベースの更新に失敗しました。";
                exit;
            }
        } else {
            echo "画像のアップロードに失敗しました。";
            exit;
        }
    }
}