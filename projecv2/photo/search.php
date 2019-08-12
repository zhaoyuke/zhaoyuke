<?
require("inc_listpage.php");
require("config.php");
$pagesize=25; 
$sql = "Select title,keyword,filename,dtime From weball where title like '%$keyword%' Or keyword like '%$keyword%'";
$sqlcount = "Select count(*) as dd From weball where title like '%$keyword%' Or keyword like '%$keyword%'";
$pageurl = "search.php?tag=1";
if($total_record=="")
{
      $rs=mysql_query($sqlcount,$conn);
      $row=mysql_fetch_object($rs);
      $total_record = $row->dd;
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>搜索程序</title>
<style type="text/css">
<!--
td {
	font-size: 10pt;line-height:160%
}
-->
</style>
</head>
<body>
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
  <form name="form1" method="get">
  <tr> 
    <td height="27" align="center"><input name="keyword" type="text" id="keyword2" maxlength="20"> 
      &nbsp; <input type="submit" name="Submit" value="全站搜索"></td>
  </tr>
  </form>
  <tr> 
    <td><hr size="1"></td>
  </tr>
  <tr> 
    <td height="29">
 <?
    $sql .= " order by ID desc ".get_limit($pagesize);
    if($total_record!=0)
    {
       $rs = mysql_query($sql,$conn);
       while($row=mysql_fetch_object($rs))
       {
       		$title = str_replace($keyword,"<font color='red'>$keyword</font>",$row->title);
       		$msg = $row->keyword;
       		$dtime = $row->dtime;
       		$filename = $row->filename;
       		@$start = strpos($keyword,$msg);
       		$mlen = strlen($msg);
       		if($mlen>450)
       		{
       			if($start>200) $msg = cn_substr($msg,$start-200,450);
       			else $msg = cn_substr($msg,0,450);
       		}
       		$msg = str_replace($keyword,"<font color='red'>$keyword</font>",$msg);
?>
    <table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr> 
          <td height="21"><a href='<?=$filename?>' style='font-size:11pt' target='_blank'><?=$title?></a></td>
        </tr>
        <tr> 
          <td>
          <?=$msg?></td>
        </tr>
        <tr> 
          <td>文件位置:<?=$filename?></td>
        </tr>
        <tr> 
          <td height="6"></td>
        </tr>
      </table>
<?
              	
       }
    }
 ?>
      </td>
  </tr>
  <tr>
    <td height="16" align="center">
<hr size="1"></td>
  </tr>
  <tr> 
    <td height="21" align="center">
    <?
     get_page_list($pageurl,$total_record,$pagesize);
    ?>
    </td>
  </tr>
  <tr> 
    <td height="20" align="right" bgcolor="#F6F6F6"><font size="2"><a href="http://www.xdede.com" target="_blank" style="font-size:10pt">Dede 
      编织梦幻之旅</a></font>&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?
mysql_close($conn);
?>