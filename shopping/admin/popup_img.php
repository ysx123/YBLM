<?
include "session.php";
include "../shared/db_connect.php";
?>
<html>
<head>
	<title>‰Ø¿¿ÕºœÛ</title>
</head>
<?
$query="SELECT pic FROM articles where article_id='".$_GET['article_id']."'";
$a=mysql_fetch_row(mysql_query($query));
$img="../pics/".$a[0];
$size=GetImageSize($img);
$w=$size[0];$h=$size[1];
?>
<body leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0" onload="window.resizeTo(<?=$w?>,<?=$h?>);">

<?
echo "<img src=\"$img\" border=0 $size[3]>";
?>

</body>
</html>
