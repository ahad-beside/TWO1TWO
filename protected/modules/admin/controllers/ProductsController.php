<?php
class ProductsController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/main';

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
                'actions' => array('create', 'update', 'index', 'view', 'admin', 'delImage', 'delete','delDownload','addOption','delOption'),
                'roles' => array('Admin'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('getOptionContainer'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionDelImage() {
        if (isset($_POST['delId']) && $_POST['delId'] != '') {
            $id = $_POST['delId'];
            $model = new ProductsImage;
            $info = $model->findByPk($id);
            if (count($info) > 0) {
                $model->deleteByPk($id);
                Yii::app()->easycode->deleteFile($info->image,'product');
                echo 1;
            }
        }
    }
    
    public function actionDelOption() {
        if (isset($_POST['delId']) && $_POST['delId'] != '') {
            $id = $_POST['delId'];
            $model = new ProductOption;
            $info = $model->findByPk($id);
            if (count($info) > 0) {
                $model->deleteByPk($id);
                Yii::app()->easycode->deleteFile($info->image,'product');
                echo 1;
            }
        }
    }
    public function actionDelDownload() {
        if (isset($_POST['delId']) && $_POST['delId'] != '') {
            $id = $_POST['delId'];
            $model = new ProductsDownload;
            $info = $model->findByPk($id);
            if (count($info) > 0) {
                $model->deleteByPk($id);
                Yii::app()->easycode->deleteFile($info->image,'product');
                echo 1;
            }
        }
    }

    public function actionGetOptionContainer(){
        $optionId = $_POST['optionId'];
        $optionCount = $_POST['optionCount'];
        //$optionId = $_GET['optionId'];
        $optionType = Option::model()->findByPk((int) $optionId);
        if ($optionType->type === 'select' || $optionType->type === 'radio' || $optionType->type === 'image') {
            echo Option::model()->getOptionContainer($optionType->type, $optionType->id, $optionType->name, $optionCount);
        }
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function saveProductsToStore($data, $category, $action) {
        if ($action == 'update')
            $model = ProductsToStore::model()->deleteAll('products_id=:id', array(':id' => $category));
        if (count($data) > 0) {
            foreach ($data as $val):
                $model = new ProductsToStore;
                $model->products_id = $category;
                $model->store_id = $val;
                $model->save();
            endforeach;
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate(){
        $this->pageTitle='New Product';
        $model = new Products;
        $data['countOptionContainer'] = 0;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Products'])){
            $model->attributes = $_POST['Products'];
            $model->update_by = Yii::app()->user->userId;
            $model->update_time = date('Y-m-d h:i:s');
            $model->slug = Yii::app()->easycode->makeSlug('Products',$model->name);
            if ($model->validate()) {
                $uploadedFile = CUploadedFile::getInstance($model, "image");
                if ($uploadedFile) {
                    $fileName = Yii::app()->easycode->genFileName($uploadedFile->extensionName);
                    $model->image = $fileName;
                }
            }
            $data['selectedCategory'] = $_POST['categories'];
            //$data['selectedFilter'] = $_POST['filters'];
            //$data['selectedRelatedProducts'] = $_POST['relatedProducts'];

            if (count($_POST['categories']) < 1) {
                Yii::app()->user->setFlash('warning', "Warning: Please choose minimum one category from link tab!");
            } else {
                if ($model->save()) {
                    if($uploadedFile)
                        $uploadedFile->saveAs(UPLOAD . Yii::app()->params->productDir . $fileName);
                    $this->saveProductCategories($model->id, $_POST['categories']); //save product categories
                    $this->saveProductsImage($model->id, $_POST['ProductsImage']); //save product images
                    $this->saveProductsDownload($model->id, $_POST['ProductsDownload']); //save product download file
                    Yii::app()->user->setFlash('success', "Success: Product created successfully");
                    $this->redirect(array('admin'));
                } else {
                    //print_r($model->getErrors());exit;
                    Yii::app()->user->setFlash('warning', "Warning: Please check the form carefully for errors!");
                }
            }
        }

        $model->sort_order = Yii::app()->easycode->getLastSortingNumber('Products', 'sort_order');
        $this->render('create', array(
            'model' => $model,
            'data' => $data,
        ));
    }

    public function actionAddOption($id) {
        $model = $this->loadModel($id);
        $data['productOption']=new ProductOption;
        $data['productsOptionData'] = ProductOption::model()->findAll('product_id=:id', array(':id' => $id));
        if (isset($_POST['ProductOption'])){
            //print_r($_POST['ProductOption']);exit;
                    $this->saveProductsOption($model->id, $_POST['ProductOption']); ////save product download file

                    Yii::app()->user->setFlash('success', "Products option created successfully");
                    $this->redirect(array('admin'));
                } 
                // else {
                //     Yii::app()->user->setFlash('warning', "Warning: Please check the form carefully for errors!");
                // }

        $this->pageTitle='Product Option for '.$model->name;
        $this->render('optionCreate', array(
            'model' => $model,
            'data' => $data,
        ));
    }
    public static function saveProductsOption($productId, $values) {
        if (count($values) > 0) {
            for ($i = 0; $i < count($values['sort_order']); $i++):
                if (isset($values['id'][$i]) && $values['id'][$i] != '') {
                    $model = ProductOption::model()->findByPk($values['id'][$i]);
                    $preImage = $model->image;
                } else {
                    $model = new ProductOption;
                    $preImage = '';
                }

                $uploadedFile = CUploadedFile::getInstance($model, "image[{$i}]");
                if ($uploadedFile) {
                    $fileName = Yii::app()->easycode->genFileName($uploadedFile->extensionName);
                    $model->image = $fileName;
                    $uploadedFile->saveAs(UPLOAD . Yii::app()->params->productDir . $fileName);
                    Yii::app()->easycode->deleteFile($preImage,'product');
                } else {
                    $model->image = $preImage;
                }

                $model->product_id = $productId;
                $model->name = $values['name'][$i];
                $model->sort_description = $values['sort_description'][$i];
                $model->price = $values['price'][$i];



                if ($values['sort_order'][$i] != '')
                    $model->sort_order = $values['sort_order'][$i];
                else
                    $model->sort_order = Yii::app()->easycode->getLastSortingNumber('ProductOption', 'sort_order');

                $model->save();
            endfor;
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $this->pageTitle='Update Product';
        $model = $this->loadModel($id);
        $data['selectedCategory'] = Products::model()->getSelectedCategory($id);
        $data['productsImage'] = ProductsImage::model()->findAll('product_id=:id', array(':id' => $id));
        $data['productsDownload'] = ProductsDownload::model()->findAll('product_id=:id', array(':id' => $id));

        /* end get selected option container */

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $preImage = $model->image;
        if (isset($_POST['Products'])) {
            $model->attributes = $_POST['Products'];
            $model->update_by = Yii::app()->user->userId;
            $model->update_time = date('Y-m-d h:i:s');
            $model->slug = Yii::app()->easycode->makeSlug('Products',$model->name);
            if ($model->validate()) {
                $uploadedFile = CUploadedFile::getInstance($model, "image");
                if ($uploadedFile) {
                    $fileName = Yii::app()->easycode->genFileName($uploadedFile->extensionName);
                    $model->image = $fileName;
                    Yii::app()->easycode->deleteFile($preImage,'product');
                } else {
                    $model->image = $preImage;
                }
            }

            if (count($_POST['categories']) < 1) {
                Yii::app()->user->setFlash('warning', "Warning: Please choose minimum one category from link tab!");
            } else {
                if ($model->save()) {
                    
                    if($uploadedFile)
                        $uploadedFile->saveAs(UPLOAD . Yii::app()->params->productDir . $fileName);

                    $this->saveProductCategories($model->id, $_POST['categories']); //save product categories
                    $this->saveProductsImage($model->id, $_POST['ProductsImage']); //save product images
                    $this->saveProductsDownload($model->id, $_POST['ProductsDownload']); //save product download file

                    Yii::app()->user->setFlash('success', "Products updated successfully");
                    $this->redirect(array('admin'));
                } else {
                    Yii::app()->user->setFlash('warning', "Warning: Please check the form carefully for errors!");
                }
            }
        }

        $this->render('create', array(
            'model' => $model,
            'data' => $data,
        ));
    }

    public static function saveProductsImage($productId, $values) {
        if (count($values) > 0) {
            for ($i = 0; $i < count($values['sort_order']); $i++):
                if (isset($values['id'][$i]) && $values['id'][$i] != '') {
                    $model = ProductsImage::model()->findByPk($values['id'][$i]);
                    $preImage = $model->image;
                } else {
                    $model = new ProductsImage;
                    $preImage = '';
                }

                $uploadedFile = CUploadedFile::getInstance($model, "image[{$i}]");
                if ($uploadedFile) {
                    $fileName = Yii::app()->easycode->genFileName($uploadedFile->extensionName);
                    $model->image = $fileName;
                    $uploadedFile->saveAs(UPLOAD . Yii::app()->params->productDir . $fileName);
                    Yii::app()->easycode->deleteFile($preImage,'product');
                } else {
                    $model->image = $preImage;
                }

                $model->product_id = $productId;

                $model->isArtwork = $values['isArtwork'][$i];


                if ($values['sort_order'][$i] != '')
                    $model->sort_order = $values['sort_order'][$i];
                else
                    $model->sort_order = Yii::app()->easycode->getLastSortingNumber('ProductsImage', 'sort_order');

                $model->save();
            endfor;
        }
    }
    public static function saveProductsDownload($productId, $values) {
        if (count($values) > 0) {
            for ($i = 0; $i < count($values['sort_order']); $i++):
                if (isset($values['id'][$i]) && $values['id'][$i] != '') {
                    $model = ProductsDownload::model()->findByPk($values['id'][$i]);
                    $preImage = $model->image;
                } else {
                    $model = new ProductsDownload;
                    $preImage = '';
                }

                $uploadedFile = CUploadedFile::getInstance($model, "image[{$i}]");
                if ($uploadedFile) {
                    $fileName = Yii::app()->easycode->genFileName($uploadedFile->extensionName);
                    $model->image = $fileName;
                    $uploadedFile->saveAs(UPLOAD . Yii::app()->params->productDir . $fileName);
                    Yii::app()->easycode->deleteFile($preImage,'product');
                } else {
                    $model->image = $preImage;
                }

                $model->product_id = $productId;


                if ($values['sort_order'][$i] != '')
                    $model->sort_order = $values['sort_order'][$i];
                else
                    $model->sort_order = Yii::app()->easycode->getLastSortingNumber('ProductsDownload', 'sort_order');

                $model->save();
            endfor;
        }
    }

    public static function saveProductsDiscounts($productId, $values) {

        ProductsDiscount::model()->deleteAll('product_id=:id', array(':id' => $productId)); //Delete Previous Product Discount

        if (count($values) > 0) {
            if ($values['price'] != '' && $values['from_date'] != '' && $values['to_date'] != '') {
                $model = new ProductsDiscount;
                $model->product_id = $productId;
                $model->price = $values['price'];
                $model->from_date = date("Y-m-d 00:00:00", strtotime($values['from_date']));
                $model->to_date = date("Y-m-d 23:59:59", strtotime($values['to_date']));
                $model->save();
            }
        }
    }

    public static function saveProductsOptions($productId, $values) {

        ProductsOption::model()->deleteAll('product_id=:id', array(':id' => $productId)); //Delete Previous Product Option
        ProductsOptionItem::model()->deleteAll('product_id=:id', array(':id' => $productId)); //Delete Previous Product Option Items

        if (count($values) > 0) {
            for ($i = 0; $i <= sizeof($values); $i++):
                $model = new ProductsOption;
                $model->product_id = $productId;
                $model->option_id = $values[$i]['id'];
                $model->isrequired = $values[$i]['required'];
                $model->update_by = Yii::app()->user->userId;
                if ($model->save()) {
                    for ($j = 0; $j <= sizeof($values[$i]['item_id']); $j++):
                        $modelItem = new ProductsOptionItem;
                        $modelItem->product_id = $productId;
                        $modelItem->product_option_id = $model->id;
                        $modelItem->option_item_id = $values[$i]['item_id'][$j];
                        $modelItem->quantity = $values[$i]['qty'][$j];
                        $modelItem->price_prefix = $values[$i]['price_prefix'][$j];
                        $modelItem->price = $values[$i]['price'][$j];
                        $modelItem->save();
                    endfor;
                }
            endfor;
        }
    }

    public function saveProductCategories($productId, $values) {
        ProductsCategory::model()->deleteAll('product_id=:id', array(':id' => $productId)); //Delete Previous Product Categories
        if (count($values) > 0) {
            for ($i = 0; $i < sizeof($values); $i++):
                $model = new ProductsCategory;
                $model->product_id = $productId;
                $model->category_id = $values[$i];
                if ($model->save())
                    $this->saveParentsCategoryToProduct($values[$i], $productId);
            endfor;
        }
    }

    public function saveParentsCategoryToProduct($catId, $productId) {
        $getParent = Category::model()->findByPk($catId);
        if ($getParent != Null) {
            if (!ProductsCategory::model()->exists('product_id=:pid and category_id=:cid', array(':pid' => $productId, ':cid' => $getParent->parent))) {
                $model = new ProductsCategory;
                $model->product_id = $productId;
                $model->category_id = $getParent->parent;
                if ($model->save())
                    $this->saveParentsCategoryToProduct($getParent->parent, $productId);
            }
        }
    }

    public static function saveProductFilters($productId, $values) {
        ProductsFilter::model()->deleteAll('product_id=:id', array(':id' => $productId)); //Delete Previous Product Categories
        if (count($values) > 0) {
            for ($i = 0; $i < sizeof($values); $i++):
                $model = new ProductsFilter;
                $model->product_id = $productId;
                $model->filter_id = $values[$i];
                $model->save();
            endfor;
        }
    }

    public static function saveProductReleatedProducts($productId, $values) {
        ProductsRelatedProduct::model()->deleteAll('product_id=:id', array(':id' => $productId)); //Delete Previous Product Related Products
        if (count($values) > 0) {
            for ($i = 0; $i < sizeof($values); $i++):
                $model = new ProductsRelatedProduct;
                $model->product_id = $productId;
                $model->related_product_id = $values[$i];
                $model->save();
            endfor;
        }
    }

    public static function saveProductAttributes($productId, $values) {

        ProductsAttribute::model()->deleteAll('product_id=:id', array(':id' => $productId)); //Delete Previous Product Attributes

        if (count($values['id']) > 0) {
            for ($i = 0; $i < sizeof($values['id']); $i++):
                $model = new ProductsAttribute;
                $model->product_id = $productId;
                $model->attribute_id = $values['id'][$i];
                $model->message = $values['text'][$i];
                $model->save();
            endfor;
        }
    }
    
    public static function saveProductPrice($productId, $values) {
        ProductsPrice::model()->deleteAll('product_fk=:id', array(':id' => $productId)); //Delete Previous Product Price

        if (count($values['start']) > 0) {
            for ($i = 0; $i < sizeof($values['start']); $i++):
                $model = new ProductsPrice;
                $model->product_fk = $productId;
                $model->start = $values['start'][$i];
                $model->end = $values['end'][$i];
                $model->price = $values['price'][$i];
                $model->save();
            endfor;
        }
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {

        Products::model()->deleteProductImages($id);

        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        /* $dataProvider = new CActiveDataProvider('Products');
          $this->render('index', array(
          'dataProvider' => $dataProvider,
          )); */


        $this->actionAdmin();
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->pageTitle='Product List';
        $model = new Products('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Products']))
            $model->attributes = $_GET['Products'];
        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Products the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Products::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Products $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'products-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
