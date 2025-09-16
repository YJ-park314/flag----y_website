<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$use_page = isset($use_page) ? $use_page : '깃발배송';
?>

<?php if($use_page == '깃발배송') { ?>
<ul class="del-info">
<?php } ?>
    <li id="sit_inf" class="service">
        <div class="tit-area">
            <p>
                <?php echo $use_page == '깃발배송' ? '깃발배송 서비스 특징' : '27년 전통 전국 7800단체, <br class="mo">국내 유일의 깃발 관리 및 보관 시스템'; ?>
            </p>
            <?php echo $use_page == '깃발배송' ? '<p class="con-summary">27년 전통 전국 7800단체, <br class="mo">국내 유일의 깃발 관리 및 보관 시스템</p>' : '' ?>
        </div>
        <ul class="info-shape">
            <li>전국 최저가 시행부가세별도</li>
            <li>365일 24시간 전화접수 시스템 운영</li>
            <li>국내 전지역 배달서비스 가능</li>
            <li>보관, 배송업무 관련 전산서비스 시행깃발보관내역, 배송현황, 배송비미납내역, 청구서, 배송비납부영수증 출력 등 온라인 서비스 시행</li>
            <li>서비스미흡 표준보상안 실시</li>
            <li>상조용품 배송깃발과 함께 전국 신속한 배달 서비스</li>
        </ul>
    </li>
    
    <li id="sit_dex" class="price center">
        <div class="tit-area"><p>배달가격표</p></div>
        <table class="deli-price-table">
            <colgroup>
                <col style="width: *;">
                <col style="width: 20%;">
                <col style="width: 20%;">
            </colgroup>
            <thead>
                <tr>
                    <th scope="row">지역</th>
                    <th scope="row">근조기 (설치+회수)</th>
                    <th scope="row">경하기 (설치+회수)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>서울</td>
                    <td>25,000</td>
                    <td>30,000</td>
                </tr>
                <tr>
                    <td>서울 근교<br>분당, 성남, 평촌, 안양, 광명, 부천, 일산, 구리, 의정부 등 인접지역</td>
                    <td>30,000</td>
                    <td>38,000</td>
                </tr>
                <tr>
                    <td>경기 수도권<br>인천, 안산, 수원, 군포, 시흥, 의왕, 부평 등 인접지역</td>
                    <td>38,000</td>
                    <td>45,000</td>
                </tr>
                <tr>
                    <td>경기외곽<br>가평, 경기광주, 남양주, 강화, 화성, 동두천, 양평, 용인, 포천, 김포 등 인접지역</td>
                    <td>43,000</td>
                    <td>45,000</td>
                </tr>
                <tr>
                    <td>지방</td>
                    <td>48,000</td>
                    <td>53,000</td>
                </tr>
                <tr>
                    <td>제주 - 도서산간</td>
                    <td>88,000</td>
                    <td>88,000</td>
                </tr>
            </tbody>
        </table>
        <ul class="info-shape">
            <li>연회비, 보관비, 관리비, 가입비가 없습니다. (계약서 상에 배송료와 관리비를 포함한 가격이 요금표입니다.)</li>
            <li>부가세별도이며 최종 배송지가 도서/산간벽지 등 교통불편지역이나 고속/시외버스 터미널에서 먼 거리를 요할 경우 배송비가 추가 될 수 있습니다.</li>
            <li>지방 터미널 도착시간이 오후 7시 이후가 될 경우 야간 배송금액으로 비용이 추가 될 수 있습니다.(익일아침 배송시에는 정상비용 적용)</li>
        </ul>
    </li>
    
    <li id="sit_deposit" class="bank">
        <div class="tit-area"><p>입금방법 안내</p></div>
        <ul class="info-shape">
            <li>배송이용요금은 월말 결산하여 익월 초에 청구합니다.</li>
            <li>세금계산서 발행을 원하시는 고객께서는 당사에 별도로 문의하시기 바랍니다.</li>
        </ul>
    </li>
<?php if($use_page == '깃발배송') { ?>
</ul>
<?php } ?>