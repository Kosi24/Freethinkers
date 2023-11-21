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
                        <h3>Issued Books</h3>
                        <button >see all <span class=""></span></button>
                    </div>

                    <div class="card-body">
                        <div class="form-containing">
                           <div class="dis-table">

                           <table>
                                <thead>
                                    <tr>
                                        <th>Issued ID</th>
                                        <th>Book Image</th>
                                        <th>Book ID</th>
                                        <th>ISBN</th>
                                        <th>Book Name</th>
                                        <th>User ID</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Issued Date</th>
                                        <th>Returned Date</th>
                                     
            
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
                                ?>
                
                                    <tr>
                                        <td><?php echo $row['issue_id']; ?></td>
                                        <td><img src="<?php echo $book_row['bkimage']; ?>" width='100' height='100'></td>
                                        <td><?php echo $row['bkid']; ?></td>
                                        <td><?php echo $book_row['isbn']; ?></td>
                                        <td><?php echo $row['bookname']; ?></td>
                                        <td><?php echo $row['userid']; ?></td>
                                        <td><?php echo $row['username']; ?></td>
                                        <td><?php echo $user_row['email']; ?></td>
                                        <td><?php echo $row['issue_date']; ?></td>
                                        <td><?php echo $row['return_date']; ?></td>
                                        

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

