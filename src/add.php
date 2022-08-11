<html>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="movie.css">
  <link rel="stylesheet" href="movieDetailsStyle.css">
	<title>Add Data</title>
	<style>
	h1 {
		text-align: center;
		margin-top: 100px;
		font-family: 'Courier New', Courier, monospace;
	}

	h3 {
		text-align: center;
		font-family: 'Courier New', Courier, monospace;
	}

	a {
		text-decoration: none;
	}



	span {
		color: #ffbb33;
		font-size: 20px;
	}
	</style>
</head>

<body>

<div id="nav">

<nav class="navbar navbar-expand-lg  navbar-light justify-content-end font-sans-serif m-3">
  <div class="container-fluid shadow-lg fixed-top" style="color:white">
	<a class="navbar-brand me-5 " href="#home-page">
	  <h1 class="text-white lh-lg font-sans-serif" >SwartzFlix</h1>
	</a>
	<button class="navbar-toggler" style="background-color:#ce682b; color:white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

	  <span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">

	  <ul class="navbar-nav w-100 justify-content-end m-2">
		<form class="d-flex" role="search" id="form">
		  <input class="form-control me-2 w-75" type="search" placeholder="Search" aria-label="Search" id="search">
		  <button class="btn btn-outline" style="background-color:#ce682b; color:white; " type="submit">Search</button>
		</form>

		<li class="nav-item ">
		  <button class="btn btn-outline-light  text-center" type="button">
			<a class="nav-link active san-serif btn btn-outline" style=" background-color:#ce682b;color:white; width:100px" aria-current="page" href="index.php">home</a>
		</li>
		</button>
		<li class="nav-item">
		  <button class="btn btn-outline-light  text-center" type="button">
			<a class="nav-link san-serif btn btn-outline" style="background-color:#ce682b; color:white; width:100px" aria-current="page" href="tvshow.php">TV-Shows</a>
		  </button>
		</li>
		<li class="nav-item san-serif">
		  <button class="btn btn-outline-light  text-center" type="button">
			<a class="nav-link btn btn-outline " style="background-color:#ce682b; color:white; width:100px" aria-current="page" href="movie.php">Movies</a>
		  </button>
		</li>
		<li class="nav-item san-serif">
		  <button class="btn btn-outline-light  text-center" type="button">
			<a class="nav-link btn btn-outline " style="background-color:#ce682b; color:white; width:100px" aria-current="page" href="logout.php">Logout</a>
		  </button>
		</li>
	  </ul>
</nav>


</div>
	<?php //including the database connection file
	include_once("dbconfig.php");

	if(isset($_POST['Submit'])) {
		$name=$_POST['name'];
		$email=$_POST['email'];
		$comment=$_POST['comment'];
		$movieTitle=$_POST['movieTitle'];
		


		// checking empty fields
		if(empty($name) || empty($email) || empty($comment) || empty($movieTitle) ) {
			if(empty($name)) {
				echo "<font color='red'>Name field is empty.</font><br/>";
			}

			if(empty($email)) {
				echo "<font color='red'>email field is empty.</font><br/>";
			}

			if(empty($comment)) {
				echo "<font color='red'>comment field is empty.</font><br/>";
			}
			
			if(empty($movieTitle)) {
				echo "<font color='red'>moveTitle is empty.</font><br/>";
			}
		
			echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
		}

		else {
			// if all the fields are filled (not empty)             
			//insert data to database
			$result=mysqli_query($conn, "INSERT INTO guestbook(name,email,comment,movieTitle) VALUES('$name','$email','$comment','$movieTitle')");

			//display success message
			echo "<font color='#ffbb33'><h1>Thank you for your Comment</h1>.
			";
			echo "<a href='movieDetails.php'><font color='black'><h3>back to movie Page? <span>Click here</span></h3></a>";
		}
	}

	?>

<script src="./movie.js"></script>
    <script src="./movieDetailsScript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js " integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsp1UyJoMp4YLEuNSfAp+JcXn/tWtIaxVXM " crossorigin="anonymous "></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js "></script>
    <script src="https://kit.fontawesome.com/3daa86828a.js" crossorigin="anonymous"></script>  

    <script type="text/javascript " src="https://code.jquery.com/jquery-3.3.1.slim.min.js "></script>
    <script type="text/javascript " src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js "></script>
    <script type="text/javascript " src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js "></script>
	
</body>

</html>