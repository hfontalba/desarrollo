<?php 
     /*********** CODIGO CREADO POR ***********
     * @Author: Gabriel López
     * @Objetive: permitir que un establecimiento pueda importar productos
     * a través de un archivo CSV
     * @Date: 17/12/2019
     * @Version: 2.0
     * @Archivos Modificados:
     *	- food-item-list.php -> Se agregó el boton "Importar archivo CSV" a la lista de opciones
     *	- MerchantController.php -> actionFoodItem()
     *	- food-item-importar-csv.php -> Se creó la vista
     * NOTAS:
     *	- El archivo csv contendrá los 6 valores obligatoriamente (algunos pueden venir vacios, pero no nulos)
     *	- Los campos item_name y price son obligatorios
     *	- Si no es proporcionado el campo sku, entonces debe ser proporcionado el campo item_description
     *****************************************/

	$merchant_id = Yii::app()->functions->getMerchantID();
    $verif = Yii::app()->functions->getNeedInventory($merchant_id);
    $inventory = $verif['need_inventory'];
?>

<!-- Agregando lista de opciones -->
<div class="uk-width-1">
<a href="<?php echo Yii::app()->request->baseUrl; ?>/merchant/FoodItem" class="uk-button"><i class="fa fa-list"></i> <?php echo Yii::t("default","List")?></a>
</div>

<div class="spacer"></div>
<div id="error-message-wrapper"></div>

<div class="csv-processing-wrap">
<?php
$db_ext = new DbExt;
$mensaje = '';

