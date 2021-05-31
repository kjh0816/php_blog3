<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/webInit.php';

?>
<?php if(!isset($_SESSION['loginedMemberId'])){ ?>
    <script>
    alert('로그인 후 이용해주세요.');
    location.replace('../member/login.php');
    </script>
    
<?php }?>
<?php



?>

<?php 
$loginPage = true;
$pageTitle = "게시판 추가";
require_once __DIR__. '/../head.php';
?>
<form action="doAdd.php">
게시판 이름: <input required placeholder="게시판 이름 입력" type="text" name="name"><br>
게시판 코드: <input required placeholder="게시판 코드 입력 ex) lol" type="text" name="code"><br>
<input type="submit" value="완료">
</form>

<?php 
require_once __DIR__. '/../foot.php';
?>
