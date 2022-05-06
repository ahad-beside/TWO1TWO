<div class="list-group">
    <?php 
    $conId=Yii::app()->controller->id;

    if(strtolower($conId)=='album')
        $albumActive='active';
    else
        $albumActive='';

    if(strtolower($conId)=='gallery')
        $galleryActive='active';
    else
        $galleryActive='';

    
    ?>
    <?= CHtml::link('Album List',$this->createUrl('//admin/album'), array('class'=>'list-group-item '.$albumActive,'data-tag'=>'genarel')); ?>

   <!--  <?//= CHtml::link('Upload Gallery Image',$this->createUrl('//admin/gallery/create'), array('class'=>'list-group-item '.$galleryActive,'data-tag'=>'genarel')); ?> -->
    
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