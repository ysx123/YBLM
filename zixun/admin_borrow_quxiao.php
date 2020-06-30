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
        <title>咨询平台 || 删除</title>
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
$resc=mysqli_query($dbc,$sqlc);

if($resc==1)
    echo"<script>alert('删除成功');window.location.href='admin_borrow_info.php'; </script>";
else echo"<script>alert('删除失败');window.location.href='admin_borrow_info.php'; </script>";
?>