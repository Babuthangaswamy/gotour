<?php 
  //debug($product_details);exit;
 //debug($product_details['available_date']);
  $last_year_arr =  end($product_details['Product_available_date']);
  $end_year = key($product_details['Product_available_date']);
  $end_year_date = end($last_year_arr);  
  $start_date_arr = reset($product_details['Product_available_date']);
  $star_month_year = key($product_details['Product_available_date']);
  $start_date_picker = reset($start_date_arr);
 Js_Loader::$js[] = array('src' => $GLOBALS['CI']->template->template_js_dir('page_resource/sightseeing_details_slider.js'), 'defer' => 'defer');
 Js_Loader::$css[] = array('href' => $GLOBALS['CI']->template->template_css_dir('owl.carousel.min.css'), 'media' => 'screen');
 Js_Loader::$js[] = array('src' => $GLOBALS['CI']->template->template_js_dir('owl.carousel.min.js'), 'defer' => 'defer'); 

 $product_available_date =$product_details['Product_available_date'];
?>

<div class="outactdiv">
          <?php 
            $a=4;
            $b=5;
            $show_picture='style=display:none';
            $show_video ='style=display:none';
            if($a==$b){
               $show_video='';
               $show_picture='style=display:none';
            }else{               
               $show_picture='';
            }
          ?>
         

          <div id="actvdeo" <?=$show_video?> >
            <video width="100%" controls>
              <source src="<?php echo $GLOBALS['CI']->template->template_images('video/video3.mp4'); ?>" type="video/mp4">
              Your browser does not support HTML5 video.
            </video>  
          </div>
          
            <div class="more_pic" <?=$show_video?>><i class="far fa-images"></i> See More Photos
            </div> 
         
             <div id="act_sldr" <?=$show_picture?> >
               <div id="hotel_top" class="owl-carousel owl-theme act_carsl owl-theme">                                                                                      
                    <?php if(isset($product_details['ProductPhotos'])):?> 
                    <?php foreach($product_details['ProductPhotos'] as $photos):?>     

                        <div class="item">                                            
                        <img src="<?=$photos['photoHiResURL']?>" alt="<?=@$photos['caption']?>"> 
                        </div>
                  <?php endforeach;?>
                  <?php endif; ?>                             
              </div> 
            </div>              
            <div class="more_vdeo" <?=$show_video?> ><i class="far fa-images"></i> See Video
            </div> 
             
  <div class="container">
     <div class="col-md-12 nopad">
      <div class="col-md-8">
         <div class="masthead-wrapper act_wrp">
           <div class="light-border">
             <h1><a href="#"><?=$product_details['ProductName']?></a></h1>
               <?php
                if(empty($product_details['ReviewCount']))
                {
                  $product_details['ReviewCount'] = 0;
                }
              ?>
              <ul class="std">
                <?php 
                
                  for($i=1;$i<=5;$i++)
                   {
                     if($i > $product_details['ReviewCount'])
                     {
                       ?>
                        <li><i class="fa fa-star clr" aria-hidden="true"></i></li>
                      <!-- <li><i class="fa fa-star-o" aria-hidden="true"></i></li>-->
                    <?php }
                      if($i <= $product_details['StarRating'])
                      { 
                ?>
                       <li><i class="fa fa-star" aria-hidden="true"></i></li>
               <?php } } 
                   ?>
               &nbsp; 
               <?php 
               //$product['reviewCount'] = 5;
               if(!empty($product_details['ReviewCount']))
               {
               ?>
               <li><span class="rcount"><?=$product_details['ReviewCount']?> Reviews</span></i></li>
               
               <?php }
               else { ?>
                 
                 <li><span class="rcount">0 Reviews</span></i></li>
                 <?php }?>
                  &nbsp; 
               <?php 
               //$product['reviewCount'] = 5;
               if(!empty($product_details['ProductCode']))
               {
               ?>
                 <li><span class="review">Tour code : <?php echo $product_details['ProductCode'];?></span></i></li>
               
               <?php }?>
              </ul>
            <!--  <ul class="actstardiv">
             
               <li><i class="fa fa-star" aria-hidden="true"></i></li>
              
             </ul> -->
             <div class="clearfix"></div>
             <ul class="locdurdiv">
              <li>Location: <?=$product_details['Location']?></li>
              <?php if($product_details['Duration']):?>
                  <li> Duration:<span><?=$product_details['Duration']?></span>(approx.)</li>
              <?php endif;?>
             </ul>
             <div class="col-md-12 actimgdiv">
               <div id="holidaySliderone" class="holiySlide hide">
                <?php if(isset($product_details['ProductPhotos'])):?>
                   
                  <?php foreach($product_details['ProductPhotos'] as $photos):?>                      
                        <div class="item">
                           <img src="<?=$photos['photoHiResURL']?>" alt="<?=@$photos['caption']?>"/>
                        </div>
                 <?php endforeach;?>
                <?php endif; ?>
               </div>

               <div class="htldtdv">                              
  <!--
                                                                 
             <div id="hotel_bottom" class="owl-carousel owl-theme">
  <?php if(isset($product_details['ProductPhotos'])):?> 
  <?php foreach($product_details['ProductPhotos'] as $photos):?>
    <div class="item">                                                 
      <img src="<?=$photos['photoHiResURL']?>" alt="<?=@$photos['caption']?>">                                            
    </div>  
     <?php endforeach;?>
    <?php endif; ?>                                                                                                  
             </div>   
