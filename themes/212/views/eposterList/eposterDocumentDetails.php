<!-- <div class="content-page-header">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="breadcrumb"> <a href="<?//= Yii::app()->homeUrl;?>"><i class="icon-home"></i> Home</a> <span class="crumbs-spacer"><i class="fa fa-angle-double-right"></i></span> <span class="current"><?php //echo $model->title?></span>
        </div>
      </div>
    </div>
  </div>
</div> -->
<!-- End Page Header -->

<style type="text/css">
  .modal-header{
    padding: 5px 15px;
  }
  .box-content-info p{
    color: <?=$data['posterDetails']->template_box_font_color?>!important;
  }
  .box-title{
    color: <?=$data['posterDetails']->template_box_font_color?>!important;
  }
  .modal-title{
    color: <?=$data['posterDetails']->template_box_font_color?>!important;
  }
  .modal-content-info p{
    color: <?=$data['posterDetails']->template_box_font_color?>!important;
  }
</style>
<section class="section30 posterdtlss" style="background:url(<?php if($data['posterDetails']->template_background_type=='Background Image'){if($data['posterDetails']->template_bg_image!=''){
  Yii::app()->easycode->showOriginalImage($data['posterDetails']->template_bg_image,'/ePoster/');
}else{
  $bgUrl='';
} }?>); background-color: <?=$data['posterDetails']->template1_bgcolor?>;"> 
   <!-- Start Page Header -->
   	<div class="container">
        <div class="poster-head">
          <div class="col-md-9">
            <h1 style="color: <?=$data['posterDetails']->template2_bgcolor?>;"><?=$data['posterDetails']->title?></h1>
            <h1 style="color: <?=$data['posterDetails']->template3_bgcolor?>;" class="sbtittle"><?=$data['posterDetails']->sub_title?></h1>
          </div>
          <div class="col-md-3 nopadding"><img style="float: right; height: 90px; margin-bottom: 15px;" class="img-responsive" src="<?= Yii::app()->easycode->showOriginalImage($data['posterDetails']->image,'/ePoster/');?>"></div>
        </div>

