<div class="order-steps-container "><div class="order-steps-expander"> <div class="container"> <div class="title">   <span class="trigger" onclick="scrollTo()"></span> </div> </div> </div> </div>

<div class="sections section-grey2 section-profile">
  <div class="container new-rofile-section">

  <div class="row" >
    
  <div class="col-md-12 ">
  
  <div class="tabs-wrapper">
     <ul id="tabs">
       <li class="<?php echo $tabs==""?"active":''?>">
       <i class="ion-android-contact"></i> <span><?php echo t("Profile")?></span>
       </li> 
             
       <li class="address-book <?php echo $tabs==2?"active":''?>" >
         <i class="ion-ios-location-outline"></i> <span><?php echo t("Address Book")?></span>
       </li>
       
       <li ><i class="ion-ios-book-outline"></i> 
       <span><?php echo t("Order History")?></span>
       </li>
       
       <li style="display: none;" ><i class="ion-ios-bookmarks-outline"></i> 
       <span><?php echo t("Booking History")?></span>
       </li>
       
       
      <?php if (FunctionsV3::hasModuleAddon("pointsprogram")) :?>
      <?php PointsProgram::frontMenu(true);?>
      <?php endif;?>
       
     </ul>
     
     <ul id="tab">
       <li class="<?php echo $tabs==""?"active":''?>">
          <?php $this->renderPartial('/front/profile',array(
            'data'=>$info           
          ));?>
       </li>
       <li class="addr-book <?php echo $tabs==2?"active":''?>">
         <?php $this->renderPartial('/front/address-book',array(
           'client_id'=>Yii::app()->functions->getClientId(),
           'data'=>Yii::app()->functions->getAddressBookByID( isset($_GET['id'])?$_GET['id']:'' ),
           'tabs'=>$tabs
         ));?>
       </li>
       <li>
         <?php $this->renderPartial('/front/order-history',array(           
           'data'=>Yii::app()->functions->clientHistyOrder( Yii::app()->functions->getClientId() )
         ));?>
                
       </li>
       
       <li>
        <?php $this->renderPartial('/front/booking-history',array(           
           'data'=>FunctionsV3::getBooking( Yii::app()->functions->getClientId() )
         ));?>
       </li>
       
       <?php if ( $disabled_cc != "yes"):?>
       <li class="addr-book <?php echo $tabs==4?"active":''?>" >
       <?php 
         if (isset($_GET['do']) && $tabs == 4){
         	 $this->renderPartial('/front/manage-credit-card-add',array(
         	   'data'=>Yii::app()->functions->getCreditCardInfo(isset($_GET['id'])?$_GET['id']:''),
         	   'tabs'=>$tabs
         	 ));
         } else {
		     $this->renderPartial('/front/manage-credit-card',array(
		       'tabs'=>$tabs
		     ));
         }
		 ?>     
       </li>
       <?php endif;?>
       
     </ul>
  </div> <!--tabs-wrapper--> 
  
      
    </div> <!--col-->
    
    
    
  </div> <!--row-->
  </div> <!--container-->  
</div> <!--sections-->


<style type="text/css">
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

