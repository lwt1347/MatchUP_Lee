<?php
session_start();
  require("../config/config.php");
  require("../lib/db.php");
  $conn = db_init($config["host"],$config["duser"],$config["dpw"], $config["dname"]);
 
  //id 로 정렬
 ?>


<?php 
	$address = $_POST['address'];
	$explanation = $_POST['explanation'];
	$startTime = $_POST['startTime'];
	$endTime = $_POST['endTime'];
	$teamName = $_POST['teamName'];
	$date = $_POST['date'];

    //$toDayDate = date("Y-m-d");
	echo $date;

	$insertInfo = "insert into `enrollmentMatchUp` (location, leftTeamName, explanation, startTime, endTime, date)value('".$address."','".$teamName."', '".$explanation."', '".$startTime."','".$endTime."','"
	.$date."')";
	mysqli_query($conn,$insertInfo);

	//$result = mysqli_query($conn,);
    //$row = mysqli_fetch_assoc($result);
	echo "<script>alert('경기 일정이 등록 되었습니다.');window.close();</script>";










 ?>