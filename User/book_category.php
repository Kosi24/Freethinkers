<?php
session_start();
include ("../inc/database.php");
if(!isset($_SESSION["id"]))
{
    header("location:../index.php");
}
else {
    if(isset($_GET['bkid'])) {
      
        $message = 'Data inserted successfully';
        echo '<div class="success">' . $message . '</div>';
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


.card{
        background: #f1f5f9;
    border-radius: 5px;
    }

    .card-header{
        display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #f0f0f0;
    background-color: white;
    }


    .category-container {
      margin-top: 30px;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px;
  justify-content: center;
 
}

.category {
  background-color: #ffffff;
  padding: 20px;
  border-radius: 10px;
  text-align: center;
  transition: all 0.2s ease-in-out;
  box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
}

.category:hover {
  background-color: #ccc;
  transform: translateY(-1.25rem);
}

.category h3 {
  font-size: 24px;
  margin-bottom: 10px;
}

.category p {
  font-size: 16px;
  margin: 10px 0;
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
                        <h3>View Books</h3>
                        <button >see all <span class=""></span></button>
                    </div>

                    <div class="card-body">
                        <div class="form-containing">
                        <div class="category-container">
  <?php
    $result = mysqli_query($db, "SELECT bookcategory.categoryName, COUNT(book.bkid) AS bookCount, SUM(book.qty) AS totalQty, SUM(book.available) AS availableQty
                                  FROM bookcategory 
                                  LEFT JOIN book ON bookcategory.categoryId = book.CatId 
                                  WHERE bookcategory.status = '1' 
                                  GROUP BY bookcategory.categoryId");

    while ($row = mysqli_fetch_array($result)) {
        echo "<div class='category'>";
        echo "<h3>" . $row['categoryName'] . "</h3>";
        
        echo "<p>Total Quantity: " . $row['totalQty'] . "</p>";
        echo "<p>Available Quantity: " . $row['availableQty'] . "</p>";
        echo "</div>";
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

