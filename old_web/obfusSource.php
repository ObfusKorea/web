<?php
  $je= "/usr/bin/java -jar "."Obfuscator.jar".$name;
  //exec("/usr/bin/java -jar Obfuscator.jar".$options, $out, $st);
  exec($je, $out, $st);

  if($st){
          echo "fail";
  }else{
  //      print_r($out);
  }

  exec("cp /home/ubuntu/web/result_C_".$option_count.".c ".$_SERVER['DOCUMENT_ROOT'].'/result/result.c' , $out, $st);
  if($st){
          echo "fail";
  }else{
  //      print_r($out);
  }
?>
