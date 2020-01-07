<!-- Remember to include jQuery :) -->
<script src="/assets/js/jquery-3.0.0.min.js"></script>

<!-- jQuery Modal -->
<script src="/assets/js/jquery.modal-0.9.1.min.js"></script>
<link rel="stylesheet" href="/assets/css/jquery.modal.min.css" />


<!-- 
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
 -->


<form id="frm_table_list" method="POST" class="report uk-form uk-form-horizontal" >
<?php echo CHtml::hiddenField('start_date',isset($_GET['start_date'])?$_GET['start_date']:"")?>
<?php echo CHtml::hiddenField('end_date',isset($_GET['end_date'])?$_GET['end_date']:"")?>

<?php 
$order_stats=Yii::app()->functions->orderStatusList2(false);    
?>

<div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Merchant Name")?></label>
  <?php 
  echo CHtml::dropDownList('merchant_id','',
  (array)FunctionsV3::merchantList(true,true)
  ,array(
    'class'=>'uk-form-width-large',    
  ))
  ?>
</div>
  
<div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Start Date")?></label>
  <?php echo CHtml::textField('start_date1',''  
  ,array(
  'class'=>'uk-form-width-large j_date',
  'data-id'=>'start_date'
  ))?>
</div>

<div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","End Date")?></label>
  <?php echo CHtml::textField('end_date1',''  
  ,array(
  'class'=>'uk-form-width-large j_date' ,
  'data-id'=>'end_date'
  ))?>
</div>


<div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Status")?></label>
  <?php echo CHtml::dropDownList('stats_id[]',array(4),(array)$order_stats,array(
  'class'=>"chosen uk-form-width-large",
  'multiple'=>true
  ))?>
</div>

<div class="uk-form-row">
  <label class="uk-form-label">&nbsp;</label>
  <input type="button" class="uk-button uk-form-width-medium uk-button-success" value="<?php echo t("Search")?>" onclick="sales_summary_reload();">  
  <a href="javascript:;" rel="rptAdminSalesMerchant" class="export_btn uk-button"><?php echo t("Export")?></a>
</div>  

<div style="height:20px;"></div>

<input type="hidden" name="action" id="action" value="rptAdminSalesRpt">
<input type="hidden" name="tbl" id="tbl" value="item">



<table id="table_list" class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
  <!--<caption>Merchant List</caption>-->
   <thead>
        <tr> 
            <th width="4%"><?php echo Yii::t('default',"# Ref Pedido")?></th>
            <th width="12%"><?php echo Yii::t('default',"Merchant Name")?></th>
            <th width="6%"><?php echo Yii::t('default',"Quantity")?></th>
            <th width="12%"><?php echo Yii::t('default',"Item")?></th>            
            <th width="6%"><?php echo Yii::t('default',"TransType")?></th>
            <th width="6%"><?php echo Yii::t('default',"Payment Type")?></th>
            <th width="6%" ><?php echo Yii::t('default',"Referencia")?></th>
            <th width="6%"><?php echo Yii::t('default',"Bank")?></th>
            <th width="6%"><?php echo Yii::t('default',"Sub-Total")?></th>
            <th width="6%"><?php echo Yii::t('default',"Deducciones por Servicio")?></th>
            <th width="6%"><?php echo Yii::t('default',"Total a Transferir")?></th>
            <th width="6%"><?php echo Yii::t('default',"$")?></th>
            <th width="6%"><?php echo Yii::t('default',"Status")?></th>
            <th width="6%"><?php echo Yii::t('default',"Platform")?></th>
            <th width="6%"><?php echo Yii::t('default',"Date")?></th>
            <!--<th width="3%"></th>-->
        </tr>
    </thead>
    <tbody>    
    </tbody>
</table>

</form>

<script>
  

