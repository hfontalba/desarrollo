<?php echo CHtml::beginForm('','post',array(
 'onsubmit'=>"return false;"
)); 
?> 

<div class="row">
  <div class="col-md-5">
    
<div class="form-group">
    <label><b><?php echo mobileWrapper::t("App Default Language")?></b></label>        
    <?php 
    $lang_list[0]=mobileWrapper::t("Please select");
    $enabled_lang=FunctionsV3::getEnabledLanguage();	    
    if(is_array($enabled_lang) && count($enabled_lang)>=1){
    	foreach ($enabled_lang as $val) {
    		$lang_list[$val]=$val;
    	}
    }
    	    
    echo CHtml::dropDownList('mobileapp2_language',getOptionA('mobileapp2_language'),
    (array)$lang_list,array(
      'class'=>"form-control"
    ));
    ?>    
    <small class="form-text text-muted">
      <?php echo mobileWrapper::t("set application default language")?>
    </small>
</div>  
  
  </div> <!--col-->
  
  <div class="col-md-5">
    
<div class="form-group">
    <label><?php echo mobileWrapper::t("Location Accuracy")?></label>        
     <?php 
    echo CHtml::dropDownList('mobileapp2_location_accuracy',getOptionA('mobileapp2_location_accuracy'),
    mobileWrapper::locationAccuracyList()
    ,array(
      'class'=>"form-control"
    ));
    ?>     
</div>  
  
  </div> <!--col-->
  
</div> <!--row-->


<p><b><?php echo mobileWrapper::t("Home Page")?></b></p>
<div class="row">
  
  <div class="col-md-2">
  <?php echo htmlWrapper::checkbox('mobile2_home_offer','',"Enabled Offers", getOptionA('mobile2_home_offer') );?>   
  </div> <!--col-->
  
  <div class="col-md-2">
  <?php echo htmlWrapper::checkbox('mobile2_home_featured','',"Enabled Feature Restaurant", getOptionA('mobile2_home_featured') );?>   
  </div> <!--col-->
  
  <div class="col-md-2">
  <?php echo htmlWrapper::checkbox('mobile2_home_cuisine','',"Enabled Browse By Cuisine", getOptionA('mobile2_home_cuisine') );?>   
  </div> <!--col-->
  
  <div class="col-md-2">
  <?php echo htmlWrapper::checkbox('mobile2_home_all_restaurant','',"Enabled All Restaurant", getOptionA('mobile2_home_all_restaurant') );?>   
  </div> <!--col-->
  
  
  <div class="col-md-2">
  <?php echo htmlWrapper::checkbox('mobile2_home_favorite_restaurant','',"Enabled Favorites Restaurant", getOptionA('mobile2_home_favorite_restaurant') );?>   
  </div> <!--col-->
  

</div> <!--row-->

<div class="height10"></div>

<p><b><?php echo mobileWrapper::t("Home Page Filter")?></b></p>

<div class="row">
  
  <div class="col-md-4">
  <?php echo htmlWrapper::checkbox('mobile2_show_only_current_location','',"Show Restaurant based on location only", getOptionA('mobile2_show_only_current_location') );?>   
  </div> <!--col-->
</div>  

<div class="height10"></div>
<div class="height10"></div>

<p><b><?php echo mobileWrapper::t("Menu/List Style")?></b></p>

<div class="row">
   
<div class="col-md-5">
<div class="form-group">
    <label><?php echo mobileWrapper::t("Restaurant List Type")?></label>        
     <?php 
    echo CHtml::dropDownList('mobileapp2_merchant_list_type',getOptionA('mobileapp2_merchant_list_type'),
    mobileWrapper::RestaurantListType()
    ,array(
      'class'=>"form-control"
    ));
    ?>     
</div>  
</div> <!--col-->


<div class="col-md-5">
<div class="form-group">
    <label><?php echo mobileWrapper::t("Menu Type")?></label>        
     <?php 
    echo CHtml::dropDownList('mobileapp2_merchant_menu_type',getOptionA('mobileapp2_merchant_menu_type'),
    mobileWrapper::MenuType()
    ,array(
      'class'=>"form-control"
    ));
    ?>     
</div>  
</div> <!--col-->
   
</div>

<div class="height10"></div>

<p style="margin-bottom:0;"><b><?php echo mobileWrapper::t("Search Results Data")?></b></p>
<small class="form-text text-muted">
 <?php echo mobileWrapper::t("choose less data for faster results")?>
</small>
<div class="height20"></div>

