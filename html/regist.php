<?php
    include_once '../controllers/insert.php';
    include_once '../controllers/display.php';
    session_start();

    if(isset($_SESSION['login'])){
        header("Location: ../index.php");
    }

    if(isset($_POST['regist'])){
        $error = cekDataRegist($_POST);
        $data = [];
        if(!isset($error['err_email'])) $data['email'] = $_POST['email'];
        if(!isset($error['err_uname'])) $data['name'] = $_POST['name'];
        if(!isset($error['err_pass'])) $data['pass'] = $_POST['password'];
        if(!isset($error['err_cpass'])) $data['cpass'] = $_POST['confirm'];
        $data['address'] = $_POST['address'];

        if(count($data) == 5){
            if(insertData($_POST) > 0){
                $email = $_POST['email'];
                $slug = getData("userSlug", "user", "userEmail LIKE '$email'")[0];
                header("Location: login.php?xyz='$slug'");
            }
        }
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
    <title>Register</title>
</head>
<body>
    <div class="container">
        <?php include 'partials/navbar_user1.php' ?>
    </div>
    <div class="container p-3 m-auto">
        <h2 class="text-center w-100 fs-3">Register</h2>
        <form action="" method="POST">
            <div class="form-card d-flex justify-content-center align-item-center w-100 position-relative">
                <div class="form-column position-relative d-flex flex-column justify-content-center align-item-center w-50 my-4">
                    <div class="inputBox position-relative w-100 ">
                        <input type="text" name="email" value="<?php if(isset($data['email'])) echo $data['email'] ?>" required>
                        <span class="text position-absolute d-block ps-3">Email</span>
                        <span class="line position-absolute d-block w-100"></span>
                    </div>
                    <div class="text-danger"><?php if(isset($error['err_email'])) echo $error['err_email'] ?></div>
                </div>
            </div>
            <div class="form-card d-flex justify-content-center align-item-center w-100 position-relative">
                <div class="form-column position-relative d-flex flex-column justify-content-center align-item-center w-50 my-4">
                    <div class="inputBox position-relative w-100">
                        <input type="text" name="name" value="<?php if(isset($data['name'])) echo $data['name'] ?>" required>
                        <span class="text position-absolute d-block ps-3">Full Name</span>
                        <span class="line position-absolute d-block w-100"></span>
                    </div>
                    <div class="text-danger"><?php if(isset($error['err_uname'])) echo $error['err_uname'] ?></div>
                </div>
            </div>
            <div class="form-card d-flex justify-content-center align-item-center w-100 position-relative">
                <div class="form-column position-relative d-flex flex-column justify-content-center align-item-center w-50 my-4">
                    <div class="inputBox position-relative w-100">
                        <input type="text" name="address" value="<?php if(isset($data['address'])) echo $data['address'] ?>" required>
                        <span class="text position-absolute d-block ps-3">Address</span>
                        <span class="line position-absolute d-block w-100"></span>
                    </div>
                </div>
            </div>
            <div class="form-card d-flex justify-content-center align-item-center w-100 position-relative">
                <div class="form-column position-relative d-flex flex-column justify-content-center align-item-center w-50 my-4">
                    <div class="inputBox position-relative w-100 ">
                        <input type="password" name="password" required>
                        <span class="text position-absolute d-block ps-3">Password</span>
                        <span class="line position-absolute d-block w-100"></span>
                    </div>
                    <div class="text-danger"><?php if(isset($error['err_pass'])) echo $error['err_pass'] ?></div>
                </div>
            </div>
            <div class="form-card d-flex justify-content-center align-item-center w-100 position-relative">
                <div class="form-column position-relative d-flex flex-column justify-content-center align-item-center w-50 my-4">
                    <div class="inputBox position-relative w-100 ">
                        <input type="password" name="confirm" required>
                        <span class="text position-absolute d-block ps-3">Confirm Password</span>
                        <span class="line position-absolute d-block w-100"></span>
                    </div>
                    <div class="text-danger"><?php if(isset($error['err_cpass'])) echo $error['err_cpass'] ?></div>
                </div>
            </div>
            <div class="form-card d-flex justify-content-center align-item-center w-100 position-relative">
                <div class="form-column position-relative d-flex justify-content-center align-item-center w-50 my-4">
                    <button class="px-3 py-2 bg-dark text-light border-0 rounded" name="regist">Registrasi</button>
                </div>
            </div>
        </form>
        <div class="form-card">
            <p class="text-center">
                <a href="forgotpass.php" class="text-black-a">Forgot Password</a> |
                <a href="login.php" class="text-black-a">Login</a>
            </p>
        </div>
    </div>
    <?php include 'partials/footer_user1.html' ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</html>