jQuery(document).ready(function() { 
  

 $("#table_list tbody").on( "click", "tr", function() { 

$("#referencia").attr('disabled', 'true');
$("#banco").attr('disabled', 'true');



var ref_d_ped = '';
var ref = '';
var banc = '';
var tip_pag = '';


  

      ref_d_ped = $(this).find('td:first').html();


      if (ref_d_ped != 'Cargando...' && ref_d_ped !='0' && ref_d_ped !='') {

        document.getElementById("a-mod").click(); 
                tip_pag   = $(this).find('td:nth-child(6)').html();
                ref       = $(this).find('td:nth-child(7)').html();
                banc      = $(this).find('td:nth-child(8)').html();


                $("#Ref_ped").val(ref_d_ped);
                $("#referencia").val(ref);
                
                $("#tip_pag").val(tip_pag);


          if (ref_d_ped != '' && ref == '' ) {
            mostrarSelect(banc);
          }else if (ref_d_ped != '' ) {
            mostarInput(banc);
          }

      }else{
        uk_msg('Por favor espere a que carguen los datos de la tabla');

      }
 
});


function mostrarSelect(banc){

$("#banco").css('display', 'block').val(banc);
$("#banco_input").css('display', 'none');

$("#guardar").removeAttr('disabled');
$("#referencia").removeAttr('disabled');
$("#banco").removeAttr('disabled');

}

function mostarInput(banc){


$("#banco_input").css('display', 'block').val(banc);
$("#banco").css('display', 'none');
$("#guardar").attr('disabled', 'true');
$("#referencia").attr('disabled', 'true');
$("#banco").attr('disabled', 'true');

}

$("#guardar").click(function() {

    var ref_d_ped = $("#Ref_ped").val();
    var ref = $("#referencia").val();
    var banc = $("#banco").val();
    var tip_pag = $("#tip_pag").val();


  guardar(ref_d_ped, ref, banc, tip_pag);


});

$("#cerrar-modal").click(function(event) {
   document.getElementById("c-mod").click(); 
});


 $("#referencia").attr('disabled', 'true');   

/*$("#banco").click(function(event) {
  var ref =  $("#banco").val();
    if (ref == 0 || ref =="") {
      $("#referencia").attr('disabled', 'true');   
    }else{
      $("#referencia").removeAttr('disabled');
    }
});*/


$("#editar").click(function(event) {
  mostrarSelect('');
  $("#referencia").removeAttr('disabled');
  $("#banco").removeAttr('disabled');
});

function cargar_select_pago(){

    var accion = "select_pago";
    $.ajax({
      url: 'http://www.asiderapido.cloud/protected/views/admin/rpt-merchant-sales-ajax.php',
      type: 'POST',
      dataType: 'json',
      data: {
        accion:accion
      },
    })
    .done(function(data) {
          if ((data.result==1)) {
          $("#banco").html(data.select);
        }
    })
    .fail(function(data) {
      console.log("error al cargar select de pago");
    })

}


$("#banco").change(function(event) {
  var banco = $("#banco").val();

  if (banco == 0) {
    $("#referencia").val('').attr('disabled', 'true');
  }else{

  }
});

 function guardar(ref_d_ped, ref, banc, tip_pag){

  document.getElementById("c-mod").click(); 

  var error = 0;

    

  if (banc == "") {
    uk_msg('Por favor seleccione el banco de donde se realizo el pago');
    error = error + 1;
  }else if(banc == 0){
    ref = '0000';
  }

 if (ref_d_ped == "" || ref_d_ped == 0) {
      uk_msg('Por favor ingrese la referencia de pedido');
      error = error + 1;
  }
  

 if (tip_pag == "" || tip_pag == 0) {
    uk_msg('Por favor seleccione el tipo de pago');
    error = error + 1;
}


    if (error == 0) {

        var accion = "save_ref_pag";
          $.ajax({
            url: 'http://www.asiderapido.cloud/protected/views/admin/rpt-merchant-sales-ajax.php',
            type: 'POST',
            dataType: 'json',
            data: {
              accion:accion,
              ref_d_ped:ref_d_ped,
              ref:ref,
              banc:banc,
              tip_pag:tip_pag
            },
          })
          .done(function(data) {
            if ((data.result==1)) {
                uk_msg_sucess('Se aplico correctamente los cambios al pedido: '+ref_d_ped);    
                sales_summary_reload()    
            }else{
                uk_msg_sucess('Error al guardar datos');        
            }

          })
          .fail(function(data) {
            if ((data.result2==3)) {
            
              uk_msg_sucess('error al guardar datos ajax');
            }
            mensaje(notificacion);
          })
      }else{
        uk_msg('Ocurrio un error verifique los datos');
      }
    
 }

cargar_select_pago()
});

</script>
<!-- Modal HTML embedded directly into document -->
<div id="ex1" class="modal">
    <div class="uk-modal-header">
        <h2>Agregar datos de pago</h2>
    </div>

    <div class="uk-modal-body">

        <form class="uk-form uk-form-horizontal">

            <div class="uk-form-row">
                <label for="Ref_ped" class="uk-form-label">Referencia de pedido</label>
                <div class="uk-form">
                    <input type="text" id="Ref_ped" class="uk-form-width-medium" disabled>
                </div>
            </div>
            <div class="uk-form-row">
                <label for="tip_pag" class="uk-form-label">Tipo de pago</label>
                <div class="uk-form">
                    <input type="text" id="tip_pag" class="uk-form-width-medium" disabled>
                </div>
            </div>
            <div class="uk-form-row">
                <label for="referencia" class="uk-form-label">Referencia</label>
                <div class="uk-form">
                    <input type="number" id="referencia" class="uk-form-width-medium">
                </div>
            </div>
            <div class="uk-form-row">
                <label for="banco" class="uk-form-label">Banco</label>
                <div class="uk-form">
                    <select name="banco" id="banco" class="uk-form-width-medium">
                    </select>

                    <input type="text" id="banco_input" class="uk-form-width-medium" disabled>

                </div>
            </div>
               <br>
            <div class="uk-modal-footer">

                <button type="button" class="uk-button" id="cerrar-modal">Cancel</button>
                <button type="button" class="uk-button" id="editar">Editar</button>
                <button type="button" class="uk-button uk-button-success" id="guardar">Guardar</button>


            </div>

        </form>
     

        <a style="display: none" href="#" rel="modal:close" id="c-mod">Close</a>
        <a style="display: none" href="#ex1" rel="modal:open" id="a-mod"></a>
    </div>
</div>

<!-- Link to open the modal -->

