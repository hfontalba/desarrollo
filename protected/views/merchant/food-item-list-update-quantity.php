<?php 
     /*********** CODIGO MODIFICADO ***********
     * @Author: Henry J. Fontalba L
     * @Objetive: permitir que un establecimiento que necesite inventario se le sea agregado 
     * el campo cantidad en el stock de inventario permitiendo rellenar ese campo
     * @Date: 02/10/2019
     * @Version: 2.0
     *****************************************/
   
    /*** Consulto en la Base de Datos la Necesidad de un Stock de Inventario ****/

	$mtid=Yii::app()->functions->getMerchantID();
    $verif=Yii::app()->functions->getNeedInventory($mtid);
    $inventory=$verif['need_inventory'];


?>

<div class="uk-width-1">
<a href="<?php echo Yii::app()->request->baseUrl; ?>/merchant/FoodItem/Do/Add" class="uk-button"><i class="fa fa-plus"></i> <?php echo Yii::t("default","Add New")?></a>
<a href="<?php echo Yii::app()->request->baseUrl; ?>/merchant/FoodItem" class="uk-button"><i class="fa fa-list"></i> <?php echo Yii::t("default","List")?></a>
<a href="<?php echo Yii::app()->request->baseUrl; ?>/merchant/FoodItem/Do/Sort" class="uk-button"><i class="fa fa-sort-alpha-asc"></i> <?php echo Yii::t("default","Sort")?></a>
<a href="<?php echo Yii::app()->request->baseUrl; ?>/merchant/FoodItem/Do/ListUpdate" class="uk-button"><i class="fa fa-bar-chart"></i> <?php echo Yii::t("default","Update Price")?></a>
<?php if($inventory > 1): ?>
<a href="<?php echo Yii::app()->request->baseUrl; ?>/merchant/FoodItem/Do/ListUpdateQuantity" class="uk-button"><i class="fa fa-bar-chart"></i> <?php echo Yii::t("default","Update Quantity")?></a>  
<?php endif; ?>
</div>


<div class="spacer"></div>

<div id="error-message-wrapper"></div>

<form class="uk-form uk-form-horizontal forms" id="forms">
<?php echo CHtml::hiddenField('action','FoodItemQuantityUpdate')?>

<h1>TABLA DE ACTUALIZACIÓN DE PRECIOS</h1>

<?php 
$price='';
$category='';

$data='';

$mtid=Yii::app()->functions->getMerchantID();

if (!$data = Yii::app()->functions->getFoodItemLists2($mtid)){
	echo "<div class=\"uk-alert uk-alert-danger\">".
	Yii::t("default","Sorry but we cannot find what your are looking for.")."</div>";
	return ;
}

    

	// $item_name = isset($data['addon_item'])?(array)json_decode($data['addon_item']):false;

	// $addon_item=isset($data['addon_item'])?(array)json_decode($data['addon_item']):false;		
	// $category=isset($data['category'])?(array)json_decode($data['category']):false;
	// $price=isset($data['price'])?(array)json_decode($data['price']):false;	
	// $cooking_ref_selected=isset($data['cooking_ref'])?(array)json_decode($data['cooking_ref']):false;
	// $multi_option_Selected=isset($data['multi_option'])?(array)json_decode($data['multi_option']):false;
	// $multi_option_value_selected=isset($data['multi_option_value'])?(array)json_decode($data['multi_option_value']):false;	
	
	// $ingredients_selected=isset($data['ingredients'])?(array)json_decode($data['ingredients']):false;
	
	// $two_flavors_position=isset($data['two_flavors_position'])?(array)json_decode($data['two_flavors_position']):false;	
	// //dump($two_flavors_position);
	
	// $require_addon=isset($data['require_addon'])?(array)json_decode($data['require_addon']):false;
	
    //var_dump($data);exit;
    
    Yii::app()->functions->data="list";
    $cat_list=Yii::app()->functions->getCategoryList($mtid);
    $size_list=Yii::app()->functions->getSizeList($mtid);
    
?>

<table id="table_list_update" class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
   <thead>
        <tr>
            <th width="20%"><?php echo Yii::t('default',"Name")?></th>
            <th width="20%"><?php echo Yii::t('default',"Description")?></th>
            <th width="10%"><?php echo Yii::t('default',"Categories")?></th>            
            <th width="10%"><?php echo Yii::t('default',"Price")?></th>
            <?php if($inventory > 1):?>
             	<th width="10%"><?php echo Yii::t('default',"Quantity")?></th>
            <?php endif; ?>
            <th width="10%"><?php echo Yii::t('default',"Date")?></th>
           

            <!--<th width="20%"><?php echo Yii::t('default',"price_aux")?></th>-->
        </tr>
    </thead>
    <tbody>

    <?php 
    foreach ($data as $row){
        $name = $row['item_name'];
        $desc = "";
        $categories='';
        // $cant = $row['item_cant'];  	    	
		$category=isset($row['category'])?(array)json_decode($row['category']):false;    	    		
		if ( is_array($category) && count($category)>=1){
			foreach ($category as $valcat) {
				if (array_key_exists($valcat,(array)$cat_list)){
					$categories.=$cat_list[$valcat] .", ";
				}
			}
			$categories=!empty($categories)?substr($categories,0,-2):"";
		}
        $cat = $categories;
        $price_list='';
		$price=isset($row['price'])?(array)json_decode($row['price']):false;
		if ( is_array($price) && count($price)>=1){
			foreach ($price as $key_price=>$val_price) {    	    		
				if (array_key_exists($key_price,(array)$size_list)){
						
					$price_list.=getCurrencyCode().prettyFormat($val_price)." ".ucwords($size_list[$key_price]). "<br/>";
					
				// $price_list .= ' <input type="number" value="'.$val_price.'" min="0" step="0.01" id="price" name="price[]" /><br/>';
				}    	    		
			}
		}

		$cant = '<input type="number" name="item_cant['.$row['item_id'].'][]" id="item_cant" value="'.$row['item_cant'].'" min="0" style="margin-top: 20px"><br/>';

        $date_mod=FormatDateTime($row['date_created']);
        ?>

	  <tr>
	      <td>
                <?php echo $name;?>
	      </td>
	      <td>
                <?php echo $desc; ?>
	      </td>
	      <td>
                <?php echo $cat; ?>
	      </td>
	      <td>
	          <?php echo $price_list; ?>
	      </td>
	      <?php if($inventory > 1):?>
	      	<td>
	          <?php echo $cant; ?>
	      	</td>
	      <?php endif; ?>	
	      <td>
	          <?php echo $date_mod;?>
	      </td>
	  </tr>
	  <?php }?>

    </tbody>
</table>

<div class="spacer"></div>


<div class="uk-form-row">
<label class="uk-form-label"></label>
<button type="submit" id="update_btn" class="uk-button uk-form-width-medium uk-button-success"><i class="fa fa-tasks" aria-hidden="true"></i> Actualizar</button>
</div>

</form>

