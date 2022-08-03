<?php ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="./home.css">
</head>
<title>Getflix</title>
</head>

<body>
  <div class="warraper">
    <div id="nav">

      <nav class="navbar navbar-expand-lg  navbar-light justify-content-end font-sans-serif m-3">
        <div class="container-fluid shadow-lg fixed-top" style="color:white">
          <a class="navbar-brand me-5 " href="#home-page">
            <h1 class="text-white lh-lg font-sans-serif">SwartzFlix</h1>
          </a>
          <button class="navbar-toggler" style="background-color:#ce682b; color:white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav w-100 justify-content-end ">
              <form class="d-flex m-2" role="search">
                <input class="form-control me-2 w-75" type="search" placeholder="Search" aria-label="Search" id="search">
                <button class="btn btn-outline" style="background-color:#ce682b; color:white; " type="submit">Search</button>
              </form>

              <li class="nav-item m-2 ">
                <button class="btn btn-outline-light  text-center " type="button">
                  <a class="nav-link active san-serif btn btn-outline" style=" background-color:#ce682b;color:white; width:100px" aria-current="page" href="./index.php">home</a>
                </button>
              </li>
              <li class="nav-item m-2">
                <button class="btn btn-outline-light  text-center" type="button">
                  <a class="nav-link san-serif btn btn-outline" style="background-color:#ce682b; color:white; width:100px" aria-current="page" href="./src/text.php">TV-Shows</a>
                </button>
              </li>
              <li class="nav-item san-serif m-2">
                <button class="btn btn-outline-light  text-center" type="button">
                  <a class="nav-link btn btn-outline " style="background-color:#ce682b; color:white; width:100px" aria-current="page" href="./src/text.php">Movies</a>
                </button>
              </li>
              <li class="nav-item san-serif m-2">
                <button class="btn btn-outline-light  text-center" type="button">
                  <a class="nav-link btn btn-outline " style="background-color:#ce682b; color:white; width:100px" aria-current="page" href="/src/login.php">Login</a>
                </button>
              </li>
            </ul>
      </nav>


    </div>


    <main class="flex-shrink-1 bg-image" style="
    background-image: url('../getflixProject/images/neflix background.png');
    height: 400px;
    background-size:100%;
  ">
        <div class="jumbotron m-auto mt-5">

          <h1 class="display-5 text-center p-2">Welcome</h1>
          <p class="lead m-3 text-center">Lorem ipsum, necessitatibus dignissimos quo fugiat vero omnis libero hic cupiditate sapiente consequatur ullam explicabo cum incidunt id?</p>
          <div class="text-center ">
          <button class="btn btn-outline-light text-center" type="button">
            <a class="nav-link active san-serif btn btn-outline   " style=" background-color:#ce682b;color:white; width:100px; padding:10px; " aria-current="page" href="./src/text.php">Gallery</a>
            </buttun>
        </div>



    </main>


  <footer class="footer mt-auto py-3 ">
    <div class="container">
      <div class="row h-25">
        <div class="col-lg-6 col-md-6 col-sm-3">
          <h1>SwartzFlix</h1>

        </div>
        <div class="col-lg-6 col-md-6 col-sm-3">
          <form action="" method="post">
            <input type="email" name="email">
            <input type="submit" value="Subscribe" style="background-color:#ce682b; color:white">
          </form>

          <div class="social-links mt-3 ">
            <a href="#" style="background-color:#ce682b; margin:20px" target="_blank "><i class="fa fa-github " style="color:white"></i></a>
            <a href="#" style="background-color:#ce682b; margin:20px" target="_blank "><i class="fa fa-linkedin " style="color:white"></i></a>
            <a href="#" style="background-color:#ce682b; margin:20px"><i class="fa fa-instagram " target="_blank " style="color:white"></i></a>
            <a href="#" style="background-color:#ce682b; margin:20px" target="_blank "><i class="fa fa-youtube " style="color:white"></i></a>

            <div class="copyright col-lg-12"> &copy; Copyright <strong><span>Getflix</span></strong>. All Rights Reserved </div>
            <div class="credits col-lg-12"> Designed by <a style="color:#ce682b" href="#">getflixgroup</a>
            </div>
          </div>
        </div>
  </footer>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js " integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsp1UyJoMp4YLEuNSfAp+JcXn/tWtIaxVXM " crossorigin="anonymous "></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js "></script>
  <script type="text/javascript " src="https://code.jquery.com/jquery-3.3.1.slim.min.js "></script>
  <script type="text/javascript " src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js "></script>
  <script type="text/javascript " src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js "></script>
</body>

</html>