.avatar-wrap {
    display: block;
    margin: 0;
    max-width: 100%;
    width: 150px;
    height: 150px;
    border-radius: 100%;
}
.avatar-wrap img {
  border-radius: 0px; 
}
.profile-head {
  display: flex;
}
.connected-wrap {
  padding-left: 20px;
  width: 100%;
  border: none;
}
.new-rofile-section {
  padding: 30px;
  background-color: #fff;
}
.new-rofile-section .tabs-wrapper {
  display: flex;
  border: 0px solid ;
  background: #fff;
}
.new-rofile-section ul#tabs {
  width: 25%;
}
.new-rofile-section ul#tabs {
    list-style-type: none;
    padding: 0;
       
    text-align: center;
    background: #f5f5f5;
    border-bottom: 0px solid #c9c7c7;
    padding-left: 20px;
    padding-top: 20px;
    padding-bottom: 20px;
}
.new-rofile-section ul#tabs li.active {
    border-bottom: 0px solid #f75d34;
    background: #fff;
}
.new-rofile-section ul#tabs li.active i {
    color: #454545;
}
 .new-rofile-section ul#tabs li i {
    font-size: 26px;
    margin-right: 5px;
    width: 25px;
}
.new-rofile-section ul#tabs li {
    display: flex;
    padding: 5px 15px;
    margin-bottom: 4px;
    cursor: pointer;
    text-align: left;
    padding: 14px 15px;
    align-items: center;
}
.new-rofile-section ul#tab {
  width: 75%;
  padding-left: 30px;
}
.new-rofile-section .grey-fields {
    background: #fff;
    border: 1px solid #eaeaea;
    color: #1e1e1e;
    padding: 8px 10px;
    width: 100%;
}
.new-rofile-section ul#tabs li:hover {
    border-bottom: 0px solid #f75d34;
}
.new-rofile-section .box-grey {
  border: 0px!important;
  border-radius: 0px!important;
}
#table_list tr, #table_list th, #table_list td {
  border: 1px solid #ddd;
  border-collapse:  collapse;
  padding: 10px;
}
#table_list a {
  color: #999;
  font-size: 13px;
}
#tab {
  position: relative;
}
.addr-book  .round-plus-new  {
  width: 140px;
  height: 140px;
  line-height: 50px;
  border-radius: 100%;
  text-align: center;
  line-height: 50px;
  display: block;
  position: relative;
  top: 0px;
  left: 0px;
  right: 0px;
  margin: auto;
  bottom: 0px;
  background: #fff;
  border: 3px dashed #DDD;
}
.addr-book  .round-plus-new:hover {
  background: transparent;
  border: 3px dashed #DDD;
}
.addr-book  .round-plus-new i {
  line-height: 50px;
  font-size: 40px;
  position: absolute;
  top: 0px;
  left: 0px;
  right: 0px;
  bottom: 0px;
  margin: auto;
  width: 33px;
  height: 46px;
  color: #00b279;
}
.addr-book h3 {
  text-align: center;
  font-size: 20px;
}
.addr-book h5 {
  text-align: center;
}
#addressCards .addressCard .caption {
  background: #f8f8f8;
  border: 1px solid #f0f0f0;
  border-top: 5px solid #e7e7e7e6;
  border-radius: 0px;
  -webkit-box-shadow: 0px 0px 16px 0px rgba(0,0,0,0.11);
  -moz-box-shadow: 0px 0px 16px 0px rgba(0,0,0,0.11);
  box-shadow: 0px 0px 16px 0px rgba(0, 0, 0, 0.11);
  margin: 10px;
}
#addressCards .addressCard  .caption {
    padding: 50px 20px 20px 20px;
    color: #333;
}
#addressCards .addressCard .caption  h3 {
  text-align: left;
  text-transform: uppercase;
  font-size: 18px;
  font-weight: 700;
}
#addressCards .addressCard .caption p {
      font-size: 12px!important;
}
#addressCards .addressCard  .options {
  width: 90px;
  display: flex;
  margin-top: -30px;
}
#addressCards .addressCard   .options i {
  font-size: 18px;
  background: #121212;
  width: 40px;
  display: block;
  height: 40px;
  line-height: 41px;
  text-align: center;

  border-radius: 100%;
  color: #fff;
  margin: 2px;
}
#addressCards .addressCard  .options i::before {
  line-height: 38px;
}
#addressCards .addressCard {
  border: none;
}
.creditCard .caption {
  background: #f8f8f8;
  border: 1px solid #f0f0f0;
  border-top: 5px solid #e7e7e7e6;
  border-radius: 0px;
  -webkit-box-shadow: 0px 0px 16px 0px rgba(0,0,0,0.11);
  -moz-box-shadow: 0px 0px 16px 0px rgba(0,0,0,0.11);
  box-shadow: 0px 0px 16px 0px rgba(0, 0, 0, 0.11);
  margin: 10px;
  padding: 20px 20px 20px 20px;
  color: #333;
  text-align: center;
}
.creditCard {
  border: none;
}
.creditCard p {
  font-size: 12px;
}
.creditCard .options {
  width: 100%;
  display: flex;
  margin-top: 10px;
  margin-bottom: 10px;
  justify-content: center;
}
.creditCard  .options i {
  font-size: 18px;
  background: #121212;
  width: 40px;
  display: block;
  height: 40px;
  line-height: 41px;
  text-align: center;

  border-radius: 100%;
  color: #fff;
  margin: 2px;
}
.creditCard .options i::before {
  line-height: 38px;
}
@media (min-width: 960px) and (max-width: 1024px) {
  .new-rofile-section {
    padding: 15px;
  }
  .tabs-wrapper {
    flex-direction: column;
  }
  .new-rofile-section ul#tabs {
    display: flex;
    width: 100%!important;
    padding: 0px!important;
  }
  .new-rofile-section ul#tab {
    width: 100%;
    padding: 10px 0px;
  }
  .new-rofile-section ul#tabs li {
    margin-top: 4px;
    margin-bottom: 0px;
  }
  #frm-cc .row {
    margin-bottom: 0px!important;
  }
   #frm-cc  p {
    margin: 10px 0px 10px!important;
    display: block;
   }
   .krms-forms-btn {
    margin-top: 10px;
   }
   #forms .row {
    margin-bottom: 0px!important;
  }
  #forms  p {
    margin: 10px 0px 10px!important;
    display: block;
   }
   #forms .green-button {
      margin-top: 10px;
   }
   #tab .box-grey {
    padding: 0px;
   }
   #addressCards .addressCard .options i {
    font-size: 15px;
    width: 30px;
    height: 30px;
    line-height: 9px;
    margin: 2px;
  }
  #addressCards .addressCard .options i::before {
    line-height: 30px;
  }
  #addressCards .addressCard .options {
    width: 67px;
    display: flex;
    margin-top: -30px;
    margin-right: -60px;
}
  #addressCards .addressCard .caption  {
    padding-right: 70px;
  }
}
@media (min-width: 768px) and (max-width: 960px) {
  .new-rofile-section {
    padding: 15px;
  }
  .tabs-wrapper {
    flex-direction: column;
  }
  .new-rofile-section ul#tabs {
    display: flex;
    width: 100%!important;
    padding: 0px!important;
  }
  .new-rofile-section ul#tab {
    width: 100%;
    padding: 10px 0px;
  }
  .new-rofile-section ul#tabs li {
    margin-top: 4px;
    margin-bottom: 0px;
  }
  #frm-cc .row {
    margin-bottom: 0px!important;
  }
   #frm-cc  p {
    margin: 10px 0px 10px!important;
    display: block;
   }
   .krms-forms-btn {
    margin-top: 10px;
   }
   #forms .row {
    margin-bottom: 0px!important;
  }
  #forms  p {
    margin: 10px 0px 10px!important;
    display: block;
   }
   #forms .green-button {
      margin-top: 10px;
   }
   #tab .box-grey {
    padding: 0px;
   }
   #addressCards .addressCard .options i {
    font-size: 15px;
    width: 30px;
    height: 30px;
    line-height: 9px;
    margin: 2px;
  }
  #addressCards .addressCard .options i::before {
    line-height: 30px;
  }
  #addressCards .addressCard .options {
    width: 67px;
    display: flex;
    margin-top: -30px;
    margin-right: -60px;
}
  #addressCards .addressCard .caption  {
    padding-right: 70px;
  }
}
@media (min-width: 641px) and (max-width: 767px) {
  .new-rofile-section {
    padding: 15px;
  }
  .tabs-wrapper {
    flex-direction: column;
  }
  .new-rofile-section ul#tabs {
    display: flex;
    width: 100%!important;
    padding: 0px!important;
  }
  .new-rofile-section ul#tab {
    width: 100%;
    padding: 10px 0px;
  }
  .new-rofile-section ul#tabs li {
    margin-top: 4px;
    margin-bottom: 0px;
  }
  #frm-cc .row {
    margin-bottom: 0px!important;
  }
   #frm-cc  p {
    margin: 10px 0px 10px!important;
    display: block;
   }
   .krms-forms-btn {
    margin-top: 10px;
   }
   #forms .row {
    margin-bottom: 0px!important;
  }
  #forms  p {
    margin: 10px 0px 10px!important;
    display: block;
   }
   #forms .green-button {
      margin-top: 10px;
   }
   #tab .box-grey {
    padding: 0px;
   }
   #addressCards .addressCard .options i {
    font-size: 15px;
    width: 30px;
    height: 30px;
    line-height: 9px;
    margin: 2px;
  }
  #addressCards .addressCard .options i::before {
    line-height: 30px;
  }
  #addressCards .addressCard .options {
    width: 67px;
    display: flex;
    margin-top: -30px;
    margin-right: -60px;
}
  #addressCards .addressCard .caption  {
    padding-right: 70px;
  }
  .creditCard {
    border: none;
    padding-left: 13%;
    padding-right: 13%;
}
.addressCard {
    padding-left: 13%;
    padding-right: 13%;
}
#forms {
  padding-left: 13%;
    padding-right: 13%;
}
}

