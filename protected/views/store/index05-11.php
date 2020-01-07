

<?php
$kr_search_adrress = FunctionsV3::getSessionAddress();

$home_search_text=Yii::app()->functions->getOptionAdmin('home_search_text');
if (empty($home_search_text)){
	$home_search_text=Yii::t("default","Find restaurants near you");
}

$home_search_subtext=Yii::app()->functions->getOptionAdmin('home_search_subtext');
if (empty($home_search_subtext)){
	$home_search_subtext=Yii::t("default","Order Delivery Food Online From Local Restaurants");
}

$home_search_mode=Yii::app()->functions->getOptionAdmin('home_search_mode');
$placholder_search=Yii::t("default","Street Address,City,State");
if ( $home_search_mode=="postcode" ){
	$placholder_search=Yii::t("default","Enter your postcode");
}
$placholder_search=Yii::t("default",$placholder_search);
?>


<?php if ( $home_search_mode=="address" || $home_search_mode=="") :?>

<section class="landing" style="background-image: url(https://asiderapido.com/images/banner-1.jpg); ">
<!-- <video autoplay='true' loop='true' muted='true' poster='' src='https://asiderapido.com/images/video.mp4'>
  <source type="video/mp4" src="https://asiderapido.com/images/video.mp4"></source>
       <source type="video/webm" src="https://asiderapido.com/images/video.webm"></source> 
</video> -->


<?php 
if ( $enabled_advance_search=="yes"){
	$this->renderPartial('/front/advance_search',array(
	  'home_search_text'=>$home_search_text,
	  'kr_search_adrress'=>$kr_search_adrress,
	  'placholder_search'=>$placholder_search,
	  'home_search_subtext'=>$home_search_subtext,
	  'theme_search_merchant_name'=>getOptionA('theme_search_merchant_name'),
	  'theme_search_street_name'=>getOptionA('theme_search_street_name'),
	  'theme_search_cuisine'=>getOptionA('theme_search_cuisine'),
	  'theme_search_foodname'=>getOptionA('theme_search_foodname'),
	  'theme_search_merchant_address'=>getOptionA('theme_search_merchant_address'),
	));
} else $this->renderPartial('/front/single_search',array(
      'home_search_text'=>$home_search_text,
	  'kr_search_adrress'=>$kr_search_adrress,
	  'placholder_search'=>$placholder_search,
	  'home_search_subtext'=>$home_search_subtext
));
?>

</section>
<?php else :?>



<!--SEARCH USING LOCATION-->
<img class="mobile-home-banner" src="<?php echo assetsURL()."/images/b6.jpg"?>">

<div id="parallax-wrap" class="parallax-container parallax-home" 
data-parallax="scroll" data-position="top" data-bleed="10" 
data-image-src="<?php echo assetsURL()."/images/b6.jpg"?>">

  <?php 
  $location_type=getOptionA("admin_zipcode_searchtype");  
  $this->renderPartial('/front/location-search-'.$location_type,array(
   'location_search_type'=>$location_type
  ));
  ?>



</div> <!--parallax-container-->

<?php endif;?>
<?php $lang = isset($_GET['lang']) ? $_GET['lang'] : ''; ?>
<div class="order-steps-container ">
<div class="order-steps-expander">
        <div class="container">
            <div class="title">
                Get your favourite food at your doorstep.
                <span class="trigger" onclick="scrollTo()"></span>
            </div>
        </div>
    </div>
  </div>
  <div class="main-wrapper-bg">
<div class="ads1">
  <div class="container">
    <div class="row">
      <div class="skew-wrap">
      <div class="col-md-8 res-margin-20">
        <img src="https://asiderapido.com/images/ad.jpg" class="full-width">
      </div>
      
      <div class="col-md-4">
        <img src="https://asiderapido.com/images/ad2.jpg" class="full-width">
      </div>
    

<?php if ($theme_hide_cuisine<>2):?>
<!--CUISINE SECTIONS-->
<?php if ( $list=FunctionsV3::getCuisine() ): ?>
<div class="sections section-cuisine" style="display: none;">
<div class="container  nopad">

<div class="col-md-3 nopad">
<img src="<?php echo assetsURL()."/images/cuisine.png"?>" class="img-cuisine">
</div>

<div class="col-md-9  nopad">

  <h2><?php echo t("Browse by cuisine")?></h2>
  <p class="sub-text center"><?php echo t("choose from your favorite cuisine")?></p>
  
  <div class="row">
    <?php $x=1;?>
    <?php foreach ($list as $val): ?>
    <div class="col-md-4 col-sm-4 indent-5percent nopad">
      <a href="<?php echo Yii::app()->createUrl('/store/cuisine',array("category"=>$val['cuisine_id']))?>" 
     class="<?php echo ($x%2)?"even":'odd'?>">
      <?php 
      $cuisine_json['cuisine_name_trans']=!empty($val['cuisine_name_trans'])?json_decode($val['cuisine_name_trans'],true):'';  
      echo qTranslate($val['cuisine_name'],'cuisine_name',$cuisine_json);
      if($val['total']>0){
        echo "<span>(".$val['total'].")</span>";
      }
      ?>
      </a>
    </div>   
    <?php $x++;?>
    <?php endforeach;?>
  </div> 

</div>
  
</div> <!--container-->
</div> <!--section-cuisine-->
<?php endif;?>
<?php endif;?>

