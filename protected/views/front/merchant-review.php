<div class="text-right">
<a href="javascript:;" class="write-review-new green-button inline bottom10 upper">
Publicar reseña
</a>
</div>

<div class="review-input-wrap bottom10 row">
<!--<form class="forms" id="forms" onsubmit="return false;">-->
<form class="forms-review" id="forms-review" onsubmit="return false;">
<?php echo CHtml::hiddenField('action','addReviews')?>
<?php echo CHtml::hiddenField('currentController','store')?>
<?php echo CHtml::hiddenField('merchant-id',$merchant_id)?>
<?php echo CHtml::hiddenField('initial_review_rating','')?>	        
   <div class="col-md-12 border">
     <div>
       <div class="raty-stars" data-score="5"></div>   
     </div>
     <div>
     <?php echo CHtml::textArea('review_content','',array(
        'required'=>true,
        'class'=>"grey-inputs"
     ))?>
     </div>
     <div class="top10">
        <button class="orange-button inline" type="submit" style="margin: 0 auto !important;">Publicar reseña</button>
     </div>
   </div> <!--col-->	        
</form>
</div> <!--review-input-wrap-->

<div class="box-grey rounded merchant-review-wrap" style="margin-top:0;"></div>