<?php 


include_once 'rpt-merchant-sales-conexion.php';

$accion = $_REQUEST['accion'];


	if ($accion == 'select_pago') {
		
	$data=new stdClass();

		$query = $pdo->prepare("SELECT * FROM mt_banks");
		$query->execute();
			$option="<option value>Elegir</option>";
				for($i=0; $row = $query->fetch(); $i++){
					$option.="<option value=".$row['id_bank'].">".$row['bank_name']."</option>";
				}

		$data->select = $option;
		$data->result = 1;

		echo json_encode($data);


      }

    if ($accion == 'save_ref_pag') {
    	
    	

	    	$ref_d_ped = $_POST['ref_d_ped'];   // referencia de Orden
	    	$ref = $_POST['ref'];			    // referencia de pago
	    	$banc = $_POST['banc'];			    // banco del pago (nacional o internacional)
	    	$tip_pag = $_POST['tip_pag'];	    // tipo de pago


		$stmt = $pdo->prepare("INSERT INTO mt_payment_order (payment_type, payment_reference, payment_provider, order_id, date_created) VALUES (:payment_type, :payment_reference, :payment_provider, :order_id, NOW())");

			$data=new stdClass();

			if($stmt->execute(array(':payment_type'  => $tip_pag, ':payment_reference'   => $ref, ':payment_provider' =>$banc, ':order_id' => $ref_d_ped))) {
		 		$data->result= 1; // Insert success
			}else{
				$data->result= 2; // Insert error
			}
			echo json_encode($data);
	}
    




	//	unset($pdo);
	//	unset($query);


?>

