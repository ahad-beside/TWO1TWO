<?php
class OrderController extends Controller {
    public $layout = '//layouts/main';
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }
    public function accessRules() {

        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'view', 'create', 'update', 'orderview', 'pendingWithoutPayment', 'pendingWithPayment', 'received', 'shipped', 'delivered', 'confirmed', 'canceled', 'confirmedList', 'artworkConfirmedList', 'artworkConfirmed', 'productionList', 'production', 'shippedList', 'receiveList', 'deliveredList', 'canceledList', 'print', 'setFlag', 'artworkUpload', 'artworkSave', 'loadRegularProducts', 'loadCustomizedProductType', 'loadCustomizedProductSize', 'genIndProRow', 'pending', 'sendInvoice', 'downloadInvoice', 'artworkUploadSingle', 'getOrderCount', 'individualArtworkConfirmed', 'individualArtworkPending','getBillingNShipping','dueList'),
                'roles' => array('Admin'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    
    public function actionGetBillingNShipping(){
        if($_POST){
            //get billing information
            $binfo = BillingInfo::model()->find('user_id_fk=:uid order by id desc',array(':uid'=>Yii::app()->easycode->safeReadFrom($_POST['custId'])));
                
            
            //get shipping information
            $sinfo = ShippingInfo::model()->find('user_id_fk=:uid order by id desc',array(':uid'=>Yii::app()->easycode->safeReadFrom($_POST['custId'])));
                
            $this->renderPartial('billingShippingForm',array('billing'=>$binfo,'shipping'=>$sinfo));
            Yii::app()->end();
        }
    }
    
    public function actionGetBillingNShipping_old(){
        if($_POST){
            //get billing information
            $billing = BillingInfo::model()->findAll('user_id_fk=:uid order by id desc',array(':uid'=>Yii::app()->easycode->safeReadFrom($_POST['custId'])));
            $billingOpt='';
            foreach($billing as $binfo):
                $billingOpt .= '<option value="'.$binfo->id.'">'.$binfo->name.', '.$binfo->street_address.', '.$binfo->city.', '.$binfo->pincode.', '.$binfo->phone.', '.$binfo->countryIdFk->name.'</option>';
            endforeach;
            
            //get shipping information
            $shipping = ShippingInfo::model()->findAll('user_id_fk=:uid order by id desc',array(':uid'=>Yii::app()->easycode->safeReadFrom($_POST['custId'])));
            $shippingOpt='';
            foreach($shipping as $sinfo):
                $shippingOpt .= '<option value="'.$sinfo->id.'">'.$sinfo->name.', '.$sinfo->street_address.', '.$sinfo->city.', '.$sinfo->pincode.', '.$sinfo->phone.', '.$sinfo->countryIdFk->name.'</option>';
            endforeach;
            echo CJSON::encode(array('billing'=>$billingOpt,'shipping'=>$shippingOpt));
            Yii::app()->end();
        }
    }

    public function actionSendInvoice($id) {
        //$id = $_GET['id'];

        $this->pageTitle = 'Order View - ' . Yii::app()->name;
        $this->layout = '//layouts/flash';

        $order = Order::model()->find("id='" . $id . "'");

        if (count($order) < 1)
            throw new CHttpException(404, 'You are not permitted to do this');

        $orderInfo = Order::model()->findByPk($id);
        $userInfo = User::model()->findByPk($orderInfo->user_id_fk);

        $mPDF1 = Yii::app()->ePdf->mpdf();
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4', 0, '', 5, 5, 5, 5);

        $mPDF1->WriteHTML($this->renderPartial('invoicepdf', array('order' => $order), true));
        $fileName = $order->order_number . ".pdf";
        $path = INVOICE . '/' . $fileName;
        $mPDF1->Output($path, 'F');

        $storeMailSettings = StoreMailSettings::model()->find('store_id=:storeid', array(':storeid' => STORE_ID));
        $storeSettings = StoreSettings::model()->findByPk(STORE_ID);
        $button = "<a target='_blank' href='https://www.uscraft.com/payment/payNow/order/success/id/$order->id'><b>Pay</b></a>";
        $text = <<<TEXT
                <strong>Dear Customer,</strong><br>
                Please find the attached invoice of order# $order->order_number <br><br>
                For payment please click here $button<br>
                Thanks,<br>
                USCraft.
TEXT;
        $subject = 'Invoice of Order# ' . $order->order_number . ' | SGD ' . $order->grand_total;
        $mail = new YiiMailer('withHtml', array('text' => $text));
        $mail->setLayout('mail');
        $mail->setFrom($storeMailSettings->mailer_mail, $storeMailSettings->mailer_name);
        $mail->setSubject($subject . ' - ' . $storeSettings->store_name);
        $mail->setAttachment($path);
        $mail->setTo($userInfo->email);
        $mail->setCc($storeMailSettings->mailer_mail);
        if ($mail->send()) {
            echo 1;
        } else {
            echo 0;
        }
//        $this->render('invoicepdf', array(
//            'order' => $order,
//        ));
    }

    public function actionDownloadInvoice($id) {
        //$id = $_GET['id'];

        $this->pageTitle = 'Order View - ' . Yii::app()->name;
        $this->layout = '//layouts/flash';

        $order = Order::model()->find("id='" . $id . "'");

        if (count($order) < 1)
            throw new CHttpException(404, 'You are not permitted to do this');
        //$this->render('invoicepdf', array('order' => $order));
        
        //$this->render('invoicepdf', array('order' => $order));exit();

        $orderInfo = Order::model()->findByPk($id);
        $userInfo = User::model()->findByPk($orderInfo->user_id_fk);

        $mPDF1 = Yii::app()->ePdf->mpdf();
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4', 0, '', 5, 5, 5, 5);

        $mPDF1->WriteHTML($this->renderPartial('invoicepdf', array('order' => $order), true));
        $fileName = $order->order_number . ".pdf";
        $path = INVOICE . '/' . $fileName;
        $mPDF1->Output($fileName, 'D');
    }

    public function actionGenIndProRow() {

        if ($_POST):

            $this->renderPartial('genIndProRow', array('data' => $_POST));

        endif;
    }

    public function actionGetOrderCount() {
        $pendingCount = Order::model()->findAll("status='Pending'");
        $totalPending = count($pendingCount);

        $confirmCount = Order::model()->findAll("status='Confirmed'");
        $totalConfirm = count($confirmCount);

        $paymentCount = Order::model()->findAll("payment_status='Paid'");
        $totalPayment = count($paymentCount);

        $productionCount = Order::model()->findAll("status='Production'");
        $totalProduction = count($productionCount);

        $receiveCount = Order::model()->findAll("status='Received'");
        $totalReceive = count($receiveCount);

        $shippedCount = Order::model()->findAll("status='Shipped'");
        $totalShipped = count($shippedCount);

        $cancelCount = Order::model()->findAll("status='Canceled'");
        $totalCancel = count($cancelCount);

        $dueCount = Order::model()->findAll("payment_status='Due' and status!='Canceled' and status!='Pending'");
        $totalDue = count($dueCount);

        echo CJSON::encode(array('pending' => $totalPending, 'confirmed' => $totalConfirm, 'payment' => $totalPayment, 'received' => $totalReceive, 'shipped' => $totalShipped, 'canceled' => $totalCancel, 'production' => $totalProduction, 'due' => $totalDue));
        Yii::app()->end();
    }

    public function actionLoadCustomizedProductSize() {

        $products = CustomProductSize::model()->findAll('status=:status and product_fk=:pfk order by sort_order', array(':status' => 1, ':pfk' => Yii::app()->easycode->safeReadFrom($_POST['id'])));

        if (count($products) > 1)
            echo '<option value="">Select Any</option>';

        foreach ($products as $product):

            echo '<option value="' . $product->id . '">' . $product->name . '</option>';

        endforeach;
    }

    public function actionLoadCustomizedProductType() {

        $products = CustomProductType::model()->findAll('status=:status and product_fk=:pfk order by sort_order', array(':status' => 1, ':pfk' => Yii::app()->easycode->safeReadFrom($_POST['id'])));

        if (count($products) > 1)
            echo '<option value="">Select Any</option>';

        foreach ($products as $product):

            echo '<option value="' . $product->id . '">' . $product->name . '</option>';

        endforeach;
    }

    public function actionLoadRegularProducts() {

        $products = Products::model()->findAll('status=:status and outofstock_status=:stock order by name', array(':status' => 1, ':stock' => 'In Stock'));

        echo '<option value="">Select Any</option>';

        foreach ($products as $product):
            echo '<option value="' . $product->id . '">' . $product->name . '</option>';
        endforeach;
    }
    
    public function actionUpdate($id){
        $data['order'] = Order::model()->findByPk((int)$id); //get data from order table
        $data['orderProducts'] = OrderProducts::model()->findAll('order_id_fk=:ofk',array(':ofk'=>(int)$id)); //get regular products
        $data['orderCustomProduct'] = OrderCustomProduct::model()->findAll('order_id=:ofk',array('ofk'=>(int)$id)); //get custom products
        
        //get billing id
        $bill = CJSON::decode($data['order']->billing_info);
        $data['billingId']=$bill['id'];
        
        //get shipping id
        $ship = CJSON::decode($data['order']->delivery_info);
        $data['shippingId']=$ship['id'];
        
        if ($_POST) {
            //echo $_POST['product_added'];exit();
            $order_number = $data['order']->order_number;
            $order_date = Yii::app()->easycode->safeReadFrom($_POST['order_date']);
            $customer = Yii::app()->easycode->safeReadFrom($_POST['customer']);
            $bankName = Yii::app()->easycode->safeReadFrom($_POST['bankName']);
            $currency = Yii::app()->easycode->safeReadFrom($_POST['currency']);
            $productionTime = Yii::app()->easycode->safeReadFrom($_POST['productionTime']);
            $shippingTime = Yii::app()->easycode->safeReadFrom($_POST['shippingTime']);
            $orderNote = Yii::app()->easycode->safeReadFrom($_POST['orderNote']);

            /* Order Save Start */
            $orderModel = $data['order'];
            $orderModel->order_number = $data['order']->order_number;
            $orderModel->user_id_fk = $customer;
            $orderModel->total = array_sum($_POST['productTotalPrice_added']);
            $orderModel->grand_total = array_sum($_POST['productTotalPrice_added']);
            //$orderModel->billing_info = CJSON::encode(BillingInfo::model()->findByPk($_POST['billing_id']));
            $orderModel->billing_info = $this->saveBilling($_POST['BillingInfo'], $customer, $_POST['billingInfoPk']);
            //$orderModel->delivery_info = CJSON::encode(ShippingInfo::model()->findByPk($_POST['shipping_id']));
            $orderModel->delivery_info = $this->saveShipping($_POST['ShippingInfo'], $customer, $_POST['shippingInfoPk']);


            $orderModel->update_by = Yii::app()->user->userId;
            $orderModel->payment_method = 0;
            $orderModel->shipping_method = 2;
            $orderModel->made_by = 'Admin';
            $orderModel->order_note = $orderNote;
            $orderModel->bank_id = $bankName;
            $orderModel->currency = $currency;
            $orderModel->identity_text = $this->getIdentityText($_POST['product_added']);

            if ($orderModel->save()) {

                if (count($_POST['productType_added']) > 0):
                    
                    //delete all previous product and artwork
                    OrderProducts::model()->deleteAll('order_id_fk=:ofk',array(':ofk'=>(int)$id));
                    OrderCustomProduct::model()->deleteAll('order_id=:ofk',array('ofk'=>(int)$id));
                    OrderArtwork::model()->deleteAll('order_id_fk=:ofk',array(':ofk'=>(int)$id));
                    
                    
                    for ($i = 0; $i < count($_POST['productType_added']); $i++):
                        $pk = $this->saveManualOrder($_POST, $id, $i);
                        $rand = $_POST['artwork_rand'][$i];

                        if (count($_POST['artwork_added'][$rand]) > 0):
                            $this->saveArtwork($_POST, $orderModel->id, $pk, $rand);
                        endif;
                    endfor;
                endif;

                /* if (count($_POST['artwork_added']) > 0):
                  $this->saveArtwork($_POST, $orderModel->id);
                  endif; */

                //mail now disabled
                //$subject='New Order: '.$orderModel->order_number;
                //Order::model()->mailSent($orderModel->id,$subject);//sent mail
                
                Yii::app()->user->setFlash('success', "Success: Order# ".$orderModel->order_number." successfully updated");
                $this->redirect(array('index'));
            }else {
                Yii::app()->user->setFlash('error', "Error: Order# ".$orderModel->order_number." failed to update");
            }
            /* Order Save End */
        }
        
        $this->render('update',array('data'=>$data));
    }

    public function actionCreate() {
        if ($_POST) {
            //print_r($_POST['product_added']);exit();
            $order_number = Yii::app()->easycode->safeReadFrom($_POST['order_number']);
            $order_date = Yii::app()->easycode->safeReadFrom($_POST['order_date']);
            $customer = Yii::app()->easycode->safeReadFrom($_POST['customer']);
            $bankName = Yii::app()->easycode->safeReadFrom($_POST['bankName']);
            $currency = Yii::app()->easycode->safeReadFrom($_POST['currency']);
            $productionTime = Yii::app()->easycode->safeReadFrom($_POST['productionTime']);
            $shippingTime = Yii::app()->easycode->safeReadFrom($_POST['shippingTime']);
            $orderNote = Yii::app()->easycode->safeReadFrom($_POST['orderNote']);

            /* Order Save Start */
            $orderModel = new Order;
            $orderModel->order_number = $orderModel->genOrderNumber('UC');
            $orderModel->user_id_fk = $customer;
            $orderModel->total = array_sum($_POST['productTotalPrice_added']);
            $orderModel->grand_total = array_sum($_POST['productTotalPrice_added']);
            //$orderModel->billing_info = CJSON::encode(BillingInfo::model()->findByPk($_POST['billing_id']));
            $orderModel->billing_info = $this->saveBilling($_POST['BillingInfo'], $customer, $_POST['billingInfoPk']);
            //$orderModel->delivery_info = CJSON::encode(ShippingInfo::model()->findByPk($_POST['shipping_id']));
            $orderModel->delivery_info = $this->saveShipping($_POST['ShippingInfo'], $customer, $_POST['shippingInfoPk']);
            $orderModel->update_by = Yii::app()->user->userId;
            $orderModel->payment_method = 0;
            $orderModel->shipping_method = 2;
            $orderModel->made_by = 'Admin';
            $orderModel->order_note = $orderNote;
            $orderModel->bank_id = $bankName;
            $orderModel->currency = $currency;
            $orderModel->identity_text = $this->getIdentityText($_POST['product_added']);
            if ($orderModel->save()) {
                if (count($_POST['productType_added']) > 0):
                    for ($i = 0; $i < count($_POST['productType_added']); $i++):
                        $pk = $this->saveManualOrder($_POST, $orderModel->id, $i);
                        $rand = $_POST['artwork_rand'][$i];

                        if (count($_POST['artwork_added'][$rand]) > 0):
                            $this->saveArtwork($_POST, $orderModel->id, $pk, $rand);
                        endif;
                    endfor;
                endif;

                /* if (count($_POST['artwork_added']) > 0):
                  $this->saveArtwork($_POST, $orderModel->id);
                  endif; */

                //mail now disabled
                //$subject='New Order: '.$orderModel->order_number;
                //Order::model()->mailSent($orderModel->id,$subject);//sent mail

                Yii::app()->user->setFlash('success', "Success: Order# ".$orderModel->order_number." successfully added");
                $this->redirect(array('index'));
            }else {
                print_r($orderModel->getErrors());
                Yii::app()->user->setFlash('error', "Error: Order# ".$orderModel->order_number." failed to create");
            }
            /* Order Save End */
        }
        $this->render('create');
    }

    public function saveArtwork($data, $orderId, $pk, $rand) {
        OrderArtwork::model()->updateAll(array('latest' => 'No'), 'order_id_fk=:oid and order_product=:pid', array(':oid' => $orderId, ':pid' => $pk));

        for ($i = 0; $i < count($data['artwork_added'][$rand]); $i++):
            $model = new OrderArtwork;
            $model->order_id_fk = $orderId;
            $model->order_product = $pk;
            $model->artwork = $data['artwork_added'][$rand][$i];
            $model->latest = 'Yes';
            $model->sessionId = time() . rand(11, 99);
            if ($model->save()) {
                if (file_exists('images/custom/tmp/' . $model->artwork))
                    copy('images/custom/tmp/' . $model->artwork, 'images/custom/' . $model->artwork);
            }
        endfor;
        if (count($data) > 0):
            $data['orderInfo'] = Order::model()->findByPk($orderId);
            $data['customerInfo'] = User::model()->findByPk($data['orderInfo']->user_id_fk);
            $data['latestArtwork'] = OrderArtwork::model()->findAll('order_id_fk=:oid and latest="Yes"', array(':oid' => $orderId));
        //mail now disabled
        //OrderArtwork::model()->mailSent($data);
        endif;
    }

    public function getIdentityText($data) {
        $text = (in_array(1, $data)) ? CustomProduct::model()->findByPk(1)->identity_text . ',' : '';
        $text .= (in_array(2, $data)) ? CustomProduct::model()->findByPk(2)->identity_text . ',' : '';
        $text .= (in_array(0, $data)) ? 'R,' : '';
        $text .= (in_array(3, $data)) ? CustomProduct::model()->findByPk(3)->identity_text . ',' : '';
        $text .= (in_array(4, $data)) ? CustomProduct::model()->findByPk(4)->identity_text . ',' : '';
        $text .= (in_array(8, $data)) ? CustomProduct::model()->findByPk(4)->identity_text . ',' : '';
        return rtrim($text, ',');
    }

    public function saveShipping($data, $customer, $pk) {
        if($pk!=''){
            $model = ShippingInfo::model()->findByPk($pk);
            if(count($model)<1){
                $model = new ShippingInfo;
            }
        }else{
            $model = new ShippingInfo;
        }
        $model->user_id_fk = $customer;
        $model->name = Yii::app()->easycode->safeReadFrom($data['name']);
        $model->street_address = Yii::app()->easycode->nl2br($data['street_address']);
        $model->city = Yii::app()->easycode->safeReadFrom($data['city']);
        $model->state = Yii::app()->easycode->safeReadFrom($data['state']);
        $model->pincode = Yii::app()->easycode->safeReadFrom($data['pincode']);
        $model->phone = Yii::app()->easycode->safeReadFrom($data['phone']);
        $model->update_by = Yii::app()->easycode->safeReadFrom(Yii::app()->user->userId);
        $model->country = Yii::app()->easycode->safeReadFrom($data['country']);
        if ($model->save()) {
            return CJSON::encode($model);
        }
    }

    public function saveBilling($data, $customer, $pk) {
        if($pk!=''){
            $model = BillingInfo::model()->findByPk($pk);
            if(count($model)<1){
                $model = new BillingInfo;
            }
        }else{
            $model = new BillingInfo;
        }
        $model->user_id_fk = $customer;
        $model->name = Yii::app()->easycode->safeReadFrom($data['name']);
        $model->street_address = Yii::app()->easycode->nl2br($data['street_address']);
        $model->city = Yii::app()->easycode->safeReadFrom($data['city']);
        $model->state = Yii::app()->easycode->safeReadFrom($data['state']);
        $model->pincode = Yii::app()->easycode->safeReadFrom($data['pincode']);
        $model->phone = Yii::app()->easycode->safeReadFrom($data['phone']);
        $model->update_by = Yii::app()->user->userId;
        $model->country = Yii::app()->easycode->safeReadFrom($data['country']);
        if ($model->save()) {
            return CJSON::encode($model);
        }
    }

    public function saveArtwork_old($data, $orderId) {
        for ($i = 0; $i < count($data['artwork_added']); $i++):
            OrderArtwork::model()->updateAll(array('latest' => 'No'), 'order_id_fk=:oid and order_product=:pid', array(':oid' => $orderId, ':pid' => $data['artwork_product'][$i]));
            $model = new OrderArtwork;
            $model->order_id_fk = $orderId;
            $model->order_product = $data['artwork_product'][$i];
            $model->artwork = $data['artwork_added'][$i];
            $model->latest = 'Yes';
            $model->sessionId = time() . rand(11, 99);
            if ($model->save()) {
                //OrderArtwork::model()->updateByPk($model->id,array('order_product'=>))
                if (file_exists('images/custom/tmp/' . $model->artwork))
                    copy('images/custom/tmp/' . $model->artwork, 'images/custom/' . $model->artwork);
            }
        endfor;
        if (count($data) > 0):
            $data['orderInfo'] = Order::model()->findByPk($orderId);
            $data['customerInfo'] = User::model()->findByPk($data['orderInfo']->user_id_fk);
            $data['latestArtwork'] = OrderArtwork::model()->findAll('order_id_fk=:oid and latest="Yes"', array(':oid' => $orderId));
        //mail now disabled
        //OrderArtwork::model()->mailSent($data);
        endif;
    }

    public function saveManualOrder($data, $orderId, $i) {
        if ($data['product_added'][$i] == '0'):
            $model = new OrderProducts;
            $model->order_id_fk = $orderId;
            $model->products_id_fk = $data['productType_added'][$i];
            $model->options = '[]';
            $model->qty = $data['productQty_added'][$i];
            $model->price = $data['productUnitPrice_added'][$i];
            $model->total = $data['productTotalPrice_added'][$i];
            $model->special_instruction = $data['productNotes'][$i];
            $model->save();
        else:
            $model = new OrderCustomProduct;
            $model->order_id = $orderId;
            $model->product_type = $data['productType_added'][$i];
            $model->product_size = $data['productSize_added'][$i];
            $model->special_instruction = nl2br($data['productNotes'][$i]);
            $model->front_image = '[CUSTOM]';
            $model->qty = $data['productQty_added'][$i];
            $model->price = $data['productTotalPrice_added'][$i];
            $model->msg_style = '[CUSTOM]';
            $model->front_msg = '[CUSTOM]';
            $model->decoration = ($data['productNotes'][$i] == '') ? '[CUSTOM]' : nl2br($data['productNotes'][$i]);
            $model->production_time = $data['productionTime'];
            $model->shipping_time = $data['shippingTime'];
            $model->update_by = Yii::app()->user->userId;
            $model->save();
        endif;
        return $model->id;
    }

    public function actionArtworkSave() {
        $save = false;
        $session = Yii::app()->session;

        $orderId = Yii::app()->easycode->safeReadFrom($_GET['orderId']);
        if ($_POST[artworkHidden]) {

            $i = 0;
            foreach ($_POST[artworkHidden] as $artwork):
                OrderArtwork::model()->updateAll(array('latest' => 'No'), 'order_id_fk=:oid and order_product=:op', array(':oid' => $orderId, ':op' => $_POST['product'][$i]));
                $i++;
            endforeach;

            $i = 0;
            foreach ($_POST[artworkHidden] as $artwork):
                $model = new OrderArtwork;
                $model->artwork = $artwork;
                $model->order_id_fk = $orderId;
                $model->order_product = $_POST['product'][$i];
                $model->additional_note = $_POST['additional'][$i];
                $model->latest = 'Yes';
                $model->sessionId = $session['artworkUpload'];
                if ($model->save()) {
                    $save = true;
                    copy('images/custom/tmp/' . $artwork, 'images/custom/' . $artwork);
                }
                $i++;
            endforeach;
            unset($session['artworkUpload']);
            $data['orderInfo'] = Order::model()->findByPk($orderId);
            $data['customerInfo'] = User::model()->findByPk($data['orderInfo']->user_id_fk);
            $data['latestArtwork'] = OrderArtwork::model()->findAll('order_id_fk=:oid and latest="Yes"', array(':oid' => $orderId));


            //mail now disabled
            //OrderArtwork::model()->mailSent($data);
        }



        if ($save == true)
            Yii::app()->user->setFlash('success', "Success: Artwork uploaded successfully");

        $this->redirect(array('//admin/order/orderview/' . $orderId));
    }

    public function actionArtworkUploadSingle() {
        $this->layout = '//layouts/blank';
        $this->render('artworkUploadSingle');
    }

    public function actionArtworkUpload() {

        if ($_FILES['artwork']['name'] != '') {

            $uploadedFile = CUploadedFile::getInstanceByName("artwork");

            if ($uploadedFile) {

                $fileName = Yii::app()->easycode->genFileName($uploadedFile->extensionName);

                //$model->image = $fileName;

                if ($uploadedFile->saveAs(CUSTOM_ARTWORK . '/' . $fileName))
                    echo $fileName;

                Yii::app()->end();
            }
        }
    }

    public function actionConfirmed() {

        if (Yii::app()->request->isAjaxRequest) {

            $data = array('msg' => 'error');

            if ($_POST['value']) {

                if (is_array($_POST['value'])) {

                    $totalOrders = array();

                    $totalDue = array();

                    for ($i = 0; $i < sizeof($_POST['value']); $i++):

                        if (Order::model()->checkEligibleForConfirmedOrder($_POST['value'][$i])) {

                            $paymentCheck = Order::model()->paymentStatus($_POST['value'][$i]);

                            $dueCheck = strip_tags($paymentCheck);

                            //if ($dueCheck == 'PAID') {
                            //update order status

                            Order::model()->updateByPk($_POST['value'][$i], array('status' => 'Confirmed', 'confirmed_date' => date('Y-m-d H:i:s')));

                            //save current status

                            OrderProccessingHistory::model()->saveCurrentStatus($_POST['value'][$i], 'Confirmed');

                            //mail now disabled

                            $onderNumber = Order::model()->findByPk($_POST['value'][$i]);

                            $subject = 'Order Confirmed: ' . $onderNumber->order_number;

                            //Order::model()->mailSent($_POST['value'][$i],$subject);

                            $totalOrders[] = $_POST['value'][$i];
                            //} else {
                            //$totalDue[] = $_POST['value'][$i];
                            //}
                        }
                    endfor;

                    $data = array('msg' => 'success', 'totalOrders' => count($totalOrders), 'totalDue' => count($totalDue));
                } else {

                    $totalOrders = array();

                    if (Order::model()->checkEligibleForConfirmedOrder($_POST['value'])) {

                        $paymentCheck = Order::model()->paymentStatus($_POST['value']);

                        $dueCheck = strip_tags($paymentCheck);

                        //if ($dueCheck == 'PAID') {
                        //update order status

                        Order::model()->updateByPk($_POST['value'], array('status' => 'Confirmed', 'confirmed_date' => date('Y-m-d H:i:s')));

                        //save current status

                        OrderProccessingHistory::model()->saveCurrentStatus($_POST['value'], 'Confirmed');

                        //mail now disabled

                        $onderNumber = Order::model()->findByPk($_POST['value']);

                        $subject = 'Order Confirmed: ' . $onderNumber->order_number;

                        //Order::model()->mailSent($_POST['value'],$subject);

                        $totalOrders[] = $_POST['value'];
                        //} else {
                        //$totalDue[] = $_POST['value'];
                        //}
                    }

                    $data = array('msg' => 'success', 'totalOrders' => count($totalOrders), 'totalDue' => count($totalDue));
                }
            } else {

                $data = array('msg' => 'error');
            }

            echo json_encode($data);

            Yii::app()->end();
        }
    }
    public function actionArtworkConfirmed() {

        if (Yii::app()->request->isAjaxRequest) {

            $data = array('msg' => 'error');

            if ($_POST['value']) {

                if (is_array($_POST['value'])) {

                    $totalOrders = array();

                    for ($i = 0; $i < sizeof($_POST['value']); $i++):

                        if (Order::model()->checkEligibleForArtworkConfirmedOrder($_POST['value'][$i])) {

                            //update order status
                            Order::model()->updateByPk($_POST['value'][$i], array('artwork_approved_status' => 'Approved'));

                            //save current status
                            //OrderProccessingHistory::model()->saveCurrentStatus($_POST['value'][$i], 'ArtworkConfirmed');

                            /* mail now disabled
                              $onderNumber=Order::model()->findByPk($_POST['value'][$i]);
                              $subject='Artwork Confirmed: '.$onderNumber->order_number;
                              Order::model()->mailSent($_POST['value'][$i],$subject,$isArtworkLink=true); */

                            $totalOrders[] = $_POST['value'][$i];
                        }

                    endfor;

                    $data = array('msg' => 'success', 'totalOrders' => count($totalOrders));
                } else {

                    $totalOrders = array();

                    if (Order::model()->checkEligibleForArtworkConfirmedOrder($_POST['value'])) {

                        //update order status

                        Order::model()->updateByPk($_POST['value'], array('artwork_approved_status' => 'Approved'));

                        //save current status
                        //OrderProccessingHistory::model()->saveCurrentStatus($_POST['value'], 'ArtworkConfirmed');
                        //mail now disabled

                        $onderNumber = Order::model()->findByPk($_POST['value']);

                        $subject = 'Artwork Confirmed: ' . $onderNumber->order_number;

                        //Order::model()->mailSent($_POST['value'],$subject,$isArtworkLink=true);

                        $totalOrders[] = $_POST['value'];
                    }

                    $data = array('msg' => 'success', 'totalOrders' => count($totalOrders));
                }
            } else {

                $data = array('msg' => 'error');
            }

            echo json_encode($data);

            Yii::app()->end();
        }
    }

    public function actionProduction() {

        if (Yii::app()->request->isAjaxRequest) {

            $data = array('msg' => 'error');

            if ($_POST['value']) {

                if (is_array($_POST['value'])) {

                    $totalOrders = array();

                    for ($i = 0; $i < sizeof($_POST['value']); $i++):

                        if (Order::model()->checkEligibleForProductionOrder($_POST['value'][$i])) {

                            //update order status

                            Order::model()->updateByPk($_POST['value'][$i], array('status' => 'Production', 'production_date' => date('Y-m-d H:i:s')));



                            //save current status

                            OrderProccessingHistory::model()->saveCurrentStatus($_POST['value'][$i], 'Production');

                            //mail now disabled

                            $onderNumber = Order::model()->findByPk($_POST['value'][$i]);

                            $subject = 'Order Send to production: ' . $onderNumber->order_number;

                            //Order::model()->mailSent($_POST['value'][$i],$subject);



                            $totalOrders[] = $_POST['value'][$i];
                        }

                    endfor;

                    $data = array('msg' => 'success', 'totalOrders' => count($totalOrders));
                } else {

                    $totalOrders = array();

                    if (Order::model()->checkEligibleForProductionOrder($_POST['value'])) {

                        //update order status

                        Order::model()->updateByPk($_POST['value'], array('status' => 'Production', 'production_date' => date('Y-m-d H:i:s')));



                        //save current status

                        OrderProccessingHistory::model()->saveCurrentStatus($_POST['value'], 'Production');

                        //mail now disabled

                        $onderNumber = Order::model()->findByPk($_POST['value']);

                        $subject = 'Order Send to production: ' . $onderNumber->order_number;

                        //Order::model()->mailSent($_POST['value'],$subject);

                        $totalOrders[] = $_POST['value'];
                    }

                    $data = array('msg' => 'success', 'totalOrders' => count($totalOrders));
                }
            } else {

                $data = array('msg' => 'error');
            }

            echo json_encode($data);

            Yii::app()->end();
        }
    }

    public function actionReceived() {

        if (Yii::app()->request->isAjaxRequest) {

            $data = array('msg' => 'error');

            if ($_POST['value']) {

                if (is_array($_POST['value'])) {

                    $totalOrders = array();

                    for ($i = 0; $i < sizeof($_POST['value']); $i++):

                        if (Order::model()->checkEligibleForReceivedOrder($_POST['value'][$i])) {

                            //update order status

                            Order::model()->updateByPk($_POST['value'][$i], array('status' => 'Received', 'received_date' => date('Y-m-d H:i:s')));

                            //save current status

                            OrderProccessingHistory::model()->saveCurrentStatus($_POST['value'][$i], 'Received');

                            //mail now disabled

                            $onderNumber = Order::model()->findByPk($_POST['value'][$i]);

                            $subject = 'Order Received: ' . $onderNumber->order_number;

                            //Order::model()->mailSent($_POST['value'][$i],$subject);

                            $totalOrders[] = $_POST['value'][$i];
                        }

                    endfor;

                    $data = array('msg' => 'success', 'totalOrders' => count($totalOrders));
                } else {

                    $totalOrders = array();

                    if (Order::model()->checkEligibleForShippedOrder($_POST['value'])) {

                        //update order status

                        Order::model()->updateByPk($_POST['value'], array('status' => 'Received', 'received_date' => date('Y-m-d H:i:s')));

                        //save current status

                        OrderProccessingHistory::model()->saveCurrentStatus($_POST['value'], 'Received');

                        //mail now disabled

                        $onderNumber = Order::model()->findByPk($_POST['value']);

                        $subject = 'Order Received: ' . $onderNumber->order_number;

                        //Order::model()->mailSent($_POST['value'],$subject);

                        $totalOrders[] = $_POST['value'];
                    }

                    $data = array('msg' => 'success', 'totalOrders' => count($totalOrders));
                }
            } else {

                $data = array('msg' => 'error');
            }

            echo json_encode($data);

            Yii::app()->end();
        }
    }

    public function actionShipped() {

        if (Yii::app()->request->isAjaxRequest) {

            $data = array('msg' => 'error');

            if ($_POST['value']) {

                if (is_array($_POST['value'])) {

                    $totalOrders = array();

                    for ($i = 0; $i < sizeof($_POST['value']); $i++):

                        if (Order::model()->checkEligibleForShippedOrder($_POST['value'][$i])) {

                            //update order status

                            Order::model()->updateByPk($_POST['value'][$i], array('status' => 'Shipped', 'shipped_date' => date('Y-m-d H:i:s')));

                            //save current status

                            OrderProccessingHistory::model()->saveCurrentStatus($_POST['value'][$i], 'Shipped');

                            //mail

                            $onderNumber = Order::model()->findByPk($_POST['value'][$i]);

                            $subject = 'Order Shipped: ' . $onderNumber->order_number;

                            Order::model()->mailSent($_POST['value'][$i], $subject);

                            $totalOrders[] = $_POST['value'][$i];
                        }

                    endfor;

                    $data = array('msg' => 'success', 'totalOrders' => count($totalOrders));
                } else {

                    $totalOrders = array();

                    if (Order::model()->checkEligibleForShippedOrder($_POST['value'])) {

                        //update order status

                        Order::model()->updateByPk($_POST['value'], array('status' => 'Shipped', 'shipped_date' => date('Y-m-d H:i:s')));

                        //save current status

                        OrderProccessingHistory::model()->saveCurrentStatus($_POST['value'], 'Shipped');

                        //mail

                        $onderNumber = Order::model()->findByPk($_POST['value']);

                        $subject = 'Order Shipped: ' . $onderNumber->order_number;

                        Order::model()->mailSent($_POST['value'], $subject);

                        $totalOrders[] = $_POST['value'];
                    }

                    $data = array('msg' => 'success', 'totalOrders' => count($totalOrders));
                }
            } else {

                $data = array('msg' => 'error');
            }

            echo json_encode($data);

            Yii::app()->end();
        }
    }

    public function actionDelivered() {

        if (Yii::app()->request->isAjaxRequest) {

            $data = array('msg' => 'error');

            if ($_POST['value']) {

                if (is_array($_POST['value'])) {

                    $totalOrders = array();

                    for ($i = 0; $i < sizeof($_POST['value']); $i++):

                        if (Order::model()->checkEligibleForDeliveredOrder($_POST['value'][$i])) {

                            //update order status

                            Order::model()->updateByPk($_POST['value'][$i], array('status' => 'Delivered'));



                            //save current status

                            OrderProccessingHistory::model()->saveCurrentStatus($_POST['value'][$i], 'Delivered');

                            //mail now disabled

                            $onderNumber = Order::model()->findByPk($_POST['value'][$i]);

                            $subject = 'Order Delivered: ' . $onderNumber->order_number;

                            //Order::model()->mailSent($_POST['value'][$i],$subject);

                            $totalOrders[] = $_POST['value'][$i];
                        }

                    endfor;

                    $data = array('msg' => 'success', 'totalOrders' => count($totalOrders));
                } else {

                    $totalOrders = array();

                    if (Order::model()->checkEligibleForDeliveredOrder($_POST['value'])) {

                        //update order status

                        Order::model()->updateByPk($_POST['value'], array('status' => 'Delivered'));



                        //save current status

                        OrderProccessingHistory::model()->saveCurrentStatus($_POST['value'], 'Delivered');

                        //mail now disabled

                        $onderNumber = Order::model()->findByPk($_POST['value']);

                        $subject = 'Order Delivered: ' . $onderNumber->order_number;

                        //Order::model()->mailSent($_POST['value'],$subject);

                        $totalOrders[] = $_POST['value'];
                    }

                    $data = array('msg' => 'success', 'totalOrders' => count($totalOrders));
                }
            } else {

                $data = array('msg' => 'error');
            }

            echo json_encode($data);

            Yii::app()->end();
        }
    }

    public function actionCanceled() {

        if (Yii::app()->request->isAjaxRequest) {

            $data = array('msg' => 'error');

            if ($_POST['value']) {

                if (is_array($_POST['value'])) {

                    $totalOrders = array();

                    for ($i = 0; $i < sizeof($_POST['value']); $i++):

                        if (Order::model()->checkEligibleForCanceledOrder($_POST['value'][$i])) {

                            //update order status

                            Order::model()->updateByPk($_POST['value'][$i], array('status' => 'Canceled', 'canceled_date' => date('Y-m-d H:i:s')));



                            $totalOrders[] = $_POST['value'][$i];



                            //save current status

                            OrderProccessingHistory::model()->saveCurrentStatus($_POST['value'][$i], 'Canceled');

                            //mail disabled

                            $onderNumber = Order::model()->findByPk($_POST['value'][$i]);

                            $subject = 'Order Canceled: ' . $onderNumber->order_number;

                            //Order::model()->mailSent($_POST['value'][$i],$subject);
                        }

                    endfor;

                    $data = array('msg' => 'success', 'totalOrders' => count($totalOrders));
                } else {

                    $totalOrders = array();

                    if (Order::model()->checkEligibleForCanceledOrder($_POST['value'])) {

                        //update order status

                        Order::model()->updateByPk($_POST['value'], array('status' => 'Canceled', 'canceled_date' => date('Y-m-d H:i:s')));

                        //save current status

                        OrderProccessingHistory::model()->saveCurrentStatus($_POST['value'], 'Canceled');

                        //mail disabled

                        $onderNumber = Order::model()->findByPk($_POST['value']);

                        $subject = 'Order Canceled: ' . $onderNumber->order_number;

                        //Order::model()->mailSent($_POST['value'],$subject);

                        $totalOrders[] = $_POST['value'];
                    }

                    $data = array('msg' => 'success', 'totalOrders' => count($totalOrders));
                }
            } else {

                $data = array('msg' => 'error');
            }

            echo json_encode($data);

            Yii::app()->end();
        }
    }

    public function actionIndividualArtworkConfirmed() {

        if (Yii::app()->request->isAjaxRequest) {

            $data = array('msg' => 'error');

            if ($_POST['value']) {

                $totalOrders = array();

                for ($i = 0; $i < sizeof($_POST['value']); $i++):
                    //update order status
                    OrderArtwork::model()->updateByPk($_POST['value'][$i], array('status' => 'Approved'));
                    $totalOrders[] = $_POST['value'][$i];
                endfor;
                $data = array('msg' => 'success', 'totalOrders' => count($totalOrders));
            } else {

                $data = array('msg' => 'error');
            }

            echo json_encode($data);

            Yii::app()->end();
        }
    }

    public function actionIndividualArtworkPending() {

        if (Yii::app()->request->isAjaxRequest) {

            $data = array('msg' => 'error');

            if ($_POST['value']) {

                $totalOrders = array();

                for ($i = 0; $i < sizeof($_POST['value']); $i++):
                    //update order status
                    OrderArtwork::model()->updateByPk($_POST['value'][$i], array('status' => 'Pending'));
                    $totalOrders[] = $_POST['value'][$i];
                endfor;
                $data = array('msg' => 'success', 'totalOrders' => count($totalOrders));
            } else {

                $data = array('msg' => 'error');
            }

            echo json_encode($data);

            Yii::app()->end();
        }
    }

    public function actionPending() {

        if (Yii::app()->request->isAjaxRequest) {

            $data = array('msg' => 'error');

            if ($_POST['value']) {

                if (is_array($_POST['value'])) {

                    $totalOrders = array();

                    for ($i = 0; $i < sizeof($_POST['value']); $i++):

                        if (Order::model()->checkEligibleForCanceledOrder($_POST['value'][$i])) {

                            //update order status

                            Order::model()->updateByPk($_POST['value'][$i], array('status' => 'Pending'));



                            $totalOrders[] = $_POST['value'][$i];



                            //save current status

                            OrderProccessingHistory::model()->saveCurrentStatus($_POST['value'][$i], 'Pending');

                            //mail disabled

                            $onderNumber = Order::model()->findByPk($_POST['value'][$i]);

                            $subject = 'Order Pending: ' . $onderNumber->order_number;

                            //Order::model()->mailSent($_POST['value'][$i],$subject);
                        }

                    endfor;

                    $data = array('msg' => 'success', 'totalOrders' => count($totalOrders));
                } else {

                    $totalOrders = array();

                    if (Order::model()->checkEligibleForCanceledOrder($_POST['value'])) {

                        //update order status

                        Order::model()->updateByPk($_POST['value'], array('status' => 'Pending'));

                        //save current status

                        OrderProccessingHistory::model()->saveCurrentStatus($_POST['value'], 'Pending');

                        //mail disabled

                        $onderNumber = Order::model()->findByPk($_POST['value']);

                        $subject = 'Order Pending: ' . $onderNumber->order_number;

                        //Order::model()->mailSent($_POST['value'],$subject);

                        $totalOrders[] = $_POST['value'];
                    }

                    $data = array('msg' => 'success', 'totalOrders' => count($totalOrders));
                }
            } else {

                $data = array('msg' => 'error');
            }

            echo json_encode($data);

            Yii::app()->end();
        }
    }

    public function actionIndex() {

        /* By defatult index page show pending order list */
        $this->pageTitle='Pending Order List';
        $model = new Order;
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['Order']))
            $model->attributes = $_GET['Order'];
        $data['status'] = 'Pending';
        $this->render('index', array(
            'model' => $model,
            'data' => $data,
        ));
    }

    public function actionSetFlag($id) {

        if (Yii::app()->request->isAjaxRequest) {

            $data = array('msg' => 'error');

            if ($_POST['value']) {

                if (is_array($_POST['value'])) {

                    $totalOrders = array();

                    for ($i = 0; $i < sizeof($_POST['value']); $i++):

                        //update order status

                        Order::model()->updateByPk($_POST['value'][$i], array('flag_id' => $id));

                        $totalOrders[] = $_POST['value'][$i];

                    endfor;

                    $data = array('msg' => 'success', 'totalFlag' => count($totalOrders));
                }else {

                    $totalOrders = array();

                    //update order status

                    Order::model()->updateByPk($_POST['value'], array('flag_id' => $id));

                    $totalOrders[] = $_POST['value'];

                    $data = array('msg' => 'success', 'totalFlag' => count($totalOrders));
                }
            } else {

                $data = array('msg' => 'error');
            }

            echo json_encode($data);

            Yii::app()->end();
        }
    }

    public function actionConfirmedList() {
        $this->pageTitle='Confirmed Order List';
        /* By defatult index page show pending order list */

        $model = new Order;

        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['Order'])) {

            $model->attributes = $_GET['Order'];
        }



        $data['status'] = 'Confirmed';



        $this->render('index', array(
            'model' => $model,
            'data' => $data,
        ));
    }

    public function actionDeliveredList() {

        /* By defatult index page show pending order list */

        $model = new Order;

        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['Order'])) {

            $model->attributes = $_GET['Order'];
        }

        $data['status'] = 'Delivered';



        $this->render('index', array(
            'model' => $model,
            'data' => $data,
        ));
    }

    public function actionCanceledList() {

        $this->pageTitle='Cancled Order List';
        /* By defatult index page show pending order list */

        $model = new Order;

        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['Order'])) {

            $model->attributes = $_GET['Order'];
        }

        $data['status'] = 'Canceled';



        $this->render('index', array(
            'model' => $model,
            'data' => $data,
        ));
    }

    public function actionProductionList() {

        /* By defatult index page show pending order list */

        $model = new Order;

        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['Order'])) {

            $model->attributes = $_GET['Order'];
        }

        $data['status'] = 'Production';



        $this->render('index', array(
            'model' => $model,
            'data' => $data,
        ));
    }
    public function actionDueList() {

        /* By defatult index page show pending order list */

        $model = new Order;

        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['Order'])) {

            $model->attributes = $_GET['Order'];
        }

        $data['status'] = '';
        $data['paymentStatus'] = 'Due';



        $this->render('index', array(
            'model' => $model,
            'data' => $data,
        ));
    }

    public function actionArtworkConfirmedList() {

        /* By defatult index page show pending order list */

        $model = new Order;

        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['Order'])) {

            $model->attributes = $_GET['Order'];
        }

        $data['status'] = 'ArtworkConfirmed';



        $this->render('index', array(
            'model' => $model,
            'data' => $data,
        ));
    }

    public function actionReceiveList() {

        /* By defatult index page show pending order list */

        $model = new Order;

        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['Order'])) {

            $model->attributes = $_GET['Order'];
        }

        $data['status'] = 'Received';



        $this->render('index', array(
            'model' => $model,
            'data' => $data,
        ));
    }

    public function actionShippedList() {

        $this->pageTitle='Shipped Order List';
        /* By defatult index page show pending order list */

        $model = new Order;

        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['Order'])) {

            $model->attributes = $_GET['Order'];
        }

        $data['status'] = 'Shipped';



        $this->render('index', array(
            'model' => $model,
            'data' => $data,
        ));
    }

    public function actionOrderview($id) {
        $this->layout = '//layouts/main';
        $order = Order::model()->find("id=" . $id);

        $this->render('orderview', array(
            'order' => $order,
        ));
    }

    public function actionPrint($id) {

        $this->layout = '//layouts/blank';

        $mPDF1 = Yii::app()->ePdf->mpdf();

        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4', 0, '', 5, 5, 5, 5);



        /* if (isset($_GET['from']) && $_GET['from'] == 'view_invoice') {

          $printCount = TempOrders::model()->findByPk($id)->print_count;

          TempOrders::model()->updateByPk($id, array('print_count' => ((int) $printCount + 1)));

          if ($printCount > 1) {

          $mPDF1->SetWatermarkText('DUPLICATE');

          $mPDF1->showWatermarkText = true;

          $mPDF1->watermarkTextAlpha = 0.1;

          }

          } */



        if (isset($id) && $id != '') {

            $model = Order::model()->findByPk($id);

            $mPDF1->WriteHTML($this->render('print', array(
                        'order' => $model,
                            ), true));

            $fileName = "Order #" . $model->order_number . ".pdf";

            //$mPDF1->Output($fileName, 'D');

            $mPDF1->Output($fileName, 'I');

            /* $this->render('view', array(

              'model' => $this->loadModel($id),

              'print_button' => false,

              'admin_button' => false,

              'print' => true,

              )); */
        }
    }

}
