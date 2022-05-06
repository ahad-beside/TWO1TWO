<?php

/**
 * This is the model class for table "review".
 *
 * The followings are the available columns in table 'review':
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $details
 * @property string $status
 * @property string $entry_date
 */
class Review extends CActiveRecord
{
	public $reviewStatus = array(
        'Pending'=>'Pending',
        'Confirmed'=>'Confirmed',      
    );
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'review';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('details, entry_date,rating_point,user_id,review_type,product_id', 'required'),
			array('status', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id,rating_point, details, status, entry_date', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'product' => array(self::BELONGS_TO, 'Products', 'product_id'),
			'service' => array(self::BELONGS_TO, 'Service', 'product_id'),
		);
	}
	public static function getStatusWiseCount($status){
            return self::model()->count(array(
                'condition'=>'status=:st',
                'params'=>[':st'=>$status]
            ));
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'details' => 'Message',
			'status' => 'Status',
			'entry_date' => 'Review Date',
			'rating_point'=>'Rating',
			'user_id'=>'User',
			'product_id'=>'Product/Service',
		);
	}
	public static function getStar($star){
		return '<img src="'.Yii::app()->request->baseUrl.'/upload/star'.$star.'.png">';
	}
	public static function getProductService($proId,$proType){
		if($proType=='Product'){
			$url = Products::model()->makeLink($proId);
			return '<a target="_blank" href="'.$url.'">'.Products::model()->findByPk($proId)->name.'</a>';
		}else{
			$url = Service::model()->makeLink($proId);
			return '<a target="_blank" href="'.$url.'">'.Service::model()->findByPk($proId)->name.'</a>';
		}
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('review_type',$this->review_type);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('details',$this->details,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('entry_date',$this->entry_date,true);
		$criteria->order="entry_date desc";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pagesize'=>150,
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Review the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