if (isset($_POST) && $_SERVER['REQUEST_METHOD']=='POST') {		
	$filename = $_FILES['file']['name'];

	if (preg_match("/.csv/i", $filename)) { // Se verifica que el archivo sea un CSV

		ini_set('auto_detect_line_endings',TRUE);
		$handle = fopen($_FILES['file']['tmp_name'], "r");
		$num_linea = 1;

		while (($data_tmp = fgetcsv($handle, ";")) !== FALSE) {

			$data = explode(";", $data_tmp[0]); # Separando la data en un arreglo
			/*
			FORMATO:
				$data[0] => item_name
				$data[1] => item_description
				$data[2] => category
				$data[3] => price
				$data[4] => sku
				$data[5] => item_cant
				$data[6] => valor basura (vacio)
			*/

			# Consultando y formateando las categorias del producto
			# Si la categoria no esta vacia
			if ( !empty($data[2]) ) {
	            # Consultando el id de la categoria mediante merchant_id y category_name
	            $qryCategoria = "SELECT cat_id FROM {{category}}
    	           	WHERE merchant_id = '$merchant_id' AND category_name LIKE('%$data[2]%')";
	            $categoria = $db_ext->rst($qryCategoria);
	            $data[2] = (string) $categoria[0]["cat_id"];
			} else {
				$data[2] = NULL;
			}

			# Consultando y formateando el precio del producto
			# Si el precio no esta vacio
			if ( !empty($data[3]) ) {
	            # Consultando id de la presentacion por defecto mediante merchant_id y size_name
	            $qryPresentacion = "SELECT size_id FROM {{size}}
    	           	WHERE merchant_id = '$merchant_id' AND size_name LIKE('%medium%')";
	            $presentacion = $db_ext->rst($qryPresentacion);
	            $data[3] = '{"' . (string) $presentacion[0]["size_id"] . '":"' . $data[3] . '"}';
			}

			# Verificando que se pueda procesar la  línea
			if (!(empty($data[0]) && empty($data[1]) && empty($data[2]) && empty($data[3]) && empty($data[4]) && empty($data[5]))) {
				echo "<p class=\"non-indent uk-text-primary\">".t("Procesando línea")." ($num_linea)<br/></p>";
			}

			# Si pasaron la cantidad correcta de parametros en el CSV y el precio no esta vacio 
		    if ( (count($data) >= 6) && (!empty($data[3])) ){

		    	# Consultando el item_id de la tabla "mt_item", para saber si existe el producto
		    	$item_id = "";
		    	if (!empty($data[4])) {
	                # Consultando el item_id mediante merchant_id y sku
	                $qry = "SELECT item_id FROM {{item}}
    	            	WHERE merchant_id = '$merchant_id' AND sku = '$data[4]'";
	                $item_id = $db_ext->rst($qry);
		    	} else {
	                # Consultando el item_id mediante merchant_id, item_name e item_desciption
	                $qry = "SELECT item_id FROM {{item}}
	                	WHERE merchant_id = '$merchant_id' AND item_name = '$data[0]' AND item_description = '$data[1]'";
	                $item_id = $db_ext->rst($qry);
		    	}

		    	echo "<p class=\"indent uk-text-primary\">".t("Importando producto...")."...</p>";

		    	# Si existe el producto, se actualiza #####################################################
		    	if (!empty($item_id)) {
			    	# Transformando a entero el item_id obtenido de la base de datos
			    	$item_id = (int) $item_id[0]["item_id"];

			    	$params = array(
			    		'price' => $data[3],
			    		'item_cant' => (int) $data[5],
			    		'cant_min' => (int) ($data[5] * 0.25),
			    		'date_modified' => FunctionsV3::dateNow()
			    	);

					if ( $db_ext->updateData('{{item}}', $params ,'item_id', $item_id) ){
		    			echo "<p class=\"indent uk-text-primary\">" . t("Actualización exitosa") . "...</p>";
					} else {
 		    			echo "<p class=\"indent uk-text-danger\">" . t("ERROR: no se pudo actualizar") . "...</p>";
					}

				# Si no existe el producto, se inserta ####################################################
		    	} else {

			    	$params = array(
						'merchant_id' => (int) $merchant_id,
						'item_name' => $data[0],
						'item_description' => $data[1],
						'status' => 'publish',
						'category' => $data[2],
						'price' => $data[3],
						'sku' =>  (int) $data[4],
						'item_cant' =>  (int) $data[5],
						'cant_min' =>  (int) ($data[5] * 0.25),
						'addon_item' => null,
						'cooking_ref' => null,
						'discount' => '',
						'multi_option' => null,
						'multi_option_value' => null,
						'photo' => '',
						'sequence' => 0,
						'is_featured' => '',
						'date_created' => FunctionsV3::dateNow(),
						'date_modified' => '0000-00-00 00:00:00',
						'ip_address' => '', #$_SERVER['REMOTE_ADDR'],
						'ingredients' => null,
						'spicydish' => 1,
						'two_flavors' => (int) '',
						'two_flavors_position' => null,
						'require_addon' => null,
						'dish' => null,
						'item_name_trans' => null,
						'item_description_trans' => null,
						'non_taxable' => 1,
						'not_available' => 1,
						'gallery_photo' => null,
						'points_earned' => 0,
						'points_disabled' => 1,
						'packaging_fee' => 0.0000,
						'packaging_incremental' => 0,
						'ext_prod_code' => null
			    	);

		    		if ( $db_ext->insertData("{{item}}", $params) ) {		    	
		    			echo "<p class=\"indent uk-text-primary\">" . t("Inserción exitosa") . "...</p>";
		    	    } else {
 		    			echo "<p class=\"indent uk-text-danger\">" . t("Inserción fallida") . "...</p>";
		    	    }
		    	}

		    } else {
		    	# Si se insertaron datos incorrectos
				if (!(empty($data[0]) && empty($data[1]) && empty($data[2]) && empty($data[3]) && empty($data[4]) && empty($data[5]))) {
			    	echo "<p class=\"indent uk-text-danger\">" . t("Error en la línea" . " " . $num_linea) . " <br/></p>";
				}
		    }

		    $num_linea++; # Pasando a la siguiente línea
		}
 
	 	ini_set('auto_detect_line_endings',FALSE);
		fclose($_FILES['file']['tmp_name']);

	} else $mensaje = t("Please upload a valid CSV file");
}
?>
</div>

<form class="uk-form uk-form-horizontal" method="post" enctype="multipart/form-data"  >
	<?php if (!empty($mensaje)): ?>
		<p class="uk-alert uk-alert-danger"><?php echo $mensaje;?></p>
	<?php endif; ?>

	<div class="uk-form-row">
		<label class="uk-form-label"><?php echo Yii::t("default","CSV")?></label>
		<input type="file" name="file" id="file" />
	</div>

	<div class="uk-form-row">
		<label class="uk-form-label"></label>
		<input type="submit" value="<?php echo Yii::t("default","Submit")?>" class="uk-button uk-form-width-medium uk-button-success">
	</div>
</form>
