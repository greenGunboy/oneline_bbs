<?php
  //POST送信が行われたら、下記の処理を実行
  //テストコメント

  // $_POSTが存在していて、且つ空ではない(!empty)時。
  if(isset($_POST) && !empty($_POST)){
    header("Location: {$_SERVER['REQUEST_URI']}");

    //データベースに接続
    $dsn = 'mysql:dbname=oneline_bbs;host=localhost';
    $user = 'root';
    $password = '';

    // PDO(php data object)
    $dbh = new PDO($dsn,$user,$password);
    // query指定　言語
    $dbh->query('SET NAMES utf8');

    $nickname =$_POST['nickname'];
    $comment =$_POST['comment'];
     date_default_timezone_set("Asia/Manila");
    $created = date("Y-m-d H:i:s");   
    $nickname = htmlspecialchars($nickname);
    $comment = htmlspecialchars($comment);

    //SQL文作成(INSERT文)
    $sql = 'INSERT INTO `posts`(`nickname`, `comment`, `created`) VALUES ("'.$nickname.'", "'.$comment.'","'.$created.'")';
    $stmt = $dbh->prepare($sql);
    //INSERT文実行
    $stmt->execute();

    // $sql = 'SELECT * FROM `posts` WHERE 1';
    // $stmt = $dbh->prepare($sql);
    // $stmt->execute();

    // $rec = array();

    // while(1){
    //     $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    //     if($rec==false){
    //       break;
    //     }
    // $posts[]=$rec;
    //     echo $rec['id'];
    //     echo $rec['nickname'];
    //     echo $rec['comment'];
    //     echo $rec['created'];
    //     echo $rec'<br />';
    //   }



    //データベースから切断
    $dbh = null;

   
      }

  
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>セブ掲示版</title>

</head>
<body>
    <form action="bbs.php" method="post">
      <input type="text" name="nickname" placeholder="nickname" required>
     
      <textarea type="text" name="comment" placeholder="comment" required></textarea>
      <button type="submit" >つぶやく</button>
    </form>

    <?php

      $dsn = 'mysql:dbname=oneline_bbs;host=localhost';
      $user = 'root';
      $password = '';
      $dbh = new PDO($dsn,$user,$password);
      $dbh->query('SET NAMES utf8');

      $sql = 'SELECT * FROM `posts` WHERE 1';
      $stmt = $dbh->prepare($sql);
      // $data[]=$id;
      $stmt->execute();
      // var_dump($data);
      while(1){
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rec==false){ 
          break;
        }else{
        echo '<h2><a href="#">nickname'.$rec['nickname'].'</a> <span>'.$rec['created'].'</span></h2>
    <p>'.$rec['comment'].'</p>.';
        echo '<br />';
      }
    }
    
    ?>

</body>
</html>