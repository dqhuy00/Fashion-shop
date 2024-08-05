<!-- Product -->
<div class="bg0 m-t-23 p-b-140">
    <div class="container">
        <div class="flex-w flex-sb-m p-b-52">
            <?php View('components/product/product-filter', ['category' => $category ?? []]) ?>
        </div>

        <div class="row isotope-grid">
            <?php if (!empty($products) && count($products) > 0) : ?>
                <?php foreach ($products['data'] as $value) : ?>
                    <?php View('components/product/product-cart', $value) ?>
                <?php endforeach ?>
            <?php endif ?>
        </div>

        <!-- Load more -->
        <div class="flex-c-m flex-w w-full p-t-45">
            <?php View('components/paginate', ['page' => $products['page']]); ?>
        </div>
    </div>
</div>