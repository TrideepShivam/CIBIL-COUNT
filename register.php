<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>

<?php
session_start();
require_once('database.php');
if($conn)
{
    $userid=$_POST['userId'];
    $email=$_POST['email-Id'];
    $pass=$_POST['password'];

}
$cmd="insert into register values(".$userid.",'".$email."','".$pass."',true,300);";
$ins=mysqli_query($conn,$cmd);
if ($ins) {
    //echo "Successfully Registered.";
    $_SESSION['uid']=$userid;
    $loc = "location:dashboard.php";
    header($loc);
}
else
{
    echo "<div class='container'><h1>OOPS... We already have this ID.</h1>";
    echo "<a href='index.html'>LogIn</a></div>";
}

?>
</body>
</html>