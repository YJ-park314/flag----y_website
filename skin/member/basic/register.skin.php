<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!-- 비주얼 -->
<?php 
    $vis_id = 'regi';
    $vis_name = '회원가입';
    $vis_desc = '믿음과 신뢰를 바탕으로 고객과의 약속을 지키겠습니다.';
    include_once(G5_THEME_PATH.'/component/visual.php');
?>

<!-- 회원가입약관 동의 시작 { -->
<article id="register" class="register wrap2">
    <form  name="fregister" id="fregister" action="<?php echo $register_action_url ?>" onsubmit="return fregister_submit(this);" method="POST" autocomplete="off">
        <h2 class="sound_only"> 회원가입 본문영역</h2>
        <p class="bo-tit">회원가입</p>
        <p class="summary">회원가입약관 및 개인정보처리방침안내 약관에 동의하셔야 회원가입 하실 수 있습니다.</p>
        
        <?php
        // 소셜로그인 사용시 소셜로그인 버튼
        @include_once(get_social_skin_path().'/social_register.skin.php');
        ?>
        <section id="fregister_term">
            <h3>회원가입약관</h3>
            <textarea readonly><?php echo get_text($config['cf_stipulation']) ?></textarea>
            <fieldset class="fregister_agree">
                <input type="checkbox" name="agree" value="1" id="agree11" class="selec_chk">
                <label for="agree11"><span></span><b>회원가입약관의 내용에 동의합니다.</b></label>
            </fieldset>
        </section>

        <section id="fregister_private">
            <h3>개인정보취급방침</h3>
            <textarea readonly><?php echo get_text($config['cf_privacy']) ?></textarea>

            <fieldset class="fregister_agree">
                <input type="checkbox" name="agree2" value="1" id="agree21" class="selec_chk">
                <label for="agree21"><span></span><b>개인정보 수집 및 이용의 내용에 동의합니다.</b></label>
        </fieldset>
        </section>
        
        <div id="fregister_chkall" class="chk_all fregister_agree">
            <input type="checkbox" name="chk_all" id="chk_all" class="selec_chk">
            <label for="chk_all"><span></span>회원가입 약관에 모두 동의합니다</label>
        </div>
            
        <div class="btn_confirm">
            <a href="<?php echo G5_URL ?>" class="btn-reset">취소</a>
            <button type="submit" class="btn-point">회원가입 하기</button>
        </div>
    </form>

    <script>
    function fregister_submit(f)
    {
        if (!f.agree.checked) {
            alert("회원가입약관의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
            f.agree.focus();
            return false;
        }

        if (!f.agree2.checked) {
            alert("개인정보 수집 및 이용의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
            f.agree2.focus();
            return false;
        }

        return true;
    }
    
    jQuery(function($){
        // 모두선택
        $("input[name=chk_all]").click(function() {
            if ($(this).prop('checked')) {
                $("input[name^=agree]").prop('checked', true);
            } else {
                $("input[name^=agree]").prop("checked", false);
            }
        });
    });
    </script>
</article>
<!-- } 회원가입 약관 동의 끝 -->
