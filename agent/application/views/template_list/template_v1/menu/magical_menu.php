<?php
$active_domain_modules = $this->active_domain_modules;
/**
 * Need to make privilege based system
 * Privilege only for loading menu and access of the web page
 * 
 * Data loading will not be based on privilege.
 * Data loading logic will be different.
 * It depends on many parameters
 */
$menu_list = array();
if (count($active_domain_modules) > 0) {
	$any_domain_module = true;
} else {
	$any_domain_module = false;
}
$airline_module = is_active_airline_module();
$accomodation_module = is_active_hotel_module();
$bus_module = is_active_bus_module();
$package_module = is_active_package_module();
$sightseeing_module = is_active_sightseeing_module();
$car_module = is_active_car_module();
$transfer_module =is_active_transferv1_module();
// debug($car_module);exit;
?>
<ul class="sidebar-menu">
	<li class="header">MAIN NAVIGATION</li>
	<li class="active treeview">
		<a href="<?php echo base_url()?>">
			<i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
		</a>
	</li>
	<!-- USER ACCOUNT MANAGEMENT -->
	<li class="treeview">
		<a href="#">
			<i class="fa fa-search"></i><span> Search </span><i class="fa fa-angle-left pull-right"></i></a>
		<ul class="treeview-menu">
		<!-- USER TYPES -->
			<?php if ($airline_module) { ?>
			<li><a href="<?=base_url().'index.php/menu/index/flight/?default_view='.META_AIRLINE_COURSE?>"><i class="<?=get_arrangement_icon(META_AIRLINE_COURSE)?> text-blue"></i> <span class="hidden-xs">Flight</span></a></li>
			<?php } ?>
			<?php if ($accomodation_module) { ?>
			<li><a href="<?=base_url().'index.php/menu/index/hotel/?default_view='.META_ACCOMODATION_COURSE?>"><i class="<?=get_arrangement_icon(META_ACCOMODATION_COURSE)?> text-green"></i> <span class="hidden-xs">Hotel</span></a></li>
			<?php } ?>
			<?php if ($bus_module) { ?>
			<li><a href="<?=base_url().'index.php/menu/index/bus/?default_view='.META_BUS_COURSE?>"><i class="<?=get_arrangement_icon(META_BUS_COURSE)?> text-red"></i> <span class="hidden-xs">Bus</span></a></li>
			<?php } ?>
			<?php if($transfer_module){?>
				<li><a href="<?=base_url().'index.php/menu/index/transfers/?default_view='.META_TRANSFERV1_COURSE?>"><i class="<?=get_arrangement_icon(META_TRANSFERV1_COURSE)?> text-red"></i> <span class="hidden-xs">Transfers</span></a></li>
			<?php }?>
			<?php if($sightseeing_module){?>
				<li><a href="<?=base_url().'index.php/menu/index/sightseeing/?default_view='.META_SIGHTSEEING_COURSE?>"><i class="<?=get_arrangement_icon(META_SIGHTSEEING_COURSE)?> text-red"></i> <span class="hidden-xs">Activities</span></a></li>
			<?php }?>
			<?php if($car_module){?>
				<li><a href="<?=base_url().'index.php/menu/index/car/?default_view='.META_CAR_COURSE?>"><i class="<?=get_arrangement_icon(META_CAR_COURSE)?> text-red"></i> <span class="hidden-xs">Car</span></a></li>
			<?php }?>
			<?php if ($package_module) { ?>
			<li><a href="<?=base_url().'index.php/menu/index/package/?default_view='.META_PACKAGE_COURSE?>"><i class="<?=get_arrangement_icon(META_PACKAGE_COURSE)?> text-yellow"></i> <span class="hidden-xs">Holiday</span></a></li>
			<?php } ?>
		</ul>
	</li>
	<?php if ($any_domain_module) {?>
	<li class="treeview">
		<a href="#">
			<i class="far fa-chart-bar"></i> 
			<span> Reports </span><i class="fa fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
		<!-- USER TYPES -->
			<li><a href="#"><i class="fa fa-book"></i> Booking Details</a>
				<ul class="treeview-menu">
				<?php if ($airline_module) { ?>
				<li><a href="<?php echo base_url().'index.php/report/flight/';?>"><i class="<?=get_arrangement_icon(META_AIRLINE_COURSE)?>"></i> Flight</a></li>
				<?php } ?>
				<?php if ($accomodation_module) { ?>
				<li><a href="<?php echo base_url().'index.php/report/hotel/';?>"><i class="<?=get_arrangement_icon(META_ACCOMODATION_COURSE)?>"></i> Hotel</a></li>
				<?php } ?>
				<?php if ($bus_module) { ?>
				<li><a href="<?php echo base_url().'index.php/report/bus/';?>"><i class="<?=get_arrangement_icon(META_BUS_COURSE)?>"></i> Bus</a></li>
				<?php } ?>
				<?php if($transfer_module){?>
					<li><a href="<?php echo base_url().'index.php/report/transfers/';?>"><i class="<?=get_arrangement_icon(META_TRANSFERV1_COURSE)?>"></i>Transfers</a></li>
				<?php }?>
				<?php if($sightseeing_module):?>
					<li><a href="<?php echo base_url().'index.php/report/activities/';?>"><i class="<?=get_arrangement_icon(META_SIGHTSEEING_COURSE)?>"></i>Activities</a></li>
				<?php endif;?>
				<?php if($car_module):?>
					<li><a href="<?php echo base_url().'index.php/report/car/';?>"><i class="<?=get_arrangement_icon(META_CAR_COURSE)?>"></i>Car</a></li>
				<?php endif;?>
				</ul>
			</li>
			<li><a href="<?php echo base_url().'index.php/management/pnr_search'?>"><i class="fa fa-search"></i> <span>PNR Search</span></a></li>
			<li><a href="<?php echo base_url().'index.php/report/flight?filter_booking_status=BOOKING_PENDING'?>"><i class="far fa-ticket"></i> <span>Pending Ticket</span></a></li>

			<li><a href="<?php echo base_url().'index.php/report/flight?daily_sales_report='.ACTIVE?>"><i class="far fa-chart-bar"></i> <span>Daily Sales Report</span></a></li>

			<li><a href="<?php echo base_url().'index.php/management/account_ledger'?>"><i class="far fa-calculator"></i> <span>Account Ledger</span></a></li>

			<li class="treeview"><a href="<?php echo base_url().'index.php/transaction/logs'?>"><i class="far fa-list-alt"></i> <span> Transaction Logs </span></a></li>
		</ul>
	</li>
	<?php
	if($airline_module || $bus_module || $sightseeing_module) {
	?>
	<li class="treeview">
		<a href="#">
			<i class="fa fa-briefcase"></i> 
			<span> My Commission</span><i class="fa fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
			<?php if ($airline_module) { ?>
			<li><a href="<?=base_url().'index.php/management/flight_commission';?>"><i class="<?=get_arrangement_icon(META_AIRLINE_COURSE)?>"></i> Flight</a></li>
			<?php } ?>
			<?php if ($bus_module) { ?>
			<li><a href="<?=base_url().'index.php/management/bus_commission';?>"><i class="<?=get_arrangement_icon(META_BUS_COURSE)?>"></i> Bus</a></li>
			<?php } ?>
			<?php if($transfer_module):?>
				<li><a href="<?=base_url().'index.php/management/transfer_commission';?>"><i class="<?=get_arrangement_icon(META_TRANSFERV1_COURSE)?>"></i>Transfers</a></li>

			<?php endif;?>
			<?php if($sightseeing_module){?>
				<li><a href="<?=base_url().'index.php/management/sightseeing_commission';?>"><i class="<?=get_arrangement_icon(META_SIGHTSEEING_COURSE)?>"></i>Activities</a></li>
			<?php }?>
		</ul>
	</li>
	<?php } ?>
	<li class="treeview">
		<a href="#">
			<i class="fa fa-plus-square"></i> 
			<span> My Markup </span><i class="fa fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
		<!-- USER TYPES -->
				<?php if ($airline_module) { ?>
				<li><a href="<?php echo base_url().'index.php/management/b2b_airline_markup/';?>"><i class="<?=get_arrangement_icon(META_AIRLINE_COURSE)?>"></i> Flight</a></li>
				
				<?php } ?>
				<?php if ($accomodation_module) { ?>
				<li><a href="<?php echo base_url().'index.php/management/b2b_hotel_markup/';?>"><i class="<?=get_arrangement_icon(META_ACCOMODATION_COURSE)?>"></i> Hotel</a></li>
				<?php } ?>
				<?php if ($bus_module) { ?>
				<li><a href="<?php echo base_url().'index.php/management/b2b_bus_markup/';?>"><i class="<?=get_arrangement_icon(META_BUS_COURSE)?>"></i> Bus</a></li>
				<?php } ?>

				<?php if ($transfer_module) { ?>
				<li><a href="<?php echo base_url().'index.php/management/b2b_transfer_markup/';?>"><i class="<?=get_arrangement_icon(META_TRANSFERV1_COURSE)?>"></i>Transfers</a></li>
				<?php } ?>

				<?php if ($sightseeing_module) { ?>
				<li><a href="<?php echo base_url().'index.php/management/b2b_sightseeing_markup/';?>"><i class="<?=get_arrangement_icon(META_SIGHTSEEING_COURSE)?>"></i>Activities</a></li>
				<?php } ?>
				<?php if($car_module){?>
				<li><a href="<?=base_url().'index.php/management/b2b_car_markup';?>"><i class="<?=get_arrangement_icon(META_CAR_COURSE)?>"></i>Car</a></li>
			<?php }?>

		</ul>
	</li>
	<?php } ?>
	
	<li class="treeview">
		<a href="#">
			<i class="fab fa-google-wallet"></i> 
			<span> Payment </span><i class="fa fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
		<!-- USER TYPES -->
			<li><a href="<?php echo base_url().'index.php/management/b2b_balance_manager'?>"><i class="fas fa-rupee-sign"></i> Update Balance</a></li>
			<li><a href="<?php echo base_url().'index.php/management/b2b_credit_limit'?>"><i class="fas fa-rupee-sign"></i> Update Credit Limit</a></li>
			<li><a href="<?php echo base_url().'index.php/management/bank_account_details'?>"><i class="fas fa-university"></i> Bank Account Details</a></li>
		</ul>
	</li>
	<li><a href="<?php echo base_url().'index.php/management/set_balance_alert'?>"><i class="fa fa-bell"></i> <span>Set Balance Alert</span></a></li>
	<li><a href="<?php echo base_url().'index.php/user/domain_logo'?>"><i class="fa fa-image"></i> <span>Logo</span></a></li>
	</ul>