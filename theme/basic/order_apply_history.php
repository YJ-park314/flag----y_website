<?php
if (!defined('_INDEX_')) define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.php');
?>

<!-- 비주얼 --> 
<?php 
    $vis_id = 'search';
    $vis_name = '깃발제작신청목록'; 
    $vis_desc = '주문한 깃발의 신청목록을 알려드립니다.';
    include_once(G5_THEME_PATH.'/component/visual.php');
?>

<article>
    <div id="bo_list" class="wrap center">
        <h3>깃발제작신청목록</h3>
        <div class="tbl_head01 tbl_wrap">
            <table>
                <colgroup class="pc">
                    <col style="width: 15%;">
                    <col style="width: 55%;">
                    <col style="width: 15%;">
                    <col style="width: 15%;">
                </colgroup>
                <colgroup class="mo">
                    <col style="width: 18%;">
                    <col style="width: 46%;">
                    <col style="width: 18%;">
                    <col style="width: 18%;">
                </colgroup>
                <thead>
                    <tr>
                        <th scope="col">신청일</th>
                        <th scope="col">제품명</th>
                        <th scope="col">주문자</th>
                        <th scope="col">상태</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = " select *
                                from {$g5['g5_shop_order_table']}
                                where mb_id = '{$member['mb_id']}'
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
                                $od_status = '<span class="sts-shape checking">접수</span>'; 
                                break;
                            case '입금':
                                $od_status = '<span class="sts-shape checking">접수</span>';
                                break;
                            case '준비':
                                $od_status = '<span class="sts-shape complete">신청완료</span>';
                                break;
                            case '배송':
                                $od_status = '<span class="sts-shape complete">신청완료</span>';
                                break;
                            case '완료':
                                $od_status = '<span class="sts-shape complete">신청완료</span>';
                                break;
                            default:
                                $od_status = '<span class="sts-shape cancel">취소</span>';
                                break;
                        }
                    ?>
                    <tr>
                        <td><?php echo date('y.m.d', $row['date']) ?></td>
                        <td><?php echo $row2['it_name'] ?></td>
                        <td><?php echo $row['od_name'] ?></td>
                        <td><?php echo $od_status ?></td>
                    </tr>
                    <?php
                    } if ($i == 0)
                        echo '<tr><td colspan="7" class="empty_table">신청한 깃발이 없습니다';
                        if(!$is_member) {
                            echo ' <span class="no-log">(*로그인 후 이용가능합니다)</span>';
                        }
                        echo '</td></tr>';
                    ?>
            </table>
        </div>
    </div>
</article>

<?php
include_once(G5_THEME_PATH.'/tail.php');