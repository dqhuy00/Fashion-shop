<?php
$query = new Query();

$attr = $query->table('attribute')->select()->where('parent_id', '=', 0)->all();

$attr = getChillAttr($attr);


function getChillAttr($attr)
{
    global $query;
    $arr = [];
    foreach ($attr as $key => $value) {
        $attrChill = $query->table('attribute')->select()->where('parent_id', '=', $value['id'])->all();
        if (count($attrChill) > 0) {
            array_push($arr, [...$value, 'chill' => getChillAttr($attrChill)]);
        } else {
            array_push($arr, $value);
        }
    }
    return $arr;
}



?>

<div class="flex-w flex-l-m filter-tope-group m-tb-10">
    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
        tất cả
    </button>
    <?php if (!empty($category) && count($category) > 0) : ?>
        <?php foreach ($category as $value) : ?>
            <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".category-<?= $value['id'] ?>">
                <?= $value['name'] ?>
            </button>
        <?php endforeach ?>
    <?php endif ?>
</div>
<div class="flex-w flex-c-m m-tb-10">
    <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
        <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
        <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
        Lọc
    </div>

    <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
        <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
        <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
        Search
    </div>
</div>

<!-- Search product -->
<div class="dis-none panel-search w-full p-t-10 p-b-15">
    <div class="bor8 dis-flex p-l-15">
        <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
            <i class="zmdi zmdi-search"></i>
        </button>

        <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Search">
    </div>
</div>

<!-- Filter -->
<div class="dis-none panel-filter w-full p-t-10">
    <div class="row flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
        <div class="col-3 p-r-15 p-b-27">
            <div class="mtext-102 cl2 p-b-15">
                sắp xếp
            </div>

            <ul class="p-0 ">
                <li class="p-b-6">
                    <a href="<?= currentRouter([...$_GET, 'order' => 'created_at', 'direction' => 'DESC']) ?>" class="filter-link stext-106 trans-04 <?= !empty($_GET['order']) && $_GET['order'] ==  'created_at' && $_GET['direction'] == 'DESC' ? 'filter-link-active' : ''  ?> ">
                        sản phẩm mới
                    </a>
                </li>

                <li class="p-b-6">
                    <a href="<?= currentRouter([...$_GET, 'order' => 'count_views', 'direction' => 'DESC']) ?>" class="filter-link stext-106 trans-04 <?= !empty($_GET['order']) && $_GET['order'] ==  'count_views' && $_GET['direction'] == 'DESC' ? 'filter-link-active' : ''  ?> ">
                        phổ biến
                    </a>
                </li>


                <li class="p-b-6">
                    <a href=" <?= currentRouter([...$_GET, 'order' => 'price', 'direction' => 'ASC']) ?>" class="filter-link stext-106 trans-04 <?= !empty($_GET['order']) &&  $_GET['order'] ==  'price' && $_GET['direction'] == 'ASC' ? 'filter-link-active' : ''  ?> ">
                        giá từ thấp đến cao
                    </a>
                </li>

                <li class="p-b-6">
                    <a href="<?= currentRouter([...$_GET, 'order' => 'price', 'direction' => 'DESC']) ?>" class="filter-link stext-106 trans-04 <?= !empty($_GET['order']) &&  $_GET['order'] ==  'price' && $_GET['direction'] == 'DESC' ? 'filter-link-active' : ''  ?> ">
                        giá từ cao đếp thấp
                    </a>
                </li>
            </ul>
        </div>

        <div class="col-3 p-r-15 p-b-27">
            <div class="mtext-102 cl2 p-b-15">
                Theo giá
            </div>

            <ul class="p-0 ">
                <li class="p-b-6">
                    <a href="<?= currentRouter([...$_GET, 'price' => '0']) ?>" class="filter-link stext-106 trans-04 <?= !empty($_GET['price']) &&  $_GET['price'] ==  '0'  ? 'filter-link-active' : ''  ?>">
                        Tất cả
                    </a>
                </li>

                <li class="p-b-6">
                    <a href="<?= currentRouter([...$_GET, 'price' => '0-500000']) ?>" class="filter-link stext-106 trans-04 <?= !empty($_GET['price']) &&  $_GET['price'] ==  '0-500000'  ? 'filter-link-active' : ''  ?>">
                        0 - 500k
                    </a>
                </li>

                <li class="p-b-6">
                    <a href="<?= currentRouter([...$_GET, 'price' => '500000-1000000']) ?>" class="filter-link stext-106 trans-04 <?= !empty($_GET['price']) &&  $_GET['price'] ==  '500000-1000000'  ? 'filter-link-active' : ''  ?>">
                        500k - 1tr
                    </a>
                </li>

                <li class="p-b-6">
                    <a href="<?= currentRouter([...$_GET, 'price' => '1000000-2000000']) ?>" class="filter-link stext-106 trans-04 <?= !empty($_GET['price']) &&  $_GET['price'] ==  '1000000-2000000'  ? 'filter-link-active' : ''  ?>">
                        1tr - 2 tr
                    </a>
                </li>

                <li class="p-b-6">
                    <a href="<?= currentRouter([...$_GET, 'price' => '2000000']) ?>" class="filter-link stext-106 trans-04 <?= !empty($_GET['price']) &&  $_GET['price'] ==  '2000000'  ? 'filter-link-active' : ''  ?>">
                        2tr >
                    </a>
                </li>

            </ul>
        </div>
        <?php if (isset($attr) && count($attr) > 0) : ?>
            <?php foreach ($attr as $value) : ?>
                <div class="col-3 p-r-15 p-b-27">
                    <div class="mtext-102 cl2 p-b-15">
                        <?= $value['name'] ?>
                    </div>
                    <ul class="p-0 ">
                        <?php foreach ($value['chill'] as $key => $value) : ?>
                            <li class="p-b-6">
                                <?php if ($value['type'] == 'color') : ?>
                                    <span class="fs-15 lh-12 m-r-6" style="color: <?= $value['value'] ?>;">
                                        <i class="zmdi zmdi-circle"></i>
                                    </span>
                                <?php endif; ?>

                                <a href="<?= currentRouter([...$_GET, $value['type'] => $value['value']]) ?>" class="filter-link stext-106 trans-04">
                                    <?= $value['name'] ?>
                                </a>
                            </li>
                        <?php endforeach ?>
                    </ul>

                </div>
            <?php endforeach ?>
        <?php endif ?>
    </div>
</div>