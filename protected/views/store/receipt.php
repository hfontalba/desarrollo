<?php
unset($_SESSION['pts_earn']);
unset($_SESSION['pts_redeem_amt']);

$this->renderPartial('/front/banner-receipt',array(
   'h1'=>t("Thank You"),
   'sub_text'=>t("Your order has been placed.")
));

$ok=false;
//$data='';
//if ( $data=Yii::app()->functions->getOrder2($_GET['id'])){				
if (is_array($data) && count($data)>=1){
	$merchant_id=$data['merchant_id'];
	$json_details=!empty($data['json_details'])?json_decode($data['json_details'],true):false;
	if ( $json_details !=false){
		Yii::app()->functions->displayOrderHTML(array(
		  'merchant_id'=>$data['merchant_id'],
		  'delivery_type'=>$data['trans_type'],
		  'delivery_charge'=>$data['delivery_charge'],
		  'packaging'=>$data['packaging'],
		  'cart_tip_value'=>$data['cart_tip_value'],
		  'cart_tip_percentage'=>$data['cart_tip_percentage']/100,
		  'card_fee'=>$data['card_fee'],
		  'tax'=>$data['tax'],
		  'points_discount'=>isset($data['points_discount'])?$data['points_discount']:'' /*POINTS PROGRAM*/,
		  'voucher_amount'=>$data['voucher_amount'],
		  'voucher_type'=>$data['voucher_type']
		  ),$json_details,true);
		if ( Yii::app()->functions->code==1){
			$ok=true;
		}
		
		/*ITEM TAXABLE*/
		$mtid = $merchant_id;
		$apply_tax = $data['apply_food_tax'];
	    $tax_set = $data['tax'];	         	 
		if ( $apply_tax==1 && $tax_set>0){							    
		    Yii::app()->functions->details['html']=Yii::app()->controller->renderPartial('/front/cart-with-tax',array(
    		   'data'=>Yii::app()->functions->details['raw'],
    		   'tax'=>$tax_set,
    		   'receipt'=>true,    		
    		   'merchant_id'=>$mtid   
    		),true);
		}
		
		/*dump(Yii::app()->functions->details['raw']);
		die();*/
	}	
}
unset($_SESSION['kr_item']);
unset($_SESSION['kr_merchant_id']);
unset($_SESSION['voucher_code']);
unset($_SESSION['less_voucher']);
unset($_SESSION['shipping_fee']);

$print='';

$order_ok=true;

$merchant_info=Yii::app()->functions->getMerchant(isset($merchant_id)?$merchant_id:'');
$full_merchant_address=$merchant_info['street']." ".$merchant_info['city']. " ".$merchant_info['state'].
" ".$merchant_info['post_code'];

$transaction_type=$data['trans_type'];
?>

<style type="text/css">
@import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,700');
	#parallax-wrap {
		display: none;
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
.section-receipt .inner h1, .section-orangeform .inner h1 {
	background: #325193;
	color: #fff;
	font-family: 'Open Sans', sans-serif;
	font-size: 20px;
	font-weight: 300;
	margin: 0;
	padding: 20px 20px;
}
#receipt-content table tr {
	background: #fff;
}
#receipt-content table td {
	padding: 20px 10px;
	line-height: 28px;
	text-align: left;
}
#receipt-content table td:first-child {
	padding-right: 30px;
}
.order-list-wrap b {
	display: none;
}
.order-list-wrap p.uk-text-small {
    text-align: left;
    font-style: normal;
    margin: 0;
    padding: 5px 0px 5px 0px;
    font-size: 11px;
    color: #999;
}
.cart_total_wrap {
	font-size: 20px!important;
}
.order-list-wrap p.uk-text-small {
    text-align: left;
    font-style: normal;
    font-size: 11px;
    color: #999;
}
.item-order-list {
    padding-bottom: 10px;
    padding-top: 15px;
    border-bottom: 1px solid #E4E7EA;
}
.section-receipt .inner, .section-mobile-verification .inner, .section-orangeform .inner {
	max-width: 700px;
	margin-top: 75px;
}
.section-grey2 {
    background: #fff;
}
.box-grey {
    background: #FFFFFF;
    border: 1px solid #e1e1e1;
    }
</style>

