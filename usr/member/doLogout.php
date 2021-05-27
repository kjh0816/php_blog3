<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';
unset($_SESSION['loginedMemberId']);
?>
<script>
alert('로그아웃 되었습니다.');
location.replace('../article/list.php');
</script>