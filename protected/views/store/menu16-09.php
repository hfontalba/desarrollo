<?php
/*POINTS PROGRAM*/
if (FunctionsV3::hasModuleAddon("pointsprogram")){
	unset($_SESSION['pts_redeem_amt']);
	unset($_SESSION['pts_redeem_points']);
}

$merchant_photo_bg=getOption($merchant_id,'merchant_photo_bg');
if ( !file_exists(FunctionsV3::uploadPath()."/$merchant_photo_bg")){
	$merchant_photo_bg='';
} 

/*RENDER MENU HEADER FILE*/

/*GET MINIMUM ORDER*/

$min_fees=FunctionsV3::getMinOrderByTableRates($merchant_id,
   $distance,
   $distance_type,
   $data['minimum_order']
);

$ratings=Yii::app()->functions->getRatings($merchant_id);   
$merchant_info=array(   
  'merchant_id'=>$merchant_id ,
  //'minimum_order'=>$data['minimum_order'],
  'minimum_order'=>$min_fees,
  'ratings'=>$ratings,
  'merchant_address'=>$data['merchant_address'],
  'cuisine'=>$data['cuisine'],
  'restaurant_name'=>$data['restaurant_name'],
  'background'=>$merchant_photo_bg,
  'merchant_website'=>$merchant_website,
  'merchant_logo'=>FunctionsV3::getMerchantLogo($merchant_id),
  'contact_phone'=>$data['contact_phone'],
  'restaurant_phone'=>$data['restaurant_phone'],
  'social_facebook_page'=>$social_facebook_page,
  'social_twitter_page'=>$social_twitter_page,
  'social_google_page'=>$social_google_page,
);
$this->renderPartial('/front/menu-header',$merchant_info);

/*ADD MERCHANT INFO AS JSON */
$cs = Yii::app()->getClientScript();
$cs->registerScript(
  'merchant_information',
  "var merchant_information =".json_encode($merchant_info)."",
  CClientScript::POS_HEAD
);		

/*PROGRESS ORDER BAR*/
$this->renderPartial('/front/order-progress-bar',array(
   'step'=>3,
   'show_bar'=>true
));

$now=date('Y-m-d');
$now_time=date('h:i A');//, strtotime("+30 minutes")

$checkout=FunctionsV3::isMerchantcanCheckout($merchant_id); 
$menu=Yii::app()->functions->getMerchantMenu($merchant_id , isset($_GET['sname'])?$_GET['sname']:'' ); 
//dump($menu);die();

//dump($checkout);

echo CHtml::hiddenField('is_merchant_open',isset($checkout['code'])?$checkout['code']:'' );

/*hidden TEXT*/
echo CHtml::hiddenField('restaurant_slug',$data['restaurant_slug']);
echo CHtml::hiddenField('merchant_id',$merchant_id);
echo CHtml::hiddenField('is_client_login',Yii::app()->functions->isClientLogin());

echo CHtml::hiddenField('website_disbaled_auto_cart',
Yii::app()->functions->getOptionAdmin('website_disbaled_auto_cart'));

$hide_foodprice=Yii::app()->functions->getOptionAdmin('website_hide_foodprice');
echo CHtml::hiddenField('hide_foodprice',$hide_foodprice);

echo CHtml::hiddenField('accept_booking_sameday',getOption($merchant_id
,'accept_booking_sameday'));

echo CHtml::hiddenField('customer_ask_address',getOptionA('customer_ask_address'));

echo CHtml::hiddenField('merchant_required_delivery_time',
  Yii::app()->functions->getOption("merchant_required_delivery_time",$merchant_id));   
  
/** add minimum order for pickup status*/
$merchant_minimum_order_pickup=Yii::app()->functions->getOption('merchant_minimum_order_pickup',$merchant_id);
if (!empty($merchant_minimum_order_pickup)){
	  echo CHtml::hiddenField('merchant_minimum_order_pickup',$merchant_minimum_order_pickup);
	  
	  echo CHtml::hiddenField('merchant_minimum_order_pickup_pretty',
         displayPrice(baseCurrency(),prettyFormat($merchant_minimum_order_pickup)));
}
 
