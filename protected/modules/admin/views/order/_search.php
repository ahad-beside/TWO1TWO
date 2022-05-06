<?php
Yii::app()->clientScript->registerScript('search', "
$('.searchForm').submit(function(){
    $('#order-grid').yiiGridView('update', {
        data: $('.searchForm').serialize()
    });
    return false;
});
");
?>
<div class="portlet box grid-search-portlet" style="display: none">
    <div class="portlet-body" style="display: block;">

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'method' => 'get',
            'htmlOptions' => array('class' => 'searchForm', 'role' => 'form')
        ));
        ?>
        <div class="form-body">
            <h3 class="form-section">Search</h3>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo $form->label($model, 'order_number', array('class' => 'control-label')); ?>
                        <?php echo $form->textField($model, 'order_number', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control input-sm', 'placeholder' => 'Order Name')); ?>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo $form->label($model, 'grand_total', array('class' => 'control-label')); ?>
                        <?php echo $form->textField($model, 'grand_total', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control input-sm', 'placeholder' => 'Grand Total')); ?>
                    </div>
                </div>
                
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-sm green">Search</button>
                </div>
            </div>
        </div>

        <?php $this->endWidget(); ?>

    </div>
</div>

<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/assets/global/plugins/select2/css/select2.min.css');?>

<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/assets/global/plugins/select2/css/select2-bootstrap.min.css');?>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/global/scripts/components-select2.min.js', CClientScript::POS_END);?>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/global/plugins/select2/js/select2.full.min.js', CClientScript::POS_END);?>