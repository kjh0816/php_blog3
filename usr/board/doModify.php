<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

if(!isset($_SESSION['loginedMemberId'])){
    echo "로그인 후 이용 가능합니다.";
    exit;
}

$memberId = $_SESSION['loginedMemberId'];

if(!isset($_GET['id'])){
    echo "게시판이 존재하지 않습니다.";
    exit;
}


$boardId = $_GET['id'];

$sqlGetBoard = "
SELECT * FROM board
WHERE id = ${boardId};
";

$board = DB__getRow($sqlGetBoard);

if($board['memberId'] != $memberId){
    echo "권한이 없습니다.";
    exit;
}



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

$sqlModifyBoard = "
UPDATE board
SET regDate = regDate,
updateDate = NOW(),
memberId = memberId,
`name` = '${name}',
`code` = '${code}'
WHERE id = ${boardId};
";

DB__update($sqlModifyBoard);
?>
<script>
alert('<?=$boardId?>번 게시판이 수정되었습니다.');
location.replace('detail.php?id=<?=$boardId?>');
</script>