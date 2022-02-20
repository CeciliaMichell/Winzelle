<?php
    include '../controllers/insert.php';
    session_start();

    $success = false;
    if(isset($_POST['contact'])){
        if(addContact($_POST)){
            $success = true;
        }
    }
    if(isset($_SESSION['login'])){
        if($_SESSION['userLevel'] != 0) header("Location: ../index.php");
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
    <title>Contact</title>
</head>
<body>
    <div class="container my-3">
        <?php include 'partials/navbar_user1.php' ?>
    </div>
    <?php if($success == true) : ?>
        <div class="container alert alert-primary" role="alert">
            Successfully sent a message!
        </div>
    <?php endif; ?>
    <div class="container p-3 m-auto">
        <h2 class="text-center w-100 fs-3">Contact</h2>
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
                        <input type="text" name="name" required>
                        <span class="text position-absolute d-block ps-3">Name</span>
                        <span class="line position-absolute d-block w-100"></span>
                    </div>
                </div>
            </div>
            <div class="form-card d-flex justify-content-center align-item-center w-100 position-relative">
                <div class="form-column position-relative d-flex justify-content-center align-item-center w-50 my-4">
                    <div class="inputBox position-relative w-100 ">
                        <input type="text" name="text" required>
                        <span class="text position-absolute d-block ps-3">Text</span>
                        <span class="line position-absolute d-block w-100"></span>
                    </div>
                </div>
            </div>
            <div class="form-card d-flex justify-content-center align-item-center w-100 position-relative">
                <div class="form-column position-relative d-flex justify-content-center align-item-center w-50 my-4">
                    <button class="px-3 py-2 bg-dark text-light border-0 rounded" name="contact">Contact</button>
                </div>
            </div>
        </form>
        <div class="form-card">
            <p class="text-center"><a href="../index.php#about" class="text-dark">More information...</a></p>
        </div>
    </div>
    <?php include 'partials/footer_user1.html' ?>
</body>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</html>