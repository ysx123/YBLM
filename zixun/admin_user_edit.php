<?php
session_start();
$userid=$_SESSION['userid'];
include ('mysqli_connect.php');
$userrid=$_GET['id'];

$sqlb="select * from user_info where user_id={$userrid}";
$resb=mysqli_query($dbc,$sqlb);
$resultb=mysqli_fetch_array($resb);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>咨询平台 || 用户信息修改</title>
</head>
<body>
<h1 style="text-align: center"><strong>用户信息修改</strong></h1><br/><br/><br/>
<div style="padding: 10px 500px 10px;">
    <form action="admin_user_edit.php?id=<?php echo $userrid; ?>" method="POST" style="text-align: center" class="bs-example bs-example-form" role="form">
        <div id="login">
            <div class="input-group"><span class="input-group-addon">预约证号</span><input name="nid" value="<?php echo $resultb['user_id'] ;?>" type="text" placeholder="请输入修改的预约证号" class="form-control"></div><br/>
            <div class="input-group"><span class="input-group-addon">姓名</span><input name="nname" value="<?php echo $resultb['name'] ;?>" type="text" placeholder="请输入修改的名字" class="form-control"></div><br/>
            <div class="input-group"><span class="input-group-addon">性别</span><input name="nsex" value="<?php echo $resultb['sex'] ;?>" type="text" placeholder="请输入修改的性别" class="form-control"></div><br/>
            <div class="input-group"><span class="input-group-addon">生日</span><input name="nbirth" value="<?php echo $resultb['birth'] ;?>" type="text" placeholder="请输入修改的生日" class="form-control"></div><br/>
            <div class="input-group"><span class="input-group-addon">地址</span><input name="naddress" value="<?php echo $resultb['address'] ;?>" type="text" placeholder="请输入修改的地址" class="form-control"></div><br/>
            <div class="input-group"><span class="input-group-addon">电话</span><input name="ntel" value="<?php echo $resultb['telcode'] ;?>" type="text" placeholder="请输入修改的电话" class="form-control"></div><br/>
            <input type="submit" value="确认" class="btn btn-default">
            <input type="reset" value="重置" class="btn btn-default">
        </div>
    </form>
</div>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{

    $readid=$_GET['id'];

    $nnid = $_POST["nid"];
    $nnam= $_POST["nname"];
    $nsex = $_POST["nsex"];
    $nbir= $_POST["nbirth"];
    $nadd= $_POST["naddress"];
    $nnte = $_POST["ntel"];



    $sqla="update user_info set user_id={$nnid},name='{$nnam}',sex='{$nsex}',
birth='{$nbir}',address='{$nadd}',telcode='{$nnte}' where user_id=$readid;";
    $resa=mysqli_query($dbc,$sqla);
    $sqlc="update user_card set name='{$nnam}',user_id='{$nnid}' where user_id=$readid;";
    $resc=mysqli_query($dbc,$sqlc);

    if($resa==1&&$resc==1)
    {

        echo "<script>alert('修改成功！')</script>";
        echo "<script>window.location.href='admin_user.php'</script>";

    }
    else
    {
        echo "<script>alert('修改失败！请重新输入！');</script>";

    }

}


?>
</body>
</html>
