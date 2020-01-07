
<div class="uk-width-1">
<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/adsManagerAdd" class="uk-button"><i class="fa fa-plus"></i> <?php echo Yii::t("default","Add New")?></a>

<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/adsManager" class="uk-button"><i class="fa fa-list"></i> <?php echo Yii::t("default","List")?></a>
</div>

<form id="frm_ads_list" method="POST" >
<input type="hidden" name="action" id="action" value="adsManager">
<input type="hidden" name="tbl" id="tbl" value="ads_manager">
<input type="hidden" name="clear_tbl"  id="clear_tbl" value="clear_tbl">
<input type="hidden" name="whereid"  id="whereid" value="id">
<input type="hidden" name="slug" id="slug" value="adsManagerAdd">
<table id="ads_list" class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
  <caption><?php echo Yii::t("default","Ads List")?></caption>
   <thead>
        <tr>
            <th width="3%"><?php echo Yii::t("default","Ads ID")?></th>
            <th width="7%"><?php echo Yii::t("default","Ads Name")?></th>            
            <th width="6%"><?php echo Yii::t("default","Link")?></th>
            <th width="5%"><?php echo Yii::t("default","Image")?></th>
            <th width="5%"><?php echo Yii::t("default","Status")?></th>            
        </tr>
    </thead>
    <tbody>    
    </tbody>
</table>
<div class="clear"></div>
</form>