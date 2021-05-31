<?php 
require_once $_SERVER['DOCUMENT_ROOT']. '/webInit.php';
?>

<?php 
$loginPage = true;
$pageTitle = "Home";
?>
<?php 
require_once __DIR__ . '/../head.php';
?>
<a href="/usr/member/user.php">내 정보</a><br><br>

<a href="/usr/board/list.php">게시판 리스트로 이동</a><br><br>

<a href="/usr/article/list.php">게시물 리스트로 이동</a>








<?php 
require_once __DIR__ . '/../foot.php';
?>