<!-- carousel start -->
<!-- style src="/assets/vendor/OwlCarousel/dist/assets/owl.carousel.min.css"></style>
<style src="/assets/vendor/OwlCarousel/dist/assets/owl.theme.default.min.css"></style-->

  
    <div class="col-md-12 ne-margin">
    <div class=" owl1 owl-carousel">
      
    <?php
    	// get all ads. 
    	$ads = Yii::app()->functions->getAds();
    	$adsHtml = '';
    	foreach($ads as $i => $ad) {
    	    $active = ($i==0)?"active":"";
    		$adsHtml .= '<div class="item" rev="'.$ad['id'].'">';
    		$adsHtml .= '<a href="'.$ad['link'].'"><div class="ad-image"><img src="'.Yii::app()->request->baseUrl.'/upload/'.$ad['image'].'">';
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
  <div class="clearfix"></div>
    </div>
 
</div>
</div>
</div>
</div>
<!--script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="/assets/vendor/OwlCarousel/dist/owl.carousel.min.js"></script-->
<script>
$(document).ready(function(){
  $(".owl1").owlCarousel({
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
            items:2
        },
        1000:{
            items:3  
        }
    }

  });
});
</script>
<!-- carousel end -->
</div>
<?php if ($theme_hide_how_works<>2):?>

<?php endif;?>
<div class="how-it-works" style="background-image: url(https://asiderapido.com/images/video-bg.jpg);" >
  <div class="container">
    <img src="https://asiderapido.com/images/smiley.png">
    <h1>People who love to eat are always the best people</h1>
    
    
  </div>
</div>
<section class="block how-it-works-block" style="padding-bottom: 0px;">
   <div class="container">
      <div class="top-text text-center wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
         <h4 class="text-uppercase text-sp text-lt">HOW IT WORKS</h4>
      </div>
      <div class="row">
         <div class="col-xs-12 col-sm-4 choose wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;">
            <div class="feature-item-wrap text-center">
               <figure><img class="img-responsive" src="https://asiderapido.com/images/meal.svg" alt="Choose Your Favorite"></figure>
               <h5>Choose Your Favorite</h5>
               <p>We consider your wish and deliver your dish. Open your app, choose it.</p>
            </div>
         </div>
         <div class="col-xs-12 col-sm-4 choose wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;">
            <div class="feature-item-wrap text-center">
               <figure><img class="img-responsive" src="https://asiderapido.com/images/delivery.svg" alt="We Deliver Your Meals"></figure>
               <h5>We Deliver Your Meals</h5>
               <p>We prepare and deliver your dish. Keep your door open.</p>
            </div>
         </div>
         <div class="col-xs-12 col-sm-4 choose wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;">
            <div class="feature-item-wrap text-center">
               <figure><img class="img-responsive" src="https://asiderapido.com/images/eat-enjoy.svg" alt="Eat and Enjoy"></figure>
               <h5>Eat and Enjoy</h5>
               <p>Forget everything and remember to order because we cook for you. Enjoy</p>
            </div>
         </div>
      </div>
   </div>
</section>
<!--FEATURED RESTAURANT SECIONS-->
<?php if ($disabled_featured_merchant==""):?>
<?php if ( getOptionA('disabled_featured_merchant')!="yes"):?>
<?php// if ($res=FunctionsV3::getFeatureMerchant()):?>
<div class="sections section-feature-resto" id="featured-restaurant">
<div class="container">
<div >
  <?php $cuisine_list=Yii::app()->functions->Cuisine(true);?>

  <h1>Featured <strong>Restaurants</strong></h1>
  <h6>Eu principes assueverit nam, nam quaeque</h6>
  
  <div class="row">
    
    <div class=" owl3 owl-carousel">
  <?php foreach ($res as $val): //dump($val);?>
  <?php $address= $val['street']." ".$val['city'];
        $address.=" ".$val['state']." ".$val['post_code'];
        
        $ratings=Yii::app()->functions->getRatings($val['merchant_id']);
  ?>   
  
    <!--<a href="<?php echo Yii::app()->createUrl('/store/menu/merchant/'. trim($val['restaurant_slug']) )?>">-->
    <a href="<?php echo Yii::app()->createUrl("/menu-". trim($val['restaurant_slug']))?>">
    <div >
    <div class="featured-box">
      <div class="featured-box-image" style="background-image: url(<?php echo FunctionsV3::getMerchantLogo($val['merchant_id'],$val['logo']);?>);"></div>
      <div class="merchantopentag">
            <?php echo FunctionsV3::merchantOpenTag($val['merchant_id'])?>   
            </div>
         <!--col-->
        
        
        </div>
        <div class="featured-box-details" >
        
          <h4 class="concat-text"><?php echo clearString($val['restaurant_name'])?></h4>
          <div class="height-hider">
          <p class="concat-text" style="display: none;">
          <?php //echo wordwrap(FunctionsV3::displayCuisine($val['cuisine']),50,"<br />\n");?>
          <?php echo FunctionsV3::displayCuisine($val['cuisine'],$cuisine_list);?>
          </p>
          <p class="concat-text"><?php echo $address?></p>                             
          <div style="display: none;"><?php echo FunctionsV3::displayServicesList($val['service'])?></div> 
          <div class="rating-stars" data-score="<?php echo $ratings['ratings']?>"></div>   
          </div>       
        </div> <!--col-->
    </div> <!--col-6-->
    </a>
    
      
  <?php endforeach;?>
</div>
  <div class="clearfix"></div>
  </div> <!--end row-->
</div>
<script>
$(document).ready(function(){
  $(".owl3").owlCarousel({
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
            items:2
        },
        1000:{
            items:4  
        }
    }});
});
</script>
  
