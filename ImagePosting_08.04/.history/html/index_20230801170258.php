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
  <?php include('./header.php') ?>
  <div class="imageList">
    <?php
      $imageCount = count($data); // 画像の数を取得
      $maxImageCount = 10; // 最大画像数を設定
      for ($i = 0; $i < $maxImageCount; $i++) {
        echo '<div class="imageFrame">';
        if ($i < $imageCount) {
          $image = $data[$i];
          echo '<a href="./imageDetail.php?id=' . $image['id'] . '"><img src="../images/' . $image['file_name'] . '" alt="投稿画像"></a>';
        } else {
          echo '<div class="emptyImageFrame"></div>'; // 画像がない場合の空の枠
        }
        // 番号を表示
        echo '<div class="imageNumber">' . ($i + 1) . '</div>';
        echo '</div>';
      }
    ?>
  </div>
</body>
</html>
