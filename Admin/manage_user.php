<?php
session_start();
include ("../inc/database.php");
if(!isset($_SESSION["id"]))
{
    header("location:../index.php");
}
else {

    if(isset($_GET['inid'])) {
        $id=$_GET['inid'];
        $status=0;
        $sql = "update user set Status=? WHERE userid=?";
        $query = $db->prepare($sql);
        $query->bind_param('ii', $status, $id);
        $query->execute();
        header('location:manage_user.php');
    }
    
    //code for active students
    if(isset($_GET['activeid'])) {
        $id=$_GET['activeid'];
        $status=1;
        $sql = "update user set Status=? WHERE userid=?";
        $query = $db->prepare($sql);
        $query->bind_param('ii', $status, $id);
        $query->execute();
        header('location:manage_user.php');
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
     <style>

    .card{
        background: #f1f5f9;
    border-radius: 5px;
    }

    .card-header{
        display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #f0f0f0;
    background-color: white;
    }

.dis-table {
        display: flex;
        flex-wrap: wrap;
           justify-content: space-evenly;
        gap: 20px;
        margin-top: 30px;
    }
    
    .usercard-single {
        background-color: #fff;
        box-shadow: 0px 2px 3px rgba(0, 0, 0, 0.1);
        width: 260px;
        text-align: center;
        padding: 20px;
        border-radius: 20px;
    }
    
    .usercard-single .userImage {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        border-radius: 50%;
        overflow: hidden;
        border: 2px solid #ccc;
        box-shadow: 0px 2px 3px rgba(0, 0, 0, 0.1);
    }
    
    .usercard-single .userImage img {
        width: 100%;
        height: 100%;
        object-fit: cover;
       
  
    }
    
    .usercard-single .status {
        font-size: 16px;
        margin-bottom: 20px;
    }
    
    .usercard-single .userDetails {
        font-size: 14px;
        line-height: 1.2;
        height: 80px;
    }
    
    .usercard-single .userDetails h4.username {
        font-size: 18px;
        margin-bottom: 5px;
    }
    
    .usercard-single .userDetails h15 {
        font-size: 14px;
        margin-bottom: 10px;
    }
    
    .usercard-single .type {
        display: block;
        font-style: italic;
        margin-top: 10px;
    }
    
    .usercard-single .btnactive,
    .usercard-single .btnview {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }

    button.btn-view {
    font-size: large;
    border: none;
    background: white;
    margin-left: 192px;
    color: #073f5f;
    margin-top: -15px;
}
button.btn-view:hover {
    color: #12ade3;
}
    
    .usercard-single .btnactive a,
    .usercard-single .btnview a {
        display: inline-block;
        color: #fff;
        border: none;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 14px;
        transition: all 0.3s;
    }
    
   
    
    .usercard-single .btn-edit i {
        font-size: 18px;
        margin-right: 5px;
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
                    <h3>Registered Users</h3>
                    <button>see all <span></span></button>
                </div>

                <div class="card-body">
                    <div class="form-containing">
                        <div class="dis-table">

                            <?php
                                $sql = "SELECT * FROM user";
                                $query = $db->prepare($sql);
                                $query->execute();
                                $results = $query->get_result()->fetch_all(MYSQLI_ASSOC);
                                $cnt = 1;
                                if (count($results) > 0) {
                                    foreach ($results as $result) {
                            ?>

                            <div class="usercard-single">
                            <div class="userImage">
                                <?php if(!empty($result["photo"])): ?>
                                        <?php echo '<img src="'.$result["photo"].'" width="40px" height="40px" alt="">'; ?>
                                <?php else: ?>
                                        <img src="../upload/placeholder.png" width="40px" height="40px" alt="">
                                <?php endif; ?>
                            </div>

                                <div>
                                    <?php
                                        if ($result['Status'] == 1) {
                                            echo "Active";
                                        } else {
                                            echo "Blocked";
                                        }
                                    ?>
                                </div>

                                <div class="userDetails">
                                    <?php echo '<h4 class="username">'.$result["username"].'</h4>'; ?><br>
                                    <?php echo '<h15 class="username">'.$result["firstname"].'&nbsp;&nbsp;'.$result["lastname"].'</h15>'; ?><br>
                                    <?php echo '<small class="type">'.$result["occupation"].'</small>'; ?>
                                </div>

                                <div class="btnactive">
                                    <?php if ($result['Status'] == 1) {?>
                                    <a href="manage_user.php?inid=<?php echo $result["userid"];?>" onclick="return confirm('Are you sure you want to block this user?');"><i class="fa-solid fa-eye" style='font-size:28px;color:green'></i></a>
                                    <?php } else {?>
                                    <a href="manage_user.php?activeid=<?php echo $result["userid"];?>" onclick="return confirm('Are you sure you want to active this user?');"><i class="fa-solid fa-eye-slash" style='font-size:28px;color:red'></i></a> 
                                    <?php } ?>
                                </div>

                                <div class="btnview">
                                    <a href="view_user.php?userid=<?php echo $result["userid"]; ?>"><button class="btn-view"> <i class="fa-solid fa-up-right-from-square"></i></button></a> &nbsp;&nbsp;&nbsp;
                                    </a>
                                    
                                    
                                </div>

                            </div>

                            <?php
                                }
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

<?php } ?>