$merchant_maximum_order_pickup=Yii::app()->functions->getOption('merchant_maximum_order_pickup',$merchant_id);
if (!empty($merchant_maximum_order_pickup)){
	  echo CHtml::hiddenField('merchant_maximum_order_pickup',$merchant_maximum_order_pickup);
	  
	  echo CHtml::hiddenField('merchant_maximum_order_pickup_pretty',
         displayPrice(baseCurrency(),prettyFormat($merchant_maximum_order_pickup)));
}  

/*add minimum and max for delivery*/
//$minimum_order=Yii::app()->functions->getOption('merchant_minimum_order',$merchant_id);
$minimum_order=$min_fees;
if (!empty($minimum_order)){
	echo CHtml::hiddenField('minimum_order',unPrettyPrice($minimum_order));
	echo CHtml::hiddenField('minimum_order_pretty',
	 displayPrice(baseCurrency(),prettyFormat($minimum_order))
	);
}
$merchant_maximum_order=Yii::app()->functions->getOption("merchant_maximum_order",$merchant_id);
 if (is_numeric($merchant_maximum_order)){
 	echo CHtml::hiddenField('merchant_maximum_order',unPrettyPrice($merchant_maximum_order));
    echo CHtml::hiddenField('merchant_maximum_order_pretty',baseCurrency().prettyFormat($merchant_maximum_order));
 }

$is_ok_delivered=1;
if (is_numeric($merchant_delivery_distance)){
	if ( $distance>$merchant_delivery_distance){
		$is_ok_delivered=2;
		/*check if distance type is feet and meters*/
		//if($distance_type=="ft" || $distance_type=="mm" || $distance_type=="mt"){
		if($distance_type=="ft" || $distance_type=="mm" || $distance_type=="mt" || $distance_type=="meter"){
			$is_ok_delivered=1;
		}
	}
} 

echo CHtml::hiddenField('is_ok_delivered',$is_ok_delivered);
echo CHtml::hiddenField('merchant_delivery_miles',$merchant_delivery_distance);
echo CHtml::hiddenField('unit_distance',$distance_type);
echo CHtml::hiddenField('from_address', FunctionsV3::getSessionAddress() );

echo CHtml::hiddenField('merchant_close_store',getOption($merchant_id,'merchant_close_store'));
/*$close_msg=getOption($merchant_id,'merchant_close_msg');
if(empty($close_msg)){
	$close_msg=t("This restaurant is closed now. Please check the opening times.");
}*/
echo CHtml::hiddenField('merchant_close_msg',
isset($checkout['msg'])?$checkout['msg']:t("Sorry merchant is closed."));

echo CHtml::hiddenField('disabled_website_ordering',getOptionA('disabled_website_ordering'));
echo CHtml::hiddenField('web_session_id',session_id());

echo CHtml::hiddenField('merchant_map_latitude',$data['latitude']);
echo CHtml::hiddenField('merchant_map_longtitude',$data['lontitude']);
echo CHtml::hiddenField('restaurant_name',$data['restaurant_name']);


echo CHtml::hiddenField('current_page','menu');

if ($search_by_location){
	echo CHtml::hiddenField('search_by_location',$search_by_location);
}

echo CHtml::hiddenField('minimum_order_dinein',FunctionsV3::prettyPrice($minimum_order_dinein));
echo CHtml::hiddenField('maximum_order_dinein',FunctionsV3::prettyPrice($maximum_order_dinein));

/*add meta tag for image*/
Yii::app()->clientScript->registerMetaTag(
Yii::app()->getBaseUrl(true).FunctionsV3::getMerchantLogo($merchant_id)
,'og:image');

$remove_delivery_info=false;
if($data['service']==3 || $data['service']==6 || $data['service']==7 ){	
	$remove_delivery_info=true;
}

/*CHECK IF MERCHANT SET TO PREVIEW*/
$is_preview=false;
if ($food_viewing_private==2){		
	if (isset($_GET['preview'])){
		if($_GET['preview']=='true'){
			if(!isset($_GET['token'])){
				$_GET['token']='';
			}
			if (md5($data['password'])==$_GET['token']){
			   $is_preview=true;
			}
		}
	}
	if($is_preview==false){
		$menu='';
		$enabled_food_search_menu='';
	}
}
?>

