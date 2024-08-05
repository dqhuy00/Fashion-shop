<?php if (!empty($product_reviews) && count($product_reviews) > 0) : ?>
    <?php foreach ($product_reviews as $key => $value) : ?>
        <div class="flex-w flex-t p-b-68">
            <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                <img src="public/assets/images/avatar-01.jpg" alt="AVATAR">
            </div>
            <div class="size-207">
                <div class="flex-w flex-sb-m p-b-17">
                    <span class="mtext-107 cl2 p-r-20">
                        <?= $value['name'] ?>
                    </span>
                    <span class="fs-18 cl11">
                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                            <?php if ($i <= $value['scores']) : ?>
                                <i class="zmdi zmdi-star"></i>
                            <?php else : ?>
                                <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                            <?php endif; ?>
                        <?php endfor ?>
                    </span>
                </div>

                <p class="stext-102 cl6">
                    <?= $value['text'] ?>
                </p>
            </div>
        </div>
    <?php endforeach ?>
<?php endif ?>