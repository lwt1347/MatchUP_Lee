<?php
// CSRF 방지를 위한 상태 토큰 생성 코드
// 상태 토큰은 추후 검증을 위해 세션에 저장되어야 한다.

function generate_state() {
    $mt = microtime();
    $rand = mt_rand();
    return md5($mt . $rand);
}

// 상태 토큰으로 사용할 랜덤 문자열을 생성
$state = generate_state();
// 세션 또는 별도의 저장 공간에 상태 토큰을 저장
$session->set_state($state);
return $state;
?>

<html lang="ko">
<head>
  <script type="text/javascript" src="https://static.nid.naver.com/js/naverLogin_implicit-1.0.2.js" charset="utf-8"></script>
  <script type="text/javascript" src="https://static.nid.naver.com/js/naverLogin_implicit-1.0.2-min.js" charset="utf-8"></script>
  <script type="text/javascript" src="https://apis.naver.com/nidlogin/nid/getUserProfile.xml" charset="utf-8"></script>
</head>
<body>


<!-- 네이버아디디로로그인 Callback페이지 처리 Script -->
<script type="text/javascript">

	// 네이버 사용자 프로필 조회 이후 프로필 정보를 처리할 callback function
	function naverSignInCallback() {
		// naver_id_login.getProfileData('프로필항목명');
		// 프로필 항목은 개발가이드를 참고하시기 바랍니다.
		alert(naver_id_login.getProfileData('email'));
		alert(naver_id_login.getProfileData('nickname'));
		alert(naver_id_login.getProfileData('age'));
	}


	// 네이버 사용자 프로필 조회
	naver_id_login.get_naver_userprofile("naverSignInCallback()");
  naverSignInCallback();

</script>
<!-- //네이버아디디로로그인 Callback페이지 처리 Script -->
</body>
</html>
