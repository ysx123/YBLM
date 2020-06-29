<?
Function content($page)
{
	Global $cat_id,$article_id;
	If (!$cat_id) $cat_id=0;

	Switch ($page)
	{
		Case "search":			
			search($_POST['keyword']);
		Break;
		Case "static_page":			
			static_page($_GET['page_id']);
		Break;
		Case "zoom_article":
			zoom_article($_GET['article_id']);
		Break;
		Case "category":
			category($_GET['cat_id']);
		Break;
		Case "view_cart":
			view_cart();
		Break;
		Default:
			category(0);
	};
}


Function display_article($article_id,$display_type,$text_type,$no_title)
{
	$query="select article_id, title, short_text, pic, price, long_text from articles where article_id='$article_id' ";
	$a=mysql_fetch_row(mysql_query($query));
	$text=$a[2];
	if ($text_type=="long") $text=$a[5];

	$sursa="pics/".$a[3];
	$z=@getImageSize($sursa);
	$si=explode("\"",$z[3]);
	$wd1=$wd=$si[1];
	$he1=$he=$si[3];
	if ($wd>$he){
		if ($wd>136){
			$x = 136 * $he;
			$he =  round($x / $wd);
			$wd = 136 ;
		}
	}
	else{
		if ($he>180){
			$x = 180 * $wd;
			$wd =  round($x / $he);
			$he = 180 ;
		}
}
?>
						<TR>
							<TD valign=top width="100%">
                                <?if(!$no_title){?><font class="art_title"><?=$a[1]?></font><?}?>
								<BR>
								<?=nl2br($text)?>
								<BR>
								<table width="100%" border="0" cellpadding="0" cellspacing="0">
									<tr><td colspan="2"><b>价格: </b>$ <?=$a[4]?></td></tr>
									<tr>
										<?if($display_type=="normal"){?>
										<td><A href="index.php?page=zoom_article&article_id=<?=$a[0]?>">详细资料</A></td>
										<?}else{?>
											<td><A href="javascript:history.back()"><< 返回</A></td>										
										<?}?>
										<td align="right"><A href="index.php?goto=add_to_cart&article_id=<?=$a[0]?>">购买</A></td>
									</tr>
								</table>
							</TD>
                            <TD valign=top>
                                <TABLE cellspacing=0 cellpadding=0 width="100%" border=0 NOF="TE">
	                                <TR>
    		                            <TD align=right>
											<?
											if($a[3]){
												if($display_type=="normal"){
											?>
													<A href="index.php?page=zoom_article&article_id=<?=$a[0]?>"><img src="<?echo $sursa?>" width="<?echo $wd?>" height="<?echo $he?>" alt="点击查看详细资料" border="0"></A>
											<?	
												}else{
												?>
													<A href="javascript:popup('popup_img.php?article_id=<?=$a[0]?>','art_img','<?=$wd1?>','<?=($he1+25)?>')"><img src="<?echo $sursa?>" width="<?echo $wd?>" height="<?echo $he?>" alt="查看图片" border="0"></A>												
												<?
												}
											}
											?>
										</TD>
									</TR>
								</TABLE>
							</TD>
							<td>&nbsp;</td>
						</TR>
<?
}

Function category($cat_id){
//shop_stat_cat($cat_id);
$a_cat=mysql_fetch_row(mysql_query("select name from categories where cat_id='$cat_id'"));
?>
<TR>
	<TD align="center" valign=top width=598>
		<TABLE cellspacing=0 cellpadding=0 width="100%" border=0>
			<TR>
				<TD width="80%" valign=top>
					<TABLE cellspacing=0 cellpadding=0 width="100%" border=0>
						
<TR>
	<TD valign=top align="center" colspan="2">
		<H2><b><?=$a_cat[0]?></b></H2>
	</TD>
</TR>
<?
$query="
select a.article_id, a.title, a.short_text, a.pic, a.price  
from articles a
inner join p2c b on a.article_id=b.article_id 
where b.cat_id='$cat_id' and a.active='1' order by a.title asc 
";
$q=mysql_query($query);
$contor=0;
$exclude_article_id="0,";
while ($a=mysql_fetch_row($q)):
	$exclude_article_id.=$a[0].",";
	if ($contor)
		echo "<tr><td colspan=\"2\" width=\"100%\"><hr width=\"100%\" size=\"1\"></td></tr>";
	display_article($a[0],"normal","short",0);
	$contor++;
endwhile;
$exclude_article_id=substr ($exclude_article_id, 0,strlen($exclude_article_id)-1);
?>				
				</TABLE>
				</TD>
				<td nowrap valign="top" width="1%" background="gifs/navbg.gif">&nbsp;</td>
				<td nowrap align="center" valign="top" width="20%"><b>优惠促销:</b><br><?special_offers($exclude_article_id);?></td>
			</TR>
		</TABLE>
	</TD>
</TR>
<?}

