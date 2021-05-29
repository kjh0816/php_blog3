<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';
session_unset();
?>
<script>
alert('로그아웃 되었습니다.');
location.replace('../article/list.php');
</script>