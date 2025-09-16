<?php
$sub_menu = '400400';
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, "r");

$g5['title'] = '깃발배송주문';
include_once (G5_ADMIN_PATH.'/admin.head.php');
include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php'); 

$where = array();

$doc = isset($_GET['doc']) ? clean_xss_tags($_GET['doc'], 1, 1) : '';
$sort1 = (isset($_GET['sort1']) && in_array($_GET['sort1'], array('od_id', 'od_cart_price', 'od_receipt_price', 'od_cancel_price', 'od_misu', 'od_cash'))) ? $_GET['sort1'] : '';
$sort2 = (isset($_GET['sort2']) && in_array($_GET['sort2'], array('desc', 'asc'))) ? $_GET['sort2'] : 'desc';
$sel_field = (isset($_GET['sel_field']) && in_array($_GET['sel_field'], array('od_id', 'mb_id', 'od_name', 'od_tel', 'od_hp', 'od_b_name', 'od_b_tel', 'od_b_hp', 'od_deposit_name', 'od_invoice')) ) ? $_GET['sel_field'] : ''; 
$od_status = isset($_GET['od_status']) ? get_search_string($_GET['od_status']) : '';
$search = isset($_GET['search']) ? get_search_string($_GET['search']) : '';

$fr_date = (isset($_GET['fr_date']) && preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $_GET['fr_date'])) ? $_GET['fr_date'] : '';
$to_date = (isset($_GET['to_date']) && preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $_GET['to_date'])) ? $_GET['to_date'] : '';

$od_misu = isset($_GET['od_misu']) ? preg_replace('/[^0-9a-z]/i', '', $_GET['od_misu']) : '';
$od_cancel_price = isset($_GET['od_cancel_price']) ? preg_replace('/[^0-9a-z]/i', '', $_GET['od_cancel_price']) : '';
$od_refund_price = isset($_GET['od_refund_price']) ? preg_replace('/[^0-9a-z]/i', '', $_GET['od_refund_price']) : '';
$od_receipt_point = isset($_GET['od_receipt_point']) ? preg_replace('/[^0-9a-z]/i', '', $_GET['od_receipt_point']) : '';
$od_coupon = isset($_GET['od_coupon']) ? preg_replace('/[^0-9a-z]/i', '', $_GET['od_coupon']) : ''; 
$od_settle_case = isset($_GET['od_settle_case']) ? clean_xss_tags($_GET['od_settle_case'], 1, 1) : ''; 
$od_escrow = isset($_GET['od_escrow']) ? clean_xss_tags($_GET['od_escrow'], 1, 1) : ''; 

$tot_itemcount = $tot_orderprice = $tot_receiptprice = $tot_ordercancel = $tot_misu = $tot_couponprice = 0;
$sql_search = "";
if ($search != "") {
    if ($sel_field != "") {
        $where[] = " $sel_field like '%$search%' ";
    }

    if ($save_search != $search) {
        $page = 1;
    }
}

if ($od_status) {
    switch($od_status) {
        case '전체취소':
            $where[] = " od_status = '취소' ";
            break;
        case '부분취소':
            $where[] = " od_status IN('주문', '입금', '준비', '배송', '완료') and od_cancel_price > 0 ";
            break;
        default:
            $where[] = " od_status = '$od_status' ";
            break;
    }

    switch ($od_status) {
        case '주문' :
            $sort1 = "od_id";
            $sort2 = "desc";
            break;
        case '입금' :   // 결제완료
            $sort1 = "od_receipt_time";
            $sort2 = "desc";
            break;
        case '배송' :   // 배송중
            $sort1 = "od_invoice_time";
            $sort2 = "desc";
            break;
    }
}

if ($od_settle_case) {
    if( $od_settle_case === '간편결제' ) {
        $where[] = " od_settle_case in ('간편결제', '삼성페이', 'lpay', 'inicis_kakaopay') ";
    } else {
        $where[] = " od_settle_case = '$od_settle_case' ";
    }
}

if ($od_misu) {
    $where[] = " od_misu != 0 ";
}

if ($od_cancel_price) {
    $where[] = " od_cancel_price != 0 ";
}

if ($od_refund_price) {
    $where[] = " od_refund_price != 0 ";
}

if ($od_receipt_point) {
    $where[] = " od_receipt_point != 0 ";
}

if ($od_coupon) {
    $where[] = " ( od_cart_coupon > 0 or od_coupon > 0 or od_send_coupon > 0 ) ";
}

if ($od_escrow) {
    $where[] = " od_escrow = 1 ";
}

if ($fr_date && $to_date) {
    $where[] = " od_time between '$fr_date 00:00:00' and '$to_date 23:59:59' ";
}

if ($where) {
    $sql_search = ' where '.implode(' and ', $where);
}

if ($sel_field == "")  $sel_field = "od_id";
if ($sort1 == "") $sort1 = "od_id";
if ($sort2 == "") $sort2 = "desc";

$sql_common = " from {$g5['g5_shop_order_table']} $sql_search ";

$sql = " select count(od_id) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql  = " select *,
            (od_cart_coupon + od_coupon + od_send_coupon) as couponprice
           $sql_common
           order by $sort1 $sort2
           limit $from_record, $rows ";
$result = sql_query($sql);

$qstr1 = "od_status=".urlencode($od_status)."&amp;od_settle_case=".urlencode($od_settle_case)."&amp;od_misu=$od_misu&amp;od_cancel_price=$od_cancel_price&amp;od_refund_price=$od_refund_price&amp;od_receipt_point=$od_receipt_point&amp;od_coupon=$od_coupon&amp;fr_date=$fr_date&amp;to_date=$to_date&amp;sel_field=$sel_field&amp;search=$search&amp;save_search=$search";
if($default['de_escrow_use'])
    $qstr1 .= "&amp;od_escrow=$od_escrow"; 
