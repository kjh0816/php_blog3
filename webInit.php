<?php 
// 사용자 요청을 처리하는 모든 php파일에서 호출하는 파일.

// WEB 루트 = $_SERVER['DOCUMENT_ROOT'];

// require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';


session_start();
require_once __DIR__ . "/util.php";

$dbConn = mysqli_connect("127.0.0.1", "jhmysql", "1234", "php_blog");
?>