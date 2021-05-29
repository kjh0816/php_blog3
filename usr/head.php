
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=$pageTitle?></title>
  <link rel="stylesheet" href="/common.css">
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css"
  >
</head>
<body>
  <h1><?=$pageTitle?></h1>
  <hr>
  <!-- 로그인된 상태일 경우, 로그아웃 버튼 생성-->
  
  <div class="home"><a href="/usr/member/userHome.php">HOME</a></div>
  <?php


  if($loginPage){
  if ( isset($_SESSION['loginedMemberId']) ) { ?>
  <a class="logout_button" onClick="if(!confirm('로그아웃 하시겠습니까?')){return false}" href="/usr/member/doLogout.php">로그아웃</a>
  <?php }else{ ?>
    <a class="login_button" href="/usr/member/login.php">로그인</a>
  <?php } ?>
<?php } ?>
  <hr>