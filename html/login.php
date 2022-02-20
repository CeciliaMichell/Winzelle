<?php 
    include_once '../controllers/insert.php';
    session_start();

    if(isset($_SESSION['login'])){
        header("Location: ../index.php");
    }

    if(isset($_POST['login'])){
        $errLogin = cekDataLogin($_POST);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../img/logo.jpg">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <?php include('partials/navbar_user1.php') ?>
    </div>
    <div class="container p-3 m-auto">
        <h2 class="text-center w-100 fs-3">Login</h2>
        <form action="" method="POST">
            <div class="form-card d-flex justify-content-center align-item-center w-100 position-relative">
                <div class="form-column position-relative d-flex justify-content-center align-item-center w-50 my-4">
                    <div class="inputBox position-relative w-100 ">
                        <input type="text" name="email" required>
                        <span class="text position-absolute d-block ps-3">Email</span>
                        <span class="line position-absolute d-block w-100"></span>
                    </div>
                </div>
            </div>
            <div class="form-card d-flex justify-content-center align-item-center w-100 position-relative">
                <div class="form-column position-relative d-flex justify-content-center align-item-center w-50 my-4">
                    <div class="inputBox position-relative w-100 ">
                        <input type="password" name="password" required>
                        <span class="text position-absolute d-block ps-3">Password</span>
                        <span class="line position-absolute d-block w-100"></span>
                    </div>
                </div>
            </div>
            <div class="text-danger text-center"><?php if(isset($errLogin)) echo $errLogin ?></div>
            <div class="form-card d-flex justify-content-center align-item-center w-100 position-relative">
                <div class="form-column position-relative d-flex justify-content-center align-item-center w-50 my-4">
                    <button class="px-3 py-2 bg-dark text-light border-0 rounded" name="login">Login</button>
                </div>
            </div>
        </form>
        <div class="form-card">
            <p class="text-center">
                <a href="forgotpass.php" class="text-black-a">Forgot Password</a> |
                <a href="regist.php" class="text-black-a">Registrasi</a>
            </p>
        </div>
    </div>
    <?php include 'partials/footer_user1.html' ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</html>