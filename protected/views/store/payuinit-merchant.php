<?php


$this->renderPartial('/front/order-progress-bar',array(
   'step'=>4,
   'show_bar'=>true
));

$db_ext=new DbExt;
$error='';
$my_token=isset($_GET['token'])?$_GET['token']:'';
$package_id=isset($_GET['package_id'])?$_GET['package_id']:'';	
$is_merchant=true;

$amount_to_pay=0;
$payment_description=Yii::t("default",'Payment to merchant');

$back_url=Yii::app()->request->baseUrl."/store/PaymentOption";
$payment_ref=Yii::app()->functions->generateCode()."TT".Yii::app()->functions->getLastIncrement('{{order}}');

if ( $data=Yii::app()->functions->getOrder($_GET['id'])){		
	
	$merchant_id=isset($data['merchant_id'])?$data['merchant_id']:'';	
	$payment_description.=isset($data['merchant_name'])?" ".$data['merchant_name']:'';	
	
	$amount_to_pay=isset($data['total_w_tax'])?Yii::app()->functions->standardPrettyFormat($data['total_w_tax']):'';
	
	/*dump($payment_description);
	dump($amount_to_pay);*/
	
} else $error=Yii::t("default","Failed. Cannot process payment");  
?>
<div class="order-steps-container "><div class="order-steps-expander"> <div class="container"> <div class="title"> Get your favourite food at your doorstep. <span class="trigger" onclick="scrollTo()"></span> </div> </div> </div> </div>
<div class="sections  section-orangeform">
  <div class="container">  
    <div class="row top30">
       <div class="inner new-form">
          <h1><?php echo t("Pay using PayUMoney")?></h1>
          <div class="box-grey rounded">	     
          
          <?php if ( !empty($error)):?>
               <p class="text-danger"><?php echo $error;?></p>  
          <?php else :?>
          
          <?php require_once("payu.php")?>
		  <?php 
		  if ( $success==TRUE){
		   	  //dump($_POST);
		   	  $data_post=$_POST;	
		   	  $params_logs=array(
		      'order_id'=>$_GET['id'],
		      'payment_type'=>Yii::app()->functions->paymentCode('payumoney'),
		      'raw_response'=>json_encode($data_post),
		      'date_created'=>FunctionsV3::dateNow(),
		      'ip_address'=>$_SERVER['REMOTE_ADDR'],
		      'payment_reference'=>$data_post['txnid']
		    );
		    $db_ext->insertData("{{payment_order}}",$params_logs);
		    
		    $params_update=array( 'status'=>'paid');	        
		    $db_ext->updateData("{{order}}",$params_update,'order_id',$_GET['id']);
		    
		    /*POINTS PROGRAM*/ 
		    if (FunctionsV3::hasModuleAddon("pointsprogram")){
			   PointsProgram::updatePoints($_GET['id']);
		    }
		    
		    /*Driver app*/
			if (FunctionsV3::hasModuleAddon("driver")){
			   Yii::app()->setImport(array(			
				  'application.modules.driver.components.*',
			   ));
			   Driver::addToTask($_GET['id']);
			}
		    		    		    
		    $this->redirect( Yii::app()->createUrl('/store/receipt',array(
	          'id'=>$_GET['id']
	        )) );
		    die();						
		  }
		  ?>
          
          <?php endif;?>            
          
            <div class="top25">
		     <a href="<?php echo Yii::app()->createUrl('/store/paymentoption')?>">
             <i class="ion-ios-arrow-thin-left"></i> <?php echo Yii::t("default","Click here to change payment option")?></a>
            </div>
          
          </div> <!--box-->
       </div> <!--inner-->
    </div> <!--row-->
  </div> <!--container-->
</div><!-- sections-->
<style type="text/css">
@import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700');
	#parallax-wrap {
		display: none;
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
.new-form h1 {
	background: #20ac76!important;
	font-family: 'Open Sans', sans-serif!important;
	font-weight: 600!important;
	padding: 20px 20px!important;
}
.new-form {
	border-radius: 5px;
	overflow: hidden;
}
.new-form .grey-fields {
    background: #fff!important;
    border: 1px solid #ddd!important;
    color: #1e1e1e!important;
    padding: 12px 10px!important;
    width: 100%!important;
    margin-bottom: 0px!important;
}
.new-form .row {
	display: flex;
	align-items: center;
	margin-bottom: 20px;
}
.black-button {
    background: #20ac76;
    border: 1px solid #20ac76;
    color: #fff;
    padding: 5px 8px;
    border-radius: 5px;
}
</style>