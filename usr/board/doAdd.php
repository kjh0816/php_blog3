<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';
?>

<?php

loginCheck();
$memberId = $_SESSION['loginedMemberId'];



if(!isset($_GET['name'])){
    echo "게시판 이름을 입력해주세요.";
    exit;
}


$name = $_GET['name'];


if(!isset($_GET['code'])){
    echo "게시판 이름을 입력해주세요.";
    exit;
}

$code = $_GET['code'];


$sqlGetBoardByName = "
SELECT * FROM board
WHERE name = '${name}';
";


$boardByName = DB__getRow($sqlGetBoardByName);
if($boardByName != null){
    echo "게시판 이름: ${name}이(가) 이미 존재합니다.";
    exit;
}

$sqlGetBoardByCode = "
SELECT * FROM board
WHERE code = '${code}';
";


$boardByCode = DB__getRow($sqlGetBoardByCode);
if($boardByCode != null){
    echo "게시판 코드: ${code}이(가) 이미 존재합니다.";
    exit;
}


$sqlAddBoard = "
INSERT INTO board
SET regDate = NOW(),
updateDate = NOW(),
memberId = ${memberId},
`name` = '${name}',
`code` = '${code}';
";

$boardId = DB__insert($sqlAddBoard);
?>

<script>
alert('<?=$boardId?>번 게시판이 추가되었습니다.');
location.replace('detail.php?id=<?=$boardId?>');
</script>