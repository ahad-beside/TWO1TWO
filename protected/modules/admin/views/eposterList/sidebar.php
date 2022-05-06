<div class="list-group">
    <?php 
    $conId=Yii::app()->controller->action->id;

    if(strtolower($conId)=='index' || strtolower($conId)=='create' || strtolower($conId)=='update' || strtolower($conId)=='eposterdocumentview')
        $eposterListActive='active';
    else
        $eposterListActive='';

    if(strtolower($conId)=='speakerlist' || strtolower($conId)=='createspeaker')
        $eposterSpeakerActive='active';
    else
        $eposterSpeakerActive='';
    
    ?>

    <?= CHtml::link('Event List',$this->createUrl('//admin/eposterList'), array('class'=>'list-group-item '.$eposterListActive,'data-tag'=>'genarel')) ?>

    <?= CHtml::link('Speaker List',$this->createUrl('//admin/eposterList/speakerList'), array('class'=>'list-group-item '.$eposterSpeakerActive,'data-tag'=>'genarel')) ?>

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