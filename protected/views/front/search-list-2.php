<?php
$min_fees=FunctionsV3::getMinOrderByTableRates($merchant_id,
   $distance,
   $distance_type_orig,
   $val['minimum_order']
);

$show_delivery_info=false;
if($val['service']==1 || $val['service']==2  || $val['service']==4  || $val['service']==5 ){
	$show_delivery_info=true;
}

?>
<div id="search-listgrid" class=" ds-lg infinite-item <?php echo $delivery_fee!=true?'free-wrap':'non-free'; ?>">
    <div class="inner list-view">
    
    <?php if ( $val['is_sponsored']==2):?>
    <div class="ribbon"><span><?php echo t("Sponsored")?></span></div>
    <?php endif;?>
    
    <?php if ($offer=FunctionsV3::getOffersByMerchant($merchant_id)):?>
    <div class="ribbon-offer"><span><?php echo $offer;?></span></div>
    <?php endif;?>
    
    <div class="row">
	    <div class="col-md-3 border ">
	     <!--<a href="<?php echo Yii::app()->createUrl('store/menu/merchant/'.$val['restaurant_slug'])?>">-->
	     <a href="<?php echo Yii::app()->createUrl("/menu-". trim($val['restaurant_slug']))?>">
	      <img class="logo-small"src="<?php echo FunctionsV3::getMerchantLogo($merchant_id);?>">
	     </a>	
	     <div style="display: none;">     
	     <?php echo FunctionsV3::displayServicesList($val['service']);?>    
	     <?php FunctionsV3::displayCashAvailable($merchant_id,true,$val['service'])?>  
	     </div>    
	    </div> <!--col-->
	    
	    <div class="col-md-7 border">
	     
	       
	       
	       <h2><?php echo clearString($val['restaurant_name'])?></h2>
	       <div class="mytable">
	         <div class="mycol">
	            <div class="rating-stars" data-score="<?php echo $ratings['ratings']?>"></div>   
	         </div>
	         <div class="mycol">
	            <p>(<?php echo $ratings['votes']." ".t("")?>)</p>
	         </div>
	         <div class="mycol">
	         	<div class="open-tag">
	            <?php echo FunctionsV3::merchantOpenTag($merchant_id)?>   
	            </div>             
	         </div>
	         
	     </div>
	       <div class="mytable">
	         

	         
	          <div style="display: none;">
	         <div class="mycol">
	          <!--<p><?php echo t("Minimum Order").": ".FunctionsV3::prettyPrice($val['minimum_order'])?></p>-->
	          <p><?php echo t("Minimum Order").": ".FunctionsV3::prettyPrice($min_fees)?></p>
	      </div>
	         </div>
	         
	       </div> <!--mytable-->
	       <div style="display: none;">
	       <p class="merchant-address concat-text"><?php echo $val['merchant_address']?></p>   
	       	       	       </div>
	       <p class="cuisine">
           <?php echo FunctionsV3::displayCuisine($val['cuisine']);?>
           </p>                
              <div class="row" >
              	<div style="display: none;">
              	<div class="col-md-6">
           <p>
	        <?php 
	        if(!$search_by_location){
		        if ($distance){
		        	echo t("Distance").": ".number_format($distance,1)." $distance_type";
		        } else echo  t("Distance").": ".t("not available");
	        }
	        ?>
	        </p>
	    </div>
	</div>
