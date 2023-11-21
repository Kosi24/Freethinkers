<?php
session_start();
include ("../inc/database.php");
if(!isset($_SESSION["id"]))
{
    header("location:../index.php");
}

else {
   
    if (isset($_POST['reserve'])) {
        $req_id = $_POST['req_id'];
        $bkid = $_POST['bkid'];
        $bookname = $_POST['bookname'];
        $userid = $_POST['userid'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $req_date = $_POST['req_date'];
        $req_note = $_POST['req_note'];


            // Check if the req_id exists in the req_book table
    // $check_query = "SELECT * FROM req_book WHERE req_id = '$req_id'";
    // $result = mysqli_query($db, $check_query);
    
    // if (mysqli_num_rows($result) > 0) {
    //     // Insert the data into the reserved_book table
    //     $reserve_query = "INSERT INTO reserved_book (bkid, bookname, userid, username, email, req_date, req_note) 
    //                       VALUES ('$bkid', '$bookname', '$userid', '$username', '$email', '$req_date', '$req_note')";
    //     mysqli_query($db, $reserve_query);

    //     $status_query =" INSERT INTO book_status(req_id) VALUES('$req_id')";
    //     mysqli_query($db, $status_query);
        
    //     // Get the auto-generated reserve_id
    //     $reserve_id = mysqli_insert_id($db);
        
    //     // Insert a new row into the req_history table
    //     $status = "book is reserved";
    //     $update_query = "UPDATE req_history SET status='$status', reserve_id='$reserve_id' WHERE req_id='$req_id'";
    //    mysqli_query($db, $update_query);
        
    //     // Send a notification to the user
    //     $message = "The book $bookname is reserved. Now you can borrow it from Vavuniya Public Library.";
    //     $title = "The book $bookname is reserved";
    //     $datetime = date('Y-m-d H:i:s');
    //     $notify_query = "INSERT INTO notifications (id, msgTitle, message, created_at) 
    //                      VALUES ('$userid', '$title', '$message', '$datetime')";
    //     mysqli_query($db, $notify_query);
        
    //     // Update the Available count in the book table
    //     mysqli_query($db, "UPDATE book SET Available = Available - 1 WHERE bkid = '".$bkid."'");
        

    //     // Delete the row from the req_book table
    //     mysqli_query($db, "DELETE FROM req_book WHERE req_id = '$req_id'");

        
        
    //     // Redirect the user to a success page
    //     header('Location: issue_book.php');
    //     exit();
        
        mysqli_query($db, "UPDATE book SET Available = Available - 1 WHERE bkid = '".$bkid."'");
        mysqli_query($db, "INSERT INTO reserved_book (req_id, bkid, bookname, userid, username, email, req_date, req_note) VALUES ('$req_id', '$bkid', '$bookname', '$userid', '$username', '$email', '$req_date', '$req_note')");
        $reserve_id = mysqli_insert_id($db); // Get the auto-generated reserved_id

        // mysqli_query($db, " INSERT INTO book_status(req_id) VALUES('$req_id')");

        mysqli_query($db, "DELETE FROM req_book WHERE req_id = '$req_id'");



    $status = "book is reserved";
    $update_query = "UPDATE req_history SET status='$status', reserve_id='$reserve_id' WHERE req_id='$req_id'";
    mysqli_query($db, $update_query);

    
    $message = "The book $bookname is reserved. now you can borrow from Vavuniya Public Library.";

    $title = "The book $bookname successfully reserved";

    // Get the current date/time
    $datetime = date('Y-m-d H:i:s');

    // Insert a new row into the notifications table
    $query = "INSERT INTO notifications (id, msgTitle, message, created_at) VALUES ('$userid', '$title', '$message', '$datetime')";
    mysqli_query($db, $query);

 header('Location:issue_book.php');
        exit();

    }
         
        elseif(isset($_POST['cancel'])) {
            $req_id = $_POST['req_id'];
            $bookname =$_POST['bookname'];
            $userid =$_POST['userid'];
            
            // Delete the request from the req_book table
            mysqli_query($db, "DELETE FROM req_book WHERE req_id = '$req_id'");


            $status = "The Book request is cancel";
            $update_query = "UPDATE req_history SET status='$status' WHERE req_id='$req_id'";
            mysqli_query($db, $update_query);

    
            $message = "The book $bookname request is canceled by librarian. contact the library to solve your issue";

            $title = "The book $bookname request is canceled";

            // Get the current date/time
            $datetime = date('Y-m-d H:i:s');

            // Insert a new row into the notifications table
            $query = "INSERT INTO notifications (id, msgTitle, message, created_at) VALUES ('$userid', '$title', '$message', '$datetime')";
            mysqli_query($db, $query);
            
            // Redirect back to the same page
            header("Location: requested_books.php");
            exit();
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
table {
  border-collapse: collapse;
  width: 100%;
}



th, td {
  text-align: left;
  padding: 8px;
}

th {
    background-color: #008CBA;
    color: white;
  font-weight: bold;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

.center {
  text-align: center;
}

.btn {
  padding: 6px 12px;
  border: none;
  border-radius: 4px;
  color: #fff;
  background-color: #008cba;
  cursor: pointer;
  margin-top: 35px;
}

.btn:hover {
  background-color: #0069d9;
}

td.center {
    gap: 5px;
}

td.req-note {
    overflow-wrap: anywhere;
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
                           <div class="dis-table">

                           <table>
    <thead>
        <tr>
            <th>Request ID</th>
            <th>Book Image</th>
            <th>Book ID</th>
            <th>ISBN</th>
            <th>Book Name</th>
            <th>Category</th>
            <th>User ID</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Requested Date</th>
            <th>Notes</th>
            <th>Action</th>
            
        </tr>
    </thead>
    <tbody>
    <?php
            $result = mysqli_query($db, "SELECT * FROM req_book");
            while ($row = mysqli_fetch_array($result)) {
                $book_result = mysqli_query($db, "SELECT bkimage,isbn,Available FROM book WHERE bkid = '".$row['bkid']."'");
                $book_row = mysqli_fetch_array($book_result);
                $available = $book_row['Available'];
        ?>
                
                <tr>
                    <td><?php echo $row['req_id']; ?></td>
                    <td><img src="<?php echo $book_row['bkimage']; ?>" width='100' height='100'></td>
                    <td><?php echo $row['bkid']; ?></td>
                    <td><?php echo $book_row['isbn']; ?></td>
                    <td><?php echo $row['bookname']; ?></td>
                    <td><?php echo $row['categoryName']; ?></td>
                    <td><?php echo $row['userid']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['req_date']; ?></td>
                    <td class="req-note"><?php echo $row['req_note']; ?></td>

                    <td class="center">
                    <?php 
                        $reserved_result = mysqli_query($db, "SELECT * FROM reserved_book WHERE req_id = '".$row['req_id']."' AND bkid = '".$row['bkid']."' AND bookname = '".$row['bookname']."' AND userid = '".$row['userid']."' AND username = '".$row['username']."' AND email = '".$row['email']."' AND req_date = '".$row['req_date']."' AND req_note = '".$row['req_note']."' ");
                        if (mysqli_num_rows($reserved_result) == 0  && $available > 0) {
                // Show reserve button
                        ?>
                        <form action="" method="post">
                            <input type="hidden" name="req_id" value="<?php echo $row['req_id']; ?>">
                            <input type="hidden" name="bkid" value="<?php echo $row['bkid']; ?>">
                            <input type="hidden" name="bookname" value="<?php echo $row['bookname']; ?>">
                            <input type="hidden" name="userid" value="<?php echo $row['userid']; ?>">
                            <input type="hidden" name="username" value="<?php echo $row['username']; ?>">
                            <input type="hidden" name="email" value="<?php echo $row['email']; ?>">
                            <input type="hidden" name="req_date" value="<?php echo $row['req_date']; ?>">
                            <input type="hidden" name="req_note" value="<?php echo $row['req_note']; ?>">
                            <button type="submit" name="reserve" class="btn btn-primary">Reserve</button> 
                        </form>

                        <?php
            
                         }
                        ?>
                        <br><br>
                        <form action="" method="post">
                            <input type="hidden" name="req_id" value="<?php echo $row['req_id']; ?>">
                            <input type="hidden" name="bookname" value="<?php echo $row['bookname']; ?>">
                            <input type="hidden" name="userid" value="<?php echo $row['userid']; ?>">
                            <button type="submit" name="cancel" class="btn btn-primary">Cancel</button>
                    </form>                    
                    </td>
                    
                </tr>
                    
             
        <?php } ?>

    </tbody>
</table>


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

<?php  }?>

