
<div class="box-grey rounded merchant-opening-hours" style="margin-top:0;">

<div class="section-label bottom20">
    <a class="section-label-a">
      <i class="ion-clock"></i>
      <span class="bold" style="background:#fff;">
      Horarios de apertura</span>
      <b></b>
    </a>     
</div>  

<?php if ( $res=FunctionsV3::getMerchantOpeningHours($merchant_id)):?>
<?php foreach ($res as $val):?>
   <div class="row custom-flex-row">
      <div class="col-md-4 col-xs-3 "><i class="green-color ion-ios-plus-empty"></i> 
      <?php echo t($val['day'])?></div>
      <div class="col-md-4 col-xs-6 "><?php echo $val['hours']?></div>
      <div class="col-md-4 col-xs-3"><?php echo $val['open_text']?></div>
   </div>
<?php endforeach;?>
<?php else :?>
<p class="text-danger">Información no disponible</p>
<?php endif;?>

</div> <!--box-grey-->