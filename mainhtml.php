<?php
//새션 시작은 항상 최상위에 있어야한다.
session_start();
?>

    <div align="center">
    <img src="http://192.168.105.208/jobduo/image/mainimage.png" alt=""  class="img-square" id = "logo" height="100%" />
    <h1><a href="http://192.168.105.208/jobduo">Match Up</a></h1>
    </div>

    <div class="container"> <!--100px 의 여백 고정된 사이즈로 만들어줌-->
      <header class = "" >




        <div class = "row" align="right">
          <div class = "col-md-11"></div>
           

            <?php
          if(!empty($_SESSION['nickname'])){
            echo $_SESSION['nickname'];
            echo '<a href="http://192.168.105.208/jobduo/logout.php">로그아웃</a></br>';
            //echo '<a href="http://192.168.105.208/jobduo/teamInfo/teamInforouter.php"> 내 팀 정보</a>';
            echo '<a onclick="move();"> 내 팀 정보</a>';
            echo '<script>
            function move(){
            window.open("http://192.168.105.208/jobduo/teamInfo/teamInfo.php", "하하호호", "width=400, height=650 menubar=no, status=no,toolbar=no,scrollbars=no");
            }
            </script>';



            //echo '<a href="http://192.168.105.208/jobduo/teamInfo/teamInfo.php"> 내 팀 정보</a>';
            
          }else{
            echo ' <div class = "col-md-1"><a href="http://192.168.105.208/jobduo/login.php"><h6>로그인</h6></a></div>';
          }
            ?>


            <!--<div class = "col-md-1"><a href="http://192.168.105.208/jobduo/signup.php"><h6>회원가입</h6></a></div>-->
        </div>

      </header>



<script src="http://code.jquery.com/jquery-latest.js"></script>

<!--드롭다운 제이쿼리-->
<script type="text/javascript">

$(document).ready(function(){  
   
  $(".dropdown-category").hover(function() {                    //마우스를 topnav에 오버시
   $(this).parent().find(".dropdown-menu").slideDown('normal').show();                   //subnav가 내려옴.
   $(this).parent().hover(function() {  
   }, function(){  
    $(this).parent().find(".dropdown-menu").slideUp('fast');                 //subnav에서 마우스 벗어났을 시 원위치시킴  
   });  
  });  
   
 });  
var jq142 = jQuery.noConflict(); //달력 을 불러오는 페이지의 경우 제이쿼리의 다른 버전을 가져 오기 때문에 제이ㅇ쿼리 충돌이 발생한다 따라서 이 부분을 통해서 제이쿼리 충돌을 방지한다.
</script>




<nav class = "Menu"> <!--메뉴 설정-->

  <div class="collapse-navbar-collapse">
    <ul class="nav navbar-nav ">
            <?php



              while($row = mysqli_fetch_assoc($result)){
                //echo '<div class="col-md-3" id = "menubartext"><li><a href="/jobduo/index.php?id='.$row['id'].'">'.htmlspecialchars($row['title']).'</a></li></div>';

                $subresultcount = mysqli_query($conn, "SELECT count(*) FROM submenubar WHERE title = "."'".$row['title']."'");
                $subresultcount =  mysqli_fetch_assoc($subresultcount);
                //위 두줄은 서브 메뉴가 몇개인지 판단해서 드롭다운을 할 것인지 말 것인지를 판단한다.

                if($subresultcount['count(*)'] > 0){

//                  echo '<li class="dropdown"><a href="#" class="dropdown-category" id="navbar-page" data-toggle="dropdown">'
//                  .htmlspecialchars($row['title']).'<i class="caret"></i></a>';

                 // echo '<li class="dropdown"><a href="#" class="dropdown-category" id="navbar-page" data-toggle="dropdown">'
                 // .htmlspecialchars($row['title']).'<i class="caret"></i></a>';
                   echo '<li class="dropdown" style = "background-color: #3478af;  padding-left: 25px;padding-right: 25px; " >
                   
                   <a href="#" class="dropdown-category" id="menubarBackCss" data-toggle="dropdown">'

                  .htmlspecialchars($row['title']).'<i class="caret"></i></a>';


                  //메뉴 바 드롭다운
                  echo '<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownCategoryMenu">';
                  $subresult = mysqli_query($conn, "SELECT * FROM submenubar");
                  while($subrow = mysqli_fetch_assoc($subresult)){
                   if($row['title'] == $subrow['title']){
                      echo '<li><a href="/jobduo/index.php?id='.$subrow['id'].'&title='.$subrow['title'].' ">'.$subrow['event'].'</a></li>';
                    }
                  }
                  echo '</ul></li>';
                }else{ //드롭바 없는 메뉴 클릭시
                  echo '<li style = "background-color: #3478af"><a href="/jobduo/index.php?id='.$row['id'].'&title='.$row['title'].'" class="dropdown-category" id = "menubarBackCss" >'
                  .htmlspecialchars($row['title']).'</a></li>';
                }



              }
              ?>
            </ul>
          </div>
       </nav>





      <hr>
      <br>

<article>
      <nav class="MainText">
        <?php
        //1 = 자유 게시판
        if(empty($_GET['id']) === false && ($_GET['title']) == '자유 게시판'){
            echo("<script>location.replace('/jobduo/freenoticeboard.php?page=1&list=10');</script>");
        }
        //축구
        if(empty($_GET['id']) === false && ($_GET['id']) == 1 && ($_GET['title']) == '경기 일정'){
            //echo $_GET['title'].$_GET['id'];
        }
        //야구
        if(empty($_GET['id']) === false && ($_GET['id']) == 2 && ($_GET['title']) == '경기 일정'){
            //echo $_GET['title'].$_GET['id'];
        }//농구
        if(empty($_GET['id']) === false && ($_GET['id']) == 3 && ($_GET['title']) == '경기 일정'){

        }


        //선수 등록
        if(empty($_GET['id']) === false && ($_GET['id']) == 3 && ($_GET['title']) == '선수[팀] 등록'){
            echo("<script>location.replace('/jobduo/enrollment/playerenrollment.php');</script>");
        }
        //팀 등록 신청
        if(empty($_GET['id']) === false && ($_GET['id']) == 2 && ($_GET['title']) == '선수[팀] 등록'){
           echo("<script>location.replace('/jobduo/enrollment/teamenrollmentToPlayer.php?page=1&list=10');</script>");
        }
        //팀 등록
        if(empty($_GET['id']) === false && ($_GET['id']) == 1 && ($_GET['title']) == '선수[팀] 등록'){
            echo("<script>location.replace('/jobduo/enrollment/teamenrollment.php');</script>");
        }

        //경기장 참가
        if(empty($_GET['id']) === false && ($_GET['id']) == 3 && ($_GET['title']) == '게임 등록'){

            //echo("<script>location.replace('/jobduo/enrollment/playgroundattend.php');</script>");
        }
        //경기장 등록
        if(empty($_GET['id']) === false && ($_GET['id']) == 2 && ($_GET['title']) == '게임 등록'){
            echo("<script>location.replace('/jobduo/enrollment/playgroundEnrollment.php');</script>");
        }
        
        //빈 경기장 등록
        if(empty($_GET['id']) === false && ($_GET['id']) == 1 && ($_GET['title']) == '게임 등록'){

        }
        

        ?>




      </nav>

</article>
</div>
