<?php

use yii\helpers\Url;
use common\models\Order;
?>
<section class="page-header padding-tb page-header-bg-1">
    <div class="container">
        <div class="page-header-item d-flex align-items-center justify-content-center">
            <div class="post-content">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Order</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Transaction</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<section class="content bg-grey">
    <div class="container">
        <!-- New Payout Section -->
        <div class="row">
            <div class="col-lg-8">
                <!-- ============== COMPONENT FINAL =============== -->
                <article class="card h-100">
                    <div class="card-body">
                        <div class="my-4 mx-auto text-center" style="max-width:600px"> <svg width="96px" height="96px"
                                viewBox="0 0 96 96" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="round-check">
                                        <circle id="Oval" fill="#ffd863" cx="48" cy="48" r="48"></circle>
                                        <circle id="Oval-Copy" fill="#ffc107" cx="48" cy="48" r="36"></circle>
                                        <polyline id="Line" stroke="#fff" stroke-width="4" stroke-linecap="round"
                                            points="34.188562 49.6867496 44 59.3734993 63.1968462 40.3594229">
                                        </polyline>
                                    </g>
                                </g>
                            </svg>
                            <div class="my-3">
                                <h4>Thank you. Your order has been received. </h4>
                                <!-- <p>Some information will be written here, bla bla lorem ipsum you enter into any new
                                    area of science, you almost always find yourself</p> -->
                            </div>
                        </div>
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
                </article><!-- ============== COMPONENT FINAL .// =============== -->
            </div> <!-- col.// -->
            <aside class="col-lg-4">
                <!-- ============== COMPONENT RECEIPE =============== -->
                <article class="card">
                    <div class="card-body">
                        <h5 class="card-title"> Receipt Details </h5>
                        <hr>
                        <div class="itemside mb-3">
                            <!-- <div class="aside"> 
                                <span class="icon-sm text-primary bg-primary-light rounded"><i class="fa fa-lg fa-paypal"></i></span>
                             </div> -->
                            <div class="lh-sm"> <strong>Order No : <?= $order->order_number ?></strong> <br>
                                <span class="text-muted">
                                    <?php
                                    echo $order->getCreatedDate() ?></span>
                            </div>
                        </div>
                        <dl class="dlist-align">
                            <dt>Method:</dt>
                            <dd><?php echo $order->getPaymentMethod() ?></dd>
                        </dl>
                        <dl class="dlist-align">
                            <dt>Billed to:</dt>
                            <dd><?php
                                $userName = Yii::$app->user->identity->firstname . ' ' . Yii::$app->user->identity->lastname;
                                echo $userName ?></dd>
                        </dl>
                        <dl class="dlist-align">
                            <dt>Total Delivery:</dt>
                            <dd><?php echo $order->getItemsDelivery() ?></dd>
                        </dl>
                        <dl class="dlist-align">
                            <dt>Total Amount:</dt>
                            <dd class="h5 fw-600"><?php echo Yii::$app->formatter->asCurrency($order->total_price) ?>
                            </dd>
                        </dl>
                        <hr>
                        <a href="<?= Url::to(['profile/order-details', 'id' => $order->id]) ?>"
                            class="btn btn-outline-warning">
                            <span class="cv-text">View Order Details</span>
                        </a>

                    </div>
                </article><!-- ============== COMPONENT RECEIPE .// =============== -->
            </aside> <!-- col.// -->
        </div>
    </div>
</section>