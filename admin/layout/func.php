<?
function top()
{
	
};

function tabbar($page,$action){
Global $adm,$s,$wf;
$logout="&nbsp;&nbsp;&nbsp;";
if (!$_SESSION[adm]["id"]){
	$text="Authentication";$file="main.php";
}
else{
	$logout="<font class=tab-n>(".$_SESSION[adm]["name"].")</font> <a class='tab-n' href='main.php?goto=logout'>注销</a> <img src='images/logout.gif' width='16' height='16' align='absmiddle'>&nbsp;&nbsp;&nbsp;";
		
	Switch($page):
		
		Case "my_profile":
			$text="My Profile";
			$file="main.php?page=my_profile";
		Break;
		Case "edit_admin":
			Global $id;
			if ($id)
				$text="编辑管理员";
			else
				$text="添加管理员";
			$file="#";
		Break;

		Case "edit_category":
			Global $id;
			if ($id)
				$text="编辑种类";
			else
				$text="添加种类";
			$file="#";
		Break;

		Case "categories":
			$text="分类";
			$file="#";
		Break;
		

		Case "edit_product":
			Global $id;
			if ($id)
				$text="编辑产品";
			else
				$text="添加产品";
			$file="#";
		Break;

		Case "products":
			$text="产品";
			$file="#";
		Break;

		Case "administrators":
			$text="管理员";
			$file="main.php?page=administrators";
		Break;		
		
		Case "category_views":
			$text="浏览分类";
			$file="main.php?page=category_views";
		Break;
		
		Case "product_views":
			$text="浏览产品";
			$file="main.php?page=product_views";
		Break;

		Case "static_pages":
		Case "edit_static_page":
			$text="Static Pages";
			$file="main.php?page=static_pages";
		Break;
		
		Case "banners":
			$text="Banners";
			$file="main.php?page=banners";
		Break;

		Case "shipping":
			$text="Shipping";
			$file="main.php?page=shipping";
		Break;
		
		Case "add_edit_banner":
			Global $banner_id;
			if ($banner_id)
				$text="Edit Banner";
			else
				$text="Add Banner";
			$file="#";
		Break;		Default:
			$text="Home";
			$file="main.php";
	EndSwitch;
	
}

echo "
<table width='100%' border='0' cellspacing='0' cellpadding='0'>
<tr><td height='24' width='181' bgcolor='#1C95CC'>&nbsp;</td>
<td height='24' bgcolor=#1C95CC> 
	<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width='100%'>
	<tr><td>
		<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width='1'>
	    <tr>
			<td bgcolor='#FFFFFF' valign='middle' nowrap>&nbsp;&nbsp;<a class='tab-s' href='$file'>$text</a></td>
			<td><img src='images/tab-ew.gif' width='10' height='24'></td>
		</tr>
		</table>
	</td>
	<td align='right' valign='middle' nowrap>$logout</td>
	</tr>
	</table>
</td></tr>
</table>";
}

function navigation(){


if ($_SESSION[adm]["id"]){

echo "
<b>管理菜单</b><br>

<img src='images/break.gif' height='1' width='160' vspace='4'><br>
<img src='images/caret-t.gif' width='11' height='7'>&nbsp;<a href='main.php'>管理首页</a><br>
<img src='images/break.gif' height='1' width='160' vspace='4'><br>
<b>商店:</b>
<img src='images/break.gif' height='1' width='160' vspace='4'><br>
<img src='images/caret-u.gif' width='11' height='7'>&nbsp;<a href='main.php?page=categories'>分类</a><br>
<img src='images/break.gif' height='1' width='160' vspace='4'><br>
<img src='images/caret-u.gif' width='11' height='7'>&nbsp;<a href='main.php?page=products'>产品</a><br>
<img src='images/break.gif' height='1' width='160' vspace='4'><br>
<img src='images/caret-u.gif' width='11' height='7'>&nbsp;<a href='main.php?page=shipping'>运输费用设置</a><br>
<img src='images/break.gif' height='1' width='160' vspace='4'><br>
<img src='images/caret-u.gif' width='11' height='7'>&nbsp;<a href='main.php?page=static_pages'>其他页面设置</a><br>

<img src='images/break.gif' height='1' width='160' vspace='4'><br>
<b>统计:</b>
<img src='images/break.gif' height='1' width='160' vspace='4'><br>
<img src='images/caret-u.gif' width='11' height='7'>&nbsp;<a href='main.php?page=category_views'>浏览分类</a><br>

<img src='images/break.gif' height='1' width='160' vspace='4'><br>
<img src='images/caret-u.gif' width='11' height='7'>&nbsp;<a href='main.php?page=product_views'>浏览产品</a><br>


<img src='images/break.gif' height='1' width='160' vspace='4'><br>
<b>系统管理:</b>
<img src='images/break.gif' height='1' width='160' vspace='4'><br>
<img src='images/caret-u.gif' width='11' height='7'>&nbsp;<a href='main.php?page=my_profile'>修改管理员资料</a><br>
<img src='images/break.gif' height='1' width='160' vspace='4'><br>
<img src='images/caret-u.gif' width='11' height='7'>&nbsp;<a href='main.php?page=administrators'>管理员列表</a><br>
<img src='images/break.gif' height='1' width='160' vspace='4'><br>

";
}
else echo "&nbsp;";
}
?>