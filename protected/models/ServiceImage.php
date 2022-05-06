<?php

/**
 * This is the model class for table "products_image".
 *
 * The followings are the available columns in table 'products_image':
 * @property integer $id
 * @property integer $product_id
 * @property string $image
 * @property integer $sort_order
 *
 * The followings are the available model relations:
 * @property Products $product
 */
class ServiceImage extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'service_image';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('product_id, image', 'required'),
            array('product_id, sort_order', 'numerical', 'integerOnly' => true),
            array('image', 'file', 'allowEmpty'=>true, 'types'=>'jpg,jpeg,png','mimeTypes'=>'image/gif, image/jpeg, image/png'),
            array('image', 'length', 'max' => 255),
            array('isArtwork','safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, product_id, image, sort_order', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'service' => array(self::BELONGS_TO, 'Service', 'product_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'product_id' => 'Service',
            'image' => 'Image',
            'sort_order' => 'Sort Order',
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
        $criteria->compare('product_id', $this->product_id);
        $criteria->compare('image', $this->image, true);
        $criteria->compare('sort_order', $this->sort_order);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ProductsImage the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    

}
