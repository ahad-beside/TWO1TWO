<style>
    .paypal-success{
        text-align: center;
		font-size:24px;
    }
    .p-success i{
        color: #7ac142;
        font-size: 103px;
    }
    .processed{
        color:green;
        font-size: 28px;
    }
	.p_success_tbl{
		margin-top:20px;
		text-align:left;
	}
	.p_success_tbl table thead{
		background-color:#CCC;
	}
	.p_success_tbl table thead th{
		border:none;
	}
</style>

<div class="col-md-12">
	<div class="whitebox" style="padding:50px 0px;">
    <div class="col-md-6 col-md-offset-3">
        <div class="contentbg" style="padding: 20px 12px;">
            <div class="paypal-success">
                <div class="p-success"><i class="fa fa-check-circle"></i></div>
                <div class="">Your Payment was <span class="processed">successfully</span> processed!. <br />Here is your thansection ID. :<span style="color:green"> <?= $_GET['transaction'];?></span> Thanks.</div>
               </div>
                
                
                
                
                
                
                
                <div style="padding:7px 0px; margin-top:30px;">
                    
                    <div class="" role="group" aria-label="...">
  <a type="button" href="<?= $this->createUrl('//user/dashboard')?>" class="btn btn-primary">My Account</a>
  <a type="button" href="<?= $this->createUrl('//category/all')?>" class="btn btn-success">Continue Shopping</a>
</div>
                    
                </div>
            </div>
        </div>
    </div>
    </div>
</>