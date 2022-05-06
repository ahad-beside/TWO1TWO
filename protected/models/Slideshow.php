<?php

/**
 * This is the model class for table "slideshow".
 *
 * The followings are the available columns in table 'slideshow':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $update_by
 * @property string $update_time
 */
class Slideshow extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'slideshow';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('image,position', 'required','on'=>'insert'),
            array('status, sort_order', 'numerical', 'integerOnly' => true),
            array('link', 'length', 'max' => 1055),
			  array('image', 'length', 'max' => 255),
            array('link, status, sort_order,title,button_label', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, sort_order,position, link,title,button_label', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
		'slideshowitems' => array(self::HAS_MANY, 'SlideshowItems', 'slideshow_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'link' => 'Link',
            'sort_order' => 'Sort Order',
            'status'=>'Status',
			'image' => 'Image',
            'position'=>'Position',
            'title' => 'Title',
            'button_label'=>'Button Label',
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
        $criteria->compare('link', $this->link, true);
        $criteria->compare('sort_order', $this->sort_order, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('position', $this->position, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('button_label', $this->button_label, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
}
