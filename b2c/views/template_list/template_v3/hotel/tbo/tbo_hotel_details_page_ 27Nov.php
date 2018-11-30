<?php
$mini_loading_image	 = '<div class="text-center loader-image"><img src="'.$GLOBALS['CI']->template->template_images('loader_v3.gif').'" alt="Loading........"/></div>';
$loading_image		 = '<div class="text-center loader-image"><img src="'.$GLOBALS['CI']->template->template_images('loader_v1.gif').'" alt="Loading........"/></div>';
$_HotelDetails		 = $hotel_details['HotelInfoResult']['HotelDetails'];
$sanitized_data['HotelCode']			= $_HotelDetails['HotelCode'];
$sanitized_data['HotelName']			= $_HotelDetails['HotelName'];
$sanitized_data['StarRating']			= $_HotelDetails['StarRating'];
$sanitized_data['Description']			= $_HotelDetails['Description'];
$sanitized_data['Attractions']			= (isset($_HotelDetails['Attractions']) ? $_HotelDetails['Attractions'] : false);
$sanitized_data['HotelFacilities']		= (isset($_HotelDetails['HotelFacilities']) ? $_HotelDetails['HotelFacilities'] : false);
$sanitized_data['HotelPolicy']			= (isset($_HotelDetails['HotelPolicy']) ? $_HotelDetails['HotelPolicy'] : false);
$sanitized_data['SpecialInstructions']	= (isset($_HotelDetails['SpecialInstructions']) ? $_HotelDetails['SpecialInstructions'] : false);
$sanitized_data['Address']				= (isset($_HotelDetails['Address']) ? $_HotelDetails['Address'] : false);
$sanitized_data['PinCode']				= (isset($_HotelDetails['PinCode']) ? $_HotelDetails['PinCode'] : false);
$sanitized_data['HotelContactNo']		= (isset($_HotelDetails['HotelContactNo']) ? $_HotelDetails['HotelContactNo'] : false);
$sanitized_data['Latitude']				= (isset($_HotelDetails['Latitude']) ? $_HotelDetails['Latitude'] : 0);
$sanitized_data['Longitude']			= (isset($_HotelDetails['Longitude']) ? $_HotelDetails['Longitude'] : 0);
$sanitized_data['RoomFacilities']		= (isset($_HotelDetails['RoomFacilities']) ? $_HotelDetails['RoomFacilities'] : false);
$sanitized_data['Images']				= $_HotelDetails['Images'];
Js_Loader::$css[] = array('href' => $GLOBALS['CI']->template->template_css_dir('owl.carousel.min.css'), 'media' => 'screen');
Js_Loader::$js[] = array('src' => $GLOBALS['CI']->template->template_js_dir('owl.carousel.min.js'), 'defer' => 'defer');
?>

<?php
/**
 * Application VIEW
 */
echo $GLOBALS['CI']->template->isolated_view('hotel/search_panel_summary');
?>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJfvWH36KY3rrRfopWstNfduF5-OzoywY&sensor=false"></script>
<script type="text/javascript">
	/** Google Maps **/
	var myCenter=new google.maps.LatLng(<?=floatval($sanitized_data['Latitude'])?>,<?=floatval($sanitized_data['Longitude']); ?>);
	function initialize()
	{
		var mapProp = {
			center:myCenter,
			zoom:12,
			mapTypeId:google.maps.MapTypeId.ROADMAP
		};

		var map = new google.maps.Map(document.getElementById("Map"), mapProp);
	
		var marker = new google.maps.Marker({
			position:myCenter,
		});
	
		marker.setMap(map);
	
		var infowindow = new google.maps.InfoWindow({
			content:"Hotel Location"
		});
	
		google.maps.event.addListener(marker, "click", function() {
			infowindow.open(map, marker);
		});
	}
	google.maps.event.addDomListener(window, "load", initialize);
