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




          window.open('/jobduo/enrollment/caleandarpopup.php', '_blank', "width=700,height=500,toolbar=no");
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



    <div id='calendar'></div>

</article>
</div>



    <!-- jQuery (부트스트랩의 자바스크립트 플러그인을 위해 필요합니다) -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->
    <!-- 모든 컴파일된 플러그인을 포함합니다 (아래), 원하지 않는다면 필요한 각각의 파일을 포함하세요 -->
    <script src="http://192.168.105.208/jobduo/bootstrap-3.3.2-dist/bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>
  </body>
</html>
