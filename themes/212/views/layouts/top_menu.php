<div class="container">

  <div class="row">

    <div class="navbar-header"> 

      <!-- Stat Toggle Nav Link For Mobiles -->

      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <i class="fa fa-bars"></i> </button>

      <a class="navbar-brand" href="<?= Yii::app()->homeUrl;?>"> <img src="<?= $this->siteLogo?>" style="height: 61px;width: auto;" /> </a> </div>

    <div class="navbar-collapse collapse"> 
      <!-- Start Navigation List -->
      <ul class="nav navbar-nav navbar-right">
        <li> <a href="<?= Yii::app()->homeUrl;?>"> Home </a> </li>
    <?php
      $topMenu = Menu::model()->findAll("position='Top Menu' and parent is Null and status='1' order by sort_order");
       foreach ($topMenu as $top):
    ?>

        <li> <a href="<?= Menu::model()->makeLink($top->id) ?>"><?php echo $top->name ?></a></li>

        <?php endforeach ?>

      </ul>

      <!-- End Navigation List --> 

    </div>

  </div>

</div>

<!-- End Header Logo & Naviagtion --> 



<!-- Mobile Menu Start -->

<ul class="mobile-menu">

  <li><a class="active" href="<?= Yii::app()->homeUrl;?>"> Home </a>

    <!--<ul class="dropdown">

      <li> <a class="active" href="#">demo</a> </li>

      <li> <a href="#">demo 2</a> </li>

    </ul>-->

  </li>

   <?php

       foreach ($topMenu as $top):

    ?>

  <li> <a href="<?= Menu::model()->makeLink($top->id) ?>"><?php echo $top->name ?></a> </li>

  <?php endforeach ?>

  

</ul>

<!-- Mobile Menu End -->