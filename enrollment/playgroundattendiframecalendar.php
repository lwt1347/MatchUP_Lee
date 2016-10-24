<?php 
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
  <title></title>

   <link href="/jobduo/bootstrap-3.3.2-dist/bootstrap-3.3.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type = "text/css" href="../style.css">

    <link rel='stylesheet' type='text/css' href='http://arshaw.com/js/fullcalendar-1.6.3/fullcalendar/fullcalendar.css' />
    <script type='text/javascript' src='http://arshaw.com/js/fullcalendar-1.6.3/jquery/jquery-1.10.2.min.js'></script>
    <script type='text/javascript' src='http://arshaw.com/js/fullcalendar-1.6.3/jquery/jquery-ui-1.10.3.custom.min.js'></script>
    <script type='text/javascript' src='http://arshaw.com/js/fullcalendar-1.6.3/fullcalendar/fullcalendar.min.js'></script>
</head>
<body>



</body>
</html>
<?php
  require("../config/config.php");
  require("../lib/db.php");
  $conn = db_init($config["host"],$config["duser"],$config["dpw"], $config["dname"]);
  //$result = mysqli_query($conn, "SELECT * FROM menubar ORDER BY id ASC");
 ?>



<?php 

//어떤 조건으로 검색할지 결정한다.
$selectVersion = $_GET['selectVersion'];
//1이면 자신의 팀이 위치한 곳의 지역 팀을 우선 검색한다. [같은 시 까지 검색]
//2이면 같은시 같은 구 까지 검색
if(empty($selectVersion)){
$selectVersion = 1; //기본값 지역 팀 검색 
}


  if(empty($_SESSION['nickname'])){
            
            echo '<script>
            location.href = "../mainhtml.php";
            </script>';



          }
          else{ 

            $nickname = $_SESSION['nickname'];
            $result = mysqli_query($conn,"SELECT count(*)  FROM playerinfo WHERE emailid ='".$nickname."'");
            $row = mysqli_fetch_assoc($result);
 
            if($row['count(*)'] == 0){
              echo '<script>
            alert("등록된 팀이 없습니다.");
            location.href = "../enrollment/teamenrollmentToPlayer.php?page=1&list=10";
            </script>';
            }else if ($row['count(*)'] > 1){ //등록된 팀이 2개 이상인 경우 어떤 팀을 할 지 결정해 주어야  함.

            }
        }


//1이면 자신의 팀이 위치한 곳의 지역 팀을 우선 검색한다. [같은 시 까지 검색]
//2이면 같은시 같은 구 까지 검색
if($selectVersion == 1){
    $teamLocation = "SELECT location FROM teaminfo WHERE id in (SELECT teamid FROM teammember WHERE playerid in(SELECT id FROM playerinfo WHERE emailid = '".$_SESSION['nickname']."'))";
    $teamLocation = mysqli_query($conn, $teamLocation);
    $teamLocation = mysqli_fetch_assoc($teamLocation);

    $teamLocation =  $teamLocation['location'];
    $teamLocation = explode(" ", $teamLocation);
    //echo $teamLocation[0];
        

}

/*
while($row = mysqli_fetch_assoc($result)){
                //echo '<div class="col-md-3" id = "menubartext"><li><a href="/jobduo/index.php?id='.$row['id'].'">'.htmlspecialchars($row['title']).'</a></li></div>';

                $subresultcount = mysqli_query($conn, "SELECT count(*) FROM submenubar WHERE title = "."'".$row['title']."'");
                $subresultcount =  mysqli_fetch_assoc($subresultcount);
                //위 두줄은 서브 메뉴가 몇개인지 판단해서 드롭다운을 할 것인지 말 것인지를 판단한다.

                if($subresultcount['count(*)'] > 0){
*/



//날짜 받아오기
$s = $_GET['s'];

if(!$s){
    $s=date("Y-m-d");
}
// 오늘날짜를 구합니다. $s 에 넣습니다.


//function crd($s){ // 함수를 제작합니다. 함수내에서 변수 $s 는 "지정된 달" 입니다 

$x=explode("-",$s); // 들어온 날짜를 년,월,일로 분할해 변수로 저장합니다.
$s_Y=$x[0]; // 지정된 년도 
$s_m=$x[1]; // 지정된 월
$s_d=$x[2]; // 지정된 요일
 
$s_t=date("t",mktime(0,0,0,$s_m,$s_d,$s_Y)); // 지정된 달은 몇일까지 있을까요?
$s_n=date("N",mktime(0,0,0,$s_m,1,$s_Y)); // 지정된 달의 첫날은 무슨요일일까요?
$l=$s_n%7; // 지정된 달 1일 앞의 공백 숫자.
$ra=($s_t+$l)/7; $ra=ceil($ra); $ra=$ra-1; // 지정된 달은 총 몇주로 라인을 그어야 하나?
 
$n_d= date("Y-m-d",mktime(0,0,0,$s_m,$s_d+1,$s_Y)); // 다음날
$p_d= date("Y-m-d",mktime(0,0,0,$s_m,$s_d-1,$s_Y)); // 이전날
$n_m= date("Y-m-d",mktime(0,0,0,$s_m+1,$s_d,$s_Y)); // 다음달 (빠뜨린 부분 추가분이에요)
$p_m= date("Y-m-d",mktime(0,0,0,$s_m-1,$s_d,$s_Y)); // 이전달
$n_Y= date("Y-m-d",mktime(0,0,0,$s_m,$s_d,$s_Y+1)); // 내년
$p_Y= date("Y-m-d",mktime(0,0,0,$s_m,$s_d,$s_Y-1)); // 작년



