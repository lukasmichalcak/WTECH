<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/static/css/styles.css">

</head>

<body>
<div class="wrapper">
    <header>
    <nav class="navbar prometex-color navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Prometex</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-supported-content" aria-controls="navbar-supported-content" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    </header>

    <main>
    <!-- Split Content Area -->
    <div class="container d-flex justify-content-center container login-main-div">
        <form>

            <h1 class="form-group mt-3">Log in</h1>

            <a href="register-page.html">Don't have an account? Sign up</a>

            <div class="form-group mt-3 mb-3">
                <label for="exampleInputUsername">Username</label>
                <input type="email" class="form-control" id="exampleInputUsername" aria-describedby="emailHelp" placeholder="Enter username">

            </div>

            <div class="form-group mt-3 mb-3">
                <label for="exampleInputPassword2">Confirm Password</label>
                <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
            </div>

            <a href="../home.blade.php" class="btn btn-primary rounded-pill d-block text-center">Create Account</a>
        </form>
    </div>
    </main>

    <footer class="py-3 my-4 border-top mb-0">
    <div class="container text-center ">
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
</body>
</html>
