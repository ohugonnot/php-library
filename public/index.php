<?php
require dirname(__DIR__) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";
$bibliotheque = new App\Bibliotheque(dirname(__DIR__) . DIRECTORY_SEPARATOR ."data/books.csv");
if(isset($_GET['category'])){
    $bibliotheque->setSelectedBookFromCategory($_GET['category']);
}
if(isset($_GET['search'])){
    $bibliotheque->searchByTitle($_GET['search']);
}
if(isset($_POST['sortby'])){
    $bibliotheque->setSelectedBookSortBy($_POST['sortby'],$_POST['asc']);
}
?>

<!DOCTYPE html>
<!-- saved from url=(0061)https://template.hasthemes.com/boighor/boighor/shop-grid.html -->
<html class="js sizes customelements history pointerevents postmessage webgl websockets cssanimations csscolumns csscolumns-width csscolumns-span csscolumns-fill csscolumns-gap csscolumns-rule csscolumns-rulecolor csscolumns-rulestyle csscolumns-rulewidth csscolumns-breakbefore csscolumns-breakafter csscolumns-breakinside flexbox picture srcset webworkers" lang="zxx"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Book-Grid | Books Library eCommerce Store</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicons -->
    <link rel="shortcut icon" href="https://template.hasthemes.com/boighor/boighor/images/favicon.ico">
    <link rel="apple-touch-icon" href="https://template.hasthemes.com/boighor/boighor/images/icon.png">

    <!-- Google font (font-family: 'Roboto', sans-serif; Poppins ; Satisfy) -->
    <link href="css/typo1.css" rel="stylesheet">
    <link href="css/typo2.css" rel="stylesheet">
    <link href="css/typo3.css" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/plugins.css">
    <link rel="stylesheet" href="css/style.css">

    <!-- Cusom css -->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Cusom css -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- Modernizer js -->
    <script src="javascript/modernizr-3.5.0.min.js"></script>
<style type="text/css"></style><style type="text/css">.fancybox-margin{margin-right:17px;}</style></head>

<body>
<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade
    your browser</a> to improve your experience and security.</p>
<![endif]-->

<!-- Main wrapper -->
<div class="wrapper" id="wrapper">

    <!-- Header -->
    <header id="wn__header" class="oth-page header__area header__absolute sticky__header is-sticky">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-7 col-lg-2">
                    <div class="logo">
                        <a href="index.php#">
                            <img src="images/logo.png" alt="logo images">
                        </a>
                    </div>
                </div>
                <div class="col-md-8 col-sm-8 col-5 col-lg-2">
                    <ul class="header__sidebar__right d-flex justify-content-end align-items-center">
                        <li class="shop_search"><a class="search__active" href="#"></a></li>
                    </ul>
                </div>
            </div>
            <!-- Start Mobile Menu -->
            <div class="row d-none">
                <div class="col-lg-12 d-none">
                    <nav class="mobilemenu__nav" style="display: block;">
                        <ul class="meninmenu">
                            <li><a href="index.php#">Home</a><li>
                            <li class="shop_search"><a class="search__active" href="#"></a></li>
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
    <div class="box-search-content search_active block-bg close__top">
        <form id="search_mini_form" class="minisearch" action="index.php" metyhod="post" onchange='this.submit()'>
            <div class="field__search">
                <input type="text" placeholder="Search entire store here..." name="search">
                <div class="action">
                    <a href="#"><i class="zmdi zmdi-search"></i></a>
                </div>
            </div>
        </form>
        <div class="close__wrap">
            <span>close</span>
        </div>
    </div>

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

    <!-- Start Shop Page -->
    <div class="page-shop-sidebar left--sidebar bg--white section-padding--lg">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12 order-2 order-lg-1 md-mt-40 sm-mt-40">
                    <div class="shop__sidebar">
                        <aside class="widget__categories products--cat">
                            <h3 class="widget__title">Product Categories</h3>
                            <ul>
                                <?php echo $bibliotheque->getCategory__toString(); ?>
                            </ul>
                        </aside>
                    </div>
                </div>
                <div class="col-lg-9 col-12 order-1 order-lg-2">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="shop__list__wrapper d-flex flex-wrap flex-md-nowrap justify-content-between">
                                <div class="shop__list nav justify-content-center" role="tablist">
                                    <!--<a class="nav-item nav-link active" data-bs-toggle="tab" href="#nav-grid" role="tab" aria-selected="true">GRID</a>-->
                                    <!--<a class="nav-item nav-link " data-bs-toggle="tab" href="#nav-list" role="tab" aria-selected="false">LISTE</a>-->
                                </div>
                                <p>Showing <?php echo count($bibliotheque->selected_books); ?> results</p>
                                <div class="orderby__wrapper">
                                    <span>Sort By</span>
                                    <form id='sorting' method="post" action="index.php?<?php
                                    if(isset($_GET['category'])){
                                        echo "category=".$_GET['category'];
                                    }
                                    ?>" onchange='this.submit()'>
                                    <select name ="sortby" class="shot__byselect">
                                        <option <?php if(!isset($_POST['sortby'])){ echo "selected";} ?> disabled>Default sorting</option>
                                        <option <?php if(isset($_POST['sortby']) && $_POST['sortby'] == 'title'){ echo "selected";} ?> value="title">Title</option>
                                        <option <?php if(isset($_POST['sortby']) && $_POST['sortby'] == 'author'){ echo "selected";} ?> value="author" >Author</option>
                                        <option <?php if(isset($_POST['sortby']) && $_POST['sortby'] == 'rating'){ echo "selected";} ?> value="rating">Rating</option>
                                    </select>
                                    <select name ="asc" class="shot__byselect">
                                        <option <?php if(isset($_POST['asc']) && $_POST['asc'] == 'asc'){ echo "selected";} ?> value="asc">ASC</option>
                                        <option <?php if(isset($_POST['asc']) && $_POST['asc'] == 'desc'){ echo "selected";} ?> value="desc" >DESC</option>
                                    </select>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tab__container tab-content">
                        <div class="shop-grid tab-pane active show" id="nav-grid" role="tabpanel">
                            <div class="row">
                                <?php
                                foreach($bibliotheque->selected_books as $book){
                                    echo $book->tabBook__toString();
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <!--<div class="shop-grid tab-pane" id="nav-list" role="tabpanel">
                        <div class="list__view__wrapper">
                            <?php
                            /*foreach($bibliotheque->selected_books as $book){
                                echo $book->listBook__toString();
                            }*/
                            ?>
                        </div>
                    </div> -->
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
                        <div class="footer_widget footer__menu">
                            <div class="ft__logo">
                                <a href="#">
                                    <img src="images/3.png" alt="logo">
                                </a>
                                <p>There are many variations of passages of Lorem Ipsum available, but the majority
                                    have suffered duskam alteration variations of passages</p>
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
                                <p>© 2021, Boighor. Made with <i class="fa fa-heart text-danger"></i> by <a href="https://hasthemes.com/" target="_blank">HasThemes</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- //Footer Area -->
</div>
<!-- //Main wrapper -->

<!-- JS Files -->
<script src="javascript/jquery.min.js"></script>
<script src="javascript/popper.min.js"></script>
<script src="javascript/bootstrap.min.js"></script>
<script src="javascript/plugins.js"></script>
<script src="javascript/active.js"></script>
<a id="scrollUp" href="index.php#top" style="position: fixed; z-index: 2147483647;"><i class="fa fa-angle-up"></i></a>