</div> <!--container-->
</div>
<?php// endif;?>
<?php endif;?>
<?php endif;?>
<!--END FEATURED RESTAURANT SECIONS-->
<!-- <section class="block blog-block" style="display: none;">
    <div class="container">
        <div class="top-text-header text-center " >
            <h4 class="text-uppercase text-lt text-sp">LATEST BLOG</h4></div>
        <div class="row">
            <div class="col-xs-12 col-sm-4  blog-single " >
                <div class="blog-single-wrap">
                    <figure>
                        <a href="#"><img width="389" height="258" src="https://asiderapido.com/images/blog-1.jpg" class="img wp-post-image" ></a>
                    </figure>
                </div>
                <div class="blog-description ">
                    <h6 class="text-uppercase"><a href="#" class="text-lt text-sp">5 SIMPLE &amp; HEALTHY GLUTEN FREE COOKIE RECIPES</a></h6> <span class="posted-date">Nov 16, 2016</span>
                    <p>Headings Header one Header two Header three Header four Header five Header six Blockquotes Single line blockquote: Stay hungry. Stay foolish. Multi line blockquote with a cite reference: People think[...]</p> <span class="comments-count">no comments</span> <a href="#" class="text-capitalize pull-right read-more-btn text-lt text-sp txcolor">read more</a></div>
            </div>
            <div class="col-xs-12 col-sm-4  blog-single " >
                <div class="blog-single-wrap">
                    <figure>
                        <a href="#"><img width="389" height="258" src="https://asiderapido.com/images/blog-2.jpg" class="img wp-post-image" alt="" ></a>
                    </figure>
                </div>
                <div class="blog-description ">
                    <h6 class="text-uppercase"><a href="#" class="text-lt text-sp">6 Tip to Make Paleo Eating Easy + ..</a></h6> <span class="posted-date">Nov 16, 2016</span>
                    <p>Headings Header one Header two Header three Header four Header five Header six Blockquotes Single line blockquote: Stay hungry. Stay foolish. Multi line blockquote with a cite reference: People think[...]</p> <span class="comments-count">no comments</span> <a href="#" class="text-capitalize pull-right read-more-btn text-lt text-sp txcolor">read more</a></div>
            </div>
            <div class="col-xs-12 col-sm-4  blog-single " >
                <div class="blog-single-wrap">
                    <figure>
                        <a href="#"><img width="389" height="258" src="https://asiderapido.com/images/blog-3.jpg" class="img wp-post-image" alt=""></a>
                    </figure>
                </div>
                <div class="blog-description ">
                    <h6 class="text-uppercase"><a href="#" class="text-lt text-sp">5 Foods That Sound Healthy, But Aren’t</a></h6> <span class="posted-date">Nov 16, 2016</span>
                    <p>Headings Header one Header two Header three Header four Header five Header six Blockquotes Single line blockquote: Stay hungry. Stay foolish. Multi line blockquote with a cite reference: People think[...]</p> <span class="comments-count">no comments</span> <a href="#" class="text-capitalize pull-right read-more-btn text-lt text-sp txcolor">read more</a></div>
            </div>
        </div>
    </div>
</section> -->


<?php if ($theme_show_app==2):?>
<!--MOBILE APP SECTION-->

<section class="download-app-block">
    <div class="container">
        <div class=" left-mobile animated">
            <figure><img src="https://asiderapido.com/images/mobile-phone-big.png" alt="Mobile phone"></figure>
        </div>
        <div class=" download-app-text animated">
            <div class="download-app-wrap">
                <h4><a href="https://play.google.com/store/apps/details?id=asiderapido.mobile.app" class="text-lt text-sp txcolor">Download the app</a></h4>
                <h2 class="text-lt text-sp">Order from your pocket</h2>
                <p>Be handy for easy orders. Forget your laziness or false cooking. We are there to create your dream dishes. Download asiderapido app to diminish your appetite all the time.</p>
                <div class="download-from">
                    <a href="#" class="pull-left" data-toggle="modal" data-target=".download-popup"><img src="https://asiderapido.com/images/app-store.png" alt="App store"></a>
                    <a href="https://play.google.com/store/apps/details?id=asiderapido.mobile.app" class="pull-left"><img src="https://asiderapido.com/images/google-play.png" alt="Google Play"></a>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</section>


<div id="mobile-app-sections" style="display: none;">
  <div class="container">
<div class="container-medium">
  <div class="row">
     <div class="col-xs-5 into-row border app-image-wrap">
       <img class="app-phone" src="<?php echo assetsURL()."/images/getapp-2.png"?>">
     </div> <!--col-->
     <div class="col-xs-7 into-row border">
       <h2><span>Restaurants</span> in your Pocket! </h2>
       <h3 class="green-text"><?php echo t("Get our app, it's the fastest way to order food on the go")?>.</h3>
       
       <div class="row border" id="getapp-wrap">
       <?php if(!empty($theme_app_ios) && $theme_app_ios!="http://"):?>
         <div class="col-xs-4 border">                      
           <a href="<?php echo $theme_app_ios?>" target="_blank">
           <img class="get-app" src="<?php echo assetsURL()."/images/get-app-store.png"?>">
           </a>           
         </div>
         <?php endif;?>
         
         <?php if(!empty($theme_app_android) && $theme_app_android!="http://"):?>
         <div class="col-xs-4 border">
           <a href="<?php echo $theme_app_android?>" target="_blank">
             <img class="get-app" src="<?php echo assetsURL()."/images/get-google-play.png"?>">
           </a>
         </div>
         <?php endif;?>
         
       </div> <!--row-->
       </div>
     </div> <!--col-->
  </div> <!--row-->
  </div> <!--container-medium-->
  
  <div class="mytable border" id="getapp-wrap2">
     <?php if(!empty($theme_app_ios) && $theme_app_ios!="http://"):?>
     <div class="mycol border">
           <a href="<?php echo $theme_app_ios?>" target="_blank">
           <img class="get-app" src="<?php echo assetsURL()."/images/get-app-store.png"?>">
           </a>
     </div> <!--col-->
     <?php endif;?>
     <?php if(!empty($theme_app_android) && $theme_app_android!="http://"):?>
     <div class="mycol border">
          <a href="<?php echo $theme_app_android?>" target="_blank">
             <img class="get-app" src="<?php echo assetsURL()."/images/get-google-play.png"?>">
           </a>
     </div> <!--col-->
     <?php endif;?>
  </div> <!--mytable-->
  
  
