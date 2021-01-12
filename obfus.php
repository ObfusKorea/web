<?php
echo "
<!DOCTYPE html>
<html lang=\"ko\">

<head>
  <meta charset=\"utf-8\">
  <meta name=\"viewport\" content=\"width=device-width,initial-scale=1\">
  <title>Obfus</title>

  <!-- 폰트 -->
  <link rel=\"preconnect\" href=\"https://fonts.gstatic.com\">
  <link href=\"https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap\" rel=\"stylesheet\">

  <!-- css -->
  <link rel=\"stylesheet\" type=\"text/css\" href=\"css/obfus_done.css\">

  <!-- js -->
  <script src=\"https://code.jquery.com/jquery-1.12.4.min.js\"></script>
  <script src=\"js/obfus_done.js\"></script>
</head>

<body>
<header>
  <img src=\"img/obfus_logo.png\" id=\"logo\" alt=\"obfus_logo\">
  <span id=\"logo_text\">An Obfuscation Tool for C and Binary Programs</span>
  <button type=\"button\" id=\"github_repository\" onclick=\"window.open('https://github.com/ObfusKorea/Obfuscator')\">GitHub</button>
  <p>OBFUS is an obfuscation tool for software copyright and vulnerability protection. It provides obfuscation for C code and binary programs, so choose what to obfuscate and paste (or upload) your code below. And you can get a obfuscated version of your work. Is there any difficulty using the web page? Look <a href=\"help.html\">how to Use it</a>!</p>
</header>

  <section id=\"content\">
    <div class=\"two_tabs\">

      <!-- 탭 헤더 -->";

// 어떤 난독화인지에 따라 탭 헤더 조정
$type = $_POST['type'];
if ($type=="source") {
  echo "<h2 class=\"tab_header\"><a href=\"#source\" id=\"source_header\" style=\"background-color: white; border-bottom: solid white 2px;\">Source</a><a href=\"#binary\" id=\"binary_header\">Binary</a></h2>";
}else{
  echo "<h2 class=\"tab_header\"><a href=\"#source\" id=\"source_header\">Source</a><a href=\"#binary\" id=\"binary_header\" style=\"background-color: white; border-bottom: solid white 2px;\">Binary</a></h2>";
}

echo "<div id=\"source\" class=\"tab\"></div>

      <p>Your Code : </p>";

if ($type=="source") {
  if($_FILES['input_file']['name'] != ""){
    // 파일로 올렸을 때
    echo $_FILES['input_file']['name'];

    echo "<textarea id=\"input_code\" readonly>";
    if (($filehandle = fopen($_FILES['input_file']['tmp_name'], "r")) != FALSE) {
      while( !feof($filehandle) ) {
      echo fgets($filehandle);
      }
      fclose($filehandle);
    }
    echo "</textarea>";
  }else{
    // 코드 붙여넣기로 올렸을 때
    $uploadfile = $_SERVER['DOCUMENT_ROOT'].'/input.c';
    if (($filehandle = fopen($uploadfile, "w")) != FALSE) {
      $text = $_POST['input_code'];
      $text .= "\n";
      $text = preg_replace('/\015/','',$text);      fwrite($filehandle, $text);
      fclose($filehandle);
    }
    echo "<textarea id=\"input_code\" readonly>";
    if (($filehandle = fopen($uploadfile, "r")) != FALSE) {
      while( !feof($filehandle) ) {
      echo fgets($filehandle);
      }
      fclose($filehandle);
    }
    echo "</textarea>";
  }
}

echo "
      <p>Selected Options : </p>";

// 옵션 받아오기, 옵션 프린트
$options = $_POST['option_text'];
echo "
      <input type=\"text\" id=\"option_text\" name=\"option_text\" value=\"".$options."\" readonly></br></br>
    </div>
    </div>";
$option_count = substr_count($options, '-') - 1;

echo "
    <img src=\"img/arrow.png\" class=\"arrow\">

    <!-- 결과 출력 창 -->
    <div class=\"result\" id=\"result_div\">";

// 업로드 주소
$uploaddir = "/home/ubuntu/web/input/";
$uploadfile = $uploaddir.basename($_FILES['input_file']['name']);

$fileType = pathinfo($uploadfile,PATHINFO_EXTENSION);
if ($type == "source" && $options !="") {
  // 소스코드 난독화
  if($_FILES['input_file']['name'] != ""){
    // 파일로 올렸을 때
    $uploadfile = $_SERVER['DOCUMENT_ROOT'].'/input.c';
    if (move_uploaded_file($_FILES['input_file']['tmp_name'], $uploadfile)) {
      include 'obfusSource.php';
      echo "
        <h3>Obfuscation Successful!</h3>
        <div class=\"output\">
          <p>Obfuscated Code : </p>
          <textarea id=\"output_code\" readonly>";

      $obfusedfile = $_SERVER['DOCUMENT_ROOT'].'/result/result.c';
      if (($filehandle = fopen($obfusedfile, "r")) != FALSE) {
        while( !feof($filehandle) ) {
          echo fgets($filehandle);
        }
        fclose($filehandle);
      }

      echo "</textarea>
        </div>
        <a href=\"download.php\" class=\"file_btn\">Download</a>
        <p class=\"center_or\">or</p>";
    } else {
      echo "<h3>Obfuscation Failed..</h3>
      <p>Something wrong in file upload. Try later!</p>";
    }
  }else{
    // 코드 붙여넣기로 올렸을 때
    include 'obfusSource.php';
    echo "
      <h3>Obfuscation Successful!</h3>
      <div class=\"output\">
        <p>Obfuscated Code : </p>
        <textarea id=\"output_code\" readonly>";

    $obfusedfile = $_SERVER['DOCUMENT_ROOT'].'/result/result.c';
    if (($filehandle = fopen($obfusedfile, "r")) != FALSE) {
      while( !feof($filehandle) ) {
        echo fgets($filehandle);
      }
      fclose($filehandle);
    }

    echo "</textarea>
      </div>
      <a href=\"download.php\" class=\"file_btn\">Download</a>
      <p class=\"center_or\">or</p>";
  }
} else if($type == "binary" && $options !=""){
  // 바이너리 난독화
  $uploadfile = "/home/ubuntu/web/obfus/retdec/target/src/target";
  if (move_uploaded_file($_FILES['input_file']['tmp_name'], $uploadfile)) {
    include 'obfusBinary.php';
    $uploadOk = 0;
    echo "
      <h3>Obfuscation Successful!</h3>
      <div class=\"output\">
        <p>Obfuscated Code : </p>
      </div>
      <a href=\"download_binary.php\" class=\"file_btn\">Download</a>
      <p class=\"center_or\">or</p>";
  } else {
    echo "<h3>Obfuscation Failed..</h3>
    <p>Something wrong in file upload. Try later!</p>";
  }
} else{
  echo "<h3>Obfuscation Failed..</h3>
  <p>Try check your file and options!</p>";
}

echo "
  <button type=\"button\" name=\"button\" onclick=\"location.href='main.html'\" class=\"file_btn\">Retry</button>

</div>
</section>
</body>

</html>";
?>
