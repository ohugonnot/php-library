<?php

require_once __DIR__.'/vendor/autoload.php';
require_once "Book.php";
require_once "Bibliotheque.php";

use League\Csv\Reader;

try {
    // throw new Exception('Exception message');
    $csvReader = Reader::createFromPath('books.csv', 'r');
    $csvReader->setHeaderOffset(0);
    $bookRecords = $csvReader->getRecords();
    $books = [];
    foreach($bookRecords as $bookRecord) {
        $books[] = new Book($bookRecord);
    }
    $bibliotheque = new Bibliotheque($books);
    dump($bibliotheque);
} catch(Exception $e) {
    $file = fopen("books.csv", 'rb');
    $i = 0;
    $headers = [];
    $books = [];
    while(!feof($file))
    {
        $book = fgetcsv($file);
        if($i === 0) {
            $i++;
            $headers = $book;
            continue;
        }

        if(is_array($book)) {
            foreach($book as $k=>$value) {
                $book[$headers[$k]] = $value;
                unset($book[$k]);
            }
            $books[] = new Book($book);
        }
        $i++;
    }
    fclose($file);
    $bibliotheque = new Bibliotheque($books);
}

if(isset($_GET['search'])) {
    $bibliotheque->search($_GET['search']);
}

if(isset($_GET['genre'])) {
    $bibliotheque->findBooksByGenre($_GET['genre']);
}

if(isset($_GET['sortBy'])) {
    $bibliotheque->sortBy($_GET['sortBy']);
}
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Shop-Grid | Books Library eCommerce Store</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicons -->
    <link rel="shortcut icon" href="https://template.hasthemes.com/boighor/boighor/images/favicon.ico">
    <link rel="apple-touch-icon" href="https://template.hasthemes.com/boighor/boighor/images/icon.png">

    <!-- Google font (font-family: 'Roboto', sans-serif; Poppins ; Satisfy) -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,600,600i,700,700i,800"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">

    <style>
        .ht__breadcrumb__area {
            padding-bottom: 20px !important;
            padding-top: 60px !important;
        }
        .product .product__content .action {
            top: 360px !important;
        }
        .product:hover .product__content h4, .product:hover .product__content ul.price {
            opacity: 0.5 !important;
            visibility: visible !important;
        }
        .copyright{
            display: none;
        }
    </style>
    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://template.hasthemes.com/boighor/boighor/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://template.hasthemes.com/boighor/boighor/css/plugins.css">
    <link rel="stylesheet" href="https://template.hasthemes.com/boighor/boighor/css/style.css">

    <!-- Cusom css -->
    <link rel="stylesheet" href="https://template.hasthemes.com/boighor/boighor/css/custom.css">

    <!-- Modernizer js -->
    <script src="https://template.hasthemes.com/boighor/boighor/js/vendor/modernizr-3.5.0.min.js"></script>
</head>