</div> <!--container-->
<!--END MOBILE APP SECTION-->
<?php endif;?>

<script type="text/javascript" src="https://asiderapido.com/parallax/parallax.js">
  $('.parallax-window').parallax({imageSrc: 'https://asiderapido.com/images/bgg.jpg'});

</script>
 <style type="text/css">

@import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800');
@import url('https://fonts.googleapis.com/css?family=Reenie+Beanie');
a {
    color: #60ba62;
    text-decoration: none;
}
  .dishes-wrapper {
    padding: 80px 0px;
    text-align: center;
    background: #f3f3f3;
  }
  .dishes-wrapper h1 {
    font-size: 35px;
    font-weight: 400;
  }
  .dishes-wrapper h6 {
    font-size: 12px;
    margin-bottom: 50px;
  }
.dishes-box .dish-img {
  width: 100%;
  height: 200px;
  background-size: cover;
  background-position: center;
 }
 .dishes-box h2 {
  font-size: 18px;
  color: #000;
  text-transform: uppercase;
  font-weight: 800;
 }
 .dishes-box h2 a {
  color: #000;
 }
 .dishes-box h2 a:hover {
  text-decoration: none;

 }
  .dishes-box p {
    font-size: 14px;
    color: #777;
    padding: 0px 25px;
    line-height: 24px;
 }
 .dishes-box {
  border: 1px solid #ddd;
  border-radius: 25px;
  overflow: hidden;
  padding-bottom: 20px;
  transition: all .25s ease;
  background: #fff;
  position: relative;
  
 }
 .dishes-box:hover {
  -webkit-box-shadow: 0px 0px 11px 0px rgba(0,0,0,0.25);
  -moz-box-shadow: 0px 0px 11px 0px rgba(0,0,0,0.25);
  box-shadow: 0px 0px 11px 0px rgba(0,0,0,0.25);
  cursor: pointer;
  margin-top: -5px;
 }
.how-it-works {
  padding: 130px 0px 130px;
    text-align: center;
    background: #1d0f0e;
    background-size: cover;
background-attachment: fixed;
    
color: #fff;
position: relative;

  }
  .how-it-works::after {
    position: absolute;
    top: 0px;
    left: 0px;
    right: 0px;
    bottom: 0px;
    margin: auto;
    content: "";
    background: rgba(0,0,0,.6);
  }
  .how-it-works img {
    width: 100px;
  }
  .how-it-works .container {
    position: relative;
    z-index: 100;
  }
.how-it-works h1 {
    font-size: 45px;
    font-weight: 400;
    font-family: 'Reenie Beanie', cursive!important;
  }
.how-it-works h6 {
    font-size: 12px;
    margin-bottom: 50px; 
 }
.step-box {
  margin-bottom: 30px;
}
.step-box .icon img {
  width: 80px;
}
.step-box .step {
  font-size: 1.429rem;
  font-weight: 700;
  width: 2.25em;
  height: 2.25em;
  line-height: 2.25em;
  text-align: center;
  border-radius: 50%;
  color: #ffffff;
  background-color: #ffbd2f;
  position: relative;
  text-align: center;
  margin: 15px auto 0px;
}
.step-box h3 {
  font-size: 18px;
}
#featured-restaurant {
    padding: 80px 0px 120px;
    background: #fff;
    
}
#featured-restaurant h1 {
    font-size: 35px;
    font-weight: 300!Important;
    text-align: center;
    font-family: 'Open Sans', sans-serif !important;
    text-transform: uppercase;
  }
  #featured-restaurant h1 strong {
    font-weight: 300!Important;
  }
#featured-restaurant h6 {
    font-size: 12px;
    margin-bottom: 50px; 
    text-align: center;
    font-family: 'Open Sans', sans-serif !important;
 }
#featured-restaurant .row {
  
}
#featured-restaurant .row .featured-box {
 
  border: none!important;
  
  background: #fff;
  margin-bottom: 10px;
  display: flex;
  
}
#featured-restaurant .row .featured-box h4{
  font-size: 16px;
  font-weight: 700;
  padding: 5px 0px 0px;
  font-family: 'Open Sans', sans-serif !important;
}
#featured-restaurant .row .featured-box p {
  font-size: 11px;
  font-family: 'Open Sans', sans-serif !important;
}
.section-feature-resto ul li, ul.services-type li {
    padding: 0px 10px 0px 0px;
    font-size: 13px;
}
.section-feature-resto .featured-box {
    min-height: 130px;
    box-shadow: 0 0 7px rgba(173, 173, 173, 0.32);
    padding: 15px;
    position: relative;
}
.section-feature-resto .featured-box .col-md-3 {
      background-image: url(/restaurant/assets/images/default-image-merchant.png);
    background-size: cover;
    background-position: center;
    border:1px solid #ddd;

}
.merchantopentag {
  position: absolute;
    top: 5px;
    left: -11px;
    padding: 3px 10px;
    line-height: normal;
    background: #3ab54b;
    font-size: 10px;
    color: #fff;
    display: block;
    text-transform: uppercase;
    min-height: 20px;
    min-width: 52px;
    text-align: center;
    z-index: 10;
}

