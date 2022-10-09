<nav class="navbar">
        <div class="brand"><a href="index.php" style="text-decoration:none;color:#1746A2;">Chello<a></div>

        <a href="#" class="toggle-button">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </a>

        <div class="r-nav">

            <ul>
                <?php  if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in']!=true){
            echo '
                <a class="nav-link " href="login.php">Login</a>';}
            else{
                if($_SESSION['role']=='employer'){
                echo '<li class="nav-item drop"> <div class="dropdown" ><button class="dropbtn notranslate">'.$_SESSION['username'].'▼</button>
              <div class="dropdown-content"><a class="nav-link" href="user-details.php">Profile</a><a class="nav-link" href="manage-employees.php">Dashboard</a><a class="nav-link" href="logout.php">Logout</a></div>
              </div></li>';
              }
              else{
                echo '<li class="nav-item drop"> <div class="dropdown" ><button class="dropbtn notranslate">'.$_SESSION['username'].'▼</button>
              <div class="dropdown-content"><a class="nav-link" href="user-details.php">Profile</a><a class="nav-link" href="task.php">Dashboard</a><a class="nav-link" href="logout.php">Logout</a></div>
              </div></li>';
              }
            }
            ?>
            </ul>

        </div>
</nav>