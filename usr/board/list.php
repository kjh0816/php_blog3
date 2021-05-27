<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';


$sqlGetBoards = "
SELECT * FROM board
";

$boards = DB__getRows($sqlGetBoards);

?>
<?php $pageTitle = "게시판 리스트"; ?>
<?php require_once __DIR__ . '/../head.php'; ?>

<?php foreach($boards as $board){?>
    <?php $boardDetailUrl = "detail.php?id=${board['id']}"?>

        번호 : <?=$board['id']?><br>
        <div>
        <a href="<?=$boardDetailUrl?>">게시판 이름 : <?=$board['name']?></a><br>
        게시판 코드 : <?=$board['code']?><br>
        생성 날짜 : <?=$board['regDate']?><br>
        </div>
        <hr>
<?php } ?>



<?php require_once __DIR__ . '/../foot.php'; ?>