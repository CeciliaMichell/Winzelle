<?php 
    include_once '../controllers/display.php';
    include_once '../controllers/insert.php';
    include_once '../controllers/delete.php';
    include_once '../controllers/update.php';
    session_start();

    if(isset($_SESSION['login'])){
        if($_SESSION['userLevel'] != 0){
            $canEdit = 0;
            $id = $_SESSION['userID'];
            $user = getData("*", "user", "userID LIKE '$id'")[0];
            $product = getAllData("*", "product");

            if(isset($_POST['addProduct'])){
                $error = addProduct($_POST);
                if($error == 1) header("Refresh: 0");
                else $response =  $error;
            }

            if(isset($_POST['remove-product'])){
                $pID = $_POST['remove-product'];
                deleteCRUD("product", "productID LIKE '$pID'");
                header("Refresh: 0");
            }

            if(isset($_POST['update-product'])){
                $id = $_POST['update-product'];
                $update = getData("*", "product", "productID LIKE '$id'")[0];
                $canEdit = $update['productID'];
            }

            if(isset($_POST['save-update'])){
                $productID = $_POST['save-update'];
                $name = $_POST['productName'];
                $desc = $_POST['productDesc'];
                $price = $_POST['productPrice'];
                updateCRUD("productName = '$name', productDesc = '$desc', productPrice = '$price'", "product", "productID LIKE '$productID'");
                header("Refresh: 0");
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
    <title>Product Management</title>
</head>
<body>
    <div class="container">
        <?php include('partials/navbar_user1.php') ?>
    </div>
    <div class="w-100 text-center bg-black my-3">
        <div class="container w-100 py-3">
            <div class="d-flex w-100 d-flex justify-content-around">
                <a class="w-25 bg-light btnPadding border-0 text-decoration-none text-dark text-uppercase" data-bs-toggle="modal" href="#addProduct" role="button">Add Product</a>
            </div>
        </div>
    </div>
    <?php if(isset($response)):  ?>
        <div class="container alert alert-secondary alert-dismissible fade show">
            <?= $response ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <div class="modal fade" id="addProduct" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase" id="exampleModalToggleLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-body text-uppercase w-100 bg-black">
                        <div class="w-100 d-flex justify-content-between text-light my-2">
                            <div>Name</div>
                            <div class="w-50"><input type="text" class="w-100" name="name"></div>
                        </div>
                        <div class="w-100 d-flex justify-content-between text-light my-2">
                            <div>Category</div>
                            <div class="w-50">
                                <select class="form-control form-control-sm text-uppercase" name="category">
                                    <option value="1">Top</option>
                                    <option value="2">Pants</option>
                                    <option value="3">Accessories</option>
                                    <option value="4">Beauty</option>
                                </select>
                            </div>
                        </div>
                        <div class="w-100 d-flex justify-content-between text-light my-2">
                            <div>Description</div>
                            <div class="w-50"><input type="text" class="w-100" name="desc"></div>
                        </div>
                        <div class="w-100 d-flex justify-content-between text-light my-2">
                            <div>Price</div>
                            <div class="w-50"><input type="number" class="w-100" name="price"></div>
                        </div>
                        <div class="w-100 d-flex justify-content-between text-light my-2">
                            <div class="w-50"><input type="file" class="w-100" name="photo"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="bg-black text-light px-5 py-2 border-0 mx-2 text-uppercase" name="addProduct" data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#modal-response">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php if(!count($product)) : ?>
        <p class="container fs-1 text-uppercase text-center m-auto my-5">-- empty --</p>
    <?php else: ?>
        <div class="container w-100 d-flex flex-column my-5">
            <div class="w-100 border border-end-0 border-start-0 border-dark">
                <div class="container d-flex w-100 justify-content-around p-2">
                    <div class="text-uppercase w-10 text-center text-truncate">Action</div>
                    <div class="text-uppercase w-10 text-center text-truncate">Popular</div>
                    <div class="text-uppercase w-30 text-center text-truncate">Product</div>
                    <div class="text-uppercase w-10 text-center text-truncate">Rating</div>
                    <div class="text-uppercase w-30 text-center text-truncate">Description</div>
                    <div class="text-uppercase w-10 text-center text-truncate">Price</div>
                </div>
            </div>
            <?php foreach($product as $p): ?>
                <div class="container w-100 my-3">
                    <form action="" method="POST" class="container d-flex w-100 justify-content-around p-2 align-items-center">
                        <div class="text-uppercase w-10 justify-content-center d-flex align-items-center">
                            <button class="w-100 bg-transparent border-0" name="remove-product" value="<?= $p['productID'] ?>"><ion-icon class="fs-3" name="remove-circle-outline"></ion-icon></button>
                            <?php if($canEdit !== $p['productID']): ?>
                                <button class="w-100 bg-transparent border-0" name="update-product" value="<?= $p['productID'] ?>"><ion-icon class="fs-3" name="create-outline"></ion-icon></button>
                            <?php else: ?>
                                <button class="w-100 bg-transparent border-0" name="save-update" value="<?= $p['productID'] ?>"><ion-icon class="fs-3" name="save-outline"></ion-icon></button>
                            <?php endif; ?>
                        </div>
                        <div class="text-uppercase w-10 text-center text-truncate"><?= $p['productCount'] ?> view(s)</div>
                        <div class="w-30 d-flex justify-content-between align-items-center">
                            <img class="w-30 mx-2" src="../img/<?= $p['categoryID'] ?>/<?= $p['productImage'] ?>" alt="">
                            <div class="w-70 ">
                                <input type="text" class="bg-transparent text-uppercase text-truncate <?php if($canEdit !== $p['productID']) echo "border-0" ?>" value="<?= $p['productName'] ?>" name="productName" <?php if($canEdit !== $p['productID']) echo 'disabled'; ?>>
                            </div>
                        </div>
                        <div class="text-uppercase w-10 text-center text-truncate">
                            <div class="starts">
                                <?php for($i = 1; $i <= $p['productRating']; $i++) : ?>
                                    <ion-icon name="star"></ion-icon>
                                <?php endfor; ?>
                                <?php for($i = $p['productRating']+1; $i <= 5; $i++) : ?>
                                    <ion-icon name="star-outline"></ion-icon>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <div class="w-30 mx-1">
                            <input type="text" class="w-100 bg-transparent text-uppercase text-truncate mx-1 <?php if($canEdit !== $p['productID']) echo "border-0" ?>" value="<?= $p['productDesc'] ?>" name="productDesc" <?php if($canEdit !== $p['productID']) echo 'disabled'; ?>>
                        </div>
                        <div class="w-10 d-flex align-items-center">
                            IDR
                            <input type="text" class="w-100 bg-transparent text-uppercase text-truncate <?php if($canEdit !== $p['productID']) echo "border-0" ?>" value="<?= $p['productPrice'] ?>" name="productPrice" <?php if($canEdit !== $p['productID'])  echo 'disabled'; ?>>
                        </div>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <?php include 'partials/footer_user1.html' ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</html>