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

    <div class="container"> <!--100px 의 여백 고정된 사이즈로 만들어줌-->

     <article>




	<!--	 <form action="process.php" method="post">-->
			 <div class="form-group">
				 <label for="form-title">제목</label>
				 <input type = "text" class ="form-control" name = "title" id = "form-title" placeholder="제목을 입력해 주세요.">
          <!--text 대신 email 이 된다면 이메일 형태가 아닌 것은 서브밋이 안됨 [부트 스트랩 기능]-->
			</div>

					<div class="form-group">
	 				 <label for="form-author">작성자</label>
	 				 <input type = "text" class ="form-control" name = "author" id = "form-author" placeholder="작성자를 적어 주세요.">
	 				</div>

						<div class="form-group">
              <ul class="nav navbar-nav">
						    <li><label>본문</li>




              <!--이미지 서버에 전송 하기 로직-->
              <form  action="write.php" method="POST" enctype="multipart/form-data">
                 <input type="hidden" name="MAX_FILE_SIZE" value="90000" />
                 <!--파일이 너무 크면 안들어감 그냥 대충 크다 싶어도 안됨 그냥 작아야함-->
                 <li><input name="userfile" type="file" /></li>
                 <li><input type="submit" value="upload"/></li>

                 <?php
                if(empty($_POST['MAX_FILE_SIZE']) === false){ //자기 자신에게 회신할때 회신을 안한상태에서 오류를 막기위해서
                  ini_set("display_errors", "1");
                   $uploaddir = 'C:\Bitnami\wampstack-5.6.25-0\apache2\htdocs\jobduo\fileupload\file\\'; // \\2개를 하는 이유는 \의 기능을 제거하기 위해서  이상태로 냅둬라 URL
                    if(!is_dir($uploaddir)) { //폴더가 존재하지 않는다면 생성한다 따라서 폴더를 주키인 ID로 나누고 ID에 따라 DB에서 이미지를 가져올수 있도록한다
                      mkdir($uploaddir);      //또한 ID와 num 을 따로 구분해서 삭제시에도 ID는 변경이 없도록 한다.
                      }
                   $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
                  echo '<pre>';
                  if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) { //tmp_name = 임시저장위치
                     //move_uploaded_file 보안성이 띄어나다
                      // echo "파일이 유효하고, 성공적으로 업로드 되었습니다.\n";
                  } else {
                       print "파일 업로드 공격의 가능성이 있습니다!\n";
                  }

                }
                 ?>

              </form>










</label>
</ul>





					  	<textarea class="form-control" name="description" rows = "10" id = "form-author" placeholder="본문을 적어 주세요."></textarea>
						</div>

				<input type="submit" name="name" class = "btn btn-default btn-lg">
	<!--	 </form>-->
     </article>


     <hr><!--수평선 태그-->
</div>
         <!-- jQuery (부트스트랩의 자바스크립트 플러그인을 위해 필요합니다) -->
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
         <!-- 모든 컴파일된 플러그인을 포함합니다 (아래), 원하지 않는다면 필요한 각각의 파일을 포함하세요 -->
         <script src="http://192.168.105.208/jobduo/bootstrap-3.3.2-dist/bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>
       </body>
     </html>
