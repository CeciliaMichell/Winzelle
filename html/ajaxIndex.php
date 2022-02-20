<?php 
    include_once '../controllers/display.php';
    $key = $_GET['key'];
    $timelineProduct = getData("*", "product", "productName LIKE '%$key%'");
?>

<div class="container my-5">
    <div class="pruducts d-flex flex-wrap align-item-center">
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
        <?php endforeach; ?>
    </div>
</div>