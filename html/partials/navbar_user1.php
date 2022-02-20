<?php 
    if(isset($_SESSION['login'])){
        $id = $_SESSION['userID'];
        $user = getData("*", "user", "userID LIKE '$id'")[0];
    }
?>

<?php if(!isset($_SESSION['login'])): ?>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a href="../index.php" class="navbar-brand text-black d-flex align-items-center"><ion-icon name="heart-circle-outline"></ion-icon>Winzelle</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse css-nav d-flex justify-content-between align-items-center" id="navbarSupportedContent">
                <div class="d-flex">
                    <a class="text-uppercase text-decoration-none text-black mx-3" href="../index.php#about">About</a>
                    <a class="text-uppercase text-decoration-none text-black mx-3" href="../index.php#shop">Shop</a>
                </div>
                <div class="d-flex align-items-center">
                    <a class="text-uppercase text-decoration-none text-black mx-3" href="contact.php">Contact</a>
                    <a class="text-uppercase text-decoration-none text-black mx-3" href="login.php">Login</a>
                    <a class="text-uppercase text-decoration-none text-black mx-3" href="regist.php">Register</a>
                </div>
            </div>
        </div>
    </nav>
<?php else: ?>
    <?php if(!$_SESSION['userLevel']): ?>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a href="../index.php" class="navbar-brand text-black d-flex align-items-center"><ion-icon name="heart-circle-outline"></ion-icon>Winzelle</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse css-nav d-flex justify-content-between align-items-center" id="navbarSupportedContent">
                    <div class="d-flex">
                        <a class="text-uppercase text-decoration-none text-black mx-3" href="../index.php#about">About</a>
                        <a class="text-uppercase text-decoration-none text-black mx-3" href="../index.php#shop">Shop</a>
                    </div>
                    <div class="d-flex align-items-center">
                        <a class="text-uppercase text-decoration-none text-black mx-3" href="contact.php">Contact</a>
                        <a class="text-uppercase text-decoration-none text-black mx-3" href="cart.php"><ion-icon name="cart-outline" class="fs-3"></ion-icon></a>
                        <a class="text-uppercase text-decoration-none text-black mx-3 text-truncate" href="profile.php"><?= $user['userName'] ?></a>
                        <a class="text-uppercase text-decoration-none text-black mx-3" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </nav>
    <?php else: ?>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a href="../index.php" class="navbar-brand text-black d-flex align-items-center"><ion-icon name="heart-circle-outline"></ion-icon>Winzelle</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse css-nav d-flex justify-content-between align-items-center" id="navbarSupportedContent">
                    <div class="d-flex">
                        <a class="text-uppercase text-decoration-none text-black mx-3" href="../index.php#about">About</a>
                        <a class="text-uppercase text-decoration-none text-black mx-3" href="../index.php#shop">Shop</a>
                    </div>
                    <div class="d-flex align-items-center">
                        <a class="text-uppercase text-decoration-none text-black mx-3" href="admin_contact.php">Contact</a>
                        <a class="text-uppercase text-decoration-none text-black mx-3 text-truncate" href="admin_productManagement.php"><?= $user['userName'] ?></a>
                        <a class="text-uppercase text-decoration-none text-black mx-3" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </nav>
    <?php endif; ?>
<?php endif; ?>