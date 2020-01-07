<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="../../../assets/css/style.css">
<?php
$kr_search_adrress = FunctionsV3::getSessionAddress();

$home_search_text=Yii::app()->functions->getOptionAdmin('home_search_text');
if (empty($home_search_text)){
	$home_search_text=Yii::t("default","asdasd");
}

$home_search_subtext=Yii::app()->functions->getOptionAdmin('home_search_subtext');
if (empty($home_search_subtext)){
	$home_search_subtext=Yii::t("default","asdads");
}

$home_search_mode=Yii::app()->functions->getOptionAdmin('home_search_mode');
$placholder_search=Yii::t("default","Street Address,City,State");
if ( $home_search_mode=="postcode" ){
	$placholder_search=Yii::t("default","Enter your postcode");
}
$placholder_search=Yii::t("default",$placholder_search);
?>


<?php if ( $home_search_mode=="address" || $home_search_mode=="") :?>

<section class="landing" style="background: transparent;/*background-image: url(https://asiderapido.com/images/bann-1.jpg) center bottom*/;background-position:center bottom !important ">
<!-- <video autoplay='true' loop='true' muted='true' poster='' src='https://asiderapido.com/images/video.mp4'>
  <source type="video/mp4" src="https://asiderapido.com/images/video.mp4"></source>
       <source type="video/webm" src="https://asiderapido.com/images/video.webm"></source> 
</video> -->

<!--INICIO SLIDER-->
  <header class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-adr">
      <a class="navbar-brand" href="#">
        <img src="../../../images/logo-adr.png" class="logo" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contacto</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Registrate</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
<div class="bd-example">
  <section id="slider">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="../../../../images/s1.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="../../../../s2.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="../../../../s3.jpg" class="d-block w-100" alt="...">
        </div>
            <div class="slider carousel-caption d-none d-md-block">
              <img src="../../../../images/f-slider.svg" class="slider d-block" alt="...">
            </div>
      </div>
    </div>
  </section>
</div>

<!--FIN SLIDER-->



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
<section id="section-1">
    <div class="container">
      <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
          <center><h3 class="titulo-s1">¿Qué te ofrecemos?</h3></center>
          <p class="texto-s1">La forma más facil y segura para ordenar y pagar todo lo que necesites</p>
        </div>
        <!--<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
          
        </div>-->
      </div>
    </div>
  </section>
  <section id="section-2">
    <div class="container">
      <div class="row">
        <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12">
          <h3 class="titulo-s1">¿Como funciona?</h3>
          <p class="texto-s2">La forma más facil y segura para ordenar y pagar todo lo que necesites hola me llamo esteban de la santisima trinidad</p>
        </div>
        <!--<div class="col-xl-8 .col-lg-8 .col-md-12 .col-sm-12">
          <div class="pasos-1">
            <img src="btn1.svg" alt="">
          </div>
          <div class="pasos-2">
            <img src="btn2.svg" alt="">
          </div>
          <div class="pasos-3">
            <img src="btn3.svg" alt="">
          </div>
        </div>-->
      </div>
    </div>
  </section>
  <section id="section-3">
    <div class="container">
      <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
          <center><h3 class="titulo-s1">Social Media</h3>
            <p class="texto-s1">Digitalizate nadie es más rapido para posicionarte...</p></center>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
          
        </div>
      </div>
    </div>
  </section>
  <section id="slider2">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators c-puntos">
        <li class="puntos" data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li class="puntos" data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li class="puntos" data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        <li class="puntos" data-target="#carouselExampleIndicators" data-slide-to="3"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="../../../../images/f1.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="../../../../images/f1.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="../../../../images/f1.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="../../../../images/f1.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="text-slider carousel-caption d-none d-md-block">
              <img src="../../../../images/icon1.svg" class="icon1 d-block" alt="...">
              
              <p>¿Estas de aniversario y se te olvido hacer esa cena romantica?</p><br>
              <h2>Pídemelo, lo tenemos, lo tienes.</h2><br>
              <div class="cont-img">
              <a href=""><img src="./../../../ios.png" class="img-descarga" alt=""></a>
              <a href=""><img src="./../../../playstore.png" class="img-descarga" alt=""></div></a>
              <!--<div class="descarga d-block"></div>--><br>
              <a href="" class="instagram"><img src="../../../../instagram.svg" alt=""><span>@asiderapido</span></a><br>
            </div>
      </div>
    </div>
  </section>
  <footer>
    <div class="container">
      <div class="row">
        <div class="witget col-xl-3 col-lg-3 col-md-6 col-sm-12">
          <img src="../../../../images/logo-adr.png" width="114" alt="">
        </div>
        <div class="witget col-xl-3 col-lg-3 col-md-6 col-sm-12">
          <h4>Ciudades</h4>
          <ul>
            <li>Valencia</li>
            <li>Caracas(Próximamente)</li>
            <li>Maracay(Próximamente)</li>
          </ul>
        </div>
        <div class="witget col-xl-3 col-lg-3 col-md-6 col-sm-12">
          <h4>Links</h4>
          <ul>
            <li>Blog</li>
            <li>Términos y Condiciones</li>
            <li>Trabaja con Nosotros</li>
            <li>Contactanos</li>
          </ul>
        </div>
        <div class="witget col-xl-3 col-lg-3 col-md-6 col-sm-12">
          <h4>Soporte</h4>
          <ul>
            <li><a href="">FAQ</a></li>
            <li><a href="">Centro de Soporte</a></li>
          </ul>
        </div>
      </div>
      <div class="derechos-text">
      <p>Todos los derechos reservados. Asiderapido, C.A. Rif: J-41090166-7</p>
    </div>
    </div>
    
  </footer>
    


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
<!--<div class="how-it-works" style="background-image: url(https://asiderapido.com/images/video-bg.jpg);" >
  <div class="container">
    <img src="https://asiderapido.com/images/smiley.png">
    <h1>De manera fácil y segura puedes ordenar y pagar todo lo que necesites</h1>
    
    
  </div>
