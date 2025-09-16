<?php
    $vis_id = isset($vis_id) ? $vis_id : null;
    $vis_name = isset($vis_name) ? $vis_name : '게시판 제목입니다';
    $vis_desc = isset($vis_desc) ? $vis_desc : "게시판 설명 글입니다.";
?>

<div class="visual-sub <?php echo $vis_id ?>">
    <dl>
        <dt><?php echo $vis_name ?></dt>
        <dd><?php echo $vis_desc ?></dd>
    </dl>
</div>