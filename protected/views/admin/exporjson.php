
<div class="parisin">

<h3 class="head-with-bg"><?php echo Yii::t("default","Incoming orders from merchant for today")?> <span class="uk-text-success">
<?php echo FormatDateTime(date('c'),false); //echo date('F d, Y')?></span></h3>

<form id="frm_table_list3" method="POST" class="report uk-form uk-form-horizontal admin-neworders" >
<input type="hidden" name="action" id="action" value="rptIncomingOrders">
<input type="hidden" name="tbl" id="tbl" value="item">
<table id="table_list3" class="uk-table uk-table-hover uk-table-striped uk-table-condensed">  
   <thead>
        <tr> 
            <th width="2%"><?php echo Yii::t('default',"Ref#")?></th>
            <th width="2%"><?php echo Yii::t('default',"Merchant Name")?></th>           
            <th width="6%"><?php echo Yii::t('default',"Name")?></th>
            <th width="3%"><?php echo Yii::t('default',"Item")?></th>            
            <th width="3%"><?php echo Yii::t('default',"TransType")?></th>
            <th width="3%"><?php echo Yii::t('default',"Payment Type")?></th>
            <th width="3%"><?php echo Yii::t('default',"Total Pedido")?></th>
            <th width="3%"><?php echo Yii::t('default',"Status")?></th>
            <th width="3%"><?php echo Yii::t('default',"Platform")?></th>
            <th width="3%"><?php echo Yii::t('default',"Date")?></th>            
        </tr>
    </thead>
    <tbody>    
    </tbody>
</table>
<div class="clear"></div>

</form>

<div style="padding-top:50px;padding-bottom:20px;">
<hr></hr>
</div>
</div>


<style type="text/css">
    .tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #00928c;
    color: #fff;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}
.head-with-bg {
    background: #EEE;
    padding: 15px 20px !important;
    border-left: 0px solid !important;
}
.parisin {
    border: 1px solid #ddd;
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 30px;
    padding-bottom: 20px;
    margin-top: 20px;
}
#frm_table_list3 {
    padding: 20px 30px;
}
.for-tab {
    -webkit-border-top-left-radius: 10px;
-webkit-border-top-right-radius: 10px;
-moz-border-radius-topleft: 10px;
-moz-border-radius-topright: 10px;
border-top-left-radius: 10px;
border-top-right-radius: 10px;
}
.head-with-bg span {
    color: black !important;
    font-weight: bold;
}
</style>
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
          document.getElementById("London").style.display = "block";
          var btLondon = document.getElementById("bt-london");
    btLondon.classList.add("active");
          

      });
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

</script>
