<link rel="stylesheet" href="http://asiderapido.com/css/sample2.css">
<!--script src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/jquery-1.10.2.min.js" type="text/javascript"></script-->

<div class="preLoader" style="display: none;" >
  <div class="loader">
    <div class="loaderBox">
        <div class="loadBars"></div>
        <div class="loadBars"></div>
        <div class="loadBars"></div>
    </div>
  </div>
</div>

<div class="top-small-bar">
  <div class="container">
    <p>
        Call us for Ordering. 
        +91 8640 999 888</p>
      
    </ul>
  </div>
</div>
<div class="top-menu-wrapper <?php echo "top-".$action;?>">

<div class="container border" >
  <div class="col-md-3 col-xs-3 border col-a">
    <?php if ( $theme_hide_logo<>2):?>
    <a href="<?php echo websiteUrl()?>">
     <img src="<?php echo FunctionsV3::getDesktopLogo();?>" class="logo logo-desktop">
     <img src="<?php echo FunctionsV3::getMobileLogo();?>" class="logo logo-mobile">
    </a>
    <?php endif;?>
  </div>
  
  
  
  <?php if ( Yii::app()->controller->action->id =="menu"):?>
  <div class="col-xs-1 cart-mobile-handle border relative">     
      <div class="badge cart_count"></div>
     <a href="<?php echo Yii::app()->createUrl('store/cart')?>">       
       <i class="ion-ios-cart"></i>
     </a>
  </div> <!--cart-mobile-handle-->
  <?php endif;?>
  
  
  <div class="col-md-9 border col-b text-right">
    <span class="bt-text">Feel Hungry?</span><?php $this->widget('zii.widgets.CMenu', FunctionsV3::getMenu() );?> 
    <div class="clear"></div>
  </div>
  
</div> <!--container-->

</div> <!--END top-menu-->

<div class="menu-top-menu">
    <?php $this->widget('zii.widgets.CMenu', FunctionsV3::getMenu() );?> 
    <div class="clear"></div>
</div> <!--menu-top-menu-->

<style type="text/css">
  .top-menu-wrapper {
    position: relative;
    background-color: #fff;
  }
  .top-menu-wrapper img.logo {
    width: 148px;
    min-width: 148px;
}
#menu a {
  color: #292929;
  font-family: "Open Sans";
  background: #f9a700;
color: #fff;
padding: 10px 30px;
border-radius: 5px;
transition: all .25s ease;
}
#menu a:hover {
  color: #fff;
  background: #f5a402;
}
#menu li:first-child{
  display: none;
}
.top-small-bar {
  padding: 15px 0px;
  background: #111;

}
.top-small-bar p {
  text-align: center;
  
  font-family: "Open Sans";
  font-size: 12px;
  color: #cdcdcd;
  padding: 0px;
  margin: 0px;
  text-transform: uppercase;
letter-spacing: 2px;
}
.top-menu-wrapper {
  padding-top: 10px;
  padding-bottom: 10px;
}
.bt-text {
  text-align: right;
padding-right: 20px;
line-height: 50px;
font-weight: 700;
font-size: 18px;
}
@media (max-width: 640px) {
  .top-small-bar p {
    font-size: 10px;
    color: #cdcdcd;
    padding: 0px;
    margin: 0px;
    text-transform: uppercase;
    letter-spacing: 0px;
  }
  .top-small-bar {
    padding: 5px 0px;
    background: #111;
  }
  .top-menu-wrapper {
    padding-top: 5px;
    padding-bottom: 5px;
  }
  .top-menu-wrapper img.logo {
    width: 80px;
    min-width: 80px;
}
}
</style>