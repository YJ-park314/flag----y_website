<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/tail.php');
    return;
}

if(G5_COMMUNITY_USE === false) {
    include_once(G5_THEME_SHOP_PATH.'/shop.tail.php');
    return;
}
?>

    </div>
    <!-- <div id="aside">
        <?// php echo outlogin('theme/basic'); // 외부 로그인, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정 ?>
        <?// php echo poll('theme/basic'); // 설문조사, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정 ?>
    </div> -->
</div>

</div>
<!-- } 콘텐츠 끝 -->

<hr>
 
<!-- 하단 시작 { -->
<footer id="ft">
    <img src="/theme/basic/img/ft_logo.svg" alt="플렉하이웨이" class="ft-logo pc">
    <p class="bank-info pc">무통장 입금 : 우리은행 1005-800-962902 (주)플렉하이웨이</p>
    <ul class="ft-gnb">
        <li><a href="/bbs/content.php?co_id=privacy">개인정보취급방침</a></li>
        <li><a href="/bbs/content.php?co_id=provision">이용약관</a></li>
        <li><a href="/bbs/board.php?bo_table=notice">고객센터</a></li>
    </ul>
    <div class="addr">
        <p>서울특별시 송파구 마천로 70-9(오금동) 태승빌딩 2층 <br class="mo">(주)플렉하이웨이</p>
        <p>대표자명 : 정영현<span class="pc"> | </span><br class="mo">사업자등록번호 : 215-86-70437<span class="pc"> | </span><br class="mo"><a href="#" onclick="window.open('http://www.ftc.go.kr/bizCommPop.do?wrkr_no=2158670437', 'bizCommPop', 'width=750, height=950;');return false;">통신판매업 신고 번호 : 제 2015-서울송파-1578 (정보조회)</a><span class="pc"> | </span><br class="mo">개인정보 관리책임자 : 정영현</p>
        <p>T. (02)400-4409<span class="pc"> | </span><br class="mo">F. (02)431-4414<span class="pc"> | </span><br class="mo">E-mail. hiwayes@hanmail.net</p>
    </div>
    <p class="copy">Copyright 2022 (주)플렉하이웨이. All rights reserved</p>
    <ul class="connect-url">
        <li><a href="tel:02-400-4409"><img src="/theme/basic/img/ico_tel.svg" alt=""><span class="bf pc">전화문의</span><span class="af">02-400-4409</span></a></li>
        <li><a href="tel:010-8884-1234"><img src="/theme/basic/img/ico_message.svg" alt=""><span class="bf pc">문자문의</span><span class="af">010-8884-1234</span></a></li>
    </ul>
</footer>

<?php
if(G5_DEVICE_BUTTON_DISPLAY && !G5_IS_MOBILE) { ?>
<?php
}

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<!-- } 하단 끝 -->
<script src="/theme/basic/js/custom.js"></script>
<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<?php
include_once(G5_THEME_PATH."/tail.sub.php");