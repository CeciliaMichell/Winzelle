<?php 
    include_once '../controllers/display.php';
    $ctg = $_GET['ctg'];
    $category = getData("*", "product p JOIN category c ON p.categoryID = c.categoryID", "p.categoryID LIKE '$ctg'");
    $ctgName = $category[0];
    $ctgName = $ctgName['categoryName'];
?>

<h2 class="my-5">Category : <?= $ctgName ?></h2>
<div class="d-flex flex-wrap align-item-center">
    <?php foreach($category as $product): ?>
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
    <?php endforeach; ?>
</div>