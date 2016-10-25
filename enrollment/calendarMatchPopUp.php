<?php
session_start();
  require("../config/config.php");
  require("../lib/db.php");
  $conn = db_init($config["host"],$config["duser"],$config["dpw"], $config["dname"]);

  $rock = 0;

			if(empty($_SESSION['nickname'])){
            //alert("로그인 후 에 사용 가능 합니다.");

            echo '<script>
            	$rock = 1;
            </script>';



          }
          else{ //팀리더는 하나의 팀만 개설 할 수 있도록 한다.

            $teamReader = $_SESSION['nickname'];
            $result = mysqli_query($conn,"SELECT count(*)  FROM teaminfo WHERE leader ='".$teamReader."'");
            $row = mysqli_fetch_assoc($result);
            
            $sendTeamName = mysqli_query($conn,"SELECT teamname  FROM teaminfo WHERE leader ='".$teamReader."'");
            $sendTeamName = mysqli_fetch_assoc($sendTeamName);

            if($row['count(*)'] >= 1){
            	
            }else{
            //alert("등록한 팀이 없거나 팀의 리더가 아닙니다.");
              echo '<script>
            	$rock = 1;
            </script>';
            }



          }
           

 ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- 부트스트랩 -->
   
   
</head>
<body>


<?php 

//day='+ day[0] + '&year=' + year + '&month=' + month  ;\
$day = $_GET['day'];
$year = $_GET['year'];
$month = $_GET['month']+1;
$selectVersion = $_GET['selectVersion'];
//echo $day . " " . $year . " " . $month ." ". $selectVersion;
//selectVersion 1 = 등록된 팀 주 변 (시) 단위 검색
//selectVersion 2 = 등록 된 팀 주변 (시, 군) 단위 검색

	    $teamLocation = "SELECT location FROM teaminfo WHERE id in (SELECT teamid FROM teammember WHERE playerid in(SELECT id FROM playerinfo WHERE emailid = '".$_SESSION['nickname']."'))";
	    $teamLocation = mysqli_query($conn, $teamLocation);
	    $teamLocation = mysqli_fetch_assoc($teamLocation);

	    $teamLocation =  $teamLocation['location'];
	    $teamLocation = explode(" ", $teamLocation);

	     $queryDay = $year ."-".$month . "-" . $day;

	     echo "<table style='padding-left: 50px; padding-top: 50px;'>";
                    

				if($selectVersion == 1){
                    $playDay = "select * from enrollmentmatchup where date = '" . $queryDay . "' && location like '" . $teamLocation[0] . "%'";
                    echo "<tr><td><font color = 'red' >" . $queryDay . "</font>일 등록 된 <font color = 'blue' >" . $teamLocation[0] . "</font>(시) 매칭</td></tr>";
                    }else if($selectVersion == 2){
                    $playDay = "select * from enrollmentmatchup where date = '" . $queryDay . "' && location like '" . $teamLocation[0]." ".$teamLocation[1] . "%'";
                    echo "<tr><td><font color = 'red' >" . $queryDay . "</font>일 등록 된 <font color = 'blue' >" . $teamLocation[0] . " ".$teamLocation[1] ."</font>(시, 군) 매칭</td></tr>";
                    }

                    $playDay = mysqli_query($conn,$playDay);

                    //경기 신청 버튼은 팀 리더만 가능하도록 해야함
                    while( $playD = mysqli_fetch_assoc($playDay)){
                        
                        echo "<tr><td>";

                        if(!empty($playD['leftTeamName']) && !empty($playD['rightTeamName']) ){
                            
                            echo "<br><font color = 'green'; size = '5' >". $playD['leftTeamName'] . "</font> vs <font color = 'blue'; size = '5'>" . $playD['rightTeamName'] . "</font>";
                        	
                        }
                        else if(!empty($playD['leftTeamName'])){
                            
                            echo "<br><font color = 'green'; size = '5'>". $playD['leftTeamName'];

                            if($rock == 0){ //$rock 이 0 일때 팀 의 리더 라는 것
                            echo "</font>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button class='btn btn-primary'  onclick = ' " . ' clickEvent("'.$playD['id'].'","'.$sendTeamName['teamname'].'")  '."  '; >매칭 신청하기</button>";
							}
                        }
                        echo "<tr>
                        <td><strong>경기장 위치:</strong><font size = '2'>
                        ". $playD['location'] ."</font>
                        </td>
                        </tr>
						<tr>
                        <td>위치 추가 설명:<font size = '2'>
                        ". $playD['explanation'] ."</font>
                        </td>
                        </tr>
                        ";

                        echo "</td></tr>";
                    }

                    echo "</table>";

//'". $playD['id'] . "','a'




 ?>

<script type="text/javascript">

	function clickEvent(id, name){
	

		if (confirm("신청 하시겠습니까?") == true){    //확인

			//insert into `submenubar` (id, title, event) values ('3' , '선수[팀] 등록' ,'선수 등록');

			window.open('/jobduo/enrollment/calendarMatchPopUpInsertRightTeam.php?name='+ name + '&id=' + id , '_blank', "width=570,height=700,toolbar=no");


   		}else{   //취소
		    return;
		}

	}
</script>


</body>
</html>
