<?php
$class_up_css = '<link rel="stylesheet" href="/attention_renewal/admin/css/class_up.css">';
$title = '강좌 수정 - Code Rabbit';
include_once $_SERVER['DOCUMENT_ROOT'] . '/attention_renewal/admin/inc/dbcon.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/attention_renewal/admin/inc/header.php';

$pid = $_GET['pid'];

$sql = "SELECT * FROM class WHERE pid='{$pid}'";
$result = $mysqli->query($sql);
while ($rs = $result->fetch_object()) {
  $rc[] = $rs;
}

$query2 = "SELECT * FROM category WHERE step=1";
$result2 = $mysqli->query($query2);
while ($rs2 = $result2->fetch_object()) {
  $cate1[] = $rs2;
}
?>

<div class="common_pd">
  <p class="tt_01 class_ss_mt class_m_pd text-center">강좌 수정</p>
  <form action="class_modify_ok.php?pid=<?= $pid; ?>" method="POST" id="class_form" enctype="multipart/form-data">
    <input type="hidden" name="file_table_id" id="file_table_id" value="">
    <input type="hidden" name="content" id="content" value="">
    <table class="table">
      <tbody>
        <?php
        foreach ($rc as $sqlobj) {
          $cateAr = explode("/", $sqlobj->cate);
        ?>
          <tr class="class_ss_mb">
            <th class="tt_03">카테고리</th>
            <td>
              <span class="select">
                <select name="select" class="select_from" id="pcode2_1">
                  <option selected disabled>
                    <?php
                    $catesqlItem = "SELECT * FROM category WHERE cid='{$cateAr[0]}'";
                    $result2 = $mysqli->query($catesqlItem);
                    $rcss = $result2->fetch_object();
                    echo $rcss->name;
                    ?>
                  </option>
                  <?php foreach ($cate1 as $c) { ?>
                    <option value="<?= $c->cid ?>"><?= $c->name ?>
                    </option>
                  <?php } ?>
                </select>
              </span>
              <span class="select class_ss_ml">
                <select name="select" class="select_from" id="pcode3">
                  <option selected disabled>
                    <?php
                    $catesqlItem = "SELECT * FROM category WHERE cid='{$cateAr[1]}'";
                    $result2 = $mysqli->query($catesqlItem);
                    $rcss = $result2->fetch_object();
                    echo $rcss->name;
                    ?>
                  </option>
                </select>
              </span>
              <span class="select class_ss_ml">
                <select name="select" class="select_from" id="pcode3_1">
                  <option selected disabled>
                    <?php
                    $catesqlItem = "SELECT * FROM category WHERE cid='{$cateAr[2]}'";
                    $result2 = $mysqli->query($catesqlItem);
                    $rcss = $result2->fetch_object();
                    echo $rcss->name;
                    ?>
                  </option>
                </select>
              </span>
            </td>
          </tr>
          <tr>
            <th class="tt_03">강좌명</th>
            <td>
              <input type="text" class="form-control class_form_wd" value="<?= $sqlobj->name ?>" name="name">
            </td>
          </tr>
      </tbody>
    </table>
    <hr class="class_hr">
    <table class="table class_s_mt">
      <tbody>
        <tr>
          <th class="tt_03">강좌난이도</th>
          <td>
            <div class="btn-group">
              <input type="radio" class="btn-check level" name="level" id="level_Beginner" autocomplete="off" value="1" <?php if ($sqlobj->level == 1) {
                                                                                                                          echo "checked";
                                                                                                                        } ?>>
              <label class="btn btn-primary class_btn_bd_color text3 dark_gray" for="level_Beginner">초급</label>
              <input type="radio" class="btn-check level" name="level" id="level_Intermediate" autocomplete="off" value="2" <?php if ($sqlobj->level == 2) {
                                                                                                                              echo "checked";
                                                                                                                            } ?>>
              <label class="btn btn-primary class_btn_bd_color text3 dark_gray" for="level_Intermediate">중급</label>
              <input type="radio" class="btn-check level" name="level" id="level_Advanced" autocomplete="off" value="3" <?php if ($sqlobj->level == 3) {
                                                                                                                          echo "checked";
                                                                                                                        } ?>>
              <label class="btn btn-primary class_btn_bd_color text3 dark_gray" for="level_Advanced">상급</label>
            </div>
            <input type="hidden" name="level" value="" id="level">
          </td>
        </tr>
        <tr>
          <th class="tt_03">가격</th>
          <td>
            <div class="btn-group class_price">
              <input type="radio" class="btn-check" name="price" id="price_free" autocomplete="off" value="0" <?php if ($sqlobj->price == 0) {
                                                                                                                echo "checked";
                                                                                                              } ?>>
              <label class="btn btn-primary class_btn_bd_color text3  dark_gray" for="price_free">무료</label>
              <input type="radio" class="btn-check" name="price" id="price_pay" autocomplete="off" value="<?php if ($sqlobj->price == 1) {
                                                                                                            echo "30000";
                                                                                                          } ?>" <?php if ($sqlobj->price == 1) {
                                                                                                                  echo "checked";
                                                                                                                } ?>>
              <label class="btn btn-primary class_btn_bd_color text3 dark_gray" for="price_pay" checked>유료</label>
            </div>
            <input type="number" class="form-control class_form_wd class_sm_ml price_form" min="30000" max="1200000" value="<?= $sqlobj->price_val ?>" step="10000" id="price_val" name="price_val">
            <label class="form-check-label" for="flexSwitchCheckDefault">원</label>
          </td>
        </tr>
        <tr>
          <th class="tt_03">수강기한</th>
          <td class="class_label_h">
            <div class="btn-group class_date">
              <input type="radio" class="btn-check" name="sale_end_date" id="unlimited" autocomplete="off" value="0" <?php if ($sqlobj->sale_end_date == 0) {
                                                                                                                        echo "checked";
                                                                                                                      } ?>>
              <label class="btn btn-primary class_btn_bd_color text3  dark_gray" for="unlimited">무제한</label>
              <input type="radio" class="btn-check" name="sale_end_date" id="limited" autocomplete="off" value="1" <?php if ($sqlobj->sale_end_date == 1) {
                                                                                                                      echo "checked";
                                                                                                                    } ?>>
              <label class="btn btn-primary class_btn_bd_color text3 dark_gray" for="limited">제한</label>
            </div>
            <input type="number" class="form-control class_form_wd class_sm_ml date_form" min="1" max="72" value="<?= $sqlobj->date_val ?>" name="date_val">
            <label class="form-check-label" for="flexSwitchCheckDefault">개월</label>
          </td>
        </tr>
        <tr>
          <th class="tt_03">강좌영상</th>
          <td class="class_video">
            <div class="video_wrap">
              <div class="video_address">
                <input type="text" class="form-control class_lform_wd white_back" value="<?= $sqlobj->video ?>" name="video[]">
              </div>
              <button type="button" id="video_add"><i class="bi bi-plus-circle icon_gray"></i></button>
            </div>
          </td>
        </tr>
        <tr>
          <th class="tt_03">공개 여부</th>
          <td>
            <div class="btn-group class_status">
              <input type="radio" class="btn-check" name="status" id="open" autocomplete="off" value="1" <?php if ($sqlobj->status == 1) {
                                                                                                            echo "checked";
                                                                                                          } ?>>
              <label class="btn btn-primary class_btn_bd_color text3  dark_gray" for="open">공개</label>
              <input type="radio" class="btn-check" name="status" id="Private" autocomplete="off" value="0" <?php if ($sqlobj->status == 0) {
                                                                                                              echo "checked";
                                                                                                            } ?>>
              <label class="btn btn-primary class_btn_bd_color text3 dark_gray" for="Private">비공개</label>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <hr class="class_hr">
    <table class="table class_s_mt">
      <tbody>
        <tr>
          <th class="tt_03">강좌소개</th>
          <td>
            <!-- summernote -->
            <div id="class_intro"><?php echo $sqlobj->content ?></div>
            <!-- /summernote -->
          </td>
        </tr>
        <tr>
          <th class="tt_03">썸네일</th>
          <td>
            <input type="file" class="form-control" name="thumbnail" id="thumbnail">
          </td>
        </tr>
        <tr>
          <th class="tt_03" scope="row">추가이미지</th>
          <td>
            <div class="drop form-control d-flex justify-content-center align-items-center gray" id="drag_drop">
              <span class="text3"><i class="bi bi-upload icon_gray"></i>이미지를 이곳으로 Drag & Drop 해주세요</span>
              <div id="add_images" class="d-flex justify-content-start">
              </div>
            </div>
          </td>
        </tr>
      <?php
        }
      ?>
      </tbody>
    </table>
    <hr class="class_hr">
    <div class="d-flex justify-content-end class_s_mt">
      <button class="btn btn-primary class_sm_ml">수정</button>
      <a href="/attention_renewal/admin/class/class_list.php" class="btn btn-dark class_sm_ml">취소</a>
    </div>
  </form>
