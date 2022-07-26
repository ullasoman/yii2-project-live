<?php

/**
 * User: TheCodeholic
 * Date: 12/13/2020
 * Time: 3:47 PM
 */
/** @var \common\models\Order $order */

//$orderAddress = $order->orderAddress;
$paypalClientId = 'ass996699';

$this->title = 'Fiteggs.com | Checkout';

use common\models\CartItems;
use common\models\OrderItem;
use Razorpay\Api\Api;
use yii\helpers\Url;

$key_id = 'rzp_test_7UHOMqbwP86L6y';
$secret = 'm74N34vHNwMlDvCUTXXtCT8I';
$logo = Yii::$app->request->baseUrl . '/frontend/web/theme/images/logo.png';
$phone = '8129464548';
$name = Yii::$app->user->identity->username;
$email = Yii::$app->user->identity->email;
$currUserId = Yii::$app->user->id;
?>


<div class="page-header padding-tb page-header-bg-1">
    <div class="container">
        <div class="page-header-item d-flex align-items-center justify-content-center">
            <div class="post-content">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Order Summary</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="content bg-grey">
    <div class="container">
        <!-- New Payout Section -->
        <div class="row my-4">
            <div class="col-12 col-sm-7 col-md-9 ps-shopping">
                <ul class="ps-shopping__list">
                    <?php foreach ($order->orderItems as $item) : ?>

                        <li>
                            <div class="ps-product ps-product--wishlist">
                                <div class="pc-grid">
                                    <div class="ps-product__content">
                                        <div class="ps-product__thumbnail">
                                            <div class="ps-product__label">Product</div>
                                            <div>
                                                <a href="#" class="ps-product__image">
                                                    <figure>
                                                        <img src="<?php echo $item->product->getImageUrl() ?>" alt="alt">
                                                    </figure>
                                                </a>
                                                <h5 class="ps-product__title"> <?php echo $item->product_name ?></h5>
                                            </div>
                                        </div>
                                        <div class="product-data">
                                            <div class="pd-row">
                                                <div class="ps-product__row sm-50">
                                                    <div class="ps-product__label">Select Date</div>
                                                    <div class="ps-product__value">
                                                        <?php echo $item->delivery_days ?>
                                                    </div>
                                                </div>
                                                <div class="ps-product__row">
                                                    <div class="ps-product__label">Price</div>
                                                    <div class="ps-product__value">
                                                        <?php echo Yii::$app->formatter->asCurrency($item->quantity * $item->unit_price) ?>
                                                    </div>
                                                </div>

                                                <div class="ps-product__row ps-product__quantity">
                                                    <div class="ps-product__label">Quantity</div>
                                                    <div class="ps-product__value">
                                                        <?php echo $item->quantity ?>
                                                    </div>
                                                </div>
                                                <div class="ps-product__row ps-product__quantity">
                                                    <div class="ps-product__label">Delivery</div>
                                                    <div class="ps-product__value">
                                                        <?php echo $item->total_delivery ?>
                                                    </div>
                                                </div>
                                                <div class="ps-product__row ps-product__subtotal">
                                                    <div class="ps-product__label">Sub Total</div>
                                                    <div class="ps-product__value">
                                                        <?php echo OrderItem::getTotalPriceForItem($item->product_id, $order->id) ?>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <article class="card card-body">
                    <h5 class="card-title">Preferred Delivery Timing</h5>
                    <hr>
                    <div>
                        <label for="delivery_time_1" class="l-radio">
                            <input disabled type="radio" id="delivery_time_1" name="delivery_time" tabindex="1" value="1">
                            <span>(7am-8am)</span>
                        </label>
                        <label for="delivery_time_2" class="l-radio">
                            <input checked type="radio" id="delivery_time_2" name="delivery_time" tabindex="2" value="2">
                            <span>(8am-9am)</span>
                        </label>
                        <label for="delivery_time_3" class="l-radio">
                            <input disabled type="radio" id="delivery_time_3" name="delivery_time" tabindex="3" value="3">
                            <span>(9am-10am)</span>
                        </label>
                        <label for="delivery_time_4" class="l-radio">
                            <input disabled type="radio" id="delivery_time_4" name="delivery_time" tabindex="4" value="4">
                            <span>(10am-11am)</span>
                        </label>
                        <label for="delivery_time_5" class="l-radio">
                            <input disabled type="radio" id="delivery_time_5" name="delivery_time" tabindex="5" value="5">
                            <span>(11am-12pm)</span>
                        </label>
                        <label for="delivery_time_6" class="l-radio">
                            <input disabled type="radio" id="delivery_time_6" name="delivery_time" tabindex="6" value="6">
                            <span>(11am-12pm)</span>
                        </label>
                    </div>
                </article>
            </div>

            <aside class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Order Summary</h5>
                        <hr>
                        <dl class="dlist-align">
                            <dt>Order No:</dt>
                            <dd class="text-end"> <?php echo $order->order_number ?></dd>
                        </dl>
                        <dl class="dlist-align">
                            <dt>Total Items:</dt>
                            <dd class="text-end"> <?php echo $order->getItemsQuantity() ?></dd>
                        </dl>
                        <dl class="dlist-align">
                            <dt>Total Delivery:</dt>
                            <dd class="text-end"> <?php echo $order->getItemsDelivery() ?></dd>
                        </dl>
                        <dl class="dlist-align">
                            <dt>Total Price:</dt>
                            <dd class="text-end text-dark h5">
                                <?php echo Yii::$app->formatter->asCurrency($order->total_price) ?> </dd>
                        </dl>
                        <dl class="dlist-align">
                            <dt>Payment Method:</dt>
                            <dd class="text-end text-dark">
                                <?php echo $order->getPaymentMethod() ?> </dd>
                        </dl>
                        <hr>
                        <?php
                        if ($order->payment_type == 2) {
                            echo '<button data-datoid="' . $order->id . '" id="btn_offline" class="checkout_btn btn-custom w-100 mb-2">Checkout</button>';
                        } else {
                            echo '<button id="rzp-button1" class="checkout_btn btn-custom w-100 mb-2">Checkout</button>';
                        }
                        ?>

                        <button data-datoid="<?= $order->id ?>" class="cancel-order btn btn-outline-danger w-100">Cancell
                            Order</button>
                        <!-- <a href="<?php echo Url::to(['cart/cancel-order', 'id' => $order->id]) ?>"
                            class="cancel-order btn btn-danger w-100">Cancell Order</a> -->
                    </div> <!-- card-body.// -->
                </div> <!-- card.// -->
            </aside> <!-- col.// -->
        </div>
        <!-- New Payout Section -->

    </div>
