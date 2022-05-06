<div class="container">
        <div class="row">
        <div class="col-md-3 col-sm-6">
            <div class="block-subscribe">
              <h3 class="widget-title">About Us</h3>
             <!--  <p>Quisque a nunc interdum tellus placerat cursus. Quisque facilisis dapibus facilisis! Vivamus dictum lectus ut porta volutpat.</p>
              <p>Quisque a nunc interdum tellus placerat cursus.</p> -->

              <?php 
              $footerAbout=Page::model()->find("id=1");
               echo Yii::app()->easycode->getExcerpt($footerAbout->description,0,200); 
              ?>
            </div>
          </div>
          
          <div class="col-md-3 col-sm-6">
            <h3 class="widget-title">Company</h3>
            <ul>
              <?php 
                $footerMenuLeft=Menu::model()->findAll("position='Footer Menu Left' and parent is Null and status='1' order by sort_order");
                foreach($footerMenuLeft as $rowFooter):
              ?>
              <li><a href="<?= Menu::model()->makeLink($rowFooter->id) ?>"><?= $rowFooter->name;?></a></li>
            <?php endforeach;?>
            </ul>
          </div>
          
          <div class="col-md-3 col-sm-6">
            <h3 class="widget-title">Resources</h3>
            <ul>
              <?php 
                $footerMenuRight=Menu::model()->findAll("position='Footer Menu Right' and parent is Null and status='1' order by sort_order");
                foreach($footerMenuRight as $rowFooter):
              ?>
               <li><a href="<?= Menu::model()->makeLink($rowFooter->id) ?>"><?= $rowFooter->name;?></a></li>
            <?php endforeach;?>
            </ul>
          </div>
          
          <div class="col-md-3 col-sm-6">
            <div class="contact-us">
              <h3 class="widget-title">Contact Us</h3>
              <?=Page::model()->find("id=6")->description;?>
              <!-- <ul class="contact-list">
                <li><i class="icon-home"></i> <span>212 Communications
1110 University Ave. Suite 404
Honolulu, HI 96826 USA</span></li>
                <li><i class="icon-call-out"></i> <span>808-520-0124</span></li>
                <li><i class="icon-envelope"></i> <span>info@212com.com</span></li>
              </ul> -->
            </div>
          </div>
          
        </div>
      </div>

      <div class="footer-login"><a target="_blank" href="http://galaxy.signage.me/WebService/signagestudio.aspx?mode=login&v=4&eri=f7bee07a7e79c8f1d7951b4d24de4713c22f150f56bf6978"><img src="<?php echo Yii::app()->theme->baseUrl ?>/assets/images/login.png"></a></div>

      <style type="">
      	.footer-login{position: fixed; float: left; left: 0; top: 60%;}
      </style>