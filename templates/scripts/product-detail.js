document.addEventListener("DOMContentLoaded", function() {
    // =========== Toggle for COLOR buttons ===========
    const colorButtons = document.querySelectorAll(".color-btn");

    colorButtons.forEach((btn) => {
        btn.addEventListener("click", () => {
            // Remove "btn-primary" from all color buttons
            colorButtons.forEach((b) => {
                b.classList.remove("btn-primary");
                b.classList.add("btn-secondary");
            });

            // Make the clicked one "primary"
            btn.classList.remove("btn-secondary");
            btn.classList.add("btn-primary");

            // Optionally, grab the data attribute if needed
            console.log("Selected color:", btn.getAttribute("data-color"));
        });
    });

    // =========== Toggle for RAM buttons ===========
    const ramButtons = document.querySelectorAll(".ram-btn");

    ramButtons.forEach((btn) => {
        btn.addEventListener("click", () => {
            ramButtons.forEach((b) => {
                b.classList.remove("btn-primary");
                b.classList.add("btn-secondary");
            });
            btn.classList.remove("btn-secondary");
            btn.classList.add("btn-primary");

            console.log("Selected RAM:", btn.getAttribute("data-ram"));
        });
    });

    // =========== Toggle for SSD buttons ===========
    const ssdButtons = document.querySelectorAll(".ssd-btn");

    ssdButtons.forEach((btn) => {
        btn.addEventListener("click", () => {
            ssdButtons.forEach((b) => {
                b.classList.remove("btn-primary");
                b.classList.add("btn-secondary");
            });
            btn.classList.remove("btn-secondary");
            btn.classList.add("btn-primary");

            console.log("Selected SSD:", btn.getAttribute("data-ssd"));
        });
    });
});