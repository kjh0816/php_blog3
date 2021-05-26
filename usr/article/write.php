<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php'; 

?>
<?php $pageTitle = "게시물 작성";
?>
<?php require_once __DIR__ . "/../head.php";
?>
<form action="doWrite.php">
<div>
<span>제목</span>
<input required placeholder="제목을 입력해주세요." type="text" name="title">
</div>
<div>
<span>제목</span>
<textarea required placeholder="내용을 입력해주세요." name="body"></textarea>
</div>
<input type="submit" value="완료">
</form>

<?php require_once __DIR__ . "/../foot.php";
?>