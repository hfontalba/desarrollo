<div class="order-steps-container "><div class="order-steps-expander"> <div class="container"> <div class="title"> Get your favourite food at your doorstep. <span class="trigger" onclick="scrollTo()"></span> </div> </div> </div> </div>

<?php 
$this->renderPartial('/front/order-progress-bar',array(
   'step'=>isset($step)?$step:4,
   'show_bar'=>true,
   'guestcheckout'=>isset($guestcheckout)?$guestcheckout:false
));

$s=$_SESSION;
$continue=false;

$merchant_address='';		
if ($merchant_info=Yii::app()->functions->getMerchant($s['kr_merchant_id'])){	
	$merchant_address=$merchant_info['street']." ".$merchant_info['city']." ".$merchant_info['state'];
	$merchant_address.=" "	. $merchant_info['post_code'];
}

$client_info='';

if (isset($is_guest_checkout)){
	$continue=true;	
} else {	
	$client_info = Yii::app()->functions->getClientInfo(Yii::app()->functions->getClientId());
	if (isset($s['kr_search_address'])){	
		$temp=explode(",",$s['kr_search_address']);		
		if (is_array($temp) && count($temp)>=2){
			$street=isset($temp[0])?$temp[0]:'';
			$city=isset($temp[1])?$temp[1]:'';
			$state=isset($temp[2])?$temp[2]:'';
		}
		if ( isset($client_info['street'])){
			if ( empty($client_info['street']) ){
				$client_info['street']=$street;
			}
		}
		if ( isset($client_info['city'])){
			if ( empty($client_info['city']) ){
				$client_info['city']=$city;
			}
		}
		if ( isset($client_info['state'])){
			if ( empty($client_info['state']) ){
				$client_info['state']=$state;
			}
		}
	}	
	
	if (isset($s['kr_merchant_id']) && Yii::app()->functions->isClientLogin() && is_array($merchant_info) ){
		$continue=true;
	}
}
echo CHtml::hiddenField('mobile_country_code',Yii::app()->functions->getAdminCountrySet(true));

echo CHtml::hiddenField('admin_currency_set',getCurrencyCode());

echo CHtml::hiddenField('admin_currency_position',
Yii::app()->functions->getOptionAdmin("admin_currency_position"));

?>


