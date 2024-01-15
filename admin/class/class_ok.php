<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'].'/attention_renewal/admin/inc/dbcon.php';

$cate1 = $_POST['cate1'] ?? '';
$cate2 = $_POST['cate2'] ?? '';
$cate3 = $_POST['cate3'] ?? '';
$cate = $cate1.'/'.$cate2.'/'.$cate3;

// 관리자 검사
if(!isset($_SESSION['AUID'])){
  echo "<script>
  alert('권한이 없습니다');
  history.back();
  </script>";
}

$name = $_POST['name'] ?? '';
$video = $_POST['video'] ?? '';
$level = $_POST['level'] ?? 0;
$price = $_POST['price'] ?? '';
$price_val = $_POST['price_val'] ?? 0;
$sale_end_date = $_POST['sale_end_date'] ?? '';
$date_val = $_POST['date_val'] ?? 0;
$thumbnail = '';
$status = $_POST['status'] ?? 0;
$filename = '';
$content =  rawurldecode($_POST['content']);

if(isset($_POST['file_table_id'])){
  $file_table_id = $_POST['file_table_id']??'';
  $file_table_id = rtrim($file_table_id, ',');
}

if(isset($_FILES['thumbnail']['name'])){
  if(isset($_FILES['thumbnail']['size']) > 10240000){
    echo "<script>
      alert('10MB 이하만 첨부할 수 있습니다.');
      history.back();
      </script>";
      exit;
  }
  if(strpos($_FILES['thumbnail']['type'], 'image') === false){
    echo "<script>
          alert('이미지만 첨부할 수 있습니다.');    
          history.back();            
        </script>";
        exit;
  }
  
  $save_dir = $_SERVER['DOCUMENT_ROOT']."/attention_renewal/pdata/class/";
  $filename = $_FILES['thumbnail']['name'];
  $ext = pathinfo($filename, PATHINFO_EXTENSION); 
  $newfilename = date("YmdHis").substr(rand(), 0,6); 
  $thumbnail = $newfilename.".".$ext; 
  if(move_uploaded_file($_FILES['thumbnail']['tmp_name'], $save_dir.$thumbnail)){  
    $thumbnail = "/attention_renewal/pdata/class/".$thumbnail;
  } else{
    echo "<script>
      alert('파일 첨부 실패.. :(');    
      history.back();            
    </script>";
  }
}

$sql = "INSERT INTO class (name, cate, content, thumbnail, price, price_val, level,   sale_end_date, date_val, regdate, status, file_table_id) 
 VALUES ('{$name}', '{$cate}', '{$content}', '{$thumbnail}', '{$price}', '{$price_val}', '{$level}',  '{$sale_end_date}', '{$date_val}', now(), '{$status}', '{$file_table_id}')";
$result = $mysqli -> query($sql);
$pid = $mysqli -> insert_id; 

for($i=0;$i<count($video);$i++){
  $videourl = $video[$i];
  $videosql = "INSERT INTO class_clips (pid, video_url) VALUES ({$pid}, '$videourl')";
  $videoresult = $mysqli->query($videosql);
}

if($result){
  if(isset($_POST['file_table_id'])){
    $updatesql = "UPDATE class_image_table SET pid={$pid} WHERE imgid IN ({$file_table_id})";
    $result2 = $mysqli -> query($updatesql);
  }
  echo "<script>
          alert('등록 완료되었습니다 :)');
          location.href ='./class_list.php';
          </script>";
 } else{
    echo "<script>
            alert('등록 실패.. :(');
            history.back();
          </script>";   
 }
?>