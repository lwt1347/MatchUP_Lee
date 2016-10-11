<?php
  require("config/config.php");
  require("lib/db.php");
  $conn = db_init($config["host"],$config["duser"],$config["dpw"], $config["dname"]);

  //id 로 정렬
 ?>


<?php 
$title = $_POST["title"];
$writer = $_POST["author"];
$mainText = $_POST["mainText"];

if(empty($title)){

  echo '<script>
            alert("제목을 입력하세요.");
            history.back();
            </script>';

} else if(empty($mainText)){
 
  echo '<script>
            alert("본문 내용을 입력하세요.");
            history.back();
            </script>';
}


$query = "select max(num)+1 as count from freenoticeboard;";
$result = mysqli_query($conn,$query);

$row = mysqli_fetch_assoc($result);

$toDayDate = date("Y-m-d");

//시간 떄문에 안들어가는거임

$query = "insert into `freenoticeboard` (num, title, maintext, author, data, views) values ('" . $row['count'] . "','" . $title ."','" . $mainText ."','" . $writer ."','". $toDayDate ."','0');"; 
//echo $query;

mysqli_query($conn,$query);

 echo '<script>
            alert("게시글이 작성 되었습니다.");
            </script>';
echo("<script>location.replace('/jobduo/freenoticeboard.php?page=1&list=10');</script>");
 

//아래 쿼리를 통해 데이터 베이스 teaminfo 에 값을 집어 넣는다.
//$query = "insert into `playerinfo` (number, name, position, goal, location, win, lose, image, emailid)value('".$number."', '".$nickName."', '".$position."', '0' , '".$address."', '0', '0' , 'http://192.168.105.208/jobduo/fileupload/file/player/". $nickName . "/" . $Image[2] . "', '".$emailNmae."');";

//$query = "insert into `teaminfo` (num, teamname, logoimage, win, lose, location, leader)value('".$buyTotalCount."', '".$teamName."', 'http://192.168.105.208/jobduo/fileupload/file/team/". $teamName . "/" . $logoImage[2] . "' , '0', '0' ,'" . $address."','". $readerName . "');";







 ?>
