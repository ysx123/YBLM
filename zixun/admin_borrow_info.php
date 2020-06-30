<?php
session_start();
$userid=$_SESSION['userid'];
include ('mysqli_connect.php');
date_default_timezone_set("PRC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>咨询平台 || 预约信息</title>
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
<h1 style="text-align: center"><strong>预约信息</strong></h1>
<form  id="query" action="admin_borrow_info.php" method="POST">
    <div id="query">
        <label ><input  name="query" type="text" placeholder="输入医院名,医院号或预约证号" class="form-control"></label>
        <input type="submit" value="查询" class="btn btn-default">
    </div>
</form>

<table  width='100%' class="table table-hover">
    <tr>
        <th>预约流水号</th>
        <th>医院号</th>
        <th>医院名</th>
        <th>预约证号</th>
        <th>预约日期</th>
        <th>可以使用日期</th>
        <th>实际日期</th>
        <th>状态</th>
        <th>是否超期</th>
        <th>操作</th>

    </tr>
    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $gjc = $_POST["query"];

        $sql="select sernum,lend_list.hospital_id,name,user_id,lend_date,DATE_ADD(lend_date,INTERVAL 1 DAY) AS yhrq,back_date
from hospital_info,lend_list
where hospital_info.hospital_id=lend_list.hospital_id and ( name like '%{$gjc}%'or user_id like '%{$gjc}% 'or lend_list.hospital_id like '%{$gjc}%' ) ;";
    }
    else{
        $sql="select sernum,lend_list.hospital_id,name,user_id,lend_date,DATE_ADD(lend_date,INTERVAL 1 DAY) AS yhrq,back_date
from hospital_info,lend_list
where hospital_info.hospital_id=lend_list.hospital_id;";
    }


    $res=mysqli_query($dbc,$sql);
    while($row=mysqli_fetch_array($res)){
        echo "<tr>";
        echo "<td>{$row['sernum']}</td>";
        echo "<td>{$row['hospital_id']}</td>";
        echo "<td>{$row['name']}</td>";
        echo "<td>{$row['user_id']}</td>";
        echo "<td>{$row['lend_date']}</td>";
        echo "<td>{$row['yhrq']}</td>";
        echo "<td>{$row['back_date']}</td>";
        echo "<td>"; if($row['back_date']!=null) echo"已使用</td>";else echo "未使用</td>";
        echo "<td>"; if(date("Y-m-d")>$row['yhrq']) echo"已超期</td>";else echo "未超期</td>";
        if($row['back_date']!=null) echo "<td><a href='admin_borrow_quxiao.php?id={$row['hospital_id']}'>删除</a></td>";
        else echo "<td>无</td>";
        echo "</tr>";
    };
    ?>
</table>
</body>
</html>