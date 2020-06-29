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
    <title>我的咨询平台 || 医院查询</title>
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        #resbook{
            top:50%;

        }
        #query{

            text-align: center;
        }
        body{
            width: 100%;

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
<h4 style="text-align: center">医院查询：</h4>


<form action="user_queryhospital.php" method="POST">
    <div id="query">
        <label ><input  name="hospitalquery" type="text" placeholder="请输入医院名或医院号" class="form-control"></label>
        <input type="submit" value="查询" class="btn btn-default">
    </div>
</form>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $gjc = $_POST["hospitalquery"];
    if($gjc=="") echo "<script>alert('查询词不能为空！')</script>";
    else{
        $sqla="select hospital_id,name,address,starlevel,phone,introduction,office,price,date,hospital_info.class_id,class_name,dean,state from hospital_info,class_info where hospital_info.class_id=class_info.class_id and ( name like '%{$gjc}%' or hospital_id like '%{$gjc}%')  ;";

        $resa=mysqli_query($dbc,$sqla);
        $jgs=mysqli_num_rows($resa);

        if($jgs==0)  echo "<script>alert('平台暂时无该医院！')</script>";
        else{
            echo "<table   id='resbook' class='table'>
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
        <th>分类</th>
        <th>院长</th>
        <th>状态</th>
        <th>操作</th>
    </tr>";
            while($row=mysqli_fetch_array($resa)){
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
                echo "<td>{$row['class_name']}</td>";
                echo "<td>{$row['dean']}</td>";
                if($row['state']==1) echo "<td>可预约</td>"; else if($row['state']==0) echo "<td>预约已满</td>";else  echo "<td>无状态信息</td>";
                if($row['state']==1)echo "<td><a href='user_yuyue.php?id={$row['hospital_id']}'>预约</a></td>";
                echo "</tr>";
            };
        };



        echo "</table>";



    }


}
?>
</body>
</html>