$qstr = "$qstr1&amp;sort1=$sort1&amp;sort2=$sort2&amp;page=$page";

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

// 주문삭제 히스토리 테이블 필드 추가
if(!sql_query(" select mb_id from {$g5['g5_shop_order_delete_table']} limit 1 ", false)) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_order_delete_table']}`
                    ADD `mb_id` varchar(20) NOT NULL DEFAULT '' AFTER `de_data`,
                    ADD `de_ip` varchar(255) NOT NULL DEFAULT '' AFTER `mb_id`,
                    ADD `de_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER `de_ip` ", true);
}

if( function_exists('pg_setting_check') ){
	pg_setting_check(true); 
}
?>

<style>
    .search-wrap{background: #6f809a; margin-bottom: 0; padding-right: 17px;}
    #forderlist .tb-container{margin-top: 0;}
</style>

<div class="local_ov01 local_ov">
    <?php echo $listall; ?>
    <span class="btn_ov01"><span class="ov_txt">전체 주문내역</span><span class="ov_num"> <?php echo number_format($total_count); ?>건</span></span>
    <?php if($od_status == '준비' && $total_count > 0) { ?>
    <a href="./orderdelivery.php" id="order_delivery" class="ov_a">엑셀배송처리</a>
    <?php } ?>
</div>

<form name="frmorderlist" class="local_sch01 local_sch">
    <input type="hidden" name="doc" value="<?php echo $doc; ?>">
    <input type="hidden" name="sort1" value="<?php echo $sort1; ?>">
    <input type="hidden" name="sort2" value="<?php echo $sort2; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="save_search" value="<?php echo $search; ?>">

    <label for="sel_field" class="sound_only">검색대상</label>
    <select name="sel_field" id="sel_field">
        <option value="od_id" <?php echo get_selected($sel_field, 'od_id'); ?>>주문번호</option>
        <option value="mb_id" <?php echo get_selected($sel_field, 'mb_id'); ?>>회원 ID</option>
        <option value="od_name" <?php echo get_selected($sel_field, 'od_name'); ?>>주문자</option>
        <option value="od_tel" <?php echo get_selected($sel_field, 'od_tel'); ?>>주문자전화</option>
        <option value="od_hp" <?php echo get_selected($sel_field, 'od_hp'); ?>>주문자핸드폰</option>
        <option value="od_b_name" <?php echo get_selected($sel_field, 'od_b_name'); ?>>받는분</option>
        <option value="od_b_tel" <?php echo get_selected($sel_field, 'od_b_tel'); ?>>받는분전화</option>
        <option value="od_b_hp" <?php echo get_selected($sel_field, 'od_b_hp'); ?>>받는분핸드폰</option>
        <option value="od_deposit_name" <?php echo get_selected($sel_field, 'od_deposit_name'); ?>>입금자</option>
        <option value="od_invoice" <?php echo get_selected($sel_field, 'od_invoice'); ?>>운송장번호</option>
    </select>

    <label for="search" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="search" value="<?php echo $search; ?>" id="search" required class="required frm_input" autocomplete="off">
    <input type="submit" value="검색" class="btn_submit">
</form>


<form class="local_sch03 local_sch">
    <div>
        <strong>주문상태</strong>
        <input type="radio" name="od_status" value="" id="od_status_all"    <?php echo get_checked($od_status, '');     ?>>
        <label for="od_status_all">전체</label>
        <input type="radio" name="od_status" value="주문" id="od_status_odr" <?php echo get_checked($od_status, '주문'); ?>>
        <label for="od_status_odr">주문</label>
        <input type="radio" name="od_status" value="입금" id="od_status_income" <?php echo get_checked($od_status, '입금'); ?>>
        <label for="od_status_income">입금</label>
        <input type="radio" name="od_status" value="준비" id="od_status_rdy" <?php echo get_checked($od_status, '준비'); ?>>
        <label for="od_status_rdy">준비</label>
        <input type="radio" name="od_status" value="배송" id="od_status_dvr" <?php echo get_checked($od_status, '배송'); ?>>
        <label for="od_status_dvr">배송</label>
        <input type="radio" name="od_status" value="완료" id="od_status_done" <?php echo get_checked($od_status, '완료'); ?>>
        <label for="od_status_done">완료</label>
        <input type="radio" name="od_status" value="전체취소" id="od_status_cancel" <?php echo get_checked($od_status, '전체취소'); ?>>
        <label for="od_status_cancel">전체취소</label>
        <input type="radio" name="od_status" value="부분취소" id="od_status_pcancel" <?php echo get_checked($od_status, '부분취소'); ?>>
        <label for="od_status_pcancel">부분취소</label>
    </div>

    <div>
        <strong>결제수단</strong>
        <input type="radio" name="od_settle_case" value="" id="od_settle_case01"        <?php echo get_checked($od_settle_case, '');          ?>>
        <label for="od_settle_case01">전체</label>
        <input type="radio" name="od_settle_case" value="무통장" id="od_settle_case02"   <?php echo get_checked($od_settle_case, '무통장');    ?>>
        <label for="od_settle_case02">무통장</label>
        <input type="radio" name="od_settle_case" value="가상계좌" id="od_settle_case03" <?php echo get_checked($od_settle_case, '가상계좌');  ?>>
        <label for="od_settle_case03">가상계좌</label>
        <input type="radio" name="od_settle_case" value="계좌이체" id="od_settle_case04" <?php echo get_checked($od_settle_case, '계좌이체');  ?>>
        <label for="od_settle_case04">계좌이체</label>
        <input type="radio" name="od_settle_case" value="휴대폰" id="od_settle_case05"   <?php echo get_checked($od_settle_case, '휴대폰');    ?>>
        <label for="od_settle_case05">휴대폰</label>
        <input type="radio" name="od_settle_case" value="신용카드" id="od_settle_case06" <?php echo get_checked($od_settle_case, '신용카드');  ?>>
        <label for="od_settle_case06">신용카드</label>
        <input type="radio" name="od_settle_case" value="간편결제" id="od_settle_case07" <?php echo get_checked($od_settle_case, '간편결제');  ?>>
        <label for="od_settle_case07" data-tooltip-text="NHN_KCP 간편결제 : PAYCO, 네이버페이, 카카오페이(NHN_KCP), 애플페이(NHN_KCP) &#xa;LG유플러스 간편결제 : PAYNOW &#xa;KG 이니시스 간편결제 : KPAY, 삼성페이, LPAY, 카카오페이(KG이니시스)">PG간편결제</label>
        <input type="radio" name="od_settle_case" value="KAKAOPAY" id="od_settle_case08" <?php echo get_checked($od_settle_case, 'KAKAOPAY');  ?>>
        <label for="od_settle_case08">KAKAOPAY</label>
    </div>

    <div>
        <strong>기타선택</strong>
        <input type="checkbox" name="od_misu" value="Y" id="od_misu01" <?php echo get_checked($od_misu, 'Y'); ?>>
        <label for="od_misu01">미수금</label>
        <input type="checkbox" name="od_cancel_price" value="Y" id="od_misu02" <?php echo get_checked($od_cancel_price, 'Y'); ?>>
        <label for="od_misu02">반품,품절</label>
        <input type="checkbox" name="od_refund_price" value="Y" id="od_misu03" <?php echo get_checked($od_refund_price, 'Y'); ?>>
        <label for="od_misu03">환불</label>
        <input type="checkbox" name="od_receipt_point" value="Y" id="od_misu04" <?php echo get_checked($od_receipt_point, 'Y'); ?>>
        <label for="od_misu04">포인트주문</label>
        <input type="checkbox" name="od_coupon" value="Y" id="od_misu05" <?php echo get_checked($od_coupon, 'Y'); ?>>
        <label for="od_misu05">쿠폰</label>
        <?php if($default['de_escrow_use']) { ?>
        <input type="checkbox" name="od_escrow" value="Y" id="od_misu06" <?php echo get_checked($od_escrow, 'Y'); ?>>
        <label for="od_misu06">에스크로</label>
        <?php } ?>
    </div>

    <div class="sch_last">
        <strong>주문일자</strong>
        <input type="text" id="fr_date"  name="fr_date" value="<?php echo $fr_date; ?>" class="frm_input" size="10" maxlength="10"> ~
        <input type="text" id="to_date"  name="to_date" value="<?php echo $to_date; ?>" class="frm_input" size="10" maxlength="10">
        <button type="button" onclick="javascript:set_date('오늘');">오늘</button>
        <button type="button" onclick="javascript:set_date('어제');">어제</button>
        <button type="button" onclick="javascript:set_date('이번주');">이번주</button>
        <button type="button" onclick="javascript:set_date('이번달');">이번달</button>
        <button type="button" onclick="javascript:set_date('지난주');">지난주</button>
        <button type="button" onclick="javascript:set_date('지난달');">지난달</button>
        <button type="button" onclick="javascript:set_date('전체');">전체</button>
        <input type="submit" value="검색" class="btn_submit">
    </div>
</form>

<div class="tbl_head01 tbl_wrap search-wrap">
    <div class="tb-container">
        <form name="" action="" method="get" class="fixed">
            <table class="cstm-table">
                <caption>검색 영역</caption>
                <thead>
                    <tr>
                        <th class="chk"></th>
                        <th class="num">No.</th>
                        <th scope="col"><a href="#">고객명</a></th>
                        <th scope="col"><a href="#">고객번호</a></th>
                        <th scope="col"><a href="#">보관장소</a></th>
                        <th scope="col"><a href="#">설치요청일</a></th>
                        <th scope="col"><a href="#">상태</a></th>
                        <th scope="col"><a href="#">관계</a></th>
                        <th scope="col"><a href="#">구분</a></th>
                        <th scope="col"><a href="#">장소</a></th>
                        <th scope="col"><a href="#">지역</a></th>
                        <th scope="col"><a href="#">지역오더</a></th>
                        <th scope="col"><a href="#">총금액</a></th>
                        <th scope="col"><a href="#">할인액</a></th>
                        <th scope="col"><a href="#">배송</a></th>
                        <th scope="col"><a href="#">배송일</a></th>
                        <th scope="col"><a href="#">회수</a></th>
                        <th scope="col"><a href="#">회수일</a></th>
                        <th scope="col"><a href="#">메모</a></th>
                        <th scope="col"><a href="#">Box</a></th>
                        <th scope="col"><a href="#">가는경로</a></th>
                        <th scope="col"><a href="#">오더유의</a></th>
                        <th scope="col"><a href="#">등록일</a></th>
                        <th scope="col"><a href="#">특별메모</a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="chk"></td>
                        <td class="num"></td>
                        <td class="user-name"><input type="text" name="usreName"></td>
                        <td class="user-idx"><input type="text" name="userIdx"></td>
                        <td class="keep-place"><input type="text" name="keepPlace"></td>
                        <td class="setup-apply">
                            <input type="date" name="setupApply1"> -
                            <input type="date" name="setupApply2">
                        </td>
                        <td class="status"><input type="text" name="status"></td>
                        <td class="connect-width"><input type="text" name="connectWidth"></td>
                        <td class="classify"><input type="text" name="구분"></td>
                        <td class="place"><input type="text" name="place"></td>
                        <td class="region"><input type="text" name="region"></td>
                        <td class="region-order"><input type="text" name="regionOrder"></td>
                        <td class="total-price"></td>
                        <td class="discount"></td>
                        <td class="delivery"><input type="text" name="delivery"></td>
                        <td class="delivery-date">
                            <input type="date" name="deliveryDate1"> -
                            <input type="date" name="deliveryDate2">
                        </td>
                        <td class="return"><input type="text" name="return"></td>
                        <td class="return-date">
                            <input type="date" name="returnDate1"> -
                            <input type="date" name="returnDate2">
                        </td>
                        <td class="memo">
                            <input type="text" name="memo">
                        </td>
                        <td class="box"></td>
                        <td class="way"></td>
                        <td class="order-info"><input type="text" name="orderInfo"></td>
                        <td class="regi-date"><input type="text" name="regiDate"></td>
                        <td class="extra-memo"><input type="text" name="extraMemo"></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>

<form name="forderlist" id="forderlist" onsubmit="return forderlist_submit(this);" method="post" autocomplete="off">
    <input type="hidden" name="search_od_status" value="<?php echo $od_status; ?>">

    <div class="tbl_head01 tbl_wrap">
        <div class="tb-container">
            <table class="cstm-table data-table no-head">
                <caption>주문 내역 목록</caption>
                <thead>
                    <tr>
                        <th class="chk"></th>
                        <th class="num">No.</th>
                        <th scope="col">고객명</th>
                        <th scope="col">고객번호</th>
                        <th scope="col">보관장소</th>
                        <th scope="col">설치요청일</th>
                        <th scope="col">상태</th>
                        <th scope="col">관계</th>
                        <th scope="col">구분</th>
                        <th scope="col">장소</th>
                        <th scope="col">지역</th>
                        <th scope="col">지역오더</th>
                        <th scope="col">총금액</th>
                        <th scope="col">할인액</th>
                        <th scope="col">배송</th>
                        <th scope="col">배송일</th>
                        <th scope="col">회수</th>
                        <th scope="col">회수일</th>
                        <th scope="col">메모</th>
                        <th scope="col">Box</th>
                        <th scope="col">가는경로</th>
                        <th scope="col">오더유의</th>
                        <th scope="col">등록일</th>
                        <th scope="col">특별메모</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0; $i<20; $i++) { ?>
                    <tr ondblclick="popData();">
                        <td class="chk"><input type="radio" name="listChk" value=""></td>
                        <td class="num"><?php echo $i+1; ?></td>
                        <td class="user-name">한일기술사회</td>
                        <td class="user-idx">2425</td>
                        <td class="keep-place">**가방</td>
                        <td class="setup-apply">20250329</td>
                        <td class="status">확정</td>
                        <td class="connect-width">박성태아들</td>
                        <td class="classify">경하기</td>
                        <td class="place">포항라메르</td>
                        <td class="region">지방</td>
                        <td class="region-order"></td>
                        <td class="total-price">53,000</td>
                        <td class="discount">0</td>
                        <td class="delivery"></td>
                        <td class="delivery-date">1900-01-01</td>
                        <td class="return"></td>
                        <td class="return-date"></td>
                        <td class="memo">톡</td>
                        <td class="box">0</td>
                        <td class="way"></td>
                        <td class="order-info">사진 010-1234-1234</td>
                        <td class="regi-date">2025-02-04 오전 10:49:18</td>
                        <td class="extra-memo"></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="crud-btn-wrap">
                <button type="button" onclick="openPop();">Add</button>
                <button type="button">Edit</button>
                <button type="button">오늘(<?php echo date('Y.m.d') ?>)</button>
                <button type="button">등록일기준(<?php echo date('Y.m.d') ?>)</button>
                <button type="button">돌림처리내역</button>
            </div>
        </div>

        <table id="sodr_list" class="">
        <caption>주문 내역 목록</caption>
        <thead>
        <tr>
            <th scope="col" rowspan="3">
                <label for="chkall" class="sound_only">주문 전체</label>
                <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
            </th>
            <th scope="col" id="th_ordnum" rowspan="2" colspan="2"><a href="<?php echo title_sort("od_id", 1)."&amp;$qstr1"; ?>">주문번호</a></th>
            <th scope="col" id="th_odrer">주문자</th>
            <th scope="col" id="th_odrertel">주문자전화</th>
            <th scope="col" id="th_recvr">받는분</th>
            <th scope="col" rowspan="3">주문합계<br>선불배송비포함</th>
            <th scope="col" rowspan="3">입금합계</th>
            <th scope="col" rowspan="3">주문취소</th>
            <th scope="col" rowspan="3">쿠폰</th>
            <th scope="col" rowspan="3">미수금</th>
            <th scope="col" rowspan="3">보기</th>
        </tr>
        <tr>
            <th scope="col" id="th_odrid">회원ID</th>
            <th scope="col" id="th_odrcnt">주문상품수</th>
            <th scope="col" id="th_odrall">누적주문수</th>
        </tr>
        <tr>
            <th scope="col" id="odrstat">주문상태</th>
            <th scope="col" id="odrpay">결제수단</th>
            <th scope="col" id="delino">운송장번호</th>
            <th scope="col" id="delicom">배송회사</th>
            <th scope="col" id="delidate">배송일시</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i=0; $row=sql_fetch_array($result); $i++)
        {
            // 결제 수단
            $s_receipt_way = $s_br = "";
            if ($row['od_settle_case'])
            {
                $s_receipt_way = check_pay_name_replace($row['od_settle_case'], $row);
                $s_br = '<br />';
            }
            else
            {
                $s_receipt_way = '결제수단없음';
                $s_br = '<br />';
            }

            if ($row['od_receipt_point'] > 0)
                $s_receipt_way .= $s_br."포인트";

            $mb_nick = get_sideview($row['mb_id'], get_text($row['od_name']), $row['od_email'], '');

            $od_cnt = 0;
            if ($row['mb_id'])
            {
                $sql2 = " select count(*) as cnt from {$g5['g5_shop_order_table']} where mb_id = '{$row['mb_id']}' ";
                $row2 = sql_fetch($sql2);
                $od_cnt = $row2['cnt'];
            }

            // 주문 번호에 device 표시
            $od_mobile = '';
            if($row['od_mobile'])
                $od_mobile = '(M)';

            // 주문번호에 - 추가
            switch(strlen($row['od_id'])) {
                case 16:
                    $disp_od_id = substr($row['od_id'],0,8).'-'.substr($row['od_id'],8);
                    break;
                default:
                    $disp_od_id = substr($row['od_id'],0,6).'-'.substr($row['od_id'],6);
                    break;
            }

            // 주문 번호에 에스크로 표시
            $od_paytype = '';
            if($row['od_test'])
                $od_paytype .= '<span class="list_test">테스트</span>';

            if($default['de_escrow_use'] && $row['od_escrow'])
                $od_paytype .= '<span class="list_escrow">에스크로</span>';

            $uid = md5($row['od_id'].$row['od_time'].$row['od_ip']);

            $invoice_time = is_null_time($row['od_invoice_time']) ? G5_TIME_YMDHIS : $row['od_invoice_time'];
            $delivery_company = $row['od_delivery_company'] ? $row['od_delivery_company'] : $default['de_delivery_company'];

            $bg = 'bg'.($i%2);
            $td_color = 0;
            if($row['od_cancel_price'] > 0) {
                $bg .= 'cancel';
                $td_color = 1;
            }
        ?>
        <tr class="orderlist<?php echo ' '.$bg; ?>">
            <td rowspan="3" class="td_chk">
                <input type="hidden" name="od_id[<?php echo $i ?>]" value="<?php echo $row['od_id'] ?>" id="od_id_<?php echo $i ?>">
                <label for="chk_<?php echo $i; ?>" class="sound_only">주문번호 <?php echo $row['od_id']; ?></label>
                <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
            </td>
            <td headers="th_ordnum" class="td_odrnum2" rowspan="2" colspan="2">
                <a href="<?php echo G5_SHOP_URL; ?>/orderinquiryview.php?od_id=<?php echo $row['od_id']; ?>&amp;uid=<?php echo $uid; ?>" class="orderitem"><?php echo $disp_od_id; ?></a>
                <?php echo $od_mobile; ?>
                <?php echo $od_paytype; ?>
            </td>
            <td headers="th_odrer" class="td_name"><?php echo $mb_nick; ?></td>
            <td headers="th_odrertel" class="td_tel"><?php echo get_text($row['od_tel']); ?></td>
            <td headers="th_recvr" class="td_name"><a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?sort1=<?php echo $sort1; ?>&amp;sort2=<?php echo $sort2; ?>&amp;sel_field=od_b_name&amp;search=<?php echo get_text($row['od_b_name']); ?>"><?php echo get_text($row['od_b_name']); ?></a></td>
            <td rowspan="3" class="td_num td_numsum"><?php echo number_format($row['od_cart_price'] + $row['od_send_cost'] + $row['od_send_cost2']); ?></td>
            <td rowspan="3" class="td_num_right"><?php echo number_format($row['od_receipt_price']); ?></td>
            <td rowspan="3" class="td_numcancel<?php echo $td_color; ?> td_num"><?php echo number_format($row['od_cancel_price']); ?></td>
            <td rowspan="3" class="td_num_right"><?php echo number_format($row['couponprice']); ?></td>
            <td rowspan="3" class="td_num_right"><?php echo number_format($row['od_misu']); ?></td>
            <td rowspan="3" class="td_mng td_mng_s">
                <a href="./orderform.php?od_id=<?php echo $row['od_id']; ?>&amp;<?php echo $qstr; ?>" class="mng_mod btn btn_02"><span class="sound_only"><?php echo $row['od_id']; ?> </span>보기</a>
            </td>
        </tr>
        <tr class="<?php echo $bg; ?>">
            <td headers="th_odrid">
                <?php if ($row['mb_id']) { ?>
                <a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?sort1=<?php echo $sort1; ?>&amp;sort2=<?php echo $sort2; ?>&amp;sel_field=mb_id&amp;search=<?php echo $row['mb_id']; ?>"><?php echo $row['mb_id']; ?></a>
                <?php } else { ?>
                비회원
                <?php } ?>
            </td>
            <td headers="th_odrcnt"><?php echo $row['od_cart_count']; ?>건</td>
            <td headers="th_odrall"><?php echo $od_cnt; ?>건</td>
        </tr>
        <tr class="<?php echo $bg; ?>">
            <td headers="odrstat" class="odrstat">
                <input type="hidden" name="current_status[<?php echo $i ?>]" value="<?php echo $row['od_status'] ?>">
                <?php echo $row['od_status']; ?>
            </td>
            <td headers="odrpay" class="odrpay">
                <input type="hidden" name="current_settle_case[<?php echo $i ?>]" value="<?php echo $row['od_settle_case'] ?>">
                <?php echo $s_receipt_way; ?>
            </td>
            <td headers="delino" class="delino">
                <?php if ($od_status == '준비') { ?>
                    <input type="text" name="od_invoice[<?php echo $i; ?>]" value="<?php echo $row['od_invoice']; ?>" class="frm_input" size="10">
                <?php } else {
                    echo ($row['od_invoice'] ? $row['od_invoice'] : '-');
                } ?>
            </td>
            <td headers="delicom">
                <?php if ($od_status == '준비') { ?>
                    <select name="od_delivery_company[<?php echo $i; ?>]">
                        <?php echo get_delivery_company($delivery_company); ?>
                    </select>
                <?php } else {
                    echo ($row['od_delivery_company'] ? $row['od_delivery_company'] : '-');
                } ?>
            </td>
            <td headers="delidate">
                <?php if ($od_status == '준비') { ?>
                    <input type="text" name="od_invoice_time[<?php echo $i; ?>]" value="<?php echo $invoice_time; ?>" class="frm_input" size="10" maxlength="19">
                <?php } else {
                    echo (is_null_time($row['od_invoice_time']) ? '-' : substr($row['od_invoice_time'],2,14));
                } ?>
            </td>
        </tr>
        <?php
            $tot_itemcount     += $row['od_cart_count'];
            $tot_orderprice    += ($row['od_cart_price'] + $row['od_send_cost'] + $row['od_send_cost2']);
            $tot_ordercancel   += $row['od_cancel_price'];
            $tot_receiptprice  += $row['od_receipt_price'];
            $tot_couponprice   += $row['couponprice'];
            $tot_misu          += $row['od_misu'];
        }
        sql_free_result($result);
        if ($i == 0)
            echo '<tr><td colspan="12" class="empty_table">자료가 없습니다.</td></tr>';
        ?>
        </tbody>
        <tfoot>
        <tr class="orderlist">
            <th scope="row" colspan="3">&nbsp;</th>
            <td>&nbsp;</td>
            <td><?php echo number_format($tot_itemcount); ?>건</td>
            <th scope="row">합 계</th>
            <td><?php echo number_format($tot_orderprice); ?></td>
            <td><?php echo number_format($tot_receiptprice); ?></td>
            <td><?php echo number_format($tot_ordercancel); ?></td>
            <td><?php echo number_format($tot_couponprice); ?></td>
            <td><?php echo number_format($tot_misu); ?></td>
            <td></td>
        </tr>
        </tfoot>
        </table>
    </div>

    <div class="local_cmd01 local_cmd">
    <?php if (($od_status == '' || $od_status == '완료' || $od_status == '전체취소' || $od_status == '부분취소') == false) {
        // 검색된 주문상태가 '전체', '완료', '전체취소', '부분취소' 가 아니라면
    ?>
        <label for="od_status" class="cmd_tit">주문상태 변경</label>
        <?php
        $change_status = "";
        if ($od_status == '주문') $change_status = "입금";
        if ($od_status == '입금') $change_status = "준비";
        if ($od_status == '준비') $change_status = "배송";
        if ($od_status == '배송') $change_status = "완료";
        ?>
        <label><input type="checkbox" name="od_status" value="<?php echo $change_status; ?>"> '<?php echo $od_status ?>'상태에서 '<strong><?php echo $change_status ?></strong>'상태로 변경합니다.</label>
        <?php if($od_status == '주문' || $od_status == '준비') { ?>
        <input type="checkbox" name="od_send_mail" value="1" id="od_send_mail" checked="checked">
        <label for="od_send_mail"><?php echo $change_status; ?>안내 메일</label>
        <input type="checkbox" name="send_sms" value="1" id="od_send_sms" checked="checked">
        <label for="od_send_sms"><?php echo $change_status; ?>안내 SMS</label>
        <?php } ?>
        <?php if($od_status == '준비') { ?>
        <input type="checkbox" name="send_escrow" value="1" id="od_send_escrow">
        <label for="od_send_escrow">에스크로배송등록</label>
        <?php } ?>
        <input type="submit" value="선택수정" class="btn_submit" onclick="document.pressed=this.value">
    <?php } ?>
        <?php if ($od_status == '주문') { ?> <span>주문상태에서만 삭제가 가능합니다.</span> <input type="submit" value="선택삭제" class="btn_submit" onclick="document.pressed=this.value"><?php } ?>
    </div>

    <div class="local_desc02 local_desc">
    <p>
        &lt;무통장&gt;인 경우에만 &lt;주문&gt;에서 &lt;입금&gt;으로 변경됩니다. 가상계좌는 입금시 자동으로 &lt;입금&gt;처리됩니다.<br>
        &lt;준비&gt;에서 &lt;배송&gt;으로 변경시 &lt;에스크로배송등록&gt;을 체크하시면 에스크로 주문에 한해 PG사에 배송정보가 자동 등록됩니다.<br>
        <strong>주의!</strong> 주문번호를 클릭하여 나오는 주문상세내역의 주소를 외부에서 조회가 가능한곳에 올리지 마십시오.
    </p>
    </div>

</form>

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
                            <th scope="row">주문번호</th>
                            <td><input type="text" name="orderIdx"> <span>*신규 주문시 자동으로 입력됨.</span></td>
                        </tr>
                        <tr>
                            <th scope="row">설치요청일</th>
                            <td><input type="date" name="setupApply"> <span>*수정시 변경 불가</span> <span>[등록시간] 2025-05-05 오후 5:19:29</span></td>
                        </tr>
                        <tr>
                            <th scope="row">행사시간</th>
                            <td><input type="text" name="eventTime1"></td>
                        </tr>
                        <tr>
                            <th scope="row">주문상태</th>
                            <td>
                                <select name="orderStatus" id="orderStatus">
                                    <option value="삭제">삭제</option>
                                    <option value="접수">접수</option>
                                    <option value="확정">확정</option>
                                    <option value="배송중">배송중</option>
                                    <option value="배송완료">배송완료</option>
                                    <option value="회수중">회수중</option>
                                    <option value="돌림처리">돌림처리</option>
                                    <option value="회수완료">회수완료</option>
                                    <option value="입금완료">입금완료</option>
                                </select>
                                <div class="chk-wrap">
                                    <input type="checkbox" id="printOpt1" name="printOpt">
                                    <label for="printOpt1">원장전표 프린트</label>
                                    <input type="checkbox" id="printOpt2" name="printOpt">
                                    <label for="printOpt2">배송전표 프린트</label>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table>
                    <tbody>
                        <tr>
                            <th scope="row">고객(단체)명</th>
                            <td>
                                <input type="text" name="userName"><button type="button">조회</button>
                                <input type="text" name="userNameEtc"><button type="button">거래내역</button>
                                <button type="button">돌림내역</button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">관계</th>
                            <td>
                                <input type="text" name="connectWidth">
                                <div class="chk-wrap">
                                    <input type="radio" id="connectOpt1">
                                    <label for="connectOpt1">보관료</label>
                                    <input type="radio" id="connectOpt2">
                                    <label for="connectOpt2">금액수정</label>
                                    <input type="radio" id="connectOpt3" name="connectOpt">
                                    <label for="connectOpt3">빈값</label>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table>
                    <tbody>
                        <tr>
                            <th scope="row">배송상품</th>
                            <td>
                                <select name="post-prdt" id="postPrdt">
                                    <option value="010">근조기</option>
                                    <option value="020">경하기</option>
                                    <option value="030">화환</option>
                                    <option value="031">화환(영정바구니)</option>
                                    <option value="032">화환(쌀)</option>
                                    <option value="033">화환(신화환)</option>
                                    <option value="034">화환(오브제형)</option>
                                    <option value="040">상조용품</option>
                                    <option value="050">근조기+상조용품</option>
                                    <option value="060">회기(기타)</option>
                                    <option value="070">회기</option>
                                    <option value="410">용품1박스(300)</option>
                                    <option value="420">용품2박스</option>
                                    <option value="510">근조기+용품1박스(300)</option>
                                    <option value="520">근조기+용품2박스</option>
                                </select>
                                <p>상조용품현재고 : <span></span>개</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">상조용품Box수량</th>
                            <td><input type="text" name="boxCnt"> <p>개로 변경 (신청Box수 : <span></span>개)</p></td>
                        </tr>
                        <tr>
                            <th scope="row">상주(혼주)연락처</th>
                            <td><input type="text" name="hostHp"></td>
                        </tr>
                        <tr>
                            <th scope="row">상주(혼주)연락처</th>
                            <td><input type="text" name="hostHp"></td>
                        </tr>
                        <tr>
                            <th scope="row">발인일자</th>
                            <td><input type="date" name="eventTime2"></td>
                        </tr>
                    </tbody>
                </table>
                <table>
                    <tbody>
                        <tr>
                            <th scope="row">보관장소</th>
                            <td><input type="text" readonly name="keepPlace"></td>
                        </tr>
                        <tr>
                            <th scope="row">설치장소</th>
                            <td><input type="text" name="setupPlace"></td>
                        </tr>
                        <tr>
                            <th scope="row">장소상세</th>
                            <td><input type="text" name="placeDetail"></td>
                        </tr>
                        <tr>
                            <th scope="row">지역</th>
                            <td>
                                <div class="group">
                                    <select name="region" id="region">
                                        <option value="010">서울</option>
                                        <option value="020">경기/수도권</option>
                                        <option value="030">경기외곽</option>
                                        <option value="040">지방</option>
                                        <option value="050">제주-제주시</option>
                                        <option value="060">제주-서귀포</option>
                                    </select>
                                </div>
                                <div class="group">
                                    행선지 : <input type="text" name="goTo">
                                </div>
                                <div class="group">
                                    터미널 : <input type="text" name="terminal">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">지역오더</th>
                            <td>
                                <input type="text" name="regionOrder">
                                <div class="group">
                                    퀵업체 : <input type="text" name="quick">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">택배회수</th>
                            <td>
                                <select name="return" id="return">
                                    <option value="Y">Y</option>
                                    <option value="N">N</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">배송사원</th>
                            <td>
                                <input type="text" name="postWorker"> <button type="button">조회</button>
                                <input type="text" name="ep">
                                <select id="setEp">
                                    <option value="1회차">1회차</option> 
                                    <option value="2회차">2회차</option>
                                    <option value="3회차">3회차</option>
                                    <option value="4회차">4회차</option>
                                </select> <span>회차</span>
                                <select name="postGroup" id="postGroup">
                                    <option value="">선택</option>
                                    <option value="단독">단독</option>
                                    <option value="묶음">묶음</option>
                                </select> <span>배송</span>
                                <button type="button">배송사원 비우기</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table>
                    <tbody>
                        <tr>
                            <th scope="row">오더유의사항</th>
                            <td><input type="text" name="orderInfo"></td>
                        </tr>
                        <tr>
                            <th scope="row">합계금액</th>
                            <td><input type="text" name="totalPrice"></td>
                        </tr>
                        <tr>
                            <th scope="row">배송료</th>
                            <td><input type="text" name="deleveryPrice"> <span>*콤마없이 입력</span> <button type="button">배송료를 합계금액으로 재계산</button></td>
                        </tr>
                        <tr>
                            <th scope="row">관리비</th>
                            <td><input type="text" name="managePrice"></td>
                        </tr>
                        <tr>
                            <th scope="row">DC금액</th>
                            <td><input type="text" name="discountPrice"></td>
                        </tr>
                        <tr>
                            <th scope="row">DC지역</th>
                            <td><input type="text" name="discountRegion" raedonly value="해당없음"></td>
                        </tr>
                    </tbody>
                </table>
                <table>
                    <tbody>
                        <tr>
                            <th scope="row">메모</th>
                            <td><textarea name="memo" id="memo"></textarea></td>
                        </tr>
                        <tr>
                            <th scope="row">특별메모</th>
                            <td><textarea name="extraMemo" id="extraMemo"></textarea></td>
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

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>

<script>
    function popData() {
        openPop();
    }
</script>

<script>
$(function(){
    $("#fr_date, #to_date").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99", maxDate: "+0d" });

    // 주문상품보기
    $(".orderitem").on("click", function() {
        var $this = $(this);
        var od_id = $this.text().replace(/[^0-9]/g, "");

        if($this.next("#orderitemlist").length)
            return false;

        $("#orderitemlist").remove();

        $.post(
            "./ajax.orderitem.php",
            { od_id: od_id },
            function(data) {
                $this.after("<div id=\"orderitemlist\"><div class=\"itemlist\"></div></div>");
                $("#orderitemlist .itemlist")
                    .html(data)
                    .append("<div id=\"orderitemlist_close\"><button type=\"button\" id=\"orderitemlist-x\" class=\"btn_frmline\">닫기</button></div>");
            }
        );

        return false;
    });

    // 상품리스트 닫기
    $("#sodr_list").on("click", "#orderitemlist-x", function(e) {
        $("#orderitemlist").remove();
    });

    $("body").on("click", function(e) {
        if ($(e.target).closest("#orderitemlist").length === 0){
            $("#orderitemlist").remove();
        }
    });

    // 엑셀배송처리창
    $("#order_delivery").on("click", function() {
        var opt = "width=600,height=450,left=10,top=10";
        window.open(this.href, "win_excel", opt);
        return false;
    });
});

function set_date(today)
{
    <?php
    $date_term = date('w', G5_SERVER_TIME);
    $week_term = $date_term + 7;
    $last_term = strtotime(date('Y-m-01', G5_SERVER_TIME));
    ?>
    if (today == "오늘") {
        document.getElementById("fr_date").value = "<?php echo G5_TIME_YMD; ?>";
        document.getElementById("to_date").value = "<?php echo G5_TIME_YMD; ?>";
    } else if (today == "어제") {
        document.getElementById("fr_date").value = "<?php echo date('Y-m-d', G5_SERVER_TIME - 86400); ?>";
        document.getElementById("to_date").value = "<?php echo date('Y-m-d', G5_SERVER_TIME - 86400); ?>";
    } else if (today == "이번주") {
        document.getElementById("fr_date").value = "<?php echo date('Y-m-d', strtotime('-'.$date_term.' days', G5_SERVER_TIME)); ?>";
        document.getElementById("to_date").value = "<?php echo date('Y-m-d', G5_SERVER_TIME); ?>";
    } else if (today == "이번달") {
        document.getElementById("fr_date").value = "<?php echo date('Y-m-01', G5_SERVER_TIME); ?>";
        document.getElementById("to_date").value = "<?php echo date('Y-m-d', G5_SERVER_TIME); ?>";
    } else if (today == "지난주") {
        document.getElementById("fr_date").value = "<?php echo date('Y-m-d', strtotime('-'.$week_term.' days', G5_SERVER_TIME)); ?>";
        document.getElementById("to_date").value = "<?php echo date('Y-m-d', strtotime('-'.($week_term - 6).' days', G5_SERVER_TIME)); ?>";
    } else if (today == "지난달") {
        document.getElementById("fr_date").value = "<?php echo date('Y-m-01', strtotime('-1 Month', $last_term)); ?>";
        document.getElementById("to_date").value = "<?php echo date('Y-m-t', strtotime('-1 Month', $last_term)); ?>";
    } else if (today == "전체") {
        document.getElementById("fr_date").value = "";
        document.getElementById("to_date").value = "";
    }
}
</script>

<script>
function forderlist_submit(f)
{
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    /*
    switch (f.od_status.value) {
        case "" :
            alert("변경하실 주문상태를 선택하세요.");
            return false;
        case '주문' :

        default :

    }
    */

    if(document.pressed == "선택삭제") {
        if(confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            f.action = "./orderlistdelete.php";
            return true;
        }
        return false;
    }

    var change_status = f.od_status.value;

    if (f.od_status.checked == false) {
        alert("주문상태 변경에 체크하세요.");
        return false;
    }

    var chk = document.getElementsByName("chk[]");

    for (var i=0; i<chk.length; i++)
    {
        if (chk[i].checked)
        {
            var k = chk[i].value;
            var current_settle_case = f.elements['current_settle_case['+k+']'].value;
            var current_status = f.elements['current_status['+k+']'].value;

            switch (change_status)
            {
                case "입금" :
                    if (!(current_status == "주문" && current_settle_case == "무통장")) {
                        alert("'주문' 상태의 '무통장'(결제수단)인 경우에만 '입금' 처리 가능합니다.");
                        return false;
                    }
                    break;

                case "준비" :
                    if (current_status != "입금") {
                        alert("'입금' 상태의 주문만 '준비'로 변경이 가능합니다.");
                        return false;
                    }
                    break;

                case "배송" :
                    if (current_status != "준비") {
                        alert("'준비' 상태의 주문만 '배송'으로 변경이 가능합니다.");
                        return false;
                    }

                    var invoice      = f.elements['od_invoice['+k+']'];
                    var invoice_time = f.elements['od_invoice_time['+k+']'];
                    var delivery_company = f.elements['od_delivery_company['+k+']'];

                    if ($.trim(invoice_time.value) == '') {
                        alert("배송일시를 입력하시기 바랍니다.");
                        invoice_time.focus();
                        return false;
                    }

                    if ($.trim(delivery_company.value) == '') {
                        alert("배송업체를 입력하시기 바랍니다.");
                        delivery_company.focus();
                        return false;
                    }

                    if ($.trim(invoice.value) == '') {
                        alert("운송장번호를 입력하시기 바랍니다.");
                        invoice.focus();
                        return false;
                    }

                    break;
            }
        }
    }

    if (!confirm("선택하신 주문서의 주문상태를 '"+change_status+"'상태로 변경하시겠습니까?"))
        return false;

    f.action = "./orderlistupdate.php";
    return true;
}
</script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');