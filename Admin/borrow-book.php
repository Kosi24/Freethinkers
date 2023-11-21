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
                        <h3>View Books</h3>
                        <button >see all <span class=""></span></button>
                    </div>

                    <div class="card-body">
                        <div class="form-containing">
                           
                        <?php if(isset($message)): ?>
                                    <div><?php echo $message; ?></div>
                         <?php endif; ?>


                         <?php
// check if book id is set in URL
if(isset($_GET['bkid'])){
    // retrieve book details from database using book id
    $bkid = $_GET['bkid'];
    $result = mysqli_query($db, "SELECT book.*, bookcategory.categoryName 
                                 FROM book 
                                 INNER JOIN bookcategory ON bookcategory.categoryId = book.CatId 
                                 WHERE book.bkid = $bkid") ;
    while ($row = mysqli_fetch_array($result)) {
?>


<!-- display book details in form -->
<form class="borrow details" method="post" enctype="multipart/form-data" action="">
    <div class="form-menu1">

        <div class="book-group">
            <div class="book-id">
                <label>Book ID &nbsp;&nbsp;&nbsp;</label><input type="text" name="bkid" value="<?php echo $row['bkid']; ?>" disabled>
            </div>
        </div>

            <div class="form-group1">    
        
            <div class="form-group">
                <img src="<?php echo $row['bkimage']; ?>" height="100" width="100" alt="">
            </div>
       
        

        

        <div class="form-menu3">
            
            <div class="isbn">
            <label >ISBN NO:</label>
            <input type="text" name="isbn" value="<?php echo $row['isbn']; ?>" disabled>
            </div>
            
            <div>
            <label>Books Name:</label>
            <input type="text" name="bookname" value="<?php echo $row['bookname']; ?>" disabled>
            </div>

            <div>
            <label>Books Category:</label>
            <input type="text" name="categoryName" value="<?php echo $row['categoryName']; ?>" disabled>
            </div>


       


         
        

         <div class="userid-select">
            <p>choose User ID</p>
            <div>
            <select name="getid" id="userid" class="form-control">
                <?php 
                $res = mysqli_query($db, "SELECT userid FROM user");
                while($row1 = mysqli_fetch_array($res)){
                    echo "<option value='" . $row1['userid'] . "'>" . $row1['userid'] . "</option>";
                }
                ?>
            </select>


            <input type="submit" class="btn btn-info" value="select" name="select">
            
            </div>
                

                                    <?php 
                                    if (isset($_POST["select"])) {
                                       $res5 = mysqli_query($db, "select * from user where userid='$_POST[getid]' ");
                                       while($row5 = mysqli_fetch_array($res5)){

                                           $userid  = $row5['userid'];                
										   $username  = $row5['username'];
                                           $email     = $row5['email'];
                                           $occupation = $row5['occupation'];
                                           $phone_number = $row5['phone_number'];
                                           $place = $row5['place'];
                                          
                                       
                                    ?>

        </div>
            <div>
                <label>User ID</label>
                <input type="text" class="form-control" name="userid" value="<?php echo $userid; ?>" disabled> 

            </div> 
            
            <div>
                <label>Username:</label>
                <input type="text" class="form-control" name="username" value="<?php echo $username; ?>" disabled> 
            </div>
            
            <div>  
                <label>Email:</label>
                 <input type="text" class="form-control" name="email" value="<?php echo $email; ?>" disabled> 
             </div>

            <div>
                <label>Occupation:</label>
                <input type="text" class="form-control" name="occupation" value="<?php echo $occupation; ?>" disabled>
            </div>

            <div>
                <label>Phone Number:</label>
                <input type="text" class="form-control" name="phone_number" value="<?php echo $phone_number; ?>" disabled> 
            </div>
            
    
            <div>
                <label>School/University/Institute:</label>
                <input type="text" class="form-control" name="place" value="<?php echo $place; ?>" disabled> 
            </div>



            <form method="post" action="">
                <input type="hidden" name="bkid" value="<?php echo $row['bkid']; ?>" >
                <input type="hidden" name="bookname" value="<?php echo $row["bookname"]; ?>">
                <input type="hidden" name="categoryName" value="<?php echo $row["categoryName"]; ?>">
              
                    
                <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                
                <input type="hidden" name="username" value="<?php echo $username; ?>">
                <input type="hidden" name="email" value="<?php echo $email; ?>">
                <div>
                   
                <label>Borrow Note</label>
                <input type="text" name="note" id="note" placeholder="Enter note here...">  

                </div>
                
                
                <button  class="update" type="submit" name="update">Update</button>                             
                                               
    
                                          
           </form>

        </div>
            
       
    </div>

        
</form>

<?php }}?>
<?php }?> 
<?php }?> 




   
    
                            
				        </div>	
                                
                    </div>
                   
                </div>
            </div>




            <?php


if(isset($_POST["update"])){
    $bkid = $_POST["bkid"];
    $bookname = $_POST["bookname"];
    $categoryName = $_POST["categoryName"];
    $userid = $_POST["userid"];
    $username = $_POST["username"];
    $email =$_POST["email"];
    $note =$_POST["note"];

    $sql = "INSERT INTO req_book (bkid, bookname, categoryName, userid, username,email,req_note) VALUES ('$bkid', '$bookname', '$categoryName', '$userid', '$username','$email','$note')";
    mysqli_query($db, $sql);

    $req_id = mysqli_insert_id($db); // get the req_id value from the last INSERT statement
    $status = "Book is requested for $username by Librarian";

    $sql = "INSERT INTO req_history (req_id,bkid, bookname, categoryName, userid, username,email,req_note,status) VALUES ('$req_id','$bkid', '$bookname', '$categoryName', '$userid', '$username','$email','$note','$status')";
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
}
?>