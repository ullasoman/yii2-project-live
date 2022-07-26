<?php

//use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

//$this->params['cartItemCount'] = 0;

$cartItemCount = $this->params['cartItemCount'];
?>

<header>
    <!-- Header top 0-->
    <!-- <div class="header-top" style="background: #458a5b;">
        <div class="container">
            <div class="htop-area">
                <div class="htop-left">
                    <ul class="htop-information">
                        <li><i class="fa fa-envelope-o"></i> fitegg@gmail.com</li>
                        <li class="dm-none"><i class="fa fa-phone-volume"></i> +91 130 589 745 6987</li>
                        <li><i class="fa fa-clock"></i> Mon - Fri 09:00 - 18:00</li>
                    </ul>
                </div>

            </div>
        </div>
    </div> -->
    <!-- Header Top -->
    <nav id="navbar_top" class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand" href="<?= Url::to(['site/index']) ?>"><img
                    src="<?= Yii::getAlias('@web/frontend/web/theme/images/') ?>logo.png" /></a>
            <div>
                <span class="position-relative sm-cart-btn">
                    <a href="<?= Url::to(['cart/index']) ?>">
                        <img class="cart-icon"
                            src="<?php echo Yii::$app->request->baseUrl . '/frontend/web/theme/images/icons/bag.png' ?>">
                    </a>
                    <span id="cart-quantity" class="badge badge-warning sm-cart-badge"><?= $cartItemCount ?></span>
                </span>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
            </div>

            <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
                <div class="mob-logo desk-none">
                    <a class="navbar-brand" href="<?= Url::to(['site/index']) ?>"><img
                            src="<?= Yii::getAlias('@web/frontend/web/theme/images/') ?>logo.png" /></a>
                </div>
                <div class="left-bar desk-none">
                    <div class="user-area">
                        <div class="user-info-sidebar sidebar-profile">
                            <div class="user-info-box">
                                <div href="#" class="profile-pic"></div>
                                <div class="profile-user">

                                    <?php
                                    if (!Yii::$app->user->isGuest) {
                                        $user_id = Yii::$app->user->id;
                                    ?>
                                    <h4 class="profile-user-name"> <span> Hi, <?= Yii::$app->user->identity->username ?>
                                        </span></h4>
                                    <?= Html::a(Yii::t('app', 'Logout'), Url::to(['site/logout']), ['data' => ['method' => 'post'], 'class' => 'profile-user-logout']) ?>
                                    <?php
                                    } else {
                                    ?>
                                    <h4 class="profile-user-name"> <span> Hi, Guest </span></h4>

                                    <?php
                                    }
                                    ?>


                                </div>
                            </div>
                            <!-- 
                            <span class="drawer-close">
                                <i class="icon-close"></i>
                            </span> -->

                        </div>
                        <!-- Sidebar List -->
                        <ul class="sidebar-list desk-desk">
                            <?php
                            if (!Yii::$app->user->isGuest) {
                                $user_id = Yii::$app->user->id;
                            ?>
                            <li class="sidebar-list-item">
                                <a class="sidebar-list-item-link list-products"
                                    href="<?= Url::to(['site/index']) ?>">Home</a>
                            </li>
                            <li class="sidebar-list-item">
                                <a class="sidebar-list-item-link list-products"
                                    href="<?= Url::to(['profile/index']) ?>">Account information</a>
                            </li>
                            <li class="sidebar-list-item">
                                <a class="sidebar-list-item-link list-orders"
                                    href="<?= Url::to(['profile/address-information']) ?>">Address information</a>
                            </li>
                            <li class="sidebar-list-item">
                                <a class="sidebar-list-item-link list-coupons"
                                    href="<?= Url::to(['profile/order-history']) ?>">My Orders</a>
                            </li>
                            <li class="sidebar-list-item">
                                <a class="sidebar-list-item-link list-delivery-boys"
                                    href="<?= Url::to(['profile/settings']) ?>">Profile setting</a>
                            </li>
                            <li class="sidebar-list-item">
                                <?= Html::a(Yii::t('app', 'Logout'), Url::to(['site/logout']), ['data' => ['method' => 'post'], 'class' => 'sidebar-list-item-link list-add-product']) ?>
                            </li>

                            <?php
                            } else {
                            ?>
                            <li class="sidebar-list-item">
                                <a class="sidebar-list-item-link list-products"
                                    href="<?= Url::to(['site/index']) ?>">Home</a>
                            </li>
                            <li class="sidebar-list-item">
                                <a class="sidebar-list-item-link list-products" href="<?= Url::to(['site/faq']) ?>">Our
                                    Story</a>
                            </li>
                            <li class="sidebar-list-item">
                                <a class="sidebar-list-item-link list-products"
                                    href="<?= Url::to(['site/login']) ?>">Login</a>
                            </li>
                            <li class="sidebar-list-item">
                                <a class="sidebar-list-item-link list-products"
                                    href="<?= Url::to(['site/signup']) ?>">Register</a>
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                        <!-- Sidebar List  -->
                    </div>
                    <!-- -->
                    <div class="side-nav-footer">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                            y="0px" viewBox="0 0 300 126.5"
                            style="margin-bottom: -5px; enable-background:new 0 0 300 126.5;" xml:space="preserve"
                            class="injected-svg js-svg-injector" data-parent="#SVGwaveWithDots">
                            <style type="text/css">
                            .wave-bottom-with-dots-0 {
                                fill: #fdc913;
                            }

                            .wave-bottom-with-dots-1 {
                                fill: #fdc913;
                            }

                            .wave-bottom-with-dots-2 {
                                fill: #DE4437;
                            }

                            .wave-bottom-with-dots-3 {
                                fill: #00C9A7;
                            }

                            .wave-bottom-with-dots-4 {
                                fill: #FFC107;
                            }
                            </style>
                            <path class="wave-bottom-with-dots-0 fill-primary" opacity=".6"
                                d="M0,58.9c0-0.9,5.1-2,5.8-2.2c6-0.8,11.8,2.2,17.2,4.6c4.5,2.1,8.6,5.3,13.3,7.1C48.2,73.3,61,73.8,73,69  c43-16.9,40-7.9,84-2.2c44,5.7,83-31.5,143-10.1v69.8H0C0,126.5,0,59,0,58.9z">
                            </path>
                            <path class="wave-bottom-with-dots-1 fill-primary"
                                d="M300,68.5v58H0v-58c0,0,43-16.7,82,5.6c12.4,7.1,26.5,9.6,40.2,5.9c7.5-2.1,14.5-6.1,20.9-11  c6.2-4.7,12-10.4,18.8-13.8c7.3-3.8,15.6-5.2,23.6-5.2c16.1,0.1,30.7,8.2,45,16.1c13.4,7.4,28.1,12.2,43.3,11.2  C282.5,76.7,292.7,74.4,300,68.5z">
                            </path>
                            <g>
                                <circle class="wave-bottom-with-dots-2 fill-danger" cx="259.5" cy="17" r="13"></circle>
                                <circle class="wave-bottom-with-dots-1 fill-primary" cx="290" cy="35.5" r="8.5">
                                </circle>
                                <circle class="wave-bottom-with-dots-3 fill-success" cx="288" cy="5.5" r="5.5"></circle>
                                <circle class="wave-bottom-with-dots-4 fill-warning" cx="232.5" cy="34" r="2"></circle>
                            </g>
                        </svg>
                    </div>
                    <!-- Footer -->
                </div>

                <ul class="navbar-nav ms-auto dm-none">
                    <li class="nav-item"><a href="<?= Url::to(['site/index']) ?>"
                            class="page-scroll nav-link active">Home</a></li>
                    <li class="nav-item"><a href="#" class="page-scroll nav-link">Our Story</a></li>
                    <?php
                    if (!Yii::$app->user->isGuest) {
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <?= Yii::$app->user->identity->username ?> <i class="fa fa-chevron-down"></i></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="<?= Url::to(['profile/index']) ?>">My Profile</a>
                            <a class="dropdown-item" href="<?= Url::to(['profile/order-history']) ?>">My Orders</a>
                            <div class="dropdown-divider"></div>
                            <a href="<?= Url::to(['site/logout']) ?>" class="nav-link" data-method="post">Logout</a>
                        </ul>
                    </li>
                    <?php
                    } else {
                    ?>
                    <li class="nav-item">
                        <a href="<?= Url::to(['site/login']) ?>" class="nav-link">Login</a>
                    </li>
                    <?php
                    }
                    ?>
                    <li class="nav-item dm-none position-relative">
                        <a href="<?= Url::to(['cart/index']) ?>" class="nav-link"> Cart <img class="cart-icon"
                                src="<?php echo Yii::$app->request->baseUrl . '/frontend/web/theme/images/icons/bag.png' ?>">

                        </a>
                        <span id="cart-quantity-top" class="badge badge-warning dm-none"><?= $cartItemCount ?></span>
                    </li>

                </ul>

            </div> <!-- navbar-collapse.// -->
        </div> <!-- container-fluid.// -->
    </nav>

</header>