<?php
//Yii::import('application.*');
// require 'vendor/autoload.php'; 
// use net\authorize\api\contract\v1 as AnetAPI;
// use net\authorize\api\controller as AnetController;
// define("AUTHORIZENET_LOG_FILE", "phplog");
class PaymentController extends Controller {

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
            	'actions' => array('manualSubmit'),
            	'roles' => array('Admin'),
            	),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
            	'actions' => array('index', 'paypalSubmit', 'paypalSuccess', 'canceled', 'paypalNotify', 'ocbc', 'ocbcReturn', 'ocbcNotify','mailView','paypal','payNow','creditCard','creditCardForm','creditSuccess','creditCancel'),
            	'users' => array('*'),
            	),
            array('deny', // deny all users
            	'users' => array('*'),
            	),
            );
	}

	public function actionMailView($id){
		$order = Order::model()->findByPk($id);
		$this->render('//mail/payment_success', array('order' => $order));
	}

	public function actionIndex(){
		$this->pageTitle = 'Payment - ' . Yii::app()->name;
		if (isset($_GET['id']) && (int) $_GET['id']) {
			$storeSettings = StoreSettings::model()->find();
			$order = Order::model()->findByPk((int)$_GET['id']);
			$this->render('index', array('settings' => $storeSettings,'order'=>$order));
		} else {
			throw new CHttpException(404, 'Invalid order information');
		}
	}

  public function actionPayNow(){
  	$this->pageTitle = 'Payment - ' . Yii::app()->name;
  	if (isset($_GET['id']) && (int) $_GET['id']){
  		$order = Order::model()->findByPk((int)$_GET['id']);
      if (isset($_GET['invoiceid']) && (int) $_GET['invoiceid']!=0){
        $invoice = OrderInvoice::model()->findByPk((int) $_GET['invoiceid']);
      }else{
      $curdate=date('Y-m-d');
      $invoice = OrderInvoice::model()->find("order_id=".(int)$_GET['id']." and invoice_date='$curdate'");
    }
      //print_r($invoice);exit;
  		$this->render('payNowForm', array('order'=>$order,'invoice'=>$invoice));
  	} else {
  		throw new CHttpException(404, 'Invalid order information');
  	}
  }

  public function actionPaypal() {
  	if (isset($_GET['source']) && $_GET['source'] != '') {
  		$source = base64_decode($_GET['source']);
  		$data = CJSON::decode($source);

  		$orderInfo = Order::model()->find(array('condition' => 'id=:id and order_number=:on and grand_total=:gt', 'params' => array(':id' => $data['id'], ':on' => $data['order_number'], ':gt' => $data['grand_total'])));
  		if (count($orderInfo) > 0) {


  			$this->render('paypalPaymentForm', array('orderInfo' => $orderInfo));
  		} else {
  			throw new CHttpException(404, 'Invalid order information');
  		}
  	} else {
  		throw new CHttpException(404, 'Invalid order information');
  	}
  }


  public function actionManualSubmit() {
  	if (Yii::app()->request->isAjaxRequest) {
  		if (Order::model()->checkEligibleForConfirmedOrder(Yii::app()->easycode->safeReadFrom($_POST['orderid']))) {
  			$model = new OrderPaymentHistory;
  			$model->gateway = PaymentMethods::model()->findByPk(Yii::app()->easycode->safeReadFrom($_POST['method']))->name;
  			$model->order_id_fk = Yii::app()->easycode->safeReadFrom($_POST['orderid']);
  			$model->amount = Yii::app()->easycode->safeReadFrom($_POST['amount']);
  			$model->status = 4;
  			$refNo = array('Reference Number' => Yii::app()->easycode->safeReadFrom($_POST['refno']));
  			$model->others = CJSON::encode($refNo);
  			if ($model->save()) {
  				if($_POST['orderStatus']=='Pending'){
  					Yii::app()->user->setFlash('success', "Success: Confirm and Payment successfully done");
  					echo 'Saved';
                    //update order status
  					Order::model()->updateByPk($model->order_id_fk, array('status' => 'Confirmed', 'payment_method' => Yii::app()->easycode->safeReadFrom($_POST['method']), 'payment_status' => 'Paid', 'confirmed_date' => date("Y-m-d H:i:s")));
                    //save current status
  					OrderProccessingHistory::model()->saveCurrentStatus($model->order_id_fk, 'Confirmed');

  					$onderNumber = Order::model()->findByPk($model->order_id_fk);
  					$subject = 'Order Confirmed: ' . $onderNumber->order_number;
  					Order::model()->mailSent($model->order_id_fk, $subject);
  				}else{
                        //update order status
  					Order::model()->updateByPk($model->order_id_fk, array('payment_method' => Yii::app()->easycode->safeReadFrom($_POST['method']), 'payment_status' => 'Paid'));
  					OrderProccessingHistory::model()->saveCurrentStatus($model->order_id_fk, $_POST['orderStatus']);
  					Yii::app()->user->setFlash('success', "Success: Payment successfully done");
  					echo 'Saved'; 
  				}
  			} else {
                    //Yii::app()->user->setFlash('warning', "Warning: Payment not saved");
  				echo 'Not Saved';
  			}
  		} else {
  			echo 'Not Eligible';
  		}
  	}
  }

  public function actionPaypalSubmit(){
  	$storeSettings = SiteSettings::model()->find();
  	if (trim($storeSettings->paypal_id) == '')
  		throw new CHttpException(404, 'No Paypal Settings Found');
  	define('PAYPAL_HOST', ($storeSettings->paypal_mode == 'Sandbox') ? 'www.sandbox.paypal.com' : 'www.paypal.com');
  	define('PAYPAL_URL', ($storeSettings->paypal_mode == 'Sandbox') ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr');
        define('PAYPAL_EMAIL', $storeSettings->paypal_id); // dev email of merchant
        define('PAYPAL_SANDBOX', ($storeSettings->paypal_mode == 'Sandbox') ? true : false);
        $source = base64_decode($_GET['source']);
        $data = CJSON::decode($source);
        $id = Yii::app()->easycode->safeReadFrom($data['id']);
        $invoiceid = Yii::app()->easycode->safeReadFrom($data['invoiceid']);
        if ((int) $id > 0) {
        	$order = Order::model()->findByPk($id);
          $invoice = OrderInvoice::model()->findByPk($invoiceid);
        	$this->render('makeForm', array('model' => $order,'invoice'=>$invoice));
        }
    }

    public function actionCanceled() {
    	$this->pageTitle = 'Payment Canceled - ' . Yii::app()->name;
    	$this->render('canceled');
    }

    public function actionPaypalSuccess() {
    	$this->pageTitle = 'Payment Success - ' . Yii::app()->name;
    	$this->render('paypalSuccess', array('data' => $_REQUEST));
    }
    
    public function actionPaypalCancel() {
    	$this->pageTitle = 'Payment Success - ' . Yii::app()->name;
    	$this->render('paypalCancel', array('data' => $_REQUEST));
    }

    public function actionCardSuccess() {
    	$this->render('cardSuccess');
    }

    public function actionPaypalNotify() {
    	$paypal = new PayPal();
    	$paypal->notify();
    }
    public function actionCreditSuccess() {
      $this->render('creditSuccess');
    }
    public function actionCreditCancel() {
      $this->render('creditCancel');
    }
}
?>
