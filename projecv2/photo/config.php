<?
#####################################################
# Dede ��֯�λ�֮�� ȫվ��������
# www.dedecms.com  QQ: 2500875 Email: dbzllx@21cn.com
# ������ռ����Դ�Ƚϴ�,������HTML�ļ��кܶ�,��ʹ���㹻���ܵķ�����
# �ļ�������
# par-web.php ����վ��html�ļ����м���,�����浽���ݿ���
# search.php �������ݿ�ĳ���
# config.php ���ó���
# inc_listpage.php ��ҳ�㷨
#####################################################
//------------��Ҫ����������Ŀ¼,�����ö��ڱ����������о�����ʾ������ȫվ����,����"../"��ʾ-------------
$basepath = "../";
$conn = mysql_connect("localhost","","");
mysql_select_db("dede");
//-----------�����ַ���ȡ-----------------------------------------=--
function cn_substr($str,$start,$len)
{
  	if(strlen($str) > $len)
  	{
		for($i=0;$i<$start+$len-2;$i++)
  		{
       		$tmpstr =(ord($str[$i])>127)?$str[$i].$str[++$i]:$str[$i];
       		if ($i>=$start) $tmp .= $tmpstr;
    	}
 		return $tmp.'��';
	}
 	else {
       	return $str;
 	}
}
?>