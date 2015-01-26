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

  <table border="1">
  <?php
  $dsn = 'mysql:dbname=FriendsDB;host=localhost';
  $user = 'root';
  $password = 'camp2015';
  $dbh = new PDO($dsn,$user,$password);
  $dbh->query('SET NAMES utf8');

  //都道府県のidとエリアのidが一致している時、そのデータのカウントをもってこい
  $sql = 'select area_table.*,count(friends_table.id) as `friends_cnt` from area_table left outer join friends_table on area_table.id = friends_table.area_table_id group by area_table.id';
  $stmt = $dbh->prepare($sql);
  $stmt->execute();

  while(1)
  {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);

    if($rec == false){
      break;
    }

    if($rec['friends_cnt'] != 0){
      echo "<tr><td>{$rec['id']}</td><td><a href=area_friends.php?area_id={$rec['id']}>{$rec['name']}</a></td><td>{$rec['friends_cnt']}</td></tr>";
    } else {
      echo "<tr><td>{$rec['id']}</td><td>{$rec['name']}</td><td>{$rec['friends_cnt']}</td></tr>";
    }
  }

  $dbh = null;
  ?>
  </table>
</body>

</html>