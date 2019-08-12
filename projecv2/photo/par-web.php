<?
require("config.php");
/*------------创建用于保存全站索引的数据表-----------*/
$maketable = "
CREATE TABLE `weball` (
`ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
`title` VARCHAR(100) NOT NULL, 
`keyword` TEXT NOT NULL, 
`filename` VARCHAR(250) NOT NULL, 
`dtime` DATETIME NOT NULL
); 
";
@mysql_query($maketable,$conn);	
mysql_query("Delete From weball",$conn);
$pweb = new ParWeb();
$pweb->conn = $conn;
//$pweb->path = $basepath;
$pweb->Doing($basepath);
//----------------------------------------------------
mysql_close($conn);
/***********分析本站的html文件的类********************/
class ParWeb
{
	var $conn;
	function Doing($path)
	{
		$dh = dir($path);
		while($filename=$dh->read())
		{
			if(!ereg("^\.",$filename))
			{
				$fullname = $path."/".$filename;
				if(is_dir($fullname)) $this->Doing($fullname);
				else
				{
					if(eregi("\.htm",$filename))
					{
						$fp = fopen($fullname,"r");
						$str = fread($fp,filesize($fullname));
						$tags = split(">",$str);
						fclose($fp);
						$filetime = filemtime($fullname);
     					$dtime = strftime("%y-%m-%d %H:%M:%S",$filetime);
     					$body = "";
     					$title = "";
     					$t=0;
     					$j=0;
     					foreach($tags as $tag)
     					{
     						$tag = ereg_replace("[\n\r\t]","",str_replace(" ","",$tag));	
     						if($t==0)
     						{
     							if(eregi("<tit",$tag))
     							{
     								$title = eregi_replace("<(.*)$","",$tags[$j+1]);
     								$t=1;
     							}	
     						}
     						if($t==1)
     						    if(eregi("<body",$tag)) $t=2;
     						if($t==2&&$tag[0]!="<")
     						{
     							$body .= str_replace("&nbsp;","",ereg_replace("<(.*)$","",$tag));
     						}
     						$j++;
     					}
     					$webfilename = ereg_replace("^\.{2}","",$fullname);
     					if($title=="") $title = $webfilename;
     					mysql_query("Insert Into weball(title,keyword,filename,dtime) Values('$title','$body','$webfilename','$dtime')",$this->conn);
						echo "$webfilename <br> $title ok<br>\n";
					}
				}
			}	
		}
	}
}	
?>