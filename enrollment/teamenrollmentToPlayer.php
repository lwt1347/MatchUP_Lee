<?php
  require("../config/config.php");
  require("../lib/db.php");
  $conn = db_init($config["host"],$config["duser"],$config["dpw"], $config["dname"]);
  $result = mysqli_query($conn, "SELECT * FROM menubar ORDER BY id ASC");

  //id 로 정렬
 ?>

<!DOCTYPE html>
<html>
  <head>

    <link rel="stylesheet" type = "text/css" href="../style.css">
    <?php
    require("../mainheadhtml.php");

     ?>

  </head>
  <body>

 <?php
 require("../mainhtml.php");
  ?>

<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">
<table class="table">
<caption>등록된 팀</caption>
<thead>
  <tr>
    <div class="row">
    </div>
  </tr>
</thead>
<tbody>
<?php






    $pageNum = ($_GET['page']) ? $_GET['page'] : 1;     //page : default - 1
    $list = ($_GET['list']) ? $_GET['list'] : 10; //page : default - 50


    $b_pageNum_list = $list; //블럭에 나타낼 페이지 번호 갯수
    $block = ceil($pageNum/$b_pageNum_list); //현재 리스트의 블럭 구하기


    $b_start_page = ( ($block - 1) * $b_pageNum_list ) + 1; //현재 블럭에서 시작페이지 번호
    $b_end_page = $b_start_page + $b_pageNum_list - 1; //현재 블럭에서 마지막 페이지 번호

    $buyTotalCount = mysqli_query($conn, "SELECT count(*) FROM teaminfo ");
    $buyTotalCount =  mysqli_fetch_assoc($buyTotalCount);
    $buyTotalCount = $buyTotalCount['count(*)'];

    $total_page =  ceil($buyTotalCount/$list); //총 페이지 수

    if ($b_end_page > $total_page){
        $b_end_page = $total_page;
      }

//DB에서 정보를 가져와 테이블 형성하는곳
//자유 게시판 DB에서 가져오기
//if($pageNum == 1){
// $startDB = 0;
// $endDB = $list+1;

 $startDB = $buyTotalCount - (($pageNum-1) * 10);     //14;
 $endDB = $startDB - 10;       //3;
 // echo $buyTotalCount . " " . $pageNum . " " . $startDB ." " . $endDB;

//}else {
 // $startDB = $pageNum*$list-$list;
  //$endDB = $pageNum*$list+1;
//}


//id 는 1번 부터가 아니기 때문에 num 을 넣어서 1번 부터 만들어 주어야 한다.
  $dbtableinfo = mysqli_query($conn, "SELECT num,teamname,logoimage FROM teaminfo WHERE num <= $startDB and num > $endDB ORDER BY num DESC");
  $i = 0;
        while($row = mysqli_fetch_assoc($dbtableinfo)){
     
          if($i % 4 == 0){
          	echo '<tr>';    
          }

          //echo '<div class="col-md-3" id = "menubartext"><li><a href="/jobduo/index.php?id='.$row['id'].'">'.htmlspecialchars($row['title']).'</a></li></div>';
          echo '
              <td>
              <img src="'.$row['logoimage'].'" width = "200" height = "200"/><br>
              '.$row['teamname'].'</td>
              ';

          if($i % 4 == 3){
          	echo '</tr>';
          }
/// <img src="http://192.168.105.208/jobduo/image/mainimage.png" alt=""  class="img-square" id = "logo" height="100%" />
		  $i++;
        }

        echo '</tbody>';
        echo '</table>';
//////////////////////////////////////////////

    if($pageNum <= 1){
          echo '<font size=2  color=red>처음</font>';
        }else{
            echo '<font size=2><a href="/jobduo/enrollment/teamenrollmentToPlayer.php?&page=&list='.$list.'">처음</a></font>';
        }



    if($block <=1){
        echo '<font> </font>';
    }else{
        $b_start_page = $b_start_page-1;
        echo '<font size=2><a href="/jobduo/enrollment/teamenrollmentToPlayer.php?&page='.$b_start_page.'&list='.$list.'">이전</a></font>';
        $b_start_page = $b_start_page+1;
    }





    for($j = $b_start_page; $j <=$b_end_page; $j++)
    {
        if($pageNum == $j)
        {
            echo '<font size=2 color=red>'.$j.'</font>';
        }
        else{
            echo '<font size=2><a href="/jobduo/enrollment/teamenrollmentToPlayer.php?&page='.$j.'&list='.$list.'">'.$j.'</a></font>';
          }
    }



    $total_block = ceil($total_page/$b_pageNum_list);

    if($block >= $total_block){
      echo '<font> </font>';
    }else{
      $b_end_page = $b_end_page+1;
      echo '<font size=2><a href="/jobduo/enrollment/teamenrollmentToPlayer.php?page='.$b_end_page.'&list='.$list.'">다음</a></font>';
      $b_end_page = $b_end_page-1;
    }



    if($pageNum >= $total_page){

            echo '<font size=2 color=red>마지막</font>';

        }else{
            echo '<font size=2><a href="/jobduo/enrollment/teamenrollmentToPlayer.php?page='.$total_page.'&list='.$list.'">마지막</a></font>';

        }


 ?>


</div>
</div>



<br>
<hr>
</div>












  <!-- jQuery (부트스트랩의 자바스크립트 플러그인을 위해 필요합니다) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <!-- 모든 컴파일된 플러그인을 포함합니다 (아래), 원하지 않는다면 필요한 각각의 파일을 포함하세요 -->
  <script src="http://192.168.105.208/jobduo/bootstrap-3.3.2-dist/bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>




  </body>
</html>