<div class="sections section-grey2 section-receipt">
   <div class="container">
      
   <?php if ($ok==TRUE):?>
   <div class="inner" id="receipt-content">
	   <h1>Detalles de tu orden</h1>
	   <div class="box-grey">     
	   
	   <div class="text-center bottom10">
	   <i class="ion-ios-checkmark-outline i-big-extra green-text"></i>
	   </div>
	   	   
	   <table class="table table-striped">
	    <tbody>	     
	       
	       <tr>
	         <td><?php echo Yii::t("default","Nombre del comprador")?></td>
	         <td class="text-right"><?php echo $data['full_name']?></td>
	       </tr>	       
	       <?php $print[]=array( 'label'=>Yii::t("default","Customer Name"), 'value'=>$data['full_name'] );?>	       
	       <tr>
	         <td><?php echo Yii::t("default","Establecimiento")?></td>
	         <td class="text-right"><?php echo clearString($data['merchant_name'])?></td>
	       </tr>       
	       <?php $print[]=array( 'label'=>Yii::t("default","Establecimiento"), 'value'=>$data['merchant_name']); ?>
	       
	       <?php if (isset($data['abn']) && !empty($data['abn'])):?>	       
	       <tr>
	         <td><?php echo Yii::t("default","ABN")?></td>
	         <td class="text-right"><?php echo $data['abn']?></td>
	       </tr> 
	       <?php 	       
	       $print[]=array(
	         'label'=>Yii::t("default","ABN"),
	         'value'=>$data['abn']
	       );
	       ?>
	       <?php endif;?>
	       
	       <tr>
	         <td><?php echo Yii::t("default","Teléfono")?></td>
	         <td class="text-right"><?php echo $data['merchant_contact_phone']?></td>
	       </tr>	       
	       <?php 	       
	       $print[]=array(
	         'label'=>Yii::t("default","Telephone"),
	         'value'=>$data['merchant_contact_phone']
	       );
	       ?>
		   		   
	       <tr>
	         <td><?php echo Yii::t("default","Dirección")?></td>
	         <td class="text-right"><?php echo $full_merchant_address?></td>
	       </tr>    
	       <?php 	       
	       $print[]=array(
	         'label'=>Yii::t("default","Dirección"),
	         'value'=>$full_merchant_address
	       );
	       ?>
	       
	       <?php $merchant_tax_number=getOption($merchant_id,'merchant_tax_number');?>
	       <?php if (!empty($merchant_tax_number)):?>
		       <tr>
		         <td><?php echo Yii::t("default","Tax number")?></td>
		         <td class="text-right"><?php echo $merchant_tax_number?></td>
		       </tr>    
		       <?php 	       
		       $print[]=array(
		         'label'=>Yii::t("default","Tax number"),
		         'value'=>$merchant_tax_number
		       );
		       ?>
	       <?php endif;?>
	       	       
	       <tr>
	         <td><?php echo Yii::t("default","Tipo de transacción")?></td>
	         <td class="text-right"><?php echo Yii::t("default",$data['trans_type'])?></td>
	       </tr>
	       
	       <?php 	       
	       $print[]=array(
	         'label'=>Yii::t("default","TRN Type"),
	         'value'=>t($data['trans_type'])
	       );
	       ?>
	       	       
	       <tr>
	         <td><?php echo Yii::t("default","Forma de pago")?></td>
	         <!--<td class="text-right"><?php echo strtoupper(t($data['payment_type']))?></td>-->
	         <td class="text-right">
	         <?php echo FunctionsV3::prettyPaymentType('payment_order',
	         $data['payment_type'],$_GET['id'],$data['trans_type'])?>
	         </td>
	       </tr>
	       <?php 	       
	       $print[]=array(
	         'label'=>Yii::t("default","Forma de pago"),
	         'value'=>FunctionsV3::prettyPaymentType('payment_order',$data['payment_type'],$_GET['id'],$data['trans_type'])
	       );	       
	       ?>
	       	       
	       <?php if ( $data['payment_provider_name']):?>	      
	       <tr>
	         <td><?php echo Yii::t("default","Card#")?></td>
	         <td class="text-right"><?php echo $data['payment_provider_name']?></td>
	       </tr>
	       <?php 	       
	       $print[]=array(
	         'label'=>Yii::t("default","Card#"),
	         'value'=>strtoupper($data['payment_provider_name'])
	       );
	       ?>
	       <?php endif;?>	       	       
	       	       
	       <?php if ( $data['payment_type'] =="pyp"):?>
	       <?php 
	       $paypal_info=Yii::app()->functions->getPaypalOrderPayment($data['order_id']);	       
	       ?>	       
	       <tr>
	         <td><?php echo Yii::t("default","Paypal Transaction ID")?></td>
	         <td class="text-right"><?php echo isset($paypal_info['TRANSACTIONID'])?$paypal_info['TRANSACTIONID']:'';?></td>
	       </tr>
	       <?php 	       
	       $print[]=array(
	         'label'=>Yii::t("default","Paypal Transaction ID"),
	         'value'=>isset($paypal_info['TRANSACTIONID'])?$paypal_info['TRANSACTIONID']:''
	       );
	       ?>
	       <?php endif;?>
	       	       
	       <tr>
	         <td><?php echo Yii::t("default","Reference #")?></td>
	         <td class="text-right"><?php echo Yii::app()->functions->formatOrderNumber($data['order_id'])?></td>
	       </tr>
	       <?php 	       
	       $print[]=array(
	         'label'=>Yii::t("default","No. de referencia"),
	         'value'=>Yii::app()->functions->formatOrderNumber($data['order_id'])
	       );
	       ?>
	       
	       <?php if ( !empty($data['payment_reference'])):?>	      
	       <tr>
	         <td><?php echo Yii::t("default","Payment Ref")?></td>
	         <td class="text-right"><?php echo $data['payment_reference']?></td>
	       </tr>
	       <?php
	       $print[]=array(
	         'label'=>Yii::t("default","Payment Ref"),
	         'value'=>Yii::app()->functions->formatOrderNumber($data['order_id'])
	       );
	       ?>
	       <?php endif;?>
	       	       
	       <?php if ( $data['payment_type']=="ccr" || $data['payment_type']=="ocr"):?>	       
	       <tr>
	         <td><?php echo Yii::t("default","Card #")?></td>
	         <td class="text-right"><?php echo $card=Yii::app()->functions->maskCardnumber($data['credit_card_number'])?></td>
	       </tr>
	       <?php 	       
	       $print[]=array(
	         'label'=>Yii::t("default","Card #"),
	         'value'=>$card
	       );
	       ?>
	       <?php endif;?>
	       	       
	       <tr>
	         <td><?php echo Yii::t("default","Fecha de transacción")?></td>
	         <td class="text-right">
	         <?php 
	         $trn_date=date('M d,Y G:i:s',strtotime($data['date_created']));
	         echo Yii::app()->functions->translateDate($trn_date);
	         ?>
	         </td>
	       </tr>
	       <?php 	       
	       $print[]=array(
	         'label'=>Yii::t("default","TRN Date"),
	         'value'=>$trn_date
	       );
	       ?>
	       
	       <?php if ($data['trans_type']=="delivery"):?>
		       	       
		       <?php if (isset($_SESSION['kr_delivery_options']['delivery_date'])):?>		       
		       <tr>
		         <td><?php echo Yii::t("default","Fecha de entrega")?></td>
		         <td class="text-right">
		         <?php 
		         $deliver_date=prettyDate($_SESSION['kr_delivery_options']['delivery_date']);
		         echo Yii::app()->functions->translateDate($deliver_date);
		         ?>
		         </td>
		       </tr>
		       <?php 	       
		       $print[]=array(
		         'label'=>Yii::t("default","Delivery Date"),
		         'value'=>$deliver_date
		       );
		       ?>
		       <?php endif;?>
		       
		       <?php if (isset($_SESSION['kr_delivery_options']['delivery_time'])):?>
		       <?php if ( !empty($_SESSION['kr_delivery_options']['delivery_time'])):?>		       
		       <tr>
		         <td><?php echo Yii::t("default","Hora de entrega")?></td>
		         <td class="text-right"><?php echo Yii::app()->functions->timeFormat($_SESSION['kr_delivery_options']['delivery_time'],true)?></td>
		       </tr>
		       <?php 	       
		       $print[]=array(
		         'label'=>Yii::t("default","Hora de entrega"),
		         'value'=>Yii::app()->functions->timeFormat($_SESSION['kr_delivery_options']['delivery_time'],true)
		       );
		       ?>
		       <?php endif;?>
		       <?php endif;?>
		       
		       <?php if (isset($_SESSION['kr_delivery_options']['delivery_asap'])):?>
		       <?php if ( !empty($_SESSION['kr_delivery_options']['delivery_asap'])):?>		       
		       <tr>
		         <td><?php echo Yii::t("default","Entrega en 1 hora aprox.")?></td>
		         <td class="text-right">
		         <?php echo $delivery_asap=$_SESSION['kr_delivery_options']['delivery_asap']==1?t("Yes"):'';?>
		         </td>
		       </tr>
			   <?php 	       
				$print[]=array(
				 'label'=>Yii::t("default","Entrega en 1 hora aprox."),
				 'value'=>$delivery_asap
				);
				?>
		       <?php endif;?>
		       <?php endif;?>
		       		       
		       <tr>
		         <td><?php echo Yii::t("default","Entregar a")?></td>
		         <td class="text-right">
		         <?php 		         
		         if (!empty($data['client_full_address'])){		         	
		         	echo $delivery_address=$data['client_full_address'];
		         } else echo $delivery_address=$data['full_address'];		         
		         ?>
		         </td>
		       </tr>
				<?php 	       
				$print[]=array(
				  'label'=>Yii::t("default","Entregar a"),
				  'value'=>$delivery_address
				);
				?>
						       		      
		       <tr>
		         <td><?php echo Yii::t("default","Instrucciones de entrega")?></td>
		         <td class="text-right"><?php echo $data['delivery_instruction']?></td>
		       </tr>
		       <?php 	       
				$print[]=array(
				  'label'=>Yii::t("default","Instrucciones de entrega"),
				  'value'=>$data['delivery_instruction']
				);
				?>
		       		       
		       <tr>
		         <td><?php echo Yii::t("default","Nombre de dirección")?></td>
		         <td class="text-right">
		         <?php 
		         if (!empty($data['location_name1'])){
		         	$data['location_name']=$data['location_name1'];
		         }
		         echo $data['location_name'];
		         ?>
		         </td>
		       </tr>
		       <?php 	       
				$print[]=array(
				  'label'=>Yii::t("default","Nombre de dirección"),
				  'value'=>$data['location_name']
				);
				?>
								
		       <tr>
		         <td><?php echo Yii::t("default","Númmero de contacto")?></td>
		         <td class="text-right">
		         <?php 
		         if ( !empty($data['contact_phone1'])){
		         	$data['contact_phone']=$data['contact_phone1'];
		         }
		         echo $data['contact_phone'];?>
		         </td>
		       </tr>       
		       <?php 	       
				$print[]=array(
				  'label'=>Yii::t("default","Númmero de contacto"),
				  'value'=>$data['contact_phone']
				);
				?>
				
				<?php if ($data['order_change']>=0.1):?>					
		       <tr>
		         <td><?php echo Yii::t("default","Cambio")?></td>
		         <td class="text-right">
		         <?php echo displayPrice( baseCurrency(), normalPrettyPrice($data['order_change']))?>
		         </td>
		       </tr>     
		       <?php 	       
				$print[]=array(
				  'label'=>Yii::t("default","Cambio"),
				  'value'=>normalPrettyPrice($data['order_change'])
				);
				?>
				<?php endif;?>
				
								
		   <?php else :?>   
		   
		      <?php 
		      $label_date=t("Fecha de recogida");
		      $label_time=t("Hora de recogida");
		      if ($transaction_type=="dinein"){
		      	  $label_date=t("Dine in Date");
		          $label_time=t("Dine in Time");
		      }
		      ?>
		   		   		  
               <?php 
				if (isset($data['contact_phone1'])){
					if (!empty($data['contact_phone1'])){
						$data['contact_phone']=$data['contact_phone1'];
					}
				}
			   ?>		      
		       <tr>
		         <td><?php echo Yii::t("default","Número de contacto")?></td>
		         <td class="text-right"><?php echo $data['contact_phone']?></td>
		       </tr>
		       <?php 	       
				$print[]=array(
				  'label'=>Yii::t("default","Número de contacto"),
				  'value'=>$data['contact_phone']
				);
				?>
		       		     		  
		      <?php if (isset($_SESSION['kr_delivery_options']['delivery_date'])):?>		       
		       <tr>
		         <td><?php echo $label_date?></td>
		         <td class="text-right">
		         <?php echo $_SESSION['kr_delivery_options']['delivery_date']?>
		         </td>
		       </tr>
		       <?php 	       
				$print[]=array(
				  'label'=>$label_date,
				  'value'=>$_SESSION['kr_delivery_options']['delivery_date']
				);
				?>
		       <?php endif;?>
		       
		       <?php if (isset($_SESSION['kr_delivery_options']['delivery_time'])):?>
		       <?php if ( !empty($_SESSION['kr_delivery_options']['delivery_time'])):?>		       
		       <tr>
		         <td><?php echo $label_time?></td>
		         <td class="text-right">
		         <?php echo Yii::app()->functions->timeFormat($_SESSION['kr_delivery_options']['delivery_time'],true)?>
		         </td>
		       </tr>
		       <?php 	       
				$print[]=array(
				 'label'=>$label_time,
				 'value'=>Yii::app()->functions->timeFormat($_SESSION['kr_delivery_options']['delivery_time'],true)
				);
				?>
		       <?php endif;?>
		       <?php endif;?>
		       
		       <?php if ($data['order_change']>=0.1):?>					
		       <tr>
		         <td><?php echo Yii::t("default","Cambio")?></td>
		         <td class="text-right">
		         <?php echo displayPrice( baseCurrency(), normalPrettyPrice($data['order_change']))?>
		         </td>
		       </tr>  
		        <?php 	       
				$print[]=array(
				  'label'=>Yii::t("default","Cambio"),
				  'value'=>$data['order_change']
				);
				?>
				<?php endif;?> 
				
			   <?php if ($transaction_type=="dinein"):?>
			    <tr>
		         <td><?php echo t("Number of guest")?></td>
		         <td class="text-right">
		         <?php echo $data['dinein_number_of_guest']?>
		         </td>
		       </tr>  
		       <tr>
		         <td><?php echo t("Special instructions")?></td>
		         <td class="text-right">
		         <?php echo stripslashes($data['dinein_special_instruction'])?>
		         </td>
		       </tr>  
		       <?php 	       
				$print[]=array(
				  'label'=>t("Number of guest"),
				  'value'=>$data['dinein_number_of_guest']
				);
				$print[]=array(
				  'label'=>t("Special instructions"),
				  'value'=>$data['dinein_special_instruction']
				);
				?>
			   <?php endif;?>
		       
	       
	       <?php endif;?>
	       
	       <tr>
			 <td colspan="2"></td>
		   </tr>
	       	    
	    </tbody>
	   </table>
	   
	    <div class="receipt-wrap order-list-wrap">
	    <?php echo $item_details=Yii::app()->functions->details['html'];?>
	    </div>
	   
	   </div> <!--box-grey-->
	   
   </div> <!--inner-->
   
   <div class="row">
      <div class="col-sm-12 text-right">
        <a href="javascript:;" class="print-receipt"><i class="ion-ios-printer-outline"></i></a>
      </div> <!--col-->
   </div> <!--row-->
    
   <?php else :?>
    <p class="text-warning"><?php echo t("Lo sentimos pero no podemos encontrar lo que estás buscando.")?></p>
    <?php $order_ok=false;?>
   <?php endif;?>
    
   </div> <!--container-->
