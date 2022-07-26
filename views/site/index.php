<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Welcome to Fiteggs.com';

?>
<!-- display error message -->
<?php if (Yii::$app->session->hasFlash('error')) : ?>
    <div class="container">
        <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    </div>
<?php endif; ?>
<section class="hero-banner">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-6">
                <!-- <h1 class="fs-1 mb-5 wow fadeInUp" data-wow-delay=".4s">We produce fresh, all natural
                    soy-free eggs</h1>
                <div class="mb-4">
                    <p class="fs-5 text-white">100% Natural & Healthy Products</p>
                    <p class="fs-5 text-white">Taste our delicious and
                        nutritious eggs.</p>
                </div> -->

                <!-- <div class="py-4">
                    <a href="#" target="_blank" class="btn-custom">
                        <span class="cv-text ms-1 text-uppercase">Try Our Products</span>
                    </a>
                </div> -->

            </div>
            <!-- <div class="col-lg-6 text-end">
                <img src="<?php echo Yii::$app->request->baseUrl . '/frontend/web/theme/images/hero-egg.png' ?>"
                    alt="fiteggs">
            </div> -->
        </div>

    </div>

</section>
<!-- <div class="position-relative">
    <div class="shape">
        <img src="<?php echo Yii::$app->request->baseUrl . '/frontend/web/theme/images/bg-wave.svg' ?>" alt=""
            class="img-fluid">
    </div>
</div> -->
<!-- Hero -->
<!-- About -->

<!-- Products -->
<section class="bg-grey product_section">
    <div class="container">
        <div class="section_heading mb-40 text-center">
            <h2>Our Products<span>.</span> </h2>
        </div>
        <?php echo \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'layout' => '<div class="row">{items}</div>{pager}',
            'itemView' => '_product_item',
            'summary' => '',
            'itemOptions' => [
                'class' => 'col-md-3 col-sm-6 pb-4 product-item'
            ],
            'pager' => [
                'class' => \yii\bootstrap4\LinkPager::class
            ]
        ]) ?>
        <div class="py-4 text-center">
            <?= Html::a('View Cart', ['/controller/action'], ['class' => 'button-37']) ?>

        </div>
    </div>
</section>
<!-- End Products -->

<!-- About -->
<section class="specification position-relative">
    <div class="shapes"><img src="<?php echo Yii::$app->request->baseUrl . '/frontend/web/theme/images/header-sape5.png' ?>" alt="img"></div>
    <div class="container">
        <div class="section_heading mb-40 text-center">
            <h2>Why Fiteggs?</h2>
            <p>We make sure every product you get has been fully tested for purity and freshness.</p>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="white-box">
                    <div class="feature-img">
                        <img src="<?php echo Yii::$app->request->baseUrl . '/frontend/web/theme/images/eggs.png' ?>" alt="" class="img-fluid">
                    </div>
                    <div class="spec-content">
                        <h4>Freshness Guaranteed</h4>
                        <p>Directly delivered from farm to you at your date and time.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="white-box">
                    <div class="feature-img">
                        <img src="<?php echo Yii::$app->request->baseUrl . '/frontend/web/theme/images/farmer.png' ?>" alt="" class="img-fluid">
                    </div>
                    <div class="spec-content">
                        <h4>Tie up's with farmers</h4>
                        <p>To secure quality and fair price to our customers and farmers.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="white-box">
                    <div class="feature-img">
                        <img src="<?php echo Yii::$app->request->baseUrl . '/frontend/web/theme/images/subscription.png' ?>" alt="" class="img-fluid">
                    </div>
                    <div class="spec-content">
                        <h4>Hassle free subscription</h4>
                        <p>No commitment, Pause/Cancel order anytime</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="white-box">
                    <div class="feature-img">
                        <img src="<?php echo Yii::$app->request->baseUrl . '/frontend/web/theme/images/tracking.png' ?>" alt="" class="img-fluid">
                    </div>
                    <div class="spec-content">
                        <h4>Flexible payment plan</h4>
                        <p>Pay when the order is placed or pay when delivered.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="white-box">
                    <div class="feature-img">
                        <img src="<?php echo Yii::$app->request->baseUrl . '/frontend/web/theme/images/delivery-man.png' ?>" alt="" class="img-fluid">
                    </div>
                    <div class="spec-content">
                        <h4>Free Doorstep Delivery</h4>
                        <p>We offer free unlimited delivery for every order, with no hidden cost associated.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="white-box">
                    <div class="feature-img">
                        <img src="<?php echo Yii::$app->request->baseUrl . '/frontend/web/theme/images/rupee.png' ?>" alt="" class="img-fluid">
                    </div>
                    <div class="spec-content">
                        <h4>Commitment to NGO</h4>
                        <p>Part of our revenue goes to an Ngo who's vision is to eliminate malnutrition. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="shapes-right">
        <img src="<?php echo Yii::$app->request->baseUrl . '/frontend/web/theme/images/doodle.png' ?>" alt="img">
    </div>
