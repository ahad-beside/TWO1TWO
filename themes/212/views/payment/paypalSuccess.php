<style>
    .paypal-success{
        text-align: center;
    }
    .p-success i{
        color: #7ac142;
        font-size: 103px;
    }
    .processed{
        color:green;
        font-size: 24px;
    }
</style>

<div class="container">
    <div class="col-md-12">
        <div class="contentbg" style="padding: 20px 12px;">
            <div class="paypal-success">
                <div class="p-success"><i class="fa fa-check-circle"></i></div>
                <div class="processed">Your Payment was successfully processed!</div>
                <?php //print_r($_POST);?>
                <div>You have just paid to <?= Yii::app()->params->companyName?> <?php /*number_format($_POST['payment_gross'],Yii::app()->params->decimalPoint);*/echo "50.00SGD"?> for <b>Order No. <?//= Order::model()->findByPk($_POST['custom'])->order_number?></b> as of <?//= date("d-m-Y", strtotime($_POST['payment_date']))?>.</div>
                
                
                <div style="padding:7px 0px;">
                    
                    <div class="btn-group" role="group" aria-label="...">
  <button type="button" class="btn btn-primary">My Account</button>
  <button type="button" class="btn btn-primary">Go to Order List</button>
  <a type="button" href="<?= $this->createUrl('//category/all')?>" class="btn btn-primary">Continue Shopping</a>
</div>
                    
                </div>
            </div>
        </div>
    </div>
</div>