<div class="sections section-menu section-grey2" id="my-food-menu">
<div class="container">
  <div class="row">

     <div class="col-md-8 border menu-left-content">
         
        <div class="tabs-wrapper" id="menu-tab-wrapper">
	    <ul id="tabs">
		    <li class="active">
		       <span><?php echo t("Menu")?></span>
		       <i class="ion-fork"></i>
		    </li>
		    
		    <?php if ($theme_hours_tab==""):?>
		    <li>
		       <span><?php echo t("Opening Hours")?></span>
		       <i class="ion-clock"></i>
		    </li>
		    <?php endif;?>
		    
		    <?php if ($theme_reviews_tab==""):?>
		    <li class="view-reviews">
		       <span><?php echo t("Reviews")?></span>
		       <i class="ion-ios-star-half"></i>
		    </li>
		    <?php endif;?>
		    
		    <?php if ($theme_map_tab==""):?>
		    <li class="view-merchant-map">
		       <span><?php echo t("Map")?></span>
		       <i class="ion-ios-navigate-outline"></i>
		    </li>
		    <?php endif;?>
		    
		    <?php if ($booking_enabled):?>
		      <li>
		      <span><?php echo t("Book a Table")?></span>
		      <i class="ion-coffee"></i>
		      </li>
		    <?php endif;?>
		    
		    <?php if ($photo_enabled):?>
		      <li class="view-merchant-photos">
		       <span><?php echo t("Photos")?></span>
		       <i class="ion-images"></i>
		      </li>
		    <?php endif;?>
		    
		    <?php if ($theme_info_tab==""):?>
		    <li>
		      <span><?php echo t("Information")?></span>
		      <i class="ion-ios-information-outline"></i>
		    </li>
		    <?php endif;?>
		    
		    <?php if ( $promo['enabled']==2 && $theme_promo_tab==""):?>
		      <li>
		       <span><?php echo t("Promos")?></span>
		       <i class="ion-pizza"></i>
		      </li>
		    <?php endif;?>
		</ul>
		
		<ul id="tab">
		
		<!--MENU-->
	    <li class="active">
	        <div class="row">
			 <div class="col-md-4 col-xs-4 border category-list">
				<div class="theiaStickySidebar">
				 <?php 
				 $this->renderPartial('/front/menu-category',array(
				  'merchant_id'=>$merchant_id,
				  'menu'=>$menu			  
				 ));
				 ?>
				</div>
			 </div> <!--col-->
			 <div class="col-md-8 col-xs-8 border" id="menu-list-wrapper">
			 
			 <?php if($enabled_food_search_menu==1):?>
			 <form method="GET" class="frm-search-food">			   
			 
			 <?php 
			 if($is_preview==true){
				 if(isset($_GET['preview'])){
				 	echo CHtml::hiddenField('preview','true');
				 }
				 if(isset($_GET['token'])){
				 	echo CHtml::hiddenField('token',$_GET['token']);
				 }
			 }
			 ?>
			 
			 <div class="search-food-wrap">						   
			   <?php echo CHtml::textField('sname',
			   isset($_GET['sname'])?$_GET['sname']:''
			   ,array(
			     'placeholder'=>t("Search"),
			     'class'=>"form-control search_foodname required"
			   ))?>
			   <button type="submit"><i class="ion-ios-search"></i></button>
			 </div>
			 <?php if (isset($_GET['sname'])):?> 
			     <a href="<?php echo Yii::app()->createUrl('store/menu-'.$data['restaurant_slug'])?>">
			     [<?php echo t("Clear")?>]
			     </a>
			     <div class="clear"></div>
			   <?php endif;?>
			 </form>
			 <?php endif;?>
			 
			 <?php 
			 $admin_activated_menu=getOptionA('admin_activated_menu');			 
			 $admin_menu_allowed_merchant=getOptionA('admin_menu_allowed_merchant');
			 if ($admin_menu_allowed_merchant==2){			 	 
			 	 $temp_activated_menu=getOption($merchant_id,'merchant_activated_menu');			 	 
			 	 if(!empty($temp_activated_menu)){
			 	 	 $admin_activated_menu=$temp_activated_menu;
			 	 }
			 }			 
			 
			 $merchant_tax=getOption($merchant_id,'merchant_tax');
			 if($merchant_tax>0){
			    $merchant_tax=$merchant_tax/100;
			 }
				
			 switch ($admin_activated_menu)
			 {
			 	case 1:
			 		$this->renderPartial('/front/menu-merchant-2',array(
					  'merchant_id'=>$merchant_id,
					  'menu'=>$menu,
					  'disabled_addcart'=>$disabled_addcart
					));
			 		break;
			 		
			 	case 2:			 		
			 		$this->renderPartial('/front/menu-merchant-3',array(
					  'merchant_id'=>$merchant_id,
					  'menu'=>$menu,
					  'disabled_addcart'=>$disabled_addcart
					));
			 		break;
			 			
			 	default:	
				 	$this->renderPartial('/front/menu-merchant-1',array(
					  'merchant_id'=>$merchant_id,
					  'menu'=>$menu,
					  'disabled_addcart'=>$disabled_addcart,
					  'tc'=>$tc,
					  'merchant_apply_tax'=>getOption($merchant_id,'merchant_apply_tax'),
					  'merchant_tax'=>$merchant_tax>0?$merchant_tax:0,
					));
			    break;
			 }			 
			 ?>			
			 </div> <!--col-->
			</div> <!--row-->
	    </li>
	    <!--END MENU-->
	    
	    
	    <!--OPENING HOURS-->
	    <?php if ($theme_hours_tab==""):?>
	    <li>	       	     
	    <?php
	    $this->renderPartial('/front/merchant-hours',array(
	      'merchant_id'=>$merchant_id
	    )); ?>           
	    </li>
	    <?php endif;?>
	    <!--END OPENING HOURS-->
	    
	    <!--MERCHANT REVIEW-->
	    <?php if ($theme_reviews_tab==""):?>
	    <li class="review-tab-content">	       	     
	    <?php $this->renderPartial('/front/merchant-review',array(
	      'merchant_id'=>$merchant_id
	    )); ?>           
	    </li>
	    <?php endif;?>
	    <!--END MERCHANT REVIEW-->
	    
	    <!--MERCHANT MAP-->
	    <?php if ($theme_map_tab==""):?>
	    <li>	        	
	    <?php $this->renderPartial('/front/merchant-map'); ?>        
	    </li>
	    <?php endif;?>
	    <!--END MERCHANT MAP-->
	    
	    <!--BOOK A TABLE-->
	    <?php if ($booking_enabled):?>
	    <li>
	    <?php $this->renderPartial('/front/merchant-book-table',array(
	      'merchant_id'=>$merchant_id
	    )); ?>        
	    </li>
	    <?php endif;?>
	    <!--END BOOK A TABLE-->
	    
	    <!--PHOTOS-->
	    <?php if ($photo_enabled):?>
	    <li>
	    <?php 
	    $gallery=Yii::app()->functions->getOption("merchant_gallery",$merchant_id);
        $gallery=!empty($gallery)?json_decode($gallery):false;
	    $this->renderPartial('/front/merchant-photos',array(
	      'merchant_id'=>$merchant_id,
	      'gallery'=>$gallery
	    )); ?>        
	    </li>
	    <?php endif;?>
	    <!--END PHOTOS-->
	    
	    <!--INFORMATION-->
	    <?php if ($theme_info_tab==""):?>
	    <li>
	        <div class="box-grey rounded " style="margin-top:0;">
	          <?php echo getOption($merchant_id,'merchant_information')?>
	        </div>
	    </li>
	    <?php endif;?>
	    <!--END INFORMATION-->
	    
	    <!--PROMOS-->
	    <?php if ( $promo['enabled']==2 && $theme_promo_tab==""):?>
	    <li>
	    	<div class="promos">
	    <?php $this->renderPartial('/front/merchant-promo',array(
	      'merchant_id'=>$merchant_id,
	      'promo'=>$promo
	    )); ?>  
	    </div>      
	    </li>
	    <?php endif;?>
	    <!--END PROMOS-->
	    
	    
	   </ul>
	   </div>
     
     </div> <!-- menu-left-content-->
     
     <?php if (getOptionA('disabled_website_ordering')!="yes"):?>
     <div id="menu-right-content" class="col-md-4 border menu-right-content <?php echo $disabled_addcart=="yes"?"hide":''?>" >
     
     <div class="theiaStickySidebar">
      <div class="box-grey rounded  relative">
              
        
        <?php else :?>
        
        <?php endif;?>
        
        <!--CART-->
        <div class="inner line-top relative new-cart">
        
           
           
          <h2 class="order-title-new"><?php echo t("Your Order")?></h2>
           
           <div class="item-order-wrap"></div>
           
           <!--VOUCHER STARTS HERE-->
           <?php Widgets::applyVoucher($merchant_id);?>
           <!--VOUCHER STARTS HERE-->
           
           <!--MAX AND MIN ORDR-->
           <?php if ($minimum_order>0):?>
           <div class="delivery-min">
              <p class="small center"><?php echo Yii::t("default","Subtotal must exceed")?> 
              <?php echo displayPrice(baseCurrency(),prettyFormat($minimum_order,$merchant_id))?>
           </div>
           <?php endif;?>
           
           <?php if ($merchant_minimum_order_pickup>0):?>
           <div class="pickup-min">
              <p class="small center"><?php echo Yii::t("default","Subtotal must exceed")?> 
              <?php echo displayPrice(baseCurrency(),prettyFormat($merchant_minimum_order_pickup,$merchant_id))?>
           </div>
           <?php endif;?>
                      
           <?php if($minimum_order_dinein>0):?>
           <div class="dinein-min">
              <p class="small center"><?php echo Yii::t("default","Subtotal must exceed")?> 
              <?php echo FunctionsV3::prettyPrice($minimum_order_dinein)?>
           </div>
           <?php endif;?>
              
	        <a href="javascript:;" class="clear-cart">[<?php echo t("Clear Order")?>]</a>
           
        </div> <!--inner-->
        <!--END CART-->
        
        <!--DELIVERY OPTIONS-->
        <div class="inner line-top relative delivery-option center dl-options">
           
           
           
           <h2 class="order-title-new"><?php echo t("Delivery Options")?></h2>
           
           <div class="dl-sub">

           <?php echo CHtml::radioButtonList('delivery_type', 'delivery',
           (array)Yii::app()->functions->DeliveryOptions($merchant_id),array(
             'class'=>'grey-fields',
							'separator'=>'&nbsp;&nbsp;',
           ))?>
           
           <?php echo CHtml::hiddenField('delivery_date',$now)?>
           <?php echo CHtml::textField('delivery_date1',
            FormatDateTime($now,false),array('class'=>"j_date grey-fields",'data-id'=>'delivery_date'))?>
           
           <div class="delivery_asap_wrap">            
            <?php $detect = new Mobile_Detect;?>           
            <?php if ( $detect->isMobile() ) :?>
             <?php                           
             echo CHtml::dropDownList('delivery_time',$now_time,
             (array)FunctionsV3::timeList()
             ,array(
              'class'=>"grey-fields"
             ))
             ?>
            <?php else :?>                   
	         <?php echo CHtml::textField('delivery_time',$now_time,
	          array('class'=>"timepick grey-fields",'placeholder'=>Yii::t("default","Delivery Time")))?>
	       <?php endif;?>  	          	  

	          <?php if ( $checkout['is_pre_order']==2):?>         
	          <span class="delivery-asap">
	           <?php echo CHtml::checkBox('delivery_asap',true,array('class'=>"icheck"))?>
	            <span class="text-muted"><?php echo Yii::t("default","I Prefer a Quick Delivery")?></span>	          
	         </span>       	         	        	     
	         <?php endif;?>    
	         </div>
           </div><!-- delivery_asap_wrap-->
           
           <?php if ( $checkout['code']==1):?>
              <a href="javascript:;" class="orange-button medium checkout"><?php echo $checkout['button']?></a>
           <?php else :?>
              <?php if ( $checkout['holiday']==1):?>
                 <?php echo CHtml::hiddenField('is_holiday',$checkout['msg'],array('class'=>'is_holiday'));?>
                 <p class="text-danger"><?php echo $checkout['msg']?></p>
              <?php else :?>
                 <p class="text-danger"><?php echo $checkout['msg']?></p>
                 <p class="small">
                 <?php echo Yii::app()->functions->translateDate(date('F d l')."@".timeFormat(date('c'),true));?></p>
              <?php endif;?>
           <?php endif;?>
                                                                
        </div> <!--inner-->
        <!--END DELIVERY OPTIONS-->
        <!--DELIVERY INFO-->
        <?php if ($remove_delivery_info==false):?>
        
        <div class="inner center dl-options" >
        	<h2 class="order-title-new"><?php echo t("Delivery Information")?></h2>
         <button type="button" class="close modal-close-btn" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button> 
            <div class="dl-info">
	        
	        <p>
	        <?php 
	        if(!$search_by_location){
		        if ($distance){
		        	echo t("Distance").": ".number_format($distance,1)." $distance_type";
		        } else echo  t("Distance").": ".t("not available");
	        }
	        ?>
	        </p>
	        
	        <p class="delivery-fee-wrap">
	        <?php echo t("Estimation")?>: <?php echo FunctionsV3::getDeliveryEstimation($merchant_id)?></p>
	        
	        <p class="delivery-fee-wrap">
	        <?php 
	        if(!$search_by_location){
		        if (!empty($merchant_delivery_distance)){
		        	echo t("Distance Covered").": ".$merchant_delivery_distance." $distance_type_orig";
		        } else echo  t("Distance Covered").": ".t("not available");
	        }
	        ?>
	        </p>
	        
	        <p class="delivery-fee-wrap">
	        <?php 
	        if ($delivery_fee){
	             echo t("Delivery Fee").": ".FunctionsV3::prettyPrice($delivery_fee);
	        } else echo  t("Delivery Fee").": ".t("Free Delivery");
	        ?>
	        </p>
	        
	        <?php if($search_by_location):?>
	        <a href="javascript:;" class="top10 green-color change-location block text-center">
	        [<?php echo t("Change Location here")?>]
	        </a>
	        <?php else:?>
	        <a href="javascript:;" class="top10 green-color change-address block text-center">
	        <?php echo t("Change Your Address ?")?>
	        </a>
	        <?php endif;?>
	    </div>
	        
        </div>
        <!--END DELIVERY INFO-->
        
      </div> <!-- box-grey-->
      </div> <!--end theiaStickySidebar-->
     
     </div> <!--menu-right-content--> 
     <?php endif;?>
  
  </div> <!--row-->
