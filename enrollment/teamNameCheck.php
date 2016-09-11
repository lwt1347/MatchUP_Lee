<?php
  require("../config/config.php");
  require("../lib/db.php");
  $conn = db_init($config["host"],$config["duser"],$config["dpw"], $config["dname"]);
  $result = mysqli_query($conn, "SELECT * FROM menubar ORDER BY id ASC");
  //id 로 정렬
 ?>

<?php
//$d1->setTimezone(new DateTimezone($_POST['timezone']));

$teamName = "'".$_POST['format']."'";
$result = mysqli_query($conn,"SELECT teamname FROM teaminfo WHERE teamname =".$teamName);
$row = mysqli_fetch_assoc($result);


if(!empty($row['teamname'])){
	//echo "<span style='color:red'>팀 명이 중복됩니다.</span>";
	echo "1";
}else{
	echo "2";
	//echo "<span style='color:green'>사용 가능한 팀 이름입니다.</span>";
}

?>