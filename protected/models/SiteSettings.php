<?php
/**
 * This is the model class for table "site_settings".
 *
 * The followings are the available columns in table 'site_settings':
 * @property integer $id
 * @property string $name
 * @property string $logo
 * @property string $email
 * @property string $address
 * @property string $phone
 * @property integer $entry_by
 * @property string $entry_time
 * @property integer $update_by
 * @property string $update_time
 */
class SiteSettings extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'site_settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, logo,site_logo,login_banner, email, address, phone, entry_by, update_by,paypal_id,paypal_mode', 'required'),
			array('entry_by, update_by', 'numerical', 'integerOnly'=>true),
			array('name, logo, email, phone,login_banner', 'length', 'max'=>500),
			array('address', 'length', 'max'=>400),
			array('entry_time, update_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, logo,site_logo, email, address, phone, entry_by, entry_time, update_by, update_time,login_banner', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'logo' => 'Admin Logo',
			'site_logo' => 'Forntend Logo',
			'login_banner'=>'Admin Login Page Banner',
			'email' => 'Email',
			'address' => 'Address',
			'phone' => 'Phone',
			'entry_by' => 'Entry By',
			'entry_time' => 'Entry Time',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('site_logo',$this->site_logo,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('entry_by',$this->entry_by);
		$criteria->compare('entry_time',$this->entry_time,true);
		$criteria->compare('update_by',$this->update_by);
		$criteria->compare('update_time',$this->update_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SiteSettings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
