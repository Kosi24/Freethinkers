<?php
    session_start();
    include 'inc\database.php';
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
        <div id="wrapper" style="background-image: url('https://t4.ftcdn.net/jpg/05/96/90/29/360_F_596902955_4zzO8Y9KIPdeSxJcbz0nWbCY6moXTaOg.jpg');">
            <div class="slider-container">
                <!-- <div class="menu">
                    <label for="slide-dot-1"></label>
                    <label for="slide-dot-2"></label>
                    <label for="slide-dot-3"></label>
                </div>
                <input id="slide-dot-1" type="radio" name="slides" checked>
                <div class="slide slide-1"></div>
                <input id="slide-dot-2" type="radio" name="slides">
                <div class="slide slide-2"></div>
                <input id="slide-dot-3" type="radio" name="slides">
                <div class="slide slide-3"></div> -->
    
                <div id="content">
                    <div class="inputcontent">
    
                        <h1>Welcome to our <br>Library Management System</h1>
    
                        <div class="search">
                            <form action="book_list.php" method="post">
                                <div class ="search_field">
                                    <input type="text" placeholder="Search Books" name="search">
                                    <button name="submit" type="submit"><i class="fa fa-search"></i></button>
                                </div>
                                
                            </form>
                        </div>
    
                    </div>
                </div>
            </div>
        </div>

    </div>
    

    <div class="middle">
        <div id="new-books">
            <!-- Include content for new books here -->
            <h2>New Books</h2>
            <div class="book">
                <img src="book1.jpg" alt="Book 1">
                <p>Book 1 Name</p>
            </div>
            <div class="book">
                <img src="book2.jpg" alt="Book 2">
                <p>Book 2 Name</p>
            </div>
        </div>
    
        <div id="new-magazines">
            <!-- Include content for new magazines here -->
            <h2>New Magazines</h2>
            <div class="magazine">
                <img src="magazine1.jpg" alt="Magazine 1">
                <p>Magazine 1 Name</p>
            </div>
            <div class="magazine">
                <img src="magazine2.jpg" alt="Magazine 2">
                <p>Magazine 2 Name</p>
            </div>
        </div>
    
        <div id="user-reviews">
            <!-- Include content for user reviews here -->
            <h2>User Reviews</h2>
            <div class="review">
                <img src="user1.jpg" alt="User 1">
                <p>User 1 Review</p>
            </div>
            <div class="review">
                <img src="user2.jpg" alt="User 2">
                <p>User 2 Review</p>
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
