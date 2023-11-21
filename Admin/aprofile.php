<?php
session_start();
include ("../inc/database.php");
if(!isset($_SESSION["id"]))
{
    header("location:../index.php");
}
else {
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
 
    <link rel="stylesheet" href="../CSS/style.css" >

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css"  />
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <style>
 .container{

justify-content: center;
display: inline-flex;
width: 100%;
margin-bottom: 50px

}   
.profile-container {
display: flex;
flex-wrap: wrap;
justify-content: space-between;
}

.left_div {

margin-top: 34px;
margin-left: 30px;
margin-right: 30px;
margin-right: 18px;
/* padding-right: 20px; */
box-sizing: border-box;
text-align: center;
}

.right_div {

width: 50%;
box-sizing: border-box;
}

.left_div .photo {
margin-left: 10%;
margin-right: 10%;
width: 80%;
height: 60%;
/* border-right: inset; */
/* border-bottom: inset; */
/* border-radius: 10px; */
border: 4px solid lightgrey;
/* border-style: ridge; */
/* float: right; */

}

.photo img {
max-width: 100%;
height: 100%;
}

.uploadPhoto {
margin-top: 30px;
display: inline-block;
margin-bottom: 30px;
margin-left: 10%;
margin-right: 10%;
width: 80%;
}

.choose-file {

padding: 10px;
border: inset;

}

.uploadPhoto form {
margin-top: 5px;
margin-bottom: 10px;
display: grid;
}

.btn-upload {
background-color: #1b96dc;
color: white;
padding: 10px 15px;
border: none;
border-radius: 3px;
cursor: pointer;
}

.profile-details {
margin-top: 30px;
}

.profile-details .form-group {
margin-bottom: 20px;
}

.profile-details .form-group label {
display: block;
margin-bottom: 5px;
}

.profile-details .form-group .form-control {
display: block;
width: 100%;
height: 40px;
padding: 0 10px;
border: 1px solid #ccc;
border-radius: 3px;
font-size: 16px;
font-family: 'Roboto', sans-serif;
}

.profile-details .form-group .form-control.custom {
background-color: #f7f7f7;
border-color: #f7f7f7;
cursor: not-allowed;
}

.profile-details .text-right .btn.btn-info {
background-color: #073f5f;
color: #fff;
padding: 10px 15px;
border: none;
border-radius: 3px;
cursor: pointer;
float: right;
}

@media screen and (max-width: 768px) {
.left_div,
.right_div {
    width: 100%;
    padding: 0;
}
}
</style>
   </head>
<body>

<?php  include("admin_sidebar.php");
    include("admin_header.php");
?>


<main>
<div class="model">
            <div class="projects">
                <div class="card">
                    <div class="card-header">
                        <h3>My Account</h3>
                        <button >see all <span class=""></span></button>
                    </div>

                    <div class="card-body">
                        <div class="container">
                           <div class="left_div">
                                <div class="photo">
                                    <?php
                                        $res = mysqli_query($db, "select * from admin where id='".$_SESSION['id']."'");
                                        while ($row = mysqli_fetch_array($res)){
                                            ?><img src="<?php echo $row["photo"]; ?> " height="300px" width="250px" alt="something wrong"></a> <?php
                                        }
                                     ?>
                                </div>

                                <div class="uploadPhoto">
                                    <div class="gap-30"></div>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <input type="file" name="image" class="choose-file" id="image"> <br><br>
                                        <input type="submit" class="btn-upload" value="Upload Image" name="submit">
                                    </form>
                                </div>
                                <?php 
                                if (isset($_POST["submit"])) {
                                    $image_name=$_FILES['image']['name'];
                                    $temp = explode(".", $image_name);
                                    $newfilename = round(microtime(true)) . '.' . end($temp);
                                    $imagepath="../upload/".$newfilename;
                                    move_uploaded_file($_FILES["image"]["tmp_name"],$imagepath);
                                    mysqli_query($db, "update admin set photo='".$imagepath."' where id='".$_SESSION['id']."'");
                                    
                                    ?>
                                        <script type="text/javascript">
                                            window.location="aprofile.php";
                                        </script>
                                    <?php
                                }
                                ?>
                           
                            </div> 

                            <div class="right_div">
                                <div class="profile-details">
                                    <?php
                                     $res5 = mysqli_query($db, "select * from admin where id='$_SESSION[id]' ");
                                        while($row5 = mysqli_fetch_array($res5)){
                                            $post      = $row5['post'];
                                            $fname      = $row5['firstname'];
                                            $lname      = $row5['lastname'];
                                            $username  = $row5['username'];
                                            $email     = $row5['email'];
                                            $phone     = $row5['phone'];
                                           
                                        }
                                    ?>

                                <form method="post">
                                    <div class="form-group">
                                        <label for="post" class="text-right">Post:</label>
                                        <input type="text" class="form-control custom"  name="post" value="<?php echo $post; ?>" disabled/>
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="text-right">First Name:</label>
                                        <input type="text" class="form-control custom"  name="firstname" value="<?php echo $fname; ?>" />
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="text-right">Last Name:</label>
                                        <input type="text" class="form-control custom"  name="lastname" value="<?php echo $lname ; ?>" />
                                    </div>
                                    
                                    <div class="form-group">
                                         <label for="username">Username:</label>
                                        <input type="text" class="form-control custom" placeholder="Username" name="username" value="<?php echo $username; ?>" disabled />
                                    </div>
                                    <div class="form-group">
                                         <label for="email">Email:</label>
                                        <input type="text" class="form-control custom"  name="email" value="<?php echo $email; ?>" disabled />
                                    </div>
                                    <div class="form-group">
                                         <label for="phone">Phone No:</label>
                                        <input type="text" class="form-control custom"  name="phone" value="<?php echo $phone; ?>" />
                                    </div> 
                                    
                                    <div class="text-right mt-20">
                                        <input type="submit" value="Save" class="btn btn-info" name="save">
                                    </div>
                                <?php

                                ?>
                                </form>
                                </div>
                                <?php
                                    if (isset($_POST["save"])){
                                        mysqli_query($db, "update admin set 
                                        firstname= '$_POST[firstname]',
                                        lastname='$_POST[lastname]',
                                        phone='$_POST[phone]'
                                        where id='$_SESSION[id]'");

                                        ?>

                                        <script type="text/javascript">
                                            window.location="aprofile.php";
                                        </script>

                                    <?php
                              }
                            ?>




                            </div>
					               
                            
				        </div>	
                                
                    </div>
                   
                </div>
            </div>
        </div>
        
</main>        








</div>    

 <?php 
include "../footer.php";
?>

<?php }?>
