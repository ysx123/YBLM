<?
include "session.php";
include "../shared/db_connect.php";
include "header.php";
include "layout/func.php";
include "../shared/query_results_limit.php";
include "content.php";

head($_POST['goto']);

?>
<html>
	<head>
		<title></title>
		<script src="js/admin.js" type="text/javascript"></script>
		<link rel="STYLESHEET" type="text/css" href="css/admin.css">	
	</head>
<body bgcolor='#FFFFFF' background='images/background.gif' text='#000000' leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'>
<?
//top();
tabbar($page,$action);
?>
<!-- Sidebar -->
<table width='100%' border='0' cellspacing='0' cellpadding='0'>
<tr>
	<td valign="top">
	<table width="181" border="0" cellspacing="0" cellpadding="0">

    	<tr valign="top"><td colspan='2' width="20" height="48" bgcolor='#1C95CC' valign='bottom'>&nbsp;</td></tr>
	
    	<tr valign="top">
			<td width="5" height="24"><img src="images/grad-1.gif" width="5" height="20"></td>
			<td height="24"><img src="images/grad-1.gif" width="160" height="20"></td>
		</tr>
	
		<tr><td width="5">&nbsp;</td>
	    <td class='nav'><?navigation();?></td></tr>
    </table>
</td>

<!-- Main contents -->
<td valign="top" width='100%'>
	<table width="640" border="0" cellspacing="0" cellpadding="0">
    <tr><td width="40" height="20">&nbsp;</td><td height="20">&nbsp;</td></tr>
    <tr>
		<td width="20">&nbsp;</td>
		<td>
<?
content($_GET['page'],$action);
?>
		</td>
	</tr>

	<!-- Spacer -->
	<tr><td width="40" height="20">&nbsp;</td>
	<td height="20" align="center">&nbsp;<br><br><a href="../index.php" target="_blank"><font size=1><b>Õ¯…œ…Ã≥«</b></font></a></td></tr>
	</table>
</td></tr>
</table>

</body>
</html>
