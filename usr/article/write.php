<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php'; 
?>

<?php

loginCheck(); 
$memberId = $_SESSION['loginedMemberId'];


$sqlGetBoards = "
SELECT * FROM board
";

$boards = DB__getRows($sqlGetBoards);
?>

<?php 
$loginPage = true;
$pageTitle = "게시물 작성";
?>
<?php require_once __DIR__ . "/../head.php";
?>
<form action="doWrite.php">
<div>
<span>게시판 선택
<select required name="boardId">
<?php foreach($boards as $board){?>
    <?php if($memberId == 1){?>
    <option value="<?=$board['id']?>"><?=$board['name']?></option>
    <?php }else{ ?>
    <?php if($board['id'] != 1){?>
    <option value="<?=$board['id']?>"><?=$board['name']?></option>

    <?php }}?>
<?php }?>
</select>
</span>
</div>
<div>
<span>제목</span>
<input required placeholder="제목을 입력해주세요." type="text" name="title">
</div>
<div>
<span>내용</span>
<textarea required placeholder="내용을 입력해주세요." name="body"></textarea>
</div>
<input type="submit" value="완료">
</form>

<?php require_once __DIR__ . "/../foot.php";
?>