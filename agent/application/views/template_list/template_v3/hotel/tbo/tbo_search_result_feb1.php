<?php
$template_images = $GLOBALS['CI']->template->template_images();
$mini_loading_image = '<div class="text-center loader-image">Please Wait <img src="'.$template_images.'loader_v3.gif" alt="Loading........"/></div>';
foreach ($raw_hotel_list['HotelSearchResult']['HotelResults'] as $hd_key=>$hd) {
	$current_hotel_rate = ($hd['StarRating']);
	$hotel_code = preg_replace("/[^a-zA-Z0-9]/", "",$hd['HotelCode']);
	//$file_headers = @get_headers($hd['HotelPicture']);
	$image_found=1;
	// if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
	// 	$image_found = 0;
	// }
?>
<div class="rowresult r-r-i">
	<div class="madgrid forhtlpopover" data-key="<?=$hd_key?>" data-hotel-code="<?=$hotel_code?>">
		<div class="col-xs-4 nopad listimage">
			<div class="imagehtldis">
				<?php if($hd['HotelPicture']&&$image_found==1):?>
					<img src="" alt="Hotel img" data-src="<?=$hd['HotelPicture'] ?>" class="lazy h-img">
				<?php else:?>
					<img src="" alt="Hotel img" data-src="<?=$GLOBALS['CI']->template->template_images('default_hotel_img.jpg') ?>" class="lazy h-img">
				<?php endif;?>
				<?php
					/**
					 * HOTEL PRICE SECTION With Markup price will be returned
					 * 
					 */
					 //Getting RoomPrice from API per night wise					
					$search_id = intval($attr['search_id']);					
					//$RoomPrice					= round($hd['Price']['RoomPrice']/$no_of_nights);
					$RoomPrice					= $hd['Price']['RoomPrice'];
					?>

				<img src="" alt="Hotel img" data-src="<?=$hd['HotelPicture'] ?>" class="lazy h-img">
				<?php if($hd['HotelPicture']&&$image_found==1):?>
				<a data-target="map-box-modal" data-result-token="<?=urlencode($hd['ResultToken'])?>" data-booking-source="<?=urlencode($booking_source)?>" data-price="<?=$RoomPrice?>" data-star-rating="<?=$current_hotel_rate?>"  data-hotel-name="<?php echo $hd['HotelName']?>" id="map_id_<?=$hd_key?>"  data-trip-url="<?=$hd['trip_adv_url']?>" data-trip-rating="<?=$hd['trip_rating']?>"  data-id="<?=$hd_key?>" class="hotel-image-gal mapviewhtlhotl fa fa-picture-o view-photo-btn" data-hotel-code="<?=$hd['HotelCode']?>"></a> 
				<?php endif;?>
				<a class="hotel_location" data-lat="<?=@$hd['Latitude']?>" data-lon="<?=@$hd['Longitude']?>"></a>
			</div>
		</div>
		<div class="col-xs-8 nopad listfull">
			<div class="sidenamedesc">
				<div class="celhtl width70">
					<div class="innd">
					  <div class="imptpldz">
						<div class="property-type" data-property-type="hotel"></div>
						<div class="shtlnamehotl">
							<span class="h-name"><?php echo $hd['HotelName']?></span>
						</div>
						<div class="starrtinghotl rating-no">
								<span class="h-sr hide"><?php echo $current_hotel_rate?></span>
								<?php echo print_star_rating($current_hotel_rate);?>
						</div>
						<div class="adreshotle h-adr" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $hd['HotelAddress']?>"><?php echo $hd['HotelAddress']?>
						</div>
						<div class="preclsdv">
							<?php if(isset($hd['Free_cancel_date'])):?>
								<?php if($hd['Free_cancel_date']):?>
						 		 <span class="canplyto"><i class="fa fa-check" aria-hidden="true"></i> Free Cancellation till:<b><?=local_month_date($hd['Free_cancel_date']);?></b></span>
						 		<?php endif;?>
							<?php endif;?>
						</div>

						<div class="bothicntri">
						<div class="mwifdiv">
                           <ul class="htl_spr">                         
				         	<?php if(isset($hd['HotelAmenities'])):?>
				         		<?php if($hd['HotelAmenities']):?>
				         			<?php
				         			   	//debug($hd['HotelAmenities']);
				         			   	$in_search_params = "".strtolower('wireless')."";
										$in_input = preg_quote(@$in_search_params, '~'); // don't forget to quote input string!
										$internet_result = preg_grep('~' . $in_input . '~', $hd['HotelAmenities']);
										$inn_search_params = "Wi-Fi";
										$inn_input = preg_quote(@$inn_search_params, '~'); 
										$innternet_result = preg_grep('~' . $inn_input . '~', $hd['HotelAmenities']);

										//checking free wifi
										
										$wf_search_params = "Wi";
										$wf_input = preg_quote(@$wf_search_params, '~'); 
										$wf_result = preg_grep('~' . $wf_input . '~', $hd['HotelAmenities']);

										$b_search_params = "".strtolower('breakfast')."";
										$b_input = preg_quote(@$b_search_params, '~'); 
										$b_result = preg_grep('~' . $b_input . '~', $hd['HotelAmenities']);
										//checking breakfast 
										$bf_search_params = "Breakfast";
										$bf_input = preg_quote(@$bf_search_params, '~'); 
										$bf_result = preg_grep('~' . $bf_input . '~', $hd['HotelAmenities']);

										$p_search_params = "".strtolower('parking')."";
										$p_input = preg_quote(@$p_search_params, '~'); 
										$p_result = preg_grep('~' . $p_input . '~', $hd['HotelAmenities']);
										//car parking
										$cp_search_params = "".strtolower('park')."";
										$cp_input = preg_quote(@$cp_search_params, '~'); 
										$cp_result = preg_grep('~' . $cp_input . '~', $hd['HotelAmenities']);

										$s_search_params = "pool";
										$s_input = preg_quote(@$s_search_params, '~'); 
										$s_result = preg_grep('~' . $s_input . '~', $hd['HotelAmenities']);
										$swim = "Swim";
								
										$sw_input = preg_quote(@$swim, '~'); 
										$sw_result = preg_grep('~' . $sw_input . '~', $hd['HotelAmenities']);
				         			?>
				         				<?php if($internet_result||$innternet_result|| $wf_result):?>
				         					<li class="wf" data-toggle="tooltip" data-placement="top" title="Wifi"><span>Wifi</span></li>
				         					<input type="hidden" value="filter" id="wifi" class="wifi" data-wifi="1">
				         				<?php else:?>
				         					<input type="hidden" value="filter" id="wifi" class="wifi" data-wifi="0">
				         				<?php endif;?>
				         				<?php if($b_result||$bf_result):?>
				         					<li class="bf" data-toggle="tooltip" data-placement="top" title="Breakfast"><span>Breakfast</span></li>
				         					<input type="hidden" value="filter" id="breakfast" class="breakfast" data-breakfast="1">
				         				<?php else:?>
				         					<input type="hidden" value="filter" id="breakfast" class="breakfast" data-breakfast="0">
				         				<?php endif;?>
				         				<?php if($p_result || $cp_result):?>
				         						 <li class="pr" data-toggle="tooltip" data-placement="top" title="Parking"><span>Parking</span></li>
		         						 		<input type="hidden" value="filter" id="parking" data-parking ="1" class="parking">
		         						<?php else:?>
		         								<input type="hidden" value="filter" id="parking" class="parking" data-parking="0">
				         				<?php endif;?>
				         				<?php if($s_result||$sw_result):?>
				         						 <li class="sf" data-toggle="tooltip" data-placement="top" title="Swimming pool"><span>Swimming pool</span></li>
				         						 <input type="hidden" value="filter" id="pool" class="pool" data-pool="1">
				         				<?php else:?>
				         					 <input type="hidden" value="filter" id="pool" class="pool" data-pool="0">
				         				<?php endif;?>
				         	<?php else:?>
				         		<input type="hidden" value="filter" id="wifi" class="wifi" data-wifi="0">
				         		<input type="hidden" value="filter" id="breakfast" class="breakfast" data-breakfast="0">
				         		<input type="hidden" value="filter" id="parking" class="parking" data-parking="0">
				         		<input type="hidden" value="filter" id="pool" class="pool" data-pool="0">		         			   	
				         	<?php endif;?>
				         	<?php else:?>
				         			<input type="hidden" value="filter" id="wifi" class="wifi" data-wifi="0">
				         		<input type="hidden" value="filter" id="breakfast" class="breakfast" data-breakfast="0">
				         		<input type="hidden" value="filter" id="parking" class="parking" data-parking="0">
				         		<input type="hidden" value="filter" id="pool" class="pool" data-pool="0">
				         	<?php endif;?>
                           
                           </ul>
						</div>
						  	<?php if(isset($hd['trip_adv_url'])&&empty($hd['trip_adv_url'])==false):?>
							  <div class="tripad">
							    <a href="#"><img src="<?=$hd['trip_adv_url']?>"></a>
							    <span>Rating <?=$hd['trip_rating']?></span>
							  </div>
							<?php endif;?>
						 </div>
						<div class="clearfix"></div>
					</div>
					<div class="maprew">
						<div class="hoteloctnf">
							<a href="<?php echo base_url().'index.php/hotel/map?lat='.$hd['Latitude'].'&lon='.$hd['Longitude'].'&hn='.urlencode($hd['HotelName']).'&sr='.intval($hd['StarRating']).'&c='.urlencode($hd['HotelLocation']).'&price='.$RoomPrice.'&img='.urlencode($hd['HotelPicture'])?>"" class="location-map  fa fa-map-marker" target="map_box_frame" data-toggle="tooltip" data-placement="top" data-original-title="View Map"></a>
							<!-- <span class="h-loc"><?=$hd['HotelLocation']?></span> -->
						</div>
					</div>
				</div>
				</div>
				<?php
					/**
					 * HOTEL PRICE SECTION With Markup price will be returned
					 * 
					 */
					$search_id = intval($attr['search_id']);
					//$PublishedPrice				= $hd['Price']['PublishedPrice'];
					//$PublishedPriceRoundedOff	= $hd['Price']['PublishedPriceRoundedOff'];
					//$OfferedPrice				= $hd['Price']['OfferedPrice'];
					//$OfferedPriceRoundedOff		= $hd['Price']['OfferedPriceRoundedOff'];
					$RoomPrice					= $hd['Price']['RoomPrice'];
					?>
				<div class="celhtl width30">
					<div class="sidepricewrp">
						<?php
							if (isset($hd['HotelPromotion']) == true and empty($hd['HotelPromotion']) == false) {?>
						<a href="#" class="dealicons hide" data-trigger="hover" data-placement="left" data-toggle="popover" data-deal="<?php echo ACTIVE?>" title="Hotel Deal" data-content="<?=$hd['HotelPromotion']?>"></a>
						<h6 class="alert alert-success hide">
							<span class="deal-status fa fa-star" data-deal="<?php echo ACTIVE?>"></span> <span href="#"><?=$hd['HotelPromotion']?></span>
						</h6>
						<?php
							} else {?>
						<span class="deal-status hide" data-deal="<?php echo INACTIVE?>"></span>
						<?php
							}?>
						<div class="priceflights">
							<!-- <div class="prcstrtingt">starting @ </div> -->
							<strong> <?php echo $currency_obj->get_currency_symbol($currency_obj->to_currency); ?> </strong>
							<span class="h-p"><?php echo roundoff_number($RoomPrice); ?></span>
							<div class="prcstrtingt">Avg / Night</div>
						</div>
                        
                        <div class="snf_hnf hide">
							<?php echo $currency_obj->get_currency_symbol($currency_obj->to_currency); ?> 
                        	<?php echo roundoff_number($RoomPrice); ?>
                        </div>
                        
						<form method="GET" action="<?php echo base_url().'index.php/hotel/hotel_details/'.($search_id)?>">
							<div class="hide">
								<input type="hidden" value="<?=urlencode($hd['ResultToken'])?>"	name="ResultIndex" class="result-index">
								<input type="hidden" value="<?=urlencode($booking_source)?>"				name="booking_source" class="booking_source">
								<input type="hidden" value="get_details"									name="op" class="operation">
							</div>
							<button class="confirmBTN b-btn bookallbtn splhotltoy" type="submit"> Book Now</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<form class="room-form hide">
			<input type="hidden" value="<?=urlencode($hd['ResultToken'])?>"	name="ResultIndex" class="result-index">
			<input type="hidden" value="<?=urlencode($booking_source)?>"				name="booking_source" class="booking_source">
			<input type="hidden" name="op" value="get_room_details">
			<input type="hidden" name="search_id" value="<?=$search_id?>">
		</form>
		<div class="viewhotlrmtgle hide">
			<button class="vwrums room-btn" type="button">View Rooms</button>
		</div>
		<div class="clearfix"></div>
		<div class="room-list" style="display:none">
			<div class="room-summ romlistnh">
				<?=$mini_loading_image?>
			</div>
		</div>

		<?php

			if (isset($hd['HotelPromotion']) == true and empty($hd['HotelPromotion']) == false) {?>	
				<div class="gift-tag">
		          <span class="offdiv deal-status" data-deal="<?php echo ACTIVE?>"><?=$hd['HotelPromotion']?>% Off</span>
		        </div>
			<?php } else {?>
				<span class="deal-status hide" data-deal="<?php echo INACTIVE?>"></span>
				<?php
		}?>

	</div>

	<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();  
});
</script>

</div>
<?php
}