<?php 
if (isset($_GET['id']) && !empty($_GET['id'])){
	if (!$data=Yii::app()->functions->getAd($_GET['id'])){
		echo "<div class=\"uk-alert uk-alert-danger\">".
		Yii::t("default","Sorry but we cannot find what your are looking for.")."</div>";
		return ;
	} else {}
}
?>                              

<div class="uk-width-1">
<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/adsManagerAdd" class="uk-button"><i class="fa fa-plus"></i> <?php echo Yii::t("default","Add New")?></a>
<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/adsManager" class="uk-button"><i class="fa fa-list"></i> <?php echo Yii::t("default","List")?></a>


</div>

<div class="spacer"></div>

<div class="merchant-add"></div>

<!--<div class="right" style="margin-top:-30px">
<h3 style="margin:0 0 8px;"><?php echo t("Charges Type")?>: <span class="uk-text-danger">
<?php echo FunctionsV3::DisplayMembershipType($data['merchant_type']);?></span>
</h3>

</div>
<div class="clear"></div>

<ul data-uk-tab="{connect:'#tab-content'}" class="uk-tab uk-active">
<li class="uk-active"><a href="#"><?php echo t("Restaurant Information")?></a></li>
<li class=""><a href="#"><?php echo Yii::t("default","Login Information")?></a></li>
<li class=""><a href="#"><?php echo Yii::t("default","Merchant Type")?></a></li>
<li class=""><a href="#"><?php echo Yii::t("default","Featured")?></a></li>
<li class=""><a href="#"><?php echo Yii::t("default","Payment History")?></a></li>
<li class=""><a href="#"><?php echo Yii::t("default","Payment Settings")?></a></li>
<li class=""><a href="#"><?php echo Yii::t("default","Google Map")?></a></li>
<li class=""><a href="#"><?php echo Yii::t("default","Others")?></a></li>
</ul>     
-->
<form class="uk-form uk-form-horizontal forms" id="ads_form">
<?php 
echo CHtml::hiddenField('action','adsManagerAdd');
FunctionsV3::addCsrfToken(false);
?>
<?php echo CHtml::hiddenField('id',isset($_GET['id'])?$_GET['id']:"");?>
<?php echo CHtml::hiddenField('old_status',isset($data['status'])?$data['status']:"")?>
<?php if (!isset($_GET['id'])):?>
<?php echo CHtml::hiddenField("redirect",Yii::app()->request->baseUrl."/admin/adsManager")?>
<?php endif;?>
<!--
<ul class="uk-switcher uk-margin " id="tab-content">
<li class="uk-active">-->
    <fieldset>
        <!--<div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","name")?></label>
          <?php echo CHtml::textField('restaurant_slug',
          isset($data['restaurant_slug'])?stripslashes($data['restaurant_slug']):""
          ,array(
          'class'=>'uk-form-width-large',
          'data-validation'=>"required"
          ))?>
        </div>-->
    
        <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","Ad name")?></label>
          <?php echo CHtml::textField('name',
          isset($data['name'])?stripslashes($data['name']):""
          ,array(
          'class'=>'uk-form-width-large',
          'data-validation'=>"required"
          ))?>
        </div>
        
				<div class="uk-form-row">
				  <label class="uk-form-label"><?php echo Yii::t("default","Image")?></label>
				  <!--<div style="display:inline-table;margin-left:1px;" class="button uk-button" id="image"></div>-->
				  <!--<input type="file" name="file" id="file" data-validation="required" />-->
				  <div style="display:inline-table;margin-left:1px;" class="button uk-button" id="image"><?php echo Yii::t('default',"Browse")?></div>	  
					<div style="display:inline;" class="image_file"><?=isset($data['image'])?$data['image']:""?></div>
					<div style="display:none;" class="image_preview"></div>
					<input type="hidden" name="image" id="image_value" value="<?=isset($data['image'])?$data['image']:""?>"/>
				</div>
        
        <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","Link (URL)")?></label>
          <?php echo CHtml::textField('link',
          isset($data['link'])?$data['link']:""
          ,array(
          'class'=>'uk-form-width-large',
          'data-validation'=>"required"
          ))?>
        </div>
        
        <!--
        <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","Contact name")?></label>
          <?php echo CHtml::textField('contact_name',
          isset($data['contact_name'])?$data['contact_name']:""
          ,array(
          'class'=>'uk-form-width-large',
          'data-validation'=>"required"
          ))?>
        </div>
        <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","Contact phone")?></label>
          <?php echo CHtml::textField('contact_phone',
          isset($data['contact_phone'])?$data['contact_phone']:""
          ,array(
          'class'=>'uk-form-width-large',
          'data-validation'=>"required"
          ))?>
        </div>
        <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","Contact email")?></label>
          <?php echo CHtml::textField('contact_email',
          isset($data['contact_email'])?$data['contact_email']:""
          ,array(
          'class'=>'uk-form-width-large',
          'data-validation'=>"required"
          ))?>
        </div>
        <div class="uk-form-row">
          <label class="uk-form-label"><?php echo t("Country")?></label>
          <?php echo CHtml::dropDownList('country_code',
          isset($data['country_code'])?$data['country_code']: getOptionA('merchant_default_country'),
          (array)Yii::app()->functions->CountryList(),          
          array(
          'class'=>'uk-form-width-large',
          'data-validation'=>"required"
          ))?>
        </div>
        <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","Street address")?></label>
          <?php echo CHtml::textField('street',
          isset($data['street'])?$data['street']:""
          ,array(
          'class'=>'uk-form-width-large',
          'data-validation'=>"required"
          ))?>
        </div>
                
        <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","City")?></label>
          <?php echo CHtml::textField('city',
          isset($data['city'])?$data['city']:""
          ,array(
          'class'=>'uk-form-width-large',
          'data-validation'=>"required"
          ))?>
        </div>
        <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","Post code/Zip code")?></label>
          <?php echo CHtml::textField('post_code',
          isset($data['post_code'])?$data['post_code']:""
          ,array(
          'class'=>'uk-form-width-large',
          'data-validation'=>"required"
          ))?>
        </div>
		
				<div class="uk-form-row">
				<label class="uk-form-label"><?php echo Yii::t("default","State/Region")?></label>
				<?php echo CHtml::textField('state',
				isset($data['state'])?$data['state']:""
				,array(
				'class'=>'uk-form-width-large',
				'data-validation'=>"required"
				))?>
				</div>    		

        <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","Cuisine")?></label>
          <?php echo CHtml::dropDownList('cuisine[]',
          isset($data['cuisine'])?(array)json_decode($data['cuisine']):"",
          (array)Yii::app()->functions->Cuisine(true),          
          array(
          'class'=>'uk-form-width-large chosen',
          'multiple'=>true,
          'data-validation'=>"required"
          ))?>
        </div>
        <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","Services")?></label>
          <?php echo CHtml::dropDownList('service',
          isset($data['service'])?$data['service']:"",
          (array)Yii::app()->functions->Services(),          
          array(
          'class'=>'uk-form-width-large',
          'data-validation'=>"required"
          ))?>
        </div>
        
         <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","Published Merchant")?></label>
          <?php 
          echo CHtml::checkBox('is_ready',
          $data['is_ready']==2?true:false
          ,array(
            'value'=>2,
            'class'=>"icheck"
          ))
          ?>
        </div>-->
        <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","Type")?></label>
        <?php 
          echo CHtml::checkBoxList(
            'view_type',
            $selected_Array=array(),
            array('Common'=>'Common','Location'=>'By Location'),
            array(
            'class'=>'uk-form-width-large','onchange'=>'typevalue()'
          )); 
          ?>
        </div>
        
        <div class="uk-form-row" id="loc" style="display: none;">
          <label class="uk-form-label"><?php echo Yii::t("default","Location")?></label>
          <?php echo CHtml::textField('location',
				isset($data['state'])?$data['state']:""
				,array(
				'class'=>'uk-form-width-large',
				'data-validation'=>"required"
				))?>
				<?php echo CHtml::hiddenField('city',''
				,array(
				'class'=>'uk-form-width-large'
				))?>
        </div>
        
        <div class="uk-form-row">
          <label class="uk-form-label"><?php echo Yii::t("default","Status")?></label>
          <?php echo CHtml::dropDownList('status',
          isset($data['status'])?$data['status']:"1",
          array(1 => 'Enabled', 0 => 'Disabled'),          
          array(
          'class'=>'uk-form-width-large',
          'data-validation'=>"required"
          ))?>
        </div>
        
				<div class="uk-form-row">
				<label class="uk-form-label"></label>
				<input type="submit" value="<?php echo Yii::t("default","Save")?>" class="uk-button uk-form-width-medium uk-button-success">
				</div>
               
    </fieldset>
</li>

</ul>    

<?php 
Yii::app()->functions->data="list";
?>


</form>
<script type="text/javascript">
    function typevalue() {
        if (document.getElementById('view_type_1').checked) {
            document.getElementById("loc").style.display = 'block';
        } else {
            document.getElementById("loc").style.display = 'none';
        }
    }
</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyBkbmA0sGERXI7WDTLwD5EeDz7xsDRGXBc"></script>
<script type="text/javascript">
        function initialize() {
            var input = document.getElementById('location');
            var autocomplete = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var place = autocomplete.getPlace();
                var address = place.formatted_address;
                document.getElementById('city').value = place.name;
                //document.getElementById('location').value = place.geometry.location.lat();
                // document.getElementById('cityLng').value = place.geometry.location.lng();
                //alert("This function is working!");
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize); 
</script>