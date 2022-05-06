<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="Ecommerce">
<script type="text/javascript" src="<?= Yii::app()->theme->baseUrl?>/assets/js/jquery-min.js"></script>
<title><?= $this->pageTitle;?></title>

<!-- Favicon -->
<link rel="shortcut icon" href="<?= Yii::app()->theme->baseUrl?>/assets/img/favicon.png">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl?>/assets/css/bootstrap.min.css" type="text/css">
<!-- Font Awesome CSS -->
<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl?>/assets/fonts/font-awesome.min.css" type="text/css">
<!-- Line Icons CSS -->
<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl?>/assets/fonts/line-icons/line-icons.css" type="text/css">
<!-- Main Styles -->
<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl?>/assets/css/main.css" type="text/css">

<!-- Stepy Style -->
<link href='<?= Yii::app()->theme->baseUrl?>/assets/css/stepy_style.css' rel='stylesheet' type='text/css'>

<!-- Animate CSS -->
<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl?>/assets/extras/animate.css" type="text/css">
<!-- Owl Carousel -->
<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl?>/assets/extras/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl?>/assets/extras/owl.theme.css" type="text/css">
<!-- Slick Css -->
<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl?>/assets/css/slick.css" type="text/css">
<!-- Mansory Css -->
<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl?>/assets/css/mansory.css" type="text/css">

<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl?>/assets/css/slick-theme.css" type="text/css">
<!-- Slicknav Css -->
<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl?>/assets/css/slicknav.css" type="text/css">
<!-- Responsive CSS Styles -->
<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl?>/assets/css/responsive.css" type="text/css">
<!-- Telenor CSS Styles -->
<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl?>/assets/css/telenor.css" type="text/css">
<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl?>/assets/css/bootstrap_form.css" type="text/css">
<!-- Base MasterSlider style sheet -->
<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl?>/assets/masterslider/style/masterslider.css" />
<!-- Master Slider Skin -->


<!-- Master Slider Skin -->
<link href="<?= Yii::app()->theme->baseUrl?>/assets/masterslider/skins/default/style.css" rel='stylesheet' type='text/css'>


<link href='<?= Yii::app()->theme->baseUrl?>/assets/masterslider/style/ms-fullscreen.css' rel='stylesheet' type='text/css'>

<!-- Master Slider -->
<script src="<?= Yii::app()->theme->baseUrl?>/assets/masterslider/masterslider.min.js"></script>

<!--Collapse Menu -->
<link rel="stylesheet" type="text/css" href="<?= Yii::app()->theme->baseUrl?>/assets/css/vmenuModule.css" />

<script type="text/javascript" src="<?= Yii::app()->theme->baseUrl?>/assets/js/my-custom.js"></script>
<script type="text/javascript" src="<?= Yii::app()->theme->baseUrl?>/assets/js/review.js"></script>
<link href="<?= Yii::app()->theme->baseUrl ?>/assets/lightbox-master/dist/ekko-lightbox.css" rel="stylesheet">
</head>
<body>
<script>
    function updateMiniCart() {
        $.post("<?= Yii::app()->createUrl('//cart/updateMiniCart') ?>", {}, function (data) {
            //$("#cart-content").html(data);
            $('#mini-cart-details').html(data);
        });
    }
    function updateCartCountAmount() {
        $.post("<?= Yii::app()->createUrl('//cart/countItemsAmount') ?>", {}, function (data) {
            data = JSON.parse(data);

            //$('#mini-item-total').html(data.totalItems + ' item(s) ' + data.totalAmounts);
            $('#mini-item-total').html(data.totalItems);
            // if (typeof shake === 'undefined')
            //     shakeStart();
        });
    }
    $(document).ready(function () {
        $('body').on('click', '.rmitem', function () {
            var $obj = $(this);
            if (confirm('Are you sure to delete?') == true) {
                $.post('<?= Yii::app()->createUrl('//cart/dell/') ?>', {id: $obj.attr('data-id')}, function (data) {
                    if (data == 1) {
                        updateMiniCart();
                        updateCartCountAmount();
                    }
                });
            } else {
                return false;
            }
        });
    });
</script>
<script>
    function forgotPassword() { 
        $('#forgotspin').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>');
        var emailid = $('#frgt_paswd_email_id').val().trim();
        if (emailid === '') {
            $('#frgt_paswd_email_id').focus();
            $('#forgotspin').html('Recover Password');
            return false;
        } else {
            $.post('<?php echo Yii::app()->createUrl('//user/forgotPasswordLink') ?>', {email: emailid}, function (data) {
                data = jQuery.parseJSON(data);
                if (data.status == 0) {
                    $('#msg_forgotpass').css('color', 'red');
                    $('#forgotspin').html('Recover Password');
                } else {
                    $('#msg_forgotpass').css('color', 'green');
                    $('#frgt_paswd_email_id').val('');
                    $('#forgotspin').html('Recover Password');
                }
                $('#msg_forgotpass').html(data.msg);
            });
        }
    }
</script>