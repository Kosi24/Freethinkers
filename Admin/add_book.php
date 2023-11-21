
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
   </head>

   <style>

    /* Form styles */

.form-menu1 {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  background: #fff;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.form-menu1 .form-group {
  margin-bottom: 20px;
}

.form-group .form-control {
  width: 100%;
  padding: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
}

.form-group select.form-control {
  height: 40px;
}

.form-group textarea.form-control {
  height: 150px;
}

.addbookbtn button {
  display: inline-block;
  padding: 10px 20px;
  margin: 10px;
  border-radius: 5px;
  border: none;
  color: #fff;
  font-size: 16px;
  cursor: pointer;
}

.addbookbtn button.fa-floppy-disk {
  background-color: #4CAF50;
}

.addbookbtn button.fa-plus-circle {
  background-color: #2196F3;
}

.addbookbtn button.fa-trash-can {
  background-color: #f44336;
}

.addbookbtn button:hover {
  opacity: 0.8;
}



   </style>
<body>

<?php  include("admin_sidebar.php");
    include("admin_header.php");
?>

    <main>
            <div class="model">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h3>Add Books</h3>
                            <button >see all <span class="">
                            </span></button>
                        </div>

                        <div class="card-body">
                                <div class="form-containing">
                                <?php if(isset($message)): ?>
                                    <div><?php echo $message; ?></div>
                                <?php endif; ?>
					                <form  method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                           
                               

                                        <div class="form-menu1">
                                        <div class="form-group">
                                                
                                                <input class="form-control" type="text" name="isbn"  required="required" placeholder="ISBN Number" autocomplete="off"  />
                                            </div>

                                            <div class="form-group">
                                            <label> Category</label><br>
                                            <select class="form-control" name="category" required="required">
                                                <option value=""> Select Category</option>
                                                <?php
                                                    $status = 1;
                                                    $sql = "SELECT * FROM bookcategory WHERE status=?";
                                                    $query = $db->prepare($sql);
                                                    $query->bind_param("i", $status);
                                                    $query->execute();
                                                    $results = $query->get_result()->fetch_all(MYSQLI_ASSOC);
                                                    $cnt=1;
                                                    if(!empty($results))
                                                        {
                                                            foreach($results as $result)
                                                            {
                                                         ?>
                                                    <option value="<?php echo htmlentities($result['categoryId']);?>"><?php echo htmlentities($result['categoryName']);?></option>
                                                    
                                                    <?php
                                                         }
                                                            }
                                                                 ?>
                                            </select>
                                            </div>

                                          

                                            <div class="form-group">
                                                
                                                <input class="form-control" type="text" name="bookname" placeholder="Book Title" autocomplete="off"  required />
                                            </div>

                                            <div class="form-group">
                                                
                                                <input class="form-control" type="text" name="author" placeholder="Author of Book" autocomplete="off"  />
                                            </div>

                                            <div class="form-group">
                                               
                                                <input class="form-control" type="number" name="qty" placeholder="Book Quantity" autocomplete="off"  required />
                                            </div>

                                            <div class="form-group">
                                               
                                                <input class="form-control" type="number" name="Available" placeholder="Available books" autocomplete="off"  required />
                                            </div>

                                            <div class="form-group">
                                                <label>Track</label><br>
                                                <input class="form-control" type="text" name="track" placeholder="Shell No" required/>
                                                
                                            </div>

                                           
                                            <div class="form-group">
                                                <label>Books image</label><br>
                                                <input class="form-control" type="file" name="img"  placeholder="Book Quantity" required="required" autocomplete="off"  />
                                            </div>
                                      

                                            <div class="form-group">
                                                <label>Books file<span style="color:red;">*</span></label><br>
                                                <input class="form-control" type="file" name="file"  autocomplete="off"  />
                        
                                            </div>

                                            <div class="form-group">
                                                <label>Description</label><br>
                                                <textarea class="form-control" type="text" name="describe" placeholder="About the Book" autocomplete="off"   ></textarea>
                                            </div>

                                            <div class="addbookbtn">
                                            <button type="submit" name="add" class="fa-solid fa-floppy-disk">Save </button> &nbsp;
                                            <button type="submit" name="addnew" class="fa fa-plus-circle">Save & Add New Book </button> &nbsp;
                                            <button type="reset" name="reset" class="fa-solid fa-trash-can">Clear Form </button>
                                             </div>

                 

                                        </div>
                                    </form>  
                            
				                </div>	
                                
                        </div>
                   
                    </div>
                </div>
            </div>
   
