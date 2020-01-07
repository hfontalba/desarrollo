<div class="order-steps-container "><div class="order-steps-expander"> <div class="container"> <div class="title"> Get your favourite food at your doorstep. <span class="trigger" onclick="scrollTo()"></span> </div> </div> </div> </div>

<?php 
$this->renderPartial('/front/order-progress-bar',array(
   'step'=>isset($step)?$step:5,
   'show_bar'=>true,
   'guestcheckout'=>isset($guestcheckout)?$guestcheckout:false
));
?>
<form id="frm-delivery" class="frm-delivery new-frm-delivery" method="POST" onsubmit="return false;">
<?php 
$mtid=isset($data['merchant_id'])?$data['merchant_id']:'';
echo CHtml::hiddenField('action','placeOrder');
foreach ($data as $key=>$val) {	
	switch ($key) {
		case "payment_opt":
			echo CHtml::radioButton($key,true,array(
			  'value'=>$val,
			  'class'=>"payment_option hide_inputs"
			));
			break;

		case "payment_provider_name":	
		   echo CHtml::radioButton($key,true,array(
			  'value'=>$val,
			  'class'=>"hide_inputs"
			));
			break;
		   break;
		   
		case "cc_id":	
		    echo CHtml::radioButton($key,true,array(
			  'value'=>$val,
			  'class'=>"cc_id hide_inputs"
			));
		    break; 
		    
		case "card_fee":    
		   $cs = Yii::app()->getClientScript();			
		   $cs->registerScript(
			  'card_fee',
			 "var card_fee='$val';",
			  CClientScript::POS_HEAD
		   );
		   break; 
		   
		default:
			echo CHtml::hiddenField($key,$val);	
			break;
	}
}

$transaction_type=isset($data['delivery_type'])?$data['delivery_type']:'';

switch ($transaction_type) {
	case "delivery":
		$header_1='Delivery information';
		$header_2='Delivery Address';
		$label_1='Delivery Date';
		$label_2='Delivery Time';
		
		$address=$data['street']." ";
		if (isset($data['area_name'])){
			$address.=$data['area_name']." ";
		}
		if (isset($data['city'])){
		    $address.=$data['city']." ";
		}		
		if (isset($data['state'])){
		   $address.=$data['state']." ";
		}
		if (isset($data['zipcode'])){
		   $address.=$data['zipcode']." ";
		}
		
		if (isset($data['address_book_id'])){
			if ( $address_book = Yii::app()->functions->getAddressBookByID($data['address_book_id'])){
				$address=$address_book['street'];
				$address.=" ".$address_book['city'];
				$address.=" ".$address_book['state'];
				$address.=" ".$address_book['zipcode'];
				$address.=" ".$address_book['country_code'];
			}
		}
				
		if (isset($data['map_address_lat'])){
			if(!empty($data['map_address_lat'])){
				$lat_res=FunctionsV3::latToAdress($data['map_address_lat'],$data['map_address_lng']);
				if($lat_res){					
					$address=$lat_res['formatted_address'];
				}
			}
		}
		
		break;
		
	case "pickup":	
	    $header_1='Pickup information';
	    $header_2='Pickup Address';
	    $label_1='Pickup Date';
		$label_2='Pickup Time';
						
	    $address='';
	    if ( $merchant_info=FunctionsV3::getMerchantInfo($mtid)){
	    	$address=$merchant_info['complete_address'];
	    }
	    break;
	    
	case "dinein":    
	    $header_1='Dine in information';
	    $header_2='Dine in Address';
	    $label_1='Dine in Date';
		$label_2='Dine in Time';
		$address='';
	    if ( $merchant_info=FunctionsV3::getMerchantInfo($mtid)){
	    	$address=$merchant_info['complete_address'];
	    }
	   break;

	default:
		break;
}
if (!isset($s['kr_delivery_options'])){
   $s['kr_delivery_options']='';
}

if (!isset($data['is_guest_checkout'])){
	$data['is_guest_checkout']='';
}

