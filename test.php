<?php
  //POST送信が行われたら、下記の処理を実行
  //テストコメント
  if(isset($_POST) && !empty($_POST)){
    //データベースに接続
    $dsn = 'mysql:dbname=oneline_bbs;host=localhost';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->query('SET NAMES utf8');
    // $created = string date ( string $format [, int $timestamp = time() ] )

    //SQL文作成(INSERT文)
    $sql = 'INSERT INTO `posts`(`nickname`, `comment`, `created`) VALUES ("'.$nickname.'", "'.$comment.'", "'.$created.'")';
    $stmt = $dbh->prepare($sql);
    //INSERT文実行
    $stmt->execute();
    //データベースから切断
    $dbh = null;

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rec==false){ 
          echo '検索結果がありませんでした';
        }else{
        echo $rec['code'];
        echo $rec['nickname'];
        echo $rec['comment'];
        echo $rec['created'];
        echo '<br />';
    
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

    <h2><a href="#">nickname Eriko</a> <span>2015-12-02 10:10:20</span></h2>
    <p>つぶやきコメント</p>

    <h2><a href="#">nickname Eriko</a> <span>2015-12-02 10:10:10</span></h2>
    <p>つぶやきコメント2</p>
</body>
</html>string date ( string $format [, int $timestamp = time() ] )