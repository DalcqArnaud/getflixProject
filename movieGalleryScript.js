var CategoriesArray = [];
var CarrouselsArray = [];

////////////////////////////////////////////// Fetch Movie Genres //////////////////////////////////////////////

GetMovieGenres();

function GetMovieGenres(){
    fetch("https://api.themoviedb.org/3/genre/movie/list?api_key=f088ebb3ea3afd9640eb95267cc47330&language=en-US")
        .then(response => {
            return response.json();
        })
        .then(genres => {
            for(let i = 0; i < genres.genres.length; i++){
                CreateMoviesCarrousel(genres.genres[i]);
                CreateCategory(genres.genres[i].name);
            }
        });
}

////////////////////////////////////////////// Categories //////////////////////////////////////////////

function CreateCategory(categoryName){
    var categoriesList = document.getElementById("categoriesList");

    var categoryListItem = document.createElement("li");

    var categoryDiv = document.createElement("div");
    
    var categoryInput = document.createElement("input");
    categoryInput.setAttribute("type", "checkbox");
    categoryInput.setAttribute("id", "checkbox"+categoryName);
    categoryInput.setAttribute("name", "checkbox"+categoryName);
    categoryInput.setAttribute("checked", "true");
    CategoriesArray.push(categoryInput);

    categoryInput.addEventListener("change", (event) => {
        if(event.currentTarget.checked){
            CarrouselsArray[CategoriesArray.indexOf(categoryInput, 0)].style.display = "block";
            CarrouselsArray[CategoriesArray.indexOf(categoryInput, 0)].setAttribute("class", "appear");
            // setTimeout(() => {
            // }, 500);
        } else {
            CarrouselsArray[CategoriesArray.indexOf(categoryInput, 0)].setAttribute("class", "disappear");
            setTimeout(() => {
                CarrouselsArray[CategoriesArray.indexOf(categoryInput, 0)].style.display = "none";
            }, 500);
        }
    });
    
    var categoryLabel = document.createElement("label");
    categoryLabel.setAttribute("for", "checkbox"+categoryName);
    categoryLabel.textContent = " "+ categoryName;
    
    categoryDiv.appendChild(categoryInput);
    categoryDiv.appendChild(categoryLabel);

    categoryListItem.appendChild(categoryDiv);
    categoriesList.appendChild(categoryListItem);
    
}

////////////////////////////////////////////// Movie Gallery //////////////////////////////////////////////

var RightGallery = document.getElementById("RightGallery");
const moviesAmountPerGallery = 9;
const moviesAmountPerContainer = 3;

function CreateMoviesCarrousel(genre){
    var carrouselPos = 0;
    
    var carrouselDiv = document.createElement("div");
    carrouselDiv.setAttribute("id", "carrouselDiv"+genre.name);
    RightGallery.appendChild(carrouselDiv);
    CarrouselsArray.push(carrouselDiv);
    
    var carrouselTitle = document.createElement("p");
    carrouselTitle.setAttribute("id", "carrouselTitle"+genre.name);
    carrouselTitle.textContent = genre.name;
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
        if(carrouselPos < 0){
            carrouselPos++;
        }
        carrouselContainer.style.transform = "translate("+ carrouselPos * document.getElementById("movieContainer0").offsetWidth + "px)";
        carrouselContainer.style.transition = "all 0.8s ease";
        UpdateCarrouselBtnDisplay(carrouselPos, carrouselLeftBtn, carrouselRightBtn);
    });
    
    var carrouselRightBtn = document.createElement("img");
    carrouselRightBtn.setAttribute("src", "images/carrouselBtn.png");
    carrouselRightBtn.setAttribute("class", "carrouselBtn");
    carrouselRightBtn.setAttribute("id", "carrouselRightBtn");
    carrouselRightBtn.style.visibility = "hidden";
    carrouselDiv.appendChild(carrouselRightBtn);
    
    carrouselRightBtn.addEventListener("click", () => {
        if(carrouselPos > -moviesAmountPerContainer + 1){
            carrouselPos--;
        }
        carrouselContainer.style.transform = "translate("+ carrouselPos * document.getElementById("movieContainer0").getBoundingClientRect().width + "px)";
        carrouselContainer.style.transition = "all 0.8s ease";
        UpdateCarrouselBtnDisplay(carrouselPos, carrouselLeftBtn, carrouselRightBtn);
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
            
            var movieTitleContainer = document.createElement("p");
            moviesTitlesContainers.push(movieTitleContainer);
            movieDivContainer.appendChild(movieTitleContainer);
            
            var moviePosterContainer = document.createElement("img");
            moviesPostersContainers.push(moviePosterContainer);
            movieDivContainer.appendChild(moviePosterContainer);
            
            movieContainer.appendChild(movieDivContainer);
        }
    
        carrouselContainer.appendChild(movieContainer);
    }
    
    carrouselDiv.style.height = document.getElementById("movieContainer0").offsetHeight;
    
    UpdateCarrouselBtnDisplay(carrouselPos, carrouselLeftBtn, carrouselRightBtn);
    
    //https://api.themoviedb.org/3/genre/movie/list?api_key=f088ebb3ea3afd9640eb95267cc47330&language=en-US
    //GetMovies("https://api.themoviedb.org/3/movie/popular?api_key=f088ebb3ea3afd9640eb95267cc47330&language=en-US&page=1", moviesTitlesContainers, moviesPostersContainers);
    //console.log(genre);
    GetMovies("https://api.themoviedb.org/3/discover/movie?api_key=f088ebb3ea3afd9640eb95267cc47330&with_genres="+genre.id+"&language=en-US", moviesTitlesContainers, moviesPostersContainers);
}


function GetMovies(urlString, titlesContainers, postersContainers){
    fetch(urlString)
    .then(response => {
        return response.json();
    })
    .then(movies => {
        //console.log(movies);
        UpdateMovies(moviesAmountPerGallery, titlesContainers, postersContainers, movies);
    });
}

function UpdateMovies(movieAmount, movieTitles, moviePosters, newMoviesList){
    for(let i = 0; i < movieAmount; i++){
        movieTitles[i].innerText = newMoviesList.results[i].title;
        moviePosters[i].setAttribute("src", "https://image.tmdb.org/t/p/w500/" + newMoviesList.results[i].backdrop_path);
        moviePosters[i].setAttribute("alt", newMoviesList.results[i].title);
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