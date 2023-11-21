<div class="home-section">
<header>
          <h2>
            <div class="home-content">
              <i class='fas fa-bars' ></i>
              <span class="text"> Dashboard</span>
            </div>
          </h2>

          <div class="search-wrapper">
                <form action="book_list.php" method="post" >
                    <span class="fa fa-search"></span>
                    <input type="search" placeholder="Search Books" name="search" required/>
                </form>
                
            </div>

            <div class="user-wrapper">
            <?php
              $res = mysqli_query($db, "select * from user where userid='".$_SESSION['id']."'");
              while ($row = mysqli_fetch_array($res)){
              echo '<img src="'.$row["photo"].'" width="40px" height="40px" alt="">';
              echo '<div>';
              echo '<h4 class="username">'.$row["username"].'</h4>';
              echo '<small class="type">'.$row["occupation"].'</small>';
              echo '</div>';
              }
            ?>
            </div> 


           


    </header>