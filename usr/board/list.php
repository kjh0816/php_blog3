<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';


$sqlGetBoards = "
SELECT * FROM board
";

$boards = DB__getRows($sqlGetBoards);


$loginPage = true;
$pageTitle = "모든 게시판 리스트";
require_once __DIR__ . '/../head.php';

?>
<?php foreach($boards as $board){?>

    <?php 
    $memberId = $board['memberId'];
    $sqlGetMember = "
    SELECT * FROM member
    WHERE id = ${memberId}
    ";

    $member = DB__getRow($sqlGetMember);
    ?>
    <a href="detail.php?id=<?=$board['id']?>">
    게시판 번호: <?=$board['id']?><br>
    게시판 이름: <?=$board['name']?><br>
    게시판 코드: <?=$board['code']?><br>
    게시판 주인: <?=$member['nickname']?>
    </a>
    <hr>

<?php } ?>

<?php 
require_once __DIR__ . '/../foot.php';
?>
