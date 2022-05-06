<div class="widget-search md-30">
  <form method="GET" action="" id="submitFrom">
    <input name="q" class="form-control" placeholder="Search here..." type="text" value="<?php if(isset($_GET['q']) && $_GET['q']!='')echo $_GET['q'];?>">
    <button type="submit"> <i class="fa fa-search"></i> </button>
  </form>
</div>
<div class="widget-ct widget-categories mb-30">
  <div class="widget-s-title">
    <h4>Service Category </h4>
  </div>
  <div class="widget-info" style="width:100%; display:inline-block;">
     <div class="u-vmenu">
      <ul>
        <li><a href="<?= Yii::app()->createUrl('//serviceCategory/all');?>" class="ol" data-rel="All">All</a></li>
        <?php
            if ($name != '') {
                $tagname = explode('.', $name);
                $catName = ServiceCategory::model()->getCategoryNameForExpand($tagname[0]);
            }
            $parent = Service::model()->getProductParent();
            foreach ($parent as $parentName):
                $filter = '';
                if ($_GET['filter']) {
                    $param = explode('?', $_SERVER['REQUEST_URI']);
                    $filter = '?' . $param[1];
                }
                $child = Service::model()->getProductChild($parentName->id);
                ?>
        <li><a href="<?= ServiceCategory::model()->makeLinkNew($parentName->id) . $filter; ?>" data-rel="<?= $parentName->name ?>">
          <?= $parentName->name ?>
          </a>
          <ul <?php if ($catName == $parentName->name) { ?>style="display:block;"<?php } ?>>
            <?php foreach ($child as $childName): ?>
            <li><a class="<?php if ($childName->slug == $tagname[0]) echo 'active'; ?>" href="<?= ServiceCategory::model()->makeLinkNew($childName->id) . $filter; ?>">
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