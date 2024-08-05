<?php
$query = new Query();
$menu = $query->table('menus')->select('*')->where('parent_id', '=', 0)->all();
$cart = session_get('product_cart');
$current_user = session_get('current_user');
function renderChildMenu($parent_id)
{
    global $query;
    $menuChild = $query->table('menus')->select('*')->where('parent_id', '=', $parent_id)->all();
    if (!empty($menuChild) && count($menuChild) > 0) {
        echo '<ul class="sub-menu">';
        foreach ($menuChild as $value) {
            echo '<li><a href="' . $value['url'] . '">' . $value['name'] . '</a>
            ' . renderChildMenu($value['id']) . '
            </li>';
        }
        echo '</ul>';
    }
}
?>

<!-- Header -->
<header class="header-v4">
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <!-- Topbar -->
        <div class="top-bar">
            <div class="content-topbar flex-sb-m h-full container">
                <div class="left-top-bar">
                    Free shipping for standard order over $100
                </div>

                <div class="right-top-bar flex-w h-full">
                    <a href="#" class="flex-c-m trans-04 p-lr-25">
                        Help & FAQs
                    </a>

                    <a href="#" class="flex-c-m trans-04 p-lr-25">
                        My Account
                    </a>

                    <a href="#" class="flex-c-m trans-04 p-lr-25">
                        EN
                    </a>

                    <a href="#" class="flex-c-m trans-04 p-lr-25">
                        USD
                    </a>
                </div>
            </div>
        </div>

        <div class="wrap-menu-desktop how-shadow1">
            <nav class="limiter-menu-desktop container">

                <!-- Logo desktop -->
                <a href="" class="logo d-flex  align-align-items-center justify-content-start " style="text-decoration:none;">
                    <img src="public/logo.png" alt="IMG-LOGO">
                    <p class="text-uppercase fw-bold m-0 ms-2" style="color: #333333;">SUNFLOWER</p>
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <?php if (!empty($menu) && count($menu) > 0) : ?>
                            <?php foreach ($menu as $value) : ?>
                                <!-- 'active-menu' -->
                                <li class="">
                                    <a href="<?= $value['url'] ?>" style="text-decoration:none;"><?= $value['name'] ?></a>
                                    <?= renderChildMenu($value['id']) ?>
                                </li>
                            <?php endforeach ?>
                        <?php endif ?>
                        <!-- <li class="label1" data-label1="hot">
                            <a href="shoping-cart.html">Features</a>
                        </li> -->
                    </ul>
                </div>

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                        <i class="zmdi zmdi-search"></i>
                    </div>

                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="<?= count($cart) ?>">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>

                    <a href="#" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="0">
                        <i class="zmdi zmdi-favorite-outline"></i>
                    </a>
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-11 account ">
                        <div class="d-flex align-items-center  ">
                            <i class="zmdi zmdi-account-circle"></i>
                            <span style="font-size: 15px; margin-left: 10px;"> <?= $current_user['name'] ?? '' ?></span>
                        </div>

                        <ul class="sub-menu" style="top:calc(100% + 10px); left: 0;">
                            <?php if (!empty($current_user['id'])) : ?>
                                <li><a href="?controller=shop&amp;page=1&amp;category=26">điểm : 0</a>
                                </li>
                                <li><a href="?controller=shop&amp;page=1&amp;category=26">tài khoản</a>
                                </li>
                                <li><a href="?controller=auth&action=logout">đăng xuất</a>
                                </li>
                            <?php else : ?>
                                <li><a href="?controller=auth&action=login_user">đăng nhập</a>
                                </li>
                            <?php endif ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <div class="logo-mobile">
            <a href="/"><img src="public/assets/images/icons/logo-01.png" alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                <i class="zmdi zmdi-search"></i>
            </div>

            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="<?= count($cart) ?>">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>

            <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="0">
                <i class="zmdi zmdi-favorite-outline"></i>
            </a>
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                <i class="zmdi zmdi-account-circle"></i>

            </div>
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="topbar-mobile">
            <li>
                <div class="left-top-bar">
                    Free shipping for standard order over $100
                </div>
            </li>

            <li>
                <div class="right-top-bar flex-w h-full">
                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        Help & FAQs
                    </a>

                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        My Account
                    </a>

                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        EN
                    </a>

                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        USD
                    </a>
                </div>
            </li>
        </ul>

        <ul class="main-menu-m">
            <li>
                <a href="index.html">Home</a>
                <ul class="sub-menu-m">
                    <li><a href="index.html">Homepage 1</a></li>
                    <li><a href="home-02.html">Homepage 2</a></li>
                    <li><a href="home-03.html">Homepage 3</a></li>
                </ul>
                <span class="arrow-main-menu-m">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </span>
            </li>

            <li>
                <a href="product.html">Shop</a>
            </li>

            <li>
                <a href="shoping-cart.html" class="label1 rs1" data-label1="hot">Features</a>
            </li>

            <li>
                <a href="blog.html">Blog</a>
            </li>

            <li>
                <a href="about.html">About</a>
            </li>

            <li>
                <a href="contact.html">Contact</a>
            </li>
        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="images/icons/icon-close2.png" alt="CLOSE">
            </button>

            <form class="wrap-search-header flex-w p-l-15">
                <button class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="search" placeholder="Search...">
            </form>
        </div>
    </div>
</header>