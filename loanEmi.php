<?php
session_start();
require_once('./operations/database.php');
if(isset($_POST['required_loan'])){
    $required = $_POST['required_loan'];
    $salary = $_POST['salary'];
    $period = $_POST['period'];
    $method = $_POST['method'];
    $emi = $required/($period*12/$method);
    $cmd="insert into loandetails values(".$_SESSION['uid'].",".$required.",".$salary.",".$period.",".$method.",".$emi.");";
    $ins=mysqli_query($conn,$cmd);
    if ($ins) {
        $loc = "location:".$_SERVER['PHP_SELF'];
        header($loc);
    }
    else
    {
        echo "<div class='container'><h1>OOPS... SOMETHING WENT WRONG. TRY AGAIN.</h1>";
    }
}
else if(isset($_SESSION['uid'])){
    $uname=$_SESSION['uid'];
    $sql = "SELECT * FROM register left join loandetails on register.userId = loandetails.userId WHERE register.userId=".$uname;
    $result = mysqli_query($conn, $sql);
    if ($result != false&&mysqli_num_rows($result) == 1) 
    {
        $row = $result->fetch_assoc();
        $cibilScore=$row['creditScore'];
        $maxloan=$cibilScore*500;
?>
<html>
    <head>
    <link rel="stylesheet" href="dashboard.css">
        <link rel="stylesheet" href="style.css">
        <title>Calculate loan EMI and CIBIL count</title>
        <style>
            #mainContent form{
                background-image:url(picture/approval.png);
                gap:20px;
            }
            #mainContent form table tr td{font-size:30px;line-height: 50px;}
        </style>
    </head>
    <body>
        <div class="firstDiv">
            <div id="sidenav" class="dashboardContainer">
                <div id="profile">
                    <div id="profileImg"></div>
                    <h1 id="userId"><?php echo $uname;?></h1>
                </div>
                <button name="dashboard" class="navbtn" onclick="getNewPage(this)">Dashboard</button>
                <button id="activeTab" class="navbtn" name="loanEmi" onclick="getNewPage(this)">Loan EMI</button>
                <button class="navbtn" name="cibilCount" onclick="getNewPage(this)">CIBIL count</button>
                <button class="navbtn" name="about" onclick="getNewPage(this)">About</button>
                <button class="navbtn" name="writeUs" onclick="getNewPage(this)">Write To Us</button>
                <button class="navbtn" name="./operations/logout" onclick="getNewPage(this)">Log Out</button>
            </div>
            <div id="mainContent" class="dashboardContainer">  
                <form action=<?php echo $_SERVER['PHP_SELF']?> method="post">
                <?php
                    if($row['RequiredLoan']==!null) {
                ?> <h1>Loan Approved</h1>
                    <table>
                        <tr>
                            <td>Loan amount:</td>
                            <td><?php echo $row['RequiredLoan']?></td>
                        </tr>
                        <tr>
                            <td>Period(year):</td>
                            <td><?php echo $row['Period']?></td>
                        </tr>
                        <tr>
                            <td>Pay Day:</td>
                            <td><?php echo $row['Method']?></td>
                        </tr>
                        <tr>
                            <td>Interest Rate:</td>
                            <td>12%</td>
                        </tr>
                        <tr>
                            <td>Pay Amount:</td>
                            <td><?php echo $row['emi']?></td>
                        </tr>
                    </table>
                <?php
                    }else{
                ?>    
                    <h1>Loan Approval</h1>
                    <div>
                        <label for="NAME">MAX loan: According to Credit Score</label>
                        <input type="text" value="<?php echo $maxloan;?>" class="data" disabled>
                    </div>
                    <div>
                        <label for="contact">Required loan:</label>
                        <input type="text" name="loan_amount">
                    </div>
                    <div>
                        <label for="contact">Monthly Income:</label>
                        <input type="text" name="salary">
                    </div>
                    <div>
                        <label for="history">Time Period:</label>
                        <input type="number" min='1' max='20' name="period">
                    </div>
                    <div>
                        <label for="history">Rate: 12 %</label>
                    </div>
                    <div>
                        <label for="history">How do you want to pay:</label>
                        <select name="method">
                            <option value="1">Monthly</option>
                            <option value="3">Quarterly</option>
                            <option value="6">Half Yearly</option>
                            <option value="12">Yearly</option>
                        </select>
                    </div>
                    <div>
					<button id="submitDashboard" type="submit">SUBMIT</button>        
                <?php } ?>
                </form>
            </div>
        </div>
        <script>
            function approve(){
                let data=document.getElementsByClassName('data');

            }
        </script>
        <script src="script.js"></script>
    </body>
</html>
<?php
    }else{
       echo "Invalid Id";
    }
}else{
    $uname="page not found: Please contact to the service provider;";
    echo $uname;
}
?>

 