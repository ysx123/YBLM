<?
Function content($page,$action){
Global $l2;

if (!$_SESSION[adm]["id"])
echo "<br><br>
	<form method=\"post\">
	<table>
		<input type=\"hidden\" name=\"goto\" value=\"check_login\">
		<tr>
			<td>用户名:</td>
			<td><input type=\"text\" name=\"username\"></td>
		</tr>
		<tr>
			<td>密码:</td>
			<td><input type=\"password\" name=\"password1\"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type=\"submit\" class=\"buton\" VALUE=\"登录\"></td>
		</tr>
	</table>
	</form>
";
else {//$adm["id"]!=0
	Switch ($page):
	
		Case "shipping":
			shipping();
		Break;
	
		
		Case "edit_static_page":
			Global $page_id;
			edit_static_page($page_id);
		Break;
		
		Case "static_pages":
			static_pages();
		Break;
		
		Case "category_views":
			Global $month,$day,$year,$month2,$day2,$year2;
			category_views($month,$day,$year,$month2,$day2,$year2);
		Break;

		Case "product_views":
			Global $month,$day,$year,$month2,$day2,$year2;
			product_views($month,$day,$year,$month2,$day2,$year2);
		Break;

		Case "categories":
			categories();
		Break;
		Case "edit_category":
			//Global $id;
			edit_category($_GET['id']);
		Break;

		Case "products":
			products();
		Break;
		Case "edit_product":
		
			edit_product($_GET['id']);
		Break;

		Case "administrators":
			administrators();
		Break;
		Case "edit_admin":
			
			edit_admin_profile($_GET['id']);
		Break;
		Case "my_profile":
			edit_admin_profile($_SESSION[adm]["id"]);
		Break;
		Default:
			home();
	EndSwitch;
}

}//Function content(){

Function home(){
	echo "<br><br><br><span class='tab-s'>欢迎进入管理页面.</span>.";
}

Function edit_admin_profile($id){
$a=mysql_fetch_array(mysql_query("select * from admins where id='$id'"));
$active_status="checked";
$suspended_status="";
if ($a["status"]!='Active'){
	$active_status="";
	$suspended_status="checked";
}
?>
<form method=post>
<table border=0 cellpadding="2" cellspacing="0">
	<tr><td><b>用户名:</b></td><td><input type="text" name="username" value="<?=$a["username"]?>"></td></tr>
	<tr><td><b>密码:</b></td><td><input type="text" name="pass" value="<?=$a["pass"]?>"></td></tr>
	<tr><td><b>姓:</b></td><td><input type="text" name="lname" value="<?=$a["lname"]?>"></td></tr>
	<tr><td><b>名:</b></td><td><input type="text" name="fname" value="<?=$a["fname"]?>"></td></tr>
	<tr><td><b>状态:</b></td><td><input type="radio" name="status" value="Active" <?=$active_status?>> 活动的 &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="status" value="Suspended" <?=$suspended_status?>> 暂停</td></tr>
	<tr><td colspan="2">&nbsp;</td></tr>
	<tr><td colspan="2" align="right"><input type="Submit" class="buton" value="<?if ($id){?>更新管理员资料<?}else{?>创建管理员<?}?>"></td></tr>
</table>
<input type="Hidden" name="goto" value="update_admin">
<input type="Hidden" name="id" value="<?=$id?>">
</form>
<?
}
Function administrators(){
$q=mysql_query("select *,date_format(date_inserted,'%m/%d/%Y %h:%i %p') as di,date_format(date_updated,'%m/%d/%Y %h:%i %p') as du from admins order by username");
echo "<table border=\"0\" width=\"100%\">";
	echo "<tr><td colspan=5>&nbsp;</td></tr>";
	echo "><b>添加新的管理员</b></a></td></tr>";
	echo "<tr><td colspan=5>&nbsp;</td></tr>";
	echo "<tr><TD align=\"center\"><b>用户名</b></TD><TD align=\"center\"><b>名称</b></TD><TD align=\"center\"><b>状态</b></TD><TD align=\"center\"><b>添加时间</b></TD><TD align=\"center\"><b>更新时间</b></TD></tr>";
while($a=mysql_fetch_array($q)):
	echo "<tr>";
	echo "<TD align=\"center\"><a href=\"main.php?page=edit_admin&id=".$a["id"]."\">".$a["username"]."</a></td>";
	echo "<TD align=\"center\">".$a["fname"]." ".$a["lname"]."</td>";
	echo "<TD align=\"center\">".$a["status"]."</td>";
	echo "<TD align=\"center\">".$a["di"]."</td>";
	echo "<TD align=\"center\">".$a["du"]."</td>";
	echo "</tr>";
endwhile;
echo "</table>";
}


