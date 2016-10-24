<?php
  require("../config/config.php");
  require("../lib/db.php");
  $conn = db_init($config["host"],$config["duser"],$config["dpw"], $config["dname"]);
  $result = mysqli_query($conn, "SELECT * FROM menubar ORDER BY id ASC");
 //경기장 등록 
  //id 로 정렬
  //$playDay = "select * from enrollmentmatchup";
  //$playDay = mysqli_query($conn,$playDay);
  //$playDay = mysqli_fetch_assoc($playDay);



 ?>





<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 위 3개의 메타 태그는 *반드시* head 태그의 처음에 와야합니다; 어떤 다른 콘텐츠들은 반드시 이 태그들 *다음에* 와야 합니다 -->
    <title>당신의 즐거운 운동 생활! Match Up!</title>

    <!-- 부트스트랩 -->
    <link href="/jobduo/bootstrap-3.3.2-dist/bootstrap-3.3.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type = "text/css" href="../style.css">

    <link rel='stylesheet' type='text/css' href='http://arshaw.com/js/fullcalendar-1.6.3/fullcalendar/fullcalendar.css' />
    <script type='text/javascript' src='http://arshaw.com/js/fullcalendar-1.6.3/jquery/jquery-1.10.2.min.js'></script>
    <script type='text/javascript' src='http://arshaw.com/js/fullcalendar-1.6.3/jquery/jquery-ui-1.10.3.custom.min.js'></script>
    <script type='text/javascript' src='http://arshaw.com/js/fullcalendar-1.6.3/fullcalendar/fullcalendar.min.js'></script>








    <script type='text/javascript'>
    	$(document).ready(function() {

    		var date = new Date();
    		var d = date.getDate();
    		var m = date.getMonth();
    		var y = date.getFullYear();

    		$('#calendar').fullCalendar({
    			header : {
    				left : 'prev,next today',
    				center : 'title',
    				right : 'month,agendaWeek,agendaDay'
    			},
          selectable: true,
    			selectHelper: true,
    			select: function(start, end) {

            //입력창 html 하나 더 띄어서 그날 정보 다 띄어줘야함
    			//	var title = prompt('Event Title:');



          window.open('/jobduo/enrollment/caleandarpopup.php', '_blank', "width=570,height=700,toolbar=no");
          //문서 주소, 이름, 크기

          //캘린더에서 날짜를 클릭하면 팝업 올린다.
    				var eventData;
    				/*if (title) {
    					eventData = {
    						title: title,
    						start: start,
    						end: end
    					};
    					//$('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
    				}*/
    				//$('#calendar').fullCalendar('unselect');
    			},
    			editable: true,
    			eventLimit: true

    		});

    	});
    </script>

  </head>



  <body>




    <?php
     require("../mainhtml.php");
$s = $_GET['s'];

if(!$s){
    $s=date("Y-m-d");
}
    //crd($s);
?>

  <div class="container"> <!--100px 의 여백 고정된 사이즈로 만들어줌-->
<article>
      <nav class="MainText">




      </nav>
    </div>



    <!--<div id='calendar'></div>-->

</article>
</div>





    <!-- jQuery (부트스트랩의 자바스크립트 플러그인을 위해 필요합니다) -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->
    <!-- 모든 컴파일된 플러그인을 포함합니다 (아래), 원하지 않는다면 필요한 각각의 파일을 포함하세요 -->
    <script src="http://192.168.105.208/jobduo/bootstrap-3.3.2-dist/bootstrap-3.3.2-dist/js/bootstrap.min.js"></script> 






  </body>
</html>


<?php

     if(empty($_SESSION['nickname'])){
            
            echo '<script>
            alert("로그인 후 에 사용 가능 합니다.");
            history.back();
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
              echo '<script>
            alert("등록한 팀이 없거나 팀의 리더가 아닙니다.");
            history.back();
            </script>';
            }


            $Nick = $_SESSION['nickname'];
            $result = mysqli_query($conn,"SELECT count(*)  FROM playerinfo WHERE emailid ='".$Nick."'");
            $row = mysqli_fetch_assoc($result);

            if($row['count(*)'] == 0){
            echo '<script>
            alert("선수 등록을 먼저 하세요.");
            history.back();
            </script>';
            }


          }
     ?>


