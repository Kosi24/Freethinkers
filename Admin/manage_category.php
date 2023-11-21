<?php
session_start();
include ("../inc/database.php");
if(!isset($_SESSION["id"]))
{
    header("location:../index.php");
}
else {
    if(isset($_GET['message'])) {
        $message = $_GET['message'];
        echo '<div class="success">' . $message . '</div>';
    }

   
 
        // Handle form submission
        if(isset($_POST['Create'])){
          $category = $_POST['category'];
          $status = $_POST['status'];
      
          // Make a database connection
          $db = mysqli_connect("localhost", "root", "", "book_inforce");
      
          // Prepare the SQL statement to insert a new category
          $sql = "INSERT INTO bookcategory(categoryName, status) VALUES (?, ?)";
          $query = $db->prepare($sql);
          $query->bind_param('si', $category, $status);
      
          // Execute the SQL statement
          if($query->execute()) {
              // Redirect to the category management page after successfully adding the category
              header("Location: manage_category.php");
              exit();
          } else {
              $message = "Error: " . $sql . "<br>" . $db->error;
          }
      }
    
      

    
    if(isset($_GET['incategoryId'])) {
        $id=$_GET['incategoryId'];
        $status=0;
        $sql = "update bookcategory set status=? WHERE categoryId=?";
        $query = $db->prepare($sql);
        $query->bind_param('ii', $status, $id);
        $query->execute();
        header('location:manage_category.php');
    }
    
    //code for active students
    if(isset($_GET['categoryId'])) {
        $id=$_GET['categoryId'];
        $status=1;
        $sql = "update bookcategory set status=? WHERE categoryId=?";
        $query = $db->prepare($sql);
        $query->bind_param('ii', $status, $id);
        $query->execute();
        header('location:manage_category.php');
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

.overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.7);
  z-index: 999;
  display: none;
}

.popup {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: #fff;
  width: 400px;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
}

.popup .close {
  position: absolute;
  top: 10px;
  right: 10px;
  font-size: 30px;
  font-weight: bold;
  color: #aaa;
  cursor: pointer;
}

.popup .close:hover,
.popup .close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.popup form {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: 100%;
}

label {
  font-weight: bold;
  margin-top: 10px;
}

input[type="text"] {
  padding: 5px;
  border-radius: 3px;
  border: 1px solid #ccc;
}

input[type="radio"] {
  margin-right: 10px;
}

button[type="submit"] {
  padding: 10px;
  background-color:#073f5f;
  color: #fff;
  border: none;
  border-radius: 3px;
  cursor: pointer;
  margin-top: 10px;
}

button[type="submit"]:hover {
  background-color: #008cba;
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
                            <h3>Book Categories</h3>
                            <button id="addBtn">Add New</button>
                                <div id="popup" class="overlay">
                                    <div class="popup">
                                        <h2>Add New Category</h2>
                                        <span class="close" onclick="closeModal();">&times;</span>
    
                                        <form id="addForm" method="post">
                                            <label>Category Name:</label>
                                            <input type="text" id="category" name="category" required><br>
                                            <label>Status</label>
                                            <label>
                                                <input type="radio" name="status" id="status" value="1" checked="checked">Active
                                            </label>
                                            <label>
                                                <input type="radio" name="status" id="status" value="0">Inactive
                                            </label><br>
                                            <button type="submit" name="Create">Create</button>
                                        </form>
                                    </div>
                                </div>


                        </div>

                        

                        <div class="card-body">
                            <div class="table-responsive">
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>Creation Date</th>
                                            <th colspan="2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php 
                                        $sql = "SELECT * FROM bookcategory";
                                        $query = $db->prepare($sql);
                                        $query->execute();
                                        $results = $query->get_result();

                                        $categoryId=1;

                                        if ($results->num_rows > 0) {
                                        while ($result = $results->fetch_assoc()) {
                                        ?>

                
                                        <tr class="odd gradeX">
                                            
                                        <td class="center"><?php echo $result["categoryId"]; ?></td>
                                        <td class="center"><?php echo $result["categoryName"]; ?></td>
                                        <td class="center">
                                            <?php if ($result['status'] == 1) {?>
                                            <a href="manage_category.php?incategoryId=<?php echo $result["categoryId"];?>" onclick="return confirm('Are you sure you want to block this user?');"><i class="fa-solid fa-eye" style='font-size:28px;color:green'></i></a>
                                            <?php } else {?>
                                            <a href="manage_category.php?categoryId=<?php echo $result["categoryId"];?>" onclick="return confirm('Are you sure you want to activate this user?');"><i class="fa-solid fa-eye-slash" style='font-size:28px;color:red'></i></a> 
                                            <?php } ?>
                                            </td>
                                        <td class="center"><?php echo $result["creationDate"]; ?></td>
                                        <td class="center">
                                            <a href="delete-category.php?categoryId=<?php echo $result["categoryId"];?>" onclick="return confirm('Are you sure you want to delete?');"><i class="fas fa-trash"></i></a>
                                            <?php }?>
                                          
                                        </td>
                                            
                                        </tr>
                                        
 <?php $categoryId=$categoryId+1;} ?> 
                                    </tbody>

                                </table>



                            </div>
                               
                        </div>
                   
                    </div>
                </div>
            </div>
</main>      

</div>    

<script src="script.js"></script>
	<script>
        // Get the button that opens the popup model
  var addBtn = document.getElementById("addBtn");

// Get the popup model
var popup = document.getElementById("popup");

// Get the <span> element that closes the popup model
var closeBtn = document.getElementsByClassName("close")[0];

// Function to close the modal
function closeModal() {
  popup.style.display = "none";
}

// When the user clicks the button, open the popup model
addBtn.onclick = function() {
  popup.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
closeBtn.onclick = function() {
  closeModal();
}

// When the user clicks anywhere outside of the popup model, close it
window.onclick = function(event) {
  if (event.target == popup) {
    closeModal();
  }
}
	</script>







 <?php 
include "../footer.php";
?>

<?php }?>