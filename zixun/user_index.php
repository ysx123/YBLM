<?php
session_start();
$userid=$_SESSION['userid'];
include ('mysqli_connect.php');

$sql="select name from user_card where user_id={$userid}";
$res=mysqli_query($dbc,$sql);
$result=mysqli_fetch_array($res);
date_default_timezone_set("PRC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>我的咨询平台</title>
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
        #gonggao{
            position: absolute;
            left: 40%;
            top: 50%;
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
<br/><br/><h3 style="text-align: center"><?php echo $result['name'];  ?>用户，您好</h3><br/>
<h4 style="text-align: center"><?php
    $sqla="select count(*) a from lend_list where user_id={$userid} and back_date is NULL;";

    $resa=mysqli_query($dbc,$sqla);
    $resulta=mysqli_fetch_array($resa);
    echo "您目前预约{$resulta['a']}家医院。";
    ?>
</h4>
<h4 style="text-align: center">
    <?php
    $sqlb="select DATE_ADD(lend_date,INTERVAL 1 MONTH) AS yhrq from lend_list where user_id={$userid} and back_date is NULL;";
    $counta=0;
    $resb=mysqli_query($dbc,$sqlb);

    foreach ($resb as $row){
        if(strtotime(date("y-m-d"))>strtotime($row['yhrq'])) $counta++;
    };

    if($counta==0) echo "您当前没有超期的医院。";
    else echo "有{$counta}家医院已超期，请您及时取消";

    ?>
</h4>
<div id="gonggao">
    <a href="a.html" style="font-style: italic;color: white;text-decoration:replace-underline">咨询模块介绍</a><br>


</div>

</body>
</html>
