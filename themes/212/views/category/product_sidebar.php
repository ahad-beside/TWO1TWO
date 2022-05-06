<div class="widget-search md-30">
  <form method="GET" action="" id="submitFrom">
    <input name="q" class="form-control" placeholder="Search here..." type="text" value="<?php if(isset($_GET['q']) && $_GET['q']!='')echo $_GET['q'];?>">
    <button type="submit"> <i class="fa fa-search"></i> </button>
  </form>
</div>
<div class="widget-ct widget-categories mb-30">
  <div class="widget-s-title">
    <h4>Category </h4>
  </div>
  <div class="widget-info" style="width:100%; display:inline-block;">
    
    
    <!--<div class="u-vmenu">
				<ul>
					<li>
						<a href="#">Item 1</a>
						<ul>
							<li><a href="#">Subitem 1</a>
							</li>
							<li>
								<a href="#">Subitem 2</a>
								<ul>
									<li><a href="#">Subitem 1</a>
										<ul>
											<li><a href="#">Subitem 1</a>
											</li>
											<li><a href="#">Subitem 2</a>
											</li>
											<li><a href="#">Subitem 3</a>
											</li>
											<li><a href="#">Subitem 4</a>
											</li>
										</ul>
									</li>
									<li><a href="#">Subitem 2</a>
									</li>
									<li><a href="#">Subitem 3</a>
									</li>
									<li><a href="#">Subitem 4</a>
									</li>
								</ul>
							</li>
							<li><a href="#">Subitem 3</a>
							</li>
							<li>
								<a href="#">Subitem 4</a>
								<ul>
									<li><a href="#">Subitem 1</a>
									</li>
									<li><a href="#">Subitem 2</a>
									</li>
								</ul>
							</li>
							<li><a href="#">Subitem 5</a>
							</li>
						</ul>
					</li>
					<li><a href="#">Item 2</a>
						<ul>
							<li><a href="#">Subitem 1</a>
							</li>
							<li><a href="#">Subitem 2</a>
							</li>
							<li><a href="#">Subitem 3</a>
							</li>
							<li><a href="#">Subitem 4</a>
							</li>
						</ul>
					</li>
					<li><a href="#">Item 3</a>
						<ul>
							<li><a href="#">Subitem 1</a>
							</li>
							<li><a href="#">Subitem 2</a>
							</li>
							<li><a href="#">Subitem 3</a>
							</li>
							<li><a href="#">Subitem 4</a>
							</li>
							<li><a href="#">Subitem 5</a>
							</li>
							<li><a href="#">Subitem 6</a>
							</li>
						</ul>
					</li>
					<li><a href="#">Item without subitems</a>
					</li>
				</ul>
			</div>-->
    
    
     <div class="u-vmenu">
      <ul>
        <li><a href="<?= Yii::app()->createUrl('//category/all');?>" class="ol" data-rel="All">All</a></li>
        <?php
            if ($name != '') {
                $tagname = explode('.', $name);
                $catName = Category::model()->getCategoryNameForExpand($tagname[0]);
            }
            $parent = Products::model()->getProductParent();
            foreach ($parent as $parentName):
                $filter = '';
                if ($_GET['filter']) {
                    $param = explode('?', $_SERVER['REQUEST_URI']);
                    $filter = '?' . $param[1];
                }
                $child = Products::model()->getProductChild($parentName->id);
                ?>
        <li><a href="<?= Category::model()->makeLinkNew($parentName->id) . $filter; ?>" data-rel="<?= $parentName->name ?>">
          <?= $parentName->name ?>
          </a>
          <ul <?php if ($catName == $parentName->name) { ?>style="display:block;"<?php } ?>>
            <?php foreach ($child as $childName): ?>
            <li><a class="<?php if ($childName->slug == $tagname[0]) echo 'active'; ?>" href="<?= Category::model()->makeLinkNew($childName->id) . $filter; ?>">
              <?= $childName->name ?>
              </a></li>
            <?php endforeach; ?>
          </ul>
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