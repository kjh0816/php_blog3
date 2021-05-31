<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';
?>

<?php

loginCheck();

if(!isset($_GET['id'])){
    echo "게시물 번호(id)가 존재하지 않습니다.";
    exit;
}

$id = $_GET['id'];


if(!isset($_GET['title'])){
    echo "제목(title)을 입력해주세요.";
    exit;
}

$title = $_GET['title'];


if(!isset($_GET['body'])){
    echo "내용(body)을 입력해주세요.";
    exit;
}

$body = $_GET['body'];


$sqlGetArticle = "
SELECT * FROM article
WHERE id = ${id};
";

$article = DB__getRow($sqlGetArticle);
if($article == null){
    echo "${id}번 게시물이 존재하지 않습니다.";
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

?>

<script>
alert('<?=$id?>번 게시물이 수정되었습니다.');
location.replace('detail.php?id=<?=$id?>');
</script>