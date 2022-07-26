<?php

/**
 * User: TheCodeholic
 * Date: 12/12/2020
 * Time: 1:30 PM
 */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var \common\models\User $user */
/** @var \yii\web\View $this */
/** @var \common\models\UserAddress $userAddress */
$this->title = 'Fiteggs.com | User Profile | My Orders';

?>
<div class="page-header padding-tb page-header-bg-1">
    <div class="container">
        <div class="page-header-item d-flex align-items-center justify-content-center">
            <div class="post-content">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Profile</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update Profile Info</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<section class="content bg-grey">
    <div class="container">
        <!-- -->
        <div class="row">
            <aside class="col-lg-3">
                <!-- COMPONENT MENU LIST -->
                <div class="card p-3">
                    <nav class="nav flex-column nav-pills">
                        <a class="nav-link" href="<?= Url::to(['profile/index']) ?>">Account information</a>
                        <a class="nav-link" href="<?= Url::to(['profile/address-information']) ?>">Address
                            information</a>
                        <a class="nav-link active" href="<?= Url::to(['profile/order-history']) ?>">Orders history</a>
                        <a class="nav-link" href="<?= Url::to(['profile/settings']) ?>">Profile setting</a>
                        <a class="nav-link" href="<?= Url::to(['site/logout']) ?>" data-method="post">Log out</a>
                    </nav>
                </div> <!-- COMPONENT MENU LIST END .// -->
            </aside>
            <div class="col-lg-9">
                <div class="card p-3 table-responsive">
                    <?= GridView::widget([
                        'id' => 'ordersTable',
                        'dataProvider' => $dataProvider,
                        //'filterModel' => $searchModel,
                        'tableOptions' => ['class' => 'table order-list'],
                        'pager' => [
                            'class' => \yii\bootstrap4\LinkPager::class
                        ],
                        'columns' => [
                            [
                                'attribute' => 'order_number',
                            ],
                            [
                                'attribute' => 'Order Date',
                                'value' => function ($model) {
                                    return Yii::$app->formatter->asDate($model->created_at);
                                },
                            ],
                            [
                                'attribute' => 'status',
                                'format' => ['orderStatus']
                            ],
                            [
                                'attribute' => 'Delivery Time',
                                'value' => function ($model) {
                                    if ($model->delivered_at == null)
                                        return '';
                                    else
                                        return Yii::$app->formatter->asDate($model->delivered_at);
                                },
                            ],
                            'total_delivery',
                            'total_price:currency',


                            //'email:email',
                            //'payment_type',
                            //'delivery_date_range',
                            //'from_date',
                            //'to_date',
                            //'transaction_id',
                            //'razorpay_order_id',
                            //'razorpay_payment_id:ntext',
                            //'razorpay_signature:ntext',
                            //'created_by',

                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{my_button}',

                                'buttons' => [
                                    'my_button' => function ($url, $model, $key) {
                                        return Yii::$app->formatter->asOrderAction($model->status, $model->id);
                                    },
                                ]
                                // 'template' => '{view}',

                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
        <!-- -->

    </div>
</section>