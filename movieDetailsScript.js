////////////////////////////////////////////// Movie Details //////////////////////////////////////////////

var mediaType = localStorage.getItem("mediaType");
var id = localStorage.getItem("movieId");
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
        moviePoster.setAttribute("src", "https://image.tmdb.org/t/p/w1280/" + movieDetails.backdrop_path);
    }

    var movieSynopsis = document.getElementById("MovieDetailsSynopsis");
    if(movieDetails.overview == null || movieDetails.overview == ""){
        movieSynopsis.innerHTML = "No Synopsis available :("
    }
    else{
        movieSynopsis.innerHTML = movieDetails.overview;
    }

    var movieBubble = document.getElementById("DotVoteAverage");
    var movieVoteAverage = document.getElementById("MovieDetailsVoteAverage");
    if(movieDetails.vote_average == null){
        movieVoteAverage.textContent = "??";
        movieBubble.style.color = "gray";
    }
    else{
        var roundedVoteAverage = (Math.round(movieDetails.vote_average * 10) / 10).toFixed(1);
        movieVoteAverage.textContent = roundedVoteAverage;  
        if(roundedVoteAverage <= 3.3){
            movieBubble.style.color = "red";
        }else if(roundedVoteAverage > 3.3 && roundedVoteAverage < 6.6){
            movieBubble.style.color = "orange";
        }
        else{
            movieBubble.style.color = "green";
        }
    }

    UpdateMovieTrailer();
}

function UpdateMovieTrailer(){
    fetch("https://api.themoviedb.org/3/"+ mediaType +"/"+ id +"/videos?api_key=f088ebb3ea3afd9640eb95267cc47330&language=en-US")
    .then(response => {
        return response.json();
    })
    .then(videos => {
        var movieTrailer = document.getElementById("MovieDetailsTrailer");
        movieTrailer.setAttribute("src", CheckTrailerAvailability(videos));
    });
}

function CheckTrailerAvailability(videos){
    var isAvailable = false;
    if(videos.results.length > 0){
        for(let i = 0; i < videos.results.length; i++){
            if(videos.results[i].site == "YouTube"){
                isAvailable = true;
                return "https://www.youtube.com/embed/" + videos.results[i].key;
            }
        }
        if(!isAvailable){
            return "https://www.youtube.com/embed/notavailabl";
        }
    }
    else{
        return "https://www.youtube.com/embed/notavailabl";
    }
}