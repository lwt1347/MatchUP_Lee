<?php 
$query = "select id from playerinfo where emailid = '". $_SESSION['nickname'] ."'";
$playerid = mysqli_query($conn,$query);
$playerid = mysqli_fetch_assoc($playerid);

$query = "select id from teaminfo where teamname = '". $teamName ."'";
$teamid = mysqli_query($conn,$query);
$teamid = mysqli_fetch_assoc($teamid);

echo($playerid['id']." ".$teamid['id']);
$query = "insert into `teammember` (teamid, playerid)value('". $teamid['id'] ."','". $playerid['id'] ."');";
mysqli_query($conn,$query);
 ?>