//dump($data);
?>
<div class="sections section-grey2 section-confirmorder" >
   <div class="container">
     <div class="row">
        <div class="col-md-7">
          <div class="">
                     
           <?php if ($data['is_guest_checkout']==2):?>
           <?php FunctionsV3::sectionHeader("Customer Information")?>
           <table class="table-order-details">
            <tr>
              <td class="a"><?php echo t("Name")?></td>
              <td class="b">: <?php echo $data['first_name']." ".$data['last_name']?></td>
            </tr>
           </table>
           <?php endif;?>          
          
           <?php FunctionsV3::sectionHeader($header_1)?>
           <table class="table-order-details">
            <tr>
              <td class="a"><?php echo t("Merchant Name")?></td>
              <td class="b">: <?php echo clearString($merchant_info['restaurant_name'])?></td>
            </tr>
            
            <?php if (isset($s['kr_delivery_options']['delivery_date'])):?>
            <?php if (!empty($s['kr_delivery_options']['delivery_date'])):?>
            <tr>
              <td class="a"><?php echo t($label_1)?></td>
              <td class="b">: <?php echo FunctionsV3::prettyDate($s['kr_delivery_options']['delivery_date'])?></td>
            </tr>
            <?php endif;?>
            <?php endif;?>
            
            <?php if (isset($s['kr_delivery_options']['delivery_time'])):?>
            <?php if (!empty($s['kr_delivery_options']['delivery_time'])):?>
            <tr>
              <td class="a"><?php echo t($label_2)?></td>
              <td class="b">: <?php echo FunctionsV3::prettyTime($s['kr_delivery_options']['delivery_time'])?></td>
            </tr>
            <?php endif;?>
            <?php endif;?>
            
            <?php if($transaction_type=="delivery"):?>
            <?php if (isset($data['delivery_instruction'])):?>
            <?php if (!empty($data['delivery_instruction'])):?>
            <tr>
              <td class="a"><?php echo t("Delivery instructions")?></td>
              <td class="b">: <?php echo $data['delivery_instruction']?></td>
            </tr>
            <?php endif;?>
            <?php endif;?>
            <?php endif;?>
                        
            <?php if($transaction_type=="dinein"):?>
               <tr>
               <td class="a"><?php echo t("Number of guest")?></td>
                <td class="b">: <?php echo $data['dinein_number_of_guest']?></td>
              </tr>
              <?php if(!empty($data['dinein_special_instruction'])):?>
              <tr>
               <td class="a"><?php echo t("Special instructions")?></td>
                <td class="b">: <?php echo $data['dinein_special_instruction']?></td>
              </tr>
              <?php endif;?>
            <?php endif;?>
            
            <?php if (isset($s['kr_delivery_options']['delivery_asap'])):?>
            <?php if (!empty($s['kr_delivery_options']['delivery_asap'])):?>
            <tr>
              <td class="a"><?php echo t("Delivery Time")?></td>
              <td class="b">: <?php echo t("ASAP")?></td>
            </tr>
            <?php endif;?>
            <?php endif;?>
            
           </table>
           
           <?php FunctionsV3::sectionHeader($header_2)?>
           <p class="spacer3"><?php echo $address;?></p>
           
           <?php FunctionsV3::sectionHeader('Payment Information')?>
                      
           <p>
           <?php 
           if (array_key_exists($data['payment_opt'],$paymentlist)){
           	   switch ($data['payment_opt']) {
           	   	case "cod":
           	   		if ($data['delivery_type']=="pickup"){
           	   			echo t("Cash On Pickup");
           	   		} elseif ( $data['delivery_type']=="dinein" ) {
         		           echo t("Pay in person");   	
           	   		} else echo t($paymentlist[$data['payment_opt']]);
           	   		break;
           	   		
           	   		case "pyr":
           	   			if ($data['delivery_type']=="pickup"){
           	   			   echo t("Pay On Pickup");
           	   		    } else echo t($paymentlist[$data['payment_opt']]);
           	   		break;
           	   
           	   	default:
           	   		echo t($paymentlist[$data['payment_opt']]);
           	   		break;
           	   }
           } else echo t($data['payment_opt']);
           
           switch ($data['payment_opt']) {
           	case "cod":
           		 if(!isset($data['order_change'])){
           		 	$data['order_change']=0;
           		 }
           		 if ($data['order_change']>0){
	           		 echo '<p class="text-muted text-small">'.t("change for").
	           		 " ". FunctionsV3::prettyPrice($data['order_change']) .'</p>';
           		 }
           		 break;
           	case "ocr":
           		if ( $card_info=Yii::app()->functions->getCreditCardInfo($data['cc_id'])){
           			echo "<p class=\"text-muted text-small\">".$card_info['card_name']."</p>";
           			echo "<p class=\"text-muted text-small\">".
           			Yii::app()->functions->maskCardnumber($card_info['credit_card_number'])."</p>";
           		}
           		break;
           
           	default:
           		break;
           }
           ?>
           </p>
           
          </div><!-- box-grey-->
                    
          <a href="<?php echo $guestcheckout==true?Yii::app()->createUrl('/store/guestcheckout'):Yii::app()->createUrl('/store/paymentoption')?>">
           <i class="ion-ios-arrow-thin-left"></i> <?php echo t("Back")?>
          </a>
          
        </div> <!--col-->
        
        <div class="col-md-5 sticky-div">
        
          <div class=" new-cart">
             
             
             <div class="order-list-wrap">   
	       
	           <h2 class="order-title-new"><?php echo t("Your Order")?></h2>
	           <div class="item-order-wrap"></div>
	         
	           <div class="text-center top25">
	             <a href="javascript:;" class="place_order green-button medium inline block checkout">
	             <?php echo t("Confirm Order")?>
	             </a>
	           </div>
	           
	         </div> <!--order-list-wrap-->
             
          </div> <!--box-grey sticky-div--> 
        
        </div> <!--col-->
        
     </div> <!--row-->
   </div> <!--container-->
