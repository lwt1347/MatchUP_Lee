<?php
if(!empty($_GET['key']))
 {
 //세션 시작은 항상 가장위에서 실행되어야한다.
   session_start();
     $_SESSION['is_login'] = true;
     $_SESSION['nickname'] = $_GET['key'];
     header('Location: ./index.php'); //리 다이렉션 ./session.php 로 이동시킴
   exit;
 }

 ?>



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
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
   </head>

   <body>

     <div class="container">



       <form class="form-signin">
         <h2 class="form-signin-heading">Match Up!!!</h2>
         <div id="naver_id_login"></div><!--네이버 로그인 버튼 위치-->
          <button onclick="whatup()">whatup@naver.com 으로 로그인 하기 </button>


<!--

         <label for="inputEmail" class="sr-only">아이디를 입력하세요.</label>
         <input type="email" id="inputEmail" class="form-control" placeholder="아이디를 입력하세요." required autofocus>

         <label for="inputPassword" class="sr-only">비밀번호를 입력하세요.</label>
         <input type="password" id="inputPassword" class="form-control" placeholder="비밀번호를 입력하세요." required>
-->



<!--
         <div class="checkbox">

         </div>
         <button class="btn btn-lg btn-primary btn-block" type="submit">로그인</button>
         -->
       </form>

     </div> <!-- /container -->


     <!--네이버 웹 로그인-->
     <script type="text/javascript" src="https://static.nid.naver.com/js/naverLogin_implicit-1.0.2.js" charset="utf-8"></script>
     <script type="text/javascript" src="https://static.nid.naver.com/js/naverLogin_implicit-1.0.2-min.js" charset="utf-8"></script>
     <!-- 네이버아이디로로그인 버튼 노출 영역 -->



     <!-- 네이버아이디로로그인 초기화 Script -->
     <script type="text/javascript">
      var naver_id_login = new naver_id_login("UiztzbRwFPc8MDTUTHhf", "http://192.168.105.208/jobduo/login.php");
      var state = naver_id_login.getUniqState();
      naver_id_login.setButton("white", 5,45);
      naver_id_login.setDomain(".service.com");
      naver_id_login.setState(state);
      //naver_id_login.setPopup();
      naver_id_login.init_naver_id_login();
     </script>



     <!-- 네이버아디디로로그인 Callback페이지 처리 Script -->
     <script type="text/javascript">
     	// 네이버 사용자 프로필 조회 이후 프로필 정보를 처리할 callback function
      var email;
     	function naverSignInCallback() {
     		// naver_id_login.getProfileData('프로필항목명');
     		// 프로필 항목은 개발가이드를 참고하시기 바랍니다.
        email = naver_id_login.getProfileData('email');
     		//alert(naver_id_login.getProfileData('email'));
     		//alert(naver_id_login.getProfileData('nickname'));
     		//alert(naver_id_login.getProfileData('age'));



            var method =  "get";
            var form = document.createElement("form");
            form.setAttribute("method", "method");
            form.setAttribute("action", "login.php");

                var hiddenField = document.createElement("input");
                hiddenField.setAttribute("type", "hidden");
                hiddenField.setAttribute("name", "key");
                hiddenField.setAttribute("value", email);
                form.appendChild(hiddenField);

            document.body.appendChild(form);
            form.submit();

     	}

     	// 네이버 사용자 프로필 조회
     	naver_id_login.get_naver_userprofile("naverSignInCallback()");
     </script>
     <!-- //네이버아디디로로그인 Callback페이지 처리 Script -->


<!--네이버 로그인 함수를 통해 로그인을 인증받으면 그 값을 받아온다.-->





<script type="text/javascript">
            function whatup(){
              
               document.write('<?php 
               {
               //세션 시작은 항상 가장위에서 실행되어야한다.
                 session_start();
                   $_SESSION["is_login"] = true;
                   $_SESSION["nickname"] = "whatup@naver.com";
                   header("Location: ./index.php");
                 exit;
               } ?>');
               



            }
          </script>







     <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
     <script src="http://bootstrapk.com/assets/js/ie10-viewport-bug-workaround.js"></script>
   </body>
 </html>
