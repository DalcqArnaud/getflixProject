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
    <title>SwartzFlix</title>

  

</head>

<body>
  <div id="nav">

    <nav class="navbar navbar-expand-lg  navbar-light justify-content-end font-sans-serif m-3">
            <div class="container-fluid shadow-lg fixed-top" style="color:white">
                <!-- <a class="navbar-brand me-5 " href="../index.php">
                    <h1 class="text-white lh-lg font-sans-serif" >SwartzFlix</h1>
                </a> -->
                <a class="navbar-brand me-5 " style="padding-left: 20px;text-shadow: -6px 8px 0px #CE5937;"; href="../index.php">
                  <h1 class="text-white lh-lg font-sans-serif" id="logo1" style="text-shadow: -3px 6px 0px #CE5937;">SwartzFlix</h1>
                </a> 
                <button class="navbar-toggler"  style="background-color:#ce682b; color:white"type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  
          <span class="navbar-toggler-icon"></span>
        </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav w-100 justify-content-end m-2">


                        <li class="nav-item san-serif">
                        <button class="btn btn-outline-light  text-center"  type="button" >
                            <a class="nav-link btn btn-outline " style="background-color:#ce682b; color:white; width:100px" aria-current="page" href="register.php">Sign-Up</a>
          </button>   </li>
                    </ul>
    </nav>
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
                    
                    <div class="center">    
                        <label id="username" class="username" for="username">Username</label><br>
                        <input  type="username" name="username" id="username" placeholder="Username" required  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2, 4}$" 
                        class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
					value="<?php echo $username; ?>"><br>
          <span class="invalid-feedback"><?php echo $username_err; ?></span>
                    </div> </br>

                    <div class="center"> 
                        <label for="password">Password</label><br>
                        <input class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" type="password"  name="password" id="password" placeholder="Password" required  >
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