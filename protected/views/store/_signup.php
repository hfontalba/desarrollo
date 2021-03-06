<?php
$this->renderPartial('/front/banner-receipt',array(
   'h1'=>t("Login & Signup"),
   'sub_text'=>t("sign up to start ordering")
));

echo CHtml::hiddenField('mobile_country_code',Yii::app()->functions->getAdminCountrySet(true));
?>
<div class="order-steps-container "><div class="order-steps-expander"> <div class="container"> <div class="title"> Get your favourite food at your doorstep. <span class="trigger" onclick="scrollTo()"></span> </div> </div> </div> </div>
<div class="sections  section-checkout" id="mylogin">

<div class="container">

  <div class="row nw-flex">
     <!--LEFT CONTENT-->
     
    <div class="col-md-6 border-r" >
       
     <div class="login-form" >      
        <h2> Login Here</h2>
                 
      <form id="forms" class="forms" method="POST">
         <?php echo CHtml::hiddenField('action','clientLogin')?>
         <?php echo CHtml::hiddenField('currentController','store')?> 
         <?php FunctionsV3::addCsrfToken(false);?>       
         
          <?php if ($google_login_enabled==2 || $fb_flag==2 ) :?>
              <?php if ( $fb_flag==2):?>
            <a href="javascript:fbcheckLogin();" class="fb-button orange-button medium rounded">
             <i class="ion-social-facebook"></i><?php echo t("login with Facebook")?>
            </a> 
            <?php endif;?>
          
            <?php if ($google_login_enabled==2):?>
            <div class="top10"></div>
            <a href="<?php echo Yii::app()->createUrl('/store/googleLogin')?>" 
            class="google-button orange-button medium rounded">
              <i class="ion-social-googleplus-outline"></i><?php echo t("Sign in with Google")?>
            </a> 
            <?php endif;?>
          
          <div class="login-or">
            <span><?php echo t("Or")?></span>
          </div>
          <?php endif;?>
             
      <div class="row top10">
         <div class="col-md-12 ">
         <?php echo CHtml::textField('username','',
                array('class'=>'grey-fields',
                'placeholder'=>t("Mobile number or email"),
               'required'=>true
               ))?>
         </div>
      </div> <!--row-->
      
      <div class="row top10">
         <div class="col-md-12 ">
         <?php echo CHtml::passwordField('password','',
                array('class'=>'grey-fields',
                'placeholder'=>t("Password"),
               'required'=>true
               ))?>
         </div>
      </div> <!--row-->   
            
      <?php if ($captcha_customer_login==2):?>
           <div class="top10">
             <div id="kapcha-1"></div>
           </div>
          <?php endif;?> 
      
      <div class="row top15">
      <div class="col-md-4">
         <input type="submit" value="<?php echo t("Login")?>" class="green-button medium full-width">
       </div>    
               
       <div class="col-md-8">
         <a href="javascript:;" class="forgot-pass-link2 block orange-text text-right" style="display: block; margin-top: 10px; color: #666;">
         <?php echo t("Forgot Password");?> <i class="ion-help"></i>
         </a>      
       </div>
       
      </div>
            
    </form>           
      <form id="frm-modal-forgotpass" class="frm-modal-forgotpass" method="POST" onsubmit="return false;" >
    <?php echo CHtml::hiddenField('action','forgotPassword')?>
    <?php echo CHtml::hiddenField('do-action', isset($_GET['do-action'])?$_GET['do-action']:'' )?>     
    <div class="section-forgotpass">
        <div >      
          
        
         <div class="row top15">
            <div class="col-md-12 ">
           <?php echo CHtml::textField('username-email','',
                  array('class'=>'grey-fields',
                  'placeholder'=>t("Email address"),
                 'required'=>true
                 ))?>
           </div>
        </div> <!--row--> 
        
         <div class="row top10">             
         
         <div class="col-md-6 ">
           <input type="submit" value="<?php echo t("Retrieve Password")?>" class="green-button medium full-width">
         </div>
        </div>  
      
      </div> <!--box-grey-->
    </div> <!--section-forgotpass-->
    </form>
    </div> <!--box-grey-->  
   
    
    
    
    </div> <!--col-->
    <!--END LEFT CONTENT-->
    
    <!--RIGHT CONTENT-->
    
    <div class="col-md-6" >
          
      <div class="login-form"> 
        <h1>Get an Account & Order Now</h1>
      <h6>Signup with Kerala's fastest online food delivery service. Easy login and eat your delicious food. </h6>     
      
      <form id="form-signup" class="form-signup uk-panel uk-panel-box uk-form" method="POST">
       <?php echo CHtml::hiddenField('action','clientRegistrationModal')?>
         <?php echo CHtml::hiddenField('currentController','store')?>
         <?php echo CHtml::hiddenField('single_page',2)?>    
         <?php FunctionsV3::addCsrfToken(false);?>
         <?php 
         $verification=Yii::app()->functions->getOptionAdmin("website_enabled_mobile_verification");      
       if ( $verification=="yes"){
          echo CHtml::hiddenField('verification',$verification);
       }
       if (getOptionA('theme_enabled_email_verification')==2){
        echo CHtml::hiddenField('theme_enabled_email_verification',2);
       }
       ?>
                  
      
      
       <div class="row top10">
         <div class="col-md-6 ">
         <?php echo CHtml::textField('first_name','',
                array('class'=>'grey-fields',
                'placeholder'=>t("First Name"),
               'required'=>true               
               ))?>
         </div>
     
         <div class="col-md-6 ">
         <?php echo CHtml::textField('last_name','',
                array('class'=>'grey-fields',
                'placeholder'=>t("Last Name"),
               'required'=>true
               ))?>
         </div>
      </div> <!--row-->   
      
      <div class="row top10">
         <div class="col-md-6 ">
         <?php echo CHtml::textField('contact_phone','',
                array('class'=>'grey-fields mobile_inputs',
                'placeholder'=>t("Mobile"),
               'required'=>true
               ))?>
         </div>
     
         <div class="col-md-6 ">
         <?php echo CHtml::textField('email_address','',
                array('class'=>'grey-fields',
                'placeholder'=>t("Email address"),
               'required'=>true
               ))?>
         </div>
      </div> <!--row-->    
      
      <div class="row top10">
         <div class="col-md-6 ">
         <?php echo CHtml::passwordField('password','',
                array('class'=>'grey-fields',
                'placeholder'=>t("Password"),
               'required'=>true
               ))?>
         </div>
     
         <div class="col-md-6 ">
         <?php echo CHtml::passwordField('cpassword','',
                array('class'=>'grey-fields',
                'placeholder'=>t("Confirm Password"),
               'required'=>true
               ))?>
         </div>
      </div> <!--row-->     
      
      
     <?php 
         $FunctionsK=new FunctionsK();
         $FunctionsK->clientRegistrationCustomFields();
         ?> 
      
     <?php if ($captcha_customer_signup==2):?>             
         <div class="top10">
             <div id="kapcha-2"></div>
         </div>
         <?php endif;?> 
           
         <p class="text-muted">
          <?php echo Yii::t("default","By creating an account, you agree to receive sms from vendor.")?>
         </p>  
         
        <?php if ($terms_customer=="yes"): ?> 
         <div class="row">
           <div class="col-md-1">
           <?php 
        echo CHtml::checkBox('terms_n_condition',false,array(
         'value'=>2,
         'class'=>"icheck",
         'required'=>true
       ));?>
           </div>
           <div class="col-md-11 text-left">
           <?php 
           echo " ". t("I Agree To")." <a href=\"$terms_customer_url\" target=\"_blank\">".t("The Terms & Conditions")."</a>";
            ?>
           </div>
         </div>
         <?php endif;;?>
         
         <div class="row top10">
         <div class="col-md-5 ">
          <input type="submit" value="<?php echo t("Create Account")?>" class=" reg-button orange-button medium block full-width">
          </div>
         </div>
      
    </form> 
    </div> <!--box-grey-->  
    
    
    </div> <!--col-->
    
    <!--END RIGHT CONTENT-->
    
  </div> <!--row-->

