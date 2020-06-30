<?php
session_start();
$userid=$_SESSION['userid'];
include ('mysqli_connect.php');
$xgid=$_GET['id'];

$sqlb="select name,address,starlevel,phone,introduction,office,price,date,class_id,dean,
state from hospital_info where hospital_id={$xgid}";
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
    <title>咨询平台 || 医院信息修改</title>
</head>
<body>
<h1 style="text-align: center"><strong>医院信息修改</strong></h1>
<div style="padding: 10px 500px 10px;">
    <form  action="admin_hospital_edit.php?id=<?php echo $xgid; ?>"" method="POST" style="text-align: center" class="bs-example bs-example-form" role="form">
    <div id="login">
        <div class="input-group"><span class="input-group-addon">医院名</span><input name="nname" type="text" placeholder="请输入医院名" class="form-control"></div><br/>
        <div class="input-group"><span class="input-group-addon">地址</span><input name="naddress" type="text" placeholder="请输入地址" class="form-control"></div><br/>
        <div class="input-group"><span class="input-group-addon">星级</span><input name="nstarlevel" type="text" placeholder="请输入星级" class="form-control"></div><br/>
        <div class="input-group"><span class="input-group-addon">联系方式</span><input name="nphone" type="text" placeholder="请输入联系方式" class="form-control"></div><br/>
        <div class="input-group"><span class="input-group-addon">简介</span><input name="nintroduction" type="text" placeholder="请输入简介" class="form-control"></div><br/>
        <div class="input-group"><span class="input-group-addon">擅长科目</span><input name="noffice" type="text" placeholder="请输入擅长科目" class="form-control"></div><br/>
        <div class="input-group"><span class="input-group-addon">挂号价格</span><input name="nprice" type="text" placeholder="请输入挂号价格" class="form-control"></div><br/>
        <div class="input-group"><span class="input-group-addon">修建日期</span><input name="date" type="text" placeholder="请输入修建日期" class="form-control"></div><br/>
        <div class="input-group"><span class="input-group-addon">分类号</span><input name="nclass_id" type="text" placeholder="请输入分类号" class="form-control"></div><br/>
        <div class="input-group"><span class="input-group-addon">院长</span><input name="ndean" type="text" placeholder="请输入院长" class="form-control"></div><br/>
        <div class="input-group"><span class="input-group-addon">状态</span><input name="nstate" type="text" placeholder="请输入状态" class="form-control"></div><br/>
        <label><input type="submit" value="确认" class="btn btn-default"></label>
        <label><input type="reset" value="重置" class="btn btn-default"></label>
    </div>
    </form>
</div>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{

    $boid=$_GET['id'];
    $nnam = $_POST["nname"];
    $naut = $_POST["naddress"];
    $npubl = $_POST["nstarlevel"];
    $nisb = $_POST["nphone"];
    $nint = $_POST["nintroduction"];
    $nlan = $_POST["noffice"];
    $npri = $_POST["nprice"];
    $npubd = $_POST["ndate"];
    $ncla = $_POST["nclass_id"];
    $npre = $_POST["ndean"];
    $nsta= $_POST["nstate"];



    $sqla="update hospital_info set name='{$nnam}',address='{$naut}',starlevel='{$npubl}',
phone='{$nisb}',introduction='{$nint}',office='{$nlan}',price='{$npri}',date='{$npubd}',
class_id={$ncla},dean={$npre},state={$nsta} where hospital_id=$boid;";
    $resa=mysqli_query($dbc,$sqla);


    if($resa==1)
    {

        echo "<script>alert('修改成功！')</script>";
        echo "<script>window.location.href='admin_hospital.php'</script>";

    }
    else
    {
        echo "<script>alert('修改失败！请重新输入！');</script>";

    }

}


?>
</body>
</html>
