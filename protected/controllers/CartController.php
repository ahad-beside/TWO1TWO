<?php

class CartController extends Controller {

    public $layout = '//layouts/cart';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }
    
    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array(''),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('index', 'add', 'dell', 'updateMiniCart', 'countItemsAmount', 'checkout', 'updateCart', 'order', 'chkBillingInput', 'chkShippingInput', 'checkExistenceOfUser', 'getBillingAddress', 'loadTotalRows', 'addShippingMethodToSession', 'chkProductInCart','calculateShippingValue'),
                'users' => array('*'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionChkProductInCart() {
        if (Yii::app()->request->isAjaxRequest && $_POST) {
            $pids = $_POST['ids'];
            array_unique($pids);
            $cart = Yii::app()->session['cart'];
            $return = array();
            foreach ($cart as $v):
                if ($v['productType'] == 'Regular' && in_array($v['id'], $pids)) {
                    $return[] = $v['id'];
                }
            endforeach;
            echo CJSON::encode($return);
        }
        Yii::app()->end();
    }

    public function actionLoadTotalRows() {
        $this->renderPartial('loadTotalRows');
        Yii::app()->end();
    }

    public function actionGetBillingAddress() {
        if ($_POST['id']) {
            $id = Yii::app()->easycode->safeReadFrom($_POST['id']);
            $add = BillingInfo::model()->findByPk($id);
            $address = array(
                'name' => $add->name,
                'street_address' => $add->street_address,
                'city' => $add->city,
                'pincode' => $add->pincode,
                'country' => $add->country,
                'phone' => $add->phone,
            );
            echo CJSON::encode($address);
            Yii::app()->end();
        }
    }

    public function actionCheckExistenceOfUser() {
        if ($_POST['email']) {
            $email = Yii::app()->easycode->safeReadFrom($_POST['email']);
            if (User::model()->exists('email=:email', array(':email' => $email))) {
                echo 0;
            } else {
                echo 1;
            }
        }
    }

    public function actionChkBillingInput() {
        if (Yii::app()->request->isAjaxRequest && $_POST) {
            $name = Yii::app()->easycode->safeReadFrom($_POST['name']);
            $street_address = Yii::app()->easycode->safeReadFrom($_POST['street_address']);
            $city = Yii::app()->easycode->safeReadFrom($_POST['city']);
            $state = Yii::app()->easycode->safeReadFrom($_POST['state']);
            $country = Yii::app()->easycode->safeReadFrom($_POST['country']);
            $pincode = Yii::app()->easycode->safeReadFrom($_POST['pincode']);
            $phone = Yii::app()->easycode->safeReadFrom($_POST['phone']);

            $model = new BillingInfo;
            $model->name = $name;
            $model->street_address = $street_address;
            $model->city = $city;
            $model->state = $state;
            $model->country = $country;
            $model->pincode = $pincode;
            $model->phone = $phone;
            $model->update_by = 1;
            $model->user_id_fk = 1;
            if ($model->validate()) {
                echo CJSON::encode(array(
                    'validate' => true,
                ));
            } else {
                echo CJSON::encode(array(
                    'validate' => false,
                    'errors' => $model->getErrors(),
                ));
            }
            Yii::app()->end();
        }
    }

    public function actionChkShippingInput() {
        if (Yii::app()->request->isAjaxRequest && $_POST) {
            $name = Yii::app()->easycode->safeReadFrom($_POST['name']);
            $street_address = Yii::app()->easycode->safeReadFrom($_POST['street_address']);
            $city = Yii::app()->easycode->safeReadFrom($_POST['city']);
            $state = Yii::app()->easycode->safeReadFrom($_POST['state']);
            $country = Yii::app()->easycode->safeReadFrom($_POST['country']);
            $pincode = Yii::app()->easycode->safeReadFrom($_POST['pincode']);
            $phone = Yii::app()->easycode->safeReadFrom($_POST['phone']);

            $model = new ShippingInfo;
            $model->name = $name;
            $model->street_address = $street_address;
            $model->city = $city;
            $model->state = $state;
            $model->country = $country;
            $model->pincode = $pincode;
            $model->phone = $phone;
            $model->update_by = 1;
            $model->user_id_fk = 1;
            if ($model->validate()) {
                echo CJSON::encode(array(
                    'validate' => true,
                ));
            } else {
                echo CJSON::encode(array(
                    'validate' => false,
                    'errors' => $model->getErrors(),
                ));
            }
            Yii::app()->end();
        }
    }

    public function actionIndex() {
        $this->redirect(array('checkout'));
    }


    public function actionUpdateCart() {
        $id = (int) trim($_POST['id']);
        $qty = (int) trim($_POST['qty']);

        $session = Yii::app()->session;
        $temp = $session['cart'];

        $temp[$id]['qty'] = $qty;
        if(count($temp[$id]['productOption'])>0)
            $option=CJSON::decode($temp[$id]['productOption']);
        else
            $option=array();

        if($temp[$id]['item_from']=='Product')
            $temp[$id]['price'] = $qty * Products::model()->getProductPrice($temp[$id]['id'],$option);
        else
            $temp[$id]['price'] = $qty * Service::model()->getProductPrice($temp[$id]['id']);

        $session['cart'] = $temp;
        echo number_format($temp[$id]['price'], Yii::app()->params->decimalPoint);
    }

    public function actionDell($id = '') {
        if ($id == '')
            $id = (int) trim($_POST['id']);
        $session = Yii::app()->session;
        $temp = $session['cart'];
        unset($temp[$id]);
        $session['cart'] = $temp;
        echo 1;
        //Yii::app()->user->setFlash('success', "1 item deleted from cart");
        //$this->redirect(array($_GET['return']));
    }

    public function dellFromCart($id) {
        $session = Yii::app()->session;
        $temp = $session['cart'];
        unset($temp[$id]);
        $session['cart'] = $temp;
    }

    public function actionAdd() {
        if (isset($_POST)) {
            $session = Yii::app()->session;

            if (isset($session['item'])) {
                $session['item'] +=1;
            } else {
                $session['item'] = 0;
            }
            $cc = $session['item'];

            $pid = Yii::app()->easycode->safeReadFrom($_POST['product-id']);
            $subscriptionId = Yii::app()->easycode->safeReadFrom($_POST['subscription']);
            $subscriptionMonth = Yii::app()->easycode->safeReadFrom($_POST['subscriptionMonth']);
            $qty = Yii::app()->easycode->safeReadFrom($_POST['productQty']);
            $item_from = Yii::app()->easycode->safeReadFrom($_POST['item_from']);
            $productOption=CJSON::encode($_POST['productOption']);
            if($item_from=='Product'){
                $productPrice = Products::model()->getProductPrice($pid,$_POST['productOption'],$_POST['productQty']);
                $productInfo = Products::model()->findByPk($pid);
            }
            else{
                $productPrice = Service::model()->getProductPrice($pid,array(),$_POST['productQty'],$subscriptionId);
                $productInfo = Service::model()->findByPk($pid);
            }

            $cartArray = Yii::app()->session['cart'];
            $match = 0;
            if (count($cartArray) > 0) {
                foreach ($cartArray as $key => $preCart):
                    if ($preCart['id'] == $pid) {
                        $qty += $preCart['qty'];
                        $match = 1;
                        $matchKey = $key;
                    }
                endforeach;
            }

            $price = $qty * $productPrice;//Products::model()->getProductPrice($pid, $_POST['option'], $_POST['productQty']);
            $product = array(
                'id' => $pid,
                'qty' => $qty,
                'name' => $productInfo->name,
                'image' => $productInfo->image,
                'productPrice' => $productPrice,
                'price' => $price,
                'currency' => 'USD',
                'item_from' => $item_from,
                'productOption'=>$productOption,
                'subscriptionId'=>$subscriptionId,
                'subscriptionMonth'=>$subscriptionMonth,
            );


            $cartArray[$cc] = $product;
            $session['cart'] = $cartArray;

            if (isset($matchKey))
                $this->dellFromCart($matchKey);

            //echo json_encode($session['cart']);
            echo 1;
        }
    }

    public function actionCountItemsAmount() {
        $session = Yii::app()->session;
        $totalItems = count($session['cart']);
        $totalAmounts = 0;
        $cartItems = $session['cart'];
        // if ($totalItems > 0) {
        //     foreach ($cartItems as $k => $v):
        //         $totalAmounts += Yii::app()->currency->convertCart($v['price'],false,$v['currency']);
        //     endforeach;
        // }
        //echo json_encode(array('totalItems'=>$totalItems,'totalAmounts'=>Yii::app()->params->currencySymbol.' '.number_format($totalAmounts,Yii::app()->params->decimalPoint)));
        echo json_encode(array('totalItems' => $totalItems));
    }

    public function actionUpdateMiniCart() {
        $data['session'] = Yii::app()->session;
        $this->renderPartial('miniCart', array(
            'data' => $data,
        ));
    }

    public function actionCheckout() {
        $this->pageTitle = 'Checkout your order';
        $this->render('checkout');
    }

    public function getOrderingUserId($data) {
        $userId = 0;
        if (Yii::app()->user->isGuest){
            $type = Yii::app()->easycode->safeReadFrom($_POST['user_type']);
            if ($type == 'Guest') {
                $email = Yii::app()->easycode->safeReadFrom($_POST['guest_email_address']);
                if (User::model()->exists('email=:email', array(':email' => $email))) {
                    $user = User::model()->find('email=:email', array(':email' => $email));
                    $userId = $user->id;
                } else {
                    $password = '2441139_dox2020';
                    $first_name = Yii::app()->easycode->safeReadFrom($_POST['BillingInfo']['name']);
                    //$last_name = Yii::app()->easycode->safeReadFrom($_POST['BillingInfo']['name']);
                    $phone = Yii::app()->easycode->safeReadFrom($_POST['BillingInfo']['phone']);
                    $role = 3; //3 is guest user
                    /* save guest user */
                    $saveUser = new User;
                    $saveUser->first_name = $first_name;
                    //$saveUser->last_name = $last_name;
                    $saveUser->email = $email;
                    $saveUser->password = Yii::app()->easycode->genPass($password);
                    $saveUser->repeatpassword = Yii::app()->easycode->genPass($password);
                    $saveUser->phone = $phone;
                    $saveUser->role = $role;
                    $saveUser->email_verified = '1';
                    if ($saveUser->save())
                        $userId = $saveUser->id;
                    /* save guest user */
                }
            }else {
                $email = Yii::app()->easycode->safeReadFrom($_POST['register_email_address']);
                $password = Yii::app()->easycode->genPass(Yii::app()->easycode->safeReadFrom($_POST['password']));
                $repassword = Yii::app()->easycode->genPass(Yii::app()->easycode->safeReadFrom($_POST['repassword']));
                $first_name = Yii::app()->easycode->safeReadFrom($_POST['register_first_name']);
                //$last_name = Yii::app()->easycode->safeReadFrom($_POST['register_last_name']);
                //$phone = Yii::app()->easycode->safeReadFrom($_POST['BillingInfo']['phone']);
                $verification_code = md5(Yii::app()->params->md5Key . $email);
                $role = 2; //2 is customer user
                /* save new user */
                $saveUser = new User;
                $saveUser->first_name = $email;
                $saveUser->username = $email;
                $saveUser->email = $email;
                $saveUser->password = $password;
                $saveUser->repeatpassword = $repassword;
                $saveUser->verification_code = $verification_code;
                //$saveUser->phone = $phone;
                $saveUser->role = $role;
                if ($saveUser->save()) {
                    $saveUser->sendRegistrationSuccessMail($saveUser->id);
                    $userId = $saveUser->id;
                }

            //$userId=$saveUser->getErrors();
                /* save new user */
            }
        } else {
            //return looged user id
            $userId = Yii::app()->user->userId;
        }
        return $userId;
    }

    public function genBillingInfo($data, $userid) {
        $billingId = Yii::app()->easycode->safeReadFrom($data['address_id_billing']);
        if ($billingId != '') {
            $model = BillingInfo::model()->findByPk($billingId);
        } else {
            $model = new BillingInfo;
        }
        $model->attributes = $data['BillingInfo'];
        $model->street_address = Yii::app()->easycode->nl2br($data['BillingInfo']['street_address']);
        $model->user_id_fk = $userid;
        $model->update_by = $userid;
        if ($model->save()) {
            $return = CJSON::encode($model);
        } else {
            $return = '';
        }
        return $return;
    }

    public function genShippingInfo($data, $userid) {
        $billingId = Yii::app()->easycode->safeReadFrom($data['address_id_delivery']);
        if ($billingId != '') {
            $model = ShippingInfo::model()->findByPk($billingId);
        } else {
            $model = new ShippingInfo;
        }
        $model->attributes = $data['ShippingInfo'];
        $model->street_address = Yii::app()->easycode->nl2br($data['ShippingInfo']['street_address']);
        $model->user_id_fk = $userid;
        $model->update_by = $userid;
        if ($model->save()) {
            $return = CJSON::encode($model);
        } else {
            $return = '';
        }

        return $return;
    }
    public function actionAddShippingMethodToSession() {
        if ($_GET['method']) {
            $session = Yii::app()->session;
            $session['shipping_method'] = Yii::app()->easycode->safeReadFrom($_GET['method']);
            //echo $session['shipping_method'];
            echo 1;
        }
        Yii::app()->end();
    }

    public function actionOrder() {
        $this->pageTitle = 'Order now - ' . Yii::app()->name;
        Yii::app()->user->returnUrl = $this->createUrl('//cart/order');

        $model = new Order;

        $data = array();
        $data['login'] = new LoginForm;

        $data['userId'] = $this->getOrderingUserId((isset($_POST)) ? $_POST : array());
        //echo ( $data['userId']);exit();
        $model->delivery_info = ShippingInfo::model()->getShippingInfo($data['userId']);
         $total = 0;
            $mixingPrice = 0;
            //start read session
            $session = Yii::app()->session;
            foreach ($session['cart'] as $k => $v):
                $total += $v['price'];
            endforeach;
            //end read session
        if (!Yii::app()->user->isGuest)
            $data['billingInfo'] = BillingInfo::model()->find('user_id_fk=:uid order by id desc', array(':uid' => Yii::app()->user->userId));
        else
            $data['billingInfo'] = array();

        if (!Yii::app()->user->isGuest)
            $data['shippingInfo'] = ShippingInfo::model()->find('user_id_fk=:uid order by id desc', array(':uid' => Yii::app()->user->userId));
        else
            $data['shippingInfo'] = array();

        $data['shippingMethod'] = ShippingSettings::model()->findAll('status=:status order by sort_order', array(':status' => 1));



        if ($_POST) {
            //print_r($_POST);exit;
            $vat = $model->calVat($total);
            $tax = $model->calTax($total);
            $model->attributes = $_POST['Order'];
            
            $model->user_id_fk = $data['userId'];
            $model->order_number = $model->genOrderNumber('TOT');
            $model->total = $total;
            $model->discount = 0;
            $model->vat = number_format($vat, Yii::app()->params->decimalPoint);
            $model->tax = number_format($tax, Yii::app()->params->decimalPoint);
            
            $model->billing_info = $this->genBillingInfo($_POST, $data['userId']);
            
            $model->delivery_info = $this->genShippingInfo($_POST, $data['userId']);
            
            //$model->delivery_charge = $model->calDeliveryCharge($total);
            $model->delivery_charge =Yii::app()->easycode->safeReadFrom($_POST['shipping_method']);
            $model->grand_total = ($total - $model->discount) + $model->delivery_charge + $model->vat + $model->tax;
            $model->update_by = $data['userId'];
            
            $model->update_time = date("Y-m-d H:i:s");
            $model->payment_method = 0;
            $model->shipping_method = 1;
            $model->currency = 'usd';
            //print_r($v);
            //echo $model->grand_total;exit();
            if ($model->save()) {
                //save current status
                OrderProccessingHistory::model()->saveCurrentStatus($model->id);

                //start order items
                $identity = array();
                foreach ($session['cart'] as $k => $v):
                    if ($v['item_from'] == 'Product') {
                        OrderProducts::model()->saveData($model, $v);
                        if (!in_array('P', $identity))
                            $identity[] = 'P';
                    }else {
                        OrderProducts::model()->saveData($model, $v);
                        if (!in_array('S', $identity))
                            $identity[] = 'S';
                    }
                endforeach;
                //end order items

                $maxSubscriptionMonth=OrderProducts::model()->findBySql("select MAX(subscribtion_month) as subscribtion_month from order_products where order_id_fk=".$model->id)->subscribtion_month;

            for($i=1;$i<=$maxSubscriptionMonth;$i++){

                if($i>1){
                    $invoiceDate=date('Y-m-d', strtotime("+".(($i-1)*30)." days"));
                    $invoiceDueDate=date('Y-m-d', strtotime($invoiceDate."+5 days"));
                }else{
                    $invoiceDate=date('Y-m-d');
                    $invoiceDueDate=date('Y-m-d');
                }

                $allOrderProduct=OrderProducts::model()->findAll("order_id_fk=".$model->id);
                $invoiceAmountTotal=0;
                $productInfo=array();
                foreach($allOrderProduct as $rowProductList):
                    $countCalPrice=$rowProductList->subscribtion_month;
                    if($countCalPrice>=$i){
                        $invoiceAmount =($rowProductList->total/$rowProductList->subscribtion_month);
                        $invoiceAmountTotal =$invoiceAmountTotal+$invoiceAmount;
                        $productInfo[]=array('id'=>$rowProductList->id,'price'=>$invoiceAmount);
                }
                endforeach;
                $invoice = new OrderInvoice;
                $invoice->order_id=$model->id;
                $invoice->users_id_fk = $model->user_id_fk;
                $invoice->invoice_number=$invoice->genOrderNumber('INV',$model->id);
                $invoice->invoice_date=$invoiceDate;
                $invoice->invoice_amount=$invoiceAmountTotal;
                $invoice->due_date=$invoiceDueDate;
                $invoice->status='Pending';
                $invoice->payment_status='Due';
                $invoice->product_info=CJSON::encode($productInfo);
                $invoice->save();
            }

                if (count($identity) > 0)
                    $model->updateByPk($model->id, array('identity_text' => implode(',', $identity)));

                Yii::app()->user->setFlash('success', "Order successfully placed");
                unset($session['cart']);

                $subject = 'New Order: ' . $model->order_number . ' (Pending)';

                //Mail for order placed
                //Order::model()->mailSent($model->id,$subject);//sent mail

                $this->redirect(array('//payment/payNow', 'order' => 'success', 'id' => $model->id, 'invoiceid' => ''));
            }else {
                Yii::app()->user->setFlash('error', "Warning: Order not save due to critical error");
                //print_r($model->getErrors());exit;
            }
        }
        
        if (isset($_GET['orderid'])) {
            $data['orderInfo'] = $model->findByPk((int) $_GET['orderid']);
        }

        //print_r($model->getErrors());

        $this->render('order', array(
            'model' => $model,
            'data' => $data,
        ));
    }

    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}
