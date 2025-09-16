<?php
$sub_menu = '400940';
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, "r");

$g5['title'] = '상조용품입고관리';
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
                        <th scope="col"><a href="#">입고No</a></th>
                        <th scope="col"><a href="#">고객명</a></th>
                        <th scope="col"><a href="#">입고일자</a></th>
                        <th scope="col"><a href="#">수량</a></th>
                        <th scope="col"><a href="#">메모</a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="chk"></td>
                        <td class="num"></td>
                        <td class="in-num"><input type="text" name="inNum"></td>
                        <td class="user-name"><input type="text" name="userName"></td>
                        <td class="in-date"><input type="text" name="inDate1">-<input type="text" name="inDate2"></td>
                        <td class="qty"><input type="text" name="qty"></td>
                        <td class="memo"><input type="text" name="memo"></td>
                    </tr>
                </tbody>
            </table>
        </form>
        <!-- } -->
    
        <form action="" method="post">
            <table class="cstm-table data-table no-head">
                <caption>상조용품입고관리 목록</caption>
                <thead>
                    <tr>
                        <th class="chk"></th>
                        <th class="num">No.</th>
                        <th scope="col">입고No</th>
                        <th scope="col">고객명</th>
                        <th scope="col">입고일자</th>
                        <th scope="col">수량</th>
                        <th scope="col">메모</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0; $i<20; $i++) { ?>
                    <tr ondblclick="popData();">
                        <td class="chk"><input type="radio" name="listChk" value=""></td>
                        <td class="num"><?php echo $i+1; ?></td>
                        <td class="in-num">5189</td>
                        <td class="user-name">오리온</td>
                        <td class="in-date">20250206</td>
                        <td class="qty">3</td>
                        <td class="memo">송파입고</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="crud-btn-wrap">
                <button type="button">Add</button>
                <button type="button">Edit</button>
                <button type="button">Delete</button>
            </div>
        </form>
    </div>
</div>

<!-- 팝업 --> 
<div class="pop-container dpnone">
    <div class="inner" style="height: fit-content;">
        <div class="pop-header">
            <p>add record</p>
            <a href="#" class="close-pop" onclick="closePop();"></a>
        </div>
        <form action="" method="post">
            <div class="pop-body">
                <ul class="data-list">
                    <li>
                        <label for="receivingNo">입고No</label>
                        <input type="text" name="receivingNo" id="receivingNo">
                    </li>
                    <li>
                        <label for="receivingDate">입고일자</label>
                        <input type="date" name="receivingDate" id="receivingDate">
                    </li>
                    <li>
                        <label for="customerName">고객(단체)명</label>
                        <input type="text" name="customerName" id="customerName">
                        <button type="button" id="inquiry">조회</button>
                        <input type="text" name="inquiryResult" id="inquiryResult" style="width: 100px;">
                    </li>
                    <li>
                        <label for="receivingQuantity">입고수량</label>
                        <input type="text" name="receivingQuantity" id="receivingQuantity">
                    </li>
                    <li class="wide">
                        <label for="memo">메모</label>
                        <textarea name="memo" id="memo"></textarea>
                    </li>
                </ul>
            </div>
            <div class="pop-footer">
                <button>Add</button>
                <button type="button" class="close-pop no-ic" onclick="closePop(this.event);">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
    function popData() {
        openPop();
    }
</script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');