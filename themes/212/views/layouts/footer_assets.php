<script type="text/javascript" src="<?= Yii::app()->baseUrl ?>/filemanager/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?= Yii::app()->theme->baseUrl?>/assets/js/bootstrap.min.js"></script>

<script type="text/javascript" src="<?= Yii::app()->theme->baseUrl?>/assets/js/owl.carousel.min.js"></script>

<script type="text/javascript" src="<?= Yii::app()->theme->baseUrl?>/assets/js/ion.rangeSlider.js"></script>

<script type="text/javascript" src="<?= Yii::app()->theme->baseUrl?>/assets/js/classie.js"></script>    

<script type="text/javascript" src="<?= Yii::app()->theme->baseUrl?>/assets/js/slick.min.js"></script>

<script type="text/javascript" src="<?= Yii::app()->theme->baseUrl?>/assets/js/jquery.slicknav.js"></script>

<script type="text/javascript" src="<?= Yii::app()->theme->baseUrl?>/assets/js/mansory.js"></script> 

<script type="text/javascript" src="<?= Yii::app()->theme->baseUrl?>/assets/js/main.js"></script>

<script type="text/javascript" src="<?= Yii::app()->theme->baseUrl?>/assets/js/paralax.js"></script>

<script src="<?= Yii::app()->theme->baseUrl ?>/assets/lightbox-master/dist/ekko-lightbox.js"></script>

<script>

	initParalaxBg();

</script>    



<script type="text/javascript">		

	

		var slider = new MasterSlider();

		slider.setup('masterslider' , {

			width:1024,

			height:768,

			space:5,

			view:'fade',

			autofill:true,

			speed:20

		});

		

		slider.control('arrows' ,{insertTo:'#masterslider'});	

		slider.control('bullets');	



		var wrapper = $('#slider1-wrapper');

		wrapper.height(window.innerHeight - 56);

		$(window).resize(function(event) {

			wrapper.height(window.innerHeight - 56);

		});





		$('#myTab a').click(function (e) {

		  e.preventDefault()

		  $(this).tab('show')

		});



		SyntaxHighlighter.all();

		

	</script>

    

<!--collapsable menu-->

<script type="text/javascript" src="<?= Yii::app()->theme->baseUrl?>/assets/js/vmenuModule.js"></script>

		<script type="text/javascript">

			$(document).ready(function() {

				$(".u-vmenu").vmenuModule({

					Speed: 200,

					autostart: false,

					autohide: true

				});

			});

		</script>

        

        



<script>

	   $(".incr-btn").on("click", function (e) {

        var $button = $(this);

        var oldValue = $button.parent().find('.quantity').val();

        $button.parent().find('.incr-btn[data-action="decrease"]').removeClass('inactive');

        if ($button.data('action') == "increase") {

            var newVal = parseFloat(oldValue) + 1;

        } else {

            // Don't allow decrementing below 1

            if (oldValue > 1) {

                var newVal = parseFloat(oldValue) - 1;

            } else {

                newVal = 1;

                $button.addClass('inactive');

            }

        }

        $button.parent().find('.quantity').val(newVal);

        e.preventDefault();

    });

</script>

<script type="text/javascript">

    updateMiniCart();

    updateCartCountAmount();

</script>

    

<script>

  $('#addtocartbutton').click(function (e) {

        e.preventDefault();

        var subscription=$('.selectSubscription').val();

        if(subscription!=''){

        var $obj = $(this);

        $obj.attr('disabled', 'disabled');

        var errors = false;

        $('.option-product').each(function () {

            if ($(this).hasClass('required') && $(this).val().trim() == ''){

                errors = true;

                $(this).next('.error').show();

                $obj.removeAttr('disabled', 'disabled');

            }

        });

        if (errors === false){

            $.post('<?php echo Yii::app()->createUrl('//cart/add'); ?>', $('#addtocart').serialize(), function (data) {

                if (data == '1') {

                     window.location = '<?php echo Yii::app()->createUrl('//cart/checkout'); ?>';

                    //umayalsolike('<?= $model->id ?>', '.umayalsolike');

                    /*$('.product_add_success').html('Product successfully added into cart <a class="btn btn-sm btn-primary" href="<? //= $this->createUrl('//cart/checkout')?>">Checkout Now</a> or <a class="btn btn-sm btn-primary" href="<? //= $_SERVER['HTTP_REFERER']?>">Continue Shopping</a>');*/

                    //$('.product_add_success').show();

                    $obj.removeAttr('disabled', 'disabled');

                    $('#addtocart')[0].reset();

                    $('.img-option').removeClass('option-active');

                    $('.error').hide();

                    updateMiniCart();

                    updateCartCountAmount();



                    //hide product container

                    $('.product-container').show();

                    removeLoading('.product-details');



                    /* Open auto matick after add a product */

                    // if (!$('#minicart-wrapper').find('.cartcontentmove').hasClass('Moved')) {

                    //     $('.wristcart').trigger('click');

                    // }

                    /* /Open auto matick after add a product */

                }

            });

        } else {

            removeLoading('.product-details');

        }

    }else{

        $('.errorMessage').html('Please Choose Subscription');

        return false;

    }

    });

  $(document).on('change','.selectSubscription',function(){

    var subscription=$(this).val();

    if(subscription!='')

        $('.errorMessage').html('');

    var servicePrice=$('.servicePrice').attr('data-price');

    //alert(servicePrice);

    $.post('<?= Yii::app()->createUrl('//service/getSubscriptionPrice')?>',{subscription:subscription,servicePrice:servicePrice},function(data){

        data=$.parseJSON(data);

        $('.subscriptionPrice').html('Total: $'+data.price);

        $('.servicePrice').val(data.price);

        $('.sebscriptionMonth').val(data.totalMonth);

    });

  });

</script>

  </body>

</html>