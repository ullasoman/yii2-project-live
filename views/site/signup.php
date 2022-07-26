<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

$this->title = 'fiteggs.com | signup';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="content bg-grey">
    <div class="container">
        <div class="row">
            <aside class="col-lg-4 m-auto">
                <div class="card shadow-xl rounded-2xl">
                    <div class="card-body">
                        <h4 class="mb-4">Signing Up</h4>
                        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                        <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Full Name') ?>
                        <?= $form->field($model, 'email') ?>
                        <?= $form->field($model, 'phone_no')->textInput(['autofocus' => true]) ?>
                        <?= $form->field($model, 'password')->passwordInput() ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="minimal-checkbox-1" required>
                            <label class="form-check-label" for="minimal-checkbox-1">
                                By signing up, you agree to our <a href="<?= Url::to(['site/terms']) ?>">Terms & Conditions</a> and the <a href="<?= Url::to(['site/privacy']) ?>">Privacy Policy</a>.
                            </label>
                        </div>
                        <div class="form-group">
                            <?= Html::submitButton('Signup', ['class' => 'btn-custom w-100', 'name' => 'signup-button']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                        <div class="col-md-12 text-center">
                            Already have an account? <?= Html::a('Login', ['site/login'], ['class' => 'signup-links']) ?>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>