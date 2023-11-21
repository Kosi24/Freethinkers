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

    <link rel="stylesheet" href="../CSS/main.css" >


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css"  />
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

   </head>

    <body>

        <?php  include("admin_sidebar.php");
                include("admin_header.php");
        ?>

        <main>
            <div class="cards">

                <div class="card-single">
                    <div>
                        <h1 class="counter">
                            <?php
                                 $sql = "SELECT * FROM user";
                                 $count = $db->query($sql);
                                 $result = mysqli_num_rows( $count);
                                 echo $result;   
                            ?>   

                        </h1> 
                        <span>Register Users</span>  
                    </div>
                    <div>
                        <span class="fa-solid fa-users"></span>
                    </div>
                </div>


                <div class="card-single">
                    <div>
                        <h1 class="counter">
                            <?php
                               $sql = "SELECT * FROM book";
                               $count = $db->query($sql);
                               $result = mysqli_num_rows( $count);
                               echo $result;   
                            ?>  
                        </h1> 
                            <span>Books</span>
                    </div>
                    <div>
                        <span class="fa-solid fa-swatchbook"></span>
                    </div>
                </div>


                <div class="card-single">
                    <div>
                        <h1>
                            <?php
                                $sql = "SELECT * FROM issue_book";
                                $count = $db->query($sql);
                                $result = mysqli_num_rows( $count);
                                echo $result;   
                            ?>  
                        </h1> 
                        <span>Issued Books</span>  
                    </div>
                    <div>
                        <span class="fa-brands fa-hive"></span>
                    </div>
                </div>



                <div class="card-single">
                    <div>
                        <h1>129</h1> 
                        <span>Fine</span>  
                    </div>
                    <div>
                        <span class="fa-solid fa-wallet"></span>
                        
                    </div>
                </div>

            </div>



            <div class="recent-grid">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h3>Issued Book</h3>
                            <button>see all <span class=""></span></button>
                        </div>

                        <div class="card-body">
                           <div class="table-responsive">
                           <table width="100%">
                                <thead>
                                    <tr>
                                        <td>Issue ID</td>
                                        <td>Book ID</td>
                                        <td>Book Name</td>
                                        <td>User ID</td>
                                        <td>Issu Date</td>
                                    </tr>
                                </thead>

                                <tbody> 

                                    <?php 
                                        $db = mysqli_connect("localhost", "root", "", "book_inforce");
    
                                        // Calculate the date four weeks ago
   
    
                                        // Retrieve books added within the last four weeks
                                        $result = mysqli_query($db, "SELECT * FROM issue_book  ");
    
                                        while ($row = mysqli_fetch_array($result)) {     

                                        echo "<tr>"; 
                                            echo "<td>";
                                                echo $row["issue_id"];
                                            echo "</td>";
                                            echo "<td>";
                                                echo $row["bkid"];
                                            echo "</td>";
                                            echo "<td>";
                                                echo $row["bookname"];
                                            echo "</td>";   
                                            echo "<td>";
                                                echo $row["userid"];
                                            echo "</td>";  
                                            echo "<td>";
                                                echo $row["issue_date"];
                                            echo "</td>";
                                        }
                                        ?>
                                </tbody>
                            </table>
                                
                           </div>

                        </div>
                    </div>
                </div>

                <div class="customers">

                    <div class="card">
                        <div class="card-header">
                            <h3>New USers</h3>

                            <button>see all <span class=""></span></button>

                        </div>

                        <div class="card-body">
                            <div class="customer-book ">
                                <div class="info">

                                <?php 
                                    $db = mysqli_connect("localhost", "root", "", "book_inforce");
    
                                    // Calculate the date four weeks ago
                                    $fourWeeksAgo = date('Y-m-d', strtotime('-4 weeks'));
    
                                    // Retrieve books added within the last four weeks
                                    $result = mysqli_query($db, "SELECT * FROM user WHERE RegDate >= '$fourWeeksAgo'");
    
                                    while ($row = mysqli_fetch_array($result)) {        
                                    echo '<div class="user-details">';
                                            echo'<div class="img-user">';
                                                echo '<img src="../Admin/' . $row["photo"] . '?booku=imge" width="40px" height="40px">';
                                            echo '</div>';
                                            echo '<div class="user-included">';
                                                echo '<h4>' . $row["username"] . '</h4>';
                                                echo '<p> ' . $row["occupation"] . '</p>';
                                            echo '</div>';
                                            echo '<div class="RegDate">';
                                                echo '<small> ' . $row["RegDate"] . '</small>';
                                            echo '</div>';

                                    echo '</div>';
     
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