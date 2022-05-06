<div class="row">

    <div class="clearfix">&nbsp;</div>
    <div class="col-md-12"><?php echo Yii::app()->easycode->showNotification(); ?></div>

    <div class="manualOrder">
        <div class="col-md-12" style="text-align: right">
            <?php $srt = strtolower($this->action->id); ?>
            <div class="btn-group">
                <a href="<?= $this->createUrl('create') ?>" class="btn btn-default <?= ($srt == 'create') ? 'active' : ''; ?>"><i class="fa fa-plus"></i> Create</a>
                <a href="<?= $this->createUrl('index') ?>" class="btn btn-default <?= ($srt == 'index') ? 'active' : ''; ?>"><i class="fa fa-list"></i> List</a>
            </div>
        </div>

        <div class="clearfix">&nbsp;</div>
        <form method="post" id="manualOrder">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-bar-chart-o fa-fw"></i> Order
                            </div>
                            <div class="panel-body row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="OrderNumber">Order Number</label>
                                        <div class="order_number"><?php echo $on = $data['order']->order_number ?></div>
                                        <input type="hidden" name="order_number" value="<?= $on ?>">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="OrderNumber">Order Date</label>
                                        <div class='input-group date' id='datetimepicker1'>
                                            <?php
                                            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                                'name' => 'order_date',
                                                'value' => date("d-F-Y",strtotime($data['order']->order_date)),
                                                'options' => array(
                                                    'showAnim' => 'fold',
                                                    'dateFormat' => 'dd-MM-yy',
                                                    'changeMonth' => true,
                                                    'changeYear' => true
                                                ),
                                                'htmlOptions' => array(
                                                    'class' => 'form-control',
                                                ),
                                            ));
                                            ?>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="OrderNumber">Select Currency</label>
                                        <select class="form-control" name="currency">
                                            <?php
                                            $getCurrency = Currency::model()->findAll();
                                            foreach ($getCurrency as $cr):
                                                $sel='';
                                                if(strtolower($cr->label) == $data['order']->currency){
                                                    $sel = 'selected="selected"';
                                                }
                                                echo '<option '.$sel.' value="' . strtolower($cr->label) . '">' . $cr->label . '</option>';
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row customer_panel">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-user"></i> Customer 
                            </div>
                            <div class="panel-body row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="OrderNumber" style="width:100%">Choose Customer <div class="newUser">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">+ Add</button>
                                            </div></label>
                                        <?php echo Chtml::dropDownList('customer', $data['order']->user_id_fk, User::model()->customerListAsArray(), array('class' => 'form-control chosen-select', 'empty' => 'Select customer')) ?>
                                        <div class="customer_error error" style="display:none"></div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="row billing_panel">
                    <div class="col-lg-12">
                        <div class="panel panel-default bilshipload">
                            <div class="panel-heading">
                                <i class="fa fa-user"></i> Billing &AMP; Shipping Information 
                            </div>



                            <div class="panel-body billshiploadhere">
                                
                            </div>
                            <!-- /.panel-body -->

                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default add-form">
                            <div class="panel-heading">
                                <i class="fa fa-bar-chart-o fa-fw"></i> Product 
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div>
                                        <div class="col-md-12">
                                            
                                            
                                    <div class="alert alert-danger submit-error" style="display:none"></div>
                                    <div class="alert alert-success" style="display: none"></div>
                                            
                                            <div class="form-group">
                                                <label for="OrderNumber">Choose Product Type</label>
                                                <div class="alltypeOrder">

                                                    <?php 
                                                    $customProduct=  CustomProduct::model()->findAll();
                                                    foreach ($customProduct as $rowProduct):
                                                    ?>
                                                    <button type="button" class="btn btn-primary product <?php if($rowProduct->id==1){?>selected btn-success<?php } ?>" data-id="<?=$rowProduct->id?>" onclick="loadCustomizedProductType(<?=$rowProduct->id?>);
                                                            loadCustomizedProductSize(<?=$rowProduct->id?>);"><i class="fa fa-check checkshow" <?php if($rowProduct->id!=1){?>style="display:none;"<?php } ?>></i> <?=$rowProduct->name?></button>
                                                            <?php endforeach;?>
