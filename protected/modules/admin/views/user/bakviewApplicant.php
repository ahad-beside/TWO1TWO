<div class="page-content">
    <div class="container">
    
    	
        <div id="exTab2" class="container">	
<ul class="nav nav-tabs">
			<li class="active">
        <a  href="#1" data-toggle="tab">Personal Information</a>
			</li>
			<li><a href="#2" data-toggle="tab">Education Information</a>
			</li>
			<li><a href="#3" data-toggle="tab">Working Experience</a>
			</li>
		</ul>

			<div class="tab-content ">
			  <div class="tab-pane active" id="1">
          <h3>Standard tab panel created on bootstrap using nav-tabs</h3>
				</div>
				<div class="tab-pane" id="2">
          <h3>Notice the gap between the content and tab after applying a background color</h3>
				</div>
        <div class="tab-pane" id="3">
          <h3>add clearfix to tab-content (see the css)</h3>
				</div>
			</div>
  </div>


        
    
        <!-- BEGIN PAGE BREADCRUMBS -->
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="profile">
                <div class="tabbable-line tabbable-full-width">
                 <?php if(count($data['userInfo'])>0){?>
                    <div class="tab-content">
<div class="tab-pane active">
    <div class="row">
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
                    <img src="<?= Yii::app()->easycode->showOriginalImage($data['userInfo']->photo,'/profile/'); ?>" class="img-responsive pic-bordered" alt="" /></li>
            </ul>
                </div>

                <!--end col-md-4-->
            </div>
            <!--end row-->
            <div class="tabbable-line tabbable-custom-profile">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1_11">
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
                                            Father Name
                                        </td>
                                        <td class="hidden-xs"> <?= $data['userInfo']->father_name ?> </td>
                                    </tr>
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
                                    <?php if($data['userInfo']->category!=''){?>
                                    <tr>
                                        <td style="width: 200px;">
                                            Category
                                        </td>
                                        <td class="hidden-xs"> <?= $data['userInfo']->category; ?> </td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <td style="width: 200px;">
                                            Nationality
                                        </td>
                                        <td class="hidden-xs"> <?= $data['userInfo']->nationality; ?> </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 200px;">
                                            ID Proof Number
                                        </td>
                                        <td class="hidden-xs"> <?= $data['userInfo']->id_proof_number; ?> </td>
                                    </tr>

                                    <tr>
                                        <td style="width: 200px;">
                                            Mobile
                                        </td>
                                        <td class="hidden-xs"> <?= $data['userInfo']->mobile_with_country_code; ?> </td>
                                    </tr>

                                    <tr>
                                        <td style="width: 200px;">
                                            Phone
                                        </td>
                                        <td class="hidden-xs"> <?= $data['userInfo']->mobile_with_std_code; ?> </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 200px;">
                                            Address
                                        </td>
                                        <td class="hidden-xs"> <?= $data['userInfo']->address1; ?> <br><?= $data['userInfo']->address2; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 200px;">
                                            State
                                        </td>
                                        <td class="hidden-xs"> <?= $data['userInfo']->state->name; ?></td>
                                    </tr>
                                     <tr>
                                        <td style="width: 200px;">
                                            District
                                        </td>
                                        <td class="hidden-xs"> <?= $data['userInfo']->district->name; ?></td>
                                    </tr>
                                     <tr>
                                        <td style="width: 200px;">
                                            ID Proof Attachment
                                        </td>
                                        <td class="hidden-xs"> 
                                            
                                            <a target="_blank" href="<?= Yii::app()->easycode->showOriginalImage($data['userInfo']->id_proof_photo,'/profile/'); ?>">Click Here</a>
                                        </td>
                                    </tr>
                                     <tr>
                                        <td style="width: 200px;">
                                            Birth Certificate
                                        </td>
                                        <td class="hidden-xs"> 
                                            
                                            <a target="_blank" href="<?= Yii::app()->easycode->showOriginalImage($data['userInfo']->birth_cirtificate_photo,'/profile/'); ?>">Click Here</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--tab-pane-->
                    <!--tab-pane-->
                </div>
            </div>
            

        </div>
    </div>
</div>
                        <!--tab_1_2-->

                        <!--end tab-pane-->

                        <!--end tab-pane-->
                    </div>
                    <?php } else{?>
                    <div class="alert alert-warning">
  <strong>Sorry!</strong> Applicant profile is not update yet.
</div>
            <?php } ?>
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT INNER -->
    </div>
</div>