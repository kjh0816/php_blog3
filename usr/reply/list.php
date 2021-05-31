<script>

  function toggleText(i) {
    var text = document.getElementById("modifyReply" + i);
    var modifyBtn = document.getElementById("modifyBtn" + i);
    if (text.style.display == "none") {
      text.style.display = "block";
      modifyBtn.style.display = "block";
    } else {
      text.style.display = "none";
      modifyBtn.style.display = "none";
    }
  }
  </script>

  <?php 
  require_once $_SERVER['DOCUMENT_ROOT']. '/webInit.php';
  ?>

  <?php 
  $sqlGetReplies = "
  SELECT * FROM reply
  WHERE relId = ${articleId}
  ";

  $replies = DB__getRows($sqlGetReplies);
  ?>
  <?php 
  $i = 0;
  ?>
  <?php foreach($replies as $reply){ ?>
    <?php 
      $memberId = $reply['memberId'];
      $articleId = $reply['relId'];
      $replyId = $reply['id'];
      
      ?>


  <!-- 좋아요 관련 (시작)  -->
  <?php 

  $sqlGetReplyHeart = "
  SELECT digitalCode FROM replyLiked
  WHERE memberId = ${memberId}
  AND articleId = ${articleId}
  AND replyId = ${replyId}
  ";



  $replyArray = DB__getRow($sqlGetReplyHeart);
  if(!empty($array)){
      
  $replyHeart = $replyArray['digitalCode'];

  }else{
    
    $sqlReplyInsertZero = "
    INSERT INTO replyLiked
    SET memberId = ${memberId},
    articleId = ${articleId},
    replyId = ${replyId},
    digitalCode = 0;
    ";
    
    mysqli_query($dbConn, $sqlReplyInsertZero);


    $replyHeart = 0;
  }





?>
<!-- 좋아요 관련 (끝))  -->

  <?php 
  $i = $i + 1
  ?>
  <?php
  
    
    $sqlGetMember = "
    SELECT * FROM `member`
    WHERE id = ${memberId}
    ";
    $member = DB__getRow($sqlGetMember);
    
    ?>

    
        작성자: <?=$member['nickname']?><br>
        댓글 : <?=$reply['body']?><br>

        <?php if($replyHeart == 1){ ?>
    
        <!-- 값이 1인 경우, 붉은 하트를 보여줄 것 / 클릭 시 0(좋아요 해제)으로 바뀐다. -->
        <a href="/usr/reply/liked.php?memberId=<?=$reply['memberId']?>&articleId=<?=$reply['relId']?>&replyId=<?=$reply['id']?>&digitalCode=0"><i style="color:red;" class="fas fa-heart"></i></a>

        <?php }else{ ?>  
        <!-- 값이 없거나 0인 경우, 회색 하트를 보여줄 것 / 클릭 시 1(좋아요)으로 바뀐다. -->
        <a href="/usr/reply/liked.php?memberId=<?=$reply['memberId']?>&articleId=<?=$reply['relId']?>&replyId=<?=$reply['id']?>&digitalCode=1"><i class="far fa-heart"></i></a>


        <?php        } ?>
        <?=
        $reply['liked'];
        ?>
        
        <!-- 로그인한 회원이 작성한 댓글일 경우, 댓글 수정/삭제 버튼이 보임. -->
        <?php if($reply['memberId'] == $_SESSION['loginedMemberId'] || $_SESSION['loginedMemberId'] == 1){?>
            <button onclick="toggleText(<?=$i?>)">수정하기</button>
            <button onclick="deleteConfirm('/usr/reply/doDelete.php?id=<?=$reply['id']?>')" class="delete">댓글 삭제</button>
            <form action="/usr/reply/doModify.php">
            <input type="hidden" name="id" value=<?=$reply['id']?>>
            <textarea required placeholder="댓글을 입력해주세요." name="body" id="modifyReply<?=$i?>" style="display: none; width:200px; height: 60px;"></textarea>
            <input id="modifyBtn<?=$i?>" type="submit" value="완료" style="display: none;">
            </form>
        <?php }?>
        <hr>

  <?php } ?>

  

