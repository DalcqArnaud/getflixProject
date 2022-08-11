var CategoriesArray = [];
var CarrouselsArray = [];
var CarrouselsPosArray = [];
var ExtraCategoryNamesArray = ["All", "None"];
var ExtraCategoriesArray = [];
var checkedCount = 0;
var MoviesResults = [];
var moviesCount = 0;
var mediaType = "";

////////////////////////////////////////////// Movie Gallery //////////////////////////////////////////////

var RightGallery = document.getElementById("RightGallery");
const moviesAmountPerGallery = 9;
const moviesAmountPerContainer = 3;

CreateMoviesCarrousel("Popular Tv-shows", "tv");
CreateMoviesCarrousel("Popular Movies", "movie");

function CreateMoviesCarrousel(carrouselName, type){
    mediaType = type;

    var carrouselPos = 0;
    CarrouselsPosArray.push(carrouselPos);
    
    var carrouselDiv = document.createElement("div");
    carrouselDiv.setAttribute("id", "carrouselDiv"+carrouselName);
    RightGallery.appendChild(carrouselDiv);
    CarrouselsArray.push(carrouselDiv);
    
    var carrouselTitle = document.createElement("p");
    carrouselTitle.setAttribute("id", "carrouselTitle"+carrouselName);
    carrouselTitle.textContent = carrouselName;
    carrouselDiv.appendChild(carrouselTitle);

    var carrouselContainer = document.createElement("div");
    carrouselContainer.setAttribute("id", "carrouselContainer");
    carrouselDiv.appendChild(carrouselContainer);
    
    var carrouselLeftBtn = document.createElement("img");
    carrouselLeftBtn.setAttribute("src", "images/carrouselBtn.png");
    carrouselLeftBtn.setAttribute("class", "carrouselBtn");
    carrouselLeftBtn.setAttribute("id", "carrouselLeftBtn");
    carrouselLeftBtn.style.visibility = "hidden";
    carrouselDiv.appendChild(carrouselLeftBtn);
    
    carrouselLeftBtn.addEventListener("click", () => {
        if(CarrouselsPosArray[CarrouselsArray.indexOf(carrouselDiv, 0)] < 0){
            CarrouselsPosArray[CarrouselsArray.indexOf(carrouselDiv, 0)] += 1;
        }
        carrouselContainer.style.transform = "translate("+ CarrouselsPosArray[CarrouselsArray.indexOf(carrouselDiv, 0)] * document.getElementById("movieContainer0").offsetWidth + "px)";
        carrouselContainer.style.transition = "all 0.8s ease";
        UpdateCarrouselBtnDisplay(CarrouselsPosArray[CarrouselsArray.indexOf(carrouselDiv, 0)], carrouselLeftBtn, carrouselRightBtn);
    });
    
    var carrouselRightBtn = document.createElement("img");
    carrouselRightBtn.setAttribute("src", "images/carrouselBtn.png");
    carrouselRightBtn.setAttribute("class", "carrouselBtn");
    carrouselRightBtn.setAttribute("id", "carrouselRightBtn");
    carrouselRightBtn.style.visibility = "hidden";
    carrouselDiv.appendChild(carrouselRightBtn);
    
    carrouselRightBtn.addEventListener("click", () => {
        if(CarrouselsPosArray[CarrouselsArray.indexOf(carrouselDiv, 0)] > -moviesAmountPerContainer + 1){
            CarrouselsPosArray[CarrouselsArray.indexOf(carrouselDiv, 0)] -= 1;
        }
        carrouselContainer.style.transform = "translate("+ CarrouselsPosArray[CarrouselsArray.indexOf(carrouselDiv, 0)] * document.getElementById("movieContainer0").getBoundingClientRect().width + "px)";
        carrouselContainer.style.transition = "all 0.8s ease";
        UpdateCarrouselBtnDisplay(CarrouselsPosArray[CarrouselsArray.indexOf(carrouselDiv, 0)], carrouselLeftBtn, carrouselRightBtn);
    });
    
    var moviesTitlesContainers = [];
    var moviesPostersContainers = [];

    for(let i = 0; i < (moviesAmountPerGallery/moviesAmountPerContainer); i++){
    
        var movieContainer = document.createElement("div");
        movieContainer.setAttribute("class", "movieContainer");
        movieContainer.setAttribute("id", "movieContainer"+ i);
    
        for(let j = 0; j < moviesAmountPerContainer; j++){
            var movieDivContainer = document.createElement("div");
            movieDivContainer.setAttribute("class", "movieDiv");
            movieDivContainer.setAttribute("id", moviesCount);
            movieContainer.appendChild(movieDivContainer);

            movieDivContainer.addEventListener("click", (e) => {
                var movieDetails = MoviesResults[e.currentTarget.getAttribute("id")];
                if(e.currentTarget.getAttribute("id") >= moviesAmountPerGallery){
                    mediaType = "movie";
                }
                else{
                    mediaType = "tv";
                }

                localStorage.setItem("mediaType", mediaType);
                localStorage.setItem("movieId", movieDetails.id);
                window.location.href = "movieDetails.php";
            });
            
            var movieTitleContainer = document.createElement("p");
            moviesTitlesContainers.push(movieTitleContainer);
            movieDivContainer.appendChild(movieTitleContainer);
            
            var moviePosterContainer = document.createElement("img");
            moviesPostersContainers.push(moviePosterContainer);
            movieDivContainer.appendChild(moviePosterContainer);
            moviesCount++;
        }
        carrouselContainer.appendChild(movieContainer);
    }

    carrouselDiv.style.height = document.getElementById("movieContainer0").offsetHeight;
    
    UpdateCarrouselBtnDisplay(carrouselPos, carrouselLeftBtn, carrouselRightBtn);
    //GetMovies("https://api.themoviedb.org/3/tv/latest?api_key=f088ebb3ea3afd9640eb95267cc47330&language=en-US", moviesTitlesContainers, moviesPostersContainers);
    GetMovies("https://api.themoviedb.org/3/"+ mediaType +"/popular?api_key=f088ebb3ea3afd9640eb95267cc47330&language=en-US&page=1", moviesTitlesContainers, moviesPostersContainers, mediaType);
}