Function products(){
$q=mysql_query("select *,date_format(date_inserted,'%m/%d/%Y %h:%i %p') as di,date_format(date_updated,'%m/%d/%Y %h:%i %p') as du from articles order by title");

echo "<table border=\"0\" width=\"100%\">";
	echo "<tr><td colspan=5>&nbsp;</td></tr>";
	echo "<tr><td colspan=5 align=\"center\"><a href=\"main.php?page=edit_product\"><b>添加新产品</b></a></td></tr>";
	echo "<tr><td colspan=5>&nbsp;</td></tr>";
	echo "<tr><TD><b>名称</b></TD><TD align=\"center\"><b>状态</b></TD><TD align=\"center\"><b>添加时间</b></TD><TD align=\"center\"><b>更新时间</b></TD></tr>";
while($a=mysql_fetch_array($q)):
$status="Disabled";
if ($a["active"]==1) $status="Active";
	echo "<tr>";
	echo "<TD><a href=\"main.php?page=edit_product&id=".$a["article_id"]."\">".$a["title"]."</a></td>";
	echo "<TD align=\"center\">".$status."</td>";
	echo "<TD align=\"center\">".$a["di"]."</td>";
	echo "<TD align=\"center\">".$a["du"]."</td>";
	echo "</tr>";
endwhile;
echo "</table>";
}


Function edit_product($id){
$a=mysql_fetch_array(mysql_query("select * from articles where article_id='$id'"));
$pic=$a["pic"];
$price=$a["price"];
$active_status="checked";
$special_offer="";
$suspended_status="";
if ($a["active"]!='1'){
	$active_status="";
	$suspended_status="checked";
}
if ($a["special_offer"]=='1') $special_offer="checked";

$p2c=array();
$i=0;
$qp2c=mysql_query("select * from p2c where article_id='$id'");
while ($ap2c=mysql_fetch_row($qp2c)){
	$p2c[$i]=$ap2c[2];
	$i++;
}
?>
<form method=post enctype="multipart/form-data">
<table border=0 cellpadding="2" cellspacing="0">
	<tr><td><b>产品名称:</b></td><td><input type="text" name="title" value="<?=$a["title"]?>"></td></tr>
	<tr><td><b>简单描述:</b></td><td><textarea cols="35" rows="6" name="short_text"><?=$a["short_text"]?></textarea></td></tr>
	<tr><td><b>详细描述:</b></td><td><textarea cols="45" rows="11" name="long_text"><?=$a["long_text"]?></textarea></td></tr>
	<tr>
		<td><b>所属分类:</b></td>
		<td>
			<select name=cat_id[] size="5" multiple>
				<?
					$q=mysql_query("select * from categories where active='1' order by name asc");
					if (in_array("0",$p2c))
						echo "<option value=\"0\" selected>商城首页\n";
					else
						echo "<option value=\"0\">商城首页\n";
					while ($a=mysql_fetch_row($q)):
						if (in_array($a[0],$p2c))
							echo "<option value=\"$a[0]\" selected>$a[1]\n";
						else
							echo "<option value=\"$a[0]\">$a[1]\n";
					endwhile;
				?>
			</select>
		</td>
	</tr>
	<tr><td><b>图片:</b></td><td><?if($pic){?><a href="javascript:popup('popup_img.php?article_id=<?=$id?>','art_img')"><?=$pic?></a><br><?}?><input type="file" name="pic"></td></tr>
	<tr><td><b>价格:</b></td><td><input type="text" name="price" size="6" maxlength="7" value="<?=$price?>"></td></tr>
	<tr><td><b>优惠价格?</b></td><td><input type="checkbox" name="special_offer" <?=$special_offer?>></td></tr>
	<tr><td><b>状态:</b></td><td><input type="radio" name="status" value="1" <?=$active_status?>> 活动 &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="status" value="0" <?=$suspended_status?>> 停止 </td></tr>

	<tr><td colspan="2">&nbsp;</td></tr>
	<tr><td colspan="2" align="right"><input type="Submit" class="buton" value="<?if ($id){?>更新产品<?}else{?>添加产品<?}?>"></td></tr>
</table>
<input type="Hidden" name="goto" value="update_product">
<input type="Hidden" name="id" value="<?=$id?>">
</form>
<?
}