<div class="sections section-grey2 section-payment-option">
   <div class="container">
           
     <?php if ( $continue==TRUE):?>
     <?php 
     $merchant_id=$s['kr_merchant_id'];
     echo CHtml::hiddenField('merchant_id',$merchant_id);
     ?>
     <div class="col-md-7 ">
          
     <div class="">
     <form id="frm-delivery" class="frm-delivery" method="POST" onsubmit="return false;">
     <?php 
     //echo CHtml::hiddenField('action','placeOrder');
     echo CHtml::hiddenField('action','InitPlaceOrder');
     echo CHtml::hiddenField('country_code',$merchant_info['country_code']);
     echo CHtml::hiddenField('currentController','store');
     echo CHtml::hiddenField('delivery_type',$s['kr_delivery_options']['delivery_type']);
     echo CHtml::hiddenField('cart_tip_percentage','');
     echo CHtml::hiddenField('cart_tip_value','');
     echo CHtml::hiddenField('client_order_sms_code');
     echo CHtml::hiddenField('client_order_session');
     
     echo CHtml::hiddenField('cart_tip_cash_percentage','');
     
     if (isset($is_guest_checkout)){
     	echo CHtml::hiddenField('is_guest_checkout',2);
     }          
     
     $transaction_type=$s['kr_delivery_options']['delivery_type'];     
     ?>
     
     <?php if ( $transaction_type=="pickup" ||  $transaction_type=="dinein"):?> 
               
         
          <?php 
          if($transaction_type=="pickup"){
            ?>
            <div class="section-label"> <a class="section-label-a"> <span class="bold"> Pickup information</span> <b></b> </a> </div>
            <?php
          } else {
            ?>
            <div class="section-label"> <a class="section-label-a"> <span class="bold"> Dine information</span> <b></b> </a> </div>
            <?php
          }
          ?>
         
          <div class="dl-padding">
          <p class="uk-text-bold"><?php echo $merchant_address; ?></p>
            </div>       
          <?php if (!isset($is_guest_checkout)):?> 
          <?php //if ( getOptionA('mechant_sms_enabled')==""):?>
          <?php //if ( getOption($merchant_id,'order_verification')==2):?>
          <?php //$sms_balance=Yii::app()->functions->getMerchantSMSCredit($merchant_id);?>
          <?php //if ( $sms_balance>=1):?>
                    
            <div class="row top10">
                <div class="col-md-10">
                  <div class="dl-padding">
              <?php echo CHtml::textField('contact_phone',
              isset($client_info['contact_phone'])?$client_info['contact_phone']:''
              ,array(
               'class'=>'mobile_inputs grey-fields',
               'placeholder'=>Yii::t("default","Mobile Number"),
               'data-validation'=>"required",
               'maxlength'=>15
              ))?>
             </div>   
             </div>          
            </div>  
          
		  <?php //endif;?>
          <?php //endif;?>
          <?php //endif;?>
          <?php endif;?>
          
          
          <?php if (isset($is_guest_checkout)):?> <!--PICKUP GUEST-->
          <?php 
           $this->renderPartial('/front/guest-checkou-form',array(
		     'merchant_id'=>$merchant_id,
		     'transaction_type'=>$transaction_type
		   ));
          ?>                     
          <?php endif;?>  <!--PICKUP GUEST-->
          
          
     <?php else :?> <!-- DELIVERY-->                          	       	      
          
		  <?php FunctionsV3::sectionHeader('Delivery information')?>		 
      <div class="dl-padding"> 
		  <p>
	        <?php echo clearString(ucwords($merchant_info['restaurant_name']))?> <?php echo Yii::t("default","Restaurant")?> 
	        <?php echo "<span class='bold'>".Yii::t("default",ucwords($s['kr_delivery_options']['delivery_type'])) . "</span> ";
	        if ($s['kr_delivery_options']['delivery_asap']==1){
	        	$s['kr_delivery_options']['delivery_date']." ".Yii::t("default","ASAP");
	        } else {	          
	          echo '<span class="bold">'.Yii::app()->functions->translateDate(date("M d Y",strtotime($s['kr_delivery_options']['delivery_date']))).
	          " ".t("at"). " ". $s['kr_delivery_options']['delivery_time']."</span> ".t("to");
	        }
	        ?>
	       </p>	       
	       	      	</div>     
	       <div class="top10">
	       
	        <?php FunctionsV3::sectionHeader('Address')?> 
	        	       
	        <?php if (isset($is_guest_checkout)):?>	   
          <div class="dl-padding">      	        
	         <div class="row top10">
                <div class="col-md-10">
                 <?php echo CHtml::textField('first_name','',array(
	               'class'=>'grey-fields full-width',
	               'placeholder'=>Yii::t("default","First Name"),
	               'data-validation'=>"required"
	              ))?>
	             </div> 
              </div>
              
              <div class="row top10">
                <div class="col-md-10">
                 <?php echo CHtml::textField('last_name','',array(
	               'class'=>'grey-fields full-width',
	               'placeholder'=>Yii::t("default","Last Name"),
	               'data-validation'=>"required"
	              ))?>
	             </div> 
              </div>
            </div>
	        <?php endif;?> <!--$is_guest_checkout-->
	        <div class="dl-padding">
	        <?php if (!$search_by_location):?>
	        <?php if ( $website_enabled_map_address==2 ):?>	        
	        <div class="top10">
            <?php Widgets::AddressByMap()?>
            </div>
            <?php endif;?>
            
            <?php if ( $address_book):?>
            <div class="address_book_wrap">
            <div class="row top10">
                <div class="col-sm-12 col-md-12">
                <style>
							  #selectable .ui-selecting { background: #FECA40; }
							  #selectable .ui-selected { background: #F39814; color: white; }
							  </style>
               <?php 
               /*$address_list=Yii::app()->functions->addressBook(Yii::app()->functions->getClientId());
               echo CHtml::dropDownList('address_book_id',$address_book['id'],
               (array)$address_list,array(
                  'class'=>"grey-fields full-width"
               ));*/
               //var_dump($address_list);
               	
               	$address_list=Yii::app()->functions->getAddressBookByClient(Yii::app()->functions->getClientId());
               	echo CHtml::hiddenField('address_book_id', $address_book['id']);
               	$card = '<div class="" id="selectable">';
								foreach($address_list as $addr) {
									$def = $address_book['id']==$addr['id']?'ui-selected':'';
									$card .= '<div class="addressCard thumbnail col-sm-6 col-md-6 '.$def.'" id="'.$addr['id'].'">';
									$card .= '<div class="caption">';
									$card .= '<h3 class="">'.$addr['location_name'].'</h3>';
									$card .= '<p class="">'.$addr['address'].'</p>';
									$card .= '</div>';
									$card .= '</div>';
								}
								$card .= '</div>';
               	echo $card;
               ?>
               </div> 
              </div>  
            </div> <!--address_book_wrap-->
            <?php endif;?>
            <?php endif;?>
            </div>
            <div class="row">
            <div class="col-sm-12 col-md-12">
              <div class="dl-padding">
            <div class="addressCard thumbnail col-sm-6">
						<div class="caption">
							<h4 class="">
							<a href="javascript:;" class="center edit_address_book block top10"> Deliver to a new address</a>
							</h4>
							<p class=""></p>
						</div>
						</div>
          </div>
            </div>
            </div>
            
            <div class="address-block">
              <div class="row top10">
                <div class="col-md-10">
                  <div class="dl-padding">
                 <?php echo CHtml::textField('street', isset($client_info['street'])?$client_info['street']:'' ,array(
	               'class'=>'grey-fields full-width',
	               'placeholder'=>Yii::t("default","Street"),
	               'data-validation'=>"required"
	              ))?>
              </div>
	             </div> 
              </div>
              
           <?php if (!$search_by_location):?>    
              <div class="row top10">
                <div class="col-md-10">
                  <div class="dl-padding">
	             <?php echo CHtml::textField('city',
	             isset($client_info['city'])?$client_info['city']:''
	             ,array(
	               'class'=>'grey-fields full-width',
	               'placeholder'=>Yii::t("default","City"),
	               'data-validation'=>"required"
	              ))?>
              </div>
	             </div> 
              </div>
                         
            <div class="row top10">
                <div class="col-md-10">
                  <div class="dl-padding">
                 <?php echo CHtml::textField('state',
                 isset($client_info['state'])?$client_info['state']:''
                 ,array(
                 'class'=>'grey-fields full-width',
	               'placeholder'=>Yii::t("default","State"),
	               'data-validation'=>"required"
	              ))?>
              </div>
	             </div> 
              </div>  
              
             <div class="row top10">
                <div class="col-md-10">
                  <div class="dl-padding">
                  <?php echo CHtml::textField('zipcode',
                  isset($client_info['zipcode'])?$client_info['zipcode']:''
                  ,array(
	               'class'=>'grey-fields full-width',
	               'placeholder'=>Yii::t("default","Zip code")
	              ))?>
              </div>
	             </div> 
              </div> 
           
           <?php else :?>      
            <!--ADDRESS BY LOCATION -->
            <?php
             echo CHtml::hiddenField('city');
             echo CHtml::hiddenField('state');             
             echo CHtml::hiddenField('area_name');             
             $country_id=getOptionA('location_default_country'); $state_ids='';
             $location_search_data=FunctionsV3::getSearchByLocationData();
             //dump($location_search_data);
             ?>
             <div class="row top10">
                <div class="col-md-10">
                  <div class="dl-padding">
                 <?php
                 echo CHtml::dropDownList('state_id','',
                 (array)FunctionsV3::ListLocationState($country_id)
                 ,array(
                   'class'=>'grey-fields full-width',
                   'data-validation'=>"required"
                 ));
                 ?>
               </div>
	             </div> 
              </div>  
              
             <div class="row top10">
                <div class="col-md-10">
                  <div class="dl-padding">
                 <?php
                 echo CHtml::dropDownList('city_id','',
                 array(
                  ''=>t("Select City")
                 )
                 ,array(
                   'class'=>'grey-fields full-width',
                   'data-validation'=>"required"
                 ));
                 ?>
               </div>
	             </div> 
              </div>   
              
             <div class="row top10">
                <div class="col-md-10">
                  <div class="dl-padding">
                 <?php
                 echo CHtml::dropDownList('area_id','',
                 array(
                  ''=>t("Select Distric/Area/neighborhood")
                 )
                 ,array(
                   'class'=>'grey-fields full-width',
                   'data-validation'=>"required"
                 ));
                 ?>
               </div>
	             </div> 
              </div>    
              
             <div class="row top10">
                <div class="col-md-10">
                  <div class="dl-padding">
                  <?php echo CHtml::textField('zipcode',
                  isset($client_info['zipcode'])?$client_info['zipcode']:''
                  ,array(
	               'class'=>'grey-fields full-width',
	               'placeholder'=>Yii::t("default","Zip code")
	              ))?>
              </div>
	             </div> 
              </div>  
              
           <?php endif;?>
              
              
             <div class="row top10">
                <div class="col-md-10">
                  <div class="dl-padding">
                 <?php echo CHtml::textField('location_name',
                 isset($client_info['location_name'])?$client_info['location_name']:''
                 ,array(
	               'class'=>'grey-fields full-width',
	               'placeholder'=>Yii::t("default","Apartment suite, unit number, or company name")	               
	              ))?>
              </div>
	             </div> 
              </div> 
              
            </div> <!--address-block-->  
              
              <div class="row top10">
                <div class="col-md-10">
                  <div class="dl-padding">
                 <?php echo CHtml::textField('contact_phone',
                 isset($client_info['contact_phone'])?$client_info['contact_phone']:''
                 ,array(
	               'class'=>'grey-fields mobile_inputs full-width',
	               'placeholder'=>Yii::t("default","Mobile Number"),
	               'data-validation'=>"required",
	               'maxlength'=>15
	              ))?>
              </div>
	             </div> 
              </div>  
              
             <div class="row top10">
                <div class="col-md-10">
                  <div class="dl-padding">
                  <?php echo CHtml::textField('delivery_instruction','',array(
	               'class'=>'grey-fields full-width',
	               'placeholder'=>Yii::t("default","Delivery instructions")   
	              ))?>
              </div>
	             </div> 
              </div> 
              
             <div class="row top10">
                <div class="col-md-10">
                  <div class="dl-padding">
                  <?php
	              echo CHtml::checkBox('saved_address',false,array('class'=>"icheck",'value'=>2));
	              echo " ".t("Save to my address book");
	              ?>
              </div>
	             </div> 
              </div> 
              
             <?php if (isset($is_guest_checkout)):?>
             <div class="row top10">
                <div class="col-md-10">
                  <div class="dl-padding]">
                 <?php echo CHtml::textField('email_address','',array(
	               'class'=>'grey-fields full-width',
	               'placeholder'=>Yii::t("default","Email address"),              
	              ))?>
              </div>
	             </div> 
              </div>
                                          
             <?php endif;?> 
                                      
            
             <?php if (isset($is_guest_checkout)):?>
             <?php FunctionsV3::sectionHeader('Optional')?>		  
             <div class="row top10">
                <div class="col-md-10">
                  <div class="dl-padding">
                 <?php echo CHtml::passwordField('password','',array(
	               'class'=>'grey-fields full-width',
	               'placeholder'=>Yii::t("default","Password"),               
	              ))?>
              </div>
	             </div> 
              </div>
             <?php endif;?>
             
	       </div> <!--top10--> 
	        	        	               
     <?php endif;?> <!-- ENDIF DELIVERY-->
     
     
     <?php if($transaction_type=="dinein"):?>
     <div class="top30"></div>
     <?php FunctionsV3::sectionHeader('Table Information')?>
     
     <div class="row top10">	
        <div class="col-md-10">
          <div class="dl-padding">
         <?php echo CHtml::textField('dinein_number_of_guest','',array(
           'class'=>'grey-fields numeric_only',
           'placeholder'=>Yii::t("default","Number of guest"),
           'data-validation'=>"required",
          ))?>
        </div>
         </div> 
      </div>
      
      <div class="row top10">	
        <div class="col-md-10">
          <div class="dl-padding">
         <?php echo CHtml::textArea('dinein_special_instruction','',array(
           'class'=>'grey-fields full-width',
           'placeholder'=>Yii::t("default","Special instructions"),              
          ))?>
        </div>
         </div> 
      </div>
     
     <?php endif;?>
     
     <div class="top25">

     <?php 
	 $this->renderPartial('/front/payment-list',array(
	   'merchant_id'=>$merchant_id,
	   'payment_list'=>FunctionsV3::getMerchantPaymentListNew($merchant_id),
	   'transaction_type'=>$s['kr_delivery_options']['delivery_type']	   
	 ));
	 ?>
	 </div>
     
     <!--TIPS-->
     <?php if ( Yii::app()->functions->getOption("merchant_enabled_tip",$merchant_id)==2):?>
     <?php 
     $merchant_tip_default=Yii::app()->functions->getOption("merchant_tip_default",$merchant_id);
     if ( !empty($merchant_tip_default)){
    	echo CHtml::hiddenField('default_tip',$merchant_tip_default);
     }        
     $FunctionsK=new FunctionsK();
     $tips=$FunctionsK->tipsList();        
     ?>	   
	   <div class="section-label top25">
	    <a class="section-label-a">
	      <span class="bold">
	        <?php echo t("Tip Amount")?> (<span class="tip_percentage">0%</span>)
	      </span>
	      <b></b>
	    </a>     
	   </div>          
	   
	    <div class="uk-panel uk-panel-box">
	     <ul class="tip-wrapper">
	       <?php foreach ($tips as $tip_key=>$tip_val):?>           
	       <li>
	       <a class="tips" href="javascript:;" data-type="tip" data-tip="<?php echo $tip_key?>">
	       <?php echo $tip_val?>
	       </a>
	
	       </li>
	       <?php endforeach;?>           
	       <li><a class="tips tip_cash" href="javascript:;" data-type="cash" data-tip="0"><?php echo t("Tip cash")?></a></li>
	       <li><?php echo CHtml::textField('tip_value','',array(
	         'class'=>"numeric_only grey-fields",
	         'style'=>"width:70px;"
	       ));?>
	       </li>
	       <li>           
           <button type="button" class="apply_tip green-button"><?php echo t("Apply")?></button>
           </li> 
	     </ul>
	    </div>	       
     <?php endif;?>
     <!--END TIPS-->
     
     </form>    
     
     <!--CREDIT CART-->
     <?php 
     $this->renderPartial('/front/credit-card',array(
	   'merchant_id'=>$merchant_id	   
	 ));
	 ?>     
     <!--END CREDIT CART-->
     
     </div> <!--box rounded-->
     
     </div> <!--left content-->
     
     <div class="col-md-5  sticky-div"><!-- RIGHT CONTENT STARTS HERE-->
     
       <div class="   relative new-cart ">
       
       
       
	       <div class="order-list-wrap">   
	       
	         <h2 class="order-title-new"><?php echo t("Your Order")?></h2>
	         <div class="item-order-wrap"></div>
	       
	         <!--VOUCHER STARTS HERE-->
            <?php Widgets::applyVoucher($merchant_id);?>
            <!--VOUCHER STARTS HERE-->
            
            <?php 
            if (FunctionsV3::hasModuleAddon("pointsprogram")){
            	/*POINTS PROGRAM*/
                PointsProgram::redeemForm();
            }
            ?>
	         
	         <?php 	         
	         $minimum_order=Yii::app()->functions->getOption('merchant_minimum_order',$merchant_id);
	         $maximum_order=getOption($merchant_id,'merchant_maximum_order');	         
	         if ( $s['kr_delivery_options']['delivery_type']=="pickup"){
	         	
	          	  $minimum_order=Yii::app()->functions->getOption('merchant_minimum_order_pickup',$merchant_id);
	          	  $maximum_order=getOption($merchant_id,'merchant_maximum_order_pickup');	     
	          	      
	         } elseif ( $s['kr_delivery_options']['delivery_type']=="dinein"){
	         	  $minimum_order=getOption($merchant_id,'merchant_minimum_order_dinein');
	         	  $maximum_order=getOption($merchant_id,'merchant_maximum_order_dinein');
	         }	         	         
	         ?>
	         
	         <?php 
	         if (!empty($minimum_order)){
	         	echo CHtml::hiddenField('minimum_order',unPrettyPrice($minimum_order));
	            echo CHtml::hiddenField('minimum_order_pretty',baseCurrency().prettyFormat($minimum_order));
	            ?>
	            <p class="small center"><?php echo t("Subtotal must exceed")?> 
                 <?php echo baseCurrency().prettyFormat($minimum_order,$merchant_id)?>
                </p>      
	            <?php
	         }
	         if($maximum_order>0){
	         	echo CHtml::hiddenField('maximum_order',unPrettyPrice($maximum_order));
	         	echo CHtml::hiddenField('maximum_order_pretty',baseCurrency().prettyFormat($maximum_order));
	         }
	         ?>
	         
	         <?php //if ( getOptionA('captcha_order')==2 || getOptionA('captcha_customer_signup')==2):?>             
	         <?php if ( getOptionA('captcha_order')==2):?>             
             <div class="top10 capcha-wrapper">
             <?php //GoogleCaptcha::displayCaptcha()?>
             <div id="kapcha-1"></div>
             </div>
             <?php endif;?>          
             
              <!--SMS Order verification-->
	          <?php if ( getOptionA('mechant_sms_enabled')==""):?>
	          <?php if ( getOption($merchant_id,'order_verification')==2):?>
	          <?php $sms_balance=Yii::app()->functions->getMerchantSMSCredit($merchant_id);?>
	          <?php if ( $sms_balance>=1):?>
	          <?php $sms_order_session=Yii::app()->functions->generateCode(50);?>
	          <p class="top20 center">
	          <?php echo t("This merchant has required SMS verification")?><br/>
	          <?php echo t("before you can place your order")?>.<br/>
	          <?php echo t("Click")?> <a href="javascript:;" class="send-order-sms-code" data-session="<?php echo $sms_order_session;?>">
	             <?php echo t("here")?></a>
	          <?php echo t("receive your order sms code")?>
	          </p>
	          <div class="top10 text-center">
	          <?php 
	          echo CHtml::textField('order_sms_code','',array(	            
	            'placeholder'=>t("SMS Code"),
	            'maxlength'=>8,
	            'class'=>'grey-fields text-center'
	          ));
	          ?>
	          </div>
	          <?php endif;?>
	          <?php endif;?>
	          <?php endif;?>
	          <!--END SMS Order verification-->
           
	          <div class="text-center ">
	          <a href="javascript:;" class="place_order green-button medium inline block checkout">
	          <?php echo t("Place Order")?>
	          </a>
	          </div>
	         
	       </div> <!-- order-list-wrap-->       
	   </div> <!--box-grey-->    
     
     </div> <!--right content-->
     
     <?php else :?>      
       <div class="box-grey rounded">
      <p class="text-danger">
      <?php echo t("Something went wrong Either your visiting the page directly or your session has expired.")?></p>
      </div>
     <?php endif;?>
		
   </div>  <!--container-->
