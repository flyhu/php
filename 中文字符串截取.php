<?php
//此函数完成带汉字的字符串取串
function substr_CN($str,$mylen){                                                                                                                                        
$len=strlen($str);
$content='';
$count=0;
for($i=0;$i<$len;$i++){
   if(ord(substr($str,$i,1))>127){
    $content.=substr($str,$i,2);
    $i++;
   }else{
    $content.=substr($str,$i,1);
   }
   if(++$count==$mylen){
    break;
   }
}
echo $content;
}

 

$str="来自玉林市福绵管理区香山村的钟远梅代表，进入会堂那一刻还是稍显紧张。“我代表着群众，生怕做得不好。”她对记者说。会间休息时，钟远梅的手机响了。电话那头，村里的妇女陈梅告诉她，一天时间就已经收到900多元捐款。挂了电话，钟远梅脸上有了笑容：陈梅家庭困难，因重病住院，医疗??…";
substr_CN($str,21);//输出34中
?>