Function categories(){
$q=mysql_query("select *,date_format(date_inserted,'%m/%d/%Y %h:%i %p') as di,date_format(date_updated,'%m/%d/%Y %h:%i %p') as du from categories order by name");

echo "<table border=\"0\" width=\"100%\">";
	echo "<tr><td colspan=5>&nbsp;</td></tr>";
	echo "<tr><td colspan=5 align=\"center\"><a href=\"main.php?page=edit_category\"><b>添加分类</b></a></td></tr>";
	echo "<tr><td colspan=5>&nbsp;</td></tr>";
	echo "<tr><TD><b>分类</b></TD><TD align=\"center\"><b>状态</b></TD><TD align=\"center\"><b>添加时间</b></TD><TD align=\"center\"><b>更新时间</b></TD></tr>";
while($a=mysql_fetch_array($q)):
$status="Disabled";
if ($a["active"]==1) $status="Active";
	echo "<tr>";
	echo "<TD><a href=\"main.php?page=edit_category&id=".$a["cat_id"]."\">".$a["name"]."</a></td>";
	echo "<TD align=\"center\">".$status."</td>";
	echo "<TD align=\"center\">".$a["di"]."</td>";
	echo "<TD align=\"center\">".$a["du"]."</td>";
	echo "</tr>";
endwhile;
echo "</table>";
}

Function edit_category($id){
$active_status="checked";
$suspended_status="";
if($id)
{
	$a=mysql_fetch_array(mysql_query("select * from categories where cat_id='$id'"));
	if ($a["active"]!='1'){
		$active_status="";
		$suspended_status="checked";
	}
}
?>
<form method=post>
<table border=0 cellpadding="2" cellspacing="0">
	<tr><td><b>分类名称:</b></td><td><input type="text" name="name" value="<?=$a["name"]?>"></td></tr>
	<tr><td><b>状态:</b></td><td><input type="radio" name="status" value="1" <?=$active_status?>> 可使用 &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="status" value="0" <?=$suspended_status?>> 停用 </td></tr>
	<tr><td colspan="2">&nbsp;</td></tr>
	<tr><td colspan="2" align="right"><input type="Submit" class="buton" value="<?if ($id){?>更新分类<?}else{?>创建新分类<?}?>"></td></tr>
</table>
<input type="Hidden" name="goto" value="update_category">
<input type="Hidden" name="id" value="<?=$id?>">
</form>
<?
}



/**********************************************
			 S T A T I S T I C S			   
**********************************************/
Function category_views($month,$day,$year,$month2,$day2,$year2){
if(!$month) $month=$month2=date("m");
if(!$day) $day=$day2=date("d");
if(!$year) $year=$year2=date("Y");
$date=$year."-".$month."-".$day;
$date2=$year2."-".$month2."-".$day2;
	$query="
	select if(b.name is null,'Home Page',b.name) as Category, sum(a.views) as Views
	from stat_cat a 
	left join categories b on a.cat_id=b.cat_id 
	where '$date'<=a.day and a.day<='$date2' 
	group by a.cat_id 
	";
	$l2=20;
	$head_title="<br>
	<form method=post name=category_views>
		<table border=0>
			<tr>
				<td class=white1>&nbsp;&nbsp;&nbsp;</td>
				<td class=white1 nowrap>
					&nbsp;&nbsp;从:&nbsp;<select name=year class=fliessgross>";
				for ($i=2003;$i<=2006;$i++)
					if ($i==$year)
						$head_title.= "<option value=\"$i\" selected>".$i."\n";
					else
						$head_title.= "<option value=\"$i\">".$i."\n";					

	$head_title.="	</select>年<select name=month>";
				for ($i=1;$i<=12;$i++)
					if ($i==$month)
						$head_title.= "<option value=\"$i\" selected>".$i."\n";
					else
						$head_title.= "<option value=\"$i\">".$i."\n";
	$head_title.="	</select> 月<select name=day class=fliessgross>";
				for ($i=1;$i<=31;$i++)
					if ($i==$day)
						$head_title.= "<option value=\"$i\" selected>".$i."\n";
					else
						$head_title.= "<option value=\"$i\">".$i."\n";


	$head_title.="	</select>日&nbsp;&nbsp;到:&nbsp;<select name=year2 class=fliessgross>";
				for ($i=2003;$i<=2006;$i++)
					if ($i==$year2)
						$head_title.= "<option value=\"$i\" selected>".$i."\n";
					else
						$head_title.= "<option value=\"$i\">".$i."\n";
	$head_title.="	</select>年<select name=month2>";
	
				for ($i=1;$i<=12;$i++)
					if ($i==$month2)
						$head_title.= "<option value=\"$i\" selected>".$i."\n";
					else
						$head_title.= "<option value=\"$i\">".$i."\n";
						
	$head_title.="	</select>月<select name=day2 class=fliessgross>";
				for ($i=1;$i<=31;$i++)
					if ($i==$day2)
						$head_title.= "<option value=\"$i\" selected>".$i."\n";
					else
						$head_title.= "<option value=\"$i\">".$i."\n";

	
	$head_title.=" 	</select>日&nbsp;&nbsp;</td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;<input type=Submit class=buton value='提交'></td>
			</tr>
		</table>
		<input type=Hidden name=\"page\" value=\"category_views\">
	</form>
	<br>
	";
	query_results_limit($query,"Category","asc","",$fields_alias,"main.php?page=category_views",$l2,$head_title,$no_results_msg,$noform);
}

