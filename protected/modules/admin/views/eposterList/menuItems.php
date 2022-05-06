<script type="text/javascript">
        $(document).ready(function (){
           getCountTotal(); 
        });
        function getCountTotal(){
            $.post('<?php echo Yii::app()->createUrl('//admin/eposterList/getOrderCount')?>',function (data){
                data = JSON.parse(data);
                $('.tPending').html('['+data.pending+']');
                $('.tConfirm').html('['+data.confirmed+']');
                $('.tCanceled').html('['+data.canceled+']');
            });
        }
</script>
<div class="col-md-10">
    <div class="btn-group">
        <?php $srt = strtolower($this->action->id);
        ?>
        <a href="<?= $this->createUrl('index') ?>" class="btn btn-default <?= ($srt == 'index') ? 'active' : ''; ?>"><i class="fa fa-list"></i> Pending <span style="color:red; font-weight: bold;font-style: italic;" class="tPending">[ <i class="fa fa-refresh fa-spin"></i> ]</span></a>
        
         <a href="<?= $this->createUrl('confirmedList') ?>" class="btn btn-default <?= ($srt == 'confirmedlist') ? 'active' : ''; ?>"><i class="fa fa-list"></i> Confirmed <span style="color:green; font-weight: bold;font-style: italic;" class="tConfirm">[ <i class="fa fa-refresh fa-spin"></i> ]</span></a>
<!--         <a href="<?//= $this->createUrl('artworkConfirmedList') ?>" class="btn btn-default <?= ($srt == 'artworkconfirmedlist') ? 'active' : ''; ?>"><i class="fa fa-list"></i> Artwork Confirmed </a>-->
        
        
<!--        <a href="<?//= $this->createUrl('deliveredList') ?>" class="btn btn-default <?//= ($srt == 'deliveredlist') ? 'active' : ''; ?>"><i class="fa fa-list"></i> Delivered </a>-->
        <a href="<?= $this->createUrl('canceledList') ?>" class="btn btn-default <?= ($srt == 'canceledlist') ? 'active' : ''; ?>"><i class="fa fa-list"></i> Canceled <span style="font-weight: bold;font-style: italic;" class="tCanceled">[ <i class="fa fa-refresh fa-spin"></i> ]</span> </a>
        <!-- <a href="<?//= $this->createUrl('create') ?>" class="btn btn-success <?//= ($srt == 'create') ? 'active' : ''; ?>"><i class="fa fa-plus"></i> Create</a> -->
    </div>
    <!-- <a style="float:right;" href="<?//= $this->createUrl('dueList') ?>" class="btn btn-danger <?//= ($srt == 'duelist') ? 'active' : ''; ?>"><i class="fa fa-list"></i> Due <span style="font-weight: bold;font-style: italic;" class="tDue">[ <i class="fa fa-refresh fa-spin"></i> ]</span> </a> -->
</div>