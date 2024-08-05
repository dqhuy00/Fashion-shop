<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2">
                giỏ hàng
            </span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        <div class="header-cart-content flex-w js-pscroll ">

            <ul class="header-cart-wrapitem w-full" id="cart">

            </ul>
            <div class="w-full">
                <div class="header-cart-total w-full p-tb-40">

                </div>

                <div class="header-cart-buttons flex-w w-full">
                    <a href="?controller=shop&action=cart" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                        Giỏ hàng
                    </a>

                    <a href="?controller=checkout" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                        thanh toán
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener('load', handleLoadCart());

    function handleClickDeleteCart(e) {
        fetch(e.currentTarget.dataset.value)
            .then(res => res.json)
            .then(data => {
                console.log(1)
                handleLoadCart();
            })
    }

    function handleLoadCart() {
        const xhttp = new XMLHttpRequest();
        xhttp.open('GET', '?controller=shop&action=cart_header');
        xhttp.onload = function() {
            document.querySelector('#cart').innerHTML = this.responseText;
        };
        xhttp.send();
    }
</script>