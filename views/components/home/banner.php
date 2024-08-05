<!-- Banner -->
<?php

$query = new Query();
if (!empty($nameBannerGroup)) {
    $bannerGroup = $query->table('banner_group')->select()->where('name', '=', $nameBannerGroup)->first();
    $banner = $query->table('banner')->select()->where('banner_group_id', '=', $bannerGroup['id'])->all();
}

?>
<div class="sec-banner bg0 p-t-80 p-b-50">
    <div class="container">
        <div class="row">
            <?php if (!empty($banner) && count($banner) > 0) : ?>
                <?php foreach ($banner as $value) : ?>
                    <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                        <!-- Block1 -->
                        <div class="block1 wrap-pic-w">
                            <img src="<?= $value['images'] ?>" alt="IMG-BANNER">

                            <a href="<?= $value['url'] ?>" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                                <div class="block1-txt-child1 flex-col-l">
                                    <span class="block1-name ltext-102 trans-04 p-b-8">
                                        <?= $value['name'] ?>
                                    </span>

                                    <span class="block1-info stext-102 trans-04">
                                        <?= $value['sub_title'] ?>
                                    </span>
                                </div>

                                <div class="block1-txt-child2 p-b-4 trans-05">
                                    <div class="block1-link stext-101 cl0 trans-09">
                                        xem thêm
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>
</div>