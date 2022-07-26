<?php

/**
 * User: TheCodeholic
 * Date: 12/12/2020
 * Time: 11:53 AM
 */

use common\models\CartItems;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var \common\models\Product $model */
?>
<div class="list-card bg-white rounded overflow-hidden position-relative shadow-sm">
    <div class="list-card-image">
        <!-- <div class="star position-absolute">
            <span class="badge badge-success">
                <i class="fa fa-inr"></i> 
            </span>
        </div>
        <div class="favourite-heart text-danger position-absolute">
            <a href="#"><i class="feather-heart"></i></a>
        </div>
        <div class="member-plan position-absolute">
            <span class="badge badge-dark">Promoted</span>
        </div> -->

        <img src="<?php echo $model->getImageUrl() ?>" alt=" " class="img-responsive" />
    </div>
    <div class="product-meta position-relative">
        <div class="list-card-body">
            <h6 class="mb-1"><a href="#" class="text-black text-capitalize"><?php echo $model->product_name ?></a>
            </h6>
            <p><?php echo $model->product_description ?></p>
        </div>
        <div class="list-card-badge">
            <div>
                <i class="fa fa-inr"></i> <?php echo $model->product_price ?>
            </div>
            <div>
                <?php
                if (Yii::$app->user->isGuest) {
                ?>
                <a href="<?= Url::to(['site/login']) ?>" class="btn theme-border">Add to Cart </a>
                <?php
                } else {
                    if (CartItems::checkItemExistInCart($model->id) == 1) {
                    ?>
                <span>
                    <button class="btn btn-theme"> Added</button>
                </span>
                <?php
                    } else {
                    ?>
                <span id="cartBtn_<?= $model->id ?>">
                    <a id="addToCart" href="<?php echo \yii\helpers\Url::to(['/cart/add']) ?>"
                        class="btn theme-border btn-add-to-cart">
                        Add to Cart
                    </a>
                </span>

                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>