<style>
    .slick-track {
        min-width: 100%;
    }
</style>

<!-- Product Detail -->
<section class="sec-product-detail bg0 p-t-65 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-7 p-b-30">
                <div class="p-l-25 p-r-30 p-lr-0-lg">
                    <div class="wrap-slick3 flex-sb flex-w">
                        <div class="wrap-slick3-dots">
                        </div>
                        <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>
                        <div class="slick3 gallery-lb">
                            <?php if ($product['images_list'] && count($product['images_list']) > 0) : ?>
                                <?php foreach ($product['images_list'] as $value) : ?>
                                    <div class="item-slick3" data-thumb="<?= $value['image_url'] ?>">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="<?= $value['image_url'] ?>" alt="IMG-PRODUCT">
                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="<?= $value['image_url'] ?>">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-5 p-b-30">
                <div class="p-r-50 p-t-5 p-lr-0-lg">
                    <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                        <?= $product['name'] ?>
                    </h4>

                    <span class="mtext-106 cl2 price-product-detail">
                        <?php if ($product['discount'] > 0) : ?>
                            <?= number_format($product['discount'])  ?> đ
                            <del><?= number_format($product['price']) ?> đ </del>
                        <?php else : ?>
                            <?= number_format($product['price'])  ?> đ
                        <?php endif; ?>
                    </span>

                    <!--  -->
                    <div class="p-t-33">
                        <form action="?controller=shop&action=add-cart&id=<?= $product['id'] ?>" class="form-cart" method="post" name="review-product">
                            <div class="attr">
                                <?php View('components/attribute', ['attribute' => $attr]); ?>
                            </div>
                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-204 flex-w flex-m respon6-next">
                                    <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                        <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-minus"></i>
                                        </div>

                                        <input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1" max="<?= $product['quantity'] ?? 0 ?>">

                                        <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-plus"></i>
                                        </div>
                                    </div>
                                    <button type="submit" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                        thêm vào giỏ hàng
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!--  -->
                    <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                        <div class="flex-m bor9 p-r-10 m-r-11">
                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">
                                <i class="zmdi zmdi-favorite"></i>
                            </a>
                        </div>

                        <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
                            <i class="fa fa-facebook"></i>
                        </a>

                        <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
                            <i class="fa fa-twitter"></i>
                        </a>

                        <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
                            <i class="fa fa-google-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="bor10 m-t-50 p-t-43 p-b-40">
            <!-- Tab01 -->
            <div class="tab01">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item p-b-10">
                        <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Mô tả </a>
                    </li>

                    <li class="nav-item p-b-10">
                        <a class="nav-link" data-toggle="tab" href="#information" role="tab">Thông tin </a>
                    </li>

                    <li class="nav-item p-b-10">
                        <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Đánh giá (<?= count($productReviews) ?? 0 ?>)</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content p-t-43">
                    <!-- - -->
                    <div class="tab-pane fade show active" id="description" role="tabpanel">
                        <div class="how-pos2 p-lr-15-md">
                            <?= $product['description'] ?>
                            <!-- <p class="stext-102 cl6">
                                Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus et elementum sed, sodales vitae eros. Ut ex quam, porta consequat interdum in, faucibus eu velit. Quisque rhoncus ex ac libero varius molestie. Aenean tempor sit amet orci nec iaculis. Cras sit amet nulla libero. Curabitur dignissim, nunc nec laoreet consequat, purus nunc porta lacus, vel efficitur tellus augue in ipsum. Cras in arcu sed metus rutrum iaculis. Nulla non tempor erat. Duis in egestas nunc.
                            </p> -->
                        </div>
                    </div>

                    <!-- - -->
                    <div class="tab-pane fade" id="information" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                <ul class="p-lr-28 p-lr-15-sm">
                                    <li class="flex-w flex-t p-b-7">
                                        <span class="stext-102 cl3 size-205">
                                            Weight
                                        </span>

                                        <span class="stext-102 cl6 size-206">
                                            0.79 kg
                                        </span>
                                    </li>

                                    <li class="flex-w flex-t p-b-7">
                                        <span class="stext-102 cl3 size-205">
                                            Dimensions
                                        </span>

                                        <span class="stext-102 cl6 size-206">
                                            110 x 33 x 100 cm
                                        </span>
                                    </li>

                                    <li class="flex-w flex-t p-b-7">
                                        <span class="stext-102 cl3 size-205">
                                            Materials
                                        </span>

                                        <span class="stext-102 cl6 size-206">
                                            60% cotton
                                        </span>
                                    </li>

                                    <li class="flex-w flex-t p-b-7">
                                        <span class="stext-102 cl3 size-205">
                                            Color
                                        </span>

                                        <span class="stext-102 cl6 size-206">
                                            Black, Blue, Grey, Green, Red, White
                                        </span>
                                    </li>

                                    <li class="flex-w flex-t p-b-7">
                                        <span class="stext-102 cl3 size-205">
                                            Size
                                        </span>

                                        <span class="stext-102 cl6 size-206">
                                            XL, L, M, S
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- - -->
                    <div class="tab-pane fade" id="reviews" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                <div class="p-b-30 m-lr-15-sm review-product">
                                    <!-- Review -->

                                </div>
                                <!-- Add review -->
                                <form action="?controller=review&action=create&id=<?= $product['id'] ?>" class="w-full" method="post" onsubmit="handleSubmitReivewProduct(event)">
                                    <h5 class="mtext-108 cl2 p-b-7">
                                        đánh giá sản phẩm
                                    </h5>

                                    <p class="stext-102 cl6">
                                        Địa chỉ email của bạn sẽ không được công bố. Các trường bắt buộc được đánh dấu *
                                    </p>

                                    <div class="flex-w flex-m p-t-50 p-b-23">
                                        <span class="stext-102 cl3 m-r-16">
                                            Đánh giá của bạn
                                        </span>

                                        <span class="wrap-rating fs-18 cl11 pointer">
                                            <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                            <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                            <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                            <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                            <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                            <input class="dis-none" type="number" name="rating">
                                        </span>
                                    </div>

                                    <div class="row p-b-25">
                                        <div class="col-12 p-b-5">
                                            <label class="stext-102 cl3" for="review">Your review</label>
                                            <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="review"></textarea>
                                        </div>

                                        <div class="col-sm-6 p-b-5">
                                            <label class="stext-102 cl3" for="name">Name</label>
                                            <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name" type="text" name="name">
                                        </div>

                                        <div class="col-sm-6 p-b-5">
                                            <label class="stext-102 cl3" for="email">Email</label>
                                            <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email" type="text" name="email">
                                        </div>
                                    </div>

                                    <button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                                        đánh giá
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
        <span class="stext-107 cl6 p-lr-25">
            SKU: JAK-01
        </span>

        <span class="stext-107 cl6 p-lr-25">
            Categories: Jacket, Men
        </span>
    </div>
