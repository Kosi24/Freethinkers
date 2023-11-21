<?php
session_start();
include ("../inc/database.php");
if(!isset($_SESSION["id"]))
{
    header("location:../index.php");
}



?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../CSS/style.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css"  />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<?php  
    include("admin_sidebar.php");
    include("admin_header.php");
?>

<main>
    <div class="model">
        <div class="projects">
            <div class="card">
                <div class="card-header">
                    <h3>Registered Users</h3>
                    <button>see all <span></span></button>
                </div>

                <div class="card-body">
                    <div class="form-containing">
                        <div class="dis-table">

                        <?php
                        
                            if(isset($_GET['userid'])){
                             $id = $_GET['userid'];
                            $result = mysqli_query($db, "SELECT * FROM user WHERE userid='$id'");
                                if(mysqli_num_rows($result) > 0){
                                $row = mysqli_fetch_array($result);
                                 } else {
                                echo "User not found";
                                exit;
                                }
                             } else {
                                echo "User ID not specified";
                                exit;
                                }
                                ?>                      
                                
                                
                                
                                <div class="card-single">
                                    <div class="right-content"  style="background-color:white; width:30%;">

                                        <div class="userImage">
                                            <?php echo '<img src="'.$row["photo"].'" width="200px" height="250px" alt="">'; ?>
                                            
                                        </div><br>

                                        <div class="contact_details" >
                                            <div class="personal_details">
                                                <div>
                                                    <label><h3><?php echo $row["firstname"].'&nbsp;&nbsp;'.$row["lastname"]; ?></h3></label>
                                                    <label><h7><?php echo $row["occupation"]; ?></h7></label><br>
                                                    <label><h7>@&nbsp;<?php echo $row["School"]; ?></h7></label>
                                                
                                                 
                                                  
                                                </div>
                                            </div>
                                        </div>



                                    </div>

                               



                            </div>
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

<?php 

?>
