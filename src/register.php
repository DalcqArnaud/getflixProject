<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM login WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO login (username, password) VALUES (:username, :password)";
         
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: login.php");
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
    <link rel="stylesheet" href="movie.css">
    <link rel="stylesheet" href="register.css">


</head>

<body>

<div id="nav">

<nav class="navbar navbar-expand-lg  navbar-light justify-content-end font-sans-serif m-3">
            <div class="container-fluid shadow-lg fixed-top" style="color:white">
                <a class="navbar-brand me-5 " href="#home-page">
                    <h1 class="text-white lh-lg font-sans-serif">SwartzFlix</h1>
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

                        <!-- <li class="nav-item san-serif ">
                        <button class="btn btn-outline-light  text-center"  type="button" >
                            <a class="nav-link active san-serif btn btn-outline"  style=" background-color:#ce682b;color:white; width:100px"aria-current="page" href="../index.php">home</a>
</button> </li> -->

                        <li class="nav-item san-serif">
                        <button class="btn btn-outline-light  text-center"  type="button" >
                            <a class="nav-link btn btn-outline " style="background-color:#ce682b; color:white; width:100px" aria-current="page" href="login.php">Login</a>
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

  <div class="avgrund-cover">
            <aside id="default-popup" class="avgrund-popup">
                
                     <div class="regP">
                            <p id="regP">Register</p>
                    </div> 
                  
       <form action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
            
            <div class="first">
                     <label class="UserName" for="UserName">UserName</label><br>
                     <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
					value="<?php echo $username; ?>" placeholder= "User Name" required minlength="4" maxlength="16">
          <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
                       <div class="7"> 
                  <label for="password">Password</label><br>
                 <input class="UserName <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"
					value="<?php echo $password; ?>"  type="password"  name="password" id="password" placeholder="Password" required  ><br>
          <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </div>
             <div class=""> <label for="confirm">Confirm</label><br>
                <input class="userName <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>"
					value="<?php echo $confirm_password; ?>" type="password" name="confirm_password" id="confirm" placeholder="Confirm Password" required ><br>
          <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
        </div>
    
            <div class="submit" >
                 <input type="submit" name="submit" id="submit" value="Submit" placeholder="submit"><br>
            </div>
            <p>Already have an account? <a href="login.php" class="text-white">Login here</a></p>
       </form>
            
       </aside>
    </div>

	
</body>

</html>