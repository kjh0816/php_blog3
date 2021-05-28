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



$sqlGetMember = "
SELECT * FROM `member`
WHERE id = ${memberId};
";

$member = DB__getRow($sqlGetMember);


$sqlGetBoard = "
SELECT * FROM board
WHERE id = ${boardId};
";

$board = DB__getRow($sqlGetBoard);

if($board == null){
    echo "게시판이 존재하지 않습니다.";
    exit;
}


if($member['id'] != $board['memberId']){
    echo "권한이 없습니다.";
    exit;
}

?>
<?php 
$loginPage = true;
$pageTitle = "게시판 수정";
require_once __DIR__. '/../head.php';
?>

<form action="doModify.php">
<input type="hidden" name="id" value=<?=$boardId?>>
게시판 이름: <input required placeholder="게시판 이름 입력" type="text" name="name"><br>
게시판 코드: <input required placeholder="게시판 코드 입력" type="text" name="code"><br>
<input type="submit" value="완료">
</form>



<?php 
require_once __DIR__. '/../foot.php';
?>