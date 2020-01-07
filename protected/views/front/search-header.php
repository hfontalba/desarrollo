
<div class="mobile-banner-wrap relative">
 <div class="layer"></div>
 <img class="mobile-banner" src="<?php echo assetsURL()."/images/banner-2-mobile.jpg"?>">
</div>

<div id="parallax-wrap" style="background-color: rgba(255, 255, 255, 0.6) !important;" class="parallax-search" 
data-parallax="scroll" data-position="center" data-bleed="10" 
data-image-src="<?php echo assetsURL()."/images/banner-2.jpg"?>">

<div class="search-wraps" style="background: transparent !important;">
	<h1 style="color: #325093 !important;font-weight: bold;"><?php echo $total." ".t("resultados")?></h1>
	<p style="color: black !important;"><i class="fa fa-map-marker"></i> <?php echo $search_address?></p>
</div> <!--search-wraps-->

</div> <!--parallax-container-->