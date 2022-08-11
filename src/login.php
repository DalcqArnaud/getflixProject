<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM login WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["id"];
                        $username = $row["username"];
                        $hashed_password = $row["password"];
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: welcome.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Close connection
    unset($pdo);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <script src="nav2.js"></script> -->
    <link rel="stylesheet" href="login.css">
  

  

</head>

<body>
<div id="nav">

<nav class="navbar navbar-expand-lg  navbar-light justify-content-end font-sans-serif m-3">
            <div class="container-fluid shadow-lg fixed-top" style="color:white">
                <a class="navbar-brand me-5 " href="#home-page">
                    <h1 class="text-white lh-lg font-sans-serif" >Getflix</h1>
                </a>
                <button class="navbar-toggler"  style="background-color:#ce682b; color:white"type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- <form class="d-flex" role="search">
        <input class="form-control me-2" style="margin: auto" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline" style="background-color:#ce682b; color:white;" type="submit">Search</button>
      </form> -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- <form class="d-flex me-5" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline" style="background-color:#ce682b; color:white; " type="submit">Search</button>
      </form> -->
                    <ul class="navbar-nav w-100 justify-content-end m-2">
                    <!-- <form class="d-flex" role="search" id="form" >
        <input class="form-control me-2 w-75" type="search" placeholder="Search" aria-label="Search" id="search">
        <button class="btn btn-outline" style="background-color:#ce682b; color:white; " type="submit">Search</button>
      </form> -->
<!-- 
                        <li class="nav-item san-serif ">
                        <button class="btn btn-outline-light  text-center"  type="button" >
                            <a class="nav-link active san-serif btn btn-outline"  style=" background-color:#ce682b;color:white; width:100px"aria-current="page" href="../index.php">home</a>
</button> </li> -->

                        <li class="nav-item san-serif">
                        <button class="btn btn-outline-light  text-center"  type="button" >
                            <a class="nav-link btn btn-outline " style="background-color:#ce682b; color:white; width:100px" aria-current="page" href="register.php">Sign-Up</a>
</button>   </li>
                    </ul>
        </nav>

<!-- <nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li> -->
        <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li> -->
        <!-- <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
      </ul> -->
      <!-- <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form> -->


    <!-- </div>
  </div>
</nav> -->
  </div>


		<?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>
 <div class="avgrund-cover">
            <aside id="default-popup" class="avgrund-popup">
                
<form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="regP">
                        <p id="regP">Login</p>
                    </div> 
                    
                    <div class="">    
                        <label id="username" class="username" for="username">User name</label><br>
                        <input  type="username" name="username" id="username" placeholder="username" required  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2, 4}$" 
                        class="username <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
					value="<?php echo $username; ?>"><br>
          <span class="invalid-feedback"><?php echo $username_err; ?></span>
                    </div> </br>

                    <div class=""> 
                        <label for="password">Password</label><br>
                        <input class="password <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" type="password"  name="password" id="password" placeholder="Password" required  >
                        <span class="invalid-feedback"><?php echo $password_err; ?></span><br>
                        </br>
                    </div></br></br>

                    <div class="center" >
                        <input class="subtn" type="submit" name="submit" id="submit" value="Submit" placeholder="submit"><br>
               

                        <p>Don't have an account?<span><a href="register.php">Sign up now.</a></span></p>
                        </div>
                    
                </form>
                
            </aside>
        </div>



	</div>
    <div>
</body>

</html>