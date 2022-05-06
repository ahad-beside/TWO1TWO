<div class="btn-group" style="padding-top: 10px;">
        <button data-toggle="dropdown" class="btn btn-sm blue dropdown-toggle" type="button"><i class='fa fa-cogs'></i> Actions
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul role="menu" class="dropdown-menu">
            <li>

            <?php

            echo CHtml::ajaxLink("<i class='fa fa-check-square-o'></i> Pending", Yii::app()->createUrl('//admin/settings/pending'), array(

                'cache' => true,

                'type' => 'POST',

                'data' => 'js:{value : $.fn.yiiGridView.getChecked("job-view-data","actionCheck[]")}',

                "beforeSend" => 'js:function(){

                                            var ask = confirm("Are you sure want to send into Pending?");

                                            if(ask==false){

                                                return false;

                                            }

                                        }',

                'success' => 'js:function(data){
                                            $.fn.yiiGridView.update("job-view-data");
                                            getCountTotal();
                                            data = $.parseJSON (data);

                                            if(data.msg=="success"){

                                                //alert();
                                                jQuery(document).ready(function () {
                UIToastr.init("success",data.totalOrders + " Review send to pending list successfully.");
            });
                                            }else if(data.msg=="error"){

                                                //alert("Error occured !!!");
                                                jQuery(document).ready(function () {
                UIToastr.init("danger","Error occured !!!");
            });
                                            }
                                        }',
                'error' => 'js:function(data){

                                            alert("Problem occured !!!");

                                            //alert(JSON.stringify(data));

                                            //alert("e"+data.msg);

                                        }',

                    ), array('class' => 'btn btn-xs', 'style' => 'text-align:left;color:black; font-weight:normal;', 'id' => 'pendingOrder'));
            ?>
        </li>
            <li>
                <?php
                echo CHtml::ajaxLink("<i class='fa fa-check-square-o'></i> Confirmed", Yii::app()->createUrl('//admin/settings/confirmed'), array(
                    'cache' => true,
                    'type' => 'POST',
                    'data' => 'js:{value : $.fn.yiiGridView.getChecked("job-view-data","actionCheck[]")}',
                    "beforeSend" => 'js:function(){

                                            var ask = confirm("Are you sure want to confirm this Review?");

                                            if(ask==false){

                                                return false;

                                            }

                                        }',

                    'success' => 'js:function(data){

                    //alert(data);

                                            $.fn.yiiGridView.update("job-view-data");
                                            getCountTotal();
                                            data = $.parseJSON (data);

                                            if(data.msg=="success"){

                                                //alert();

                                                if(data.totalDue==0){

                                                showAlert("success",data.totalOrders + " Review confirmed successfully.");

                                                }else if(data.totalOrders==0){

                                                showAlert("danger",data.totalDue + " Orders not confirmed because of due.");

                                                }else{

                                                jQuery(document).ready(function () {
                UIToastr.init("success",data.totalOrders + " Orders confirmed successfully.");
            });

                                                }


                                            }else if(data.msg=="error"){

                                                //alert("Error occured !!!");
                                                jQuery(document).ready(function () {
                UIToastr.init("danger","Error occured !!!");
            });

                                            }

                                        }',

                    'error' => 'js:function(data){

                                            alert("Problem occured !!!");

                                            //alert(JSON.stringify(data));

                                            //alert("e"+data.msg);

                                        }',

                        ), array('class' => 'btn btn-xs', 'style' => 'text-align:left;color:black; font-weight:normal;', 'id' => 'confirmOrder'));

                ?>

            </li>
            <li>

                <?php

                echo CHtml::ajaxLink("<i class='fa fa-times-circle-o'></i> Canceled", Yii::app()->createUrl('//admin/settings/canceled'), array(
                    'cache' => true,
                    'type' => 'POST',
                    'data' => 'js:{value : $.fn.yiiGridView.getChecked("job-view-data","actionCheck[]")}',
                    "beforeSend" => 'js:function(){

                                            var ask = confirm("Are you sure want to cancel?");
                                            if(ask==false){
                                                return false;
                                            }

                                        }',

                    'success' => 'js:function(data){

                                            $.fn.yiiGridView.update("job-view-data");
                                            getCountTotal();
                                            data = $.parseJSON (data);

                                            if(data.msg=="success"){

                                                //alert(data.totalOrders + " Orders calceled successfully.");
                                                jQuery(document).ready(function () {
                UIToastr.init("success",data.totalOrders + " Review calceled successfully.");
            });

                                            }else if(data.msg=="error"){

                                                //alert("Error occured !!!");
                                                jQuery(document).ready(function () {
                UIToastr.init("danger","Error occured !!!");
            });

                                            }

                                        }',

                    'error' => 'js:function(data){

                    //alert(JSON.stringify(data))

                                            alert("Problem occured !!!");

                                            //alert(JSON.stringify(data));

                                            //alert("e"+data.msg);

                                        }',

                        ), array('class' => 'btn btn-xs', 'style' => 'text-align:left;color:black; font-weight:normal;', 'id' => 'canceledOrder' . rand(1, 999)));
                ?>
            </li>
        </ul>
    </div>