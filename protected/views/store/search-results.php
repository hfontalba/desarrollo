<?php 
$search_address=isset($_GET['s'])?$_GET['s']:'';
if (isset($_GET['st'])){
	$search_address=$_GET['st'];
}

/*SEARCH BY LOCATION*/
$search_by_location=false; $location_data='';
if (FunctionsV3::isSearchByLocation()){
	if($location_data=FunctionsV3::getSearchByLocationData()){		
		$search_by_location=TRUE;		
		switch ($location_data['location_type']) {
			case 1:
				$search_address= $location_data['location_city']." ".$location_data['location_area'];
				break;
		
			case 2:
			    $search_address = $location_data['city_name']." ".$location_data['state_name'];
			    break;
			    
			case 3:
				$search_address=$location_data['postal_code'];
				break;
					
			default:
				break;
		}	    
	}	
}

$this->renderPartial('/front/search-header',array(
   'search_address'=>$search_address,
   'total'=>$data['total']
));?>

<?php 
$this->renderPartial('/front/order-progress-bar',array(
   'step'=>2,
   'show_bar'=>true
));

echo CHtml::hiddenField('clien_lat',$data['client']['lat']);
echo CHtml::hiddenField('clien_long',$data['client']['long']);
?>

<div class="search-map-results">  
</div> <!--search-map-results-->

