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
        <form method="post" action="<?= $this->createUrl('create') ?>" id="manualOrder">
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
                                        <div class="order_number"><?php echo $on = Order::model()->genOrderNumber('WS'); ?></div>
                                        <input type="hidden" name="order_number" value="<?= $on ?>">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="OrderNumber">Order Date</label>

                                        <div class='input-group date' id='datetimepicker1'>
                                            <?php
                                            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                                'name' => 'order_date',
                                                'value' => date("d-F-Y"),
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
                                        <?php echo Chtml::dropDownList('customer', '', User::model()->customerListAsArray(), array('class' => 'form-control chosen-select', 'empty' => 'Select customer')) ?>
                                        <div class="customer_error error" style="display:none"></div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="row billing_panel" style="display:none">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-user"></i> Billing &AMP; Shipping Information 
                            </div>



                            <div class="panel-body">
                                <div class="existing_address">
                                    <div class="col-md-12 errorBillShip" style="display:none"></div>
                                    <div class="col-md-6" style="padding-top:12px;">
                                        <label for="OrderNumber">Billing Information</label>
                                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#billingModal"><i class="fa fa-plus"></i> Add</button>
                                        <select size="5" style="width: 100%; padding: 6px; display: none" name="billing_id"></select>
                                        <div class="errorBilling" style="display:none"></div>
                                    </div>

                                    <div class="col-md-6" style="padding-top:12px;">
                                        <label for="OrderNumber">Shipping Information</label>
                                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#shippingModal"><i class="fa fa-plus"></i> Add</button>
                                        <select size="5" style="width: 100%; padding: 6px; display: none" name="shipping_id"></select>
                                        <div class="errorShipping"></div>
                                    </div>
                                </div>
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

                                                    <button type="button" class="btn btn-primary product selected btn-success" data-id="1" onclick="loadCustomizedProductType(1);
                                                            loadCustomizedProductSize(1);"><i class="fa fa-check checkshow"></i> Wristbands</button>
                                                    <button type="button" class="btn btn-primary product" data-id="2" onclick="loadCustomizedProductType(2);
                                                            loadCustomizedProductSize(2);"><i class="fa fa-check checkshow" style="display:none;"></i> Lanyards</button>

                                                    <button type="button" class="btn btn-primary product" data-id="3" onclick="loadCustomizedProductType(3);"> <i class="fa fa-check checkshow" style="display:none;"></i> Tyvek</button>
                                                    <button type="button" class="btn btn-primary product" data-id="4" onclick="loadCustomizedProductType(4);
                                                            loadCustomizedProductSize(4);"><i class="fa fa-check checkshow" style="display:none;"></i> Koozies</button>
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
                                    echo '<option  value="' . $production->id . '">' . $production->bank_name . ' - ' . $production->account_number . '</option>';
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
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="OrderNumber">Order Note</label>
                            <textarea rows="2" name="orderNote" id="orderNote" class="form-control" placeholder="Order Related Note"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <input type="hidden" id="totalAmount">
                        <div style="text-align:center; margin-top: 35px;"><button class="btn btn-success btn-lg" type="submit"><i class="fa fa-arrow-circle-right"></i> Create Order </button></div>
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

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="User_email">Email <span class="required">*</span></label>
                                <input type="text" id="User_email" name="User[email]" class="form-control" maxlength="50" size="50">
                                <div class="error error_email"></div>
                            </div>
                        </div>
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

