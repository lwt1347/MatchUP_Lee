<?php
  require("../config/config.php");
  require("../lib/db.php");
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
    <link rel="stylesheet" type = "text/css" href="../style.css">

    <link rel='stylesheet' type='text/css' href='http://arshaw.com/js/fullcalendar-1.6.3/fullcalendar/fullcalendar.css' />
    <script type='text/javascript' src='http://arshaw.com/js/fullcalendar-1.6.3/jquery/jquery-1.10.2.min.js'></script>
    <script type='text/javascript' src='http://arshaw.com/js/fullcalendar-1.6.3/jquery/jquery-ui-1.10.3.custom.min.js'></script>
    <script type='text/javascript' src='http://arshaw.com/js/fullcalendar-1.6.3/fullcalendar/fullcalendar.min.js'></script>

    <script type="text/javascript">
      var teamCb = false;
      var imageCb = false;
      var addressCb = false;
      var btn = document.getElementById('btn_submit');

    </script>



  </head>



  <body>



    <?php
     require("../mainhtml.php");
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
 
            if($row['count(*)'] >= 1){
              echo '<script>
            alert("이미 등록한 팀이 있습니다.");
            history.back();
            </script>';
            }



          }
     ?>

  <div class="container"> <!--100px 의 여백 고정된 사이즈로 만들어줌-->


  


  <!-- ajax 를 통한 서버와의 통신  -->
        <article>

              <nav class="MainText">


        
       




        <!--이미지 서버에 전송 하기 로직-->
        <form  action="teamNameInsert.php" method="POST" enctype="multipart/form-data">
           <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
           <!--파일이 너무 크면 안들어감 그냥 대충 크다 싶어도 안됨 그냥 작아야함 hidden-->
    

<div class ="row">
<div class="collapse-navbar-collapse">
           <table id = teamenrollmenttable>
           <tr>
               <td>
                  
                 팀 리더 : <input type="text" name = "readerName" value = "<?php 
                 echo $_SESSION['nickname'];
                  ?>" style = "border:0" readonly>
                 
                

                </td>
            </tr>
              <tr>
               <td>
                  
                 팀 로고 이미지를 선택하세요. (.png)

                </td>
            </tr>
           <tr>
            <td>

             <p><input name="userfile" id = "userfile" type="file"/></p>
            <!--<li><input type="submit" value="upload"/></li>-->
              <p id="status"></p>
            <div id="holder"></div>


            <script type='text/javascript'>
            function pictureName(){
              //그림 이름값 알아오기 위한 함수
              //document.getElementById('user').innerHTML =  document.getElementById('userfile').value;
              var imageName = document.getElementById('logoImage');
              imageName.value = document.getElementById('userfile').value;

            }
            </script>

              <input type="hidden" name= "logoImage" id="logoImage">

            </td>
          </tr>
          <tr>
            <td colspan="2">
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <label for="inputEmail" class="sr-only" >팀 명을 입력하세요.</label>
              <input class="form-control" id = "teamName" name = "teamName" placeholder="팀 명을 입력하세요." required>

              <label id="checkTeamName">TeamName Check.</label>

            </td>
           
          </tr>
          <tr>

          </tr>

          <tr>
            <td>

<!-- // 다음 주소검색 창 -->

              <input type="text" id = "sample3_postcode" class="form-control" placeholder="우편번호" readonly>
            </td>
            <td>
              <input type="button" onclick="sample3_execDaumPostcode()" value="우편번호 찾기"><br>

 </td>
 </tr>
 <tr>
 <td colspan="2">

              <div id="wrap" style="display:none;border:1px solid;width:500px;height:300px;margin:5px 0;position:relative">
              <img src="//i1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnFoldWrap" style="cursor:pointer;position:absolute;right:0px;top:-1px;z-index:1" onclick="foldDaumPostcode()" alt="접기 버튼">
              </div>

              <input type="text" id="sample3_address" name = "address" class="form-control" placeholder="활동 주소" readonly>

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
            <td>
         
              <input type="submit" value="팀 등록하기" id="btn_submit" disabled = false style="color : gray" onclick="pictureName()"/>

            </td>

          </tr>


           </table>