<div style="display: none;">
	        
	        <?php //if($val['service']!=3):?>
	        <?php if($show_delivery_info):?>
	        	<div class="col-md-6">
	        <p><?php echo t("Delivery Est")?>: <?php echo FunctionsV3::getDeliveryEstimation($merchant_id)?></p>
	    </div>
	        <?php endif;?>
	    </div>
	        <div class="col-md-12">
	        <p>
	        <?php 	        
	        //if($val['service']!=3){
	        if($show_delivery_info){
		        if (!empty($merchant_delivery_distance)){
		        	echo t("Delivery Distance").": ".$merchant_delivery_distance." $distance_type_orig";
		        } else echo  t("Delivery Distance").": ".t("not available");
	        }
	        ?>
	        </p>
	            </div>
	            <div style="display: none;">
	            <div class="col-md-6">                    
	        <p>
	        <?php 
	        //if($val['service']!=3){
	        if($show_delivery_info){
		        if ($delivery_fee){
		             echo t("Delivery Fee").": ".FunctionsV3::prettyPrice($delivery_fee);
		        } else echo  t("Delivery Fee").": ".t("Free Delivery");
	        }
	        ?>
	        </p>
	    </div>
	        </div>
	    </div>
	        
	    
	    </div> <!--col-->
	    
	    <div class="col-md-3 relative border">
	    
	      <!--<a href="<?php echo Yii::app()->createUrl('store/menu/merchant/'.$val['restaurant_slug'])?>" -->
	      <a href="<?php echo Yii::app()->createUrl("/menu-". trim($val['restaurant_slug']))?>" 
         class="orange-button rounded3 medium view-menu-button">
          <?php echo t("Comprar")?>
         </a>   
	    
	    </div>
    </div> <!--row-->
    
    </div> <!--inner-->

    
</div> 

	<div id="search-listgrid" class=" ds-sm infinite-item <?php echo $delivery_fee!=true?'free-wrap':'non-free'; ?>">
    	<div class="inner list-view">
		    <?php if ( $val['is_sponsored']==2):?>
	    		<div class="ribbon"><span><?php echo t("Publicidad")?></span></div>
	    	<?php endif;?>
    
		    <?php if ($offer=FunctionsV3::getOffersByMerchant($merchant_id)):?>
		    <div class="ribbon-offer"><span><?php echo $offer;?></span></div>
		    <?php endif;?>
    
    		<div class="row mobile-row">
				<div class="open-tag">
	            	<?php echo FunctionsV3::merchantOpenTag($merchant_id)?>   
	            </div> 
	    		<div class="left-image " style="background-image: url(<?php echo FunctionsV3::getMerchantLogo($merchant_id);?>); ">
	     		</div>    
	   			<div class="right-contnet">
	     			<h2><?php echo clearString($val['restaurant_name'])?></h2>
	       			<div class="rating-stars" data-score="<?php echo $ratings['ratings']?>"></div>   
				       <p class="cuisine">
			           <?php echo FunctionsV3::displayCuisine($val['cuisine']);?>
			           </p>                
	        		   <p>
					        <?php 	        
					        //if($val['service']!=3){
					        if($show_delivery_info){
						        if (!empty($merchant_delivery_distance)){
						        	echo t("Delivery Distance").": ".$merchant_delivery_distance." $distance_type_orig";
						        } else echo  t("Delivery Distance").": ".t("not available");
					        }
					        ?>
	        			</p>
    
	      <!--<a href="<?php echo Yii::app()->createUrl('store/menu/merchant/'.$val['restaurant_slug'])?>" -->
					      <a href="<?php echo Yii::app()->createUrl("/menu-". trim($val['restaurant_slug']))?>" 
				         class="orange-button rounded3 medium view-menu-button">
				          <?php echo t("Comprar")?>
				         </a>   
	    
	 
    			</div> <!--row-->
    
    		</div> <!--inner-->

    	</div>
		</div> 


 <!--infinite-item-->   


