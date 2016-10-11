<?php
  require("config/config.php");
  require("lib/db.php");
  $conn = db_init($config["host"],$config["duser"],$config["dpw"], $config["dname"]);
  $result = mysqli_query($conn, "SELECT * FROM menubar ORDER BY id ASC");

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
    <link rel="stylesheet" type = "text/css" href="./style.css">
  </head>



  <body>
    <?php
     require("mainhtml.php");
     ?>



<?php

     if(empty($_SESSION['nickname'])){
            
            echo '<script>
            alert("로그인 후 에 사용 가능 합니다.");
            history.back();
            </script>';
          }
          else{ 

            $nickname = $_SESSION['nickname'];
            $result = mysqli_query($conn,"SELECT name  FROM playerinfo WHERE emailid ='".$nickname."'");

            $row = mysqli_fetch_assoc($result);
            if(empty($row['name'])){
              echo '<script>
              alert("선수 등록 후 사용 가능 합니다.");
              history.back();
              </script>';
            }

          }
     ?>




    <div class="container"> <!--100px 의 여백 고정된 사이즈로 만들어줌-->

     <article>



<form  action="writeInsert.php" method="POST" enctype="multipart/form-data">
	<!--	 <form action="process.php" method="post">-->
			 <div class="form-group">
				 <label for="form-title">제목</label>
				 <input type = "text" class ="form-control" name = "title" id = "form-title" placeholder="제목을 입력해 주세요.">
          <!--text 대신 email 이 된다면 이메일 형태가 아닌 것은 서브밋이 안됨 [부트 스트랩 기능]-->
			</div>

					<div class="form-group">
	 				 <label for="form-author">작성자 

           </label>



	 				 <input type = "text" class ="form-control" name = "author" id = "form-author" value="<?php echo $row['name']; ?>  " readonly>
	 				</div>



						<div class="form-group">
              <ul class="nav navbar-nav">


						    <li><label>본문</li>





              <!--이미지 서버에 전송 하기 로직-->
              <!--
                 <input type="hidden" name="inImage" value="300000" />
                 <!-파일이 너무 크면 안들어감 그냥 대충 크다 싶어도 안됨 그냥 작아야함->

                <script type='text/javascript'>
                function pictureName(){
                  //그림 이름값 알아오기 위한 함수
                  //document.getElementById('user').innerHTML =  document.getElementById('userfile').value;
                  var imageName = document.getElementById('inImage');
                  imageName.value = document.getElementById('userfile').value;

                }
                </script>

                 <li><input id = "userfile" name="userfile" type="file" /></li>

                 <li><input type="button" value="upload"/></li> <!-userfile을 제이퀄을 통해 이 부분을 ImageSend.php 로 전송을 해야 한다.->
-->


<!--제이쿼리로 시발 이미지 전송 어떻게 하는데 씨발아 족같네 -->
<!--제이쿼리로 시발 이미지 전송 어떻게 하는데 씨발아 족같네 -->
<!--제이쿼리로 시발 이미지 전송 어떻게 하는데 씨발아 족같네 -->
<!--제이쿼리로 시발 이미지 전송 어떻게 하는데 씨발아 족같네 -->
<!--제이쿼리로 시발 이미지 전송 어떻게 하는데 씨발아 족같네 -->
<!--제이쿼리로 시발 이미지 전송 어떻게 하는데 씨발아 족같네 -->
<!--제이쿼리로 시발 이미지 전송 어떻게 하는데 씨발아 족같네 -->








</label>
</ul>





					  	<textarea class="form-control" name="mainText" rows = "10" id = "form-author" placeholder="본문을 적어 주세요."></textarea>
						</div>

          <div class="form-group">
         <label for="form-title">작성일: &nbsp 
         
              <script type='text/javascript'>
              var d = new Date();
              document.write(d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate());
              </script>
        </div>
</label>
				<input type="submit" name="name" class = "btn btn-default btn-lg">
		 </form>
     </article>



<!--제이쿼리로 시발 이미지 전송 어떻게 하는데 씨발아 족같네 -->
<!--제이쿼리로 시발 이미지 전송 어떻게 하는데 씨발아 족같네 -->
<!--제이쿼리로 시발 이미지 전송 어떻게 하는데 씨발아 족같네 -->
<!--제이쿼리로 시발 이미지 전송 어떻게 하는데 씨발아 족같네 -->
<!--제이쿼리로 시발 이미지 전송 어떻게 하는데 씨발아 족같네 -->
<!--제이쿼리로 시발 이미지 전송 어떻게 하는데 씨발아 족같네 -->

<script type="text/javascript">
    document.querySelectorAll('input')[4].addEventListener('click', function(event){
      //alert("aa");
            var xhr = new XMLHttpRequest();

            xhr.open('POST', './ImageSend.php');

            xhr.onreadystatechange = function(){ //서버로부터 받아온 값을 뿌림
                
                alert(xhr.responseText); 


            }

            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            var data = ''; //서버로 보낼 데이터
            data += '&format='+ document.getElementById("userfile").value;
            xhr.send(data); 
            alert(data);
            
        });


</script>




     <hr><!--수평선 태그-->
</div>
         <!-- jQuery (부트스트랩의 자바스크립트 플러그인을 위해 필요합니다) -->
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
         <!-- 모든 컴파일된 플러그인을 포함합니다 (아래), 원하지 않는다면 필요한 각각의 파일을 포함하세요 -->
         <script src="http://192.168.105.208/jobduo/bootstrap-3.3.2-dist/bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>
       </body>
     </html>
