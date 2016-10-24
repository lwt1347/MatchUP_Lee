<?php
  require("../config/config.php");
  require("../lib/db.php");
  $conn = db_init($config["host"],$config["duser"],$config["dpw"], $config["dname"]);
  $result = mysqli_query($conn, "SELECT * FROM menubar ORDER BY id ASC");
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







  </head>



  <body>




    <?php
     require("../mainhtml.php");

    //crd($s);
?>

  <div class="container"> <!--100px 의 여백 고정된 사이즈로 만들어줌-->
<article>
      <nav class="MainText">


<!--i 프레임을 통해 버튼으로 조작을 한다-->
<iframe src="./playgroundattendiframecalendar.php?s=&selectVersion=" frameborder="0" width="100%" height="750px" id = "main_I_Frame"></iframe>



<button type="button" class="btn btn-primary" onclick = "changeIf('./playgroundattendiframecalendar.php?s=&selectVersion=1')">주변 경기장 검색</button>



      </nav>
    </div>



    <!--<div id='calendar'></div>-->

</article>
</div>





    <!-- jQuery (부트스트랩의 자바스크립트 플러그인을 위해 필요합니다) -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->
    <!-- 모든 컴파일된 플러그인을 포함합니다 (아래), 원하지 않는다면 필요한 각각의 파일을 포함하세요 -->
    <script src="http://192.168.105.208/jobduo/bootstrap-3.3.2-dist/bootstrap-3.3.2-dist/js/bootstrap.min.js"></script> 


    <!--i프레임 변 경하기-->
<script type="text/javascript">
  
  function changeIf(url){
    //alert("aaa");
    document.getElementById("main_I_Frame").src = url;
  }

</script>




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



<?php
require("../lasthtml.php");
 ?>



  </body>
</html>
