<?php
$sub_menu = '100610';
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, "r");

$g5['title'] = '배송자관리';
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
                        <th class="no">No.</th>
                        <th scope="col"><a href="#">코드NO</a></th>
                        <th scope="col"><a href="#">아이디</a></th>
                        <th scope="col"><a href="#">이름</a></th>
                        <th scope="col"><a href="#">구분(1:배송, 2:퀵, 3:기타)</a></th>
                        <th scope="col"><a href="#">상태</a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="chk"></td>
                        <td class="no"></td>
                        <td class="code-no"><input type="text" name="codeNo"></td>
                        <td class="user-id"><input type="text" name="userId"></td>
                        <td class="name"><input type="text" name="name"></td>
                        <td class="category-type">
                            <select name="categoryType">
                                <option value="">전체</option>
                                <option value="1">배송</option>
                                <option value="2">퀵</option>
                                <option value="3">기타</option>
                            </select>
                        </td>
                        <td class="status">
                            <select name="status">
                                <option value="">전체</option>
                                <option value="Y">사용</option>
                                <option value="N">사용안함</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <!-- } --> 
    
        <form action="" method="post">
            <table class="cstm-table data-table no-head">
                <caption>배송자관리 목록</caption>
                <thead>
                    <tr>
                        <th class="chk"></th>
                        <th class="no">No.</th>
                        <th scope="col">코드NO</th>
                        <th scope="col">아이디</th>
                        <th scope="col">이름</th>
                        <th scope="col">구분(1:배송, 2:퀵, 3:기타)</th>
                        <th scope="col">상태</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0; $i<20; $i++) { ?>
                    <tr ondblclick="popData('edit');">
                        <td class="chk"><input type="radio" name="listChk" id="listChk<?php echo $i+1; ?>" value=""></td>
                        <td class="no"><?php echo $i+1; ?></td>
                        <td class="code-no">164</td>
                        <td class="user-id"></td> 
                        <td class="name">봉화콜</td>
                        <td class="category-type">2</td>
                        <td class="status">N</td> 
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="crud-btn-wrap">
                <button type="button" onclick="popData('add');">Add</button>
                <button type="button" onclick="popData('edit');">Edit</button>
            </div>
        </form>
    </div>
</div>

<!-- 팝업 --> 
<div class="pop-container dpnone">
    <div class="inner" style="height: fit-content;">
        <div class="pop-header">
            <p>add record</p>
            <a href="#" class="close-pop" onclick="closePop();"></a>
        </div>
        <form action="" method="post"> 
            <div class="pop-body">
                <ul class="data-list">
                    <li class="wide">
                        <label for="codeNo">코드NO</label>
                        <input type="text" name="codeNo" id="codeNo" placeholder="자동입력">
                    </li>
                    <li class="wide">
                        <label for="userId">아이디</label>
                        <input type="text" name="userId" id="userId">
                    </li>
                    <li class="wide">
                        <label for="pw">비밀번호</label>
                        <input type="text" name="pw" id="pw">
                    </li>
                    <li class="wide">
                        <label for="name">이름</label>
                        <input type="text" name="name" id="name">
                    </li>
                    <li class="wide">
                        <label for="categoryType">구분</label>
                        <input type="text" name="categoryType" id="categoryType">
                        <span>1:배송, 2:퀵, 3:기타</span>
                    </li>
                    <li class="wide">
                        <label for="status">사용여부</label>
                        <select name="status" id="status" class="wide">
                            <option value="Y">Y</option>
                            <option value="N">N</option>
                        </select>
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
    function popData(type) { // type = edit || add
        openPop(type);
    }
</script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');