<TR>
	<TD align=middle>
		<TABLE class=menu_body cellspacing=0 cellpadding=1 width="100%" border=0>
<?
$q=mysql_query("select * from categories where active='1' order by name asc");
while($a=mysql_fetch_array($q)){
?>
			<TR style="CURSOR: pointer" onclick="location.href='index.php?page=category&cat_id=<?=$a["cat_id"]?>'">
				<TD class=menu_link_tr onmouseover="this.className='menu_link_tr_over'" onmouseout="this.className='menu_link_tr'" width="100%">
					<TABLE cellspacing=0 cellpadding=0 width="100%" border=0>
						<TR>
                        	<TD vAlign=top noWrap>&nbsp;</TD>
                            <TD width="99%"><A class=category title="<?=$a["name"]?>" href="index.php?page=category&cat_id=<?=$a["cat_id"]?>"><b><?=$a["name"]?></b></A></TD>
						</TR>
					</TABLE>
				</TD>
			</TR>
<?
};//end while
?>
		</TABLE>
	</TD>
</TR>