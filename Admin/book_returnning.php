<?php
session_start();
include("../inc/database.php");

if (!isset($_SESSION["id"])) {
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

.borrow {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }


    .form-menu1 {
    display: block;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    margin: 10px 30px 20px 30px;
}


.book-group {
    display: grid;
    justify-content: center;
    white-space: pre-line;
    font-weight: bold;
    font-size: xxx-large;
    line-height: 30px;
    /* margin: 0px; */
}

.form-group1 {
    width: 90%;
    display: flex;
    margin: 33px 31px;
    justify-content: space-evenly;
    gap: 10%;
}


.form-group img {
    width: 251px;
    height: 251px;
    border-radius: 131px;
}

.form-group1 {
  display: flex;
  margin: 33px 31px;
}



.form-menu3 {
    width: 60%;
}

.form-menu3 div {
    padding: 10px 4px;
    /* margin-bottom: 10px; */
    margin: 5px 10% 10px 2px;
    border: 1px solid gainsboro;
    border-radius: 5px;
    box-shadow: darkgray;
}

    .form-menu3 label {
    display: block;
    margin-bottom: 2px;

}

.form-menu3 .isbn input[type="text"] {
    text-align: center;
    font-size: x-large;
    background: black;
    color: white;
}


.form-menu3 div input[type="text"] {
    padding: 0px 4px;
    margin: 0px 10px;
    border: none;
}
.form-menu3 input[type="text"], .form-menu3 select {
    width: 95%;
    margin-bottom: 10px;
}
.update, .form-menu3 input[type="submit"] {
    /* margin-top: 20px; */
    width: 20%;
    height: 38px;
}


.userid-select div {
    /* display: flex; */
    display: flex;
    width: 100%;
    padding: 3px 9px 3px 9px;
    column-gap: 5%;
}

select#userid {
    width: 70%;
    margin-bottom: 0px;
}


.userid-select {
    display: flex;
    display: block;
    line-height: 4px;
    padding: 2px 4px;
}

button.update {
    width: 30%;
    margin-left: 35%;
    margin-top: 30px;
}

.book-id {
    text-align: center;
}

.book-id input[type="text"] {
    background-color: white;
    border: none;
    font-size: xxx-large;
    color: black;
    font-weight: bolder;
    width: 10%;
}

.issue_id input[type="text"] {
    font-size: smaller;
    color: black;
    font-weight: bold;
    background: none;
    border: none;
}

.paid_status div {
    display: flex;
    width: 25%;
    padding: 20px 5px 20px 10px;
    border: none;
    margin: 0px;

}

.paid_status {
    display: flex;
}

