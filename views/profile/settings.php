<?php

/**
 * User: TheCodeholic
 * Date: 12/12/2020
 * Time: 1:30 PM
 */

use yii\helpers\Url;

/** @var \common\models\User $user */
/** @var \yii\web\View $this */
/** @var \common\models\UserAddress $userAddress */


?>
<section class="page-header padding-tb page-header-bg-1">
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
</section>
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
                        <a class="nav-link" href="<?= Url::to(['profile/order-history']) ?>">Orders history</a>
                        <a class="nav-link active" href="<?= Url::to(['profile/settings']) ?>">Profile setting</a>
                        <a class="nav-link" href="<?= Url::to(['site/logout']) ?>" data-method="post">Log out</a>
                    </nav>
                </div> <!-- COMPONENT MENU LIST END .// -->
            </aside>
            <div class="col-lg-9">
                <article class="card">
                    <div class="card-body">
                        <?php \yii\widgets\Pjax::begin([
                            'enablePushState' => false
                        ]) ?>
                        <?php echo $this->render('user_account', [
                            'user' => $user
                        ]) ?>
                        <?php \yii\widgets\Pjax::end() ?>
                        <hr class="my-4">
                        <div class="row">

                            <div class="col-md">
                                <article class="box mb-3 bg-light"> <a class="btn float-end btn-outline-danger btn-sm"
                                        href="#">Deactivate</a>
                                    <p class="title mb-0">Remove account</p> <small class="text-muted d-block"
                                        style="width:70%">Once you delete your account, there is no going back.</small>
                                </article>
                            </div> <!-- col.// -->
                        </div> <!-- row.// -->
                    </div>
                </article> <!-- card .// -->
            </div>
        </div>
        <!-- -->

    </div>
</section>