<?
$SESS_DBHOST = "localhost";			/* ���ݿ��������ַ */
$SESS_DBNAME = "shop";		/* ���ݿ����� */
$SESS_DBUSER = "root";				/* ��¼�û��� */

$SESS_DBPASS = "root";			/* ��¼���� */
$SESS_DBH = mysql_connect($SESS_DBHOST, $SESS_DBUSER,$SESS_DBPASS);
mysql_query("SET NAMES 'GB2312'"); 
mysql_select_db($SESS_DBNAME,$SESS_DBH);
?>
