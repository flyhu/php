<?php      
function preg_substr($start, $end, $str) // 正则截取函数      
{      
    $temp = preg_split($start, $str);      
    $content = preg_split($end, $temp[1]);      
    return $content[0];      
}   
function str_substr($start, $end, $str) // 字符串截取函数      
{      
    $temp = explode($start, $str, 2);      
    $content = explode($end, $temp[1], 2);      
    return $content[0];      
}
?>   
<?php
ini_set('user_agent','Mozilla/5.0');
header("content-type:text/html; charset=UTF-8"); //设置编码
$id = $_GET["id"];

$xml = simplexml_load_file("http://iport.mlgx.com.cn/IssueService.do?method=queryHeadlines&category_id=".$id."&pageBegin=1&pageEnd=10");
$start1 = '<div id="cont">';
$start2 = '<div class="gallery">';
$start0 = $start1||$start2;
$htm = '</div> </div> <script src="./js/m_article.js"></script>' ;
$end0 = $htm||$html_m;
echo "<br>循环读取:<br>";
foreach($xml->headlines->headline as $list){
	$cf = preg_replace("/\s+/", " ", file_get_contents("http://iport.mlgx.com.cn/IssueService.do?method=queryWebContent&content_id=".$list['id']."&url_type=view"));   
   $str = iconv("UTF-8", "UTF-8", $cf);    
   $cont = str_substr($start1, $htm, $str);  
    $id = substr($list["id"],9);
    echo "-------------------<br>";
    echo "id:".$id."<br>";
    echo "标题:".$list['title']."<br>";
    echo "时间:".$list['publish_date']."<br>";
    echo "图片:".$list['img_url']."<br>";
	 echo "内容:".$cont."<br>";

}

?>
