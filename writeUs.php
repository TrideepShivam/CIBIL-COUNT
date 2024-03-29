<html>
    <head>
    <link rel="stylesheet" href="dashboard.css">
        <link rel="stylesheet" href="style.css">
        <title>Calculate loan EMI and CIBIL count</title>
        <style>
            #mainContent form{
                background-image:url(picture/growth.png);
                background-position:center;
                background-size:40%;
                width:500px;
                height:400px;
                gap:30px;
                text-align:center;
            }
            
        </style>
    </head>
    <body>
        <div class="firstDiv">
            <?php
            session_start();
            require_once('./operations/database.php');
            if(isset($_SESSION['uid'])){
            ?>
            <div id="sidenav" class="dashboardContainer">
                <div id="profile">
                    <div id="profileImg"></div>
                    <h1 id="userId"><?php echo $_SESSION['uid'];?></h1>
                </div>
                <button name="dashboard" class="navbtn" onclick="getNewPage(this)">Dashboard</button>
                <button class="navbtn" name="loanEmi" onclick="getNewPage(this)">Loan EMI</button>
                <button class="navbtn" name="cibilCount" onclick="getNewPage(this)">CIBIL count</button>
                <button class="navbtn" name="about" onclick="getNewPage(this)">About</button>
                <button id="activeTab" class="navbtn" name="writeUs" onclick="getNewPage(this)">Write To Us</button>
                <button class="navbtn" name="./operations/logout" onclick="getNewPage(this)">Log Out</button>
            </div>
            <div id="mainContent" class="dashboardContainer">
            <form action=<?php echo $_SERVER['PHP_SELF']?> method="post"> 
                <?php
                    if(isset($_POST['email'])&&isset($_POST['comment'])){
                        $email=$_POST['email'];
                        $comment=$_POST['comment'];
                        $cmd="insert into comments values(".$_SESSION['uid'].",'".$email."','".$comment."');";
                        $ins=mysqli_query($conn,$cmd);
                        if ($ins) {
                            $msg = "";
                            echo "<p id='success' class='msg'>Your Comment Recieved Successfully.</p>";
                        }
                        else
                        {
                            echo "<p id='error' class='msg'>Some Error Occured. Try Again.</p>";
                        }
                    }
                ?>
                <h1>Write To Us</h1>
                <input type="text" value="<?php echo $_SESSION['uid'];?>" name="uname" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="comment" placeholder="Comment" required>
                <button id="submitDashboard">SUBMIT</button>        
            </form>
            </div>
            <?php
            }else{
                $uname="page not found: Please contact to the service provider;";
                echo $uname;
            }
            ?>
        </div>
        <script src="script.js"></script>
    </body>
</html>

 