<?php
  require("config/config.php");
  require("lib/db.php");
  $conn = db_init($config["host"],$config["duser"],$config["dpw"], $config["dname"]);
  $result = mysqli_query($conn, "SELECT * FROM menubar");
 ?>



 <!DOCTYPE html>
 <html lang="en">
   <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
     <meta name="description" content="">
     <meta name="author" content="">
     <link rel="icon" href="../../favicon.ico">

     <title>Match Up 로그인</title>

     <!-- Bootstrap core CSS -->
     <link href="/jobduo/bootstrap-3.3.2-dist/bootstrap-3.3.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./signinandup/sign.css" rel="stylesheet">
     <script src="http://bootstrapk.com/assets/js/ie-emulation-modes-warning.js"></script>

   </head>

   <body>

     <div class="container">

       <!--네이버 웹 로그인-->
       <script type="text/javascript" src="https://static.nid.naver.com/js/naverLogin_implicit-1.0.2.js" charset="utf-8"></script>
       <script type="text/javascript" src="https://static.nid.naver.com/js/naverLogin_implicit-1.0.2-min.js" charset="utf-8"></script>
       <!-- 네이버아이디로로그인 버튼 노출 영역 -->




       <form class="form-signin">
         <h2 class="form-signin-heading">회원가입</h2>
         <div id="naver_id_login"></div><!--네이버 로그인 버튼 위치-->




         <label for="inputEmail" class="sr-only">네이버로 로그인 하세요.</label>
         <input type="email" id="inputEmail" class="form-control" placeholder="네이버로 로그인 하세요." required autofocus>

         <label for="inputPassword" class="sr-only">MatchUp 비밀번호를 입력하세요.</label>
         <input type="password" id="inputPassword" class="form-control" placeholder="matchUp 비밀번호를 입력하세요." required>

         <label for="inputPasswordCheck" class="sr-only">비밀번호 확인</label>
         <input type="password" id="inputPasswordCheck" class="form-control" placeholder="비밀번호 확인." required>

         <label for="inputPasswordCheck" class="sr-only">비밀번호 확인</label>
         <input type="password" id="inputPasswordCheck" class="form-control" placeholder="비밀번호 확인." required>



         <div class="checkbox">

         </div>
         <button class="btn btn-lg btn-primary btn-block" type="submit">로그인</button>
       </form>

     </div> <!-- /container -->

     <!-- 네이버아이디로로그인 초기화 Script -->
     <script type="text/javascript">
      var naver_id_login = new naver_id_login("UiztzbRwFPc8MDTUTHhf", "http://192.168.105.208/jobduo/privacycheck.php");
      var state = naver_id_login.getUniqState();
      naver_id_login.setButton("white", 5,45);
      naver_id_login.setDomain(".service.com");
      naver_id_login.setState(state);
      naver_id_login.setPopup();
      naver_id_login.init_naver_id_login();
     </script>



     <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
     <script src="http://bootstrapk.com/assets/js/ie10-viewport-bug-workaround.js"></script>
   </body>
 </html>
