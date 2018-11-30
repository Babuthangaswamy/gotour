<?php 
	//Js_Loader::$js[] = array('src'=>$GLOBALS['CI']->template->template_js_dir('date_formatter.js'),'defer'=>'defer');
	//$arr = json_decode(base64_decode($search_params['search_params']));
// debug($search_params);exit;
//   debug($tourgrade_list);exit;
	if(isset($tourgrade_list['data'][0]['bookingDate'])){
		$booking_date = $tourgrade_list['data'][0]['bookingDate'];	
	}else{
		$booking_date = $search_params['select_year'].'-'.$search_params['select_month'];
	}
	$age_band_details_arr = array('Adult','Youth','Senior','Child','Infant');
	$passenger_arr = array();
	$band_id = array();
	$passenger_count= array();
	

	foreach ($age_band_details_arr as $a_key => $a_value) {
		if(isset($search_params[$a_value.'_count'])){
			$passenger_arr[] = $a_value;
			$band_id[] = $search_params[$a_value.'_Band_ID'];
			$passenger_count[$a_value]= $search_params['no_of_'.$a_value];
		}
	}	
	
	$product_date_arr = $tourgrade_list['Available_date'];
	
	$product_dates_arr = array();
	foreach ($product_date_arr as $key => $value) {
		$product_dates_arr[$key] = $value;
	}	
	  $last_year_arr =  end($product_dates_arr);
	  $end_year = key($product_dates_arr);
	  $end_year_date = end($last_year_arr);  
	  $start_date_arr = reset($product_dates_arr);
	  $star_month_year = key($product_dates_arr);
	  $start_date_picker = reset($start_date_arr);
	  $age_band_arr = json_decode(base64_decode($search_params['age_band']));
	// $age_band_arr_list = array();
	// debug($age_band);
	// foreach ($age_band as $t_key => $t_value) {
	// 		$age_band_arr_list[$t_key] = $t_value;
	// }
	// debug($age_band_arr_list);exit;

	// debug($search_params);
	  $selected_date_str = '';
	  if(!empty($search_params['select_month'])){
	  		$selected_date_str = $search_params['select_month'];
	  }else{
	  		$selected_date_str = $search_params['get_month'];
	  }

