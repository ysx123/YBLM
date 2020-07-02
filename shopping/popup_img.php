<?
include "shared/db_connect.php";
$query="SELECT pic,title FROM articles where article_id='".$_GET['article_id']."'";
$a=mysql_fetch_row(mysql_query($query));
?>
<html>
<head>

	<title><?=$a[1]?></title>
	<link rel="STYLESHEET" type="text/css" href="css/rsm.css">
</head>
<?
$img="pics/".$a[0];
$size=GetImageSize($img);
$w=$size[0];$h=$size[1];
?>
<body leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0">

<?
echo "<img src=\"$img\" border=0 $size[3]>";
?>
<div align="center"><input type="Button" class="buton" value="Close Window" onclick="self.close()"></div>

</body>
</html>
