<section class="bg0 p-t-104 p-b-116">
    <div class="container">
        <form action="?controller=checkout&action=create" method="post">
            <div class="flex-w flex-tr">
                <div class="size-210 bor10 p-lr-30 p-t-55 p-b-30 p-lr-15-lg w-full-md">
                    <h4 class="mtext-105 cl2 txt-center p-b-30">
                        Thông tin người nhận
                    </h4>
                    <div class=" m-b-20 ">
                        <div class=" bor8 how-pos4-parent">
                            <input class="stext-111 cl2 plh3 size-116 p-l-15 p-r-30" type="text" name="name" placeholder="họ tên người nhận" fdprocessedid="drajr">
                        </div>
                        <?php if (!empty($error['name'])) : ?> <p class="text-danger ms-1 mt-1  mb-0"><?= $error['name']['message'] ?></p> <?php endif ?>
                    </div>
                    <div class=" m-b-20 ">
                        <div class="bor8 how-pos4-parent">
                            <input class="stext-111 cl2 plh3 size-116 p-l-15 p-r-30" type="text" name="phone-number" placeholder="SĐT người nhận" fdprocessedid="drajr">
                        </div>
                        <?php if (!empty($error['phone-number'])) : ?> <p class="text-danger ms-1 mt-1  mb-0"><?= $error['phone-number']['message'] ?></p> <?php endif ?>
                    </div>
                    <div class=" m-b-20 ">
                        <div class="bor8 how-pos4-parent">
                            <input class="stext-111 cl2 plh3 size-116 p-l-15 p-r-30" type="text" name="email" placeholder="email của bạn (không bắc buộc)" fdprocessedid="drajr">
                        </div>
                        <?php if (!empty($error['email'])) : ?> <p class="text-danger ms-1 mt-1  mb-0"><?= $error['email']['message'] ?></p> <?php endif ?>
                    </div>
                    <div class=" m-b-20 ">
                        <div class="bor8 how-pos4-parent">
                            <div class="rs1-select2 bor8 bg0">
                                <select class="js-select2" name="shipper">
                                    <option value="Giao hàng tiết kiệm">Giao hàng tiết kiệm</option>
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                        </div>
                        <?php if (!empty($error['shipper'])) : ?> <p class="text-danger ms-1 mt-1  mb-0"><?= $error['shipper']['message'] ?></p> <?php endif ?>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class=" m-b-20 ">
                                <div class="how-pos4-parent bor8">
                                    <div class="rs1-select2 bor8 bg0">
                                        <select class="js-select2" name="city_​province">
                                            <option value="">TP/Tỉnh</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <?php if (!empty($error['city_​province'])) : ?> <p class="text-danger ms-1 mt-1  mb-0"><?= $error['city_​province']['message'] ?></p> <?php endif ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class=" m-b-20">
                                <div class="bor8 how-pos4-parent">
                                    <div class="rs1-select2 bor8 bg0">
                                        <select class="js-select2" name="district">
                                            <option value="">Quận/Huyện</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <?php if (!empty($error['district'])) : ?> <p class="text-danger ms-1 mt-1  mb-0"><?= $error['district']['message'] ?></p> <?php endif ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class=" m-b-20 ">
                                <div class="how-pos4-parent bor8">
                                    <div class="rs1-select2 bor8 bg0">
                                        <select class="js-select2" name="wards">
                                            <option value="">Phường/Xã</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <?php if (!empty($error['wards'])) : ?> <p class="text-danger ms-1 mt-1  mb-0"><?= $error['wards']['message'] ?></p> <?php endif ?>
                            </div>
                        </div>
                    </div>
                    <div class=" m-b-20 ">
                        <div class="how-pos4-parent bor8">
                            <input class="stext-111 cl2 plh3 size-116 p-l-15 p-r-30" type="text" name="detail_address" placeholder="địa chỉ chi tiết" fdprocessedid="drajr">
                        </div>
                        <?php if (!empty($error['detail_address'])) : ?> <p class="text-danger ms-1 mt-1  mb-0"><?= $error['detail_address']['message'] ?></p> <?php endif ?>
                    </div>
                    <div class="bor8 m-b-30">
                        <textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="note" placeholder="nghi chú"></textarea>
                        <?php if (!empty($error['note'])) : ?> <p class="text-danger ms-1 mt-1  mb-0"><?= $error['note']['message'] ?></p> <?php endif ?>
                    </div>
                    <button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer" type="submit">
                        đặt hàng
                    </button>
                </div>

                <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                    <h4 class="mtext-105 cl2 txt-center p-b-30">
                        Thông tin đơn hàng
                    </h4>
                    <div class="product">
                        <ul class="header-cart-wrapitem w-full card-product">
                        </ul>
                    </div>
                    <div class="row p-t-30">
                        <div class="col-md-12">
                            <div class="m-l-2 mb-0">
                                <input type="radio" class="btn-check" value="" name="payment" id="default" checked autocomplete="off">
                                <label class="btn btn-outline-secondary w-100" for="default"> Thanh toán khi dao hàng</label><br>
                            </div>
                            <div class="m-l-2 mb-0">
                                <input type="radio" class="btn-check" name="payment" id="payment1" value="momo" autocomplete="off">
                                <label class="btn btn-outline-secondary w-100" for="payment1">MOMO</label><br>
                            </div>
                            <div class="m-l-2 mb-0">
                                <input type="radio" class="btn-check" name="payment" id="payment2" autocomplete="off">
                                <label class="btn btn-outline-secondary w-100" for="payment2">Thẻ nội địa</label><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<script src="public/assets/vendor-web/jquery/jquery-3.2.1.min.js"></script>
