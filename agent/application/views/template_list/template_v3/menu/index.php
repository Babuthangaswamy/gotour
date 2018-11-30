<?php

$active_domain_modules = $this->active_domain_modules;
$default_active_tab = $default_view;
// echo "<pre>"; print_r($holiday_data);exit;

/**
 * set default active tab
 *
 * @param string $module_name
 *        	name of current module being output
 * @param string $default_active_tab
 *        	default tab name if already its selected otherwise its empty
 */
function set_default_active_tab($module_name, &$default_active_tab) {
	if (empty ( $default_active_tab ) == true || $module_name == $default_active_tab) {
		if (empty ( $default_active_tab ) == true) {
			$default_active_tab = $module_name; // Set default module as current active module
		}
		return 'active';
	}
}
?>

<div class="searcharea">
	<div class="srchinarea">
		<div class="allformst">
			<div class="container-fluid">
			<div class="tab_border">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs tabstab">
				<?php if (is_active_airline_module()) { ?>
				<li
						class="<?php echo set_default_active_tab(META_AIRLINE_COURSE, $default_active_tab)?>"><a
						href="#flight" aria-controls="flight" role="tab" data-toggle="tab"><span class="sprte iconcmn"><i class="fal fa-plane"></i></span><label>Flight</label></a></li>
				<?php } ?>
				<?php if (is_active_hotel_module()) { ?>
				<li
						class="<?php echo set_default_active_tab(META_ACCOMODATION_COURSE, $default_active_tab)?>"><a
						href="#hotel" aria-controls="hotel" role="tab" data-toggle="tab"><span class="sprte iconcmn"><i class="fal fa-building"></i></span><label>Hotel</label></a></li>
				<?php } ?>
				<!-- <?php if (is_active_bus_module()) { ?>
				<li
						class="<?php echo set_default_active_tab(META_BUS_COURSE, $default_active_tab)?>"><a
						href="#bus" aria-controls="bus" role="tab" data-toggle="tab"><span class="sprte iconcmn"><i class="fal fa-bus"></i></span><label>Bus</label></a></li>
				<?php } ?>

				<?php if(is_active_transferv1_module()):?>
					<li
						class="<?php echo set_default_active_tab(META_TRANSFERV1_COURSE, $default_active_tab)?>"><a
						href="#transfers" aria-controls="transfers" role="tab" data-toggle="tab"><span class="sprte iconcmn"><i class="fal fa-taxi"></i></span><label>Transfers</label></a></li>

				<?php endif;?>
					<?php if (is_active_sightseeing_module()) { ?>
				<li
						class="<?php echo set_default_active_tab(META_SIGHTSEEING_COURSE, $default_active_tab)?>"><a
						href="#sightseeing" aria-controls="sightseeing" role="tab" data-toggle="tab"><span class="sprte iconcmn"><i class="fal fa-binoculars"></i></span><label>Activities </label></a></li>
				<?php } ?>
				<?php if (is_active_car_module()) { ?>
				<li
						class="<?php echo set_default_active_tab(META_CAR_COURSE, $default_active_tab)?>"><a
						href="#car" aria-controls="car" role="tab" data-toggle="tab"><span class="sprte iconcmn"><i class="fal fa-car"></i></span><label>Car</label></a></li>
				<?php } ?>

				<?php if (is_active_package_module()) { ?>
				<li
						class="<?php echo set_default_active_tab(META_PACKAGE_COURSE, $default_active_tab)?>"><a
						href="#holiday" aria-controls="holiday" role="tab"
						data-toggle="tab"><span class="sprte iconcmn"><i class="fal fa-tree"></i></span><label>Holiday</label></a></li>
				<?php } ?> -->
				</ul>
			  </div>
			</div>
			<!-- Tab panes -->
			<div class="secndblak">
				<div class="container-fluid">
					<div class="tab-content custmtab">
					<?php if (is_active_airline_module()) { ?>
					<div
							class="tab-pane <?php echo set_default_active_tab(META_AIRLINE_COURSE, $default_active_tab)?>"
							id="flight">
						<?php echo $GLOBALS['CI']->template->isolated_view('share/flight_search')?>
					</div>
					<?php } ?>
					<?php if (is_active_hotel_module()) { ?>
					<div
							class="tab-pane <?php echo set_default_active_tab(META_ACCOMODATION_COURSE, $default_active_tab)?>"
							id="hotel">
						<?php echo $GLOBALS['CI']->template->isolated_view('share/hotel_search')?>
					</div>
					<?php } ?>
					<?php if (is_active_bus_module()) { ?>
					<div
							class="tab-pane <?php echo set_default_active_tab(META_BUS_COURSE, $default_active_tab)?>"
							id="bus">
						<?php echo $GLOBALS['CI']->template->isolated_view('share/bus_search')?>
					</div>
					<?php } ?>
					<?php if(is_active_transferv1_module()):?>						
						<div
							class="tab-pane <?php echo set_default_active_tab(META_TRANSFERV1_COURSE, $default_active_tab)?>"
							id="transfers">
						<?php echo $GLOBALS['CI']->template->isolated_view('share/transferv1_search')?>
					</div>

					<?php endif; ?>
					<?php if (is_active_sightseeing_module()) { ?>
					<div
							class="tab-pane <?php echo set_default_active_tab(META_SIGHTSEEING_COURSE, $default_active_tab)?>"
							id="sightseeing">
						<?php echo $GLOBALS['CI']->template->isolated_view('share/sightseeing_search')?>
					</div>
					<?php } ?>
					<?php if (is_active_car_module()) { ?>
					<div
							class="tab-pane <?php echo set_default_active_tab(META_CAR_COURSE, $default_active_tab)?>"
							id="car">
						<?php echo $GLOBALS['CI']->template->isolated_view('share/car_search')?>
					</div>
					<?php } ?>

					<?php if (is_active_package_module()) { ?>
					<div
							class="tab-pane <?php echo set_default_active_tab(META_PACKAGE_COURSE, $default_active_tab)?>"
							id="holiday">
						<?php echo $GLOBALS['CI']->template->isolated_view('share/holiday_search',$holiday_data)?>
					</div>
					<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function($){
		//Top Destination Functionality
		$('.htd-wrap').on('click', function(e) {
			e.preventDefault();
			var curr_destination = $('.top-des-val', this).val();
			var check_in = "<?=add_days_to_date(7)?>";
			var check_out = "<?=add_days_to_date(10)?>";

			$('#hotel_destination_search_name').val(curr_destination);
			$('#hotel_checkin').val(check_in);
			$('#hotel_checkout').val(check_out);
			$('#hotel_search').submit();
		});
});
	//homepage slide show end
</script>
<?php
Js_Loader::$js[] = array('src' => $GLOBALS['CI']->template->template_js_dir('page_resource/pax_count.js'), 'defer' => 'defer');
echo $this->template->isolated_view('share/js/lazy_loader');
?>