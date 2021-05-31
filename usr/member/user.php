<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';
?>

<?php

loginCheck();
$memberId = $_SESSION['loginedMemberId'];

$sqlGetMember = "
SELECT * FROM `member`
WHERE id = ${memberId};
";

$member = DB__getRow($sqlGetMember);



?>

<!-- 삭제 버튼 클릭 시, 비밀번호 입력하는 부분 보이게 하는 함수 -->
<script>
  function showInputModify() {
    var text = document.getElementById("LoginPw1");
    var btn = document.getElementById("Btn1");
    if (text.style.display === "none") {
      text.style.display = "block";
      btn.style.display = "block";
    } else {
      text.style.display = "none";
      btn.style.display = "none";
    }
  }
</script>

<script>
  function showInputDelete() {
    var text = document.getElementById("LoginPw2");
    var btn = document.getElementById("Btn2");
    if (text.style.display === "none") {
      text.style.display = "block";
      btn.style.display = "block";
    } else {
      text.style.display = "none";
      btn.style.display = "none";
    }
  }
</script>





<?php 
$loginPage = false;
$pageTitle = "내 정보";
?>
<?php require_once __DIR__ . '/../head.php'?>
<div><a href="../article/list.php">게시물 리스트</a></div>
<hr>
<div>
이름 : <?=$member['name']?><br>
별명 : <?=$member['nickname']?><br>
핸드폰 번호 : <?=$member['cellphoneNo']?><br>
이메일 : <?=$member['email']?>
</div>
<hr>

<div class ="deleteModify">
<button onclick="showInputModify()">정보 수정</button>
<form action="modify.php">
    <input type="password" required placeholder="비밀번호 입력" style="width: 202px; display:none;" id="LoginPw1" name="loginPw">
    <input  type="submit" value="수정페이지로 이동" id="Btn1" style="width: 208px; display:none;">
</form>
</div>
<div>
<button class ="delete" onclick="showInputDelete()">회원 탈퇴</button>

<form action="doQuit.php">
    <input type="password" required placeholder="비밀번호 입력" style="width: 202px; display:none;" id="LoginPw2" name="loginPw">
    <input  onclick="if(!confirm('정말 탈퇴하시겠습니까?')){
    return false;
    }" type="submit" value="회원 탈퇴" id="Btn2" style="width: 208px; display:none;">
</form>

</div>


<?php require_once __DIR__ . '/../foot.php'?>