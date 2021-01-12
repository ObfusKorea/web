<?php
  $file_name = 'index.html'; // 저장될 파일 이름
  $file = $_SERVER['DOCUMENT_ROOT'].'/index.html'; // 파일의 전체 경로

  $fp = fopen($file, 'rb');
  fpassthru($fp);
  fclose($fp);
?>
