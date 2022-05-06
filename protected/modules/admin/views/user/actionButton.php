<div class="btn-group" style="padding-top: 10px;">
        <button data-toggle="dropdown" class="btn btn-sm blue dropdown-toggle" type="button"><i class='fa fa-cogs'></i> Actions
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul role="menu" class="dropdown-menu">
            <li>

            <?php
            echo CHtml::ajaxLink("<i class='fa fa-check-square-o'></i> Active", Yii::app()->createUrl('//admin/user/active'), array(

                'cache' => true,

                'type' => 'POST',

                'data' => 'js:{value : $.fn.yiiGridView.getChecked("grid-view-data","actionCheck[]")}',

                "beforeSend" => 'js:function(){

                                            var ask = confirm("Are you sure want to active this user?");

                                            if(ask==false){

                                                return false;

                                            }

                                        }',

                'success' => 'js:function(data){
                                            $.fn.yiiGridView.update("grid-view-data");
                                            getCountTotal();
                                            data = $.parseJSON (data);

                                            if(data.msg=="success"){
                                                getCountTotal();
                                                //alert();
                                                jQuery(document).ready(function () {
                UIToastr.init("success",data.totalOrders + " Users active successfully.");
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
                echo CHtml::ajaxLink("<i class='fa fa-times-circle-o'></i> Inactive", Yii::app()->createUrl('//admin/user/inActive'), array(
                    'cache' => true,
                    'type' => 'POST',
                    'data' => 'js:{value : $.fn.yiiGridView.getChecked("grid-view-data","actionCheck[]")}',
                    "beforeSend" => 'js:function(){

                                            var ask = confirm("Are you sure want to inactive this user?");

                                            if(ask==false){

                                                return false;

                                            }

                                        }',

                    'success' => 'js:function(data){

                    //alert(data);
                        getCountTotal();

                                            $.fn.yiiGridView.update("grid-view-data");
                                            getCountTotal();
                                            data = $.parseJSON (data);

                                            if(data.msg=="success"){

                                                //alert();
                                                if(data.totalDue==0){
                                                showAlert("success",data.totalOrders + " Users inactive successfully.");
                                                }else if(data.totalOrders==0){
                                                showAlert("danger",data.totalDue + " Error!!!.");
                                                }else{
                                                jQuery(document).ready(function () {
                UIToastr.init("success",data.totalOrders + " Users inactive successfully.");
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
        </ul>
    </div>