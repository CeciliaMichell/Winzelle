<?php 
    include_once '../controllers/display.php';
    include_once '../controllers/update.php';
    session_start();

    if(isset($_SESSION['login'])){
        if($_SESSION['userLevel'] == 0){
            $id = $_SESSION['userID'];
            $user = getData("*", "user", "userID LIKE '$id'")[0];

            $history = getData("*", "orders o JOIN product p ON p.productID LIKE o.productID", "userID LIKE '$id'");
            $times = count($history);
            $i = 0; 
            $sum = 0;
            $total = 0;

            foreach($history as $h){
                $sum += $h['orderQty'];
                $total += $h['productPrice'] * $h['orderQty'];
            }

            if(isset($_POST['update'])){
                $name = $_POST['name'];
                $address = $_POST['address'];
                $error = changeProfile('profile');
                changeData($_POST, $id);
                if(!isset($error)) header("Refresh: 0");
            }

            if(isset($_POST['updateEmail'])){
                $changeEmail = changeEmail($_POST, $id);
                if(!isset($changeEmail)) $success = true;
            }
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
    <title>Profile</title>
</head>
<body>
    <div class="container">
        <?php include 'partials/navbar_user1.php' ?>
    </div>
    <?php if(isset($success)): ?>
        <div class="container alert alert-primary mt-2" role="alert">
            Email successfully changed! Please refresh this page!
        </div>
    <?php endif; ?>
    <div class="shop-cart container d-flex my-5 w-100">
        <form action="" method="POST" enctype="multipart/form-data" class="summary w-35 bg-black text-light d-flex flex-column align-items-center py-5">
            <img class="img-fluid img-thumbnail w-70 my-3 photoprofile" src="../img/profile/<?= $user['userProfile'] ?>" alt="">
            <div class="w-75 mt-2">
                <div class="d-flex justify-content-between align-items-center my-2">
                    <div>Full Name </div>
                    <div><input class="w-100" type="text" name="name" value="<?= $user['userName'] ?>"></div>
                </div>
                <div class="d-flex justify-content-between align-items-center my-2">
                    <div>Email </div>
                    <div><input class="w-100" type="text" value="<?= $user['userEmail'] ?>" disabled></div>
                </div>
                <div class="d-flex justify-content-between align-items-center my-2">
                    <div>Address </div>
                    <div><textarea class="w-100" name="address" id="" text-truncate><?= $user['userAddress'] ?></textarea></div>
                </div>
                <div class="d-flex justify-content-between align-items-center my-3">
                    <div><input class="w-100" name="photo" type="file"></div>
                </div>
            </div>
            <div class="text-danger my-1"><?php if(isset($error['err_data'])) echo $error['err_data']; ?></div>
            <div class="form-column position-relative d-flex justify-content-center align-item-center w-50 mt-2">
                <button class="px-3 py-2 bg-light text-dark border-0 rounded" name="update">Update Data</button>
            </div>
        </form>
        <div class="details w-75 m-5">
            <div class="w-100">
                <h3>History</h3>
                <div class="w-100 d-flex justify-content-between my-2">
                    <div>Transaction Count</div>
                    <div><?= $times ?> time(s)</div>
                </div>
                <div class="w-100">
                    <div class="border border-end-0 border-start-0 border-dark">
                        <div class="container d-flex w-100 justify-content-around p-2">
                            <div class="text-uppercase w-20 text-center">Date</div>
                            <div class="text-uppercase w-30 text-center">Product</div>
                            <div class="text-uppercase w-10 text-center">Quantity</div>
                            <div class="text-uppercase w-10 text-center text-uppercase">SubTotal</div>
                        </div>
                    </div>
                    <?php foreach($history as $h):   ?>
                        <div class="container d-flex w-100 justify-content-around p-2">
                            <div class="w-20 text-center"><?= $h['orderDate'] ?></div>
                            <div class="text-uppercase w-30 text-center"><?= $h['productName'] ?></div>
                            <div class="text-uppercase w-10 text-center"><?= $h['orderQty'] ?></div>
                            <div class="text-uppercase w-10 text-center"><?= $h['productPrice'] * $h['orderQty'] ?></div>
                        </div>
                        <?php 
                            $i++; 
                            if($i == 3) break;
                        ?>
                    <?php endforeach; ?>
                        <div class="container d-flex w-100 justify-content-around p-2 fw-bold border border-end-0 border-start-0 border-dark">
                            <div class="text-uppercase w-10">Total</div>
                            <div class="text-uppercase w-30 text-center"></div>
                            <div class="text-uppercase w-10 text-center"><?= $sum ?></div>
                            <div class="text-uppercase w-10 text-center"><?= $total ?></div>
                        </div>
                </div>
            </div>
            <div class="w-100 mt-3">
                <form action="" method="POST" class="alert alert-secondary w-100" role="alert">
                    <div class="d-flex justify-content-between my-2 w-70">
                        <div>Email</div>
                        <div><input type="text" name="email" placeholder="New Email"></div>
                    </div>
                    <div class="d-flex justify-content-between my-2 w-70">
                        <div>Password</div>
                        <div><input type="password" name="pass" placeholder="Password"></div>
                    </div>
                    <div class="d-flex justify-content-between my-2 w-70">
                        <div>Confirm Pasword</div>
                        <div><input type="password" name="cpass" placeholder="Re-input password"></div>
                    </div>
                    <div class="text-danger my-1"><?php if(isset($changeEmail)) echo $changeEmail; ?></div>
                    <button class="px-3 py-2 bg-light text-dark border-0 rounded" name="updateEmail">Update Email</button>
                </form>
            </div>
        </div>
    </div>
    <?php include 'partials/footer_user1.html' ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</html>