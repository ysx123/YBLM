<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台查询学生-超级管理员</title>
</head>
<body>
<?php
session_start();
if(! isset($_SESSION['username']))
{
	header("Location:../login.php");
	exit();
	}
	include("../conn/db_conn.php");
	include("../conn/db_func.php");
	$adminNo=$_SESSION['username'];
?>
<?php include("header.php"); ?>
<form method="get" action="SearchStudent1.php">
<h2 align="center">请输入查询信息</h2>
<p align="center">查询&nbsp;<select name="ColumnName">
  <option value="StuNo">学生编号</option>
  <option value="StuName">学生名字</option>
  <option value="ClassNo">班级编号</option>
</select>&nbsp;为&nbsp;
	<input type="text" name="keyWord" />的学生
</p>
<p align="center">
<input type="submit" value="确定" />&nbsp;
<input type="reset" value="重置" />
</p>
</form>
<?php include("../footer.php"); ?>
</body>
</html>