</section>
<!-- How it Works -->
<section class="video-area pt-100 pb-100 p-relative">
    <div class="video-img2">
        <img src="<?php echo Yii::$app->request->baseUrl . '/frontend/web/theme/images/video-img.png' ?>">
    </div>
    <div class="video_content align-center">
        <a href="#">
            <img src="<?php echo Yii::$app->request->baseUrl . '/frontend/web/theme/images/icons/play-button.png' ?>">
        </a>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-xl-6">
            </div>
            <div class="col-xl-6 hiw-content">
                <div class="video-wrap">
                    <div class="section_heading mb-4 text-center">
                        <h2>Let's see how it works<span>.</span></h2>
                    </div>
                    <div class="video-content">
                        <p>Praesent fermentum nisl at ipsum facilisis viverra. Ut elementum accumsan finibus. Cras
                            placerat lacinia mi, ac dictum ante. Donec libero enim, tincidunt sit amet venenatis id,
                            maximus eu quam. </p>
                        <ul class="steps-vertical">
                            <li class="step"> <b class="icon"></b>
                                <h6 class="title mb-0">Add products & view cart.</h6>
                            </li>
                            <li class="step"> <b class="icon"></b>
                                <h6 class="title mb-0">Select the Date, Time & Quantity.</h6>
                            </li>
                            <li class="step"> <b class="icon"></b>
                                <h6 class="title mb-0">Checkout through COD or Prepaid.</h6>
                            </li>
                            <li class="step"> <b class="icon"></b>
                                <h6 class="title mb-4">Get regular fresh supplies Hassle free.</h6>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- NGO -->
<section class="special_ngo">
    <div class="special_ngo_banner"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-12 col-sm-12 col-12">
                <div class="offer_banner_one text-center">
                    <!-- <h5>NGO</h5> -->
                    <h2>THE AKSHAYA PATRA FOUNDATION</h2>
                    <p>The Akshaya Patra Foundation is a not-for-profit organisation headquartered in Bengaluru, India.
                        The Foundation strives to eliminate classroom hunger by implementing the Mid-Day Meal Programme.
                        It provides nutritious meals to children studying in Government schools and Government-aided
                        schools. Akshaya Patra also aims to counter malnutrition and support right to education of
                        children hailing from socio-economically challenging backgrounds.</p><a class="btn-custom" href="https://www.akshayapatra.org/" target="_blank">Support a Child</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- NGO -->

<!-- Testimonial -->
<section id="testimonial" class="bg-grey testimonial_section bd-bottom padding">
    <div class="container">
        <div class="section_heading mb-40 text-center">
            <h2>Testimonials</h2>
            <p>What our customers have to say</p>
        </div>
        <ul id="testimonial_carousel" class="testimonial_items owl-carousel owl-nav-2">
            <li class="testimonial_item">
                <div class="client_thumb">
                    <img src="<?= Yii::$app->request->baseUrl . '/frontend/web/theme/images/testimonial/1.png' ?>" alt="client">
                </div>
                <div class="testi_content">
                    <h4>John</h4>
                    <p>It is The best price what I can get for the organic eggs to be delivered at my Doorstep.</p>
                </div>
            </li>
            <li class="testimonial_item">
                <div class="client_thumb">
                    <img src="<?php echo Yii::$app->request->baseUrl . '/frontend/web/theme/images/testimonial/2.png' ?>" alt="client">
                </div>
                <div class="testi_content">
                    <h4>Meenakshi</h4>
                    <p>Trust builds the moment you eat fiteggs's nutritious eggs and they don't smell like the usual eggs do.</p>
                </div>
            </li>
            <li class="testimonial_item">
                <div class="client_thumb">
                    <img src="<?php echo Yii::$app->request->baseUrl . '/frontend/web/theme/images/testimonial/3.png' ?>" alt="client">
                </div>
                <div class="testi_content">
                    <h4>Sarah</h4>
                    <p>I never have to worry about going out of eggs and bread again.</p>
                </div>
            </li>
            <!-- <li class="testimonial_item">
                <div class="client_thumb">
                    <img src="<?php echo Yii::$app->request->baseUrl . '/frontend/web/theme/images/testimonial/4.png' ?>" alt="client">
                </div>
                <div class="testi_content">
                    <h4>Stephen Roben</h4>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                </div>
            </li>
            <li class="testimonial_item">
                <div class="client_thumb">
                    <img src="<?php echo Yii::$app->request->baseUrl . '/frontend/web/theme/images/testimonial/5.png' ?>" alt="client">
                </div>
                <div class="testi_content">
                    <h4>Alena Kalt</h4>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                </div>
            </li> -->

        </ul>
    </div>
</section>
<!-- Testimonial -->
<!-- Mobile App -->


<div class="app-download-conatiner">
    <div class="container">
        <div class="ad-content">
            <div class="ad-screenshot">
                <img class="screen-shot" src="<?php echo Yii::$app->request->baseUrl . '/frontend/web/theme/images/fiteggs-app.png' ?>" alt="">
            </div>
            <div class="ad-content-badge">
                <h4>All this from the convenience of your phone.</h4>
                <h4>Download the Fiteggs mobile app.</h4>
                <div class="app-badge-box">
                    <div class="abb-grid">
                        <a href="#">
                            <img src="<?php echo Yii::$app->request->baseUrl . '/frontend/web/theme/images/play-store.svg' ?>" alt="">
                        </a>
                        <a href="#">
                            <img src="<?php echo Yii::$app->request->baseUrl . '/frontend/web/theme/images/app-store.svg' ?>" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ./ Mobile App -->