<?php
if (!defined('_INDEX_')) define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

if(G5_COMMUNITY_USE === false) {
    include_once(G5_THEME_SHOP_PATH.'/index.php');
    return; 
}

include_once(G5_THEME_PATH.'/head.php');
?>

<!-- 비주얼 --> 
<div class="visual-sub main">
    <dl>
        <dt>대한민국 업계 NO1</dt>
        <dd>
            <p>정성을 담아 맞춤 제작하는 깃발 전문 업체</p>
            <p>품질과 신뢰로 고객의 소중한 순간을 함께합니다.</p>
        </dd>
    </dl>
</div>

<article id="main">
    <h2 class="sound_only">메인 본문 영역</h2>
    <section class="our-service wrap">
        <div class="tit-area">
            <p>Our Service</p>
            <h3>플렉하이웨이만의 특별 서비스</h3>
        </div>
        <ul class="service-list">
            <li>
                <a href="/shop/list.php?ca_id=30">
                    <img src="/theme/basic/img/main/emoji_flag.svg" alt="">
                    <p>깃발 제작</p>
                </a>
            </li>
            <li>
                <a href="/bbs/board.php?bo_table=setup_apply&sca=배송요청_확인">
                    <img src="/theme/basic/img/main/emoji_post.svg" alt="">
                    <p>깃발 배송</p>
                </a>
            </li>
            <li>
                <a href="/bbs/board.php?bo_table=keep_apply&sca=보관_신청한_깃발">
                    <img src="/theme/basic/img/main/emoji_storage.svg" alt="">
                    <p>깃발 보관</p>
                </a>
            </li>
            <li>
                <a href="/bbs/board.php?bo_table=design_confirm">
                    <img src="/theme/basic/img/main/emoji_order.svg" alt="">
                    <p>무료 시안</p>
                </a>
            </li>
        </ul>
        <ul class="order-list">
            <li class="custom">
                <p>제작신청목록</p> 
                <ul>
                    <?php
                        $sql = " select *
                                from {$g5['g5_shop_order_table']}
                                order by od_id desc
                                limit 0, 5 ";
                        $result = sql_query($sql);
                        for ($i=0; $row=sql_fetch_array($result); $i++)
                        {
                        $uid = md5($row['od_id'].$row['od_time'].$row['od_ip']);
                        $date_sum = date('Ymd') - date('Ymd', strtotime($row['od_time']));
                        $row['icon_new'] = $date_sum == 0 || $date_sum == 1 ? '<span class="ico-new">New</span>' : '';

                        $sql2 = " select it_name, ct_option from {$g5['g5_shop_cart_table']} where od_id = '{$row['od_id']}' ";
                        $row2 = sql_fetch($sql2);
                    ?>
                    <li>
                        <p>
                            <span class="subject">
                            <?php 
                                echo '[' . mb_substr($row['od_name'], 0, 1); 
                                for($nm=1; $nm<mb_strlen($row['od_name']) - 1; $nm++) { 
                                    echo "*";
                                } 
                                echo mb_substr($row['od_name'], mb_strlen($row['od_name']) - 1, 1) . ']' . $row2['it_name']; 
                            ?>
                            </span>
                            <?php if($row['icon_new'] != '') echo $row['icon_new']; ?>
                        </p>
                        <p><?php echo date('Y. m. d', strtotime($row['od_time'])); ?></p>
                    </li>
                    <?php
                    } if ($i == 0)
                        echo '<li>주문 내역이 없습니다</li>'; 
                    ?>
                </ul>
                <a href="/order_apply_history.php" class="read-more">+<span class="sound_only">더보기</span></a>
            </li>
            <li class="setup">
                <p>깃발설치내역</p>
                <?php echo latest('setup', 'setup_apply', 5, 25); ?>
                <a href="/bbs/board.php?bo_table=setup_apply&sca=설치내역_보기" class="read-more">+<span class="sound_only">더보기</span></a>
            </li>
        </ul>
    </section>
    <section class="del-service wrap">
        <div class="tit-area">
            <p>Delivery Service</p>
            <h3>27년 전통 전국 7800단체, <br class="mo">국내 유일의 깃발 관리 및 보관 시스템</h3>
        </div>
        <ul class="img-slide">
            <li>
                <img src="/theme/basic/img/main/delivery_img1.jpg" alt="">
                <div class="tit-area">
                    <p>compensation</p>
                    <p>서비스미흡 표준보상안 실시</p>
                </div>
            </li>
            <li>
                <img src="/theme/basic/img/main/delivery_img2.jpg" alt="">
                <div class="tit-area">
                    <p>compensation</p>
                    <p>서비스미흡 표준보상안 실시</p>
                </div>
            </li>
            <li class="active">
                <img src="/theme/basic/img/main/delivery_img3.jpg" alt="">
                <div class="tit-area">
                    <p>compensation</p>
                    <p>서비스미흡 표준보상안 실시</p>
                </div>
            </li>
            <li>
                <img src="/theme/basic/img/main/delivery_img4.jpg" alt="">
                <div class="tit-area">
                    <p>compensation</p>
                    <p>서비스미흡 표준보상안 실시</p>
                </div>
            </li>
            <li>
                <img src="/theme/basic/img/main/delivery_img5.jpg" alt="">
                <div class="tit-area">
                    <p>compensation</p>
                    <p>서비스미흡 표준보상안 실시</p>
                </div>
            </li>
            <li>
                <img src="/theme/basic/img/main/delivery_img6.jpg" alt="">
                <div class="tit-area">
                    <p>compensation</p>
                    <p>서비스미흡 표준보상안 실시</p>
                </div>
            </li>
        </ul>
    </section>
    <!-- <section>
        <h3>플렉하이웨이와 함께하는 고객사</h3>
    </section> -->
    <section class="cs wrap">
        <h3 class="sound_only">공지 및 고객센터 안내</h3>
        <!-- 공지사항 -->
        <ul class="cs-list">
            <li class="notice-wrap">
                <?php echo latest('notice', 'notice', 4, 23); ?>
            </li>
            <li class="cs-wrap">
                <div class="tit-area"> 
                    <p>고객센터</p>
                    <p>
                        <span>평일 09:00 ~ 18:00</span>
                        <span>주말 및 공휴일 휴무</span>
                    </p>
                </div>
                <ul>
                    <li>
                        <div class="ico"><img src="/theme/basic/img/ico_cs_tel.svg" alt=""></div>
                        <div class="info">
                            <p>전화상담</p>
                            <p>02.400.4409</p>
                        </div>
                    </li>
                    <li>
                        <div class="ico"><img src="/theme/basic/img/ico_cs_printer.svg" alt=""></div>
                        <div class="info">
                            <p>FAX</p>
                            <p>02.431.4414</p>
                        </div>
                    </li>
                    <li>
                        <div class="ico"><img src="/theme/basic/img/ico_cs_msg.svg" alt=""></div>
                        <div class="info">
                            <p>이메일</p>
                            <p>hiwayes@hanmail.net</p>
                        </div>
                    </li>
                    <li>
                        <div class="ico"><img src="/theme/basic/img/ico_cs_coin.svg" alt=""></div>
                        <div class="info">
                            <p>무통장 입금</p>
                            <p>우리은행 <br class="mo"><span>1005-800-962902</span> <br class="mo">플렉하이웨이</p>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
