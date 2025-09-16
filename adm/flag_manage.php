<?php
$sub_menu = '200930';
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, "r");

$g5['title'] = '고객(단체)깃발관리';
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
                        <th class="no">No.</th>
                        <th scope="col"><a href="#">고객No</a></th>
                        <th scope="col"><a href="#">고객명</a></th>
                        <th scope="col"><a href="#">깃발보관위치</a></th>
                        <th scope="col"><a href="#">가방Y/박스N</a></th>
                        <th scope="col"><a href="#">근조기수량</a></th>
                        <th scope="col"><a href="#">축하기수량</a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="chk"></td>
                        <td class="no"></td>
                        <td class="customer-no"><input type="text" name="customerNo"></td>
                        <td class="customer-name"><input type="text" name="customerName"></td>
                        <td class="flag-location"><input type="text" name="flagLocation"></td>
                        <td class="bagyboxn">
                            <select name="bagYBoxN" id="bagYBoxN">
                                <option value="">선택</option>
                                <option value="Y">가방(Y)</option>
                                <option value="N">박스(N)</option>
                            </select>
                        </td>
                        <td class="flag1-quantity"><input type="text" name="flag1Quantity"></td>
                        <td class="flag2-quantity"><input type="text" name="flag2Quantity"></td>
                    </tr>
                </tbody>
            </table>
        </form>
        <!-- } -->
    
        <form action="" method="post">
            <table class="cstm-table data-table no-head">
                <caption>고객(단체)깃발관리 목록</caption>
                <thead>
                    <tr>
                        <th class="chk"></th>
                        <th class="no">No.</th>
                        <th scope="col">고객No</th>
                        <th scope="col">고객명</th>
                        <th scope="col">깃발보관위치</th>
                        <th scope="col">가방(Y/N)</th>
                        <th scope="col">근조기수량</th>
                        <th scope="col">축하기수량</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0; $i<20; $i++) { ?>
                    <tr ondblclick="popData('edit');">
                        <td class="chk"><input type="radio" name="listChk" id="listChk<?php echo $i+1; ?>" value=""></td>
                        <td class="no"><?php echo $i+1; ?></td>
                        <td class="customer-no">11854</td>
                        <td class="customer-name">서울대법대24</td>
                        <td class="flag-location">신규제작</td>
                        <td class="bagyboxn"></td>
                        <td class="flag1-quantity">1</td>
                        <td class="flag2-quantity"></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="crud-btn-wrap">
                <button type="button" onclick="popData('edit');">Edit</button>
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
                    <li class="wide">
                        <label for="customerNo">단체번호</label>
                        <input type="text" name="customerNo" id="customerNo">
                    </li>
                    <li class="wide">
                        <label for="customerName">단체명</label>
                        <input type="text" name="customerName" id="customerName">
                    </li>
                    <li>
                        <label for="flag1Quantity">근조기수량</label>
                        <input type="text" name="flag1Quantity" id="flag1Quantity"> 개
                    </li>
                    <li>
                        <label for="flag2Quantity">축하기수량</label>
                        <input type="text" name="flag2Quantity" id="flag2Quantity"> 개
                    </li>
                    <li class="guide">*깃발보관 위치 및 보관유형</li>
                    <li class="wide">
                        <label for="categoryType">깃발보관위치</label>
                        <input type="text" name="categoryType" id="categoryType">
                    </li>
                    <li>
                        <label for="bagYBoxN1">가방/박스</label>
                        <ul class="chk-group">
                            <li><input type="radio" value="가방" name="bagYBoxN" id="bagYBoxN1"> <label for="bagYBoxN1">가방</label></li>
                            <li><input type="radio" value="가방" name="bagYBoxN" id="bagYBoxN2"> <label for="bagYBoxN2">박스</label></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="pop-footer">
                <button>수정</button>
                <button type="button" class="close-pop no-ic" onclick="closePop(this.event);">취소</button>
            </div>
        </form>
    </div>
</div>

<script>
    function popData(type) { // type = edit || add
        openPop(type);
    }
</script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');