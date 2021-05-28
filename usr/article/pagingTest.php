<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/webInit.php'; // 데이터베이스에 연결

// 현재 페이지 번호 받아오기
if(isset($_GET["page"])){
    $page = $_GET["page"]; // 하단에서 다른 페이지 클릭하면 해당 페이지 값 가져와서 보여줌
} else {
    $page = 1; // 게시판 처음 들어가면 1페이지로 시작
}
?>

<?php 
$loginPage = true;
$pageTitle = "게시물 리스트";
?>

<?php 
require_once __DIR__ . '/../haed.php';
?>

<!-- 실제 게시판 및 페이징 레이아웃에 필요한 부분 시작-->
    <div class="container">
        <br/>              
        <div class="row"> <!-- 메인 글 영역-->
            <div class="col-12" id="content">
                <!-- 게시물 목록 -->
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">번호</th>
                            <th scope="col" class="text-center">제목</th>
                            <th scope="col" class="text-center">작성자</th>
                            <th scope="col" class="text-center">작성일</th>
                            <th scope="col" class="text-center">조회수</th>
                        </tr>
                    </thead>

                    <?php
                    // 페이징 구현                                                                   
                    $sql = mq("SELECT * FROM board");
                    $

                    $sqlGetBoards = "
                    SELECT * FROM article
                    ";
                    $boards = DB__getRows($sqlGetBoards); // 모든 게시물 불러오기
                    
                    $total_record = mysqli_num_rows($boards); // 불러올 게시물 총 갯수 카운트

                    $itemCountInAPage = 10; // 한 페이지에 보여줄 게시물 개수  >> itemCountInAPage
                    $block_cnt = 5; // 하단에 표시할 블록 당 페이지 개수
                    $block_num = ceil($page / $block_cnt); // 현재 페이지 블록
                    $block_start = (($block_num - 1) * $block_cnt) + 1; // 블록의 시작 번호
                    $block_end = $block_start + $block_cnt - 1; // 블록의 마지막 번호

                    $total_page = ceil($total_record / $itemCountInAPage); // 페이징한 페이지 수
                    if($block_end > $total_page){
                        $block_end = $total_page; // 블록 마지막 번호가 총 페이지 수보다 크면 마지막 페이지 번호를 총 페이지 수로 지정함
                    }
                    $total_block = ceil($total_page / $block_cnt); // 블록의 총 개수
                    $page_start = ($page - 1) * $itemCountInAPage; // 페이지의 시작 (SQL문에서 LIMIT 조건 걸 때 사용)

                    // 게시물 목록 가져오기                
                    $sql2 = mq("SELECT * FROM board ORDER BY in_num DESC LIMIT $page_start, $itemCountInAPage"); // $page_start를 시작으로 $list의 수만큼 보여주도록 가져옴                                   
                    
                    while($board = $sql2->fetch_array()){
                        $title=$board["title"];
                        /* 제목 글자수가 30이 넘으면 ... 표시로 처리해주기 */
                        if(strlen($title)>30){
                            $title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
                        }                                
                    ?>

                    <tbody>                                        
                        <tr>                                                                                  
                            <td width="70" class="text-center"><?=$board['num'];?></td>
                            <td width="300">                                            
                                <span class="read_check" style="cursor:pointer" data-action="./read.php?num=<?=$board['num']?>"><?=$title?></span>                            
                            <td width="70" class="text-center"><?=$board["writer"];?></td>
                            <td width="90" class="text-center"><?=$board["wdate"];?></td>
                            <td width="50" class="text-center"><?=$board["views"];?></td>                                            
                        </tr>
                    </tbody>
                    <?php                
                    }                                                                                                            
                    ?>
                </table>

                <!-- 게시물 목록 중앙 하단 페이징 부분-->
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?php
                            if ($page <= 1){
                                // 빈 값
                            } else {
                                if(isset($unum)){
                                    echo "<li class='page-item'><a class='page-link' href='/test/test.php?page=1' aria-label='Previous'>처음</a></li>";
                                } else {
                                    echo "<li class='page-item'><a class='page-link' href='/test/test.php?page=1' aria-label='Previous'>처음</a></li>";
                                }
                            }
                            
                            if ($page <= 1){
                                // 빈 값
                            } else {
                                $pre = $page - 1;
                                if(isset($unum)){
                                    echo "<li class='page-item'><a class='page-link' href='/test/test.php?page=$pre'>◀ 이전 </a></li>";
                                } else {
                                    echo "<li class='page-item'><a class='page-link' href='/test/test.php?page=$pre'>◀ 이전 </a></li>";
                                }
                            }
                            
                            for($i = $block_start; $i <= $block_end; $i++){
                                if($page == $i){
                                    echo "<li class='page-item'><a class='page-link' disabled><b style='color: #df7366;'> $i </b></a></li>";
                                } else {
                                    if(isset($unum)){
                                        echo "<li class='page-item'><a class='page-link' href='/test/test.php?page=$i'> $i </a></li>";
                                    } else {
                                        echo "<li class='page-item'><a class='page-link' href='/test/test.php?page=$i'> $i </a></li>";
                                    }
                                }
                            }
                            
                            if($page >= $total_page){
                                // 빈 값
                            } else {
                                $next = $page + 1;
                                if(isset($unum)){
                                    echo "<li class='page-item'><a class='page-link' href='/test/test.php?page=$next'> 다음 ▶</a></li>";
                                } else {
                                    echo "<li class='page-item'><a class='page-link' href='/test/test.php?page=$next'> 다음 ▶</a></li>";
                                }
                            }
                            
                            if($page >= $total_page){
                                // 빈 값
                            } else {
                                if(isset($unum)){
                                    echo "<li class='page-item'><a class='page-link' href='/test/test.php?page=$total_page'>마지막</a>";
                                } else {
                                    echo "<li class='page-item'><a class='page-link' href='/test/test.php?page=$total_page'>마지막</a>";
                                }
                            }
                        ?>                                        
                    </ul>                                                                  
                </nav>               
            </div>                                            
        </div>                                                                    
    </div>
<!-- 실제 게시판 및 페이징 레이아웃에 필요한 부분 끝-->
      
</body>
</html>