</div> <!--container-->
</div> <!--section-menu-->

<style type="text/css">
@import url('https://fonts.googleapis.com/css?family=Open+Sans:400,700');
#my-food-menu #menu-tab-wrapper	{
	border: 0px;
}
#my-food-menu #menu-tab-wrapper ul#tab {
	padding: 15px 20px;
	background: #fff;
}
#my-food-menu #menu-tab-wrapper .category a {
	display: block;
    color: #999ba3;
    font-size: 12px;
    border: none;
    background: transparent;
    border-bottom: 1px solid #dee1e9;
    font-family: "Open Sans";
    padding: 13px 0;
    text-decoration: none;
    outline: none;
}
#my-food-menu #menu-tab-wrapper  .box-grey {
	border: 0px;
	padding: 10px 0px;
}
.form-control:focus {
	box-shadow: none;
}
#my-food-menu #menu-tab-wrapper  .menu-item p.bold {
	
	font-weight: 700;
	font-family: 'Open Sans', sans-serif;
	font-size: 14px;
	line-height: 24px;
    letter-spacing: 0px !important;
    text-transform: capitalize !important;
    color: #333333 !important;
}
#menu-list-wrapper h2 {
	color: #000!important;
	font-weight: 300;
	font-family: 'Open Sans', sans-serif;
	font-size: 16px;
	line-height: 24px;
	border-bottom: 0px solid #eb6825 !important;
