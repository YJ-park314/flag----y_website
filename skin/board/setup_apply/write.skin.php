<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
 
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript(G5_POSTCODE_JS, 0); //다음 주소 js

$relation = explode(',', $write['wr_4']);
$hp = explode('-', $write['wr_5']);
$addr = explode(',', $write['wr_6']);
$addr_zip = $addr[0];
?>

<!-- 비주얼 --> 
<?php 
    $vis_id = 'setup-list1';
    $vis_name = '깃발배송';
    $vis_desc = '배송 요청부터 설치 내역까지, 손쉽게 관리하세요.';
    include_once(G5_THEME_PATH.'/component/visual.php');
?>

<section id="bo_w" class="apply setup">
    <div class="tit-area">
        <h2 class="bo-tit"><?php echo $board['bo_subject'] ?> <span class="sound_only">글쓰기</span></h2>
        <!-- 배송 공통 탭메뉴 -->
        <?php include_once(G5_THEME_PATH.'/component/setup_tab_menu.php'); ?>
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
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <!-- 상태 -->
    <input type="hidden" name="wr_9" value="<?php echo $write['wr_9'] == '' ? '주문접수' : $write['wr_9']; ?>">
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

    <div class="write_div">
        <label for="wr_1" class="con-label"><span class="required">단체명<strong class="sound_only">필수</strong></span></label>
        <div>
            <select name="wr_1" id="wr_1" required>
                <option value="">연결된 단체 없음</option>
                <option value="HASY">HASY</option>
                <option value="플렉하이웨이">플렉하이웨이</option>
            </select>
            <button type="button" class="btn-black fit">보관깃발 확인</button>
        </div>
    </div>

    <div class="bo_w_tit write_div">
        <label for="wr_subject" class="con-label"><span class="required">신청자<strong class="sound_only">필수</strong></span></label>
        <div id="autosave_wrapper">
            <input type="text" name="wr_subject" readonly value="<?php echo $member['mb_name']; ?>" id="wr_subject" required class="frm_input full_input" size="50" maxlength="255">
        </div>
    </div>

    <div class="write_div">
        <label for="wr_2" class="con-label"><span class="required">신청자 연락처<strong class="sound_only">필수</span></strong></label>
        <div>
            <input type="text" id="wr_2" name="wr_2" readonly value="<?php echo $member['mb_hp'] ?>">
        </div>
    </div>

    <div class="write_div">
        <label for="wr_3" class="con-label"><span class="required">구분<strong class="sound_only">필수</span></strong></label>
        <div>
            <select name="wr_3" id="wr_3" value="<?php echo $write['wr_3']; ?>" required>
                <option value="근조기">근조기</option>
                <option value="회사·단체기">회사·단체기</option>
                <option value="경하기">경하기</option>
            </select>
        </div>
    </div>

    <div class="write_div fit">
        <label for="wr_4_1" class="con-label"><span class="required">회원·상주(고인과의관계)<strong class="sound_only">필수</span></strong></label>
        <div>
            <input type="text" name="relation[0]" id="wr_4_1" value="<?php echo $relation[0]; ?>" required>
            <select name="relation[1]" id="wr_4_2" value="<?php echo $relation[1]; ?>" required>
                <option value="본인">본인</option>
                <option value="모친">모친</option>
                <option value="부친">부친</option>
                <option value="부친">그 외 친족</option>
            </select>
        </div>
    </div> 

    <div class="write_div fit">
        <label for="wr_5_1" class="con-label"><span class="required">회원·상주 연락처<strong class="sound_only">필수</span></strong></label>
        <div>
            <select name="hp[0]" id="wr_5_1" value="<?php echo $hp[0]; ?>">
                <option value="010">010</option>
                <option value="011">011</option>
                <option value="016">016</option>
                <option value="017">017</option>
                <option value="018">018</option>
                <option value="019">019</option>
            </select> -
            <input type="text" name="hp[1]" id="wr_5_2" value="<?php echo $hp[1]; ?>" required> -
            <input type="text" name="hp[2]" id="wr_5_3" value="<?php echo $hp[2]; ?>" required>
        </div>
    </div>

    <div class="write_div flex-wrap">
        <label for="reg_mb_zip" class="con-label"><span class="required">설치장소<strong class="sound_only">필수</span></strong></label>
        <div class="input-area addr-area">
            <label for="reg_mb_zip" class="sound_only">우편번호 (필수)</label>
            <input type="text" name="addr_zip" value="<?php echo $addr_zip; ?>" id="reg_mb_zip" readonly="" required="" class="frm_input twopart_input" size="5" maxlength="6" placeholder="우편번호">
            <button type="button" class="btn_frmline fit" onclick="win_zip('fwrite', 'addr_zip', 'addr[1]', 'addr[2]', 'addr[3]', 'mb_addr_jibeon');">우편번호찾기</button>
            <label for="reg_mb_addr1" class="sound_only">기본주소 (필수)</label><br class="pc">
            <input type="text" name="addr[1]" value="<?php echo $addr[1]; ?>" id="reg_mb_addr1" readonly="" required="" class="frm_input frm_address full_input" size="50" placeholder="기본주소">
            <label for="reg_mb_addr2" class="sound_only">상세주소</label>
            <input type="text" name="addr[2]" value="<?php echo $addr[2]; ?>" id="reg_mb_addr2" class="frm_input frm_address full_input" size="50" placeholder="장소 관련 상세주소 또는 상세정보를 입력해 주세요.">
            <p class="guide">※ 행사장명을 지역 포함해서 정확히 입력해 주십시오. 예) 서울 OO병원, 대전 OO 웨딩홀, 부산 OO호텔</p>
            <div class="hidden">
                <input type="text" name="addr[3]" value="<?php echo get_text($addr[3]) ?>" id="reg_mb_addr3" class="frm_input frm_address full_input" size="50" readonly="readonly" placeholder="참고항목">
                <label for="reg_mb_addr3" class="sound_only">참고항목</label>
                <input type="hidden" name="mb_addr_jibeon" value="R">
            </div>
        </div>
    </div>

    <div class="write_div">
        <label for="wr_7" class="con-label"><span class="required">배송일<strong class="sound_only">필수</span></strong></label>
        <div>
            <input type="date" name="wr_7" id="wr_7" value="<?php echo $write['wr_7']; ?>" required>
        </div>
    </div>

    <div class="write_div">
        <label for="wr_8" class="con-label"><span class="required">발인예정<strong class="sound_only">필수</span></strong></label>
        <div>
            <input type="date" name="wr_8" id="wr_8" value="<?php echo $write['wr_8']; ?>" required>
        </div>
    </div>

    <div class="write_div">
        <label for="wr_content" class="con-label">기타사항<strong class="sound_only">필수</strong></label>
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
        <a href="<?php echo get_pretty_url($bo_table).'&sca=배송요청_확인'; ?>" class="btn-reset">취소</a>
        <button type="submit" id="btn_submit" accesskey="s" class="btn-point">보관관리신청</button>
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

    document.querySelectorAll('#wr_1 option').forEach(opt => {
        if(opt.value == '<?php echo $write['wr_1']; ?>') {
            opt.selected = true;
        }
    });

    document.querySelectorAll('#wr_3 option').forEach(opt => {
        if(opt.value == '<?php echo $write['wr_3']; ?>') {
            opt.selected = true;
        }
    });

    // 배송요청 확인 카테고리로 세팅
    const ctgrSel = document.querySelector('#ca_name');
    if(!ctgrSel.value) {
        ctgrSel.options[1].selected = true;
    }
</script>