</article>

<?php /*
<div class="latest_top_wr">
    <?php
    // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
    // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
    // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
    echo latest('theme/pic_list', 'free', 4, 23);		// 최소설치시 자동생성되는 자유게시판
	echo latest('theme/pic_list', 'qa', 4, 23);			// 최소설치시 자동생성되는 질문답변게시판
	echo latest('theme/pic_list', 'notice', 4, 23);		// 최소설치시 자동생성되는 공지사항게시판
    ?>
</div>
<div class="latest_wr">
    <!-- 사진 최신글2 { -->
    <?php
    // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
    // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
    // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
    echo latest('theme/pic_block', 'gallery', 4, 23);		// 최소설치시 자동생성되는 갤러리게시판
    ?>
    <!-- } 사진 최신글2 끝 -->
</div>

<div class="latest_wr">
<!-- 최신글 시작 { -->
    <?php
    //  최신글
    $sql = " select bo_table
                from `{$g5['board_table']}` a left join `{$g5['group_table']}` b on (a.gr_id=b.gr_id)
                where a.bo_device <> 'mobile' ";
    if(!$is_admin)
	$sql .= " and a.bo_use_cert = '' ";
    $sql .= " and a.bo_table not in ('notice', 'gallery') ";     //공지사항과 갤러리 게시판은 제외
    $sql .= " order by b.gr_order, a.bo_order ";
    $result = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($result); $i++) {
		$lt_style = '';
    	if ($i%3 !== 0 ) $lt_style = "margin-left:2%";
    ?>
    <div style="float:left;<?php echo $lt_style ?>" class="lt_wr">
        <?php
        // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
        // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
        // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
        echo latest('theme/basic', $row['bo_table'], 6, 24);
        ?>
    </div>
    <?php
    }
    ?>
    <!-- } 최신글 끝 -->
</div> */
?>

<?php
include_once(G5_THEME_PATH.'/tail.php');