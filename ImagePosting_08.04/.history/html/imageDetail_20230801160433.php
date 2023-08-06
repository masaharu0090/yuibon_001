<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style.css">
  <title>画像投稿アプリ</title>
</head>
<body>
  <?php include('../dbConfig.php') ?>
  <?php include('../getDatas.php') ?>

  <div class="detailImageBox">
    <div class="detailImage">
      <img src="../images/<?php echo $data['image']['file_name']; ?>" alt="投稿画像">
      <div class="detailImagButton">
        <button class="updateButton" onclick="location.href='./postImageForm.php?id=<?php echo $_GET['id']; ?>';">更新</button>
        <button class="deleteButton" onclick="location.href='../deleteImage.php?id=<?php echo $_GET['id']; ?>';">削除</button>
      </div>
      <button onclick="location.href='./index.php';">戻る</button>
    </div>
    <div class="comment">

  </div>
</div>
</body>
</html>