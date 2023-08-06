<?php
include('./dbConfig.php');

$uri = $_SERVER['REQUEST_URI'];

if (strpos($uri, 'imageDetail.php') !== false) {
    $imageId = $_GET['id'];
    $sql = "SELECT * FROM images WHERE id = " . $imageId;

    $sth = $db->prepare($sql);
    $sth->execute();
    $data['image'] = $sth->fetch();
    
    $sql2 = "SELECT * FROM comments WHERE image_id = " . $imageId . " ORDER BY create_date DESC";

    $sth = $db->prepare($sql2);
    $sth->execute();
    $data['comments'] = $sth->fetchAll();
    $countComment = count($data['comments']);   
} else {
    $sql = "SELECT * FROM images ORDER BY create_date DESC";

    $sth = $db->prepare($sql);
    $sth->execute();
    $data = $sth->fetchAll();
}

return $data;