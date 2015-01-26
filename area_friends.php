<!DOCTYPE HTML PUBLIC"-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta http-equive="Content-Type" content="text/html;charset=UTF-8" >
  <title>都道府県リスト</title>
  <style>
  @import "style.css";
  </style>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
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

  $area_id = $_GET['area_id'];

  $sql2 = 'SELECT * FROM area_table WHERE id =?';
  $stmt2 = $dbh->prepare($sql2);
  $data2[] = $area_id;
  $stmt2->execute($data2);
  $rec2 = $stmt2->fetch(PDO::FETCH_ASSOC);
  echo "<h1>{$rec2['name']}のお友達</h1>";

  $sql = 'SELECT * FROM friends_table WHERE area_table_id =?';
  $stmt = $dbh->prepare($sql);
  $data[] = $area_id;
  $stmt->execute($data);


  $i=0;
  $male_cnt = 0;
  $female_cnt = 0;

  while(1)
  {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);

    if($rec == false){
      break;
    }
    $i++;
    if($rec['gender'] === '男'){
      $male_cnt++;
    } else {
      $female_cnt++;
    }

    echo "<tr>";
    echo "
      <td>{$rec['id']}</td><td>{$rec['name']}</td>
      <td>{$rec['gender']}</td><td>{$rec['age']}</td>
      <td><a href=update_friends.php/?friends_id=" . $rec['id'] . "&area_id=" . $_GET['area_id'] . ">変更</a></td>
      <td><a class='delete' href=index.php/?friends_id=" . $rec['id'] . "&DeleteFlg=1>削除</a></td>";
    echo "</tr>";
  }

  $dbh = null;
  ?>

  </table>
  
  <?php
  echo "男性：{$male_cnt}人";
  echo "<br>";
  echo "女性：{$female_cnt}人";
  //0人表示
  if($i === 0){
    echo "合計{$i}人でした。";
  }
  //idをフォームで送信
  echo '<form method="post" action="add_friends.php">';
  echo '<input type="hidden" name="area_id" value=' . $_GET['area_id'] . '>';
  echo '<input type="submit" value="追加する">';
  ?>
  <a href="javascript:history.back();">一つ前のページへ戻る</a>
</body>

<script>
$('.delete').click(function(e){
  var res = confirm("本当に削除ししますか？");

  if(res == false){
    e.preventDefault();
  }

});
</script>
</html>