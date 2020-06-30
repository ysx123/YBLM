<?php
session_start();
$userid=$_SESSION['userid'];
include ('mysqli_connect.php');

$hospitalid=$_GET['id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>咨询平台 || 预约</title>
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>

    </style>

</head>
<body>
<div style="padding: 180px 550px 10px;text-align: center">
<form action="admin_hospital_yuyue.php?tsid=<?php echo $hospitalid; ?>" method="POST" class="bs-example bs-example-form" role="form">
    <div id="login">
        <div class="input-group"><span class="input-group-addon">预约人</span><input  name="borrower" type="text" placeholder="请输入预约人预约证号" class="form-control"></div><br><br>
        <input type="submit" value="预约" class="btn btn-default">
    </div>
</form>
</div>
</body>
</html>
<?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $jctsid=$_GET['tsid'];
        $reid=$_POST['borrower'];
        $sqlc="select card_state from user_card where user_id={$reid}";
        $resc=mysqli_query($dbc,$sqlc);
        $resultc=mysqli_fetch_array($resc);
        if($resultc['card_state']==1){

            $sqla="insert into lend_list(hospital_id,user_id,lend_date) values ({$jctsid},{$reid},NOW());";
            $sqlb="UPDATE hospital_info set state=0 where hospital_id={$jctsid};";
            $resa=mysqli_query($dbc,$sqla);
            $resb=mysqli_query($dbc,$sqlb);
            if($resa==1 && $resb==1)
                echo"<script>alert('预约成功！');window.location.href='admin_hospital.php'; </script>";
            else echo"<script>alert('预约失败！');window.location.href='admin_hospital.php'; </script>";
        }
       else echo"<script>alert('该预约证已挂失，无法预约！');window.location.href='admin_hospital.php'; </script>";

    };

?>