// 변수 $s 에 새로운 값을 넣고 새문서를 만들면, $s 가 들어와 원하는 값을 표시해 줍니다.
echo ("
    <table align='center'>
        <tr align = 'center'>
<td  style = 'font-size: 20px;'><a href='playgroundattendiframecalendar.php?s=$p_Y&selectVersion='>" .($s_Y - 1). " 년</a> </td>
<td width=150 align=center  style = 'font-size: 20px;'><a href='playgroundattendiframecalendar.php?s=$p_m&selectVersion='>" .($s_m - 1). " 월</a></td>
<td width=300 align=center colspan=3  style = 'font-size: 35px;'>$s_Y 년 $s_m 월</td>
<td width=150  style = 'font-size: 20px;'> <a href='playgroundattendiframecalendar.php?s=$n_m&selectVersion='>".($s_m + 1)." 월</a></td>
<td width=150  style = 'font-size: 20px;'> <a href='playgroundattendiframecalendar.php?s=$n_Y&selectVersion='>".($s_Y + 1)." 년</a></td>
        </tr>
        <tr><td>&nbsp</td></tr>
        <tr align = 'center'>
           <td width=150><font color = 'red'><strong>일요일</strong></font></td>
           <td width=150><strong>월요일</strong></td>
           <td width=150><strong>화요일</strong></td>
           <td width=150><strong>수요일</strong></td>
           <td width=150><strong>목요일</strong></td>
           <td width=150><strong>금요일</strong></td>
           <td width=150><font color = 'blue'><strong>토요일</strong></font></td>
          
        </tr><tr><td>&nbsp</td></tr> 
        <tbody id= 't_body'> 
    ");


    //$leftTeamName = "select teamname from teaminfo where leader = '" . $teamReader . "'";
    //$leftTeamName = mysqli_query($conn,$leftTeamName);
    //$leftTeamName = mysqli_fetch_assoc($leftTeamName);
   

    for($r=0;$r<=$ra;$r++){
        echo "<tr>";
            for($z=1;$z<=7;$z++){
                $rv=7*$r+$z; $ru=$rv-$l; // 칸에 번호를 매겨줍니다. 1일이 되기전 공백들 부터 마이너스 값으로 채운 뒤 ~ 
                echo "<td width=150 height=100 align=left valign=top style = 'border: solid 1px silver; padding: 5px; cursor:pointer '>";

                if($ru<=0 || $ru>$s_t){ 
                echo "&nbsp;"; 
                } // 딱 그달에 맞는 숫자가 아님 표시하지 말자
                else{

                    
                    $s=date("Y-m-d",mktime(0,0,0,$s_m,$ru,$s_Y)); // 현재칸의 날짜

                    $queryDay = $s_Y ."-".$s_m . "-" . $ru;
                    //echo $s_Y ."-".$s_m . "-" . $ru ;
                    //DB에서 정보를 가져와서 뿌려준다.

                    $playDay = "select * from enrollmentmatchup where date = '" . $queryDay . "' && location like '" . $teamLocation[0] . "%'";
                    $playDay = mysqli_query($conn,$playDay);


                    if($z==1){ //일요일일때 색깔 붉은색
                         echo "<font color = 'red' >$ru. </font>"; // 날짜입니다.
                    }else if($z==7){
                        echo "<font color = 'blue'>$ru.</font>";
                    }else{
                         echo "$ru."; // 날짜입니다.
                    }


                    $temp = 0;
                    
                    while( $playD = mysqli_fetch_assoc($playDay)){
                        

                        if(!empty($playD['leftTeamName']) && !empty($playD['rightTeamName']) ){
                            
                            echo "<br><font color = 'green' >". $playD['leftTeamName'] . "</font> vs " . $playD['rightTeamName'];
                        
                        }
                        else if(!empty($playD['leftTeamName'])){
                            
                           

                            echo "<br><font color = 'green' >". $playD['leftTeamName'] . "</font>" ;
                        }
                    }
                    

                }
                echo "</td>";
            }
        echo "</tr>";
    }
    echo "</tbody></table>";

//}

?>


<?php 
$x1=explode("-",$s); // 들어온 날짜를 년,월,일로 분할해 변수로 저장합니다.
$Year=$x1[0]; // 지정된 년도 
$Month=$x1[1]-1; // 지정된 월



?>

<script type="text/javascript">
  var day;
  $("#t_body").click(function(e) {
   day  = ($(e.target).text());
});
</script>

<script type="text/javascript">

year = '<?php 
echo $Year; 
?>';
month = '<?php 
echo $Month; 
?>'; 

  window.onload = function() {
    var header = document.getElementById('t_body');
     
   

    // header 객체에 onclick 이벤트 속성을 연결
    header.onclick = function() {

   

//s_Y 년 $s_m 
      day = day.split('.');
      if(isNaN(day)){
      window.open('/jobduo/enrollment/caleandarpopup.php?day='+ day[0] + '&year=' + year + '&month=' + month  , '_blank', "width=570,height=700,toolbar=no");
      }
    }
  };
</script>
