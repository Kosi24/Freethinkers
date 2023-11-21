<?php
session_start();
include ("../inc/database.php");
if(!isset($_SESSION["id"]))
{
    header("location:../index.php");
}
else {
  if(isset($_SESSION["success"])){
    echo "<div style='background-color: #a6e22e; color: black; padding: 30px; z-index: 3000; position: absolute; top: 200px; left: 100px; right: 10px;'>" . $_SESSION["success"] . "</div>";
    unset($_SESSION["success"]);
}
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

     <style>
      .customer-book{

        display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 0.7rem;
    overflow-y: auto;
    max-height: 300px;
      }
    .info {
        display: inline-block;
        align-items: center;
        width: 100%;
        margin-bottom: 20px;
        
    }
    
    .info img {
        margin-right: 10px;
    }
    
    .info h4 {
        font-size: 20px;
        margin: 0;
    }
    
    .info p {
        font-size: 16px;
        margin: 0;
        color: #666;
    }

    .book-details {
      display: flex;
    margin-left: 5px;
    margin-right: 5px;
    margin-top: 10px;
    margin-bottom: 10px;
    padding: 11px;
    background-color: #fbfbfb;
    border-bottom: inset;
    border-radius: 10px;
}

.book-included {
    margin-left: 10px;
    width: 50%;
}
.img-book{
  width: 20%;
}

.book-date {
    width: 30%;
}
</style>
   </head>
<body>
 
<?php  
 include("user_sidebar.php");
    include("user_header.php");
?>

    <main>

      <div class="cards">
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
            <span class="fa-solid fa-users"></span>
                       
          </div>
        </div>

        <div class="card-single">
          <div>
            <h1 class="counter">
                        <?php
                          $sql = "SELECT * FROM bookcategory";
                          $count = $db->query($sql);
                          $result = mysqli_num_rows( $count);
                          echo $result;   
                        ?>  

                      </h1> 
                      <span>Book Categories</span>
                          
                  </div>
                  <div>
                      <span class="fa-solid fa-swatchbook"></span>
                       
                      
          </div>
        </div>  


        <div class="card-single">
          <div>
            <h1 class="counter">
                        <?php
                          $sql = "SELECT * FROM issue_book WHERE userid='".$_SESSION['id']."'";
                          $count = $db->query($sql);
                          $result = mysqli_num_rows( $count);
                          echo $result;   
                        ?>  

                      </h1> 
                      <span>To Return</span>
                          
                  </div>
                  <div>
                      <span class="fa-solid fa-swatchbook"></span>
                       
                      
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
                <div style="background-color: white;"class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h3>Notification</h3>
                            <button>see all <span class="">
                            </span></button>

                        </div>

                        <div class="card-body">
                           <div class="table-responsive">
                           <table width="100%">
    <thead>
        <tr>
            <td>No</td>
            <td>Title</td>
            <td>message</td>
            <td>Date</td>
        </tr>
    </thead>
    <tbody> 
    <?php
    $db = mysqli_connect("localhost", "root", "", "book_inforce");

    $startDate = date('Y-m-d', strtotime('-1 month')); // Calculate the date one month ago
    $query = "SELECT * FROM notifications WHERE id='".$_SESSION['id']."' AND created_at >= '$startDate'";
    $result = mysqli_query($db, $query);

    $rowNumber = 1; // Initialize row number
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>"; 
        echo "<td>";
        echo $rowNumber;
        echo "</td>";
        echo "<td>";
        echo $row["msgTitle"];
        echo "</td>";
        echo "<td>";
        echo $row["message"];
        echo "</td>";
        echo "<td>";
        echo $row["created_at"];
        echo "</td>";   
        echo "</tr>";
        $rowNumber++; // Increment row number for the next row
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
                            <h3>Newly added Books</h3>

                            <button>see all <span class="">

                            </span></button>

                        </div>

                        <div class="card-body">
                            <div class="customer-book">
                            <div class="info">
    <?php 
    $db = mysqli_connect("localhost", "root", "", "book_inforce");
    
    // Calculate the date four weeks ago
    $fourWeeksAgo = date('Y-m-d', strtotime('-4 weeks'));
    
    // Retrieve books added within the last four weeks
    $result = mysqli_query($db, "SELECT * FROM book WHERE book_date >= '$fourWeeksAgo'");
    
    while ($row = mysqli_fetch_array($result)) {        
      echo '<div class="book-details">';
        echo'<div class="img-book">';
          echo '<img src="../user/' . $row["bkimage"] . '?booku=imge" width="40px" height="40px">';
         echo '</div>';
        echo '<div class="book-included">';
          echo '<h4>' . $row["bookname"] . '</h4>';
          echo '<p>by ' . $row["author"] . '</p>';
        echo '</div>';
        echo '<div class="book-date">';
          echo '<small> ' . $row["book_date"] . '</small>';
        echo '</div>';

      echo '</div>';
     
    }
    ?>
</div>
                            
                            
                            
                            
                            <br>
                            

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