Function zoom_article($article_id){
shop_stat_prod($article_id);
$a=mysql_fetch_row(mysql_query("select article_id, title, long_text, pic, price from articles where article_id='$article_id'"));
?>
<TR>
	<TD align="center" valign=top width=598>
		<TABLE cellspacing=0 cellpadding=0 width="100%" border=0>
			<TR>
				<TD width="80%" valign=top>
					<TABLE cellspacing=0 cellpadding=0 width="100%" border=0>
						
<TR>
	<TD valign=top align="center" colspan="2">
		 <font class="art_title"><?=$a[1]?></font>
	</TD>
</TR>
<?
		display_article($article_id,"zoom","long",1);
?>
				</TABLE>
				</TD>
				<td nowrap valign="top" width="1%" background="gifs/navbg.gif">&nbsp;</td>
				<td nowrap align="center" valign="top" width="20%"><b>优惠促销:</b><br><?special_offers($article_id);?></td>
			</TR>
		</TABLE>
	</TD>
</TR>
<?}

Function special_offers($exclude_article_id){
$query="
select a.article_id, a.title,b.cat_id, a.pic, a.price  
from articles a
inner join p2c b on a.article_id=b.article_id 
where a.active='1' and a.special_offer='1' and a.article_id not in ($exclude_article_id) 
group by a.article_id 
order by RAND()
limit 5 
";
$q=mysql_query($query);
$contor=0;
echo "<table border=0 width=100% cellpadding=\"0\" cellspacing=\"0\">";
while ($a=mysql_fetch_row($q)):
$sursa="pics/".$a[3];
$z=@getImageSize($sursa);
$si=explode("\"",$z[3]);
        $wd=$si[1];
        $he=$si[3];
if ($wd>$he){
	if ($wd>100){
		$x = 100 * $he;
        $he =  round($x / $wd);
        $wd = 100 ;
    }
}
else{
	if ($he>125){
		$x = 125 * $wd;
		$wd =  round($x / $he);
		$he = 125 ;
	}
}
if ($contor){
?>
	<tr><td width="100%" align="center"><hr width="100%" size="1"></td></tr>
<?}?>	

	<tr><td width="100%" background="gifs/menu_bgrnd_header_2.gif" align="center"><a href="index.php?page=zoom_article&article_id=<?=$a[0]?>&cat_id=<?=$cat_id?>"><?=$a[1]?></a></td></tr>
	<TR><TD align=center><?if($a[3]){?><A href="index.php?page=zoom_article&article_id=<?=$a[0]?>"><img src="<?echo $sursa?>" width="<?echo $wd?>" height="<?echo $he?>" alt="Click here for details" border="0"></A><?}?></TD></TR>
	<tr><td align=center><b>单价￥<?=$a[4]?> 元</b></td></tr>
<?
$contor++;
endwhile;
echo "</table>";
}


Function view_cart(){

?>
<TR>
	<TD align="center" valign=top width=598>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
	<tr> 
		<td width="100%" height="30" valign="top" align="center"> 
		<font class=art_title>购物车</font><br><br>
<?
$empty_cart=1;
if (count($_SESSION['user']["article"])){
	for ($i=0;$i<count($_SESSION['user']["article"]);$i++)
		if ($_SESSION['user']["article"][$i])
			$empty_cart=0;
}
if (!$empty_cart){
?>
<form action="index.php?goto=update_cart" method="post" name="cart">
			<table width="99%" border="0" cellpadding="2" cellspacing="0">
				<tr>
					<td><b>商品名称</b></td>
					<td align="center"><b>数量</b></td>
					<td align="center"><b>单价</b></td>
					
					<td>&nbsp;</td>
				</tr>
<?
$total=0;
$sub_total=0;
$shipping=0;
	for ($i=0;$i<count($_SESSION['user']["article"]);$i++):
		if ($_SESSION['user']["article"][$i]):  //=$i
			
?>
				<tr>
					<td class=sec><font class=white1><?
					$a=mysql_fetch_array(mysql_query("select title,price  from articles where article_id='".$_SESSION['user']["article"][$i]."'"));
					echo "<a href=\"index.php?page=zoom_article&article_id=".$_SESSION['user']["article"][$i]."\" class=\"article\">".$a[0]."</a>";
					?></a></td>
					<td class=sec align="center"><input type=text size=3 maxlength="2" name="q[]" value="<?=$_SESSION['user']["quantity"][$i]?>"></td>
					<td class=sec nowrap align="left"><font class=white1><b>￥ <?= sprintf ("%01.2f", $a[1]*$_SESSION['user']["quantity"][$i])?></b></font></td>
					<td nowrap align="right">&nbsp;&nbsp;<a href="index.php?goto=del_cart&article_id=<?=$_SESSION['user']["article"][$i]?>&i=<?=$i?>" class=sec>删除</a></td>
				</tr>
<?
		$sub_total+=$a[1]*$_SESSION['user']["quantity"][$i];
		endif;
	
	endfor;
	$sub_total = sprintf ("%01.2f", $sub_total);
?>
				<tr><td class=white1 colspan="4">&nbsp;</td></tr>
				<tr>
					<td class=white1 colspan="3" align="right">
						<table border=0 cellpadding="2" cellspacing="0">
							<?
								$q=mysql_query("select * from shipping where active='1' order by id");
								$jj=0;
								while ($a=mysql_fetch_array($q)):
									  if ($a["id"]==1){
									  	$shipping = sprintf ("%01.2f", $a["value"]);
										$total = sprintf ("%01.2f", $shipping+$sub_total);
										}
									
								$jj++;
								endwhile;
							?>
						</table>
					</td>
				</tr>
					<input type=hidden name="shipping" value="<?=$shipping?>">
				<tr><td class=white1 colspan="4">&nbsp;</td></tr>
				<tr><td class=white1 colspan="3" align="right"><b>运费: ￥ <?=$shipping?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
				<tr><td class=white1 colspan="3" align="right"><b>商品价格: ￥ <?=$sub_total?></b>&nbsp;</td></tr>
				<tr><td class=white1 colspan="3" align="right"><b>合计: ￥ <?=$total?></b>&nbsp;</td></tr>
				<tr><td class=white1 colspan="4">&nbsp;</td></tr>
				<tr>
					<td><input type="button" class=buton value="<< 返回首页" onclick="document.location='index.php'">&nbsp;&nbsp;</td>
					<input type="Hidden" name="page" value="view_cart">
					<input type="Hidden" name="goto" value="update_cart">
					<td align="center" colspan="2"><input class="buton" type="submit" value="更新购物车"></td>
		</form>

			<FORM name="paysystem" method=post action="">
					<td align="right" colspan="2"><input class="buton" type="submit" value="结算"></td>
				</tr>
			</table>
			</form>			

<?}else{?>
您的购物车为空.<br><br>
<input type="button" class="buton" value="返回首页" onclick="document.location='index.php'">
<?}?>
		</td>
	</tr>
</table>
		</td>
	</tr>
<?	
}