.merchantopentag::after {
  width: 10px;
    height: 0px;
    border-top: 10px solid #3ab54b;
    border-bottom: 10px solid #3ab54b;
    border-right: 5px solid transparent;
    position: absolute;
    top: 0;
    right: -6px;
    content: "";
}
.merchantopentag::before {
      width: 0;
    height: 0;
    border-top: 10px solid #239132;
    border-left: 10px solid transparent;
    content: "";
    left: 0;
    position: absolute;
    bottom: -10px;
}
#mobile-app-sections h2 {
  color: #000000 !important;
  font-size: 20px;
  font-weight: 300;
}
#mobile-app-sections h3 {
    margin: auto auto 25px;
    font-size: 14px;
    color: #666;
}
#mobile-app-sections {
  padding-top: 0px;
  background-color: #f0f0f0;
}
.app-phone {
  margin-top: -50px;
}
#mobile-app-sections .row {
  display: flex;
  align-items: center;
}

.parallax-container {
  min-height: 90%!important;
}
.search-input-wraps button[type="submit"] {
    background: none;
    border: none;
    font-size: 14px;
    position: absolute;
    right: -13px;
    top: -14px;
    background: #60ba62;
    width: 170px;
    bottom: -38px;
    color: #fff;
}
.search-input-wraps {
    padding: 14px 28px;
    background: #fff;
    width: 80%;
    margin: auto;
    border-radius: 5px;
    overflow: hidden;
}
.full-width {
  width: 100%;
 
}
.ads2 {
  padding-bottom: 30px;
}
.ads1 {
  padding: 60px 0px 60px;
}
.skew-wrap {
  width: 80%;
  position: relative;
  margin: 0px auto;
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
#mobile-app-sections h2 span{
  font-size: 50px;
display: block;
  font-weight: 300!important;
}
.whole-wrapper{
  width: 100%;
  height: 100%;
  position: relative;
  margin: ;
  max-height: 700px;
  overflow-y: hidden;
}
#hero-vid {
  width: 100%;
position: absolute;
top: 0px;
bottom: 0px;
left: 0px;
right: 0px;
margin: auto;
z-index: -9;
}
.owl1 .owl-item h2 {
  font-size: 20px;
  color: #333;
  text-transform: uppercase;
  display: none;
}
.owl1 .owl-item a {
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
  display: none;
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
.owl1 {
    padding: 25px 0px 20px;
}
.main-wrapper-bg {
  background-image: url(https://asiderapido.com/images/bg1.jpg); 
  background-size: cover;
  background-position: center;
}
#featured-restaurant {
    padding: 80px 0px 120px;
    background: #fff;
    
}
#featured-restaurant h1 {
    font-size: 35px;
    font-weight: 400;
    text-align: center;
  }
#featured-restaurant h6 {
    font-size: 12px;
    margin-bottom: 50px; 
    text-align: center;
 }
#featured-restaurant .row {
  
}
#featured-restaurant .row .featured-box {
 
  border: none;
  border: 1px solid #ddd;
  background: #fff;
  margin-bottom: 20px;
  
  
}
#featured-restaurant .row .featured-box h4{
  font-size: 20px;
  font-weight: 700;
  padding: 5px 0px 0px;
  color: #fff;
}
#featured-restaurant .row .featured-box p {
  font-size: 11px;
  color: #fff;
}
.section-feature-resto ul li, ul.services-type li {
    padding: 0px 10px 0px 0px;
    font-size: 13px;
    color: #fff;
}
.section-feature-resto .featured-box {
    min-height: 130px;
    box-shadow: 0 0 7px rgba(173, 173, 173, 0.32);
    padding: 0px;
    position: relative;
}
.section-feature-resto .featured-box .col-md-3 {
      background-image: url(/restaurant/assets/images/default-image-merchant.png);
    background-size: cover;
    background-position: center;
    border:1px solid #ddd;

}
.merchantopentag {
  position: absolute;
    top: 5px;
    left: -11px;
    padding: 3px 10px;
    line-height: normal;
    background: #3ab54b;
    font-size: 10px;
    color: #fff;
    display: block;
    text-transform: uppercase;
    min-height: 20px;
    min-width: 52px;
    text-align: center;
    z-index: 10;
}

.merchantopentag::after {
  width: 10px;
    height: 0px;
    border-top: 10px solid #3ab54b;
    border-bottom: 10px solid #3ab54b;
    border-right: 5px solid transparent;
    position: absolute;
    top: 0;
    right: -6px;
    content: "";
}
.merchantopentag::before {
      width: 0;
    height: 0;
    border-top: 10px solid #239132;
    border-left: 10px solid transparent;
    content: "";
    left: 0;
    position: absolute;
    bottom: -10px;
}
.featured-box-image {
  height: 300px;
  background-size: auto 100% !important;
  background-position: center;
  transition: all .25s ease;
  width: 100%;
}
.featured-box-details {
  position: relative;
  
  width: 100%;
  padding: 0px;
  transition: all .25s ease;
}
.section-feature-resto .featured-box {
  box-shadow: none;
}

