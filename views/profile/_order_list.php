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
<header class="d-md-flex">
    <div class="flex-grow-1">
        <h6 class="mb-0"> Order ID: <?= $model->id ?> <i class="dot"></i><span class="text-danger"> Pending </span> </h6> <span>Date: 16 December 2020</span>
    </div>
    <div> <a href="#" class="btn btn-sm btn-outline-danger">Cancel order</a> <a href="#" class="btn btn-sm btn-primary">View order Details</a> </div>
</header>
<hr>
<div class="row">
    <div class="col-md-4">
        <h6 class="text-muted">Payment</h6>
        <span class="text-success">
            <i class="fa fa-lg fa-cc-visa"></i>
            Visa **** 4216
        </span>
        <p>Subtotal: $356 <br>
            Shipping fee: $56 <br>
            <span class="b">Total: $456 </span>
        </p>
    </div>
</div> <!-- row.// -->
<hr>