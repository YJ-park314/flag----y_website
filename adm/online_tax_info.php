<?php
$sub_menu = '200920';
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, "r");

$g5['title'] = '전자세금(기본정보)';
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
                        <th scope="col"><a href="#">단체번호(get)</a></th>
                        <th scope="col"><a href="#">고객명</a></th>
                        <th scope="col"><a href="#">상태</a></th>
                        <th scope="col"><a href="#">거래합산(개월)</a></th>
                        <th scope="col"><a href="#">발행시점</a></th>
                        <th scope="col"><a href="#">발행유형</a></th>
                        <th scope="col"><a href="#">발행일</a></th>
                        <th scope="col"><a href="#">발행월</a></th>
                        <th scope="col"><a href="#">거래기간</a></th>
                        <th scope="col"><a href="#">등록일</a></th>
                        <th scope="col"><a href="#">수정일</a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="chk"></td>
                        <td class="num"></td>
                        <td class="user-idx"><input type="text" name="userIdx"></td>
                        <td class="user-name"><input type="text" name="userName"></td>
                        <td class="status">
                            <select name="status" id="status">
                                <option value="전체">전체</option>
                                <option value="사용">사용</option>
                                <option value="미사용">미사용</option>
                            </select>
                        </td>
                        <td class="trans-total">
                            <select name="transTotal" id="transTotal">
                                <option value="전체">전체</option>
                                <option value="1개월">1개월</option>
                                <option value="2개월">2개월</option>
                                <option value="3개월">3개월</option>
                                <option value="4개월">4개월</option>
                                <option value="5개월">5개월</option>
                                <option value="6개월">6개월</option>
                                <option value="7개월">7개월</option>
                                <option value="8개월">8개월</option>
                                <option value="9개월">9개월</option>
                                <option value="10개월">10개월</option>
                                <option value="11개월">11개월</option>
                                <option value="12개월">12개월</option>
                            </select>    
                        </td>
                        <td calss="output-value">
                            <select name="status" id="status">
                                <option value="전체">전체</option>
                                <option value="+0">+0월 발행</option>
                                <option value="+1">+1월 발행</option>
                                <option value="+2">+2월 발행</option>
                                <option value="+3">+3월 발행</option>
                            </select> 
                        </td>
                        <td calss="output-type">
                            <select name="status" id="status">
                                <option value="전체">전체</option>
                                <option value="매달발행">매달발행</option>
                                <option value="매분기발행">매분기발행</option>
                                <option value="매반기">매반기</option>
                                <option value="수시로발행">수시로발행</option>
                                <option value="2개월마다">2개월마다</option>
                            </select> 
                        </td>
                        <td class="output-date"><input type="text" name="outputDate"></td>
                        <td class="output-month"><input type="text" name="outputMonth"></td>
                        <td class="trans-period"></td>
                        <td class="regi-date"></td>
                        <td class="update-date"></td>
                    </tr>
                </tbody>
            </table>
        </form>
        <!-- } -->
    
        <form action="" method="post">
            <table class="cstm-table data-table no-head">
                <caption>전자세금(기본정보) 목록</caption>
                <thead>
                    <tr>
                        <th class="chk"></th>
                        <th class="num">No.</th>
                        <th scope="col"><a href="#">단체번호(get)</a></th>
                        <th scope="col"><a href="#">고객명</a></th>
                        <th scope="col"><a href="#">상태</a></th>
                        <th scope="col"><a href="#">거래합산(개월)</a></th>
                        <th scope="col"><a href="#">발행시점</a></th>
                        <th scope="col"><a href="#">발행유형</a></th>
                        <th scope="col"><a href="#">발행일</a></th>
                        <th scope="col"><a href="#">발행월</a></th>
                        <th scope="col"><a href="#">거래기간</a></th>
                        <th scope="col"><a href="#">등록일</a></th>
                        <th scope="col"><a href="#">수정일</a></th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0; $i<20; $i++) { ?>
                    <tr>
                        <td class="chk"><input type="radio" name="listChk" value=""></td>
                        <td class="num"><?php echo $i+1; ?></td>
                        <td class="user-idx">305</td>
                        <td class="user-name">*대한교통학회(사)</td>
                        <td class="status">사용</td>
                        <td class="trans-total">1개월</td>
                        <td calss="output-value">+1월 발행</td>
                        <td calss="output-type">매달</td>
                        <td class="output-date">06</td>
                        <td class="output-month">01,02,03,04,05,06</td>
                        <td class="trans-period">01~99</td>
                        <td class="regi-date">2022-08-12 오후 12:00:00</td>
                        <td class="update-date">2022-08-12 오후 12:10:00</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="crud-btn-wrap">
                <button type="button">Edit</button>
            </div>
        </form>
    </div>
</div> 

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');