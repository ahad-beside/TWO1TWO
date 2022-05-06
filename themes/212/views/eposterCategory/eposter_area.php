<div class="content-page-header" style="margin-top:61px;">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="breadcrumb"> <a href="<?= Yii::app()->homeUrl;?>"><i class="icon-home"></i> Home</a> <span class="crumbs-spacer"><i class="fa fa-angle-double-right"></i></span> <span class="current"><?php echo $data['categoryName']?></span>
          <?php if(isset(Yii::app()->user->roles) && Yii::app()->user->roles=='ePosterAdmin' || isset(Yii::app()->user->roles) && Yii::app()->user->roles=='Admin'){
            $eposterLink=Yii::app()->createUrl('//admin/eposterList/create');
          }else{
            $eposterLink=Yii::app()->createUrl('//site/login');
          }
            ?>
           <?php //if(isset(Yii::app()->user->roles) && Yii::app()->user->roles=='ePosterAdmin' || isset(Yii::app()->user->roles) && Yii::app()->user->roles=='Admin'){?> 
          <a class="btn btn-sm btn-success" style="float: right;color: #fff;" href="<?= $eposterLink;?>"><i class="icon-plus"></i> Post ePoster</a>
          <?php //} ?>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Page Header -->
<div id="content" class="product-area" style="padding:50px 0px;">
  	
    <div class="container">
    	<div class="whitebox">
    <div class="row">
      <div class="col-md-3 col-sm-3 col-xs-12">
        <?php $this->renderPartial('eposter_sidebar',array('data'=>$data)); ?>
      </div>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <div class="shop-content">
          <?php if(count($data['jobList'])>0){
            ?>
              <?php foreach($data['jobList'] as $rowProduct):
              $url = EposterList::model()->makeLink($rowProduct['id']);
              ?>
              <div class="col-md-12 col-sm-12 col-xs-12">
              	<div class="perrow">
                <div class="row">
                <div class="col-md-9">
                	<a href="<?= $url?>"><?= $rowProduct['name']?></a>
                </div>
                
                <div class="col-md-3 text-right expired_date">
                	<div><?= EposterList::model()->getAttributeLabel('expire_date')?></div>
                    <p class="date"><i class="fa fa-calendar" aria-hidden="true"></i> <?= date('d-m-Y',strtotime($rowProduct['expire_date']));?></p>
                </div>
                
                
                </div>
                </div>
              </div>
              <?php endforeach;?>
            <?php } else{?>
            <div class="alert alert-warning">
              No ePoster found under this Category.
            </div>
            <?php } ?>
        </div>
      </div>
    </div>
  </div>
    </div>
  
</div>

<style>
.expired_date{
	color:#666;
	font-size:12px;
}
.perrow{
	width:100%;
	display:inline-block;
	background-color:#FFF;
	margin-bottom:20px;
	padding:12px;
}
.date{
	font-size:12px;
	color:#888;
}
	.whitebox{
		width:100%;
		display:inline-block;
		padding:12px;
	}
	.shop-content a{
		color:#15C;
	}
</style>