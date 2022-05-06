
                            <div class="col-md-12">
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-plus-circle"></i><?= $this->pageTitle?> </div>
                                    </div>
                                    <div class="portlet-body" style="display: block;">
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'album-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data', 'onsubmit' => "return false;", 'onkeypress' => " if(event.keyCode == 13){ send(); } "),
        ));
?>
                                        <div class="form-body">
                                            <div class="form-group">
                                                <?php echo $form->labelEx($model, 'name', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-9">
                                                    <?php echo $form->textField($model, 'name', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('name'))); ?>
                                                    <?php echo $form->error($model, 'name'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($model, 'description', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-9">
                                                    <?php echo $form->textArea($model, 'description', array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($model, 'description'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($model, 'image', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-3">
                                                  <?php echo $form->fileField($model, 'image'); ?>
                                                </div>
                                                <?php echo $form->labelEx($model, 'status', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-3">
                                                    <?php echo $form->dropDownList($model, 'status', array('1' => 'Enable', '0' => 'Disable'), array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($model, 'status'); ?>
                                            </div>

                                            
                                            
                                            

                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                   <button class="btn btn-sm green" onclick="javascript:send();">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $this->endWidget(); ?>
                                    </div>
                                </div>
                            </div>
                            <script type="text/javascript">
    function send()
    {
        var data = $("#album-form").serialize();
        $.ajax({
            type: 'POST',
            url: '<?php echo Yii::app()->createAbsoluteUrl("//admin/album/albumCreateAjax"); ?>',
            data: data,
            success: function (data) {
                data = JSON.parse(data);
                if(data.id=='0'){
                    var err = '';
                    $.each(data.error,function(k,v){
                        err += '<li>'+v+'</li>';
                    });
                    $("#album-form").find('.alert-error').show('slow');
                    $("#album-form").find('.alert-error ul').html(err);
                }else{
                    $('#responsive').modal('toggle');
                    var target = $('#responsive').attr('data-target');
                    $(target).append(data.option);
                    $(target).val(data.id);
                    $('.select2').select2();
                }
            },
            error: function (data) { // if error occured
                alert("Error occured.please try again");
                alert(data);
            },
        });

    }
</script>
                        
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css');?>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js', CClientScript::POS_END);?>