<?php if($data['posterDetails']->template_type==1){?>
  <div id="template-1" class="template-box">
      <div class="">
        <div class="row">
          <div class="col-md-4">       
          <!-- BOX1 Start-->
            <div class="box" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>">
              <div class="box-title" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>; color: <?=$data['posterDetails']->template_box_font_color?>"><?=$data['posterDetails']->template1_title?></div>
              <div class="box-content-info half">
  <?php if($data['posterDetails']->template1_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template1_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
  <?php } ?>
              <?=$data['posterDetails']->template1?>
            </div>
              <div class="read-more">
                <a href="" data-toggle="modal" data-target="#myModal1">
                  <div>Open</div>
                  <div class="arrow-down"></div>
                </a>
              </div>
              <!-- Modal -->
              <div class="modal fade modal" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>;">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel"><?=$data['posterDetails']->template1_title?></h4>
                    </div>
                    <div class="modal-body" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>;">
                      <div class="modal-content-info">
<?php if($data['posterDetails']->template1_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template1_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
<?php } ?>
                        <?=$data['posterDetails']->template1?></div>
                    </div>
                  
                  </div>
                </div>
              </div>
            </div>
            <!-- BOX1 End-->
            <!-- BOX4 Start-->
            <div class="box" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>">
              <div class="box-title" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>; color: <?=$data['posterDetails']->template_box_font_color?>"><?=$data['posterDetails']->template4_title?></div>
              <div class="box-content-info half">
<?php if($data['posterDetails']->template4_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template4_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
<?php } ?>
                <?=$data['posterDetails']->template4?> 
              </div>
              <div class="read-more">
                <a href=""  data-toggle="modal" data-target="#myModal4">
                  <div>Open</div>
                  <div class="arrow-down"></div>
                </a>
              </div>
              <!-- Modal -->
              <div class="modal fade modal" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>;">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel"><?=$data['posterDetails']->template4_title?></h4>
                    </div>
                    <div class="modal-body" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>;">
                      <div class="modal-content-info">
<?php if($data['posterDetails']->template4_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template4_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
<?php } ?>
                        <?=$data['posterDetails']->template4?></div>
                    </div>
                  
                  </div>
                </div>
              </div>
            </div>
            <!-- BOX4 End-->
          </div>

          <div class="col-md-4">
            <!-- BOX2 Start-->
            <div class="box" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>">
              <div class="box-title" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>; color: <?=$data['posterDetails']->template_box_font_color?>"><?=$data['posterDetails']->template2_title?></div>
              <div class="box-content-info full">
<?php if($data['posterDetails']->template2_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template2_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
<?php } ?>
                <?=$data['posterDetails']->template2?></div>
              <div class="read-more">
                <a href="" data-toggle="modal" data-target="#myModal2">
                  <div>Open</div>
                  <div class="arrow-down"></div>
                </a>
              </div>

              <!-- Modal -->
              <div class="modal fade modal" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>;">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel"><?=$data['posterDetails']->template2_title?></h4>
                    </div>
                    <div class="modal-body" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>;">
                      <div class="modal-content-info">
<?php if($data['posterDetails']->template2_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template2_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
<?php } ?>
                        <?=$data['posterDetails']->template2?></div>
                    </div>
                  
                  </div>
                </div>
              </div>
            </div>
            <!-- BOX2 End-->
          </div>

          <div class="col-md-4"> 
            <!-- BOX3 Start-->
            <div class="box" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>">
              <div class="box-title" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>; color: <?=$data['posterDetails']->template_box_font_color?>"><?=$data['posterDetails']->template3_title?></div>
              <div class="box-content-info half">
<?php if($data['posterDetails']->template3_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template3_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
<?php } ?>
                <?=$data['posterDetails']->template3?></div>
              <div class="read-more">
                <a href="" data-toggle="modal" data-target="#myModal3">
                  <div>Open</div>
                  <div class="arrow-down"></div>
                </a>
              </div>

              <!-- Modal -->
              <div class="modal fade modal" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>;">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel"><?=$data['posterDetails']->template3_title?></h4>
                    </div>
                    <div class="modal-body" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>;">
                      <div class="modal-content-info">
<?php if($data['posterDetails']->template3_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template3_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
<?php } ?>
                        <?=$data['posterDetails']->template3?></div>
                    </div>
                  
                  </div>
                </div>
              </div>
            </div>
            <!-- BOX3 End-->

            <!-- BOX5 Start-->
            <div class="box" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>">
              <div class="box-title" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>; color: <?=$data['posterDetails']->template_box_font_color?>"><?=$data['posterDetails']->template5_title?></div>
              <div class="box-content-info half">
<?php if($data['posterDetails']->template5_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template5_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
<?php } ?>
                <?=$data['posterDetails']->template5?></div>
              <div class="read-more">
                <a href="" data-toggle="modal" data-target="#myModal5">
                  <div>Open</div>
                  <div class="arrow-down"></div>
                </a>
              </div>

              <!-- Modal -->
              <div class="modal fade modal" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>;">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel"><?=$data['posterDetails']->template5_title?></h4>
                    </div>
                    <div class="modal-body" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>;">
                      <div class="modal-content-info">
<?php if($data['posterDetails']->template5_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template5_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
<?php } ?>
                        <?=$data['posterDetails']->template5?></div>
                    </div>
                  
                  </div>
                </div>
              </div>
            </div>
            <!-- BOX5 End-->
          </div>


        </div>
      </div>
  </div>
<?php }elseif($data['posterDetails']->template_type==2){?>
  <div id="template-2" class="template-box">
      <div class="">
        <div class="row">
          <div class="col-md-3">

          <!-- BOX1 Start-->    
            <div class="box" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>">
              <div class="box-title" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>; color: <?=$data['posterDetails']->template_box_font_color?>"><?=$data['posterDetails']->template1_title?></div>
              <div class="box-content-info half">
<?php if($data['posterDetails']->template1_video!=''){?>
  <div class="video-post">
    <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template1_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
  </div>
<?php } ?>
              <?=$data['posterDetails']->template1?>
            </div>
              <div class="read-more">
                <a href="" data-toggle="modal" data-target="#myModal1">
                  <div>Open</div>
                  <div class="arrow-down"></div>
                </a>
              </div>
              <!-- Modal -->
              <div class="modal fade modal" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>;">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel"><?=$data['posterDetails']->template1_title?></h4>
                    </div>
                    <div class="modal-body" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>;">
                      <div class="modal-content-info">
<?php if($data['posterDetails']->template1_video!=''){?>
  <div class="video-post">
    <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template1_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
  </div>
<?php } ?>
                        <?=$data['posterDetails']->template1?></div>
                    </div>
                  
                  </div>
                </div>
              </div>
            </div>
            <!-- BOX1 End--> 

            <!-- BOX5 Start-->    
            <div class="box" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>">
              <div class="box-title" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>; color: <?=$data['posterDetails']->template_box_font_color?>"><?=$data['posterDetails']->template5_title?></div>
              <div class="box-content-info half">
<?php if($data['posterDetails']->template5_video!=''){?>
  <div class="video-post">
    <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template5_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
  </div>
<?php } ?>
              <?=$data['posterDetails']->template5?>
            </div>
              <div class="read-more">
                <a href="" data-toggle="modal" data-target="#myModal5">
                  <div>Open</div>
                  <div class="arrow-down"></div>
                </a>
              </div>
              <!-- Modal -->
              <div class="modal fade modal" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>;">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel"><?=$data['posterDetails']->template5_title?></h4>
                    </div>
                    <div class="modal-body" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>;">
                      <div class="modal-content-info">
<?php if($data['posterDetails']->template5_video!=''){?>
  <div class="video-post">
    <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template5_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
  </div>
<?php } ?>
                        <?=$data['posterDetails']->template5?></div>
                    </div>
                  
                  </div>
                </div>
              </div>
            </div>
            <!-- BOX5 End--> 
          </div>

          <div class="col-md-3">
            <!-- BOX2 Start-->
            <div class="box" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>">
              <div class="box-title" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>; color: <?=$data['posterDetails']->template_box_font_color?>"><?=$data['posterDetails']->template2_title?></div>
              <div class="box-content-info full">
<?php if($data['posterDetails']->template2_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template2_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
<?php } ?>
                <?=$data['posterDetails']->template2?></div>
              <div class="read-more">
                <a href="" data-toggle="modal" data-target="#myModal2">
                  <div>Open</div>
                  <div class="arrow-down"></div>
                </a>
              </div>

              <!-- Modal -->
              <div class="modal fade modal" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>;">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel"><?=$data['posterDetails']->template2_title?></h4>
                    </div>
                    <div class="modal-body" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>;">
                      <div class="modal-content-info">
<?php if($data['posterDetails']->template2_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template2_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
<?php } ?>
                        <?=$data['posterDetails']->template2?></div>
                    </div>
                  
                  </div>
                </div>
              </div>
            </div>
            <!-- BOX2 End-->
            
          </div>
          <div class="col-md-3">
            
            <!-- BOX3 Start-->
            <div class="box" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>">
              <div class="box-title" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>; color: <?=$data['posterDetails']->template_box_font_color?>"><?=$data['posterDetails']->template3_title?></div>
              <div class="box-content-info full">
<?php if($data['posterDetails']->template3_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template3_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
<?php } ?>
                <?=$data['posterDetails']->template3?></div>
              <div class="read-more">
                <a href="" data-toggle="modal" data-target="#myModal3">
                  <div>Open</div>
                  <div class="arrow-down"></div>
                </a>
              </div>

              <!-- Modal -->
              <div class="modal fade modal" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>;">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel"><?=$data['posterDetails']->template3_title?></h4>
                    </div>
                    <div class="modal-body" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>;">
                      <div class="modal-content-info">
<?php if($data['posterDetails']->template3_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template3_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
<?php } ?>
                        <?=$data['posterDetails']->template3?></div>
                    </div>
                  
                  </div>
                </div>
              </div>
            </div>
            <!-- BOX3 End-->

            
          </div>

          <div class="col-md-3">            
            <!-- BOX4 Start-->
            <div class="box" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>">
              <div class="box-title" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>; color: <?=$data['posterDetails']->template_box_font_color?>"><?=$data['posterDetails']->template4_title?></div>
              <div class="box-content-info half">
<?php if($data['posterDetails']->template4_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template4_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
<?php } ?>
                <?=$data['posterDetails']->template4?> 
              </div>
              <div class="read-more">
                <a href=""  data-toggle="modal" data-target="#myModal4">
                  <div>Open</div>
                  <div class="arrow-down"></div>
                </a>
              </div>
              <!-- Modal -->
              <div class="modal fade modal" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>;">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel"><?=$data['posterDetails']->template4_title?></h4>
                    </div>
                    <div class="modal-body" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>;">
                      <div class="modal-content-info">
<?php if($data['posterDetails']->template4_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template4_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
<?php } ?>
                        <?=$data['posterDetails']->template4?></div>
                    </div>
                  
                  </div>
                </div>
              </div>
            </div>
            <!-- BOX4 End-->

            <!-- BOX6 Start-->
            <div class="box" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>">
              <div class="box-title" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>; color: <?=$data['posterDetails']->template_box_font_color?>"><?=$data['posterDetails']->template6_title?></div>
              <div class="box-content-info half">
<?php if($data['posterDetails']->template6_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template6_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
<?php } ?>
                <?=$data['posterDetails']->template6?> 
              </div>
              <div class="read-more">
                <a href=""  data-toggle="modal" data-target="#myModal6">
                  <div>Open</div>
                  <div class="arrow-down"></div>
                </a>
              </div>
              <!-- Modal -->
              <div class="modal fade modal" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>;">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel"><?=$data['posterDetails']->template6_title?></h4>
                    </div>
                    <div class="modal-body" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>;">
                      <div class="modal-content-info">
<?php if($data['posterDetails']->template6_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template6_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
<?php } ?>
                        <?=$data['posterDetails']->template6?></div>
                    </div>
                  
                  </div>
                </div>
              </div>
            </div>
            <!-- BOX6 End-->
          </div>


        </div>
      </div>
  </div>
<?php }elseif($data['posterDetails']->template_type==3){?>

  <div id="template-3" class="template-box">
      <div class="">
        <div class="row">
          <div class="col-md-3">            
            <!-- BOX1 Start-->
            <div class="box" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>">
              <div class="box-title" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>; color: <?=$data['posterDetails']->template_box_font_color?>"><?=$data['posterDetails']->template1_title?></div>
              <div class="box-content-info half">
  <?php if($data['posterDetails']->template1_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template1_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
  <?php } ?>
              <?=$data['posterDetails']->template1?>
            </div>
              <div class="read-more">
                <a href="" data-toggle="modal" data-target="#myModal1">
                  <div>Open</div>
                  <div class="arrow-down"></div>
                </a>
              </div>
              <!-- Modal -->
              <div class="modal fade modal" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>;">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel"><?=$data['posterDetails']->template1_title?></h4>
                    </div>
                    <div class="modal-body" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>;">
                      <div class="modal-content-info">
<?php if($data['posterDetails']->template1_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template1_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
<?php } ?>
                        <?=$data['posterDetails']->template1?></div>
                    </div>
                  
                  </div>
                </div>
              </div>
            </div>
            <!-- BOX1 End-->

            <!-- BOX5 Start-->
            <div class="box" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>">
              <div class="box-title" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>; color: <?=$data['posterDetails']->template_box_font_color?>"><?=$data['posterDetails']->template5_title?></div>
              <div class="box-content-info half">
  <?php if($data['posterDetails']->template5_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template5_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
  <?php } ?>
              <?=$data['posterDetails']->template5?>
            </div>
              <div class="read-more">
                <a href="" data-toggle="modal" data-target="#myModal5">
                  <div>Open</div>
                  <div class="arrow-down"></div>
                </a>
              </div>
              <!-- Modal -->
              <div class="modal fade modal" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>;">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel"><?=$data['posterDetails']->template5_title?></h4>
                    </div>
                    <div class="modal-body" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>;">
                      <div class="modal-content-info">
<?php if($data['posterDetails']->template5_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template5_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
<?php } ?>
                        <?=$data['posterDetails']->template5?></div>
                    </div>
                  
                  </div>
                </div>
              </div>
            </div>
            <!-- BOX5 End-->
          </div>

          <div class="col-md-3">
            
            <!-- BOX2 Start-->
            <div class="box" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>">
              <div class="box-title" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>; color: <?=$data['posterDetails']->template_box_font_color?>"><?=$data['posterDetails']->template2_title?></div>
              <div class="box-content-info half">
  <?php if($data['posterDetails']->template2_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template2_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
  <?php } ?>
              <?=$data['posterDetails']->template2?>
            </div>
              <div class="read-more">
                <a href="" data-toggle="modal" data-target="#myModal2">
                  <div>Open</div>
                  <div class="arrow-down"></div>
                </a>
              </div>
              <!-- Modal -->
              <div class="modal fade modal" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>;">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel"><?=$data['posterDetails']->template2_title?></h4>
                    </div>
                    <div class="modal-body" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>;">
                      <div class="modal-content-info">
<?php if($data['posterDetails']->template2_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template2_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
  <?php } ?>
                        <?=$data['posterDetails']->template2?></div>
                    </div>
                  
                  </div>
                </div>
              </div>
            </div>
            <!-- BOX2 End-->

            
          </div>
          <div class="col-md-3">            
            <!-- BOX3 Start-->
            <div class="box" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>">
              <div class="box-title" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>; color: <?=$data['posterDetails']->template_box_font_color?>"><?=$data['posterDetails']->template3_title?></div>
              <div class="box-content-info half">
  <?php if($data['posterDetails']->template3_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template3_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
  <?php } ?>
              <?=$data['posterDetails']->template3?>
            </div>
              <div class="read-more">
                <a href="" data-toggle="modal" data-target="#myModal3">
                  <div>Open</div>
                  <div class="arrow-down"></div>
                </a>
              </div>
              <!-- Modal -->
              <div class="modal fade modal" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>;">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel"><?=$data['posterDetails']->template3_title?></h4>
                    </div>
                    <div class="modal-body" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>;">
                      <div class="modal-content-info">
<?php if($data['posterDetails']->template3_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template3_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
  <?php } ?>
                        <?=$data['posterDetails']->template3?></div>
                    </div>
                  
                  </div>
                </div>
              </div>
            </div>
            <!-- BOX3 End-->

            
          </div>

          <div class="col-md-3">            
            <!-- BOX4 Start-->
            <div class="box" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>">
              <div class="box-title" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>; color: <?=$data['posterDetails']->template_box_font_color?>"><?=$data['posterDetails']->template4_title?></div>
              <div class="box-content-info half">
  <?php if($data['posterDetails']->template4_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template4_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
  <?php } ?>
              <?=$data['posterDetails']->template4?>
            </div>
              <div class="read-more">
                <a href="" data-toggle="modal" data-target="#myModal4">
                  <div>Open</div>
                  <div class="arrow-down"></div>
                </a>
              </div>
              <!-- Modal -->
              <div class="modal fade modal" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>;">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel"><?=$data['posterDetails']->template4_title?></h4>
                    </div>
                    <div class="modal-body" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>;">
                      <div class="modal-content-info">
<?php if($data['posterDetails']->template4_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template4_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
  <?php } ?>
                        <?=$data['posterDetails']->template4?></div>
                    </div>
                  
                  </div>
                </div>
              </div>
            </div>
            <!-- BOX4 End-->

            <!-- BOX6 Start-->
            <div class="box" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>">
              <div class="box-title" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>; color: <?=$data['posterDetails']->template_box_font_color?>"><?=$data['posterDetails']->template6_title?></div>
              <div class="box-content-info half">
  <?php if($data['posterDetails']->template6_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template6_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
  <?php } ?>
              <?=$data['posterDetails']->template6?>
            </div>
              <div class="read-more">
                <a href="" data-toggle="modal" data-target="#myModal6">
                  <div>Open</div>
                  <div class="arrow-down"></div>
                </a>
              </div>
              <!-- Modal -->
              <div class="modal fade modal" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>;">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel"><?=$data['posterDetails']->template6_title?></h4>
                    </div>
                    <div class="modal-body" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>;">
                      <div class="modal-content-info">
<?php if($data['posterDetails']->template6_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template6_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
  <?php } ?>
                        <?=$data['posterDetails']->template6?></div>
                    </div>
                  
                  </div>
                </div>
              </div>
            </div>
            <!-- BOX6 End-->
          </div>


        </div>
      </div>
  </div>
<?php }elseif($data['posterDetails']->template_type==4){?>

  <div id="template-4" class="template-box">
      <div class="">
        <div class="row">
          <div class="col-md-3">

            <!-- BOX1 Start-->
            <div class="box" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>">
              <div class="box-title" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>; color: <?=$data['posterDetails']->template_box_font_color?>"><?=$data['posterDetails']->template1_title?></div>
              <div class="box-content-info half">
  <?php if($data['posterDetails']->template1_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template1_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
  <?php } ?>
              <?=$data['posterDetails']->template1?>
            </div>
              <div class="read-more">
                <a href="" data-toggle="modal" data-target="#myModal1">
                  <div>Open</div>
                  <div class="arrow-down"></div>
                </a>
              </div>
              <!-- Modal -->
              <div class="modal fade modal" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>;">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel"><?=$data['posterDetails']->template1_title?></h4>
                    </div>
                    <div class="modal-body" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>;">
                      <div class="modal-content-info">
<?php if($data['posterDetails']->template1_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template1_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
<?php } ?>
                        <?=$data['posterDetails']->template1?>
                      </div>
                    </div>
                  
                  </div>
                </div>
              </div>
            </div>
            <!-- BOX1 End-->

            <!-- BOX5 Start-->
            <div class="box" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>">
              <div class="box-title" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>; color: <?=$data['posterDetails']->template_box_font_color?>"><?=$data['posterDetails']->template5_title?></div>
              <div class="box-content-info half">
  <?php if($data['posterDetails']->template5_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template5_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
  <?php } ?>
              <?=$data['posterDetails']->template5?>
            </div>
              <div class="read-more">
                <a href="" data-toggle="modal" data-target="#myModal5">
                  <div>Open</div>
                  <div class="arrow-down"></div>
                </a>
              </div>
              <!-- Modal -->
              <div class="modal fade modal" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>;">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel"><?=$data['posterDetails']->template5_title?></h4>
                    </div>
                    <div class="modal-body" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>;">
                      <div class="modal-content-info">
<?php if($data['posterDetails']->template5_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template5_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
<?php } ?>
                        <?=$data['posterDetails']->template5?></div>
                    </div>
                  
                  </div>
                </div>
              </div>
            </div>
            <!-- BOX5 End-->
          </div>

          <div class="col-md-6">
            <div class="row">
              <div class="col-md-6">
                <!-- BOX2 Start-->
            <div class="box" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>">
              <div class="box-title" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>; color: <?=$data['posterDetails']->template_box_font_color?>"><?=$data['posterDetails']->template2_title?></div>
              <div class="box-content-info half">
  <?php if($data['posterDetails']->template2_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template2_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
  <?php } ?>
              <?=$data['posterDetails']->template2?>
            </div>
              <div class="read-more">
                <a href="" data-toggle="modal" data-target="#myModal2">
                  <div>Open</div>
                  <div class="arrow-down"></div>
                </a>
              </div>
              <!-- Modal -->
              <div class="modal fade modal" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>;">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel"><?=$data['posterDetails']->template2_title?></h4>
                    </div>
                    <div class="modal-body" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>;">
                      <div class="modal-content-info">
  <?php if($data['posterDetails']->template2_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template2_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
  <?php } ?>
                        <?=$data['posterDetails']->template2?></div>
                    </div>
                  
                  </div>
                </div>
              </div>
            </div>
            <!-- BOX2 End-->
            
              </div>

              <div class="col-md-6">
                <!-- BOX3 Start-->
            <div class="box" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>">
              <div class="box-title" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>; color: <?=$data['posterDetails']->template_box_font_color?>"><?=$data['posterDetails']->template3_title?></div>
              <div class="box-content-info half">
<?php if($data['posterDetails']->template3_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template3_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
<?php } ?>
                <?=$data['posterDetails']->template3?></div>
              <div class="read-more">
                <a href="" data-toggle="modal" data-target="#myModal3">
                  <div>Open</div>
                  <div class="arrow-down"></div>
                </a>
              </div>

              <!-- Modal -->
              <div class="modal fade modal" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>;">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel"><?=$data['posterDetails']->template3_title?></h4>
                    </div>
                    <div class="modal-body" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>;">
                      <div class="modal-content-info">
  <?php if($data['posterDetails']->template3_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template3_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
<?php } ?>
                        <?=$data['posterDetails']->template3?></div>
                    </div>
                  
                  </div>
                </div>
              </div>
            </div>
            <!-- BOX3 End-->
              </div>

              <div class="col-md-12" style="margin-top: 20px;">

                <!-- BOX6 Start-->
            <div class="box" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>">
              <div class="box-title" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>; color: <?=$data['posterDetails']->template_box_font_color?>"><?=$data['posterDetails']->template6_title?></div>
              <div class="box-content-info half">
<?php if($data['posterDetails']->template6_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template6_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
<?php } ?>
                <?=$data['posterDetails']->template6?> 
              </div>
              <div class="read-more">
                <a href=""  data-toggle="modal" data-target="#myModal6">
                  <div>Open</div>
                  <div class="arrow-down"></div>
                </a>
              </div>
              <!-- Modal -->
              <div class="modal fade modal" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>;">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel"><?=$data['posterDetails']->template6_title?></h4>
                    </div>
                    <div class="modal-body" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>;">
                      <div class="modal-content-info">
<?php if($data['posterDetails']->template6_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template6_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
<?php } ?>
                        <?=$data['posterDetails']->template6?></div>
                    </div>
                  
                  </div>
                </div>
              </div>
            </div>
            <!-- BOX6 End-->
            
              </div>


            </div>            
          </div>
          

          <div class="col-md-3">            
            <!-- BOX4 Start-->
            <div class="box" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>">
              <div class="box-title" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>; color: <?=$data['posterDetails']->template_box_font_color?>"><?=$data['posterDetails']->template4_title?></div>
              <div class="box-content-info half">
<?php if($data['posterDetails']->template4_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template4_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
<?php } ?>
                <?=$data['posterDetails']->template4?> 
              </div>
              <div class="read-more">
                <a href=""  data-toggle="modal" data-target="#myModal4">
                  <div>Open</div>
                  <div class="arrow-down"></div>
                </a>
              </div>
              <!-- Modal -->
              <div class="modal fade modal" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>;">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel"><?=$data['posterDetails']->template4_title?></h4>
                    </div>
                    <div class="modal-body" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>;">
                      <div class="modal-content-info">
<?php if($data['posterDetails']->template4_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template4_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
<?php } ?>
                        <?=$data['posterDetails']->template4?></div>
                    </div>
                  
                  </div>
                </div>
              </div>
            </div>
            <!-- BOX4 End-->

            <!-- BOX7 Start-->
            <div class="box" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>">
              <div class="box-title" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>; color: <?=$data['posterDetails']->template_box_font_color?>"><?=$data['posterDetails']->template7_title?></div>
              <div class="box-content-info half">
<?php if($data['posterDetails']->template7_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template7_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
<?php } ?>
                <?=$data['posterDetails']->template7?> 
              </div>
              <div class="read-more">
                <a href=""  data-toggle="modal" data-target="#myModal7">
                  <div>Open</div>
                  <div class="arrow-down"></div>
                </a>
              </div>
              <!-- Modal -->
              <div class="modal fade modal" id="myModal7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: <?=$data['posterDetails']->template3_bgcolor?>;">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel"><?=$data['posterDetails']->template7_title?></h4>
                    </div>
                    <div class="modal-body" style="background-color: <?=$data['posterDetails']->template4_bgcolor?>;">
                      <div class="modal-content-info">
<?php if($data['posterDetails']->template7_video!=''){?>
    <div class="video-post">
      <iframe width="100%" height="250" src="<?=Yii::app()->easycode->getYoutubeUrlId($data['posterDetails']->template7_video)?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
<?php } ?>
                        <?=$data['posterDetails']->template7?></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- BOX7 End-->
          </div>
        </div>
      </div>
  </div>
<?php } ?>
  <div class="poster-footer">
          <div class="col-md-12" style="color: <?=$data['posterDetails']->template2_bgcolor?>"> <?=$data['posterDetails']->footer_text?></div>
        </div>
   	</div>
   <!-- End Page Header -->
   <div class="window-fullscreen">
         <a href="#" class="requestfullscreen"><img style="width: 50px" src="<?php echo Yii::app()->theme->baseUrl ?>/assets/images/full-size.png"/></a>
         <!-- <a href="#" class="exitfullscreen" style="display: none"><img style="width: 50px" src="<?php echo Yii::app()->theme->baseUrl ?>/assets/images/full-size-exit.png"/></a> -->
  </div>
