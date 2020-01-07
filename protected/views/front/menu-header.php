
<div id="parallax-wrap" class="parallax-search parallax-menu" 
data-parallax="scroll" data-position="top" data-bleed="10" 
data-image-src="<?php echo empty($background)?assetsURL()."/images/b-2-mobile.jpg":uploadURL()."/$background"; ?>">

<div class="container  menu-header ds-lg" >

	<div class="new-flex-header">
		<div class="flex-left">
			<div class="flex-logo">
				<img class="logo-medium bottom15" src="<?php echo $merchant_logo;?>">
			</div>
			<div class="flex-details">
				
				<h1><?php echo clearString($restaurant_name)?></h1>
				<div class="mytable">
	     <div class="mycol">
	        <div class="rating-stars" data-score="<?php echo $ratings['ratings']?>"></div>   
	     </div>
	     <div class="mycol">
	        <p class="small">
	        <a href="javascript:;"class="goto-reviews-tab">
	        <?php echo $ratings['votes']." ".t("Reseñas")?>
	        </a>
	        </p>
	     </div>	        
	     
	     <div class="mycol">
	       
	     </div>
	   </div> 
	   <p><i class="fa fa-map-marker"></i> <?php echo $merchant_address?></p>
	<p class="small"><?php echo FunctionsV3::displayCuisine($cuisine);?></p>
	<p><?php echo FunctionsV3::getFreeDeliveryTag($merchant_id)?></p>
	
	<?php if ( getOption($merchant_id,'merchant_show_time')=="yes"):?>
	<p class="small">
	<?php echo t("Merchant Current Date/Time").": ".
	Yii::app()->functions->translateDate(date('F d l')." ".timeFormat(date('c'),true));?>
	</p>
	<?php endif;?>
	
	<?php if (!empty($merchant_website)):?>
	<p class="small">
	<?php echo t("Sitio web").": "?>
	<a target="_blank" href="<?php echo FunctionsV3::fixedLink($merchant_website)?>">
	  <?php echo $merchant_website;?>
	</a>
	</p>
	<?php endif;?>
			</div>

		</div>
		<div class="flex-right text-right">
			<span style="font-weight: bold;">Estado:</span> <div class=" open-bg">
	        <?php echo FunctionsV3::merchantOpenTag($merchant_id)?>             
	     </div>
			 <p class="small" style="font-weight: bold;"><?php echo t("Orden mínima").": ".FunctionsV3::prettyPrice($minimum_order)?></p>
		</div>
	</div>
      
      
	  <!--mytable-->

	
	
	<?php if(!empty($social_facebook_page) || !empty($social_twitter_page) || !empty($social_google_page)):?>
	<ul class="merchant-social-list">
	 <?php if(!empty($social_google_page)):?>
	 <li>
	   <a href="<?php echo FunctionsV3::prettyUrl($social_google_page)?>" target="_blank">
	    <i class="ion-social-googleplus"></i>
	   </a>
	 </li>
	 <?php endif;?>
	 
	 <?php if(!empty($social_twitter_page)):?>
	 <li>
	   <a href="<?php echo FunctionsV3::prettyUrl($social_twitter_page)?>" target="_blank">
	   <i class="ion-social-twitter"></i>
	   </a>
	 </li>
	 <?php endif;?>
	 
	 <?php if(!empty($social_facebook_page)):?>
	 <li>
	   <a href="<?php echo FunctionsV3::prettyUrl($social_facebook_page)?>" target="_blank">
	   <i class="ion-social-facebook"></i>
	   </a>
	 </li>
	 <?php endif;?>
	 
	</ul>
	<?php endif;?>
	
	
			
</div> <!--search-wraps-->




