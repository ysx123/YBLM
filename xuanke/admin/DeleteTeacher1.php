<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台删除老师</title>
</head>

<body>
<?php
session_start();
if(! isset($_SESSION["username"])){
	header("Location:..//login.php");
	exit();
	}else if($_SESSION["role"]<>"admin"){
	header("Location:..//login.php");
	exit();
		}
include("../conn/db_conn.php");
include("../conn/db_func.php");
$TeaNo=$_GET['TeaNo'];

$DeleteTeacher_SQL="delete from teacher where TeaNo='$TeaNo'";
$DeleteTeacher_Result=db_query($DeleteTeacher_SQL);

if($DeleteTeacher_Result){
	echo"<script>";
	echo"alert(\"删除成功\");";
	echo"location.href=\"ShowTea.php\"";
	echo"</script>";
	}else{
	echo"<script>";
	echo"alert(\"删除失败，请重新修改\");";
	echo"location.href=\"ShowTea.php\"";
	echo"</script>";
		}
?>
</body>
</html>