</div><!-- sections-->   
</form>
<style type="text/css">
  .login-form {
    padding: 15px 0px 0px;
  }
  .login-form input[type="text"],
  .login-form input[type="password"] {
    width: 100%;
    border:0px;
    border: 1px solid #eee;
    background: #fff;
    margin-bottom: 10px!important;
    height: 40px;
  }
  #mylogin {
    /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#ffffff+0,ffffff+49,354448+49,354448+100 */
background: rgb(255,255,255); /* Old browsers */
background: -moz-linear-gradient(left, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 49%, rgba(53,68,72,1) 49%, rgba(53,68,72,1) 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(left, rgba(255,255,255,1) 0%,rgba(255,255,255,1) 49%,rgba(53,68,72,1) 49%,rgba(53,68,72,1) 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to right, rgba(255,255,255,1) 0%,rgba(255,255,255,1) 49%,rgba(53,68,72,1) 49%,rgba(53,68,72,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#354448',GradientType=1 ); /* IE6-9 */
  }
  .login-form h1 {
    color: #fff;
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
    color: #fff;
    font-weight: 300;
    line-height: 23px;
    margin-bottom: 20px;
  }
  
    .login-form .text-muted {
    color: #efefef;
    font-size: 13px;
    font-weight: 300;
}
#frm-delivery h3 {
  font-size: 22px;
  font-weight: 300;
}
#frm-delivery p {
    font-size: 14px;
    font-weight: 300;
    line-height: 24px;
    margin: 15px 0px 0px;
}
.filter-box a span, .menu-cat a span, .section-label a.section-label-a span {
  background: transparent;
}
.section-label-a b {
  display: none!important;
}
.section-label-a  span {
  font-size: 16px;
  font-weight: 300!important;
}
.text-muted {
  color: #888!important;
}
.new-cart {
  padding: 0px!important;
}
.order-title-new {
  font-size: 20px!important;
  font-weight: 400;
  color: #333;
  font-family: 'Open Sans', sans-serif!important;
  text-align: left!important;
  border-bottom: solid 1px #ededed;
  padding: 10px 20px;
  margin-top: 0px!important;
}
.new-cart p {
  display: none;
}
.new-cart  .edit_item {
  display: none;
}
.item-order-wrap {
  margin-top: 10px;
  padding: 20px;
  padding: 0px 20px 20px;
}
.item-order-list {
    padding-bottom: 15px;
    padding-top: 15px;
    border-bottom: 1px solid #E4E7EA;
}
.item-row a {
    font-size: 20px;
    margin-right: 5px;
    color: #9A9A93;
    line-height: 0px!important;
}
.summary-wrap {
    padding-top: 10px;
    line-height: 26px;
}
.clear-cart {
    
    right: 15px;
    top: 20px;
}
.cart_total_wrap {
  font-size: 16px;
}
.dl-options {
  padding: 0px!important;
}
.dl-sub {
  padding: 10px 30px 20px 30px;

}
.dl-sub select , .dl-sub input {
  width: 100%!important;
  height: 40px;
  background: #f3f3f3;
  border: none;
}
.checkout {
  width: 100%;
  display: block;
  border-radius: 0px;
  background: #60ba62;
  border: none!important;
  padding: 13px 10px!important;
  font-size: 16px;
}
.checkout:hover {
  background: #188159!important;
}
.dl-info {
  text-align: left;
  padding: 10px 20px 20px 20px;
}
.dl-info p {
  line-height: 28px;
}
.dl-info .change-address {
  text-align: left;
border-top: 1px solid #eee;
padding-top: 15px;
}
.delivery-asap {
  display: block;
  text-align: left;
}
.custom-select {
  position: relative;
  font-family: Arial;
}
#direction_output {
  padding: 0px;
  border: none!important;
  border-top: 1px solid #ddd;
}
.adp-text {
    width: 100%;
    padding: 10px;
    background: none;
}
.adp, .adp table {
    font-family: Roboto,Arial,sans-serif;
    font-weight: 300;
    color: #2C2C2C;
    line-height: 34px;
    background: transparent;
border: none;
}
.new-cart {
    padding: 8px 0px 0px 0px !important;
    background: #fff;
}
.checkout {
    width: 100%;
    display: block;
    border-radius: 0px;
    background: #60ba62;
    border: none !important;
    padding: 13px 10px !important;
    font-size: 16px;
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
.item-row .a, .item-row .b, .item-row .c, .item-row .d, .summary-wrap .a {
  float: none!important;
}
.item-row .manage, .summary-wrap .manage {
  float: none!important;
}
.item-order-list {
  padding-bottom: 5px;
  padding-top: 5px;
  border-bottom: 1px solid #E4E7EA;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.item-row .c {
    margin-right: 0px;
    width: 10%;
}
.item-row .c-left {
  display: flex;
  flex-direction: column-reverse;
  text-align: center;
  width: 30px;
  border: 1px solid #60ba62;
  overflow: hidden;
  border-radius: 2px;
}
.item-row a {
    font-size: 10px;
    margin-right: 5px;
    color: #FFF;
    line-height: 0px !important;
    width: 30px;
    height: 15px;
    background: #60ba62;
    
    display: flex;
    align-items: center;
    text-align: center;
    margin-right: 0px;
}
.item-row a i {
  width: 100%;
}
.item-row .a {
    width: 30px;
    text-indent: 0;
}
.c-left a:hover, .c-right a:hover {
  color: #fff;
}
.manage {
  display: flex;
}
.manage .c-right a{
  width: 20px;
  height: 20px;
  border-radius: 100%;
  margin-left: 10px;
  font-size: 13px;
}
.item-row .c-left {
  border: 1px solid #fff;
}
.item-row .manage .c-right {
  position: absolute;
  top: 0px;
  right: 0px;
  bottom: 0px;
  left: 0px;
  margin: auto;
  background: #fff;
  opacity: 0;
  display: flex;
  justify-content: end;
}
.c-left a, .c-right a {
  opacity: 0;
}
.item-order-list:hover .c-left a,
.item-order-list:hover .c-right a,
.item-order-list:hover .c-right  {
  opacity: 1!important;
}
.item-order-list:hover .c-left {
  border: 1px solid #60ba62;
}
.item-row .b {
  width: 60%;
  padding-left: 10px;
}
.item-row .manage {
  width: 30%;
  position: relative;
  justify-content: end;
}
.cart_total_wrap {
  padding-top: 10px;
}
.cart_total {
  font-size: 26px;
}
.section-confirmorder .delete_item {
  display: flex;
}
</style>



