<?php

/**
 * This is the model class for table "job_category".
 *
 * The followings are the available columns in table 'job_category':
 * @property integer $id
 * @property string $name
 * @property integer $sort_order
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property JobList[] $jobLists
 */
class JobCategory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'job_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, sort_order,slug', 'required'),
			array('sort_order, status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, sort_order, status,slug', 'safe', 'on'=>'search'),
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
			'jobLists' => array(self::HAS_MANY, 'JobList', 'category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'sort_order' => 'Sort Order',
			'status' => 'Status',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('sort_order',$this->sort_order);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public static function makeLink($id){
        $info = self::model()->findByPk($id);
        if(count($info)>0){
            //return Yii::app()->createUrl('//category/'.$id,array('name'=>$info->name));
            //return Yii::app()->createAbsoluteUrl('//category/'.$info->slug);
            return Yii::app()->createAbsoluteUrl('//jobCategory/'.$info->slug);
        }else{
            return '#';
        }
    }
    public static function makeLinkNew($id){
        $info = self::model()->findByPk($id);
        if(count($info)>0){
            //return Yii::app()->createUrl('//category/'.$id,array('name'=>$info->name));
            //return Yii::app()->createAbsoluteUrl('//category/'.$info->slug);
            return Yii::app()->createUrl('//jobCategory/view/'.$info->slug);
        }else{
            return '#';
        }
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return JobCategory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
