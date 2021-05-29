<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';


if(!isset($_GET['id'])){
    echo "id를 입력해주세요.";
    exit;
}

$id = intval($_GET['id']);

$sql = "
SELECT * FROM article
WHERE id = ${id};
";

$article = DB__getRow($sql);

if($article == null){
    echo "${id}번 게시물은 존재하지 않습니다.";
    exit;
}

$sqlGetMemberById = "
SELECT * FROM member
WHERE id = ${article['memberId']};
";

$sqlGetBoardById = "
SELECT * FROM board
WHERE id = ${article['boardId']};
";


$member = DB__getRow($sqlGetMemberById);
$board = DB__getRow($sqlGetBoardById);

$memberId = $member['id'];

?>


<!-- 조회수 관련 (시작) -->
<?php    


$articleIndex = strval($article['id']);
$articleStr = "article".$articleIndex;  // articleId에 해당하는 고유 세션명 지정.


if(isset($_SESSION['loginedMemberId']) && !isset($_SESSION['$articleStr']) ){


    // 로그인이 된 상태이고, 조회한 이력이 없을 경우에 조회수가 1 올라간다.
    $sqlAddCount = "
    UPDATE article
    SET `count` = `count`+1
    WHERE id = ${id};
    "; 

    DB__update($sqlAddCount);
    $_SESSION['$articleStr'] = 1; // 로그인한 회원이 해당 article/detail을 조회했을 때, 1로 세팅. 중복 조회수 올리기 불가
    

}else{

            // 빈 값

}



    ?>
    <!-- 조회수 관련 (끝) -->
    <!-- 좋아요 관련 (시작)  -->
    <?php 

        $sqlGetHeart = "
        SELECT digitalCode FROM articleLiked
        WHERE memberId = ${memberId}
        AND articleId = ${id};
        ";

        

        $array = DB__getRow($sqlGetHeart);
        if(!empty($array)){
            
        $heart = $array['digitalCode'];

        }else{
            
            $sqlInsertZero = "
            INSERT INTO articleLiked
            SET memberId = ${memberId},
            articleId = ${id},
            digitalCode = 0;
            ";
            
            mysqli_query($dbConn, $sqlInsertZero);


            $heart = 0;
        }
        

        
    
    
    ?>

    <!-- 좋아요 관련 (시작)  -->

<?php 
$loginPage = true;
$pageTitle = "${id}번 게시물 상세페이지";
?>
<hr>
<?php require_once __DIR__ . "/../head.php";   
?>
<div><a href="list.php">게시물 리스트</a></div>

<hr>
<div>
    번호 : <?=$article['id']?><br>
    게시판 : <?=$board['name']?><br>
    제목 : <?=$article['title']?><br>
    조회수 : <?=$article['count']?><br>
    작성자 : <?=$member['nickname']?><br>
    작성날짜 : <?=$article['regDate']?><br>
    수정날짜 : <?=$article['updateDate']?><br>
    내용 : <?=$article['body']?><br>
    
</div>
<?php if($heart == 1){ ?>
    
    <!-- 값이 1인 경우, 붉은 하트를 보여줄 것 / 클릭 시 0(좋아요 해제)으로 바뀐다. -->
    <a href="liked.php?memberId=<?=$memberId?>&articleId=<?=$id?>&digitalCode=0"><i style="color:red;" class="fas fa-heart"></i></a>

<?php }else{ ?>  
    <!-- 값이 없거나 0인 경우, 회색 하트를 보여줄 것 / 클릭 시 1(좋아요)으로 바뀐다. -->
    <a href="liked.php?memberId=<?=$memberId?>&articleId=<?=$id?>&digitalCode=1"><i class="far fa-heart"></i></a>


<?php        } ?>
<?=$article['liked']?><br>
<hr>

<div>
<a class="modify" href="modify.php?id=<?=$id?>">수정하기</a>
<a class="delete" onClick="if(!confirm('이 게시물을 삭제하시겠습니까?')){return false}" href="doDelete.php?id=<?=$id?>">삭제하기</a>
</div>
<?php require_once __DIR__ . "/../foot.php";   
?>