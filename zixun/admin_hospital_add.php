<?php
session_start();
$userid=$_SESSION['userid'];
include ('mysqli_connect.php');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>咨询平台 || 增加医院</title>
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
<h1 style="text-align: center"><strong>增加医院</strong></h1>
<div style="padding: 10px 500px 10px;">
    <form action="admin_hospital_add.php" method="POST" style="text-align: center" class="bs-example bs-example-form" role="form">
        <div id="login">
            <div class="input-group"><span class="input-group-addon">医院名</span><input name="nname" type="text" placeholder="请输入医院名" class="form-control"></div><br/>
            <div class="input-group"><span class="input-group-addon">地址</span><input name="naddress" type="text" placeholder="请输入地址" class="form-control"></div><br/>
            <div class="input-group"><span class="input-group-addon">星级</span><input name="nstarlevel" type="text" placeholder="请输入星级" class="form-control"></div><br/>
            <div class="input-group"><span class="input-group-addon">联系方式</span><input name="nphone" type="text" placeholder="请输入联系方式" class="form-control"></div><br/>
            <div class="input-group"><span class="input-group-addon">简介</span><input name="nintroduction" type="text" placeholder="请输入简介" class="form-control"></div><br/>
            <div class="input-group"><span class="input-group-addon">联系方式</span><input name="nlanguage" type="text" placeholder="请输入语言" class="form-control"></div><br/>
            <div class="input-group"><span class="input-group-addon">挂号价格</span><input name="nprice" type="text" placeholder="请输入挂号价格" class="form-control"></div><br/>
            <div class="input-group"><span class="input-group-addon">修建日期</span><input name="date" type="text" placeholder="请输入修建日期" class="form-control"></div><br/>
            <div class="input-group"><span class="input-group-addon">分类号</span><input name="nclass_id" type="text" placeholder="请输入分类号" class="form-control"></div><br/>
            <div class="input-group"><span class="input-group-addon">院长</span><input name="ndean" type="text" placeholder="请输入院长" class="form-control"></div><br/>
            <div class="input-group"><span class="input-group-addon">状态</span><input name="nstate" type="text" placeholder="请输入状态" class="form-control"></div><br/>
            <label><input type="submit" value="添加" class="btn btn-default"></label>
            <label><input type="reset" value="重置" class="btn btn-default"></label>
        </div>
    </form>
</div>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $nnam = $_POST["nname"];
    $naut = $_POST["naddress"];
    $npubl = $_POST["nstarlevel"];
    $nisb = $_POST["nphone"];
    $nint = $_POST["nintroduction"];
    $nlan = $_POST["nlanguage"];
    $npri = $_POST["nprice"];
    $npubd = $_POST["npubdate"];
    $ncla = $_POST["nclass_id"];
    $npre = $_POST["ndean"];
    $nsta= $_POST["nstate"];



    $sqla="insert into hospital_info VALUES (NULL ,'{$nnam}','{$naut}','{$npubl}','{$nisb}','{$nint}','{$nlan}','{$npri}','{$npubd}',{$ncla},{$npre},{$nsta} )";
    $resa=mysqli_query($dbc,$sqla);


    if($resa==1)
    {

        echo "<script>alert('添加成功！')</script>";
        echo "<script>window.location.href='admin_hospital.php'</script>";

    }
    else
    {
        echo "<script>alert('添加失败！请重新输入！');</script>";

    }

}

?>
</body>
</html>
