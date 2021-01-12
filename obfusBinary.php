<?php
for($i = 0; $i<2; $i = $i +1 )
{
  shell_exec("sudo -S chown -R www-data:www-data /home/ubuntu/web");
  exec("/home/ubuntu/web/obfus/retdec/retdec/bin/retdec-decompiler.py /home/ubuntu/web/obfus/retdec/target/src/target", $out1, $st1);
  if($st1){
    echo "fail1";
  }else{
    //      print_r($st1);
  }
  exec("/usr/local/bin/clang -Xclang -load -Xclang /home/ubuntu/seoyeon/llvm-pass-skeleton/build/skeleton/libSkeletonPass.so /home/ubuntu/web/obfus/retdec/target/src/target.ll", $out2, $st2);
  if($st2){
    echo "fail2";
  }else{
    //      print_r($out2);
  }
  exec("cp /home/ubuntu/web/a.out /home/ubuntu/web/obfus/retdec/target/src/target", $out3, $st3);
  if($st3){
    print_r($st3);
    echo "fail3";
  }else{
    //      print_r($out3);
  }
  //  echo "< for loop ".$i." > ";
}

?>
