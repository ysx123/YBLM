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
	$logout="<font class=tab-n>(".$_SESSION[adm]["name"].")</font> <a class='tab-n' href='main.php?goto=logout'>ע��</a> <img src='images/logout.gif' width='16' height='16' align='absmiddle'>&nbsp;&nbsp;&nbsp;";
		
	Switch($page):
		
		Case "my_profile":
			$text="My Profile";
			$file="main.php?page=my_profile";
		Break;
		Case "edit_admin":
			Global $id;
			if ($id)
				$text="�༭����Ա";
			else
				$text="��ӹ���Ա";
			$file="#";
		Break;

		Case "edit_category":
			Global $id;
			if ($id)
				$text="�༭����";
			else
				$text="�������";
			$file="#";
		Break;

		Case "categories":
			$text="����";
			$file="#";
		Break;
		

		Case "edit_product":
			Global $id;
			if ($id)
				$text="�༭��Ʒ";
			else
				$text="��Ӳ�Ʒ";
			$file="#";
		Break;

		Case "products":
			$text="��Ʒ";
			$file="#";
		Break;

		Case "administrators":
			$text="����Ա";
			$file="main.php?page=administrators";
		Break;		
		
		Case "category_views":
			$text="�������";
			$file="main.php?page=category_views";
		Break;
		
		Case "product_views":
			$text="�����Ʒ";
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
<b>����˵�</b><br>

<img src='images/break.gif' height='1' width='160' vspace='4'><br>
<img src='images/caret-t.gif' width='11' height='7'>&nbsp;<a href='main.php'>������ҳ</a><br>
<img src='images/break.gif' height='1' width='160' vspace='4'><br>
<b>�̵�:</b>
<img src='images/break.gif' height='1' width='160' vspace='4'><br>
<img src='images/caret-u.gif' width='11' height='7'>&nbsp;<a href='main.php?page=categories'>����</a><br>
<img src='images/break.gif' height='1' width='160' vspace='4'><br>
<img src='images/caret-u.gif' width='11' height='7'>&nbsp;<a href='main.php?page=products'>��Ʒ</a><br>
<img src='images/break.gif' height='1' width='160' vspace='4'><br>
<img src='images/caret-u.gif' width='11' height='7'>&nbsp;<a href='main.php?page=shipping'>�����������</a><br>
<img src='images/break.gif' height='1' width='160' vspace='4'><br>
<img src='images/caret-u.gif' width='11' height='7'>&nbsp;<a href='main.php?page=static_pages'>����ҳ������</a><br>

<img src='images/break.gif' height='1' width='160' vspace='4'><br>
<b>ͳ��:</b>
<img src='images/break.gif' height='1' width='160' vspace='4'><br>
<img src='images/caret-u.gif' width='11' height='7'>&nbsp;<a href='main.php?page=category_views'>�������</a><br>

<img src='images/break.gif' height='1' width='160' vspace='4'><br>
<img src='images/caret-u.gif' width='11' height='7'>&nbsp;<a href='main.php?page=product_views'>�����Ʒ</a><br>


<img src='images/break.gif' height='1' width='160' vspace='4'><br>
<b>ϵͳ����:</b>
<img src='images/break.gif' height='1' width='160' vspace='4'><br>
<img src='images/caret-u.gif' width='11' height='7'>&nbsp;<a href='main.php?page=my_profile'>�޸Ĺ���Ա����</a><br>
<img src='images/break.gif' height='1' width='160' vspace='4'><br>
<img src='images/caret-u.gif' width='11' height='7'>&nbsp;<a href='main.php?page=administrators'>����Ա�б�</a><br>
<img src='images/break.gif' height='1' width='160' vspace='4'><br>

";
}
else echo "&nbsp;";
}
?>