<!DOCTYPE HTML PUBLIC"-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta http-equive="Content-Type" content="text/html;charset=UTF-8" >
  <title>都道府県リスト</title>
  <style>
  @import "style.css";
  </style>
</head>
<body>
  <h1>都道府県リスト</h1>
  <form method="post" action="add_friends.php">
    名前<br>
    <input type="text" name="name" value="">
    <br>性別<br>
    <SELECT name="gender"> 
    <OPTION value="男" selected>男</OPTION>
    <OPTION value="女">女</OPTION>
    </SELECT>
    <br>年齢<br>
    <input type="text" name="age" value="">
    <?php 
    echo '<input type="hidden" name="area_id_2" value=' . $_POST['area_id'] . '>' ;
    ;?>
    <br>
    <input type="submit" value="保存">
  </form>

  <a href="javascript:history.back();">一つ前のページへ戻る</a>

  <?php
  if(isset($_POST['area_id_2'])){
    try{
      $dsn = 'mysql:dbname=FriendsDB;host=localhost';
      $user = 'root';
      $password = 'camp2015';
      $dbh = new PDO($dsn,$user,$password);
      $dbh->query('SET NAMES utf8');

      $name = htmlspecialchars($_POST['name']);
      $gender = htmlspecialchars($_POST['gender']);
      $age = htmlspecialchars($_POST['age']);
      $area_id_2 = htmlspecialchars($_POST['area_id_2']);

      $sql = 'INSERT INTO friends_table (name,gender,age,area_table_id) VALUES ("'.$name.'","'.$gender.'","'.$age.'","' . $area_id_2 . '")';
      $stmt = $dbh->prepare($sql);
      $stmt->execute();

      $dbh = null;
      
      header('location: area_friends.php?area_id=' . $area_id_2);
      exit();

    } catch(Exception $e){
      echo 'ただいま障害により大変ご迷惑をおかけしております。';
    }
  }
  ?>



</body>

</html>