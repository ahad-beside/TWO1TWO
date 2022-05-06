<?php
class PayPal {
    public function notify(){
        $logCat = 'paypal';
        $listener = new IpnListener();
        $listener->use_sandbox = PAYPAL_SANDBOX;
        try {
            $listener->requirePostMethod();
            
            if ($listener->processIpn() && $_POST['payment_status']==='Completed') {
                $order = Order::model()->findByPk($_POST['custom']); // we set custom as our order id on sending the request to paypal
                if ($order === null) {
                    Yii::log('Cannot find order with id ' . $custom, CLogger::LEVEL_ERROR, $logCat);
                    Yii::app()->end(); // note that die; will not execute Yii::log() so we have to use Yii::app()->end();
                }
                $orderhistory = new OrderPaymentHistory;
                $orderhistory->setAttributes(array(
                    'gateway'=> 'PayPal',
                    'order_id_fk'=> Yii::app()->easycode->safeReadFrom($_POST['custom']),
                    'amount'=> Yii::app()->easycode->safeReadFrom($_POST['payment_gross']),
                    'status'=> OrderPaymentHistory::STATUS_PAID, // statusId field in model Order
                    'transaction_id'=> Yii::app()->easycode->safeReadFrom($_POST['txn_id']),
                    'others'=> CJSON::encode($_POST),
                ));
                $orderhistory->save();
                //Product::deductQty($order); // deduct quantity for this product
                //Product::sendSuccessEmails($order); // send success emails to merchant and buyer
                Order::model()->paypalPaymentMail($_POST['custom'], 'Order# ' . $_POST['item_name'] . ' Payment Confirmation', 'paypal_payment_success');
            }else{
                Yii::log('invalid ipn', CLogger::LEVEL_ERROR, $logCat);
            }
        } catch (Exception $e) {
            Yii::log($e->getMessage(), CLogger::LEVEL_ERROR, $logCat);
        }
    }
 
}
?>