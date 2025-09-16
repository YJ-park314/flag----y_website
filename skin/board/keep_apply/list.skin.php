<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(!isset($_GET['sca']) || $_GET['sca'] == '') goto_url('/bbs/board.php?bo_table='.$bo_table.'&sca=보관_신청한_깃발');

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 6;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

$ctgr_num = '1';

// if($_GET['sca'] == '현재_관리중인_깃발') {
//     $ctgr_num = '2';
// } else if($_GET['sca'] == '단체_연결_안된_깃발') {
//     $ctgr_num = '3';
// }

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<!-- 비주얼 -->
<?php 
    $vis_id = $bo_table.$ctgr_num;
    $vis_name = '깃발보관';
    $vis_desc = '보관 및 관리 상태를 한 곳에서 쉽게 살펴보세요.';
    include_once(G5_THEME_PATH.'/component/visual.php');
?>

<!-- 게시판 목록 시작 { --> 
<div id="bo_list" class="wrap apply"> 
    <h3 title="<?php echo get_text($g5['title']); ?>"><?php echo get_head_title($g5['title']); ?> 확인</h3>
    
    <!-- 게시판 카테고리 시작 { -->
    <!-- <?php if ($is_category) { ?>
    <nav id="bo_cate">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul id="bo_cate_ul" class="common-tab">
            <?php echo $category_option ?>
        </ul>
    </nav>
    <?php } ?> -->
    <!-- } 게시판 카테고리 끝 -->

    <!-- 보관 공통 탭 메뉴 -->
    <?php include_once(G5_THEME_PATH.'/component/keep_tab_menu.php'); ?>
    
    <form name="fboardlist" id="fboardlist" action="<?php echo G5_BBS_URL; ?>/board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">

    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div id="bo_btn_top">
        <!-- <div id="bo_list_total">
            <span>Total <?php echo number_format($total_count) ?>건</span>
            <?php echo $page ?> 페이지
        </div> -->

        <ul class="btn_bo_user">
            <!-- <?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin btn" title="관리자"><i class="fa fa-cog fa-spin fa-fw"></i><span class="sound_only">관리자</span></a></li><?php } ?> -->
            <!-- <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01 btn" title="RSS"><i class="fa fa-rss" aria-hidden="true"></i><span class="sound_only">RSS</span></a></li><?php } ?> -->
            <!-- <li>
                <button type="button" class="btn_bo_sch btn_b01 btn" title="게시판 검색"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">게시판 검색</span></button>
            </li> -->
            <!-- <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b01 btn" title="글쓰기"><i class="fa fa-pencil" aria-hidden="true"></i><span class="sound_only">글쓰기</span></a></li><?php } ?> -->
            <?php if ($is_admin == 'super' || $is_auth) {  ?>
            <li>
                <button type="button" class="btn_more_opt is_list_btn btn_b01 btn" title="게시판 리스트 옵션"><i class="fa fa-ellipsis-v" aria-hidden="true"></i><span class="sound_only">게시판 리스트 옵션</span></button>
                <?php if ($is_checkbox) { ?>	
                <ul class="more_opt is_list_btn">  
                    <li><button type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"><i class="fa fa-trash-o" aria-hidden="true"></i> 선택삭제</button></li>
                    <li><button type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value"><i class="fa fa-files-o" aria-hidden="true"></i> 선택복사</button></li>
                    <li><button type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value"><i class="fa fa-arrows" aria-hidden="true"></i> 선택이동</button></li>
                </ul>
                <?php } ?>
            </li>
            <?php }  ?>
        </ul> 
    </div>
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->
            
    <div class="tbl_head01 tbl_wrap center apply">
        <table>
            <caption><?php echo $board['bo_subject'] ?> 목록</caption>
            <colgroup class="pc">
                <?php if ($is_checkbox) { ?><col style="width: 5%;"><?php }?>
                <col style="width: 15%;">
                <col style="width: *;">
                <col style="width: *;">
                <?php if($ctgr_num == '1') { ?>
                    <col style="width: 20%;">
                    <col style="width: 10%;">
                <?php } ?>
                <?php if($ctgr_num != '1') { ?>
                    <col style="width: 10%;">
                <?php } ?>
            </colgroup>
            <colgroup class="mo">
                <?php if ($is_checkbox) { ?><col style="width: 24px;"><?php }?>
                <col style="width: 30%;">
                <col style="width: 40%;">
                <col style="width: 30%;">
            </colgroup>
            <thead>
                <tr>
                    <?php if ($is_checkbox) { ?>
                    <th scope="col" class="all_chk chk_box">
                        <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);" class="selec_chk">
                        <label for="chkall">
                            <span></span>
                            <b class="sound_only">현재 페이지 게시물  전체선택</b>
                        </label>
                    </th>
                    <?php } ?>
                    <th scope="col"><?php echo subject_sort_link('wr_datetime', $qstr2, 1) ?>신청일</a></th>
                    <th class="pc" scope="col">근조기<?php if($ctgr_num == 3) echo '(수량)'; ?></th>
                    <th class="pc" scope="col">경하기<?php if($ctgr_num == 3) echo '(수량)'; ?></th>
                    <th scope="col">단체명</th>
                    <?php if($ctgr_num == '1') { ?>
                        <th class="pc" scope="col">변경</th>
                        <th scope="col">상태</th>
                    <?php } ?>
                    <?php if($ctgr_num != '1') { ?><th scope="col">비고</th><?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i=0; $i<count($list); $i++) {
                    if ($i%2==0) $lt_class = "even";
                    else $lt_class = "";
                    $addr = explode(',',$list[$i]['wr_6']);
                    $relaction = explode(',',$list[$i]['wr_4']);
                ?>
                <tr class="<?php if ($list[$i]['is_notice']) echo "bo_notice"; ?> <?php echo $lt_class ?>">
                    <?php if ($is_checkbox) { ?>
                    <td class="td_chk chk_box">
                        <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>" class="selec_chk">
                        <label for="chk_wr_id_<?php echo $i ?>">
                            <span></span>
                            <b class="sound_only"><?php echo $list[$i]['subject'] ?></b>
                        </label>
                    </td> 
                    <?php } ?> 
                    <td class="td_datetime"><a href="<?php echo $list[$i]['href'] ?>"><?php echo date('y.m.d', strtotime($list[$i]['datetime'])) ?></a></td>
                    <td class="pc"><a href="<?php echo $list[$i]['href'] ?>">-</a></td>
                    <td class="pc"><a href="<?php echo $list[$i]['href'] ?>">-</a></td>
                    <td><a href="<?php echo $list[$i]['href'] ?>"><?php echo $list[$i]['subject'] ?></a></td>
                    <?php if($ctgr_num == '1') { ?> 
                        <td class="pc"><?php echo $list[$i]['wr_12'] ?></td>
                        <td><span class="status-shape"><?php echo $list[$i]['wr_13'] ?></span></td>
                    <?php } ?>
                    <?php if($ctgr_num != '1') { ?><td><?php echo $list[$i]['wr_14'] ?></td><?php } ?>
                </tr>
                <?php } ?>
                <?php if (count($list) == 0) { 
                    echo '<tr><td colspan="'.$colspan.'" class="empty_table">게시물이 없습니다.';
                    if(!$is_member) echo ' <span class="no-log">(*로그인 후 이용가능합니다)</span>';
                    echo '</td></tr>'; 
                } ?>
            </tbody>
        </table>

        <?php if ($write_href) { ?><button type="button" class="btn-point" onclick="window.location.href='<?php echo $write_href ?>'">깃발 보관 신청</button><?php } ?>
    </div>
    <!-- 페이지 -->
    <?php echo $write_pages; ?>
    <!-- 페이지 -->
    
    <!-- <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">
        <?php if ($list_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin btn" title="관리자"><i class="fa fa-cog fa-spin fa-fw"></i><span class="sound_only">관리자</span></a></li><?php } ?>
            <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01 btn" title="RSS"><i class="fa fa-rss" aria-hidden="true"></i><span class="sound_only">RSS</span></a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b01 btn" title="글쓰기"><i class="fa fa-pencil" aria-hidden="true"></i><span class="sound_only">글쓰기</span></a></li><?php } ?>
        </ul>	
        <?php } ?>
    </div>
    <?php } ?>    -->
    </form>

    <!-- 게시판 검색 시작 { -->
    <div class="bo_sch_wrap">
        <fieldset class="bo_sch">
            <h3>검색</h3>
            <form name="fsearch" method="get">
            <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
            <input type="hidden" name="sca" value="<?php echo $sca ?>">
            <input type="hidden" name="sop" value="and">
            <label for="sfl" class="sound_only">검색대상</label>
            <select name="sfl" id="sfl">
                <?php echo get_board_sfl_select_options($sfl); ?>
            </select>
            <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
            <div class="sch_bar">
                <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="sch_input" size="25" maxlength="20" placeholder=" 검색어를 입력해주세요">
                <button type="submit" value="검색" class="sch_btn"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>
            </div>
            <button type="button" class="bo_sch_cls" title="닫기"><i class="fa fa-times" aria-hidden="true"></i><span class="sound_only">닫기</span></button>
            </form>
        </fieldset>
        <div class="bo_sch_bg"></div>
    </div>
    <script>
    jQuery(function($){
        // 게시판 검색
        $(".btn_bo_sch").on("click", function() {
            $(".bo_sch_wrap").toggle();
        })
        $('.bo_sch_bg, .bo_sch_cls').click(function(){
            $('.bo_sch_wrap').hide();
        });
    });
    </script>
    <!-- } 게시판 검색 끝 --> 
