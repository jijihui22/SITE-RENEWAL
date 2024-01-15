<?php
session_start();
// header("Access-Control-Allow-Origin: *");
require_once $_SERVER['DOCUMENT_ROOT'] . '/attention_renewal/admin/inc/dbcon.php';
?>
<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="coderabbit renewal">
  <meta property="og:type" content="website">
  <meta property="og:title" content="coderabbit renewal">
  <meta property="og:description" content="coderabbit renewal">
  <meta property="og:image" content="https://ifh.cc/g/aTOkOq.jpg">
  <meta property="og:url" content="http://jhjh3373jh.dothome.co.kr/attention_renewal/admin/dashboard/index.php">
  <title>Login - Code Rabbit</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/attention_renewal/admin/css/common.css">
  <link rel="stylesheet" href="/attention_renewal/admin/css/login.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-N86FG6QH');</script>
  <!-- End Google Tag Manager -->
</head>

<body>
  <div class="background">
    <div class="">
      <div class="main d-flex flex-column align-items-center justify-content-center">
        <div class="logo d-flex flex-column align-items-center">
          <img src="/attention_renewal/admin/img/coderabbit_logo_2x.svg" alt="">
          <p class="tt_02">Admin</p>
        </div>
        <form action="login_ok.php" method="POST" class="d-flex flex-column align-items-center">
          <label for="userid" class="hidden_label">ID</label>
          <input type="text" name="userid" class="form-control" id="userid" aria-describedby="basic-addon3 basic-addon4" placeholder="ID">
          <label for="userpw" class="hidden_label">Password</label>
          <input type="password" name="passwd" class="form-control" id="userpw" aria-describedby="basic-addon3 basic-addon4" placeholder="Password">
          <button type="submit" class="btn btn-primary flex-fill">로그인</button>
        </form>
      </div>
      <!-- COOKIE POPUP -->
      <dialog class="popup cf">
        <h3>LMS 관리자 페이지 제작 프로젝트</h3>
        <h4>본 사이트는 구직용 포트폴리오 웹사이트이며&#44; 실제로 운영되는 사이트가 아닙니다&#46;</h4>
        <h5>아이디 &#58; admin &#47; 비밀번호 &#58; 1111</h5>
        <hr>
        <p>Attention 팀 &#58; 김&#42;훈&#44; 기&#42;은&#44; 천&#42;영&#44; 한&#42;연&#44; 한지희</p>
        <p>제작기간 &#58; 2023&#46; 08&#46; 11 &#126; 2023&#46; 09&#46; 08</p>
        <p>사용한 프로그램 &#58; html&#44; css&#44; javascript&#44; php&#44; mySQL</p>
        <p>파트 업무 분장</p>
        <p>기획 &#58; 전원참여</p>
        <p>디자인&#44; 구현</p>
        <p>김&#42;훈 &#58; 로그인&#44; 대시보드&#44; 매출관리&#44; 회원관리</p>
        <p>기&#42;은 &#58;쿠폰관리 &#40;조회&#44; 등록&#44; 수정&#41;</p>
        <p>천&#42;영 &#58; 공지사항 &#40;조회&#44; 등록&#44; 수정&#44; 상세보기&#41;</p>
        <p>한&#42;연 &#58; 카테고리 &#40;조회&#44; 등록&#44; 수정&#41;</p>
        <p>한지희 &#58; 강좌관리 &#40;<a href="http://jhjh3373jh.dothome.co.kr/attention_renewal/admin/class/class_list.php/">조회</a>&#44; <a href="http://jhjh3373jh.dothome.co.kr/attention_renewal/admin/class/class_up.php">등록</a>&#44; <a href="http://jhjh3373jh.dothome.co.kr/attention_renewal/admin/class/class_view.php?pid=287">수정</a>&#44; <a href="http://jhjh3373jh.dothome.co.kr/attention_renewal/admin/class/class_view.php?pid=287">상세보기</a>&#41;</p>
        <hr>
        <label for="day-check" aria-label="오늘 하루 안보기">오늘 하루 안보기</label>
        <input type="checkbox" id="day-check">
        <button type="button" id="close">close</button>
      </dialog>
      <!-- COOKIE POPUP END -->
      <script>
        let popup = document.querySelector('.popup'),
          closeBtn = popup.querySelector('#close'),
          dayCheck = popup.querySelector('#day-check');

        function setCookie(name, value, day) {
          let date = new Date();
          date.setDate(date.getDate() + day);
          document.cookie = `${name}=${value};expires=${date.toUTCString()}`;
        }

        function cookieCheck(name) {
          let cookieArr = document.cookie.split(';');
          let visited = false;

          for (let cookie of cookieArr) {
            if (cookie.search(name) > -1) {
              visited = true;
              break;
            }
          }

          if (!visited) {
            popup.setAttribute('open', '');
          }
        };
        cookieCheck('ABC');

        closeBtn.addEventListener('click', () => {
          popup.removeAttribute('open');
          if (dayCheck.checked) {
            setCookie('ABC', 'home', 1);
          } else {
            setCookie('ABC', 'home', -1);
          }
        });
      </script>