-->
        </div>

        <div class="clearfix"></div>
        <div class="basic_info">
        <ul class="list-inline">
        <li><img src="<?php echo $GLOBALS['CI']->template->template_images('free_cancellation.svg'); ?>" alt="icon" />Free Cancelation - 24 Hrs Notice</li>
        <li><img src="<?php echo $GLOBALS['CI']->template->template_images('show_mobile.svg'); ?>" alt="icon" /> Show Mobile or Printed Voucher</li>
        <li><img src="<?php echo $GLOBALS['CI']->template->template_images('duration.svg'); ?>" alt="icon" /> 14 Hrs Duration</li>
        <li><img src="<?php echo $GLOBALS['CI']->template->template_images('language.svg'); ?>" alt="icon" /> English</li>
        <li><img src="<?php echo $GLOBALS['CI']->template->template_images('join_group.svg'); ?>" alt="icon" /> Join In Group</li>
        <li><img src="<?php echo $GLOBALS['CI']->template->template_images('meet_up.svg'); ?>" alt="icon" /> Meet Up At Location</li>
        </li>
        </ul>
        </div>
        <div class="clearfix"></div>

       <div class="col-md-12 col-xs-12 nopad">
         <div class="ovrimpdiv">
           <ul class="nav nav-pills">
             <li class="active full_mobile"><a data-toggle="pill" href="#home"><i class="fal fa-list-alt"></i> Overview</a></li>
             <li class="full_mobile"><a data-toggle="pill" href="#menu1"><i class="fal fa-info-circle"></i> Important Info</a></li>
             <li class="full_mobile"><a data-toggle="pill" href="#menu2"><i class="fal fa-smile"></i> Review</a></li>
           </ul>
  
           <div class="tab-content">
             <div id="home" class="tab-pane fade in active">
               <p><?=$product_details['Description']?></p>
             </div>


             <div id="menu1" class="tab-pane fade">
                <h3><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;Details</h3>
                <div class="cms-content mtm"> 
                  <p>Description : <?=$product_details['ShortDescription']?></p>
                <div class="mvm"> 
                   <div class="strong"> <p>Maximum Traveller : <?=$product_details['MaxTravellerCount']?></p></div>
                </div>                 
                <div class="mvm"> 
                   <div class="strong">Voucher Information</div>
                  <p><?=$product_details['Voucher_req'];?></p>
                </div>
                <?php if(isset($product_details['Itinerary'])):?>
                  <?php if($product_details['Itinerary']):?>
                      <div>
                         <div class="strong">Itinerary</div>
                          <p><?=$product_details['Itinerary']?></p>
                      </div>
                   <?php endif;?>
                <?php endif;?>
                  <?php if(isset($product_details['Inclusions'])): ?>
                     <?php if($product_details['Inclusions']):?>
                  <div class="mvm">                      
                      <div class="strong">Inclusions</div>
                      <ul>
                        <?php foreach($product_details['Inclusions'] as $include):?>  <li><?=$include?></li>
                        <?php endforeach;?> 
                      </ul>                        
                  </div> 
                    <?php endif;?>
                 <?php endif;?>
                 <?php if(isset($product_details['Exclusions'])): ?>
                    <?php if($product_details['Exclusions']):?>
                      <div class="mvm">                      
                          <div class="strong">Exclusions</div>
                          <ul>
                            <?php foreach($product_details['Exclusions'] as $exclude):?>  <li><?=$exclude?></li>
                            <?php endforeach;?> 
                          </ul>                        
                      </div>
                    <?php endif;?> 
                 <?php endif;?>
                  <?php if(isset($product_details['SalesPoints'])): ?>
                    <?php if($product_details['SalesPoints']): ?>
                  <div class="mvm">                      
                      <div class="strong">HighLights</div>
                      <ul>
                        <?php foreach($product_details['SalesPoints'] as $sales):?>  <li><?=$sales?></li>
                        <?php endforeach;?> 
                      </ul>                        
                  </div> 
                  <?php endif;?>
                 <?php endif;?>

                 <?php if(isset($product_details['TermsAndConditions'])): ?>
                  <?php if($product_details['TermsAndConditions']):?>
                  <div class="mvm">                      
                      <div class="strong">TermsAndConditions</div>
                      <ul>
                        <?php foreach($product_details['TermsAndConditions'] as $terms):?>  <li><?=$terms?></li>
                        <?php endforeach;?> 
                      </ul>                        
                  </div> 
                  <?php endif;?>
                 <?php endif;?>
                  <?php if(isset($product_details['Highlights'])): ?>
                    <?php if($product_details['Highlights']):?>
                      <div class="mvm">                      
                          <div class="strong">Highlights</div>
                          <ul>
                            <?php foreach($product_details['Highlights'] as $hight):?>  <li><?=$hight?></li>
                            <?php endforeach;?> 
                          </ul>                        
                      </div> 
                    <?php endif;?>
                 <?php endif;?>
             
                 <?php if(isset($product_details['AdditionalInfo'])): ?>
                    <?php if($product_details['AdditionalInfo']): ?>
                  <div class="mvm">                      
                      <div class="strong">AdditionalInfo</div>
                      <ul>
                        <?php foreach($product_details['AdditionalInfo'] as $info):?>  <li><?=$info?></li>
                        <?php endforeach;?> 
                      </ul>                        
                  </div>
                <?php endif;?>
                 <?php endif;?>
               </div> 

               <div class="clearfix"></div>

               <h3 class=""><i class="fa fa-question-circle " aria-hidden="true"></i>&nbsp;Cancellation Policy</h3>               
                 <div class="cms-content mtm ">
                  <div class="mvm">
                  <ul>
                    <li><?php echo $product_details['Cancellation_Policy'];?></li>                    
                  </ul>                 
                  </div>
                 </div>
              
               <h3><i class="fa fa-pencil-square" aria-hidden="true"></i>&nbsp;Schedule and Pricing</h3>
               <div class="cms-content mtm">
                <div class="mvm">
                      <?php if($product_details['DeparturePoint']):?>
                      <p>Departure Point : <?=$product_details['DeparturePoint']?> </p>       
                    <?php endif;?>
                      <?php if($product_details['DepartureTime']):?>
                          <p>Departure time : <?=$product_details['DepartureTime']?></p> 
                      <?php endif;?>                 
                      <?php if($product_details['DepartureTimeComments']):?>
                        <p>DepartureTimeComments : <?=$product_details['DepartureTimeComments']?> </p>
                      <?php endif;?>   
                      <?php if($product_details['Duration']):?>
                      <p>Duration : <?=$product_details['Duration']?></p>
                    <?php endif; ?>
                      <?php if($product_details['ReturnDetails']):?>
                      <p>Return Details : <?=$product_details['ReturnDetails']?></p>
                      <?php endif;?>
                     
                </div>
               </div>
               <div class="clearfix"></div>                             
             </div>
             <div id="menu2" class="tab-pane fade">
              <?php if($product_details['Product_Reviews']):?>
                <h3><i class="fal fa-smile"></i>&nbsp;Customer Reviews</h3>
                  <?php foreach($product_details['Product_Reviews'] as $review):?>
                     <div class="revoutdiv">
                        <div class="reviewdv">    
                          <?php if(isset($review['UserImage'])):?>
                              <img src="<?=$review['UserImage']?>" alt="Avatar"/>
                          <?php else:?>           
                            <img src="<?=$GLOBALS['CI']->template->template_images('sadimg.png')?>" alt="Avatar"/>
                          <?php endif;?>
                        </div>
                          <div class="contdivrew1">
                              <h5><?=$review['UserName']?></h5>
                             <div class="rewstar">
                              <ul class="rewstardv">
                                  <?php for($r=1;$r<=$review['Rating'];$r++):?>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                              <?php endfor;?>
                              </ul>
                              <span class="xsmall"><?php echo date('l\, jS F Y',strtotime($review['Published_Date']));?></span>
                             </div>
                             <p><?=$review['Review']?></p>
                          </div>
                      </div>
                    <?php endforeach;?>
                  <?php else:?>
                      <p>No Reviews</p>
                <?php endif;?>  
                </div>
          </div>
         </div>
       </div>


             </div>
           </div>
         </div>
      </div>
      <div class="col-md-4 nopad">
         <div class="frmdiv">
           <div class="booking-price">
             <span class="price-from">Best Price From </span>
             <span class="price-amount price-amount-l">
             <span class="currency-sign"><?php echo $currency_obj->get_currency_symbol($currency_obj->to_currency); ?></span>
                <span class="currency-amount"><?=$product_details['Price']['TotalDisplayFare']?></span>
             </span>
           </div>
            <form method="post" action="<?php echo base_url()?>index.php/sightseeing/select_tourgrade">
               <div class="datediv">
                
                <!--  <div class="adteselect"> 
                      <input type="text" name="select_date" value="" id="">
                 </div> -->
                 
                <?php //echo date("d");?>
                <!-- <div class="adteselect">
                 <select class="form-control" id="sel1" name="select_month">
                  <?php foreach($start_date_arr as $s_key=>$s_value):?>
                      <option value="<?=$s_value?>"><?=$s_value?></option>
                  <?php endforeach;?>
                
                 </select>
                </div> -->
