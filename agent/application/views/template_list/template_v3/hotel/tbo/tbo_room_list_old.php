<?php
/*debug($raw_room_list);
exit;*/
$booking_url = $GLOBALS['CI']->hotel_lib->booking_url($params['search_id']);
/**
 * Generate all the possible combinations among a set of nested arrays.
 *
 * @param array $data  The entrypoint array container.
 * @param array $all   The final container (used internally).
 * @param array $group The sub container (used internally).
 * @param mixed $val   The value to append (used internally).
 * @param int   $i     The key index (used internally).
 */
function generate_combinations(array $data, array &$all = array(), array $group = array(), $value = null, $i = 0)
{
	$keys = array_keys($data);
	if (isset($value) === true) {
		array_push($group, $value);
	}

	if ($i >= count($data)) {
		array_push($all, $group);
	} else {
		$currentKey     = $keys[$i];
		$currentElement = $data[$currentKey];
		foreach ($currentElement as $val) {
			generate_combinations($data, $all, $group, $val, $i + 1);
		}
	}

	return $all;
}

$clean_room_list			 = '';//HOLD DATA TO BE RETURNED
$_HotelRoomsDetails			 = get_room_index_list($raw_room_list['GetHotelRoomResult']['HotelRoomsDetails']);
$_RoomCombinations			 = $raw_room_list['GetHotelRoomResult']['RoomCombinations'];
$_InfoSource				 = $raw_room_list['GetHotelRoomResult']['RoomCombinations']['InfoSource'];

$common_params_url = '';
$common_params_url .= '<input type="hidden" name="ResultIndex"		value="'.$params['ResultIndex'].'">';
$common_params_url .= '<input type="hidden" name="booking_source"	value="'.$params['booking_source'].'">';
$common_params_url .= '<input type="hidden" name="search_id"		value="'.$params['search_id'].'">';

$common_params_url .= '<input type="hidden" name="op"				value="block_room">';
$common_params_url .= '<input type="hidden" name="GuestNationality"	value="'.ISO_INDIA.'" >';
$common_params_url .= '<input type="hidden" name="HotelName"		value="" >';
$common_params_url .= '<input type="hidden" name="StarRating"		value="">';
$common_params_url .= '<input type="hidden" name="HotelImage"		value="">';//Balu A
$common_params_url .= '<input type="hidden" name="HotelAddress"		value="">';//Balu A

/**
 * Forcing room combination to appear in multiple list format
 */
if (isset($_RoomCombinations['RoomCombination'][0]) == false) {
	$_RoomCombinations['RoomCombination'][0] = $_RoomCombinations['RoomCombination'];
}


//print_r($_RoomCombinations['RoomCombination']);echo "<br>test";
/**
 * FIXME
 * Room Details
 * Currently we are supporting Room Of - FixedCombination
 */
$generate_rm_cm = array();
if ($_InfoSource != 'FixedCombination') {


	//print_r($_RoomCombinations['RoomCombination']);
	foreach ($_RoomCombinations['RoomCombination'] as $key => $value) {
		$rm_com = array();
		/*echo "key "; print_r($key);
		echo "<br>value "; print_r($value['RoomIndex']);*/
		$rm_com = $value['RoomIndex'];
		$generate_rm_cm[] = $rm_com;
	}

	$_RoomComb = generate_combinations($generate_rm_cm);
	//echo "<br><pre>";print_r($_RoomComb);
	$RoomComb_fin = array();
	foreach ($_RoomComb as $key => $value) {
		$RoomComb_fin[$key]['RoomIndex']=$value;
		 /*echo"<br>key"; print_r($key);
		 echo "<bR> VALUE";
		 print_r($value);*/
		}
		$_RoomCombinations['RoomCombination'] = $RoomComb_fin;
	//echo "<pre>";	print_r($RoomComb_fin);
	/*	debug($_RoomCombinations);
	exit;*/
}

/**
 * Forcing room combination to appear in multiple list format
 */
if (isset($_RoomCombinations['RoomCombination'][0]) == false) {
	$_RoomCombinations['RoomCombination'][0] = $_RoomCombinations['RoomCombination'];
}

