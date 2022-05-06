<div class="list-group">
    <?php 
    $conId=Yii::app()->controller->id;

    if(strtolower($conId)=='joblist')
        $jobListActive='active';
    else
        $jobListActive='';

    if(strtolower($conId)=='jobCategory')
        $jobCategoryActive='active';
    else
        $jobCategoryActive='';

    if(strtolower($conId)=='jobcategory')
        $jobCategoryActive='active';
    else
        $jobCategoryActive='';
    
    ?>

    <?= CHtml::link('Job Category',$this->createUrl('//admin/jobCategory'), array('class'=>'list-group-item '.$jobCategoryActive,'data-tag'=>'genarel')) ?>

    <?= CHtml::link('Job List',$this->createUrl('//admin/jobList'), array('class'=>'list-group-item '.$jobListActive,'data-tag'=>'genarel')) ?>


    <?= CHtml::link('Applied List',$this->createUrl('//admin/menu/index'), array('class'=>'list-group-item '.$menuActive,'data-tag'=>'genarel')); ?>
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