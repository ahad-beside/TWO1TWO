<?php
/**
 * This is the model class for table "products".
 *
 * The followings are the available columns in table 'products':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $metatag_title
 * @property string $metatag_description
 * @property string $metatag_keywords
 * @property string $image
 * @property string $model
 * @property string $sku
 * @property string $price
 * @property integer $quantity
 * @property integer $minimum_quantity
 * @property integer $substract_stock
 * @property string $outofstock_status
 * @property string $seo_keyword
 * @property integer $manufacturer
 * @property integer $status
 * @property integer $sort_order
 * @property integer $update_by
 * @property string $update_time
 */
class Service extends CActiveRecord {
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'service';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules(){
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, metatag_title, model, sku, price,reseller_price, quantity, update_by, update_time,slug,quick_view,subscription', 'required'),
            array('slug', 'unique', 'on' => 'insert', 'message' => '{attribute}:{value} already exists!'),
            array('quantity, status, sort_order, update_by', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 200),
            //array('metatag_title, metatag_description, metatag_keywords, seo_keyword', 'length', 'max' => 255),
            //array('image', 'file', 'allowEmpty' => true, 'types' => 'jpg,jpeg,png', 'mimeTypes' => 'image/gif, image/jpeg, image/png'),
            array('image', 'file', 'allowEmpty' => true, 'types' => 'jpg,jpeg,png'),
            array('image, model, sku', 'length', 'max' => 100),
            array('price', 'length', 'max' => 11),
            array('description,specification,feature,benifits, metatag_description, metatag_keywords, image, seo_keyword, sort_order, featured', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, description, metatag_title, metatag_description, metatag_keywords, image, model, sku, price, quantity, seo_keyword,status, sort_order, update_by, update_time,subscription', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'quick_view'=>'Quick Overview',
            'specification' => 'Specification',
            'feature' => 'Features',
            'benifits' => 'Benifits',
            'metatag_title' => 'Meta Tag Title',
            'metatag_description' => 'Meta Tag Description',
            'metatag_keywords' => 'Meta Tag Keywords',
            'image' => 'Image',
            'model' => 'Model',
            'sku' => 'SKU',
            'price' => 'Customer Price',
            'reseller_price' => 'Reseller Price',
            'quantity' => 'Quantity',
            'seo_keyword' => 'Seo Keyword',
            'manufacturer' => 'Manufacturer',
            'featured' => 'Featured',
            'status' => 'Status',
            'sort_order' => 'Sort Order',
            'update_by' => 'Update By',
            'update_time' => 'Update Time',
            'subscription'=>'Subscription',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('quick_view', $this->quick_view, true);
        $criteria->compare('metatag_title', $this->metatag_title, true);
        $criteria->compare('metatag_description', $this->metatag_description, true);
        $criteria->compare('metatag_keywords', $this->metatag_keywords, true);
        $criteria->compare('image', $this->image, true);
        $criteria->compare('model', $this->model, true);
        $criteria->compare('sku', $this->sku, true);
        $criteria->compare('price', $this->price, true);
        $criteria->compare('quantity', $this->quantity);
        $criteria->compare('seo_keyword', $this->seo_keyword, true);
        $criteria->compare('featured', $this->featured);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('sort_order', $this->sort_order);
        $criteria->compare('update_by', $this->update_by);
        $criteria->compare('update_time', $this->update_time, true);
        $criteria->compare('subscription', $this->subscription, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Products the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getSelectedCategory($id) {
        $data = CategoryService::model()->findAll('product_id=:id', array(':id' => $id));
        if (count($data) > 0) {
            $sel = array();
            foreach ($data as $row):
                $sel[] = $row->category_id;
            endforeach;
        }
        return $sel;
    }

    public static function findProductImgName($id){
        return self::model()->findByPk($id)->image;
    }
    public static function addRecentView($id){
            $cookie_name = "Fdox";
            if(isset($_COOKIE['Fdox'])){
               $cookie_value= $_COOKIE['Fdox'].','.$id; ;
            }else{
              $cookie_value= $id;
            }
            setcookie($cookie_name, $cookie_value, time() + (86400 * 7), "/");
           //setcookie('Fdox', "", 0, "/");
        }


    public static function dropDown($id = 0, $con = '') {

        $cond = 'status="1" ';

        if ((int) $id > 0)
            $cond = 'id!=' . $id;

        $data = array();
        $parent = self::model()->findAll($cond);
        foreach ($parent as $p) {
            $data[$p->id] = $p->name;
        }
        return $data;
    }

    public static function makeLink($id){
        //return Yii::app()->createAbsoluteUrl('//product/' . $id, array('name' => self::model()->findByPk($id)->name));
        return Yii::app()->createAbsoluteUrl('//service/' . self::model()->findByPk($id)->slug);
    }

    public static function getProductPrice($pid, $option = array(), $qty='',$subscriptionId='') {
        $pinfo = self::model()->findByPk($pid);
        $subscriptionMonth=Subscription::model()->findByPk($subscriptionId)->total_month;
        if(isset(Yii::app()->user->roles) && Yii::app()->user->roles=='Reseller')
            $price = $pinfo->reseller_price;
        else
            $price = $pinfo->price;

        if($subscriptionId!='')
            return $price*$subscriptionMonth;
        else
            return $price;
        //return Yii::app()->currency->convert($price,false);
    }

    public static function getPrice4Admin($productId, $price) {
            return $price;
    }


    public static function getPrice($price, $discount = 0, $output='html') {
        $price = Yii::app()->currency->convert($price,false);
        $discount = Yii::app()->currency->convert($discount,false);
        
        $res = '';
        $arr=array();
        if ($discount > 0) {
            $percent = round(($price - $discount) / $price * 100);
            $res .='<div class="pu-discount fk-font-11"><span class="pu-old">' . Yii::app()->currency->getSymbol() .' '. $price . '</span> ' . $percent . '% OFF</div>';
            //$res .= "<span class='pre_price fk-font-11'>".Yii::app()->params->currencySymbol.$price."</span>";
            $res .= "<span class='fk-font-17 fk-bold'>" . Yii::app()->currency->getSymbol() . $discount . "</span>";
        } else {
            $res .= "<span class='fk-font-17 fk-bold'>" . Yii::app()->currency->getSymbol() . $price . "</span>";
        }
        return $res;
    }


    public static function getRelatedService($makeOr,$id) {
        $command = Yii::app()->db->createCommand();
        $command->select("p.id, p.name, p.image, p.price, p.update_time, pc.category_id");

        $command->from('category_service pc');
        $command->join('service p', 'pc.product_id=p.id');
        $command->orwhere($makeOr);
        $command->andwhere('p.status=:status', array(':status' => 1));
        $command->andwhere('p.id!=:id', array(':id' => $id));
            $command->group('p.id');

        return $command->queryAll();
    }

    public static function getProductList($catId, $filter = array(), $sortval = '', $q = '', $offset = 24, $with_offset = true,$limit=12) {
        $command = Yii::app()->db->createCommand();
        $command->select("p.id, p.name, p.image, p.price, p.update_time,p.quick_view, pc.category_id");

        $command->from('category_service pc');

        //$command->join('products_filter pf','pc.product_id=pf.product_id');
        //$command->join('products p','pf.product_id=p.id');
        $command->join('service p', 'pc.product_id=p.id');

        /* if (count($filter) > 0)
          $command->join('products_filter pf', 'p.id=pf.product_id'); */

        $command->where('pc.category_id=:catid', array(':catid' => $catId));
        $command->andwhere('p.status=:status', array(':status' => 1));

        if (trim($q) != '') {
            $command->andwhere('p.name LIKE :q', array(':q' => '%' . $q . '%'));
        }

        /* if (count($filter) > 0) {
          $filQuery = array();
          $filQuery[] = 'and';
          foreach ($filter as $fill):
          $filQuery[] = 'pf.filter_id="' . $fill . '"';
          endforeach;
          $command->andwhere($filQuery);
          } */


        if ($sortval != '') {
            if ($sortval == 'price_asc') {
                $field = 'p.price asc';
            } else if ($sortval == 'price_desc') {
                $field = 'p.price desc';
            } else if ($sortval == 'date_desc') {
                $field = 'p.update_time desc';
            }
            $command->order($field);
        }
        if ($with_offset) {
            $command->limit($limit);
            $command->offset($offset);
        }
        if (count($filter) > 0)
            $command->group('pc.product_id');
        else
            $command->group('pc.product_id');


        return $command->queryAll();
        //return $command->getText();
    }

    public static function getAllProductList($filter = array(), $sortval = '', $q = '', $offset = 24, $categoryId='', $with_offset = true, $limit=12) {
        $command = Yii::app()->db->createCommand();
        $command->select("p.id, p.name, p.image,p.quick_view,p.quick_view, p.price,p.update_time, pc.category_id");

        $command->from('category_service pc');

        $command->join('service p', 'pc.product_id=p.id');
        $command->andwhere('p.status=:status', array(':status' => 1));
        
        if($categoryId !='')
        $command->andwhere('pc.category_id=:pcid', array(':pcid' =>$categoryId));

        if (trim($q) != '') {
            $command->andwhere('p.name LIKE :q', array(':q' => '%' . $q . '%'));
        }

        /* if (count($filter) > 0) {
          $filQuery = array();
          $filQuery[] = 'and';
          foreach ($filter as $fill):
          $filQuery[] = 'pf.filter_id="' . $fill . '"';
          endforeach;
          $command->andwhere($filQuery);
          } */


        if ($sortval != '') {
            if ($sortval == 'price_asc') {
                $field = 'p.price asc';
            } else if ($sortval == 'price_desc') {
                $field = 'p.price desc';
            } else if ($sortval == 'date_desc') {
                $field = 'p.update_time desc';
            }
            $command->order($field);
        }
        if ($with_offset) {
            $command->limit($limit);
            $command->offset($offset);
        }
        if (count($filter) > 0)
            $command->group('pc.product_id');
        else
            $command->group('pc.product_id');


        return $command->queryAll();
        //return $command->getText();
        //return $categoryId;
    }

    public static function getCategoryFilter($cat = '') {
        $categoryList = array();
        if ($cat == '') {
            $allcat = ServiceCategory::model()->findAll('status=:status and parent is :parent order by sort_order', array(':status' => 1, ':parent' => Null));
           foreach($allcat as $v):
               $categoryList[$v->id] = $v->name;
           endforeach;
            return $categoryList;
        }else {
            $catInfo = ServiceCategory::model()->findByPk($cat);
            $categoryList[$catInfo->id] = array();
            $childCat = ServiceCategory::model()->findAll('status=:status and parent=:parent order by sort_order', array(':status' => 1, ':parent' => $catInfo->id));
            foreach($childCat as $v):
                $categoryList[$catInfo->id][] = array('id'=>$v->id,'name'=>$v->name);
            endforeach;
            return $categoryList;
        }
    }
    
    public static function getProductParent() {
            $allcat = ServiceCategory::model()->findAll('status=:status and parent is :parent order by sort_order', array(':status' => 1, ':parent' => Null));
            return $allcat;
    }
    
    public static function getProductChild($id) {
            $childCat = ServiceCategory::model()->findAll('status=:status and parent=:parent order by sort_order', array(':status' => 1, ':parent' => $id));
            return $childCat;
    }
    public static function getProductList_pre($catId = '', $filter = array(), $sortval = '', $q = '', $offset = 24, $with_offset = true) {
        $command = Yii::app()->db->createCommand();
        $command->select("p.id, p.name, p.image, p.price, p.outofstock_status, p.update_time,  (select pd.price as pdprice from products_discount pd where now() between pd.from_date and pd.to_date and pd.product_id=p.id) as discount_price");

        if ($catId != '') {
            $command->from('products_category pc');
            $command->join('products p', 'pc.product_id=p.id');
        } else {
            $command->from('products p');
        }

        if (count($filter) > 0)
            $command->join('products_filter pf', 'p.id=pf.product_id');

        $command->where('p.outofstock_status=:stock', array(':stock' => 'In Stock'));
        if ($catId != '')
            $command->andwhere('pc.category_id=:catid', array(':catid' => $catId));
        $command->andwhere('p.status=:status', array(':status' => 1));

        if (trim($q) != '') {
            $command->andwhere('p.name LIKE :q', array(':q' => '%' . $q . '%'));
        }

        if (count($filter) > 0) {
            $filQuery = array();
            $filQuery[] = 'or';
            foreach ($filter as $fill):
                $filQuery[] = 'pf.filter_id="' . $fill . '"';
            endforeach;
            $command->andwhere($filQuery);
            //$command->where(array('or', 'pf.filter_id=20', 'pf.filter_id=22',));
            //$command->where(array('in', 'pf.filter_id', $filter));
        }

        if ($sortval != '') {
            if ($sortval == 'price_asc') {
                $field = 'p.price asc';
            } else if ($sortval == 'price_desc') {
                $field = 'p.price desc';
            } else if ($sortval == 'date_desc') {
                $field = 'p.update_time desc';
            }
            $command->order($field);
        }

        if (count($filter) > 0)
            $command->group('pc.product_id,pf.product_id');
        else
            $command->group('p.id');


        return $command->queryAll();
    }

    public static function deleteProductImages($id) {
        //Delete Single Images
        $model = Service::model()->findByPk($id);
        if ($model->image != '')
            Yii::app()->easycode->deleteFile($model->image,'service');


        //Delete Multiple Images
        if ($id != '' && $id > 0) {
            $model = new ServiceImage;
            $info = $model->findAll('product_id=:id', array(':id' => $id));
            if (count($info) > 0) {
                foreach ($info as $row):
                    Yii::app()->easycode->deleteFile($row->image,'service');
                endforeach;
            }
        }
    }
    public static function getProductImage($image){
        return Yii::app()->easycode->returnOriginalImage($image,'/product/');
    }

    public static function newArrival($orderBy = 'id', $limit = '10') {
        return self::model()->findAll(array('order' => $orderBy, 'limit' => $limit));
    }

    public static function getProductRating($id) {
        return ProductsRatingReview::model()->findBySql('select round(AVG(rating_score)) as `rating_score`, count(id) as id from products_rating_review where product_id=:id group by product_id', array(':id' => $id));
    }
    
    public static function getUMayAlsoLike() {
        $command = Yii::app()->db->createCommand();
        $command->select("p.id, p.name, p.image, p.price, p.most_popular, (select pd.price as pdprice from products_discount pd where now() between pd.from_date and pd.to_date and pd.product_id=p.id) as discount_price");
        $command->from('products_category pc');
        $command->join('products p', 'pc.product_id=p.id');

        $command->where('p.outofstock_status="In Stock"');
        
        
        $carts = Yii::app()->session['cart'];
        foreach($carts as $cart):
            if($cart['productType']=='Regular'){
                $command->andwhere('p.id!="'.$cart['id'].'"');
            }
        endforeach;
        
        $command->andwhere('p.status=:status', array(':status' => 1));


        $command->limit(25);
        $command->group('pc.product_id');
        $results = $command->queryAll();
        //return $command->getText();
        return $results;
    }
}
