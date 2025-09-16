<?php
$sub_menu = '200910';
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, "r");

$g5['title'] = '고객(단체)관리';
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
                        <th scope="col"><a href="#">계약일자</a></th>
                        <th scope="col"><a href="#">고객명</a></th>
                        <th scope="col"><a href="#">깃발보관위치</a></th>
                        <th scope="col"><a href="#">가방Y/박스N</a></th>
                        <th scope="col"><a href="#">담당자</a></th>
                        <th scope="col"><a href="#">핸드폰</a></th>
                        <th scope="col"><a href="#">메모</a></th>
                        <th scope="col"><a href="#">삭제</a></th>
                        <th scope="col"><a href="#">근조기수량</a></th>
                        <th scope="col"><a href="#">축하기수량</a></th>
                        <th scope="col"><a href="#">할인</a></th>
                        <th scope="col"><a href="#">주문사항</a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="chk"></td>
                        <td class="no"></td>
                        <td class="customer-no"><input type="text" name="customerNo"></td>
                        <td class="contract-date"><input type="text" name="contractDate"></td>
                        <td class="customer-name"><input type="text" name="customerName"></td>
                        <td class="flag-location"><input type="text" name="flagLocation"></td>
                        <td class="bagy-boxn">
                            <select name="bagyboxn" id="bagyboxn">
                                <option value="">선택</option>
                                <option value="Y">가방(Y)</option>
                                <option value="N">박스(N)</option>
                            </select>
                        </td>
                        <td class="manager"><input type="text" name="manager"></td>
                        <td class="hp"><input type="text" name="hp"></td>
                        <td class="memo"><input type="text" name="memo"></td>
                        <td class="del"><input type="text" name="del"></td>
                        <td class="flag1-quantity"><input type="text" name="flag1Quantity"></td>
                        <td class="flag2-quantity"><input type="text" name="flag2Quantity"></td>
                        <td class="discount"><input type="text" name="discount"></td>
                        <td class="order-details"><input type="text" name="orderDetails"></td>
                    </tr>
                </tbody>
            </table>
        </form>
        <!-- } -->
    
        <form action="" method="post">
            <table class="cstm-table data-table no-head">
                <caption>고객(단체)관리 목록</caption>
                <thead>
                    <tr>
                        <th class="chk"></th>
                        <th class="no">No.</th>
                        <th scope="col">고객No</th>
                        <th scope="col">계약일자</th>
                        <th scope="col">고객명</th>
                        <th scope="col">깃발보관위치</th>
                        <th scope="col">가방(Y/N)</th>
                        <th scope="col">담당자</th>
                        <th scope="col">핸드폰</th>
                        <th scope="col">메모</th>
                        <th scope="col">삭제</th>
                        <th scope="col">근조기수량</th>
                        <th scope="col">축하기수량</th>
                        <th scope="col">할인</th>
                        <th scope="col">주문사항</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0; $i<20; $i++) { ?>
                    <tr ondblclick="popData();">
                        <td class="chk"><input type="radio" name="listChk" id="listChk<?php echo $i+1; ?>" value=""></td>
                        <td class="no"><?php echo $i+1; ?></td>
                        <td class="customer-no">11854</td>
                        <td class="contract-date">202-02-06</td>
                        <td class="customer-name">서울대법대24</td>
                        <td class="flag-location">신규제작</td>
                        <td class="bagy-boxn"></td>
                        <td class="manager">도재성</td>
                        <td class="hp">010-1234-1234</td>
                        <td class="memo">내부/금술 도재성 010-1234-1234</td>
                        <td class="del">N</td>
                        <td class="flag1-quantity">1</td>
                        <td class="flag2-quantity"></td>
                        <td class="discount">0</td>
                        <td class="order-details">설치사진필</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="crud-btn-wrap">
                <button type="button" onclick="popData('add');">Add</button>
                <button type="button" onclick="popData('edit');">Edit</button> 
                <button>Delete</button>
            </div>
        </form>
    </div>
</div>

<!-- 팝업 -->
<div class="pop-container dpnone">
    <div class="inner">
        <div class="pop-header">
            <p>add record</p>
            <a href="#" class="close-pop" onclick="closePop();"></a>
        </div>
        <form action="" method="post">
            <div class="pop-body">
                <ul class="data-list">
                    <li class="wide">
                        <label for="useStatus">사용여부</label>
                        <select name="useStatus" id="useStatus">
                            <option value="사용함">사용함</option>
                            <option value="사용안함">사용안함</option>
                        </select>
                    </li>
                    <li>
                        <label for="customerNo">단체번호</label>
                        <input type="text" placeholder="자동입력" id="customerNo" name="customerNo">
                        <button type="button">깃발사진조회</button>
                    </li>
                    <li>
                        <label for="tel1">전화번호</label>
                        <input type="text" name="tel1" id="tel1" class="wd3"> -
                        <input type="text" name="tel2" id="tel2" class="wd3"> -
                        <input type="text" name="tel3" id="tel3" class="wd3"> 
                    </li>
                    <li>
                        <label for="customerName">단체명</label>
                        <input type="text" name="customerName" id="customerName">
                    </li>
                    <li>
                        <label for="hp1">대표핸드폰</label>
                        <input type="text" name="hp1" id="hp1" class="wd3"> -
                        <input type="text" name="hp2" id="hp2" class="wd3"> -
                        <input type="text" name="hp3" id="hp3" class="wd3">
                    </li>
                    <li>
                        <label for="contractDate">계약일자</label>
                        <input type="date" name="contractDate" id="contractDate">
                    </li>
                    <li>
                        <label for="faxNum">팩스번호</label>
                        <input type="text" name="faxNum1" id="faxNum1" class="wd3"> -
                        <input type="text" name="faxNum2" id="faxNum2" class="wd3"> -
                        <input type="text" name="faxNum3" id="faxNum3" class="wd3">
                    </li>
                </ul>
                <ul class="data-list">
                    <li class="guide">*사업장 정보는 선택사항입니다.</li>
                    <li>
                        <label for="corporationName">법인명</label>
                        <input type="text" id="corporationName" name="corporationName">
                    </li>
                    <li>
                        <label for="businessNumber">사업자번호</label>
                        <input type="text" id="businessNumber" name="businessNumber" placeholder="하이픈(-)없이 입력">
                    </li>
                    <li>
                        <label for="representative">대표자</label>
                        <input type="text" id="representative" name="representative">
                    </li>
                    <li>
                        <label for="business">종목</label>
                        <input type="text" id="business" name="business">
                    </li>
                    <li>
                        <label for="businesAddr">사업장주소</label>
                        <input type="text" id="businesAddr" name="businesAddr">
                    </li>
                    <li>
                        <label for="businesState">업태</label>
                        <input type="text" id="businesState" name="businesState">
                    </li>
                </ul>
                <ul class="data-list">
                    <li>
                        <label for="manager1">담당자1</label>
                        <input type="text" id="manager1" name="manager1">
                    </li>
                    <li>
                        <label for="manager2">담당자2</label>
                        <input type="text" id="manager2" name="manager2">
                    </li>
                    <li>
                        <label for="hp1">담당자 HP</label>
                        <select name="hp1" id="hp1" class="wd3">
                            <option value="010">010</option>
                            <option value="011">011</option>
                            <option value="016">016</option>
                            <option value="017">017</option>
                            <option value="018">018</option>
                            <option value="019">019</option>
                            <option value="0130">0130</option>
                        </select> -
                        <input type="text" name="hp2" id="hp2" class="wd3"> -
                        <input type="text" name="hp3" id="hp3" class="wd3">
                    </li>
                    <li>
                        <label for="tel1">담당자 연락처</label>
                        <input type="text" name="tel1" id="tel1" class="wd3"> -
                        <input type="text" name="tel2" id="tel2" class="wd3"> -
                        <input type="text" name="tel3" id="tel3" class="wd3">
                    </li>
                    <li>
                        <label for="flag1Quantity">근조기수량</label>
                        <input type="text" id="flag1Quantity" name="flag1Quantity">
                    </li>
                    <li>
                        <label for="flag2Quantity">경하기수량</label>
                        <input type="text" id="flag2Quantity" name="flag2Quantity">
                    </li>
                    <li class="wide">
                        <label for="orderDetails">오더유의사항</label>
                        <input type="text" id="orderDetails" name="orderDetails">
                    </li>
                </ul>
                <ul class="data-list">
                    <li class="wide">
                        <label for="zip">우편번호</label>
                        <input type="text" id="zip" name="zip">
                    </li>
                    <li class="wide">
                        <label for="addr1">주소</label>
                        <input type="text" id="addr1" name="addr1">
                        <input type="text" id="addr2" name="addr2">
                    </li>
                    <li class="wide">
                        <label for="mail1">메일주소</label>
                        <input type="text" id="mail1" name="mail1"> @
                        <input type="text" id="mail2" name="mail2">
                        <select name="mailDom" id="mailDom">
                            <option value="직접입력">직접입력</option>
                            <option value="hanmail.net">hanmail.net</option>
                            <option value="daum.net">daum.net</option>
                            <option value="naver.com">naver.com</option>
                            <option value="hotmail.com">hotmail.com</option>
                            <option value="nate.com">nate.com</option>
                            <option value="korea.com">korea.com</option>
                            <option value="gmail.com">gmail.com</option>
                        </select>
                    </li>
                    <li class="wide">
                        <label for="memo">메모</label>
                        <textarea name="memo" id="memo"></textarea>
                    </li>
                </ul>
                <ul class="data-list">
                    <li class="guide">*고객 추가정보</li>
                    <li>
                        <label for="bank">거래은행</label>
                        <select name="bank" id="bank">
                            <option value="선택">선택</option>
                            <option value="국민515501-01-096888">국민515501-01-096888</option>
                            <option value="신한140-007-725544">신한140-007-725544</option>
                            <option value="우리1005-800-962902">우리1005-800-962902</option>
                            <option value="농협100028-55-001537">농협100028-55-001537</option>
                            <option value="하나235-910008-66904">하나235-910008-66904</option>
                        </select>
                    </li>
                    <li>
                        <label for="aidPrdtManage">상조용품</label>
                        <ul class="chk-group">
                            <li><input type="checkbox" id="aidPrdtManage" name="aidPrdtManage"> <label for="aidPrdtManage">상조용품 관리</label></li>
                        </ul>
                    </li>
                    <li>
                        <label for="dcRegion1">DC지역</label>
                        <ul class="chk-group">
                            <li><input type="checkbox" id="dcRegion1" name="dcRegion" value="서울"> <label for="dcRegion1">서울</label></li>
                            <li><input type="checkbox" id="dcRegion2" name="dcRegion" value="경기"> <label for="dcRegion2">경기</label></li>
                            <li><input type="checkbox" id="dcRegion3" name="dcRegion" value="경기외곽"> <label for="dcRegion3">경기외곽</label></li>
                            <li><input type="checkbox" id="dcRegion4" name="dcRegion" value="지방"> <label for="dcRegion4">지방</label></li>
                            <li><input type="checkbox" id="dcRegion5" name="dcRegion" value="제주"> <label for="dcRegion5">제주</label></li>
                            <li><input type="checkbox" id="dcRegion6" name="dcRegion" value="제주(서귀포)"> <label for="dcRegion6">제주(서귀포)</label></li>
                        </ul>
                    </li>
                    <li>
                        <label for="receiptStatus1">수신여부</label>
                        <ul class="chk-group">
                            <li><input type="checkbox" id="receiptStatus1" name="receiptStatus" value="세금계산서발행"> <label for="receiptStatus1">세금계산서발행</label></li>
                            <li><input type="checkbox" id="receiptStatus2" name="receiptStatus" value="문자발송"> <label for="receiptStatus2">문자발송</label></li>
                            <li><input type="checkbox" id="receiptStatus3" name="receiptStatus" value="메일"> <label for="receiptStatus3">메일</label></li>
                            <li><input type="checkbox" id="receiptStatus4" name="receiptStatus" value="팩스"> <label for="receiptStatus4">팩스</label></li>
                            <li><input type="checkbox" id="receiptStatus5" name="receiptStatus" value="우편발송"> <label for="receiptStatus5">우편발송</label></li>
                        </ul>
                    </li>
                    <li>
                        <label for="dcPrice">DC금액</label>
                        <input type="text" id="dcPrice" name="dcPrice">원
                    </li>
                    <li>
                        <label for="groupKey">단체 키</label>
                        <input type="text" id="groupKey" name="groupKey">
                    </li>
                </ul>
                <ul class="data-list">
                    <li class="guide">*깃발보관 위치 및 보관유형</li>
                    <li>
                        <label for="flagLocation">깃발보관위치</label>
                        <input type="text" name="flagLocation" id="flagLocation">
                    </li>
                    <li>
                        <label for="flagLocation">가방/박스</label>
                        <ul class="chk-group">
                            <li><input type="radio" id="bagyboxn1" name="bagyboxn" value="가방"> <label for="bagyboxn1">가방</label></li>
                            <li><input type="radio" id="bagyboxn2" name="bagyboxn" value="박스"> <label for="bagyboxn2">박스</label></li>
                        </ul>
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
    function popData(type) { // type = edit || add
        openPop(type);
    }
</script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');