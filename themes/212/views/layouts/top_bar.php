<div class="top-bar">

  <div class="container">

    <div class="row">

      <div class="col-md-4 col-sm-2">

      </div>

      <div class="col-md-8 col-sm-10"> 

        <!-- shopping cart end -->

        <div class="shop-cart">

          <ul>

            <li> <a href="#" class="cart-icon cart-btn"><i class="icon-basket"></i><span class="cart-label" id="mini-item-total">0</span></a>

              <div class="cart-box">

                <div class="popup-container">

                  <div class="topcartresult" id="mini-cart-details">

                    <div class="wristscroll scrollcontent">No Products.</div>

                  </div>

                </div>

              </div>

            </li>

          </ul>

        </div>

        <?php if(isset(Yii::app()->user->userId)){?>
          
         <div class="account link-inline"> <a href="<?=Yii::app()->createUrl('//site/logout')?>"><span class="">Logout</span></a> </div>
          <div class="box-currency">

            <div class="btn-group toggle-wrap"> <span class="toggle"> <?=Yii::app()->user->userFirstname;?> </span>

              <ul class="toggle_cont pull-right">

                <li>

                 <a href="<?=Yii::app()->createUrl('//user/dashboard')?>">My Account</a>

               </li>

               <li>

                 <a href="<?=Yii::app()->createUrl('//site/logout')?>">Logout</a>

               </li>

             </ul>

           </div>

         </div>
         <?php } else {?>

         <div class="account link-inline"> <a href="<?php echo Yii::app()->createUrl('//site/login'); ?>"><span class="">Login</span></a> </div>

         <div class="account link-inline"> <a href="<?php echo Yii::app()->createUrl('//site/registration'); ?>"><span class="">Register</span></a> </div>

         <?php } ?>

       </div>

     </div>

   </div>

 </div>

