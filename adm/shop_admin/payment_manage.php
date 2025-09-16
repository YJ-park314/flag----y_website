<?php
$sub_menu = '400900';
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, "r");

$g5['title'] = '고객결제(입금)관리';
include_once (G5_ADMIN_PATH.'/admin.head.php');
include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');

?>

<div class="tbl_head01 tbl_wrap">
    <div class="tb-container">
        <form method="get" class="fixed">
        <!-- 테이블 검색 { -->
            <table class="cstm-table">
                <caption>검색 영역</caption>
                <thead>
                    <tr>
                        <th class="chk dpnone"></th>
                        <th class="num">No.</th>
                        <th scope="col"><a href="#">입금번호</a></th>
                        <th scope="col"><a href="#">고객ID</a></th>
                        <th scope="col"><a href="#">고객명</a></th>
                        <th scope="col"><a href="#">입금일자</a></th>
                        <th scope="col"><a href="#">입금액</a></th>
                        <th scope="col"><a href="#">배분합계</a></th>
                        <th scope="col"><a href="#">배분</a></th>
                        <th scope="col"><a href="#">주문NO</a></th>
                        <th scope="col"><a href="#">메모</a></th>
                        <th scope="col"><a href="#">전표번호</a></th>
                        <th scope="col"><a href="#">작업자</a></th>
                        <th scope="col"><a href="#">주문번호</a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="chk dpnone"></td>
                        <td class="num"></td>
                        <td class="deposit-num"><input type="text" name="depositNum"></td>
                        <td class="user-id"><input type="text" name="userId"></td>
                        <td class="user-name"><input type="text" name="userName"></td>
                        <td class="deposit-date"><input type="text" name="depositDate"></td>
                        <td class="deposit-price"><input type="text" name="depositPrice"></td>
                        <td class="allotments-sum"><input type="text" name="allotmentsSum"></td>
                        <td class="allotments"><input type="text" name="allotments"></td>
                        <td class="order-no"><input type="text" name="orderNo"></td>
                        <td class="memo"><input type="text" name="memo"></td>
                        <td class="slip-num"><input type="text" name="slipNum"></td>
                        <td class="worker"><input type="text" name="worker"></td>
                        <td class="order-num"><input type="text" name="orderNum"></td>
                    </tr>
                </tbody>
            </table>
        </form>
        <!-- } -->
    
        <form action="" method="post">
            <table class="cstm-table data-table no-head">
                <caption>고객결제관리 목록</caption>
                <thead>
                    <tr>
                        <th class="chk dpnone"></th>
                        <th class="num">No.</th>
                        <th scope="col">입금번호</th>
                        <th scope="col">고객ID</th>
                        <th scope="col">고객명</th>
                        <th scope="col">입금일자</th>
                        <th scope="col">입금액</th>
                        <th scope="col">배분합계</th>
                        <th scope="col">배분</th>
                        <th scope="col">주문NO</th>
                        <th scope="col">메모</th>
                        <th scope="col">전표번호</th>
                        <th scope="col">작업자</th>
                        <th scope="col">주문번호</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0; $i<20; $i++) { ?>
                    <tr ondblclick="popData();">
                        <td class="chk dpnone"><input type="radio" name="listChk" value=""></td>
                        <td class="num"><?php echo $i+1; ?></td>
                        <td class="deposit-num">509741</td>
                        <td class="user-id">5914</td>
                        <td class="user-name">진도지산중14회</td>
                        <td class="deposit-date">20250206</td>
                        <td class="deposit-price">48,000</td>
                        <td class="allotments-sum">48,000</td>
                        <td class="allotments">48,000</td>
                        <td class="order-no">250124100</td>
                        <td class="memo">진도지산중14회</td>
                        <td class="slip-num">211921</td>
                        <td class="worker">[ys4051]</td>
                        <td class="order-num">564188</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="crud-btn-wrap">
                <button type="button">Add</button>
                <button type="button">Edit</button>
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
                        <label for="depositNum">입금번호</label>
                        <input type="text" name="depositNum" id="depositNum">
                    </li>
                    <li>
                        <label for="slipNum">전표번호</label>
                        <input type="text" name="slipNum" id="slipNum">
                    </li>
                    <li class="wide wrap">
                        <label for="depositDate">입금일자</label>
                        <input type="date" name="depositDate" id="depositDate">
                        <p>*수정시 입금일만 수정가능 (같은 전표번호 모두 변경됨)</p>
                    </li> 
                    <li class="wide">
                        <label for="customerName">고객(단체)명</label>
                        <input type="text" name="userName" id="userName">
                        <button type="button">조회</button>
                        <input type="text" name="userDetail" id="userDetail">
                        <button type="button">조회상세</button>
                    </li>
                    <li>
                        <label for="currentPrice">현재잔액</label>
                        <input type="text" name="currentPrice">
                    </li>
                    <li>
                        <label for="allotmentsSum">배분후잔액</label>
                        <input type="text" name="allotmentsSum" id="allotmentsSum">
                    </li>
                    <li class="wide wrap">
                        <label for="depositPrice">입금액</label>
                        <input type="text" name="depositPrice" id="depositPrice">
                        <span>*콤마 없이 입력</span>
                        <input type="checkbox" name="afterDeposit" id="afterDeposit"> <label for="afterDeposit" class="fit">(무조건입금처리)</label>
                    </li>
                    <li>
                        <label for="allotments">배분금액</label>
                        <input type="text" name="allotments" id="allotments">
                    </li>
                    <li class="wide">
                        <label for="faxNum">처리갯수 확인</label>
                        <p>총 갯수 : <span class="proCnt">0</span></p>
                        <p>선택(처리) 갯수 : <span class="selCnt">0</span></p>
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