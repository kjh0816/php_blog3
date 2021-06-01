<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';
?>

<?php

loginCheck();

$boardId = getIntValueOr($_GET['id'], 0);
if($boardId == 0){
    jsHistoryBackExit("게시판이 존재하지 않습니다.");
}




$sqlGetBoard = "
SELECT * FROM board
WHERE id = ${boardId};
";

$board = DB__getRow($sqlGetBoard);

if($board == null){
    jsHistoryBackExit("게시판이 존재하지 않습니다.");
}





$sqlDeleteBoard = "
DELETE FROM board
WHERE id = ${boardId};
";


?>

<?php if($_SESSION['loginedMemberId'] == 1){ ?>

<?php DB__delete($sqlDeleteBoard); 

jsLocationReplaceExit("/usr/board/list.php", "${boardId}번 게시판이 관리자 권한으로 삭제되었습니다.");


 }else { 

if($board['memberId'] != $_SESSION['loginedMemberId']){ 

    jsHistoryBackExit("권한이 없습니다.");
    

 }else{
  
    DB__delete($sqlDeleteArticle); 
    
    jsLocationReplaceExit("/usr/board/list.php", "${boardId}번 게시판이 삭제되었습니다.");
    }
 } ?>