<?php
class ProductsController extends Controller {

    public $layout = '//layouts/product';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'view', 'umayalsolike','viewTest'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('rating','addToWishList','delFromWishList'),
                'users' => array('@'),
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
    
    public function actionUmayalsolike(){
        //$productId = Yii::app()->easycode->safeReadFrom($_GET['id']);
        $data = Products::model()->getUMayAlsoLike();
        if(count($data)>0){
            $this->renderPartial('umayalsolike',array('data'=>$data));
        }
    }

    public function actionRating($name) {
        $this->pageTitle =  'Product Rating - '.Yii::app()->name;
        //$this->layout = '//layouts/blank';
        $model = new ProductsRatingReview;
        //$productInfo = Products::model()->findByPk($id);
        $productInfo = Products::model()->find('slug=:slug',array(':slug'=>$name));

        if (isset($_POST['ProductsRatingReview'])) {
            $model->attributes = $_POST['ProductsRatingReview'];
            $model->product_id = $productInfo->id;
            $model->user_id = Yii::app()->user->userId;
            if ($model->save()) {
                Yii::app()->user->setFlash('success', "Thanks for your review and rating.");
                $this->redirect(array('//product/' . $name));
            }
        }

        $this->render('rating', array(
            'model' => $model,
            'productInfo' => $productInfo,
        ));
    }

    public function actionIndex(){
        $this->redirect(array('//category/all'));
    }

    public function actionView($name){
        $model = Products::model()->find('slug=:slug',array(':slug'=>$name));
        $modelReview=new Review;
        $data['actual_link'] = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $this->pageTitle =  $model->name.' - '.Yii::app()->name;
        
        $id = $model->id;
        $data['productOption']=ProductOption::model()->findAll("product_id=".$id);
        $data['allReview'] = Review::model()->findAll(array(
          'select'=>'*',
          'condition'=>'status=:status and product_id=:product_id',
          'params'=>array(':status'=>'Confirmed',':product_id'=>$id),
          'order'=>'entry_date desc',
          )
        );
          $data['totalRating'] = Review::model()->find(array(
          'select'=>'SUM(rating_point) as rating_point',
          'condition'=>'status=:status and product_id=:product_id',
          'params'=>array(':status'=>'Confirmed',':product_id'=>$id)
          )
        );

        $data['images'] = ProductsImage::model()->findAll('product_id=:id', array(':id' => (int) $id));
        $data['download'] = ProductsDownload::model()->findAll('product_id=:id', array(':id' => (int) $id));
        $data['categoryId']=ProductsCategory::model()->findAll("product_id=".(int) $id);
        $i=0;
        $data['makeOr']='';
        foreach($data['categoryId'] as $rowCategoryId):
            $i++;
            if($i<count($data['categoryId']))
                $placeOr=' or ';
            else
                $placeOr='';
            $data['makeOr'].="pc.category_id=".$rowCategoryId->category_id." ".$placeOr;
        endforeach;
        $data['relatedProduct']=Products::model()->getRelatedProducts($data['makeOr'],(int) $id);
        $this->render('productDetails', array(
            'model' => $model,
            'modelReview' => $modelReview,
            'data' => $data,
        ));
    }
	

    public function loadModel($id) {
        $model = Products::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
    
    public function actionDelFromWishList($id){
        $productId = $id;
        if(ProductsWishlist::model()->deleteAll('product_id=:pid and user_id=:uid',array(':pid'=>$id,':uid'=>Yii::app()->user->userId))){
            Yii::app()->user->setFlash('success', "Product successfully deleted from your wish list");
        }else{
            Yii::app()->user->setFlash('error', "You are not authorized to delete this");
        }
        $this->redirect(Products::model()->makeLink($id));
    }

    public function actionAddToWishList($id) {
        //$productId = mysql_real_escape_string($_POST['id']);
        $productId = $id;

        $model = new ProductsWishlist;

        //get previous data
        $previous = $model->count('user_id=:uid', array(':uid' => Yii::app()->user->userId));
        if ($previous == 25) {
            $model->deleteAll('user_id=:uid order by entry_time limit 1', array(':uid' => Yii::app()->user->userId));
            $data = array('msg' => 'Product not delete.');
        }

        if (!$model->exists('user_id=:uid and product_id=:pid', array(':uid' => Yii::app()->user->userId, ':pid' => $productId))) {
            $model->product_id = $productId;
            $model->user_id = Yii::app()->user->userId;
            $model->save();
            Yii::app()->user->setFlash('success', "Product successfully added to your wish list");
        } else {
            Yii::app()->user->setFlash('error', "This product already in your wish list");
            $this->redirect(Products::model()->makeLink($productId));
        }
        $this->redirect(Products::model()->makeLink($productId));
    }

}