<!-- Start Billing Modal -->
<div class="modal fade" id="billingModal" tabindex="-1" role="dialog" aria-labelledby="billingModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Billing Information</h4>
            </div>
            <form method="post" action="#" id="billing-entry-form">
                <div class="modal-body">


                    <input type="hidden" name="BillingInfo[user_id_fk]" class="customerIdInput">
                    <p class="note">Fields with <span class="required">*</span> are required.</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="User_first_name">Full Name <span class="required" style="color:red">*</span></label>
                                <input type="text" id="BillingInfo_name" name="BillingInfo[name]" class="form-control" maxlength="50" size="50">
                                <div class="error error_name"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="BillingInfo_phone">Phone <span class="required">*</span></label>
                                <input type="text" id="BillingInfo_phone" name="BillingInfo[phone]" class="form-control" maxlength="50" size="50">
                                <div class="error error_phone"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="required" for="BillingInfo_street_address">Street Address <span class="required">*</span></label>
                                <textarea type="text" id="BillingInfo_street_address" name="BillingInfo[street_address]" class="form-control" rows="2"></textarea>
                                <div class="error error_street_address"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="BillingInfo_city">City <span class="required">*</span></label>
                                <input type="text" id="BillingInfo_city" name="BillingInfo[city]" class="form-control" maxlength="50" size="50">
                                <div class="error error_city"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="BillingInfo_pincode">Post Code <span class="required">*</span></label>
                                <input type="text" id="BillingInfo_pincode" name="BillingInfo[pincode]" class="form-control" maxlength="50" size="50">
                                <div class="error error_pincode"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="BillingInfo_country">Country <span class="required">*</span></label>
                                <?php
                                $countryList = Country::model()->findAll();
                                $htmlOptions = array('class' => 'form-control');
                                if (count($countryList) > 1):
                                    $htmlOptions['empty'] = 'Select Any';
                                endif;
                                echo CHtml::dropDownList('BillingInfo[country]', '', CHtml::listData($countryList, id, name), $htmlOptions);
                                ?>
                                <div class="error error_country"></div>
                            </div>
                        </div>
                    </div>



                </div>
                <div class="modal-footer">
                    <div class="col-md-6" style="text-align: left"><input type="checkbox" checked="checked" name="sameShipping" value="1"> Create Same Shipping</div>
                    <div class="col-md-6">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary create-billing">Create</button></div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.create-billing').click(function (e) {
        e.preventDefault();
        var custid = $('.customerIdInput').val();
        $('.error').html('');
        var form = $('#billing-entry-form');

        $.post('<?= $this->createUrl("//admin/user/createBillingInfo") ?>', form.serializeArray(), function (data) {
            datas = JSON.parse(data);
            if (datas.res == 'failed') {
                $.each(datas.errors, function (index, value) {
                    $('#billing-entry-form').find('.error_' + index).html(value);
                });
            } else {
                var option = '<option value="' + datas.id + '" selected="selected">' + datas.value + '</option>';
                $('select[name="billing_id"]').prepend(option);
                $('#billingModal').modal('hide');
                $('select[name="billing_id"]').show();
                $('.errorBilling').hide();
                $('#billing-entry-form').find('input[type="text"],select,textarea').val('');
                $('.customerIdInput').val(custid);

                if (typeof datas.shippingid != 'undefined') {
                    var option2 = '<option value="' + datas.shippingid + '" selected="selected">' + datas.value + '</option>';
                    $('select[name="shipping_id"]').prepend(option2);
                    $('#shippingModal').modal('hide');
                    $('select[name="shipping_id"]').show();
                    $('.errorShipping').hide();
                    $('#shipping-entry-form').find('input[type="text"],select,textarea').val('');
                    $('.customerIdInput').val(custid);
                }
            }
        });
    });
</script>
<!-- End Billing Modal -->

<!-- Start Shipping Modal -->
<div class="modal fade" id="shippingModal" tabindex="-1" role="dialog" aria-labelledby="shippingModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Shipping Information</h4>
            </div>
            <div class="modal-body">

                <form method="post" action="#" id="shipping-entry-form">
                    <input type="hidden" name="ShippingInfo[user_id_fk]" class="customerIdInput">
                    <p class="note">Fields with <span class="required">*</span> are required.</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="ShippingInfo_name">Full Name <span class="required" style="color:red">*</span></label>
                                <input type="text" id="ShippingInfo_name" name="ShippingInfo[name]" class="form-control" maxlength="50" size="50">
                                <div class="error error_name"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="ShippingInfo_phone">Phone <span class="required">*</span></label>
                                <input type="text" id="ShippingInfo_phone" name="ShippingInfo[phone]" class="form-control" maxlength="50" size="50">
                                <div class="error error_phone"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="required" for="ShippingInfo_street_address">Street Address <span class="required">*</span></label>
                                <textarea type="text" id="ShippingInfo_street_address" name="ShippingInfo[street_address]" class="form-control" rows="2"></textarea>
                                <div class="error error_street_address"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="ShippingInfo_city">City <span class="required">*</span></label>
                                <input type="text" id="ShippingInfo_city" name="ShippingInfo[city]" class="form-control" maxlength="50" size="50">
                                <div class="error error_city"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="ShippingInfo_pincode">Post Code <span class="required">*</span></label>
                                <input type="text" id="ShippingInfo_pincode" name="ShippingInfo[pincode]" class="form-control" maxlength="50" size="50">
                                <div class="error error_pincode"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="ShippingInfo_country">Country <span class="required">*</span></label>
                                <?php
                                $countryList = Country::model()->findAll();
                                $htmlOptions = array('class' => 'form-control');
                                if (count($countryList) > 1):
                                    $htmlOptions['empty'] = 'Select Any';
                                endif;
                                echo CHtml::dropDownList('ShippingInfo[country]', '', CHtml::listData($countryList, id, name), $htmlOptions);
                                ?>
                                <div class="error error_country"></div>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary create-shipping">Create</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.create-shipping').click(function (e) {
        e.preventDefault();
        var custid = $('.customerIdInput').val();
        $('.error').html('');
        var form = $('#shipping-entry-form');

        $.post('<?= $this->createUrl("//admin/user/createShippingInfo") ?>', form.serializeArray(), function (data) {
            datas = JSON.parse(data);
            if (datas.res == 'failed') {
                $.each(datas.errors, function (index, value) {
                    $('#shipping-entry-form').find('.error_' + index).html(value);
                });
            } else {
                var option = '<option value="' + datas.id + '" selected="selected">' + datas.value + '</option>';
                $('select[name="shipping_id"]').prepend(option);
                $('#shippingModal').modal('hide');
                $('select[name="shipping_id"]').show();
                $('.errorShipping').hide();
                $('#shipping-entry-form').find('input[type="text"],select,textarea').val('');
                $('.customerIdInput').val(custid);
            }
        });
    });
