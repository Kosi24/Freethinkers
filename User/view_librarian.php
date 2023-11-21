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
<style>

.form-containing {
    display: flex;
    flex-wrap: wrap;
}

.card-single {
    background-color: #073f5f;
    border-radius: 10px;
    margin: 20px;
    overflow: hidden;
    transition: transform 0.3s ease;
    flex: 1 1 calc(33.33% - 40px); /* Adjust this for desired number of columns */
}

.card-single:hover {
    transform: scale(1.05);
}

.right-content {
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.userImage img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 20px;
}

.contact_details {
    margin-top: 20px;
}

.personal_details {
    display: flex;
    flex-direction: column;
    align-items: center;
    color: #fff;
}

.personal_details label {
    margin: 5px 0;
}

@media only screen and (max-width: 768px) {
    .card-single {
        flex: 1 1 calc(100% - 40px);
    }
}


</style>
  </head>
<body>

<?php  include("user_sidebar.php");
    include("user_header.php");
?>

<main>
    <div class="model">
        <div class="projects">
            <div class="card">
                <div class="card-header">
                    <h3>Library Staff</h3>
                    <button>see all <span></span></button>
                </div>

                <div class="card-body">
                    <div class="form-containing">
                        <div class="dis-table">

                            <?php
                            $result = mysqli_query($db, "SELECT * FROM admin ");
                            while ($row = mysqli_fetch_array($result)) {
                            ?>

                                <div class="card-single">
                                    <div class="right-content">
                                        <div class="userImage">
                                            <?php echo '<img src="' . $row["photo"] . '" alt="">'; ?>
                                        </div>
                                        <div class="contact_details">
                                            <div class="personal_details">
                                                <label><h3><?php echo $row["firstname"] . '&nbsp;&nbsp;' . $row["lastname"]; ?></h3></label>
                                                <label><h7><?php echo $row["post"]; ?></h7></label><br>
                                                <label><h7>@&nbsp;<?php echo $row["phone"]; ?></h7></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</div>

<?php include "../footer.php"; ?>