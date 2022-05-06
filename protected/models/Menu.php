<?php

/**
 * This is the model class for table "menu".
 *
 * The followings are the available columns in table 'menu':
 * @property integer $id
 * @property string $name
 * @property integer $parent
 * @property string $type
 * @property integer $additional_id
 * @property string $position
 * @property integer $sort_order
 * @property integer $status
 * @property integer $update_by
 * @property string $update_time
 */
class Menu extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'menu';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, type, additional_id, position, update_by, update_time', 'required'),
            array('parent, sort_order, status, update_by', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 100),
            array('type', 'length', 'max' => 30),
            array('icon', 'length', 'max' => 50),
            array('additional_id', 'length', 'max' => 200),
            array('position', 'length', 'max' => 20),
            array('sort_order,link_lable', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, parent, type, additional_id, position, sort_order, status, update_by, update_time', 'safe', 'on' => 'search'),
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
            'link_lable' => 'Link Lable',
            'parent' => 'Parent',
            'type' => 'Type',
            'additional_id' => 'Additional',
            'position' => 'Position',
            'sort_order' => 'Sort Order',
            'status' => 'Status',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('link_lable', $this->link_lable, true);
        $criteria->compare('parent', $this->parent);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('additional_id', $this->additional_id);
        $criteria->compare('position', $this->position, true);
        $criteria->compare('sort_order', $this->sort_order);
        $criteria->compare('status', $this->status);
        $criteria->compare('update_by', $this->update_by);
        $criteria->compare('update_time', $this->update_time, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Menu the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /* Multi Category Dropdown */

    public static function dropDown($withoutParent = true) {
        $data = array();
        $parent = self::model()->findAll('parent is NULL');
        foreach ($parent as $p) {
            if ($withoutParent)
                $data[$p->id] = $p->name;
            $childItems = self::model()->getChildItems($p->id, $p->name);
            $data = self::model()->array_merge_custom($data, $childItems);
        }
        return $data;
    }

    public static function getChildItems($id, $name) {
        $data = array();
        $child = self::model()->findAll('parent=:parentid', array(':parentid' => $id));
        foreach ($child as $c) {
            $data[$c->id] = $name . ' > ' . $c->name;
            $childItems = self::model()->getChildItems($c->id, $name . ' > ' . $c->name);
            $data = self::model()->array_merge_custom($data, $childItems);
        }
        return $data;
    }

    function array_merge_custom($first, $second) {
        $result = array();
        foreach ($first as $key => $value) {
            $result[$key] = $value;
        }
        foreach ($second as $key => $value) {
            $result[$key] = $value;
        }

        return $result;
    }

    /* End Multi Category Dropdown */

    public function makeLink($id) {
        $info = self::model()->findByPk((int) $id);
        if ($info->type == 'category')
            return Category::model()->makeLink($info->additional_id);
        else if ($info->type == 'page')
            return Page::model()->makeLink($info->additional_id);
        else
            return $info->additional_id;
    }

    public function showChildMenu($id, $inc, $tr = '') {
        $menus = Menu::model()->findAll("parent='" . $id . "' and status='1' order by sort_order");
        $tr .= $tr;
        foreach ($menus as $menu):
            $tr .= '<tr>';
            $tr .= '<td></td><td>' . $this->showDash($inc) . $menu->name . '</td>';
            $tr .= '<td></td><td><a href="' . Yii::app()->createUrl('//admin/menu/del', array('id' => $menu->id)) . '"><i class="fa fa-minus-circle"></i></a> <a href="' . Yii::app()->createUrl('//admin/menu/update', array('id' => $menu->id)) . '"><i class="fa fa-edit"></i></a></td>';
            $tr .= '</tr>';

            $tr .= $this->showChildMenu($menu->id, $inc + 1, $td);
        endforeach;

        return $tr;
    }

    public function showDash($count) {
        $c = '';
        for ($i = 0; $i <= $count; $i++):
            $c .='&nbsp;';
        endfor;
        return $c;
    }

    public function makeBreadCrumb($id, $type) {
        if ($type == 'Category') {
            $menu = self::model()->find('type=:type and additional_id=:additional_id', array(':type' => 'category', ':additional_id' => $id));
            $data[] = array('name' => $menu->name, 'link' => Category::model()->makeLink($id));
        } else if ($type == 'Product') {
            $pinfo = Products::model()->findByPk($id);
            $pcat = ProductsCategory::model()->find('product_id=:id', array(':id' => $id));
            $data[] = array('name' => $pinfo->name, 'link' => '#');
            $menu = self::model()->find('type=:type and additional_id=:additional_id', array(':type' => 'category', ':additional_id' => $pcat->category_id));
            $data[] = array('name' => $menu->name, 'link' => Category::model()->makeLink($id));
        }
        $breadCrumb = $this->findParents($menu->parent, $data);
        $breadCrumb = array_reverse($breadCrumb, true);
        $final = array();
        foreach ($breadCrumb as $v):
            if ($v['name'] != '')
                $final[$v['name']] = $v['link'];
        endforeach;
        return $final;
    }

    public function findParents($parentId, $data) {
        $parent = self::model()->findByPk($parentId);
        if ($parent->type == 'category') {
            $name = $parent->name;
            $link = Category::model()->makeLink($parent->additional_id);
        }
        $data[] = array('name' => $name, 'link' => $link);
        if ($parent->parent != Null)
            $data = self::model()->array_merge_custom($data, $this->findParents($parent->parent, $data));

        return $data;
    }

}
