<?php
$sub_menu = '200940';
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, "r");

$g5['title'] = '미회수 깃발조회';
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
                        <th scope="col"><a href="#">번호</a></th>
                        <th scope="col"><a href="#">고객명</a></th>
                        <th scope="col"><a href="#">설치일자</a></th>
                        <th scope="col"><a href="#">발인일자</a></th>
                        <th scope="col"><a href="#">상태</a></th>
                        <th scope="col"><a href="#">구분</a></th>
                        <th scope="col"><a href="#">설치장소</a></th>
                        <th scope="col"><a href="#">주소</a></th>
                        <th scope="col"><a href="#">연락처</a></th>
                        <th scope="col"><a href="#">지역</a></th>
                        <th scope="col"><a href="#">지역상세</a></th>
                        <th scope="col"><a href="#">행선지</a></th>
                        <th scope="col"><a href="#">보관장소</a></th>
                        <th scope="col"><a href="#">배송</a></th>
                        <th scope="col"><a href="#">회수</a></th>
                        <th scope="col"><a href="#">회수일</a></th>
                        <th scope="col"><a href="#">택배회수</a></th>
                        <th scope="col"><a href="#">메모</a></th>
                        <th scope="col"><a href="#">장소상세</a></th>
                        <th scope="col"><a href="#">상주연락처</a></th>
                        <th scope="col"><a href="#">오더유의</a></th>
                        <th scope="col"><a href="#">돌림(수)처리</a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="chk"></td>
                        <td class="num"></td>
                        <td class="idx"><input type="text" name="idx"></td>
                        <td class="user-name"><input type="text" name="userName"></td>
                        <td class="setup-date"><input type="date" name="setupDate1"> - <input type="date" name="setupDate2"></td>
                        <td class="use-date"><input type="date" name="useDate1"> - <input type="date" name="useDate2"></td>
                        <td class="status"><input type="text" name="status"></td>
                        <td class="classify"><input type="text" name="classify"></td>
                        <td class="setup-place"><input type="text" name="setupPlace"></td>
                        <td class="addr"><input type="text" name="addr"></td>
                        <td class="tel"><input type="text" name="tel"></td>
                        <td class="region"><input type="text" name="region"></td>
                        <td class="region-detail"><input type="text" name="regionDetail"></td>
                        <td class="destination"><input type="text" name="destination"></td>
                        <td class="keep-place"><input type="text" name="keepPlace"></td>
                        <td class="post"><input type="text" name="post"></td>
                        <td class="return"><input type="text" name="return"></td>
                        <td class="return-date"><input type="date" name="returnDate1"> - <input type="date" name="returnDate2"></td>
                        <td class="post-return"><input type="text" name="postRreturn"></td>
                        <td class="memo"><input type="text" name="memo"></td>
                        <td class="addr-detail"></td>
                        <td class="charge-hp"></td>
                        <td class="order-info"><input type="text" name="orderInfo"></td>
                        <td class="return-cnt"></td>
                    </tr>
                </tbody>
            </table>
        </form>
        <!-- } -->
    
        <form action="" method="post">
            <table class="cstm-table data-table no-head">
                <caption>미회수 깃발조회 목록</caption>
                <thead>
                    <tr>
                        <th class="chk"></th>
                        <th class="num">No.</th>
                        <th scope="col">번호</th>
                        <th scope="col">고객명</th>
                        <th scope="col">설치일자</th>
                        <th scope="col">발인일자</th>
                        <th scope="col">상태</th>
                        <th scope="col">구분</th>
                        <th scope="col">설치장소</th>
                        <th scope="col">주소</th>
                        <th scope="col">연락처</th>
                        <th scope="col">지역</th>
                        <th scope="col">지역상세</th>
                        <th scope="col">행선지</th>
                        <th scope="col">보관장소</th>
                        <th scope="col">배송</th>
                        <th scope="col">회수</th>
                        <th scope="col">회수일</th>
                        <th scope="col">택배회수</th>
                        <th scope="col">메모</th>
                        <th scope="col">장소상세</th>
                        <th scope="col">상주연락처</th>
                        <th scope="col">오더유의</th>
                        <th scope="col">돌림(수)처리</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0; $i<20; $i++) { ?>
                    <tr>
                        <td class="chk"><input type="radio" name="listChk" value=""></td>
                        <td class="num"><?php echo $i+1; ?></td>
                        <td class="idx">564958</td>
                        <td class="user-name">이종철</td>
                        <td class="setup-date">20250131</td>
                        <td class="use-date">20250201</td>
                        <td class="status">배송중</td>
                        <td class="classify">근조기</td>
                        <td class="setup-place">고대안암병원</td>
                        <td class="addr"></td>
                        <td class="tel">031-123-1234</td>
                        <td class="region">서울</td>
                        <td class="region-detail"></td>
                        <td class="destination"></td>
                        <td class="keep-place">가-206</td>
                        <td class="post">이병헌</td>
                        <td class="return"></td>
                        <td class="return-date"></td>
                        <td class="post-return">N</td>
                        <td class="memo">톡</td>
                        <td class="addr-detail">1호</td>
                        <td class="charge-hp">010-1234-1234</td>
                        <td class="order-info">신규</td>
                        <td class="return-cnt">0</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </form>
    </div>
</div> 

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');