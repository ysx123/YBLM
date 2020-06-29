<?
Function head($goto)
{
Global $page,$_POST;

Switch ($goto):

/**********************************************
			 S H I P P I N G 				   
**********************************************/
case "update_shipping":
	Global $value;
	mysql_query("update shipping set value='$value'");
break;

	
	Case "update_static_page":
		Global $page_id,$page_name,$page_content;
		if ($page_id)
			mysql_query("update static_pages set page_name='$page_name',page_content='$page_content' where page_id='$page_id' ");
		else{
			mysql_query("insert into static_pages set page_name='$page_name',page_content='$page_content' ");
			$page_id=mysql_insert_id();
			}
	Break;
	
	Case "update_category":
		//Global $id,$name,$status;
		if ($_POST['id'])
			mysql_query("update categories set name='".$_POST['name']."',active='".$_POST['status']."',date_updated=now() where cat_id='".$_POST['id']."'");
		else
			mysql_query("insert into categories set name='".$_POST['name']."',active='".$_POST['status']."',date_inserted=now()");

		$page="categories";
	Break;
	
	
	Case "update_product":

        if($_POST['special_offer'])
			$_POST['special_offer']=1; 
	     else 
			 $_POST['special_offer']=0;

		if ($_POST['id']){
			$id = $_POST['id'];
			mysql_query("update articles set title='".$_POST['title']."',price='".$_POST['price']."',short_text='".$_POST['short_text']."',long_text='".$_POST['long_text']."',active='".$_POST['status']."',date_updated=now(),special_offer='".$_POST['special_offer']."' where article_id='".$_POST['id']."'");
		}else{
			mysql_query("insert into articles set title='".$_POST['title']."',price='".$_POST['price']."',short_text='".$_POST['short_text']."',long_text='".$_POST['long_text']
				."',active='".$_POST['status']."',date_inserted=now(),special_offer='".$_POST['special_offer']."'");
			$id=mysql_insert_id();
		}

		mysql_query("delete from p2c where article_id='".$_POST['id']."'");
		if (is_array($_POST['cat_id']))
			foreach($_POST['cat_id'] as $key=>$val)
				mysql_query("insert into p2c set article_id='$id',cat_id='$val'");

		if ($_FILES['pic']['name'] && $id){
			//文件上传
			@move_uploaded_file($_FILES['pic']['tmp_name'], "../pics/".$id."_".$_FILES['pic']['name']);
			mysql_query("update articles set pic='".$id."_".$_FILES['pic']['name']."' where article_id='$id'");
		}

		$page="edit_product";
	Break;

	Case "update_admin":
		Global $id,$username,$pass,$fname,$lname,$status;
		if ($id){
			if ($id==$_SESSION[adm]["id"])
				mysql_query("update admins set username='$username',pass='$pass',fname='$fname',lname='$lname',date_updated=now() where id='$id'");
			else
				mysql_query("update admins set username='$username',pass='$pass',fname='$fname',lname='$lname',status='$status',date_updated=now() where id='$id'");
		}else
			mysql_query("insert into admins set username='$username',pass='$pass',fname='$fname',lname='$lname',status='$status',date_inserted=now()");
		$page="administrators";
	Break;

	Case "check_login":
		//Global $username,$password1;
		check_login($_POST['username'],$_POST['password1']);
	Break;
	
	Case "logout":
		session_unset();
	    session_destroy();


	Break;
	
	
EndSwitch;
}


Function check_login($username,$password1){
//Global $adm;

	$q=mysql_query("select id,fname,lname,status from admins where username='$username' and pass='$password1' ");

	if (!MySQL_Num_Rows($q))
		echo "<script>alert('Wrong username/password!')</script>";
	else{
		$disabled=0;
		$a=mysql_fetch_row($q);
		
		if ($a[3]=="Suspended"){
			echo "<script>alert('Sorry, but your account has been temporarily suspended.')</script>";
		}
		else{
			$_SESSION[adm]["id"]=$a[0];
			$_SESSION[adm]["name"]=$a[1]." ".$a[2];
			$_SESSION[adm]["su"]=$a[3];
			$_SESSION[adm]["page"]="home";
		}
	}
}
?>