<?php
require_once('blog.php');
$blog = new Blog();
$result = $blog->getById($_GET['id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>詳細</title>
</head>
<body>
    <h1>ブログ詳細</h1>
    <h2>タイトル:<?php echo $result['title'] ?></h2>
    <p>投稿日<?php echo $result['post-at'] ?></p>
    <p>カテゴリ:<?php echo $blog->setCategoryName($result['category']) ?></p>
    <hr>
    <p>本文：<?php echo $result['content'] ?></p>
    <p><a href="index.php">戻る</a></p>
</body>
</html>