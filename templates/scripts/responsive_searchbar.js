document.getElementById("search-toggle").addEventListener("click", function() {
    let searchForm = document.querySelector(".search-form");
    searchForm.style.display = (searchForm.style.display === "flex") ? "none" : "flex";
});

