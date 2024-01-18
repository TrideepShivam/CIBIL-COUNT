<?php 
session_start();
require_once('database.php');//used to implement database file otherwise fatal error.
$msg = "Error";
if (isset($_REQUEST['email-Id']) && isset($_REQUEST['password'])) 
{
    $uname =$_REQUEST['email-Id'];
    $pass =$_REQUEST['password'];
    $sql = "SELECT * FROM register WHERE userId='".$uname."' AND password='".$pass."'";
    $result = mysqli_query($conn, $sql);
    if ($result != false&&mysqli_num_rows($result) == 1) 
    {
        $_SESSION['uid']=$uname;
        header('location:../dashboard.php');
    }else{
    //    header("location:../login.html");
        $msg="Invalid Id or Password.";
        echo $msg;
    }
}else{
    // header("location:../login.html");
    $msg="Empty Data.";
    echo $msg;
}
?>