?>
<div class="turgrde">
  <div class="container">
    <div class="col-md-12">
     <div class="pidaydiv">
       <h1><?=$tourgrade_list['ProductDetails']['ProductName']?> </h1>
       <p> Pricing based on <span>
       	<?php foreach($passenger_count as $p_key=>$p_val):?>
      				 <?php echo $p_val.' '.$p_key;?>
   			<?php endforeach;?></span>
       <?php  echo date("l\, jS F Y",strtotime($booking_date)); ?></p>
     </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12">
      <div class="col-md-3 nopad">
        <div class="frmdiv">
     		
     		<form method="post" action="<?php echo base_url()?>index.php/sightseeing/select_tourgrade">
     			<?php if(isset($search_params['search_params'])):?>
     		 		<input type="hidden" name="search_params" id="search_params_update" value="<?php echo $search_params['search_params']?>">
     		 	<?php else:?>
     		 		<input type="hidden" name="search_params" id="search_params_update" value="<?=
     		 		@base64_encode(json_encode($search_params))?>">
     			<?php endif;?>
  			  <div class="datediv">
  			    <div class="outdate">
  					<input id="tourgarde" type="text" name="date" class="form-control outdatadiv" >
  			    </div>
  			        <?php
                    //$date = date('Y-m-d');
                   	 $date =$star_month_year.'-'.$start_date_picker;
                    $start = $month = strtotime($date);                    
                    $end_year_details = $end_year.'-'.$end_year_date;                  
                    $end_date = date($end_year_details);
                    $end = strtotime($end_date);
                    $option = '';
                    $selected_date_time =strtotime($booking_date);
                    //echo "sle".$selected_date_time.'<br/>';
                    while($month < $end)
                    {   

                       $selected ='';
                    	if($search_params['select_year']==date('Y-m', $month)){
                    		$selected=' selected';
                    	}

                         $option .= '<option value='.date('Y-m', $month).' '. $selected.'>'.date('M Y', $month).'</option>';
                         $month = strtotime("+1 month", $month);
                    }
                   
                    
                 ?>

  			    <div class="adteselect">
  			        <select id="sel1" class="form-control" name="select_month">
        	      	<?php foreach($start_date_arr as $s_key=>$s_value):?>
                      <option value="<?=$s_value?>"><?=$s_value?></option>
                    <?php endforeach;?>
  			        </select>
  			    </div>
  			    <div class="adteselect1">
  			        <select id="sel2" class="form-control" name="select_year">
  			        	<?php echo $option;?>
  			        </select>
  			    </div>
  			    <div class="clearfix"></div>
  			    <div class="adudiv">
  			     	<input type="hidden" name="productID" value="PRODUCT" id="productID">
	                  <input type="hidden" name="product_code" value="<?=$search_params['product_code']?>">

	                
	                  <input type="hidden" name="search_id" value="<?=$search_params['search_id']?>">

	                   <input type="hidden" name="get_date" value="" id="get_date">
	                   <input type="hidden" name="get_month" value="" id="get_month">
	                   <input type="hidden" name="get_year" value="" id="get_year">
	                   
	                   <input type="hidden" name="ResultToken" value="<?=$search_params['ResultToken']?>">
	                  

	                   <input type="hidden" name="booking_source" value="<?=$search_params['booking_source']?>">

  			    	 <input type="hidden" name="max_count" value="<?=$search_params['max_count']?>">

  			    	<input type="hidden" name="" id="total_age_band" value="<?=count($age_band_arr);?>">


  			    	<input type="hidden" name="op" value="check_tourgrade">

                 <input type="hidden" name="age_band" value="<?=$search_params['age_band']?>"> 

                  

                   <input type="hidden" name="product_title" value="<?=$tourgrade_list['ProductDetails']['ProductName']?>">

                   <input type="hidden" name="product_image" value="<?=$tourgrade_list['ProductDetails']['ProductImage']?>">


                   <?php foreach($age_band_arr as $key=>$age_band):?> 
                       <div class="linesdt">
                         <label><?=$age_band->description?> (<span>Age <?=$age_band->ageFrom?> to <?=$age_band->ageTo?></span>) </label>
                       </div>
                       <div class="linesdt1">                    
                         <div class="adultlabdiv">
                            <input type="hidden" name="<?=$age_band->description?>_Band_ID" value="<?=$age_band->bandId?>">
                            <input type="hidden" name="<?=$age_band->description?>_count" value="<?=$age_band->count?>">
                            <input type="hidden" name="<?=$age_band->description?>_treat" value="<?=$age_band->treatAsAdult?>">

                            <select class="form-control travel-count" id="sel_<?=$key?>" name="no_of_<?=$age_band->description?>">
                             <?php for ($a=0; $a <=$search_params['max_count'] ; $a++) { ?>     
                             		                     
                              		<option value="<?=$a?>" <?php echo ($search_params['no_of_'.$age_band->description]==$a)?'selected':'';?> ><?=$a?></option>
                              <?php }?>
                           </select>
                         </div>
                       </div> 
                    <?php endforeach;?>		  			      
  			    </div>
  			    <button  id="update-price" class="btn btn-primary">Update Option</button>
  			  </div>
     		</form>
        </div>
      </div>
      <div class="col-md-9 zyx actresdv">

       <div class="pidaydiv1">
         <h2>Tour/Activity Options</h2>
        </div>
        <?php if(isset($tourgrade_list['Message'])&&!empty($tourgrade_list['Message'])):?>
        		<div class="tourguidiveut">
        			<p><?=implode(",", $tourgrade_list['Message']);?></p>
        			<p>Please Change the date</p>
        		</div>
        <?php else:?>
        		
        <?php foreach($tourgrade_list['Trip_list'] as $t_key=>$t_value): ?>
        	<?php 
        		$class='hide_grade';
        		if($t_value['available']==true){
        			$class = 'show_grade';
        		}
        	?>

	       <div class="tourguidiveut <?=$class?>">
		      	<div class="light-border-t mbl">
		            <div class="line light-border-b option-row">
		               <div class="unit size1of4">
		                <p class="mas"><span class="strong"><?=$t_value['gradeTitle']?></span><br><span class="xsmall hint">Code: <?=$t_value['gradeCode']?></span></p>
		               </div>

		               <div class="unit size1of2">
		               <p class="mhs mvs">Description: <?=$t_value['gradeDescription']?></p>
		               <?php if($t_value['gradeDepartureTime']):?>
		               		 <p class="mhs mvs green-color">DepartureTime: <?=$t_value['gradeDepartureTime']?></p>
		               <?php endif;?>
		               <p class="mhs">Total Traveler: <?=$t_value['TotalPax']?></p>
		               	<?php if(!empty($t_value['unavailableReason'])):?>
		               			<p>We're Sorry This option is not available</p>

		               	<?php endif;?>
		               	<?php if(isset($t_value['ageBandsRequired'])):?>
		               		<?php 

		               			foreach ($t_value['ageBandsRequired'] as $key => $value) {
		               				foreach ($value as $c_key => $c_value) {
		               					if(empty($c_value['maximumCountRequired'])){
		               						$text = ' more ';
		               					}else{
		               						$text = $c_value['maximumCountRequired'];
		               					}
		               					echo '<p>Traveller Count Start from '.$c_value['minimumCountRequired'].' to '.$text.' '.$passenger_arr[$c_key].' Required.</p>';
		               				}
		               			}
		               		?>
		               	<?php endif;?>
		               
		                <?php if(isset($t_value['langServices'])):?>
		                <div class="lang">
		                	<p>Language Service : <?php echo implode(",",$t_value['langServices']);?></p>
		                </div>
		            <?php endif;?>
		               </div>
		               <?php if($t_value['available']==true){?>
		               
		               <div class="txtR mas line">

		                 <div class="price-from">From <?php echo $currency_obj->get_currency_symbol($currency_obj->to_currency); ?> </div>
		                 <div class="h2 strong"><?=$t_value['Price']['TotalDisplayFare']?></div>

		                <div class="">
		                 <form method="post" action="<?=base_url()?>index.php/sightseeing/booking"> 

		                <input type="hidden" name="booking_source" value="<?=$search_params['booking_source']?>">

		                <?php 
		                	if(isset($search_params['search_params'])):
		                ?>
		            		<input type="hidden" name="search_params" value="<?=$search_params['search_params']?>">

		            	<?php else:?>
		            		<input type="hidden" name="additional_info" value="<?=$search_params['additional_info']?>">
		            		<input type="hidden" name="inclusions" value="<?=$search_params['inclusions']?>">
	            			<input type="hidden" name="exclusions" value="<?=$search_params['exclusions']?>">
            				<input type="hidden" name="short_desc" value="<?=$search_params['short_desc']?>">
            				<input type="hidden" name="voucher_req" value="<?=$search_params['voucher_req']?>">
		            	<?php endif;?>
		            	
	                  	<input type="hidden" name="search_id" value="<?=$search_params['search_id']?>">

                        <input type="hidden" name="product_code" id="product_code" value="<?=$tourgrade_list['ProductDetails']['ProductCode']?>">

		                 <input type="hidden" name="product_title" id="product_code" vlaue="<?=$tourgrade_list['ProductDetails']['ProductName']?>">

		                 <input type="hidden" name="grade_title" id="grade_title" value="<?=$t_value['gradeTitle']?>">

		                 <input type="hidden" name="grade_code" id="grade_code" value="<?=$t_value['gradeCode']?>">

		                 <input type="hidden" name="grade_desc" id="grade_desc" vlaue="<?=$t_value['gradeDescription']?>">
		                 <input type="hidden" name="booking_date" id="booking_date" value="<?=$t_value['bookingDate']?>">

				         <input type="hidden" name="tour_uniq_id" value="<?=$t_value['TourUniqueId']?>">

				         <input type="hidden" name="age_band" id="age_band_<?=$t_key?>" value="<?php echo base64_encode(json_encode($t_value['AgeBands']))?>">

				        <input type="hidden" name="op" value="block_trip">
		                <button type="submit"  class="btn btn-primary sight_book">Book</button>
		                </form>
		                </div>
		               </div>
		               <?php } ?>
		            </div>
		        </div>
	       </div> 
	    <?php endforeach; ?>
	<?php endif;?>
      </div>
    </div>
  </div>
