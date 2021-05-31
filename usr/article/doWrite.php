<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

loginCheck();


if(!isset($_GET['boardId'])){
    echo "게시판을 선택해주세요.";
    exit;
}

if(!isset($_GET['title'])){
    echo "제목(title)을 입력해주세요.";
    exit;
}

if(!isset($_GET['body'])){
    echo "내용(body)을 입력해주세요.";
    exit;
}

$memberId = $_SESSION['loginedMemberId'];
$boardId = $_GET['boardId'];
$title = $_GET['title']; 
$body = $_GET['body'];

$sql = "
INSERT INTO article
SET regDate = NOW(),
updateDate = NOW(),
memberId = ${memberId},
boardId = ${boardId},
title = '${title}',
`body` = '${body}';
";

$id = DB__insert($sql);

?>

<script>
    alert('<?=$id?>번 게시물이 추가되었습니다.');
    location.replace('detail.php?id=<?=$id?>');
</script>