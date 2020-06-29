<?php
session_start();
$userid=$_SESSION['userid'];
include ('mysqli_connect.php');

$hospitalid=$_GET['id'];
date_default_timezone_set("PRC");
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>咨询平台 || 取消</title>
        <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>

    </body>
    </html>

<?php

$sqle="select sernum from  lend_list where hospital_id={$hospitalid}";
$rese=mysqli_query($dbc,$sqle);
$resulte=mysqli_fetch_array($rese);

$sqlc="delete from lend_list where sernum={$resulte['sernum']} ;";
$sqld="UPDATE hospital_info set state=1 where hospital_id={$hospitalid};";
$resc=mysqli_query($dbc,$sqlc);
$resd=mysqli_query($dbc,$sqld);

if($resc==1 && $resd==1)
    echo"<script>alert('取消成功！');window.location.href='user_borrow.php'; </script>";
else echo"<script>alert('取消失败！');window.location.href='user_borrow.php'; </script>";
?>