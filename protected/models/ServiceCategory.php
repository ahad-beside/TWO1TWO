<?php
/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property integer $id
 * @property integer $name
 * @property string $description
 * @property string $metatag_title
 * @property string $metatag_description
 * @property string $metatag_keywords
 * @property integer $parent
 * @property string $image
 * @property integer $top
 * @property integer $sort_order
 * @property integer $status
 * @property integer $update_by
 * @property string $update_time
 */
class ServiceCategory extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'service_category';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, update_by, update_time, slug', 'required'),
            array('slug', 'unique', 'on' => 'insert', 'message' => '{attribute}:{value} already exists!'),
            array('parent,  sort_order, status, update_by', 'numerical', 'integerOnly' => true),
            array('metatag_title,category_banner, metatag_description, metatag_keywords, image', 'length', 'max' => 255),
            array('description,category_banner, metatag_title, metatag_description, metatag_keywords, image', 'safe'),
            array('image', 'file', 'allowEmpty'=>true, 'types'=>'jpg,jpeg,png'),
            //array('image', 'file', 'allowEmpty'=>true, 'types'=>'jpg,jpeg,png','mimeTypes'=>'image/jpg, image/jpeg, image/png'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, description, metatag_title, metatag_description, metatag_keywords, parent, image, category_banner, sort_order, status, update_by, update_time', 'safe', 'on' => 'search'),
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
            'description' => 'Description',
            'metatag_title' => 'Metatag Title',
            'metatag_description' => 'Metatag Description',
            'metatag_keywords' => 'Metatag Keywords',
            'parent' => 'Parent',
            'image' => 'Image',
            'category_banner' => 'Banner Image',
            'sort_order' => 'Sort Order',
            'status' => 'Status',
            'update_by' => 'Update By',
            'update_time' => 'Update Time',
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
        $criteria->compare('name', $this->name);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('metatag_title', $this->metatag_title, true);
        $criteria->compare('metatag_description', $this->metatag_description, true);
        $criteria->compare('metatag_keywords', $this->metatag_keywords, true);
        $criteria->compare('parent', $this->parent);
        $criteria->compare('image', $this->image, true);
        $criteria->compare('category_banner', $this->category_banner, true);
        $criteria->compare('sort_order', $this->sort_order);
        $criteria->compare('status', $this->status);
        $criteria->compare('update_by', $this->update_by);
        $criteria->compare('update_time', $this->update_time, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Category the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /* Multi Category Dropdown */
    public static function dropDown($withoutParent=true) {
        $data = array();
        $parent = self::model()->findAll('parent is NULL');
        foreach ($parent as $p) {
            if($withoutParent)
                $data[$p->id] = $p->name;
            $childItems = self::model()->getChildItems($p->id, $p->name);
            $data = self::model()->array_merge_custom($data, $childItems);
        }
        return $data;
    }

    public static function getChildItems($id, $name) {
        $data = array();
        $child = self::model()->findAll('parent=:parentid', array(':parentid' => $id));
        foreach ($child as $c) {
            $data[$c->id] = $name . ' > ' . $c->name;
            $childItems = self::model()->getChildItems($c->id, $name . ' > ' . $c->name);
            $data = self::model()->array_merge_custom($data, $childItems);
        }
        return $data;
    }
    
    function array_merge_custom($first, $second) {
        $result = array();
        foreach ($first as $key => $value) {
            $result[$key] = $value;
        }
        foreach ($second as $key => $value) {
            $result[$key] = $value;
        }

        return $result;
    }
    /* End Multi Category Dropdown */

    public static function getCategoryName($id = '', $name = '') {
        $get = self::model()->findByPk($id);
        if($name=='')
            $name = $get->name;
        if ((int) $get->parent > 0) {
            $parent = self::model()->findByPk($get->parent);
            $name = self::model()->getCategoryName($get->parent, $parent->name) . ' > ' . $name;
        }
        return $name;
    }
    
    public static function findAllMainCategory($parrent='NULL') {
        $get = self::model()->findAll();
        return $get;
    }
    
    public static function getCategoryNameForExpand($name) {
        $get = self::model()->find("slug='$name'");
        if($get->parent==Null){
            $name = $get->name;
        }
        else{
           $name=self::model()->find("id=$get->parent")->name;
        }
        return $name;
    }
    
    public static function makeLink($id){
        $info = self::model()->findByPk($id);
        if(count($info)>0){
            //return Yii::app()->createUrl('//category/'.$id,array('name'=>$info->name));
            //return Yii::app()->createAbsoluteUrl('//category/'.$info->slug);
            return Yii::app()->createAbsoluteUrl('//serviceCategory/'.$info->slug);
        }else{
            return '#';
        }
    }
    public static function makeLinkNew($id){
        $info = self::model()->findByPk($id);
        if(count($info)>0){
            //return Yii::app()->createUrl('//category/'.$id,array('name'=>$info->name));
            //return Yii::app()->createAbsoluteUrl('//category/'.$info->slug);
            return Yii::app()->createUrl('//serviceCategory/view/'.$info->slug);
        }else{
            return '#';
        }
    }
}