function bottom_links(){
$q=mysql_query("select * from static_pages order by page_name");
while($a=mysql_fetch_array($q))
	echo "[<A title=Home href=\"index.php?page=static_page&page_id=".$a["page_id"]."\">".$a["page_name"]."</A>] ";
}

function static_page($page_id){
$a=mysql_fetch_row(mysql_query("select * from static_pages where page_id='$page_id'"));
?>
<TR>
	<TD align="center" valign=top width=598>
		<TABLE cellspacing=0 cellpadding=0 width="100%" border=0>
			<TR>
				<TD width="80%" valign=top>
					<TABLE cellspacing=0 cellpadding=4 width="100%" border=0>
						<TR>
							<TD valign=top align="center"><font class="art_title"><?=$a[1]?></font></TD>
						</TR>
						<TR>
							<TD valign=top width="100%">
								<BR>
								<div align="justify">
								<?=nl2br($a[2])?>
								</div>
								<BR>
							</TD>
						</TR>
				</TABLE>
				</TD>
				<td nowrap valign="top" width="1%" background="gifs/navbg.gif">&nbsp;</td>
				<td nowrap align="center" valign="top" width="20%"><b>优惠促销:</b><br><?special_offers(0);?></td>
			</TR>
		</TABLE>
	</TD>
</TR>
<?
}
Function search($keyword){
$query="
select a.article_id 
from articles a 
inner join p2c b on a.article_id=b.article_id 
where (a.title like '%$keyword%' or a.short_text like '%$keyword%' or a.long_text like '%$keyword%') and a.active='1' 
group by a.article_id
order by a.title asc 
limit 30
";
$q=mysql_query($query);
$contor=0;
$exclude_article_id="0,";
?>
<TR>
	<TD align="center" valign=top width=598>
		<TABLE cellspacing=0 cellpadding=0 width="100%" border=0>
			<TR>
				<TD width="80%" valign=top>
					<TABLE cellspacing=0 cellpadding=4 width="100%" border=0>
						<TR>
							<TD valign=top align="center" colspan=2><font class="art_title">搜索结果</font><br><b>关键字: <?=$keyword?></b><br>与您搜索相关的记录共有：<?=mysql_num_rows($q)?> 条</TD>
						</TR>
<?
while ($a=mysql_fetch_row($q)):
	$exclude_article_id.=$a[0].",";
	if ($contor)
		echo "<tr><td colspan=\"2\" width=\"100%\"><hr width=\"100%\" size=\"1\"></td></tr>";
	display_article($a[0],"normal","short",0);
	$contor++;
endwhile;
$exclude_article_id=substr ($exclude_article_id, 0,strlen($exclude_article_id)-1);
?>
				</TABLE>
				</TD>
				<td nowrap valign="top" width="1%" background="gifs/navbg.gif">&nbsp;</td>
				<td nowrap align="center" valign="top" width="20%"><b>优惠促销:</b><br><?special_offers($exclude_article_id);?></td>
			</TR>
		</TABLE>
	</TD>
</TR>
<?

}
?>