<!--                                                    <button type="button" class="btn btn-primary product" data-id="2" onclick="loadCustomizedProductType(2);
                                                            loadCustomizedProductSize(2);"><i class="fa fa-check checkshow" style="display:none;"></i> Lanyards</button>

                                                    <button type="button" class="btn btn-primary product" data-id="3" onclick="loadCustomizedProductType(3);
                                                            loadCustomizedProductSize(3);"> <i class="fa fa-check checkshow" style="display:none;"></i> Tyvek</button>
                                                            <button type="button" class="btn btn-primary product" data-id="8" onclick="loadCustomizedProductType(8);
                                                            loadCustomizedProductSize(8);"> <i class="fa fa-check checkshow" style="display:none;"></i> Vinyl Wristbands</button>
                                                    <button type="button" class="btn btn-primary product" data-id="4" onclick="loadCustomizedProductType(4);
                                                            loadCustomizedProductSize(4);"><i class="fa fa-check checkshow" style="display:none;"></i> Koozies</button>-->
                                                    <button type="button" class="btn btn-primary product" data-id="0" onclick="loadRegularProducts();"> <i class="fa fa-check checkshow" style="display:none;"></i> Regular Products</button>
                                                </div>
                                            </div>
                                        </div>
                                        <script>
                                            $('.product').click(function () {

                                                if ($(this).attr('data-id') == '0') {
                                                    if ($('.addedArtwork').length > 0) {
                                                        if (confirm('Regular product not allowed artwork, are you sure to remove all artworks?')) {
                                                            $('#remove-all-artwork').trigger('click');
                                                        } else {
                                                            return false;
                                                        }
                                                    }
                                                    $('.dropzone-container').hide();
                                                } else {

                                                    if ($('.addedArtwork').length > 0) {
                                                        $('input[class="form-control pro"]').val($(this).attr('data-id'));
                                                    }
                                                    $('.dropzone-container').show();
                                                }

                                                $(this).parent().find('.product').removeClass('selected');
                                                $(this).parent().find('.product').removeClass('btn-success');
                                                $(this).addClass('selected');
                                                $(this).addClass('btn-success');
                                                $('.checkshow').hide();
                                                $(this).find('.checkshow').show();
                                            });
                                        </script>



                                    </div>
                                    <div>

                                        <!---------new design--------->
                                        <div class="col-lg-6">
                                            <div class="row">
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="OrderNumber">Product Name</label>
                                                        <select class="form-control chosen-select" id="product-type"></select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="OrderNumber">Size</label>
                                                        <select class="form-control chosen-select" id="product-size"></select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">


                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="OrderNumber">Quantity</label>
                                                        <input type="text" class="form-control" id="qty" placeholder="Quantity">
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="OrderNumber">Unit Price</label>
                                                        <input type="text" class="form-control" id="unit_price" placeholder="Price">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="OrderNumber">Total Price</label>
                                                        <input type="text" class="form-control" id="total_price" placeholder="Price">
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <textarea id="notes" class="form-control" rows="3" placeholder="Notes - Extra options, color, additional options etc"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="">
                                                <div class="manualorderbtn"><a href="javascript:void(0)" class="btn btn-success" id="add-row"><i class="fa fa-plus-circle"></i> ADD</a></div>
                                            </div>

                                            <script>
                                                $('#add-row').on('click', function () {
                                                    var artworks = '[';
                                                    if ($('.addedArtwork').length > 0) {
                                                        $('.addedArtwork').each(function () {
                                                            var ardata = '{file:"' + $(this).find('.file').val() + '",product:' + $(this).find('.product').val() + ',pro:' + $(this).find('.pro').val() + '},';

                                                            artworks = artworks + ardata;
                                                        });
                                                        artworks = artworks + ']';
                                                    }

                                                    if (artworks == '') {
                                                        if (confirm('Are you sure to add this product without artwork?') == false) {
                                                            return false;
                                                        }
                                                    }

                                                    var product = '0';
                                                    var productType = $('#product-type');
                                                    var productTypeLabel = $('#product-type :selected').text();

                                                    var productSize = $('#product-size');
                                                    var productSizeLabel = $('#product-size :selected').text();

                                                    var qty = $('#qty');
                                                    var unitPrice = $('#unit_price');
                                                    var totalPrice = $('#total_price');
                                                    var notes = $('#notes').val().trim();


                                                    $('.product').each(function () {
                                                        if ($(this).hasClass('selected')) {
                                                            product = $(this).attr('data-id');
                                                        }
                                                    });

                                                    var dangerMsg = $('.add-form').find('.alert-danger');
                                                    var successMsg = $('.add-form').find('.alert-success');

                                                    if (product == 0) {
                                                        if (productType.val().trim() == '' || qty.val().trim() == '' || unitPrice.val().trim() == '' || totalPrice.val().trim() == '') {
                                                            successMsg.hide();
                                                            dangerMsg.show();
                                                            dangerMsg.html('All filed must be filled');
                                                            return false;
                                                        } else {
                                                            dangerMsg.hide();
                                                            addLoading('.add-form');
                                                            $.post('<?= $this->createUrl('genIndProRow') ?>', {product: product, productTypeLabel: productTypeLabel, productType: productType.val().trim(), qty: qty.val().trim(), unitPrice: unitPrice.val().trim(), totalPrice: totalPrice.val().trim(), notes: notes, artworks: artworks}, function (data) {
                                                                $('#pro-added').prepend(data);
                                                                getProTotal();
                                                                removeLoading('.add-form');
                                                                resetAddForm();
                                                                successMsg.show();
                                                                successMsg.html('Product successfully added');
                                                                return false;
                                                            });
                                                        }
                                                    } else if (product == 3) {
                                                        if (productType.val().trim() == '' || qty.val().trim() == '' || unitPrice.val().trim() == '' || totalPrice.val().trim() == '') {
                                                            dangerMsg.hide();
                                                            dangerMsg.show();
                                                            dangerMsg.html('All filed must be filled');
                                                            return false;
                                                        } else {
                                                            dangerMsg.hide();
                                                            addLoading('.add-form');
                                                            $.post('<?= $this->createUrl('genIndProRow') ?>', {product: product, productType: productType.val().trim(), productTypeLabel: productTypeLabel, qty: qty.val().trim(), unitPrice: unitPrice.val().trim(), totalPrice: totalPrice.val().trim(), notes: notes, artworks: artworks}, function (data) {
                                                                $('#pro-added').prepend(data);
                                                                removeLoading('.add-form');
                                                                successMsg.show();
                                                                successMsg.html('Product successfully added');
                                                                getProTotal();
                                                                resetAddForm();
                                                                return false;
                                                            });
                                                        }
                                                    } else {
                                                        if (productType.val().trim() == '' || productSize.val().trim() == '' || qty.val().trim() == '' || unitPrice.val().trim() == '' || totalPrice.val().trim() == '') {
                                                            dangerMsg.hide();
                                                            dangerMsg.show();
                                                            dangerMsg.html('All filed must be filled');
                                                            return false;
                                                        } else {
                                                            dangerMsg.hide();
                                                            addLoading('.add-form');
                                                            $.post('<?= $this->createUrl('genIndProRow') ?>', {product: product, productType: productType.val().trim(), productTypeLabel: productTypeLabel, productSizeLabel: productSizeLabel, productSize: productSize.val().trim(), qty: qty.val().trim(), unitPrice: unitPrice.val().trim(), totalPrice: totalPrice.val().trim(), notes: notes, artworks: artworks}, function (data) {
                                                                $('#pro-added').prepend(data);
                                                                removeLoading('.add-form');
                                                                successMsg.show();
                                                                successMsg.html('Product successfully added');
                                                                getProTotal();
                                                                resetAddForm();
                                                                return false;
                                                            });
                                                        }
                                                    }
                                                    return false;
                                                });
                                            </script>

                                        </div>
                                        <div class="col-lg-6 dropzone-container">
                                            <label>Artwork</label>

                                            <div class="form-group dropupload">
                                                <?php
                                                $artworkModel = new OrderArtwork;
                                                $this->widget('ext.dropzone.EDropzone', array(
                                                    'model' => $artworkModel,
                                                    'attribute' => 'artwork',
                                                    'name' => 'artwork',
                                                    'url' => $this->createUrl('//admin/order/artworkUpload'),
                                                    'mimeTypes' => array('application/pdf'),
                                                    'onSuccess' => 'makeFieldForArtwork(file.name, response)',
                                                    'options' => array('autoProcessQueue' => true, 'maxFilesize' => 10, 'maxFiles' => 500, 'parallelUploads' => 500, 'addRemoveLinks' => true, 'processing' => "js:function(file,done){
                                                    $('#add-row').attr('disabled','disabled');
                                                    }", 'removedfile' => "js:function(file,done){
                                      var ask = true;//confirm('Are you sure to remove this '+ file.name +'?');
                                      if(ask==true){
                                        var source = $('.artworks').find('input[data-mil=\"'+ file.name.replace(/[^A-Z0-9]+/ig, '_') +'\"]');
                                        source.parent().remove();
                                        
                                      }else{
                                        return false;
                                      }
                                      var _ref;
                                      return (ref = file.previewElement) != null ? ref.parentNode.removeChild(file.previewElement) : void 0;
                                      }"),
                                                ));
                                                ?>
                                                <button type="button" id="remove-all-artwork" style="display:none">Remove All Artwork</button>
                                                <strong style="font-size: 12px">Only PDF file allowed for upload</strong>
                                            </div>
                                        </div>

                                        <div class="artworks">

                                        </div>
                                        <script>
                                            function makeFieldForArtwork(filename, res) {
                                                $('#add-row').removeAttr('disabled');
                                                var product = $('#product-type').val();
                                                var pro = $('.alltypeOrder').find('button[class="btn btn-primary product selected btn-success"]').attr('data-id');

                                                var field = '<div class="addedArtwork">';
                                                field = field + '<input type="hidden" name="artworkHidden[]" data-mil="' + filename.replace(/[^A-Z0-9]+/ig, "_") + '" class="form-control file" value="' + res + '">';
                                                field = field + '<input type="hidden" name="product[]" class="form-control product" value="' + product + '">';
                                                field = field + '<input type="hidden" name="pro[]" class="form-control pro" value="' + pro + '">';
                                                field = field + '</div>';
                                                $('.artworks').append(field);
                                            }


                                        </script>


                                        <!----------------new design end-------->





                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>





                <div class="row">

                    

                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-bar-chart-o fa-fw"></i> Product List 
                            </div>
                            <div class="panel-body row">
                                <div class="col-md-12">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr class="cart_menu">
                                                <th>Product Name</th>
                                                <th>Size</th>
                                                <th>Artwork</th>
                                                <th>Qty</th>
                                                <th align="right" style="text-align: right;">Unit</th>
                                                <th align="right" style="text-align: right;">Total</th>
                                                <th style="text-align: center">Remove</th>
                                            </tr>
                                        </thead>
                                        <tbody id="pro-added">
                                            <?php
                                            if(count($data['orderCustomProduct'])>0):
                                                foreach($data['orderCustomProduct'] as $customProduct):
                                                $this->renderPartial('genIndProRowUpdate',array('data'=>$customProduct,'orderInfo'=>$data['order']));
                                                endforeach;
                                            endif;
                                            
                                            if(count($data['orderProducts'])>0):
                                                foreach($data['orderProducts'] as $orderProduct):
                                                $this->renderPartial('genIndProRowRegularUpdate',array('data'=>$orderProduct));
                                                endforeach;
                                            endif;
                                            ?>
                                        </tbody>
                                        <tfoot id='pro-total'></tfoot>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row">
                    
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="OrderNumber">Bank</label>
                            <select class="form-control" name="bankName">
                                <option value="">Choose Bank</option>
                                <?php
                                $getBank = Bank::model()->findAll(array('order' => 'sort_order'));
                                foreach ($getBank as $production):
                                    $sel='';
                                    if($production->id==$data['order']->bank_id){
                                        $sel = 'selected="selected"';
                                    }
                                    echo '<option '.$sel.'  value="' . $production->id . '">' . $production->bank_name . ' - ' . $production->account_number . '</option>';
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="OrderNumber">Production Time</label>
                            <select class="form-control" name="productionTime">
                                <?php
                                $getProduction = CustomProductionShipping::model()->findAll('status=1 and type="Production" order by sort_order');
                                foreach ($getProduction as $production):
                                    echo '<option  value="' . $production->id . '">' . $production->name . '</option>';
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="OrderNumber">Shipping Time</label>
                            <select class="form-control" name="shippingTime">
                                <?php
                                $getShipping = CustomProductionShipping::model()->findAll('status=1 and type="Shipping" order by sort_order');
                                foreach ($getShipping as $shipping):
                                    echo '<option value="' . $shipping->id . '">' . $shipping->name . '</option>';
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-2">

                    </div>
                    <div class="col-sm-1">&nbsp;</div>
                </div>
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9">
                        (Note: Production and shipping time price calculation will not generate here)
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="OrderNumber">Order Note</label>
                            <textarea rows="2" name="orderNote" id="orderNote" class="form-control" placeholder="Order Related Note"><?= $data['order']->order_note?></textarea>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <input type="hidden" id="totalAmount">
                        <div style="text-align:center; margin-top: 35px;"><button class="btn btn-success btn-lg" type="submit"><i class="fa fa-arrow-circle-right"></i> Update Order </button></div>
                    </div>
                </div>
        </form>
    </div>