</div>
<script>
  $('.class_menu').css({
    backgroundColor: "#252a38"
  });
  $('.class_menu').find('a').css({
    color: 'white'
  });
  $('#class_form').submit(function() {
    let content_str = $('#class_intro').summernote('code');
    let content = encodeURIComponent(content_str);
    $('#content').val(content);
  });

  $(function() {
    $(".select_from").selectmenu();
  });

  //카테고리 시작
  $(function() {
    $("select").selectmenu();
    $("select#pcode2_1").on("selectmenuchange", function(event, ui) {
      $('#pcode2_1-button span.ui-selectmenu-text').css({
        color: '#505050',
        fontWeight: '700'
      });
    });
    $("select#pcode3").on("selectmenuchange", function(event, ui) {
      $('#pcode3-button span.ui-selectmenu-text').css({
        color: '#505050',
        fontWeight: '700'
      });
    });
    $("select#pcode3_1").on("selectmenuchange", function(event, ui) {
      $('#pcode3_1-button span.ui-selectmenu-text').css({
        color: '#505050',
        fontWeight: '700'
      });
    });
    $("#pcode2_1").on("selectmenuselect", function(event, ui) {
      let data = {
        cate: $("#pcode2_1").val(),
        step: 2,
        category: '중분류'
      }
      $.ajax({
        async: false,
        type: 'post',
        data: data,
        url: "../category/printOption.php",
        dataType: 'html',
        success: function(result) {
          $("#pcode3").html(result);
          $("#pcode3").selectmenu('refresh');
        }
      });
    });

    $("#pcode3").on("selectmenuselect", function(event, ui) {
      let data = {
        cate: $("#pcode3").val(),
        step: 3,
        category: '소분류'
      }

      $.ajax({
        async: false,
        type: 'post',
        data: data,
        url: "../category/printOption.php",
        dataType: 'html',
        success: function(result) {
          $("#pcode3_1").html(result);
          $("#pcode3_1").selectmenu('refresh');
        }
      });
    });
  })

  $('#class_form').submit(function() {
    let markupStr = $('#class_intro').summernote('code');
    let content = encodeURIComponent(markupStr);
    if ($('#class_intro').summernote('isEmpty')) {
      alert('상품 설명을 입력하세요');
      return false;
    }
  });
  //카테고리 끝

  // 추가 이미지 삭제 아이콘 클릭 시 해당 이미지만 삭제 기능 시작
  $('#add_images').on('click', 'a', function(e) {
    e.preventDefault()
    let imgid = $(this).parent().attr('data-imgid');
    file_delete(imgid);
  });
  // 추가 이미지 삭제 아이콘 클릭 시 해당 이미지만 삭제 기능 끝

  // summernote 시작
  $('#class_intro').summernote({
    height: 400,
    placeholder: '강좌를 소개해주세요',
    resize: false,
    lang: "ko-KR",
    disableResizeEditor: true,
    callbacks: { //여기 부분이 이미지를 첨부하는 부분
      onImageUpload: function(files) {
        RealTimeImageUpdate(files, this);
      }
    }
  });
  // summernote 끝

  // 유료 무료, 제한, 무제한 버튼 클릭 시 비활성화 나타냄 시작
  $('.class_price input').change(function() {
    let price_val = $(this).val();
    if (price_val == '0') {
      $('.price_form').prop("disabled", false).focus();
      $('.price_form').prop("disabled", true);
    }
    if (price_val == '30000') {
      $('.price_form').prop("disabled", true);
      $('.price_form').prop("disabled", false).focus();
    }
  })

  $('.class_date input').change(function() {
    let date_val = $(this).val();
    if (date_val == '0') {
      $('.date_form').prop("disabled", false).focus();
      $('.date_form').prop("disabled", true);
    }
    if (date_val == '1') {
      $('.date_form').prop("disabled", true);
      $('.date_form').prop("disabled", false).focus();
    }
  })
  // 유료 무료, 제한, 무제한 버튼 클릭 시 비활성화 나타냄 끝

  //drag drop, 이미지 추가 시작
  let uploadFiles = [];
  let $drop = $("#drag_drop");
  $drop.on("dragenter", function() {
    $(this).addClass('drag-enter');
  }).on("dragleave", function() {
    $(this).removeClass('drag-enter');
  }).on("dragover", function(e) {
    e.preventDefault();
    e.stopPropagation();
  }).on('drop', function(e) {
    e.preventDefault();

    $(this).removeClass('drag-enter');
    let files = e.originalEvent.dataTransfer.files;
    for (let i = 0; i < files.length; i++) {
      let file = files[i];
      let size = uploadFiles.push(file);
      attachFile(file);
    }
  });

  $(".images_submit").click(function() {
    let formData = new FormData();
    $.each(uploadFiles, function(i, file) {
      if (file.upload != 'disable')
        formData.append('upload-file', file, file.name);
    });
    $.ajax({
      url: '/api/etc/file/upload',
      data: formData,
      type: 'post',
      contentType: false,
      processData: false,
      success: function(ret) {
        console.log("사진 넣기 완료");
      }
    });
  });
  $("#add_images").on("click", ".close", function(e) {
    let $target = $(e.target);
    let idx = $target.attr("data-idx");
    uploadFiles[idx].upload = 'disable';
    $target.parent().remove();
  });

  function attachFile(file) {
    let formData = new FormData();
    formData.append('savefile', file)
    $.ajax({
      url: 'class_save_image.php',
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      dataType: 'json',
      type: 'POST',
      error: function(error) {
        console.log('error:', error)
      },
      success: function(return_data) {
        console.log(return_data);
        if (return_data.result == 'member') {
          alert('로그인을 하십시오.');
          return;
        } else
        if (return_data.result == 'image') {
          alert('이미지파일만 첨부할 수 있습니다.');
          return;
        } else if (return_data.result == 'size') {
          alert('10메가 이하만 첨부할 수 있습니다.');
          return;
        } else if (return_data.result == 'error') {
          alert('관리자에게 문의하세요');
          return;
        } else {

          //첨부이미지 테이블에 저장하면 할일
          let imgid = $('#file_table_id').val() + return_data.imgid + ',';
          $('#file_table_id').val(imgid);
          let html = `
                <div class="thumb" id="f_${return_data.imgid}" data-imgid="${return_data.imgid}">
                  <img src="/attention_renewal/pdata/class/${return_data.savefile}" alt="">
                  <a href="#"><i class="bi bi-trash-fill icon_red"></i></a>
              </div>
            `;
          $('#add_images').append(html);
        }
      }
    });
  }

  function file_delete(imgid) {
    if (!confirm('정말 삭제하시겠습니까? :0')) {
      return false;
    }
    let data = {
      imgid: imgid
    }
    $.ajax({
      async: false,
      type: 'post',
      url: 'image_delete.php',
      data: data,
      dataType: 'json',
      error: function(error) {
        console.log('error:', error)
      },
      success: function(return_data) {
        if (return_data.result == 'member') {
          alert('로그인 먼저하세요');
          return;
        } else if (return_data.result == 'my') {
          alert('본인이 작성한 제품의 이미지만 삭제할 수 있습니다.');
          return;
        } else if (return_data.result == 'no') {
          alert('파일 첨부 실패.. :(');
          return;
        } else {
          $('#f_' + imgid).hide();
        }
      }
    })
  } //file_delete func
  //drag drop, 이미지 추가 끝

  //강좌 취소 이벤트 시작
  $('.class_close').click(function(e) {
    e.preventDefault();
    history.back();
  });
  //강좌 취소 이벤트 끝

  //video url html 추가 시작
  $('#video_add').click(function() {
    let video_html = $('.video_address').html();
    video_html = `<div class="video_address d-flex align-items-center">${video_html}</div>`;
    $('.video_wrap').append(video_html);
  })
  //video url html 추가 끝
</script>
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/attention_renewal/admin/inc/footer.php';
?>