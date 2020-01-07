
<div class="search-wraps single-search">

  
    
  <form method="GET" class="forms-search" id="forms-search" action="<?php echo Yii::app()->createUrl('store/searcharea')?>" style="display: none;">
  <div class="search-input-wraps">
     <div class="row">
        <div class=" border col-sm-11 col-xs-10">
        <?php echo CHtml::textField('s',$kr_search_adrress,array(
         'placeholder'=>"Ingresa tu ciudad",
         'required'=>true
        ))?>        
        </div>        
        <div class=" relative border col-sm-1 col-xs-2" style="">
          <button type="submit" class="hide-mob" style="font-family:'Open Sans',sans-serif !important;background: #264baa !important;">¡Pidemelo!</button>  
          <button type="submit" class="display-mob"><i class="ion-ios-search"></i></button>       
        </div>
     </div>
  </div> <!--search-input-wrap-->
  </form>

  <!--INICIO ICONO DE WHATSAPP-->

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <a href="https://api.whatsapp.com/send?phone=584244390457&amp;text=%C2%A1Hola!%20Quiero%20pedir%20As%C3%ADdeR%C3%A1pido" class="float-ws" target="_blank">
    <i class="fa fa-whatsapp my-float"></i>
  </a>

  <style>
    .float-ws{
      position:fixed;
      width:60px;
      height:60px;
      bottom:40px;
      right:40px;
      background-color:#25d366;
      color:#FFF;
      border-radius:50px;
      text-align:center;
      font-size:30px;
      box-shadow: 2px 2px 3px #999;
      z-index:100;
    }

    .my-float{
      margin-top:16px;
    }
  </style>

  <!--INICIO ICONO DE WHATSAPP-->

  
</div> <!--search-wrapper-->