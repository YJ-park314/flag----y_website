<?php // $my_key = array_keys($mypage_url); ?>

<section id="mySide" class="">
    <h3>마이페이지<span class="sound_only"> 네비게이션 영역</span></h3>
    <ul>
        <?php 
        foreach($mypage_url as $key => $val) {
            echo '<li title="'.$key.'" class="';
            if($key == '단체연결') {
                echo 'dpnone';
            }
            echo '"><h4><a href="'.$val.'"';
            if($key == '회원탈퇴') {
                echo 'onclick="member_leave();"';
            }
            echo '">'.$key.'</a></h4></li>';
        }
        ?>
    </ul>
</section>

<script>
    function member_leave(e) {  // 회원 탈퇴 tto
        // e.preventDefault();

        if (confirm("회원에서 탈퇴 하시겠습니까?"))
                location.href = '<?php echo G5_BBS_URL ?>/member_confirm.php?url=member_leave.php';
    }
</script>