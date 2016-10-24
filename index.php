

<?php
  require("config/config.php");
  require("lib/db.php");
  $conn = db_init($config["host"],$config["duser"],$config["dpw"], $config["dname"]);
  $result = mysqli_query($conn, "SELECT * FROM menubar ORDER BY id ASC");

  //id 로 정렬


 ?>

<!DOCTYPE html>
<html>
  <head>
    <?php
    require("mainheadhtml.php");
     ?>

  </head>
  <body>

 <?php
 require("mainhtml.php");
  ?>

<div align="center">

<table>
<tr><td colspan="2">
<a href = "/jobduo/freenoticeboard.php?page=1&list=10">
<img src="http://192.168.105.208/jobduo/image/freenoticeborder_before.png"  onmouseover="this.src = 'http://192.168.105.208/jobduo/image/freenoticeborder_after.png'" 
onmouseout="this.src = 'http://192.168.105.208/jobduo/image/freenoticeborder_before.png'" alt=""  class="img-square" id = "" weight= "100%"  />
</td></tr>
<tr><td>&nbsp</td></tr>
<tr><td rowspan="2">
<a href = "/jobduo/enrollment/playerenrollment.php">
<img src="http://192.168.105.208/jobduo/image/playerenrollment_before.png"  onmouseover="this.src = 'http://192.168.105.208/jobduo/image/playerenrollment_after.png'" 
onmouseout="this.src = 'http://192.168.105.208/jobduo/image/playerenrollment_before.png'" alt=""  class="img-square" id = "" weight= "100%"  />
</td>
<td>
<a href = "http://192.168.105.208/jobduo/enrollment/teamenrollment.php">
<img src="http://192.168.105.208/jobduo/image/teamenrollmenttoplayer_before.png"  onmouseover="this.src = 'http://192.168.105.208/jobduo/image/teamenrollmenttoplayer_after.png'" 
onmouseout="this.src = 'http://192.168.105.208/jobduo/image/teamenrollmenttoplayer_before.png'" alt=""  class="img-square" id = "" weight= "100%"  />
</td>
</tr>
<tr>
  <td>
<a href = "http://192.168.105.208/jobduo/enrollment/teamenrollmentToPlayer.php?page=1&list=10">
<img src="http://192.168.105.208/jobduo/image/teamenrollment_before.png"  onmouseover="this.src = 'http://192.168.105.208/jobduo/image/teamenrollment_after.png'" 
onmouseout="this.src = 'http://192.168.105.208/jobduo/image/teamenrollment_before.png'" alt=""  class="img-square" id = "" weight= "100%"  />
</td>
</tr>

<tr>
  <td colspan="2">
<a href = "">
<img src="http://192.168.105.208/jobduo/image/allmatchview_before.png"  onmouseover="this.src = 'http://192.168.105.208/jobduo/image/allmatchview_after.png'" 
onmouseout="this.src = 'http://192.168.105.208/jobduo/image/allmatchview_before.png'" alt=""  class="img-square" id = "" weight= "100%"  />
</td>
</tr>
<tr><td>&nbsp</td></tr>
</table>

<table>
  
  <tr>
<td>
<a href = "http://192.168.105.208/jobduo/enrollment/playgroundEnrollment.php?s=">
<img src="http://192.168.105.208/jobduo/image/playgroundenrollment_before.png"  onmouseover="this.src = 'http://192.168.105.208/jobduo/image/playgroundenrollment_after.png'" 
onmouseout="this.src = 'http://192.168.105.208/jobduo/image/playgroundenrollment_before.png'" alt=""  class="img-square" id = "" weight= "100%"  />
</td>
<td>
<a href = "">
<img src="http://192.168.105.208/jobduo/image/matchup_before.png"  onmouseover="this.src = 'http://192.168.105.208/jobduo/image/matchup_after.png'" 
onmouseout="this.src = 'http://192.168.105.208/jobduo/image/matchup_before.png'" alt=""  class="img-square" id = "" weight= "100%"  />
</td>

</tr>


</table>

</div></a>













  <!-- jQuery (부트스트랩의 자바스크립트 플러그인을 위해 필요합니다) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <!-- 모든 컴파일된 플러그인을 포함합니다 (아래), 원하지 않는다면 필요한 각각의 파일을 포함하세요 -->
  <script src="http://192.168.105.208/jobduo/bootstrap-3.3.2-dist/bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>




  </body>
</html>
 <?php
    require("lasthtml.php");
?>