<script src="public/assets/api/cart-api.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        function apiProvinces({
            url = '',
            success
        }) {
            $.ajax({
                url: 'https://provinces.open-api.vn/api/' + url,
                method: 'GET',
                success: success
            })
        }
        apiProvinces({
            success: function(data) {
                const htmlCityProvinces = data.map(function(p) {
                    return `<option value="${p.name}" data-value="${p.code}">${p.name}</option>`
                });
                htmlCityProvinces.unshift(`<option value="" >Tỉnh/TP</option>`)

                $('select[name="city_​province"]').html(htmlCityProvinces.join(''));
            }
        })
        $('select[name="city_​province"]').change(function(e) {
            const code = $('select[name="city_​province"] option:selected').attr('data-value');
            apiProvinces({
                success: function(data) {
                    const htmlDistricts = data.districts.map(function(p) {
                        return `<option value="${p.name}" data-value="${p.code}">${p.name}</option>`
                    });

                    htmlDistricts.unshift(`<option value="" >Quận/huyện</option>`);

                    $('select[name="district"]').html(htmlDistricts.join(''));
                },
                url: 'p/' + code + '?depth=2'
            })
        })
        $('select[name="district"]').change(function(e) {
            const code = $('select[name="district"] option:selected').attr('data-value');
            apiProvinces({
                success: function(data) {
                    const wards = data.wards.map(function(p) {
                        return `<option value="${p.name}" data-value="${p.code}">${p.name}</option>`
                    });
                    wards.unshift(`<option value="" >phường/xã</option>`);
                    $('select[name="wards"]').html(wards.join(' '));
                },
                url: 'd/' + code + '?depth=2'
            })
        })
        apiCart.all({
            'url': 'action=products_cart',
            success: function(data) {
                console.log(Object.values(JSON.parse(data)));
                $('.card-product').html(Object.values(JSON.parse(data)).map(function(product) {
                    const attr = product.attr.map(attr => attr.name).join('-');
                    return `                        <li class="header-cart-item flex-w flex-t m-b-12">
                            <div class="header-cart-item-img">
                                <img src="${product.images}" alt="IMG">
                            </div>
                            <div class="header-cart-item-txt p-t-8">
                                <a href="?controller&action=detail&id=${product.product_id}" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                    ${product.name} ${attr}
                                </a>
                                <span class="header-cart-item-info">
                                    ${product.quantity} x  ${product.price}
                                </span>
                            </div>
                        </li>`;
                }))
            }
        })
    })
</script>