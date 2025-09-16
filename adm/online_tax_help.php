<?php
$sub_menu = '200950';
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, "r");

$g5['title'] = '전자세금(도우미)';
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
                        <th scope="col"><a href="#">작성일자</a></th>
                        <th scope="col"><a href="#">등록번호</a></th>
                        <th scope="col"><a href="#">상호</a></th>
                        <th scope="col"><a href="#">대표자명</a></th>
                        <th scope="col"><a href="#">담당자1</a></th>
                        <th scope="col"><a href="#">회사전화1</a></th>
                        <th scope="col"><a href="#">이메일1</a></th>
                        <th scope="col"><a href="#">핸드폰번호</a></th>
                        <th scope="col"><a href="#">공급가액</a></th>
                        <th scope="col"><a href="#">세액</a></th>
                        <th scope="col"><a href="#">일자1</a></th>
                        <th scope="col"><a href="#">근조기</a></th>
                        <th scope="col"><a href="#">공금가액1</a></th>
                        <th scope="col"><a href="#">현금</a></th>
                        <th scope="col"><a href="#">수표</a></th>
                        <th scope="col"><a href="#">어음</a></th>
                        <th scope="col"><a href="#">외상미수금</a></th>
                        <th scope="col"><a href="#">청구</a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="chk"></td>
                        <td class="num"></td>
                        <td class="regi-date"></td>
                        <td class="regi-num"></td>
                        <td class="trade-name"><input type="text" name="tradeName"></td>
                        <td class="representative"><input type="text" name="representative"></td>
                        <td class="charge"><input type="text" name="charge"></td>
                        <td class="tel"><input type="text" name="tel"></td>
                        <td class="mail"><input type="text" name="mail"></td>
                        <td class="hp"><input type="text" name="hp"></td>
                        <td class="supply-price"></td>
                        <td class="tax-amount"></td>
                        <td class="date"></td>
                        <td class="flag"></td>
                        <td class="supply-price1"></td>
                        <td class="cash"></td>
                        <td class="check"></td>
                        <td class="bill"></td>
                        <td class="misu"></td>
                        <td class="claim"></td>
                    </tr>
                </tbody>
            </table>
        </form>
        <!-- } -->
    
        <form action="" method="post">
            <table class="cstm-table data-table no-head">
                <caption>전자세금(도우미) 목록</caption>
                <thead>
                    <tr>
                        <th class="chk"></th>
                        <th class="num">No.</th>
                        <th scope="col"><a href="#">작성일자</a></th>
                        <th scope="col"><a href="#">등록번호</a></th>
                        <th scope="col"><a href="#">상호</a></th>
                        <th scope="col"><a href="#">대표자명</a></th>
                        <th scope="col"><a href="#">담당자1</a></th>
                        <th scope="col"><a href="#">회사전화1</a></th>
                        <th scope="col"><a href="#">이메일1</a></th>
                        <th scope="col"><a href="#">핸드폰번호</a></th>
                        <th scope="col"><a href="#">공급가액</a></th>
                        <th scope="col"><a href="#">세액</a></th>
                        <th scope="col"><a href="#">일자1</a></th>
                        <th scope="col"><a href="#">근조기</a></th>
                        <th scope="col"><a href="#">공금가액1</a></th>
                        <th scope="col"><a href="#">현금</a></th>
                        <th scope="col"><a href="#">수표</a></th>
                        <th scope="col"><a href="#">어음</a></th>
                        <th scope="col"><a href="#">외상미수금</a></th>
                        <th scope="col"><a href="#">청구</a></th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0; $i<20; $i++) { ?>
                    <tr>
                        <td class="chk"><input type="radio" name="listChk" value=""></td>
                        <td class="num"><?php echo $i+1; ?></td>
                        <td class="regi-date"></td>
                        <td class="regi-num"></td>
                        <td class="trade-name">코리아</td>
                        <td class="representative">강호철</td>
                        <td class="charge">박완</td>
                        <td class="tel">029435883</td>
                        <td class="mail">aaa@naver.com</td>
                        <td class="hp">01012345123</td>
                        <td class="supply-price">123,000</td>
                        <td class="tax-amount">12,300</td>
                        <td class="date">20251230</td>
                        <td class="flag">4</td>
                        <td class="supply-price1"></td>
                        <td class="cash"></td>
                        <td class="check"></td>
                        <td class="bill"></td>
                        <td class="misu"></td>
                        <td class="claim">02</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="crud-btn-wrap">
                <div class="group">
                    <input type="date" name="searchDate1"><input type="date" name="searchDate2">
                    <button type="button">조회</button>
                </div>
                <div class="group">
                    <button type="button">거래출력</button>
                    <button type="button">Excel</button>
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
                    <select name="" id="">
                        <option value="매달">매달</option>
                        <option value="6개월">6개월</option>
                    </select>
                    <select name="" id="">
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