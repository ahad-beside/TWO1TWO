<?php
/**
 * This is the model class for table "order".
 *
 * The followings are the available columns in table 'order':
 * @property integer $id
 * @property string $order_number
 * @property integer $user_id_fk
 * @property string $total
 * @property string $delivery_charge
 * @property string $discount
 * @property string $grand_total
 * @property string $delivery_info
 * @property string $order_date
 * @property string $update_time
 * @property integer $update_by
 */
class Order extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public $order_from_date, $order_to_date, $name;

    public function tableName() {
        return 'order';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('order_number, grand_total, billing_info, delivery_info, update_by, payment_method, shipping_method, currency', 'required'),
            array('total', 'required', 'message' => 'Minimum one product need to make order.'),
            array('user_id_fk, update_by, payment_method, bank_id', 'numerical', 'integerOnly' => true),
            array('order_number', 'length', 'max' => 20),
            array('total, delivery_charge, discount, grand_total', 'length', 'max' => 11),
            array('delivery_info,billing_info', 'length', 'max' => 400),
            array('user_id_fk,delivery_charge, discount,order_date, update_time, status, vat, tax,order_from_date,order_to_date,identity_text, name,payment_status,made_by,order_note,confirmed_date,production_date,received_date,shipped_date,canceled_date,bank_id', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, order_number, user_id_fk, total, delivery_charge, discount, grand_total, delivery_info, order_date, update_time, update_by,confirmed_date,production_date,received_date,shipped_date,canceled_date,made_by', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'userIdFk' => array(self::BELONGS_TO, 'User', 'user_id_fk'),
            'flagId' => array(self::BELONGS_TO, 'FlagSettings', 'flag_id'),
            'bank' => array(self::BELONGS_TO, 'Bank', 'bank_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'order_number' => 'Order Number',
            'user_id_fk' => 'User Id Fk',
            'total' => 'Total',
            'delivery_charge' => 'Delivery Charge',
            'discount' => 'Discount',
            'grand_total' => 'Grand Total',
            'billing_info' => 'Billing Address',
            'delivery_info' => 'Shipping Address',
            'vat' => 'VAT',
            'tax' => 'TAX',
            'order_date' => 'Order Date',
            'update_time' => 'Update Time',
            'update_by' => 'Update By',
            'status' => 'Status',
            'order_to_date' => 'To',
            'order_from_date' => 'From',
            'first_name' => 'Customer',
            'payment_status' => 'Payment',
            'identity_text' => 'Product',
            'confirmed_date' => 'Confirm Date',
            'production_date' => 'Production Date',
            'received_date' => 'Receive Date',
            'shipped_date' => 'Shipped Date',
            'canceled_date' => 'Cancel Date',
            'bank_id' => 'Bank',
            'currency' => 'Currency',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
	 
	 public function dashboardorders() {
        $criteria = new CDbCriteria;
        $criteria->with = array('userIdFk');
        $criteria->compare('order_number', $this->order_number, true);
        $criteria->compare('user_id_fk', Yii::app()->user->userId);
        $criteria->compare('total', $this->total, true);
        $criteria->compare('grand_total', $this->grand_total, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('payment_status', $this->payment_status, true);
		$criteria->limit=10;

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => false,
            'sort' => array(
                'defaultOrder' => 'order_date DESC',
            ),
        ));
    }
    public function myorders() {
        $criteria = new CDbCriteria;
        $criteria->with = array('userIdFk');
        $criteria->compare('order_number', $this->order_number, true);
        $criteria->compare('user_id_fk', Yii::app()->user->userId);
        $criteria->compare('total', $this->total, true);
        $criteria->compare('grand_total', $this->grand_total, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('payment_status', $this->payment_status, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => PAGINATION_ITEM,
            ),
            'sort' => array(
                'defaultOrder' => 'order_date DESC',
            ),
        ));
    }

    public function search($status = '', $mixedCond = array(),$paymentStatus = '') {
        // @todo Please modify the following code to remove attributes that should not be searched.
        $criteria = new CDbCriteria;
        $criteria->with = array('userIdFk');
        $criteria->compare('id', $this->id);
        $criteria->compare('order_number', $this->order_number, true);
        if ($paymentStatus == '')
        $criteria->compare('payment_status', $this->payment_status, true);
        else
            $criteria->compare('payment_status', $paymentStatus);
        if ($userId == '')
            $criteria->compare('userIdFk.email', $this->user_id_fk, true);
        else
            $criteria->compare('user_id_fk', $userId);

        if ($this->name != '')
            $criteria->compare('CONCAT(userIdFk.first_name , userIdFk.last_name)', $this->name, true);
        $criteria->compare('total', $this->total, true);
        $criteria->compare('delivery_charge', $this->delivery_charge, true);
        $criteria->compare('grand_total', $this->grand_total, true);
        $criteria->compare('delivery_info', $this->delivery_info, true);
        $criteria->compare('update_time', $this->update_time, true);
        $criteria->compare('update_by', $this->update_by);
        $criteria->compare('made_by', $this->made_by);
        $criteria->compare('identity_text', $this->identity_text, true);
        if ($this->confirmed_date != '')
            $criteria->compare('confirmed_date', date("Y-m-d", strtotime($this->confirmed_date)), true);
        if ($this->shipped_date != '')
            $criteria->compare('shipped_date', date("Y-m-d", strtotime($this->shipped_date)), true);
        if ($this->canceled_date != '')
            $criteria->compare('canceled_date', date("Y-m-d", strtotime($this->canceled_date)), true);

        if (count($mixedCond) > 0) {
            foreach ($mixedCond as $k => $v):
                $criteria->compare("$k", $v, true);
            endforeach;
        }

        $criteria->compare('currency', $this->currency);

        if ($status == ''){
            $arrayStatus=array("Confirmed", "Shipped");
            $criteria->addInCondition('status',$arrayStatus);
            $criteria->compare('status', $this->status,true);
        }
        else{
            $criteria->compare('status', $status);
        }
        if ($status == 'Confirmed')
            $criteria->order = 'confirmed_date DESC';
        else if ($status == 'Shipped')
            $criteria->order = 'shipped_date DESC';
        else if ($status == 'Canceled')
            $criteria->order = 'canceled_date DESC';
        if ($this->order_to_date != '' && $this->order_from_date != '') {
            $criteria->addBetweenCondition('order_date', date("Y-m-d", strtotime($this->order_from_date)) . ' 00:00:00', date("Y-m-d", strtotime($this->order_to_date)) . ' 23:59:59', 'AND');
        } else {
            if ($this->order_date != '')
                $criteria->compare('order_date', date("Y-m-d", strtotime($this->order_date)), true);
        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 100,
            ),
            'sort' => array(
                'defaultOrder' => 'order_date DESC',
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Order the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function genOrderNumber($prefix) {
        $count = self::model()->count('order_date LIKE :thisMonth', array(':thisMonth' => date('Y-m') . '%'));
        return $prefix . date('ym') . ($count + 1);
    }

    public static function calDeliveryCharge($total) {
        return 5;
    }

    public static function getAllStatusArray() {
        return array(
            '1' => 'Pending',
            '2' => 'Processing',
            '3' => 'Canceled',
            '4' => 'Denied',
            '5' => 'Failed',
            '6' => 'Refunded',
            '7' => 'Shipped',
            '8' => 'Complete',
        );
    }

    public static function calVat($total) {
        $vat = 0;
        // $vatSettings = StoreSettings::model()->find();
        // if ($vatSettings->vat) {
        //     $vat = ($vatSettings->vat / 100) * $total;
        // }
        return number_format($vat, Yii::app()->params->decimalPoint);
    }

    public static function calTax($total) {
        $tax = 0;
        // $taxSettings = StoreSettings::model()->find();
        // if ($taxSettings->tax) {
        //     $tax = ($taxSettings->tax / 100) * $total;
        // }
        return number_format($tax, Yii::app()->params->decimalPoint);
    }

    public static function getBarCode($orderNumber, $width = 100, $fontsize = 13, $height = 60, $containerstyle = 'float:right;clear:both') {
        return "<table style='" . $containerstyle . "'><tr><td><img width='" . $width . "' height='" . $height . "' src='" . Yii::app()->params->SERVER_HOST . "barcodegenerator/generatebarcode?code=" . $orderNumber . "'/></td></tr><tr><td style='text-align:center; font-size:16px;font-weight:bold; color:#000;'>" . $orderNumber . "</td></tr></table>";
    }

    public static function mailSent($id, $subject, $isArtworkLink = false) {
        $orderInfo = self::model()->findByPk($id);
        $userInfo = User::model()->findByPk($orderInfo->user_id_fk);
        if ($userInfo->email != '') {

            $storeMailSettings = StoreMailSettings::model()->find('store_id=:storeid', array(':storeid' => STORE_ID));
            $storeSettings = StoreSettings::model()->findByPk(STORE_ID);

            $mail = new YiiMailer('orderview', array('order' => $orderInfo));
            $mail->setLayout('mail');
            $mail->setFrom($storeMailSettings->mailer_mail, $storeMailSettings->mailer_name);
            $mail->setSubject($subject . ' - ' . $storeSettings->store_name);
            $mail->setTo($userInfo->email);
            $mail->setBcc($storeMailSettings->mailer_mail);
            $mail->send();
        }
    }

    public static function paymentMail($id, $subject, $view) {
        $orderInfo = self::model()->findByPk($id);
        $userInfo = User::model()->findByPk($orderInfo->user_id_fk);
        if ($userInfo->email != '') {
            $storeMailSettings = StoreMailSettings::model()->find('store_id=:storeid', array(':storeid' => STORE_ID));
            $storeSettings = StoreSettings::model()->findByPk(STORE_ID);

            $mail = new YiiMailer($view, array('order' => $orderInfo, 'user' => $userInfo));
            $mail->setLayout('mail');
            $mail->setFrom($storeMailSettings->mailer_mail, $storeMailSettings->mailer_name);
            $mail->setSubject($subject . ' - ' . $storeSettings->store_name);
            $mail->setTo($userInfo->email);
            $mail->send();

            $mail = new YiiMailer('payment_success_admin', array('order' => $orderInfo, 'user' => $userInfo));
            $mail->setLayout('mail');
            $mail->setFrom($storeMailSettings->mailer_mail, $storeMailSettings->mailer_name);
            $mail->setSubject($subject . ' - ' . $storeSettings->store_name);
            $mail->setTo($userInfo->email);
            $mail->setBcc('rrakhmit@gmail.com');
            $mail->send();
        }
    }
    
    public static function paypalPaymentMail($id, $subject, $view) {
        $orderInfo = self::model()->findByPk($id);
        $userInfo = User::model()->findByPk($orderInfo->user_id_fk);
        if ($userInfo->email != '') {
            $storeMailSettings = StoreMailSettings::model()->find('store_id=:storeid', array(':storeid' => STORE_ID));
            $storeSettings = StoreSettings::model()->findByPk(STORE_ID);

            $mail = new YiiMailer($view, array('order' => $orderInfo, 'user' => $userInfo));
            $mail->setLayout('mail');
            $mail->setFrom($storeMailSettings->mailer_mail, $storeMailSettings->mailer_name);
            $mail->setSubject($subject . ' - ' . $storeSettings->store_name);
            $mail->setTo($userInfo->email);
            $mail->send();
        }
    }
    public static function creditPaymentMail($id, $subject, $view) {
        $orderInfo = self::model()->findByPk($id);
        $userInfo = User::model()->findByPk($orderInfo->user_id_fk);
        if ($userInfo->email != '') {
            $storeMailSettings = StoreMailSettings::model()->find('store_id=:storeid', array(':storeid' => STORE_ID));
            $storeSettings = StoreSettings::model()->findByPk(STORE_ID);

            $mail = new YiiMailer($view, array('order' => $orderInfo, 'user' => $userInfo));
            $mail->setLayout('mail');
            $mail->setFrom($storeMailSettings->mailer_mail, $storeMailSettings->mailer_name);
            $mail->setSubject($subject . ' - ' . $storeSettings->store_name);
            $mail->setTo($userInfo->email);
            //$mail->setTo('anup@coder71.com');
            $mail->send();
        }
    }

    public function showIdendityText($text) {
        if ($text != '') {
            $t = explode(',', $text);
            $keyword = '';
            foreach ($t as $v):
                $keyword .= '<span class="checknotify">' . $v . '</span> ';
            endforeach;
            return $keyword;
        }
    }

//    public function checkEligibleForConfirmedOrder($id) {
//        if (Order::model()->exists('id=:id and (status="Pending" or status="Canceled")', array(':id' => $id)))
//            return true;
//        else
//            return false;
//    }

    public function checkEligibleForConfirmedOrder($id) {
        if (Order::model()->exists('id=:id', array(':id' => $id)))
            return true;
        else
            return false;
    }
    public function checkEligibleForArtworkConfirmedOrder($id) {
        if (Order::model()->exists('id=:id and (status="Confirmed" or status="Pending" or status="Production")', array(':id' => $id)))
            return true;
        else
            return false;
    }

    public function checkEligibleForProductionOrder($id) {
        if (Order::model()->exists('id=:id and (status="ArtworkConfirmed" or status="Confirmed")', array(':id' => $id)))
            return true;
        else
            return false;
    }

    public function checkEligibleForReceivedOrder($id) {
        if (Order::model()->exists('id=:id and (status="Production")', array(':id' => $id)))
            return true;
        else
            return false;
    }

    public function checkEligibleForShippedOrder($id) {
        if (Order::model()->exists('id=:id and (status="Confirmed")', array(':id' => $id)))
            return true;
        else
            return false;
    }

    public function checkEligibleForDeliveredOrder($id) {
        if (Order::model()->exists('id=:id and (status="Shipped")', array(':id' => $id)))
            return true;
        else
            return false;
    }

    public function checkEligibleForCanceledOrder($id) {
        if (Order::model()->exists('id=:id and (status!="Delivered")', array(':id' => $id)))
            return true;
        else
            return false;
    }

    public function setPaymentStatus($id) {
        $orderInfo = Order::model()->findByPk($id);

        $paymentHistory = OrderPaymentHistory::model()->findAllBySql('select sum(amount) as amount from order_payment_history where order_id_fk="' . $orderInfo->id . '" and status="Paid"');
        if ($paymentHistory[0]->amount >= $orderInfo->grand_total) {
            Yii::app()->db->createCommand()->update('order', array('payment_status' => 'Paid'), 'id=:id', array(':id' => $id));
        } else {
            Yii::app()->db->createCommand()->update('order', array('payment_status' => 'Paid'), 'id=:id', array(':id' => $id));
        }
    }

    public function getTotalCollection($currency = 'sgd',$from='',$to='',$status=array('Production','Received','Shipped')) {
        $dateCon='';
        if($from!='' && $to!=''){
            $from = $from.' 00:00:00';
            $to = $to. ' 23:59:59';
            $dateCon = ' and Confirmed_date BETWEEN "'.$from.'" and "'.$to.'"';
        }
        
//        $statusCond='';
//        if(count($status)>0){
//            $statusCond='(';
//            foreach($status as $sta):
//                $statusCond .= 'status="'.$sta.'" or ';
//            endforeach;
//            $statusCond = rtrim($statusCond,' or ').') ';
//        }
        $statusCond='payment_status="Paid" and status!="Pending" and status!="Canceled"';
        $totalCollectionP = Order::model()->findBySql('select sum(grand_total) as grand_total from `order` where '.$statusCond.' and currency="' . $currency . '"'.$dateCon);
        $payment['paid']=$totalCollectionP->grand_total;
        
        $statusCondD='payment_status="Due" and status!="Pending" and status!="Canceled"';
        $totalCollectionD = Order::model()->findBySql('select sum(grand_total) as grand_total from `order` where '.$statusCondD.' and currency="' . $currency . '"'.$dateCon);
        $payment['due']=$totalCollectionD->grand_total;
        return $payment;
        //return 'select sum(grand_total) as grand_total from `order` where '.$statusCond.' and currency="' . $currency . '"'.$dateCon;
    }
    
    
    
    public function getTotalCollectionAdminv2($currency = 'sgd',$from='',$to='',$status=array('Production','Received','Shipped')) {
        $dateCon='';
        if($from!='' && $to!=''){
            $from = $from.' 00:00:00';
            $to = $to. ' 23:59:59';
            $dateCon = ' and Confirmed_date BETWEEN "'.$from.'" and "'.$to.'"';
        }
        
//        $statusCond='';
//        if(count($status)>0){
//            $statusCond='(';
//            foreach($status as $sta):
//                $statusCond .= 'status="'.$sta.'" or ';
//            endforeach;
//            $statusCond = rtrim($statusCond,' or ').') ';
//        }
        $statusCond='status!="Pending" and status!="Canceled"';
        $totalCollectionP = Order::model()->findBySql('select sum(grand_total) as grand_total from `order` where '.$statusCond.' and currency="' . $currency . '"'.$dateCon);
        $payment['paid']=$totalCollectionP->grand_total;
        
        $statusCondD='payment_status="Due" and status!="Pending" and status!="Canceled"';
        $totalCollectionD = Order::model()->findBySql('select sum(grand_total) as grand_total from `order` where '.$statusCondD.' and currency="' . $currency . '"'.$dateCon);
        $payment['due']=$totalCollectionD->grand_total;
        return $payment;
        //return 'select sum(grand_total) as grand_total from `order` where '.$statusCond.' and currency="' . $currency . '"'.$dateCon;
    }
    
    
    public function showCurrency($type,$data){
        if($type=='html'){
            return "<span class='btn btn-xs ". (($data=='usd')?'btn-primary':'btn-info') ."'>".strtoupper($data)."</span>";
        }else{
            return $data;
        }
    }

    public function paymentStatusHtml($data) {
        $button = '';
        if ($data->payment_status != '') {
            if ($data->payment_status == 'Paid')
                $button = '<span class="btn-success btn-sm"> <i class="fa fa-check-circle"></i> &nbsp;' . $data->payment_status . '</span>';
            else {
                //$button .= '<span class="btn-warning btn-sm">' . $data->payment_status . '</span> ';
                //$button .= '<a target="_blank" href="' . Yii::app()->createUrl('//payment/ocbc/', array('source' => base64_encode(CJSON::encode(array('id' => $data->id, 'order_number' => $data->order_number, 'grand_total' => $data->grand_total))))) . '" class="btn-info btn-sm">Pay</a>';
                $button .= '<a style="color:#fff" target="_blank" href="' . Yii::app()->createUrl('//payment/payNow/', array('order' => 'success','id' => $data->id)) . '" class="btn-primary btn-sm"><i class="fa fa-money"></i> &nbsp;Pay Now</a>';
                
                  
            }
        }
        return $button;
    }

    public function paymentStatus($id) {
        $orderInfo = Order::model()->findByPk($id);
        if ($orderInfo->payment_method == 0) {
            $data = 0;
        } else {
            $paymentHistory = OrderPaymentHistory::model()->findAllBySql('select sum(amount) as amount from order_payment_history where order_id_fk="' . $orderInfo->id . '" and status="Paid"');
            if ($paymentHistory[0]->amount >= $orderInfo->grand_total)
                $data = 1;
        }
        if ($data == 1) {
            return '<span class="btn-primary btn-sm">PAID</span>';
        } else {
            return '<span class="btn-warning btn-sm">DUE</span>';
        }
    }

    public function orderStatForCustomer($custId) {
        $totalOrder = Yii::app()->db->createCommand()
                ->select(
                        '(select count(`id`) from `order` where `user_id_fk`="' . $custId . '") as `totalOrder`,
                        (select count(`id`) from `order` where `user_id_fk`="' . $custId . '" and status!="Pending" and status!="Complete") as `totalProcessing`,
                        (select count(`id`) from `order` where `user_id_fk`="' . $custId . '" and status="Complete") as `totalComplete`,
                        (select count(`id`) from `order` where `user_id_fk`="' . $custId . '" and status="Canceled") as `totalCanceled`'
                )
                ->from('order')
                ->where('user_id_fk=:id', array(':id' => $custId))
                ->queryRow();

        return $totalOrder;
    }

    public function productAsOption($id) {
        $options = '';

        $custom = OrderCustomProduct::model()->with('productTypeId')->findAll('order_id=:id', array(':id' => $id));
        if (count($custom) > 0) {
            foreach ($custom as $cp):
                $options .= '<option value="' . $cp->id . '">' . $cp->productTypeId->name . ' / ' . $cp->productSizeId->name . '</option>';
            endforeach;
        }

//        $regular = OrderProducts::model()->with('products')->findAll('order_id_fk=:id',array(':id'=>$id));
//        if(count($regular)>0){
//            foreach($regular as $cp):
//                $options .= '<option value="'.$cp->id.'_Regular">'.$cp->products->name.'</option>';
//            endforeach;
//        }

        return $options;
    }

    public function enableCol($status, $arrayStatus) {
        if (in_array($status, $arrayStatus)) {
            return 1;
        } else {
            return 0;
        }
    }
    public function enableColStatus($status, $arrayStatus) {
        if (in_array($status, $arrayStatus)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function getBackToListUrl($status) {
        switch ($status):
            case "Pending":
                return Yii::app()->createUrl('//admin/order');
                break;
            case "Confirmed":
                return Yii::app()->createUrl('//admin/order/confirmedList');
                break;
            case "Production":
                return Yii::app()->createUrl('//admin/order/productionList');
                break;
            case "Received":
                return Yii::app()->createUrl('//admin/order/receiveList');
                break;
            case "Shipped":
                return Yii::app()->createUrl('//admin/order/shippedList');
                break;
            case "Canceled":
                return Yii::app()->createUrl('//admin/order/canceledList');
                break;
            default:
                return Yii::app()->createUrl('//admin/order');
        endswitch;
    }

    public function getOrderData($orderNumber) {
        $data['order'] = self::model()->find(array(
            'condition' => 'order_number=:orderNumber',
            'params' => array(
                ':orderNumber' => $orderNumber,
            )
        ));

        if (count($data['order']) > 0):

            $data['customOrderProducts'] = OrderCustomProduct::model()->findAll(array(
                'condition' => 'order_id=:oid',
                'params' => array(
                    ':oid' => $data['order']->id
                )
            ));

            $data['orderHistory'] = OrderProccessingHistory::model()->findAll(array(
                'condition' => 'order_id_fk=:oid',
                'params' => array(
                    ':oid' => $data['order']->id
                ),
                'order' => 'update_time desc',
            ));
        else:
            $data['invalidOrder'] = 'Order# '.$orderNumber.' is not exists. <br>Please re-check your order number';
        endif;
        return $data;
    }

}
