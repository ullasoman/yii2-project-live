<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

$this->title = 'fiteggs.com | Faq';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="newsfeed-banner">
    <div class="container">
        <div class="media">
            <div class="media-body">
                <h3 class="item-title">Frequently Ask Questions</h3>
            </div>
        </div>
        <ul class="animation-img">
            <li data-sal="slide-down" data-sal-duration="800" data-sal-delay="400" class="sal-animate"><img width="625" height="191" src="<?php echo Yii::$app->request->baseUrl . '/frontend/web/theme/images/breadcrump-shape.png' ?>" class="attachment-full size-full"></li>

        </ul>
    </div>
</div>
<section class="content bg-grey">
    <div class="container">
        <div class="row">
            <div class="accordion-content">
                <?php

                foreach ($faqs as $faq) {
                ?>
                    <div class="accordion-item shadow-xl rounded-2xl">
                        <header class="item-header">
                            <h4 class="item-question">
                                <?= $faq->faq_title; ?>
                            </h4>
                            <div class="item-icon">
                                <i class='bx bx-chevron-down'></i>
                            </div>
                        </header>
                        <div class="item-content">
                            <p class="item-answer"><?= $faq->faq_content; ?>
                            </p>
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>
        </div>
    </div>
</section>