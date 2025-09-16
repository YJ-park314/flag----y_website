<?php
$sub_menu = '400930';
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, "r");

$g5['title'] = '상조용품재고조회';
include_once (G5_ADMIN_PATH.'/admin.head.php');
include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');

?>

<div class="tbl_head01 tbl_wrap">
    <div class="tb-container">
        <!-- 테이블 검색 { -->
        <form method="get" class="fixed">
            <table class="cstm-table">
                <caption>검색 영역</caption>
                <thead>
                    <tr>
                        <th class="chk"></th>
                        <th class="num">No.</th>
                        <th scope="col"><a href="#">고객ID</a></th>
                        <th scope="col"><a href="#">고객명</a></th>
                        <th scope="col"><a href="#">입고량</a></th>
                        <th scope="col"><a href="#">출고량</a></th>
                        <th scope="col"><a href="#">기준일재고</a></th>
                        <th scope="col"><a href="#">보관료등록</a></th>
                        <th scope="col"><a href="#">보관료등록량</a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="chk"></td>
                        <td class="num"></td>
                        <td class="user-idx"><input type="text" name="userIdx"></td>
                        <td class="user-name"><input type="text" name="userName"></td>
                        <td class="in-qty"></td>
                        <td class="out-qty"></td>
                        <td class="current-qty"></td>
                        <td class="pay-date"></td>
                        <td class="pay-amount"></td>
                    </tr>
                </tbody>
            </table>
        </form>
        <!-- } -->
    
        <form action="" method="post">
            <table class="cstm-table data-table no-head">
                <caption>상조용품재고조회 목록</caption>
                <thead>
                <tr>
                        <th class="chk"></th>
                        <th class="num">No.</th>
                        <th scope="col">고객ID</th>
                        <th scope="col">고객명</th>
                        <th scope="col">입고량</th>
                        <th scope="col">출고량</th>
                        <th scope="col">기준일재고</th>
                        <th scope="col">보관료등록</th>
                        <th scope="col">보관료등록량</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0; $i<20; $i++) { ?>
                    <tr>
                        <td class="chk"><input type="radio" name="listChk" value=""></td>
                        <td class="num"><?php echo $i+1; ?></td>
                        <td class="user-idx">9013</td>
                        <td class="user-name">엘지생활협력업체(맨파워코리아)</td>
                        <td class="in-qty">99</td>
                        <td class="out-qty">99</td>
                        <td class="current-qty">0</td>
                        <td class="pay-date"></td>
                        <td class="pay-amount"></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="crud-btn-wrap">
                <div class="group">
                    <input type="date">
                    <button type="button">기준조회</button>
                </div>
                <div class="group">
                    <button type="button">Export to Excel</button>
                </div>
            </div>
        </form>
    </div>
</div> 

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');