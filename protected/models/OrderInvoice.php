<?php
/**
 * This is the model class for table "order_invoice".
 *
 * The followings are the available columns in table 'order_invoice':
 * @property integer $id
 * @property integer $order_id
 * @property string $invoice_number
 * @property string $invoice_date
 * @property string $invoice_amount
 * @property string $due_date
 * @property string $status
 * @property string $payment_status
 * @property string $payment_method
 * @property string $payment_date
 * @property string $note
 */
class OrderInvoice extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order_invoice';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_id, invoice_number, invoice_date, invoice_amount, due_date,product_info,users_id_fk', 'required'),
			array('payment_date, note, payment_method', 'safe'),
			array('order_id', 'numerical', 'integerOnly'=>true),
			array('invoice_number, status, payment_status, payment_method', 'length', 'max'=>255),
			array('invoice_amount', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, order_id, invoice_number, invoice_date, invoice_amount, due_date, status, payment_status, payment_method, payment_date, note,product_info,users_id_fk', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'order_id' => 'Order',
			'users_id_fk'=>'User',
			'invoice_number' => 'Invoice Number',
			'invoice_date' => 'Invoice Date',
			'invoice_amount' => 'Invoice Amount',
			'due_date' => 'Due Date',
			'status' => 'Status',
			'payment_status' => 'Payment Status',
			'payment_method' => 'Payment Method',
			'payment_date' => 'Payment Date',
			'note' => 'Note',
			'product_info'=>'Product Info',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('users_id_fk',$this->users_id_fk);
		$criteria->compare('invoice_number',$this->invoice_number,true);
		$criteria->compare('invoice_date',$this->invoice_date,true);
		$criteria->compare('invoice_amount',$this->invoice_amount,true);
		$criteria->compare('due_date',$this->due_date,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('payment_status',$this->payment_status,true);
		$criteria->compare('payment_method',$this->payment_method,true);
		$criteria->compare('payment_date',$this->payment_date,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('product_info',$this->product_info,true);
		$criteria->order=("invoice_date asc");
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function searchUserInvoice()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('users_id_fk',Yii::app()->user->userId);
		$criteria->compare('invoice_number',$this->invoice_number,true);
		$criteria->compare('invoice_date',$this->invoice_date,true);
		$criteria->compare('invoice_amount',$this->invoice_amount,true);
		$criteria->compare('due_date',$this->due_date,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('payment_status',$this->payment_status,true);
		$criteria->compare('payment_method',$this->payment_method,true);
		$criteria->compare('payment_date',$this->payment_date,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('product_info',$this->product_info,true);
		$criteria->order=("invoice_date asc");
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public static function genOrderNumber($prefix,$orderId){
        $count = self::model()->count('order_id =:order_id', array(':order_id' =>$orderId));
        return $prefix . date('ym') . ($count + 1);
    }
    public function paymentStatusHtml($data) {
        $button = '';
        if ($data->payment_status != '') {
            if ($data->payment_status == 'Paid')
                $button = '<span class="btn-success btn-sm"> <i class="fa fa-check-circle"></i> &nbsp;' . $data->payment_status . '</span>';
            else {
                //$button .= '<span class="btn-warning btn-sm">' . $data->payment_status . '</span> ';
                //$button .= '<a target="_blank" href="' . Yii::app()->createUrl('//payment/ocbc/', array('source' => base64_encode(CJSON::encode(array('id' => $data->id, 'order_number' => $data->order_number, 'grand_total' => $data->grand_total))))) . '" class="btn-info btn-sm">Pay</a>';
                $button .= '<a style="color:#fff" target="_blank" href="' . Yii::app()->createUrl('//payment/payNow/', array('order' => 'success','id' => $data->order_id,'invoiceid'=>$data->id)) . '" class="btn-primary btn-sm"><i class="fa fa-money"></i> &nbsp;Pay Now</a>';
                
                  
            }
        }
        return $button;
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OrderInvoice the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
