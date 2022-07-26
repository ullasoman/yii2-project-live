<?php

/**
 * User: TheCodeholic
 * Date: 12/13/2020
 * Time: 3:47 PM
 */
/** @var \common\models\Order $order */

//$orderAddress = $order->orderAddress;
$paypalClientId = 'ass996699';

$this->title = 'Fiteggs.com | Order | Order Details : #' . $order->id;

use common\models\CartItems;
use common\models\Order;
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

if ($order->status == Order::STATUS_CONFIRMED) {
    $track_status = 'active';
} elseif ($order->status == Order::STATUS_SHIPPED) {
    $track_status_2 = 'active';
    $track_status = 'active';
} elseif ($order->status == Order::STATUS_COMPLETED) {
    $track_status = 'active';
} else {
    $track_status = '';
}
?>


<div class="page-header padding-tb page-header-bg-1">
    <div class="container">
        <div class="page-header-item d-flex align-items-center justify-content-center">
            <div class="post-content">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Order</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Order
                        </li>
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
                <!-- -->
                <!-- <div class="order-status py-4">
                    <svg width="30px" height="30px" viewBox="0 0 96 96" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="round-check">
                                <circle id="Oval" fill="#ffd863" cx="48" cy="48" r="48"></circle>
                                <circle id="Oval-Copy" fill="#ffc107" cx="48" cy="48" r="36"></circle>
                                <polyline id="Line" stroke="#fff" stroke-width="4" stroke-linecap="round" points="34.188562 49.6867496 44 59.3734993 63.1968462 40.3594229">
                                </polyline>
                            </g>
                        </g>
                    </svg>
                    <p>Thank you. Your order has been received. </p>
                </div> -->

                <div class="order-status">
                    <div class="w-100 py-4 text-center">
                        <!-- <h5 class="mb-4">Order Details</h> -->
                        <ul class="steps-wrap">
                            <li class="step active"> <span class="icon">1</span> <span class="text">Order
                                    Received</span> </li>

                            <?php
                            if ($order->status == Order::STATUS_CONFIRMED) {
                                echo '<li class="step active"> <span class="icon">2</span> <span class="text">Order Confirmed</span> </li>';
                                echo '<li class="step"> <span class="icon">3</span> <span class="text">On the way</span> </li>';
                                echo '<li class="step"> <span class="icon">4</span> <span class="text">Delivered</span> </li>';
                            } elseif ($order->status == Order::STATUS_SHIPPED) {
                                echo '<li class="step active"> <span class="icon">2</span> <span class="text">Order Confirmed</span> </li>';
                                echo '<li class="step active"> <span class="icon">3</span> <span class="text">On the way</span> </li>';
                                echo '<li class="step"> <span class="icon">4</span> <span class="text">Delivered</span> </li>';
                            } else {
                                echo '<li class="step active"> <span class="icon">2</span> <span class="text">Order Confirmed</span> </li>';
                                echo '<li class="step active"> <span class="icon">3</span> <span class="text">On the way</span> </li>';
                                echo '<li class="step active"> <span class="icon">4</span> <span class="text">Delivered</span> </li>';
                            }
                            ?>
                        </ul><!-- tracking-wrap.// -->
                    </div>
                </div>
                <div class="order-status order-stages">
                    <ul class="d-flex w-100">
                        <li>
                            <span class="d-block text-xs text-uppercase mb-1">Order Number :</span>
                            <span class="font-weight-bold"><?= $order->order_number ?></span>
                        </li>
                        <li>
                            <span class="d-block text-xs text-uppercase mb-1">Order Date :</span>
                            <span
                                class="font-weight-bold"><?= Yii::$app->formatter->asDate($order->created_at) ?></span>
                        </li>
                        <li>
                            <span class="d-block text-xs text-uppercase mb-1">Total Delivery :</span>
                            <span class="font-weight-bold"><?= $order->total_delivery ?></span>
                        </li>
                        <li>
                            <span class="d-block text-xs text-uppercase mb-1">Total :</span>
                            <span class="font-weight-bold"><?= $order->total_price ?></span>
                        </li>
                        <li>
                            <span class="d-block text-xs text-uppercase mb-1">Payment Method :</span>
                            <span
                                class="font-weight-bold"><?= Yii::$app->formatter->asPaymentMethod($order->payment_type) ?></span>
                        </li>
                    </ul>
                </div>
                <!-- -->
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
                                                <div class="ps-product__label">Subtotal</div>
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

            </div>

            <aside class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Order Summary</h5>
                        <hr>
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
                        if ($order->status == Order::STATUS_DRAFT) {
                        ?>
                        <button data-datoid="<?= $order->id ?>"
                            class="cancel-order btn btn-outline-danger w-100">Cancell Order</button>
                        <?php
                        }
                        ?>

                    </div> <!-- card-body.// -->
                </div> <!-- card.// -->
            </aside> <!-- col.// -->
        </div>
        <!-- New Payout Section -->

    </div>
</div>
<?php
$orderId = urlencode(base64_encode($order->id));
$responseUrl = 'transaction?id=' . $orderId;
?>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var url_redirect = '<?php echo $responseUrl ?>';

var delivery_time = document.querySelector('input[name="delivery_time"]:checked').value;
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
        //console.log(response)
        $.ajax({
            url: '<?php echo Url::to(['/cart/submit-payment', 'orderId' => $order->id]) ?>',
            method: "POST",
            data: {
                delivery_time: delivery_time,
                razorpay_order_id: response.razorpay_order_id,
                razorpay_payment_id: response.razorpay_payment_id,
                razorpay_signature: response.razorpay_signature,
            },
            beforeSend: function() {
                $("#loading-image").show();
            },
            success: function(res) {
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
        "color": "#458a5b"
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