<?php

// Mysql CRUD 관련 함수 (시작)
function DB__getRow($sql) {
  global $dbConn;
  $rs = mysqli_query($dbConn, $sql);
  $row = mysqli_fetch_assoc($rs);

  return $row;
}

function DB__getRows($sql) {
  global $dbConn;
  $rs = mysqli_query($dbConn, $sql);

  $rows = [];

  while ( $row = mysqli_fetch_assoc($rs) ) {
    $rows[] = $row;
  }

  return $rows;
}

function DB__insert($sql) {
  global $dbConn;
  mysqli_query($dbConn, $sql);

  return mysqli_insert_id($dbConn);
}

function DB__update($sql) {
  global $dbConn;
  mysqli_query($dbConn, $sql);
}

function DB__delete($sql) {
  global $dbConn;
  mysqli_query($dbConn, $sql);
}

// Mysql CRUD 관련 함수 (끝)


// INPUT값 검사 및 결과에 따른 페이지 이동 처리 함수 (시작)

function getIntValueOr(&$value, $defaultValue) {
  if ( isset($value) ) {
    return intval($value);
  }

  return $defaultValue;
}

function getStrValueOr(&$value, $defaultValue) {
  if ( isset($value) ) {
    return strval($value);
  }

  return $defaultValue;
}

function jsAlert($msg) {
  echo "<script>";
  echo "alert('${msg}');";
  echo "</script>";
}

function jsLocationReplaceExit($url, $msg = null) {
  if ( $msg ) {
    jsAlert($msg);
  }

  echo "<script>";
  echo "location.replace('${url}')";
  echo "</script>";
  exit;
}

function jsHistoryBackExit($msg = null) {
  if ( $msg ) {
    jsAlert($msg);
  }

  echo "<script>";
  echo "history.back();";
  echo "</script>";
  exit;
}

// INPUT값 검사 및 결과에 따른 페이지 이동 처리 함수 (끝) 
?>

<!-- 권한 관련 함수 (시작) -->


<?php function loginCheck(){ 

  if(!isset($_GET['loginedMemberId'])){  ?>
    <?php if(!isset($_SESSION['loginedMemberId'])){ ?>
      <script>
      alert('로그인 후 이용해주세요.');
      location.replace('/usr/member/login.php');
      </script>
      
  <?php }
  }
}
?>


<!-- 권한 관련 함수 (끝) -->





<!-- 자바 스크립트 관련 함수 (시작) -->
<script>
function deleteConfirm(url){
    if(confirm('삭제하시겠습니까?')){
      location.replace(url);
    }else{
      return false;
    }
}
</script>
<!-- 자바 스크립트 관련 함수 (끝) -->