</script>
<div class="clearfix"></div>
<div class="search-result">
<div class="container">
<div class="htl_dtls_cont htldetailspage">
	<div class="rowfstep">
			<div class="col-sm-4 col-xs-6 nopad ">
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner" role="listbox">
					<?php
					//loop images
					if (valid_array($sanitized_data['Images']) == true) {
						$visible = 'active';
						foreach ($sanitized_data['Images'] as $i_k => $i_v) {?>
							<div class="item <?php echo $visible; $visible='';?> ">
								<img src=<?php echo $i_v?> alt="<?php echo $i_k?>" class="img-responsive" style="width:100%; height:200px">
								<div class="carousel-caption">
									<p><?php echo $sanitized_data['HotelName']?></p>
								</div>
							</div>
					<?php }
					}
					?>
					</div>
					<!-- Controls -->
					<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div><!-- Images -->
			<div class="col-sm-4 col-xs-6 nopad">
				<div class="innerdetspad">
					<div class="hoteldetsname"><?php echo strtoupper($sanitized_data['HotelName']);?></div>
					<div class="stardetshtl"><span class="rating-no"><span class="hide" id="h-sr"><?=$sanitized_data['StarRating']?></span><?php echo print_star_rating($sanitized_data['StarRating']);?></span></div>
					<div class="adrshtlo"><?php echo $sanitized_data['Address']?></div>
					<div class="butnbigs">
						<a class="tonavtorum movetop">Select Rooms</a>
					</div>
				</div>
			</div>
			<div class="col-sm-4 nopad map_mobile_dets">
				<div id="Map" class="col-md-12" style="height:200px; width:100%">Map</div>
			</div><!-- MAP -->
		</div> 
</div>
</div>
<div class="clearfix"></div>
<div class="fulldowny"> 
<div class="container">	
		<div class="fuldownsct">
			<div class="col-xs-8 nopad tab_htl_detail">
				<div class="detailtab fulldetab shdoww">
					<ul class="nav nav-tabs responsive-tabs">
					  <li class=""><a href="#htldets" data-toggle="tab">Hotel Details</a></li>
					  <li class="active"><a href="#rooms" data-toggle="tab">Rooms</a></li>
					  <li><a href="#facility" data-toggle="tab">Facilities</a></li>
					  <li><a href="#htlpolicy" data-toggle="tab">Hotel Policy</a></li>
					</ul>
					<div class="tab-content">
					<!-- Hotel Detail-->
					<div class="tab-pane" id="htldets">
						<div class="innertabs">
							<div id="hotel-additional-info" class="padinnerntb">
							<div class="lettrfty"><?php echo $sanitized_data['Description']?></div>
							</div>
						</div>
					</div>
					<!-- Hotel Detail End-->
					<!-- Rooms-->
					<div class="tab-pane active" id="rooms">
						<div class="innertabs">
							<div class="padinnerntb">
								<div id="room-list" class="room-list romlistnh">
									<?php echo $loading_image;?>
								</div>
							</div>
						</div>
					</div>
					<!-- Rooms End-->
					<!-- Facilities--> 
					<div class="tab-pane" id="facility">
						<div class="innertabs">
							<div class="padinnerntb htlfac_lity">
							<?php
							if (valid_array($sanitized_data['HotelFacilities']) == true) {
								//:p Did this for random color generation
								//$color_code = string_color_code('Balu A');
								$color_code = '#00a0e0';
								?>
								<div class="hedinerflty">
									Hotel Facilities
								</div>
								<?php
								//-- List group -->
								foreach ($sanitized_data['HotelFacilities'] as $ak => $av) {?>
									<div class="col-xs-4 nopad">
									<div class="facltyid">
									<span class="glyphicon glyphicon-check" style="color:<?php echo $color_code?>"></span> <?php echo $av; ?></div></div>
								<?php
								}?>

								
							<?php
							}
							?>
							<?php
							if (valid_array($sanitized_data['Attractions']) == true) {
								//:p Did this for random color generation
								//$color_code = string_color_code('Balu A');
								$color_code = '#00a0e0';
								?>
								<div class="subfty">
								<div class="hedinerflty">
									 Attractions
								</div>
								<?php
								//-- List group -->
								foreach ($sanitized_data['Attractions'] as $ak => $av) {?>
									<div class="col-xs-4 nopad"><div class="facltyid"><span class="glyphicon glyphicon-check" style="color:<?php echo $color_code?>"></span> <?php echo $av['Value']; ?></div></div>
								<?php
								}?>
								</div>
							<?php
							}
							?>
							</div>
						</div>
					</div>
					<!-- Facilities End-->
					<!-- Policy--> 
					<div class="tab-pane" id="htlpolicy">
						<div class="innertabs hote_plcys">
							<div class="padinnerntb">
							<p><?php echo (empty($sanitized_data['HotelPolicy']) == false ? $sanitized_data['HotelPolicy'] : '---');?></p>
							</div>
							
						</div>
					</div>
					<!-- Policy End-->
					
					</div>
				</div>
			</div>
			
		</div>
