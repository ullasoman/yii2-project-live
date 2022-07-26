<?php

namespace frontend\controllers;

use common\models\CartItems;
use common\models\Order;
use common\models\OrderAddress;
use common\models\Product;
use Yii;
use yii\filters\ContentNegotiator;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use Razorpay\Api\Api;
use yii\filters\AccessControl;

class CartController extends \frontend\base\Controller
{
    public function behaviors()
    {
        return [
            [
                'class' => ContentNegotiator::class,
                'only' => ['add', 'create-order', 'submit-payment', 'change-quantity', 'update-cart-item-total', 'razorpay-order', 'place-order', 'checkout-order-offline'],
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST', 'DELETE'],
                    'create-order' => ['POST'],
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        $cartItems = CartItems::getItemsForUser(Yii::$app->user->id);

        $userId = Yii::$app->user->id;
        $productQuantity = CartItems::getTotalQuantityForUser($userId);
        $totalPrice = CartItems::getTotalPriceForUser($userId);
        $totalDeliveryDays = CartItems::totalDeliveryDays($userId);

        return $this->render('index', [
            'items' => $cartItems,
            'productQuantity' => $productQuantity,
            'totalPrice' => $totalPrice,
            'totalDeliveryDays' => $totalDeliveryDays
        ]);
    }
    public function actionAdd()
    {
        $id = \Yii::$app->request->post('id');
        // print_r($id);
        // die;
        $product = Product::find()->where(['id' => $id, 'status' => 1])->one();

        if (!$product) {
            throw new NotFoundHttpException("Product does not exist");
        }

        if (Yii::$app->user->isGuest) {

            $cartItems = Yii::$app->session->get(CartItems::SESSION_KEY, []);
            $found = false;
            foreach ($cartItems as &$item) {
                if ($item['id'] == $id) {
                    $item['quantity']++;
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $cartItem = [
                    'id' => $id,
                    'product_name' => $product->product_name,
                    'product_image' => $product->product_image,
                    'product_price' => $product->product_price,
                    'quantity' => 1,
                    'total_price' => $product->product_price
                ];
                $cartItems[] = $cartItem;
            }

            Yii::$app->session->set(CartItems::SESSION_KEY, $cartItems);
        } else {
            $userId = \Yii::$app->user->id;
            // $cartItem = CartItems::find()->userId($userId)->productId($id)->one();
            $cartItem = CartItems::find()->where(['customer_id' => $userId, 'product_id' => $id])->one();
            if ($cartItem) {
                $cartItem->quantity++;
            } else {
                $cartItem = new CartItems();
                $cartItem->product_id = $id;
                $cartItem->customer_id = $userId;
                $cartItem->quantity = 1;
            }
            if ($cartItem->save()) {
                return [
                    'success' => true
                ];
            } else {
                return [
                    'success' => false,
                    'customerId' => $userId,
                    'errors' => $cartItem->errors
                ];
            }
        }
    }
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            $cartItems = \Yii::$app->session->get(CartItems::SESSION_KEY, []);
            foreach ($cartItems as $i => $cartItem) {
                if ($cartItem['id'] == $id) {
                    array_splice($cartItems, $i, 1);
                    break;
                }
            }
            \Yii::$app->session->set(CartItems::SESSION_KEY, $cartItems);
        } else {
            CartItems::deleteAll(['product_id' => $id, 'customer_id' => Yii::$app->user->id]);
        }

        return $this->redirect(['index']);
    }

    public function actionChangeQuantity()
    {
        $id = Yii::$app->request->post('id');
        $userId = Yii::$app->user->id;
        $product = Product::find()->where(['id' => $id, 'status' => 1])->one();
        if (!$product) {
            throw new NotFoundHttpException("Product does not exist");
        }
        $quantity = \Yii::$app->request->post('quantity');
        if (Yii::$app->user->isGuest) {
            $cartItems = \Yii::$app->session->get(CartItems::SESSION_KEY, []);
            foreach ($cartItems as &$cartItem) {
                if ($cartItem['id'] === $id) {
                    $cartItem['quantity'] = $quantity;
                    $cartItem['total_price'] = $cartItem['total_price'] * $cartItem['quantity'];
                    break;
                }
            }
            \Yii::$app->session->set(CartItems::SESSION_KEY, $cartItems);
        } else {
            $cartItem = CartItems::find()->where(['customer_id' => $userId, 'product_id' => $id])->one();
            if ($cartItem) {
                $cartItem->quantity = $quantity;
                $cartItem->save();
            }
        }

        $productQuantity = CartItems::getTotalQuantityForUser($userId);
        $totalPrice = CartItems::getTotalPriceForUser($userId);
        $totalDeliveryDays = CartItems::totalDeliveryDays($userId);

        return [
            'item_price' => CartItems::getTotalPriceForItemForUser($id, $userId),
            'total_quantity' => CartItems::getTotalQuantityForUser($userId),
            'total_delivery' => $totalDeliveryDays,
            'total_price' => $totalPrice
        ];
    }
    public function actionUpdateCartItemTotal()
    {
        $cart_id = Yii::$app->request->post('cart_id');
        $selectedDates = Yii::$app->request->post('selectedDates');
        $selectedDatesCount = Yii::$app->request->post('selectedDatesCount');

        $userId = Yii::$app->user->id;
        $cartItem = CartItems::find()->where(['id' => $cart_id])->one();
        $cartItem->delivery_days = $selectedDates;
        $cartItem->total_delivery_days = $selectedDatesCount;
        $cartItem->save();

        $productId = $cartItem->product_id;
        $totalQuantity = CartItems::getTotalQuantityForUser($userId);
        $totalDeliveryDays = CartItems::totalDeliveryDays($userId);
        $totalPrice = CartItems::getTotalPriceForUser($userId);
        $totalItemDelivery = CartItems::itemDeliveryDays($cart_id);
        $totalItemPrice = CartItems::getTotalPriceForItemForUser($productId, $userId);
        return [
            'totalQuantity' => CartItems::getTotalQuantityForUser($userId),
            'totalDeliveryDays' => $totalDeliveryDays,
            'totalPrice' => $totalPrice,
            'totalItemDelivery' => $totalItemDelivery,
            'totalItemPrice' => $totalItemPrice
        ];
    }
    // public function actionProceedToCheckout()
    // {
    // }
    public function actionPlaceOrder()
    {
        $key_id = Yii::$app->params['razorPayKeyId'];
        $secret = Yii::$app->params['razorPaySecret'];
        $receipt = '#FE' . time();

        $userId = Yii::$app->user->id;
        $cartItems = CartItems::getItemsForUser($userId);
        $totalPrice = CartItems::getTotalPriceForUser($userId);
        $totalDeliveryDays = CartItems::totalDeliveryDays($userId);

        if (empty($cartItems)) {
            return $this->goHome();
        }

        $payment_type = Yii::$app->request->post('payment_type');

        $order = new Order();
        // payment type == 1 : Do Razorpay online payment 

        if ($payment_type == 1) {

            // RazorPay Order Creation
            $api = new Api($key_id, $secret);
            $orderData = [
                'receipt'         => $receipt,
                'amount'          => $totalPrice * 100, // 2000 rupees in paise
                'currency'        => 'INR',
            ];

            $razorpayOrder = $api->order->create($orderData);
            $razorpayOrderId = $razorpayOrder['id'];
            $order->payment_type = Order::PAYMENT_TYPE_ONLINE;
        } else {
            $order->payment_type = Order::PAYMENT_TYPE_COD;
            $razorpayOrderId = null;
        }
        $order->firstname = Yii::$app->user->identity->firstname;
        $order->lastname = Yii::$app->user->identity->lastname;
        $order->email = Yii::$app->user->identity->email;
        $order->total_delivery = $totalDeliveryDays;
        $order->total_price = $totalPrice;
        $order->status = Order::STATUS_DRAFT;
        $order->transaction_id = $receipt;
        $order->razorpay_order_id = $razorpayOrderId;
        $order->created_at = time();
        $order->created_by = $userId;

        $transaction = Yii::$app->db->beginTransaction();

        if ($order->save() && $order->saveOrderItems()) {
            $transaction->commit();

            CartItems::clearCartItems($userId);
            $orderId = urlencode(base64_encode($order->id));
            return [
                'orderId' => $orderId
            ];

            // return $this->render('pay-now', [
            //     'order' => $order,
            // ]);
        } else {
            print_r($order->getErrors());
            exit;
        }
        // return $this->render('pay-now', [
        //     'order' => $order,
        // ]);
    }
    // Cancel the order
    public function actionCancellOrder()
    {
        $order_id = Yii::$app->request->post('order_id');
        $order = Order::find()->where(['id' => $order_id])->andWhere(['is_active' => true])->one();
        if (!$order) {
            throw new NotFoundHttpException("Order does not exist");
        }
        $order->is_active = false;
        if ($order->save()) {
            return 'Success';
        } else {
            return $order->errors;
        }
    }
    public function actionCheckout($id)
    {

        $order_id = base64_decode(urldecode($id));

        $order = Order::find()->where(['id' => $order_id])->andWhere(['status' => Order::STATUS_DRAFT])->one();

        if (!$order) {
            throw new NotFoundHttpException("Order does not exist");
        }

        return $this->render('pay-now', [
            'order' => $order,
        ]);
    }
    public function actionCheckoutOrderOffline()
    {
        $order_id = Yii::$app->request->post('order_id');
        $delivery_time = Yii::$app->request->post('delivery_time');
        $order = Order::find()->where(['id' => $order_id])->andWhere(['is_active' => true])->one();
        if (!$order) {
            throw new NotFoundHttpException("Order does not exist");
        }
        //print_r(Yii::$app->user->identity->firstname);
        // $order->firstname = Yii::$app->user->identity->firstname;
        // $order->lastname = Yii::$app->user->identity->lastname;
        // $order->email = Yii::$app->user->identity->email;
        $order->delivery_timing = $delivery_time;
        $order->firstname = Yii::$app->user->identity->firstname;
        $order->lastname = Yii::$app->user->identity->lastname;
        $order->email = Yii::$app->user->identity->email;
        $order->status = Order::STATUS_DRAFT;

        if ($order->save()) {
            $orderId = urlencode(base64_encode($order->id));
            return [
                'result' => 'success',
                'orderId' => $orderId
            ];
        } else {
            return $order->errors;
        }
    }
    // public function actionCheckoutOld()
    // {

    //     $userId = Yii::$app->user->id;
    //     $cartItems = CartItems::getItemsForUser($userId);
    //     $productQuantity = CartItems::getTotalQuantityForUser($userId);
    //     $totalPrice = CartItems::getTotalPriceForUser($userId);

    //     if (empty($cartItems)) {
    //         return $this->goHome();
    //         // return $this->redirect(goHome());
    //     }

    //     $key_id = Yii::$app->params['razorPayKeyId'];
    //     $secret = Yii::$app->params['razorPaySecret'];
    //     $receipt = '#FE' . time();

    //     $order = new Order();
    //     if ($order->load(Yii::$app->request->post())) {
    //         $post_data = Yii::$app->request->post();

    //         $order->from_date = $post_data['Order']['from_date'];
    //         $order->to_date = $post_data['Order']['from_date'];
    //     }

    //     $order->total_price = $totalPrice;
    //     $order->status = Order::STATUS_DRAFT;

    //     $order->created_at = time();
    //     $order->created_by = $userId;
    //     $transaction = Yii::$app->db->beginTransaction();
    //     if (
    //         $order->load(Yii::$app->request->post())
    //         && $order->save()
    //         && $order->saveAddress(Yii::$app->request->post())
    //         && $order->saveOrderItems()
    //     ) {
    //         $transaction->commit();

    //         CartItems::clearCartItems($userId);

    //         return $this->render('pay-now', [
    //             'order' => $order,
    //         ]);
    //     }

    //     $orderAddress = new OrderAddress();
    //     if (!Yii::$app->user->isGuest) {
    //         /** @var \common\models\User $user */
    //         $user = Yii::$app->user->identity;
    //         $userAddress = $user->getAddress();

    //         $order->firstname = $user->firstname;
    //         $order->lastname = $user->lastname;
    //         $order->email = $user->email;
    //         $order->status = Order::STATUS_DRAFT;

    //         $orderAddress->address = $userAddress->address;
    //         $orderAddress->city = $userAddress->city;
    //         $orderAddress->state = $userAddress->state;
    //         $orderAddress->country = $userAddress->country;
    //         $orderAddress->zipcode = $userAddress->zipcode;
    //     }

    //     return $this->render('checkout', [
    //         'order' => $order,
    //         'orderAddress' => $orderAddress,
    //         'cartItems' => $cartItems,
    //         'productQuantity' => $productQuantity,
    //         'totalPrice' => $totalPrice
    //     ]);
    // }
    public function actionSubmitPayment($orderId)
    {
        $where = ['id' => $orderId, 'status' => Order::STATUS_DRAFT];

        $order = Order::findOne($where);
        if (!$order) {
            throw new NotFoundHttpException();
        }
        $delivery_time = Yii::$app->request->post('delivery_time');
        $razorpayOrderId = Yii::$app->request->post('razorpay_order_id');
        $razorpayPaymentId = Yii::$app->request->post('razorpay_payment_id');
        $razorpaySignature = Yii::$app->request->post('razorpay_signature');

        $exists = Order::find()->andWhere(['razorpay_payment_id' => $razorpayPaymentId])->exists();
        if ($exists) {
            throw new BadRequestHttpException();
        }

        // @TODO Save the response information in logs
        // if ($response->statusCode === 200) {
        //     $order->paypal_order_id = $paypalOrderId;
        //     $paidAmount = 0;
        //     foreach ($response->result->purchase_units as $purchase_unit) {
        //         if ($purchase_unit->amount->currency_code === 'USD') {
        //             $paidAmount += $purchase_unit->amount->value;
        //         }
        //     }
        //     if ($paidAmount === (float)$order->total_price && $response->result->status === 'COMPLETED') {
        //         $order->status = Order::STATUS_PAID;
        //     }
        //     $order->transaction_id = $response->result->purchase_units[0]->payments->captures[0]->id;
        //     if ($order->save()) {
        //         if (!$order->sendEmailToVendor()) {
        //             Yii::error("Email to the vendor is not sent");
        //         }
        //         if (!$order->sendEmailToCustomer()) {
        //             Yii::error("Email to the customer is not sent");
        //         }

        //         return [
        //             'success' => true
        //         ];
        //     } else {
        //         Yii::error("Order was not saved. Data: " . VarDumper::dumpAsString($order->toArray()) .
        //             '. Errors: ' . VarDumper::dumpAsString($order->errors));
        //     }
        // }
        $order->firstname = Yii::$app->user->identity->firstname;
        $order->lastname = Yii::$app->user->identity->lastname;
        $order->delivery_timing = $delivery_time;
        $order->email = Yii::$app->user->identity->email;
        $order->status = Order::STATUS_PAID;
        $order->razorpay_payment_id = $razorpayPaymentId;
        $order->razorpay_signature = $razorpaySignature;

        if ($order->save()) {
            if (!$order->sendEmailToVendor()) {
                Yii::error("Email to the vendor is not sent");
            }
            if (!$order->sendEmailToCustomer()) {
                Yii::error("Email to the customer is not sent");
            }

            return [
                'success' => true
            ];
        } else {
            Yii::error("Order was not saved. Data: " . VarDumper::dumpAsString($order->toArray()) .
                '. Errors: ' . VarDumper::dumpAsString($order->errors));
        }
    }
    public function actionTransaction($id)
    {
        $order_id = base64_decode(urldecode($id));
        $order = Order::find()->where(['id' => $order_id])->one();

        if (!$order) {
            throw new NotFoundHttpException("Order does not exist");
        }

        return $this->render('transaction', [
            'order' => $order,
        ]);
    }
}