</div>
</div>

<!-- Modal for customer entry form -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Customer</h4>
            </div>
            <div class="modal-body">

                <form method="post" action="#" id="customer-entry-form">
                    <p class="note">Fields with <span class="required">*</span> are required.</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="User_first_name">Full Name <span class="required" style="color:red">*</span></label>
                                <input type="text" id="User_first_name" name="User[first_name]" class="form-control" maxlength="50" size="50">
                                <div class="error error_first_name"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="User_email">Email <span class="required">*</span></label>
                                <input type="text" id="User_email" name="User[email]" class="form-control" maxlength="50" size="50">
                                <div class="error error_email"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="User_password">Password <span class="required">*</span></label>
                                <input type="password" id="User_password" name="User[password]" class="form-control" maxlength="50" size="50">
                                <div class="error error_password"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="User_repeatpassword">Repeat Password <span class="required">*</span></label>
                                <input type="password" id="User_repeatpassword" name="User[repeatpassword]" class="form-control" maxlength="50" size="50">
                                <div class="error error_repeatpassword"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="User_active">Active <span class="required">*</span></label>
                                <select id="User_active" name="User[active]" class="form-control">
                                    <option selected="selected" value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <div class="error error_active"></div>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary create-customer">Create</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).on("click", "a.upload-artwork-row", function (e) {
        e.preventDefault();
        $.colorbox({
            open: true,
            href: $(this).attr('href'),
            iframe: true,
            width: "50%",
            height: "600",
            overlayClose: false
        });

        return false;
    });

    $('.create-customer').click(function (e) {
        e.preventDefault();
        $('.error').html('');
        var form = $('#customer-entry-form');

        $.post('<?= $this->createUrl("//admin/user/createCustomer") ?>', form.serializeArray(), function (data) {
            datas = JSON.parse(data);
            if (datas.res == 'failed') {
                $.each(datas.errors, function (index, value) {
                    $('.error_' + index).html(value);
                });
            } else {
                var option = '<option value="' + datas.id + '" selected="selected">' + datas.value + '</option>';
                $('select#customer').append(option);
                $('select#customer').trigger("chosen:updated");
                $('#myModal').modal('hide');
                form.find("input[type=text]").val("");
                getBillingNShipping(datas.id);
            }
        });
    });
