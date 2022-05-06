<?php if(Yii::app()->controller->id=='eposterCategory'){?>
	<div class="widget-search md-30">
		<form method="GET" action="" id="submitFrom">
			<input name="q" class="form-control" placeholder="Search here..." type="text" value="<?php if(isset($_GET['q']) && $_GET['q']!='')echo $_GET['q'];?>">
			<button type="submit"> <i class="fa fa-search"></i> </button>
		</form>
	</div>
	<?php } ?>
	<div class="widget-ct widget-categories mb-30">
		<div class="widget-s-title">
			<h4>Category </h4>
		</div>
		<div class="widget-info" style="width:100%; display:inline-block;">
			<div class="u-vmenu">
				<ul>
					<?php
					foreach ($data['model'] as $row212Poster):
						?>
						<li><a href="<?= EposterList::model()->makeLink($row212Poster->id); ?>" data-rel="<?= $row212Poster->name ?>">
							<?= $row212Poster->name ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</div>

<!--<div class="widget-ct widget-size mb-30">
<div class="widget-s-title">
<h4>Size</h4>
</div>
<div class="widget-info size-filter clearfix">
<ul>
<li><a href="#">M</a></li>
<li class="active"><a href="#">S</a></li>
<li><a href="#">L</a></li>
<li><a href="#">SL</a></li>
<li><a href="#">XL</a></li>
</ul>
</div>
</div>
<div class="widget-ct widget-banner">
<div class="widget-info widget-banner-img">
<a href="#"><img src="assets/img/banner-left.jpg" alt=""></a>
</div>
</div>-->
<script>
	$(document).ready(function(){
		//alert(0);
	});
</script>