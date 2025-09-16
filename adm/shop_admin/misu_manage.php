<?php
$sub_menu = '400920';
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, "r");

$g5['title'] = '미수금관리';
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
                        <th scope="col"><a href="#">이전미수금액</a></th>
                        <th scope="col"><a href="#">설치(기간)합계</a></th>
                        <th scope="col"><a href="#">입금(기간)합계</a></th>
                        <th scope="col"><a href="#">미수잔액</a></th>
                        <th scope="col"><a href="#">설치(전체)합계</a></th>
                        <th scope="col"><a href="#">입금(전체)합계</a></th>
                        <th scope="col"><a href="#">현미수잔액</a></th>
                        <th scope="col"><a href="#">현잔고</a></th>
                        <th scope="col"><a href="#">최종합계액</a></th>
                        <th scope="col"><a href="#">세금</a></th>
                        <th scope="col"><a href="#">팩스</a></th>
                        <th scope="col"><a href="#">메일</a></th>
                        <th scope="col"><a href="#">우편</a></th>
                        <th scope="col"><a href="#">문자</a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="chk"></td>
                        <td class="num"></td>
                        <td class="user-idx"><input type="text" name="userIdx"></td>
                        <td class="user-name"><input type="text" name="userName"></td>
                        <td class="prev-misu"></td>
                        <td class="setup-sum"></td>
                        <td class="deposit-sum"></td>
                        <td class="misu-price"></td>
                        <td class="setup-total"></td>
                        <td class="deposit-total"></td>
                        <td class="current-misu"></td>
                        <td class="current-balance"></td>
                        <td class="total"></td>
                        <td class="tax"><input type="text" name="tax"></td>
                        <td class="fax"><input type="text" name="fax"></td>
                        <td class="mail"><input type="text" name="mail"></td>
                        <td class="post"><input type="text" name="post"></td>
                        <td class="msg"><input type="text" name="msg"></td>
                    </tr>
                </tbody>
            </table>
        </form>
        <!-- } -->
    
        <form action="" method="post">
            <table class="cstm-table data-table no-head">
                <caption>미수금관리 목록</caption>
                <thead>
                    <tr>
                    <th class="chk"></th>
                        <th class="num">No.</th>
                        <th scope="col">고객ID</th>
                        <th scope="col">고객명</th>
                        <th scope="col">이전미수금액</th>
                        <th scope="col">설치(기간)합계</th>
                        <th scope="col">입금(기간)합계</th>
                        <th scope="col">미수잔액</th>
                        <th scope="col">설치(전체)합계</th>
                        <th scope="col">입금(전체)합계</th>
                        <th scope="col">현미수잔액</th>
                        <th scope="col">현잔고</th>
                        <th scope="col">최종합계액</th>
                        <th scope="col">세금</th>
                        <th scope="col">팩스</th>
                        <th scope="col">메일</th>
                        <th scope="col">우편</th>
                        <th scope="col">문자</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0; $i<20; $i++) { ?>
                    <tr>
                        <td class="chk"><input type="radio" name="listChk" value=""></td>
                        <td class="num"><?php echo $i+1; ?></td>
                        <td class="user-idx">6425</td>
                        <td class="user-name">(103)성균관대ROTC22기</td>
                        <td class="prev-misu">0</td>
                        <td class="setup-sum">38,000</td>
                        <td class="deposit-sum">38,000</td>
                        <td class="misu-price">0</td>
                        <td class="setup-total">2,010,000</td>
                        <td class="deposit-total">2,010,000</td>
                        <td class="current-misu">0</td>
                        <td class="current-balance">0</td>
                        <td class="total">0</td>
                        <td class="tax">Y</td>
                        <td class="fax"></td>
                        <td class="mail"></td>
                        <td class="post"></td>
                        <td class="msg">Y</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="crud-btn-wrap">
                <div class="group">
                    <input type="date"> ~ <input type="date">
                    <button type="button">조회</button>
                </div>
                <div class="group">
                    <button type="button">거래출력</button>
                    <button type="button">Excel</button>
                    <button type="button">Fax</button>
                </div>
                <div class="group">
                    <button type="button">청구(기간내)출력</button>
                    <button type="button">Excel</button>
                </div>
                <div class="group">
                    <button type="button">청구(이전미입금)출력</button>
                    <button type="button">Excel</button>
                    <button type="button">Email 청구확인</button>
                </div>
                <div class="group">
                    <select name="monthSet" id="monthSet">
                        <option value="매달">매달</option>
                        <option value="6개월">6개월</option>
                    </select>
                    <select name="monthSet" id="monthSet">
                        <option value="세금">세금</option>
                        <option value="팩스">팩스</option>
                        <option value="이메일">이메일</option>
                        <option value="우편">우편</option>
                        <option value="문자">문자</option>
                    </select>
                    <button type="button">전체출력</button>
                    <button type="button">Excel</button>
                    <button type="button">Fax</button>
                    <button type="button">Email</button>
                    <button type="button">Sms</button>
                </div>
            </div>
        </form>
    </div>
</div> 

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');