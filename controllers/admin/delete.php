<?php
require_once("../class/conn.php");

// 執行刪除動作
    $boardid = filter_var($_POST['boardid'],FILTER_SANITIZE_NUMBER_INT);
    $sql_query = "DELETE FROM board WHERE boardid=$boardid";
    $db['AS']->query($sql_query);
    $db['AS']->query($query_update);
    $db['AS']->close();