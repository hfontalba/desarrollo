<?php 
     /*********** CODIGO MODIFICADO ***********
     * @Author: Gabriel López
     * @Objetive: Permitir que un establecimiento pueda importar productos
     * a través de un archivo CSV
     * @Date: 16/12/2019
     * @Version: 2.0
     * @Archivos Modificados:
     *	- food-item-list.php -> Se agregó el boton "Importar archivo CSV" a la lista de opciones
     *	- MerchantController.php -> actionFoodItem()
     *	- food-item-importar-csv.php -> Se creó la vista
     *****************************************/

     /*********** CODIGO MODIFICADO ***********
     * @Author: Henry J. Fontalba L
     * @Objetive: permitir que un establecimiento que necesite inventario se le sea agregado 
     * el campo cantidad en el stock de inventario permitiendo rellenar ese campo
     * @Date: 02/10/2019
     * @Version: 2.0
     *****************************************/
   
    /*** Consulto en la Base de Datos la Necesidad de un Stock de Inventario ****/

     $mid= Yii::app()->functions->getMerchantID();
     $invent= Yii::app()->functions->getNeedInventory($mid);
     $verif=$invent['need_inventory'];


?>

<!-- Lista de opciones -->
<div class="uk-width-1">
<a href="<?php echo Yii::app()->request->baseUrl; ?>/merchant/FoodItem/Do/Add" class="uk-button"><i class="fa fa-plus"></i> <?php echo Yii::t("default","Add New")?></a>
<a href="<?php echo Yii::app()->request->baseUrl; ?>/merchant/FoodItem" class="uk-button"><i class="fa fa-list"></i> <?php echo Yii::t("default","List")?></a>
<a href="<?php echo Yii::app()->request->baseUrl; ?>/merchant/FoodItem/Do/Sort" class="uk-button"><i class="fa fa-sort-alpha-asc"></i> <?php echo Yii::t("default","Sort")?></a>
<a href="<?php echo Yii::app()->request->baseUrl; ?>/merchant/FoodItem/Do/ListUpdate" class="uk-button"><i class="fa fa-bar-chart"></i> <?php echo Yii::t("default","Update Price")?></a>
<?php if($verif > 1): ?>
	<a href="<?php echo Yii::app()->request->baseUrl; ?>/merchant/FoodItem/Do/ListUpdateQuantity" class="uk-button"><i class="fa fa-bar-chart"></i> <?php echo Yii::t("default","Update Quantity")?></a>

	<a href="<?php echo Yii::app()->request->baseUrl; ?>/merchant/FoodItem/Do/ImportarCSV" class="uk-button"><i class="fa fa-plus"></i> <?php echo Yii::t("default","Importar archivo CSV")?></a>  

    <a href="<?php echo Yii::app()->request->baseUrl; ?>/merchant/Import-Json" class="uk-button"><i class="fa fa-plus"></i> <?php echo Yii::t("default","Procesar archivo Json")?></a>  

<?php endif; ?>
</div>

<?php 
       
    /*** Consulto en la Base de Datos la Necesidad de un Stock de Inventario ****/

     $mid= Yii::app()->functions->getMerchantID();
     $invent= Yii::app()->functions->getNeedInventory($mid);


     $name = Yii::t('default',"Name");
     $descrip = Yii::t('default',"Description");
     $cat= Yii::t('default',"Categories");
     $price=Yii::t('default',"Price");
     $picture=Yii::t('default',"Photos");
     $cant=Yii::t('default',"Quantity");
     $aviable= Yii::t('default',"Item Not Available");
     $date= Yii::t('default',"Date");
    
       

/***** Comienzo a pintar la Tabla de los productos ****/

$html='<form id="frm_table_list" method="POST" >
	<input type="hidden" name="action" id="action" value="FoodItemList">
	<input type="hidden" name="tbl" id="tbl" value="item">
	<input type="hidden" name="clear_tbl"  id="clear_tbl" value="clear_tbl">
	<input type="hidden" name="whereid"  id="whereid" value="item_id">
	<input type="hidden" name="slug" id="slug" value="FoodItem/Do/Add">
	<table id="table_list" class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
	  <caption>Merchant List</caption>';

/**** Verifico que el Establecimiento necesite un Stock de Inventario*****/

  if($verif > 1)
  {

	$html.='<thead>
				<tr>
              	  <th width="2%"><input type="checkbox" id="chk_all" class="chk_all"></th>';
    $html.='<th width="5%">'.$name.'</th>';
    $html.='<th width="4%">'.$descrip.'</th>';
    $html.='<th width="4%">'.$cat.'</th>';
    $html.='<th width="4%">'.$price.'</th>';
    $html.='<th width="4%">'.$picture.'</th>';
    $html.='<th width="4%">'.$cant.'</th>';
    $html.='<th width="4%">'.$aviable.'</th>';
    $html.='<th width="4%">'.$date.'</th>';
	$html.='</tr></thead>';

  }else
  {
  	$html.='<thead>
				<tr>
              	  <th width="2%"><input type="checkbox" id="chk_all" class="chk_all"></th>';
    $html.='<th width="5%">'.$name.'</th>';
    $html.='<th width="4%">'.$descrip.'</th>';
    $html.='<th width="4%">'.$cat.'</th>';
    $html.='<th width="4%">'.$price.'</th>';
    $html.='<th width="4%">'.$picture.'</th>';
    $html.='<th width="4%">'.$aviable.'</th>';
    $html.='<th width="4%">'.$date.'</th>';
	$html.='</tr></thead>';

  }

  /*** muestro el HTML ****/

  echo $html;


 ?>

	<!-- 
	<form id="frm_table_list" method="POST" >
	<input type="hidden" name="action" id="action" value="FoodItemList">
	<input type="hidden" name="tbl" id="tbl" value="item">
	<input type="hidden" name="clear_tbl"  id="clear_tbl" value="clear_tbl">
	<input type="hidden" name="whereid"  id="whereid" value="item_id">
	<input type="hidden" name="slug" id="slug" value="FoodItem/Do/Add">
	<table id="table_list" class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
	  <caption>Merchant List</caption>
	   <thead>
	        <tr>
	                <th width="2%"><input type="checkbox" id="chk_all" class="chk_all"></th>
	                <th width="5%"><?php echo Yii::t('default',"Name")?></th>
	                <th width="4%"><?php echo Yii::t('default',"Description")?></th>
	                <th width="4%"><?php echo Yii::t('default',"Categories")?></th>            
	                <th width="4%"><?php echo Yii::t('default',"Price")?></th>
	                <th width="4%"><?php echo Yii::t('default',"Photos")?></th>
	                <th width="4%"><?php echo Yii::t('default',"Item Not Available")?></th>
	                <th width="4%"><?php echo Yii::t('default',"Date")?></th>
	        </tr>
	    </thead>
	    <tbody> 
	    </tbody>
	</table>
	<div class="clear"></div>
	</form> -->