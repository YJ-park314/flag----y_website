<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.php');
?>

<style>
    .sts-shape{padding: 10px 15px;}
</style>

<!-- 비주얼 -->
<?php 
	$vis_id = 'myhistory';
    $vis_name = '주문내역';
    $vis_desc = '주문한 깃발의 내역을 확인할 수 있습니다.';
    include_once(G5_THEME_PATH.'/component/visual.php');
?> 

<article id="myHistory" class="wrap mypage">
	<h2 class="sound_only">본문영역</h2>

	<!-- 사이드 메뉴 { -->
	<?php include_once(G5_THEME_PATH.'/component/mypage_side.php'); ?>

	<section class="wrap2">
		<h3 class="bo-tit">주문내역</h3>

		<ul class="common-tab">
			<li class="active"><a href="#manage">깃발관리</a></li>
			<li><a href="#order">깃발제작</a></li>
			<li><a href="#post">깃발배송</a></li>
			<li><a href="#bill">청구서 보기</a></li>
		</ul>

		<ul class="tab-con">
			<li class="manage"></li>
			<li class="order dpnone"></li>
			<li class="post dpnone"></li>
			<li id="bo_w" class="bill dpnone apply">
				<form action="" method="get">
					<div class="write_div">
						<label for="thisGroup" class="tit"><span>단체명</span></label>
						<div>
							<select name="thisGroup" id="thisGroup">
								<option value="">연결된 단체 없음</option>
								<option value="">HASY</option>
							</select>
						</div>
					</div>
					<div class="write_div">
						<label for="thisMon" class="tit"><span>청구월</span></label>
						<div>
							<input type="month" name="thisMon" id="thisMon">
						</div>
					</div>
					<button class="btn-point strong">청구서 확인</button>
				</form>
			</li>
		</ul>
	</section>
</article>

<script>
	const tabAll = document.querySelectorAll('.common-tab a');

	$(function() {
		$('.manage').load('/bbs/board.php?bo_table=keep_apply&sca=현재_관리중인_깃발 .tbl_wrap', function() {
			const goBtn = document.querySelector('.manage .btn-point');
			const tdA = document.querySelectorAll('td a');

			goBtn.setAttribute('onclick', goBtn.getAttribute('onclick').replace("keep_apply'", "keep_apply&back=my'"));
			tdA.forEach(a => {
				a.href += '&back=my';
			});
		});
		$('.order').load('/shop/orderinquiry.php .order-list');
		$('.post').load('/bbs/board.php?bo_table=setup_apply&sca=설치내역_보기 .tbl_wrap', function() {
			const noMyAll = document.querySelectorAll('.no-my');
			const myAll = document.querySelectorAll('.my');
			const tdA = document.querySelectorAll('td a');

			noMyAll.forEach(el => {
				el.classList.add('dpnone');
			});

			myAll.forEach(el => {
				el.classList.remove('dpnone');
			});

			tdA.forEach(a => {
				a.href += '&back=my';
			});
		});
	});

	tabAll.forEach((a, idx) => {
		if(window.location.href.includes(a.href)) {
			tabAll.forEach((a2, idx2) => {
				a2.closest('li').classList.remove('active');
				document.querySelectorAll('.tab-con li')[idx2].classList.add('dpnone');
			});

			a.closest('li').classList.add('active');
			document.querySelectorAll('.tab-con li')[idx].classList.remove('dpnone');
		}

		a.addEventListener('click', e => {
			// e.preventDefault();

			tabAll.forEach((a2, idx2) => {
				a2.closest('li').classList.remove('active');
				document.querySelectorAll('.tab-con li')[idx2].classList.add('dpnone');
			});

			a.closest('li').classList.add('active');
			document.querySelectorAll('.tab-con li')[idx].classList.remove('dpnone');
		});
	});
</script>

<?php
include_once(G5_THEME_PATH.'/tail.php');