<?
#####################################################
# Dede 编织梦幻之旅 全站搜索程序
# www.dedecms.com  QQ: 2500875 Email: dbzllx@21cn.com
# 本程序占用资源比较大,如果你的HTML文件有很多,请使用足够性能的服务器
# 文件包括：
# par-web.php 对网站的html文件进行检索,并保存到数据库中
# search.php 搜索数据库的程序
# config.php 配置程序
# inc_listpage.php 分页算法
#####################################################
//------------你要建立索引的目录,这里用对于本程序的相对中径来表示，例如全站索引,则用"../"表示-------------
$basepath = "../";
$conn = mysql_connect("localhost","","");
mysql_select_db("dede");
//-----------中文字符截取-----------------------------------------=--
function cn_substr($str,$start,$len)
{
  	if(strlen($str) > $len)
  	{
		for($i=0;$i<$start+$len-2;$i++)
  		{
       		$tmpstr =(ord($str[$i])>127)?$str[$i].$str[++$i]:$str[$i];
       		if ($i>=$start) $tmp .= $tmpstr;
    	}
 		return $tmp.'…';
	}
 	else {
       	return $str;
 	}
}
?>