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
            #mainContent form input{
                width:100%;
                font-size:30px;
            }
            #mainContent form h1{color:green;}
        </style>
    </head>
    <body>
        <div class="firstDiv">
            <?php
            session_start();
            require_once('database.php');
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
                <button class="navbtn" name="logout" onclick="getNewPage(this)">Log Out</button>
            </div>
            <div id="mainContent" class="dashboardContainer">
            <form method="post">  
                <h1>Write To Us</h1>
                <input type="text" value="<?php echo $_SESSION['uid'];?>" name="uname" required>
                <input type="email" placeholder="Email" required>
                <input type="text" placeholder="Comment" required>
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

 