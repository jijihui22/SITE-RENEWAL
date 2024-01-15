<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/attention_renewal/admin/inc/login_header.php';
if(isset($_SESSION['AUID'])){
  if($_SESSION['AUID'] == 'admin'){
    echo "<script>
      alert('이미 로그인 하셨습니다.');
      location.href = '/attention_renewal/admin/dashboard/index.php';
    </script>";
  }
}
?>


<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/attention_renewal/admin/inc/footer.php';
?>