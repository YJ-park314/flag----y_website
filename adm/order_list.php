<?php
include_once('./_common.php');
// include_once('./admin.head.php');

$now = date('Y-m-d');
?>

<link rel="stylesheet" href="<?php echo G5_ADMIN_URL ?>/css/admin.css">

<article id="postOrder" class="adm-post-wrap">
    <h2 class="sound_only">배송현황 - 주문창고</h2>

    <p class="adm-post-tit">금일배송 <span class="this-date"><?php echo $now; ?></span></p>
    
    <div class="post-list-wrap">
        <div class="post-head">
            <span>번호</span>
            <span>단체명</span>
            <span>깃발위치</span>
            <span>배송물품</span>
            <span>배송장소</span>
            <span>지역</span>
            <span>배송인</span>
            <span>배송시간</span>
        </div>
        <ul class="post-body">
            <?php for($i=0; $i<30; $i++) { ?>
            <li class="<?php echo $i < 5 ? 'bg1' : ''; ?>">
                <span><?php echo $i+1; ?></span>
                <span>00대학총동문회</span>
                <span>사-500</span>
                <span>근조기+상조</span>
                <span>00장례식장</span>
                <span>서울</span>
                <span>홍길동</span>
                <span>11:53</span>
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