<script type="text/javascript">
var month;
var year;
function setStyle(id,style,value)
{
    id.style[style] = value;
}
function opacity(el,opacity)
{
        setStyle(el,"filter:","alpha(opacity="+opacity+")");
        setStyle(el,"-moz-opacity",opacity/100);
        setStyle(el,"-khtml-opacity",opacity/100);
        setStyle(el,"opacity",opacity/100);
}
function calendar()
{
        var date = new Date();
        var day = date.getDate();
        month = date.getMonth();
        year = date.getYear();

        

        if(year<=200)
        {
                year += 1900;
        }
        months = new Array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12');
        days_in_month = new Array(31,28,31,30,31,30,31,31,30,31,30,31);
        if(year%4 == 0 && year!=1900)
        {
                days_in_month[1]=29;
        }
        total = days_in_month[month];
        var date_today = year+'년'+months[month]+'월 '+day+'일';
        var yearMonth = year+'-'+months[month]+'-';
        beg_j = date;
        beg_j.setDate(1);
        if(beg_j.getDate()==2)
        {
                beg_j=setDate(0);
        }
        beg_j = beg_j.getDay();
        document.write('<table class="cal_calendar" onload="opacity(document.getElementById(\'cal_body\'),20);"><tbody id="cal_body"><tr><th colspan="7">'+date_today+'</th></tr>');
        document.write('<tr class="cal_d_weeks"><th>일</th><th>월</th><th>화</th><th>수</th><th>목</th><th>금</th><th>토</th></tr><tr>');
        week = 0;
        for(i=1;i<=beg_j;i++)
        {
                document.write('<td class="cal_days_bef_aft" >'+'</td>');
                week++;
        }

        

        for(i=1;i<=total;i++)
        {
                if(week==0)
                {
                        document.write('<tr>');
                }
                if(day==i)
                {
                       
                        document.write('<?php 
                        //php가 먼저 실행되기 때문에 이거는 안됨

                        $k =  "' + yearMonth + i +  '";

                        //echo "\"' + yearMonth + i +  '\""; 
                        //echo $k;

                        //$k = "2016-10-15";
                        echo $k;
                        if($k == '2016-10-15'){
                          echo "a";
                        }

                        while($Temp = mysqli_fetch_assoc($playDay)){
                          if($Temp["date"] == $k){

                            echo $Temp["date"] . "@@";
                          }

                         }
                        
                        

                        ?>');

                        document.write('<td class="cal_today" >'+i+'.<br> aaa </td>');
                       
                       
                }
                else
                {
                        document.write('<td>'+i+'.<br></td>');
                }
                week++;
                if(week==7)
                {
                        document.write('</tr>');
                        week=0;
                }
        }

        for(i=1;week!=0;i++)
        {
                document.write('<td class="cal_days_bef_aft">'+'</td>');
                week++;
                if(week==7)
                {
                        document.write('</tr>');
                        week=0;
                }
        }
        document.write('</tbody></table>');
        opacity(document.getElementById('cal_body'),70);
        return true;
}
</script>

<style>
table.cal_calendar{padding:0px;margin:0 auto; width: 60%;}
table.cal_calendar th{border:1px solid #c0c0c0;background-color:#e0e0e0;width:36px;font-family:돋움;font-size:15px;padding:3px;}
table.cal_calendar td{border:1px solid #e0e0e0;background-color:#ffffff;text-align:left;width:20px;height:25px;font-family:tahoma;font-size:11px;padding:3px; height: 100px;}

.cal_today{color:#ff0000;font-weight:bold;}
.cal_days_bef_aft{color:#5a779e;}
</style>


 <script type="text/javascript">
     // calendar();
    </script>

<script type="text/javascript">
  var day;
  $("#cal_body").click(function(e) {
   day  = ($(e.target).text());
});
</script>

<script type="text/javascript">
  window.onload = function() {
    var header = document.getElementById('cal_body');
     

    // header 객체에 onclick 이벤트 속성을 연결
    header.onclick = function() {

      day = day.split('.');

      window.open('/jobduo/enrollment/caleandarpopup.php?day='+ day[0] + '&year=' + year + '&month=' + month  , '_blank', "width=570,height=700,toolbar=no");
    }
  };
</script>



<?php 
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
<td  style = 'font-size: 20px;'><a href='playgroundEnrollment.php?s=$p_Y'>" .($s_Y - 1). " 년</a> </td>
<td width=150 align=center  style = 'font-size: 20px;'><a href='playgroundEnrollment.php?s=$p_m'>" .($s_m - 1). " 월</a></td>
<td width=300 align=center colspan=3  style = 'font-size: 35px;'>$s_Y 년 $s_m 월</td>
<td width=150  style = 'font-size: 20px;'> <a href='playgroundEnrollment.php?s=$n_m'>".($s_m + 1)." 월</a></td>
<td width=150  style = 'font-size: 20px;'> <a href='playgroundEnrollment.php?s=$n_Y'>".($s_Y + 1)." 년</a></td>
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


    $leftTeamName = "select teamname from teaminfo where leader = '" . $teamReader . "'";
    $leftTeamName = mysqli_query($conn,$leftTeamName);
    $leftTeamName = mysqli_fetch_assoc($leftTeamName);
   

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

                    $playDay = "select * from enrollmentmatchup where date = '" . $queryDay . "' && leftTeamName = '" . $leftTeamName['teamname'] . "'";
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
                            if($temp == 0){
                                echo "<font color = 'red' > 매칭 완료</font>";
                                $temp = 1;
                            }
                            echo "<br><font color = 'green' >". $playD['leftTeamName'] . "</font> vs " . $playD['rightTeamName'];
                        
                        }
                        else if(!empty($playD['leftTeamName'])){
                            if($temp == 0){
                                echo " 경기 매칭중...";
                                 $temp = 1;
                        }
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


<?php
require("../lasthtml.php");
 ?>