display: inline-block;
position: relative;
padding-bottom: 9px;
}
#menu-list-wrapper h2::after {
	width: 27px;
	height: 2px;
	position: absolute;
	left: 0px;
	bottom: 0px;
	content: "";
	background: #20ac76;
}
.menu-3 a.menu-item .row {
	border-bottom: 1px solid #ece6e6;
	padding-top: 6px;
	padding-bottom: 15px;
	margin-bottom: 10px;
	display: flex;
	align-items: center;
	border-top: 0px;
	margin-left: 0px;
margin-right: 0px;
}
#menu-list-wrapper .food-description {
	min-height: auto!important;
}
.menu-3 a.menu-item:hover .row {
	background: transparent;
}
.menu-3 .bottom20 {
    margin-bottom: 50px;
}
.menu-3 .food-description {
	color: #757575;

}
.add-plus {
	width: 30px;
	height: 30px;
	position: relative;
	border: 1px solid #60ba62;
	border-radius: 100%;

}
.add-plus::before {
	width: 1px;
	height: 10px;
	position: absolute;
	background: #60ba62;
	top: 0px;
	left: 0px;
	right: 0px;
	bottom: 0px;
	margin: auto;
	content: "";
}
.add-plus::after {
	width: 10px;
	height: 1px;
	position: absolute;
	background: #60ba62;
	top: 0px;
	left: 0px;
	right: 0px;
	bottom: 0px;
	margin: auto;
	content: "";
}
.menu-list-row {
	display: flex;
	align-items: center;
}
.menu-list-row  .col-md-3 {
	display: flex;
	align-items: center;
}
.menu-list-row  .col-md-3 p {
	width: 70%;
	padding: 0px;
	margin: 0px!important;
}
ul#tabs li {
    display: inline-block;
    padding: 15px 15px 11px;
    margin-bottom: 4px;
    cursor: pointer;
    margin-bottom: -1px;
}
.custom-flex-row {
	display: flex;
	align-items: center;
}
.custom-flex-row .col-md-4 {
	width: 100%;
}
.merchant-opening-hours .row {
	border-top: 1px solid #e6e6e6;
	padding-top: 15px;
	padding-bottom: 15px;
}
.write-review-new {
	border-radius: 30px;
	padding: 10px 30px;
}
.orange-button {
	border-radius: 30px;
	padding: 10px 30px;
}
#book-table-form  input[type="text"],
#book-table-form  input[type="email"],
#book-table-form  input[type="tel"],
#book-table-form  textarea {
	background-color: #fbfcfd;
    border: 1px solid #eaecf2;
    color: #9fa1a9;
    font-size: 12px;
    width: 100%;
    height: 34px;
    padding-top: 0;
    padding-bottom: 0;
    line-height: 34px;
    border-radius: 3px;
    position: relative;
    margin-bottom: 10px;
}
#book-table-form  textarea {
	height: 100px;
}
.book-table-button {
	border-radius: 30px;
	padding: 10px 30px;
}
#book-table-form .section-label-a  span {
	color: #898989;
	font-weight: 400;
}
.theiaStickySidebar .box-grey {
	background: transparent;
	border: none;
}
.theiaStickySidebar .box-grey .inner{
	border-top: 0px solid #c9c7c700!important;
	background: #fff;
	margin-bottom: 25px;
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
	padding: 6px 20px;
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
	background: #20ac76;
	border: none!important;
	padding: 13px 10px!important;
	font-size: 16px;
}
.checkout:hover {
	background: #1a9969 !important;
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

ul#tabs {
	text-align: left;
}
#my-food-menu .container {
	margin-top: -68px;
}
.promos {
	display: block;
	text-align: center;
	border: 2px dashed #999;
	padding: 30px;
	font-size: 18px;
	font-weight: 700;
}
.promos .section-label {
	display: none;
}
.promos .merchant-promo {
	padding: 0px!important;
	margin: 0px!important;
}
.add_to_cart {
	border: #20ac76;
	background-color: #20ac76;
}
.add_to_cart:hover {
	border: 0px!important;
	background-color: #60ba62!important;
}
.new-button {
	background: #20ac76;
	border: 0px solid #20ac76;
}
.new-button:hover {
	background: #60ba62!important;
	border: 0px solid #60ba62!important;
}
a.orange-button:hover, button.orange-button:hover, input.orange-button:hover, input.orange-button:focus, a.orange-button:focus, #menu .logout-menu a:hover {
	
	background: #60ba62 !important;
border: 0px solid #60ba62 !important;
}
ul#tabs li.active {
    border-bottom: 2px solid #20ac76;
}

.dl-sub input[type='radio'] {
	width: 10%!important;
	height: 25px;
}
.dl-sub span#delivery_type {
  display: block;
  text-align: left;
	margin-bottom: 10px;
}
@media(max-width: 970px) {
	.section-menu ul#tabs li span {
		display: inline-block;
		font-size: 12px;
	}
	.section-menu ul#tabs li i {
		display: none;
	}
}
@media(max-width: 640px) {
	#origin {
		margin-bottom: 10px;
	}
	#travel_mode {
		margin-bottom: 10px;
	}
	.easy-autocomplete {
		width: 100%!important;
	}
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
	border: 1px solid #20ac76;
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
    background: #20ac76;
    
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
	border: 1px solid #20ac76;
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
</style>