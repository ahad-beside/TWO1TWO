<div class="row open_page">
    <div class="col-md-12 custom-page-header">
        <div class="col-md-6"><h2>Album</h2></div>
    </div>

    <div class="col-md-12"><?php echo Yii::app()->easycode->showNotification(); ?></div>

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Update Album
				<div style="float:right">
					<?php
						echo CHtml::link('<i class="fa fa-plus"></i>', $this->createUrl('slideshow/createHomeSlide'), array('class' => 'btn btn-default btn-circle', 'title' => 'New Album'))."&nbsp;";
						echo CHtml::link('<i class="fa fa-list"></i>', $this->createUrl('slideshow/adminHomeSlide'), array('class' => 'btn btn-default btn-circle', 'title' => 'All Album'));
					?>
				</div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?php $this->renderPartial('_form', array('model' => $model)); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>