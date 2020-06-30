<?php
session_start();
$userid=$_SESSION['userid'];
include ('mysqli_connect.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>咨询平台 || 医院管理</title>
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        body{
            width: 100%;
            height:auto;

        }
        #query{
            text-align: center;
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
<h1 style="text-align: center"><strong>全部医院</strong></h1>
<form id="query" action="admin_hospital.php" method="POST">
    <div id="query">
        <label ><input  name="hospitalquery" type="text" placeholder="请输入医院名或医院号" class="form-control"></label>
        <input type="submit" value="查询" class="btn btn-default">
    </div>
</form>

<table  width='100%' class="table table-hover">
    <tr>
        <th>医院号</th>
        <th>医院名</th>
        <th>地址</th>
        <th>星级</th>
        <th>联系方式</th>
        <th>简介</th>
        <th>擅长科室</th>
        <th>挂号价格</th>
        <th>修建日期</th>
        <th>分类号</th>
        <th>分类名</th>
        <th>院长</th>
        <th>状态</th>
        <th>操作</th>
        <th>操作</th>
        <th>操作</th>
    </tr>
    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    $gjc = $_POST["hospitalquery"];

        $sqla="select hospital_id,name,address,starlevel,phone,introduction,office,price,date,hospital_info.class_id,class_name,dean,state from hospital_info,class_info where hospital_info.class_id=class_info.class_id and ( name like '%{$gjc}%' or hospital_id like '%{$gjc}%')  ;";
    }
    else{
        $sql="select hospital_id,name,address,starlevel,phone,introduction,office,price,date,hospital_info.class_id,class_name,dean,state from hospital_info,class_info where hospital_info.class_id=class_info.class_id ;";
    }


    $res=mysqli_query($dbc,$sql);
    while($row=mysqli_fetch_array($res)){
        echo "<tr>";
        echo "<td>{$row['hospital_id']}</td>";
        echo "<td>{$row['name']}</td>";
        echo "<td>{$row['address']}</td>";
        echo "<td>{$row['starlevel']}</td>";
        echo "<td>{$row['phone']}</td>";
        echo "<td>{$row['introduction']}</td>";
        echo "<td>{$row['office']}</td>";
        echo "<td>{$row['price']}</td>";
        echo "<td>{$row['date']}</td>";
        echo "<td>{$row['class_id']}</td>";
        echo "<td>{$row['class_name']}</td>";
        echo "<td>{$row['dean']}</td>";
         if($row['state']==1) echo "<td>可预约</td>"; else if($row['state']==0) echo "<td>预约满</td>";else  echo "<td>无状态信息</td>";
        echo "<td><a href='admin_hospital_edit.php?id={$row['hospital_id']}'>修改</a></td>";
        echo "<td><a href='admin_hospital_del.php?id={$row['hospital_id']}'>删除</a></td>";
        if($row['state']==1)echo "<td><a href='admin_hospital_yuyue.php?id={$row['hospital_id']}'>预约</a></td>";
        if($row['state']==0)echo "<td><a href='admin_hospital_quxiao.php?id={$row['hospital_id']}'>取消</a></td>";
        echo "</tr>";
    };
    ?>
</table>
</body>
</html>