</div>
</div>



           


        </form>






      </nav>
    </div>

</article>



        <!--팀명 에서 포커스 아웃 되면 php에 ajax 를 통해 쿼리르 용청하고 값을 얻는다.-->
        <script>
         var check;
          document.querySelectorAll('input')[4].addEventListener('focusout', function(event){

            var xhr = new XMLHttpRequest();
            btn = document.getElementById('btn_submit');

            xhr.open('POST', './teamNameCheck.php');

            xhr.onreadystatechange = function(){ //서버로부터 받아온 값을 뿌림
                check = xhr.responseText; 
                var checkTeamInnerHTML = check-1;

//팀이름 2 ~ 14 사이만 입력 가능  
if(document.getElementById("teamName").value.length > 1 && document.getElementById("teamName").value.length <=15){


                if(checkTeamInnerHTML > 0){
                  checkTeamInnerHTML = "<span style='color:green'>사용 가능한 팀 이름입니다.</span>";
                  //btn.disabled = false;
                  //btn.style.color = "black";
                  //팀 등록하기 버튼 누르기 위한 불린.
                  teamCb = true;
                  if(teamCb == true && imageCb == true){
                  btn.disabled = false;
                  btn.style.color = "black";
                  }

                }else {
                  
                  checkTeamInnerHTML = "<span style='color:red'>팀 명이 중복됩니다.</span>";
                  btn.disabled = true;
                  btn.style.color = "gray";
                  teamCb = false;
                }

                document.querySelector('#checkTeamName').innerHTML = checkTeamInnerHTML;

                if(check-1 > 0){//패쇼
                    
                }else{
                //노패스

                }
}else {
  checkTeamInnerHTML = "<span style='color:red'>팀 명을 2~15자리 사이를 입력하세요.</span>";
  document.querySelector('#checkTeamName').innerHTML = checkTeamInnerHTML;
  btn.disabled = true;
  btn.style.color = "gray";
  teamCb = false;
}

            }

            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            var data = ''; //서버로 보낼 데이터
            data += '&format='+ document.getElementById("teamName").value;
            xhr.send(data); 
            
        });

          
        </script> 



                



<?php
require("../lasthtml.php");
 ?>
<script>
var upload = document.getElementsByTagName('input')[2], //[1] 이 몇번재 input에서 작동 할 것인가에 대해 판단한다. 그림 띄우기
    holder = document.getElementById('holder'),
    state = document.getElementById('status');





if (typeof window.FileReader === 'undefined') {
  state.className = 'fail';
} else {
  state.className = 'success';
}

upload.onchange = function (e) {


  //imageCb = true;
  var imgPn = document.getElementById('userfile').value;
  imgPn = imgPn.substr(imgPn.length-3,imgPn.length);
  //png 파일을로 거른다.
  if(imgPn == "png"){
    imageCb = true;
                  if(teamCb == true && imageCb == true){
                  btn.disabled = false;
                  btn.style.color = "black";
                  }
  }else{
    imageCb = false;
    btn.disabled = true;
    btn.style.color = "gray";
  }


  e.preventDefault();

  var file = upload.files[0],
      reader = new FileReader();
  reader.onload = function (event) {
    var img = new Image();
    img.src = event.target.result;
    // note: no onload required since we've got the dataurl...I think! :)
    if (img.width > 350) { // holder width
      img.width = 56;
    }
    holder.innerHTML = '';
    holder.appendChild(img);



  };
  reader.readAsDataURL(file);

  return false;
};
</script>

<script type="text/javascript">
  

</script>





    <!-- jQuery (부트스트랩의 자바스크립트 플러그인을 위해 필요합니다) -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->
    <!-- 모든 컴파일된 플러그인을 포함합니다 (아래), 원하지 않는다면 필요한 각각의 파일을 포함하세요 -->
    <script src="http://192.168.105.208/jobduo/bootstrap-3.3.2-dist/bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>

  </body>
</html>
