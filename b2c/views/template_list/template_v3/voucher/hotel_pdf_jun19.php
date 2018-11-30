<?php
$booking_details = $data['booking_details'][0];
//echo debug($booking_details);
//exit;
$itinerary_details = $booking_details['itinerary_details'][0];
$attributes = $booking_details['attributes'];
$customer_details = $booking_details['customer_details'][0];

$domain_details = $booking_details;
$lead_pax_details = $booking_details['customer_details'];
?>
<table style="border-collapse: collapse; background: #ffffff;font-size: 12pt; margin: 0 auto; font-family: arial;" width="100%" cellpadding="0" cellspacing="0" border="0">
  <tbody>
   <tr>
   <td style="border-collapse: collapse; padding:10px 20px 20px" >
			<table width="100%" style="border-collapse: collapse;" cellpadding="0" cellspacing="0" border="0">
			<tr><td style="font-size:15pt; line-height:30px; width:100%; display:block; font-weight:600; text-align:center">E-Ticket</td></tr>
			<tr>
					<td>
			<table width="100%" style="border-collapse: collapse;" cellpadding="0" cellspacing="0" border="0">
			     <tr>
					<td style="padding: 10px;width:65%;"><img style="height:56px;" src="<?=$GLOBALS['CI']->template->domain_images($data['logo'])?>"></td>
					<td style="padding: 10px;width:35%">
                    	<table width="100%" style="border-collapse: collapse;text-align: right; line-height:15px;" cellpadding="0" cellspacing="0" border="0">
                    		
                    		<tr>
                    		<td style="font-size:12pt;"><span style="width:100%; float:left"><?php echo $data['address'];?></span>
                    		</td>
                    		</tr>
                         </table></td>
				  </tr>
				  
				  
				</table>
				</td>
			</tr>
			<tr>
					<td style="padding: 10px;">
					
			            <table cellpadding="5" cellspacing="0" border="0" width="100%" style="border-collapse: collapse;">
							<tr>
								<td width="100%" style="padding: 10px;border: 1px solid #cccccc; font-size: 11pt; font-weight: bold;">Hotel Booking Lookup</td>
							</tr>
								<tr>
								<td style="border: 1px solid #cccccc;">
									<table width="100%" cellpadding="5" style="padding: 10px;font-size: 11pt;">
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
                                           <strong class="<?php echo booking_status_label( $booking_details['status']);?>" style=" font-size:11pt;">
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
								<td style="padding: 10px;border: 1px solid #cccccc; font-size: 11pt; font-weight: bold;">Hotel Information</td>
								
							</tr>
							<tr>
								<td  width="100%" style="border: 1px solid #cccccc;">
									<table width="100%" cellpadding="5" style="padding: 10px;font-size: 11pt;">
										<tr>
											<td width="20%"><strong>Hotel Name</strong></td>
											<td width="30%"><?php echo $booking_details['hotel_name']; ?></td>
											<td width="20%"><strong>Hotel Address</strong></td>
											<td width="30%"><?php echo $booking_details['hotel_address']; ?></td>
									   
									    </tr>
									    
									    <tr>
											<td width="20%"><strong>Check-In</strong></td>
											<td width="30%"><?=@date("d M Y",strtotime($itinerary_details['check_in']))?></td>
											<td width="20%"><strong>Check-Out</strong></td>
											<td width="30%"><?=@date("d M Y",strtotime($itinerary_details['check_out']))?></td>
									   
									    </tr>
									    
									    <tr>
											<td width="20%"><strong>No of Room's</strong></td>
											<td width="30%"><?php echo $booking_details['total_rooms']; ?></td>
											<td width="20%"><strong>Room Type</strong></td>
											<td width="30%"><?php echo $itinerary_details['room_type_name']; ?></td>
									   
									    </tr>
									    
									    <tr>
											<td width="20%"><strong>Adult's</strong></td>
											<td width="30%"><?php echo $booking_details['adult_count']; ?></td>
											<td width="20%"><strong>Children</strong></td>
											<td width="30%"><?php echo $booking_details['child_count']; ?></td>
									   
									    </tr>
									    
									  
							           
									</table>
									</td>
							</tr>
							 <tr>
                            <td>&nbsp;</td></tr>
							<tr>
								<td style="padding: 10px;border: 1px solid #cccccc; font-size: 11pt; font-weight: bold;">Contact Information</td>
								
							</tr>
							<tr>
								<td style="border: 1px solid #cccccc;">
									<table width="100%" cellpadding="5" style="padding: 10px;font-size: 11pt;">
										<tr>
											<td><strong>Passenger Name</strong></td>
											<td><strong>Mobile</strong></td>
											<td><strong>Email</strong></td>
											<td><strong>City</strong></td>
											
										</tr>
										<tr>
										 <td><?php echo $customer_details['title'].' '.$customer_details['first_name'].' '.$customer_details['last_name'];?></td>
                                            <td><?php echo $customer_details['phone'];?></td>
                                            <td><?php echo $customer_details['email'];?></td>
                                            <td><?php echo $booking_details['cutomer_city'];?></td>
                                             
                                         </tr>   
									</table>
								</td>
								
							</tr>
							
						<tr><td>&nbsp;</td></tr>
							<tr>
								<td style="padding: 10px;border: 1px solid #cccccc; font-size: 11pt; font-weight: bold;">Price Summary</td>
								
							</tr>
							<tr>
								<td style="border: 1px solid #cccccc;">
									<table width="100%" cellpadding="5" style="padding: 10px;font-size: 11pt;">
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
										<tr style="font-size:11pt;">
                                        	<td   align="right"><strong>Total Fare</strong></td>
											<td><strong><?php echo $booking_details['currency']; ?> <?php echo $booking_details['grand_total']; ?></strong></td>
										</tr>
									</table>
								</td>
								
							</tr> 
						<tr><td>&nbsp;</td></tr>
							<tr>
								<td width="100%" style="padding: 10px;border: 1px solid #cccccc; font-size: 11pt; font-weight: bold;">Terms and Conditions</td>
							</tr>
							<tr>
								<td  width="100%" style="border: 1px solid #cccccc;">
									<table width="100%" cellpadding="5" style="padding: 10px 20px;font-size: 11pt;">
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
   </tr>
  </tbody>
</table>  