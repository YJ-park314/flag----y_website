<?php
$sub_menu = '400910';
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, "r");

$g5['title'] = '설치장소관리';
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
                        <th scope="col"><a href="#">코드ID</a></th>
                        <th scope="col"><a href="#">장소명</a></th>
                        <th scope="col"><a href="#">사용여부</a></th>
                        <th scope="col"><a href="#">연락처</a></th>
                        <th scope="col"><a href="#">지역</a></th>
                        <th scope="col"><a href="#">지역ID</a></th>
                        <th scope="col"><a href="#">행선지</a></th>
                        <th scope="col"><a href="#">연결버스</a></th>
                        <th scope="col"><a href="#">터미널명</a></th>
                        <th scope="col"><a href="#">우편번호</a></th>
                        <th scope="col"><a href="#">주소</a></th>
                        <th scope="col"><a href="#">퀵배송업체</a></th>
                        <th scope="col"><a href="#">퀵배송연락처</a></th>
                        <th scope="col"><a href="#">택배회수</a></th>
                        <th scope="col"><a href="#">택배회수업체명</a></th>
                        <th scope="col"><a href="#">구분</a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="chk"></td>
                        <td class="num"></td>
                        <td class="code-id"><input type="text" name="codeId"></td>
                        <td class="place"><input type="text" name="place"></td>
                        <td class="use-status"><input type="text" name="useStatus"></td>
                        <td class="tel"><input type="text" name="tel"></td>
                        <td class="region"><input type="text" name="region"></td>
                        <td class="region-id"><input type="text" name="regioId"></td>
                        <td class="destination"><input type="text" name="destination"></td>
                        <td class="transport"><input type="text" name="transport"></td>
                        <td class="terminal"><input type="text" name="terminal"></td>
                        <td class="zip"><input type="text" name="zip"></td>
                        <td class="addr"><input type="text" name="addr"></td>
                        <td class="delivery-company"><input type="text" name="deliveryCompany"></td>
                        <td class="delivery-tel"><input type="text" name="deliveryTel"></td>
                        <td class="return-status"><input type="text" name="returnStatus"></td>
                        <td class="return-company"><input type="text" name="returnCompany"></td>
                        <td class="classify"><input type="text" name="classify"></td>
                    </tr>
                </tbody>
            </table>
        </form>
        <!-- } -->
    
        <form action="" method="post">
            <table class="cstm-table data-table no-head">
                <caption>설치장소관리 목록</caption>
                <thead>
                    <tr>
                        <th class="chk"></th>
                        <th class="num">No.</th>
                        <th scope="col">코드ID</th>
                        <th scope="col">장소명</th>
                        <th scope="col">사용여부</th>
                        <th scope="col">연락처</th>
                        <th scope="col">지역</th>
                        <th scope="col">지역ID</th>
                        <th scope="col">행선지</th>
                        <th scope="col">연결버스</th>
                        <th scope="col">터미널명</th>
                        <th scope="col">우편번호</th>
                        <th scope="col">주소</th>
                        <th scope="col">퀵배송업체</th>
                        <th scope="col">퀵배송연락처</th>
                        <th scope="col">택배회수</th>
                        <th scope="col">택배회수업체명</th>
                        <th scope="col">구분</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0; $i<20; $i++) { ?>
                    <tr ondblclick="popData();">
                        <td class="chk"><input type="radio" name="listChk" value=""></td>
                        <td class="num"><?php echo $i+1; ?></td>
                        <td class="code-id">1011</td>
                        <td class="place">강릉동인병원</td>
                        <td class="use-status">Y</td>
                        <td class="tel">033-650-6165</td>
                        <td class="region">지방</td>
                        <td class="region-id">040</td>
                        <td class="destination">강릉</td>
                        <td class="transport">분당선/모란역/5번/3-1,500-1,500-2 경안장례식장하차</td>
                        <td class="terminal">동서울>강릉</td>
                        <td class="zip">25440</td>
                        <td class="addr">강원도 강릉시 사천면 방동길 38 강릉아산병원</td>
                        <td class="delivery-company">강릉퀵</td>
                        <td class="delivery-tel">010-1234-1234</td>
                        <td class="return-status">N</td>
                        <td class="return-company">우체국</td>
                        <td class="classify">1</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="crud-btn-wrap">
                <button type="button" onclick="popData();">Add</button>
                <button type="button" onclick="popData();">Edit</button>
            </div>
        </form>
    </div>
</div>

<!-- 팝업 -->
<div class="cstm-pop-container dpnone">
    <div class="inner">
        <div class="tit-area">
            <p>Add Record</p>
            <a href="#" class="close-pop" onclick="closePop();"></a>
        </div>
        <div class="content">
            <form action="" method="post">
                <table>
                    <tbody>
                        <tr>
                            <th scope="row">사용여부</th> 
                            <td>
                                <select name="useStatus" id="useStatus">
                                    <option value="Y">Y</option>
                                    <option value="N">N</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">코드ID</th>
                            <td><input type="text" name="codeId"></td>
                        </tr>
                        <tr>
                            <th scope="row">장소명</th>
                            <td><input type="text" name="place"></td>
                        </tr>
                        <tr>
                            <th scope="row">구분</th>
                            <td><input type="text" name="classify"></td>
                        </tr>
                        <tr>
                            <th scope="row">연락처</th>
                            <td><input type="text" name="tel"></td>
                        </tr>
                        <tr>
                            <th scope="row">행선지</th>
                            <td><input type="text" name="destination"></td>
                        </tr>
                        <tr>
                            <th scope="row">연결버스</th>
                            <td>
                                <textarea name="transport" id="transport"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">택배회수</th>
                            <td>
                                <select name="returnStatus" id="returnStatus">
                                    <option value="N">N</option>
                                    <option value="Y">Y</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">택배업체명</th>
                            <td><input type="text" name="returnCompany"></td>
                        </tr>
                        <tr>
                            <th scope="row">터미널명</th>
                            <td><input type="text" name="terminal"></td>
                        </tr> 
                        <tr>
                            <th scope="row">퀵배송업체</th>
                            <td><input type="text" name="deliveryCompany"></td>
                        </tr>
                        <tr>
                            <th scope="row">퀵배송연락처</th>
                            <td><input type="text" name="deliveryTel"></td>
                        </tr>
                        <tr>
                            <th scope="row">우편번호</th>
                            <td><input type="text" name="zip"></td>
                        </tr>
                        <tr>
                            <th scope="row">주소</th>
                            <td><input type="text" name="addr"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="btn-wrap">
                    <button>Add</button>
                    <button type="button" class="close-pop no-ic" onclick="closePop(this.event);">Cancel</button>
                </div>
            </form>
        </div>
    </div> 
</div>

<script>
    function popData() {
        openPop();
    }
</script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');