var CategoriesArray = [];
var CarrouselsArray = [];
var CarrouselsPosArray = [];
var ExtraCategoryNamesArray = ["All", "None"];
var ExtraCategoriesArray = [];
var checkedCount = 0;
var MoviesResults = [];
var moviesCount = 0;

////////////////////////////////////////////// Fetch Movie Genres //////////////////////////////////////////////

GetMovieGenres();

function GetMovieGenres(){
    fetch("https://api.themoviedb.org/3/genre/movie/list?api_key=f088ebb3ea3afd9640eb95267cc47330&language=en-US")
        .then(response => {
            return response.json();
        })
        .then(genres => {
            CreateExtraCategory(ExtraCategoryNamesArray);
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
            UpdateCategories(CategoriesArray.indexOf(categoryInput, 0), true);
            checkedCount++;
            UpdateExtraCategories(ExtraCategoriesArray);
        } else {
            UpdateCategories(CategoriesArray.indexOf(categoryInput, 0), false);
            checkedCount--;
            UpdateExtraCategories(ExtraCategoriesArray);
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

function CreateExtraCategory(extraCategoryNames){
    var categoriesList = document.getElementById("categoriesList");

    var categoryListItem = document.createElement("li");
    categoryListItem.setAttribute("id", "extraCategoryLi")

    for(let i = 0; i < extraCategoryNames.length; i++){
        var categoryDiv = document.createElement("div");
        
        var categoryInput = document.createElement("input");
        categoryInput.setAttribute("type", "checkbox");
        categoryInput.setAttribute("id", "checkbox"+extraCategoryNames[i]);
        categoryInput.setAttribute("name", "checkbox"+extraCategoryNames[i]);
        if(i == 0){
            categoryInput.setAttribute("checked", "true");
            categoryInput.addEventListener("change", (event) => {
                if(event.currentTarget.checked){
                    checkedCount = 0;
                    UpdateExtraCategories(ExtraCategoriesArray);
                    CategoriesArray.forEach((element, index) => {
                        element.checked = true;
                        UpdateCategories(index, true);
                    });
                }
            });
        }
        else{
            categoryInput.addEventListener("change", (event) => {
                if(event.currentTarget.checked){
                    checkedCount = -CategoriesArray.length;
                    UpdateExtraCategories(ExtraCategoriesArray);
                    CategoriesArray.forEach((element, index) => {
                        element.checked = false;
                        UpdateCategories(index, false);
                    });
                }
            });
        }

        ExtraCategoriesArray.push(categoryInput);
        
        var categoryLabel = document.createElement("label");
        categoryLabel.setAttribute("for", "checkbox"+extraCategoryNames[i]);
        categoryLabel.textContent = " "+ extraCategoryNames[i];
        
        categoryDiv.appendChild(categoryInput);
        categoryDiv.appendChild(categoryLabel);
    
        categoryListItem.appendChild(categoryDiv);
    }
    categoriesList.appendChild(categoryListItem);
}

function UpdateCategories(categoryIndex, appear){
    if(appear){
        CarrouselsArray[categoryIndex].style.display = "block";
        CarrouselsArray[categoryIndex].setAttribute("class", "appear");
    }
    else {
        CarrouselsArray[categoryIndex].setAttribute("class", "disappear");
        setTimeout(() => {
            CarrouselsArray[categoryIndex].style.display = "none";
        }, 500);
    }
}

function UpdateExtraCategories(ExtraCategoryCheckboxes){
    if(checkedCount == 0){
        ExtraCategoryCheckboxes[0].checked = true;
    }
    else{
        ExtraCategoryCheckboxes[0].checked = false;
    }

    if(checkedCount == -CategoriesArray.length){
        ExtraCategoryCheckboxes[1].checked = true;
    }
    else{
        ExtraCategoryCheckboxes[1].checked = false;
    }
}

////////////////////////////////////////////// Movie Gallery //////////////////////////////////////////////

var RightGallery = document.getElementById("RightGallery");
const moviesAmountPerGallery = 9;
const moviesAmountPerContainer = 3;

function CreateMoviesCarrousel(genre){
    var carrouselPos = 0;
    CarrouselsPosArray.push(carrouselPos);
    
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
                CreateMoviePopup(movieDetails);
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
    
    GetMovies("https://api.themoviedb.org/3/discover/movie?api_key=f088ebb3ea3afd9640eb95267cc47330&with_genres="+genre.id+"&language=en-US", moviesTitlesContainers, moviesPostersContainers);
}


function GetMovies(urlString, titlesContainers, postersContainers){
    fetch(urlString)
    .then(response => {
        return response.json();
    })
    .then(movies => {
        for(let i = 0; i < moviesAmountPerGallery; i++){
            MoviesResults.push(movies.results[i]);
        }

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

////////////////////////////////////////////// Movie Popup //////////////////////////////////////////////

function CreateMoviePopup(movieDetails){
    
    var moviePopupDiv = document.createElement("div");
    moviePopupDiv.setAttribute("id", "moviePopup");
    
    var moviePopupContainer = document.createElement("div");
    moviePopupContainer.setAttribute("id", "moviePopupContainer");
    moviePopupDiv.appendChild(moviePopupContainer);

    var moviePopupTitle = document.createElement("p");
    moviePopupTitle.setAttribute("id", "moviePopupTittle");
    moviePopupTitle.textContent = movieDetails.title;
    moviePopupContainer.appendChild(moviePopupTitle);
    
    var moviePopupPoster = document.createElement("img");
    moviePopupPoster.setAttribute("id", "moviePopupPoster");
    moviePopupPoster.setAttribute("src", "https://image.tmdb.org/t/p/w500/" + movieDetails.backdrop_path);
    moviePopupContainer.appendChild(moviePopupPoster);

    var moviePopupSynopsis = document.createElement("p");
    moviePopupSynopsis.setAttribute("id", "moviePopupSynopsis");
    moviePopupSynopsis.textContent = movieDetails.overview;
    moviePopupContainer.appendChild(moviePopupSynopsis);
    
    var moviePopupVoteAverage = document.createElement("p");
    moviePopupVoteAverage.setAttribute("id", "moviePopupVoteAverage");
    var roundedVoteAverage = (Math.round(movieDetails.vote_average * 10) / 10).toFixed(1);
    moviePopupVoteAverage.textContent = roundedVoteAverage;
    moviePopupContainer.appendChild(moviePopupVoteAverage);
    

    var rightGalleryDiv = document.getElementById("RightGallery");
    rightGalleryDiv.parentNode.insertBefore(moviePopupDiv, rightGalleryDiv.nextSibling);

}