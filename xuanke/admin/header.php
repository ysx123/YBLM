<table align="center" width="620">
     <tr>
	     <td align="left"><a><strong>帐号管理</strong></a></td>
         <td><font color="red">用户ID:</font><a><?php echo $_SESSION['username']?></a></td>
         <td><a href="Changepwd.php">修改密码</a></td>
         <td><a href="../logout.php">退出系统</a></td>
     </tr>
</table>
<table align="center" width="620">
     <tr>
	     <td align="left"><a><strong>课程管理</strong></a></td>
         <td><a href="ShowCourse.php">课程列表</a></td>
         <td><a href="SearchCourse.php">查询课程</a></td>
         <td><a href="AddCourse.php">添加课程</a></td>
     </tr>
</table>
<table align="center" width="620">
     <tr>
         <td align="left"><a><strong>教师管理</strong></a></td>
		 <td><a href="Showtea.php">教师列表</a></td>
         <td><a href="Searchtea.php">查询教师</a></td>
         <td><a href="Addtea.php">添加教师</a></td>
     </tr>
</table>
<table align="center" width="620">
     <tr>
         <td><a><strong>学生管理</strong></a></td>
         <td><a href="Showstudent.php">学生列表</a></td>
         <td><a href="SearchStudent.php">查询学生</a></td>
         <td><a href="AddStudent.php">添加学生</a></td>
     </tr>
</table>