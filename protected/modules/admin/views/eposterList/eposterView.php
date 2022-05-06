<div class="page-wrapper-row full-height">
		<div class="page-wrapper-middle">
			<!-- BEGIN CONTAINER -->
			<div class="page-container">
				<!-- BEGIN CONTENT -->
				<div class="page-content-wrapper">
					<!-- BEGIN CONTENT BODY -->
					<!-- BEGIN PAGE HEAD-->
					<div class="page-head">
						<div class="container">
							<!-- BEGIN PAGE TITLE -->
							<div class="page-title">
								<h1><?= $this->pageTitle ?></h1>
							</div>

						</div>
					</div>
					<!-- END PAGE HEAD-->
					<!-- BEGIN PAGE CONTENT BODY -->
					<div class="page-content">
						<div class="container">
							<div class="row">
								<div class="col-md-3">
									<?php $this->renderPartial('/eposterList/sidebar') ?>
								</div>
								<?php //$this->renderPartial('menuItems',array('status'=>$data['status'])) ?>
								<div class="col-md-9">
									<?php //$this->renderPartial('_search', array('model' => $model)) ?>
									<div class="portlet box">
										<div class="portlet-body" style="display: block;">
											<h2>Event: <?= $modelEposter->name;?></h2>
                      <p>Date & Time: <?= date('d-m-Y',strtotime($modelEposter->expire_date))?> <?= date('h:i A',strtotime($modelEposter->expire_date))?></p>
											<?php 
											if(isset(Yii::app()->user->roles) && Yii::app()->user->roles!='ePosterAdmin')
												//$this->renderPartial('actionButton');
											?>
											<?php
                                            $this->widget('zii.widgets.grid.CGridView', array(
                                                'id' => 'job-view-data',
                                                'htmlOptions' => array('class' => 'data-grid table-responsive'),
                                                'itemsCssClass' => 'table table-striped table-bordered table-hover',
                                                'template' => '{items}{pager}',
                                                'dataProvider' => $model->search(),
                                                'columns' => array(
                                                   // array(
                                                   //     'class' => 'CCheckBoxColumn',
                                                   //     'value' => '$data->id',
                                                   //     'selectableRows' => '2',
                                                   //     'id' => 'actionCheck'
                                                   // ),
                                                    array(
                                                        'class' => 'IndexColumn',
                                                        'header' => '#',
                                                        'headerHtmlOptions' => array('style' => 'width:20px;'),
                                                    ),
                                                    array(
                                                    'name'=>'speaker_id',
                                                    'value'=>'User::model()->findByPk($data->speaker_id)->first_name." ".User::model()->findByPk($data->speaker_id)->last_name',
                                                    ),
                                                    array(
                                                    'name'=>'date_time',
                                                    'header'=>'Date',
                                                    'value'=>'date("d-m-Y",strtotime($data->date_time))',
                                                    ),
                                                    array(
                                                    'name'=>'date_time',
                                                    'header'=>'Time',
                                                    'value'=>'date("h:i A",strtotime($data->date_time))',
                                                    ),
                                                    'title',
                                                    array(
                                                    'header'=>'Document',
                                                    'name'=>'image',
                                                    'value'=>'EposterImage::model()->getDocument($data->id)',
                                                    'type'=>'raw',
                                                    ),
                                                    
                                                    array(
                                                        'class' => 'CButtonColumn',
                                                        'header' => 'Action',
                                                        'template' => '{update} &nbsp;&nbsp;{delete}',
                                                    //'deleteConfirmation' => false,
                                                        'buttons' => array(
                                                            'update' => array(
                                                                'label' => '<span class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></span>',
                                                            'url'=>'EposterImage::model()->getDocumentButtonVisibleManager($data->id)',
                                                                'imageUrl' => false,
                                                                'options' => array('title' => 'Update'),
                                                            ),
                                                            'delete' => array(
                                                                'label' => '<span class="btn btn-xs btn-danger"><i class="fa fa-times"></i></span>',
                                                            'url'=>'Yii::app()->createUrl("//admin/eposterList/documentDelete/",array("id"=>$data->id))',
                                                                'imageUrl' => false,
                                                                'options' => array(
                                                                    'title' => 'Delete',
                                                                //'class' => 'delConfirm',
                                                                //'data-toggle'=>'confirmation',
                                                                ),
                                                            ),
                                                        ),
                                                    ),
                                                ),
                                            ));
                                            ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- END PAGE CONTENT BODY -->
					<!-- END CONTENT BODY -->
				</div>
				<!-- END CONTENT -->

			</div>
			<!-- END CONTAINER -->
		</div>
	</div>
<div class="clearfix">
	&nbsp;
</div>

