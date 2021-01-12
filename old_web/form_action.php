<?php
echo "<!DOCTYPE html>
<html lang=\"ko\">

<head>
<meta charset=\"utf-8\">
<title>ObfusKorea</title>
<link rel=\"stylesheet\" type=\"text/css\" href=\"main.css\">
<script src=\"main.js\"></script>
</head>

<body>
<h1>OBFUS 코드 난독화 프로그램</h1>

<div class=\"\">
<p>> output</p>

<div class=\"output_code\">";


// 옵션 받아오기, 옵션 프린트
$name = $_POST['optionText'];
echo "<p>입력한 옵션 : ".$name."</p>";


$option_count = substr_count($name, '-') - 1;



// 업로드 주소
//$uploaddir = $_SERVER['DOCUMENT_ROOT']."/input/";
$uploaddir = "/home/ubuntu/web/input/";


$uploadfile = $uploaddir.basename($_FILES['inputFile']['name']);


echo '<pre>';
$fileType = pathinfo($uploadfile,PATHINFO_EXTENSION);
if($fileType != "c") {
        echo "실행파일을 입력하셨습니다.</br>";
        $uploadfile = "/home/ubuntu/web/obfus/retdec/target/src/target";
        if (move_uploaded_file($_FILES['inputFile']['tmp_name'], $uploadfile)) {
//              echo "파일이 정상적으로 업로드 되었습니다.\n";
        } else {
                echo "파일 업로드에 실패했습니다.\n";
        }
        include 'obfusBinary.php';

        $uploadOk = 0;


        print "</pre>";

        echo "<a href=\"download_binary.php\">다운로드</a>";

}else{
        //파일 업로드
        $uploadfile = $_SERVER['DOCUMENT_ROOT'].'/input.c';
        if (move_uploaded_file($_FILES['inputFile']['tmp_name'], $uploadfile)) {
//              echo "파일이 정상적으로 업로드 되었습니다.\n";
                include 'obfusSource.php';

                echo "<a href=\"download.php\">다운로드</a>";
        } else {
                echo "파일 업로드에 실패했습니다.\n";
        }
}


print "</pre>";

echo "
    </div>
  </div>

  <div class=\"buttonDiv\">
    <button type=\"button\" class=\"mainBtn\" style=\"vertical-align:middle\" onClick=\"location.href='main.html'\"><span>처음으로 </span></button>
  </div>

</html>";
?>
