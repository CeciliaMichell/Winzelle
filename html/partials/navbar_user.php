<?php 
    if(isset($_SESSION['login'])){
        $id = $_SESSION['userID'];
        $user = getData("*", "user", "userID LIKE '$id'")[0];
    }
?>

<?php if(!isset($_SESSION['login'])): ?>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
        <a href="index.php" class="navbar-brand text-black d-flex align-items-center"><ion-icon name="heart-circle-outline"></ion-icon>Winzelle</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse css-nav" id="navbarSupportedContent">
            <a class="text-uppercase text-decoration-none text-black mx-3" href="#about">About</a>
            <a class="text-uppercase text-decoration-none text-black mx-3" href="#shop">Shop</a>
            <div class="navbar-nav css-aic">
                <form class="d-flex m-1" method="POST">
                    <input name="keyword" class="form-control me-2 css-searchInput keyword" type="search" placeholder="Find your style.." aria-label="Search">
                    </a>
                </form>
            </div>
            <a class="text-uppercase text-decoration-none text-black mx-3" href="html/contact.php">Contact</a>
            <a class="text-uppercase text-decoration-none text-black mx-3" href="html/login.php">Login</a>
            <a class="text-uppercase text-decoration-none text-black mx-3" href="html/regist.php">Register</a>
            </div>
        </div>
    </nav>
<?php else: ?>
    <?php if(!$_SESSION['userLevel']) : ?>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a href="index.php" class="navbar-brand text-black d-flex align-items-center"><ion-icon name="heart-circle-outline"></ion-icon>Winzelle</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse css-nav" id="navbarSupportedContent">
                    <a class="text-uppercase text-decoration-none text-black mx-3" href="#about">About</a>
                    <a class="text-uppercase text-decoration-none text-black mx-3" href="#shop">Shop</a>
                    <div class="navbar-nav css-aic">
                        <form class="d-flex m-1" method="POST">
                            <input name="keyword" class="form-control me-2 css-searchInput keyword" type="search" placeholder="Find your style.." aria-label="Search">
                            </a>
                        </form>
                    </div>
                    <a class="text-uppercase text-decoration-none text-black mx-3" href="html/contact.php">Contact</a>
                    <a class="text-uppercase text-decoration-none text-black mx-3" href="html/cart.php"><ion-icon name="cart-outline" class="fs-3"></ion-icon></a>
                    <a class="text-uppercase text-decoration-none text-black mx-3 text-truncate" href="html/profile.php"><?= $user['userName'] ?></a>
                    <a class="text-uppercase text-decoration-none text-black mx-3" href="html/logout.php">Logout</a>
                </div>
            </div>
        </nav>
    <?php else:?> 
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a href="index.php" class="navbar-brand text-black d-flex align-items-center"><ion-icon name="heart-circle-outline"></ion-icon>Winzelle</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse css-nav" id="navbarSupportedContent">
                    <a class="text-uppercase text-decoration-none text-black mx-3" href="#about">About</a>
                    <a class="text-uppercase text-decoration-none text-black mx-3" href="#shop">Shop</a>
                    <div class="navbar-nav css-aic">
                        <form class="d-flex m-1" method="POST">
                            <input name="keyword" class="form-control me-2 css-searchInput keyword" type="search" placeholder="Find your style.." aria-label="Search">
                            </a>
                        </form>
                    </div>
                    <a class="text-uppercase text-decoration-none text-black mx-3" href="html/admin_contact.php">Contact</a>
                    <a class="text-uppercase text-decoration-none text-black mx-3 text-truncate" href="html/admin_productManagement.php"><?= $user['userName'] ?></a>
                    <a class="text-uppercase text-decoration-none text-black mx-3" href="html/logout.php">Logout</a>
                </div>
            </div>
        </nav>
    <?php endif; ?>
<?php endif; ?>