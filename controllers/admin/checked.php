<?php
require_once("../class/connMysql.php");

$checked = 1;
$boardid = filter_var($_POST['boardid'],FILTER_SANITIZE_NUMBER_INT);
$sql_query = "UPDATE board SET checked=? WHERE boardid= ?";
$stmt = $db_link->prepare($sql_query);
$stmt->bind_param('ii', $checked, $boardid);
$stmt->execute();
$stmt->close();