</div>
</div>
</div>
<?php
/**
 * This is used only for sending hotel room request - AJAX
 */
$hotel_room_params['ResultIndex']	= $params['ResultIndex'];
$hotel_room_params['booking_source']		= $params['booking_source'];
$hotel_room_params['search_id']		= $hotel_search_params['search_id'];
$hotel_room_params['op']			= 'get_room_details';
?>
<script>
$(document).ready(function() {
	//Load hotel Room Details
	var ResultIndex = '';
	var HotelCode = '';
	var TraceId = '';
	var booking_source = '';
	var op = 'get_room_details';
	function load_hotel_room_details()
	{
		var _q_params = <?php echo json_encode($hotel_room_params)?>;
		if (booking_source) { _q_params.booking_source = booking_source; }
		if (ResultIndex) { _q_params.ResultIndex = ResultIndex; }
		$.post(app_base_url+"index.php/ajax/get_room_details", _q_params, function(response) {
			if (response.hasOwnProperty('status') == true && response.status == true) {
				$('#room-list').html(response.data);
				var _hotel_name = "<?php echo preg_replace('/^\s+|\n|\r|\s+$/m', '', $sanitized_data['HotelName']);//Hotel Name comes from hotel info response ?>";
				var _hotel_star_rating = <?php echo abs($sanitized_data['StarRating'])?>;
				var _hotel_image = "<?php echo $sanitized_data['Images'][0];?>";
				var _hotel_address = "<?php echo preg_replace('/^\s+|\n|\r|\s+$/m', '', $sanitized_data['Address']);?>";
				$('[name="HotelName"]').val(_hotel_name);
				$('[name="StarRating"]').val(_hotel_star_rating);
				$('[name="HotelImage"]').val(_hotel_image);//Balu A
				$('[name="HotelAddress"]').val(_hotel_address);//Balu A
			}
		});
	}
	load_hotel_room_details();
	$('.hotel_search_form').on('click', function(e) {
		e.preventDefault();
		$('#hotel_search_form').slideToggle(500);
	});
	
	
	$('.movetop').click(function(){
		$('html, body').animate({scrollTop: $('.fulldowny').offset().top - 60 }, 'slow');
	});
	
});

/*  For responsive tab  */



! function($) {
	"use strict";
	var a = {
		accordionOn: ["xs"]
	};
	$.fn.responsiveTabs = function(e) {
		var t = $.extend({}, a, e),
			s = "";
		return $.each(t.accordionOn, function(a, e) {
			s += " accordion-" + e
		}), this.each(function() {
			var a = $(this),
				e = a.find("> li > a"),
				t = $(e.first().attr("href")).parent(".tab-content"),
				i = t.children(".tab-pane");
			a.add(t).wrapAll('<div class="responsive-tabs-container" />');
			var n = a.parent(".responsive-tabs-container");
			n.addClass(s), e.each(function(a) {
				var t = $(this),
					s = t.attr("href"),
					i = "",
					n = "",
					r = "";
				t.parent("li").hasClass("active") && (i = " active"), 0 === a && (n = " first"), a === e.length - 1 && (r = " last"), t.clone(!1).addClass("accordion-link" + i + n + r).insertBefore(s)
			});
			var r = t.children(".accordion-link");
			e.on("click", function(a) {
				a.preventDefault();
				var e = $(this),
					s = e.parent("li"),
					n = s.siblings("li"),
					c = e.attr("href"),
					l = t.children('a[href="' + c + '"]');
				s.hasClass("active") || (s.addClass("active"), n.removeClass("active"), i.removeClass("active"), $(c).addClass("active"), r.removeClass("active"), l.addClass("active"))
			}), r.on("click", function(t) {
				t.preventDefault();
				var s = $(this),
					n = s.attr("href"),
					c = a.find('li > a[href="' + n + '"]').parent("li");
				s.hasClass("active") || (r.removeClass("active"), s.addClass("active"), i.removeClass("active"), $(n).addClass("active"), e.parent("li").removeClass("active"), c.addClass("active"))
			})
		})
	}
}(jQuery);

$('.responsive-tabs').responsiveTabs({
	accordionOn: ['xs']
});
</script>
<?php
Js_Loader::$js[] = array('src' => $GLOBALS['CI']->template->template_js_dir('page_resource/pax_count.js'), 'defer' => 'defer');
?>