<!--                 <div class="adteselect1">
<?php
    //$date = date('Y-m-d');
    $date =$star_month_year.'-'.$start_date_picker;
    $start = $month = strtotime($date);                    
    $end_year_details = $end_year.'-'.$end_year_date;                  
    $end_date = date($end_year_details);
    $end = strtotime($end_date);
    $option = '';
    // echo $star_month_year;exit;
    while($month < $end)
    {   
        //echo "ince".$month.'<br/>';
         $option .= '<option value='.date('Y-m', $month).'>'.date('M Y', $month).'</option>';
         $month = strtotime("+1 month", $month);
    }
   
    
 ?>

 <select class="form-control" id="sel2" name="select_year" >
      <?php echo $option;?>
 </select>
</div> -->
                <div class="clearfix"></div>
                <input type="hidden" name="max_count" value="<?=$product_details['MaxTravellerCount']?>">
                 <input type="hidden" name="all_passenger_name_req" value="<?=$product_details['AllTravellerNamesRequired']?>">

                <div id="prc_rght" class="collapse">
                 <div class="outdate">
                   <input type="text" class="form-control outdatadiv" id="activitydate">
                  <input type="hidden" name="productID" value="PRODUCT" id="productID">
                  <input type="hidden" name="product_code" value="<?=$product_details['ProductCode']?>">
                  
                  <input type="hidden" name="ResultToken" value="<?=$product_details['ResultToken']?>">
                  <input type="hidden" name="search_id" value="<?=$search_id?>">

                  <input type="hidden" name="booking_engine" value="<?=$product_details['BookingEngineId']?>">

                   <input type="hidden" name="get_date" value="" id="get_date">
                   <input type="hidden" name="get_month" value="" id="get_month">
                   <input type="hidden" name="get_year" value="" id="get_year">
                   <input type="hidden" name="op" value="check_tourgrade">

                 <input type="hidden" name="age_band" value="<?=base64_encode(json_encode($product_details['Product_AgeBands']))?>">

                   <input type="hidden" name="booking_source" value="<?=$active_booking_source?>">
                   <?php 
                      //debug($product_details['bookingQuestions']);exit;
                   ?>                  
                    <input type="hidden" name="additional_info" value="<?=base64_encode(json_encode($product_details['AdditionalInfo']))?>">
                   <input type="hidden" name="inclusions" value="<?=base64_encode(json_encode($product_details['Inclusions']))
                   ?>">
                   <input type="hidden" name="voucher_req" value="<?=base64_encode($product_details['Voucher_req']);?>">

                   <input type="hidden" name="exclusions" value="<?=base64_encode(json_encode($product_details['Exclusions']))?>">
                   <input type="hidden" name="short_desc" value="<?=base64_encode($product_details['ShortDescription'])?>">

                 </div>
                 <div class="adudiv">
                 <?php
                  //debug($product_details['ageBands']);exit;
                 ?>
                  <div class="travel-title"><p>Travelllers</p></div>
                  <input type="hidden" name="" id="total_age_band" value="<?=count($product_details['Product_AgeBands']);?>">
                   <?php foreach($product_details['Product_AgeBands'] as $key=>$age_band):?> 
                       <div class="linesdt">
                         <label><?=$age_band['description']?> (<span>Age <?=$age_band['ageFrom']?> to <?=$age_band['ageTo']?></span>) </label>
                       </div>
                       <div class="linesdt1">                    
                         <div class="adultlabdiv">
                            <input type="hidden" name="<?=$age_band['description']?>_Band_ID" value="<?=$age_band['bandId']?>">
                            <input type="hidden" name="<?=$age_band['description']?>_count" value="<?=$age_band['count']?>">
                            <input type="hidden" name="<?=$age_band['description']?>_treat" value="<?=$age_band['treatAsAdult']?>">

                            <select class="form-control travel-count" id="sel_<?=$key?>" name="no_of_<?=$age_band['description']?>">
                             <?php for ($a=0; $a <=$product_details['MaxTravellerCount'] ; $a++) { ?>                             
                              <option value="<?=$a?>" ><?=$a?></option>
                              <?php }?>
                           </select>
                         </div>
                       </div> 
                    <?php endforeach;?>
                 </div>
                </div>
                <div class="clearfix"></div>
                 <div class="patendiv">
                   <button  class="patencls" id="check-avil-btn">Check Availability</button>
                 </div> 
                <div class="clearfix"></div>
                <div class="spc_list">
                <ul> 
                <li><i class="fas fa-clock"></i> Earliest available date: 25 May 2018</li>
                <li><i class="fas fa-thumbs-up"></i> Instant Confirmation</li>
                <li>Special Offer: <span>Book and save 20% compared to the local supplier's prices for a 2-day pass!</span></li>
              </form>
           </div>
         </div>
      </div>
     </div>
  </div>
