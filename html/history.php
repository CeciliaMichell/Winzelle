<?php
    include_once '../controllers/display.php';
    include_once '../controllers/insert.php';

    session_start();
    if(isset($_SESSION['login'])){
        if($_SESSION['userLevel'] == 0){
            $submit = 0; $done = 0;
            $id = $_SESSION['userID'];
            $user = getData("*", "user", "userID LIKE '$id'")[0];
            $order = productOrders($id);

            if(isset($_POST['addReview'])){
                $submit = $_POST['addReview'];
                $orderData = getData("*", "orders", "orderID LIKE '$submit'")[0];

                if($orderData['ratingID'] != NULL){
                    $ratingID = $orderData['ratingID'];
                    $review = getData("*", "rating", "ratingID LIKE '$ratingID'")[0];
                    $done = $review['orderID'];
                }
            }
            if(isset($_POST['submitReview'])){
                $orderID = $_POST['submitReview'];
                $productID = $_POST['productID'];

                addRating($_POST);

                $sum = 0;
                $numb = getData("ratingNumb", "orders o 
                JOIN rating r ON r.ratingID = o.ratingID
                JOIN product p ON p.productID = o.productID", "o.productID LIKE '$productID'");

                $cntPpl = count($numb);
                foreach($numb as $n){
                    $n = $n['ratingNumb'];
                    $sum += $n;
                }
                $result = $sum/$cntPpl;
                $result = (int) $result;
                updateCRUD("productRating = '$result'", "product", "productID LIKE '$productID'");
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
    <title>History</title>
</head>
<body>
    <div class="container">
        <?php include 'partials/navbar_user1.php' ?>
    </div>
    <div class="text-center bg-black my-3">
        <div class="container">
            <div class="d-flex w-100 py-3">
                <a href="cart.php" class="text-decoration-none bg-transparent border-0 text-light text-uppercase w-50 py-2">Cart</a>
                <a href="" class="text-decoration-none bg-light border-0 text-dark text-uppercase w-50 py-2">History</a>
            </div>
        </div>
    </div>
    <h2 class="container mt-5">Shoppping History</h2>
    <?php if(!count($order)): ?>
        <p class="container fs-1 text-uppercase text-center m-auto my-5">-- empty --</p>
    <?php else: ?>
        <div class="container">
            <div class="w-100 me-4">
                <div class="border border-end-0 border-start-0 border-dark">
                    <div class="container d-flex w-100 justify-content-around p-2">
                        <div class="text-uppercase w-15 text-center text-truncate">Date</div>
                        <div class="text-uppercase w-30 text-center text-truncate">Product</div>
                        <div class="text-uppercase w-10 text-center text-truncate">Details</div>
                        <div class="text-uppercase w-10 text-center text-truncate">Payment</div>
                        <div class="text-uppercase w-10 text-center text-truncate">Courier</div>
                        <div class="text-uppercase w-10 text-center text-truncate">Total</div>
                        <div class="text-uppercase w-10 text-center text-truncate">Review</div>
                    </div>
                </div>
                <div class="container my-3">
                    <form action="" method="POST">
                        <?php foreach($order as $o): ?>
                            <div class="w-100 d-flex justify-content-around align-items-center my-3">
                                <p class="w-15 text-center text-truncate"><?= $o['orderDate'] ?></p>
                                <div class="w-30 d-flex justify-content-between align-items-center">
                                    <img class="w-30 mx-2" src="../img/<?= $o['categoryID'] ?>/<?= $o['productImage'] ?>" alt="">
                                    <div class="w-70 ">
                                        <div class="text-uppercase text-truncate"><?= $o['productName'] ?></div>
                                        <div class="text-uppercase">IDR <?= $o['productPrice'] ?></div>
                                    </div>
                                </div>
                                <p class="w-10 text-center"><?= $o['orderQty'] ?>, <?= $o['orderSize'] ?></p>
                                <p class="w-10 text-center text-truncate"><?= $o['orderPayment'] ?></p>
                                <p class="w-10 text-center text-truncate"><?= $o['orderCourier'] ?></p>
                                <p class="w-10 text-center text-truncate">IDR <?= $o['productPrice'] * $o['orderQty']; ?></p>
                                <div class="d-flex align-items-center justify-content-center">
                                    <?php if($submit !== $o['orderID']): ?>
                                        <button class="border-0 bg-black text-light px-3 py-2" name="addReview" value="<?= $o['orderID'] ?>">Add Review</button>
                                    <?php elseif(($submit === $o['orderID']) && ($done !== $o['orderID'])): ?>
                                        <button class="border-0 bg-black text-light px-3 py-2" name="submitReview" value="<?= $o['orderID'] ?>">Submit</button>
                                    <?php else: ?>
                                        <button class="border-0 bg-black text-light px-3 py-2">Submit</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if($submit === $o['orderID']): ?>
                                <div class="w-100 bg-black text-uppercase p-3">
                                    <div class="w-100 d-flex justify-content-between text-light my-2">
                                        <input type="hidden" name="productID" value="<?= $o['productID'] ?>">
                                        <div>Rating</div>
                                        <div class="w-50">
                                            <select class="form-control form-control-sm text-uppercase" name="rating" 
                                            <?php if($done === $o['orderID']) echo 'disabled' ?>>
                                            <?php if($done === $o['orderID']): ?>
                                                <option value="<?= $review['ratingNumb'] ?>"><?= $review['ratingNumb'] ?></option>
                                            <?php else: ?>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="w-100 d-flex justify-content-between text-light my-2">
                                        <div>Description</div>
                                        <div class="w-50">
                                            <textarea class="w-100" name="desc" <?php if($done === $o['orderID']) echo 'disabled' ?>><?php if($done === $o['orderID']) echo $review['ratingDesc'] ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php include 'partials/footer_user1.html' ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</html>