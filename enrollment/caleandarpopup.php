<?php
  require("../config/config.php");
  require("../lib/db.php");
  $conn = db_init($config["host"],$config["duser"],$config["dpw"], $config["dname"]);
  $result = mysqli_query($conn, "SELECT * FROM menubar ORDER BY id ASC");

  //id 로 정렬
 ?>


 <script type="text/javascript">

 function winMove(){
   window.moveTo((document.body.clientWidth)/3,(document.body.clientHeight)/3);

 }

 </script>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title></title>
   </head>
   <body  onload="winMove()">

    good!

   </body>
 </html>
