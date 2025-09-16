<?php
if (!defined('_INDEX_')) define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.php');
?>

<!-- 비주얼 --> 
<?php 
    $vis_id = 'keep_apply1';
    $vis_name = '깃발보관';
    $vis_desc = '보관 및 관리 상태를 한 곳에서 쉽게 살펴보세요.';
    include_once(G5_THEME_PATH.'/component/visual.php');
?>
 
<article id="keepSearch" class="wrap">
    <h2 class="sound_only">보관관리 검색 영역</h2>

    <div class="summary-wrap">
        <section class="search-frm">
            <h3>깃발 보관</h3>
            <!-- 보관 공통 탭 메뉴 -->
            <?php include_once(G5_THEME_PATH.'/component/keep_tab_menu.php'); ?>

            <p class="tit">보관관리 검색</p>
            <p>
                (주)플렉하이웨이에서는 깃발제작뿐만 아니라 <br class="mo">보관ㆍ배달관리까지 안전하게 해드리고 있습니다.<br>
                보관관리는 무료이며 배달관리비를 받고 있습니다. <br class="mo">깃발 보관신청시 등록하신 단체명으로 <br class="mo">조회가 가능합니다.
            </p>
            <form action="" method="get">
                <input type="text" name="keyword" id="keyword" placeholder="단체명을 입력해주세요">
                <button class="btn-black">검색</button>
            </form>
        </section>

        <section class="search-result">
            <h3 class="sound_only">검색 결과 영역</h3>
            <ul class="result-list">
                <li>고려대학교 KU 77 산악회</li>
                <li>중앙대학교 검도부</li>
                <li>중앙대학교 신문방송학과 89학번 동기회</li>
                <li>광영고5회동창회</li>
                <li>한국건축시공기술연구회</li>
                <li>인월중학교 21회</li>
                <li>재경 목포중앙초등학교 32회동창회</li>
                <li>신광초등학교6회</li>
            </ul>
        </section>
    </div>
</article>

<script>
    const resultAll = document.querySelectorAll('.result-list li');
    const frm = document.querySelector('#keepSearch form');
    const key = '<?php echo get_text($_GET['keyword']) ?>';

    if(key != '') {
        let resultCnt = 0;
        console.log(key);

        frm.keyword.value = key;
    
        resultAll.forEach(li => {
            if(!li.textContent.includes(key)) {
                li.classList.add('dpnone');
            } else {
                resultCnt++;
            }
        });

        if(!resultCnt) {
            document.querySelector('.result-list').innerHTML = '<li class="no-result">검색결과가 없습니다</li>';
        }
    }
</script>

<?php
include_once(G5_THEME_PATH.'/tail.php');