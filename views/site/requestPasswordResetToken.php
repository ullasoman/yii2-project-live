<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \frontend\models\PasswordResetRequestForm $model */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

$this->title = 'Request password reset';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content bg-grey">
    <div class="container">
        <div class="row">
            <aside class="col-lg-5 col-md-4 m-auto">
                <div class="card shadow-xl rounded-2xl" id="resettokenForm">
                    <div class="card-body">
                        <h4><?= Html::encode($this->title) ?></h4>
                        <p class="mb-4">Please fill out your email. A link to reset password will be sent there.</p>
                        <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

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
                        <h3><?= Yii::$app->session->getFlash('resettoken_title'); ?></h3>
                        <p>
                            <?php if (Yii::$app->session->hasFlash('resettoken_success')) {
                                echo Yii::$app->session->getFlash('resettoken_success');
                            } else if (Yii::$app->session->hasFlash('resettoken_error')) {
                                echo Yii::$app->session->getFlash('resettoken_error');
                            }   ?>
                        </p>
                        <a href="<?= Url::toRoute('site/index'); ?>"><?= Yii::t('app', 'Go') ?> <?= Yii::t('app', 'Home') ?></a>

                        <script type="text/javascript">
                            document.getElementById('resettokenForm').style.display = 'none';
                        </script>
                    <?php } ?>
                </div>
                <!-- ./ Response Message -->
            </aside>

        </div>
    </div>
</section>