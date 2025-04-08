<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width">
    <title>Homepage</title>

    @vite(['resources/css/styles.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>
<div class="wrapper">
    <header>
    <nav class="navbar prometex-color navbar-expand-lg navbar-light bg-light ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Prometex</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-supported-content" aria-controls="navbar-supported-content" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbar-supported-content">

                <div class="me-auto"></div>

                <!-- Search Bar (Properly Responsive) -->
                <div class="search-container d-flex">

                    <!-- Search Form -->
                    <form class="d-flex search-form">
                        <input class="form-control me-2 search-input" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-light my-0 search-button" type="submit">Search</button>
                    </form>
                </div>

                <div class="me-auto"></div>

                <div class="justify-content-center">
                    <a class="nav-link d-inline-block me-3" href="profile-page.html">
                        <i class="bi bi-person"></i>
                    </a>
                    <a class="nav-link d-inline-block position-relative me-3" href="shopping-cart.html">
                        <i class="bi bi-cart fs-4"></i>
                        <span id="cart-badge" class="position-absolute top-0 start-100 translate-middle
                        badge rounded-pill bg-danger cart-badge">3</span>
                    </a>
                </div>


            </div>

        </div>
    </nav>
    </header>

<main>
    <div class="container-fluid text-center div-with-side-bar">

        <div class="row g-0">
            <!-- Left sidebar -->
            <div class="col-auto bg-light">
                <div class="d-flex flex-column flex-shrink-0 p-3   bg-light main-nav-bar">

                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="#" class="nav-link active" aria-current="page">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link link-dark">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                            Smartphones
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link link-dark">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                            Laptops
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link link-dark">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
                            TVs
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link link-dark">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
                            appliances
                        </a>
                    </li>
                </ul>


                </div>
            </div>


<!--            Carousel-->
            <div class="col">
                <div class="row g-0" style="padding: 0">

                    <div class="container carousel-wrapper row align-items-center justify-content-center">

                            <div class="col-auto">
                                <button type="button" class="btn btn-primary carousel-left-button ml-auto"><i class="bi bi-arrow-left"></i></button>
                            </div>
                            <div class="col-9">
                                <img src="https://picsum.photos/id/694/900/375" alt="banner image" class="img-fluid p-3">

                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-primary carousel-right-button mr-auto"><i class="bi bi-arrow-right"></i></button>
                            </div>

                    </div>




                    <div class="col-12 p-3" style="background-color: white">
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
                            <!-- First card -->
                            <div class="col">
                                <div class="card align-items-center h-100">
                                    <img src="{{ Vite::asset('resources/images/A55.png') }}" class="card-img-top product-card" alt="a55">
                                    <div class="card-body">
                                        <h5 class="card-title">Samsung A55 128GB/8GB</h5>
                                    </div>
                                    <div class="card-body">
                                        <p>400.99$</p>
                                        <a href="#" class="card-link"><i class="bi bi-cart-plus"></i></a>
                                    </div>
                                </div>
                            </div>

                            <!-- Second card -->
                            <div class="col">
                                <div class="card align-items-center h-100">
                                    <img src="{{ Vite::asset('resources/images/A55.png') }}" class="card-img-top product-card" alt="a55">
                                    <div class="card-body">
                                        <h5 class="card-title">Samsung A55 128GB/8GB</h5>
                                    </div>
                                    <div class="card-body">
                                        <p>400.99$</p>
                                        <a href="#" class="card-link"><i class="bi bi-cart-plus"></i></a>
                                    </div>
                                </div>
                            </div>

                            <!-- Third card -->
                            <div class="col">
                                <div class="card align-items-center h-100">
                                    <img src="{{ Vite::asset('resources/images/A55.png') }}" class="card-img-top product-card" alt="a55" >
                                    <div class="card-body">
                                        <h5 class="card-title">Samsung A55 128GB/8GB</h5>
                                    </div>
                                    <div class="card-body">
                                        <p>400.99$</p>
                                        <a href="#" class="card-link"><i class="bi bi-cart-plus"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card align-items-center h-100">
                                    <img src="{{ Vite::asset('resources/images/A55.png') }}" class="card-img-top product-card" alt="a55" >
                                    <div class="card-body">
                                        <h5 class="card-title">Samsung A55 128GB/8GB</h5>
                                    </div>
                                    <div class="card-body">
                                        <p>400.99$</p>
                                        <a href="#" class="card-link"><i class="bi bi-cart-plus"></i></a>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</main>

<footer class="py-3 my-4 border-top mb-0 mt-auto">


    <div class="container text-center">
        <div class="row">

            <div class="col">
                <a href="#" class="nav-link px-2 text-body-secondary footer-text">Home</a>
            </div>
            <div class="col">
                <a href="#" class="nav-link px-2 text-body-secondary footer-text">Features</a>
            </div>
            <div class="col">
                <a href="#" class="nav-link px-2 text-body-secondary footer-text">Pricing</a>
            </div>
            <div class="col">
                <a href="#" class="nav-link px-2 text-body-secondary footer-text">FAQs</a>
            </div>
            <div class="col">
                <a href="#" class="nav-link px-2 text-body-secondary footer-text">About</a>
            </div>
        </div>
        <div class="pt-2">

            <p class="mb-0 text-body-secondary company-text-footer">© 2025 Prometex, Inc</p>

        </div>
    </div>
    </footer>

</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>
</html>
