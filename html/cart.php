<?php
    include_once '../controllers/display.php';
    include_once '../controllers/insert.php';
    include_once '../controllers/delete.php';
    session_start();

    if(isset($_SESSION['login'])){
        if($_SESSION['userLevel'] == 0){
            $id = $_SESSION['userID'];
            $user = getData("*", "user", "userID LIKE '$id'")[0];
            $cart = getData("*", "cart", "userID = '$id'");
            $currTime = currentTime();

            if(count($cart)){
                $total = 0;
                $product = productOnCart($id);

                if(isset($_POST['remove-product'])){
                    $pID = $_POST['remove-product'];
                    deleteCRUD("cart", "productID LIKE '$pID'");
                    header("Refresh: 0");
                }
            }

            if(isset($_POST['checkout'])){
                foreach($product as $p){
                    $date = $currTime;
                    $size = $p['cartSize'];
                    $qty = $p['cartQty'];
                    $payment = $_POST['payment'];
                    $courier = $_POST['courier'];
                    $productID = $p['productID'];

                    if(cartToHistory($id, $productID, $qty, $size, $payment, $courier, $date)){
                        deleteCRUD("cart", "productID LIKE '$productID'");
                        header("Refresh: 0");
                        $success = true;
                    }
                }
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
    <title>Cart</title>
</head>
<body>
    <div class="container">
        <?php include 'partials/navbar_user1.php' ?>
    </div>
    <div class="text-center bg-black my-3">
        <div class="container">
            <div class="d-flex w-100 py-3">
                <a href="" class="text-decoration-none bg-light border-0 text-dark text-uppercase w-50 py-2">Cart</a>
                <a href="history.php" class="text-decoration-none bg-transparent border-0 text-light text-uppercase w-50 py-2">History</a>
            </div>
        </div>
    </div>
    <?php if(isset($success)): ?>
        <div class="container alert alert-primary" role="alert">
            Checkout successfully!
        </div>
    <?php endif ?>
    <h2 class="container mt-5">Shoppping Cart</h2>
    <?php if(!count($cart)) : ?>
        <p class="container fs-1 text-uppercase text-center m-auto my-5">-- empty --</p>
    <?php else: ?>
        <div class="shop-cart container w-100">
            <div class="details w-75 me-4">
                <div class="border border-end-0 border-start-0 border-dark">
                    <div class="container d-flex w-100 justify-content-around p-2">
                        <div class="w-10"></div>
                        <div class="text-uppercase w-30 text-center">Product</div>
                        <div class="text-uppercase w-10 text-center">Quantity</div>
                        <div class="text-uppercase w-10 text-center">Size</div>
                        <div class="text-uppercase w-10 text-center">Total</div>
                    </div>
                </div>
                <?php foreach($product as $p): ?>
                    <div class="container my-3">
                        <div class="w-100 d-flex justify-content-around align-items-center">
                            <form action="" method="POST">
                                <button class="w-10 bg-transparent border-0" name="remove-product" value="<?= $p['productID'] ?>"><ion-icon class="fs-3" name="remove-circle-outline"></ion-icon></button>
                            </form>
                            <div class="w-30 d-flex justify-content-between align-items-center">
                                <img class="w-30 mx-2" src="../img/<?= $p['categoryID'] ?>/<?= $p['productImage'] ?>" alt="">
                                <div class="w-70 ">
                                    <div class="text-uppercase text-truncate"><?= $p['productName'] ?></div>
                                    <div class="text-uppercase">IDR <?= $p['productPrice'] ?></div>
                                </div>
                            </div>
                            <input class="w-10 text-center border-0" type="number" value="<?= $p['cartQty'] ?>" disabled>
                            <input class="w-10 text-center border-0" type="text" value="<?= $p['cartSize'] ?>"> 
                            <p class="w-10 text-center">IDR 
                                <?php
                                    $sum = $p['productPrice'] * $p['cartQty'];
                                    $total += $sum;
                                    echo $sum;
                                ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <form action="" method="POST" class="w-25 summary">
                <div class="bg-black p-3 text-light position-sticky">
                    <h3 class="text-uppercase text-center">Order Summary</h3>
                    <div class="border-top border-bottom border-light py-3">
                        <div class="d-flex justify-content-between text-uppercase">
                            Order Date
                            <input class="w-50 bg-transparent text-light border-0" type="text" value="<?= $currTime ?>" disabled>
                        </div>
                        <div class="text-uppercase py-2">
                            Payment
                            <select class="form-control form-control-sm text-uppercase" name="payment">
                                <option value="GoPay">GoPay</option>
                                <option value="DANA">DANA</option>
                                <option value="LinkAja">LinkAja</option>
                                <option value="Jenius">Jenius</option>
                            </select>
                        </div>
                        <div class="text-uppercase py-2">
                            Courier
                            <select class="form-control form-control-sm text-uppercase" name="courier">
                                <option value="JNE">JNE</option>
                                <option value="J&T Express">J&T Express</option>
                                <option value="Sicepat">Sicepat</option>
                            </select>
                        </div>
                        <div class="text-uppercase py-2">
                            Address
                            <div class="text-jusitfy"><?= $user['userAddress'] ?></div>
                        </div>
                    </div>
                    <div class="pt-3 text-uppercase">
                        <div class="d-flex justify-content-between">
                            <?php if(count($product) == 1): ?>
                                <p>Item</p>
                            <?php else: ?>
                                <p>Items</p>
                            <?php endif; ?>
                            <p><?= count($product) ?></p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>Total Cost</p>
                            <p>IDR <?= $total ?></p>
                        </div>
                        <button class="text-uppercase w-100 bg-light rounded border-0 p-1" name="checkout">Checkout</button>
                    </div>
                </div>
            </form>
        </div>
    <?php endif; ?>
    <?php include 'partials/footer_user1.html' ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</html>