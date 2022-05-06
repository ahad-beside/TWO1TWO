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
								<!-- <a class="btn btn-sm btn-primary" href="<?//= $this->createUrl('//admin/eposterList/create') ?>" title="Create ePoster"> <i class="fa fa-plus"></i> Create ePoster</a> -->
							</div>

						</div>
					</div>
					<!-- END PAGE HEAD-->
					<!-- BEGIN PAGE CONTENT BODY -->
					<div class="page-content">
						<div class="container">
							<div class="row">
								<div class="col-md-2">
									<?php $this->renderPartial('sidebar')?>
								</div>
								<?php $this->renderPartial('menuItems',array('status'=>$data['status'])) ?>
								<div class="col-md-10" style="margin-top: 10px;">
									<?php //$this->renderPartial('_search', array('model' => $model)) ?>
									<div class="portlet box">
										<div class="portlet-body" style="display: block;">
											<?php 
											//if(isset(Yii::app()->user->roles) && Yii::app()->user->roles!='ePosterAdmin')
												$this->renderPartial('actionButton');
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
													'name'=>'product_id',
													'value'=>'Review::model()->getProductService($data->product_id,$data->review_type)',
													'type'=>'raw',
													),
													array(
													'name'=>'user_id',
													'value'=>'$data->user->first_name." ".$data->user->last_name',
													//'visible'=>Yii::app()->user->roles != "ePosterAdmin" ?true:false,
													),
													'details',

													array(
													'name'=>'rating_point',
													'value'=>'Review::model()->getStar($data->rating_point)',
													'type'=>'raw',
													),
													array(
													'name'=>'entry_date',
													'value'=>'date("d-m-Y",strtotime($data->entry_date))',
													),
													array(
														'class' => 'CButtonColumn',
														'header' => 'Action',
														'template' => '{delete}',
                                                    //'deleteConfirmation' => false,
														'buttons' => array(
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

