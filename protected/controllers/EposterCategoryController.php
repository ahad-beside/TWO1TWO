<?php
class EposterCategoryController extends Controller {
    
    public $layout = '//layouts/login';
    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index','view','all','more'),
                'users' => array('*'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $this->redirect(array('all'));
    }

    public function actionView($name) {
        $nameArray=  explode('.', $name);
        $name=$nameArray[0];
        //$data['categoryName'] = Category::model()->FindByPk($id)->name;
        $catInfo = EposterCategory::model()->find('slug=:slug',array(':slug'=>$name));
        if(count($catInfo)>0){
            $id = $catInfo->id;
            $data['categoryName'] = $catInfo->name;
        }else{
            $id = '';
            $data['categoryName'] = '';
        }
        
        $this->pageTitle = $catInfo->name . ' - '.Yii::app()->name;
        
        
        
        if($_GET['q']){
            $data['q'] = $_GET['q'];
        }else{
            $data['q'] = '';
        }
        
        
        $data['jobList'] = EposterList::model()->getProductList($data['q'],$id);//Get Products List
        
        if(Yii::app()->request->isAjaxRequest){
            $this->layout = '//layouts/plain';
            $this->renderPartial('productsListingGrid',array(
            'id'=>$id,
            'name'=>$name,
            'data'=>$data['products'],
            ));
            Yii::app()->end();
        }else{
            $this->render('eposterList',array(
            'id'=>$id,
            'data'=>$data,
            'name'=>$name,
        ));
        }
    }
	
    public function actionAll() {
        $this->pageTitle =  'All ePoster - '.Yii::app()->name;
        $data['categoryName'] = 'All ePoster';
        
        if($_GET['q']){
            $data['q'] = $_GET['q'];
        }else{
            $data['q'] = '';
        }
        if($_GET['category_id']){
            $data['category_id'] = $_GET['category_id'];
        }else{
            $data['category_id'] = 0;
        }
        
        $data['jobList'] = EposterList::model()->getAllProductList($data['q'],$data['category_id']);//Get Products List
        
            $this->render('eposterList',array(
            'id'=>$id,
            'data'=>$data,
        ));
    }

    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}
