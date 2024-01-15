<?php
  $class_list_css = '<link rel="stylesheet" href="/attention_renewal/admin/css/class_list.css">';
  $url_detail_css = '<link rel="stylesheet" href="/attention_renewal/admin/css/url_detail.css">';
  $title = '강좌 업로드 가이드 - Code Rabbit';
  include_once $_SERVER['DOCUMENT_ROOT'].'/attention_renewal/admin/inc/header.php'; 
?>
<p class="tt_01 class_m_pd text-center">강좌 업로드 가이드</p>
<div class="url_detail white_back">
  <div class="url_step text1 class_lg_mt">
    <div class="class_sm_mt">
      <span class="btn btn-primary">1</span>Youtube 영상의 공유 버튼을 눌러주세요.
    </div>
    <img src="../img/class/url_step13.png" alt="강좌 업로드 가이드 이미지">
  </div>
  <div class="url_step text1 class_lg_mt">
    <div class="class_sm_mt">
      <span class="btn btn-primary">2</span>퍼가기 버튼을 눌러주세요.
    </div>
    <img src="../img/class/url_step23.png" alt="강좌 업로드 가이드 이미지">
  </div>
  <div class="url_step text1 class_lg_pd">
    <div class="class_sm_mt">
      <span class="btn btn-primary">3</span>링크를 복사해 코드래빗 강의등록의 강좌영상에 넣습니다.
    </div>
    <img src="../img/class/url_step33.png" alt="강좌 업로드 가이드 이미지">
  </div>
  <div class="d-flex justify-content-end">
    <a href="#" class="url_close btn btn-dark class_sm_ml">닫기</a>
  </div>
</div>
<script>
$('.url_close').click(function(e){
  e.preventDefault();
  history.back();
})
</script>
<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/attention_renewal/admin/inc/footer.php';
?>