<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$faq_skin_url.'/style.css">', 0);
?>

<!-- 비주얼 -->
<?php 
    $vis_id = 'notice';
    $vis_name = '고객센터';
    $vis_desc = '플렉하이웨이의 최신 소식을 알려드립니다.';
    include_once(G5_THEME_PATH.'/component/visual.php');
?>

<!-- FAQ 시작 { -->
<?php
if ($himg_src)
    echo '<div id="faq_himg" class="faq_img"><img src="'.$himg_src.'" alt=""></div>';

// 상단 HTML
echo '<div id="faq_hhtml">'.conv_content($fm['fm_head_html'], 1).'</div>';
?>

<!-- <fieldset id="faq_sch">
    <legend>FAQ 검색</legend>
    <form name="faq_search_form" method="get">
    <span class="sch_tit">FAQ 검색</span>
    <input type="hidden" name="fm_id" value="<?php echo $fm_id;?>">
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo $stx;?>" required id="stx" class="frm_input" size="15" maxlength="15">
    <button type="submit" value="검색" class="btn_submit"><i class="fa fa-search" aria-hidden="true"></i> 검색</button>
    </form>
</fieldset> -->

<!-- <?php
if( count($faq_master_list) ){
?>
<nav id="bo_cate">
    <h3>자주하시는질문 분류</h3>
    <ul id="bo_cate_ul">
        <?php
        foreach( $faq_master_list as $v ){
            $category_msg = '';
            $category_option = '';
            if($v['fm_id'] == $fm_id){ // 현재 선택된 카테고리라면
                $category_option = ' id="bo_cate_on"';
                $category_msg = '<span class="sound_only">열린 분류 </span>';
            }
        ?>
        <li><a href="<?php echo $category_href;?>?fm_id=<?php echo $v['fm_id'];?>" <?php echo $category_option;?> ><?php echo $category_msg.$v['fm_subject'];?></a></li>
        <?php
        }
        ?>
    </ul>
</nav>
<?php } ?> -->

<div id="faq_wrap" class="faq_<?php echo $fm_id; ?> wrap">
    <?php // FAQ 내용
    if( count($faq_list) ){
    ?>
    <div id="faq_con">
        <h3><?php echo $g5['title']; ?></h3>

        <!-- 고객센터 공통 탭 -->
        <?php include_once(G5_THEME_PATH.'/component/cstm_tab_menu.php'); ?>

        <p class="list-head"><span>분류</span><span>제목</span></p>
        <ol>
            <?php
            foreach($faq_list as $key=>$v){
                if(empty($v))
                    continue;
            ?>
            <li>
                <h4>
                	<span class="tit_bg">Q</span><a href="#none" onclick="return faq_open(this);"><?php echo conv_content($v['fa_subject'], 1); ?></a>
                	<button class="tit_btn" onclick="return faq_open(this);"><img src="/theme/basic/img/ico_arrow_down.svg" alt=""><span class="sound_only">열기</span></button>
                </h4>
                <div class="con_inner">
                    <?php echo conv_content($v['fa_content'], 1); ?>
                    <button type="button" class="closer_btn"><img src="/theme/basic/img/ico_arrow_down.svg" class="reverse" alt=""><span class="sound_only">닫기</span></button>
                </div>
            </li>
            <?php
            }
            ?>
        </ol>
    </div>
    <?php

    } else {
        if($stx){
            echo '<p class="empty_list">검색된 게시물이 없습니다.</p>';
        } else {
            echo '<div class="empty_list">등록된 FAQ가 없습니다.';
            if($is_admin)
                echo '<br><a href="'.G5_ADMIN_URL.'/faqmasterlist.php">FAQ를 새로 등록하시려면 FAQ관리</a> 메뉴를 이용하십시오.';
            echo '</div>';
        }
    }
    ?>
</div>

<?php echo get_paging($page_rows, $page, $total_page, $_SERVER['SCRIPT_NAME'].'?'.$qstr.'&amp;page='); ?>

<?php
// 하단 HTML
echo '<div id="faq_thtml">'.conv_content($fm['fm_tail_html'], 1).'</div>';

if ($timg_src)
    echo '<div id="faq_timg" class="faq_img"><img src="'.$timg_src.'" alt=""></div>';
?>


<!-- } FAQ 끝 -->

<!-- <?php
if ($admin_href)
    echo '<div class="faq_admin"><a href="'.$admin_href.'" class="btn_admin btn" title="FAQ 수정"><i class="fa fa-cog fa-spin fa-fw"></i><span class="sound_only">FAQ 수정</span></a></div>';
?> -->

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>
<script>
jQuery(function() {
    $(".closer_btn").on("click", function() {
        $(this).closest(".con_inner").slideToggle('slow', function() {
			var $h4 = $(this).closest("li").find("h4");

			$("#faq_con li h4").removeClass("faq_li_open");
			if($(this).is(":visible")) {
				$h4.addClass("faq_li_open");
			}
		});
    });
});

function faq_open(el)
{	
    var $con = $(el).closest("li").find(".con_inner"),
		$h4 = $(el).closest("li").find("h4");

    if($con.is(":visible")) {
        $con.slideUp();
		$h4.removeClass("faq_li_open");
    } else {
        $("#faq_con .con_inner:visible").css("display", "none");

        $con.slideDown(
            function() {
                // 이미지 리사이즈
                $con.viewimageresize2();
				$("#faq_con li h4").removeClass("faq_li_open");

				$h4.addClass("faq_li_open");
            }
        );
    }

    return false;
}
</script>