<?php
session_start();
include ("../inc/database.php");
if(!isset($_SESSION["id"]))
{
    header("location:../index.php");
}

else {
   
//     if (isset($_POST['reserve'])) {
//         $req_id = $_POST['req_id'];
//         $bkid = $_POST['bkid'];
//         $bookname = $_POST['bookname'];
//         $userid = $_POST['userid'];
//         $username = $_POST['username'];
//         $email = $_POST['email'];
//         $req_date = $_POST['req_date'];
//         $req_note = $_POST['req_note'];
        
//         mysqli_query($db, "INSERT INTO reserved_book (req_id, bkid, bookname, userid, username, email, req_date, req_note) VALUES ('$req_id', '$bkid', '$bookname', '$userid', '$username', '$email', '$req_date', '$req_note')");
//         $reserve_id = mysqli_insert_id($db); // Get the auto-generated reserved_id
//         mysqli_query($db, "DELETE FROM req_book WHERE req_id = '$req_id'");

    
//     $status = "book is reserved";
//     $update_query = "UPDATE req_history SET status='$status', reserve_id='$reserve_id' WHERE req_id='$req_id'";
//     mysqli_query($db, $update_query);

    
//     $message = "The book $bookname is reserved. now you can borrow from Vavuniya Public Library.";

//     $title = "The book $bookname successfully reserved";

//     // Get the current date/time
//     $datetime = date('Y-m-d H:i:s');

//     // Insert a new row into the notifications table
//     $query = "INSERT INTO notifications (id, msgTitle, message, created_at) VALUES ('$userid', '$title', '$message', '$datetime')";
//     mysqli_query($db, $query);

//  header('Location:issue_book.php');
//         exit();

//         } elseif(isset($_POST['cancel'])) {
//             $req_id = $_POST['req_id'];
//             $bookname =$_POST['bookname'];
//             $userid =$_POST['userid'];
            
//             // Delete the request from the req_book table
//             mysqli_query($db, "DELETE FROM req_book WHERE req_id = '$req_id'");


//             $status = "The Book request is cancel";
//             $update_query = "UPDATE req_history SET status='$status' WHERE req_id='$req_id'";
//             mysqli_query($db, $update_query);

    
//             $message = "The book $bookname request is canceled by librarian. contact the library to solve your issue";

//             $title = "The book $bookname request is canceled";

//             // Get the current date/time
//             $datetime = date('Y-m-d H:i:s');

//             // Insert a new row into the notifications table
//             $query = "INSERT INTO notifications (id, msgTitle, message, created_at) VALUES ('$userid', '$title', '$message', '$datetime')";
//             mysqli_query($db, $query);
            
//             // Redirect back to the same page
//             header("Location: requested_books.php");
//             exit();
//         }
        
        
        


    
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
    .status {
    font-size: large;
    font-style: normal;
    font-weight: 600;
    color: #1d1b31;
    text-align: center;
}

    table {
    border-collapse: collapse;
    width: 100%;
    margin-bottom: 20px;
  }

  th, td {
    text-align: left;
    padding: 8px;
  }

  th {
    background-color: #2196F3;
    color: white;
  }

  tr:nth-child(even) {
    background-color: #f2f2f2;
  }

  tr:hover {
    background-color: #ddd;
  }

  button {
    background-color: #12ace2;
    border: none;
    border-radius: 3px;
    padding: 3px 7px 3px 7px;
    color: white;
    font-weight: bold;
}

tr td:last-child {
    display: flex;
    align-items: center;
    margin-top: 39px;
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
                        <h3>Retun Books</h3>
                        <button >see all <span class=""></span></button>
                    </div>

                    <div class="card-body">
                        <div class="form-containing">
                           <div class="dis-table">

                           <table>
                                <thead>
                                    <tr>
                                        <th>Book Image</th>
                                        <th>Issue ID</th>
                                        <th>Book ID</th>
                                        <th>Book Name</th>
                                        <th>User ID</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Issued Date</th>
                                        <th>Return Date</th>
                                        <th>status</th>
                                        <th>Date Delays</th>
                                        <th>Fine</th>
                                        <th>Paid Status</th>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php
                                   


                                    $result = mysqli_query($db, "SELECT * FROM issue_book");
                                    while ($row = mysqli_fetch_array($result)) {
                                    $book_result = mysqli_query($db, "SELECT bkimage,isbn FROM book WHERE bkid = '".$row['bkid']."'");
                                    $book_row = mysqli_fetch_array($book_result);
                                    $user_result = mysqli_query($db, "SELECT email FROM user WHERE userid = '".$row['userid']."'");
                                    $user_row = mysqli_fetch_array($user_result);

                                        
                                    
                                    // // calculate days late
                                    // $return_date = $row['return_date'];
                                    // $today = date('d/m/Y');

                                    // if($today < $return_date) {
                                    //     $status ="Expired";
                                    // }else{
                                    //     $status= "Active";

                                    //     $days_late = "";
                                    // }

                                    $return_date = new DateTime($row['return_date']);

                                    $today = new DateTime();

                                    if ($today < $return_date) {
                                        $status = "Active";
                                        $days_late = 0;
                                        $penalty = 0 ;

                                        } else {
                                            $status = "Expired";
                                            $interval = $return_date->diff($today);
                                            $days_late = $interval->format('%a');

                                            if($days_late <= 5) {
                                                $penalty = $days_late * 40  .'/=';
                                            } else {
                                                $penalty = 200 + ($days_late - 5) * 100 .'/=';
                                            }
                                        }

                                      
                                ?>
                
                                    <tr>
                                        <td><img src="<?php echo $book_row['bkimage']; ?>" width='60' height='70'></td>
                                        <td><?php echo $row['issue_id']; ?></td>
                                        <td><?php echo $row['bkid']; ?></td>
                                        <td><?php echo $row['bookname']; ?></td>
                                        <td><?php echo $row['userid']; ?></td>
                                        <td><?php echo $row['username']; ?></td>
                                        <td><?php echo $user_row['email']; ?></td>
                                        <td><?php echo $row['issue_date']; ?></td>
                                        <td><?php echo $row['return_date']; ?></td>
                                        <td class="status"style="background-color: <?php echo $status == 'Active' ? 'green' : 'red'; ?>"><?php echo $status ?></td>
                                        <td><?php echo $days_late . "&nbsp;&nbsp; Days"; ?></td> 
                                        <td><?php echo $penalty ; ?></td>
                                        
                                        <td class="center">

                                        <a href="book_returnning.php?issue_id=<?php echo $row["issue_id"]; ?> "><button class="btn_edit"><i class="fa fa-edit "></i> Return</button></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <button type="submit" name="cancel" class="btn btn-primary">Delete</button>
                                                       
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

