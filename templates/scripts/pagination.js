const pagination = document.getElementById("pagination");

pagination.addEventListener("click", function (e) {
    if (e.target.tagName === "A" && !e.target.closest("li").classList.contains("disabled")) {
        const items = pagination.querySelectorAll(".page-item");
        items.forEach(item => item.classList.remove("active"));
        e.target.closest("li").classList.add("active");
    }
});