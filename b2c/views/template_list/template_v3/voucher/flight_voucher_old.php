<?php
$booking_details = $data ['booking_details'] [0];
//debug($booking_details);exit;
$itinerary_details = $booking_details ['booking_itinerary_details'];

$attributes = $booking_details ['attributes'];
$customer_details = $booking_details ['booking_transaction_details'] [0] ['booking_customer_details'];
$domain_details = $booking_details;
$lead_pax_details = $customer_details;
$booking_transaction_details = $booking_details ['booking_transaction_details'];
//debug($booking_transaction_details);exit;
$adult_count = 0;
$infant_count = 0;
//debug($customer_details);exit;
foreach ($customer_details as $k => $v) {
	if (strtolower($v['passenger_type']) == 'infant') {
		$infant_count++;
	} else {
		$adult_count++;
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
      <title>Flight E-Ticket</title>
   </head>
   <body>
      <table style="max-width: 500px; margin: 10px auto; border: 1px solid #dddddd;" width="800" border="0" align="center" cellpadding="0" cellspacing="0" >
         <tr>
            <td colspan="3" valign="top" align="center">
               <table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                     <td width="230" align="left" height="90"><img src="<?=$GLOBALS['CI']->template->domain_images($GLOBALS['CI']->template->get_domain_logo())?>" alt="logo"  border="0"  /></td>
                  </tr>
               </table>
            </td>
         </tr>
         <tr>
            <td width="979">
               <table width="98%" align="center" border="0" cellpadding="0" cellspacing="0" >
                  <tr>
                     <td>
                        <div align="center" class="farebreakup" style="font-size: 31px; color:#FFA500;">E-ticket</div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div class="spacer"></div>
                     </td>
                  </tr>
                  <tr>
                     <td class="inputtext" style="color:#000000;padding-left: 10px;">
                        <p>Dear <b><?=@$booking_details['lead_pax_name']?></b>,
                        <div class="spacer"></div>
                        Your Flight is confirmed. Your reference number is <font style="font-weight:bold;" color="#FFA500"><?=@$booking_details['app_reference']?> </font>Please
                        use this reference number for all future communications.</p>
                     </td>
                  </tr>
                  <tr>
                  <td>
                   <div align="left" class="farebreakup" style="font-size: 15px; "><strong>Booked On :</strong>
                        <?=@$booking_details['booked_date']?>
                        </div>
                        <div align="left" class="farebreakup" style="font-size: 15px; "><strong>Trip Type :</strong>
                        <?=@ucfirst($booking_details['trip_type_label'])?>
                        </div>
                  </td>
                  </tr>
                  <tr>
                     <td colspan="10" valign="top">
                        <table border="1" style="border:1px solid #B2B2B2;margin-left:10px; border-collapse:collaps" width="98%" cellpadding="2" cellspacing="0">
                           <tr>
                              <td align="center" style="border-right: 1px solid #000000;"><strong class="hoteltext" style="color:#000000;">Airline</strong></td>
                              <td align="center" style="border-right: 1px solid #000000;"><strong class="hoteltext" style="color:#000000;">Flight No</strong></td>
                              <td align="center" style="border-right: 1px solid #000000;"><strong class="hoteltext" style="color:#000000;">Airline PNR</strong></td>
                              <td align="center" style="border-right: 1px solid #000000;"><strong class="hoteltext" style="color:#000000;">Departure Date &amp; Time</strong></td>
                              <td align="center" style="border-right: 1px solid #000000;"><strong class="hoteltext" style="color:#000000;">Arrival Date &amp; Time</strong></td>
                              <td align="center" style="border-right: 1px solid #000000;"><strong class="hoteltext" style="color:#000000;">From</strong></td>
                              <td align="center"><strong class="hoteltext" style="color:#000000;">To</strong></td>
                           </tr>
                           <!-- Loop starts passenger-->
                           <?php 
                           if(isset($booking_transaction_details) && $booking_transaction_details != ""){
                           //$temp_booking_transaction_details = array_shift($booking_transaction_details);
                           foreach($itinerary_details as $segment_details_k => $segment_details_v){
                           	
                           	//$segment_details_v = $v['segment_details'];
                           	if(valid_array($segment_details_v) == true) { ?>
	                           	<?php if($booking_details['trip_type'] == 'circle' && $booking_details['is_domestic'] == true){?>
	                           <!-- 
	                           FIXME: Pravin
	                           <tr>
	                           		<td colspan="7"align="center" style="border-right: 1px solid #000000;">
	                           			<strong class="hoteltext" style="color:#000000;"><?=$trip_direction_label?> Flight - PNR: <?//=@$temp_booking_transaction_details[$k]['pnr'] ?> </strong>
	                           		</td>
	                           	</tr>
	                           	 -->
	                           <?php }?>
	                           		
	                           <tr>
	                              <td align="center" style="color:#000000; border-top:1px solid #000000; border-right: 1px solid #000000;"><img src="<?=SYSTEM_IMAGE_DIR.'airline_logo/'.$segment_details_v['airline_code'].'.gif'?>" alt="airline_logo"></td>
	                              <td width="15%"  class="normal" align="center" style="color:#000000; border-top:1px solid #000000; border-right: 1px solid #000000;"><?=@$segment_details_v['flight_number']?></td>
	                              <td width="15%"  class="normal" align="center" style="color:#000000; border-top:1px solid #000000; border-right: 1px solid #000000;"><?=@$segment_details_v['airline_pnr']?></td>
	                              <td width="25%" class="normal" align="center" style="color:#000000; border-right: 1px solid #000000;  border-top:1px solid #000000;" >
	                              <?php echo date("d M Y",strtotime($segment_details_v['departure_datetime'])).", ".date("H:i",strtotime($segment_details_v['departure_datetime']));?>
	                              </td>
	                              <td width="25%" class="normal" align="center" style="color:#000000;  border-top:1px solid #000000; border-right: 1px solid #000000;">
	                              <?php echo date("d M Y",strtotime($segment_details_v['arrival_datetime'])).", ".date("H:i",strtotime($segment_details_v['arrival_datetime']));?>
	                              </td>
	                              <td width="15%" class="normal" align="center" style="color:#000000;  border-top:1px solid #000000; border-right: 1px solid #000000;">
	                              <?=@$segment_details_v['from_airport_code'].'</br>'.@$segment_details_v['from_airport_name'] ?>
	                              </td>
	                              <td width="15%" class="normal" align="center" style="color:#000000;  border-top:1px solid #000000;">
	                              <?=@$segment_details_v['to_airport_code'].'</br>'.@$segment_details_v['to_airport_name'] ?>
	                              </td>
	                           </tr>
                           	<?php }
                           	}
                           	}?>
                           <!-- Loop ends passenger-->
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div class="spacer"></div>
                     </td>
                  </tr>
                  <tr>
                     <td colspan="10" valign="top" style="color:#000000">
                        <table border="1" width="98%" style="border:1px solid #B2B2B2;margin-left: 10px; border-collapse:collapse;" cellpadding="2" cellspacing="0">
                           <tr>
                              <td colspan="4" class="notice" style="color:#000000"><strong>Passenger Details:</strong></td>
                           </tr>
                           <!-- loop starts passenger-->
                            <?php foreach($booking_transaction_details as $key => $value){
                            	$trip_direction_label = '';
                            	if($key == 0 && count($booking_transaction_details) == 2) {
                            		$trip_direction_label = 'Onward ';
                            		
                            	} else if($key == 1){
                            		$trip_direction_label = 'Return';
                            	} ?>
                            
                           <tr>
                           		<td colspan="7"align="center" style="border-right: 1px solid #000000;">
                           			<strong class="hoteltext" style="color:#000000;"><?=$trip_direction_label?> Passenger(s)- PNR: <?=@$booking_transaction_details[$key]['pnr'] ?> </strong>
                           		</td>
                           	</tr>
                           	<tr>
                              <td width="25%" align="center" class="hoteltext" style="color:#000000;"><b>Name</b></td>
                              <td width="25%" align="center" class="hoteltext" style="color:#000000;"><b>Type</b></td>
                              <td width="25%" align="center" class="hoteltext" style="color:#000000;"><b>Ticket Id</b></td>
                              <td width="25%" align="center" class="hoteltext" style="color:#000000;"><b>Ticket Number</b></td>
                           </tr>
                           
                           <?php 
                           	foreach($value['booking_customer_details'] as $cus_k => $cus_v){ ?>
                           <tr>
                              <td align="center"class="normal" style="color:#000000;"><?=@$cus_v['title'].' '.@$cus_v['first_name'].' '.@$cus_v['last_name']?></td>
                              <td align="center" class="normal" style="color:#000000;"><?=@$cus_v['passenger_type']?></td>
                              <td align="center" class="normal" style="color:#000000;"><?=@$cus_v['TicketId']?></td>
                              <td align="center" class="normal" style="color:#000000;"><?=@$cus_v['TicketNumber']?></td>
                           </tr>
                            <?php 
                           	}
                           	}?>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div class="spacer"></div>
                     </td>
                  </tr>
                  <tr>
                     <td valign="top" >
                        <table  style="margin-left: 10px; border:1px solid #B2B2B2; border-collapse:collapse" width="98%" cellpadding="2" cellspacing="0" border="1">
                           <tr bgcolor="">
                              <td width="28%" align="left" height="22" style="border-right: 1px solid #000000;">
                                 <div class="hoteltext" align="left" style="color:#000000;"><strong>Transaction </strong></div>
                              </td>
                              <td width="72%">
                                 <div class="hoteltext" align="left" style="color:#000000;"><strong>Amount(<?=@$booking_details['currency']?>)</strong></div>
                              </td>
                           </tr>
                           <tr>
                              <td align="left" style="border-top:1px solid #000000; border-right: 1px solid #000000;">
                                 <div class="notice" align="left" style="color:#000000; width:86%;"> Total Amount</div>
                              </td>
                              <td style="border-top:1px solid #000000;">
                                 <div class="normal" align="left" style="color:#000000; text-align: left;"><?=@$booking_details['currency']?> <?=@$booking_details['grand_total']?></div>
                              </td>
                           </tr>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div class="spacer"></div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div class="spacer"></div>
                     </td>
                  </tr>
                  <tr>
                     <td valign="top">
                        <table style="margin-left: 10px;" width="98%" border="0" cellpadding="0" cellspacing="0">
                           <tr>
                              <td>&nbsp;</td>
                           </tr>
                           <tr>
                              <td class="normal1">
                                 <strong>Terms & Conditions:</strong>
                              </td>
                           </tr>
                           <tr>
                              <td class="normal"><strong>Flight</strong>
                                 - We're here to help! If you need assistance with your
                                 reservation, please visit our Help Center. For urgent
                                 situations,: such as check-in troubles or arriving to something
                                 unexpected
                              </td>
                           </tr>
                           <tr>
                              <td class="normal"><strong>Cancellation
                                 Policies</strong> - We're here to help! If you need assistance
                                 with your reservation, please visit our Help Center. For urgent
                                 situations,: such as check-in troubles or arriving to something
                                 unexpected
                              </td>
                           </tr>
                           <tr>
                              <td class="normal"><strong>Amendment
                                 Policies</strong> - We're here to help! If you need assistance
                                 with your reservation, please visit our Help Center. For urgent
                                 situations,: such as check-in troubles or arriving to something
                                 unexpected
                              </td>
                           </tr>
                        </table>
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
         <tr>
            <td>
               <div class="spacer"></div>
            </td>
         </tr>
         <tr>
            <td colspan="10" align="center">
               <div id="printOption" align="center">
                  <a href="javascript:void();" onclick="document.getElementById('printOption').style.visibility = 'hidden'; print(); return true;" class="farebreakup" style="color: #FFA500;">Print</a>
               </div>
            </td>
         </tr>
      </table>
      </td>
      </tr>
      </table>
   </body>
</html>
