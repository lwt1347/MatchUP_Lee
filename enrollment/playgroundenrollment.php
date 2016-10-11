<?php
  require("../config/config.php");
  require("../lib/db.php");
  $conn = db_init($config["host"],$config["duser"],$config["dpw"], $config["dname"]);
  $result = mysqli_query($conn, "SELECT * FROM menubar ORDER BY id ASC");
 //경기장 등록 
  //id 로 정렬
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
                        document.write('<td class="cal_today" >'+i+'</td>');
                }
                else
                {
                        document.write('<td>'+i+'</td>');
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
      calendar();
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
      window.open('/jobduo/enrollment/caleandarpopup.php?day='+ day + '&year=' + year + '&month=' + month  , '_blank', "width=570,height=700,toolbar=no");
    }
  };
</script>


