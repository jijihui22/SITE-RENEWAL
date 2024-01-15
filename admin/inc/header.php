<?php
  session_start();
  require_once $_SERVER['DOCUMENT_ROOT'].'/attention_renewal/admin/inc/dbcon.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="coderabbit renewal">
  <meta property="og:type" content="website">
  <meta property="og:title" content="coderabbit renewal">
  <meta property="og:description" content="coderabbit renewal">
  <meta property="og:image" content="https://ifh.cc/g/aTOkOq.jpg">
  <meta property="og:url" content="http://jhjh3373jh.dothome.co.kr/attention_renewal/admin/dashboard/index.php">
  <title><?php if(isset($title)){echo $title;} else { echo '코드래빗과 함께 뛰어보세요!';}; ?></title>
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css" integrity="sha512-ngQ4IGzHQ3s/Hh8kMyG4FC74wzitukRMIcTOoKT3EyzFZCILOPF0twiXOQn75eDINUfKBYmzYn2AA8DkAk8veQ==" crossorigin="anonymous" referrerpolicy="no-referrer">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
  <link rel="stylesheet" href="/attention_renewal/admin/css/common.css">
  <link rel="stylesheet" href="/attention_renewal/admin/css/main.css">
  <link rel="shortcut icon" type="image/x-icon" href="/attention_renewal/admin/img/coderabbit_favicon.png">
  <link rel="apple-touch-icon" sizes="114x114" href="/attention_renewal/admin/img/coderabbit_favicon.png">
  <?php
    if(isset($category_css)){
      echo $category_css;
    }
    if(isset($class_cate_css)){
      echo $class_cate_css;
    }
    if(isset($class_list_css)){
      echo $class_list_css;
    }
    if(isset($class_up_css)){
      echo $class_up_css;
    }
    if(isset($class_view_css)){
      echo $class_view_css;
    }
    if(isset($url_detail_css)){
      echo $url_detail_css;
    }
    if(isset($coup_ok_css)){
      echo $coup_ok_css;
    }
    if(isset($coup_css)){
      echo $coup_css;
    }
    if(isset($login_css)){
      echo $login_css;
    }
    if(isset($member_css)){
      echo $member_css;
    }
    if(isset($notice_css)){
      echo $notice_css;
    }
    if(isset($sales_css)){
      echo $sales_css;
    }
    if(isset($flatpickr_min_css)){
      echo $flatpickr_min_css;
    }
    if(isset($index_css)){
      echo $index_css;
    }
    if(isset($summernote_min_css)){
      echo $summernote_min_css;
    }

  ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script><!-- summernote 기능 쓰려면 필요 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js" integrity="sha512-6F1RVfnxCprKJmfulcxxym1Dar5FsT/V2jiEUvABiaEiFWoQ8yHvqRM/Slf0qJKiwin6IDQucjXuolCfCKnaJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-N86FG6QH');</script>
  <!-- End Google Tag Manager -->
</head>
<body>
<div class="background d-flex">
  <nav class="aside tt_03">
    <div class="logo">
        <img src="/attention_renewal/admin/img/coderabbit_logo.svg" alt="코드래빗 로고">
    </div>
    <div class="d-flex flex-column aside_title">
      <ul>
        <li class="dash_menu"><a href="/attention_renewal/admin/dashboard/index.php"><i class="bi bi-grid-1x2-fill"></i> 대시보드</a></li>
        <li class="sales_menu"><a href="/attention_renewal/admin/sales/sales_list.php"><i class="bi bi-bar-chart"></i> 매출 관리</a></li>
        <li class="class_menu"><a href="/attention_renewal/admin/class/class_list.php"><i class="bi bi-mortarboard-fill"></i> 강좌 관리</a></li>
        <li class="coup_menu"><a href="/attention_renewal/admin/coupon/coupon_list.php"><i class="bi bi-credit-card-2-front"></i> 쿠폰 관리</a></li>
        <li class="member_menu"><a href="/attention_renewal/admin/member/member_list.php"><i class="bi bi-person-fill"></i> 회원 관리</a></li>
        <li class="board_menu"><a href="/attention_renewal/admin/notice/notice.php"><i class="bi bi-layout-text-sidebar-reverse"></i> 게시판 관리</a></li>
      </ul>
      <a href="/attention_renewal/admin/logout.php" class="text2 logout"><i class="bi bi-door-closed"></i><span>Logout</span></a>
      
    </div>
  </nav>
  <div class="main">
    <div class="profile text-end">
      <i class="bi bi-bell icon_gray"></i>
      <i class="bi bi-emoji-sunglasses icon_gray"></i>
      <span class="text2">admin</span>
    </div>
