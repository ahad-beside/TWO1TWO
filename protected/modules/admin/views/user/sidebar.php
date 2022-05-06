<script type="text/javascript">
    $(document).ready(function (){
       getCountTotal(); 
    });
    function getCountTotal(){
        $.post('<?php echo Yii::app()->createUrl('//admin/user/getUserCount')?>',function (data){
            data = JSON.parse(data);
            $('.tReseller').html('['+data.reseller+']');
            $('.tCustomer').html('['+data.customer+']');
            $('.tActiveEvent').html('['+data.activeEvent+']');
            $('.tInActiveEvent').html('['+data.inActiveEvent+']');
        });
    }
</script>
<?php 
if(isset($_GET['User']['role']) && $_GET['User']['role']=='2')
    $resellerActive='active';
else
    $resellerActive='';

if(isset($_GET['User']['role']) && $_GET['User']['role']=='3')
    $customerActive='active';
else
    $customerActive='';

if(isset($_GET['User']['role']) && $_GET['User']['role']=='4' && $_GET['User']['active']=='1')
    $eventActive='active';
else
    $eventActive='';

if(isset($_GET['User']['role']) && $_GET['User']['role']=='4' && $_GET['User']['active']=='0')
    $InactiveEventActive='active';
else
    $InactiveEventActive='';
?>

<div class="list-group">
    <?= CHtml::link('Reseller <span class="countColor tReseller"></span>',$this->createUrl('//admin/user/index?User[role]=2&'), array('class'=>'list-group-item '.$resellerActive,'data-tag'=>'genarel')) ?>
    
    <?= CHtml::link('Customer <span class="countColor tCustomer"></span>',$this->createUrl('//admin/user/index?User[role]=3&'), array('class'=>'list-group-item '.$customerActive,'data-tag'=>'genarel')) ?>
    
    <?= CHtml::link('Approved Event Management <span class="countColor tActiveEvent"></span>',$this->createUrl('//admin/user/index?User[role]=4&User[active]=1&'), array('class'=>'list-group-item '.$eventActive,'data-tag'=>'genarel')) ?>

    <?= CHtml::link('Pending Event Management <span class="countColorP tInActiveEvent"></span>',$this->createUrl('//admin/user/index?User[role]=4&User[active]=0&'), array('class'=>'list-group-item '.$InactiveEventActive,'data-tag'=>'genarel')) ?>
    
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
    .active .countColor{
        color: #fff!important;
    }
    .active .countColorP{
        color: #fff!important;
    }
</style>
<script type="text/javascript">
    /*$(document).ready(function(){
        $(".list-group-item").removeClass('active');
        $(".list-group-item[data-tag='"+window.location.hash.substr(1)+"']").addClass('active');
    });*/
</script>