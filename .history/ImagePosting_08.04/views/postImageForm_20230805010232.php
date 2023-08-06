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
    <?php include('./header.php') ?>
    <div class="submitImage">
        <?php if(isset($_GET['id'])) { ?>
        <form action="../api/updateImage.php?php echo($_GET['id']); ?>" method="post" enctype="multipart/form-data">
            <?php } else ?>
            <form action="../api/postImage.php" method="post" enctype="multipart/form-data">
                <input type="file" name="file" id="file">
                <input type="submit" name="submit" value="Upload">
            </form>

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