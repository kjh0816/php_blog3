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
require_once __DIR__ . '/../head.php';
?>



<!-- 실제 게시판 및 페이징 레이아웃에 필요한 부분 시작-->
 
    

                    

                    <?php
                    // 페이징 구현                                                                   
                    // $sql = mq("SELECT * FROM board");
                    
                    

                    $dbConn = mysqli_connect("127.0.0.1", "jhmysql", "1234", "php_blog");

                    $sqlGetAllArticles = "
                    SELECT * FROM article
                    ";
                    
                    

                    $allArticles = mysqli_query($dbConn, $sqlGetAllArticles);// 모든 게시물 불러오기
                    
                    $total_record = mysqli_num_rows($allArticles); // 불러올 게시물 총 갯수 카운트
                    $itemCountInAPage = 5; // 한 페이지에 보여줄 게시물 개수  >> itemCountInAPage
                    $block_cnt = 5; // 한 블록에 표시할 페이지 번호 갯수
                    $block_num = ceil($page / $block_cnt); // 현재 페이지가 해당하는 블록 
                    // 현재 페이지가 5씩 넘어갈 때마다 한 블록씩 넘어간다.
                    $block_start = (($block_num - 1) * $block_cnt) + 1; // 블록 내, 페이지 시작 번호
                    // 현재 블록이 1이면, 블록 시작번호 = 1 , 2이면 , 시작번호 = 6
                    $block_end = $block_start + $block_cnt - 1; // 블록의 마지막 번호
                    // 1~5 / 6~10 ...

                    $total_page = ceil($total_record / $itemCountInAPage); // 게시물 갯수에 따른 총 페이지 수
                    if($block_end > $total_page){
                        $block_end = $total_page; // 블록 마지막 번호가 총 페이지 수보다 크면 마지막 페이지 번호를 총 페이지 수로 지정함
                    }
                    $total_block = ceil($total_page / $block_cnt); // 블록의 총 개수
                    $article_start = ($page - 1) * $itemCountInAPage; // 페이지의 시작 (SQL문에서 LIMIT 조건 걸 때 사용)

                    // itemCountInAPage만큼의 게시물 가져오기
                    $sqlGetArticles = "
                    SELECT * FROM article
                    ORDER BY id DESC
                    LIMIT $article_start, $itemCountInAPage;
                    ";
                    $queryGetArticles = mysqli_query($dbConn ,$sqlGetArticles);
                    // mysqli_fetch_assoc()을 하지 않고, 데이터를 가공해서 배열에 담을 예정
                    // $article_start를 시작으로 $itemCountInAPage의 수만큼 보여주도록 가져옴 

                    ?>
                    
                    

                    
                    
                    



                    <?php 

                    
                    

                    // 페이징 단계에서 보여줄 형태로 가공해서 배열에 담는다.
                    while($article = $queryGetArticles -> fetch_array()){
                        $title=$article['title'];
                        /* 제목 글자수가 30이 넘으면 ... 표시로 처리해주기 */
                        if(strlen($title) > 30){
                            $title=str_replace($article['title'],mb_substr($article['title'], 0, 30, "utf-8")."...", $article['title']);
                        }  
                        
                        
                        // 여기서 memberId, boardId로 값 얻어내서 아래에 합류시킬 것.
                        
                        $memberId = $article['memberId'];
                        $boardId = $article['boardId'];
                        $articleId = $article['id'];

                        $sqlGetMember = "
                        SELECT * FROM `member`
                        WHERE id = ${memberId};
                        ";
                        
                        
                        $sqlGetBoard = "
                        SELECT * FROM board
                        WHERE id = ${boardId};
                        ";

                        $sqlGetReplyCount = "
                        SELECT * FROM reply
                        WHERE relId = ${articleId};
                        ";


                        $board = DB__getRow($sqlGetBoard);
                        $member = DB__getRow($sqlGetMember);

                        $queryGetReplyCount = mysqli_query($dbConn, $sqlGetReplyCount);
                        $replyCount = mysqli_num_rows($queryGetReplyCount);
                        
                    ?>


                <nav class="line">
                <a href="detail.php?id=<?=$articleId?>" class="article_section">
                    <div>번호: <?=$article['id']?></div>
                    <div>
                        <div>제목: <?=$article['title']?> <span style="color:blue;">(<?=$replyCount?>)</span></div>
                        <div>
                            <div>게시판: <?=$board['name']?></div>
                            <div>작성날짜: <?=$article['regDate']?></div>
                            <div>작성자: <?=$member['nickname']?></div>
                            <div>조회수: <?=$article['count']?></div>
                    </div>
                    </div>
                </a>
                </nav>
                <hr>
                    

                    
                    <?php                
                    }                                                                                                            
                    ?>
                </table>

                <!-- 게시물 목록 중앙 하단 페이징 부분-->
                <nav  class="page-items-cover">
                    <ul  class="page-items row">
                        <?php
                            if ($page <= 1){
                                // 빈 값
                            } else {
                                echo "<li class='page-item cell'><a class='page-link' href='/usr/article/list.php?page=1' aria-label='Previous'><b style='color:blue;'>처음</b></a></li>";
                            }
                            
                            if ($page <= 1){
                                // 빈 값
                            } else {
                                $pre = $page - 1;
                                echo "<li class='page-item cell'><a class='page-link' href='/usr/article/list.php?page=$pre'><b style='color:blue;'>◀이전</b></a></li>";
                            }
                            
                            for($i = $block_start; $i <= $block_end; $i++){
                                if($page == $i){
                                    echo "<li class='page-item cell'><a disabled><b style='color: black; font-size:20px;'> $i </b></a></li>";
                                } else {
                                    echo "<li class='page-item cell'><a href='/usr/article/list.php?page=$i'><b style='color:blue;'> ($i) </b></a></li>";
                                }
                            }
                            
                            if($page >= $total_page){
                                // 빈 값
                            } else {
                                $next = $page + 1;
                                echo "<li class='page-item cell'><a class='page-link' href='/usr/article/list.php?page=$next'><b style='color:blue;'> 다음▶</b></a></li>";
                            }
                            
                            if($page >= $total_page){
                                // 빈 값
                            } else {
                                echo "<li class='page-item cell'><a class='page-link' href='/usr/article/list.php?page=$total_page'><b style='color:blue;'>마지막</b></a>";
                            }
                        ?>                                        
                    </ul>                                                                  
                </nav>               
            </div>                                            
        </div>                                                                    
    </div>
    <br>
    <br>
    <br>
<!-- 실제 게시판 및 페이징 레이아웃에 필요한 부분 끝-->
      
<?php 
require_once __DIR__.'/../foot.php';
?>








