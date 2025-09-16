<?php
$sub_menu = '200960';
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, "r");

$g5['title'] = '전자세금(발행)관리';
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
                        <th scope="col"><a href="#">순번</a></th>
                        <th scope="col"><a href="#">단체번호</a></th>
                        <th scope="col"><a href="#">공급받는자</a></th>
                        <th scope="col"><a href="#">작성일자</a></th>
                        <th scope="col"><a href="#">발행유형</a></th>
                        <th scope="col"><a href="#">거래시작</a></th>
                        <th scope="col"><a href="#">거래종료</a></th>
                        <th scope="col"><a href="#">발행상태</a></th>
                        <th scope="col"><a href="#">전송상태</a></th>
                        <th scope="col"><a href="#">리턴코드</a></th>
                        <th scope="col"><a href="#">리턴결과값</a></th>
                        <th scope="col"><a href="#">전송일시</a></th>
                        <th scope="col"><a href="#">승인번호</a></th>
                        <th scope="col"><a href="#">등록번호</a></th>
                        <th scope="col"><a href="#">공급가액(合)</a></th>
                        <th scope="col"><a href="#">부가세액(合)</a></th>
                        <th scope="col"><a href="#">청구금액</a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="chk"></td>
                        <td class="num"></td>
                        <td class="sort-num"></td>
                        <td class="user-idx"><input type="text" name="userIdx"></td>
                        <td class="output-charge"><input type="text" name="outputCharge"></td>
                        <td class="regi-date"><input type="text" name="regiDate"></td>
                        <td class="output-type">
                            <select name="outputType" id="outputType">
                                <option value="">전체</option>
                                <option value="매달발행">매달발행</option>
                                <option value="매분기발행">매분기발행</option>
                                <option value="매반기">매반기</option>
                                <option value="수시로발행">수시로발행</option>
                                <option value="2개월마다">2개월마다</option>
                            </select>
                        </td>
                        <td class="trade-start"></td>
                        <td class="trade-end"></td>
                        <td class="output-status"><input type="text" name="outputStatus"></td>
                        <td class="trans-status"></td>
                        <td class="return-code"></td>
                        <td class="return-result"></td>
                        <td class="return-date"></td>
                        <td class="accept-num"></td>
                        <td class="apply-num"></td>
                        <td class="supply-price"></td>
                        <td class="tax-price"></td>
                        <td class="bill-price"></td>
                    </tr>
                </tbody>
            </table>
        </form>
        <!-- } -->
    
        <form action="" method="post">
            <table class="cstm-table data-table no-head">
                <caption>전자세금(발행)관리 목록</caption>
                <thead>
                    <tr>
                        <th class="chk"></th>
                        <th class="num">No.</th>
                        <th scope="col">순번</th>
                        <th scope="col">단체번호</th>
                        <th scope="col">공급받는자</th>
                        <th scope="col">작성일자</th>
                        <th scope="col">발행유형</th>
                        <th scope="col">거래시작</th>
                        <th scope="col">거래종료</th>
                        <th scope="col">발행상태</th>
                        <th scope="col">전송상태</th>
                        <th scope="col">리턴코드</th>
                        <th scope="col">리턴결과값</th>
                        <th scope="col">전송일시</th>
                        <th scope="col">승인번호</th>
                        <th scope="col">등록번호</th>
                        <th scope="col">공급가액(合)</th>
                        <th scope="col">부가세액(合)</th>
                        <th scope="col">청구금액</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0; $i<20; $i++) { ?>
                    <tr>
                        <td class="chk"><input type="radio" name="listChk" value=""></td>
                        <td class="num"><?php echo $i+1; ?></td>
                        <td class="sort-num">11</td>
                        <td class="user-idx">9074</td>
                        <td class="output-charge">김웅</td>
                        <td class="regi-date">2022-06-30</td>
                        <td class="output-type">매달</td>
                        <td class="trade-start">2022-06-01</td>
                        <td class="trade-end">2022-06-30</td>
                        <td class="output-status">CREATED</td>
                        <td class="trans-status"></td>
                        <td class="return-code"></td>
                        <td class="return-result"></td>
                        <td class="return-date"></td>
                        <td class="accept-num"></td>
                        <td class="apply-num"></td>
                        <td class="supply-price">627000</td>
                        <td class="tax-price">62700</td>
                        <td class="bill-price">689700</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="crud-btn-wrap">
                <button type="button">Edit</button>
                <button type="button">Delete</button>
                <button type="button">임시저장(팝빌)</button>
                <button type="button">팝빌->국세청전송</button>
            </div>
        </form>
    </div>
</div> 

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');