<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Check if form is submitted
if(isset($_POST['add']) || isset($_POST['addnew'])) {

    // Establish database connection
    $db = mysqli_connect("localhost", "root", "", "book_inforce");
    
    // Get form data
    $isbn = $_POST['isbn'];
    $category = $_POST['category'];
    $bookname = $_POST['bookname'];
    $author = $_POST['author'];
    $qty = $_POST['qty'];
    $Available = $_POST['Available'];
    $Track = $_POST['track'];
    $Description = mysqli_real_escape_string($db, $_POST['describe']);

    // File upload configuration
    $targetDir1 = "books-image/"; //books_image
    $targetDir2 = "books-file/";
    $imageName = basename($_FILES["img"]["name"]);
    $fileName = basename($_FILES["file"]["name"]);
    $imagePath = $targetDir1 . $imageName;
    $filepath = $targetDir2 . $fileName;
    $imageType = pathinfo($imagePath,PATHINFO_EXTENSION);
    $fileType = pathinfo($filepath,PATHINFO_EXTENSION);

    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');

    // Validate form data
    if(empty($isbn) || empty($category) || empty($bookname) || empty($qty) || empty($Available) ||empty($fileName)) {
        $message = "Please fill all required fields.";
    } elseif(!in_array($imageType, $allowTypes) || !in_array($fileType, $allowTypes)){
        $message = "Only JPG, JPEG, PNG, GIF, & PDF files are allowed.";
    } else {

        // Upload file to server
        if(move_uploaded_file($_FILES["img"]["tmp_name"], $imagePath) && move_uploaded_file($_FILES["file"]["tmp_name"], $filepath)) {

            // // Insert data into database
            // $sql ="INSERT INTO book(isbn,CatId,bookname,author,qty,Available,track,`describe`,bkimage,bkfile) VALUES (?,?,?,?,?,?,?,?,?,?)";
            // $query = $db->prepare($sql);

            // $query->bind_param('sissssssss', $isbn, $category, $bookname, $author, $qty, $Available, $Track, $Description, $imagePath, $filepath);

            mysqli_query($db, "insert into book values('','$_POST[isbn]','$_POST[CatId]','$_POST[bookname]','$_POST[author]','$_POST[qty]','$_POST[Available]','$_POST[track]','$_POST[describe]','$imagepath','$filepath')");
            $query = $db->prepare($sql);


            if($query->execute()) {
                $message = "Data inserted successfully.";
            } else {
                $message = "Error: " . $sql . "<br>" . $db->error;
            }
                // Redirect to display.php page if Add button is clicked
            if(isset($_POST['add'])) { ?>
                <script type="text/javascript">
                    window.location="display_book.php";
                </script>
                <?php
            } 
        

            // Display success message and form to add another book if Add & New button is clicked
            if(isset($_POST['addnew'])) {
                $success_message = "Data inserted successfully , You can add another book.";
                $isbn = "";
                $category = "";
                $bookname = "";
                $author = "";
                $qty = "";
                $Available ="";
                $Track = "";
                $Description = "";
            }

        } else {
            $message = "Sorry, there was an error uploading your files.";
        }
       
        }
    // Close database connection
mysqli_close($db);
}
}

?>


       
            </main>        
</div>    



 


 
 
 <?php 
include "../footer.php";
?>

<?php }?>            
