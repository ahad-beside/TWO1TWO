<?php
class OrderInvoiceController extends Controller {

        public $layout = '//layouts/login';
    
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            
            array('allow',
                'actions' => array('invoicePdf','artworkApproved','artworkReject','artworkview','orderArtworkview','showArtwork','showArtworkIn'),
                'users' => array('*'),
            ),
            
            array('allow',
                'actions' => array('index','confirmedList','shippedList','canceledList','view'),
                'users' => array('@'),
            ),
            
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    public function actionIndex(){
        /* By defatult index page show pending order list */
        $model = new OrderInvoice('dashboardorders');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['OrderInvoice']))
            $model->attributes = $_GET['OrderInvoice'];
        $this->pageTitle=$_GET['OrderInvoice']['payment_status'].' Invoice List';
        $this->render('index', array(
            'model' => $model,
            'data' => $data,
        ));
    }

    public function actionView($id){
        $this->pageTitle = 'Invoice View';
        if (isset(Yii::app()->user->roles) && Yii::app()->user->roles == 'Customer')
            $this->layout = '//layouts/login';
        if (Yii::app()->user->isGuest):
            $order = array();
        else:
            $invoice = OrderInvoice::model()->find("id='" .$id. "' and users_id_fk=" . Yii::app()->user->userId);
            $order = Order::model()->find("id='" . $invoice->order_id . "' and user_id_fk=" . Yii::app()->user->userId);
        endif;
        if (count($order) < 1)
            throw new CHttpException(404, 'You are not permitted to do this');

        $this->render('orderview', array(
            'order' => $order,
            'invoice'=>$invoice,
        ));
    }
    
    public function actionInvoicePdf($id) {
        $this->pageTitle = 'Order View - ' . Yii::app()->name;
            $this->layout = '//layouts/flash';
        
            $order = Order::model()->find("id='" . $id . "' and user_id_fk=" . Yii::app()->user->userId);

        if (count($order) < 1)
            throw new CHttpException(404, 'You are not permitted to do this');
        
        $mPDF1 = Yii::app()->ePdf->mpdf();
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4', 0, '', 5, 5, 5, 5);
        
        $mPDF1->WriteHTML($this->renderPartial('invoicepdf', array('order' => $order), true));
        $fileName = $order->order_number . ".pdf";
        $path = 'invoices/'.$fileName;
        $mPDF1->Output($path, 'F');
        
        $storeMailSettings = StoreMailSettings::model()->find('store_id=:storeid', array(':storeid' => STORE_ID));
        $storeSettings = StoreSettings::model()->findByPk(STORE_ID);
        
        $text = <<<TEXT
                <strong>Dear Customer,</strong><br>
                Please find the attached invoice of order# $order->order_number <br><br>
                Thanks,<br>
                USCraft.
TEXT;
        $subject = 'Invoice of Order# '.$order->order_number.' | '.Yii::app()->params->usdCurrency.$order->grand_total;
        $mail = new YiiMailer('withHtml', array('text' =>$text));
        $mail->setLayout('mail');
        $mail->setFrom($storeMailSettings->mailer_mail, $storeMailSettings->mailer_name);
        $mail->setSubject($subject . ' - ' . $storeSettings->store_name);
        $mail->setAttachment($path);
        $mail->setTo($userInfo->email);
        $mail->setBcc($storeMailSettings->mailer_mail);
        $mail->send();
        

//        $this->render('invoicepdf', array(
//            'order' => $order,
//        ));
    }

    public function actionArtworkApproved() {
        if (Yii::app()->request->isAjaxRequest) {

            $status = 'Approved';

            $source = CJSON::decode(base64_decode($_POST['source']));
            if (OrderArtwork::model()->exists('id=:id and artwork=:artwork and order_id_fk=:order_id_fk', array(':id' => $source['id'], ':artwork' => $source['artwork'], ':order_id_fk' => $source['order_id_fk']))) {
                OrderArtwork::model()->updateByPk($source['id'], array('status' => $status, 'replied_note' => $_POST['note'], 'final_date' => date("Y-m-d H:i:s")));
                echo 1;
                Yii::app()->user->setFlash('success', "Success: Artwork approved successfully");
                $data['orderInfo'] = Order::model()->findByPk($source['order_id_fk']);
                $data['status'] = $status;
                OrderArtwork::model()->mailSentAR($data);
            } else {
                echo 0;
                Yii::app()->user->setFlash('error', "Error: Artwork approval failed");
            }
        }
        Yii::app()->end();
    }

    public function actionArtworkReject() {
        if (Yii::app()->request->isAjaxRequest) {

            $status = 'Reject';

            $source = CJSON::decode(base64_decode($_POST['source']));
            if (OrderArtwork::model()->exists('id=:id and artwork=:artwork and order_id_fk=:order_id_fk', array(':id' => $source['id'], ':artwork' => $source['artwork'], ':order_id_fk' => $source['order_id_fk']))) {
                OrderArtwork::model()->updateByPk($source['id'], array('status' => $status, 'replied_note' => $_POST['note'], 'final_date' => date("Y-m-d H:i:s")));
                echo 1;
                Yii::app()->user->setFlash('success', "Success: Artwork rejected successfully");
                $data['orderInfo'] = Order::model()->findByPk($source['order_id_fk']);
                $data['status'] = $status;
                OrderArtwork::model()->mailSentAR($data);
            } else {
                echo 0;
                Yii::app()->user->setFlash('success', "Error: Artwork rejection failed");
            }
        }

        Yii::app()->end();
    }

    public function actionArtworkview() {
        $this->pageTitle = 'Artwork View - ' . Yii::app()->name;
        //print_r($_GET);
        $source = CJSON::decode(base64_decode($_GET['source']));

//        $llink = array();
//        $link [] = array('id'=>1,'artwork'=>'AJL-010109 CTG EXPRESS.pdf');
//        $link [] = array('id'=>2,'artwork'=>'KYM-010314 DHAKA COMICS.pdf');
//        $source = CJSON::decode(base64_decode(base64_encode(CJSON::encode($link))));


        if ($_GET['fileid'] != '')
            $fileid = base64_decode($_GET['fileid']);
        else
            $fileid = $source[0]['id'];

        if (count($source) > 0){
            $chkTrue = array();
            $ids = array();
            foreach ($source as $data):
                if (OrderArtwork::model()->exists('id=:id and artwork=:art', array(':id' => $data['id'], ':art' => $data['artwork']))) {
                    $chkTrue[] = 'true';
                    $ids[] = $data['id'];
                } else {
                    $chkTrue[] = 'false';
                }
            endforeach;


            if (in_array('false', $chkTrue)) {
                throw new CHttpException(505, 'You are trying to inject something. We track your IP address');
            } else if (!in_array($fileid, $ids)) {
                throw new CHttpException(505, 'Missmatch');
            } else {
                $this->layout = '//layouts/main';
                $orderId = OrderArtwork::model()->find('id=:id', array(':id' => $fileid))->order_id_fk;

                $data['orderInfo'] = Order::model()->findByPk($orderId);
                $data['artworks'] = $source;
                $data['fileinfo'] = OrderArtwork::model()->findByPk($fileid);

                $this->render('artworkView', array('data' => $data));
            }
        }
    }
    public function actionOrderArtworkview() {
        $this->pageTitle = 'Artwork View - ' . Yii::app()->name;
        //echo $_GET['source'];exit();
        $source = CJSON::decode(base64_decode($_GET['source']));
        
        if ($_GET['fileid'] != '')
            $fileid = base64_decode($_GET['fileid']);
        else
            $fileid = $source[0]['id'];

        if (count($source) > 0){
            $chkTrue = array();
            $ids = array();
            foreach ($source as $data):
                //echo $data['artwork'];exit();
                if (OrderArtwork::model()->exists('id=:id and artwork=:art', array(':id' => $data['id'], ':art' => $data['artwork']))) {
                    //echo'erwe';exit();
                    $chkTrue[] = 'true';
                    $ids[] = $data['id'];
                } else {
                    $chkTrue[] = 'false';
                }
            endforeach;


            if (in_array('false', $chkTrue)) {
                throw new CHttpException(505, 'You are trying to inject something. We track your IP address');
            } else if (!in_array($fileid, $ids)) {
                throw new CHttpException(505, 'Missmatch');
            } else {
                $this->layout = '//layouts/blank';
                //$orderId = OrderArtwork::model()->find('id=:id', array(':id' => $fileid))->order_id_fk;

                //$data['orderInfo'] = Order::model()->findByPk($orderId);
                //$data['artworks'] = $source;
                //$data['fileinfo'] = OrderArtwork::model()->findByPk($fileid);
                $data=  OrderArtwork::model()->getOrderArtworkView($_GET['source']);
                $this->render('orderArtworkView', array('data' => $data));
           }
        }
    }

    public function actionShowArtwork($id) {
        $this->pageTitle = 'Order View - ' . Yii::app()->name;
        if (Yii::app()->user->roles == 'Customer')
            $this->layout = '//layouts/user';
        if (Yii::app()->user->isGuest):
            $order = Order::model()->find("id=:id and update_by=:id", array(':id' => $id));
        else:
            $order = Order::model()->find("id=" . $id);
        endif;
        if (count($order) < 1)
            throw new CHttpException(404, 'You are not permitted to do this');

        $this->render('showArtwork', array(
            'order' => $order,
        ));
    }

    public function actionShowArtworkIn($id) {
        $this->layout = '//layouts/blank';
        $orderid = OrderCustomProduct::model()->find("id=" . $id)->order_id;
        if (Yii::app()->user->roles != 'Admin'){
        $this->pageTitle = 'Order View - ' . Yii::app()->name;
        if (Yii::app()->user->roles == 'Customer')
            $this->layout = '//layouts/user';
        if (Yii::app()->user->isGuest):
            $order = array();
        else:
            $order = Order::model()->find("id='" . $orderid . "' and user_id_fk=" . Yii::app()->user->userId);
        endif;
        if (count($order) < 1)
            throw new CHttpException(404, 'You are not permitted to do this');
        }
        $this->renderPartial('showArtwork', array(
            'id' => $id,
            'orderid'=>$orderid,
        ));
    }

}