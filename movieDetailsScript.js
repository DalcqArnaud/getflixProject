////////////////////////////////////////////// Movie Details //////////////////////////////////////////////

var mediaType = localStorage.getItem("mediaType");
var id = localStorage.getItem("movieId");
console.log(mediaType);
GetMovieDetails(id);

function GetMovieDetails(movieId){
    fetch("https://api.themoviedb.org/3/"+ mediaType +"/"+ movieId +"?api_key=f088ebb3ea3afd9640eb95267cc47330&language=en-US")
        .then(response => {
            return response.json();
        })
        .then(movieDetails => {
            UpdateMovieDetails(movieDetails);
        });
}

function UpdateMovieDetails(movieDetails){
    
    var movieTitle = document.getElementById("MovieDetailsTitle");
    if(mediaType == "movie"){
        if(movieDetails.title == null || movieDetails.title == ""){
            movieTitle.innerHTML = "Undefined";
        } 
        else {
            movieTitle.innerHTML = movieDetails.title;
        }
    }
    else{
        if(movieDetails.name == null || movieDetails.name == ""){
            movieTitle.innerHTML = "Undefined";
        }
        else{
            movieTitle.innerHTML = movieDetails.name;
        }
    }
    
    var moviePoster = document.getElementById("MovieDetailsPoster");
    if(movieDetails.backdrop_path == null){
        moviePoster.setAttribute("src", "images/NotAvailableIcon.png");
    }
    else{
        moviePoster.setAttribute("src", "https://image.tmdb.org/t/p/w500/" + movieDetails.backdrop_path);
    }

    var movieSynopsis = document.getElementById("MovieDetailsSynopsis");
    if(movieDetails.overview == null || movieDetails.overview == ""){
        movieSynopsis.innerHTML = "No Synopsis available :("
    }
    else{
        movieSynopsis.innerHTML = movieDetails.overview;
    }

    var movieVoteAverage = document.getElementById("MovieDetailsVoteAverage");
    if(movieDetails.vote_average == null){
        movieVoteAverage.textContent = "??";
    }
    else{
        var roundedVoteAverage = (Math.round(movieDetails.vote_average * 10) / 10).toFixed(1);
        movieVoteAverage.textContent = roundedVoteAverage;    
    }


//     console.log(movieDetails.id);
//     fetch("https://api.themoviedb.org/3/movie/"+ movieDetails.id +"/videos?api_key=f088ebb3ea3afd9640eb95267cc47330&language=en-US")
//     .then(response => {
//         return response.json();
//     })
//     .then(videos => {
//         console.log(videos);
//     });
    
    
}