function GetMovies(urlString, titlesContainers, postersContainers, type){
    fetch(urlString)
    .then(response => {
        return response.json();
    })
    .then(movies => {
        //console.log(movies);
        
        for(let i = 0; i < moviesAmountPerGallery; i++){
            MoviesResults.push(movies.results[i]);
        }
        
        UpdateMovies(moviesAmountPerGallery, titlesContainers, postersContainers, movies, type);
    });
}

function UpdateMovies(movieAmount, movieTitles, moviePosters, newMoviesList, type){
    for(let i = 0; i < movieAmount; i++){
        if(type == "movie"){
            if(newMoviesList.results[i].title != null){
                movieTitles[i].innerText = newMoviesList.results[i].title;
                moviePosters[i].setAttribute("alt", newMoviesList.results[i].title);
            }
            else{
                movieTitles[i].innerText = "Undefined";
                moviePosters[i].setAttribute("alt", "Undefined");
            }
        }
        else{
            if(newMoviesList.results[i].name != null){
                movieTitles[i].innerText = newMoviesList.results[i].name;
                moviePosters[i].setAttribute("alt", newMoviesList.results[i].name);
            }
            else{
                movieTitles[i].innerText = "Undefined";
                moviePosters[i].setAttribute("alt", "Undefined");
            }
        }
        if(newMoviesList.results[i].backdrop_path != null){
            moviePosters[i].setAttribute("src", "https://image.tmdb.org/t/p/w500/" + newMoviesList.results[i].backdrop_path);
        } 
        else{
            moviePosters[i].setAttribute("src", "images/NotAvailableIcon.png");
        }
    }
}

function UpdateCarrouselBtnDisplay(Pos, leftBtn, rightBtn){
    if(Pos == 0){
        leftBtn.style.visibility = "hidden";
    } else {
        leftBtn.style.visibility = "visible";
    }

    if(Pos == -moviesAmountPerContainer + 1){
        rightBtn.style.visibility = "hidden";
    } else {
        rightBtn.style.visibility = "visible";
    }
}

