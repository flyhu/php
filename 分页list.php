<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_GET["title"]; ?></title>

</head>

<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <?php
require("config.php");
$cid = intval($_GET["cid"]);	
$result = mysql_query("SELECT * FROM v9_category where parentid='$cid' ");
while($r = mysql_fetch_array($result))
  {

?>
  <tr>
    <td align="center"><?=$r['catid']?> <a href="list.php?cid=<?=$r['catid']?>?&title=<?=$r['catname']?>" > <?=$r['catname']?></a></td>
  </tr>
    <?php
                }
                ?>
</table>
<?php 
$Page_size=7; 
mysql_select_db("phpcms", $con);
mysql_query("set names utf8");
$result2 = mysql_query("SELECT * FROM v9_picture where catid in(SELECT catid FROM v9_category where parentid='$cid')");
if(!mysql_affected_rows()){
$result2 = mysql_query("SELECT * FROM v9_picture where catid='$cid'");
}
$count = mysql_num_rows($result2); 
$page_count = ceil($count/$Page_size); 

$init=1; 
$page_len=7; 
$max_p=$page_count; 
$pages=$page_count; 

//判断当前页码 
if(empty($_GET['page'])||$_GET['page']<0){ 
$page=1; 
}else { 
$page=$_GET['page']; 
} 

$offset=$Page_size*($page-1); 
$result2 = mysql_query("SELECT * FROM v9_picture where catid in(SELECT catid FROM v9_category where parentid='$cid')  limit $offset,$Page_size");
if(!mysql_affected_rows()){
$result2 = mysql_query("SELECT * FROM v9_picture where catid='$cid' limit $offset,$Page_size");
}
while($rr = mysql_fetch_array($result2))
  {

?>
<p><?=$rr['title']?></p>
  <?php
                }

                $page_len = ($page_len%2)?$page_len:$pagelen+1;//页码个数 
$pageoffset = ($page_len-1)/2;//页码个数左右偏移量 

$key='<div class="page">'; 
$key.="<span>$page/$pages</span> "; //第几页,共几页 
if($page!=1){ 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?cid=".$cid."&page=1\">第一页</a> "; //第一页 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?cid=".$cid."&page=".($page-1)."\">上一页</a>"; //上一页 
}else { 
$key.="第一页 ";//第一页 
$key.="上一页"; //上一页 
} 
if($pages>$page_len){ 
//如果当前页小于等于左偏移 
if($page<=$pageoffset){ 
$init=1; 
$max_p = $page_len; 
}else{//如果当前页大于左偏移 
//如果当前页码右偏移超出最大分页数 
if($page+$pageoffset>=$pages+1){ 
$init = $pages-$page_len+1; 
}else{ 
//左右偏移都存在时的计算 
$init = $page-$pageoffset; 
$max_p = $page+$pageoffset; 
} 
} 
} 
for($i=$init;$i<=$max_p;$i++){ 
if($i==$page){ 
$key.=' <span>'.$i.'</span>'; 
} else { 
$key.=" <a href=\"".$_SERVER['PHP_SELF']."?cid=".$cid."&page=".$i."\">".$i."</a>"; 
} 
} 
if($page!=$pages){ 
$key.=" <a href=\"".$_SERVER['PHP_SELF']."?cid=".$cid."&page=".($page+1)."\">下一页</a> ";//下一页 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?cid=".$cid."&page={$pages}\">最后一页</a>"; //最后一页 
}else { 
$key.="下一页 ";//下一页 
$key.="最后一页"; //最后一页 
} 
$key.='</div>'; 
?> 
<div align="center"><?php echo $key?></div>
</body>
</html>
