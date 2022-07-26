<?php

namespace frontend\controllers;

use common\models\Order;
use common\models\search\OrderSearch;
use common\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class ProfileController extends \frontend\base\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'address-information', 'update-address', 'update-account', 'order-history', 'settings', 'order-details'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        /** @var \common\models\User $user */
        $user = Yii::$app->user->identity;
        $userAddress = $user->getAddress();
        return $this->render('index', [
            'user' => $user,
            'userAddress' => $userAddress
        ]);
    }

    public function actionAddressInformation()
    {
        /** @var \common\models\User $user */
        $user = Yii::$app->user->identity;
        $userAddress = $user->getAddress();
        return $this->render('address-information', [
            'user' => $user,
            'userAddress' => $userAddress
        ]);
    }
    public function actionUpdateAddress()
    {
        if (!Yii::$app->request->isAjax) {
            throw new ForbiddenHttpException("You are only allowed to make ajax request");
        }
        /** @var \common\models\User $user */
        $user = Yii::$app->user->identity;
        $userAddress = $user->getAddress();
        $success = false;
        if ($userAddress->load(Yii::$app->request->post()) && $userAddress->save()) {
            $success = true;
        }
        return $this->renderAjax('user_address', [
            'userAddress' => $userAddress,
            'success' => $success
        ]);
    }
    public function actionOrderHistory()
    {
        /** @var \common\models\User $user */
        $user = Yii::$app->user->identity;
        $userAddress = $user->getAddress();

        // $dataProvider = new ActiveDataProvider([
        //     'query' => Order::find()->where(['created_by' => Yii::$app->user->id]),
        // ]);
        // $dataProvider->pagination->pageSize = 5;

        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->pagination->pageSize = 10;
        // return $this->render('index', [
        //     'searchModel' => $searchModel,
        //     'dataProvider' => $dataProvider,
        // ]);

        return $this->render('order-history', [
            'user' => $user,
            'userAddress' => $userAddress,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }
    public function actionOrderDetails($id)
    {

        $order = Order::find()->where(['id' => $id])->andWhere(['is_active' => true])->one();

        if (!$order) {
            throw new NotFoundHttpException("Order does not exist");
        }

        return $this->render('order-details', [
            'order' => $order,
        ]);
    }
    public function actionSettings()
    {
        /** @var \common\models\User $user */
        $user = Yii::$app->user->identity;
        $userAddress = $user->getAddress();
        return $this->render('settings', [
            'user' => $user,
            'userAddress' => $userAddress
        ]);
    }
    public function actionUpdateAccount()
    {
        if (!Yii::$app->request->isAjax) {
            throw new ForbiddenHttpException("You are only allowed to make ajax request");
        }
        /** @var \common\models\User $user */
        $user = Yii::$app->user->identity;
        $user->scenario = User::SCENARIO_UPDATE;
        $success = false;
        if ($user->load(Yii::$app->request->post()) && $user->save()) {
            $success = true;
        }
        return $this->renderAjax('user_account', [
            'user' => $user,
            'success' => $success
        ]);
    }
}
