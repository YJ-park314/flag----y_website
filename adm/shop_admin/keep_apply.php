<?php
$sub_menu = '400950';
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, "r");

$g5['title'] = '깃발보관(단체)신청';
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
                        <th scope="col"><a href="#">신청순</a></th>
                        <th scope="col"><a href="#">신청일자</a></th>
                        <th scope="col"><a href="#">고객명</a></th>
                        <th scope="col"><a href="#">담당자</a></th>
                        <th scope="col"><a href="#">핸드폰</a></th>
                        <th scope="col"><a href="#">이메일</a></th>
                        <th scope="col"><a href="#">메모</a></th>
                        <th scope="col"><a href="#">근조기수량</a></th>
                        <th scope="col"><a href="#">축하기수량</a></th>
                        <th scope="col"><a href="#">할인</a></th>
                        <th scope="col"><a href="#">주문사항</a></th>
                        <th scope="col"><a href="#">회원No</a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="chk"></td>
                        <td class="num"></td>
                        <td class="idx"><input type="text" name="idx"></td>
                        <td class="regi-date"><input type="text" name="regiDate"></td>
                        <td class="user-name"><input type="text" name="inDate1">-<input type="text" name="userName"></td>
                        <td class="charge"><input type="text" name="charge"></td>
                        <td class="hp"><input type="text" name="hp"></td>
                        <td class="mail"><input type="text" name="mail"></td>
                        <td class="memo"><input type="text" name="memo"></td>
                        <td class="flag1-cnt"><input type="text" name="flag1Cnt"></td>
                        <td class="flag2-cnt"><input type="text" name="flag2Cnt"></td>
                        <td class="discount"><input type="text" name="discount"></td>
                        <td class="order-info"><input type="text" name="orderInfo"></td>
                        <td class="user-idx"><input type="text" name="userIdx"></td>
                    </tr>
                </tbody>
            </table>
        </form>
        <!-- } -->
    
        <form action="" method="post">
            <table class="cstm-table data-table no-head">
                <caption>깃발보관(단체)신청 목록</caption>
                <thead>
                    <tr>
                        <th class="chk"></th>
                        <th class="num">No.</th>
                        <th scope="col">신청순</th>
                        <th scope="col">신청일자</th>
                        <th scope="col">고객명</th>
                        <th scope="col">담당자</th>
                        <th scope="col">핸드폰</th>
                        <th scope="col">이메일</th>
                        <th scope="col">메모</th>
                        <th scope="col">근조기수량</th>
                        <th scope="col">축하기수량</th>
                        <th scope="col">할인</th>
                        <th scope="col">주문사항</th>
                        <th scope="col">회원No</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0; $i<20; $i++) { ?>
                    <tr>
                        <td class="chk"><input type="radio" name="listChk" value=""></td>
                        <td class="num"><?php echo $i+1; ?></td>
                        <td class="idx">199</td>
                        <td class="regi-date">20220503</td>
                        <td class="user-name">둔촌고등학교</td>
                        <td class="charge">이민재</td>
                        <td class="hp">010-1234-1234</td>
                        <td class="mail">aaa@naver.com</td>
                        <td class="memo"></td>
                        <td class="flag1-cnt">1개</td>
                        <td class="flag2-cnt"></td>
                        <td class="discount">0</td>
                        <td class="order-info"></td>
                        <td class="user-idx">-999</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="crud-btn-wrap">
                <button type="button">Edit</button>
                <button type="button">Delete</button>
            </div>
        </form>
    </div>
</div> 

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');