
<!-- <img src="http://findnfounds.com/restaurant/images/booktable.png"> -->

<div class="box-grey rounded" style="margin-top:0;" id="book-table-form">

<form class="forms" id="frm-book" onsubmit="return false;">
<?php echo CHtml::hiddenField('action','bookATable')?>
<?php echo CHtml::hiddenField('currentController','store')?>
<?php echo CHtml::hiddenField('merchant-id',$merchant_id)?>
	     
<div class="section-label">
    <a class="section-label-a">
      <span class="bold" style="background:#fff;">
      Información de la reserva</span>
      <b></b>
    </a>     
</div>  

<div class="row ">
   
   <div class="col-md-4 ">
	 <?php echo CHtml::textField('number_guest',''			 
	  ,array(
	  'class'=>'numeric_only grey-inputs',
	  'required'=>true,
    'placeholder'=> 'Número de comensales'
	  ))?>
   </div>



   
   <div class="col-md-4 ">
	 <?php echo CHtml::hiddenField('date_booking')?>
	  <?php echo CHtml::textField('date_booking1',''			 
	  ,array(
	  'class'=>'date_booking grey-inputs',
	  'required'=>true,
	  'data-id'=>'date_booking',
    'placeholder'=> 'Fecha de reserva'
	  ))?>
   </div>

   
   <div class="col-md-4 ">
	 <?php echo CHtml::textField('booking_time',''			 
	  ,array(
	  'class'=>'grey-inputs',
	  'required'=>true,
    'placeholder'=> 'Hora (07:00 PM)'
	  ))?>
   </div>
</div> <!--row-->

<div class="section-label">
    <a class="section-label-a">
      <span class="bold" style="background:#fff;">
     Información de contacto</span>
      <b></b>
    </a>     
</div>  

<?php 
$booking_name=''; $email=''; $mobile='';
if ( Yii::app()->functions->isClientLogin()){
	$booking_name=Yii::app()->functions->getClientName() ." ".$_SESSION['kr_client']['last_name'];
	$email=$_SESSION['kr_client']['email_address'];
	$mobile=$_SESSION['kr_client']['contact_phone'];
}
?>

<div class="row top10">
   
   <div class="col-md-4 ">
	  <?php echo CHtml::textField('booking_name',$booking_name			 
	  ,array(
	  'class'=>'grey-inputs',
	  'required'=>true,
    'placeholder'=> 'Tu nombre'
	  ))?>
   </div>

   
   <div class="col-md-4 ">
	  <?php echo CHtml::textField('email',$email			 
	  ,array(
	  'class'=>'grey-inputs',
	  'required'=>true,
    'placeholder'=> 'Tu correo'
	  ))?>
   </div>

   
   <div class="col-md-4 ">
	  <?php echo CHtml::textField('mobile',$mobile
	  ,array(
	  'class'=>'grey-inputs',
	  'required'=>true,
    'placeholder'=> 'Tu número de teléfono'
	  ))?>
   </div>
</div> <!--row-->

<div class="row top10">
   
   <div class="col-md-12 ">
	  <?php echo CHtml::textArea('booking_notes',''			 
	  ,array(
	  'class'=>'grey-inputs',
    'placeholder'=> 'Notas de la reserva'		 
	  ))?>
   </div>
</div> <!--row-->

<div class="row top10">  
  
  <div class="col-md-12 " style="margin: 0 auto;">
  <input type="submit" value="Reservar una mesa" class="rounded book-table-button green-button inline">
  </div>
</div><!-- row-->

</form>

</div> <!--end box-->