<?php

session_start();
$userid=$_SESSION['userid'];
include ('mysqli_connect.php');

$state=$_GET['id'];

if($state==1){
    $sql="update user_card set card_state=0 where user_id={$userid}";
    $res=mysqli_query($dbc,$sql);

    if($res==1)
    {
        echo"<script>alert('挂失成功！')</script>";
        echo "<script>window.location.href='user_guashi.php'</script>";
    }
    else
    {
        echo"<script>alert('挂失失败！')</script>";
        echo "<script>window.location.href='user_guashi.php'</script>";
    }

}
else{

    $sqla="update user_card set card_state=1 where user_id={$userid}";
    $resa=mysqli_query($dbc,$sqla);

    if($resa==1)
    {
        echo"<script>alert('取消挂失成功！')</script>";
        echo "<script>window.location.href='user_guashi.php'</script>";
    }
    else
    {
        echo"<script>alert('取消挂失失败！')</script>";
        echo "<script>window.location.href='user_guashi.php'</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

</body>
</html>