</section>


<!-- Related Products -->
<section class="sec-relate-product bg0 p-t-45 p-b-105">
    <div class="container">
        <div class="p-b-45">
            <h3 class="ltext-106 cl5 txt-center">
                Sản phẩm tương tự
            </h3>
        </div>

        <!-- Slide2 -->
        <?php if (!empty($similarProducts) && count($similarProducts) > 0) : ?>
            <div class="wrap-slick2">
                <div class="slick2">
                    <?php foreach ($similarProducts as $value) : ?>
                        <?php View('components/product/product-cart', $value) ?>
                    <?php endforeach ?>
                </div>
            </div>
        <?php endif ?>
    </div>
</section>
<script>
    const xhttpl = new XMLHttpRequest();

    function handleSubmitReivewProduct(e) {
        e.preventDefault();
        let data = '';
        const dataForm = new FormData(e.currentTarget);
        dataForm.forEach(function(dataf, key) {
            data += key + '=' + dataf + "&";
        });
        xhttpl.open(e.currentTarget.method, e.currentTarget.action);
        xhttpl.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttpl.onload = function() {
            loadPrivewProduct(<?= $_GET['id'] ?>);
            swal("Bình luận", "thêm thành công", "success");
            e.querySelectorAll('input').forEach(function(element) {
                element.value = '';
            })
        }
        xhttpl.onerror = function() {
            swal("Bình luận", "thêm thất bại", "erorr");
        }
        xhttpl.send(data);
    }


    window.onload = function() {
        loadPrivewProduct(<?= $_GET['id'] ?>);
    };

    function loadPrivewProduct(id) {
        xhttpl.open('GET', '?controller=review&action=show_preview&id=' + id);
        xhttpl.onload = function() {
            document.querySelector('.review-product').innerHTML = this.responseText;
        }
        xhttpl.send();
    }
</script>