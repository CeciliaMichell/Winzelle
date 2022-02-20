<?php 
    include_once 'controllers/display.php';
    include_once 'controllers/insert.php';
    session_start();

    if(isset($_SESSION['login'])){
        $id = $_SESSION['userID'];
        $user = getData("*", "user", "userID LIKE '$id'")[0];

        if(isset($_POST['addToCart'])){
            $productID = $_POST['addToCart'];
        }
    }

    $cnt1 = 0; $cnt2 = 0;
    $categories = getAllData("*", "category");
    $timelineProduct = getAllData("*", "product ORDER BY productCount DESC");
    $reviews = getAllData("*", "orders o 
    JOIN rating r ON r.ratingID = o.ratingID
    JOIN product p ON p.productID = o.productID
    JOIN user u ON u.userID = o.userID");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" href="img/logo.jpg">
    <link rel="stylesheet" href="css/style.css">
    <title>Landing Page</title>
</head>
<body>
    <div class="container">
        <?php include 'html/partials/navbar_user.php' ?>
    </div>
    <div class="section-search">
        <div class="container">
            <h2 class="mt-5 text-center">Choose Your</h2>
            <div class="mt-3 mb-5 d-flex justify-content-center align-items-center flex-wrap">
                <div class="css-wrap-card d-flex justify-content-center">
                    <div class="ootd-product-card m-3 d-flex flex-column">
                        <img src="img/ootd/ootd1.png" alt="">
                        <div class="bg-black text-light p-3 text-center">
                            OUTFIT
                        </div>
                    </div>
                </div>
                <div class="css-wrap-card d-flex justify-content-center">
                    <div class="ootd-product-card  m-3">
                        <img src="img/ootd/ootd3.jpg" alt="">
                        <div class="bg-black text-light p-3 text-center">
                            OF
                        </div>
                    </div>
                </div>
                <div class="css-wrap-card d-flex justify-content-center">
                    <div class="ootd-product-card m-3">
                        <img src="img/ootd/ootd4.jpg" alt="">
                        <div class="bg-black text-light p-3 text-center">
                            THE
                        </div>
                    </div>
                </div>
                <div class="css-wrap-card d-flex justify-content-center">
                    <div class="ootd-product-card m-3">
                        <img src="img/ootd/ootd5.jpg" alt="">
                        <div class="bg-black text-light p-3 text-center">
                            DAY
                        </div>
                    </div>
                </div>
            </div>
            <form action="" method="POST" class="d-flex justify-content-center align-item-center flex-wrap mb-5">
                <?php foreach($categories as $ctg): ?>
                    <button type="button" class="css-ctg border border-3 border-dark rounded-pill text-center m-2" name="click-ctg" onclick="ajaxCategory(<?= $ctg['categoryID'] ?>)">
                        <?= $ctg['categoryName'] ?>
                    </button>
                <?php endforeach; ?>
            </form>
        </div>
        <div id="about" class="bg-black d-flex align-item-center justify-content-around p-5 w-100 text-light">
            <div class="css-jumbotron-text d-flex flex-column justify-content-center">
                <h2>About Winzelle</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus amet nostrum excepturi quo nesciunt voluptatem eaque distinctio quae similique perferendis minus facilis impedit, dolorem consectetur hic sit et, sunt dignissimos praesentium quam molestiae ipsam exercitationem natus. </p>
            </div>
            <div class="slider-outer d-flex justify-content-center">
                <div class="css-about-slider overflow-hidden">
                    <div class="d-flex align-item-center">
                        <input type="radio" name="radio-btn" id="radio1">
                        <input type="radio" name="radio-btn" id="radio2">
                        <input type="radio" name="radio-btn" id="radio3">
                        <div class="css-image-slide first">
                            <img src="img/slides/slide2.jpg" alt="">
                        </div>
                        <div class="css-image-slide">
                            <img src="img/slides/slide3.jpg" alt="">
                        </div>
                        <div class="css-image-slide">
                            <img src="img/slides/slide4.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" id="shop">
            <?php if(count($timelineProduct)): ?>
                <div class="ctg-product w-100">
                    <h2 class="my-5">For you</h2>
                    <div class="d-flex flex-wrap align-items-center">
                        <?php foreach($timelineProduct as $product): ?>
                            <div class="css-product-card d-flex flex-column m-2">
                                <img src="img/<?= $product['categoryID'] ?>/<?= $product['productImage'] ?>" alt="">
                                <a href="html/detail.php?id=<?= $product['productID'] ?>" class="product-name border-0 w-100 text-decoration-none text-light">
                                    <?= $product['productName'] ?>
                                </a>
                                <div class="product-details">
                                    <div class="price">
                                        <b>IDR <?= $product['productPrice'] ?></b>
                                    </div>
                                    <div class="starts">
                                        <?php for($i = 1; $i <= $product['productRating']; $i++) : ?>
                                            <ion-icon name="star"></ion-icon>
                                        <?php endfor; ?>
                                        <?php for($i = $product['productRating']+1; $i <= 5; $i++) : ?>
                                            <ion-icon name="star-outline"></ion-icon>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                $cnt1++; 
                                if($cnt1 == 10) break;
                            ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if(count($reviews)): ?>
                <div class="css-tesimonial">
                    <div><h1>Testimoni</h1></div>
                    <div class="row d-flex justify-content-center align-items-center mb-5">
                        <?php foreach($reviews as $r): ?>
                            <div class="col-4">
                                <div class="card w-100">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $r['userName'] ?></h5>
                                        <h6 class="card-subtitle mb-2 text-muted">
                                            <div class="starts">
                                                <?php for($i = 1; $i <= $r['productRating']; $i++) : ?>
                                                    <ion-icon name="star"></ion-icon>
                                                <?php endfor; ?>
                                                <?php for($i = $r['productRating']+1; $i <= 5; $i++) : ?>
                                                    <ion-icon name="star-outline"></ion-icon>
                                                <?php endfor; ?>
                                            </div>
                                        </h6>
                                        <p class="card-text text-justify"><?= $r['ratingDesc'] ?></p>
                                        <a href="html/detail.php?id=<?= $r['productID'] ?>" class="card-link text-dark">Link Product</a>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                $cnt2++; 
                                if($cnt2 == 3) break;
                            ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php include 'html/partials/footer_user.html' ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="js/script.js"></script>
</html>