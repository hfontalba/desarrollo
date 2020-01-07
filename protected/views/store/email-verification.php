<div class="order-steps-container "><div class="order-steps-expander"> <div class="container"> <div class="title"> Get your favourite food at your doorstep. <span class="trigger" onclick="scrollTo()"></span> </div> </div> </div> </div>




<div class="sections  section-mobile-verification section-orangeform">
 <div class="container">
   <div class="row top30">
     
     <div class="inner">
         <h1><?php echo t("We have sent verification code to your email address")?></h1>
	     <div class="">	     	     	    
	     <form class="forms bottom20" id="forms" onsubmit="return false;">
	     <?php echo CHtml::hiddenField('action','verifyEmailCode')?>         
         <?php echo CHtml::hiddenField('client_id',$data['client_id']) ?>
         <?php echo CHtml::hiddenField('currentController','store')?>
         
         <?php if (isset($_GET['checkout'])):?>
         <?php echo CHtml::hiddenField('redirect', Yii::app()->createUrl('/store/paymentoption') )?>
         <?php endif;?>
                  
        
               
         
         <?php 
		  echo CHtml::textField('code','',array(
		    'class'=>"otp-input",
		    'data-validation'=>"required",
		    'placeholder'=> "Verification Code",
		    'maxlength'=>14
		  ));
		  ?>		 		  		  
		  <input type="submit" value="<?php echo t("Submit")?>" class="green-button inline">		  
		  
	     
	     </form>
	     
	     <p class="text-small text-center block">
	     <?php echo t("Did not receive your verification code")?>? 
	     <a href="javascript:;" class="resend-email-code"><?php echo t("Click here to resend")?></a>
	     </p>
	     
	     </div> <!--box-grey-->
     </div> <!--inner-->
   
   </div> <!--row-->
 </div> <!--container-->
</div> <!-- section-grey-->

<style type="text/css">
	.order-steps-container .order-steps-expander { background: #f5f5f5; padding: 20px 0; text-align: center;
}
.order-steps-container .order-steps-expander .title { font-size: 18px; color: #777;
}
.order-steps-container .order-steps-expander .trigger { color: #333; font-weight: 700; padding: 0 20px; cursor: pointer; position: relative;
}
.order-steps-container.open .order-steps-expander .trigger:after { -webkit-transform: rotate(90deg); -ms-transform: rotate(90deg); transform: rotate(90deg);
}
.order-steps-container .order-steps-expander .trigger:after { content: ""; display: inline-block; border-right: none; border-left: 9px solid; border-top: 6px solid transparent; border-bottom: 6px solid transparent; -webkit-transform: rotate(90deg); -ms-transform: rotate(90deg); transform: rotate(90deg); -webkit-transform: rotate(0); -ms-transform: rotate(0); transform: rotate(0); margin-left: 10px;
}
.order-steps-container .order-steps-expander .title { font-size: 18px!important; color: #777;
}
.section-receipt .inner h1, .section-orangeform .inner h1 {

    background: transparent;
    color: #333;
    font-family: "Lato",sans-serif;
    font-size: 20px;
    font-weight: 300;
    margin: 0;
    padding: 8px 20px;
    text-align: center;

}
.otp-input {
	width: 100%;
	padding: 15px;
	border-radius: 30px;
	border: 1px solid #ddd;
	text-align: left;
	margin: 20px 0px; 
}
.green-button {
	width: 130px;
	display: block;
	position: relative;
	margin: 0px auto;
	padding: 14px 15px 15px;
	position: absolute;
	right: 0px;
	top: 59px;
	padding: 15px 15px;
	-webkit-border-top-right-radius: 30px;
	-webkit-border-bottom-right-radius: 30px;
	-moz-border-radius-topright: 30px;
	-moz-border-radius-bottomright: 30px;
	border-top-right-radius: 30px;
	border-bottom-right-radius: 30px;

}
.inner {
	position: relative;
}
#forms {
	padding: 0px 20px;
	margin-bottom: 0px;
}
.green-button {
    width: 130px;
    display: block;
    position: relative;
    margin: 0px auto;
    padding: 14px 15px 15px;
    position: absolute;
    right: 19px;
    top: 80px;
    padding: 15px 15px;
    -webkit-border-top-right-radius: 30px;
    -webkit-border-bottom-right-radius: 30px;
    -moz-border-radius-topright: 30px;
    -moz-border-radius-bottomright: 30px;
    border-top-right-radius: 30px;
    border-bottom-right-radius: 30px;
}
</style>