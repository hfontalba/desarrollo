

<div class="box-grey rounded section-credit-card" style="margin-top:0;">



<form method="POST" id="frm-otable" class="frm-otable"> 
<?php echo CHtml::hiddenField('otable_action','ClientCCList')?> 
<?php echo CHtml::hiddenField('tbl','client_cc')?>
  
<!--<table class="otable table table-striped">
 <thead>
  <tr>
   <th><?php echo Yii::t("default","Card name")?></th>
   <th><?php echo Yii::t("default","Card number")?></th>
   <th><?php echo Yii::t("default","Expiration")?></th>
  </tr>
 </thead>
</table>-->

<div id="creditCards"></div>

</form>
<div class="clearfix"></div>
<div class="bottom10 top10">
	<div class="plus-adder">
<a class="green-button inline round-plus-new rounded" href="<?php echo Yii::app()->createUrl('/store/profile/?tab=4&do=add')?>">
<i class="fa fa-plus"></i>
</a>
<h3>Do it for fast payments</h3>
<h5>Save your credit/debit card </h5>
</div>
</div>
<div class="clear"></div>

</div>