</div> <!--container-->

</div> <!--section-grey-->

<style type="text/css">
@import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,700');
  .login-form {
    padding: 30px 40px;
  }
  .login-form input[type="text"],
  .login-form input[type="password"] {
    width: 100%;
    border:0px;
    border: 1px solid #eee;
    background: #fff;
    margin-bottom: 10px;
    height: 40px;
  }
  #mylogin {
    background-color: #fff;
  }
  .login-form h1 {
    color: #333;
    font-weight: 300;
    font-size: 24px;
    text-align: left;
  }
  .login-form h2 {
    color: #333;
    font-weight: 300;
    font-size: 24px;
    text-align: left;
    font-family: 'Open Sans', sans-serif;
    margin-bottom: 20px;
  }
  .login-form h6{
    font-size: 13px;
    color: #333;
    font-weight: 300;
    line-height: 23px;
    margin-bottom: 20px;
  }
  
    .login-form .text-muted {
    color: #999;
    font-size: 13px;
    font-weight: 300;
}
  .reg-button {
    background: #00b279 !important;
    border: 1px solid #00b279 !important;
    color: #fff;
    padding: 10px 10px;
}
  .parallax-mirror, #parallax-wrap {
    display: none!important;
  }
  .order-steps-container .order-steps-expander {
    background: #f5f5f5;
    padding: 20px 0;
    text-align: center;
}
.order-steps-container .order-steps-expander .title {
    font-size: 18px;
    color: #777;
}
.order-steps-container .order-steps-expander .trigger {
    color: #333;
    font-weight: 700;
    padding: 0 20px;
    cursor: pointer;
    position: relative;
}
.order-steps-container.open .order-steps-expander .trigger:after {
    -webkit-transform: rotate(90deg);
    -ms-transform: rotate(90deg);
    transform: rotate(90deg);
}
.order-steps-container .order-steps-expander .trigger:after {
    content: "";
    display: inline-block;
    border-right: none;
    border-left: 9px solid;
    border-top: 6px solid transparent;
    border-bottom: 6px solid transparent;
    -webkit-transform: rotate(90deg);
    -ms-transform: rotate(90deg);
    transform: rotate(90deg);
    -webkit-transform: rotate(0);
    -ms-transform: rotate(0);
    transform: rotate(0);
    margin-left: 10px;
}
.order-steps-container .order-steps-expander .title {
    font-size: 18px!important;
    color: #777;
}
.section-forgotpass {
  
border-top: 1px solid rgb(238, 238, 238);
padding-top: 15px;
margin-top: 34px;
}
.sections {
    padding-top: 85px;
    padding-bottom: 117px;
}
.nw-flex {
  display: flex;
align-items: center;
}
.border-r {
  border-right: 1px solid #ededed;
}
#contact_phone {
  border: 1px solid #eee!important;
  box-shadow: none;
}
@media (min-width:961px) and (max-width: 1024px) {
  .nw-flex {
    flex-direction: column;
  }
  #mylogin {
    padding: 20px 20px
  }
  .login-form {
    padding: 0px;
    border-right: none;
    border-bottom: 1px solid #ddd; 
  }
  #mylogin .col-md-6 {
    width: 100%;
  }
  .border-r {
    border: none;
  }
  .login-form .row {
    margin-top: 0px;
  }
  .intl-tel-input {
    margin-bottom: 10px;
  }
  .mobile-banner-wrap {
    display: none;
  }
}
@media (min-width:768px) and (max-width: 959px) {
  .nw-flex {
    
  }
  #mylogin {
    padding: 20px 20px
  }
  .login-form {
    
  }
  #mylogin .col-md-6 {
    width: 100%;
  }
  .border-r {
    border: none;
  }
  .login-form .row {
    margin-top: 0px;
  }
  .intl-tel-input {
    margin-bottom: 10px;
  }
  .mobile-banner-wrap {
    display: none;
  }
}
@media (min-width:641px) and (max-width: 767px) {
  .nw-flex {
    flex-direction: column;
  }
  #mylogin {
    padding: 20px 20px
  }
  .login-form {
    padding: 0px;
    border-right: none;
    border-bottom: 1px solid #ddd; 
  }
  #mylogin .col-md-6 {
    width: 100%;
  }
  .border-r {
    border: none;
  }
  .login-form .row {
    margin-top: 0px;
  }
  .intl-tel-input {
    margin-bottom: 10px;
  }
  .mobile-banner-wrap {
    display: none;
  }
}
@media (min-width:480px) and (max-width: 640px) {
  .nw-flex {
    flex-direction: column;
  }
  #mylogin {
    padding: 20px 20px
  }
  .login-form {
    padding: 0px;
    border-right: none;
    border-bottom: 1px solid #ddd; 
  }
  #mylogin .col-md-6 {
    width: 100%;
  }
  .border-r {
    border: none;
  }
  .login-form .row {
    margin-top: 0px;
  }
  .intl-tel-input {
    margin-bottom: 10px;
  }
  .mobile-banner-wrap {
    display: none;
  }
}
@media  (max-width: 479px) {
  .nw-flex {
    flex-direction: column;
  }
  #mylogin {
    padding: 20px 20px
  }
  .login-form {
    padding: 0px;
    border-right: none;
    border-bottom: 1px solid #ddd; 
  }
  #mylogin .col-md-6 {
    width: 100%;
  }
  .border-r {
    border: none;
  }
  .login-form .row {
    margin-top: 0px;
  }
  .intl-tel-input {
    margin-bottom: 10px;
  }
  .mobile-banner-wrap {
    display: none;
  }
}
</style>


