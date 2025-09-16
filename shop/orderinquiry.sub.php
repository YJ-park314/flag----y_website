<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if (!defined("_ORDERINQUIRY_")) exit; // 개별 페이지 접근 불가

// 테마에 orderinquiry.sub.php 있으면 include
if(defined('G5_THEME_SHOP_PATH')) {
    $theme_inquiry_file = G5_THEME_SHOP_PATH.'/orderinquiry.sub.php';
    if(is_file($theme_inquiry_file)) {
        include_once($theme_inquiry_file);
        return;
        unset($theme_inquiry_file);
    }
}
?>

<!-- 비주얼 -->
<?php 
	$vis_id = 'myhistory';
    $vis_name = '주문내역';
    $vis_desc = '주문한 깃발의 내역을 확인할 수 있습니다.';
    include_once(G5_THEME_PATH.'/component/visual.php');
?>

<!-- 주문 내역 목록 시작 { -->
<?php if (!$limit) { ?>총 <?php echo $cnt; ?> 건<?php } ?>

<article id="myHistory" class="tbl_head03 tbl_wrap wrap mypage">
    <h2 class="sound_only">주문내역 본문영역</h2>
    <!-- 사이드 메뉴 { -->
	<?php include_once(G5_THEME_PATH.'/component/mypage_side.php'); ?>

    <!-- 본문 -->
    <section class="wrap2">
        <p class="bo-tit">주문내역</p>

        <ul class="common-tab">
            <li><a href="#">깃발관리</a></li>
            <li class="active"><a href="#">깃발제작</a></li>
            <li><a href="#">깃발배송</a></li>
            <li><a href="#">청구서 보기</a></li>
        </ul>

        <table class="tbl_head03 tbl_wrap order-list center">
            <colgroup class="pc">
                <col style="width: 15%;">
                <col style="width: *;">
                <col style="width: 18%;">
                <col style="width: 18%;">
                <col style="width: 15%;">
            </colgroup>
            <colgroup class="mo">
                <col style="width: 30%;">
                <col style="width: *;">
                <col style="width: 30%;">
            </colgroup>
            <thead>
                <tr>
                    <th scope="col">신청일</th>
                    <th scope="col">제품명</th>
                    <th scope="col" class="pc">입금은행</th>
                    <th scope="col" class="pc">입금자</th>
                    <th scope="col">입금예정일</th>
                    <!-- <th scope="col">주문서번호</th>
                    <th scope="col">주문일시</th>
                    <th scope="col">상품수</th>
                    <th scope="col">주문금액</th>
                    <th scope="col">입금액</th>
                    <th scope="col">미입금액</th>
                    <th scope="col">상태</th> -->
                </tr>
            </thead>
            <tbody>
            <?php
            $sql_extra = $is_admin ? "" : " where mb_id = '{$member['mb_id']}' ";
            $sql = " select *
                    from {$g5['g5_shop_order_table']}
                    ".$sql_extra."
                    order by od_id desc
                    $limit ";
            $result = sql_query($sql);
            for ($i=0; $row=sql_fetch_array($result); $i++)
            {
                $uid = md5($row['od_id'].$row['od_time'].$row['od_ip']);

                $sql2 = " select it_name, ct_option from {$g5['g5_shop_cart_table']} where od_id = '{$row['od_id']}' ";
                $row2 = sql_fetch($sql2);
    
                switch($row['od_status']) {
                    case '주문':
                        $od_status = '<span class="status_01">입금확인중</span>'; 
                        break;
                    case '입금':
                        $od_status = '<span class="status_02">입금완료</span>';
                        break;
                    case '준비':
                        $od_status = '<span class="status_03">상품준비중</span>';
                        break;
                    case '배송':
                        $od_status = '<span class="status_04">상품배송</span>';
                        break;
                    case '완료':
                        $od_status = '<span class="status_05">배송완료</span>';
                        break;
                    default:
                        $od_status = '<span class="status_06">주문취소</span>';
                        break;
                }
            ?>
    
            <tr>
                <td><?php echo mb_substr(str_replace('-', '.', explode(' ', $row['od_time'])[0]), 2); ?></td>
                <td><?php echo $row2['it_name'] ?></td>
                <td class="pc">OO은행</td>
                <td class="pc">홍길동</td>
                <td>25.00.00</td>
                <!-- <td>
                    <a href="<?php echo G5_SHOP_URL; ?>/orderinquiryview.php?od_id=<?php echo $row['od_id']; ?>&amp;uid=<?php echo $uid; ?>"><?php echo $row['od_id']; ?></a>
                </td>
                <td><?php echo substr($row['od_time'],2,14); ?> (<?php echo get_yoil($row['od_time']); ?>)</td>
                <td class="td_numbig"><?php echo $row['od_cart_count']; ?></td>
                <td class="td_numbig text_right"><?php echo display_price($row['od_cart_price'] + $row['od_send_cost'] + $row['od_send_cost2']); ?></td>
                <td class="td_numbig text_right"><?php echo display_price($row['od_receipt_price']); ?></td>
                <td class="td_numbig text_right"><?php echo display_price($row['od_misu']); ?></td>
                <td><?php echo $od_status; ?></td> -->
            </tr>
    
            <?php
            }
    
            if ($i == 0)
                echo '<tr><td colspan="7" class="empty_table">주문 내역이 없습니다.</td></tr>';
            ?>
            </tbody>
        </table>
    </section>
</article>
<!-- } 주문 내역 목록 끝 -->