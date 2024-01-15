<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/attention_renewal/admin/inc/dbcon.php';

// 관리자 검사
// if(!isset($_SESSION['AUID'])){
//   $return_data = array("result"=>"member"); 
//   echo json_encode($return_data);
//   exit;
// }

$pid = $_GET['pid'];
$name = $_POST['name'];
$level = $_POST['level'] ?? '';
$price = $_POST['price'] ?? '';
$price_val = $_POST['price'] ?? 0;
$sale_end_date = $_POST['sale_end_date'] ?? '';
$date_val = $_POST['date_val'] ?? 0;
$video = $_POST['video'] ?? '';
$status = $_POST['status'] ?? '';
$thumbnail = ''; // 썸네일 변수 초기화
$filename = '';

$content = $_POST['content'] ?? '';
if ($content !== '') {
  $content = rawurldecode($content);
}

if (isset($_POST['file_table_id'])) {
  $file_table_id = $_POST['file_table_id'] ?? '';
  $file_table_id = rtrim($file_table_id, ',');
}

if ($_FILES['thumbnail']['name'] != '') {
  if (isset($_FILES['thumbnail']['size']) > 10240000) {
    echo "<script>
        alert('10MB 이하만 첨부할 수 있습니다.');
        history.back();
        </script>";
    exit;
  }

  if (strpos($_FILES['thumbnail']['type'], 'image') === false) {
    echo "<script>
            alert('이미지만 첨부할 수 있습니다.');    
            history.back();            
          </script>";
    exit;
  }


  $save_dir = $_SERVER['DOCUMENT_ROOT'] . "/attention_renewal/pdata/class/";
  $filename = $_FILES['thumbnail']['name']; //insta.jpg
  $ext = pathinfo($filename, PATHINFO_EXTENSION); //jpg
  $newfilename = date("YmdHis") . substr(rand(), 0, 6); //20238171184015
  $thumbnail_file = $newfilename . "." . $ext; //20238171184015.jpg
  if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $save_dir . $thumbnail_file)) {
    $thumbnail_file = "/attention_renewal/pdata/class/" . $thumbnail_file;
  } else {
    echo "<script>
          alert('파일 첨부 실패.. :(');    
          history.back();            
        </script>";
  }
} else {
  $sql = "SELECT thumbnail FROM class WHERE pid='{$pid}'";
  $result = $mysqli->query($sql);
  $rs = $result->fetch_object();
  $thumbnail_file = $rs->thumbnail;
}
$sql = "UPDATE class SET name='{$name}', content='{$content}', thumbnail='{$thumbnail_file}', price='{$price}',  price_val='{$price_val}', level='{$level}', video='{$video}', sale_end_date='{$sale_end_date}', date_val={$date_val}, status={$status}, file_table_id='{$file_table_id}' WHERE pid='{$pid}'";


if ($mysqli->query($sql) === TRUE) {
  echo "<script>
    alert('수정 완료되었습니다 :)');
    location.href ='/attention_renewal/admin/class/class_list.php';</script>";
} else {
  echo "Error: " . $sql . "<br>" . $mysqli->error;
}

$mysqli->close();
?>