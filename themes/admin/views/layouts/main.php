<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <?php include_once 'headerAssets.php';?>
    </head>
    <!-- END HEAD -->

    <body class="page-container-bg-solid">
        <div class="page-wrapper">
            <div class="page-wrapper-row">
                <div class="page-wrapper-top">
                    <!-- BEGIN HEADER -->
                    <div class="page-header">
                        <!-- BEGIN HEADER TOP -->
                        <?php include_once 'headerTop.php';?>
                        <!-- END HEADER TOP -->
                        <!-- BEGIN HEADER MENU -->
                        <?php include_once 'headerNav.php';?>
                        <!-- END HEADER MENU -->
                    </div>
                    <!-- END HEADER -->
                </div>
            </div>
            <!-- <script type='text/javascript'>jQuery(document).ready(function () {UIToastr.init('success','sdsddasd','Success');});</script> -->

            <?php echo Yii::app()->easycode->showToaster(); ?>
            <?= $content?>
            <div class="page-wrapper-row">
                <div class="page-wrapper-bottom">
                    <!-- BEGIN FOOTER -->
                    <!-- BEGIN PRE-FOOTER -->
                    <?php //include_once 'footerPre.php';?>
                    <!-- END PRE-FOOTER -->
                    <!-- BEGIN INNER FOOTER -->
                    <?php include_once 'footerInner.php';?>
                    <!-- END INNER FOOTER -->
                    <!-- END FOOTER -->
                </div>
            </div>
        </div>
        <?php include_once 'footerAssets.php';?>
    </body>

</html>