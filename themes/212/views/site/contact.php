<section class="welcome_section" id="welcome" style="padding-bottom:0px; padding-top:90px;">
<div><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3717.4496403881035!2d-157.8238454850629!3d21.293242285855662!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7c006d9086d79603%3A0x4833b74997941cdb!2s1110+University+Ave+%23404%2C+Honolulu%2C+HI+96826%2C+USA!5e0!3m2!1sen!2sbd!4v1507807189410" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>

          </div>
                
  <div class="container">
  	<div class="row">
    
    
    
    <div class="col-md-12">
    <div class="whitebg">
        	
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="sidebar contact_2">
                            <div class="widget_info">
                                <div class="dividerHeading">
                                    <h4><span>Contact Info</span></h4>
                                </div>
                                <?= $data['contactAddress'];?>
                            </div>
                        </div>
                    </div>  
                    
                    
                    <div class="col-lg-6 col-md-6 col-sm-6">
            <div style="padding:25px 0px;">
            <?php if(isset($data['msg']) && $data['msg']!=''){?>
            <div class="alert alert-success">
                <?= $data['msg'];?>
            </div>
            <?php } ?>
                        <div class="dividerHeading">
                            <h4 style="margin-bottom:12px;"><span>Get in Touch</span></h4>
                        </div>   
               <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'contact-form',
                    'htmlOptions'=>array('class'=>'contact_form'),
                    'enableClientValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                    ),
                ));
                ?>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-lg-6 ">
                                        
                                        <?php echo $form->textField($model, 'name', array('class' => 'form-control','maxlength'=>'100','data-msg-required'=>'Please enter your name','placeholder'=>'Your Name')); ?>
                                    </div>
                                    <div class="col-lg-6 ">
                                        <input type="email" id="email" name="ContactForm[email]" class="form-control" maxlength="100" data-msg-email="Please enter a valid email address." data-msg-required="Please enter your email address." value="" placeholder="Your E-mail" >
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    
                                    <div class="col-md-12">
                                        <input type="text" id="subject" name="ContactForm[subject]" class="form-control" maxlength="100" data-msg-required="Please enter the subject." value="" placeholder="Subject">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <textarea id="message" class="form-control" name="ContactForm[body]" rows="10" cols="50" data-msg-required="Please enter your message." maxlength="5000" placeholder="Message"></textarea>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <input type="submit" class="btn btn-success btn-lg" value="Send Message">
                                </div>
                            </div>
                       <?php $this->endWidget(); ?>
                       </div>
                    </div>
                         
        </div>
    </div>
    </div>
  </div>
</section>
<style>
.gmap{
	display: inline-block;
    margin-top: -20px;
    position: relative;
    width: 100%;
}
.form-group {
    margin-bottom: 20px;
    position: relative;
    width: 100%;
    display: inline-block;
}
.contactform .form-group {
    margin-bottom: 4px;
}
.contact{
	padding-left:62px;
}
	.contact table tr td{
		border:1px solid #e8e8e9;
	}
</style>