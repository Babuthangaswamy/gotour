<style>
th,td{padding:5px;}
</style>
<?php
$booking_details = $data['booking_details'][0];
//echo debug($booking_details);
//exit;
$itinerary_details = $booking_details['itinerary_details'][0];
$attributes = $booking_details['attributes'];
//$customer_details = $booking_details['customer_details'][0];
$customer_details = $booking_details['customer_details'];
//debug($booking_details['customer_details']);exit;
$domain_details = $booking_details;
$lead_pax_details = $booking_details['customer_details'];
//debug($customer_details);exit;
?>
<div class="table-responsive" id="tickect_hotel">
<table style="border-collapse: collapse; background: #ffffff;font-size: 14px; margin: 0 auto; font-family: arial;" width="100%" cellpadding="0" cellspacing="0" border="0">
<tbody>
	<tr>
		<td style="border-collapse: collapse; padding:10px 20px 20px" >
			<table width="100%" style="border-collapse: collapse;" cellpadding="0" cellspacing="0" border="0">
				
				<tr>
					<td style="padding: 10px;">
						<table cellpadding="0" cellspacing="0" border="0" width="100%" style="border-collapse: collapse;">
						<tr><td style="font-size:22px; line-height:30px; width:100%; display:block; font-weight:600; text-align:center">E-Ticket</td></tr>
				<tr>
					<td>
			<table width="100%" style="border-collapse: collapse;" cellpadding="0" cellspacing="0" border="0"><tr>
					<td style="padding: 10px;width:65%;"><img style="max-height:56px;" src="<?=$GLOBALS['CI']->template->domain_images($data['logo'])?>"></td>
					<td style="padding: 10px;width:35%">
                    	<table width="100%" style="border-collapse: collapse;text-align: right; line-height:15px;" cellpadding="0" cellspacing="0" border="0">
                    		
                    		<tr>
                    		<td style="font-size:14px;"><span style="width:100%; float:left"><?php echo $data['address'];?></span>
                    		</td>
                    		</tr>
                         </table></td>
				</tr></table></td></tr>
							<tr>
								<td width="50%" style="padding: 10px;border: 1px solid #cccccc; font-size: 14px; font-weight: bold;">Hotel Booking Lookup</td>
							</tr>
							<tr>
								<td style="border: 1px solid #cccccc;">
									<table width="100%" cellpadding="5" style="padding: 10px;font-size: 13px;">
										<tr>
											<td><strong>Booking Reference</strong></td>
											<td><strong>Booking ID</strong></td>										
											<td><strong>Booking Date</strong></td>
											<td><strong>Status</strong></td>
										</tr>
										<tr>
											<td><?php echo $booking_details['app_reference']; ?></td>
											<td><?php echo $booking_details['booking_id']; ?></td>
											<td><?php echo date("d M Y",strtotime($booking_details['created_datetime'])); ?></td>
											
                                           <td>
                                           <strong class="<?php echo booking_status_label( $booking_details['status']);?>" style=" font-size:14px;">
											<?php 
											switch($booking_details['status']){
												case 'BOOKING_CONFIRMED': echo 'CONFIRMED';break;
												case 'BOOKING_CANCELLED': echo 'CANCELLED';break;
												case 'BOOKING_FAILED': echo 'FAILED';break;
												case 'BOOKING_INPROGRESS': echo 'INPROGRESS';break;
												case 'BOOKING_INCOMPLETE': echo 'INCOMPLETE';break;
												case 'BOOKING_HOLD': echo 'HOLD';break;
												case 'BOOKING_PENDING': echo 'PENDING';break;
												case 'BOOKING_ERROR': echo 'ERROR';break;
												
											}
											
																				
											?>
											</strong></td>
                                           
										</tr>
									</table>
								</td>
							</tr>
                            <tr><td>&nbsp;</td></tr>
							<tr>
								<td style="padding: 10px;border: 1px solid #cccccc; font-size: 14px; font-weight: bold;">Hotel Information</td>
								
							</tr>
							<tr>
								<td  width="100%" style="border: 1px solid #cccccc;">
									<table width="100%" cellpadding="5" style="padding: 10px;font-size: 13px;">
										<tr>
											<td width="10%"><strong>Hotel Name</strong></td>
											<td width="19%"><strong>Hotel Address</strong></td>
											<!-- <td><strong>Phone</strong></td> -->
											<td><strong>Check-In</strong></td>
											<td><strong>Check-Out</strong></td>
											<td><strong>No of Room's</strong></td>
											<td><strong>Room Type</strong></td>
											<td><strong>Adult's</strong></td>
											<td><strong>Children</strong></td>
										</tr>
										<tr>
                                        <td>
                                        <?php echo $booking_details['hotel_name']; ?>
                                        </td>
                                        <td style="line-height:16px">
                                        <?php echo $booking_details['hotel_address']; ?> 
                                        </td>
                                       
                                        <td><span style="width:100%; float:left"> <?=@date("d M Y",strtotime($itinerary_details['check_in']))?></span></td>
                                        <td><span style="width:100%; float:left"> 	<?=@date("d M Y",strtotime($itinerary_details['check_out']))?></span></td>
                                        <td align="center"><?php echo $booking_details['total_rooms']; ?></span></td>
                                        <td  width="13%"><?php echo $itinerary_details['room_type_name']; ?></td>
                                        <td align="center"><?php echo $booking_details['adult_count']; ?></td>
                                        <td align="center"><?php echo $booking_details['child_count']; ?></td>
										</tr>
									</table>
								</td>
							</tr>
                            <tr>
                            <td>&nbsp;</td></tr>
							<tr>
								<td style="padding: 10px;border: 1px solid #cccccc; font-size: 13px; font-weight: bold;">Contact Information</td>
								
							</tr>
							<tr>
								<td style="border: 1px solid #cccccc;">
									<table width="100%" cellpadding="5" style="padding: 10px;font-size: 13px;">
										<tr>
											<td><strong>Passenger Name</strong></td>
											<td><strong>Mobile</strong></td>
											<td><strong>Email</strong></td>
											<td><strong>City</strong></td>
											
										</tr>
										
											<?php foreach($customer_details as $details):?>
												<tr>
													<td><?php echo $details['title'].' '.$details['first_name'].' '.$details['last_name']?></td>
													<td><?php echo $details['phone'] ?></td>
													<td><?php echo $details['email']?></td>
													<td><?php echo $booking_details['cutomer_city']?></td>
												</tr>
											<?php endforeach;?>
										<!--  <td><?php echo $customer_details['title'].' '.$customer_details['first_name'].' '.$customer_details['middle_name'].' '.$customer_details['last_name'];?></td>
                                            <td><?php echo $customer_details['phone'];?></td>
                                            <td><?php echo $customer_details['email'];?></td>
                                            <td><?php echo $booking_details['cutomer_city'];?></td> -->
                                             
                                         </tr>   
									</table>
								</td>
								<td></td>
							</tr>
                            <tr><td>&nbsp;</td></tr>
							<tr>
								<td style="padding: 10px;border: 1px solid #cccccc; font-size: 13px; font-weight: bold;">Price Summary</td>
								
							</tr>
							<tr>
								<td style="border: 1px solid #cccccc;">
									<table width="100%" cellpadding="5" style="padding: 10px;font-size: 13px;">
										<tr>
											<td><strong>Base Fare</strong></td>
											<td><strong>Taxes</strong></td>
											<td><strong>Discount</strong></td>
											
											<td><strong>Total Fare</strong></td>
										</tr>
										<tr>
											<td><?php echo $booking_details['currency']; ?> <?php echo $booking_details['fare']; ?></td>
                                            <td><?php echo $booking_details['currency']; ?> <?php echo $itinerary_details['Tax']; ?></td>
                                            <td><?php echo $booking_details['currency']; ?> <?php echo $booking_details['discount']; ?></td>
                                            <td> <?php echo $booking_details['currency']; ?> <?php echo $booking_details['grand_total']; ?></td>
										</tr>
										<tr style="font-size:13px;">
                                        	<td colspan="5" align="right"><strong>Total Fare</strong></td>
											<td><strong><?php echo $booking_details['currency']; ?> <?php echo $booking_details['grand_total']; ?></strong></td>
										</tr>
									</table>
								</td>
								<td></td>
							</tr>                            
                            <tr><td>&nbsp;</td></tr>
                            	<tr>
								<td  width="100%" style="border: 1px solid #cccccc;">
									<table width="100%" cellpadding="5" style="padding: 10px 20px;font-size: 13px;">
										<tr>
                                        <td><?=$booking_details['cancellation_policy'][0]?></td>
										</tr>
										
									</table>
								</td>
							</tr>
							 <tr><td>&nbsp;</td></tr>
							<tr>
								<td width="50%" style="padding: 10px;border: 1px solid #cccccc; font-size: 13px; font-weight: bold;">Terms and Conditions</td>
							</tr>
							<tr>
								<td  width="100%" style="border: 1px solid #cccccc;">
									<table width="100%" cellpadding="5" style="padding: 10px 20px;font-size: 13px;">
										<tr>
                                        <td>1.Please ensure that operator PNR is filled, otherwise the ticket is not valid.</td>
										</tr>
										
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr></tbody>
</table>
<table id="printOption"onclick="w=window.open();w.document.write(document.getElementById('tickect_hotel').innerHTML);w.print();w.close(); return true;"
 style="border-collapse: collapse;font-size: 14px; margin: 10px auto; font-family: arial;" width="70%" cellpadding="0" cellspacing="0" border="0">
<tbody>
	<tr>
    <td align="center"><input style="background:#418bca; height:34px; padding:10px; border-radius:4px; border:none; color:#fff; margin:0 2px;" type="button" value="Print" />
    
    </tr>
</tbody></table>
</div>