<div class="sections section-search-results" id="my-search-results">

  <div class="container">

   <div class="row">
   
     <div class="col-md-3 border search-left-content" id="mobile-search-filter">
       
        
        
        <div class="filter-wrap rounded2  <?php echo $enabled_search_map==""?"no-marin-top":""; ?>">
                
          <button type="button" class="close modal-close-btn" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>  
        
           
           
           
           <!--FILTER MERCHANT NAME-->       
           <?php if (!empty($restaurant_name)):?>                      
           <a href="<?php echo FunctionsV3::clearSearchParams('restaurant_name')?>" class="clear-params">[<?php echo t("Clear")?>]</a>
           <div class="clearfix"></div>
           <?php endif;?>    
           <div class="filter-box">
	           <a href="javascript:;">	             
	             <span class="small-headings">
	             Buscar por nombre
	             </span>   
	             
	           </a>
	           <ul class="<?php echo $fc==2?"hide":''?>">
	              <li>
	              <form method="POST" onsubmit="return research_merchant();">
		              <div class="search-input-wraps rounded30">
		              <div class="row">
				        <div class="col-md-10 col-xs-10">
				        <?php echo CHtml::textField('restaurant_name',$restaurant_name,array(
				          'required'=>true,
				          'placeholder'=>t("Nombre del establecimiento")
				        ))?>
				        </div>        
				        <div class="col-md-2 relative col-xs-2 ">
				          <button type="submit"><i class="fa fa-search"></i></button>         
				        </div>
				     </div>
			     </div>
			     </form>
	              </li>
	           </ul>
           </div> <!--filter-box-->
           <!--END FILTER MERCHANT NAME-->           
           
           
           
           <!--FILTER DELIVERY FEE-->           
           <div class="filter-box">
	           <a href="javascript:;">	             
	            
	            <span class="small-headings">
	             Precio del delivery
	             </span>   
	             
	           </a>
	            <ul class="<?php echo $fc==2?"hide":''?>">
	              <li>
	              <?php 
		          echo CHtml::checkBox('filter_by[]',false,array(
		          'value'=>'free-delivery',
		          'class'=>"filter_promo icheck"
		          ));
		          ?>
	              Delivery Gratis
	              </li>
	           </ul>
           </div> <!--filter-box-->
           <!--END FILTER DELIVERY FEE-->
           
           <!--FILTER DELIVERY -->
           <?php if (!empty($filter_delivery_type)):?>                      
           <a href="<?php echo FunctionsV3::clearSearchParams('filter_delivery_type')?>" class="clear-params">[<?php echo t("Clear")?>]</a>
           <div class="clearfix"></div>
           <?php endif;?>
           <?php if ( $services=Yii::app()->functions->Services() ):?>
           <div class="filter-box">
	           <a href="javascript:;">	             
	            <span class="small-headings">
	             Por tipo
	             </span>   
	             
	           </a>
	           <ul class="<?php echo $fc==2?"hide":''?>">
	             <?php foreach ($services as $key=> $val):?>
	              <li>	           	              
	              <?php 
		           echo CHtml::radioButton('filter_delivery_type',
		           $filter_delivery_type==$key?true:false
		           ,array(
		          'value'=>$key,
		          'class'=>"filter_by filter_delivery_type icheck"
		          ));
		          ?>
		          <?php echo $val;?>   
	              </li>
	             <?php endforeach;?> 
	           </ul>
           </div> <!--filter-box-->
           <?php endif;?>
           <!--END FILTER DELIVERY -->
           
           <!--FILTER CUISINE-->
           <?php if (!empty($filter_cuisine)):?>                      
           <a href="<?php echo FunctionsV3::clearSearchParams('filter_cuisine')?>" class="clear-params">[<?php echo t("Clear")?>]</a>
           <div class="clearfix"></div>
           <?php endif;?>
           <?php if ( $cuisine=Yii::app()->functions->Cuisine(false)):?>
           <div class="filter-box">
	           <a href="javascript:;">	             
	             <span class="small-headings">
	             Por Categorías
	             </span>   
	            
	           </a>
	            <ul class="<?php echo $fc==2?"hide":''?>">
	             <?php foreach ($cuisine as $val): ?>
	              <li>
		           <?php 
		           $cuisine_json['cuisine_name_trans']=!empty($val['cuisine_name_trans'])?
	    		   json_decode($val['cuisine_name_trans'],true):'';
	    		   
		           echo CHtml::checkBox('filter_cuisine[]',
		           in_array($val['cuisine_id'],(array)$filter_cuisine)?true:false
		           ,array(
		           'value'=>$val['cuisine_id'],
		           'class'=>"filter_by icheck filter_cuisine"
		           ));
		          ?>
	              <?php echo qTranslate($val['cuisine_name'],'cuisine_name',$cuisine_json)?>
	              </li>
	             <?php endforeach;?> 
	           </ul>
           </div> <!--filter-box-->
           <?php endif;?>
           <!--END FILTER CUISINE-->
           
           <div style="display: none;">
           <!--MINIUM DELIVERY FEE-->           
           <?php if (!empty($filter_minimum)):?>                      
           <a href="<?php echo FunctionsV3::clearSearchParams('filter_minimum')?>" class="clear-params">[<?php echo t("Clear")?>]</a>
           <div class="clearfix"></div>
           <?php endif;?>
           <?php if ( $minimum_list=FunctionsV3::minimumDeliveryFee()):?>
           <div class="filter-box">
	           <a href="javascript:;">	             
	            <span class="small-headings">
	             <?php echo t("Minimum Delivery")?>
	             </span>   
	             
	           </a>
	            <ul class="<?php echo $fc==2?"hide":''?>">
	             <?php foreach ($minimum_list as $key=>$val):?>
	              <li>
		           <?php 
		          echo CHtml::radioButton('filter_minimum[]',
		          $filter_minimum==$key?true:false
		          ,array(
		          'value'=>$key,
		          'class'=>"filter_by_radio filter_minimum icheck"
		          ));
		          ?>
	              <?php echo $val;?>
	              </li>
	             <?php endforeach;?> 
	           </ul>
           </div> <!--filter-box-->
           <?php endif;?>
           <!--END MINIUM DELIVERY FEE-->
       </div>
           
        </div> <!--filter-wrap-->
        
     </div> <!--col search-left-content-->
     
     <div class="col-md-6 border search-right-content">
          
     <?php echo CHtml::hiddenField('sort_filter',$sort_filter)?>
     <?php echo CHtml::hiddenField('display_type',$display_type)?>     
     
         <div class="sort-wrap">
           <div class="row">           
              <div class="col-md-6 col-xs-4 border new-left-cl " style="padding: 0px;">	           
	           <?php 
	           $filter_list=array(
	             'restaurant_name'=>t("Name"),
	             'ratings'=>t("Rating"),
	             'minimum_order'=>t("Minimum"),
	             'distance'=>t("Distance")
	           );
	           if (isset($_GET['st'])){
	           	   unset($filter_list['distance']);
	           }
	           echo CHtml::dropDownList('sort-results',$sort_filter,$filter_list,array(
	             'class'=>"sort-results selectpicker",
	             'title'=>t("Ordenar por")
	           ));
	           ?>
              </div> <!--col-->
              <div class="col-md-6 col-xs-8 border new-right-cl">                
               <!--
                          
                <a href="<?php echo FunctionsV3::clearSearchParams('','display_type=listview')?>" 
	           class="display-type orange-button block center rounded 
	           <?php echo $display_type=="gridview"?'inactive':''?>" 
		          data-type="listview">
                <i class="fa fa-th-list"></i>
                </a>
                
                       -->
                
                <a href="javascript:;" id="mobile-filter-handle" class="orange-button block center rounded mr10px">
                  <i class="fa fa-filter"></i>
                </a>    
                
                <?php if ( $enabled_search_map=="yes"):?>
                <a href="javascript:;" id="mobile-viewmap-handle" class="orange-button block center rounded mr10px">
                  <i class="ion-ios-location"></i>
                </a>    
                <?php endif;?>
                
                <div class="clear"></div>
                
              </div>
           </div> <!--row-->
         </div>  <!--sort-wrap-->  
         
         
         <!--MERCHANT LIST -->
                  
         <div class="result-merchant">
             <div class="row infinite-container">
             
             <?php if ($data):?>
	             <?php foreach ($data['list'] as $val):?>
	             <?php 
	             $merchant_id=$val['merchant_id'];             
	             $ratings=Yii::app()->functions->getRatings($merchant_id);   
	             
	             /*get the distance from client address to merchant Address*/             
	             $distance_type=FunctionsV3::getMerchantDistanceType($merchant_id); 
	             $distance_type_orig=$distance_type;
	             
	             /*dump("c lat=>".$data['client']['lat']);         
	             dump("c lng=>".$data['client']['long']);	             
	             dump("m lat=>".$val['latitude']);
	             dump("c lng=>".$val['lontitude']);*/
	             
	               
	             $distance=FunctionsV3::getDistanceBetweenPlot(
	                $data['client']['lat'],$data['client']['long'],
	                $val['latitude'],$val['lontitude'],$distance_type
	             );      
	             
	             /*dump($distance_type);
	             dump($distance);*/
	             	             	     
	             $distance_type_raw = $distance_type=="M"?"miles":"kilometers";
	             $distance_type = $distance_type=="M"?t("miles"):t("kilometers");
	             $distance_type_orig = $distance_type_orig=="M"?t("miles"):t("kilometers");
	             
	             /*dump($distance_type_raw);
	             dump($distance_type);
	             dump($distance_type_orig);*/
	             
	             if(!empty(FunctionsV3::$distance_type_result)){
	             	$distance_type_raw=FunctionsV3::$distance_type_result;
	             	$distance_type=t(FunctionsV3::$distance_type_result);
	             }
	             
	             //dump($distance_type);  
	             
	             $merchant_delivery_distance=getOption($merchant_id,'merchant_delivery_miles');             
	             
	             if ($search_by_location){
	             	$delivery_fee = FunctionsV3::getLocationDeliveryFee(
	             	   $merchant_id,
	             	   $val['delivery_charges'],
	             	   $location_data
	             	);
	             } else {
	                $delivery_fee=FunctionsV3::getMerchantDeliveryFee(
	                          $merchant_id,
	                          $val['delivery_charges'],
	                          $distance,
	                          $distance_type_raw);
	             } 
	             ?>
	             
	             <?php 	             	                                   
	             if ( $display_type=="listview"){
	             	 $this->renderPartial('/front/search-list-2',array(
					   'data'=>$data,
					   'val'=>$val,
					   'merchant_id'=>$merchant_id,
					   'ratings'=>$ratings,
					   'distance_type'=>$distance_type,
					   'distance_type_orig'=>$distance_type_orig,
					   'distance'=>$distance,
					   'merchant_delivery_distance'=>$merchant_delivery_distance,
					   'delivery_fee'=>$delivery_fee,
					   'search_by_location'=>$search_by_location
					 ));
	             } else {
		             $this->renderPartial('/front/search-list-1',array(
					   'data'=>$data,
					   'val'=>$val,
					   'merchant_id'=>$merchant_id,
					   'ratings'=>$ratings,
					   'distance_type'=>$distance_type,
					   'distance_type_orig'=>$distance_type_orig,
					   'distance'=>$distance,
					   'merchant_delivery_distance'=>$merchant_delivery_distance,
					   'delivery_fee'=>$delivery_fee,
					   'search_by_location'=>$search_by_location
					 ));
	             }
				 ?>
				              
	              <?php endforeach;?>     
              <?php else :?>     
              <p class="center top25 text-danger">No hemos podido conseguir nada></p>
              <?php endif;?>
                                                   
             </div> <!--row-->                
             
             <div class="search-result-loader">
                <i></i>
                <p>Cargando más resultados...</p>
             </div> <!--search-result-loader-->
             
             <?php                         
             if (!isset($current_page_url)){
             	$current_page_url='';
             }
             if (!isset($current_page_link)){
             	$current_page_link='';
             }
             echo CHtml::hiddenField('current_page_url',$current_page_url);
             require_once('pagination.class.php'); 
             $attributes                 =   array();
			 $attributes['wrapper']      =   array('id'=>'pagination','class'=>'pagination');			 
			 $options                    =   array();
			 $options['attributes']      =   $attributes;
			 $options['items_per_page']  =   FunctionsV3::getPerPage();
			 $options['maxpages']        =   1;
			 $options['jumpers']=false;
			 $options['link_url']=$current_page_link.'&page=##ID##';			
			 $pagination =   new pagination( $data['total'] ,((isset($_GET['page'])) ? $_GET['page']:1),$options);		
			 $data   =   $pagination->render();
             ?>             
                    
         </div> <!--result-merchant-->
     
 
     <!--col search-right-content-->
 </div>

     <div class="col-md-3 mobile-no-padding">
     	<div class="message-box" style="background-color: #325193;"><strong>Sugerir establecimiento</strong><span>Si no puede encontrar el establecimiento que deseas pedir, solicitalo para agregarlo en nuestra lista</span>
     		<a href="https://docs.google.com/forms/d/e/1FAIpQLSd-rJgMUROmrJeWq_Yh-gHw9F1BWRSZfKV86yD6C8rR3p86Ug/viewform" class="request-btn" target="_blank">Solicitar</a></div>

     	<div class="message-box" style="background-color: #299fd1;"><strong>Promocionar mi establecimiento</strong><span>¿Eres dueño de un establecimiento y quieres promocionar tu establecimiento?</span>
     		<a href="https://docs.google.com/forms/d/e/1FAIpQLSd-rJgMUROmrJeWq_Yh-gHw9F1BWRSZfKV86yD6C8rR3p86Ug/viewform" class="request-btn">Publicitar</a></div>
     </div>
     
   </div> <!--row-->
  </div>
  </div> <!--container-->