</script>
<!-- Modal -->





<script type="text/javascript">
    function loadRegularProducts() {
        addLoading('.add-form');
        $.post('<?= $this->createUrl('loadRegularProducts') ?>', {}, function (data) {
            $('select#product-type').html(data);
            $('select#product-type').trigger("chosen:updated");

            $('select#product-size').html('');
            $('select#product-size').attr('disabled', 'disabled');
            $('select#product-size').trigger("chosen:updated");

            removeLoading('.add-form');
        });
    }

    $('#product-type').change(function () {
        if ($('.addedArtwork').length > 0) {
            $('input[class="form-control product"]').val($(this).val());
        }
    });
    
    

    function loadCustomizedProductType(id) {
        addLoading('.add-form');
        $.post('<?= $this->createUrl('loadCustomizedProductType') ?>', {id: id}, function (data) {
            $('select#product-type').html(data);
            $('select#product-type').trigger("chosen:updated");

            if (id == '3') {
                $('select#product-size').html('');
                $('select#product-size').attr('disabled', 'disabled');
                $('select#product-size').trigger("chosen:updated");
            }

            removeLoading('.add-form');
        });
    }

    function loadCustomizedProductSize(id) {
        addLoading('.add-form');
        $('select#product-size').removeAttr('disabled');
        $.post('<?= $this->createUrl('loadCustomizedProductSize') ?>', {id: id}, function (data) {
            $('select#product-size').html(data);
            $('select#product-size').trigger("chosen:updated");
            removeLoading('.add-form');
        });
    }

    function calPrice() {
        var qty = $('#qty').val().trim();
        var unitPrice = $('#unit_price').val().trim();
        var totalPrice = $('#total_price').val().trim();

        if (qty != '' && unitPrice != '') {
            totalPrice = parseFloat(unitPrice) * parseInt(qty);
            $('#total_price').val(totalPrice.toFixed(2));
        } else if (qty != '' && totalPrice != '') {
            unitPrice = parseFloat(totalPrice) / parseInt(qty);
            $('#unit_price').val(unitPrice.toFixed(2));
        }
    }

    $('#qty').keyup(function () {
        var str = $(this).val();
        var newval = str.replace(/[^0-9]+/ig, '');
        $(this).val(newval);
        calPrice();
    });

    $('#unit_price').keyup(function () {
        $('#total_price').val('');

        var str = $(this).val();
        var newval = str.replace(/[^0-9.]+/ig, '');
        $(this).val(newval);

        calPrice();
    });

    $('#total_price').keyup(function () {
        $('#unit_price').val('');

        var str = $(this).val();
        var newval = str.replace(/[^0-9.]+/ig, '');
        $(this).val(newval);

        calPrice();
    });

    $(document).ready(function () {
        loadCustomizedProductType(1);
        loadCustomizedProductSize(1);
        getProTotal();
    });
    
    $('#customer').change(function(){
       getBillingNShipping($(this).val());
       $('.customerIdInput').val($(this).val());
       if(parseInt($(this).val())>0){
           $('.customer_error').html('');
           $('.customer_error').hide();
       }
    });
    
    function getBillingNShipping(custId,mode){
        $('.billing_panel').show();
        if(typeof custId !='undefined' && parseInt(custId)>0){
            addLoading('.bilshipload');
            $.post('<?= $this->createUrl('getBillingNShipping')?>',{custId: custId},function(data){
                $('.billshiploadhere').html(data);
                removeLoading('.bilshipload');
                if(typeof mode!='undefined' && mode=='update'){
                    $('input[name="billingInfoPk"]').val('<?= $data['billingId']?>');
                    $('input[name="shippingInfoPk"]').val('<?= $data['shippingId']?>')
                }
            });
        }
    }

    function rmrow(types, $this) {
        if (confirm('Are you sure to delete ' + types)) {
            $this.parent().parent().remove();
            getProTotal();
        }
    }

    function getProTotal() {
        if ($('.productRow').length > 0) {
            var total = 0;
            $('.productTotalPrice_added').each(function () {
                total = parseFloat(total) + parseFloat($(this).val().trim());
            });

            $('#totalAmount').val(total.toFixed(2));

            var trow = '<tr><td align="right" colspan="5"><strong>Total</strong></td><td align="right"><strong>' + total.toFixed(2) + '</strong></td><td style="text-align: center">&nbsp;</td></tr>';
            $('#pro-total').html(trow);

            if ($('.no_products').length > 0) {
                $('.no_products').remove();
            }
            return false;
        } else {
            $('#pro-added').html('<tr class="no_products"><td colspan="7" style="text-align:center; font-weight: bold; font-size:16px">Opps! No products added yet.</td></tr>');
            $('#pro-total').html('');
            return false;
        }
    }

    function resetAddForm() {
        $('.add-form').find('input[type="text"]').val('');
        $('.add-form').find('select').val('');
        $('.add-form').find('textarea').val('');
        $('.add-form').find('select').trigger("chosen:updated");
        $('#remove-all-artwork').trigger('click');
        return false;
    }

    $('body').on("click", ".del-single-artwork", function () {
        if (confirm('Are you sure to delete "' + $(this).attr('data-file') + '" artwork')) {
            $(this).parent().remove();
        }
    });



    $('#manualOrder').submit(function () {
        var am = $('#totalAmount').val().trim();
        var customer = $('#customer').val();

        if (customer == '') {
            $('.customer_error').show();
            $('.customer_error').html('Please choose customer first');
            $('body').scrollTo($('.customer_panel'), 800);
            return false;
        } else if (chkBillingShippingValidation() == false) {
            $('.customer_error').html('');
            $('.customer_error').hide();
            return false;
        } else if (am == '' || parseFloat(am) < 1) {
            $('.customer_error').hide()
            $('.customer_error').html('');
            $('.errorBillShip').hide();

            $('.submit-error').show();
            $('.submit-error').html('Minimum one product required');
            return false;
        }
    });
    
    function chkBillingShippingValidation() {
        var chkerror=0;
        $('.billing').each(function(){
            if($(this).val().trim()==''){
                chkerror = parseInt(chkerror) + 1;
            }
        });
        $('.shipping').each(function(){
            if($(this).val().trim()==''){
                chkerror = parseInt(chkerror) + 1;
            }
        });
        if(parseInt(chkerror)>0){
            $('.errorBillShip').show();
            $('.errorBillShip').html('All fields are mendatory in billing and shipping section');
            return false;
        }else{
            return true;
        }
    }
    
    function chkBillingValidation() {
        var name = $('.chkName').val().trim();
        var address = $('.chkAddress').val().trim();
        var city = $('.chkCity').val().trim();
        var country = $('.chkCountry').val().trim();
        var post = $('.chkPost').val().trim();
        var phone = $('.chkPhone').val().trim();

        var nameS = $('.chkNameS').val().trim();
        var addressS = $('.chkAddressS').val().trim();
        var cityS = $('.chkCityS').val().trim();
        var countryS = $('.chkCountryS').val().trim();
        var postS = $('.chkPostS').val().trim();
        var phoneS = $('.chkPhoneS').val().trim();

        if (name == '' || address == '' || city == '' || country == '' || post == '' || phone == '' || nameS == '' || addressS == '' || cityS == '' || countryS == '' || postS == '' || phoneS == '') {
            $('.errorBillShip').show();
            $('.errorBillShip').html("All Billing and shipping information are mendatory");
            $('body').scrollTo($('.billing_panel'), 800);
            return false;
        } else {
            $('.errorBillShip').css('display', 'none');
            return true;
        }
    }
    $('body').on("keyup", ".billing", function () {
        if ($("#same_as_bill").is(':checked')) {
        sameBillAs();
    }
    });

    $('body').on("change", ".billing", function () {
        if ($("#same_as_bill").is(':checked')) {
        sameBillAs();
    }
    });
    $('body').on("click", "#same_as_bill", function () {
        if ($("#same_as_bill").is(':checked')) {
        sameBillAs();
    }else{
        getBillingNShipping('<?= $data['order']->user_id_fk?>','update');
            $('input[name="ShippingInfo[name]"]').removeAttr("readonly");
            $('textarea[name="ShippingInfo[street_address]"]').removeAttr("readonly");
            $('input[name="ShippingInfo[city]"]').removeAttr("readonly");
            $('input[name="ShippingInfo[pincode]"]').removeAttr("readonly");
            $('input[name="ShippingInfo[phone]"]').removeAttr("readonly");
            $('select[name="ShippingInfo[country]"]').removeAttr("readonly"); 
    }
    });
    //$('body').on("click", "#same_as_bill", function () {
    function sameBillAs() {
        if ($("#same_as_bill").is(':checked')) {
            $('input[name="ShippingInfo[name]"]').val($('input[name="BillingInfo[name]"]').val().trim());
            $('textarea[name="ShippingInfo[street_address]"]').val($('textarea[name="BillingInfo[street_address]"]').val().trim());
            $('input[name="ShippingInfo[city]"]').val($('input[name="BillingInfo[city]"]').val().trim());
            $('input[name="ShippingInfo[pincode]"]').val($('input[name="BillingInfo[pincode]"]').val().trim());
            $('input[name="ShippingInfo[phone]"]').val($('input[name="BillingInfo[phone]"]').val().trim());
            $('select[name="ShippingInfo[country]"]').val($('select[name="BillingInfo[country]"]').val().trim());
            
            $('input[name="ShippingInfo[name]"]').attr("readonly","readonly");
            $('textarea[name="ShippingInfo[street_address]"]').attr("readonly","readonly");
            $('input[name="ShippingInfo[city]"]').attr("readonly","readonly");
            $('input[name="ShippingInfo[pincode]"]').attr("readonly","readonly");
            $('input[name="ShippingInfo[phone]"]').attr("readonly","readonly");
            $('select[name="ShippingInfo[country]"]').attr("readonly","readonly");
        } else {
            $('input[name="ShippingInfo[name]"]').val($('input[name="ShippingInfo[name]"]').attr('data-value'));
            $('textarea[name="ShippingInfo[street_address]"]').val($('textarea[name="ShippingInfo[street_address]"]').attr('data-value'));
            $('input[name="ShippingInfo[city]"]').val($('input[name="ShippingInfo[city]"]').attr('data-value'));
            $('input[name="ShippingInfo[pincode]"]').val($('input[name="ShippingInfo[pincode]"]').attr('data-value'));
            $('input[name="ShippingInfo[phone]"]').val($('input[name="ShippingInfo[phone]"]').attr('data-value'));
            $('select[name="ShippingInfo[country]"]').val($('select[name="ShippingInfo[country]"]').attr('data-value'));
        }
    }
    //});

