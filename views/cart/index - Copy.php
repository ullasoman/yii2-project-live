<?php
/* @var $this yii\web\View */

use common\models\CartItems;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

$this->title = 'Fiteggs | Cart';
$userId = Yii::$app->user->id;
?>
<div class="page-header padding-tb page-header-bg-1">
    <div class="container">
        <div class="page-header-item d-flex align-items-center justify-content-center">
            <div class="post-content">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cart</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<section class="content bg-grey">
    <!-- Cart Sample -->

    <!-- Cart Sample -->
    <div class="container">
        <?php if (!empty($items)) :


        ?>
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h3>Your cart items</h3>
                        </div>

                        <div class="card-body p-0">


                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Select Date</th>
                                        <th>Unit Price</th>
                                        <th>Delivery Days</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($items as $item) : ?>
                                        <tr data-id="<?php echo $item['id'] ?>" data-url="<?php echo \yii\helpers\Url::to(['/cart/change-quantity']) ?>">

                                            <td>
                                                <div class="aside"> <img src="<?php echo \common\models\Product::formatImageUrl($item['product_image']) ?>" height="72" width="72" class="img-thumbnail img-sm"> </div>
                                                <div class="info">
                                                    <p class="title"><?php echo $item['product_name'] ?></p>
                                                </div>
                                            </td>

                                            <td>
                                                <?php
                                                // Multiple Dates Selection
                                                $cartId = $item['cart_id'];
                                                $dateId = 'date_' . $item['cart_id'];

                                                echo DatePicker::widget([
                                                    'name' => 'date_12',
                                                    'id' => $dateId,
                                                    'value' => '',
                                                    'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                                    'pickerButton' => ['title' => false],
                                                    'options' => ['placeholder' => 'Select date ...'],
                                                    'pluginOptions' => [
                                                        'format' => 'mm/dd/yyyy',
                                                        'multidate' => true,
                                                        'multidateSeparator' => ' , ',
                                                        'todayHighlight' => true,
                                                        'todayBtn' => true,
                                                        'startDate' => date('d-m-Y H:i', time()),

                                                    ],
                                                    'pluginEvents' => [
                                                        "changeDate" => "function(e) {  updateCartAmount($cartId)}",
                                                    ]

                                                ]);
                                                if ($item['delivery_days']) {
                                                ?>
                                                    <p class="mt-2 fw-600">Selected Delivery Days</p>
                                                    <p><?php echo $item['delivery_days'] ?></p>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo $item['product_price'] ?></td>
                                            <td><span id="delivery_days_<?= $item['cart_id'] ?>"><?php echo $item['total_delivery_days'] ?></span>
                                            </td>
                                            <td>
                                                <input type="number" min="1" class="form-control item-quantity" style="width: 60px" value="<?php echo $item['quantity'] ?>">
                                            </td>
                                            <td><span id="itemTotal_<?= $item['cart_id'] ?>"><?php echo $item['total_price'] ?></span>
                                            </td>
                                            <td>
                                                <?php echo \yii\helpers\Html::a('<i class="fa fa-trash"></i>', ['/cart/delete', 'id' => $item['id']], [
                                                    'class' => 'btn btn-icon btn-light',
                                                    'data-method' => 'post',
                                                    'data-confirm' => 'Are you sure you want to remove this product from cart?'
                                                ]) ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
                <!-- Right Side -->
                <aside class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Cart Summary</h5>

                            <dl class="dlist-align">
                                <dt>Total Items :</dt>
                                <dd class="text-end" id="totalQnty"> <?= $productQuantity ?></dd>
                            </dl>
                            <dl class="dlist-align">
                                <dt>Total Delivery :</dt>
                                <dd class="text-end text-success" id="totalDelivery"> <?= $totalDeliveryDays ?></dd>
                            </dl>

                            <dl class="dlist-align">
                                <dt>Total Price:</dt>
                                <dd class="text-end text-dark h5" id="totalPrice"> <?= $totalPrice ?> </dd>
                            </dl>
                            <hr>

                            <!-- Payment Method -->
                            <div class="payment-method">
                                <div class="box box-check d-inline-flex mb-2">
                                    <label class="form-check lh-sm">
                                        <input class="form-check-input" type="radio" id="payment_type" name="payment_type" value="1" checked="">
                                        <b class="border-oncheck"></b>
                                        <span class="form-check-label"> Online Payment </span>
                                    </label>
                                </div>
                                <div class="box box-check d-inline-flex mb-2">
                                    <label class="form-check lh-sm">
                                        <input class="form-check-input" type="radio" id="payment_type" name="payment_type" value="2">
                                        <b class="border-oncheck"></b>
                                        <span class="form-check-label"> Cash on delivery </span>
                                    </label>
                                </div>
                            </div>
                            <!-- Payment Method -->
                            <?php
                            $totalDeliveryDays = CartItems::totalDeliveryDays($userId);

                            if ($totalDeliveryDays > 3)
                                $disabled = '';
                            else
                                $disabled = 'disabled';
                            ?>
                            <button id="checkoutBtn" class="btn btn-primary w-100 <?= $disabled ?> place-order">Proceed to
                                Checkout</button>
                            <!-- <a id="checkoutBtn" href="<?php echo \yii\helpers\Url::to(['/cart/place-order']) ?>" class="btn btn-primary w-100 <?= $disabled ?> place-order">Checkout</a> -->
                            <div class="py-2">
                                <span><i class="me-2 text-muted fa fa-info-circle"></i> Minimum 4 delivery is
                                    required</span>
                            </div>
                        </div> <!-- card-body.// -->
                    </div> <!-- card.// -->
                </aside>
                <!-- Right Side -->
            </div>
        <?php else : ?>

            <p class="text-muted text-center p-5">There are no items in the cart</p>

        <?php endif; ?>
    </div>

</section>

<script>
    function updateCartAmount(cartId) {

        var selectedDates = document.getElementById('date_' + cartId).value;
        var elements = selectedDates.split(',');
        var selectedDatesCount = elements.length;
        var checkoutBtn = document.getElementById('checkoutBtn');
        var deliveryDates = document.getElementById('delivery_days_' + cartId)

        console.log(cartId)
        $.ajax({
            method: 'POST',
            url: 'update-cart-item-total',
            data: {
                cart_id: cartId,
                selectedDates: selectedDates,
                selectedDatesCount: selectedDatesCount
            },
            success: function(res) {
                console.log(res)
                $('#totalQnty').html(res.totalQuantity);
                $('#totalDelivery').html(res.totalDeliveryDays);
                $('#totalPrice').html(res.totalPrice);
                $('#delivery_days_' + cartId).html(res.totalItemDelivery);
                $('#itemTotal_' + cartId).html(res.totalItemPrice);

                if (res.totalDeliveryDays > 3) {
                    checkoutBtn.classList.remove("disabled");
                } else {
                    checkoutBtn.classList.add("disabled");
                }
                //console.log(arguments)
                // $cartQuantity.text(parseInt($cartQuantity.text() || 0) + 1);
            }
        })
    }
</script>