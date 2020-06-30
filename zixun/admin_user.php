<?php
session_start();
$userid=$_SESSION['userid'];
include ('mysqli_connect.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>咨询平台 || 用户管理</title>
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
<h1 style="text-align: center"><strong>全部用户</strong></h1>
<form id="query" action="admin_user.php" method="POST">
    <div id="query">
        <label ><input  name="userquery" type="text" placeholder="请输入用户姓名或预约证号" class="form-control"></label>
        <input type="submit" value="查询" class="btn btn-default">
    </div>
</form>
<table  width='100%' class="table table-hover">
    <tr>
        <th>预约证号</th>
        <th>姓名</th>
        <th>性别</th>
        <th>生日</th>
        <th>居住地</th>
        <th>电话</th>
        <th>用户状态</th>
        <th>操作</th>
        <th>操作</th>
    </tr>
    <?php



    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $gjc = $_POST["userquery"];

        $sql="select user_info.user_id, user_info.name,sex,birth,address,telcode,card_state from user_info,user_card where user_info.user_id=user_card.user_id and (name like '%{$gjc}%' or user_id like '%{$gjc}%') ;";

    }
    else{
        $sql="select user_info.user_id, user_info.name, sex, birth, address, telcode, card_state
from user_info, user_card where user_info.user_id = user_card.user_id";
    }


    $res=mysqli_query($dbc,$sql);
    while($row=mysqli_fetch_array($res)){
        echo "<tr>";
        echo "<td>{$row['user_id']}</td>";
        echo "<td>{$row['name']}</td>";
        echo "<td>{$row['sex']}</td>";
        echo "<td>{$row['birth']}</td>";
        echo "<td>{$row['address']}</td>";
        echo "<td>{$row['telcode']}</td>";
        if($row['card_state']==1) echo "<td>正常</td>"; else echo "<td>挂失</td>";
        echo "<td><a href='admin_user_edit.php?id={$row['user_id']}'>修改</a></td>";
        echo "<td><a href='admin_user_del.php?id={$row['user_id']}'>删除</a></td>";
        echo "</tr>";
    };
    ?>
</table>
</body>
</html>