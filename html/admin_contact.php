<?php
    include_once '../controllers/display.php';
    session_start();

    if(isset($_SESSION['login'])){
        if($_SESSION['userLevel'] != 0){
            $contact = getAllData("*", "contact");
        }
        else header("Location: ../index.php");
    }
    else header("Location: ../index.php");
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
    <div class="container">
        <?php include 'partials/navbar_user1.php' ?>
    </div>
    <div class="text-center bg-black my-3">
        <div class="container">
            <div class="d-flex w-100 py-3">
                <b class="text-light text-uppercase fs-4">All Inbox</b>
            </div>
        </div>
    </div>
    <div class="container">
        <?php if(!count($contact)) : ?>
            <p class="container fs-1 text-uppercase text-center m-auto my-5">-- empty --</p>
        <?php else: ?>
            <div class="w-100 d-flex py-3 text-uppercase border-0 border-top border-bottom border-dark">
                <div class="w-25 text-center fw-bold">Email</div>
                <div class="w-25 text-center fw-bold">Name</div>
                <div class="w-60 text-center fw-bold">Text</div>
            </div>
            <?php foreach($contact as $c) :?>
                <div class="w-100 d-flex py-3 border-0 border-bottom border-dark">
                    <div class="w-25 text-center text-truncate"><?= $c['contactEmail'] ?></div>
                    <div class="w-25 text-center text-truncate"><?= $c['contactName'] ?></div>
                    <div class="w-60 text-center text-truncate"><?= $c['contactText'] ?></div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php include 'partials/footer_user1.html' ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</html>