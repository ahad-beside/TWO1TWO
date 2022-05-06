<div class="list-group">
    <?php 
    $conId=Yii::app()->controller->id;

    if(strtolower($conId)=='settings')
        $settingActive='active';
    else
        $settingActive='';
    if(strtolower($conId)=='menu')
        $menuActive='active';
    else
        $menuActive='';
    if(strtolower($conId)=='slideshow')
        $slideActive='active';
    else
        $slideActive='';
    if(strtolower($conId)=='page')
        $pageActive='active';
    else
        $pageActive='';
    if(strtolower($conId)=='advertisement')
        $advertisementActive='active';
    else
        $advertisementActive='';
    
    if(strtolower($conId)=='subscription')
        $subscriptionActive='active';
    else
        $subscriptionActive='';
    ?>
    <?= CHtml::link('Site Settings',$this->createUrl('//admin/settings/index'), array('class'=>'list-group-item '.$settingActive,'data-tag'=>'genarel')) ?>

    <?= CHtml::link('Home Page',$this->createUrl('#'), array('class'=>'list-group-item '.$homeActive,'data-tag'=>'genarel')); ?>

    <?= CHtml::link('Menu',$this->createUrl('//admin/menu/index'), array('class'=>'list-group-item '.$menuActive,'data-tag'=>'genarel')); ?>
    
    <?= CHtml::link('Slider',$this->createUrl('//admin/slideshow/index'), array('class'=>'list-group-item '.$slideActive,'data-tag'=>'genarel')); ?>

    <?= CHtml::link('Page',$this->createUrl('//admin/page'), array('class'=>'list-group-item '.$pageActive,'data-tag'=>'genarel')); ?>

    <?= CHtml::link('Review',$this->createUrl('//admin/settings/review'), array('class'=>'list-group-item','data-tag'=>'genarel')); ?>

    <?= CHtml::link('Advertisement',$this->createUrl('//admin/advertisement'), array('class'=>'list-group-item '.$advertisementActive,'data-tag'=>'genarel')); ?>

    <?= CHtml::link('Subscription',$this->createUrl('//admin/subscription'), array('class'=>'list-group-item '.$subscriptionActive,'data-tag'=>'genarel')); ?>
    
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