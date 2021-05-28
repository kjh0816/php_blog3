<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';


$sqlGetBoards = "
SELECT * FROM board
";

$boards = DB__getRows($sqlGetBoards);
?>
