<?php 
//error_reporting(E_ALL & ~E_NOTICE);
$accion = $_REQUEST['accion'] ? $_POST['accion'] : '';
                 
$data=new stdClass();


if ($accion == 'process-json') {

     $arrDatos = file_get_contents("http://asiderapido.cloud/biomercados/Productos_Ecomerce.json"); 

     //if (file_exists($arrDatos)) {

          $resultado = str_replace ( '"item":', '', $arrDatos);
          $array = json_decode($resultado);

          $update = array();
          $error_update = array();
          $insert_new_data = array();
          $insert = array();
          $error_insert = array();
          $data_duplicate = array();

          for($i=0;$i<count($array);$i++){

               $merchant_id = $array[$i]->merchant_id;
               $item_name = trim($array[$i]->item_name);
               $item_description = trim($array[$i]->item_description);
               $status = $array[$i]->status;
               $category = $array[$i]->category; 
               $price = $array[$i]->price;        
               $sku = $array[$i]->sku; 
               $item_cant = $array[$i]->item_cant;
               $cant_min = 0; //$array[$i]->cant_min; //  ERROR, ESTA VARIABLE NO VIENE EN EL JSON
               $addon_item = $array[$i]->addon_item;
               $cooking_ref = $array[$i]->cooking_ref;
               $discount = $array[$i]->discount;
               $multi_option = $array[$i]->multi_option;         
               $multi_option_value = $array[$i]->multi_option_value;       
               $photo = $array[$i]->photo;
               $sequence = $array[$i]->sequence;
               $is_featured = $array[$i]->is_featured;
               $date_created = $array[$i]->date_created;
               $date_modified = $array[$i]->date_modified;
               $ip_address = $array[$i]->ip_address;
               $ingredients = $array[$i]->ingredients;
               $spicydish = $array[$i]->spicydish;
               $two_flavors = $array[$i]->two_flavors;
               $two_flavors_position = $array[$i]->two_flavors_position;   
               $require_addon = $array[$i]->require_addon;
               $dish = $array[$i]->dish;
               $item_name_trans = $array[$i]->item_name_trans;
               $item_description_trans = $array[$i]->item_description_trans;
               $non_taxable = $array[$i]->non_taxable;
               $not_available = $array[$i]->not_available;
               $gallery_photo = $array[$i]->gallery_photo;
               $points_earned = $array[$i]->points_earned;
               $points_disabled = $array[$i]->points_disabled;
               $packaging_fee = $array[$i]->packaging_fee;
               $packaging_incremental = $array[$i]->packaging_incremental;
               //$ext_prod_code = $array[$i]->ext_prod_code;


               $cant_min = $item_cant * 0.25;

               if($item_name != '' && $status !='' && $category !='' && $price !='' && $sku !='' && $item_cant !='' && $cant_min !='' ){
                    //// EXTRACCION DEL PRECIO Y LA PRESENTACION DEL JSON Y SE DESCOMPONE EL ARRAY

                    $patron = array('/\{/', '/[a-z]/', '/[1a]/', '/\{/'); 
                    $sustitucion = array(null);
                    $price_preg = preg_replace($patron, $sustitucion, $price); 
                    $price_str = str_replace('}', '',$price_preg);
                    $price_str_2 = (str_replace('"', '',$price_str));
                    $price_explode = explode(':', $price_str_2);
                    $presentacion_producto = $price_explode[0];
                    $precio_producto = $price_explode[1];

                    //// FIN

                         require_once 'import-json-ajax-conexion.php';
                         $sql_select = "SELECT item_id, merchant_id, item_name, item_description, status, category, price, SKU, item_cant, cant_min, addon_item, cooking_ref, discount, multi_option, multi_option_value, photo, sequence, is_featured, date_created, date_modified, ip_address, ingredients, spicydish, two_flavors, two_flavors_position, require_addon, dish, item_name_trans, item_description_trans, non_taxable, not_available, gallery_photo, points_earned, points_disabled, packaging_fee, packaging_incremental, ext_prod_code FROM mt_item WHERE  merchant_id = '7' AND ( item_name = '$item_name' OR item_description LIKE '%$item_description%' )";
                         $result_select = $conn->query($sql_select);
                         
                         if ($result_select->num_rows > 0) {
                            
                              while($row_select = $result_select->fetch_assoc()) {


                                   //// EXTRACCION DEL PRECIO Y LA PRESENTACION DEL JSON Y SE DESCOMPONE EL ARRAY

                                   $price_preg_bd = preg_replace($patron, $sustitucion, $row_select['price']); 
                                   $price_str_bd = str_replace('}', '',$price_preg_bd);
                                   $price_str_bd_2 = (str_replace('"', '',$price_str_bd));
                                   $price_explode_bd = explode(':', $price_str_bd_2);
                                   $presentacion_producto_bd = $price_explode_bd[0];
                                   $precio_producto_bd = $price_explode_bd[1];

                                   //// FIN

                                   $item_id = $row_select['item_id'];

                                   if ($row_select['item_name'] == $item_name && $row_select['item_description'] == $item_description && $presentacion_producto == $presentacion_producto_bd && $precio_producto_bd < $precio_producto) {
                                    //UPDATE
                                   
                                        $sql_update = "UPDATE mt_item SET 
                                        item_description = '$item_description', 
                                        status = '$status', 
                                        category = '$category', 
                                        price = '$price', 
                                        SKU = '$sku', 
                                        item_cant = '$item_cant', 
                                        cant_min = '$cant_min', 
                                        addon_item = '$addon_item', 
                                        cooking_ref = '$cooking_ref', 
                                        discount = '$discount', 
                                        multi_option = '$multi_option', 
                                        multi_option_value = '$multi_option_value', 
                                        photo = '$photo', 
                                        sequence = '$sequence', 
                                        is_featured = '$is_featured', 
                                        /*date_created = '$date_created', */
                                        date_modified = NOW(), 
                                        /*ip_address = '$ip_address', */
                                        ingredients = '$ingredients', 
                                        spicydish = '$spicydish', 
                                        two_flavors = '$two_flavors', 
                                        two_flavors_position = '$two_flavors_position', 
                                        require_addon = '$require_addon', 
                                        dish = '$dish', 
                                        item_name_trans = '$item_name_trans', 
                                        item_description_trans = '$item_description_trans', 
                                        non_taxable = '$non_taxable', 
                                        not_available = '$not_available', 
                                        gallery_photo = '$gallery_photo', 
                                        points_earned = '$points_earned', 
                                        points_disabled = '$points_disabled', 
                                        packaging_fee = '$packaging_fee', 
                                        packaging_incremental = '$packaging_incremental', 
                                        ext_prod_code = null
                                        WHERE item_id = $item_id AND merchant_id = '7'";

                                             if ($conn->query($sql_update) === TRUE) {
          
                                             array_push($update,'<br>Update in BD '.$item_name.' '.$item_description.' '.$precio_producto );
                                             
                                             }else{

                                             array_push($error_update,'<br>Error updating on BD '.$item_name.' '.$item_description.' '.$precio_producto );

                                                  
                                             }
                                   
                                   }else{

                                   array_push($data_duplicate,'<br>Data existing in BD '.$item_name.' '.$item_description.' '.$precio_producto );
          
                                   }

                             }

                         }else{ // INSERT PORQUE NO EXISTE EN LA BD

                              array_push($insert_new_data,'<br>Aggregating new data in BD '.$item_name.' '.$item_description.' '.$precio_producto );
                         
                              $sql_insert = "INSERT INTO mt_item (merchant_id, item_name, item_description, status, category, price, SKU, item_cant, cant_min, addon_item, cooking_ref, discount, multi_option, multi_option_value, photo, sequence, is_featured, date_created, date_modified, ip_address, ingredients, spicydish, two_flavors, two_flavors_position, require_addon, dish, item_name_trans, item_description_trans, non_taxable, not_available, gallery_photo, points_earned, points_disabled, packaging_fee, packaging_incremental, ext_prod_code)
                              VALUES ('7', '$item_name', '$item_description', '$status', '$category', '$price', '$sku', '$item_cant', '$cant_min', '$addon_item', '$cooking_ref', '$discount', '$multi_option', '$multi_option_value', '$photo', '$sequence', '$is_featured', NOW(), '0000-00-00 00:00:00', '$ip_address', '$ingredients', '$spicydish', '$two_flavors', '$two_flavors_position', '$require_addon', '$dish', '$item_name_trans', '$item_description_trans', '$non_taxable', '$not_available', '$gallery_photo', '$points_earned', '$points_disabled', '$packaging_fee', '$packaging_incremental', null)";

                                   if ($conn->query($sql_insert) === TRUE) {
                                   
                                        array_push($insert,'<br>Aggregating data in BD '.$item_name.' '.$item_description.' '.$precio_producto );
                                                                      
                                   }else{

                                        array_push($error_insert,'<br>Error adding data in BD '.$item_name.' '.$item_description.' '.$precio_producto );

                                   }

                         }

               }else{
               
                    $data->result = 'Datos imcompletos para poder recorrer el archivo .json';
                    
               }   // FIN VALIDACION DE DATOS VACIOS

          }  // FIN CICLO FOR I
         
               //$data->alert = $sql_insert;

               $data->result = 1;
               $data->update = count($update);
               $data->error_update = count($error_update);
               $data->insert_new_data = count($insert_new_data);
               $data->insert = count($insert);
               $data->error_insert = count($error_insert);
               $data->data_duplicate = count($data_duplicate);

               

     // }else{

     //      $data->result = 2;

     // }

     echo json_encode($data);

}

?>