</div> <!--section-payment-option-->
<style type="text/css">
@import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,700');
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
  font-size: 18px;
  font-weight: 400 !important;
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
#frm-delivery {
  background: #fff;
  padding: 0px 0px 20px;
  border: 1px solid #eee;
}
#frm-delivery .grey-fields {
  background: #fff;
  border: 1px solid #f0f0f0;
}
.addressCard .caption {
  background: #f8f8f8;
  border: 1px solid #f0f0f0;
  border-top: 5px solid #e7e7e7e6;
  border-radius: 0px;
 /* -webkit-box-shadow: 0px 0px 16px 0px rgba(0,0,0,0.11);
  -moz-box-shadow: 0px 0px 16px 0px rgba(0,0,0,0.11);
  box-shadow: 0px 0px 16px 0px rgba(0, 0, 0, 0.11);*/
  margin: 10px;

  background: #fff;

border: 1px solid #f0f0f0;

    border-top-color: rgb(240, 240, 240);
    border-top-style: solid;
    border-top-width: 1px;

border-top: 1px solid #f0f0f0;

border-radius: 0px;

-webkit-box-shadow: none;

margin: 10px;
}
.addressCard  .caption {
    padding: 20px 20px 20px 20px;
    color: #333;
}
.addressCard .caption  h3 {
  text-align: left;
  text-transform: uppercase;
  font-size: 18px;
  font-weight: 700;
}
.addressCard .caption p {
      font-size: 12px!important;
}
.addressCard  .options {
  width: 90px;
  display: flex;
  margin-top: -30px;
}
.addressCard   .options i {
  font-size: 18px;
  background: #121212;
  width: 40px;
  display: block;
  height: 40px;
  line-height: 41px;
  text-align: center;

  border-radius: 100%;
  color: #fff;
  margin: 2px;
}
.addressCard  .options i::before {
  line-height: 38px;
}
.addressCard {
  border: none;
}
#selectable .ui-selected .addressCard  {
  background: #e4e4e4;
  color: #333;
}
#selectable .ui-selected  {
  background: transparent;
}
.addressCard  p {
  margin-top: 0px!important;
}
.addressCard h3 {
  font-size: 18px!important;
  font-weight: 600;
  margin-bottom: 0px;
}
.ui-selected .caption {
 
  -webkit-box-shadow: 0px 0px 16px 0px rgba(0,0,0,0.11);
  -moz-box-shadow: 0px 0px 16px 0px rgba(0,0,0,0.11);
  box-shadow: 0px 0px 16px 0px rgba(0, 0, 0, 0.11);


  
}
#selectable .ui-selected {
  color: #333!important;
}
#selectable .ui-selected .caption {
  background: #fff !important;
