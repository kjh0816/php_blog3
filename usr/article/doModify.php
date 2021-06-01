<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';
?>

<?php

loginCheck();

$articleId = getIntValueOr($_GET['id'], 0);
if($articleId == 0){
    jsHistoryBackExit("게시물 번호(id)가 존재하지 않습니다.");
}


$title = getStrValueOr($_GET['title'], "");
if(empty($title)){
    jsHistoryBackExit("제목(title)을 입력해주세요.");
}


$body = getStrValueOr($_GET['body'], "");
if(empty($body)){
    jsHistoryBackExit("내용(body)을 입력해주세요.");
}



$sqlGetArticle = "
SELECT * FROM article
WHERE id = ${id};
";

$article = DB__getRow($sqlGetArticle);
if($article == null){
    echo "${articleId}번 게시물이 존재하지 않습니다.";
    exit;
}


$sqlModifyArticle = "
UPDATE article
SET regDate = regDate,
updateDate = NOW(),
title = '${title}',
`body`= '${body}';
";

DB__update($sqlModifyArticle);

jsLocationReplaceExit("/usr/article/detail?id=${articleId}", "${articleId}번 게시물이 수정되었습니다.");

?>

\