</div>

<?php if($is_checkbox) { ?>
<noscript>
    <p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<?php if ($is_checkbox) { ?>
<script>
    function all_checked(sw) {
        var f = document.fboardlist;

        for (var i=0; i<f.length; i++) {
            if (f.elements[i].name == "chk_wr_id[]")
                f.elements[i].checked = sw;
        }
    }

    function fboardlist_submit(f) {
        var chk_count = 0;

        for (var i=0; i<f.length; i++) {
            if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
                chk_count++;
        }

        if (!chk_count) {
            alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
            return false;
        }

        if(document.pressed == "선택복사") {
            select_copy("copy");
            return;
        }

        if(document.pressed == "선택이동") {
            select_copy("move");
            return;
        }

        if(document.pressed == "선택삭제") {
            if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
                return false;

            f.removeAttribute("target");
            f.action = g5_bbs_url+"/board_list_update.php";
        }

        return true;
    }

    // 선택한 게시물 복사 및 이동
    function select_copy(sw) {
        var f = document.fboardlist;

        if (sw == "copy")
            str = "복사";
        else
            str = "이동";

        var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

        f.sw.value = sw;
        f.target = "move";
        f.action = g5_bbs_url+"/move.php";
        f.submit();
    }

    // 게시판 리스트 관리자 옵션
    jQuery(function($){
        $(".btn_more_opt.is_list_btn").on("click", function(e) {
            e.stopPropagation();
            $(".more_opt.is_list_btn").toggle();
        });
        $(document).on("click", function (e) {
            if(!$(e.target).closest('.is_list_btn').length) {
                $(".more_opt.is_list_btn").hide();
            }
        });
    });
</script>
<?php } ?>
<script>
    const ctgrAll = document.querySelectorAll('#bo_cate a');

    ctgrAll.forEach((a, idx) => {
        let rawSpan = null; 

        if(idx == 0) {
            a.closest('li').classList.add('dpnone');
        } else {
            if(a.querySelector('span')) {
                rawSpan = document.createElement('span');
                rawSpan.textContent = a.querySelector('span').textContent;
                rawSpan.classList.add('sound_only');
                a.querySelector('span').remove();
            }
    
            a.textContent = a.textContent.replaceAll('_', ' ');
            if(rawSpan) {
                a.append(rawSpan);
            }
        }
    });
</script>
<!-- } 게시판 목록 끝 -->
