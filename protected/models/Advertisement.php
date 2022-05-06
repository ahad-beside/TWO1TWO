<?php

/**
 * This is the model class for table "advertisement".
 *
 * The followings are the available columns in table 'advertisement':
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property string $link
 * @property integer $sort_order
 * @property string $update_time
 * @property integer $update_by
 */
class Advertisement extends CActiveRecord {
    
    public $availablePositions = array(
        '212 Poster'=>'212 Poster',
    );
    
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'advertisement';
    }
    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('type, sort_order, position, update_time, update_by', 'required'),
            array('sort_order, update_by', 'numerical', 'integerOnly' => true),
            array('name, image', 'length', 'max' => 100),
            array('link', 'length', 'max' => 255),
            array('name,image, link, script', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, image, link, sort_order, update_time, update_by', 'safe', 'on' => 'search'),
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
            'position' => 'Position',
            'image' => 'Image',
            'link' => 'Link',
            'sort_order' => 'Sort Order',
            'update_time' => 'Update Time',
            'update_by' => 'Update By',
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
        $criteria->compare('image', $this->image, true);
        $criteria->compare('link', $this->link, true);
        $criteria->compare('sort_order', $this->sort_order);
        $criteria->compare('update_time', $this->update_time, true);
        $criteria->compare('update_by', $this->update_by);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
 public static function getProductImage($image){
        return Yii::app()->easycode->returnOriginalImage($image,'/advertisement/');
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Advertisement the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public function getAdvertisement($pos,$limit=1000,$orderby='rand()'){
        $data = self::model()->findAll(array(
            'condition'=>'position=:pos',
            'params'=>array(':pos'=>$pos),
            'order'=>$orderby,
            'limit'=>$limit
        ));

        if(count($data)>0){
            $all='';
            foreach($data as $ads):
                if($ads->type=='Image')
                    $all .= CHtml::link(CHtml::image(Yii::app()->easycode->showOriginalImageReturn($ads->image),$ads->name,array('class'=>'img-responsive adsImg')), ($ads->link!='')?$ads->link:'#', array('class'=>'adsLink'));
                else
                    $all .= '<div class="adsScript">'.$ads->script.'</div>';
            endforeach;
            if($all!='')
                return $all;
        }
    }

}
