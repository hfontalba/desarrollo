<div class="modal driver-details-moda" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
    
      <div class="modal-header">
         <button aria-label="Close" data-dismiss="modal" class="close" type="button">
           <span aria-hidden="true"><i class="ion-android-close"></i></span>
         </button> 
        <h4 id="mySmallModalLabel" class="modal-title">
        <?php echo Driver::t("Driver Details")?>
        </h4> 
      </div>  
      
      <div class="modal-body">
      
      <?php 
      echo CHtml::hiddenField('driver_id_details','',array(
       'class'=>"driver_id_details"
      ))
      ?>
       
      <div class="grey-box rounded">
      
       <div class="row">
         <div class="col-md-6">
            <div class="form-group left-form-group">
	         <label class="font-medium"><?php echo Driver::t("Nombre")?> :</label>
	         <span class="v driver_name"></span>
	       </div> 
         </div> <!--col-->
         
         <div class="col-md-6">
            <div class="form-group left-form-group">
	          <label class="font-medium"><?php echo Driver::t("Telf")?> :</label>
	          <span class="v phone"></span>
	        </div> 
         </div>
         
       </div> <!--row-->
       
       <div class="row">
         <div class="col-md-6">
            <div class="form-group left-form-group">
	         <label class="font-medium"><?php echo Driver::t("Correo")?> :</label>
	         <span class="v email"></span>
	       </div> 
         </div> <!--col-->
         
         <div class="col-md-6">
            <div class="form-group left-form-group">
	          <label class="font-medium"><?php echo Driver::t("Equipo")?> :</label>
	          <span class="v team_name"></span>
	        </div> 
         </div>
         
       </div> <!--row-->
       
       <div class="row">
         <div class="col-md-6">
            <div class="form-group left-form-group">
	         <label class="font-medium"><?php echo Driver::t("Tipo transporte")?> :</label>
	         <span class="v transport_type_id"></span>
	       </div> 
         </div> <!--col-->
         
         <div class="col-md-6">
            <div class="form-group left-form-group">
	          <label class="font-medium"><?php echo Driver::t("Placa")?> :</label>
	          <span class="v licence_plate"></span>
	        </div> 
         </div>
         
       </div> <!--row-->

       
        <div class="row">
         <div class="col-md-6">
            <div class="form-group left-form-group">
	         <label class="font-medium"><?php echo Driver::t("Plataforma")?> :</label>
	         <span class="v device_platform"></span>
	       </div> 
         </div> <!--col-->
         
         <div class="col-md-6">
            <div class="form-group left-form-group">
	          <label class="font-medium"><?php echo Driver::t("App Version")?> :</label>
	          <span class="v app_version"></span>
	        </div> 
         </div>
         
       </div> <!--row-->      
      
      </div> <!--box-->
      
      
      <!--TASK -->
      <h4><?php echo Driver::t("Tarea")?></h4>
      <div class="grey-box rounded top10">
        <table class="table driver-task-list">
         <thead>
         <tr> 
           <th><?php echo Driver::t("ID pedido")?></th>
           <th><?php echo Driver::t("Nombre")?></th>
           <th><?php echo Driver::t("Tipo")?></th>
           <th><?php echo Driver::t("Direccion")?></th>           
           <th><?php echo Driver::t("Estado")?></th>
           <th></th>
         </tr>
         </thead>
         <tbody>          
         </tbody>
        </table>
      </div> <!--box-->
 
      </div> <!--body-->
    
    </div>
  </div>
</div>      