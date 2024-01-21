<?php 
session_start();
require_once('database.php');//used to implement database file otherwise fatal error.
$response= array();
if (isset($_REQUEST['email-Id']) && isset($_REQUEST['password'])) 
{
    $uname =$_REQUEST['email-Id'];
    $pass =$_REQUEST['password'];
    $sql = "SELECT * FROM register WHERE userId='".$uname."' AND password='".$pass."'";
    $result = mysqli_query($conn, $sql);
    if ($result != false&&mysqli_num_rows($result) == 1) 
    {
        $_SESSION['uid']=$uname;
        $response['status']="success";
        $response['type'] = 'url';
        $response['url'] = './dashboard.php';
    }else{
    //    header("location:../login.html");
        $msg="Invalid Id or Password.";
        $response['status']="fail";
        $response['type']='msg';
        $response['msg']=$msg;
    }
}else{
    // header("location:../login.html");
    $msg="Empty Data.";
    $response['status']="fail";
    $response['type']='msg';
    $response['msg']=$msg;
}
echo json_encode($response);
?>