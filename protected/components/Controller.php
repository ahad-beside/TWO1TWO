<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
        public $metaDesc='';
        public $metaTag='';
        public $metaTitle='';
        
        public $fbShareTitle='';
        public $fbShareDesc='';
        public $fbShareImg='';
        public $siteName='';
        public $siteLogo='';
        public $adminLogo='';
        public $adminLoginBanner='';
        public $adminLoginBannerName='';
        public $adminMail='';
        
        public function init(){
        $settings = SiteSettings::model()->find();
        $this->siteName=$settings->name;
        $this->siteLogo=Yii::app()->request->baseUrl.'/upload'.Yii::app()->params->logoDir.$settings->site_logo;
        $this->adminLogo=Yii::app()->request->baseUrl.'/upload'.Yii::app()->params->logoDir.$settings->logo;
        $this->adminLoginBanner=Yii::app()->request->baseUrl.'/upload'.Yii::app()->params->logoDir.$settings->login_banner;
        $this->adminLoginBannerName=$settings->login_banner;
        $this->adminMail=$settings->email;
        }
}