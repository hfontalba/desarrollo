<div class="login-form">
<div class="row top10">
<div class="col-md-10">
  <?php echo CHtml::textField('first_name','',array(
   'class'=>'grey-fields full-width',
   'placeholder'=>Yii::t("default","First Name"),
   'data-validation'=>"required"
  ))?>
 </div> 
</div>

<div class="row top10">
<div class="col-md-10">
  <?php echo CHtml::textField('last_name','',array(
   'class'=>'grey-fields full-width',
   'placeholder'=>Yii::t("default","Last Name"),
   'data-validation'=>"required"
  ))?> 
 </div> 
</div>

<?php if ($transaction_type=="delivery"):?>

<div class="row top10">
<div class="col-md-10">
<?php echo CHtml::textField('street',
isset($client_info['street'])?$client_info['street']:''
,array(
   'class'=>'grey-fields full-width',
   'placeholder'=>Yii::t("default","Street"),
   'data-validation'=>"required"
  ))?> 
</div> 
</div>

<div class="row top10">
<div class="col-md-10">
<?php echo CHtml::textField('city',
isset($client_info['city'])?$client_info['city']:''
,array(
   'class'=>'grey-fields full-width',
   'placeholder'=>Yii::t("default","City"),
   'data-validation'=>"required"
  ))?> 
</div> 
</div>

<div class="row top10">
<div class="col-md-10">
<?php echo CHtml::textField('state',
isset($client_info['state'])?$client_info['state']:''
,array(
   'class'=>'grey-fields full-width',
   'placeholder'=>Yii::t("default","State"),
   'data-validation'=>"required"
  ))?> 
</div> 
</div>

<div class="row top10">
<div class="col-md-10">
<?php echo CHtml::textField('zipcode',
isset($client_info['zipcode'])?$client_info['zipcode']:''
,array(
   'class'=>'grey-fields full-width',
   'placeholder'=>Yii::t("default","Zip code")
  ))?> 
</div> 
</div>

<div class="row top10">
<div class="col-md-10">
<?php echo CHtml::textField('location_name',
isset($client_info['location_name'])?$client_info['location_name']:''
,array(
   'class'=>'grey-fields full-width',
   'placeholder'=>Yii::t("default","Apartment suite, unit number, or company name"),   
  ))?>
</div> 
</div>

<div class="row top10">
<div class="col-md-10">
<?php echo CHtml::textField('contact_phone',
isset($client_info['contact_phone'])?$client_info['contact_phone']:''
,array(
   'class'=>'grey-fields mobile_inputs',
   'placeholder'=>Yii::t("default","Mobile Number"),
   'data-validation'=>"required"  
  ))?> 
</div> 
</div>

<div class="row top10">
<div class="col-md-10">
<?php echo CHtml::textField('delivery_instruction','',array(
  'class'=>'grey-fields full-width',
  'placeholder'=>Yii::t("default","Delivery instructions")   
))?> 
</div> 
</div>

<div class="row top10">
<div class="col-md-10">
<?php echo CHtml::textField('email_address','',array(
   'class'=>'grey-fields full-width',
   'placeholder'=>Yii::t("default","Email address"),   
  ))?> 
</div> 
</div>

<?php else :?>

<?php 
echo CHtml::hiddenField('street','');
echo CHtml::hiddenField('city','');
echo CHtml::hiddenField('state','');
echo CHtml::hiddenField('zipcode','');
echo CHtml::hiddenField('location_name','');
echo CHtml::hiddenField('delivery_instruction','');
?>

<div class="row top10">
<div class="col-md-10">
<?php echo CHtml::textField('contact_phone',
isset($client_info['contact_phone'])?$client_info['contact_phone']:''
,array(
   'class'=>'grey-fields mobile_inputs',
   'placeholder'=>Yii::t("default","Mobile Number"),
   'data-validation'=>"required"  
  ))?> 
</div> 
</div>

<div class="row top10">
<div class="col-md-10">
<?php echo CHtml::textField('email_address','',array(
   'class'=>'grey-fields full-width',
   'placeholder'=>Yii::t("default","Email address"),   
  ))?> 
</div> 
</div>

<?php endif;?>


<?php FunctionsV3::sectionHeader('Create Account')?>		  
<p class="text-muted text-small">***<?php echo t("Optional")?></p>

<div class="row top10">
<div class="col-md-10">
   <?php echo CHtml::passwordField('password','',array(
   'class'=>'grey-fields full-width',
   'placeholder'=>Yii::t("default","Password"),   
  ))?>
 </div> 
</div>       
</div>
<style type="text/css">
@import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,700');
  .login-form {
    padding: 30px 40px;
  }
  .login-form input[type="text"],
  .login-form input[type="password"] {
    width: 100%;
    border:0px;
    border: 1px solid #eee;
    background: #fff;
    margin-bottom: 10px;
    height: 40px;
  }
  #mylogin {
    /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#ffffff+0,ffffff+49,354448+49,354448+100 */
background: rgb(255,255,255); /* Old browsers */
background: -moz-linear-gradient(left, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 49%, rgba(53,68,72,1) 49%, rgba(53,68,72,1) 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(left, rgba(255,255,255,1) 0%,rgba(255,255,255,1) 49%,rgba(53,68,72,1) 49%,rgba(53,68,72,1) 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to right, rgba(255,255,255,1) 0%,rgba(255,255,255,1) 49%,rgba(53,68,72,1) 49%,rgba(53,68,72,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#354448',GradientType=1 ); /* IE6-9 */
  }
  .login-form h1 {
    color: #fff;
    font-weight: 300;
    font-size: 24px;
    text-align: left;
  }
  .login-form h2 {
    color: #333;
    font-weight: 300;
    font-size: 24px;
    text-align: left;
    font-family: 'Open Sans', sans-serif;
    margin-bottom: 20px;
  }
  .login-form h6{
    font-size: 13px;
    color: #fff;
    font-weight: 300;
    line-height: 23px;
    margin-bottom: 20px;
  }
  
    .login-form .text-muted {
    color: #efefef;
    font-size: 13px;
    font-weight: 300;
}
  .reg-button {
    background: #1d272a!important;
border: 1px solid #1d272a!important;
color: #fff;
padding: 10px 10px;
  }
  .parallax-mirror, #parallax-wrap {
    display: none!important;
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
.guest-text p {
  color: #efefef;
  font-size: 13px;
  font-weight: 300;
  text-align: left;
}
.guest-text {
  margin-top: 20px;
  text-align: left;
}
.login-form a {
  color: #666;
}
.guest-text a {
  text-align: left;
  font-size: 16px;
  font-weight: 600;
  color: #fff;
  border-bottom: 1px solid #fff;
  display: inline-block;
}
.guest-text a:hover {
  text-decoration: none;
  color: #f9a700;
  border-bottom: 1px solid #f9a700;
}

</style>
   