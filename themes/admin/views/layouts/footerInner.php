<div class="page-footer">
    <div class="container"> <?= date("Y")?> &copy;
        <a target="_blank" href="<?= Yii::app()->homeUrl?>">
        <?php 
        if(isset(Yii::app()->session['siteName']))
            echo Yii::app()->session['siteName'];
        ?>
        </a>
    </div>
</div>
<div class="scroll-to-top">
    <i class="icon-arrow-up"></i>
</div>