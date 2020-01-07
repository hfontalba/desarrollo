


<div id="parallax-wrap" class="parallax-search" 
data-parallax="scroll" data-position="center" data-bleed="10" 
data-image-src="<?php echo assetsURL()."/images/banner-2.jpg"?>">

<div class="search-wraps" style="width: 100%;">

<!-- carousel start -->
<!-- style src="/assets/vendor/OwlCarousel/dist/assets/owl.carousel.min.css"></style>
<style src="/assets/vendor/OwlCarousel/dist/assets/owl.theme.default.min.css"></style-->
<div class="container">
  <div class="row">
    <div class="owl2 owl-carousel">
    <?php
    	// get all ads. 
    //	$ads = Yii::app()->functions->getAds();
    	$ads = Yii::app()->functions->getAdsByLocation($search_address);
    	$adsHtml = '';
    	foreach($ads as $i => $ad) {
    	    $active = ($i==0)?"active":"";
    		$adsHtml .= '<div class="item" rev="'.$ad['id'].'">';
            $adsHtml .= '<a href="'.$ad['link'].'"><div class="ad-image" > <img src="'.Yii::app()->request->baseUrl.'/upload/'.$ad['image'].'" style="width: 270px; height: 270px;">';
            //$adsHtml .= '<div class="dish-img" style="background-size: cover;background-position: center;background-image: url('.Yii::app()->request->baseUrl.'/upload/'.$ad['image'].')"></div>';
        
            //$adsHtml .= '<h2>'.$ad['name'].'</h2>';
            //$adsHtml .= '<p>Sit ipsum referrentur ut, quod ignota.</p>';
            $adsHtml .= '</div></a>';
            $adsHtml .= '</div>';
    	}
    	echo $adsHtml;
    ?>
    </div>
    </div>
</div>
<!--script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="/assets/vendor/OwlCarousel/dist/owl.carousel.min.js"></script-->
<script>
$(document).ready(function(){
  $(".owl2").owlCarousel({
    loop:true, 
    margin:30, 
    items:3, 
    nav:true, 
    autoplay:true,
    responsiveClass:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4  
        }
    }});
});
</script>
<!-- carousel end -->
  <div style="display: none;">  
	<h3 style="text-align:center;">Order from <?php echo $total." ".t("Restaurants")?> </h3>
	<p style="display: none;"><i class="fa fa-map-marker"></i> <?php echo $search_address?></p>
	<p>delivering to your door</p>
</div>
</div> <!--search-wraps-->

</div> <!--parallax-container-->

<style type="text/css">
	.parallax-search, .mobile-banner-wrap .layer {
		background: #171a29;
	}
    .owl2 .owl-item h2 {
  font-size: 20px;
  color: #333;
  text-transform: uppercase;
  display: none;
}
.owl2 .owl-item a {
  color: #333;
}
.ad-image {
  width: 100%;
  
  background-size: cover;
  background-position: center;
}
.owl-nav {
  top: 0px;
  bottom: 0px;
  width: 100%;
  margin: auto;
  position: absolute;
  height: 45px;
}
.owl-prev, .owl-next {
  width: 45px;
  height: 45px;
  background: #000;
  color: #fff!Important;
  font-size: 30px !important;
  position: absolute;
  top: 0px;
  bottom: 0px;
  background: #f9a700 !important;
  padding: 0px !important;

}
.owl-prev span, .owl-next span {
  line-height: 0px;
  display: block;
  position: absolute;
  top: 0px;
  bottom: 0px;
  left: 0px;
  right: 0px;
  margin: auto;
  height: 10px;
}
.owl-next {
  right: -20px;
}
.owl-prev {
  left: -20px;
}
.owl2 {
  margin: 0px 0px 30px;
}
.parallax-search .search-wraps {
   
    padding-bottom: 30px;
}
.parallax-search .search-wraps {
  padding-top: 0px;
}
@media (max-width: 960px) {
  .ad-image {
    
  }
}
@media (max-width: 767px) {
  .ad-image {
    
  }
}
@media (max-width: 640px) {
  #parallax-wrap {
    padding-bottom: 10px;
    padding-top: 10px;
    padding: 30px;
    background: #171a29;
  }
  .ad-image {
    width: 100%;
    
    background-size: cover;
    background-position: center;
  }
  .search-wraps p {
    color: #aaa;
  }
  .search-wraps h3 {
    font-size: 20px!important;
    text-align: center;
    padding: 0px;
    margin: 0px 0px 10px;
  }
  .parallax-search .search-wraps {
    padding-bottom: 0px;
  }
}
@media (max-width: 479px) { 
  .ad-image {
    width: 100%;
    background-size: cover;
    background-position: center;
  }
}
</style>