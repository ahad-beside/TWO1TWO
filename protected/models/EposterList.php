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
class EposterList extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'eposter_list';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, description, expire_date,slug,entry_by,user_id', 'required'),
			array('entry_date, status,image', 'safe'),
			array('status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id,name, description, expire_date, entry_date, status,slug,entry_by,image,user_id', 'safe', 'on'=>'search'),
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
			'eposterDoc' => array(self::HAS_MANY, 'EposterImage', 'eposter_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Title',
			'description' => 'Description',
			'expire_date' => 'Event Date',
			'entry_date' => 'Entry Date',
			'entry_by'=>'Entry By',
			'user_id'=>'User',
			'status' => 'Status',//0=Pending,1=Comfirmed,2=Cancled
			'image'=>'Image',
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
		$criteria->compare('name',$this->name);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('expire_date',$this->expire_date,true);
		$criteria->compare('entry_date',$this->entry_date,true);
		$criteria->compare('entry_by',$this->entry_by);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('image',$this->image,true);
		$criteria->order="expire_date asc";
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public static function makeLink($id){
        //return Yii::app()->createAbsoluteUrl('//product/' . $id, array('name' => self::model()->findByPk($id)->name));
        return Yii::app()->createAbsoluteUrl('//eposterList/' . self::model()->findByPk($id)->slug);
    }
    public static function getProductList($q='',$catId='') {
        $command = Yii::app()->db->createCommand();
        $command->select("j.id, j.name, j.description, j.expire_date, j.entry_date");

        $command->from('eposter_category jc');

        //$command->join('products_filter pf','pc.product_id=pf.product_id');
        //$command->join('products p','pf.product_id=p.id');
        $command->join('eposter_list j', 'jc.id=j.category_id');

        /* if (count($filter) > 0)
          $command->join('products_filter pf', 'p.id=pf.product_id'); */

        $command->where('jc.id=:catid', array(':catid' => intval($catId)));
        $command->andwhere('j.status=:status', array(':status' => 1));

        if (trim($q) != '') {
            $command->andwhere('j.name LIKE :q', array(':q' => '%' . CHtml::encode($q) . '%'));
        }
        return $command->queryAll();
        //return $command->getText();
    }

    public static function getAllProductList($q = '',$categoryId='') {
        $command = Yii::app()->db->createCommand();
        $command->select("j.id, j.name, j.description, j.expire_date, j.entry_date");

        $command->from('eposter_category jc');

        $command->join('eposter_list j', 'jc.id=j.category_id');
        $command->andwhere('j.status=:status', array(':status' => 1));
        
        if($categoryId !='')
        	$command->andwhere('jc.category_id=:jcid', array(':jcid' =>intval($categoryId)));

        if (trim($q) != '') {
            $command->andwhere('j.name LIKE :q', array(':q' => '%' . CHtml::encode($q) . '%'));
        }

        return $command->queryAll();
        //return $command->getText();
        //return $categoryId;
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