/**
 * Forcing Room list to appear in multiple list format
 */
if (isset($_HotelRoomsDetails[0]) == false) {
	$_HotelRoomsDetails[0] = $_HotelRoomsDetails;
}

//---------------------------------------------------------------------------Print Combination - START
foreach ($_RoomCombinations['RoomCombination'] as $__rc_key => $__rc_value) {
	/**
	 * Forcing Combination to appear in multiple format
	 */
	if (valid_array($__rc_value['RoomIndex']) == false) {
		$current_combination_wrapper = array($__rc_value['RoomIndex']);
	} else {
		$current_combination_wrapper = $__rc_value['RoomIndex'];
	}

	$temp_current_combination_count = count($current_combination_wrapper);
	$room_panel_details = $room_panel_summary = $dynamic_params_url = '';//SUPPORT DETAILS
	foreach ($current_combination_wrapper as $__room_index_key => $__room_index_value) {
		//NOTE : PRINT ROOM DETAILS OF EACH ROOM INDEX VALUE
		$temp_room_details = $_HotelRoomsDetails[$__room_index_value];
		$common_params_url .= '<input type="hidden" name="CancellationPolicy[]"	value="'.$temp_room_details['CancellationPolicy'].'">';//Balu A

		$SmokingPreference = get_smoking_preference(@$temp_room_details['SmokingPreference']);
		$room_panel_details .= '<div class="room-row">';
		$room_panel_details .= '<div class="col-xs-4 nopad fifty_rums">';
		$room_panel_details .= '<div class="colrumpad">';
		$room_panel_details .= '<div class="hotelhed"><span class="room-name">'.ucfirst(strtolower($temp_room_details['RoomTypeName'])).'</span></div>';

		
		$room_panel_details .= '<div class="mensionspl"><strong>Last Cancellation Date :</strong> 
								<span class="menlbl">'.local_date($temp_room_details['LastCancellationDate']).'</span>
								</div>';
		$room_panel_details .= '</div>';
		$room_panel_details .= '</div>';
		
		$room_panel_details .= '<div class="col-xs-4 nopad fifty_rums">';
		$room_panel_details .= '<div class="colrumpad">';
		$room_panel_details .= '<div class="mensionspl">
									<strong>Smoking Preference :</strong>
									<span class="menlbl"> '.ucfirst(strtolower($SmokingPreference['label'])).'</span>
								</div>';	
			if (isset($temp_room_details['Amenities'])) {
				$room_panel_details .= '<ul class="mensionspl">';
				foreach ($temp_room_details['Amenities'] as $__amenity) {
					$room_panel_details .= '<li class="grnepik"><span class="fa fa-check-square"></span>'.ucfirst(strtolower($__amenity)).'</li>';
				}
				$room_panel_details .= '</ul>';
			}
		$room_panel_details .= '</div>';
		$room_panel_details .= '</div>';

		$search_id = $attr['search_id'];
		
		$rslt_temp_room_details = $temp_room_details;
		$temp_price_details = $GLOBALS['CI']->hotel_lib->update_room_markup_currency($temp_room_details['Price'], $currency_obj, $search_id, true, true);
		$PublishedPrice				= $temp_price_details['PublishedPrice'];
		$PublishedPriceRoundedOff	= $temp_price_details['PublishedPriceRoundedOff'];
		$OfferedPrice				= $temp_price_details['OfferedPrice'];
		$OfferedPriceRoundedOff		= $temp_price_details['OfferedPriceRoundedOff'];
		$RoomPrice					= $temp_price_details['RoomPrice'];

		$room_panel_details .= '<div class="col-xs-4 nopad hundrd_rums">';
		$room_panel_details .= '<div class="col-xs-6 nopad">';
		$room_panel_details .= '<div class="colrumpad">
									<div class="priceflights smalwise">
									<strong> '.$currency_obj->get_currency_symbol($currency_obj->to_currency).' </strong>
									<span class="h-p">'.$RoomPrice.'</span>
									</div>
								</div>';
		$room_panel_details .= '</div>';
		$room_panel_details .= '<div class="col-xs-6 nopad">';
		$room_panel_details .= '<div class="colrumpad">
								<a href="#"class="canrumpoly" data-toggle="tooltip" data-placement="top" title="'.$rslt_temp_room_details['CancellationPolicy'].'">Cancellation Policy</a>
								</div>';
		$room_panel_details .= '</div>';
		$room_panel_details .= '</div>';
		$room_panel_details .= '</div>';


		$rslt_temp_room_details['RoomTypeName'] = ucfirst(strtolower($rslt_temp_room_details['RoomTypeName']));
		if (intval($__room_index_key) == 0) {
			$temp_book_now_button = '';
			$temp_summary_room_list = array($rslt_temp_room_details['RoomTypeName']);
			$temp_summary_price_list = array($RoomPrice);
		} else {
			$temp_summary_room_list[] = $rslt_temp_room_details['RoomTypeName'];
			$temp_summary_price_list[] = $RoomPrice;
		}

		if (intval($temp_current_combination_count) == intval($__room_index_key+1)) {
			//PIN Summary
			if (valid_array($temp_summary_room_list)) {
				$temp_summary_room_list = implode(' <i class="fa fa-plus"></i> ', $temp_summary_room_list);
			}
			if (valid_array($temp_summary_price_list)) {
				$temp_summary_price_list = array_sum($temp_summary_price_list);
			}
			$room_panel_summary = '
						<div class="col-xs-7 nopad leftde_flt">
							<div class="colrumpad">
								<div class="hotelhed room-name">'.$temp_summary_room_list.'</div>
								<a class="morehotlnav toggle-more-details">View details</a>
							</div>
							
						</div>
						<div class="col-xs-3 nopad leftde_flt">
							<div class="colrumpad">
								<div class="priceflights eachroomprice">
									<strong> '.$currency_obj->get_currency_symbol($application_preferred_currency).' </strong>
									<span class="h-p">'.$temp_summary_price_list.'</span>
								</div>
							</div>
						</div>
						';
						
			


			
		}
		$dynamic_params_url[] = $temp_room_details['RoomUniqueId'];
	}//END INDIVIDUAL COMBINATION LOOPING
	$dynamic_params_url = serialized_data($dynamic_params_url);
	$temp_dynamic_params_url = '';
	$temp_dynamic_params_url .= '<input type="hidden" name="token" value="'.$dynamic_params_url.'">';
	$temp_dynamic_params_url .= '<input type="hidden" name="token_key" value="'.md5($dynamic_params_url).'">';
	$temp_book_link = '<div class="col-xs-2 nopad none_rit">
							<div class="colrumpad">
							<form method="POST" action="'.$booking_url.'">
	'.$common_params_url.$temp_dynamic_params_url.'
	<button class="b-btn bookallbtn book-now-btn" type="submit">Book Now</button>
		</form></div>
		</div>';

	
$clean_room_list .= '<div class="eachroom">';
	$clean_room_list .= $room_panel_summary.$temp_book_link;
	$clean_room_list .= '<div class="clearfix"></div>';
	$clean_room_list .= '<div class="toggle-more-details-wrapper" style="display:none">';
	$clean_room_list .= '<div class="rumwrping">';
	$clean_room_list .= $room_panel_details;
	$clean_room_list .= '</div>';
	$clean_room_list .= '</div>';
$clean_room_list .= '</div>';
}//END COMBINATION LOOPING

echo $clean_room_list;
//---------------------------------------------------------------------------Print Combination - END
?>
<script>

	$( ".eachroom" ).hover(
	  function() {
		$('.romlistnh').find('.eachroom').addClass('blur');
		$(this).removeClass('blur');
	  }, function() {
		$('.eachroom').removeClass('blur');
	  }
	);


	$(function () {
		$('[data-toggle="tooltip"]').tooltip();
	});
	$(".toggle-more-details").click(function(){
		$(".toggle-more-details-wrapper", $(this).closest('.eachroom')).toggle();
	});
</script>
<?php
//---------------------------------------------------------------------------Support Functions - START
//---------------------------------------------------------------------------Support Functions - END