@media (min-width: 480px) and (max-width: 640px) {
  .new-rofile-section {
    padding: 15px;
  }
  .tabs-wrapper {
    flex-direction: column;
  }
  .new-rofile-section ul#tabs {
    display: flex;
    width: 100%!important;
    padding: 0px!important;
  }
  .new-rofile-section ul#tab {
    width: 100%;
    padding: 10px 0px;
  }
  .new-rofile-section ul#tabs li {
    margin-top: 4px;
    margin-bottom: 0px;
  }
  #frm-cc .row {
    margin-bottom: 0px!important;
  }
   #frm-cc  p {
    margin: 10px 0px 10px!important;
    display: block;
   }
   .krms-forms-btn {
    margin-top: 10px;
   }
   #forms .row {
    margin-bottom: 0px!important;
  }
  #forms  p {
    margin: 10px 0px 10px!important;
    display: block;
   }
   #forms .green-button {
      margin-top: 10px;
   }
   #tab .box-grey {
    padding: 0px;
   }
   #addressCards .addressCard .options i {
    font-size: 15px;
    width: 30px;
    height: 30px;
    line-height: 9px;
    margin: 2px;
  }
  #addressCards .addressCard .options i::before {
    line-height: 30px;
  }
  #addressCards .addressCard .options {
    width: 67px;
    display: flex;
    margin-top: -30px;
    margin-right: -60px;
}
  #addressCards .addressCard .caption  {
    padding-right: 70px;
  }
  #forms {
    padding-left: 10%;
    padding-right: 10%;
  }
  .addressCard {
    padding-left: 12%;
    padding-right: 12%;
  }
  .creditCard {
    padding-left: 12%;
    padding-right: 12%;
  }
}
@media (max-width: 480px) {
  .new-rofile-section {
    padding: 15px;
  }
  .tabs-wrapper {
    flex-direction: column;
  }
  .new-rofile-section ul#tabs {
    display: flex;
    width: 100%!important;
    padding: 0px!important;
  }
  .new-rofile-section ul#tab {
    width: 100%;
    padding: 10px 0px;
  }
  .new-rofile-section ul#tabs li {
    margin-top: 4px;
    margin-bottom: 0px;
  }
  #frm-cc .row {
    margin-bottom: 0px!important;
  }
   #frm-cc  p {
    margin: 10px 0px 10px!important;
    display: block;
   }
   .krms-forms-btn {
    margin-top: 10px;
   }
   #forms .row {
    margin-bottom: 0px!important;
  }
  #forms  p {
    margin: 10px 0px 10px!important;
    display: block;
   }
   #forms .green-button {
      margin-top: 10px;
   }
   #tab .box-grey {
    padding: 0px;
   }
   #addressCards .addressCard .options i {
    font-size: 15px;
    width: 30px;
    height: 30px;
    line-height: 9px;
    margin: 2px;
  }
  #addressCards .addressCard .options i::before {
    line-height: 30px;
  }
  #addressCards .addressCard .options {
    width: 67px;
    display: flex;
    margin-top: -30px;
    margin-right: -60px;
}
  #addressCards .addressCard .caption  {
    padding-right: 70px;
  }
}
</style>