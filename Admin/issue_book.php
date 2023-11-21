<?php
session_start();
include ("../inc/database.php");
if(!isset($_SESSION["id"]))
{
    header("location:../index.php");
}else{

    if(isset($_POST['cancel'])){

        // Get the reserve_id of the reserved book to be canceled
        $reserve_id = $_POST['reserve_id'];
    
        // Delete the row from reserved_book table
        $delete_query = "DELETE FROM reserved_book WHERE reserve_id='$reserve_id'";
        mysqli_query($db, $delete_query);

        
        
    
        // Redirect to requested_book.php page
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
                        <h3>To issue</h3>
                        <button >see all <span class=""></span></button>
                    </div>

                    <div class="card-body">
                        <div class="form-containing">
                           <div class="dis-table">

                          <table>
                            <thead>
                                <tr>
                                <th>Reserve ID</th>
                                <th>Book ID</th>
                                <th>Book Name</th>
                                <th>User ID</th>
                                <th>Username</th>
                                <th>Request Note</th>
                                <th>Issue Date</th>
                                <th>Return Date</th>
                                <th >
                                    <th>Issue Note</th>
                               
                                    <th>Action</th>
                                </th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php
    $result = mysqli_query($db, "SELECT * FROM reserved_book");

    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['reserve_id'] . "</td>";
        echo "<td>" . $row['bkid'] . "</td>";
        echo "<td>" . $row['bookname'] . "</td>";
        echo "<td>" . $row['userid'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['req_note'] . "</td>";
        echo "<td><input type='date' name='issue_date' id='issue_date' onchange='calculateReturnDate(this.value)' required>   </td>";
        echo "<td><input type='date' name='return_date' id='return_date' onchange='setReturnDateHidden()' required></td>";
        
        echo "<td>";?>

        <form method="post" action="">
            <input type="hidden" name="reserve_id" value="<?php echo $row["reserve_id"]; ?>">
            <input type="hidden" name="bkid" value="<?php echo $row["bkid"]; ?>">
            <input type="hidden" name="bookname" value="<?php echo $row["bookname"]; ?>">
            <input type="hidden" name="userid" value="<?php echo $row["userid"]; ?>">
            <input type="hidden" name="username" value="<?php echo $row["username"]; ?>">
            <input type="hidden" name="req_note" value="<?php echo $row["req_note"]; ?>">
            <input type="hidden" name="issue_date_hidden" id="issue_date_hidden" value="">
            <input type="hidden" name="return_date_hidden" id="return_date_hidden" value="">
            <td>
                <input type="text" name="issue_note" placeholder="Issue Note">
            </td>
            <td class="action-btn">
                <button type="submit" name="confirm">Confirm</button>&nbsp;&nbsp;&nbsp;
                <button type="Cancel" name="cancel">Cancel</button>
            </td> 
        </form>
        <?php
    }
    ?>
                              
                            </tbody>
                          </table>

                          </div>
                        </div>
                               
                    </div>
                   
                </div>
            </div>

            <?php




if(isset($_POST["confirm"])){
    $reserve_id = $_POST["reserve_id"];
    $bkid = $_POST["bkid"];
    $bookname = $_POST["bookname"];
    $userid = $_POST["userid"];
    $username = $_POST["username"];
    $req_note =$_POST["req_note"];
    $issue_date = $_POST["issue_date_hidden"]; // Retrieve from hidden field
    $return_date = $_POST["return_date_hidden"]; // Retrieve from hidden field
    $issue_note=$_POST["issue_note"];

    $sql = "INSERT INTO issue_book (reserve_id, bkid, bookname,  userid, username, req_note, issue_date, return_date, issue_note ) VALUES ('$reserve_id','$bkid', '$bookname', '$userid', '$username','$req_note', '$issue_date', '$return_date', '$issue_note')";
    mysqli_query($db, $sql);

    $query = "DELETE FROM reserved_book WHERE reserve_id='$reserve_id'";
    mysqli_query($db, $query);


    $message = "The book $bookname is successfully issued to $username ";

     $title = "The book $bookname successfully issued";

     // Get the current date/time
     $datetime = date('Y-m-d H:i:s');
 
     // Insert a new row into the notifications table
     $query = "INSERT INTO notifications (id, msgTitle, message, created_at) VALUES ('$userid', '$title', '$message', '$datetime')";
     mysqli_query($db, $query);


     if(mysqli_affected_rows($db) > 0){
        
     
        ?>
        <script type="text/javascript">
            alert("Books issued successfully");
            window.location.href = "issued_book.php";
        </script>
        <?php

    } else{
       
        echo "Error: " . $sql . "<br>" . $db-> error;
    }

}
?>




            
        </div>
    </main>        

    <script>
    function calculateReturnDate(selectedIssueDate) {
        // If issue date is not selected, do nothing
        if (!selectedIssueDate) {
            return;
        }

        // Calculate the return date by adding 30 days to the selected issue date
        var returnDate = new Date(selectedIssueDate);
        returnDate.setDate(returnDate.getDate() + 30);

        // Format the return date as YYYY-MM-DD
        var formattedReturnDate = returnDate.toISOString().split('T')[0];

        // Set the value of the return date input
        document.getElementById('return_date').value = formattedReturnDate;

        // Set the value of the hidden return date input
        document.getElementById('return_date_hidden').value = formattedReturnDate;
        // Set the value of the hidden issue date input
        document.getElementById('issue_date_hidden').value = selectedIssueDate;
    }

    function setReturnDateHidden() {
        // Get the value of the return date input
        var returnDateInput = document.getElementById('return_date').value;

        // Set the value of the hidden return date input
        document.getElementById('return_date_hidden').value = returnDateInput;
    }
</script>





</div>




 <?php 
include "../footer.php";
?>

<?php } ?>