Function product_views($month,$day,$year,$month2,$day2,$year2){
if(!$month) $month=$month2=date("m");
if(!$day) $day=$day2=date("d");
if(!$year) $year=$year2=date("Y");
$date=$year."-".$month."-".$day;
$date2=$year2."-".$month2."-".$day2;
	$query="
	select b.title as Product, sum(a.views) as Views  
	from stat_prod a 
	inner join articles b on a.article_id=b.article_id 
	where '$date'<=a.day and a.day<='$date2' 
	group by a.article_id
	";
	$l2=20;
	$head_title="
	<form method=post name=prod_views>
		<table border=0>
			<tr>
				<td class=white1>Select Date:&nbsp;&nbsp;&nbsp;</td>
				<td class=white1 nowrap>
					&nbsp;&nbsp;&nbsp;<select name=month class=fliessgross>
					";
				for ($i=1;$i<=12;$i++)
					if ($i==$month)
						$head_title.= "<option value=\"$i\" selected>".$i."\n";
					else
						$head_title.= "<option value=\"$i\">".$i."\n";
	$head_title.="	</select> / <select name=day class=fliessgross>";
				for ($i=1;$i<=31;$i++)
					if ($i==$day)
						$head_title.= "<option value=\"$i\" selected>".$i."\n";
					else
						$head_title.= "<option value=\"$i\">".$i."\n";
	$head_title.="	</select> / <select name=year class=fliessgross>";
				for ($i=2003;$i<=2006;$i++)
					if ($i==$year)
						$head_title.= "<option value=\"$i\" selected>".$i."\n";
					else
						$head_title.= "<option value=\"$i\">".$i."\n";
	$head_title.="	</select>&nbsp;&nbsp;To:&nbsp;<select name=month2>";
	
				for ($i=1;$i<=12;$i++)
					if ($i==$month2)
						$head_title.= "<option value=\"$i\" selected>".$i."\n";
					else
						$head_title.= "<option value=\"$i\">".$i."\n";
	$head_title.="	</select> / <select name=day2 class=fliessgross>";
				for ($i=1;$i<=31;$i++)
					if ($i==$day2)
						$head_title.= "<option value=\"$i\" selected>".$i."\n";
					else
						$head_title.= "<option value=\"$i\">".$i."\n";
	$head_title.="	</select> / <select name=year2 class=fliessgross>";
				for ($i=2003;$i<=2006;$i++)
					if ($i==$year2)
						$head_title.= "<option value=\"$i\" selected>".$i."\n";
					else
						$head_title.= "<option value=\"$i\">".$i."\n";
	
	$head_title.=" 	</select>&nbsp;&nbsp;</td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;<input class=buton type=Submit value=\"Submit\"></td>
			</tr>
		</table>
		<input type=Hidden name=\"page\" value=\"product_views\">
	</form>
	<br>
	";
	query_results_limit($query,"Product","asc","",$fields_alias,"main.php?page=product_views",$l2,$head_title,$no_results_msg,$noform);
}