</section>


<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl?>/assets/css/fullscreen.css" type="text/css">
<script type="text/javascript" src="<?= Yii::app()->theme->baseUrl?>/assets/js/jquery.fullscreen.js"></script>
<script type="text/javascript">
        $(function() {
          // check native support
          $('#support').text($.fullscreen.isNativelySupported() ? 'supports' : 'doesn\'t support');

          // open in fullscreen
          $('#fullscreen .requestfullscreen').click(function() {
            $('#fullscreen').fullscreen();
            return false;
          });

          // exit fullscreen
          $('#fullscreen .exitfullscreen').click(function() {
            $.fullscreen.exit();
            return false;
          });

          // document's event
          $(document).bind('fscreenchange', function(e, state, elem) {
            // if we currently in fullscreen mode
            if ($.fullscreen.isFullScreen()) {
              $('#fullscreen .requestfullscreen').hide();
              $('#fullscreen .exitfullscreen').show();
            } else {
              $('#fullscreen .requestfullscreen').show();
              $('#fullscreen .exitfullscreen').hide();
            }
            $('#state').text($.fullscreen.isFullScreen() ? '' : 'not');
          });
        });
      </script>
      <style type="text/css">
        .box-content-info P img{
          text-align: center;
          margin: auto;
        }
        .box-content-info img{
          height: 200px !important;
  width: inherit !important;
  max-width: 100% !important;
  text-align: center;
  display: block;
        }
        .modal-content img{
          /*height: 400px!important;*/
          width: 100%!important;
        }
        .box ul li{
          list-style: circle;
          margin-left: 20px;
        }
      </style>