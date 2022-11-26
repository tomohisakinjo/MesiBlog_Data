<?php
require_once('dbc.php');

Class Blog extends Dbc 
{ 
    protected $table_name = 'blogs' ; 

    //カテゴリー名の設定
    public function setCategoryName($category){
        if($category == '1'){
            return '南部';
        }elseif($category == '2'){
            return '中部';
        }else{
            return '北部';
        }
    }

    //ブログ作成
    public function blogCreate($blogs){
        $sql = "INSERT INTO 
                $this->table_name(title, content, category, publish_status)
            VALUES 
                (:title, :content, :category, :publish_status)";

        $dbh = $this->dbConnect();

        try {
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':title', $blogs['title'], PDO::PARAM_STR );
            $stmt->bindValue(':content', $blogs['content'], PDO::PARAM_STR );
            $stmt->bindValue(':category', $blogs['category'], PDO::PARAM_INT );
            $stmt->bindValue(':publish_status', $blogs['publish_status'], PDO::PARAM_INT );
            $stmt->execute();
            echo 'ブログを投稿しました。';
        } catch(PDOException $e){
            exit($e);
        }
    }
    
    //ブログ編集・投稿時の確認画面
    public function blogValidate($blogs){
        if (empty($blogs['title'])) {
            exit('タイトルを入力しください');
        }
    
        if (mb_strlen($blogs['title']) > 200) {
            exit('タイトルを200文字未満にしてください。');
        }
    
        if (empty($blogs['content'])) {
            exit('本文を入力しください');
        }
    
        if (empty($blogs['category'])) {
            exit('カテゴリーを入力しください');
        }
    
        if (empty($blogs['publish_status'])) {
            exit('公開ステータスを入力しください');
        }
    }

    public function blogUpdate($blogs){
        $sql = "UPDATE $this->table_name SET
            title = :title, content = :content, category = :category, publish_status = :publish_status
        WHERE
            id = :id";

        $dbh = $this->dbConnect();

        try {
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':title', $blogs['title'], PDO::PARAM_STR );
            $stmt->bindValue(':content', $blogs['content'], PDO::PARAM_STR );
            $stmt->bindValue(':category', $blogs['category'], PDO::PARAM_INT );
            $stmt->bindValue(':publish_status', $blogs['publish_status'], PDO::PARAM_INT );
            $stmt->bindValue(':id', $blogs['id'], PDO::PARAM_INT );
            $stmt->execute();
            echo 'ブログを更新しました。';
        } catch(PDOException $e){
            exit($e);
        }
    }
}
?>