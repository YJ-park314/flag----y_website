<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$sql = " update $write_table
        set wr_11 = '$wr_11',
            wr_12 = '$wr_12',
            wr_13 = '$wr_13',
            wr_14 = '$wr_14'
        where wr_id = '$wr_id' ";
sql_query($sql);
?>