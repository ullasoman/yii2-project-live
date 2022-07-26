<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

$this->title = 'Fiteggs.com | Sign in';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Login Box -->
<section class="content bg-grey">
    <div class="container">
        <div class="row">
            <aside class="col-lg-4 col-md-4 m-auto">
                <!-- ============= COMPONENT LOGIN 2 ============ -->
                <div class="card shadow-xl rounded-2xl">
                    <div class="card-body">
                        <h4 class="mb-4">Sign in</h4>
                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                        <div class="d-flex gap-2">
                            <a href="<?= Url::to(['site/auth', 'authclient' => 'facebook']) ?>" class="d-flex align-items-center btn-social-login sl-fb w-100">
                                <img class="mr-2" src="<?= Yii::getAlias('@web/frontend/web/theme/images/icons/') ?>facebook.svg" height="20" width="20"> Facebook
                            </a>
                            <a href="<?= Url::to(['site/auth', 'authclient' => 'google']) ?>" class="d-flex align-items-center btn-social-login sl-g w-100">
                                <img class="mr-2" src="<?= Yii::getAlias('@web/frontend/web/theme/images/icons/') ?>google.svg" height="20" width="20"> Google
                            </a>
                            <!-- <?= yii\authclient\widgets\AuthChoice::widget([
                                        'baseAuthUrl' => ['site/auth'],
                                        'popupMode' => true,
                                        'options' => [
                                            'class' => 'auth-clients-holder'
                                        ]
                                    ])
                                    ?> -->
                        </div>
                        <p class="text-divider my-4"> Or login with username </p>
                        <div class="mb-3">
                            <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Email') ?>
                        </div>
                        <div class="mb-3">
                            <?= $form->field($model, 'password')->passwordInput() ?>
                        </div>
                        <div class="d-flex mb-3">
                            <label class="form-check mr-auto">
                                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                            </label>
                            <?= Html::a(Yii::t('app', 'Forgot password?'), ['site/request-password-reset'], ['class' => 'text-muted']) ?>
                        </div>
                        <div class="mb-4">
                            <?= Html::submitButton('Sign in', ['class' => 'btn-custom w-100', 'name' => 'login-button']) ?>
                        </div>
                        <p class="mb-1 text-center">Don't have an account?
                            <?= Html::a('Register', ['site/signup']) ?></p>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </aside>

        </div>
    </div>
</section>