</div>
<?php
 
  $selected_date_str =  base64_encode(json_encode($product_available_date,JSON_FORCE_OBJECT));
 
?>

<script> 
  $( function() {
     var product_available_date_obj = "<?php echo $selected_date_str?>";

    var selecteddte = "<?=$star_month_year?>"+'-'+"<?=$start_date_picker?>"
     var start = new Date(selecteddte);
    start.setFullYear(start.getFullYear());
    var end = new Date();
    end.setFullYear(end.getFullYear()+2);
      
    $( "#activitydate" ).datepicker({
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
        var product = "<?=$product_details['ProductCode']?>";
        $.ajax({
            
            type:'post',
            url:"<?php echo base_url()?>"+'index.php/sightseeing/select_date',
            data:{
              selected_date:selected_month_value,available_date:product_available_date_obj
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
    $("#check-avil-btn").click(function(){
       var total_adult = $("select[name=no_of_Adult] option:selected").val();
        var age_band_count = $("#total_age_band").val();
        var max_traveller = "<?php echo $product_details['MaxTravellerCount']?>";
        var total_count = 0;
        for (var i = 0; i < age_band_count; i++) {
            total_count = parseInt(total_count) +parseInt($("#sel_"+i).val());
        }
        if(total_count==0){
          alert('Please select Passenger');
          return false;  
        }else if(total_adult == 0){
          alert("Minimum One Adult is required for this trip.Please select Adult count");
          return false;
        }
        else if(total_count>max_traveller){
          alert("You have selected extra Travellers for This Sightseeing");
          return false;
        }
        
    });
  });
 
$(document).ready(function(){
        $(".more_vdeo").hide();
    $(".more_pic").click(function(){
        $("#act_sldr").show();
        $(".more_vdeo").show();
        $("#actvdeo").hide();
        $(".more_pic").show();
        //alert();
    });
    $(".more_vdeo").click(function(){
        $("#actvdeo").show();
        $(".more_pic").show();
        $("#act_sldr").hide();
        $(".more_vdeo").hide();
    });

});
</script>





<?php
   // echo '<script>';
   // $script = 'console.log($("#sel2 option:selected").val())';
   // echo $script;
   // echo '</script>';
?>