</div>
<section class="block how-it-works-block" style="padding-bottom: 0px; font-family: 'Open Sans', sans-serif !important; ">
   <div class="container">
      <div class="top-text text-center wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
         <h4 class="text-uppercase text-sp text-lt" style="font-size: 28px !important; font-weight: bold;">¿Cómo funciona?</h4>
      </div>
      <div class="row">
         <div class="col-xs-12 col-sm-4 choose wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;">
            <div class="feature-item-wrap text-center">
               <figure><img class="img-responsive" src="<?php //echo assetsURL()."/images/search.svg"?>" alt="Busca productos" width="105"></figure>
               <h5 style="margin-top: 53px !important;font-weight: bold;font-size: 28px;">Selecciona tu producto</h5>
               <p>Navega a través de cientos de establecimientos, selecciona lo que quieras y paga.</p>
            </div>
         </div>
         <div class="col-xs-12 col-sm-4 choose wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;">
            <div class="feature-item-wrap text-center">
               <figure><img class="img-responsive" src="<?php //echo assetsURL()."/images/scooter.svg"?>" alt="Despachamos tu pedido" width="105"></figure>
               <h5 style="margin-top: 53px !important;font-weight: bold;font-size: 28px;">ColiRápido en camino</h5>
               <p>Nuestra red de despachadores se esmerarán en hacerte llegar el pedido en tiempo record.</p>
            </div>
         </div>
         <div class="col-xs-12 col-sm-4 choose wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;">
            <div class="feature-item-wrap text-center">
               <figure><img class="img-responsive" src="<?php //echo assetsURL()."/images/confetti.svg"?>" alt="Disfruta tu compra" width="105"></figure>
               <h5 style="margin-top: 53px !important;font-weight: bold;font-size: 28px;">¡Disfruta!</h5>
               <p>Olvidate de las colas, nosotros nos movemos por ti.</p>
            </div>
         </div>
      </div>
   </div>
</section>-->


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
 <!--<a name="descargar"></a>
<section class="download-app-block" style="font-family: 'Open Sans', sans-serif !important;">
    <div class="container">
        <div class=" left-mobile animated">
            <figure><img src="https://asiderapido.com/images/mobile-phone-big.png" alt="Mobile phone"></figure>
        </div>
        <div class=" download-app-text animated">
            <div class="download-app-wrap">
              
                <h4 style="color: #325193 !important;font-family: 'Open Sans', sans-serif !important;">¡DESCARGAR AHORA TU APP!</h4>
                <h2 class="text-lt text-sp" style="font-family: 'Open Sans', sans-serif !important;">Ordena donde quieras y cuando quieras</h2>
                <p style="font-family: 'Open Sans', sans-serif !important;">¿Ya empezó la pelicula y no te quieres mover de tu casa para comprar pizza?, ¿Estás de aniversario y se te olvidó hacer esa cena romántica?. Descarga ya Así de Rápido y ordena todo lo quieras de forma sencilla. </p>
                <div class="download-from">
                    <a href="https://itunes.apple.com/us/app/asiderapido/id1447988572?l=es&ls=1&mt=8" class="pull-left" data-toggle="modal" data-target=".download-popup"><img src="https://asiderapido.com/images/app-store.png" alt="App store"></a>
                    <a href="https://play.google.com/store/apps/details?id=com.adr.deliveryapp" class="pull-left"><img src="https://asiderapido.com/images/google-play.png" alt="Google Play"></a>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</section>-->


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

