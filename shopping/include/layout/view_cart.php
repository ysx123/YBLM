<TABLE cellspacing=0 cellpadding=0 width="100%" border=0>
	<TR>
		<TD vAlign=top><IMG src="gifs/cart.gif" border=0>&nbsp;</TD>
		<TD vAlign=center width="99%">
		<A class=top_menu title="浏览购物篮" href="index.php?page=view_cart"><b>浏览购物车</b></A>
<?
$empty_cart=1;
$nr=0;
if (count($_SESSION['user']["article"])){
	for ($i=0;$i<count($_SESSION['user']["article"]);$i++){
		if ($_SESSION['user']["article"][$i]){
			$empty_cart=0;
			$nr++;
		}
	}
}
if (!$empty_cart){
$total=0;
$sub_total=0;
$shipping=0;
	for ($i=0;$i<count($_SESSION['user']["article"]);$i++):
		if ($_SESSION['user']["article"][$i]):
			$a=mysql_fetch_array(mysql_query("select title,price  from articles where article_id='".$_SESSION['user']["article"][$i]."'"));		
			$sub_total+=$a[1]*$_SESSION['user']["quantity"][$i];
		endif;
	endfor;
	$sub_total = sprintf ("%01.2f", $sub_total);
	$q=mysql_query("select * from shipping where active='1' order by id");
	while ($a=mysql_fetch_array($q)):
		if ($a["id"]==1){
			$shipping = sprintf ("%01.2f", $a["value"]);
			$total = sprintf ("%01.2f", $shipping+$sub_total);
		}
	endwhile;
	echo "<font size=\"1\"><br><b>$nr 类商品<br>合计: ￥".$total."</b></font>";
}
else echo "<font size=\"1\"> - 无商品</font>";
?>		
		</TD>
	</TR>
<?
if (!$empty){
	echo "<tr><td colspan=2><hr></td></tr>";
}
?>
</TABLE>