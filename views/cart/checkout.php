<?php

/**
 * User: TheCodeholic
 * Date: 12/12/2020
 * Time: 8:12 PM
 */
/** @var \common\models\Order $order */
/** @var \common\models\OrderAddress $orderAddress */
/** @var array $cartItems */
/** @var int $productQuantity */

/** @var float $totalPrice */

use kartik\daterange\DateRangePicker;
use kartik\form\ActiveForm;
use yii\helpers\Url;

?>

<section class="page-header padding-tb page-header-bg-1">
    <div class="container">
        <div class="page-header-item d-flex align-items-center justify-content-center">
            <div class="post-content">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<section class="content bg-grey">
    <div class="container">
        <?php $form = ActiveForm::begin([
            'id' => 'checkout-form',
        ]); ?>
        <div class="row">
            <div class="col">
                <div class="card mb-3">
                    <div class="card-header">

                        <h5>Account information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($order, 'firstname')->textInput(['autofocus' => true]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($order, 'lastname')->textInput(['autofocus' => true]) ?>
                            </div>
                        </div>
                        <?= $form->field($order, 'email')->textInput(['autofocus' => true]) ?>
                        <?= $form->field($order, 'from_date')->hiddenInput()->label(false) ?>
                        <?= $form->field($order, 'to_date')->hiddenInput()->label(false) ?>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5>Address information</h5>
                    </div>
                    <div class="card-body">
                        <?= $form->field($orderAddress, 'address') ?>
                        <?= $form->field($orderAddress, 'city') ?>
                        <?= $form->field($orderAddress, 'state') ?>
                        <?= $form->field($orderAddress, 'country') ?>
                        <?= $form->field($orderAddress, 'zipcode') ?>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h5>Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cartItems as $item) : ?>
                                <tr>
                                    <td>
                                        <img src="<?php echo \common\models\Product::formatImageUrl($item['product_image']) ?>"
                                            style="width: 50px;" alt="<?php echo $item['product_name'] ?>">

                                    </td>
                                    <td><?php echo $item['product_name'] ?></td>
                                    <td>
                                        <?php echo $item['quantity'] ?>
                                    </td>
                                    <td><?php echo Yii::$app->formatter->asCurrency($item['total_price']) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <hr>
                        <div class="summary-data">
                            <p>Total Items</p>
                            <p><?php echo $productQuantity ?></p>
                        </div>
                        <div class="summary-data">
                            <p>Total Price (One Day) </p>
                            <p><i class="small fa fa-inr"></i> <?php echo $totalPrice ?></p>
                        </div>

                        <div class="summary-data">
                            <p>Total Price <small>(<?php echo $totalPrice ?> x <span id="dayCount">1</span>
                                    Days)</small></p>
                            <p><i class="small fa fa-inr"></i> <span id="totalPrice"><?php echo $totalPrice ?></span>
                            </p>
                        </div>

                        <!-- <div>
                        <button id="rzp-button1">Pay</button>

                    </div> -->
                        <button class="btn btn-secondary">Checkout</button>
                        <button class="btn btn-secondary">Cancell Order</button>
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>

    </div>
</section>