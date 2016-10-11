<?php
  require("./config/config.php");
  require("./lib/db.php");
  $conn = db_init($config["host"],$config["duser"],$config["dpw"], $config["dname"]);
  $result = mysqli_query($conn, "SELECT * FROM menubar ORDER BY id ASC");
  //id 로 정렬
 ?>

 <?php
 echo 
                //if(empty($_POST['MAX_FILE_SIZE']) === false){ //자기 자신에게 회신할때 회신을 안한상태에서 오류를 막기위해서
                  ini_set("display_errors", "1");
                   $uploaddir = 'C:\Bitnami\wampstack-5.6.25-0\apache2\htdocs\jobduo\fileupload\file\\'; // \\2개를 하는 이유는 \의 기능을 제거하기 위해서  이상태로 냅둬라 URL
                    if(!is_dir($uploaddir)) { //폴더가 존재하지 않는다면 생성한다 따라서 폴더를 주키인 ID로 나누고 ID에 따라 DB에서 이미지를 가져올수 있도록한다
                      mkdir($uploaddir);      //또한 ID와 num 을 따로 구분해서 삭제시에도 ID는 변경이 없도록 한다.
                      }
                   $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
                  //echo '<pre>';
                  if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) { //tmp_name = 임시저장위치
                     //move_uploaded_file 보안성이 띄어나다
                       echo "파일이 유효하고, 성공적으로 업로드 되었습니다.\n";
                  } else {
                       print "파일 업로드 공격의 가능성이 있습니다!\n";
                  }

                //}


                 ?>



                
