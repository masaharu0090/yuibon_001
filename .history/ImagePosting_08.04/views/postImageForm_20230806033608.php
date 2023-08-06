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
    <!-- ヘッダーをインクルード -->
    <?php include('./header.php') ?>

    <div class="submitImage">
        <!-- $_GET['id']がセットされている場合は画像を更新するためのフォーム -->
        <?php if(isset($_GET['id'])) { ?>
        <!-- フォームのアクションはupdateImage.phpに向け、idをパラメータとして渡す -->
        <form action="../updateImage.php?id=<?php echo($_GET['id']); ?>" method="post" enctype="multipart/form-data">
            <?php } else { ?>
            <!-- $_GET['id']がセットされていない場合は新しい画像を投稿するためのフォーム -->
            <!-- フォームのアクションはpostImage.phpに向ける -->
            <form action="../api/postImage.php" method="post" enctype="multipart/form-data">
                <?php } ?>
                <!-- プレビュー用の画像タグ -->
                <img id="preview">
                <!-- 画像ファイルの入力フィールド。ファイルが選択されたらpreviewFile関数を呼び出し -->
                <input type="file" name="file" onchange="previewFile(this);">
                <!-- フォームの送信ボタン -->
                <button type="submit" name="submit">送信</button>
            </form>
            <!-- インデックスページに戻るためのボタン -->
            <button onclick="location.href='./index.php';" class="backButton">戻る</button>
    </div>
</body>

</html>


<script>
function previewFile(event) {
    var fileData = new FileReader();
    fileData.onload = (function() {
        document.getElementById('preview').src = fileData.result;
    });
    fileData.readAsDataURL(event.files[0]);
}
</script>