border-top: 1px solid #f0f0f0;
}
.addressCard:active {
  background: transparent;
}
.ui-selecting {
  background: transparent!important;
}
.addressCard {
  margin: 0px;
}
.addressCard h4 {
  font-size: 15px!important;
  text-align: left;
  font-weight: 300;
  font-family: 'Open Sans', sans-serif;

}
.addressCard h4 a {
  color: #333!important;
  text-decoration: none;
  text-align: left;
  font-family: 'Open Sans', sans-serif;
  padding-top: 30px;
}
.addressCard h4 a:hover {
  color: #000!important;
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
.section-label {
  background: #eee;
  padding: 5px 20px;
}
.dl-padding {
  padding: 5px 20px;
}
.redeem-wrap {
    display: flex;
    width: 85%;
    position: relative;
    margin: 0px auto;
    padding: 30px 30px 20px 30px;
    border: 3px dashed #ddd;
    margin-bottom: 20px;
}
.redeem-wrap input {
  width: 70%;
  height: 40px;
  background: #fff;
  border: 1px solid #ddd;
  text-align: left;
}
.redeem-wrap button {
  width: 30%;
  height: 40px;
  margin: 0px!important;
  display: block!important;
  background: #60ba62;
  border: 1px solid #60ba62;
}
</style>
