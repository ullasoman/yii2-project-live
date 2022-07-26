<?php

use common\models\CompanyInfo;
use yii\helpers\Url;

$address = CompanyInfo::find()->where(['is_active' => 1])->one();
$address_line1 = $address->street_address . ', ' . $address->city . ', ';
$address_line2 = $address->district . ', ' . $address->state . '-' . $address->pincode;
?>
<footer class="footer">
    <div class="container">
        <div class="row footer-seperator">
            <div class="col-md-12 mb-2 d-flex flex-sm-wrap">
                <div class="col-md-4 mb-md-0 mb-4 ft-address">
                    <h6 class="footer-heading">Get in Touch</h6>
                    <p><?= $address->company_name ?></p>
                    <p><?= $address_line1 ?></p>
                    <p class="mb-2"><?= $address_line2 ?></p>
                    <p>Phone : <?= $address->company_phone ?></p>
                    <p>Email : <?= $address->company_email ?></p>


                </div>
                <div class="col-md-4 mb-md-0 mb-4 sm-w-50">
                    <h6 class="footer-heading">Discover</h6>
                    <ul>
                        <li><a href="<?= Url::to(['site/index']) ?>" class="py-1 d-block">Home</a></li>
                        <li><a href="#" class="py-1 d-block">Story</a></li>
                        <li><a href="<?= Url::to(['site/login']) ?>" class="py-1 d-block">Login</a></li>
                        <li><a href="<?= Url::to(['profile/index']) ?>" class="py-1 d-block">My Account</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-md-0 mb-4 sm-w-50">
                    <h6 class="footer-heading">About</h6>
                    <ul>
                        <li><a href="<?= Url::to(['site/privacy']) ?>" class="py-1 d-block">Privacy Policy</a></li>
                        <li><a href="<?= Url::to(['site/terms']) ?>" class="py-1 d-block">Terms & Conditions</a></li>
                        <li><a href="<?= Url::to(['site/about']) ?>" class="py-1 d-block">About Us</a></li>
                        <li><a href="<?= Url::to(['site/contact']) ?>" class="py-1 d-block">Contact Us</a></li>
                        <li><a href="<?= Url::to(['site/faq']) ?>" class="py-1 d-block">Faqs</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row mt-md-5">
            <div class="col-md-12">
                <p class="copyright">
                    Copyright ©
                    <script>
                        document.write(new Date().getFullYear());
                    </script> fiteggs - All rights reserved
                </p>
            </div>
        </div>
    </div>
</footer>
<!-- Bottom Navbar -->
<!-- <div class="bottom-navbar" id="bottomNavbar">
    <ul class="btm-nav-list">
        <li class="btm-nav-item">
            <a href="#" class="btm-nav-link active-link">
                <i class="bx bx-home-alt btm-nav-icon"></i>
                <span class="btm-nav-name">Our Story </span>
            </a>
        </li>

        <li class="btm-nav-item">
            <a href="#" class="btm-nav-link ">
                <i class="bx bx-user btm-nav-icon"></i>
                <span class="btm-nav-name">Order Now</span>
            </a>
        </li>
        <li class="btm-nav-item">
            <a href="#" class="btm-nav-link ">
                <i class="bx bx-user btm-nav-icon"></i>
                <span class="btm-nav-name">My Account</span>
            </a>
        </li>
        <li class="btm-nav-item">
            <a href="#" class="btm-nav-link ">
                <i class="bx bx-cart btm-nav-icon"></i>
                <span class="btm-nav-name">Cart</span>
                <div id="bottomCart">
                </div>
            </a>
        </li>
    </ul>
</div> -->
<!-- Bottom Navbar -->