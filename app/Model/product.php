<?php

// Check to make sure the id parameter is specified in the URL
if (isset($_GET['id'])) {
    // Prepare statement and execute, prevents SQL injection
    $stmt = $pdo->prepare('SELECT * FROM products_tbl WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if (!$product) {
        // Simple error to display if the id for the product doesn't exist (array is empty)
        exit('Product does not exist!');
    }
} else {
    // Simple error to display if the id wasn't specified
    exit('Product does not exist!');
}
?>

<?=template_header('Product')?>

<div class="product content-wrapper">
    <div class="row">
        <!-- Main Product Image -->
        <div class="col-md-8">
            <img id="mainImage" src="public/images/imgs/<?=$product['image_url']?>" width="500" height="500" alt="<?=$product['product_name']?>" class="main-image">
        </div>

        <!-- Thumbnails Section (beside the main image) -->
        <div class="col-md-4">
            <div class="thumbnails">
                <?php if (!empty($product['thumbnail_1'])): ?>
                    <img src="public/images/imgs/<?=$product['thumbnail_1']?>" width="100" height="100" alt="Thumbnail 1" onclick="changeImage(this)">
                <?php endif; ?>
                
                <?php if (!empty($product['thumbnail_2'])): ?>
                    <img src="public/images/imgs/<?=$product['thumbnail_2']?>" width="100" height="100" alt="Thumbnail 2" onclick="changeImage(this)">
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div>
        <h1 class="product_name"><?=$product['product_name']?></h1>
        <span class="price" name='price'>
            &#8369;<?=$product['price']?>
        </span>

        <form action="index.php?page=cart" method="post">
            <input type="number" name="quantity" value="1" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required>
            <input type="hidden" name="product_id" value="<?=$product['id']?>">
            <input type="submit" value="Add To Cart" style="color:white">
        </form>

        <div class="description">
            <?=$product['description']?>
        </div>
    </div>
</div>

<!-- JavaScript for Image Switching -->
<script>
    function changeImage(thumbnail) {
        document.getElementById('mainImage').src = thumbnail.src;
    }
</script>

<?=template_footer()?>
