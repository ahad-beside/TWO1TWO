<div class="page-wrapper-row full-height">
<div class="page-content">
    
    <div class="container">
        <div id="exTab2" class="container">	
        <a href="<?= Yii::app()->createUrl('//admin/user/index');?>" class="btn btn-success btn-sm">Back to List</a>
        <div class="clearfix">&nbsp;</div>
<ul class="nav nav-tabs">
			<li class="active">
        <a  href="#1" data-toggle="tab">Personal Information</a>
			</li>
		</ul>

			<div class="tab-content ">
			  <div class="tab-pane active" id="1">


              <?php if(count($data['userInfo'])>0){?>
          <div class="col-md-12">

       
            <div class="row">
                <div class="col-md-9 profile-info">
                    <h1 class="font-green sbold uppercase"><?= $data['userInfo']->first_name.' '.$data['userInfo']->last_name ?>
                    </h1>
                    <p> <?= $data['userInfo']->user->email ?> </p>
                </div>
                <!--end col-md-8-->
                <div class="col-md-3">
                    <ul class="list-unstyled profile-nav">
                <li>
                    <img src="<?= Yii::app()->easycode->showOriginalImage($data['userInfo']->photo,'/profile/'); ?>" class="img-responsive pic-bordered" alt="" />
                </li>
            </ul>
                </div>
                <!--end col-md-4-->
            </div>
            <!--end row-->
            <div class="tabbable-line tabbable-custom-profile">
                <div class="">
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-advance table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                             Title </th>
                                        <th class="hidden-xs">
                                            Description </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="width: 200px;">
                                            Date of Birth
                                        </td>
                                        <td class="hidden-xs"> <?= date('F d,Y',strtotime($data['userInfo']->birth_date)); ?> </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 200px;">
                                            Gender
                                        </td>
                                        <td class="hidden-xs"> <?= $data['userInfo']->gender; ?> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
            

        </div>
        <?php } else{?>
                    <div class="alert alert-warning">
  <strong>Sorry!</strong> User profile is not update yet.
</div>
            <?php } ?>
				</div>
			</div>
  </div>
    </div>
    </div>

</div>