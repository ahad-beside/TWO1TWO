<style>
    .pageerror{
        padding:20px;
        text-align: center;
    }
    .sorry{
        color: #666666;
        font-size: 24px;
        font-family: "oswaldregular",Arial,Helvetica,sans-serif !important;
        margin-top: 7px;
    }
    .pageerrormsg{
        padding: 4px;
        color: #333;
    }
</style>
<div class="col-md-12">
    <div class="whitebox" style="padding:20px 0px;">
        <div class="contentbg pageerror">
            <div><img src="<?php echo Yii::app()->theme->baseUrl ?>/assets/images/unhappy.png"/></div>
            <div class="sorry">Something went wrong!!!<br /> Please <a href="<?php echo Yii::app()->createUrl('//site/contact') ?>">contact</a> with us. Thanks.</div>
<!--            <div class="pageerrormsg">ou can select a different billing option bellow. </div>-->
            <div style="padding:7px 0px;">
                    <div class="btn-group" role="group" aria-label="...">
                        <!--<button type="button" class="btn btn-primary">My Account</button>-->
                        <a type="button" href="<?= $this->createUrl('//category/all')?>" class="btn btn-success">Continue Shopping</a>&nbsp;&nbsp;
                        <?php 
                        if(isset($_GET['id']))
                            {
                                $arrayId=explode('.',$_GET['id']);
                                $id=$arrayId[0];
                            }else{
                                $id='';
                            }
                            ?>
                        <a type="button" href="<?= $this->createUrl('//payment/payNow/order/success/id/'.$id)?>" class="btn btn-primary">Try Again</a>
                        <!--<button type="button" class="btn btn-primary">Pay Now</button>-->
</div> 
                </div>
        </div>
    </div>
</div>
