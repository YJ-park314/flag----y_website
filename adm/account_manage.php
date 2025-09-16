<?php
$sub_menu = '100620';
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, "r");

$g5['title'] = '은행계좌관리';
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
                        <th scope="col"><a href="#">코드NO</a></th>
                        <th scope="col"><a href="#">은행명</a></th>
                        <th scope="col"><a href="#">계좌번호</a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="chk"></td>
                        <td class="no"></td>
                        <td class="code-no"><input type="text" name="codeNo"></td>
                        <td class="bank-name"><input type="text" name="bankName"></td>
                        <td class="account"><input type="text" name="account"></td>
                    </tr>
                </tbody>
            </table>
        </form>
        <!-- } -->
    
        <form action="" method="post">
            <table class="cstm-table data-table no-head">
                <caption>은행계좌관리 목록</caption>
                <thead>
                    <tr>
                        <th class="chk"></th>
                        <th class="no">No.</th>
                        <th scope="col">코드NO</th>
                        <th scope="col">은행명</th>
                        <th scope="col">계좌번호</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0; $i<20; $i++) { ?>
                    <tr ondblclick="popData('edit');">
                        <td class="chk"><input type="radio" name="listChk" id="listChk<?php echo $i+1; ?>" value=""></td>
                        <td class="no"><?php echo $i+1; ?></td>
                        <td class="code-no">2</td>
                        <td class="bank-name">우리</td>
                        <td class="account">1005-800-962902</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="crud-btn-wrap">
                <button type="button" onclick="popData('add');">Add</button>
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
                        <label for="codeNo">코드NO</label>
                        <input type="text" name="codeNo" id="codeNo" placeholder="자동입력">
                    </li>
                    <li class="wide">
                        <label for="bankName">은행</label>
                        <select name="bankName" id="bankName" class="wide">
                            <option value="010">국민</option>
                            <option value="기업">기업</option>
                            <option value="신한">신한</option>
                            <option value="외환">외환</option>
                            <option value="우리">우리</option>
                            <option value="SC제일">SC제일</option>
                            <option value="씨티">씨티</option>
                            <option value="경남">경남</option>
                            <option value="광주">광주</option>
                            <option value="농협">농협</option>
                            <option value="대구">대구</option>
                            <option value="부산">부산</option>
                            <option value="산업">산업</option>
                            <option value="상호저축">상호저축</option>
                            <option value="새마을">새마을</option>
                            <option value="수협">수협</option>
                            <option value="신협">신협</option>
                            <option value="우체국">우체국</option>
                            <option value="전북">전북</option>
                            <option value="제주">제주</option>
                            <option value="HSBC">HSBC</option>
                            <option value="하나">하나</option>
                        </select>
                    </li>
                    <li class="wide">
                        <label for="bankName">계좌번호</label>
                        <input type="text" name="account" id="account">
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