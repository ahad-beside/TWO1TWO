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
			<h4>212Poster </h4>
		</div>
		<div class="widget-info" style="width:100%; display:inline-block;">
			<!-- <div class="u-vmenu">
				<ul> -->
					<table class="table-hover table table-striped">
						<tbody>
							<?php
					foreach ($data['model'] as $row212Poster):
						if($data['name']==$row212Poster->slug)
							$select='selectedRow';
						else
							$select='';
						?>
						<!-- <li> -->
							
						<tr class="clickable-row <?=$select?>" data-href="<?= EposterList::model()->makeLink($row212Poster->id);?>">
								<td>
									<a href="<?= EposterList::model()->makeLink($row212Poster->id); ?>" data-rel="<?= $row212Poster->name ?>">
							<?= $row212Poster->name ?>
							</a>
						</td>
								<td><a href="<?= EposterList::model()->makeLink($row212Poster->id); ?>" data-rel="<?= $row212Poster->name ?>">
							<?= date('F',strtotime($row212Poster->expire_date)) ?>
							</a></td>
								<td><a href="<?= EposterList::model()->makeLink($row212Poster->id); ?>" data-rel="<?= $row212Poster->name ?>">
							<?= date('Y',strtotime($row212Poster->expire_date)) ?>
							</a></td>
							</tr>
							
					<!-- </li> -->
				<?php endforeach; ?>
							
						</tbody>
					</table>
					
			<!-- </ul>
		</div> -->
	</div>
</div>
<script>
  jQuery(document).ready(function(){    
    $(".clickable-row").click(function() {        
      window.location = $(this).data("href");    
});
});
</script>
<style type="text/css" media="screen">
	.clickable-row{
		cursor: pointer!important;
	}
	.selectedRow td{
		background-color: #999!important;
	}
</style>