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
  <?php
    //初期表示
    if(empty($_POST)){
      $dsn = 'mysql:dbname=FriendsDB;host=localhost';
      $user = 'root';
      $password = 'camp2015';
      $dbh = new PDO($dsn,$user,$password);
      $dbh->query('SET NAMES utf8');

      $sql = 'SELECT * FROM friends_table WHERE id =?';
      $stmt = $dbh->prepare($sql);
      $data[] = $_GET['friends_id'];
      $stmt->execute($data);
      $rec = $stmt->fetch(PDO::FETCH_ASSOC);
      $dbh = null;
    } else {
      //ポストされた時
      $dsn = 'mysql:dbname=FriendsDB;host=localhost';
      $user = 'root';
      $password = 'camp2015';
      $dbh = new PDO($dsn,$user,$password);
      $dbh->query('SET NAMES utf8');

      $sql = 'UPDATE `FriendsDB`.`friends_table` SET `area_table_id` = ' . $_POST['area_table_id'] . ', `name` = \''  . $_POST['name'] . '\', `gender` = \'' . $_POST['gender'] . '\' , `age` = ' . $_POST['age'] . ' WHERE `friends_table`.`id` =' . $_POST['id'];
      $stmt = $dbh->prepare($sql);
      $stmt->execute();
      $dbh = null;
      header('location: http://' . $_SERVER['HTTP_HOST'] . '/friends/area_friends.php?area_id=' . $_POST['area_table_id']);
      exit();
    }


  ?>

  <h1>都道府県リスト</h1>
  <form method="post" action="update_friends.php">
    名前<br>
    <input type="text" name="name" value="<?php echo $rec['name'] ;?>">
    <br>性別<br>
    <SELECT name="gender">
    <?php
    if($rec['gebder'] == "男"){
      echo '<OPTION value="男" selected>男</OPTION>';
      echo '<OPTION value="女">女</OPTION>';
    } else {
      echo '<OPTION value="男">男</OPTION>';
      echo '<OPTION value="女" selected>女</OPTION>';      
    }
    ?>
    </SELECT>
    <br>年齢<br>
    <input type="text" name="age" value="<?php echo $rec['age'] ;?>">
    <?php 
    echo '<input type="hidden" name="id" value=' . $rec['id'] . '>' ;
    ;?>
    <?php 
    echo '<input type="hidden" name="area_table_id" value=' . $rec['area_table_id'] . '>' ;
    ;?>
    <br>
    <input type="submit" value="修正">
  </form>

  <a href="javascript:history.back();">一つ前のページへ戻る</a>



</body>

</html>