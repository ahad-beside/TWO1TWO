<?php

/**
 * This is the model class for table "delivery_info".
 *
 * The followings are the available columns in table 'delivery_info':
 * @property integer $id
 * @property integer $user_id_fk
 * @property string $name
 * @property string $street_address
 * @property string $landmark
 * @property integer $city
 * @property integer $country
 * @property string $pincode
 * @property string $phone
 * @property string $update_time
 * @property integer $update_by
 */
class BillingInfo extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'billing_info';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id_fk, name, street_address,state, city, pincode, phone, update_by, country', 'required'),
            array('user_id_fk, country, update_by', 'numerical', 'integerOnly' => true),
            array('name, landmark', 'length', 'max' => 100),
            array('street_address', 'length', 'max' => 300),
            array('pincode', 'length', 'max' => 20),
            array('phone, city', 'length', 'max' => 50),
            array('update_time, landmark', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id_fk, name, street_address, landmark, city, country, pincode, phone, update_time, update_by,state', 'safe', 'on' => 'search'),
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
            'countryIdFk' => array(self::BELONGS_TO, 'Country', 'country'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id_fk' => 'User Id Fk',
            'name' => 'Name',
            'street_address' => 'Street Address',
            'landmark' => 'Landmark',
            'city' => 'City',
            'country' => 'Country',
            'pincode' => 'Post Code',
            'phone' => 'Phone',
            'update_time' => 'Update Time',
            'update_by' => 'Update By',
            'state' => 'State',
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
    public function individualsearch($userId='') {
        if($userId=='')
            $userId = Yii::app()->user->userId;
        $criteria = new CDbCriteria;
        $criteria->compare('user_id_fk', $userId);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('user_id_fk', $this->user_id_fk);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('street_address', $this->street_address, true);
        $criteria->compare('landmark', $this->landmark, true);
        $criteria->compare('city', $this->city);
        $criteria->compare('country', $this->country);
        $criteria->compare('pincode', $this->pincode, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('update_time', $this->update_time, true);
        $criteria->compare('update_by', $this->update_by);
        $criteria->compare('state', $this->state);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return DeliveryInfo the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