<body>
<!-- Main wrapper -->
<div class="wrapper" id="wrapper">
    <!-- Header -->
    <header id="wn__header" class="oth-page header__area header__absolute sticky__header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-7 col-lg-2">
                    <div class="logo">
                        <a href="index.php">
                            <img src="https://template.hasthemes.com/boighor/boighor/images/logo/logo.png" alt="logo images">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8 d-none d-lg-block">
                    <nav class="mainmenu__nav">
                        <ul class="meninmenu d-flex justify-content-start">
                            <li class="drop with--one--item"><a href="index.php">Home</a></li>
                            <li><a href="contact.php">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-8 col-sm-8 col-5 col-lg-2">
                    <ul class="header__sidebar__right d-flex justify-content-end align-items-center">
                        <li class="shop_search"><a class="search__active" href="#"></a></li>
                        <li class="wishlist"><a href="#"></a></li>
                        <li class="shopcart"><a class="cartbox_active" href="#"><span
                                    class="product_qun">3</span></a>
                            <!-- Start Shopping Cart -->
                            <div class="block-minicart minicart__active">
                                <div class="minicart-content-wrapper">
                                    <div class="micart__close">
                                        <span>close</span>
                                    </div>
                                    <div class="items-total d-flex justify-content-between">
                                        <span>3 items</span>
                                        <span>Cart Subtotal</span>
                                    </div>
                                    <div class="total_amount text-end">
                                        <span>$66.00</span>
                                    </div>
                                    <div class="mini_action checkout">
                                        <a class="checkout__btn" href="cart.php">Go to Checkout</a>
                                    </div>
                                    <div class="single__items">
                                        <div class="miniproduct">
                                            <div class="item01 d-flex">
                                                <div class="thumb">
                                                    <a href=""><img
                                                            src="https://template.hasthemes.com/boighor/boighor/images/product/sm-img/1.jpg"
                                                            alt="product images"></a>
                                                </div>
                                                <div class="content">
                                                    <h6><a href="">Voyage Yoga Bag</a></h6>
                                                    <span class="price">$30.00</span>
                                                    <div class="product_price d-flex justify-content-between">
                                                        <span class="qun">Qty: 01</span>
                                                        <ul class="d-flex justify-content-end">
                                                            <li><a href="#"><i class="zmdi zmdi-settings"></i></a>
                                                            </li>
                                                            <li><a href="#"><i class="zmdi zmdi-delete"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item01 d-flex mt--20">
                                                <div class="thumb">
                                                    <a href=""><img
                                                            src="https://template.hasthemes.com/boighor/boighor/images/product/sm-img/3.jpg"
                                                            alt="product images"></a>
                                                </div>
                                                <div class="content">
                                                    <h6><a href="">Impulse Duffle</a></h6>
                                                    <span class="price">$40.00</span>
                                                    <div class="product_price d-flex justify-content-between">
                                                        <span class="qun">Qty: 03</span>
                                                        <ul class="d-flex justify-content-end">
                                                            <li><a href="#"><i class="zmdi zmdi-settings"></i></a>
                                                            </li>
                                                            <li><a href="#"><i class="zmdi zmdi-delete"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item01 d-flex mt--20">
                                                <div class="thumb">
                                                    <a href=""><img
                                                            src="https://template.hasthemes.com/boighor/boighor/images/product/sm-img/2.jpg"
                                                            alt="product images"></a>
                                                </div>
                                                <div class="content">
                                                    <h6><a href="">Compete Track Tote</a></h6>
                                                    <span class="price">$40.00</span>
                                                    <div class="product_price d-flex justify-content-between">
                                                        <span class="qun">Qty: 03</span>
                                                        <ul class="d-flex justify-content-end">
                                                            <li><a href="#"><i class="zmdi zmdi-settings"></i></a>
                                                            </li>
                                                            <li><a href="#"><i class="zmdi zmdi-delete"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mini_action cart">
                                        <a class="cart__btn" href="cart.php">View and edit cart</a>
                                    </div>
                                </div>
                            </div>
                            <!-- End Shopping Cart -->
                        </li>
                        <li class="setting__bar__icon"><a class="setting__active" href="#"></a>
                            <div class="searchbar__content setting__block">
                                <div class="content-inner">
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Start Mobile Menu -->
            <div class="row d-none">
                <div class="col-lg-12 d-none">
                    <nav class="mobilemenu__nav">
                        <ul class="meninmenu">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="contact.php">Contact</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- End Mobile Menu -->
            <div class="mobile-menu d-block d-lg-none">
            </div>
            <!-- Mobile Menu -->
        </div>
    </header>
    <!-- //Header -->
    <!-- Start Search Popup -->
    <div class="box-search-content search_active block-bg close__top">
        <form id="search_mini_form" class="minisearch" action="" method="GET">
            <div class="field__search">
                <?php foreach ($_GET as $k => $v) {
                    if($k !== "search") { ?>
                    <input type="hidden" name="<?= $k ?>" value="<?= $v ?>" placeholder="Search entire store here...">
                <?php }
                } ?>
                <input type="text" name="search" placeholder="Search entire store here...">
                <div class="action">
                    <a href="#" id="submit-search"><i class="zmdi zmdi-search"></i></a>
                </div>
                <script>
                    document.getElementById("submit-search").addEventListener("click", function(e) {
                        e.preventDefault();
                        document.getElementById("search_mini_form").submit();
                    })
                </script>
            </div>
        </form>
        <div class="close__wrap">
            <span>close</span>
        </div>
    </div>
    <!-- End Search Popup -->
    <!-- Start breadcrumb area -->
    <div class="ht__breadcrumb__area bg-image--6">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__inner text-center">
                        <h2 class="breadcrumb-title">Shop Grid</h2>
                        <nav class="breadcrumb-content">
                            <a class="breadcrumb_item" href="index.php">Home</a>
                            <span class="brd-separator">/</span>
                            <span class="breadcrumb_item active">Shop Grid</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End breadcrumb area -->
    <!-- Start Shop Page -->
    <div class="page-shop-sidebar left--sidebar bg--white section-padding--lg">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12 order-2 order-lg-1 md-mt-40 sm-mt-40">
                    <div class="shop__sidebar">
                        <aside class="widget__categories products--cat">
                            <h3 class="widget__title">Book Genres</h3>
                            <ul>
                                <?php foreach($bibliotheque->genres as $genre => $nb) { ?>
                                <li><a <?php if(($_GET['genre']??null) === $genre) { ?>style="color: #ce7852;" <?php } ?> href="?genre=<?= $genre ?>"><?= $genre ?> <span>(<?= $nb ?>)</span></a></li>
                                <?php } ?>
                            </ul>
                        </aside>
                        <aside class="widget__categories pro--range">
                            <h3 class="widget__title">Filter by price</h3>
                            <div class="content-shopby">
                                <div class="price_filter s-filter clear">
                                    <form action="#" method="GET">
                                        <div id="slider-range"></div>
                                        <div class="slider__range--output">
                                            <div class="price__output--wrap">
                                                <div class="price--output">
                                                    <span>Price :</span><input type="text" id="amount" readonly="">
                                                </div>
                                                <div class="price--filter">
                                                    <a href="#">Filter</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
                <div class="col-lg-9 col-12 order-1 order-lg-2">
                    <div class="row">
                        <div class="col-lg-12">
                            <div
                                class="shop__list__wrapper d-flex flex-wrap flex-md-nowrap justify-content-between">
                                <div class="shop__list nav justify-content-center" role="tablist">
                                    <a class="nav-item nav-link active" data-bs-toggle="tab" href="#nav-grid"
                                       role="tab"><i class="fa fa-th"></i></a>
                                    <a class="nav-item nav-link" data-bs-toggle="tab" href="#nav-list" role="tab"><i
                                            class="fa fa-list"></i></a>
                                </div>
                                <p>Showing <?= count($bibliotheque->selected_books) ?> results</p>
                                <div class="orderby__wrapper">
                                    <span>Sort By</span>
                                        <form id="sortByForm" action="" method="GET">
                                            <select id="sortBySelect" name="sortBy" class="shot__byselect">
                                                <option value="null" <?php if(isset($_GET['sortBy']) && $_GET['sortBy'] === "null" ) { echo "selected";} ?>></option>
                                                <option value="title" <?php if(isset($_GET['sortBy']) && $_GET['sortBy'] === "title" ) { echo "selected";} ?>>Title</option>
                                                <option value="author" <?php if(isset($_GET['sortBy']) && $_GET['sortBy'] === "author" ) { echo "selected";} ?>>Author</option>
                                                <option value="rating" <?php if(isset($_GET['sortBy']) && $_GET['sortBy'] === "rating" ) { echo "selected";} ?>>Note</option>
                                            </select>
                                        <script>
                                            document.getElementById("sortBySelect").addEventListener('change', function() {
                                                let href = new URL(window.location.href);
                                                href.searchParams.set('sortBy',document.getElementById("sortBySelect").value);
                                                location.href = href;
                                                return false;
                                            })
                                        </script>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab__container tab-content">
                        <div class="shop-grid tab-pane fade show active" id="nav-grid" role="tabpanel">
                            <div class="row">
                                <?php foreach($bibliotheque->selected_books as $book) { ?>
                                <!-- Start Single Product -->
                                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                    <div class="product__thumb">
                                        <a class="first__img" href=""><img height="370"
                                                src="<?= $book->img ?>" alt="product image"></a>
                                        <?php if (count($book->awards) >= 5) { ?>
                                        <div class="hot__box">
                                            <span class="hot-label">(<?= count($book->awards) ?>) awards</span>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="product__content content--center">
                                        <h4><a href=""><?= $book->getAuthor() ?></a></h4>
                                       <div><?= $book->title ?></div>
                                        <div class="action">
                                            <div class="actions_inner">
                                                <ul class="add_to_links">
                                                    <li><a class="cart" href=""><i
                                                                class="bi bi-shopping-bag4"></i></a></li>
                                                    <li><a class="wishlist" href=""><i
                                                                class="bi bi-shopping-cart-full"></i></a></li>
                                                    <li><a data-bs-toggle="modal" title="Quick View"
                                                           class="quickview modal-view detail-link"
                                                           href="#productmodal"><i class="bi bi-search"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product__hover--content">
                                            <?= $book->getStars() ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Product -->
                                <?php } ?>
                            </div>
                        </div>
                        <div class="shop-grid tab-pane fade" id="nav-list" role="tabpanel">
                            <div class="list__view__wrapper">
                                <?php foreach($bibliotheque->selected_books as $book) { ?>
                                <!-- Start Single Product -->
                                <div class="list__view mt--40">
                                    <div class="thumb">
                                        <a class="first__img" href=""><img
                                                src="<?= $book->img ?>" alt="product images"></a>
                                        <a class="second__img animation1" href=""><img
                                                src="<?= $book->img ?>" alt="product images"></a>
                                    </div>
                                    <div class="content">
                                        <h2><a href="">Titre : <?= $book->title ?></a></h2>
                                        <strong><a href="">Auteur : <?= $book->getAuthor() ?></a></strong>
                                        <p>Note : <?= $book->rating ?></p>
                                        <?= $book->getStars() ?>
                                        <p><?= $book->description ?></p>
                                        <ul class="cart__action d-flex">
                                            <li class="cart"><a href="">Add to cart</a></li>
                                            <li class="wishlist"><a href=""></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- End Single Product -->
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Shop Page -->
    <!-- Footer Area -->
    <footer id="wn__footer" class="footer__area bg__cat--8 brown--color">
        <div class="footer-static-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer__widget footer__menu">
                            <div class="ft__logo">
                                <a href="">
                                    <img src="https://template.hasthemes.com/boighor/boighor/images/logo/3.png" alt="logo">
                                </a>
                            </div>
                            <div class="footer__content">
                                <ul class="social__net social__net--2 d-flex justify-content-center">
                                    <li><a href="#"><i class="bi bi-facebook"></i></a></li>
                                    <li><a href="#"><i class="bi bi-google"></i></a></li>
                                    <li><a href="#"><i class="bi bi-twitter"></i></a></li>
                                    <li><a href="#"><i class="bi bi-linkedin"></i></a></li>
                                    <li><a href="#"><i class="bi bi-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright__wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="copyright">
                            <div class="copy__right__inner text-start">
                                <p>&copy; 2021, Boighor. Made with <i class="fa fa-heart text-danger"></i> by <a
                                        href="//hasthemes.com" target="_blank">HasThemes</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="payment text-end">
                            <img src="https://template.hasthemes.com/boighor/boighor/images/icons/payment.png" alt=""/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- //Footer Area -->
    <!-- QUICKVIEW PRODUCT -->
    <div id="quickview-wrapper">
        <!-- Modal -->
        <div class="modal fade" id="productmodal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal__container" role="document">
                <div class="modal-content">
                    <div class="modal-header modal__header">
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-product">
                            <!-- Start product images -->
                            <div class="product-images">
                                <div class="main-image images">
                                    <img alt="big images" src="https://template.hasthemes.com/boighor/boighor/images/product/big-img/1.jpg">
                                </div>
                            </div>
                            <!-- end product images -->
                            <div class="product-info">
                                <h1>Simple Fabric Bags</h1>
                                <div class="rating__and__review">
                                    <ul class="rating">
                                        <li><span class="ti-star"></span></li>
                                        <li><span class="ti-star"></span></li>
                                        <li><span class="ti-star"></span></li>
                                        <li><span class="ti-star"></span></li>
                                        <li><span class="ti-star"></span></li>
                                    </ul>
                                    <div class="review">
                                        <a href="#">4 customer reviews</a>
                                    </div>
                                </div>
                                <div class="price-box-3">
                                    <div class="s-price-box">
                                        <span class="new-price">$17.20</span>
                                        <span class="old-price">$45.00</span>
                                    </div>
                                </div>
                                <div class="quick-desc">
                                    Designed for simplicity and made from high quality materials. Its sleek geometry
                                    and material combinations creates a modern look.
                                </div>
                                <div class="addtocart-btn">
                                    <a href="#">Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END QUICKVIEW PRODUCT -->
</div>
<!-- //Main wrapper -->
<!-- JS Files -->
<script src="https://template.hasthemes.com/boighor/boighor/js/vendor/jquery.min.js"></script>
<script src="https://template.hasthemes.com/boighor/boighor/js/popper.min.js"></script>
<script src="https://template.hasthemes.com/boighor/boighor/js/vendor/bootstrap.min.js"></script>
<script src="https://template.hasthemes.com/boighor/boighor/js/plugins.js"></script>
<script src="https://template.hasthemes.com/boighor/boighor/js/active.js"></script>

</body>

</html>