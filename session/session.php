<?php
session_start();
if(!isset($_SESSION['is_login'])){
    header('Location: ./login.html'); //로그인 실패시 이동시킴
}
?>
<html>
    <body>
        <?php echo $_SESSION['nickname'];?>님 환영합니다<br />
        <a href="./logout.php">로그아웃</a>
    </body>
</html>
