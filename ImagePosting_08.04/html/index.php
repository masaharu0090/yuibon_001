<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>画像投稿アプリ</title>
</head>

<body>
    <?php include('../includes/dbConfig.php') ?>
    <?php include('../includes/getDatas.php') ?>
    <?php include('../views/header.php') ?>
    <div class="imageList">
        <?php
      $imageCount = count($data); // 画像の数を取得
      $maxImageCount = 10; // 最大画像数を設定
      for ($i = 0; $i < $maxImageCount; $i++) {
        if ($i < $imageCount) {
          $image = $data[$i];
          echo '<div class="imageFrame">';
          echo '<a href="../views/imageDetail.php?id=' . $image['id'] . '"><img src="../assets/images/' . $image['file_name'] . '" alt="投稿画像"></a>';
          // 番号を表示
          echo '<div class="imageNumber">' . ($i + 1) . '</div>';
          echo '</div>';
        } else {
          echo '<div class="imageFrame emptyImageFrame"></div>'; // 画像がない場合の空の枠
        }
      }
    ?>
    </div>
</body>

</html>