<!--  BOOTSTRAP
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>-->

<script type="text/javascript" src="https://asiderapido.com/parallax/parallax.js">
  $('.parallax-window').parallax({imageSrc: 'https://asiderapido.com/images/bgg.jpg'});

</script>
 <style type="text/css">

@import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800');
@import url('https://fonts.googleapis.com/css?family=Reenie+Beanie');
*{
  font-family: 'Open Sans', sans-serif !important;
}
a {
    color: #60ba62;
    text-decoration: none;
}
  .dishes-wrapper {
    padding: 80px 0px;
    text-align: center;
    background: #f3f3f3;
  }

  .top-menu-wrapper img.logo {
  margin-top: 15px !important;
  }

  #menu a {
  background: #264baa !important;
  border: 0px solid #60ba62 !important;
  margin-left: 5px !important;
  }

  #menu a:hover {
  background-color: rgb(41, 159, 209) !important;
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
    font-weight: 300!important;
    text-align: center;
    font-family: 'Open Sans', sans-serif !important;
    text-transform: uppercase;
  }
  #featured-restaurant h1 strong {
    font-weight: 300!important;
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
  color: #fff!important;
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
  color: #000;
  font-family: 'Open Sans', sans-serif !important;
  font-weight: 400;
}
.search-wraps.single-search p {
  color: #333;
  margin-top: 20px;
  margin-bottom: 20px;
  font-family: 'Open Sans', sans-serif !important;
  letter-spacing: 5px;
  font-weight: bold;
  font-size: 18px;
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
    font-family: 'Open Sans', sans-serif !important;
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
    font-family: 'Open Sans', sans-serif !important;
}
.download-app-wrap p {
    font-size: 18px;
    font-family: 'Open Sans', sans-serif !important;
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
    font-family: 'Open Sans', sans-serif !important;
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
    font-family: 'Open Sans', sans-serif !important;
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
    font-family: 'Open Sans', sans-serif !important;
}
.blog-block h6 a {
    font-size: 22px;
    line-height: 34px;
    margin: 0;
    font-family: 'Open Sans', sans-serif !important;
    color: #333;
}

.blog-description .posted-date {
    margin-bottom: 14px;
    display: block;
    font-family: 'Open Sans', sans-serif !important;
}
.blog-block p {
    font-size: 16px;
    line-height: 28px;
    margin: 0 0 20px 0;
    font-family: 'Open Sans', sans-serif !important;
    color: #777;
}
.sections h2, .sections h4 {
  font-family: 'Open Sans', sans-serif !important;
}
element {
}
.sections h2, .sections h4 {
    font-family: 'Open Sans', sans-serif !important;
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
    font-family: 'Open Sans', sans-serif !important;
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
    font-family: 'Open Sans', sans-serif !important;
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
    font-family: 'Open Sans', sans-serif !important;
}
.how-it-works-block .feature-item-wrap p {
    margin-bottom: 0;
    font-family: 'Open Sans', sans-serif !important;
    line-height: 28px;
}
.page-content-body p {
    font-size: 14px;
    font-family: 'Open Sans', sans-serif !important;
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

/*.carousel-indicators li{
  border-radius: 50%;
  width: 20px;
  height: 20px;
  border: none;
  margin-right: 80px !important;
}
.carousel-indicators li:active{
  border-radius: 50%;
  width: 20px;
  height: 20px;
  border: none;
  margin-right: 80px !important;
}
.carousel-indicators{
  display: grid;
  justify-content: right;
  margin-right: 4%;
  margin-bottom: 35% !important;
  margin-left: 0px !important;
  border: none !important;
}*/
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

<script type="text/javascript">
$(document).ready(function(){
  $('.owl-carousel').owlCarousel();
});
</script>