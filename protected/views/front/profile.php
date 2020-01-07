
<div  style="margin-top:0;">

<form class="profile-forms forms" id="forms" onsubmit="return false;">
<?php echo CHtml::hiddenField('action','updateClientProfile')?>
<?php echo CHtml::hiddenField('currentController','store')?>
<?php 
$p = new CHtmlPurifier();
FunctionsV3::addCsrfToken();
?>

<?php //FunctionsV3::sectionHeader('Profile');?>
<h5 class="password-head">Información básica</h5>
<div class="row bottom10">
  <div class="col-md-6">
    <p class="text-small"><?php echo t("First Name")?></p>
    <?php 
	  echo CHtml::textField('first_name',$p->purify($data['first_name']),
	  array(
	    'class'=>'grey-fields full-width',
	    'data-validation'=>"required"
	  ));
	  ?>     
  </div>
  <div class="col-md-6">
    <p class="text-small"><?php echo t("Last Name")?></p>
	<?php 
	echo CHtml::textField('last_name', $p->purify($data['last_name']),
	array(
	'class'=>'grey-fields full-width',
	'data-validation'=>"required"
	));
	?>
  </div>
</div> <!--row-->


<div class="row bottom10">
  <div class="col-md-6">
    <p class="text-small"><?php echo t("Email address")?></p>
    <?php 
	  echo CHtml::textField('email', $p->purify($data['email_address']),
	  array(
	    'class'=>'grey-fields full-width',
	    'data-validation'=>"required",
	    'disabled'=>true
	  ));
	  ?>     
  </div>
  <div class="col-md-6">
    <p class="text-small"><?php echo t("Contact phone")?></p>
	 <?php 
  echo CHtml::textField('contact_phone',$p->purify($data['contact_phone']),
  array(
    'class'=>'grey-fields full-width mobile_inputs',
    'data-validation'=>"required"
  ));
  ?>	  
  </div>
</div> <!--row-->

<?php 
$one=Yii::app()->functions->getOptionAdmin('client_custom_field_name1');
$two=Yii::app()->functions->getOptionAdmin('client_custom_field_name2');
?>

<?php if (!empty($one) || !empty($two)):?>
<div class="row bottom10">

  <?php if (!empty($one)):?>
  <div class="col-md-6">
    <p class="text-small"><?php echo t($one)?></p>
     <?php 
  echo CHtml::textField('custom_field1',$p->purify($data['custom_field1']),
  array(
    'class'=>'grey-fields full-width',
    'data-validation'=>"required"
  ));
  ?>
  </div>
  <?php endif;?>
  
  <?php if (!empty($two)):?>
  <div class="col-md-6">
    <p class="text-small"><?php echo t($two)?></p>
	 <?php 
  echo CHtml::textField('custom_field2',$p->purify($data['custom_field2']),
  array(
    'class'=>'grey-fields full-width',
    'data-validation'=>"required"
  ));
  ?>
  </div>
  <?php endif;?>
  
</div> <!--row-->
<?php endif;?>
<br>
<h5 class="password-head">Cambiar contraseña</h5>


<div class="row bottom10">
  <div class="col-md-6">
    <p class="text-small"><?php echo t("Password")?></p>
  <?php 
  echo CHtml::passwordField('password','',
  array(
    'class'=>'grey-fields full-width',
  ));
  ?>
  </div>
  <div class="col-md-6">
    <p class="text-small"><?php echo t("Confirm Password")?></p>
	<?php 
  echo CHtml::passwordField('cpassword','',
  array(
    'class'=>'grey-fields full-width',
  ));
  ?>
  </div>
</div> <!--row-->

<div class="row">  
  <div class="col-md-6">
	<input type="submit" value="<?php echo t("Save")?>" class="green-button medium">  
 </div>	
</div>


</form>
</div> <!--box-->
<style type="text/css">
  .password-head {
    font-size: 17px;
    padding: 10px 0px;
    border-bottom: 1px solid #eee;
    margin-bottom: 20px;
    margin-top: 0px;
  }
</style>