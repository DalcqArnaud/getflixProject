////////////////////////////////////////////// Sort by dropdown //////////////////////////////////////////////
/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
document.getElementById("sortDropDownBtn").addEventListener("click", () =>{
    document.getElementById("sortDropDownContentDiv").classList.toggle("show");
});
  
// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('.sortDropDownBtn')) {
        var dropdowns = document.getElementsByClassName("sortDropDownContentDiv");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

////////////////////////////////////////////// Categories //////////////////////////////////////////////

var categoriesList = document.getElementById("categoriesList").querySelectorAll("li>a");

categoriesList.forEach(element => {
    element.addEventListener("click", () =>{
        console.log("clicked");
    });
});

////////////////////////////////////////////// Movie Gallery //////////////////////////////////////////////

var RightGallery = document.getElementById("RightGallery");
const moviesAmountPerGallery = 9;
const moviesAmountPerContainer = 3;
var carrouselPos = 0;

var carrouselDiv = document.createElement("div");
carrouselDiv.setAttribute("id", "carrouselDiv");
RightGallery.appendChild(carrouselDiv);

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
    UpdateCarrouselBtnDisplay();
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
    UpdateCarrouselBtnDisplay();
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

UpdateCarrouselBtnDisplay();

fetch("https://api.themoviedb.org/3/movie/popular?api_key=f088ebb3ea3afd9640eb95267cc47330&language=en-US&page=1")
.then(response => {
    return response.json();
})
.then(movies => {
    //console.log(movies);
    UpdateMovies(moviesAmountPerGallery, moviesTitlesContainers, moviesPostersContainers, movies);
});

function UpdateMovies(movieAmount, movieTitles, moviePosters, newMoviesList){
    for(let i = 0; i < movieAmount; i++){
        movieTitles[i].innerText = newMoviesList.results[i].title;
        moviePosters[i].setAttribute("src", "https://image.tmdb.org/t/p/w500/" + newMoviesList.results[i].backdrop_path);
        moviePosters[i].setAttribute("alt", newMoviesList.results[i].title);
    }
}

function UpdateCarrouselBtnDisplay(){
    if(carrouselPos == 0){
        carrouselLeftBtn.style.visibility = "hidden";
    } else {
        carrouselLeftBtn.style.visibility = "visible";
    }

    if(carrouselPos == -moviesAmountPerContainer + 1){
        carrouselRightBtn.style.visibility = "hidden";
    } else {
        carrouselRightBtn.style.visibility = "visible";
    }
}