</div>  <!--section-receipt-->

<script type="text/javascript">
	window.document.title = 'Así de Rápido - Recibo de la compra';
</script>

<?php     
$data_raw=Yii::app()->functions->details['raw'];
if ( $apply_tax==1 && $tax_set>0){	
	$receipt=EmailTPL::salesReceiptTax($print,Yii::app()->functions->details['raw']);
} else $receipt=EmailTPL::salesReceipt($print,Yii::app()->functions->details['raw']);

$to=isset($data['email_address'])?$data['email_address']:'';

if (!isset($_SESSION['kr_receipt'])){
	$_SESSION['kr_receipt']='';
}

/*dump($receipt);
dump(Yii::app()->functions->additional_details);*/

if (!in_array($data['order_id'],(array)$_SESSION['kr_receipt'])){
	if ($order_ok==true){		
		/*SEND EMAIL TO CUSTOMER*/
		FunctionsV3::notifyCustomer($data,Yii::app()->functions->additional_details,$receipt, $to);
		FunctionsV3::notifyMerchant($data,Yii::app()->functions->additional_details,$receipt);
		FunctionsV3::notifyAdmin($data,Yii::app()->functions->additional_details,$receipt);
	
	   FunctionsV3::fastRequest(FunctionsV3::getHostURL().Yii::app()->createUrl("cron/processemail"));
	   FunctionsV3::fastRequest(FunctionsV3::getHostURL().Yii::app()->createUrl("cron/processsms"));
	   
	   // SEND FAX
       Yii::app()->functions->sendFax($merchant_id,$_GET['id']);
	}
}

$_SESSION['kr_receipt']=array($data['order_id']);