<div class="row">
  
  <div class="col-md-1">
  <?php echo htmlWrapper::checkbox('mobile2_search_data[1]','',"Open/Close", $search_options,'open_tag' );?>   
  </div> <!--col-->
  
  <div class="col-md-1">
  <?php echo htmlWrapper::checkbox('mobile2_search_data[2]','',"Reviews", $search_options ,'review' );?>   
  </div> <!--col-->
  
  <div class="col-md-1">
  <?php echo htmlWrapper::checkbox('mobile2_search_data[3]','',"Cuisine", $search_options, 'cuisine' );?>   
  </div> <!--col-->
  
  <div class="col-md-1">
  <?php echo htmlWrapper::checkbox('mobile2_search_data[4]','',"Address", $search_options , 'address' );?>   
  </div> <!--col-->
  
  <div class="col-md-1">
  <?php echo htmlWrapper::checkbox('mobile2_search_data[5]','',"Minimum Order", $search_options , 'minimum_order' );?>   
  </div> <!--col-->
  
  <div class="col-md-1">
  <?php echo htmlWrapper::checkbox('mobile2_search_data[6]','',"Distance", $search_options , 'distace' );?>   
  </div> <!--col-->
  
  <div class="col-md-1">
  <?php echo htmlWrapper::checkbox('mobile2_search_data[12]','',"Delivery Est", $search_options , 'delivery_estimation' );?>   
  </div> <!--col-->
  
  <div class="col-md-1">
  <?php echo htmlWrapper::checkbox('mobile2_search_data[7]','',"Delivery Distance", $search_options , 'delivery_distance' );?>   
  </div> <!--col-->
  
  <div class="col-md-1">
  <?php echo htmlWrapper::checkbox('mobile2_search_data[8]','',"Delivery Fee", $search_options , 'delivery_fee' );?>   
  </div> <!--col-->
  
  <div class="col-md-1">
  <?php echo htmlWrapper::checkbox('mobile2_search_data[9]','',"Offers", $search_options , 'offers' );?>   
  </div> <!--col-->
  
  <div class="col-md-1">
  <?php echo htmlWrapper::checkbox('mobile2_search_data[10]','',"Services", $search_options , 'services' );?>   
  </div> <!--col-->
  
  <div class="col-md-1">
  <?php echo htmlWrapper::checkbox('mobile2_search_data[11]','',"Payment Options", $search_options , 'payment_option' );?>   
  </div> <!--col-->
  
</div> <!--row-->



<div class="height10"></div>


<!--<p><?php echo mobileWrapper::t("Menu")?></p>-->

<p style="margin-bottom:0;"><b><?php echo mobileWrapper::t("Menu")?></b></p>

<div class="row">

<div class="col-md-2">
  <?php echo htmlWrapper::checkbox('mobile2_disabled_default_image','',"Disabled default menu image", getOptionA('mobile2_disabled_default_image') );?>   
</div> <!--col-->

<div class="col-md-2">
  <?php echo htmlWrapper::checkbox('mobile2_enabled_menu_carousel','',"Enabled Carousel", getOptionA('mobile2_enabled_menu_carousel') );?>   
</div> <!--col-->

<div class="col-md-2">
  <?php echo htmlWrapper::checkbox('mobile2_enabled_dish','',"Enabled Dishes", getOptionA('mobile2_enabled_dish') );?>   
</div> <!--col-->

</div> <!--row-->

<div class="height20"></div>

<p><b><?php echo mobileWrapper::t("Distance Results")?></b></p>

<div class="row">

	<div class="col-md-3">
	   <div class="radio">
		  <label>
		  <?php 
		  echo CHtml::radioButton('mobileapp2_distance_results',
		  getOptionA('mobileapp2_distance_results')==1?true:false
		  ,array(
		    'id'=>'mobileapp2_distance_results',		    
		    'value'=>1
		  ));
		  ?>
		  <?php echo mobileWrapper::t("Using Straight line")?>
		  </label>
		</div>
		<p class="text-muted"><?php echo mt("This options does not use any api like google and mapbox for faster results")?></p>
	</div> <!--col-->
	
	<div class="col-md-3">
	   <div class="radio">
		  <label>
		  <?php 
		  echo CHtml::radioButton('mobileapp2_distance_results',
		  getOptionA('mobileapp2_distance_results')==2?true:false
		  ,array(
		    'id'=>'mobileapp2_distance_results',		    
		    'value'=>2
		  ));
		  ?>
		  <?php echo mobileWrapper::t("Using Map Provider")?>
		  </label>
		</div>
		<p class="text-muted"><?php echo mt("This options will use api for google and mapbox")?></p>
	</div> <!--col-->

</div> <!--row-->


<p><b><?php echo mobileWrapper::t("Customer Order History")?></b></p>


<div class="row">
	<div class="col-md-3">
     <p><?php echo mt("Processing")?></p>
	 <?php 
	 unset($order_status_list[0]);	 
	 echo CHtml::dropDownList('mobileapp2_order_processing',(array)json_decode(getOptionA('mobileapp2_order_processing')),
    (array)$order_status_list,array(
      'class'=>"form-control chosen",
      "multiple"=>"multiple"
    ));
	 ?>	
	</div> <!--col-->
	
	<div class="col-md-3">
	  <p><?php echo mt("Completed")?></p>
	 <?php 
	 echo CHtml::dropDownList('mobileapp2_order_completed',(array)json_decode(getOptionA('mobileapp2_order_completed')),
    (array)$order_status_list,array(
      'class'=>"form-control chosen",
      "multiple"=>"multiple"
    ));
	 ?>	
	</div> <!--col-->
	
	<div class="col-md-3">
	  <p><?php echo mt("Cancelled")?></p>
	 <?php 
	 echo CHtml::dropDownList('mobileapp2_order_cancelled',(array)json_decode(getOptionA('mobileapp2_order_cancelled')),
    (array)$order_status_list,array(
      'class'=>"form-control chosen",
      "multiple"=>"multiple"
    ));
	 ?>	
	</div> <!--col-->
	
</div>	

<div class="height20"></div>
<div class="height10"></div>
  
  <?php
echo CHtml::ajaxSubmitButton(
	mobileWrapper::t('SAVE SETTINGS'),
	array('ajax/savesettings_app'),
	array(
		'type'=>'POST',
		'dataType'=>'json',
		'beforeSend'=>'js:function(){
		   loader(1);                 
		}
		',
		'complete'=>'js:function(){		                 
		   loader(2);
		 }',
		'success'=>'js:function(data){	
		   if(data.code==1){
		     notify(data.msg);
		   } else {
		     notify(data.msg,"danger");
		   }
		}
		'
	),array(
	  'class'=>'btn '.APP_BTN,
	  'id'=>'save_application'
	)
);
?>

<?php echo CHtml::endForm(); ?>