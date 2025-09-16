<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
// add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
add_javascript('<script src="'.G5_JS_URL.'/jquery.bxslider.js"></script>', 10);
$list_count = (is_array($list) && $list) ? count($list) : 0;
?>

<div class="tit-area"><p><?php echo $bo_subject ?></p></div>
<!-- <h2><a href="<?php echo get_pretty_url($bo_table); ?>"><?php echo $bo_subject ?></a></h2> -->
<ul>
    <?php for ($i=0; $i<$list_count; $i++) {  ?>
    <li>
        <?php
        if ($list[$i]['icon_new']) echo "<span class=\"new_icon\">N<span class=\"sound_only\">새글</span></span>";

        echo "<a href=\"".get_pretty_url($bo_table, $list[$i]['wr_id'])."\">";
            echo '<p>'.$list[$i]['subject'].'</p>';
            echo '<p>'.date("Y.m.d", strtotime($list[$i]['datetime'])).'</p>';
        echo "</a>";
        ?>
    </li>
    <?php }  ?>
    <?php if ($list_count == 0) { //게시물이 없을 때  ?>
    <li class="empty_li">게시물이 없습니다.</li>
    <?php }  ?>
</ul>
<a href="<?php echo get_pretty_url($bo_table); ?>" class="read-more">+<span class="sound_only">더보기</span></a>
