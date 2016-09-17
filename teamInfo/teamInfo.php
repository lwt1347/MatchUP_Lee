<?php
  session_start();
  require("../config/config.php");
  require("../lib/db.php");
  $conn = db_init($config["host"],$config["duser"],$config["dpw"], $config["dname"]);
  //$result = mysqli_query($conn, "SELECT * FROM menubar ORDER BY id ASC");
  
  //팀 인포를 볼때는 세션을 통해 아이를 이용해 등록된 팀을 확인하고 그 팀의 정보를 띄어준다.

  
  
  $result = mysqli_query($conn, "SELECT id FROM playerinfo WHERE emailid = '". $_SESSION['nickname'] . "'");
  $playerid = mysqli_fetch_assoc($result);
  //echo $row['id'];  // 여기서 플레이어의 아이디를 얻어 냈다. 다음에는 팀 맴버와 
  $result = mysqli_query($conn, "SELECT teamid FROM teammember WHERE playerid = '". $playerid['id'] . "'");
  $teamid = mysqli_fetch_assoc($result);
  
  //echo $teamid['teamid'];
  $result = mysqli_query($conn, "SELECT * FROM teaminfo WHERE id = '". $teamid['teamid'] . "'");
  $result = mysqli_fetch_assoc($result);

  $TeamName =  $result['teamname'];



  $TeamLogo =  $result['logoimage'];

  $TeamLeader = $result['leader'];
  //$TeamPlayer =
  $TeamWin =  $result['win'];
  $TeamLose =  $result['lose'];

  //echo $TeamName. " ". $TeamLogo . " " . $TeamLeader . " " . $TeamWin. " " .$TeamLose;

//echo($TeamLogo);
//echo($TeamLeader);


 ?>
<script type="text/javascript" language = "javascript">
// 모바일 웹 주소창 숨기기
window.addEventListener('load', function() {
  // body의 height를 살짝 늘리는 코드
  document.body.style.height = (document.documentElement.clientHeight + 5) + 'px';
  // scroll를 제어 하는 코드
  setTimeout(scrollTo, 0, 0, 1);
}, false);
</script>


 <script type="text/javascript">
 	var TeamName = "<?= $TeamName ?>"; //php 변수 사용하는 방법.
 	var TeamLeader =  "<?= $TeamLeader ?>";
 	var TeamWin =  "<?= $TeamWin ?>";
 	var TeamLose =  "<?= $TeamLose ?>";
 	//document.write(TeamName);
 </script>

<script type="text/javascript">
	 	//location.replace("http://192.168.105.208/jobduo");
	 	//window.open("http://192.168.105.208/jobduo/teamInfo/teamInfo.php", "하하호호", "width=400, height=540 menubar=no, status = no, toolbar = no");
</script>


<!DOCTYPE html>

  <link rel="stylesheet" type = "text/css" href="./teamInfo.css">

<html>
<meta http-equiv="keywords" content="keyword1,keyword2,keyword3">
    <meta http-equiv="description" content="this is my page">
    <meta http-equiv="content-type" content="text/html; charset=EUC-KR">
<head>
	<title>

					<?php 
						echo  "'" . $TeamName . '\' 팀 페이지';
					?>

	</title>
</head>

<body onclick="self.close()" style="overflow-y:hidden" >	

<div width="100px" style="color:white; background-color:#3478af;" align="center">
	<text  style="color:white; background-color:#3478af; height:30px; border:none" /><font size = "6px">Match Up</font></text>
</div>

<article>
      <nav class="MainText">

      	<div class ="row">
		<div class="collapse-navbar-collapse">
		
		<table id = "mainTable">
			<tr>
				
				<td>
				Team:
					<?php 
						echo  $TeamName;
					?>
				</td>
			</tr>

			<tr>
				<td>
				
					<?php 
						echo  "<br><img src='" . $TeamLogo . "' style='border-style:solid; border-color:#3478af;'>";
					?>
				</td>
			</tr>

			<tr>
				<td>
				    리더: 
					<?php 
						echo  $TeamLeader;
					?>
				</td>
			</tr>

			<tr>
				<td>
					<?php 
						echo  "승: ".$TeamWin."&nbsp;&nbsp;&nbsp;&nbsp;";
						echo  "패: ".$TeamLose;
					?>
				</td>
			
			</tr>
			


		</table>

		</div>
		</div>



	  </nav>
</article>

</body>
</html>