</div>
<?php
$orderId = urlencode(base64_encode($order->id));
$orderId = urlencode(base64_encode($order->id));
$responseUrl = 'transaction?id=' . $orderId;
?>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var url_redirect = '<?php echo $responseUrl ?>';


    //console.log(delivery_time)
    var options = {
        "key": "<?php echo $key_id ?>", // Enter the Key ID generated from the Dashboard
        "amount": "<?php echo $order->total_price * 100 ?>", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
        "currency": "INR",
        "name": "Fitegg",
        "description": "Test Transaction",
        "image": "<?php echo $logo ?>",
        "order_id": "<?php echo $order->razorpay_order_id ?>", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
        "handler": function(response) {
            console.log(response)
            $.ajax({
                url: '<?php echo Url::to(['/cart/submit-payment', 'orderId' => $order->id]) ?>',
                method: "POST",
                data: {
                    razorpay_order_id: response.razorpay_order_id,
                    razorpay_payment_id: response.razorpay_payment_id,
                    razorpay_signature: response.razorpay_signature,
                },
                beforeSend: function() {
                    console.log('processing')
                    //$("#loading-image").show();
                },
                success: function(res) {
                    //console.log('success')
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    window.location.href = url_redirect;
                }

            });
        },
        "prefill": {
            "name": "<?php echo $name ?>",
            "email": "<?php echo $email ?>",
            "contact": "<?php echo $phone ?>"
        },
        "notes": {
            "address": "FitEgg E-commerce"
        },
        "theme": {
            "color": "#fed700"
        }
    };
    var rzp1 = new Razorpay(options);
    rzp1.on('payment.failed', function(response) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong!' + response.error.description,
        })
        // alert(response.error.code);
        // alert(response.error.description);
        // alert(response.error.source);
        // alert(response.error.step);
        // alert(response.error.reason);
        // alert(response.error.metadata.order_id);
        // alert(response.error.metadata.payment_id);
    });
    document.getElementById('rzp-button1').onclick = function(e) {

        e.preventDefault();
        rzp1.open();
        // var delivery_time = $("input[type='radio'][name='delivery_time']:checked").val();
        // if (delivery_time == undefined) {
        //     console.log('Please choose your preffered delivery time')
        // } else {
        //     console.log('do checkout')
        //     console.log('delivery_time=' + delivery_time)
        //     rzp1.open();
        // }

    }
</script>