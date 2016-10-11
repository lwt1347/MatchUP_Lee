<?php
session_start();
  require("../config/config.php");
  require("../lib/db.php");
  $conn = db_init($config["host"],$config["duser"],$config["dpw"], $config["dname"]);
  $result = mysqli_query($conn, "SELECT * FROM menubar ORDER BY id ASC");

  //id 로 정렬


 ?>
 <?php

     if(empty($_SESSION['nickname'])){
            
            echo '<script>
            alert("로그인 후 에 사용 가능 합니다.");
            history.back();
            </script>';



          }
          else{ //팀리더는 하나의 팀만 개설 할 수 있도록 한다.

            $teamReader = $_SESSION['nickname'];
            $result = mysqli_query($conn,"SELECT count(*)  FROM teaminfo WHERE leader ='".$teamReader."'");
            $row = mysqli_fetch_assoc($result);
            
            $sendTeamName = mysqli_query($conn,"SELECT teamname  FROM teaminfo WHERE leader ='".$teamReader."'");
            $sendTeamName = mysqli_fetch_assoc($sendTeamName);

            if($row['count(*)'] >= 1){

            }else{
              echo '<script>
            alert("등록한 팀이 없거나 팀의 리더가 아닙니다.");
            history.back();
            </script>';
            }


            $Nick = $_SESSION['nickname'];
            $result = mysqli_query($conn,"SELECT count(*)  FROM playerinfo WHERE emailid ='".$Nick."'");
            $row = mysqli_fetch_assoc($result);

            if($row['count(*)'] == 0){
            echo '<script>
            alert("선수 등록을 먼저 하세요.");
            history.back();
            </script>';
            }


          }
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
     <title>MatchUp 경기장 찾기!!!</title>
   </head>
   <body  onload="winMove()">

<!-- 부트스트랩 -->
    <link href="/jobduo/bootstrap-3.3.2-dist/bootstrap-3.3.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type = "text/css" href="../style.css">

<form action="enrollmentMatch.php" method="POST" >
  
<table style="margin:30px" >
<tbody >
          <tr>
            <td style="padding-right: 10px; padding-bottom: 10px;">

<!-- // 다음 주소검색 창 -->
 
              <input type="text" id = "sample3_postcode" class="form-control" placeholder="우편번호" readonly>
            </td>
            <td style="padding-right: 10px; padding-bottom: 10px;">
              <input type="button" onclick="sample3_execDaumPostcode()" value="경기장 찾기"><br>

 </td>
 </tr>
 <tr>
 <td colspan="2" style="padding-right: 10px; padding-bottom: 10px;">

              <div id="wrap" style="display:none;border:1px solid;width:500px;height:300px;margin:5px 0;position:relative">
              <img src="//i1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnFoldWrap" style="cursor:pointer;position:absolute;right:0px;top:-1px;z-index:1" onclick="foldDaumPostcode()" alt="접기 버튼">
              </div>

              <input type="text" id="sample3_address" name = "address" class="form-control" placeholder="경기장  위치" style="width:300px;" readonly>

              <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
              <script>
                  // 우편번호 찾기 찾기 화면을 넣을 element
                  var element_wrap = document.getElementById('wrap');

                  function foldDaumPostcode() {
                      // iframe을 넣은 element를 안보이게 한다.
                      element_wrap.style.display = 'none';
                  }

                  function sample3_execDaumPostcode() {
                      // 현재 scroll 위치를 저장해놓는다.
                      var currentScroll = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
                      new daum.Postcode({
                          oncomplete: function(data) {
                              // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                              // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                              // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                              var fullAddr = data.address; // 최종 주소 변수
                              var extraAddr = ''; // 조합형 주소 변수

                              // 기본 주소가 도로명 타입일때 조합한다.
                              if(data.addressType === 'R'){
                                  //법정동명이 있을 경우 추가한다.
                                  if(data.bname !== ''){
                                      extraAddr += data.bname;
                                  }
                                  // 건물명이 있을 경우 추가한다.
                                  if(data.buildingName !== ''){
                                      extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                                  }
                                  // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
                                  fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');

                              }

                              // 우편번호와 주소 정보를 해당 필드에 넣는다.
                              document.getElementById('sample3_postcode').value = data.zonecode; //5자리 새우편번호 사용
                              document.getElementById('sample3_address').value = fullAddr;

                              // iframe을 넣은 element를 안보이게 한다.
                              // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
                              element_wrap.style.display = 'none';

                              // 우편번호 찾기 화면이 보이기 이전으로 scroll 위치를 되돌린다.
                              document.body.scrollTop = currentScroll;



/////////////////////////////////////////주소 입력 했을때 지도를 띄운다.

var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
    mapOption = {
        center: new daum.maps.LatLng(33.450701, 126.570667), // 지도의 중심좌표
        level: 3 // 지도의 확대 레벨
    };  

// 지도를 생성합니다    
var map = new daum.maps.Map(mapContainer, mapOption); 

// 주소-좌표 변환 객체를 생성합니다
var geocoder = new daum.maps.services.Geocoder();

// 주소로 좌표를 검색합니다
geocoder.addr2coord(fullAddr, function(status, result) {

    // 정상적으로 검색이 완료됐으면 
     if (status === daum.maps.services.Status.OK) {

        var coords = new daum.maps.LatLng(result.addr[0].lat, result.addr[0].lng);

        // 결과값으로 받은 위치를 마커로 표시합니다
        var marker = new daum.maps.Marker({
            map: map,
            position: coords
        });

        // 인포윈도우로 장소에 대한 설명을 표시합니다
        var infowindow = new daum.maps.InfoWindow({
            content: '<div style="width:150px;text-align:center;padding:6px 0;">경기장</div>'
        });
        infowindow.open(map, marker);

        // 지도의 중심을 결과값으로 받은 위치로 이동시킵니다
        map.setCenter(coords);

         btn = document.getElementById('btn_submit');
         btn.disabled = false;
         btn.style.color = "black";
    } 
});    



                          },
                          // 우편번호 찾기 화면 크기가 조정되었을때 실행할 코드를 작성하는 부분. iframe을 넣은 element의 높이값을 조정한다.
                          onresize : function(size) {
                              element_wrap.style.height = size.height+'px';
                          },
                          width : '100%',
                          height : '100%'
                      }).embed(element_wrap);

                      // iframe을 넣은 element를 보이게 한다.
                      element_wrap.style.display = 'block';
                  }
              </script>
            </td>
          </tr>
          <tr>
            <td colspan="2" style="padding-right: 10px; padding-bottom: 10px;" >
              <div id="map" style="width:80%;height:300px;"></div>
            </td>
          </tr>
           <tr>
            <td colspan="2" style="padding-right: 10px; padding-bottom: 10px;">
              
              <input class="form-control" placeholder="위치 상세 설명을 입력하세요." required style="width:300px;" name="explanation">

            </td>
          </tr>

          <tr>
            <td colspan="2" style="padding-right: 10px; padding-bottom: 10px;">
              
               <label for="form-title">시작 시간과 종료 시간을 선택하세요.</label>
               </td>
           
          </tr>

          <tr>

          </tr>

         