</script>
<!-- End Shipping Modal -->

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

    $('#customer').change(function () {
        getBillingNShipping($(this).val());
        $('.customerIdInput').val($(this).val());
        if (parseInt($(this).val()) > 0) {
            $('.customer_error').html('');
            $('.customer_error').hide();
        }
    });

    function getBillingNShipping(custId) {
        $('.billing_panel').show();
        if (typeof custId != 'undefined' && parseInt(custId) > 0) {
            $.post('<?= $this->createUrl('getBillingNShipping') ?>', {custId: custId}, function (data) {
                data = JSON.parse(data);
                if (data.billing != '') {
                    $('select[name="billing_id"]').show();
                    $('.errorBilling').html('');
                    $('.errorBilling').hide();
                } else {
                    $('select[name="billing_id"]').hide();
                    $('.errorBilling').html('<div class="notExist">No billing information exist</div>');
                    $('.errorBilling').show();
                }

                if (data.shipping != '') {
                    $('select[name="shipping_id"]').show();
                    $('.errorShipping').html('');
                    $('.errorShipping').hide();
                } else {
                    $('select[name="shipping_id"]').hide();
                    $('.errorShipping').html('<div class="notExist">No shipping information exist</div>');
                    $('.errorShipping').show();
                }

                $('select[name="billing_id"]').html(data.billing);
                $('select[name="shipping_id"]').html(data.shipping);

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
        var shipid = $('select[name="shipping_id"]').val();
        var billid = $('select[name="billing_id"]').val();
        if (shipid == null || billid == null) {
            $('.errorBillShip').show();
            $('.errorBillShip').html("Choose Billing & Shipping Information.");
            $('body').scrollTo($('.billing_panel'), 800);
            return false;
        } else {
            $('.errorBillShip').hide();
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
    $('.chkName').keyup(function () {
        sameBillAs();
    });
    $('.chkAddress').keyup(function () {
        sameBillAs();
    });
    $('.chkCity').keyup(function () {
        sameBillAs();
    });
    $('.chkCountry').change(function () {
        sameBillAs();
    });
    $('.chkPost').keyup(function () {
        sameBillAs();
    });
    $('.chkPhone').keyup(function () {
        sameBillAs();
    });
    $('body').on("click", "#same_as_bill", function () {
        sameBillAs();
    });
    //$('body').on("click", "#same_as_bill", function () {
    function sameBillAs() {
        if ($("#same_as_bill").is(':checked')) {
            var name = $('.chkName').val();
            var address = $('.chkAddress').val();
            var city = $('.chkCity').val();
            var post = $('.chkPost').val();
            var phone = $('.chkPhone').val();
            $('.chkNameS').val(name);
            $('.chkAddressS').val(address);
            $('.chkCityS').val(city);
            $('.chkPostS').val(post);
            $('.chkPhoneS').val(phone);
        } else {
            $('.chkNameS').val('');
            $('.chkAddressS').val('');
            $('.chkCityS').val('');
            $('.chkPostS').val('');
            $('.chkPhoneS').val('');
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

<?php
/*
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