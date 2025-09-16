<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/head.php');
    return; 
}

if(G5_COMMUNITY_USE === false) {
    define('G5_IS_COMMUNITY_PAGE', true);
    include_once(G5_THEME_SHOP_PATH.'/shop.head.php'); 
    return;
}
include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');

$mypage_url = array(
    '회원정보' => '/bbs/register_form.php?w=u',
    '주문내역' => '/my_history.php',
    '질문과 답변' => '/bbs/board.php?bo_table=qa',
    '깃발시안요청 및 확인' => '/bbs/board.php?bo_table=design_confirm',
    '단체연결' => '/bbs/board.php?bo_table=group_connect',
    '회원탈퇴' => '#',
);
?>

<script>
    const mypage_url = <?php echo json_encode($mypage_url) ?>;
</script>

<link rel="stylesheet" href="/theme/basic/css/custom.css">
<link rel="stylesheet" href="/theme/basic/css/media.css">

<!-- 상단 시작 { -->
<header id="hd">
    <h1><div class="sound_only">플렉하이웨이</div></h1>
    <div class="wrap">
        <nav id="gnbMo" class="mo">
            <h2 class="sound_only">모바일 상단 네비게이션 영역</h2>
            <div class="left">
                <a href="/">
                    <img src="/theme/basic/img/hd_logo2.png" alt="플렉하이웨이" class="logo">
                </a>
            </div>
            <div class="right">
                <a href="/bbs/register_form.php?w=u">
                    <img src="/theme/basic/img/ico_hd_my_mo.svg" alt="마이페이지">
                </a>
                <a href="#" class="ham-menu gnb-btn open">
                    <span></span>
                    <span></span>
                    <span></span>
                </a>
            </div>
        </nav>
        <nav id="gnb">
            <h2 class="sound_only">글로벌네이게이션 영역</h2>
            <ul>
                <li class="logo pc">
                    <h3>
                        <a href="/">
                            <div class="img-area">
                                <img src="/theme/basic/img/hd_logo2.png" alt="">
                                <span>SINCE 1989</span>
                            </div>
                            <div class="tit">
                                <span>대한민국 업계 넘버원!!</span>
                                <span>플렉하이웨이</span>
                            </div>
                            <!-- <span class="sound_only">홈</span> -->
                        </a>
                    </h3>
                </li>
                <li class="menu">
                    <ul> 
                        <li><h3><a href="/shop/list.php?ca_id=30">근조기</a></h3></li>
                        <li><h3><a href="/shop/list.php?ca_id=50">회사·단체기</a></h3></li>
                        <li><h3><a href="/shop/list.php?ca_id=60">경하기</a></h3></li>
                        <li class="mo bd-line"></li>
                        <li>
                            <h3><a href="/bbs/board.php?bo_table=setup_apply&sca=배송요청_확인" class="mo-toggle-menu">깃발배송<img src="/theme/basic/img/ico_plus.svg" alt="" class="toggle-ico mo"></a></h3>
                            <ul class="submenu">
                                <li><h4><a href="/bbs/write.php?bo_table=setup_apply">배송요청</a></h4></li>
                                <li><h4><a href="/bbs/board.php?bo_table=setup_apply&sca=배송요청_확인">배송요청내역</a></h4></li>
                                <li><h4><a href="/setup_info.php">배송안내</a></h4></li>
                            </ul>
                        </li>
                        <li>
                            <h3><a href="/bbs/board.php?bo_table=keep_apply&sca=보관_신청한_깃발" class="mo-toggle-menu">깃발보관<img src="/theme/basic/img/ico_plus.svg" alt="" class="toggle-ico mo"></a></h3>
                            <ul class="submenu mo-only">
                                <li><h4><a href="/bbs/board.php?bo_table=keep_apply&sca=보관_신청한_깃발">보관관리신청</a></h4></li>
                                <li><h4><a href="/bbs/board.php?bo_table=keep_apply&sca=현재_관리중인_깃발">현재관리깃발</a></h4></li>
                                <li><h4><a href="/bbs/board.php?bo_table=keep_apply&sca=단체_연결_안된_깃발">단체깃발연결</a></h4></li>
                            </ul>
                        </li>
                    </ul> 
                </li>
                <li class="member"> 
                    <ul>
                        <?php if ($is_member) {  ?>
                        <li><h3><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></h3></li>
                        <li><h3><a href="/bbs/register_form.php?w=u">마이페이지</a></h3></li>
                        <?php } else {  ?>
                        <li><h3><a href="<?php echo G5_BBS_URL ?>/login.php">로그인</a></h3></li>
                        <li><h3><a href="<?php echo G5_BBS_URL ?>/register.php">회원가입</a></h3></li>
                        <?php }  ?>
                        <li><h3><a href="/bbs/board.php?bo_table=notice">고객센터</a></h3></li>
                    </ul>
                </li> 
                <li class="cstm-info mo">
                    <p class="bank">우리은행 1005-800-962902</p>
                    <p class="company">(주)플렉하이웨이</p>
                    <p class="tel"><img src="/theme/basic/img/ico_tel.svg" alt=""> 02-400-4409</p>
                    <p class="hp"><img src="/theme/basic/img/ico_message.svg" alt=""> 010-8884-1234</p>
                </li>
            </ul>
            <div class="gnb-fixed mo">
                <a href="/bbs/register_form.php?w=u">
                    <img src="/theme/basic/img/ico_hd_my_mo.svg" alt="마이페이지">
                </a>
                <a href="#" class="gnb-btn close"><span></span></a>
            </div>
        </nav>
    </div>
</header>

<?php 
// 기존 헤더
/* <div id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>
    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
    }
    ?>
    <div id="tnb">
    	<div class="inner">
            <?php if(G5_COMMUNITY_USE) { ?>
    		<ul id="hd_define">
    			<li class="active"><a href="<?php echo G5_URL ?>/">커뮤니티</a></li>
                <?php if (defined('G5_USE_SHOP') && G5_USE_SHOP) { ?>
    			<li><a href="<?php echo G5_SHOP_URL ?>/">쇼핑몰</a></li>
                <?php } ?>
    		</ul>
            <?php } ?>
			<ul id="hd_qnb">
	            <li><a href="<?php echo G5_BBS_URL ?>/faq.php">FAQ</a></li>
	            <li><a href="<?php echo G5_BBS_URL ?>/qalist.php">Q&A</a></li>
	            <li><a href="<?php echo G5_BBS_URL ?>/new.php">새글</a></li>
	            <li><a href="<?php echo G5_BBS_URL ?>/current_connect.php" class="visit">접속자<strong class="visit-num"><?php echo connect('theme/basic'); // 현재 접속자수, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정  ?></strong></a></li>
	        </ul>
		</div>
    </div>
    <div id="hd_wrapper">

        <div id="logo">
            <a href="<?php echo G5_URL ?>"><img src="<?php echo G5_IMG_URL ?>/logo.png" alt="<?php echo $config['cf_title']; ?>"></a>
        </div>
    
        <div class="hd_sch_wr">
            <fieldset id="hd_sch">
                <legend>사이트 내 전체검색</legend>
                <form name="fsearchbox" method="get" action="<?php echo G5_BBS_URL ?>/search.php" onsubmit="return fsearchbox_submit(this);">
                <input type="hidden" name="sfl" value="wr_subject||wr_content">
                <input type="hidden" name="sop" value="and">
                <label for="sch_stx" class="sound_only">검색어 필수</label>
                <input type="text" name="stx" id="sch_stx" maxlength="20" placeholder="검색어를 입력해주세요">
                <button type="submit" id="sch_submit" value="검색"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>
                </form>

                <script>
                function fsearchbox_submit(f)
                {
                    var stx = f.stx.value.trim();
                    if (stx.length < 2) {
                        alert("검색어는 두글자 이상 입력하십시오.");
                        f.stx.select();
                        f.stx.focus();
                        return false;
                    }

                    // 검색에 많은 부하가 걸리는 경우 이 주석을 제거하세요.
                    var cnt = 0;
                    for (var i = 0; i < stx.length; i++) {
                        if (stx.charAt(i) == ' ')
                            cnt++;
                    }

                    if (cnt > 1) {
                        alert("빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.");
                        f.stx.select();
                        f.stx.focus();
                        return false;
                    }
                    f.stx.value = stx;

                    return true;
                }
                </script>

            </fieldset>
                
            <?php echo popular('theme/basic'); // 인기검색어, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정  ?>
        </div>
        <ul class="hd_login">        
            <?php if ($is_member) {  ?>
            <li><a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php">정보수정</a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
            <?php if ($is_admin) {  ?>
            <li class="tnb_admin"><a href="<?php echo correct_goto_url(G5_ADMIN_URL); ?>">관리자</a></li>
            <?php }  ?>
            <?php } else {  ?>
            <li><a href="<?php echo G5_BBS_URL ?>/register.php">회원가입</a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/login.php">로그인</a></li>
            <?php }  ?>

        </ul>
    </div>
    
    <nav id="gnb">
        <h2>메인메뉴</h2>
        <div class="gnb_wrap">
            <ul id="gnb_1dul">
                <li class="gnb_1dli gnb_mnal"><button type="button" class="gnb_menu_btn" title="전체메뉴"><i class="fa fa-bars" aria-hidden="true"></i><span class="sound_only">전체메뉴열기</span></button></li>
                <?php
				$menu_datas = get_menu_db(0, true);
				$gnb_zindex = 999; // gnb_1dli z-index 값 설정용
                $i = 0;
                foreach( $menu_datas as $row ){
                    if( empty($row) ) continue;
                    $add_class = (isset($row['sub']) && $row['sub']) ? 'gnb_al_li_plus' : '';
                ?>
                <li class="gnb_1dli <?php echo $add_class; ?>" style="z-index:<?php echo $gnb_zindex--; ?>">
                    <a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da"><?php echo $row['me_name'] ?></a>
                    <?php
                    $k = 0;
                    foreach( (array) $row['sub'] as $row2 ){

                        if( empty($row2) ) continue; 

                        if($k == 0)
                            echo '<span class="bg">하위분류</span><div class="gnb_2dul"><ul class="gnb_2dul_box">'.PHP_EOL;
                    ?>
                        <li class="gnb_2dli"><a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="gnb_2da"><?php echo $row2['me_name'] ?></a></li>
                    <?php
                    $k++;
                    }   //end foreach $row2

                    if($k > 0)
                        echo '</ul></div>'.PHP_EOL;
                    ?>
                </li>
                <?php
                $i++;
                }   //end foreach $row

                if ($i == 0) {  ?>
                    <li class="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
                <?php } ?>
            </ul>
            <div id="gnb_all">
                <h2>전체메뉴</h2>
                <ul class="gnb_al_ul">
                    <?php
                    
                    $i = 0;
                    foreach( $menu_datas as $row ){
                    ?>
                    <li class="gnb_al_li">
                        <a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_al_a"><?php echo $row['me_name'] ?></a>
                        <?php
                        $k = 0;
                        foreach( (array) $row['sub'] as $row2 ){
                            if($k == 0)
                                echo '<ul>'.PHP_EOL;
                        ?>
                            <li><a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>"><?php echo $row2['me_name'] ?></a></li>
                        <?php
                        $k++;
                        }   //end foreach $row2

                        if($k > 0)
                            echo '</ul>'.PHP_EOL;
                        ?>
                    </li>
                    <?php
                    $i++;
                    }   //end foreach $row

                    if ($i == 0) {  ?>
                        <li class="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
                    <?php } ?>
                </ul>
                <button type="button" class="gnb_close_btn"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div id="gnb_all_bg"></div>
        </div>
    </nav>
    <script>
    
    $(function(){
        $(".gnb_menu_btn").click(function(){
            $("#gnb_all, #gnb_all_bg").show();
        });
        $(".gnb_close_btn, #gnb_all_bg").click(function(){
            $("#gnb_all, #gnb_all_bg").hide();
        });
    });

    </script>
</div> */
?>
<!-- } 상단 끝 -->


<hr>

<!-- 콘텐츠 시작 { -->
<div id="wrapper">
    <div id="container_wr">
   
    <div id="container">
        <?php if (!defined("_INDEX_")) { ?><?php }