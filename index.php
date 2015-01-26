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
  <!-- テス -->
  <h1>都道府県リスト</h1>

  <table border="1">
  <?php
  $dsn = 'mysql:dbname=FriendsDB;host=localhost';
  $user = 'root';
  $password = 'camp2015';
  $dbh = new PDO($dsn,$user,$password);
  $dbh->query('SET NAMES utf8');

  $sql = 'SELECT * FROM area_table WHERE 1';
  $stmt = $dbh->prepare($sql);
  $stmt->execute();

  while(1)
  {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);

    if($rec == false){
      break;
    }

    $sql2 = 'SELECT COUNT(`id`) FROM friends_table WHERE area_table_id =' . $rec['id'];
    $stmt2 = $dbh->prepare($sql2);
    $stmt2->execute();
    $rec2 = $stmt2->fetch(PDO::FETCH_ASSOC);

    if($rec2["COUNT(`id`)"] != 0){
      echo "<tr><td>{$rec['id']}</td><td><a href=http://" . $_SERVER['HTTP_HOST'] . "/friends/area_friends.php?area_id={$rec['id']}>{$rec['name']}</a></td><td>{$rec2["COUNT(`id`)"]}</td></tr>";
    } else {
      echo "<tr><td>{$rec['id']}</td><td>{$rec['name']}</td><td>{$rec2["COUNT(`id`)"]}</td></tr>";      
    }
  }

  $dbh = null;
  ?>

  <?php
  if(isset($_GET['DeleteFlg'])){
    $dsn = 'mysql:dbname=FriendsDB;host=localhost';
    $user = 'root';
    $password = 'camp2015';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->query('SET NAMES utf8');

    $sql3 = 'DELETE FROM `FriendsDB`.`friends_table` WHERE `friends_table`.`id` =' . $_GET['friends_id'];
    $stmt3 = $dbh->prepare($sql3);
    $stmt3->execute();

    $dbh = null;
  }

  ?>
  </table>
</body>

</html>