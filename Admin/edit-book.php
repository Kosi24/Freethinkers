<?php
session_start();
include("../inc/database.php");

if (!isset($_SESSION["id"])) {
  header("location:../index.php");
} 
else {
    if(isset($_POST['update'])){
        // retrieve updated book details from form fields
        $bkid = $_POST['bkid'];
        $bookname = $_POST['bookname'];
        $catid = $_POST['catid'];
        $author = $_POST['author'];
        $qty = $_POST['qty'];
        $Track = $_POST['track'];
        
        // update book details in database
        $result = mysqli_query($db, "UPDATE book SET bookname='$bookname', CatId='$catid', author='$author', qty='$qty', track='$Track' WHERE bkid=$bkid");
        
        // redirect to display.php page
        header("Location: display_book.php");
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
    .form-menu1 {
    display: block;
    width: 85%;
    margin: auto;
    /* border: 1px solid #ccc; */
    padding: 20px;
    background-color: #fff;
    /* box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.3); */
    /* padding: 20px; */
    border-radius: 10px;
}
.form-containing form {
    margin: 20px;
    padding: 5px;
    padding-bottom: 100px;
}

 

    .form-group img {
    width: 50%;
    height: 50%;
    margin-top: 0px;
    border-radius: 150px;
    margin-bottom: 10px;
}

    label {
        display: inline-block;
        width: 120px;
        text-align: left;
        font-weight: bold;
        margin-right: 10px;
    }

    input[type="text"],
    select {
        width: 50%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        resize: vertical;
        font-size: 16px;
    }

    button[type="submit"] {
        background-color: #1b96dc;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        float: right;
        margin-right: 100px;
    }

    button[type="submit"]:hover {
        background-color: #0b3a57;
    }

    .form-group {
    width: 45%;
    height: 100%;
    /* display: flex; */
    justify-content: left;
    /* align-items: center; */
    margin-bottom: 15px;
    margin-top: 15px;
    /* border-radius: 100px; */
}

.form-menu2 {
    display: block;
    width: 95%;
    margin-left: 20px;
}

.form-menu2 label {
    width: 15%;
    margin-right: 10px;
}

.form-menu2 input[type="text"], .form-menu2 select {
    width: 70%;
    margin-right: 10px;
}

input[type="text"], select {
    /* width: 50%; */
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
    font-size: 16px;
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
                           
                        <?php if(isset($message)): ?>
                                    <div><?php echo $message; ?></div>
                         <?php endif; ?>


                         <?php
// check if book id is set in URL
if(isset($_GET['bkid'])){
    // retrieve book details from database using book id
    $bkid = $_GET['bkid'];
    $result = mysqli_query($db, "SELECT * FROM book WHERE bkid=$bkid");
    $row = mysqli_fetch_array($result);
}
?>

<!-- display book details in form -->
<form method="post" enctype="multipart/form-data" action="">
    <div class="form-menu1">
        <input type="hidden" name="bkid" value="<?php echo $row['bkid']; ?>">
        <div class="form-group">
            <img src="<?php echo $row['bkimage']; ?>" height="100" width="100" alt="">
        </div>
        <div class="form-menu2">
        <label>ISBN NO:</label>
        <input type="text" name="isbn" value="<?php echo $row['isbn']; ?>" disabled><br><br>
        <label>Books Name:</label>
        <input type="text" name="bookname" value="<?php echo $row['bookname']; ?>"><br><br>
        <label>Books Category:</label>
        <select name="catid">
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
        </select><br><br>
        <label>Author name:</label>
        <input type="text" name="author" value="<?php echo $row['author']; ?>"><br><br>
        <label>Books quantity:</label>
        <input type="text" name="qty" value="<?php echo $row['qty']; ?>"><br><br>
        <label>Track:</label>
        <input type="text" name="track" value="<?php echo $row['track']; ?>"><br><br>
        <button type="submit" name="update">Update</button>
        </div>
    </div>
</form>


					               
                            
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



<?php 
}
?>