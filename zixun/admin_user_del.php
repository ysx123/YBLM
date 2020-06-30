<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>咨询平台 || 删除用户</title>
</head>
<body>

</body>
</html>
<?php
session_start();
$userid=$_SESSION['userid'];
include ('mysqli_connect.php');


$delid=$_GET['id'];
$sqla="select count(*) a from lend_list where user_id={$delid} and back_date is NULL;";
$resa=mysqli_query($dbc,$sqla);
$resulta=mysqli_fetch_array($resa);

if($resulta['a']==0) {
    $sqla = "delete  from user_card where user_id={$delid} ;";
    $sqlb = "delete  from user_info where user_id={$delid} ;";
    $resa = mysqli_query($dbc, $sqla);
    $resb = mysqli_query($dbc, $sqlb);

    if ($resa == 1 && $resb == 1) {
        echo "<script>alert('删除成功！')</script>";
        echo "<script>window.location.href='admin_user.php'</script>";
    }
    else {
        echo "删除失败！";
        echo "<script>window.location.href='admin_user.php'</script>";
    }
}
else {
    echo "<script>alert('不能删除该用户！')</script>";
    echo "<script>window.location.href='admin_user.php'</script>";
}

?>