</script>

<script type="text/javascript">
    $('body').on('keyup','.productQty_added',function(e){
        e.preventDefault();
        var qty = $(this).val().trim();
        var unit = $(this).parent().parent().find('.productUnitPrice_added').val().trim();
        var cal = parseFloat(unit) * parseInt(qty);
        var total = $(this).parent().parent().find('.productTotalPrice_added').val(cal.toFixed(2));
        getProTotal();
    });
    
    $('body').on('keyup','.productUnitPrice_added',function(e){
        e.preventDefault();
        var qty = $(this).parent().parent().find('.productQty_added').val().trim();
        var unit = $(this).val().trim();
        var cal = parseFloat(unit) * parseInt(qty);
        var total = $(this).parent().parent().find('.productTotalPrice_added').val(cal.toFixed(2));
        getProTotal();
    });
    
    $('body').on('keyup','.productTotalPrice_added',function(e){
        e.preventDefault();
        var qty = $(this).parent().parent().find('.productQty_added').val().trim();
        var total = $(this).val().trim();
        var cal = parseFloat(total) / parseInt(qty);
        var unit = $(this).parent().parent().find('.productUnitPrice_added').val(cal.toFixed(2));
        getProTotal();
        
    });
    
    
</script>


<?php if($data['order']->user_id_fk>0):?>
<script type="text/javascript">
    $(document).ready(function(){
       getBillingNShipping('<?= $data['order']->user_id_fk?>','update');
    });
