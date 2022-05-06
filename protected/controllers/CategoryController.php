<?php
class CategoryController extends Controller {
    
    public $layout = '//layouts/product';
    

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
        $catInfo = Category::model()->find('slug=:slug',array(':slug'=>$name));
        if(count($catInfo)>0){
            $id = $catInfo->id;
            $data['categoryName'] = $catInfo->name;
        }else{
            $id = '';
            $data['categoryName'] = '';
        }
        
        $this->pageTitle = $catInfo->name . ' - '.Yii::app()->name;
        
        if ($_GET['filter']) {
            $data['getFilter'] = $_GET['filter'];
            $filter = $data['getFilter'];
            
            foreach($data['getFilter'] as $k=>$v):
                foreach($data['getFilter'][$k] as $val):
                    $data['allFilters'][]=$val;
                endforeach;
            endforeach;
        } else {
            $data['allFilters']=array();
            $data['getFilter'] = array();
            $filter = array();
        }
        
        if($_GET['product_sort_val']){
            $sortval = $_GET['product_sort_val'];
        }else{
            $sortval='';
        }
        
        if($_GET['q']){
            $data['q'] = $_GET['q'];
        }else{
            $data['q'] = '';
        }
        
        if($_GET['offset'])
            $offset = $_GET['offset'];
        else
            $offset = '0';
        
        $data['products'] = Products::model()->getProductList($id, $filter, $sortval, $data['q'],$offset);//Get Products List
        
        if(Yii::app()->request->isAjaxRequest){
            $this->layout = '//layouts/plain';
            $this->renderPartial('productsListingGrid',array(
            'id'=>$id,
            'name'=>$name,
            'data'=>$data['products'],
            ));
            Yii::app()->end();
        }else{
            $this->render('view',array(
            'id'=>$id,
            'data'=>$data,
            'name'=>$name,
        ));
        }
    }
	
	public function actionMore(){
		$this->layout = '//layouts/blank';
		if ($_GET['filter']) {
            $data['getFilter'] = $_GET['filter'];
            $filter = $data['getFilter'];
            
            foreach($data['getFilter'] as $k=>$v):
                foreach($data['getFilter'][$k] as $val):
                    $data['allFilters'][]=$val;
                endforeach;
            endforeach;
        } else {
            $data['allFilters']=array();
            $data['getFilter'] = array();
            $filter = array();
        }
        
        if($_GET['product_sort_val']){
            $sortval = $_GET['product_sort_val'];
        }else{
            $sortval='';
        }
        
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
        if($_GET['offset'])
            $offset = $_GET['offset'];
        else
            $offset = '0';
        
		if(isset($_GET['cat']))
			$data['products'] = Products::model()->getProductList((int)$_GET['cat'], $filter, $sortval, $data['q'],$offset, true,99999);//Get Products List
		else
        	$data['products'] = Products::model()->getAllProductList($filter, $sortval, $data['q'],$offset,$data['category_id'],true,99999);//Get Products List
        //echo $data['products'];exit();
        //$data['filter_filter'] = Products::model()->filterFilter(Products::model()->getAllProductList(array(),'','','0',$data['category_id'],true,99999)); //Get Filter Option
        //$data['category_filter'] = Products::model()->getCategoryFilter(); 
        //$data['exclusiveProductsSidebar'] = Products::model()->getExclusiveProducts($id,10);
		
		$this->layout = '//layouts/blank';
            $this->render('productsListingGridLoadMore',array(
            'id'=>$id,
            'data'=>$data['products'],
            ));
	}
    
    public function actionAll() {
        $this->pageTitle =  'All Products - '.Yii::app()->name;
        $data['categoryName'] = 'All Products';
        
        if ($_GET['filter']) {
            $data['getFilter'] = $_GET['filter'];
            $filter = $data['getFilter'];
            
            foreach($data['getFilter'] as $k=>$v):
                foreach($data['getFilter'][$k] as $val):
                    $data['allFilters'][]=$val;
                endforeach;
            endforeach;
        } else {
            $data['allFilters']=array();
            $data['getFilter'] = array();
            $filter = array();
        }
        
        if($_GET['product_sort_val']){
            $sortval = $_GET['product_sort_val'];
        }else{
            $sortval='';
        }
        
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
        if($_GET['offset'])
            $offset = $_GET['offset'];
        else
            $offset = '0';
        
        $data['products'] = Products::model()->getAllProductList($filter, $sortval, $data['q'],$offset,$data['category_id']);//Get Products List
        
        if(Yii::app()->request->isAjaxRequest){
            $this->layout = '//layouts/blank';
            $this->renderPartial('productsListingGrid',array(
            'id'=>$id,
            'data'=>$data['products'],
            ));
            Yii::app()->end();
        }else{
            
            $this->render('view',array(
            'id'=>$id,
            'data'=>$data,
        ));
        }
        
        
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
