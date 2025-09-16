<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
$list_count = (is_array($list) && $list) ? count($list) : 0;
?>

<div>
    <ul>
        <?php
        for ($i=0; $i<count($list); $i++) {
            $addr = explode(',', $list[$i]['wr_6']);
            // $group = mb_str_split($list[$i]['wr_1']);
		?>
        <li>
            <p>
                <?php echo $group[0]; ?>
                <?php
                    echo '<span class="subject">['.$list[$i]['wr_1'].'] '.$addr[2].'</span>';
                    if ($list[$i]['icon_new']) echo '<span class="ico-new">New</span>';
                ?>
            </p>
            <p><?php echo date('Y. m. d', strtotime($list[$i]['wr_datetime'])) ?></p>
        </li>
        <?php } ?>
        <?php if ($list_count == 0) { //게시물이 없을 때  ?>
        <li class="empty_li">게시물이 없습니다.</li>
        <?php }  ?>
    </ul>
</div>
