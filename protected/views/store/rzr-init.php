<div class="order-steps-container "><div class="order-steps-expander"> <div class="container"> <div class="title"> Get your favourite food at your doorstep. <span class="trigger" onclick="scrollTo()"></span> </div> </div> </div> </div>
<div class="sections  section-orangeform">
  <div class="container">  
  <div class="row top30">
  <div class="inner">
  <h1><?php echo t("Pay using")." ".t("Razorpay")?></h1>
  <div class="box-grey rounded">	     
  <?php if ( !empty($error)):?>
  <p class="text-danger"><?php echo $error;?></p>  
  <?php else :?>
  
          
  	<div class="row top10">
	  <div class="col-md-3"><?php echo t("Amount")?></div>
	  <div class="col-md-8">
	    <?php echo FunctionsV3::prettyPrice($amount_to_pay)?>
	  </div>
	</div>
	
	<div class="row top10">
	<div class="col-md-12">
	
	<form action="<?php echo Yii::app()->createUrl('/store/rzrverify',array('xid'=>$data['order_id']))?>" method="POST">
    <script
    src="https://checkout.razorpay.com/v1/checkout.js"
    data-key="<?php echo $credentials['key_id']?>"
    data-amount="<?php echo $amount;?>"
    data-buttontext="<?php echo t("Pay Now")?>"
    data-name="<?php echo clearString($data['merchant_name'])?>"
    data-description="<?php echo $payment_description?>"
    data-image="<?php //echo FrontFunctions::getLogoURL();?>"
    data-prefill.name="<?php echo $_SESSION['kr_client']['first_name']." ".$_SESSION['kr_client']['last_name']?>"
    data-prefill.email="<?php echo $_SESSION['kr_client']['email_address']?>"
    data-prefill.contact="<?php echo $_SESSION['kr_client']['contact_phone']?>"  
    data-theme.color="#F37254"></script>
    <input type="hidden" value="<?php echo $data['order_id']?>" name="hidden">	    
    
    <p style="margin-top:20px;" class="text-small">
    <?php echo t("Please don't close the window during payment, wait until you redirected to receipt page")?></p> 
    
    </form>
    
    </div>
    </div>
	
  <?php endif;?>
    
   <div class="top25">
     <a href="<?php echo Yii::app()->createUrl('/store/paymentoption')?>">
     <i class="ion-ios-arrow-thin-left"></i> <?php echo Yii::t("default","Click here to change payment option")?></a>
    </div>
  
    </div>
   </div>
  </div>
 </div>
</div>

<style type="text/css">
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
.section-receipt .inner h1, .section-orangeform .inner h1 {
    background: #60ba62;
    color: #fff;
    font-size: 20px;
    font-weight: 400;
    margin: 0;
    padding: 20px 20px;
}
.orange-button, .razorpay-payment-button {
    background: #60ba62;
    border: 1px solid #60ba62;
    color: #fff;
    padding: 9px 25px;
    border-radius: 5px;
    margin-top: 10px;
}
.filter-wrap, .box-grey {
  border: 1px solid #e9e9e9;
}
#header {
    background: #60ba62!important;
}
#payment-options i, .text-btn, #cancel_upi .back-btn, .offer-info li:first-child, .ecod .item i {
    color: #60ba62!important;
}
</style>

