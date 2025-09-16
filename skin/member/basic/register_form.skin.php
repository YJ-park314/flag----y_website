<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
add_javascript('<script src="'.G5_JS_URL.'/jquery.register_form.js"></script>', 0);
if ($config['cf_cert_use'] && ($config['cf_cert_simple'] || $config['cf_cert_ipin'] || $config['cf_cert_hp']))
    add_javascript('<script src="'.G5_JS_URL.'/certify.js?v='.G5_JS_VER.'"></script>', 0);

$is_update = isset($_GET['w']) && $_GET['w'] == 'u' ? true : false;
?>

<!-- 비주얼 -->
<?php 
	if($is_update == true) {
		$vis_id = 'myinfo';
		$vis_name = '회원정보';
		$vis_desc = '회원정보를 수정할 수 있습니다.';
		include_once(G5_THEME_PATH.'/component/visual.php');
	} else {
		$vis_id = 'regi';
		$vis_name = '회원가입';
		$vis_desc = '믿음과 신뢰를 바탕으로 고객과의 약속을 지키겠습니다.';
		include_once(G5_THEME_PATH.'/component/visual.php');
	}
?>

<!-- 회원정보 입력/수정 시작 { -->
<article id="register" class="register regi-form <?php echo $is_update == true ? 'mypage wrap' : 'wrap2' ?>">
	<h2 class="sound_only"> <?php echo $is_update == true ? '회원정보' : '회원가입' ?> 본문영역</h2>

	<!-- 사이드 메뉴 { -->
	<?php if($is_update == true) include_once(G5_THEME_PATH.'/component/mypage_side.php'); ?>

	
	<section id="register_form" class="<?php echo $is_update == true ? 'wrap2' : '' ?>">
		<h3 class="sound_only">이용정보 입력</h3>

		<form id="fregisterform" name="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
			<input type="hidden" name="w" value="<?php echo $w ?>">
			<input type="hidden" name="url" value="<?php echo $urlencode ?>">
			<input type="hidden" name="agree" value="<?php echo $agree ?>">
			<input type="hidden" name="agree2" value="<?php echo $agree2 ?>">
			<input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
			<input type="hidden" name="cert_no" value="">
			<?php if (isset($member['mb_sex'])) {  ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php }  ?>
			<!-- <?php // if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { // 닉네임수정일이 지나지 않았다면  ?>
				<input type="hidden" name="mb_nick_default" value="<?php echo get_text($member['mb_nick']) ?>">
				<input type="hidden" name="mb_nick" value="<?php echo get_text($member['mb_nick']) ?>">
			<?php // }  ?> -->
		
			<div class="register_form_inner">
				<div class="tit-area">
					<p class="bo-tit <?php echo $is_update == true ? 'update' : '' ?>"><?php echo $is_update == true ? '회원정보' : '회원가입' ?></p>
					<?php if(!isset($_GET['w'])) { ?>
					<p class="summary">회원가입에 필요한 정보를 입력해주세요.</p>
					<?php } ?>
				</div>
				<ul class="form-list">
					<li>
						<label for="reg_mb_id"><span class="<?php echo $required ?>">회원아이디</span></label>
						<div class="input-area id-area">
							<input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" <?php echo $required ?> <?php echo $readonly ?> class="frm_input full_input <?php echo $readonly ?>" minlength="3" maxlength="20" placeholder="아이디를 입력해주세요">
							<?php if(!$is_update) { ?>
							<button type="button" class="chk-id-btn btn-black" onclick="idChk(this);">중복확인</button>
							<?php } ?>
							<?php if(!$is_update) { ?><span class="regi-tip">한글, 특수문자를 제외한 4~20자까지의 영문과 숫자로 입력해주세요.</span><?php } ?>
							<span id="msg_mb_id"></span>
						</div>
					</li>
					<li class="half_input left_input margin_input">
						<label for="reg_mb_password"><span class="<?php echo $required ?>">비밀번호</span></label>
						<div class="input-area">
							<input type="password" name="mb_password" id="reg_mb_password" <?php echo $required ?> class="frm_input full_input" minlength="3" maxlength="20" placeholder="비밀번호를 입력해주세요">
							<?php if(!$is_update) { ?><span class="regi-tip">비밀번호는 4~12자 사이의 영문과 숫자 조합 형태로 입력해 주세요.</span><?php } ?>
						</div>
					</li>
					<li class="half_input left_input">
						<label for="reg_mb_password_re"><span class="<?php echo $required ?>">비밀번호 확인</span></label>
						<div class="input-area">
							<input type="password" name="mb_password_re" id="reg_mb_password_re" <?php echo $required ?> class="frm_input full_input" minlength="3" maxlength="20" placeholder="비밀번호를 입력해주세요">
						</div>
					</li>
					<li class="dpnone">
						<?php 
						$desc_name = '';
						$desc_phone = '';
						if ($config['cf_cert_use']) {
							$desc_name = '<span class="cert_desc"> 본인확인 시 자동입력</span>';
							$desc_phone = '<span class="cert_desc"> 본인확인 시 자동입력</span>';

							if (!$config['cf_cert_simple'] && !$config['cf_cert_hp'] && $config['cf_cert_ipin']) {
								$desc_phone = '';
							}

							if ($config['cf_cert_simple']) {
								echo '<button type="button" id="win_sa_kakao_cert" class="btn_frmline win_sa_cert" data-type="">간편인증</button>'.PHP_EOL;
							}
							if($config['cf_cert_hp'])
								echo '<button type="button" id="win_hp_cert" class="btn_frmline">휴대폰 본인확인</button>'.PHP_EOL;
							if ($config['cf_cert_ipin'])
								echo '<button type="button" id="win_ipin_cert" class="btn_frmline">아이핀 본인확인</button>'.PHP_EOL;
		
							echo '<span class="cert_req">(필수)</span>';
							echo '<noscript>본인확인을 위해서는 자바스크립트 사용이 가능해야합니다.</noscript>'.PHP_EOL;
						}
						?>
						<?php
						if ($config['cf_cert_use'] && $member['mb_certify']) {
							switch  ($member['mb_certify']) {
								case "simple": 
									$mb_cert = "간편인증";
									break;
								case "ipin": 
									$mb_cert = "아이핀";
									break;
								case "hp": 
									$mb_cert = "휴대폰";
									break;
							}
						?>
						<div id="msg_certify">
							<strong><?php echo $mb_cert; ?> 본인확인</strong><?php if ($member['mb_adult']) { ?> 및 <strong>성인인증</strong><?php } ?> 완료
						</div>
					<?php } ?>
					</li>
					<li>
						<label for="reg_mb_name"><span class="<?php echo $required ?>">이름 <?php echo $desc_name ?></span></label>
						<div class="input-area">
							<input type="text" id="reg_mb_name" name="mb_name" value="<?php echo get_text($member['mb_name']) ?>" <?php echo $required ?> <?php echo $name_readonly; ?> class="frm_input full_input <?php echo $name_readonly ?>" size="10" placeholder="이름을 입력해주세요">
						</div>
					</li>
					<?php // if ($req_nick) {  ?>
					<!-- <li>
						<label for="reg_mb_nick">
							닉네임 (필수)
							<button type="button" class="tooltip_icon"><i class="fa fa-question-circle-o" aria-hidden="true"></i><span class="sound_only">설명보기</span></button>
							<span class="tooltip">공백없이 한글,영문,숫자만 입력 가능 (한글2자, 영문4자 이상)<br> 닉네임을 바꾸시면 앞으로 <?php echo (int)$config['cf_nick_modify'] ?>일 이내에는 변경 할 수 없습니다.</span>
						</label>
						
						<input type="hidden" name="mb_nick_default" value="<?php echo isset($member['mb_nick'])?get_text($member['mb_nick']):''; ?>">
						<input type="text" name="mb_nick" value="<?php echo isset($member['mb_nick'])?get_text($member['mb_nick']):''; ?>" id="reg_mb_nick" required class="frm_input required nospace full_input" size="10" maxlength="20" placeholder="닉네임">
						<span id="msg_mb_nick"></span>	                
					</li> -->
					<?php // }  ?>
		
					<?php if ($config['cf_use_homepage']) {  ?>
					<li>
						<label for="reg_mb_homepage">홈페이지<?php if ($config['cf_req_homepage']){ ?> (필수)<?php } ?></label>
						<input type="text" name="mb_homepage" value="<?php echo get_text($member['mb_homepage']) ?>" id="reg_mb_homepage" <?php echo $config['cf_req_homepage']?"required":""; ?> class="frm_input full_input <?php echo $config['cf_req_homepage']?"required":""; ?>" size="70" maxlength="255" placeholder="홈페이지">
					</li>
					<?php }  ?>
		
					<li class="dpnone">
					<?php if ($config['cf_use_tel']) {  ?>
					
						<label for="reg_mb_tel">전화번호<?php if ($config['cf_req_tel']) { ?> (필수)<?php } ?></label>
						<input type="text" name="mb_tel" value="<?php echo get_text($member['mb_tel']) ?>" id="reg_mb_tel" <?php echo $config['cf_req_tel']?"required":""; ?> class="frm_input full_input <?php echo $config['cf_req_tel']?"required":""; ?>" maxlength="20" placeholder="전화번호">
					<?php }  ?>
					</li>
					<li>
					<?php if ($config['cf_use_hp'] || ($config["cf_cert_use"] && ($config['cf_cert_hp'] || $config['cf_cert_simple']))) {  ?>
						<label for="reg_mb_hp"><span class="<?php if (!empty($hp_required)) { ?> required <?php } ?>">대표핸드폰 <?php echo $desc_phone ?></span></label>
						
						<div class="input-area hp-area">
							<?php $hp_arr = explode('-', get_text($member['mb_hp'])); ?>
							<input type="hidden" name="mb_hp" id="reg_mb_hp" value="<?php echo get_text($member['mb_hp']) ?>" <?php echo $hp_required; ?> <?php echo $hp_readonly; ?>>
							<!-- <input type="text" name="mb_hp" value="<?php echo get_text($member['mb_hp']) ?>" id="reg_mb_hp" class="frm_input full_input <?php echo $hp_required; ?> <?php echo $hp_readonly; ?>" maxlength="20" placeholder="휴대폰번호"> -->
							<input type="text" name="mb_hp_arr" id="mb_hp_arr1" required value="<?php echo $hp_arr[0] ?>">
							<span>-</span>
							<input type="text" name="mb_hp_arr" id="mb_hp_arr2" required value="<?php echo $hp_arr[1] ?>">
							<span>-</span>
							<input type="text" name="mb_hp_arr" id="mb_hp_arr3" required value="<?php echo $hp_arr[2] ?>">

							<?php if ($config['cf_cert_use'] && ($config['cf_cert_hp'] || $config['cf_cert_simple'])) { ?>
								<input type="hidden" name="old_mb_hp" value="<?php echo get_text($member['mb_hp']) ?>">
							<?php } ?>
						</div>
					<?php }  ?>
					</li>

					<li>
						<label for="reg_mb_email"><span class="<?php echo $required ?>">대표이메일</span>
						<?php $mail_arr = explode('@', get_text($member['mb_email'])); ?>

						<?php if ($config['cf_use_email_certify']) {  ?>
						<button type="button" class="tooltip_icon"><i class="fa fa-question-circle-o" aria-hidden="true"></i><span class="sound_only">설명보기</span></button>
						<span class="tooltip">
							<?php if ($w=='') { echo "E-mail 로 발송된 내용을 확인한 후 인증하셔야 회원가입이 완료됩니다."; }  ?>
							<?php if ($w=='u') { echo "E-mail 주소를 변경하시면 다시 인증하셔야 합니다."; }  ?>
						</span>
						<?php }  ?>
						</label>

						<div class="input-area mail-area">
							<input type="hidden" name="old_email" value="<?php echo $member['mb_email'] ?>">
							<input type="hidden" name="mb_email" value="<?php echo isset($member['mb_email'])? $member['mb_email']: ''; ?>" id="reg_mb_email" required class="frm_input email full_input required" size="70" maxlength="100" placeholder="E-mail">
							<input type="text" name="mb_email_arr" id="mb_email_arr1" required value="<?php echo $mail_arr[0] ?>">
							<span>@</span>
							<input type="text" name="mb_email_arr" id="mb_email_arr2" required value="<?php echo $mail_arr[1] ?>">
							<select name="mailDom" id="mailDom">
								<option value="직접입력">직접입력</option>
								<option value="daum.net">daum.net</option>
								<option value="naver.com">naver.com</option>
								<option value="nate.com">nate.com</option>
								<option value="gmail.com">gmail.com</option>
							</select>
						</div>
					</li>
		
					<?php if ($config['cf_use_addr']) { ?>
					<li>
						<label><span class="<?php if ($config['cf_req_addr']) { ?>required<?php }  ?>">주소</span></label>
						<div class="input-area addr-area">
							<label for="reg_mb_zip" class="sound_only">우편번호<?php echo $config['cf_req_addr']?' (필수)':''; ?></label>
							<input type="text" name="mb_zip" value="<?php echo $member['mb_zip1'].$member['mb_zip2']; ?>" id="reg_mb_zip" readonly <?php echo $config['cf_req_addr']?"required":""; ?> class="frm_input twopart_input" size="5" maxlength="6"  placeholder="우편번호">
							<button type="button" class="btn_frmline" onclick="win_zip('fregisterform', 'mb_zip', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');">우편번호찾기</button><br>
							<input type="text" name="mb_addr1" value="<?php echo get_text($member['mb_addr1']) ?>" id="reg_mb_addr1" readonly <?php echo $config['cf_req_addr']?"required":""; ?> class="frm_input frm_address full_input" size="50"  placeholder="기본주소">
							<label for="reg_mb_addr1" class="sound_only">기본주소<?php echo $config['cf_req_addr']?' (필수)':''; ?></label><br>
							<input type="text" name="mb_addr2" value="<?php echo get_text($member['mb_addr2']) ?>" id="reg_mb_addr2" class="frm_input frm_address full_input" size="50" placeholder="상세주소">
							<label for="reg_mb_addr2" class="sound_only">상세주소</label>
							<div class="hidden">
								<input type="text" name="mb_addr3" value="<?php echo get_text($member['mb_addr3']) ?>" id="reg_mb_addr3" class="frm_input frm_address full_input" size="50" readonly="readonly" placeholder="참고항목">
								<label for="reg_mb_addr3" class="sound_only">참고항목</label>
								<input type="hidden" name="mb_addr_jibeon" value="<?php echo get_text($member['mb_addr_jibeon']); ?>">
							</div>
						</div>
					</li>
					<?php }  ?>
				</ul>
			</div>
		
			<div class="tbl_frm01 tbl_wrap register_form_inner dpnone">
				<ul>
					<?php if ($config['cf_use_signature']) {  ?>
					<li>
						<label for="reg_mb_signature">서명<?php if ($config['cf_req_signature']){ ?> (필수)<?php } ?></label>
						<textarea name="mb_signature" id="reg_mb_signature" <?php echo $config['cf_req_signature']?"required":""; ?> class="<?php echo $config['cf_req_signature']?"required":""; ?>"   placeholder="서명"><?php echo $member['mb_signature'] ?></textarea>
					</li>
					<?php }  ?>
		
					<?php if ($config['cf_use_profile']) {  ?>
					<li>
						<label for="reg_mb_profile">자기소개</label>
						<textarea name="mb_profile" id="reg_mb_profile" <?php echo $config['cf_req_profile']?"required":""; ?> class="<?php echo $config['cf_req_profile']?"required":""; ?>" placeholder="자기소개"><?php echo $member['mb_profile'] ?></textarea>
					</li>
					<?php }  ?>
		
					<?php if ($config['cf_use_member_icon'] && $member['mb_level'] >= $config['cf_icon_level']) {  ?>
					<li>
						<label for="reg_mb_icon" class="frm_label">
							회원아이콘
							<button type="button" class="tooltip_icon"><i class="fa fa-question-circle-o" aria-hidden="true"></i><span class="sound_only">설명보기</span></button>
							<span class="tooltip">이미지 크기는 가로 <?php echo $config['cf_member_icon_width'] ?>픽셀, 세로 <?php echo $config['cf_member_icon_height'] ?>픽셀 이하로 해주세요.<br>
	gif, jpg, png파일만 가능하며 용량 <?php echo number_format($config['cf_member_icon_size']) ?>바이트 이하만 등록됩니다.</span>
						</label>
						<input type="file" name="mb_icon" id="reg_mb_icon">
		
						<?php if ($w == 'u' && file_exists($mb_icon_path)) {  ?>
						<img src="<?php echo $mb_icon_url ?>" alt="회원아이콘">
						<input type="checkbox" name="del_mb_icon" value="1" id="del_mb_icon">
						<label for="del_mb_icon" class="inline">삭제</label>
						<?php }  ?>
					
					</li>
					<?php }  ?>
		
					<?php if ($member['mb_level'] >= $config['cf_icon_level'] && $config['cf_member_img_size'] && $config['cf_member_img_width'] && $config['cf_member_img_height']) {  ?>
					<li class="reg_mb_img_file">
						<label for="reg_mb_img" class="frm_label">
							회원이미지
							<button type="button" class="tooltip_icon"><i class="fa fa-question-circle-o" aria-hidden="true"></i><span class="sound_only">설명보기</span></button>
							<span class="tooltip">이미지 크기는 가로 <?php echo $config['cf_member_img_width'] ?>픽셀, 세로 <?php echo $config['cf_member_img_height'] ?>픽셀 이하로 해주세요.<br>
							gif, jpg, png파일만 가능하며 용량 <?php echo number_format($config['cf_member_img_size']) ?>바이트 이하만 등록됩니다.</span>
						</label>
						<input type="file" name="mb_img" id="reg_mb_img">
		
						<?php if ($w == 'u' && file_exists($mb_img_path)) {  ?>
						<img src="<?php echo $mb_img_url ?>" alt="회원이미지">
						<input type="checkbox" name="del_mb_img" value="1" id="del_mb_img">
						<label for="del_mb_img" class="inline">삭제</label>
						<?php }  ?>
					
					</li>
					<?php } ?>

					<li class="chk_box">
						<input type="checkbox" name="mb_mailling" value="1" id="reg_mb_mailling" <?php echo ($w=='' || $member['mb_mailling'])?'checked':''; ?> class="selec_chk">
						<label for="reg_mb_mailling">
							<span></span>
							<b class="sound_only">메일링서비스</b>
						</label>
						<span class="chk_li">정보 메일을 받겠습니다.</span>
					</li>
		
					<?php if ($config['cf_use_hp']) { ?>
					<li class="chk_box">
						<input type="checkbox" name="mb_sms" value="1" id="reg_mb_sms" <?php echo ($w=='' || $member['mb_sms'])?'checked':''; ?> class="selec_chk">
						<label for="reg_mb_sms">
							<span></span>
							<b class="sound_only">SMS 수신여부</b>
						</label>        
						<span class="chk_li">휴대폰 문자메세지를 받겠습니다.</span>
					</li>
					<?php } ?>
		
					<?php if (isset($member['mb_open_date']) && $member['mb_open_date'] <= date("Y-m-d", G5_SERVER_TIME - ($config['cf_open_modify'] * 86400)) || empty($member['mb_open_date'])) { // 정보공개 수정일이 지났다면 수정가능 ?>
					<li class="chk_box dpnone">
						<input type="checkbox" name="mb_open" value="1" id="reg_mb_open" <?php echo ($w=='' || $member['mb_open'])?'checked':''; ?> class="selec_chk">
						<label for="reg_mb_open">
							<span></span>
							<b class="sound_only">정보공개</b>
						</label>      
						<span class="chk_li">다른분들이 나의 정보를 볼 수 있도록 합니다.</span>
						<button type="button" class="tooltip_icon"><i class="fa fa-question-circle-o" aria-hidden="true"></i><span class="sound_only">설명보기</span></button>
						<span class="tooltip">
							정보공개를 바꾸시면 앞으로 <?php echo (int)$config['cf_open_modify'] ?>일 이내에는 변경이 안됩니다.
						</span>
						<input type="hidden" name="mb_open_default" value="<?php echo $member['mb_open'] ?>"> 
					</li>		        
					<?php } else { ?>
					<li>
						정보공개
						<input type="hidden" name="mb_open" value="<?php echo $member['mb_open'] ?>">
						<button type="button" class="tooltip_icon"><i class="fa fa-question-circle-o" aria-hidden="true"></i><span class="sound_only">설명보기</span></button>
						<span class="tooltip">
							정보공개는 수정후 <?php echo (int)$config['cf_open_modify'] ?>일 이내, <?php echo date("Y년 m월 j일", isset($member['mb_open_date']) ? strtotime("{$member['mb_open_date']} 00:00:00")+$config['cf_open_modify']*86400:G5_SERVER_TIME+$config['cf_open_modify']*86400); ?> 까지는 변경이 안됩니다.<br>
							이렇게 하는 이유는 잦은 정보공개 수정으로 인하여 쪽지를 보낸 후 받지 않는 경우를 막기 위해서 입니다.
						</span>
						
					</li>
					<?php }  ?>
		
					<?php
					//회원정보 수정인 경우 소셜 계정 출력
					if( $w == 'u' && function_exists('social_member_provider_manage') ){
						social_member_provider_manage();
					}
					?>
					
					<?php if ($w == "" && $config['cf_use_recommend']) {  ?>
					<li>
						<label for="reg_mb_recommend" class="sound_only">추천인아이디</label>
						<input type="text" name="mb_recommend" id="reg_mb_recommend" class="frm_input" placeholder="추천인아이디">
					</li>
					<?php }  ?>
		
					<!-- <li class="is_captcha_use">
						자동등록방지
						<?php // echo captcha_html(); ?>
					</li> -->
				</ul>
			</div>
			<div class="btn_confirm">
				<?php if(!$is_update) { ?><a href="<?php echo G5_URL ?>" class="btn_close btn-reset">취소</a><?php } ?>
				<button id="btn_submit" class="btn_submit btn-point" accesskey="s" onclick="return chkBeforeSubmit(this);"><?php echo $w==''?'회원가입':'회원정보수정'; ?></button>
			</div>
		</form>
	</section>
</article>
<script>
$(function() {
    $("#reg_zip_find").css("display", "inline-block");
    var pageTypeParam = "pageType=register";

	<?php if($config['cf_cert_use'] && $config['cf_cert_simple']) { ?>
	// 이니시스 간편인증
	var url = "<?php echo G5_INICERT_URL; ?>/ini_request.php";
	var type = "";    
    var params = "";
    var request_url = "";

	$(".win_sa_cert").click(function() {
		if(!cert_confirm()) return false;
		type = $(this).data("type");
        params = "?directAgency=" + type + "&" + pageTypeParam;
        request_url = url + params;
        call_sa(request_url);
	});
    <?php } ?>
    <?php if($config['cf_cert_use'] && $config['cf_cert_ipin']) { ?>
    // 아이핀인증
    var params = "";
    $("#win_ipin_cert").click(function() {
		if(!cert_confirm()) return false;
        params = "?" + pageTypeParam;
        var url = "<?php echo G5_OKNAME_URL; ?>/ipin1.php"+params;
        certify_win_open('kcb-ipin', url);
        return;
    });

    <?php } ?>
    <?php if($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
    // 휴대폰인증
    var params = "";
    $("#win_hp_cert").click(function() {
		if(!cert_confirm()) return false;
        params = "?" + pageTypeParam;
        <?php     
        switch($config['cf_cert_hp']) {
            case 'kcb':                
                $cert_url = G5_OKNAME_URL.'/hpcert1.php';
                $cert_type = 'kcb-hp';
                break;
            case 'kcp':
                $cert_url = G5_KCPCERT_URL.'/kcpcert_form.php';
                $cert_type = 'kcp-hp';
                break;
            case 'lg':
                $cert_url = G5_LGXPAY_URL.'/AuthOnlyReq.php';
                $cert_type = 'lg-hp';
                break;
            default:
                echo 'alert("기본환경설정에서 휴대폰 본인확인 설정을 해주십시오");';
                echo 'return false;';
                break;
        }
        ?>
        
        certify_win_open("<?php echo $cert_type; ?>", "<?php echo $cert_url; ?>"+params);
        return;
    });
    <?php } ?>
});

// submit 최종 폼체크
function fregisterform_submit(f)
{
    // 회원아이디 검사
    if (f.w.value == "") {
        var msg = reg_mb_id_check();
        if (msg) {
            alert(msg);
            f.mb_id.select();
            return false;
        }
    }

    if (f.w.value == "") {
        if (f.mb_password.value.length < 3) {
            alert("비밀번호를 3글자 이상 입력하십시오.");
            f.mb_password.focus();
            return false;
        }
    }

    if (f.mb_password.value != f.mb_password_re.value) {
        alert("비밀번호가 같지 않습니다.");
        f.mb_password_re.focus();
        return false;
    }

    if (f.mb_password.value.length > 0) {
        if (f.mb_password_re.value.length < 3) {
            alert("비밀번호를 3글자 이상 입력하십시오.");
            f.mb_password_re.focus();
            return false;
        }
    }

    // 이름 검사
    if (f.w.value=="") {
        if (f.mb_name.value.length < 1) {
            alert("이름을 입력하십시오.");
            f.mb_name.focus();
            return false;
        }

        /*
        var pattern = /([^가-힣\x20])/i;
        if (pattern.test(f.mb_name.value)) {
            alert("이름은 한글로 입력하십시오.");
            f.mb_name.select();
            return false;
        }
        */
    }

    <?php if($w == '' && $config['cf_cert_use'] && $config['cf_cert_req']) { ?>
    // 본인확인 체크
    if(f.cert_no.value=="") {
        alert("회원가입을 위해서는 본인확인을 해주셔야 합니다.");
        return false;
    }
    <?php } ?>

    // 닉네임 검사
    // if ((f.w.value == "") || (f.w.value == "u" && f.mb_nick.defaultValue != f.mb_nick.value)) {
    //     var msg = reg_mb_nick_check();
    //     if (msg) {
    //         alert(msg);
    //         f.reg_mb_nick.select();
    //         return false;
    //     }
    // }

    // E-mail 검사
    if ((f.w.value == "") || (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {
        var msg = reg_mb_email_check();
        if (msg) {
            alert(msg);
            f.reg_mb_email.select();
            return false;
        }
    }

    <?php if (($config['cf_use_hp'] || $config['cf_cert_hp']) && $config['cf_req_hp']) {  ?>
    // 휴대폰번호 체크
    var msg = reg_mb_hp_check();
    if (msg) {
        alert(msg);
        f.reg_mb_hp.select();
        return false;
    }
    <?php } ?>

    if (typeof f.mb_icon != "undefined") {
        if (f.mb_icon.value) {
            if (!f.mb_icon.value.toLowerCase().match(/.(gif|jpe?g|png)$/i)) {
                alert("회원아이콘이 이미지 파일이 아닙니다.");
                f.mb_icon.focus();
                return false;
            }
        }
    }

    if (typeof f.mb_img != "undefined") {
        if (f.mb_img.value) {
            if (!f.mb_img.value.toLowerCase().match(/.(gif|jpe?g|png)$/i)) {
                alert("회원이미지가 이미지 파일이 아닙니다.");
                f.mb_img.focus();
                return false;
            }
        }
    }

    if (typeof(f.mb_recommend) != "undefined" && f.mb_recommend.value) {
        if (f.mb_id.value == f.mb_recommend.value) {
            alert("본인을 추천할 수 없습니다.");
            f.mb_recommend.focus();
            return false;
        }

        var msg = reg_mb_recommend_check();
        if (msg) {
            alert(msg);
            f.mb_recommend.select();
            return false;
        }
    }

	// 자동등록방지 js
    <?php //echo chk_captcha_js();  ?>

    document.getElementById("btn_submit").disabled = "disabled";

    return true;
}

jQuery(function($){
	//tooltip
    $(document).on("click", ".tooltip_icon", function(e){
        $(this).next(".tooltip").fadeIn(400).css("display","inline-block");
    }).on("mouseout", ".tooltip_icon", function(e){
        $(this).next(".tooltip").fadeOut();
    });
});

</script>

<script>
	// 아이디 중복 버튼 250117 박예진
	let isIdChk = false;

	const idChk = function(el) {
		var msg = reg_mb_id_check();
		const f = el.closest('form');
        if (msg) {
            alert(msg);
            f.mb_id.select();
            return false;
        } else {
			alert('사용 가능한 아이디입니다');
			isIdChk = true;
		}
	}
	

	const chkBeforeSubmit = function(el) {
		const frm = el.closest('form');

		if(!isIdChk) { // 아이디 검사
			alert('아이디 중복확인을 해주세요');
			return false;
		}

		frm.mb_hp.value = frm.mb_hp_arr[0].value + '-' + frm.mb_hp_arr[1].value + '-' + frm.mb_hp_arr[2].value;
		frm.mb_email.value = frm.mb_email_arr[0].value + '@' + frm.mb_email_arr[1].value;

		return true;
	}

	// 이메일 선택
	document.querySelector('#mailDom').addEventListener('change', e => {
		const thisVal = e.target.options[e.target.selectedIndex].value;
		const mail2 = document.querySelector('#mb_email_arr2');

		if(thisVal == '직접입력') {
			mail2.value = '';
		} else {
			mail2.value = thisVal;
		}
	});
</script>
<!-- } 회원정보 입력/수정 끝 -->