Function static_pages(){
$q=mysql_query("select * from static_pages order by page_name");

echo "<table border=\"0\" width=\"100%\">";
	echo "<tr><td colspan=5>&nbsp;</td></tr>";
	echo "<tr><td colspan=5 align=\"center\"><a href=\"main.php?page=edit_static_page\"><b>添加新的页</b></a></td></tr>";
	echo "<tr><td colspan=5>&nbsp;</td></tr>";
	echo "<tr><TD><b>Title</b></TD></tr>";
while($a=mysql_fetch_array($q)):

	echo "<tr>";
	echo "<TD><a href=\"main.php?page=edit_static_page&page_id=".$a["page_id"]."\">".$a["page_name"]."</a></td>";
	echo "</tr>";
endwhile;
echo "</table>";
}


Function edit_static_page($page_id){
$a=mysql_fetch_array(mysql_query("select * from static_pages where page_id='$page_id'"));
?>
<form method=post>
<table border=0 cellpadding="2" cellspacing="0">
	<tr><td><b>Page Name:</b></td><td><input type="text" name="page_name" value="<?=$a["page_name"]?>"></td></tr>
	<tr><td><b>Page Content:</b></td><td><textarea cols="45" rows="11" name="page_content"><?=$a["page_content"]?></textarea></td></tr>
	<tr><td colspan="2">&nbsp;</td></tr>
	<tr><td colspan="2" align="right"><input type="Submit" class="buton" value="<?if ($page_id){?>Update Page<?}else{?>Create Page<?}?>"></td></tr>
</table>
<input type="Hidden" name="goto" value="update_static_page">
<input type="Hidden" name="page_id" value="<?=$page_id?>">
</form>
<?
}

function banners(){
?>
<script>
function del_confirm(banner_id){
	if (confirm('Please click the OK button if you want to delete this banner.'))
		document.location='main.php?goto=del_banner&banner_id='+banner_id
		
}
</script>
<?
$query="
select a.banner_id as id_hidden, a.title as Title, a.group as Group1, if(a.status='1',concat('<a href=main.php?goto=change_stat_banner&stat=0&banner_id=',a.banner_id,'>Enabled</a>'),concat('<a href=main.php?goto=change_stat_banner&stat=1&banner_id=',a.banner_id,'>Disabled</a>')) as Status, concat(b.clicks,'/',b.views) as C_V, concat('<a href=\"main.php?page=add_edit_banner&banner_id=',a.banner_id,'\">Edit</a>','&nbsp;&nbsp;&nbsp;','<a href=\"javascript:del_confirm(',a.banner_id,')\">Delete</a>') as edt 
from banners a 
left join banner_logs b on a.banner_id=b.banner_id 
group by a.banner_id 
";

$script_name="main.php?page=banners";
$camp_start="Title";
$order_start="";
$order_coresp_array="";
$fields_alias=array("Group1"=>"Group","C_V"=>"Clicks/Views","edt"=>"");

$l2="20";
$head_title="<center>Banners<br><br><a href=\"main.php?page=add_edit_banner\"><b>Add New Banner</b></a></center>";
$no_results_msg="<center><b>There are no banners in the system.</b><br><br><a href=\"main.php?page=add_edit_banner\"><b>Add New Banner</b></a></center>";
$noform="";

query_results_limit($query,$camp_start,$order_start,$order_coresp_array,$fields_alias,$script_name,$l2,$head_title,$no_results_msg,$noform);
}

