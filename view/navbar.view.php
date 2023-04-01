<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Container wrapper -->
    <div class="container">
        <!-- Navbar brand -->
        <a class="navbar-brand me-2" href="/">
            Home
        </a>

        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarButtonsExample"
            aria-controls="navbarButtonsExample" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarButtonsExample">
            <!-- Left links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="cashflow">Dashboard</a>
                </li>
            </ul>
            <!-- Left links -->

            <div class="d-flex align-items-center">

                <?php if ($_SESSION['user']['email'] ?? false): ?>

                <a href="login" class="nav-link"><?=$_SESSION['user']['email']?></a>

                <button type="button" class="btn btn-link px-3 me-2">
                    <a href="logout" class="nav-link">Log out</a>
                </button>

                <?php else: ?>
                <button type="button" class="btn btn-link px-3 me-2">
                    <a href="login" class="nav-link">Log in</a>
                </button>
                <button type="button" class="btn btn-primary me-3">
                    <a href="register" class="nav-link">Register</a>
                </button>
                <?php endif;?>

                <a class="btn btn-dark px-3" href="https://github.com/mdbootstrap/mdb-ui-kit" role="button"><i
                        class="fab fa-github"></i></a>
            </div>
        </div>
        <!-- Collapsible wrapper -->
    </div>
    <!-- Container wrapper -->
</nav>
<!-- Navbar -->