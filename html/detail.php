<?php 
    include_once '../controllers/display.php';
    include_once '../controllers/insert.php';
    include_once '../controllers/update.php';
    session_start();

    $productID = $_GET['id'];
    $product = getData("*", "product", "productID LIKE '$productID'")[0];

    $cnt = $product['productCount'] + 1;
    updateCRUD("productCount = '$cnt'", "product", "productID LIKE '$productID'");

    if(isset($_SESSION['login'])){
        $id = $_SESSION['userID'];
        $user = getData("*", "user", "userID LIKE '$id'")[0];
    }
    
    if(isset($_POST['addCart']) && isset($_SESSION['login'])){
        if($_SESSION['userLevel'] == 0){
            if(isset($_POST['size'])) $size = $_POST['size'];
            else $size = NULL;
            $qty = $_POST['qty'];
            if($qty <= 0) $qty = 1;
            
            $productSame = getData("cartID, cartQty", "cart", "userID LIKE '$id' AND productID LIKE '$productID' AND cartSize LIKE '$size'");
            if(count($productSame) != 0){
                $productSame = $productSame[0];
                $cartID = $productSame['cartID'];
                $cartQty = $productSame['cartQty'] + $qty;
                updateCRUD("cartQty = '$cartQty'", "cart", "cartID LIKE '$cartID'");
            }
            else ProductToCart($id, $productID, $size, $qty);
            $success = true;
        }
    }
    else if(isset($_POST['addCart']) && !isset($_SESSION['login'])) header("Location: login.php");
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
    <title>Detail Product</title>
</head>
<body>
    <div class="container">
        <?php include 'partials/navbar_user1.php' ?>
        <?php if(isset($success)): ?>
            <div class="alert alert-secondary my-3" role="alert">
                Successfully add product to your cart! 
            </div>
        <?php endif; ?>
        <div class="w-100 d-flex mt-5">
            <div class="w-50 d-flex justify-content-center">
               <img class="w-75" src="../img/<?= $product['categoryID'] ?>/<?= $product['productImage'] ?>" alt="">
            </div>
            <div class="w-50 d-flex flex-column justify-content-between text-uppercase">
                <div>
                    <h3 class="my-4 fw-bold"><?= $product['productName'] ?></h3>
                    <div class="my-2">
                        <?php for($i = 1; $i <= $product['productRating']; $i++) : ?>
                            <ion-icon name="star"></ion-icon>
                        <?php endfor; ?>
                        <?php for($i = $product['productRating']+1; $i <= 5; $i++) : ?>
                            <ion-icon name="star-outline"></ion-icon>
                        <?php endfor; ?>
                    </div>
                    <div class="fw-bold fs-5 my-2">IDR <?= $product['productPrice'] ?></div>
                    <div class="my-4 fs-6">
                        <div class="fw-bold my-1">Description : </div>
                        <p class="text-justify"><?= $product['productDesc'] ?></p>
                    </div>
                </div>
                <form action="" method="POST">
                    <?php if($product['categoryID'] == 1 || $product['categoryID'] == 2): ?>
                        <div class="d-flex my-3">
                            <div class="fw-bold me-5">Size</div>
                            <div class="form-check px-3">
                                <input class="form-check-input" type="radio" name="size" id="s" value="S" checked>
                                <label class="form-check-label" for="s">S</label>
                            </div>
                            <div class="form-check px-3">
                                <input class="form-check-input" type="radio" name="size" id="m" value="M">
                                <label class="form-check-label" for="m">M</label>
                            </div>
                            <div class="form-check px-3">
                                <input class="form-check-input" type="radio" name="size" id="l" value="L">
                                <label class="form-check-label" for="l">L</label>
                            </div>
                            <div class="form-check px-3">
                                <input class="form-check-input" type="radio" name="size" id="xl" value="XL">
                                <label class="form-check-label" for="xl">XL</label>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="w-100 d-flex justify-content-between">
                        <div class="w-50">
                            <input type="number" name="qty" value="1" class="w-15 px-2">
                        </div>
                        <button class="px-3 py-2 bg-black text-light border-0 rounded text-uppercase" name="addCart">Add to Cart</button>
                    </div>
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