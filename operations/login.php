<?php 
session_start();
require_once('database.php');//used to implement database file otherwise fatal error.
$msg = "Error";
if (isset($_POST['email-Id']) && isset($_POST['password'])) 
{
    $uname =$_POST['email-Id'];
    $pass =$_POST['password'];
    $sql = "SELECT * FROM register WHERE userId='".$uname."' AND password='".$pass."'";
    $result = mysqli_query($conn, $sql);
    if ($result != false&&mysqli_num_rows($result) == 1) 
    {
        $_SESSION['uid']=$uname;
        header('location:../dashboard.php');
    }else{
    //    header("location:../login.html");
        $msg="Invalid Id or Password.";
    }
}else{
    // header("location:../login.html");
    $msg="Empty Data.";
}
?>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <style>
            .formbox{
                display:flex;
                flex-direction:column;
                justify-content:center;
                align-items:center;                
                height:200px;
                padding:50px;
            }
            </style>
    </head>
    <body>
        <div class="container">
            <div class="formbox">
                <h2><?php echo $msg; ?></h2>
                <a class="submitBtn" href="../index.html">Try Again</a>
            </div>
        </div>
    </body>
</html>