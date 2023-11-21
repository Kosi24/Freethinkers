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
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    img {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    input[type="button"] {
        background-color: #008CBA;
        border: none;
        color: white;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        margin: 4px 2px;
        cursor: pointer;
    }
    a {
        color: #008CBA;
    }

     a button {
        background-color: #008cba;
        border-color: #008CBA;
        color: white;
        padding: 5px;
        font-variant-caps: titling-caps;
    }

    a button i.fas.fa-trash{
       background-color: none;
        color: #008cba;
        
    }
    .fa-solid, .fas {
    font-weight: 900;
    font-size: x-large;
    
}

tr td:last-child {
    margin-top: 32px;
    display: flex;
    align-items: center;
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
                           <table >
                            <thead>
                                <tr>
                                    <th style="width:fit-content">Books image</th>
                                    <th>ISBN NO</th>
                                    <th>Books Name</th>
                                    <th>Category</th>
                                    <th>Author name</th>
                                    <th>quantity</th>
                                    <th>Available Books</th>
                                    <th>Track</th>
                                    <th>Books Details</th>
                                    <th>Action </th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                $result = mysqli_query($db, "SELECT book.*, bookcategory.categoryName FROM book INNER JOIN bookcategory ON bookcategory.categoryId = book.CatId") ;
                                while ($row = mysqli_fetch_array($result)) {
                                       

                                    echo "<tr>";
                                    echo "<td>"; ?><img src="<?php echo $row["bkimage"];?>" height="100"  width="100" alt=""> <?php echo"</td>";
                                    echo "<td>";
                                    echo $row["isbn"];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row["bookname"];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row["categoryName"];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row["author"];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row["qty"];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row["Available"];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row["track"];
                                    echo "</td>";
                                    echo "<td>";?> <input type="button" onclick='window.location.href="<?php echo $row["bkfile"];?>"' value="View Book" /><?php
                                    echo "</td>";
                                     echo "<td>";
                                    ?><a href="edit-book.php?bkid=<?php echo $row["bkid"]; ?> "><button class="btn_edit"><i class="fa fa-edit "></i> Edit</button></a>&nbsp;&nbsp;&nbsp;&nbsp;<?php 
                                    ?><a href="borrow-book.php?bkid=<?php echo $row["bkid"]; ?> "><button class="btn_edit"><i class="fa fa-edit "></i> Borrow</button></a>&nbsp;&nbsp;&nbsp;&nbsp;<?php 
                                    ?><a href="delete-book.php?bkid=<?php echo $row["bkid"]; ?> "><i class="fas fa-trash"></i></a><?php
                                    
                                    
                                    echo "</td>";
                                    echo "</tr>";
                                   }
                                
                                ?>
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

<?php } ?>