<tr>
    <td style="padding-left: 0px; padding-bottom: 10px; " >
 
    <select class="form-control" style="width: 100px;" name="startTime">
      <option>9:00</option>
      <option>10:00</option>
      <option>11:00</option>
      <option>12:00</option>
      <option>13:00</option>
      <option>14:00</option>
      <option>15:00</option>
      <option>16:00</option>
      <option>17:00</option>
      <option>18:00</option>
      <option>19:00</option>
      <option>20:00</option>
      <option>21:00</option>
      <option>22:00</option>
    </select>
 </td>
  <td style="padding-right: 400px; padding-bottom: 10px; " >
 
    <select class="form-control" style="width: 100px;" name="endTime">
      <option>10:00</option>
      <option>11:00</option>
      <option>12:00</option>
      <option>13:00</option>
      <option>14:00</option>
      <option>15:00</option>
      <option>16:00</option>
      <option>17:00</option>
      <option>18:00</option>
      <option>19:00</option>
      <option>20:00</option>
      <option>21:00</option>
      <option>22:00</option>
      <option>23:00</option>
      <option>24:00</option>
    </select>
 </td>
</tr>

<tr>
  <td>
<?php 
$day = $_GET['day'];
$year = $_GET['year'];
$month = $_GET['month']+1;
$date = $year ."-". $month . "-" .  $day ;




if(empty($day)){
echo "<script>window.close();</script>";
}
echo '<input type="hidden" id ="teamName" name = "teamName" value ="'.$sendTeamName['teamname'].'">';
echo '<input type="hidden" id ="date" name = "date" value ="'.$date.'">';

?>
  
</td>
</tr>

<tr>
  <td>
    <input type="submit" id="btn_submit" value="경기 등록하기" disabled = false style="color : gray">
  </td>

</tr>


</tbody>
           </table>

</form>




<script type="text/javascript" src="//apis.daum.net/maps/maps3.js?apikey=984055de028e8772639047b7734e94d3&libraries=services"></script>
<script>
</script>


    <!-- jQuery (부트스트랩의 자바스크립트 플러그인을 위해 필요합니다) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- 모든 컴파일된 플러그인을 포함합니다 (아래), 원하지 않는다면 필요한 각각의 파일을 포함하세요 -->
    <script src="http://192.168.105.208/jobduo/bootstrap-3.3.2-dist/bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>
   </body>
 </html>
