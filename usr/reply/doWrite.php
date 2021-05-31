<?php 
require_once $_SERVER['DOCUMENT_ROOT']. '/webInit.php';
?>


<?php

loginCheck();

if(!isset($_GET['relId'])){
    echo "게시물이 존재하지 않습니다.";
    exit;
}

if(!isset($_GET['body'])){
    echo "댓글을 입력해주세요.";
    exit;
}

$relId = $_GET['relId'];
$body = $_GET['body'];
$memberId = $_SESSION['loginedMemberId'];

$sqlWriteReply = "
INSERT INTO reply
SET regDate = NOW(),
updateDate = NOW(),
memberId = ${memberId},
relTypeCode = 'article',
relId = ${relId},
liked = 0,
`body` = ${body} 
";

$replyId = DB__insert($sqlWriteReply);

?>

<script>
alert('댓글이 등록되었습니다.');
location.replace('/usr/article/detail.php?id=<?=$relId?>');
</script>


