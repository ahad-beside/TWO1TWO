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
							<!-- END PAGE TITLE -->
							<div class="page-action-buttons">
								<!-- <a class="btn btn-sm btn-primary" href="javascript:void(0)" onclick="javascript:$('.grid-search-portlet').toggle('slow')" title="Search"> <i class="fa fa-search"></i> Search</a> -->
								<a class="btn btn-sm btn-primary" href="<?= $this->createUrl('//admin/eposterList/createSpeaker') ?>" title="Create ePoster"> <i class="fa fa-plus"></i> Create Speaker</a>
								<a class="btn btn-sm btn-primary" href="<?= $this->createUrl('//admin/eposterList/eposterDocumentUpload') ?>" title="Create ePoster"> <i class="fa fa-plus"></i> Create 212Poster</a>
								<a class="btn btn-sm btn-primary" href="<?= $this->createUrl('//admin/eposterList/create') ?>" title="Create 212Poster"> <i class="fa fa-plus"></i> Create Event</a>
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
								<div class="col-md-9" style="margin-top: 0px;">
									<?php //$this->renderPartial('_search', array('model' => $model)) ?>
									<div class="portlet box">
										<div class="portlet-body" style="display: block;">
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
									               array(
									                   'class' => 'CCheckBoxColumn',
									                   'value' => '$data->id',
									                   'selectableRows' => '2',
									                   'id' => 'actionCheck'
									               ),
													array(
														'class' => 'IndexColumn',
														'header' => '#',
														'headerHtmlOptions' => array('style' => 'width:20px;'),
													),
													array(
													'name'=>'user_id',
													'value'=>'$data->user->first_name." ".$data->user->last_name',
													'visible'=>Yii::app()->user->roles != "ePosterAdmin" ?true:false,
													),
													array(
													'name'=>'expire_date',
													'value'=>'date("d-m-Y",strtotime($data->expire_date))',
													),
													array(
													'name'=>'expire_date',
													'header'=>'Time',
													'value'=>'date("h:i A",strtotime($data->expire_date))',
													),
													'name',
													// array(
													// 'name'=>'entry_date',
													// 'value'=>'date("d-m-Y",strtotime($data->entry_date))',
													// ),
													
													array(
														'class' => 'CButtonColumn',
														'header' => 'Action',
														'template' => '{update}&nbsp;&nbsp;{view}&nbsp;&nbsp;{delete}',
                                                    //'deleteConfirmation' => false,
														'buttons' => array(
															'update' => array(
																'label' => '<span class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></span>',
                                                            //'url'=>'Yii::app()->createUrl("//admin/settings/updateCity/",array("id"=>$data->id))',
																'imageUrl' => false,
																'options' => array('title' => 'Update'),
															),
															'view' => array(
																'label' => '<span class="btn btn-xs btn-warning"><i class="fa fa-eye"></i></span>',
                                                            'url'=>'Yii::app()->createUrl("//admin/eposterList/eposterDocumentView/",array("id"=>$data->id))',
																'imageUrl' => false,
																'options' => array('title' => 'View'),
															),
															'delete' => array(
																'label' => '<span class="btn btn-xs btn-danger"><i class="fa fa-times"></i></span>',
                                                            //'url'=>'Yii::app()->createUrl("//admin/settings/deleteCity/",array("id"=>$data->id))',
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