Function add_edit_banner($banner_id){
if ($banner_id){
	$a=mysql_fetch_array(mysql_query("select *,date_format(from_date,'%m') as month1,date_format(to_date,'%m') as month2 ,date_format(from_date,'%d') as day1,date_format(to_date,'%d') as day2, date_format(from_date,'%Y') as year1,date_format(to_date,'%Y') as year2 from banners where banner_id='$banner_id'"));
}
?>
<br>
<br>
		<table border="0" align="center" cellpadding="2" cellspacing="0">
<form method="post" enctype="multipart/form-data">
			<tr><td colspan="2"><br></td></tr>
			<tr><td colspan="2" align="center"><font class=title1><?if (!$banner_id){?> Add New <?}else{?> Edit <?}?> Banner</font></td></tr>	
			<tr><td colspan="2"><br></td></tr>
			<tr>
				<td><font class=title2>Title:</font></td><td><input type=text name=title value="<?=$a["title"]?>"></td>
			</tr>
			<tr>
				<td><font class=title2>Banner URL:</font></td><td><input type=text name=url size="35" value="<?=$a["url"]?>"></td>
			</tr>
			<tr>
				<td><font class=title2>Banner Group:</font></td>
				<td><select name=group>
					<option value="top" <?if($a["group"]=="top" or !$a["group"]){?>selected<?}?>>Top
					<option value="bottom" <?if($a["group"]=="bottom"){?>selected<?}?>>Bottom
					<option value="popup" <?if($a["group"]=="popup"){?>selected<?}?>>Pop-Up
				</select></td>
			</tr>
			<tr>
				<td><font class=title2>Banner Image:</font></td><td><?if($a["image"]){?><a href="../banners/<?=$a["image"]?>" target="_blank"><?=$a["image"]?></a><?}?><br><input type=file name=img size="35"></td>
			</tr>
			<tr>
				<td><font class=title2>Available from:</font></td>
				<td>
					<select name="month1" class="small">
						
						<?
							for ($i=1;$i<=12;$i++){
								if ($a["month1"]==$i) echo "<option value=\"$i\" selected>$i\n";
									else echo "<option value=\"$i\">$i\n";
							}
						?>
					</select>&nbsp;&nbsp;&nbsp;
					<select name="day1" class="small">
						
						<?
							for ($i=1;$i<=31;$i++){
								if ($a["day1"]==$i) echo "<option value=\"$i\" selected>$i\n";
									else echo "<option value=\"$i\">$i\n";
							}
						?>
					</select>&nbsp;&nbsp;&nbsp;
					<select name="year1" class="small">
						
						<?
							for ($i=date("Y");$i<=date("Y")+2;$i++){
								if ($a["year1"]==$i) echo "<option value=\"$i\" selected>$i\n";
									else echo "<option value=\"$i\">$i\n";
							}
						?>
					</select>&nbsp;&nbsp;&nbsp;
				</td>
			</tr>
			<tr>
				<td><font class=title2>Expires on:</font></td>
				<td>
					<select name="month2" class="small">
						
						<?
							for ($i=1;$i<=12;$i++){
								if ($a["month2"]==$i) echo "<option value=\"$i\" selected>$i\n";
									else echo "<option value=\"$i\">$i\n";
							}
						?>
					</select>&nbsp;&nbsp;&nbsp;
					<select name="day2" class="small">
						
						<?
							for ($i=1;$i<=31;$i++){
								if ($a["day2"]==$i) echo "<option value=\"$i\" selected>$i\n";
									else echo "<option value=\"$i\">$i\n";
							}
						?>
					</select>&nbsp;&nbsp;&nbsp;
					<select name="year2" class="small">
						
						<?
							for ($i=date("Y");$i<=date("Y")+2;$i++){
								if ($a["year2"]==$i) echo "<option value=\"$i\" selected>$i\n";
									else echo "<option value=\"$i\">$i\n";
							}
						?>
					</select>&nbsp;&nbsp;&nbsp;<b><font class=title2>, or at</b>
				</td>
			</tr>
			<tr><td></td><td><input type=text name="hits" value="<?=$a["hits"]?>" size=5> <font class=title2>clicks</td></tr>
			<tr><td colspan="2"><br></td></tr>
			<tr><td colspan="2"><br></td></tr>
			<tr><td>&nbsp;</td><td align="right"><input type=submit class="buton" value="<?if(!$banner_id){?>Add<?}else{?>Edit<?}?> Banner"></td></tr>	
			<tr><td colspan="2"><input type=button class="buton" value="<< Back to Banners List" onclick="document.location='main.php?page=banners'"></td></tr>	
			<tr><td colspan="2"><br></td></tr>
		</table>
<input type="Hidden" name="banner_id" value="<?=$banner_id?>">
<input type="Hidden" name="goto" value="add_edit_banner">
</form>		
<?
}

Function shipping(){
	$a=mysql_fetch_array(mysql_query("select * from shipping"));
echo "<br><br>
<form>
	<table border=0 cellpadding=2 cellspacing=0 align=center >
			<tr><td> &nbsp;</td></tr>
			<tr><td align=right class=white1><b>运费:</b> </td> <td> <input type=text name=value size=6 value=\"".$a["value"]."\"></td></tr>
		";
	
echo "
		<tr><td> &nbsp;</td></tr>
		<tr><td colspan=2 align=right> <input type=Submit class=buton value=\"保存\"></td></tr>
		<tr><td> &nbsp;</td></tr>
	</table>
	<input type=Hidden name=goto value=\"update_shipping\">
	<input type=Hidden name=page value=\"shipping\">
</form>";
}

?>