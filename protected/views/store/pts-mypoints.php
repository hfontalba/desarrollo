<div class="order-steps-container "><div class="order-steps-expander"> <div class="container"> <div class="title"> Get your favourite food at your doorstep. <span class="trigger" onclick="scrollTo()"></span> </div> </div> </div> </div>

<div class="sections ">
   <div class="container">
   <div class="" style="padding-bottom:40px;" >
   
   <h3 class="main-head"><?php echo t("My Points")?></h3>
   
   <ul id="simpletabs">
	<li class="active"><?php echo t("Income Points")?></li>
	<li><?php echo t("Expenses Points")?></li>
	<li><?php echo t("Expired Points")?></li>	
   </ul>
   
   <div class="points-total-wrap">
	  <div class="mytable">
	    <div class="col">
	       <p><?php echo t("Available Points")?></p>
	       <h4><?php echo $earn_points>0?$earn_points:0;?></h4>
	    </div>
	    <div class="col last">
	       <p><?php echo t("Points Expiring Soon(This year)")?></p>
	       <h4><?php echo $points_expirint>0?$points_expirint:0?></h4>
	       <p class="small">
	       <?php 
	       $date_expiring="December"." 31 ".date("Y")." 11:59 PM";
	       echo Yii::app()->functions->translateDate($date_expiring);
	       ?>
	       </p>
	    </div>
	  </div>
	</div> <!-- points-total-wrap-->
	
    <ul id="tab">   
		<li class="active">	
		 <form class="frm_pts_income pts_frm">
		  <table id="pts-income-tbl" class="table table-hover">
		     <thead>
		     <tr>
		      <th width="25%"><?php echo t("Date")?></th>
		      <th width="50%"><?php echo t("Transaction")?></th>
		      <th width="20%"><?php echo t("Amount")?></th>
		     </tr>
		     </thead>
		     <tbody>		     
		     </tbody>
		  </table> 
		 </form>
		</li>
		
		<li>
		<form class="frm_pts_expenses pts_frm">
		  <table id="pts-expenses-tbl" class="table table-hover">
		     <thead>
		     <tr>
		      <th width="25%"><?php echo t("Date")?></th>
		      <th width="50%" ><?php echo t("Transaction")?></th>
		      <th width="20%"><?php echo t("Amount")?></th>
		     </tr>
		     </thead>
		     <tbody>		     
		     </tbody>
		  </table> 
		 </form> 
		</li>
		
		<li>
		 <form class="frm_pts_expired pts_frm">
		  <table id="pts-expired-tbl" class="table table-hover">
		     <thead>
		     <tr>
		      <th width="25%"><?php echo t("Date")?></th>
		      <th width="50%"><?php echo t("Transaction")?></th>
		      <th width="20%"><?php echo t("Amount")?></th>
		     </tr>
		     </thead>
		     <tbody>		     
		     </tbody>
		  </table> 
		 </form> 
		</li>
		
    </ul> <!--tab-->	
   
    </div> <!--box-grey-->
   </div> <!--container-->
</div> <!--sections-->
<style type="text/css">
  .order-steps-container .order-steps-expander {
    background: #f5f5f5;
    padding: 20px 0;
    text-align: center;
}
.order-steps-container .order-steps-expander .title {
    font-size: 18px;
    color: #777;
}
.order-steps-container .order-steps-expander .trigger {
    color: #333;
    font-weight: 700;
    padding: 0 20px;
    cursor: pointer;
    position: relative;
}
.order-steps-container.open .order-steps-expander .trigger:after {
    -webkit-transform: rotate(90deg);
    -ms-transform: rotate(90deg);
    transform: rotate(90deg);
}
.order-steps-container .order-steps-expander .trigger:after {
    content: "";
    display: inline-block;
    border-right: none;
    border-left: 9px solid;
    border-top: 6px solid transparent;
    border-bottom: 6px solid transparent;
    -webkit-transform: rotate(90deg);
    -ms-transform: rotate(90deg);
    transform: rotate(90deg);
    -webkit-transform: rotate(0);
    -ms-transform: rotate(0);
    transform: rotate(0);
    margin-left: 10px;
}
.order-steps-container .order-steps-expander .title {
    font-size: 18px!important;
    color: #777;
}
.main-head {
	font-size: 20px;
	margin-bottom: 20px;
}
ul#simpletabs li {
	border: none;
}
ul#simpletabs li.active {
    color: #000;
    border-top: 0px;
    border-bottom: 1px solid #f75d34;
}
ul#simpletabs {
    margin-bottom: 30px;
}
.points-total-wrap .mytable p {
	font-size: 14px;
}
.points-total-wrap .mytable h4 {
	font-size: 36px;
}
</style>