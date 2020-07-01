<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台课程列表-超级管理员</title>
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
	$StuNo=$_SESSION['username'];
	$ShowCourse_sql="select * from course where CouNo not in(select CouNo from stucou where StuNo='$StuNo')ORDER BY CouNo";
	$ShowCourseResult=db_query($ShowCourse_sql);
?>
<?php include("header.php"); ?>
<table width="620" border="0" align="center" cellpadding="0" cellspacing="1">
     <tr bgcolor="#0066CC">
         <td width="80" align="center"><font color="#FFFFFF">课程编码</font></td>
         <td width="220" align="center"><font color="#FFFFFF">课程名称</font></td>
         <td width="80" align="center"><font color="#FFFFFF">课程类型</font></td>
         <td width="50" align="center"><font color="#FFFFFF">学分</font></td>
         <td width="80" align="center"><font color="#FFFFFF">任课教师</font></td>
         <td width="100" align="center"><font color="#FFFFFF">上课时间</font></td>
         <td width="40" align="center"><font color="#FFFFFF">操作</font></td>
         <td width="40" align="center"><font color="#FFFFFF">操作</font></td>
     </tr>
<?php
if(db_num_rows($ShowCourseResult)>0){
	$number=db_num_rows($ShowCourseResult);
	if(empty($_GET['p']))
	$p=0;
	else {$p=$_GET['p'];}	
	$check=$p +10;
	for($i=0;$i<$number;$i++){
		$row=db_fetch_array($ShowCourseResult);
		if($i>=$p && $i < $check){
			if($i%2 ==0)
			  echo"<tr bgcolor='#DDDDDD'>";
		else
			  echo"<tr>";
			  echo"<td width='80' align='center'><a href='CourseDetail.php? CouNo=".$row['CouNo']."'>".$row['CouNo']."</a></td>";
			  echo"<td width='220'>".$row['CouName']."</td>";
			  echo"<td width='80'>".$row['Kind']."</td>";
			  echo"<td width='50'>".$row['Credit']."</td>";
			  echo"<td width='80'>".$row['Teacher']."</td>";
			  echo"<td width='100'>".$row['SchoolTime']."</td>";
			  echo"<td width='40'><a href='ModifyCourse.php? CouNo=".$row['CouNo']."'>修改</a></td>";
			  echo"<td width='40'><a href='DeleteCourse1.php? CouNo=".$row['CouNo']."'>删除</a></td>";
			  echo"</tr>";
			  $j=$i+1; 
		 }
		}
	}
?>
</table>
<br>
<center>点击课程编码链接可以查看课程细节</center>
<br>
<table width="400" border="0" align="center">
  <tr>
      <td align="center"><a href="ShowCourse.php? p=0">第一页</a></td>
      <td align="center">
	  <?php
	  if($p>9){
		  $last=(floor($p/10)*10)-10;
		  echo"<a href='ShowCourse.php? p=$last'>上一页</a>";
		  }
		  else
		    echo"上一页";
      ?>
      </td>
      <td align="center">
      <?php
	  if($i>9 and $number>$check)
	     echo"<a href='ShowCourse.php?p=$j'>下一页</a>";
	  else
	     echo"下一页";
      ?>
      </td>
      <td align="center">
      <?php
      if($i>9)
      {
      $final=floor($number/10)*10;
      echo"<a href='ShowCourse.php? p=$final'>最后一页</a>";
      }
      else
        echo"最后一页";
		?>
       
      </td>
  </tr>
</table>  
<?php include("../footer.php"); ?>         
</body>
</html>