<div class="container  menu-header ds-sm" >

	<div class="new-flex-header">
		<div class="flex-left">
			<div class="flex-logo">
				<img class="logo-medium bottom15" src="<?php echo $merchant_logo;?>">
			</div>
			<div class="flex-details">
				
				<h1 style="color: black !important;"><?php echo clearString($restaurant_name)?></h1>
				<div class="mytable">
	     <div class="mycol">
	        <div class="rating-stars" data-score="<?php echo $ratings['ratings']?>"></div>   
	     </div>
	     <div class="mycol">
	        <p class="small">
	        <a href="javascript:;"class="goto-reviews-tab">
	        <?php echo $ratings['votes']." ".t("reseñas")?>
	        </a>
	        </p>
	     </div>	        
	     
	     
	   </div> 
	   
			</div>

		</div>
		<div class="flex-right text-right">
			<p><i class="fa fa-map-marker"></i> <?php echo $merchant_address?></p>
	<p class="small"><span class="cuisine"><?php echo FunctionsV3::displayCuisine($cuisine);?></span></p>
	
	
	<?php if ( getOption($merchant_id,'merchant_show_time')=="yes"):?>
	<p class="small">
	<?php echo t("Merchant Current Date/Time").": ".
	Yii::app()->functions->translateDate(date('F d l')." ".timeFormat(date('c'),true));?>
	</p>
	<?php endif;?>
	
	<?php if (!empty($merchant_website)):?>
	<p class="small">
	<?php echo t("Website").": "?>
	<a target="_blank" href="<?php echo FunctionsV3::fixedLink($merchant_website)?>">
	  <?php echo $merchant_website;?>
	</a>
	</p>
	<?php endif;?>
			Estado: <div class=" open-bg">
	        <?php echo FunctionsV3::merchantOpenTag($merchant_id)?>             
	     </div>
			 <p class="small"><?php echo t("Orden mínima").": ".FunctionsV3::prettyPrice($minimum_order)?></p>
		</div>
	</div>
      
      
	  <!--mytable-->

	
	
	<?php if(!empty($social_facebook_page) || !empty($social_twitter_page) || !empty($social_google_page)):?>
	<ul class="merchant-social-list">
	 <?php if(!empty($social_google_page)):?>
	 <li>
	   <a href="<?php echo FunctionsV3::prettyUrl($social_google_page)?>" target="_blank">
	    <i class="ion-social-googleplus"></i>
	   </a>
	 </li>
	 <?php endif;?>
	 
	 <?php if(!empty($social_twitter_page)):?>
	 <li>
	   <a href="<?php echo FunctionsV3::prettyUrl($social_twitter_page)?>" target="_blank">
	   <i class="ion-social-twitter"></i>
	   </a>
	 </li>
	 <?php endif;?>
	 
	 <?php if(!empty($social_facebook_page)):?>
	 <li>
	   <a href="<?php echo FunctionsV3::prettyUrl($social_facebook_page)?>" target="_blank">
	   <i class="ion-social-facebook"></i>
	   </a>
	 </li>
	 <?php endif;?>
	 
	</ul>
	<?php endif;?>
	
	
			
</div> <!--search-wraps-->

</div> <!--parallax-container-->

<style type="text/css">
	#menu a {
		background: transparent !important;
		border: 0px solid #60ba62 !important;
		margin-left: 5px !important;
	}
	.open-bg {
		background: transparent;
		border-radius: 5px;
		color: #fff;
		text-align: center !important;
		display: inline-block;
		width: 63px;
		height: 24px;
		margin-bottom: 0px;
	}
	.new-flex-header {
		display: flex;
		align-items: center;
		margin-top: 100px;
	}
	.flex-left {
		display: flex;
		align-items: center;
		width: 60%;
		color: #fff;
	}
	.flex-details h1 {
		text-align: left;
		color: black !important;
	}
	.parallax-search.parallax-menu {
    	min-height: 340px;
	}
	.flex-logo {
		margin-right: 30px;
	}
	.flex-details h1 {
		font-size: 28px;
		font-weight: 700;
		margin: 50px 0px 0px 0px;
	}
	.flex-details p {
		font-size: 14px;
		font-size: 13px;
		line-height: 20px;
		color: black !important;
	}
	.menu-header .mytable {
		margin-bottom: 10px;
	}
	.flex-right  {
		width: 100%;
		color: black !important;
	}
	.flex-right p {
		color: black !important;
	}
	.mytable .mycol {
    	display: inline-block;
	} 
	.mytable .mycol a {
		color: black !important;
		margin-top: 5p x!important;
	}
	#parallax-wrap {
		min-height: auto!important;
		background: #ffffffbf !important;
	}
	.new-flex-header {
	    padding: 30px 0px 78px;
	    margin-top: 15px;
	}
	.new-flex-header .logo-medium {
	    max-width: 186px;
	    margin-top: 45px;
	    min-width: 125px;
	}
	.ds-sm {
		display: none;
		}
	.goto-reviews-tab a, .goto-reviews-tab p {
		color: black !important;
		}
@media (max-width: 640px) {
	.new-flex-header .logo-medium {
	    max-width: 100%;
	    min-width: 100%;
	}
	.ds-lg {
			display: none;
		}
	.ds-sm {
			display: block;
	}
	.new-flex-header {
		flex-direction: column;
	}
	.flex-right {
		text-align: left;
	}
	.flex-left {
		width: 100%;
	}
	.flex-logo {
		width: 40%;
	}
	.cuisine {
	    display: inline-block;
	    background: #ff7500;
	    padding: 2px 10px 2px 10px;
	    border-radius: 3px;
	}
	.menu-3, #mobile-app-sections {
		text-align: left;
	}
	.menu-3 img {
		width: 100%;
		max-width: 100%;
	}
	.menu-list-row .col-md-2 {
		width: 30%;
		padding-left: 0px!important;
	}
	.menu-list-row .col-md-7 {
		width: 50%;
		padding: 0px;
	}
	.menu-list-row .col-md-3 {
		width: 20%;
		flex-direction: column;
	}
}
</style>