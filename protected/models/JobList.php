<?php
/**
 * This is the model class for table "job_list".
 *
 * The followings are the available columns in table 'job_list':
 * @property integer $id
 * @property integer $category_id
 * @property integer $title
 * @property string $description
 * @property string $expire_date
 * @property string $entry_date
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property JobAppliedList[] $jobAppliedLists
 * @property JobCategory $category
 */
class JobList extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'job_list';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category_id, name, description, expire_date,slug', 'required'),
			array('entry_date, status', 'safe'),
			array('category_id, status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, category_id, name, description, expire_date, entry_date, status,slug', 'safe', 'on'=>'search'),
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
			'jobAppliedLists' => array(self::HAS_MANY, 'JobAppliedList', 'job_id'),
			'category' => array(self::BELONGS_TO, 'JobCategory', 'category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category_id' => 'Category',
			'name' => 'Title',
			'description' => 'Description',
			'expire_date' => 'Expire Date',
			'entry_date' => 'Entry Date',
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
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('name',$this->name);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('expire_date',$this->expire_date,true);
		$criteria->compare('entry_date',$this->entry_date,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public static function makeLink($id){
        return Yii::app()->createAbsoluteUrl('//jobList/' . self::model()->findByPk($id)->slug);
    }
    public static function getProductList($q='',$catId='') {
        $command = Yii::app()->db->createCommand();
        $command->select("j.id, j.name, j.description, j.expire_date, j.entry_date");

        $command->from('job_category jc');
        $command->join('job_list j', 'jc.id=j.category_id');

        $command->where('jc.id=:catid', array(':catid' => intval($catId)));
        $command->andwhere('j.status=:status', array(':status' => 1));
        $command->andwhere('j.expire_date>=CURDATE()');

        if (trim($q) != '') {
            $command->andwhere('j.name LIKE :q', array(':q' => '%' . CHtml::encode($q) . '%'));
        }

        return $command->queryAll();
        //return $command->getText();
    }

    public static function getAllProductList($q = '', $categoryId='') {
        $command = Yii::app()->db->createCommand();
        $command->select("j.id, j.name, j.description, j.expire_date, j.entry_date");

        $command->from('job_category jc');

        $command->join('job_list j', 'jc.id=j.category_id');
        $command->andwhere('j.status=:status', array(':status' => 1));
        
        if($categoryId !='')
        	$command->andwhere('jc.category_id=:jcid', array(':jcid' =>intval($categoryId)));
        $command->andwhere('j.expire_date>=CURDATE()');

        if (trim($q) != '') {
            $command->andwhere('j.name LIKE :q', array(':q' => '%' . CHtml::encode($q) . '%'));
        }

        return $command->queryAll();
    }
    public static function getProductParent() {
            $allcat = JobCategory::model()->findAll('status=:status order by sort_order', array(':status' => 1));
            return $allcat;
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return JobList the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
