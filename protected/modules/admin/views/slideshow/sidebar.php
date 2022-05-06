<div class="list-group">
    <?php 
        $cond=Yii::app()->controller->action->id;
        if($_GET['Slideshow']['position']=='Photo Gallery')
            $activeP = 'active';
        else
            $activeP = '';
        if($_GET['Slideshow']['position']=='Home Banner')
            $activeH = 'active';
        else
            $activeH = '';
    ?>
        <?= CHtml::link('Photo Gallery', $this->createUrl('//admin/slideshow/index/',array('Slideshow[position]'=>'Photo Gallery')), array('class'=>'list-group-item '.$activeP,'data-tag'=>'genarel')) ?>
        <?= CHtml::link('Home Banner', $this->createUrl('//admin/slideshow/index/',array('Slideshow[position]'=>'Home Banner')), array('class'=>'list-group-item '.$activeH,'data-tag'=>'genarel')) ?>
</div>