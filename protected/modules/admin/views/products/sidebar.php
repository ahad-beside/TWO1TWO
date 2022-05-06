<div class="list-group">
    <?php 
    $conId=Yii::app()->controller->id;

    if(strtolower($conId)=='products')
        $productActive='active';
    else
        $productActive='';

    if(strtolower($conId)=='category')
        $categoryActive='active';
    else
        $categoryActive='';

    if(strtolower($conId)=='service')
        $serviceActive='active';
    else
        $serviceActive='';

    if(strtolower($conId)=='servicecategory')
        $serviceCategoryActive='active';
    else
        $serviceCategoryActive='';
    ?>
    <?= CHtml::link('Product',$this->createUrl('//admin/products'), array('class'=>'list-group-item '.$productActive,'data-tag'=>'genarel')); ?>

    <?= CHtml::link('Product Category',$this->createUrl('//admin/category'), array('class'=>'list-group-item '.$categoryActive,'data-tag'=>'genarel')); ?>

    <?= CHtml::link('Service',$this->createUrl('//admin/service'), array('class'=>'list-group-item '.$serviceActive,'data-tag'=>'genarel')); ?>

    <?= CHtml::link('Service Category',$this->createUrl('//admin/serviceCategory'), array('class'=>'list-group-item '.$serviceCategoryActive,'data-tag'=>'genarel')); ?>
    
</div>
<style>
    .countColor{
        color:green;
    }
    .countColorP{
        color:#FF9900;
    }
    .countColorR{
        color:red;
    }
</style>
<script type="text/javascript">
    /*$(document).ready(function(){
        $(".list-group-item").removeClass('active');
        $(".list-group-item[data-tag='"+window.location.hash.substr(1)+"']").addClass('active');
    });*/
</script>