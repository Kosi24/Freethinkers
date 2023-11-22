<?php
session_start();
include "./inc/database.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css"  />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="css\homemain.css">
    <title>Online Library Management</title>
   <style>

    </style>
</head>
<body>

<div id="container">
    <div id="homeheader">
        <?php
            include "logo_header.php";
        ?>

        <div id="navi">
            <ul>
                <li ><a href="index.php"><b class="home">HOME</b></a></li>
                <li><a href="userlogin.php"><b>User Login</b></a></li>
                <li><a href="adminlogin.php"><b>Admin Login</b></a></li>
            </ul>
        </div>
        
    </div>

    <div class =" Top">
        <div id="wrapper" style="background-image: url('https://img.freepik.com/premium-photo/stack-books-education-learning-background_488220-24541.jpg'); height: 600px;">
            
            <div id="content" >
                <div class="logincontent">
                    <div class="login-container">
                        <h3 class="heading">User Login here</h3>

                        <div class="logform">

                            <?php  
                                if(isset($_POST["submit"]))
                                {
                                  $sql = "SELECT * FROM `user` WHERE email='{$_POST["aemail"]}' and password='{$_POST["apass"]}'";
                                  $res = $db->query($sql);
                                 if($res->num_rows>0) 
                                 {
                                    $row = $res->fetch_assoc();
                                    $_SESSION["id"] = $row["userid"];
                                    $_SESSION["email"] = $row["email"];
                                    header("location:user\User_dashboard.php");
                                 }
                                 else
                                 {
                                    echo "<p class='error'>Invalid User Details</p>";
                                 }
                                }
                            ?>


                            <form action="userlogin.php" method="post">
                                <label for="email">Enter your Email</label>
                                <br>
                                <input type="email" id="email" name="aemail" required>
                                <br><br>

                                <label for="pass">Password</label>
                                <br>
                                <input type="password" id="pass" name="apass" required>
                                <br>
                                <a href="#" class="forgot-password">Forgot password?</a>
                                <br><br>

                                <button type="submit" name="submit">Login</button>
                            </form>
                        </div>
                        <p class="signup">Don't have an account? <a href="register.php">Sign Up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    



   <!-- footer section -->
    
   <div id="footer">
        <div class="footer_box">
            <p>@freethinkers 2022/2023 </p>
            <!-- Include links for About Us, Contact, and Social Media, and library open time closed time here -->
            <div class="footer-links">
                <a href="#">About Us</a>
                <a href="#">Contact</a>
                <a href="#">Social Media</a>
            </div>

            <div class="library-hours">
                <p>Library Hours:</p>
                <p>Monday - Friday: 9am - 6pm</p>
                <p>Saturday: 10am - 4pm</p>
                <p>Sunday: Closed</p>
            </div>
        </div>

    </div>


</div>


</body>
</html>

    