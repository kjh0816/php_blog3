<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

$member = $_SESSION['loginedMemberId'];
if($member == null){
    echo "로그인이 필요합니다.";
    exit;
}


?>

