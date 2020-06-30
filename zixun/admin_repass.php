<?php
session_start();
$userid=$_SESSION['userid'];
include ('mysqli_connect.php');
$sql="select name from user_card where user_id={$userid}";
$res=mysqli_query($dbc,$sql);
$result=mysqli_fetch_array($res);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>咨询平台 || 管理员密码修改</title>
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        body{
            width: 100%;
            overflow: hidden;
            background: url("background.jpg") no-repeat;
            background-size:cover;
            color: antiquewhite;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">咨询平台管理系统</a>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="admin_index.php">主页</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">医院管理<b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="admin_hospital.php">全部医院</a></li>
                        <li><a href="admin_hospital_add.php">增加医院</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">用户管理<b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="admin_user.php">全部用户</a></li>
                        <li><a href="admin_user_add.php">增加用户</a></li>
                    </ul>
                </li>
                <li><a href="admin_borrow_info.php">预约管理</a></li>
                <li><a href="admin_repass.php">密码修改</a></li>
                <li><a href="index.php">退出</a></li>
            </ul>
        </div>
    </div>
</nav>


<h3 style="text-align: center"><?php echo $userid;  ?>号管理员，您好</h3><br/>
<h4 style="text-align: center">修改您的密码：</h4><br/><br/><br/><br/><br/>
<form action="admin_repass.php" method="post"  style="text-align: center">
    <label><input type="password" name="pass1" placeholder="请输入新的密码" class="form-control"></label><br/><br/><br/>
    <label><input type="password" name="pass2" placeholder="确认新的密码" class="form-control"></label><br/><br/>
    <input type="submit" value="提交" class="btn btn-default">
    <input type="reset" value="重置"  class="btn btn-default">
</form>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $passa = $_POST["pass1"];
    $passb = $_POST["pass2"];
    if($passa==$passb){
        $sql="update admin set password='{$passa}' where admin_id={$userid}";
        $res=mysqli_query($dbc,$sql);
        if($res==1)
        {
            echo "<script>alert('密码修改成功！请重新登陆！')</script>";
            echo "<script>window.location.href='index.php'</script>";
        }

    }
    else{
        echo "<script>alert('两次输入密码不同，请重新输入！')</script>";

    }

}


?>
</body>
</html>