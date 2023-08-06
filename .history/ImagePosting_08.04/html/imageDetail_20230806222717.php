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
    <?php
    include('../dbConfig.php');
    include('../getDatas.php');

    // 画像の情報を取得
    $imageId = $_GET['id'];
    $sql = "SELECT * FROM images WHERE id = " . $imageId;
    $sth = $db->prepare($sql);
    $sth->execute();
    $data['image'] = $sth->fetch();

    // コメントの情報を取得
    $sql2 = "SELECT * FROM comments WHERE image_id = " . $imageId . " ORDER BY create_date DESC";
    $sth = $db->prepare($sql2);
    $sth->execute();
    $data['comments'] = $sth->fetchAll();

    // コメントの数を取得
    $countComment = count($data['comments']);

    // コメントがない場合は空の配列を代入することでエラーを回避
    if ($countComment === 0) {
        $data['comments'] = array();
    }

    $newComment = isset($_POST['comment']) ? $_POST['comment'] : '';
    $newTitle = isset($_POST['title']) ? $_POST['title'] : '';

    if (!empty($newComment) || !empty($newTitle)) {
        // コメントかタイトルが送信された場合はデータベースを更新
        if ($countComment === 0) {
            // コメントがない場合は新しいコメントとタイトルを追加
            $sql = "INSERT INTO comments (image_id, title, comment) VALUES (:image_id, :title, :comment)";
        } else {
            // コメントがある場合は最新のコメントとタイトルを更新
            $sql = "UPDATE comments SET title = :title, comment = :comment WHERE id = :comment_id";
        }
        $sth = $db->prepare($sql);
        $sth->bindValue(':image_id', $imageId, PDO::PARAM_INT);
        $sth->bindValue(':title', $newTitle, PDO::PARAM_STR);
        $sth->bindValue(':comment', $newComment, PDO::PARAM_STR);
        if ($countComment > 0) {
            $sth->bindValue(':comment_id', $data['comments'][0]['id'], PDO::PARAM_INT);
        }
        $sth->execute();

        // 再度コメントの情報を取得
        $sql2 = "SELECT * FROM comments WHERE image_id = " . $imageId . " ORDER BY create_date DESC";
        $sth = $db->prepare($sql2);
        $sth->execute();
        $data['comments'] = $sth->fetchAll();
        $countComment = count($data['comments']);
    }
    ?>

    <?php include('./header.php') ?>
    <div class="detailImageBox">
        <div class="detailImage">
            <img src="../images/<?php echo $data['image']['file_name']; ?>" alt="投稿画像">
            <div class="detailImagButton">
                <button class="updateButton"
                    onclick="location.href='./postImageForm.php?id=<?php echo $_GET['id']; ?>';">更新</button>
                <button class="deleteButton"
                    onclick="location.href='../deleteImage.php?id=<?php echo $_GET['id']; ?>';">削除</button>
            </div>
            <button onclick="location.href='./index.php';">戻る</button>
        </div>

        <div class="comment">
            <p class="commentTitle">コメント</p>
            <ul>
                <?php for ($i = 0; $i < $countComment; $i++) { ?>
                <li>
                    <?php if (!empty($data['comments'][$i]['title'])) { ?>
                    <div class="commentTitle"><?php echo $data['comments'][$i]['title']; ?>
                        <form action="../deleteTitle.php" method="post">
                            <input type="hidden" name="comment_id" value="<?php echo $data['comments'][$i]['id']; ?>">
                            <input type="hidden" name="image_id" value="<?php echo $_GET['id']; ?>">
                            <button type="submit" name="delete">削除</button>
                        </form>
                    </div>
                    <?php } ?>
                    <div class="commentContent"><?php echo $data['comments'][$i]['comment']; ?>
                        <!-- コメント削除ボタンを表示 -->
                        <form action="../deleteComment.php" method="post">
                            <input type="hidden" name="comment_id" value="<?php echo $data['comments'][$i]['id']; ?>">
                            <input type="hidden" name="image_id" value="<?php echo $_GET['id']; ?>">
                            <button type="submit" name="delete">削除</button>
                        </form>
                    </div>
                </li>
                <?php } ?>
            </ul>
            <div class="submitComment">
                <form action="../postComment.php?image_id=<?php echo $_GET['id']; ?>" method="post"
                    enctype="multipart/form-data">
                    <textarea name="comment" id="comment" cols="40" rows="10" oninput="enableSubmitButton()"></textarea>
                    <!-- タイトル入力欄の追加 -->
                    <div id="titleInputContainer" style="display: none;">
                        <input type="text" name="title" id="title" placeholder="タイトルを入力してください">
                        <button type="button" onclick="hideTitleInput()">キャンセル</button>
                    </div>
                    <button type="button" id="titleButton" onclick="showTitleInput()">タイトル入力</button>
                    <button type="submit" name="submit" id="submitButton" disabled>送信</button>
                </form>
            </div>
        </div>
    </div>

    <script>
    function enableSubmitButton() {
        const commentInput = document.getElementById('comment');
        const titleInput = document.getElementById('title');
        const submitButton = document.getElementById('submitButton');
        submitButton.disabled = commentInput.value.trim() === '' && titleInput.value.trim() === '';
    }

    function showTitleInput() {
        const titleInputContainer = document.getElementById('titleInputContainer');
        const titleButton = document.getElementById('titleButton');
        titleInputContainer.style.display = 'block';
        titleButton.style.display = 'none';
    }

    function hideTitleInput() {
        const titleInputContainer = document.getElementById('titleInputContainer');
        const titleButton = document.getElementById('titleButton');
        titleInputContainer.style.display = 'none';
        titleButton.style.display = 'block';
    }
    </script>
</body>

</html>