.section-feature-resto .featured-box:hover .height-hider {
  height: auto;
  opacity: 1;
}
.section-feature-resto .featured-box:hover .featured-box-details {
  padding-bottom: 20px;

}
.section-feature-resto .featured-box:hover .featured-box-image {
  background-size: auto 110% !important;
background-position: center;
}
.owl-carousel .owl-item img {
  width: auto!important;
  display: inline-block!important;
}
.ne-margin {
  margin-bottom: 0px;
  background: #fff;
}
.skew-wrap {
  padding-top: 20px; 
  background: #fff;
  -webkit-box-shadow: 0px 2px 12px 0px rgba(0,0,0,0.15);
-moz-box-shadow: 0px 2px 12px 0px rgba(0,0,0,0.15);
box-shadow: 0px 2px 12px 0px rgba(0,0,0,0.15);
}
.skew-wrap-1 {
  width: 80%;
  position: relative;
  margin: 0px auto;
}
.whole-wrapper {
  position: relative;
}
.whole-wrapper::after {
  position: absolute;
  top: 0px;
  left: 0px;
  right: 0px;
  bottom: 0px;
  margin: auto;
  content: "";
  background: rgba(0,0,0,0);
  z-index: -9;
}
.display-mob {
  display: none;
}
.search-wraps.single-search {
  padding-top: 140px;
}
#mobile-app-sections h2 {
  margin-top: 9%;
}
.search-input-wraps {
  border: none;
}
@media (min-width: 961px) and (max-width: 1024px) {
  .skew-wrap {
    width: 100%;
    padding: 0px;
    box-shadow: none;
  }
  .skew-wrap-1 {
    width: 100%!important;
    padding: 0px;
    box-shadow: none;
  }
  .ads1 {
    padding: 20px 0px 20px;
  }
  .res-margin-20 {
    margin-bottom: 0px;
  }
  
  .featured-box-image {
    height: 250px;
  }
  
  #mobile-app-sections {
    padding-top: 20px;
    padding-bottom: 0px;
  }
  #featured-restaurant .row .featured-box h4 {
    font-size: 16px;
    font-weight: 700;
    padding: 5px 0px 0px;
    color: #fff;
}
.search-wraps.single-search {
  padding-top: 0px!important;
  height: 168px;
  position: absolute!important;
  top: 0px;
  bottom: 0px;
  left: 0px;
  right: 0px;
  margin: auto;
}
  
}
@media  (min-width: 768px) and (max-width: 960px) {
  .skew-wrap {
    width: 100%;
    padding: 0px;
    box-shadow: none;
  }
  .skew-wrap1 {
    width: 100%;
    padding: 0px;
    box-shadow: none;
  }
  .ads1 {
    padding: 20px 0px 20px;
  }
  .res-margin-20 {
    margin-bottom: 20px;
  }
  #featured-restaurant h1 {
    font-size: 24px;
  }
  #featured-restaurant {
    padding: 30px 0px 30px;
    background: #fff;
}
  #featured-restaurant h6 {
    margin-bottom: 20px;
  }
  .featured-box-image {
    height: 250px;
  }
  
  #mobile-app-sections {
    padding-top: 20px;
    padding-bottom: 0px;
  }
  #mobile-app-sections h2 span {
    font-size: 30px;
    display: block;
    font-weight: 300 !important;
    line-height: 40px;
  }
  #mobile-app-sections h3 {
    margin: auto auto 25px;
    font-size: 14px;
    color: #666;
    line-height: 23px;
  }
  #getapp-wrap2 .mycol {
    width: 100px;
    display: inline-block;
  }
  #getapp-wrap2 {
    text-align: center;
  }
  .skew-wrap-1 {
    width: 95% !important;
    padding: 0px;
    box-shadow: none;
}
.search-wraps.single-search {
  padding-top: 0px!important;
  padding-top: 0px!important;
  height: 168px;
  position: absolute!important;
  top: 0px;
  bottom: 0px;
  left: 0px;
  right: 0px;
  margin: auto;
}
}
@media (min-width: 641px) and (max-width: 767px) {
  .skew-wrap {
    width: 100%;
    padding: 0px;
    box-shadow: none;
  }
  .skew-wrap1 {
    width: 100%;
    padding: 0px;
    box-shadow: none;
  }
  .ads1 {
    padding: 20px 0px 20px;
  }
  .res-margin-20 {
    margin-bottom: 20px;
  }
  #featured-restaurant h1 {
    font-size: 24px;
  }
  #featured-restaurant {
    padding: 0px 0px 20px;
    background: #fff;
  }
  #featured-restaurant h6 {
    margin-bottom: 20px;
  }
  .featured-box-image {
    height: 250px;
  }
  #getapp-wrap {
    display: none!important;
  }
  #mobile-app-sections {
    padding-top: 20px;
    padding-bottom: 20px;
  }
  #mobile-app-sections h2 span {
    font-size: 30px;
    display: block;
    font-weight: 300 !important;
    line-height: 40px;
  }
  #mobile-app-sections h3 {
    margin: auto auto 25px;
    font-size: 14px;
    color: #666;
    line-height: 23px;
  }
  #getapp-wrap2 .mycol {
    width: 100px;
    display: inline-block;
  }
  #getapp-wrap2 {
    text-align: center;
  }
  
}
@media (min-width: 480px) and (max-width: 640px) {
  .skew-wrap {
    width: 100%;
    padding: 0px;
    box-shadow: none;
  }
  .skew-wrap1 {
    width: 100%;
    padding: 0px;
    box-shadow: none;
  }
  .ads1 {
    padding: 20px 0px 20px;
  }
  .res-margin-20 {
    margin-bottom: 20px;
  }
  #featured-restaurant h1 {
    font-size: 24px;
  }
  #featured-restaurant {
    padding: 0px 0px 20px;
    background: #fff;
  }
  #featured-restaurant h6 {
    margin-bottom: 20px;
  }
  .featured-box-image {
    height: 250px;
  }
  #getapp-wrap {
    display: none!important;
  }
  #mobile-app-sections {
    padding-top: 20px;
    padding-bottom: 20px;
  }
  #mobile-app-sections h2 span {
    font-size: 30px;
    display: block;
    font-weight: 300 !important;
    line-height: 40px;
  }
  #mobile-app-sections h3 {
    margin: auto auto 25px;
    font-size: 14px;
    color: #666;
    line-height: 23px;
  }
  #getapp-wrap2 .mycol {
    width: 100px;
    display: inline-block;
  }
  #getapp-wrap2 {
    text-align: center;
  }
  .search-wraps.single-search {
    padding-top: 10%;
  }
  .search-wraps h1 {
    color: #fff;
    }
    .search-wraps p, .search-wraps p a {
      color: #fff;
    }
  .search-wraps  {
    padding-top: 0px!important;
  padding-top: 0px!important;
  height: 145px;
  position: absolute!important;
  top: 0px;
  bottom: 0px;
  left: 0px;
  right: 0px;
  margin: auto;

  }
}
@media (max-width: 479px) {
  .skew-wrap {
    width: 100%;
    padding: 0px;
    box-shadow: none;
  }
  .skew-wrap1 {
    width: 100%;
    padding: 0px;
    box-shadow: none;
  }
  .ads1 {
    padding: 20px 0px 20px;
  }
  .res-margin-20 {
    margin-bottom: 20px;
  }
  #featured-restaurant h1 {
    font-size: 24px;
  }
  #featured-restaurant {
    padding: 0px 0px 20px;
    background: #fff;
  }
  #featured-restaurant h6 {
    margin-bottom: 20px;
  }
  .featured-box-image {
    height: 250px;
  }
  #getapp-wrap {
    display: none!important;
  }
  #mobile-app-sections {
    padding-top: 20px;
    padding-bottom: 20px;
  }
  #mobile-app-sections h2 span {
    font-size: 30px;
    display: block;
    font-weight: 300 !important;
    line-height: 40px;
  }
  #mobile-app-sections h3 {
    margin: auto auto 25px;
    font-size: 14px;
    color: #666;
    line-height: 23px;
  }
  #getapp-wrap2 .mycol {
    width: 100px;
    display: inline-block;
  }
  #getapp-wrap2 {
    text-align: center;
  }
  .search-wraps.single-search {
    padding-top: 30%;
  }
  .search-wraps h1 {
    color: #fff;
    }
    .search-wraps p, .search-wraps p a {
      color: #fff;
    }
  .display-mob {
  display: block;
  width: 45px!important;
}
.hide-mob {
  display: none;
}
.search-wraps{
  height: 250px;
position: absolute;
top: 0px;
left: 0px;
right: 0px;
bottom: 0px;
margin: auto;
padding: 0px;
}
.search-wraps p {
  margin-bottom: 10px;
  margin-top: 10px;
}
.steps {
  width: 80%;
}
.search-input-wraps {
    padding: 10px 28px 10px 15px;
    background: #fff;
    width: 80%;
    margin: auto;
    border-radius: 5px;
    overflow: hidden;
}
.search-wraps  {
    padding-top: 0px!important;
  padding-top: 0px!important;
  height: 145px;
  position: absolute!important;
  top: 0px;
  bottom: 0px;
  left: 0px;
  right: 0px;
  margin: auto;

  }
  .landing video {
    display: none!important;
  }
}

