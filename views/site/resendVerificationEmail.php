<?php

/** @var yii\web\View$this  */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \frontend\models\ResetPasswordForm $model */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

$this->title = 'Resend verification email';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content bg-grey">
    <div class="container">
        <div class="row">
            <aside class="col-lg-5 col-md-4 m-auto">
                <div class="card shadow-xl rounded-2xl" id="resendactivation">
                    <div class="card-body">
                        <h4><?= Html::encode($this->title) ?></h4>
                        <p class="mb-4">Please fill out your email. A verification email will be sent there.</p>
                        <?php $form = ActiveForm::begin(['id' => 'resend-verification-email-form']); ?>

                        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                        <div class="form-group">
                            <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
                <!-- Response Message -->
                <div class="card shadow-xl rounded-2xl">
                    <?php if (Yii::$app->session->hasFlash('resettoken_success')) { ?>
                        <h3><?= Yii::$app->session->getFlash('resendactivation_title'); ?></h3>
                        <p>
                            <?php if (Yii::$app->session->hasFlash('resendactivation_success')) {
                                echo Yii::$app->session->getFlash('resendactivation_success');
                            } else if (Yii::$app->session->hasFlash('resendactivation_error')) {
                                echo Yii::$app->session->getFlash('resendactivation_error');
                            }   ?>
                        </p>
                        <a href="<?= Url::toRoute('site/index'); ?>">Go Home</a>
                        <script type="text/javascript">
                            document.getElementById('resendactivation').style.display = 'none';
                        </script>
                    <?php } ?>
                </div>
                <!-- ./ Response Message -->
            </aside>

        </div>
    </div>
</section>
