<div class="box-grey rounded" style="margin-top:0;">
  <div id="merchant-map"></div>	          

  <div class="row top10 direction-action">
    <div class="col-md-6 border">
       <?php echo CHtml::textField('origin',
       isset($_SESSION['kr_search_address'])?$_SESSION['kr_search_address']:''
       ,array('class'=>'grey-inputs'))?>
    </div>
    <div class="col-md-3 border">
        
    </div>
    <div class="col-md-3 border">
       <input type="button" 
       class="get_direction_btn green-button inline rounded" 
       value="Obtener dirección">
    </div>
  </div> <!--row-->
            
</div> <!--box-grey-->

<div class="direction_output" id="direction_output"></div>	       