<?php
/**
 * This is the model class for table "shipping_settings".
 *
 * The followings are the available columns in table 'shipping_settings':
 * @property integer $id
 * @property string $name
 * @property string $oparetor
 * @property string $price
 */
class ShippingSettings extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'shipping_settings';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, oparetor, price', 'required'),
            array('name', 'length', 'max' => 50),
            array('oparetor', 'length', 'max' => 1),
            array('price', 'length', 'max' => 11),
            array('sort_order, status','safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, oparetor, price', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'oparetor' => 'Oparetor',
            'price' => 'Price (per k.g.)',
            'sort_order' => 'Sort',
            'status'=>'Status',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('oparetor', $this->oparetor, true);
        $criteria->compare('price', $this->price, true);
        $criteria->compare('status', $this->status, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ShippingSettings the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public static function gramToKilogram($gram){
        if($gram>0)
            return $gram / 1000;
        else
            return 0;
    }
    
    public function callShippingPrice($id,$cart){
        $shipping = ShippingSettings::model()->findByPk($id);
        
        if($shipping->oparetor=='+'){
            return number_format($shipping->price,Yii::app()->params->decimalPoint);
        }else{
            $_pweight=0;
            if(count($cart)>0){
            foreach ($cart as $k => $v):
                if ($v['productType'] == 'Regular'){
                    $_pweight += ($v['qty'] * $v['weight']);
                }
            endforeach;
            }
            
            $kg = self::model ()->gramToKilogram($_pweight);
            $shippingPrice = $kg * $shipping->price;
        }
        
        return number_format($shippingPrice,Yii::app()->params->decimalPoint);
    }


    public static function calShippingPrice($shipping, $cart){
        if($shipping->oparetor=='+'){
            return Yii::app()->currency->getSymbol().' '.number_format($shipping->price,Yii::app()->params->decimalPoint);
        }else{
            $_pweight=0;
            if(count($cart)>0){
            foreach ($cart as $k => $v):
                if ($v['productType'] == 'Regular'){
                    $_pweight += ($v['qty'] * $v['weight']);
                }
            endforeach;
            }
            
            $kg = self::model ()->gramToKilogram($_pweight);
            $shippingPrice = $kg * $shipping->price;
        }
        
        return Yii::app()->currency->getSymbol().' '.number_format($shippingPrice,Yii::app()->params->decimalPoint);
    }

}
