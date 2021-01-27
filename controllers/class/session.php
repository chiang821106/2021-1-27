<?php

session_start();
// 檢查是否存在session，否則導回留言版主畫面
if (!isset($_SESSION['loginMember']) || ($_SESSION['loginPassword'] == "")) {
    header("Location:index.php");
}

?>