<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \frontend\models\ContactForm $model */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;

$this->title = 'Fiteggs.com | Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="newsfeed-banner">
    <div class="container">
        <div class="media">
            <div class="media-body">
                <h3 class="item-title">Contact</h3>
            </div>
        </div>
        <ul class="animation-img">
            <li data-sal="slide-down" data-sal-duration="800" data-sal-delay="400" class="sal-animate"><img width="625" height="191" src="<?php echo Yii::$app->request->baseUrl . '/frontend/web/theme/images/breadcrump-shape.png' ?>" class="attachment-full size-full"></li>

        </ul>
    </div>
</div>
<section class="content bg-grey">
    <div class="container">
        <!-- -->
        <div class="contact-form-wrapper rounded-2xl col-lg-8 m-auto">
            <div class="form-wrapper">
                <div class="contact-header">
                    <h2>Send Us</h2>
                    <p>If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.</p>
                </div>
                <div class="screen-reader-response">
                    <p role="status" aria-live="polite" aria-atomic="true"></p>
                    <ul></ul>
                </div>
                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
                    </div>
                    <div class="col-12 col-lg-6">
                        <?= $form->field($model, 'email') ?>
                    </div>
                    <div class="col-12 col-lg-12">
                        <?= $form->field($model, 'subject') ?>
                    </div>
                    <div class="col-12 col-lg-12">
                        <?= $form->field($model, 'body')->textarea(['rows' => 6, 'class' => 'form-control textarea']) ?>
                    </div>
                    <div class="col-12 col-lg-12 text-end pt-3">
                        <?= Html::submitButton('Send Message', ['class' => 'btn-custom', 'name' => 'contact-button']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <!-- -->

    </div>
</section>