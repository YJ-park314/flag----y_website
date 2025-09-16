<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
 
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript(G5_POSTCODE_JS, 0); //다음 주소 js

$hp = explode('-', $write['wr_3']);
$ml = explode('@', $write['wr_4']);
$addr = explode(',', $write['wr_5']);
$addr_zip = $addr[0];
$flag = explode(',', $write['wr_6']); 
$ml_sub = explode('@', $write['wr_9']);
?>
 
<!-- 비주얼 --> 
<?php 
    $vis_id = 'keep-detail';
    $vis_name = $board['bo_subject'];
    $vis_desc = '간편하게 깃발 보관관리를 신청하세요.';
    include_once(G5_THEME_PATH.'/component/visual.php');
?>

<section id="bo_w" class="apply">
    <div class="tit-area keep">
        <h2 class="bo-tit"><?php echo $board['bo_subject'] ?> <span class="sound_only">글쓰기</span></h2>
        <p>보관신청서 작성을 위해서 · 개인정보 수집 및 이용에 대한 안내를 읽고 동의해 주세요.</p>
    </div>


    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="wr_10" id="wr_10" value="<?php echo $write['wr_10']; ?>">
    <input type="hidden" name="wr_11" id="wr_11" value="<?php echo $write['wr_11']; ?>">
    <input type="hidden" name="wr_12" value="<?php echo $write['wr_12'] == '' ? '변경' : $write['wr_12']; ?>">
    <input type="hidden" name="wr_13" value="<?php echo $write['wr_13'] == '' ? '접수' : $write['wr_13'];; ?>">
    <input type="hidden" name="wr_14" value="<?php echo $write['wr_14'] == '' ? '-' : $write['wr_14'];; ?>">
    <!-- 상태 -->
    <?php
    $option = '';
    $option_hidden = '';
    if ($is_notice || $is_html || $is_secret || $is_mail) { 
        $option = '';
        // if ($is_notice) {
        //     $option .= PHP_EOL.'<li class="chk_box"><input type="checkbox" id="notice" name="notice"  class="selec_chk" value="1" '.$notice_checked.'>'.PHP_EOL.'<label for="notice"><span></span>공지</label></li>';
        // }
        // if ($is_html) {
        //     if ($is_dhtml_editor) {
        //         $option_hidden .= '<input type="hidden" value="html1" name="html">';
        //     } else {
        //         $option .= PHP_EOL.'<li class="chk_box"><input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" class="selec_chk" value="'.$html_value.'" '.$html_checked.'>'.PHP_EOL.'<label for="html"><span></span>html</label></li>';
        //     }
        // }
        if ($is_secret) {
            if ($is_admin || $is_secret==1) {
                $option .= PHP_EOL.'<li class="chk_box"><input type="checkbox" id="secret" name="secret"  class="selec_chk" value="secret" '.$secret_checked.'>'.PHP_EOL.'<label for="secret"><span></span>비밀글</label></li>';
            } else {
                $option_hidden .= '<input type="hidden" name="secret" value="secret">';
            }
        }
        if ($is_mail) {
            $option .= PHP_EOL.'<li class="chk_box"><input type="checkbox" id="mail" name="mail"  class="selec_chk" value="mail" '.$recv_email_checked.'>'.PHP_EOL.'<label for="mail"><span></span>답변메일받기</label></li>';
        }
    }
    echo $option_hidden;
    ?>

    <?php if ($is_category) { ?>
    <div class="bo_w_select write_div dpnone">
        <label for="ca_name" class="sound_only">분류<strong>필수</strong></label>
        <select name="ca_name" id="ca_name">
            <option value="">분류를 선택하세요</option>
            <?php echo $category_option ?>
        </select>
    </div>
    <?php } ?>

    <div class="bo_w_info write_div dpnone">
	    <?php if ($is_name) { ?>
	        <label for="wr_name" class="sound_only">이름<strong>필수</strong></label>
	        <input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="frm_input half_input required" placeholder="이름">
	    <?php } ?>
	
	    <?php if ($is_password) { ?>
	        <label for="wr_password" class="sound_only">비밀번호<strong>필수</strong></label>
	        <input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> class="frm_input half_input <?php echo $password_required ?>" placeholder="비밀번호">
	    <?php } ?>
	
	    <?php if ($is_email) { ?>
			<label for="wr_email" class="sound_only">이메일</label>
			<input type="text" name="wr_email" value="<?php echo $email ?>" id="wr_email" class="frm_input half_input email " placeholder="이메일">
	    <?php } ?>
	    
	
	    <?php if ($is_homepage) { ?>
	        <label for="wr_homepage" class="sound_only">홈페이지</label>
	        <input type="text" name="wr_homepage" value="<?php echo $homepage ?>" id="wr_homepage" class="frm_input half_input" size="50" placeholder="홈페이지">
	    <?php } ?>
	</div>
	
    <?php if ($option) { ?>
    <div class="write_div">
        <span class="sound_only">옵션</span>
        <ul class="bo_v_option">
        <?php echo $option ?>
        </ul>
    </div>
    <?php } ?>

    <div class="bo_w_tit write_div">
        <label for="wr_subject" class="con-label"><span class="required">단체명<strong class="sound_only">필수</strong></span></label>
        <div id="autosave_wrapper">
            <input type="text" name="wr_subject" id="wr_subject" value="<?php echo $write['wr_subject'] ?>" required class="frm_input full_input" size="50" maxlength="255">
        </div>
    </div>

    <div class="write_div">
        <label for="wr_1" class="con-label"><span class="required">대표전화<strong class="sound_only">필수</strong></span></label>
        <div>
            <input type="text" name="wr_1" id="wr_1" value="<?php echo $write['wr_1'] ?>">
        </div>
    </div>

    
    
    <div class="write_div">
        <label for="wr_2" class="con-label"><span class="required">대표팩스<strong class="sound_only">필수</span></strong></label>
        <div>
            <input type="text" id="wr_2" name="wr_2" value="<?php echo $write['wr_2'] ?>">
        </div>
    </div>

    <div class="write_div fit">
        <label for="wr_3_1" class="con-label"><span class="required">대표 핸드폰<strong class="sound_only">필수</span></strong></label>
        <div>
            <select name="hp[0]" id="wr_3_1" value="<?php echo $hp[0]; ?>">
                <option value="010">010</option>
                <option value="011">011</option>
                <option value="016">016</option>
                <option value="017">017</option>
                <option value="018">018</option>
                <option value="019">019</option>
            </select> -
            <input type="text" name="hp[1]" id="wr_3_2" value="<?php echo $hp[1]; ?>" required> -
            <input type="text" name="hp[2]" id="wr_3_3" value="<?php echo $hp[2]; ?>" required>
        </div>
    </div>
    

    <div class="write_div wide">
        <label for="wr_4_1" class="con-label"><span class="required">대표 이메일<strong class="sound_only">필수</span></strong></label>
        <div>
            <input type="text" name="ml[0]" id="wr_4_1" value="<?php echo $ml[0]; ?>" required> @
            <input type="text" name="ml[1]" id="wr_4_2" value="<?php echo $ml[1]; ?>" placeholder="선택해주세요" required>
            <select name="mailDom" id="mailDom" onchange="setMail(this.event, this);">
                <option value="직접입력">직접입력</option>
                <option value="daum.net">daum.net</option>
                <option value="naver.com">naver.com</option>
                <option value="nate.com">nate.com</option>
                <option value="gmail.com">gmail.com</option>
            </select>
        </div>
    </div>

    <div class="write_div flex-wrap wide">
        <label for="reg_mb_zip" class="con-label"><span class="required">주소(깃발)<strong class="sound_only">필수</span></strong></label>
        <div class="input-area addr-area">
            <label for="reg_mb_zip" class="sound_only">우편번호 (필수)</label>
            <input type="text" name="addr_zip" value="<?php echo $addr_zip; ?>" id="reg_mb_zip" readonly="" required="" class="frm_input twopart_input" size="5" maxlength="6" placeholder="우편번호">
            <button type="button" class="btn_frmline fit" onclick="win_zip('fwrite', 'addr_zip', 'addr[1]', 'addr[2]', 'addr[3]', 'mb_addr_jibeon');">우편번호찾기</button><br>
            <label for="reg_mb_addr1" class="sound_only">기본주소 (필수)</label><br>
            <input type="text" name="addr[1]" value="<?php echo $addr[1]; ?>" id="reg_mb_addr1" readonly="" required="" class="frm_input frm_address full_input" size="50" placeholder="기본주소">
            <label for="reg_mb_addr2" class="sound_only">상세주소</label>
            <input type="text" name="addr[2]" value="<?php echo $addr[2]; ?>" id="reg_mb_addr2" class="frm_input frm_address full_input" size="50" placeholder="상세주소">
            <div class="hidden">
                <input type="text" name="addr[3]" value="<?php echo get_text($addr[3]) ?>" id="reg_mb_addr3" class="frm_input frm_address full_input" size="50" readonly="readonly" placeholder="참고항목">
                <label for="reg_mb_addr3" class="sound_only">참고항목</label>
                <input type="hidden" name="mb_addr_jibeon" value="R">
            </div>
        </div>
    </div>

    <div class="write_div fit flex flag">
        <label for="wr_6" class="con-label"><span class="required">보관수량<strong class="sound_only">필수</span></strong></label>
        <div>
            <p><span>근조기</span> <input type="text" name="flag[0]" id="wr_6_1" value="<?php echo $flag[0]; ?>" required> 개</p>
            <p><span>경하기</span> <input type="text" name="flag[1]" id="wr_6_2" value="<?php echo $flag[1]; ?>" required> 개</p>
        </div>
    </div>

    <div class="write_div">
        <label for="wr_7" class="con-label"><span class="required">발인예정<strong class="sound_only">필수</span></strong></label>
        <div>
            <input type="date" name="wr_7" id="wr_7" value="<?php echo $write['wr_7']; ?>" required>
        </div>
    </div>
    
    <div class="write_div">
        <label for="wr_8" class="con-label"><span class="required">담당자 성함<strong class="sound_only">필수</span></strong></label>
        <div>
            <input type="text" name="wr_8" id="wr_8" value="<?php echo $write['wr_8']; ?>" required>
        </div>
    </div>

    <div class="write_div wide">
        <label for="wr_9_1" class="con-label"><span class="required">담당자 이메일<strong class="sound_only">필수</span></strong></label>
        <div>
            <input type="text" name="ml_sub[0]" id="wr_9_1" value="<?php echo $ml_sub[0]; ?>" required> @
            <input type="text" name="ml_sub[1]" id="wr_9_2" value="<?php echo $ml_sub[1]; ?>" placeholder="선택해주세요" required>
            <select name="mailDom" id="mailDom" onchange="setMail(this.event, this);">
                <option value="직접입력">직접입력</option>
                <option value="daum.net">daum.net</option>
                <option value="naver.com">naver.com</option>
                <option value="nate.com">nate.com</option>
                <option value="gmail.com">gmail.com</option>
            </select>
        </div>
    </div>

    <div class="write_div flex chk-area">
        <label for="bill_1" class="con-label"><span class="required">청구서 수신<strong class="sound_only">필수</span></strong></label>
        <?php $check_arr = explode(',',$write['wr_10']); ?>
        <div>
            <p><input type="checkbox" name="wr_10_arr" id="bill_1" class="selec_chk" value="문자발송" <?php if($write['wr_10'] == '') echo 'checked' ?> <?php if(in_array('문자발송', $check_arr)) echo 'checked'; ?>> <label for="bill_1"><span></span> <b>문자발송</b></label></p>
            <p><input type="checkbox" name="wr_10_arr" id="bill_2" class="selec_chk" value="메일" <?php if(in_array('메일', $check_arr)) echo 'checked'; ?>> <label for="bill_2"><span></span> <b>메일</b></label></p>
            <p><input type="checkbox" name="wr_10_arr" id="bill_3" class="selec_chk" value="팩스" <?php if(in_array('팩스', $check_arr)) echo 'checked'; ?>> <label for="bill_3"><span></span> <b>팩스</b></label></p>
            <p><input type="checkbox" name="wr_10_arr" id="bill_4" class="selec_chk" value="우편발송" <?php if(in_array('우편발송', $check_arr)) echo 'checked'; ?>> <label for="bill_4"><span></span> <b>우편발송</b></label></p>
        </div>
    </div>
    
    <div class="write_div flex chk-area">
        <label for="check_1" class="con-label"><span class="required">계산서 발행<strong class="sound_only">필수</span></strong></label>
        <?php $rdo_arr = explode(',',$write['wr_11']); ?>
        <div>
            <p><input type="radio" name="wr_11_arr" id="check_1" value="세금계산서" <?php if($write['wr_10'] == '') echo 'checked' ?> <?php if(in_array('세금계산서', $rdo_arr)) echo 'checked'; ?>> <label for="check_1">세금계산서</label></p>
            <p><input type="radio" name="wr_11_arr" id="check_2" value="필요없음" <?php if(in_array('필요없음', $rdo_arr)) echo 'checked'; ?>> <label for="check_2">필요없음</label></p>
            <p class="guide">(기타 영수증 원할시 당사에 별도 문의바랍니다.)</p>
        </div>
    </div>

    <div class="write_div">
        <label for="wr_content" class="con-label">전달사항<strong class="sound_only">필수</strong></label>
        <div class="wr_content <?php echo $is_dhtml_editor ? $config['cf_editor'] : ''; ?>">
            <?php if($write_min || $write_max) { ?>
            <!-- 최소/최대 글자 수 사용 시 -->
            <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
            <?php } ?>
            <?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
            <?php if($write_min || $write_max) { ?>
            <!-- 최소/최대 글자 수 사용 시 -->
            <div id="char_count_wrap"><span id="char_count"></span>글자</div>
            <?php } ?>
        </div>
    </div>

    <!-- <?php for ($i=1; $is_link && $i<=G5_LINK_COUNT; $i++) { ?>
    <div class="bo_w_link write_div">
        <label for="wr_link<?php echo $i ?>"><i class="fa fa-link" aria-hidden="true"></i><span class="sound_only"> 링크  #<?php echo $i ?></span></label>
        <input type="text" name="wr_link<?php echo $i ?>" value="<?php if($w=="u"){ echo $write['wr_link'.$i]; } ?>" id="wr_link<?php echo $i ?>" class="frm_input full_input" size="50">
    </div>
    <?php } ?> -->

    <?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
    <div class="bo_w_flie write_div">
        <div class="file_wr write_div">
            <label for="bf_file_<?php echo $i+1 ?>" class="lb_icon">
                <span class="sound_only"> 파일 #<?php echo $i+1 ?></span>파일첨부
            </label>
            <input type="file" name="bf_file[]" id="bf_file_<?php echo $i+1 ?>" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file sound_only">
            <span class="file-con">파일을 선택해주세요.</span>
        </div>
        <?php if ($is_file_content) { ?>
        <input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="full_input frm_input" size="50" placeholder="파일 설명을 입력해주세요.">
        <?php } ?>

        <?php if($w == 'u' && $file[$i]['file']) { ?>
        <span class="file_del">
            <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
        </span>
        <?php } ?>
        
    </div>
    <?php } ?>


    <?php if ($is_use_captcha) { //자동등록방지  ?>
    <div class="write_div">
        <?php echo $captcha_html ?>
    </div>
    <?php } ?>

    <div class="btn_confirm write_div">
        <a href="<?php echo get_pretty_url($bo_table); ?>" class="btn-reset" onclick="getBackList(this);">취소</a>
        <button type="submit" id="btn_submit" accesskey="s" class="btn-point" onclick="return setArr();">보관관리신청</button>
    </div>
    </form>

    <script>
    <?php if($write_min || $write_max) { ?>
    // 글자수 제한
    var char_min = parseInt(<?php echo $write_min; ?>); // 최소
    var char_max = parseInt(<?php echo $write_max; ?>); // 최대
    check_byte("wr_content", "char_count");

    $(function() {
        $("#wr_content").on("keyup", function() {
            check_byte("wr_content", "char_count");
        });
    });

    <?php } ?>
    function html_auto_br(obj)
    {
        if (obj.checked) {
            result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
            if (result)
                obj.value = "html2";
            else
                obj.value = "html1";
        }
        else
            obj.value = "";
    }

    function fwrite_submit(f)
    {
        <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

        var subject = "";
        var content = "";
        $.ajax({
            url: g5_bbs_url+"/ajax.filter.php",
            type: "POST",
            data: {
                "subject": f.wr_subject.value,
                "content": f.wr_content.value
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                subject = data.subject;
                content = data.content;
            }
        });

        if (subject) {
            alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
            f.wr_subject.focus();
            return false;
        }

        if (content) {
            alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
            if (typeof(ed_wr_content) != "undefined")
                ed_wr_content.returnFalse();
            else
                f.wr_content.focus();
            return false;
        }

        if (document.getElementById("char_count")) {
            if (char_min > 0 || char_max > 0) {
                var cnt = parseInt(check_byte("wr_content", "char_count"));
                if (char_min > 0 && char_min > cnt) {
                    alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                    return false;
                }
                else if (char_max > 0 && char_max < cnt) {
                    alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                    return false;
                }
            }
        }

        <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->

<script>
    document.querySelector('#wr_content').placeholder = '내용을 입력해주세요.';

    // 보관 신청한 깃발 카테고리로 세팅
    const ctgrSel = document.querySelector('#ca_name');
    ctgrSel.options[1].selected = true;

    // 이메일 선택
    function setMail(e, el) {
        const thisVal = el.options[el.selectedIndex].value;
		const mailInp = el.previousElementSibling;

		if(thisVal == '직접입력') {
			mailInp.value = '';
		} else {
			mailInp.value = thisVal;
		}
    }

    // 체크박스나 라디오 여분필드에 셋팅
    function setArr() {
        const wr_10Arr = document.querySelectorAll('input[name="wr_10_arr"]');
        const wr_10 = document.querySelector('#wr_10');

        const wr_11Arr = document.querySelectorAll('input[name="wr_11_arr"]');
        const wr_11 = document.querySelector('#wr_11');

        wr_10Arr.forEach((inp, idx) => {
            if(idx == 0) {
                wr_10.value = '';
            }

            if(inp.checked || inp.selected) {
                if(wr_10.value == '') {
                    wr_10.value = inp.value; 
                } else {
                    wr_10.value += ',' + inp.value;
                }
            }
        });

        wr_11Arr.forEach((inp, idx) => {
            if(idx == 0) {
                wr_11.value = '';
            }

            if(inp.checked) {
                if(wr_11.value == '') {
                    wr_11.value = inp.value; 
                } else {
                    wr_11.value += ',' + inp.value;
                }
            }
        });

        return true;
    }

    // 이전 페이지가 마이페이지일 경우 url 구분
    function getBackList(el) {
        if('<?php echo isset($_GET['back']) ? 'my' : 'none' ?>' == 'my') {
            el.href = '/my_history.php#manage';
        }
    }
</script>