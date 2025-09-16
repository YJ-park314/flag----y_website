<?php
$sub_menu = '300910';
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, "r");

$g5['title'] = '질문과 답변(게시판)';
include_once (G5_ADMIN_PATH.'/admin.head.php');
include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');

?>

<div class="tbl_head01 tbl_wrap">
    <div class="tb-container">
        <!-- 테이블 검색 { -->
        <form method="get" class="fixed">
            <table class="cstm-table">
                <caption>검색 영역</caption>
                <thead>
                    <tr>
                        <th class="chk"></th>
                        <th class="num">No.</th>
                        <th scope="col"><a href="#">번호</a></th>
                        <th scope="col"><a href="#">제목</a></th>
                        <th scope="col"><a href="#">이름</a></th>
                        <th scope="col"><a href="#">ID</a></th>
                        <th scope="col"><a href="#">내용</a></th>
                        <th scope="col"><a href="#">등록일</a></th>
                        <th scope="col"><a href="#">조회</a></th>
                        <th scope="col"><a href="#">답변수</a></th>
                        <th scope="col"><a href="#">연락처</a></th>
                        <th scope="col"><a href="#">삭제Y/N</a></th>
                        <th scope="col"><a href="#">확인Y/N</a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="chk"></td>
                        <td class="num"></td>
                        <td class="wr-no"><input type="text" name="wrNo"></td>
                        <td class="subject"><input type="text" name="subject"></td>
                        <td class="user-name"><input type="text" name="userName"></td>
                        <td class="user-id"><input type="text" name="userId"></td>
                        <td class="content"><input type="text" name="content"></td>
                        <td class="wr-date"><input type="text" name="wrDate"></td>
                        <td class="hit"></td>
                        <td class="answer-cnt"></td>
                        <td class="hp"><input type="text" name="hp"></td>
                        <td class="del"><input type="text" name="del"></td>
                        <td class="read"><input type="text" name="read"></td>
                    </tr>
                </tbody>
            </table>
        </form>
        <!-- } -->
    
        <form action="" method="post">
            <table class="cstm-table data-table no-head">
                <caption>질문과 답변(게시판) 목록</caption>
                <thead>
                    <tr>
                        <th class="chk"></th>
                        <th class="num">No.</th>
                        <th scope="col">번호</th>
                        <th scope="col">제목</th>
                        <th scope="col">이름</th>
                        <th scope="col">ID</th>
                        <th scope="col">내용</th>
                        <th scope="col">등록일</th>
                        <th scope="col">조회</th>
                        <th scope="col">답변수</th>
                        <th scope="col">연락처</th>
                        <th scope="col">삭제Y/N</th>
                        <th scope="col">확인Y/N</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0; $i<20; $i++) { ?>
                    <tr ondblclick="popData();">
                        <td class="chk"><input type="radio" name="listChk" value=""></td>
                        <td class="num"><?php echo $i+1; ?></td>
                        <td class="wr-no">3</td>
                        <td class="subject">택배회수문의</td>
                        <td class="user-name">유근준</td>
                        <td class="user-id">test111</td>
                        <td class="content">빙밥을 못찾겠어요</td>
                        <td class="wr-date">2025-02-06</td>
                        <td class="hit">382</td>
                        <td class="answer-cnt">1</td>
                        <td class="hp">010-1244-1234</td>
                        <td class="del">no</td>
                        <td class="read">Y</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="crud-btn-wrap">
                <button type="button" onclick="popData();">Edit</button>
                <button type="button">Delete</button>
            </div>
        </form>
    </div>
</div>

<!-- 팝업 --> 
<div class="pop-container dpnone">
    <div class="inner" style="height: fit-content;">
        <div class="pop-header">
            <p>edit record</p>
            <a href="#" class="close-pop" onclick="closePop();"></a>
        </div>
        <form action="" method="post">
            <div class="pop-body">
                <ul class="data-list">
                    <li class="wide">
                        <label for="no">No</label>
                        <input type="text" name="no" id="no"> 
                    </li>
                    <li>
                        <label for="deleteStatus">삭제여부</label>
                        <select name="deleteStatus" id="deleteStatus" class="wide">
                            <option value="N">N</option>
                            <option value="Y">Y</option>
                        </select>
                    </li>
                    <li>
                        <label for="confirmStatus">확인여부</label>
                        <select name="confirmStatus" id="confirmStatus" class="wide">
                            <option value="N">N</option>
                            <option value="Y">Y</option>
                        </select>
                    </li>
                    <li class="wide">
                        <label for="subject">제목</label>
                        <input type="text" name="subject" id="subject">
                    </li>
                    <li>
                        <label for="userName">이름</label>
                        <input type="text" name="userName" id="userName">
                    </li>
                    <li>
                        <label for="userId">아이디</label>
                        <input type="text" name="userId" id="userId">
                    </li>
                    <li>
                        <label for="userContact">연락처</label>
                        <input type="text" name="userContact" id="userContact">
                    </li>
                    <li>
                        <label for="regiDate">등록일자</label>
                        <input type="text" name="regiDate" id="regiDate">
                    </li>
                    <li>
                        <label for="viewCount">조회수</label>
                        <input type="text" name="viewCount" id="viewCount">
                    </li>
                    <li>
                        <label for="replyCount">답변수</label>
                        <input type="text" name="replyCount" id="replyCount">
                    </li>
                    <li class="wide">
                        <label for="content">내용</label>
                        <textarea name="content" id="content"></textarea>
                    </li>
                </ul>
            </div>
            <div class="pop-footer">
                <button>수정</button>
                <button type="button" class="close-pop no-ic" onclick="closePop(this.event);">취소</button>
            </div>
        </form>
    </div>
</div>

<script>
    function popData() {
        openPop();
    }
</script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');