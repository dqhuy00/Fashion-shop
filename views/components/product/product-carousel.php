<div class="container">
    <div class="p-b-45">
        <h3 class="ltext-106 cl5 ">
            <?= $title ?>
        </h3>
    </div>

    <!-- Slide2 -->
    <?php if (!empty($products) && count($products) > 0) : ?>
        <div class="wrap-slick2">
            <div class="slick2">
                <?php foreach ($products as $value) : ?>
                    <?php View('components/product/product-cart', $value) ?>
                <?php endforeach ?>
            </div>
        </div>
    <?php endif ?>
</div>