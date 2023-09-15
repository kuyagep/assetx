<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>

<body>
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" aria-label="Offcanvas navbar large">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"> AppCoreX</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbar2"
                    aria-labelledby="offcanvasNavbar2Label">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbar2Label">Offcanvas</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Features</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    My Account
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Dashboard</a></li>
                                    <li><a class="dropdown-item" href="#">Change Password</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                        {{-- <form class="d-flex mt-3 mt-lg-0" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-primary rounded-pill" type="submit">Search</button>
                    </form> --}}

                        <a href="#" class="btn btn-outline-danger rounded-pill px-4" type="button">Login</a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="px-4 pt-5 my-5 text-center border-bottom ">
            <h1 class="display-4 fw-bold text-body-emphasis">Centered screenshot</h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4">Quickly design and customize responsive mobile-first sites with Bootstrap, the
                    world’s
                    most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid
                    system,
                    extensive prebuilt components, and powerful JavaScript plugins.</p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
                    <button type="button" class="btn btn-warning btn-lg rounded-pill px-4 me-sm-3">Primary
                        button</button>
                    <button type="button" class="btn btn-outline-danger rounded-pill btn-lg px-4">Secondary</button>
                </div>
            </div>
            <div class="overflow-hidden" style="max-height: 30vh;">
                <div class="container px-5">
                    <img src="https://getbootstrap.com/docs/5.3/examples/heroes/bootstrap-docs.png"
                        class="img-fluid border rounded-3 shadow-lg mb-4" alt="Example image" width="700"
                        height="500" loading="lazy">
                </div>
            </div>
        </div>

        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <div class="col-md-4 d-flex align-items-center">
                <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
                    <svg class="bi" width="30" height="24">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                </a>
                <span class="mb-3 mb-md-0 text-body-secondary">© 2023 Company, Inc</span>
            </div>

            <ul class="nav col-md-4 justify-content-end list-unstyled d-flex px-5">
                <li class="ms-3"><a class="text-body-secondary" href="#"><i class="bi bi-twitter"></i></a></li>
                <li class="ms-3"><a class="text-body-secondary" href="#"><i class="bi bi-instagram"></i></a>
                </li>
                <li class="ms-3"><a class="text-body-secondary" href="#"><i class="bi bi-facebook"></i></a>
                </li>
            </ul>
        </footer>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
