<?php FunctionsV3::sectionHeader('¿Cómo desea pagar?')?>

<?php 
/*CHECK IF CHANGE IS REQUIRED*/
$cod_change_required='';
if (FunctionsV3::isMerchantPaymentToUseAdmin($merchant_id)){
	$cod_change_required=getOptionA('cod_change_required');
} else {
	$cod_change_required=getOption($merchant_id,'cod_change_required_merchant');
}
echo CHtml::hiddenField('cod_change_required',$cod_change_required);
?>

<?php 
if (is_array($payment_list) && count($payment_list)>=1):?>
<?php foreach ($payment_list as $key => $val):?>

  <?php   
  /*if ($key=="ip8" || $key=="mol" || $key=="mri"){
  	  continue;
  }*/  
  ?>

  <div class="row top10">
    <div class="col-md-9">
      <div class="dl-padding">
       <?php echo CHtml::radioButton('payment_opt',false,
         array('class'=>"icheck payment_option",'value'=>$key))?> 
         <?php 
         switch ($key) {
         	case "pyr":
         		if ($transaction_type=="pickup"){
         		   echo t("Pay On Pickup");
         	    } else echo $val;         
         		break;
         
         	case "cod":
         		if ($transaction_type=="pickup"){
         		   echo t("Cash On Pickup");
         		} elseif ( $transaction_type=="dinein" ) {
         		   echo t("Pay in person");
         	    } else echo $val;         
         		break;
         		
         	case "pyp":         		
         	    $fee=0;
	         	if (FunctionsV3::isMerchantPaymentToUseAdmin($merchant_id)){	         		
	         		$fee=getOptionA('admin_paypal_fee');
	         	} else {	         		
	         		$fee=getOption($merchant_id,'merchant_paypal_fee');
	         	}	         	
	         	if($fee>0){
	         		echo $val= Yii::t("default","Paypal (card fee [fee])",array(
	         		  '[fee]'=>FunctionsV3::prettyPrice($fee)
	         		));
	         	} else echo $val;
         	    break;
         			
         	default:
         		echo $val; 
         		break;
         }
         ?>
       </div>
     </div> 
  </div>
  
  <?php if ( $key=="cod"):?>
  <?php if ($transaction_type!="dinein"):?>
  <div class="row top10 indent15 change_wrap">
        <p style="font-weight: bold !important; text-align: center !important;line-height: 0;font-size: 24px;margin-bottom: 33px;" >Datos de transferencia</p>
        <p style="font-weight: bold !important; text-align: center !important;line-height: 0;font-size: 16px;" >ASI DE RAPIDO CA</p>
        <p style="font-weight: bold !important; text-align: center !important;line-height: 0;font-size: 16px;" >RIF .J-41090166-7</p>
        <p style="font-weight: bold !important; text-align: center !important;line-height: 0;font-size: 16px;margin-bottom: 66px;" >pagos@asiderapido.com</p>


        <table width="90%" style="margin-top: 33px;margin: 0 auto !important;">
            <tbody>
            <tr>
            <td><a href="https://www.bancaribe.com.ve/" target="_blank"><img src="https://asiderapido.com/assets/bancos/bancaribe.png" width="100px" class="center-imagenes"></a></td>
            <td><p style="text-align: center !important;font-size:16px;" >0114 0220 8822 0027 0005</p></td>
            </tr>
            <tr>
            <td><a href="http://www.bancodevenezuela.com/" target="_blank"><img src="https://asiderapido.com/assets/bancos/bancodevenezuela.jpg" width="100px" class="center-imagenes"></a></td>
            <td><p style="text-align: center !important;font-size:16px;" >0102 0471 2100 0020 2426</p></td>
            </tr>
            <tr>
            <td><a href="https://www.mercantilbanco.com/" target="_blank"><img src="https://asiderapido.com/assets/bancos/mercantil.jpg" width="100px" class="center-imagenes"></a></td>
            <td><p style="text-align: center !important;font-size:16px;" >0105 0120 2011 2028 9440</p></td>
            </tr>
            <tr>
            <td><a href="https://www.100x100banco.com/" target="_blank"><img src="https://asiderapido.com/assets/bancos/100banco.jpg" width="100px" class="center-imagenes"></a></td>
            <td><p style="text-align: center !important;font-size:16px;" >0156 0012 8804 0037 9749</p></td>
            </tr>
            <tr>
            <td><a href="https://www.bfc.com.ve/" target="_blank"><img src="https://asiderapido.com/assets/bancos/bfc.png" width="100px" class="center-imagenes"></a></td>
            <td><p style="text-align: center !important;font-size:16px;" >0151 0076 1610 0113 8225</p></td>
            </tr>
            </tbody>
        </table>
        
        <p style="font-size:14px !important;font-weight: bold;margin-left: 45px;max-width: 550px;">Recuerda que las transferencias se deben hacer por el monto exacto de la compra. Así mismo, se deben realizar transferencias en el mismo banco.</p>

        <p style="font-weight: bold !important;text-align: center !important;background-color: #325196;padding: 20px;margin: 25px -2px -2px -2px;color: white;font-size: 18px;">Paso 2: Reportar transferencia</p>

        <p style="font-size:16px !important;margin-left: 45px;max-width: 550px;">Haznos saber que ya hiciste la transferencia reportando tu pago en nuestra plataforma.</p>

        <a href="http://asiderapido.com/procesador/" target="_blank" style="margin: 0 auto;text-align: center !important;"><p class="boton-reportar">Reportar Pago</p></a>

  </div>
  <?php endif;?>
  <?php endif;?>
  
  <?php if ( $key=="pyr"):?>
  <?php   
  $provider_list=Yii::app()->functions->getPaymentProviderMerchant($merchant_id);
  /*if ( Yii::app()->functions->isMerchantCommission($merchant_id)){	          	
      $provider_list=Yii::app()->functions->getPaymentProviderListActive();         	
  }	*/         
  ?>
  <div class="payment-provider-wrap top10">  
   <?php if (is_array($provider_list) && count($provider_list)>=1):?>
	   <?php foreach ($provider_list as $val_provider_list): ?>
	   <div class="row">	       	       
	        <div class="col-md-3 relative">
	        <div class="checki">
	        <?php echo CHtml::radioButton('payment_provider_name',false,array(
	          'class'=>"icheck checki",
	          'value'=>$val_provider_list['payment_name']
	        ))?>	        
	        </div>
	        <img class="logo-small" src="<?php echo uploadURL()."/".$val_provider_list['payment_logo']?>">
	        </div>
	    </div>     
	   <?php endforeach;?>	   
	<?php else :?>   
	  <p class="uk-text-danger"><?php echo t("no type of payment")?></p>  
	<?php endif;?>  
  </div> <!--payment-provider-wrap-->
  <?php endif;?>
 
<?php endforeach;?>
<?php else:?>
<p class="text-danger"><?php echo t("No payment option available")?></p>
<?php endif;?>



<style type="text/css">

  .boton-reportar {
    background: #325196;
    padding: 10px 25px 10px 25px;
    max-width: 250px;
    text-align: center;
    margin: 0 auto;
    color: white;
    border-radius: 25px;
    border-bottom: 5px solid #2167bb;
    box-shadow: 0 1px 2px 0 rgba(60,64,67,0.302), 0 1px 3px 1px rgba(60,64,67,0.149);
    text-transform: uppercase;
    font-size: 12px;
    letter-spacing: 1px;
    font-weight: bold !important;
    margin-left: 35% !important;
  }

  .boton-reportar:hover {
    text-decoration: none !important;
    background: #299fd1 !important;
    text-decoration-style: inherit;
  }

</style>