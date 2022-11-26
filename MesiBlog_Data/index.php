<?php
require_once('blog.php');
$blog = new Blog();
$blogData =$blog->getAll();
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ブログ一覧</title>
</head>
<body>
    <h1>ブログ一覧</h1>
    <p><a href="form.html">新規作成</a></p>
    <table>
        <tr>
            <th>タイトル</th>
            <th>カテゴリ</th>
            <th>投稿日時</th>
        </tr>
        <?php foreach($blogData as $column): ?>
        <tr>
            <td><?php echo $column['title']?></td>
            <td><?php echo $blog->setCategoryName($column['category']) ?></td>
            <td><?php echo $column['post_at']?></td>
            <td><a href="data.php?id=<?php echo $column['id']?>">詳細</a></td>
            <td><a href="update_form.php?id=<?php echo $column['id']?>">編集</a></td>
            <td><a href="blog_delete.php?id=<?php echo $column['id']?>">削除</a></td>
        </tr>
        <?php endforeach?>
    </table>
</body>
</html>
