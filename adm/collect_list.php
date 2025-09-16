<?php
include_once('./_common.php');
// include_once('./admin.head.php');

$now = date('Y-m-d');
$day_ago = date('Y-m-d',strtotime($now."-1 day"));
$search_date = $_GET['date'];
?> 

<link rel="stylesheet" href="<?php echo G5_ADMIN_URL ?>/css/admin.css">

<article id="postCollect" class="adm-post-wrap">
    <h2 class="sound_only">배송현황 - 회수창고</h2>

    <p class="adm-post-tit"><span class="this-date"><?php echo $now; ?></span>일 회수 <span class="collect-count">43</span>건</p>
    <div class="btn-wrap">
        <a href="<?php echo G5_ADMIN_URL ?>/collect_list.php?date=<?php echo $day_ago; ?>" class="btn-point" target="_blank"><?php echo $day_ago; ?> 회수</a>
    </div>

    <div class="post-list-wrap">
        <div class="post-head">
            <span>번호</span>
            <span>단체명</span>
            <span>깃발위치</span>
            <span>배송물품</span>
            <span>배송장소</span>
            <span>회수시간</span>
            <span>배송인</span>
            <span>회수인</span>
        </div>
        <ul class="post-body">
            <?php for($i=0; $i<30; $i++) { ?>
            <li class="<?php echo $i < 5 ? 'bg1' : ''; ?>">
                <span><?php echo $i+1; ?></span>
                <span>플렉하이웨이</span>
                <span>사-500</span>
                <span>근조기+상조</span>
                <span>00대병원</span>
                <span>11:50</span>
                <span>홍길동</span>
                <span>김철수</span>
            </li>
            <?php } ?>
        </ul>
    </div>
</article>

<script>
    const postHead = document.querySelector('.post-list-wrap .post-head');
    const postHeadStop = postHead.offsetTop;

    console.log(postHeadStop);

    document.addEventListener('scroll', () => {
        const scY = window.scrollY;

        if(scY >= postHeadStop) {
            postHead.classList.add('active');
        } else {
            postHead.classList.remove('active');
        }
    });
</script>

<?php
// include_once ('./admin.tail.php');
?>