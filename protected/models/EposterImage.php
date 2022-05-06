<?php
/**
 * This is the model class for table "eposter_image".
 *
 * The followings are the available columns in table 'eposter_image':
 * @property integer $id
 * @property integer $eposter_id
 * @property string $image
 * @property string $title
 * @property integer $sort_order
 *
 * The followings are the available model relations:
 * @property EposterList $eposter
 */
class EposterImage extends CActiveRecord
{
	public $templateType,$templateTitle,$templateDate,$templateImage;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'eposter_image';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('eposter_id, title,date_time,speaker_id,document_type,template_background_type', 'required'),
			array('document_type', 'application.extensions.YiiConditionalValidator.YiiConditionalValidator',
                'if' => array(
                    array('document_type', 'compare', 'compareValue'=>'Choose Template'),
                ),
                'then' => array(
                    array('template_type, templateDate, templateTitle', 'required'),
                ),
            ),
            // array('template_type', 'application.extensions.YiiConditionalValidator.YiiConditionalValidator',
            //     'if' => array(
            //         array('template_type', 'compare', 'compareValue'=>'2'),
            //     ),
            //     'then' => array(
            //         array('template1, template2', 'required'),
            //     ),
            // ),
			array('sort_order,template_type,templateType,template1_video,template2_video,template3_video,template4_video,template1,template2,template3,template4, template5_video,template6_video,template7_video,template8_video,template5,template6,template7,template8,templateTitle ,footer_text, image,templateDate,templateImage,template1_bgcolor,template2_bgcolor,template3_bgcolor,template4_bgcolor,sub_title,template1_title,template2_title,template3_title,template4_title,template5_title,template6_title,template7_title,template8_title,template_bg_image,template_box_font_color','safe'),
			array('eposter_id,speaker_id, sort_order', 'numerical', 'integerOnly'=>true),
			array('image, title', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, eposter_id, image,date_time, title, sort_order,template_type,templateType,document_type,template1_video,template2_video,template3_video,template4_video,template1,template2,template3,template4,templateTitle,footer_text,template1_bgcolor,template2_bgcolor,template3_bgcolor,template4_bgcolor,template_background_type', 'safe', 'on'=>'search'),
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
			'eposter' => array(self::BELONGS_TO, 'EposterList', 'eposter_id'),
			'speaker' => array(self::BELONGS_TO, 'User', 'speaker_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'eposter_id' => 'Event',
			'image' => 'Logo/Image',
			'templateImage' => 'Logo/Image',
			'title' => 'Title',
			'sub_title' => 'Sub Title',
			'templateTitle'=>'Title',
			'sort_order' => 'Sort Order',
			'date_time'=>'Date Time',
			'templateDate'=>'Date Time',
			'speaker_id'=>'Speaker',
			'template_type'=>'Select Template',
			'document_type'=>'Document Type',
			'footer_text'=>'Footer Text',

			'template1'=>'Box 1',
			'template2'=>'Box 2',
			'template3'=>'Box 3',
			'template4'=>'Box 4',
			'template5'=>'Box 5',
			'template6'=>'Box 6',
			'template7'=>'Box 7',
			'template8'=>'Box 8',

			'template1_title'=>'Box 1 Title',
			'template2_title'=>'Box 2 Title',
			'template3_title'=>'Box 3 Title',
			'template4_title'=>'Box 4 Title',
			'template5_title'=>'Box 5 Title',
			'template6_title'=>'Box 6 Title',
			'template7_title'=>'Box 7 Title',
			'template8_title'=>'Box 8 Title',

			'template1_video'=>'Box 1 Youtube Url',
			'template2_video'=>'Box 2 Youtube Url',
			'template3_video'=>'Box 3 Youtube Url',
			'template4_video'=>'Box 4 Youtube Url',
			'template5_video'=>'Box 5 Youtube Url',
			'template6_video'=>'Box 6 Youtube Url',
			'template7_video'=>'Box 7 Youtube Url',
			'template8_video'=>'Box 8 Youtube Url',

			'template1_bgcolor'=>'Template Background Color',
			'template2_bgcolor'=>'Title Font Color',
			'template3_bgcolor'=>'Box Header & Sub Title Font Color',
			'template4_bgcolor'=>'Box Background Color',

			'template_background_type'=>'Template Background Type',
			'template_bg_image'=>'Template Background Image',
			'template_box_font_color'=>'Template Box Font Color',
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
		$criteria->compare('speaker_id',$this->speaker_id);
		$criteria->compare('speaker_id',$this->speaker_id);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('template_type',$this->template_type,true);
		$criteria->compare('document_type',$this->document_type,true);
		$criteria->compare('date_time',$this->date_time,true);
		$criteria->compare('template1_video',$this->template1_video,true);
		$criteria->compare('template2_video',$this->template2_video,true);
		$criteria->compare('template3_video',$this->template3_video,true);
		$criteria->compare('template4_video',$this->template4_video,true);
		$criteria->compare('template1',$this->template1,true);
		$criteria->compare('template2',$this->template2,true);
		$criteria->compare('template3',$this->template3,true);
		$criteria->compare('template4',$this->template4,true);
		$criteria->compare('template1_bgcolor',$this->template1_bgcolor,true);
		$criteria->compare('template2_bgcolor',$this->template2_bgcolor,true);
		$criteria->compare('template3_bgcolor',$this->template3_bgcolor,true);
		$criteria->compare('template4_bgcolor',$this->template4_bgcolor,true);
		$criteria->compare('footer_text',$this->footer_text,true);
		$criteria->compare('sort_order',$this->sort_order);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	// public static function getDocument($image,$title){
	// 	return '<a target="_blank" href="'.Yii::app()->easycode->showOriginalImageLink($image,Yii::app()->params->ePosterDir).'"><button type="button" class="btn btn-success btn-xs">'.$title.'</button></a>';
	// }
	public static function getDocument($id){
		$eposterImage=EposterImage::model()->findByPk($id);
		if($eposterImage->document_type=='Choose Template'){
			return '<a target="_blank" href="'.Yii::app()->createUrl('//eposterList/details',array('id'=>$eposterImage->id)).'"><button type="button" class="btn btn-success btn-xs">View</button></a>';
		}else{
			return '<a target="_blank" href="'.Yii::app()->easycode->showOriginalImageLink($eposterImage->image,Yii::app()->params->ePosterDir).'"><button type="button" class="btn btn-success btn-xs">'.$eposterImage->title.'</button></a>';
		}
	}
	public static function getDocumentButtonVisible($id){
		$eposterImage=EposterImage::model()->findByPk($id);
		if($eposterImage->document_type=='Choose Template'){
			//return true;
			return Yii::app()->createUrl("//user/updateDocument/",array("id"=>$id));
		}else{
			//return false;
			return Yii::app()->createUrl("//user/eposterDocumentUpload/",array("id"=>$eposterImage->eposter_id,'document_type'=>'Upload Document'));
		}
	}
	public static function getDocumentButtonVisibleManager($id){
		$eposterImage=EposterImage::model()->findByPk($id);
		if($eposterImage->document_type=='Choose Template'){
			//return true;
			return Yii::app()->createUrl("//admin/eposterList/updateDocument/",array("id"=>$id));
		}else{
			//return false;
			return Yii::app()->createUrl("//admin/eposterList/eposterDocumentUpload/",array("id"=>$eposterImage->eposter_id,'document_type'=>'Upload Document'));
		}
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EposterImage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
