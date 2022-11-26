<?php
require_once('env.php');
 class Dbc
 {
     protected  $table_name;

    //データベース接続関数
    public function dbConnect(){  
        $host = DB_HOST;
        $dbname = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
 
        try{
            $dbh = new PDO($dsn,$user,$pass,[
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);
        } catch(PDOOException $e){
            echo "接続失敗".$e->getMessage();
            exit();
        };
        return $dbh;
    }

    //データ取得関数
    public function getAll(){
        $dbh = $this->dbConnect();
        $sql = 'SELECT * FROM blogs';
        $stmt = $dbh->query($sql);
        $result = $stmt->fetchall(PDO::FETCH_ASSOC);
        return $result;
        $dbh = null;
    }

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

    //詳細を押したテーブルを取得
    public function getById($id){
        if(empty($id)){
            exit('idが不正です');
        }
        
        $dbh = $this->dbConnect();
        
        //sql
        $stmt = $dbh->prepare('SELECT * FROM blogs WHERE id=:id');
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if(!$result) {
            exit('ブログがありません');
        }
        return $result;
    }

    function blogCreate($blogs){
        $sql = 'INSERT INTO 
                Blogs(title, content, category, publish_status)
            VALUES 
                (:title, :content, :category, :publish_status)';

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

    public function delete($id){
        if(empty($id)){
            exit('idが不正です');
        }
        
        $dbh = $this->dbConnect();
        
        //sql
        $stmt = $dbh->prepare('DELETE FROM blogs WHERE id=:id');
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $stmt->execute();
        echo 'ブログを削除しました。';
    }
 }
?>



