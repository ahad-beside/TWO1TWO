<?php

/**
 * This is the model class for table "order_products".
 *
 * The followings are the available columns in table 'order_products':
 * @property integer $id
 * @property integer $order_id_fk
 * @property integer $products_id_fk
 * @property string $options
 * @property string $price
 * @property integer $qty
 */
class OrderProducts extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'order_products';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('order_id_fk, products_id_fk, options, price, qty, total,subscribtion_month', 'required'),
            array('order_id_fk, products_id_fk, qty', 'numerical', 'integerOnly' => true),
            array('options', 'length', 'max' => 300),
            array('price', 'length', 'max' => 11),
            array('special_instruction','safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, order_id_fk, products_id_fk, options, price, qty,subscribtion_month', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'products' => array(self::BELONGS_TO, 'Products', 'products_id_fk'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'order_id_fk' => 'Order Id Fk',
            'products_id_fk' => 'Products Id Fk',
            'options' => 'Options',
            'price' => 'Price',
            'qty' => 'Qty',
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
        $criteria->compare('order_id_fk', $this->order_id_fk);
        $criteria->compare('products_id_fk', $this->products_id_fk);
        $criteria->compare('options', $this->options, true);
        $criteria->compare('price', $this->price, true);
        $criteria->compare('qty', $this->qty);
        $criteria->compare('subscribtion_month', $this->subscribtion_month);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return OrderProducts the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function saveData($model, $v) {
        $items = new OrderProducts;
        $items->order_id_fk = $model->id;
        $items->products_id_fk = $v['id'];
        $items->qty = $v['qty'];
        $items->price = $v['productPrice'];
        $items->total = ($v['productPrice'] * $v['qty']);
        $items->options = $v['productOption'];
        $items->item_from = $v['item_from'];
        $items->subscribtion_month = $v['subscriptionMonth'];
        $items->save();
    }

}
