<?php
$db = mysqli_connect("localhost", "root", "", "book_inforce");

if(isset($_POST["confirm"])){
    $reserve_id = $_POST["reserve_id"];
    $bkid = $_POST["bkid"];
    $bookname = $_POST["bookname"];
    $userid = $_POST["userid"];
    $username = $_POST["username"];
    $req_note =$_POST["req_note"];
    $issue_date =$_POST["issue_date"];
    $return_date =$_POST["return_date"];
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
        
        header("Location: issued_book.php");
        ?>
                                              <script type="text/javascript">
                                                  alert("books issued successfully");
                                                  window.location.href=window.location.href;
                                              </script>
                                        <?php
    } else{
       
        header("Location: issue_book.php");
    }

}
?>
