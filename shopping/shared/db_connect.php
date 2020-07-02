<?
$SESS_DBHOST = "localhost";			/* 数据库服务器地址 */
$SESS_DBNAME = "shop";		/* 数据库名称 */
$SESS_DBUSER = "root";				/* 登录用户名 */

$SESS_DBPASS = "root";			/* 登录密码 */
$SESS_DBH = mysql_connect($SESS_DBHOST, $SESS_DBUSER,$SESS_DBPASS);
mysql_query("SET NAMES 'GB2312'"); 
mysql_select_db($SESS_DBNAME,$SESS_DBH);
?>
