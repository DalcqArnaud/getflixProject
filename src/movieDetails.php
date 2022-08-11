<?php
//including the database connection file
include_once("dbconfig.php");

//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result = @mysqli_query($conn, "SELECT * FROM guestbook ORDER BY id DESC"); // using mysqli_query instead
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="movie.css">
  <link rel="stylesheet" href="movieDetailsStyle.css">


  <title>Getflix</title>
  <style >

   p{color:#ce682b; 
 
font-size: 12px;}
   h5{color:white}
   .form{width: 200px;
  height: 480px;}
  /* input{height: 30px;} */
  textarea{height: 50px;}
  .commentBox{
  margin:auto;
width: 400px;}
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
                <a class="nav-link active san-serif btn btn-outline" style=" background-color:#ce682b;color:white; width:100px" aria-current="page" href="./movieGalleryHome.php">home</a>
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
  
  <div id="MovieDetailsDiv">
        <p id="MovieDetailsTitle"></p>
        <div id="MovieDetailsTrailerDiv">
            <div id="MovieDetailsTrailerContainer">
                <iframe id="MovieDetailsTrailer" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div id="MovieDetailsTrailerInfos">
                <div id="MovieDetailsVoteAverageDiv">
                    <p>User Note : <!--<span id="MovieDetailsVoteAverage"></span>--></p>
                    <!-- <i class="fa-solid fa-circle" id="DotVoteAverage"></i> -->
                    <div id="MovieDetailsVoteAverageContainer">
                        <p id="MovieDetailsVoteAverage"></p>
                        <i class="fa-solid fa-star" id="DotVoteAverage"></i>
                    </div>
                </div>
                <p id="MovieDetailsSynopsis"></p>
            </div>
        </div>
        <div id="MovieDetailsPosterContainer">
            <img id="MovieDetailsPoster">
        </div>
    </div>

      

<div class="row d-flex justify-content-center">
		<div class="container-fluid">
			<div class="row">
						<!-- <h2 class=" text-center lh-lg font-monospace ">Comment Page</h2> -->
	
		<div class=" col-lg-6 col-sm-1 mt-lg-3 mt-sm-1 p-2 m-auto w-50 h-25 mb-lg-4">
      
			<form action="./add.php" method="post" id="gb-form" class=" form w-50 border border-1 m-auto">
      <h2 class=" text-center lh-lg font-monospace text-white ">Comment</h2>
					<!-- Name input -->
					<div class=mb-3 id="movie-id">
					<label class=" form-label" style="color:#ce682b" for="movieTitle ">Movie Title</label>
					<input id="text" class="form-control w-75 m-auto" type="text" name="movieTitle" required />

				</div>
				<!-- Name input -->
				<div class=" mb-3 ">
					<label class=" form-label " style="color:#ce682b" for="name ">Name</label>
					<input class="form-control w-75 m-auto" type="text" name="name" required />
				</div>

				<!-- Email address input -->
				<div class="mb-3 ">
					<label class=" form-label  " style="color:#ce682b" for="email">Email</label>
					<input class=" form-control w-75 m-auto" type="text" name="email" required />
				</div>

				<!-- Message input -->
				<div class=" mb-3 ">
					<label class=" form-label  " style="color:#ce682b" for="comment">Comment</label>
					<textarea type="text" class=" form-control w-75 m-auto" rows=" 2" cols="25" name="comment" required style="
			height: 2rem "></textarea>
					<div class=" d-grid ">
						<input class="commentBtn btn btn-lg mt-3 p-2 text-white m-auto  " style="background-color:#ce682b ;width:100px" type="submit" name="Submit" value="Add" />
					</div>
				</div>
				<!-- Form submissions success message -->
				<div class=" d-none " id=" submitSuccessMessage ">
					<div class=" text-center mb-3 ">Form submission successful!</div>
				</div>

			</form>
		</div>
  
		<div class=" col-lg-6 col-sm-1 mt-lg-3 mt-sm-1 p-2  w-50 m-auto border-2 mb-lg-4">
    <div class=" mb-3 ">
    <div class="commentBox" >
              <?php 
        //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 

  
			
        while($res = @mysqli_fetch_array($result)) {         
          
            echo "<p>".$res['name']."</p>";
            // echo "<td>".$res['email']."</td>";
            echo "<p>".$res['comment']."</p>"; 
			      echo "<h5>".$res['movieTitle']."</h5>"; 
						echo "<p>".$res['date']."</p>"; 
						// echo "<p>".$res['movie_id']."</p>" 
				
            // echo "<td><a href=\"update.php?id=$res[id]\">Edit</a> 

            
		
      
     $commentscount ="<p>----------------------------------</p>";

echo  $commentscount  ;    
       
					}
        ?>
    </div>



           
</div>
				</div>

        </div>
        


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