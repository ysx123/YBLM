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
    <title>我的咨询平台 || 我的预约</title>
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
            <a class="navbar-brand" href="#">我的咨询平台</a>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="user_index.php">主页</a></li>
                <li><a href="user_queryhospital.php">医院查询</a></li>
                <li><a href="user_borrow.php">我的预约</a></li>
                <li><a href="user_info.php">个人信息</a></li>
                <li><a href="user_repass.php">密码修改</a></li>
                <li><a href="user_guashi.php">证件挂失</a></li>
                <li><a href="index.php">退出</a></li>
            </ul>
        </div>
    </div>
</nav>

<h3 style="text-align: center"><?php echo $result['name'];  ?>用户，您好</h3><br/>
<h4 style="text-align: center">您已预约的医院如下：</h4>

<table  width='100%' class="table">
    <tr>
        <th>预约流水号</th>
        <th>医院编号</th>
        <th>医院名</th>
        <th>预约日期</th>
        <th>使用日期</th>
        <th>操作</th>
    </tr>
    <?php



    $sqla="select sernum,hospital_info.hospital_id,hospital_info.name,lend_date,back_date,state from lend_list,hospital_info where user_id={$userid} and lend_list.hospital_id=hospital_info.hospital_id;";

    $resa=mysqli_query($dbc,$sqla);
    while($row=mysqli_fetch_array($resa)){
        echo "<tr>";
        echo "<td>{$row['sernum']}</td>";
        echo "<td>{$row['hospital_id']}</td>";
        echo "<td>{$row['name']}</td>";
        echo "<td>{$row['lend_date']}</td>";
        echo "<td>{$row['back_date']}</td>";
        if($row['back_date']==null)echo "<td><a href='user_quxiao.php?id={$row['hospital_id']}'>取消</a></td>";
        else echo "<td>无</td>";
        echo "</tr>";
    };
    ?>
</table>
</body>
</html>