<div class="widget-ct widget-categories mb-30">
		<div class="widget-s-title">
			<h4><?= Yii::app()->user->roles;?> Panel </h4>
		</div>
		<div class="widget-info" style="width:100%; display:inline-block;">
			<?php if(isset(Yii::app()->user->roles) && Yii::app()->user->roles!='Speaker'){?>
    <div class="u-vmenu">
				<ul>
					<li><a href="<?=Yii::app()->createUrl('//user/dashboard')?>">Dashboard</a></li>
					<li><a href="javascript:;">Order</a>
						<ul>
						<li><a href="<?=Yii::app()->createUrl('//order/index',array('Order[status]'=>'Pending'))?>">Pending Order</a></li>
						<li><a href="<?=Yii::app()->createUrl('//order/index',array('Order[status]'=>'Confirmed'))?>">Confirmed Order</a></li>
						<li><a href="<?=Yii::app()->createUrl('//order/index',array('Order[status]'=>'Shipped'))?>">Shipped Order</a></li>
						<li><a href="<?=Yii::app()->createUrl('//order/index',array('Order[status]'=>'Canceled'))?>">Canceled Order</a></li>
					</ul></li>
					<li><a href="javascript:;">Invoice</a>
						<ul>
						<li><a href="<?=Yii::app()->createUrl('//orderInvoice/index',array('OrderInvoice[payment_status]'=>'Due'))?>">Due</a></li>
						<li><a href="<?=Yii::app()->createUrl('//orderInvoice/index',array('OrderInvoice[payment_status]'=>'Paid'))?>">Paid</a></li>
						
					</ul></li>
					<?php 
						$profileData=Profile::model()->find("user_id=".Yii::app()->user->userId);
						if(count($profileData)==0)
							$proLink=Yii::app()->createUrl('//user/profileCreate');
						else
							$proLink=Yii::app()->createUrl('//user/profileUpdate',array('id'=>$profileData->id));
					?>
					<li><a href="<?= $proLink;?>">Profile</a></li>

					<li><a href="<?=Yii::app()->createUrl('//user/changePassword')?>">Change Password</a></li>
					<li><a href="<?=Yii::app()->createUrl('//site/logout')?>">Logout</a></li>
				</ul>
			</div>
			<?php } else{?>

			<div class="u-vmenu">
				<ul>
					<li><a href="<?=Yii::app()->createUrl('//user/dashboard')?>">212Poster</a></li>
					<?php 
						$profileData=Profile::model()->find("user_id=".Yii::app()->user->userId);
						if(count($profileData)==0)
							$proLink=Yii::app()->createUrl('//user/profileCreate');
						else
							$proLink=Yii::app()->createUrl('//user/profileUpdate',array('id'=>$profileData->id));
					?>
					<li><a href="<?= $proLink;?>">Profile</a></li>

					<li><a href="<?=Yii::app()->createUrl('//user/changePassword')?>">Change Password</a></li>
					<li><a href="<?=Yii::app()->createUrl('//site/logout')?>">Logout</a></li>
				</ul>
			</div>
			<?php } ?>

	</div>
</div>
<script>
	$(document).ready(function(){
		//alert(0);
	});
</script>
<style type="text/css" media="screen">
	.u-vmenu ul li.active{
		background-color: #000!important;
	}
</style>