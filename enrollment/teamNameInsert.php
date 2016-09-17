<?php
session_start();
  require("../config/config.php");
  require("../lib/db.php");
  $conn = db_init($config["host"],$config["duser"],$config["dpw"], $config["dname"]);
  $result = mysqli_query($conn, "SELECT * FROM menubar ORDER BY id ASC");
  
  //팀 등록하기 버튼을 누르면 작동하는 페이지 이다.
  //팀 이름만 설정하면 팀 등록은 가능하다.

  //id 로 정렬
 ?>



 <?php 

 $readerName = $_POST['readerName'];
 $teamName = $_POST['teamName'];
 $address = $_POST['address'];
 $logoImage = $_POST['logoImage'];
 
$logoImage = explode('\\', $logoImage);
//echo $logoImage[2];
//echo ('http://192.168.105.208/jobduo/fileupload/file/'. $teamName . '/' . $logoImage[2]);

if($address == ''){
	$address = "등록되지 않았습니다.";
}
	
 $buyTotalCount = mysqli_query($conn, "SELECT count(*) FROM teaminfo ");
    $buyTotalCount =  mysqli_fetch_assoc($buyTotalCount);
    $buyTotalCount = $buyTotalCount['count(*)'] + 1;
//echo $buyTotalCount;


//아래 쿼리를 통해 데이터 베이스 teaminfo 에 값을 집어 넣는다.
$query = "insert into `teaminfo` (num, teamname, logoimage, win, lose, location, leader)value('".$buyTotalCount."', '".$teamName."', 'http://192.168.105.208/jobduo/fileupload/file/team/". $teamName . "/" . $logoImage[2] . "' , '0', '0' ,'" . $address."','". $readerName . "');";

mysqli_query($conn,$query);

//선수 id 와 팀 id 를 통해 teammember 테이블 작성 라이브러리로 작성함
require("./playerintoteam.php");
  ?>

   <?php
	if(empty($_POST['MAX_FILE_SIZE']) === false){ //자기 자신에게 회신할때 회신을 안한상태에서 오류를 막기위해서
	  ini_set("display_errors", "1");
	   $uploaddir = 'C:\Bitnami\wampstack-5.6.25-0\apache2\htdocs\jobduo\fileupload\file\team\\'. $teamName .'\\'; // \\2개를 하는 이유는 \의 기능을 제거하기 위해서

	   $uploaddir = iconv("utf-8", "euckr", $uploaddir);
	   //iconv 를 통한 인코딩으로 한글 폴더 설정이 가능하도록 한다.

	    if(!is_dir($uploaddir)) { //폴더가 존재하지 않는다면 생성한다 따라서 폴더를 주키인 ID로 나누고 ID에 따라 DB에서 이미지를 가져올수 있도록한다
	      mkdir($uploaddir,0777);      //또한 ID와 num 을 따로 구분해서 삭제시에도 ID는 변경이 없도록 한다.
	      }


	   $uploadfile = $uploaddir . getbasename($_FILES['userfile']['name']);
	  //echo '<pre>';
	  if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) { //tmp_name = 임시저장위치
	     //move_uploaded_file 보안성이 띄어나다
	       //echo "파일이 유효하고, 성공적으로 업로드 되었습니다.\n";
	  } else {
	       print "파일 업로드 공격의 가능성이 있습니다!\n";
	  }

	}

	//basename = 는 한글저장시 오류 발생하기 때문에  아래 함수를 사용한다.
	function getbasename($path) { 
	$pattern = (strncasecmp(PHP_OS, 'WIN', 3) ? '/([^\/]+)[\/]*$/' : '/([^\/\\\\]+)[\/\\\\]*$/'); 
	if (preg_match($pattern, $path, $matches)) 
	return $matches[1]; 
	return ''; 
	} 
	 ?>



	 <script type="text/javascript">
	 	location.replace("http://192.168.105.208/jobduo/teamInfo/teamInforouter.php");
	 	//window.open("http://192.168.105.208/jobduo/teamInfo/teamInfo.php", "하하호호", "width=400, height=540 menubar=no, status = no, toolbar = no");
	 </script>





	<!-- <script type="text/javascript">
	 	location.replace("http://192.168.105.208/jobduo");
	 	window.open("http://192.168.105.208/jobduo/teamInfo/teamInfo.php", "하하호호", "width=400, height=540 menubar=no, status = no, toolbar = no");
	 </script>
-->