<style type="text/css">
	a.orange-button.view-menu-button {
		border: 1px solid #00a474!important;
		background: #fff!important;
		z-index: 101;
		position: relative;
		color: #00a474!important;
	}
	a.orange-button.view-menu-button:hover {
		border: 1px solid #00a474!important;
		background: #00a474!important;
		color: #fff!important;
	}
	.open-tag {
		/*background: #00a474;*/
		padding: 3px 10px 5px 10px;
		border-radius: 5px;
		font-size: 12px;
		color: #fff;
	}
	.ds-sm {
			display: none;
		}
		.search-wraps {
			background: #171a29;
		}
		#parallax-wrap {
			background: #171a29;
			padding-top: 50px;
		}
		#parallax-wrap h3 {
			color: #ddd;
		}
		#parallax-wrap p {
			color: #ddd;
		}
		@media  (min-width:961px) and (max-width:1024px) {
		.ds-lg {
			display: none;
		}
		.ds-sm {
			display: block;
		}
		.mobile-row {
			position: relative;
		}
		.rating-stars img {
			width: 10px;
		}
		.mobile-row {
			align-items: stretch!important;
		}
		.open-tag {
			position: absolute;
			top: 0px;
			right: -15px;
			border-radius: 3px;
			font-size: 10px;
			padding: 3px 10px 4px 10px;
		}
		.left-image  {
			width: 30%;
			background-size: 100% auto;
			background-repeat: no-repeat;
		}
		.right-contnet {
			padding-left: 10px;
		}
		.right-contnet h2 {
			font-size: 14px!important;
			text-align: left!important;
			line-height: 22px!important;
		}
		.inner.list-view {
			padding: 10px!important;
		}
		.right-contnet p {
			font-size: 12px!important;
			margin: 0px!important;
		}
		.view-menu-button {
			min-width: 88px!important;
			height: 24px!important;
			line-height: 22px!important;
			font-size: 12px!important;
			font-weight: 400!important;
			text-transform: uppercase!important;
			border: 1px solid!important;
			border-radius: 3px!important;
			text-align: center!important;
			padding: 0px!important;
			border: 1px solid #fa9918!important;
			background: transparent!important;
			color: #fa9918!important;
			margin-top: 10px !important;
		}
		.orange-button.view-menu-button {
			min-width: 88px!important;
			height: 24px!important;
			line-height: 22px!important;
			font-size: 12px!important;
			font-weight: 400!important;
			text-transform: uppercase!important;
			border: 1px solid!important;
			border-radius: 3px!important;
			text-align: center!important;
			padding: 0px!important;
			border: 1px solid #fa9918!important;
			background: transparent!important;
			color: #fa9918!important;
			margin-top: 10px !important;
		}
		.result-merchant .list-view .orange-button {
    		margin-top: 10px!important;
		}
		.result-merchant .list-view .view-menu-button {
    		margin-top: 15px!important;
		}
		.result-merchant .list-view a.view-menu-button {
    		margin-top: 10px!important;
		}
		.result-merchant {
    		margin-top: 10px;
		}
		#search-listgrid {
		    padding-left: 20px;
		    padding-right: 20px;
		}
		.result-merchant .infinite-item, .result-merchant .infinite-item-newest {
    		margin-bottom: 0px!important;
		}
		.modal-close-btn {
			z-index: 101;
		}
		#mobile-search-filter {
			display: block;
		}
	}
		@media  (min-width:768px) and (max-width: 960px) {
		.ds-lg {
			display: none;
		}
		.ds-sm {
			display: block;
		}
		.mobile-row {
			position: relative;
		}
		.rating-stars img {
			width: 10px;
		}
		.mobile-row {
			align-items: stretch!important;
		}
		.open-tag {
			position: absolute;
			top: 0px;
			right: -15px;
			border-radius: 3px;
			font-size: 10px;
			padding: 3px 10px 4px 10px;
		}
		.left-image  {
			width: 30%;
			background-size: 100% auto;
			background-repeat: no-repeat;
		}
		.right-contnet {
			padding-left: 10px;
		}
		.right-contnet h2 {
			font-size: 14px!important;
			text-align: left!important;
			line-height: 22px!important;
		}
		.inner.list-view {
			padding: 10px!important;
		}
		.right-contnet p {
			font-size: 12px!important;
			margin: 0px!important;
		}
		.view-menu-button {
			min-width: 88px!important;
			height: 24px!important;
			line-height: 22px!important;
			font-size: 12px!important;
			font-weight: 400!important;
			text-transform: uppercase!important;
			border: 1px solid!important;
			border-radius: 3px!important;
			text-align: center!important;
			padding: 0px!important;
			border: 1px solid #fa9918!important;
			background: transparent!important;
			color: #fa9918!important;
			margin-top: 10px !important;
		}
		.orange-button.view-menu-button {
			min-width: 88px!important;
			height: 24px!important;
			line-height: 22px!important;
			font-size: 12px!important;
			font-weight: 400!important;
			text-transform: uppercase!important;
			border: 1px solid!important;
			border-radius: 3px!important;
			text-align: center!important;
			padding: 0px!important;
			border: 1px solid #fa9918!important;
			background: transparent!important;
			color: #fa9918!important;
			margin-top: 10px !important;
		}
		.result-merchant .list-view .orange-button {
    		margin-top: 10px!important;
		}
		.result-merchant .list-view .view-menu-button {
    		margin-top: 15px!important;
		}
		.result-merchant .list-view a.view-menu-button {
    		margin-top: 10px!important;
		}
		.result-merchant {
    		margin-top: 10px;
		}
		#search-listgrid {
		    padding-left: 20px;
		    padding-right: 20px;
		}
		.result-merchant .infinite-item, .result-merchant .infinite-item-newest {
    		margin-bottom: 0px!important;
		}
		.modal-close-btn {
			z-index: 101;
		}
		#mobile-search-filter {
			display: none;
		}
	}
		@media (min-width:641px) and (max-width: 767px) {
		.ds-lg {
			display: none;
		}
		.ds-sm {
			display: block;
		}
		.mobile-row {
			position: relative;
		}
		.rating-stars img {
			width: 10px;
		}
		.mobile-row {
			align-items: stretch!important;
		}
		.open-tag {
			position: absolute;
			top: 0px;
			right: -15px;
			border-radius: 3px;
			font-size: 10px;
			padding: 3px 10px 4px 10px;
		}
		.left-image  {
			width: 30%;
			background-size: 100% auto;
			background-repeat: no-repeat;
		}
		.right-contnet {
			padding-left: 10px;
		}
		.right-contnet h2 {
			font-size: 14px!important;
			text-align: left!important;
			line-height: 22px!important;
		}
		.inner.list-view {
			padding: 10px!important;
		}
		.right-contnet p {
			font-size: 12px!important;
			margin: 0px!important;
		}
		.view-menu-button {
			min-width: 88px!important;
			height: 24px!important;
			line-height: 22px!important;
			font-size: 12px!important;
			font-weight: 400!important;
			text-transform: uppercase!important;
			border: 1px solid!important;
			border-radius: 3px!important;
			text-align: center!important;
			padding: 0px!important;
			border: 1px solid #fa9918!important;
			background: transparent!important;
			color: #fa9918!important;
			margin-top: 10px !important;
		}
		.orange-button.view-menu-button {
			min-width: 88px!important;
			height: 24px!important;
			line-height: 22px!important;
			font-size: 12px!important;
			font-weight: 400!important;
			text-transform: uppercase!important;
			border: 1px solid!important;
			border-radius: 3px!important;
			text-align: center!important;
			padding: 0px!important;
			border: 1px solid #fa9918!important;
			background: transparent!important;
			color: #fa9918!important;
			margin-top: 10px !important;
		}
		.result-merchant .list-view .orange-button {
    		margin-top: 10px!important;
		}
		.result-merchant .list-view .view-menu-button {
    		margin-top: 15px!important;
		}
		.result-merchant .list-view a.view-menu-button {
    		margin-top: 10px!important;
		}
		.result-merchant {
    		margin-top: 10px;
		}
		#search-listgrid {
		    padding-left: 20px;
		    padding-right: 20px;
		}
		.result-merchant .infinite-item, .result-merchant .infinite-item-newest {
    		margin-bottom: 0px!important;
		}
		.modal-close-btn {
			z-index: 101;
		}
		#mobile-search-filter {
			display: none;
		}
	}
	@media (min-width:480px) and (max-width: 640px) {
		.ds-lg {
			display: none;
		}
		.ds-sm {
			display: block;
		}
		.mobile-row {
			position: relative;
		}
		.rating-stars img {
			width: 10px;
		}
		.mobile-row {
			align-items: stretch!important;
		}
		.open-tag {
			position: absolute;
			top: 0px;
			right: -15px;
			border-radius: 3px;
			font-size: 10px;
			padding: 3px 10px 4px 10px;
		}
		.left-image  {
			width: 30%;
			background-size: 100% auto;
			background-repeat: no-repeat;
		}
		.right-contnet {
			padding-left: 10px;
		}
		.right-contnet h2 {
			font-size: 14px!important;
			text-align: left!important;
			line-height: 22px!important;
		}
		.inner.list-view {
			padding: 10px!important;
		}
		.right-contnet p {
			font-size: 12px!important;
			margin: 0px!important;
		}
		.view-menu-button {
			min-width: 88px!important;
			height: 24px!important;
			line-height: 22px!important;
			font-size: 12px!important;
			font-weight: 400!important;
			text-transform: uppercase!important;
			border: 1px solid!important;
			border-radius: 3px!important;
			text-align: center!important;
			padding: 0px!important;
			border: 1px solid #fa9918!important;
			background: transparent!important;
			color: #fa9918!important;
			margin-top: 10px !important;
		}
		.orange-button.view-menu-button {
			min-width: 88px!important;
			height: 24px!important;
			line-height: 22px!important;
			font-size: 12px!important;
			font-weight: 400!important;
			text-transform: uppercase!important;
			border: 1px solid!important;
			border-radius: 3px!important;
			text-align: center!important;
			padding: 0px!important;
			border: 1px solid #fa9918!important;
			background: transparent!important;
			color: #fa9918!important;
			margin-top: 10px !important;
		}
		.result-merchant .list-view .orange-button {
    		margin-top: 10px!important;
		}
		.result-merchant .list-view .view-menu-button {
    		margin-top: 15px!important;
		}
		.result-merchant .list-view a.view-menu-button {
    		margin-top: 10px!important;
		}
		.result-merchant {
    		margin-top: 10px;
		}
		#search-listgrid {
		    padding-left: 20px;
		    padding-right: 20px;
		}
		.result-merchant .infinite-item, .result-merchant .infinite-item-newest {
    		margin-bottom: 0px!important;
		}
		.modal-close-btn {
			z-index: 101;
		}
		#mobile-search-filter {
			display: none;
		}
	}
	@media (max-width: 479px) {
		.ds-lg {
			display: none;
		}
		.ds-sm {
			display: block;
		}
		.mobile-row {
			position: relative;
		}
		.rating-stars img {
			width: 10px;
		}
		.mobile-row {
			align-items: stretch!important;
		}
		.open-tag {
			position: absolute;
			top: 0px;
			right: -15px;
			border-radius: 3px;
			font-size: 10px;
			padding: 3px 10px 4px 10px;
		}
		.left-image  {
			width: 30%;
			background-size: 100% auto;
			background-repeat: no-repeat;
		}
		.right-contnet {
			padding-left: 10px;
		}
		.right-contnet h2 {
			font-size: 14px!important;
			text-align: left!important;
			line-height: 22px!important;
		}
		.inner.list-view {
			padding: 10px!important;
		}
		.right-contnet p {
			font-size: 12px!important;
			margin: 0px!important;
		}
		.view-menu-button {
			min-width: 88px!important;
			height: 24px!important;
			line-height: 22px!important;
			font-size: 12px!important;
			font-weight: 400!important;
			text-transform: uppercase!important;
			border: 1px solid!important;
			border-radius: 3px!important;
			text-align: center!important;
			padding: 0px!important;
			border: 1px solid #fa9918!important;
			background: transparent!important;
			color: #fa9918!important;
			margin-top: 10px !important;
		}
		.orange-button.view-menu-button {
			min-width: 88px!important;
			height: 24px!important;
			line-height: 22px!important;
			font-size: 12px!important;
			font-weight: 400!important;
			text-transform: uppercase!important;
			border: 1px solid!important;
			border-radius: 3px!important;
			text-align: center!important;
			padding: 0px!important;
			border: 1px solid #fa9918!important;
			background: transparent!important;
			color: #fa9918!important;
			margin-top: 10px !important;
		}
		.result-merchant .list-view .orange-button {
    		margin-top: 10px!important;
		}
		.result-merchant .list-view .view-menu-button {
    		margin-top: 15px!important;
		}
		.result-merchant .list-view a.view-menu-button {
    		margin-top: 10px!important;
		}
		.result-merchant {
    		margin-top: 10px;
		}
		#search-listgrid {
		    padding-left: 20px;
		    padding-right: 20px;
		}
		.result-merchant .infinite-item, .result-merchant .infinite-item-newest {
    		margin-bottom: 0px!important;
		}
		.modal-close-btn {
			z-index: 101;
		}
		#mobile-search-filter {
			display: none;
		}
	}
</style>