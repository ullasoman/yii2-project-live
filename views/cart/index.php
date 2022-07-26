<?php
/* @var $this yii\web\View */

use common\models\CartItems;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\Url;

$this->title = 'Fiteggs | Cart';
$userId = Yii::$app->user->id;
?>
<div class="page-header padding-tb page-header-bg-1">
    <div class="container">
        <div class="page-header-item d-flex align-items-center justify-content-center">
            <div class="post-content">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cart</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="content bg-grey">
    <div class="container">
        <?php if (!empty($items)) :


        ?>
            <div class="row my-4">
                <div class="col-12 col-sm-7 col-md-9 ps-shopping">
                    <ul id="cartItems" class="ps-shopping__list">
                        <?php foreach ($items as $item) : ?>
                            <li data-id="<?php echo $item['id'] ?>" data-url="<?php echo \yii\helpers\Url::to(['/cart/change-quantity']) ?>">
                                <div class="ps-product ps-product--wishlist">
                                    <div class="pc-grid">
                                        <div class="ps-product__content">
                                            <div class="ps-product__thumbnail">
                                                <div class="ps-product__label">Product</div>
                                                <div>
                                                    <a href="#" class="ps-product__image">
                                                        <figure>
                                                            <img src="<?php echo \common\models\Product::formatImageUrl($item['product_image']) ?>" alt="alt">
                                                        </figure>
                                                    </a>
                                                    <h5 class="ps-product__title"><a href="#" class=""><?php echo $item['product_name'] ?></a></h5>
                                                </div>
                                            </div>
                                            <div class="product-data">
                                                <div class="pd-row">
                                                    <div class="ps-product__row">
                                                        <div class="ps-product__label">Select Date</div>
                                                        <div class="ps-product__value">
                                                            <?php
                                                            // Multiple Dates Selection
                                                            $cartId = $item['cart_id'];
                                                            $dateId = 'date_' . $item['cart_id'];
                                                            $itemId = $item['id'];
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
                                                                    "changeDate" => "function(e) {  updateCartAmount($cartId,$itemId)}",
                                                                ]

                                                            ]);

                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="ps-product__row">
                                                        <div class="ps-product__label">Price</div>
                                                        <div class="ps-product__value"><?php echo $item['product_price'] ?>
                                                        </div>
                                                    </div>

                                                    <div class="ps-product__row ps-product__quantity">
                                                        <div class="ps-product__label">Quantity</div>
                                                        <div class="ps-product__value">
                                                            <!-- <div class="input-group">
                                                                <div class="input-group-btn">
                                                                    <button id="down" class="btn btn-default" onclick=" down('1',<?= $item['id'] ?>)"><i class='bx bx-minus'></i></button>
                                                                </div>
                                                                <input type="text" id="myNumber" class="item-quantity input-number" value="<?php echo $item['quantity'] ?>" />
                                                                <div class="input-group-btn">
                                                                    <button id="up" class="btn btn-default" onclick="up('10',<?= $item['id'] ?>)"><i class='bx bx-plus'></i></button>
                                                                </div>
                                                            </div> -->
                                                            <div class="input-group inline-group">
                                                                <div class="input-group-prepend">
                                                                    <button class="btn btn-outline-secondary btn-minus">
                                                                        <i class='bx bx-minus'></i>
                                                                    </button>
                                                                </div>
                                                                <input class="form-control quantity item-quantity" min="1" name="quantity" value="<?php echo $item['quantity'] ?>" type="number">
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-outline-secondary btn-plus">
                                                                        <i class='bx bx-plus'></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <!-- <input type="number" min="1" class="form-control item-quantity" style="width: 60px" value="<?php echo $item['quantity'] ?>"> -->
                                                        </div>
                                                    </div>
                                                    <div class="ps-product__row ps-product__quantity">
                                                        <div class="ps-product__label">Delivery</div>
                                                        <div class="ps-product__value">
                                                            <span id="delivery_days_<?= $item['cart_id'] ?>"><?php echo $item['total_delivery_days'] ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="ps-product__row ps-product__subtotal">
                                                        <div class="ps-product__label">Sub Total</div>
                                                        <div class="ps-product__value">
                                                            <span id="itemTotal_<?= $item['id'] ?>"><?php echo $item['total_price'] ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- -->
                                                <div class="selected-dates">
                                                    <span class="ps-product__label">Selected Dates</span>
                                                    <p id="selectedDates_<?= $item['id'] ?>">
                                                        <?php echo $item['delivery_days'] ?></p>
                                                </div>
                                                <!-- -->
                                            </div>
                                        </div>
                                        <div class="ps-product__remove">
                                            <?php echo \yii\helpers\Html::a('<i class="bx bx-x"></i>', ['/cart/delete', 'id' => $item['id']], [
                                                'class' => 'btn btn-icon',
                                                'data-method' => 'post',
                                                'data-confirm' => 'Are you sure you want to remove this product from cart?'
                                            ]) ?>
                                        </div>
                                    </div>

                                </div>

                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <article class="card card-body">
                        <h5 class="card-title">Choose Preferred Delivery Timing</h5>
                        <hr>
                        <div>
                            <label for="delivery_time_1" class="l-radio">
                                <input type="radio" id="delivery_time_1" name="delivery_time" tabindex="1" value="1">
                                <span>(7am-8am)</span>
                            </label>
                            <label for="delivery_time_2" class="l-radio">
                                <input type="radio" id="delivery_time_2" name="delivery_time" tabindex="2" value="2">
                                <span>(8am-9am)</span>
                            </label>
                            <label for="delivery_time_3" class="l-radio">
                                <input type="radio" id="delivery_time_3" name="delivery_time" tabindex="3" value="3">
                                <span>(9am-10am)</span>
                            </label>
                            <label for="delivery_time_4" class="l-radio">
                                <input type="radio" id="delivery_time_4" name="delivery_time" tabindex="4" value="4">
                                <span>(10am-11am)</span>
                            </label>
                            <label for="delivery_time_5" class="l-radio">
                                <input type="radio" id="delivery_time_5" name="delivery_time" tabindex="5" value="5">
                                <span>(11am-12pm)</span>
                            </label>
                            <label for="delivery_time_6" class="l-radio">
                                <input type="radio" id="delivery_time_6" name="delivery_time" tabindex="6" value="6">
                                <span>(11am-12pm)</span>
                            </label>
                        </div>
                    </article>
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
                                <dd class="text-end text-dark h5" id="totalPrice">
                                    <?php echo Yii::$app->formatter->asCurrency($totalPrice) ?> </dd>
                            </dl>
                            <hr>

                            <!-- Payment Method -->
                            <div class="payment-method">
                                <div class="box box-check d-inline-flex mb-2">
                                    <label class="form-check lh-sm">
                                        <input class="form-check-input" type="radio" id="payment_type" name="payment_type" value="1">
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
                            <button id="checkoutBtn" class="btn-custom w-100 <?= $disabled ?> place-order">Proceed to
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
            <div class="empty-cart">
                <img src="<?= Yii::getAlias('@web/frontend/web/theme/images/icons/empty-cart.png') ?>" alt="">
                <h4 class="mb-3">Your cart is empty.</h4>
                <p class="text-muted">Please add product to your cart list.</p>
            </div>


        <?php endif; ?>
    </div>
</div>
<script>
    function updateCartAmount(cartId, itemId) {

        var selectedDates = document.getElementById('date_' + cartId).value;
        var elements = selectedDates.split(',');
        var selectedDatesCount = elements.length;
        var checkoutBtn = document.getElementById('checkoutBtn');
        var deliveryDates = document.getElementById('delivery_days_' + cartId);
        var selectedDatesText = document.getElementById('selectedDates_' + itemId);
        console.log(cartId)
        $('#selectedDates_' + itemId).html(selectedDates);
        $.ajax({
            method: 'POST',
            url: 'cart/update-cart-item-total',
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
                $('#itemTotal_' + itemId).html(res.totalItemPrice);
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