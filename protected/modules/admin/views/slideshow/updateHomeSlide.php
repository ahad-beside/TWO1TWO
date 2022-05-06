<div class="row open_page">
    <div class="col-md-12 custom-page-header">
        <div class="col-md-12"><strong style="font-size:20px">Update Home Slider</strong>
				<div style="float:right">
					<?php
						echo CHtml::link('<i class="fa fa-plus"></i>', $this->createUrl('createHomeSlide'), array('class' => 'btn btn-default btn-circle', 'title' => 'New Page'));
						echo CHtml::link('<i class="fa fa-list"></i>', $this->createUrl('adminHomeSlide'), array('class' => 'btn btn-default btn-circle', 'title' => 'All Page'));
					?>
				</div>
				</div>
    </div>

    <div class="col-md-12"><?php echo Yii::app()->easycode->showNotification(); ?></div>

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?php $this->renderPartial('_formHomeSlide', array('model' => $model)); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>