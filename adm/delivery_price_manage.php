<?php
$sub_menu = '100600';
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, "r");

$g5['title'] = '배송가격관리';
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
                        <th scope="col"><a href="#">Index</a></th>
                        <th scope="col"><a href="#">상품구분</a></th>
                        <th scope="col"><a href="#">지역</a></th>
                        <th scope="col"><a href="#">가격</a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="chk"></td>
                        <td class="no"></td>
                        <td class="code-id"><input type="text" name="codeId"></td>
                        <td class="prdt-type"><input type="text" name="prdtType"></td>
                        <td class="region"><input type="text" name="region"></td>
                        <td class="price"></td>
                    </tr>
                </tbody>
            </table>
        </form>
        <!-- } -->
    
        <form action="" method="post">
            <table class="cstm-table data-table no-head">
                <caption>배송가격관리 목록</caption>
                <thead>
                    <tr>
                        <th class="chk"></th>
                        <th class="no">No.</th>
                        <th scope="col">Index</th>
                        <th scope="col">상품구분</th>
                        <th scope="col">지역</th>
                        <th scope="col">가격</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0; $i<20; $i++) { ?>
                    <tr ondblclick="popData('edit');">
                        <td class="chk"><input type="radio" name="listChk" id="listChk<?php echo $i+1; ?>" value=""></td>
                        <td class="no"><?php echo $i+1; ?></td>
                        <td class="code-id">1</td>
                        <td class="prdt-type">근조기</td>
                        <td class="region">서울</td>
                        <td class="price">25,000</td>
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
                        <label for="codeNo">코드ID</label>
                        <input type="text" name="codeNo" id="codeNo" placeholder="자동입력">
                    </li>
                    <li class="wide">
                        <label for="prdtType">상품구분</label>
                        <select name="prdtType" id="prdtType" class="wide">
                            <option value="근조기">근조기</option>
                            <option value="경하기">경하기</option>
                            <option value="화환">화환</option>
                            <option value="화환(영정바구니)">화환(영정바구니)</option>
                            <option value="화환(쌀)">화환(쌀)</option>
                            <option value="화환(신화환)">화환(신화환)</option>
                            <option value="화환(오브제형)">화환(오브제형)</option>
                            <option value="상조용품">상조용품</option>
                            <option value="근조기+상조용품">근조기+상조용품</option>
                            <option value="회기(기타)">회기(기타)</option>
                            <option value="회기">회기</option>
                            <option value="용품1박스(300)">용품1박스(300)</option>
                            <option value="용품2박스">용품2박스</option>
                            <option value="근조기+용품1박스(300)">근조기+용품1박스(300)</option>
                            <option value="근조기+용품2박스">근조기+용품2박스</option>
                        </select>
                    </li>
                    <li class="wide">
                        <label for="region">지역</label>
                        <select name="region" id="region" class="wide">
                            <option value="서울">서울</option>
                            <option value="경기/수도권">경기/수도권</option>
                            <option value="경기외곽">경기외곽</option>
                            <option value="지방">지방</option>
                            <option value="제주-제주시">제주-제주시</option>
                            <option value="제주-서귀포">제주-서귀포</option>
                        </select>
                    </li>
                    <li class="wide">
                        <label for="price">가격</label>
                        <input type="text" name="price" id="price">
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
    function popData(type) {
        openPop(type);
    }
</script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');