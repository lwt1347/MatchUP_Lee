<?php 

  session_start();
  require("../config/config.php");
  require("../lib/db.php");
  $conn = db_init($config["host"],$config["duser"],$config["dpw"], $config["dname"]);

$name = $_GET['name'];
$id = $_GET['id'];
echo $name . " " . $id;

mysqli_query($conn,"update `enrollmentmatchup` set rightTeamName = '".$name."' where id = " . $id);
//echo "update `enrollmentmatchup` set rightTeamName = '".$name."' where id = " . $id;
//alert("신청이 완료 되었습니다.");

 ?>

 <script type="text/javascript">
 alert("경기 신청이 완료 됬습니다.");
 	window.close();

 </script>