.landing {
    height: 100%;
    width: 100%;
    overflow: hidden;
    position: relative;
    background-image: url(https://asiderapido.com/images/banner-1.jpg);
    background-size: cover;
    background-position: center;
}
.landing video {
    height: 100%;
    width: 100%;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1;
    object-fit: cover;
    display: inline-block;
vertical-align: baseline;
}
.search-wraps.single-search {
    z-index: 2;
    position: relative;
}
.steps {
  position: absolute;
  z-index: 3;
  left: 0px;
  right: 0px;
  margin: auto;
  bottom: 15%;
}

.search-wraps.single-search {
  color: #fff;
}
.search-wraps.single-search h1 {
  color: #333;
  font-family: 'Open Sans', sans-serif !important;
  font-weight: 400;
}
.search-wraps.single-search p {
  color: #333;
  margin-top: 20px;
  margin-bottom: 20px;
  font-family: 'Open Sans', sans-serif !important;
}
.border {
  border: none!important;
}
#s {
   border: none!important;
}

.download-app-block {
    padding: 80px 0;
}
.download-app-block {
    background-color: #fff;
}
.download-app-block .left-mobile {
    width: 33%;
}
.download-app-block .left-mobile {
    display: inline-block;
    vertical-align: middle;
}
.left-mobile figure {
    float: right;
    margin-bottom: 0;
}
.download-app-block .download-app-text {
    width: 58%;
}
.download-app-block .download-app-text, .download-app-block .left-mobile {
    display: inline-block;
    vertical-align: middle;
}
.download-app-wrap {
    font-size: 17px;
    line-height: 27px;
    padding-left: 14%;
    margin-top: -10%;
}
.download-app-wrap h4 {
    font-size: 26px;
    line-height: 30px;
    margin: 0 0 12px 0;
    font-family: 'proxima_nova' !important;
    color: #60ba62;
}
.download-app-wrap h4 a {
  color: #60ba62;
}
.download-app-wrap h2 {
    font-size: 45px;
    margin: 0 0 20px 0;
    line-height: 1.3636;
    letter-spacing: .05em;
}
.download-app-wrap h2 {
    font-size: 50px;
    margin: 0 0 20px 0;
    font-family: 'proxima_nova' !important;
}
.download-app-wrap p {
    font-size: 18px;
    font-family: 'proxima_nova' !important;
    line-height: 32px;
    margin-bottom: 40px;
    color: #777;
}
.download-from a:first-child {
    margin-right: 25px;
}
.blog-block {
    background: #f5f5f5;
    padding: 70px 0;
}
.blog-block .top-text-header {
    margin-bottom: 45px;
}
.blog-block h4 {
    font-family: 'proxima_nova';
    font-size: 22px;
    margin: 0 0 38px 0;
    letter-spacing: .05em;
}
.blog-single {
    min-height: 520px;
}
.blog-single-wrap figure {
    overflow: hidden;
    height: 242px;
    border-radius: 4px;
}
.blog-description {
    font-size: 13px;
    line-height: 19px;
    font-family: 'proxima_nova';
}
.blog-description {
    background: #fff;
    border-radius: 4px;
    padding: 25px 30px 30px;
    width: 92%;
    margin: auto;
    position: relative;
    margin-top: -57px;
}
.blog-block h6 {
    margin: 0 0 10px 0;
    font-family: 'proxima_nova';
}
.blog-block h6 a {
    font-size: 22px;
    line-height: 34px;
    margin: 0;
    font-family: 'proxima_nova';
    color: #333;
}