</div>
<?php
	
	$selected_date_str = base64_encode(json_encode($product_date_arr,JSON_FORCE_OBJECT));
	
?>
<script>
  $( function() {	
  		var product_selected_date_str= "<?php echo $selected_date_str?>";
  		var selected_date = "<?php echo $search_params['select_month'];?>";
  		var selected_year = "<?php echo $search_params['select_year']?>";
  		var  product = "<?php echo $search_params['product_code']?>";
  		$.ajax({
  			type:'post',
			url:"<?php echo base_url()?>"+'index.php/sightseeing/select_date',
            data:{
              selected_date:selected_year,s_date:selected_date,available_date:product_selected_date_str
            },
            success:function(res){
              if(res){
                $("#sel1").html(res);
              }
            },
            error:function(res){
              console.log("Selected Month Ajax Error");
            }
  		});
   			 //$( "#tourgarde" ).datepicker();

   		 	var selecteddte = "<?=$booking_date?>"
		     var start = new Date(selecteddte);
		    start.setFullYear(start.getFullYear());
		    var end = new Date();
		    end.setFullYear(end.getFullYear()+2);
		  
		    $( "#tourgarde" ).datepicker({
		        minDate: start,
		        maxDate: end,
		        
		        yearRange: start.getFullYear() + ':' + end.getFullYear(),
		        onClose: function( selectedDate ) {
		         // var date1 = $('#activitydate').datepicker('getDate');
		           var date = $(this).datepicker('getDate'),
		           day  = date.getDate();
		           month = date.getMonth();       
		           two_digit_month = ("0" + (date.getMonth() + 1)).slice(-2);      
		           year =  date.getFullYear();
		           
		            $("#get_date").val(day);
		            $("#get_month").val(two_digit_month);
		            $("#get_year").val(year);
		           var options = '';
		           var monthNames = ["Jan", "Feb", "Mar", "April", "May", "June",
		              "July", "Aug", "Sep", "Oct", "Nov", "Dec"
		            ];

		           for (var i = day; i <=31; i++) {
		             options +='<option value='+i+'>'+i+'</option>';
		           }
		          var end_year = end.getFullYear();
		           var year_option = '';
		           for(var j=year ; j<=end_year;j++){
		              
		              for (var k =month ; k<12; k++) {
		                  var two_d_month = k+1;
		                  if(two_d_month>=10){
		                    two_d_month = (k+1);
		                  }else{
		                    two_d_month = '0'+(k+1);
		                  }
		                  year_option +='<option value='+j+'-'+two_d_month+'>'+monthNames[k]+' '+j+'</option>'  
		              }
		              month=1;
		              
		            
		           }
		           $("#sel2").html(year_option);
		           $("#sel1").html(options);

		        } 

		    });

		    $("#sel1").change(function(){
		      $("#get_date").val('');
		    });
		    $("#sel2").change(function(){

		        $("#get_month").val('');
		        $("#get_year").val('');
		        var selected_month_value = $("#sel2 option:selected").val();
		        var product = "<?=$search_params['product_code']?>";
		        $.ajax({
		        	type:'post',
		            url:"<?php echo base_url()?>"+'index.php/sightseeing/select_date',
		            data:{
		              selected_date:selected_month_value,available_date:product_selected_date_str
		            },
		            success:function(res){
		              if(res){
		                $("#sel1").html(res);
		              }
		            },
		            error:function(res){
		              console.log("Selected Month Ajax Error");
		            }
		        });
		        
		    });
		    $("#update-price").click(function(){
		    	 var total_adult = $("select[name=no_of_Adult] option:selected").val();
		    	//console.log("total_adult"+total_adult);
		        var age_band_count = $("#total_age_band").val();
		        var max_traveller = "<?php echo $search_params['max_count']?>";
		        var total_count = 0;
		        for (var i = 0; i < age_band_count; i++) {
		            total_count = parseInt(total_count) +parseInt($("#sel_"+i).val());
		        }
		        if(total_count==0){
		          alert('Please select Passenger');
		          return false;  
		        }
		        else if(total_adult == 0){
		          alert("Minimum One Adult is required for this trip.Please select Adult count");
		          return false;
		        }
		        else if(total_count>max_traveller){
		          alert("You have selected extra Travellers for This Sightseeing");
		          return false;
		        }
		        
		    });
  } );

  	
</script>
