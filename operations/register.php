<?php
session_start();
require_once('database.php');
$response=array();
if($conn)
{
    $userid=$_REQUEST['userId'];
    $email=$_REQUEST['email-Id'];
    $pass=$_REQUEST['password'];

}
$cmd="insert into register values(".$userid.",'".$email."','".$pass."',true,300);";
$ins=mysqli_query($conn,$cmd);
if ($ins) {
    $response['status']="success";
    $response['type']='msg';
    $response['msg']="Registration Successful. Kindly Login.";
}
else
{
    $response['status']="fail";
    $response['type']='msg';
    $response['msg']="This User-ID or Email is Registered.";
}
echo json_encode($response);
?>