</div> <!--section-search-results-->
<script type="text/javascript">
  window.document.title = 'Así de Rápido - Resultados de la busqueda';
</script>

<style type="text/css">
@import url('https://fonts.googleapis.com/css?family=Open+Sans:400,700');
	#my-search-results {
		background: #ebedf3;
	}
	.small-headings {
	font-family: 'Open Sans', sans-serif;
	display: block;
	padding: 9px 0px!important;
    border-top: 1px solid #e1e1e1;
    border-bottom: 1px solid #e1e1e1;
    margin-bottom: 20px;
	border-bottom: 1px solid #ddd;
	font-size: 15px;
	font-weight: 700;
}
	#my-search-results .icheckbox_minimal {
		margin-right: 10px;
	}	


.filter-box a {
	padding-top: 0px;
	padding-bottom: 0px;
}
.iradio_flat {
	margin-right: 10px;
}
.filter-box li {
	margin-bottom: 17px;
}
.search-input-wraps {
	background: transparent;
}
.search-input-wraps input {
	background: transparent;
}
.message-box {
    padding: 25px;
    text-align: center;
    margin-bottom: 20px;
    border: 1px solid #d7d7d7;
}
.message-box strong {
    display: block;
    color: #fff;
    font-size: 16px;
    font-weight: 700;
    font-family: 'Open Sans', sans-serif;
    margin-bottom: 8px;
}
.message-box span {
    color: #fff;
    font-size: 14px;
    font-weight: 600;
    line-height: 20px;
    display: block;
    margin-bottom: 20px;
}
.message-box .request-btn {
    display: block;
    color: #fff;
    font-size: 12px;
    font-weight: 700;
    border: 1px solid #fff;
    border-radius: 4px;
    text-transform: uppercase;
    font-family: 'Open Sans', sans-serif;
    line-height: 32px;
}
.result-merchant .list-view {
	list-style: none;
    background-color: #fff;
    box-shadow: none!important;
    text-shadow: none!important;
    border: none;
    padding: 28px 30px 28px 20px!important;
    margin: 0px 0px 20px 0!important;
    border-radius: 3px!important;
    position: relative;
}
.result-merchant .list-view .row {
	display: flex;
	align-items: center;
}
.result-merchant .logo-small {
	width: 100%!important;
	max-height: auto!important;
min-height: auto!important;
}
.result-merchant .list-view h2 {
	font-size: 16px;
	font-weight: 600;
	color: #333;
}
.result-merchant .list-view .orange-button {
	display: inline-block;
	min-width: 105px;
	height: 30px;
	line-height: 29px;
	font-size: 12px;
	font-weight: 400;
	text-transform: uppercase;
	border: 1px solid;
	border-radius: 3px;
	text-align: center;
	padding: 0px;
	border: 1px solid #fa9918;
	background: transparent;
	color: #fa9918;
	margin-top: 0px!important;
}
.sort-results button {
	display: inline-block;
    text-decoration: none;
    outline: none;
    box-shadow: none;
    border: 0;
    width: 100%;
    padding: 8px 10px 8px 18px;
    color: #2f313a;
    font: 400 14px/20px 'Open Sans', sans-serif;
    word-spacing: 1px;
    letter-spacing: 0;
    text-transform: none;
}
#my-search-results .filter-wrap {
    background: #FFF;
    border: 0px solid #c9c7c7;
    padding: 25px 25px 25px 25px;
    margin-top: 0px;
}
.clear-params {
	position: relative;
	display: block;
	float: right;
	padding-bottom: 20px;
	color: #999;
}
.clearfix {
	display: block;
	clear: both;
}
@media (max-width: 640px) {
	.sort-wrap .row {
		display: flex;
	}
	.sort-wrap .new-left-cl {
		width: 50%!important;
		padding-left: 20px!important;
	}
	.sort-wrap .new-right-cl {
		width: 50%!important;
		display: flex;
	}
	.bootstrap-select:not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {
		width: 100%!important;
	}
	
	.sort-wrap .new-right-cl a{
		display: inline-block;
		float: none;
		width: 100%;
		margin: 0px 3px;
	}
	.mobile-no-padding {
		padding: 0px 5px 0px 5px!important;
	}
}
</style>