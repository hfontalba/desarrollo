<script src="/assets/js/jquery-3.0.0.min.js"></script>

<?php 

     /*********** CODIGO MODIFICADO ***********
     * @Author: Luis A. Sarabia V
     * @Objetive: permitir que un establecimiento que necesite actualiazar su inventario por medio de un archivo .Json
     * @Date: 11/12/2019
     * @Version: 0.1
     *****************************************/
   
    /*** Consulto en la Base de Datos la Necesidad de un Stock de Inventario ****/

     $mid= Yii::app()->functions->getMerchantID();
     //$invent= Yii::app()->functions->getNeedInventory($mid);
     //$verif=$invent['need_inventory'];

?>

<!-- Lista de opciones -->
<div class="uk-width-1">
<a href="<?php echo Yii::app()->request->baseUrl; ?>/merchant/FoodItem/Do/Add" class="uk-button"><i class="fa fa-plus"></i> <?php echo Yii::t("default","Add New")?></a>
<a href="<?php echo Yii::app()->request->baseUrl; ?>/merchant/FoodItem" class="uk-button"><i class="fa fa-list"></i> <?php echo Yii::t("default","List")?></a>
<a href="<?php echo Yii::app()->request->baseUrl; ?>/merchant/FoodItem/Do/Sort" class="uk-button"><i class="fa fa-sort-alpha-asc"></i> <?php echo Yii::t("default","Sort")?></a>
<a href="<?php echo Yii::app()->request->baseUrl; ?>/merchant/FoodItem/Do/ListUpdate" class="uk-button"><i class="fa fa-bar-chart"></i> <?php echo Yii::t("default","Update Price")?></a>

     <?php 
     if($verif > 1): 
     ?>
          <a href="<?php echo Yii::app()->request->baseUrl; ?>/merchant/FoodItem/Do/ListUpdateQuantity" class="uk-button"><i class="fa fa-bar-chart"></i> <?php echo Yii::t("default","Update Quantity")?></a>

          <a href="<?php echo Yii::app()->request->baseUrl; ?>/merchant/FoodItem/Do/ImportarCSV" class="uk-button"><i class="fa fa-plus"></i> <?php echo Yii::t("default","Importar archivo CSV")?></a>

     <?php 
     endif; 
     ?>

<a href="<?php echo Yii::app()->request->baseUrl; ?>/merchant/Import-Json" class="uk-button"><i class="fa fa-plus"></i> <?php echo Yii::t("default","Procesar archivo Json")?></a>  
</div>

 <!-- <a href="<?php echo '../biomercados/Productos_Ecomerce.json' ?>">Json</a> -->
<br>
 <button class="uk-button uk-button-success" id="process-ajax">Procesar Json</button>
<br>
<div id="loading" style="display:none">
    <p><img src="http://asiderapido.cloud/protected/views/merchant/ajax-loader.gif" /> Espere por favor</p>
</div>
<h3>Consola de mensajes</h3> 
<div class="uk-overflow-show" id="consola">
    



</div>

<script>

jQuery(document).ready(function() { 


$("#process-ajax").click(function(event) {
     var accion = 'process-json';
    enviar_datos(accion);
    $("#process-ajax").attr('disabled');
});



     function enviar_datos(accion){
               $("#loading").show();


                    $.ajax({
                    url: 'http://asiderapido.cloud/protected/views/merchant/import-json-ajax.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                         accion:accion
                    },
               })
               .done(function(data) {

                    $("#loading").hide();

               
                    var result = (data.result);
                   // alert((data.alert+'   '+result ));

                    if (result == 1) {

                         var mensajes_consola = '';

                        mensajes_consola = 'Archivo .Json Procesado correctamente!<br>';

                         $("#loading").hide();
                         $("#process-ajax").removeAttr('disabled');

                         var update = (data.update);
                         var error_update = (data.error_update);
                         var insert_new_data = (data.insert_new_data);
                         var insert = (data.insert);
                         var error_insert = (data.error_insert);
                         var data_duplicate = (data.data_duplicate);

                              if (insert !='') {
                                  mensajes_consola +='Insertados: '+ insert +'<br>';
                              }

                              if (update !='') {
                                  mensajes_consola +='Actualizados: '+ update +'<br>';
                              }
                              if (error_update !='') {
                                  mensajes_consola +='Errores Actualizando: '+ error_update +'<br>';
                              }
                              if (insert_new_data !='') {
                                  mensajes_consola +='Datos Nuevos: '+ insert_new_data +'<br>';
                              }

                              if (error_insert !='') {
                                  mensajes_consola += 'Errores Insertando: '+error_insert +'<br>';
                              }
                              if (data_duplicate !='') {
                                  mensajes_consola += 'Datos Duplicados: '+data_duplicate +'<br>';
                              }




                               $('#consola').html(mensajes_consola);
                    }else if (result == 2) {

                         $('#consola').html('El archivo .Json de importacion no fue encontrado!');
                         $("#process-ajax").removeAttr('disabled');


                    }else{

                         $('#consola').html('No se recibio respuesta por parte del servidor');
                         $("#process-ajax").removeAttr('disabled');

                    }



               })
               .fail(function(data) {
                    //console.log("error");
               })
               .always(function(data) {
               });

     }


});     


</script>
