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

var categoriesList = document.getElementById("categoriesList").querySelectorAll("li>a");
console.log(categoriesList);

categoriesList.forEach(element => {
    element.addEventListener("click", () =>{
        console.log("clicked");
    });
});

var moviesSpots = Array.from(document.querySelectorAll("#MoviesContainer>div>p"));

fetch("https://api.themoviedb.org/3/movie/popular?api_key=f088ebb3ea3afd9640eb95267cc47330&language=en-US&page=1")
.then(response => {
    return response.json();
})
.then(movies => {
    console.log("hey");
    console.log(movies);
    UpdateMovies(moviesSpots, movies);
});

function UpdateMovies(moviesSpots, newMoviesList){
    for(let i = 0; i < moviesSpots.length; i++){
        moviesSpots[i].innerText = newMoviesList.results[i].title;
    }
}