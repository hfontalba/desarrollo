<div class="lg-wrap">
  <div class="lg-left">&nbsp;</div>
  <div class="lg-right">
<div class="login_wrap">

<div class="lg-form">

   
   <h3 class="uk-h3" style="text-transform: none;">¡Bienvenido al panel de establecimientos!</h3>   
     
   <form id="forms" class="uk-form forms" onsubmit="return false;" method="POST">   
   <?php echo CHtml::hiddenField("action",'merchantLogin')?>
   <?php echo CHtml::hiddenField("redirect",Yii::app()->request->baseUrl."/merchant")?>
   
   
   <?php if (isset($_GET['message'])):?>
   <p class="uk-text-danger"><?php echo $_GET['message']?></p>
   <?php endif;?>
   
   <div class="uk-form-row">
      <div class="uk-form-icon uk-width-1">
       
       <?php echo CHtml::textField('username','',array('class'=>"uk-width-1",'placeholder'=>Yii::t("default","Username"),
       'data-validation'=>"required"
       ));?>
      </div>
   </div>   
   <div class="uk-form-row">     
       <div class="uk-form-icon uk-width-1">
       
        <?php echo CHtml::passwordField('password','',array('class'=>"uk-width-1",'placeholder'=>Yii::t("default","Password"),
        'data-validation'=>"required"
        ));?>
       </div>     
   </div>   
   
   <?php if (getOptionA('captcha_merchant_login')==2):?>
   <?php GoogleCaptcha::displayCaptcha()?>
   <?php endif;?>
   
   <div class="uk-form-row">   
   <button class="uk-button uk-width-1"><?php echo Yii::t("default","Ingresar")?> </button>
   </div>
   
   <p><a href="javascript:;" class="mt-fp-link"><?php echo Yii::t("default","Forgot Password")?>?</a></p>
   </form>
   
   <form id="mt-frm" class="uk-form mt-frm" onsubmit="return false;" method="POST">   
   <?php echo CHtml::hiddenField("action",'merchantForgotPass')?>
   <h4><?php echo Yii::t("default","¿Olvidó su contraseña?")?></h4>
   
   <div class="uk-form-row">
      <div class="uk-form-icon uk-width-1">
        
       <?php echo CHtml::textField('email_address','',array('class'=>"uk-width-1",'placeholder'=>Yii::t("default","Email address"),
       'data-validation'=>"required"
       ));?>
      </div>
   </div>   
      
   <div class="uk-form-row">   
   <button class="uk-button uk-width-1"><?php echo Yii::t("default","Enviar codigo de restablecimiento")?> <i class="uk-icon-chevron-circle-right"></i></button>
   </div>
   
   <p><a href="javascript:;" class="mt-login-link"><?php echo Yii::t("default","Ingresar")?></a></p>
   
   </form>
   
   
   <form id="mt-frm-activation" class="uk-form mt-frm-activation" onsubmit="return false;" method="POST">   
   <?php echo CHtml::hiddenField("action",'merchantChangePassword')?>
   <?php echo CHtml::hiddenField("email",'')?>
   <h4><?php echo Yii::t("default","Enter Verification Code & Your New Password")?></h4>
   
   <div class="uk-form-row">
      <div class="uk-form-icon uk-width-1">
        <i class="uk-icon-unlock"></i>
       <?php echo CHtml::textField('lost_password_code','',array('class'=>"uk-width-1",'placeholder'=>Yii::t("default","Code"),
       'data-validation'=>"required"
       ));?>
      </div>
   </div>   
   
   <div class="uk-form-row">  
      <div class="uk-form-icon uk-width-1">
        <i class="uk-icon-lock"></i>
       <?php echo CHtml::passwordField('new_password','',array('class'=>"uk-width-1",'placeholder'=>Yii::t("default","New Password"),
       'data-validation'=>"required"
       ));?>
      </div>
   </div>   
    
   <div class="uk-form-row">   
   <button class="uk-button uk-width-1"><?php echo Yii::t("default","Submit")?> <i class="uk-icon-chevron-circle-right"></i></button>
   </div>
    
   <p><a href="javascript:;" class="mt-login-link"><?php echo Yii::t("default","Login")?></a></p>
   
   </form>
   
</div>
</div> <!--END login_wrap-->
</div>
</div>


<style type="text/css">
 .lg-wrap {
  display: flex;
  background-color: #fff;
 } 
 .lg-left {
  width: 100%;
  background-color: #171a29 !important;
  background-image: url(http://asiderapido.com/images/new-logo.png);
  background-position: center;
background-repeat: no-repeat;
background-size: 342px
 }
 .lg-right {
  width: 100%;
display: flex;
align-self: center;
background-color: #fff;
 }
 .content {
  height: 100%;
  margin: 0px;
 }
 .lg-wrap {
  height: 100%;
 }
 .lg-form {
  width: 60%;
  position: relative;
  margin: 0px auto;
 }
 .login_wrap {
  margin: auto;
padding-top: 0;
 }
 .lg-form {
    width: 100%;
    position: relative;
    margin: 0px auto;
}
.login_wrap {
    margin: auto;
    padding-top: 0;
    width: 32%;
}
.uk-form-icon:not(.uk-form-icon-flip) > input {
    padding-left: 15px !important;
    border-radius: 0px;
    height: 40px;
}
.uk-button{
  background: #00b279;
  text-shadow: none;
  color: #fff;
  border-radius: 0px;
  height: 40px;
  transition: all .25s ease;
}
.uk-button:hover  {
  background: #049f6d;
  color: #fff;
}
.mt-fp-link {
  font-size: 13px;
  color: #777;
  transition: all .25s ease;
}
.mt-fp-link:hover {
  text-decoration: none;
  color: #333;
}
</style>