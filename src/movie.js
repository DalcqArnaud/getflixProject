const form = document.getElementById('form');
//console.log(form);

form.addEventListener('submit', (el) => {
    el.preventDefault();
    const searchTermValue = search.value;
    localStorage.setItem("searchTerm", searchTermValue);

    window.location.href = "searchResults.php";
});