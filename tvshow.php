<?php ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="movie.css">
  <link rel="stylesheet" href="movieGalleryStyle.css">
  <link rel="stylesheet" href="filters.css" 

  <title>SwartzFlix</title>
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
              <input class="form-control me-2 w-75" type="search" placeholder='search'>

              <a class="nav-link btn btn-outline " style="color:#ce682b;padding:10px; text-decoration: none; font-weight: bold;  display: inline;" aria-current="page" href="index.php" type="submit">search</a>
            </li>
            </form>

            <li class="nav-item">
         
                <a class="nav-link btn btn-outline " style="color:#ce682b;padding:10px; text-decoration: none; font-weight: bold;  display: inline;" aria-current="page" href="index.php">home</a>
            </li>
            
            <li class="nav-item">
         
                <a class="nav-link btn btn-outline" style="color:#ce682b;padding:10px; text-decoration: none; font-weight: bold;  display: inline;" aria-current="page"" href="tvshow.php">TV-Shows</a>
              
            </li>
            <li class="nav-item">
         
                <a class="nav-link btn btn-outline " style="color:#ce682b;padding:10px; text-decoration: none; font-weight: bold;  display: inline;" aria-current="page" href="movie.php">Movies</a>
              
            </li>
            <li class="nav-item">
         
                <a class="nav-link btn btn-outline "style="color:#ce682b;padding:10px; text-decoration: none; font-weight: bold;  display: inline;" aria-current="page" href="logout.php">Logout</a>
              
            </li>
          </ul>
    </nav>


  </div>
  
  <div id="GalleryDiv">
        <div id="LeftGallery">
            <div id="categoriesDiv">
                <ul id="categoriesList"><span id="categoriesListTitle">Filters</span>
                </ul>
            </div>
        </div>
        <div id="RightGallery"></div>
    </div>
    
  <script src="./tvshow.js"></script>
  <script src="movieGalleryScript.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js " integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsp1UyJoMp4YLEuNSfAp+JcXn/tWtIaxVXM " crossorigin="anonymous "></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js "></script>

  <script type="text/javascript " src="https://code.jquery.com/jquery-3.3.1.slim.min.js "></script>
  <script type="text/javascript " src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js "></script>
  <script type="text/javascript " src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js "></script>
</body>

</html>