</script>
<?php endif;?>

<?php /*
 * <div class="new_address">
                                    <div class="col-md-6"><button type="button" class="btn btn-primary btn-xs"><i class="fa fa-database"></i> Choose from existing</button></div>
                                    <div class="clearfix">&nbsp;</div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="OrderNumber" style="width:100%">Billing Information</label>
                                            <div class="form-group">
                                                <label for="exampleInputName2">Name</label>
                                                <input type="text" name="BillingInfo[name]" class="form-control chkName" placeholder="Name">
                                                <div class="error" id="name_em_"></div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName2">Address</label>
                                                <textarea rows="2" name="BillingInfo[street_address]" class="form-control chkAddress" placeholder="Address"></textarea>
                                                <div class="error" id="street_address_em_"></div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label for="exampleInputName2">City</label>
                                                    <input type="text" name="BillingInfo[city]" class="form-control chkCity" placeholder="Type your city">
                                                    <div class="error" id="city_em_"></div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="exampleInputName2">Post Code</label>
                                                    <input type="text" name="BillingInfo[pincode]" class="form-control chkPost" placeholder="Post Code">
                                                    <div class="error" id="pincode_em_"></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label for="exampleInputName2">Country</label>
                                                    <select id="BillingInfo_country" name="BillingInfo[country]" class="form-control chkCountry">
                                                        <?php
                                                        $country = Country::model()->findAll();
                                                        foreach ($country as $cc):
                                                            echo '<option value="' . $cc->id . '">' . $cc->name . '</option>';
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                    <div class="error" id="country_em_"></div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="exampleInputName2">Phone</label>
                                                    <input type="text" name="BillingInfo[phone]" class="form-control chkPhone" placeholder="Phone">
                                                    <div class="error" id="phone_em_"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="OrderNumber" style="width:100%">Shipping Information &nbsp; &nbsp; &nbsp; <input checked="" type="checkbox" value="" id="same_as_bill"><span style="font-size:11px; padding-left: 3px;">Same as billing</span></label>

                                            <div class="form-group">

                                                <div class="form-group">
                                                    <label for="exampleInputName2">Name</label>
                                                    <input type="text" name="ShippingInfo[name]" class="form-control chkNameS" placeholder="Name">
                                                    <div class="error" id="name_em_"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName2">Address</label>
                                                    <textarea rows="2" name="ShippingInfo[street_address]" class="form-control chkAddressS" placeholder="Address"></textarea>
                                                    <div class="error" id="street_address_em_"></div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label for="exampleInputName2">City</label>
                                                        <input type="text" name="ShippingInfo[city]" class="form-control chkCityS" placeholder="Type your city">
                                                        <div class="error" id="city_em_"></div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="exampleInputName2">Post Code</label>
                                                        <input type="text" name="ShippingInfo[pincode]" class="form-control chkPostS" placeholder="Post Code">
                                                        <div class="error" id="pincode_em_"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label for="exampleInputName2">Country</label>
                                                        <select id="ShippingInfo_country" name="ShippingInfo[country]" class="form-control chkCountryS">
                                                            <?php
                                                            foreach ($country as $cc):
                                                                echo '<option value="' . $cc->id . '">' . $cc->name . '</option>';
                                                            endforeach;
                                                            ?>

                                                        </select>
                                                        <div class="error" id="country_em_"></div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="exampleInputName2">Phone</label>
                                                        <input type="text" name="ShippingInfo[phone]" class="form-control chkPhoneS" placeholder="Phone">
                                                        <div class="error" id="phone_em_"></div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
 */?>