<?php

header('Content-type:text/json');


require '../class/conn.php';
require '../class/class_page.php';

$pageRow_records = 5;
// //預設頁數
$num_pages = 1;
// //若已經有翻頁，將頁數更新
if (isset($_GET['page'])) {
    $num_pages = $_GET['page'];
}
$page_obj = new Page($db['AS'], $num_pages, $pageRow_records, "boardid", "FROM", "board")
    or die("分頁讀取失敗");
$db['AS']->query($page_obj->_SQL);

$page_p = $page_obj->PrintSelectOption();
$rows_total = $db['AS']->_num_rows;
$page_end = $page_obj->_TotalPages;

if ($num_pages > $page_end) {
    $num_pages = $page_end;
}

$row_start = ( $num_pages -1 ) * $pageRow_records;
$row_end = $row_start + $pageRow_records;

$sql = "SELECT * FROM board ORDER BY boardtime DESC LIMIT $row_start, $pageRow_records";
$db['AS']->query($sql);


// // //本頁開始記錄筆數 = (頁數-1)*每頁記錄筆數
// $startRow_records = ($num_pages - 1) * $pageRow_records;

// // //未加限制顯示筆數的SQL敘述句
// $query_RecBoard = "SELECT * FROM board ORDER BY boardtime DESC";
// // //加上限制顯示筆數的SQL敘述句，由本頁開始記錄筆數開始，每頁顯示預設筆數
// $query_limit_RecBoard = $query_RecBoard . " LIMIT {$startRow_records}, {$pageRow_records}";
// // //以加上限制顯示筆數的SQL敘述句查詢資料到 $RecBoard 中
// $db['AS']->query($query_limit_RecBoard);
// //以未加上限制顯示筆數的SQL敘述句查詢資料到 $all_RecBoard 中
// $all_RecBoard = $db['AS']->query($query_RecBoard);
// //計算總筆數
// $total_records = $all_RecBoard->num_rows;
// //計算總頁數=(總筆數/每頁筆數)後無條件進位。
// $total_pages = ceil($total_records / $pageRow_records);

//     while ($db['AS']->next_record(1)){
//         $r=$db['AS']->record;
//         // print_r($r['boardsubject']);
//         // print_r($r['boardsex']);
//     }
//  echo json_encode($r);

if(isset($_GET['page']) && isset($_GET['page']) != ""){
    for ($i = 0; $i < $db['AS']->_num_rows; $i++) {
        $db['AS']->next_record();
        $row[$i] = $db['AS']->record;
        // print_r($row[$i]);
    }
    echo json_encode($row,JSON_UNESCAPED_UNICODE);
}







// JSON_UNESCAPED_UNICODE