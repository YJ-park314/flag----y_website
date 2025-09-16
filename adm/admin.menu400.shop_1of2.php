<?php
if (!defined('G5_USE_SHOP') || !G5_USE_SHOP) {
    return;
} 
 
$menu['menu400'] = array( 
    array('400000', '주문관리', G5_ADMIN_URL . '/shop_admin/', 'shop_config'),
    array('400010', '쇼핑몰현황', G5_ADMIN_URL . '/shop_admin/', 'shop_index'),
    array('400100', '쇼핑몰설정', G5_ADMIN_URL . '/shop_admin/configform.php', 'scf_config'),
    array('400400', '깃발배송주문', G5_ADMIN_URL . '/shop_admin/orderlist.php', 'scf_order', 1),
    array('400430', '제작주문(고객요청)', G5_ADMIN_URL . '/shop_admin/custom_order.php'),
    array('400440', '개인결제관리', G5_ADMIN_URL . '/shop_admin/personalpaylist.php', 'scf_personalpay', 1),
    array('400200', '분류관리', G5_ADMIN_URL . '/shop_admin/categorylist.php', 'scf_cate'),
    array('400300', '상품관리', G5_ADMIN_URL . '/shop_admin/itemlist.php', 'scf_item'),
    array('400660', '상품문의', G5_ADMIN_URL . '/shop_admin/itemqalist.php', 'scf_item_qna'),
    array('400650', '사용후기', G5_ADMIN_URL . '/shop_admin/itemuselist.php', 'scf_ps'),
    array('400620', '상품재고관리', G5_ADMIN_URL . '/shop_admin/itemstocklist.php', 'scf_item_stock'),
    array('400610', '상품유형관리', G5_ADMIN_URL . '/shop_admin/itemtypelist.php', 'scf_item_type'), 
    array('400500', '상품옵션재고관리', G5_ADMIN_URL . '/shop_admin/optionstocklist.php', 'scf_item_option'),
    array('400800', '쿠폰관리', G5_ADMIN_URL . '/shop_admin/couponlist.php', 'scf_coupon'),
    array('400810', '쿠폰존관리', G5_ADMIN_URL . '/shop_admin/couponzonelist.php', 'scf_coupon_zone'),
    array('400750', '추가배송비관리', G5_ADMIN_URL . '/shop_admin/sendcostlist.php', 'scf_sendcost', 1),
    array('400410', '미완료주문', G5_ADMIN_URL . '/shop_admin/inorderlist.php', 'scf_inorder', 1),
    array('400900', '고객결제(입금)관리', G5_ADMIN_URL . '/shop_admin/payment_manage.php'),
    array('400910', '설치장소관리', G5_ADMIN_URL . '/shop_admin/set_place_manage.php'), 
    array('400920', '미수금관리', G5_ADMIN_URL . '/shop_admin/misu_manage.php'),  
    array('400930', '상조용품재고조회', G5_ADMIN_URL . '/shop_admin/mourning_goods_check.php'),
    array('400940', '상조용품입고관리', G5_ADMIN_URL . '/shop_admin/mourning_goods_manage.php'), 
    array('400950', '깃발보관(단체)신청', G5_ADMIN_URL . '/shop_admin/keep_apply.php'),  
);