.blog-description .posted-date {
    margin-bottom: 14px;
    display: block;
    font-family: 'proxima_nova';
}
.blog-block p {
    font-size: 16px;
    line-height: 28px;
    margin: 0 0 20px 0;
    font-family: 'proxima_nova';
    color: #777;
}
.sections h2, .sections h4 {
  font-family: 'Open Sans', sans-serif !important;
}
element {
}
.sections h2, .sections h4 {
    font-family: 'proxima_nova' !important;
}
.sections h4 {
    font-size: 18px;
    text-align: inherit;
    color: #60ba62;
    margin: 0;
    line-height: normal;
    font-weight: 600;
}
.section-feature-resto p {
    margin-left: 0px;
    margin-right: 0px;
    margin: 5px 0px 5px 0px;
    font-family: 'proxima_nova' !important;
}
.block {
    padding: 90px 0;
}
.top-text {
    color: #575757;
    width: 61%;
    margin: 0 auto 65px;
    display: block;
    line-height: 27px;

}
.how-it-works-block h4 {
    margin: 0 0 20px 0;
    font-size: 22px;
    font-family: 'proxima_nova' !important;
}
.how-it-works-block .feature-item-wrap {
    padding: 0 11%;
}
.text-center figure {
    margin-left: auto;
    margin-right: auto;
}
.feature-item-wrap figure {
    height: 76px;
    margin-bottom: 15px;
}
.feature-item-wrap figure a {
    display: inline-block;
}
.feature-item-wrap figure img {
    margin: auto;
    display: inline-block;
}
.how-it-works-block h5 {
    margin: 0 0 20px 0;
    font-size: 20px;
    font-family: 'proxima_nova' !important;
}
.how-it-works-block .feature-item-wrap p {
    margin-bottom: 0;
    font-family: 'proxima_nova' !important;
    line-height: 28px;
}
.page-content-body p {
    font-size: 14px;
    font-family: 'proxima_nova' !important;
}
.top-menu-wrapper {
    position: absolute!important;
    background: transparent!important;
    width: 100%!important;
    top: 0px!important;
}
.top-small-bar {
  display: none;
}

.search-wraps.single-search {
    padding-top: 0px;
    position: absolute !important;
    width: 64%;
    left: 0px;
    right: 0px;
    top: 0px;
    bottom: 0px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
#forms-search {
  width: 100%;
}
@media (max-width: 767px) {
	.search-wraps.single-search {
		width: 80%;
	}
	.search-input-wraps {
		width: 100%;
	}
	.feature-item-wrap {
		margin-bottom: 30px;
	}
	#featured-restaurant {
		padding: 0px 20px;
	}
	.download-app-block .left-mobile {
		width: 100%;
	}
	.download-app-block .download-app-text {
		width: 100%;
	}
	.download-app-wrap h4 {
	    font-size: 20px;
	    line-height: 30px;
	    margin: 20px 0 12px 0;    
	}
	.download-app-wrap {
		padding-left: 10px;
	}
	.download-app-wrap h2 {
		font-size: 30px;
	}
	.download-from {
		display: flex;
	}
	.download-from a:first-child {
		margin-right: 10px;
	}
	#footer-new .new-f-row {
		flex-direction: column;
	}
	.footer-social {
		margin-top: 20px;
	}
	.new-f-row .col-md-7 {
		width: 90%;
	}
  .landing {
    
    background-image: url(https://asiderapido.com/images/mob-banner-1.jpg);
   
}
}
</style>

<script type="text/javascript">
  $(document).ready(function(){
    var screenHeight = $(window).height();
    //var topBar = $(".top-small-bar").outerHeight();
   // var topMenu = $(".top-menu-wrapper").outerHeight();
    var orderBar = $(".order-steps-container").outerHeight();
    var ofsetHeight = orderBar;
    
    var slideHeight = screenHeight-ofsetHeight;
    $(".landing").height(slideHeight);
  });
</script>