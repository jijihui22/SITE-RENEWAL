<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/attention_renewal/admin/inc/dbcon.php';

if (isset($_POST['confirm_delete'])) {
    $pid = $_POST['pid'];
    $sql = "DELETE FROM class WHERE pid='{$pid}'";
    
    if ($mysqli->query($sql)) {
        echo '<script>alert("삭제되었습니다 :)");</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    echo '<script>location.href="/attention_renewal/admin/class/class_list.php";</script>';
}

// 삭제 확인을 위한 HTML 폼
?>