.paid_status div input {
    margin-left: 10px;
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
                        <h3>Book get return</h3>
                        <button >see all <span class=""></span></button>
                    </div>

                    <div class="card-body">
                        <div class="form-containing">
                           
                        <?php if(isset($message)): ?>
                                    <div><?php echo $message; ?></div>
                         <?php endif; ?>


                         <?php
// check if book id is set in URL
if(isset($_GET['issue_id'])){
    // retrieve book details from database using book id
    $issueid = $_GET['issue_id'];
    $result = mysqli_query($db, "SELECT * FROM issue_book WHERE issue_id = $issueid ") ;
    while ($row = mysqli_fetch_array($result)) {
?>


<!-- display book details in form -->
<form class="borrow details" method="post" enctype="multipart/form-data" action="">
    <div class="form-menu1">

        <div class="book-group">
            <div class="issue_id">
                <label>Issued ID &nbsp;&nbsp;&nbsp;</label><input type="text" name="issue_id" value="<?php echo $row['issue_id']; ?>" disabled>
            </div>
        </div>

     
        <div class="form-menu3">
            
            <div class="bkid">
            <label >Book ID:</label>
            <input type="text" name="bkid" value="<?php echo $row['bkid']; ?>" disabled>
            </div>
            
            <div>
            <label>Books Name:</label>
            <input type="text" name="bookname" value="<?php echo $row['bookname']; ?>" disabled>
            </div>

            <div>
            <label>USER ID:</label>
            <input type="text" name="userid" value="<?php echo $row['userid']; ?>" disabled>
            </div>

            <div>
            <label>Username:</label>
            <input type="text" name="username" value="<?php echo $row['username']; ?>" disabled>
            </div>

            <div>
            <label>Issue Date:</label>
            <input type="text" name="issue_date" value="<?php echo $row['issue_date']; ?>" disabled>
            </div>

            <div>
            <label>Return Date:</label>
            <input type="text" name="return_date" value="<?php echo $row['return_date']; ?>" disabled>
            </div>

            <?php
                $return_date = new DateTime($row['return_date']);

                if ($return_date === false) {
                     echo "Invalid return date format";
                } else {
                    $today = new DateTime();

                    if ($today < $return_date) {
                    $status = "Active";
                    $days_late = 0;
                    $penalty = 0;
                } else {
                    $status = "Expired";
                    $interval = $return_date->diff($today);

                    if ($interval === false) {
                         echo "Error calculating interval";
                    } else {
                        $days_late = $interval->format('%a');

                        if ($days_late <= 5) {
                        $penalty = $days_late * 40;
                        } else {
                            $penalty = 200 + ($days_late - 5) * 100;
            }
        }
    }
           ?>
           
            <div>
            <label>Day Delays:</label>
            <input type="text" name="day_delay" value="<?php echo  $days_late; ?>" disabled>
            </div>

            <div>
            <label>Penalty:</label>
            <input type="text" name="penalty" value="<?php echo  $penalty; ?>" disabled>
            </div>
<?php }
?>

            <div class="paid_status">
                
                <label>Status:</label>
                <div>
                    <label for="paid">Paid</label>
                    <input type="radio" id="paid" name="payment_status" value="Paid">
                </div>
                
                <div>
                    <label for="unpaid">Unpaid</label>
                    <input type="radio" id="unpaid" name="payment_status" value="Unpaid" checked> <!-- You can set the default value as needed -->
                </div>
                
            </div>
   
                <button  class="update" type="submit" name="update">Update</button>                             
                                               
    
                                          
           </form>

        </div>
            
       
    </div>

        
</form>

<?php }}?>
<?php }?> 





   
    
                            
				        </div>	
                                
                    </div>
                   
                </div>
            </div>




            <?php


if(isset($_POST["update"])){
    $bkid = $_POST["issue_id"];
    $bkid = $_POST["bkid"];
    $bookname = $_POST["bookname"];
    $userid = $_POST["userid"];
    $username = $_POST["username"];
    $penalty = $_POST["penalty"];

    $sql = "INSERT INTO req_book (bkid, bookname, categoryName, id, username,email,req_note) VALUES ('$bkid', '$bookname', '$categoryName', '$userid', '$username','$email','$note')";
    mysqli_query($db, $sql);

    $req_id = mysqli_insert_id($db); // get the req_id value from the last INSERT statement
    $status = "Book is requested for $username by Librarian";

    $sql = "INSERT INTO req_history (req_id,bkid, bookname, categoryName, id, username,email,req_note,status) VALUES ('$req_id','$bkid', '$bookname', '$categoryName', '$userid', '$username','$email','$note','$status')";
    mysqli_query($db, $sql);


     // Construct the notification message
     $message = "The book $bookname is requested for $username by librarian";
     $title = "The book $bookname successfully requested by Librarian for $username";

     // Get the current date/time
     $datetime = date('Y-m-d H:i:s');
 
     // Insert a new row into the notifications table
     $query = "INSERT INTO notifications (id, msgTitle, message, created_at) VALUES ('$userid', '$title', '$message', '$datetime')";
     mysqli_query($db, $query);
 
     if(mysqli_affected_rows($db) > 0){
        $_SESSION["success"] = "Book request successful";
        $redirect_url = "requested_books.php";
    } else{
        echo "Book  Requested  not successfully.";

        $redirect_url = "display_book.php";
    }
    
    if(!empty($redirect_url)) {
        echo "<script>window.location.href='$redirect_url';</script>";
    } else{
        
        echo "<script>window.location.href='display_dashboard.php';</script>";
    }
}
 ?> 
 
        </div>
    </main>        
</div>    



 


 
 
 <?php 
include "../footer.php";
?>



<?php 

?>
