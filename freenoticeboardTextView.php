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
    <?php
    require("mainheadhtml.php");
     ?>
  </head>



  <body>



      <?php
       require("mainhtml.php");
       $textNum = $_GET['textNum']; //보여줄 자유게시판 글 내용의 번호 

 		$result = mysqli_query($conn,"SELECT *  FROM freenoticeboard WHERE num = '". $textNum ."'");

 		mysqli_query($conn,"UPDATE freenoticeboard SET views = views+1 WHERE num = '". $textNum ."'");
 		//조회수 
//='".$nickname."'");
        $row = mysqli_fetch_assoc($result);


        $authorImage = $row['author'];
     
        $authorImage = mysqli_query($conn,"select image from playerinfo where name = '". $authorImage ."'");
        $authorImage = mysqli_fetch_assoc($authorImage);


       ?>
 
      <div class="container"> <!--100px 의 여백 고정된 사이즈로 만들어줌-->

<article>
  <nav class="MainText">
    









<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">
<table  data-example-id="simple-table">

<caption>

<tr>
	<td rowspan="3">
	 <?php 
		echo '<img src="'. $authorImage['image'] .'" style = "width: 100px; height: auto;">';
	 ?>
	 </td>

	<td>
		<?php 
		echo "&nbsp 제목: " . $row['title'];
	 	?>	
	</td>
</tr>
<tr>	
	<td>
		<?php 
		echo "&nbsp 저자: " .$row['author'];
	 ?>
	</td>
</tr>
<tr>
	<td>
		<?php 
		echo "&nbsp 게시일 : " .$row['data'];
		?>

	</td>
	</tr>
</tr>


</caption>

</table>
</div></div>



<br>






<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">
<table class="table table-hover" data-example-id="simple-table">

<hr>

<?php 
echo $row['maintext'];
 ?>


<hr>

<caption> <div id = "writeButton"><a href="/jobduo/write.php"><button type="button" style="margin-right: 0px" class="btn btn-primary">글 쓰기</button></a></div> 자유 게시판
</caption>

<thead>
  <tr>
    <div class="row">
    <th class="col-md-1">번호</th>
    <th class="col-md-5">제목</th>
    <th class="col-md-2">작성자</th>
    <th class="col-md-2">작성일</th>
    <th class="col-md-1">조회수</th>
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

    $buyTotalCount = mysqli_query($conn, "SELECT count(*) FROM freenoticeboard ");
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

 

  $dbtableinfo = mysqli_query($conn, "SELECT num, title, author, data, views FROM freenoticeboard WHERE num <= $startDB and num > $endDB ORDER BY num DESC");

        while($row = mysqli_fetch_assoc($dbtableinfo)){
          //echo '<div class="col-md-3" id = "menubartext"><li><a href="/jobduo/index.php?id='.$row['id'].'">'.htmlspecialchars($row['title']).'</a></li></div>';
            echo '<tr style = "cursor:pointer;" onclick = "location.href=' ."'". ' /jobduo/freenoticeboardTextView.php?page='.$pageNum.'&list=10&textNum='.$row['num'] . "'".'">
              <th scope="row">'.$row['num'].'</th>
                <td>'.$row['title'].'</td>
                  <td>'.$row['author'].'</td>
                    <td>'.$row['data'].'</td>
                      <td>'.$row['views'].'</td>
          </tr>';


        }



        echo '</tbody>';



        echo '</table> <br>';
//////////////////////////////////////////////



        echo '<div style="text-align:center">';

        

    if($pageNum <= 1){
          echo '<font size=2 color=red>처음</font>';
        }else{
            echo '<font size=2><a href="/jobduo/freenoticeboard.php?&page=&list='.$list.'">처음</a></font>';
        }



    if($block <=1){
        echo '<font> </font>';
    }else{
        $b_start_page = $b_start_page-1;
        echo '<font size=2><a href="/jobduo/freenoticeboard.php?&page='.$b_start_page.'&list='.$list.'">이전</a></font>';
        $b_start_page = $b_start_page+1;
    }





    for($j = $b_start_page; $j <=$b_end_page; $j++)
    {
        if($pageNum == $j)
        {
            echo '<font size=2 color=red>'.$j.'</font>';
        }
        else{
            echo '<font size=2><a href="/jobduo/freenoticeboard.php?&page='.$j.'&list='.$list.'">'.$j.'</a></font>';
          }
    }



    $total_block = ceil($total_page/$b_pageNum_list);

    if($block >= $total_block){
      echo '<font> </font>';
    }else{
      $b_end_page = $b_end_page+1;
      echo '<font size=2><a href="/jobduo/freenoticeboard.php?page='.$b_end_page.'&list='.$list.'">다음</a></font>';
      $b_end_page = $b_end_page-1;
    }



    if($pageNum >= $total_page){

            echo '<font size=2 color=red>마지막</font>';

        }else{
            echo '<font size=2><a href="/jobduo/freenoticeboard.php?page='.$total_page.'&list='.$list.'">마지막</a></font></div>';

        }


 ?>

</td>

</tr>

</div>
</div>



<br>
<hr>
</div>



</nav>


</article>



    <!-- jQuery (부트스트랩의 자바스크립트 플러그인을 위해 필요합니다) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- 모든 컴파일된 플러그인을 포함합니다 (아래), 원하지 않는다면 필요한 각각의 파일을 포함하세요 -->
    <script src="http://192.168.105.208/jobduo/bootstrap-3.3.2-dist/bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>
  </body>
</html>
