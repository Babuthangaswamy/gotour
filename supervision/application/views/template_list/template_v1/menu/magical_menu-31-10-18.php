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
$sightseen_module = is_active_sightseeing_module();
$car_module = is_active_car_module();
$transferv1_module = is_active_transferv1_module();
$bb='b2b';
$bc='b2c';
$b2b = is_active_module($bb);
$b2c = is_active_module($bc);
//checking social login status 
$social_login = 'facebook';
$social = is_active_social_login($social_login);
//echo "ela".$accomodation_module;exit;
$accomodation_module = 1;
?>
<ul class="sidebar-menu" id="magical-menu">
	<li class="treeview">
		<a href="<?php echo base_url()?>">
			<i class="far fa-tachometer-alt"></i> <span>Dashboard</span> </a>
	</li>
	<?php 
	if(is_domain_user() == false) { // ACCESS TO ONLY PROVAB ADMIN ?>
	<li class="treeview">
		<a href="#">
		<i class="far fa-wrench"></i> <span>Management</span> <i class="far fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
			<li><a href="<?php echo base_url().'index.php/user/user_management'?>"><i class="far fa-user"></i> User</a></li>
			<li><a href="<?php echo base_url().'index.php/user/domain_management'?>"><i class="far fa-laptop"></i> Domain</a></li>
			<li><a href="<?php echo base_url().'index.php/module/module_management'?>"><i class="far fa-sitemap"></i> Master Module</a></li>
		</ul>
	</li>
	<?php if ($any_domain_module) {?>
	<li class="treeview">
		<a href="#">
		<i class="far fa-user"></i> <span>Markup</span> <i class="far fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
			<?php if ($airline_module) { ?>
			<li><a href="<?php echo base_url().'index.php/private_management/airline_domain_markup'?>"><i class="<?=get_arrangement_icon(META_AIRLINE_COURSE)?>"></i> Flight</a></li>
			<?php } ?>
			<?php if ($accomodation_module) { ?>
			<li><a href="<?php echo base_url().'index.php/private_management/hotel_domain_markup'?>"><i class="<?=get_arrangement_icon(META_ACCOMODATION_COURSE)?>"></i> Hotel</a></li>
			<?php } ?>
			<?php if ($bus_module) { ?>
			<li><a href="<?php echo base_url().'index.php/private_management/bus_domain_markup'?>"><i class="<?=get_arrangement_icon(META_BUS_COURSE)?>"></i> Bus</a></li>
			<?php } ?>
			<?php if ($transferv1_module) { ?>
			<li><a href="<?php echo base_url().'index.php/private_management/transfer_domain_markup'?>"><i class="<?=get_arrangement_icon(META_TRANSFERV1_COURSE)?>"></i>Transfers</a></li>
			<?php } ?>

			<?php if ($sightseen_module) { ?>
			<li><a href="<?php echo base_url().'index.php/private_management/sightseeing_domain_markup'?>"><i class="<?=get_arrangement_icon(META_SIGHTSEEING_COURSE)?>"></i>Activities</a></li>
			<?php } ?>

		</ul>
	</li>
	<?php } ?>
	<li class="treeview">
		<a href="<?php echo base_url().'index.php/private_management/process_balance_manager'?>">
			<i class="far fa-google-wallet"></i> 
			<span> Master Balance Manager </span>
		</a>
	</li>
	<li class="treeview">
		<a href="<?php echo base_url().'index.php/private_management/event_logs'?>">
			<i class="far fa-shield"></i> 
			<span> Event Logs </span>
		</a>
	</li>
	<?php } else if((is_domain_user() == true)) {
		// ACCESS TO ONLY DOMAIN ADMIN
	?>
	<!-- USER ACCOUNT MANAGEMENT -->
	<li class="treeview">
		<a href="#">
			<i class="far fa-user"></i> 
			<span> Users </span><i class="far fa-angle-left pull-right"></i></a>
		<ul class="treeview-menu">
		<!-- USER TYPES -->
			<?php if($b2c){	?>
			<li><a href="<?php echo base_url().'index.php/user/b2c_user?filter=user_type&q='.B2C_USER;?>"><i class="far fa-circle"></i> B2C</a>
				<ul class="treeview-menu">
				<li><a href="<?php echo base_url().'index.php/user/b2c_user?filter=user_type&q='.B2C_USER.'&user_status='.ACTIVE;?>"><i class="far fa-check"></i> Active</a></li>
				<li><a href="<?php echo base_url().'index.php/user/b2c_user?filter=user_type&q='.B2C_USER.'&user_status='.INACTIVE;?>"><i class="far fa-times"></i> InActive</a></li>
				<li><a href="<?php echo base_url().'index.php/user/get_logged_in_users?filter=user_type&q='.B2C_USER;?>"><i class="far fa-circle"></i> Logged In User</a></li>
				</ul>
			</li>
			<?php } ?>

			<!-- <?php if($b2b){	?>
			<li><a href="<?php //echo base_url().'index.php/user/b2b_user?filter=user_type&q='.B2B_USER ?>"><i class="far fa-circle"></i> Agents</a>
				<ul class="treeview-menu">
				<li><a href="<?php //echo base_url().'index.php/user/b2b_user?user_status='.ACTIVE;?>"><i class="far fa-check"></i> Active</a></li>
				<li><a href="<?php //echo base_url().'index.php/user/b2b_user?user_status='.INACTIVE;?>"><i class="far fa-times"></i> InActive</a></li>
				<li><a href="<?php //echo base_url().'index.php/user/get_logged_in_users?filter=user_type&q='.B2B_USER;?>"><i class="far fa-circle"></i> Logged In User</a></li>
				</ul>
			</li>
			<?php }?> -->


			<li><a href="<?php echo base_url().'index.php/user/user_management?filter=user_type&q='.SUB_ADMIN ?>"><i class="far fa-circle"></i> Sub Admin</a>
				<ul class="treeview-menu">
				<li><a href="<?php echo base_url().'index.php/user/user_management?filter=user_type&q='.SUB_ADMIN.'&user_status='.ACTIVE;?>"><i class="far fa-check"></i> Active</a></li>
				<li><a href="<?php echo base_url().'index.php/user/user_management?filter=user_type&q='.SUB_ADMIN.'&user_status='.INACTIVE;?>"><i class="far fa-times"></i> InActive</a></li>
				<li><a href="<?php echo base_url().'index.php/user/get_logged_in_users?filter=user_type&q='.SUB_ADMIN;?>"><i class="far fa-circle"></i> Logged In User</a></li>
				</ul>
			</li>
		</ul>
	</li>
	<?php if ($any_domain_module) {?>
	<li class="treeview">
		<a href="#">
			<i class="fas fa-shield"></i> 
			<span> Queues </span><i class="far fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
			<li><a href="<?php echo base_url().'index.php/report/cancellation_queue/';?>"><i class="far fa-flight"></i> Flight Cancellation </a>
		</ul>
	</li>
	<li class="treeview">
		<a href="#">
			<i class="fas fa-chart-bar"></i> 
			<span> Reports </span><i class="far fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
		<!-- USER TYPES -->
			<li><a href="#"><i class="far fa-circle"></i> B2C</a>
				<ul class="treeview-menu">
				<?php if ($airline_module) { ?>
				<li><a href="<?php echo base_url().'index.php/report/b2c_flight_report/';?>"><i class="far fa-plane"></i> Flight</a></li>
				<?php } ?>
				<?php if ($accomodation_module) { ?>
				<li><a href="<?php echo base_url().'index.php/report/b2c_hotel_report/';?>"><i class="far fa-bed"></i> Hotel</a></li>
				<?php } ?>
				<?php if ($bus_module) { ?>
				<li><a href="<?php echo base_url().'index.php/report/b2c_bus_report/';?>"><i class="<?=get_arrangement_icon(META_BUS_COURSE)?>"></i> Bus</a></li>
				<?php } ?>
				
				<?php
				   if($transferv1_module){ ?>
				   <li><a href="<?php echo base_url().'index.php/report/b2c_transfers_report/';?>"><i class="<?=get_arrangement_icon(META_TRANSFERV1_COURSE)?>"></i> Transfer</a></li>

				<?php    } 
				?>

				<?php
				   if($sightseen_module){ ?>
				   <li><a href="<?php echo base_url().'index.php/report/b2c_activities_report/';?>"><i class="<?=get_arrangement_icon(META_SIGHTSEEING_COURSE)?>"></i> Activities</a></li>

				<?php    } 
				?>
				<?php if ($car_module) { ?>
				<li><a href="<?php echo base_url().'index.php/report/b2c_car_report/';?>"><i class="<?=get_arrangement_icon(META_CAR_COURSE)?>"></i> Car</a></li>
				<?php } ?>


				</ul>
			</li>

          <!--  <li><a href="#"><i class="far fa-circle"></i> Agent b</a>
				<ul class="treeview-menu">
				<?php if ($airline_module) { ?>
				<li><a href="<?php echo base_url().'index.php/report/b2b_flight_report/';?>"><i class="far fa-plane"></i> Flight</a></li>
				<?php } ?>
				<?php if ($accomodation_module) { ?>
				<li><a href="<?php echo base_url().'index.php/report/b2b_hotel_report/';?>"><i class="far fa-bed"></i> Hotel</a></li>
				<?php } ?>
				<?php if ($bus_module) { ?>
				<li><a href="<?php echo base_url().'index.php/report/b2b_bus_report/';?>"><i class="<?=get_arrangement_icon(META_BUS_COURSE)?>"></i> Bus</a></li>
				<?php } ?>

				<?php if ($transferv1_module) { ?>
				<li><a href="<?php echo base_url().'index.php/report/b2b_transfers_report/';?>"><i class="<?=get_arrangement_icon(META_TRANSFERV1_COURSE)?>"></i>Transfers</a></li>
				<?php } ?>


			
				<?php if ($sightseen_module) { ?>
				<li><a href="<?php echo base_url().'index.php/report/b2b_activities_report/';?>"><i class="<?=get_arrangement_icon(META_SIGHTSEEING_COURSE)?>"></i> Activities</a></li>
				<?php } ?>
				<?php if ($car_module) { ?>
				<li><a href="<?php echo base_url().'index.php/report/b2b_car_report/';?>"><i class="<?=get_arrangement_icon(META_CAR_COURSE)?>"></i> Car</a></li>
				<?php } ?>
				</ul>
			</li> -->


		</ul>

		<ul class="treeview-menu">
			<!--  TYPES -->
			<li class="treeview">
				<a href="<?php echo base_url().'index.php/transaction/logs'?>">
					<i class="far fa-shield"></i> 
					<span> Transaction Logs </span>
				</a>
			</li>
			<li class="treeview">
				<a href="<?php echo base_url().'index.php/transaction/search_history'?>">
					<i class="far fa-search"></i> 
					<span> Search History </span>
				</a>
			</li>
			<li class="treeview">
				<a href="<?php echo base_url().'index.php/transaction/top_destinations'?>">
					<i class="far fa-globe"></i> 
					<span> Top Destinations</span>
				</a>
			</li>
			<li class="treeview">
				<a href="<?php echo base_url().'index.php/management/account_ledger'?>">
					<i class="fas fa-chart-bar "></i> 
					<span> Account Ledger</span>
				</a>
			</li>
		</ul>
	</li>

	<!-- <li class="treeview">
		<a href="#">
		<i class="far fa-money-bill"></i> <span>Account</span> <i class="far fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
			<li><a href="<?php echo base_url().'private_management/credit_balance'?>"><i class="far fa-circle"></i> Credit Balance</a></li>
			<li><a href="<?php echo base_url().'private_management/debit_balance'?>"><i class="far fa-circle"></i> Debit Balance</a></li>
		</ul>
	</li> -->

	<!-- <?php if($b2b) {?>
		<li class="treeview">
			<a href="#">
			<i class="far fa-briefcase"></i> <span>Commission</span> <i class="far fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li><a href="<?php echo base_url().'index.php/management/agent_commission?default_commission='.ACTIVE;?>"><i class="far fa-circle"></i> Default Commission</a></li>
				<li><a href="<?php echo base_url().'index.php/management/agent_commission'?>"><i class="far fa-circle"></i> Agent's Commission</a></li>
			</ul>
		</li>
	<?php }?> -->

	<li class="treeview">
		<a href="#">
			<i class="far fa-plus-square"></i> 
			<span> Markup </span><i class="far fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
		<!-- Markup TYPES -->
		<?php if($b2c) {?>
			<li><a href="#"><i class="far fa-circle"></i> B2C</a>
				<ul class="treeview-menu">
				<?php if ($airline_module) { ?>
				<li><a href="<?php echo base_url().'index.php/management/b2c_airline_markup/';?>"><i class="<?=get_arrangement_icon(META_AIRLINE_COURSE)?>"></i> Flight</a></li>
				<?php } ?>
				<?php if ($accomodation_module) { ?>
				<li><a href="<?php echo base_url().'index.php/management/b2c_hotel_markup/';?>"><i class="<?=get_arrangement_icon(META_ACCOMODATION_COURSE)?>"></i> Hotel</a></li>
				<?php } ?>
				<?php if ($bus_module) { ?>
				<li><a href="<?php echo base_url().'index.php/management/b2c_bus_markup/';?>"><i class="<?=get_arrangement_icon(META_BUS_COURSE)?>"></i> Bus</a></li>
				<?php }  ?>

				<?php
				   if($transferv1_module){ ?>
				   <li><a href="<?php echo base_url().'index.php/management/b2c_transfer_markup/';?>"><i class="<?=get_arrangement_icon(META_TRANSFERV1_COURSE)?>"></i> Transfers</a></li>

				<?php    } 
				?>


				<?php
				   if($sightseen_module){ ?>
				   <li><a href="<?php echo base_url().'index.php/management/b2c_sightseeing_markup/';?>"><i class="<?=get_arrangement_icon(META_SIGHTSEEING_COURSE)?>"></i> Activities</a></li>

				<?php    } 
				?>
				<?php
				   if($car_module){ ?>
				   <li><a href="<?php echo base_url().'index.php/management/b2c_car_markup/';?>"><i class="<?=get_arrangement_icon(META_CAR_COURSE)?>"></i> Car</a></li>

				<?php    } 
				?>
				</ul>
			</li>
			<?php } 
			if($b2b){	?>

			<!-- <li><a href="#"><i class="far fa-circle"></i> B2B</a>
				<ul class="treeview-menu">
				<?php if ($airline_module) { ?>
				<li><a href="<?php echo base_url().'index.php/management/b2b_airline_markup/';?>"><i class="<?=get_arrangement_icon(META_AIRLINE_COURSE)?>"></i> Flight</a></li>
				<?php } ?>
				<?php if ($accomodation_module) { ?>
				<li><a href="<?php echo base_url().'index.php/management/b2b_hotel_markup/';?>"><i class="<?=get_arrangement_icon(META_ACCOMODATION_COURSE)?>"></i> Hotel</a></li>
				<?php } ?>
				<?php if ($bus_module) { ?>
				<li><a href="<?php echo base_url().'index.php/management/b2b_bus_markup/';?>"><i class="<?=get_arrangement_icon(META_BUS_COURSE)?>"></i> Bus</a></li>
				<?php } ?>

				<?php if ($transferv1_module) { ?>
				<li><a href="<?php echo base_url().'index.php/management/b2b_transfer_markup/';?>"><i class="<?=get_arrangement_icon(META_TRANSFERV1_COURSE)?>"></i>Transfers</a></li>
				<?php } ?>


				<?php
				   if($sightseen_module){ ?>
				   <li><a href="<?php echo base_url().'index.php/management/b2b_sightseeing_markup/';?>"><i class="<?=get_arrangement_icon(META_SIGHTSEEING_COURSE)?>"></i> Activities</a></li>

				<?php    } 
				?>
				<?php
				   if($car_module){ ?>
				   <li><a href="<?php echo base_url().'index.php/management/b2b_car_markup/';?>"><i class="<?=get_arrangement_icon(META_CAR_COURSE)?>"></i> Car</a></li>

				<?php    } 
				?>
				</ul>
			</li> -->


			<?php } ?>
		</ul>
	</li>
	<?php } ?>

<!-- 	<li class="treeview">
		<a href="<?php echo base_url().'index.php/management/gst_master'?>">
			<i class="fa fa-globe"></i> 
			<span> GST Master </span>
		</a>
	</li> -->

	<?php if($b2b){	?>
	<!-- <li class="treeview">
		<a href="#">
			<i class="far fa-money-bill"></i> 
			<span> Master Balance Manager </span><i class="far fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
	
			<li><a href="<?php echo base_url().'index.php/management/master_balance_manager'?>"><i class="far fa-circle-o"></i> API</a></li>
			<li><a href="<?php echo base_url().'index.php/management/b2b_balance_manager'?>"><i class="far fa-circle"></i> B2B</a></li>
		</ul>
		 <ul class="treeview-menu">
			<li><a href="<?php echo base_url().'index.php/management/b2b_credit_request'?>"><i class="far fa-circle"></i> B2B Credit Limt Requests</a></li>
		</ul> 
	</li> -->
	
		<?php } if ($package_module) { ?>
	<li class="treeview">
		<a href="#">
			<i class="far fa-plus-square"></i> 
			<span> Package Management </span><i class="far fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
		<!-- USER TYPES -->
			<li><a href="<?php echo base_url().'index.php/supplier/view_packages_types'?>"><i class="far fa-circle"></i> View Package Types </a></li>
			<li><a href="<?php echo base_url().'index.php/supplier/add_with_price'?>"><i class="far fa-circle"></i> Add New Package </a></li>
			<li><a href="<?php echo base_url().'index.php/supplier/view_with_price'?>"><i class="far fa-circle"></i> View Packages </a></li>
			<li><a href="<?php echo base_url().'index.php/supplier/enquiries'?>"><i class="far fa-circle"></i> View Packages Enquiries </a></li>
		</ul>
	</li>
	<?php } ?>
	<li class="treeview">
		<a href="#">
			<i class="far fa-envelope"></i> 
			<span> Email Subscriptions </span><i class="far fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
		<!-- USER TYPES -->
			<li><a href="<?php echo base_url().'index.php/general/view_subscribed_emails'?>"><i class="far fa-circle"></i> View Emails </a></li>
			<!-- <li><a href="<?php echo base_url().'index.php/supplier/add_with_price'?>"><i class="far fa-circle"></i> Add New Package </a></li>
			<li><a href="<?php echo base_url().'index.php/supplier/view_with_price'?>"><i class="far fa-circle"></i> View Packages </a></li>
			<li><a href="<?php echo base_url().'index.php/supplier/enquiries'?>"><i class="far fa-circle"></i> View Packages Enquiries </a></li> -->
		</ul>
	</li>
	<?php } ?>
	<li class="treeview">
		<a href="#">
			<i class="far fa-laptop"></i>
			<span>CMS</span><i class="far fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
			<li><a href="<?php echo base_url().'index.php/user/banner_images'?>"><i class="far fa-image"></i> <span>Main Banner Image</span></a></li>
			<li><a href="<?php echo base_url().'index.php/cms/add_cms_page'?>"><i class="far fa-file-alt"></i> <span>Static Page content</span></a></li>
			
			<!-- Top Destinations START -->
				<?php if ($airline_module) { ?>
				<li class=""><a href="<?php echo base_url().'index.php/cms/flight_top_destinations'?>"><i class="far fa-plane"></i> <span>Flight Top Destinations</span></a></li>
				<?php } ?>
				<?php if ($accomodation_module) { ?>
				<li class=""><a href="<?php echo base_url().'index.php/cms/hotel_top_destinations'?>"><i class="fas fa-bed"></i> <span>Hotel Top Destinations</span></a></li>
				<?php } ?>
				<?php if ($bus_module) { ?>
				<li class=""><a href="<?php echo base_url().'index.php/cms/bus_top_destinations'?>"><i class="far fa-bus"></i> <span>Bus Top Destinations</span></a></li>
				<?php } ?>
				<li class=""><a href="<?php echo base_url().'index.php/cms/home_page_headings'?>"><i class="far fa-book"></i> <span>Home Page Headings</span></a></li>
				<li class=""><a href="<?php echo base_url().'index.php/cms/why_choose_us'?>"><i class="far fa-question"></i> <span>Why Choose Us</span></a></li>
				<li class=""><a href="<?php echo base_url().'index.php/cms/top_airlines'?>"><i class="far fa-plane"></i> <span>Top Airlines</span></a></li>
				<li class=""><a href="<?php echo base_url().'index.php/cms/tour_styles'?>"><i class="far fa-binoculars"></i> <span>Tour Styles</span></a></li>
				<li class=""><a href="<?php echo base_url().'index.php/cms/add_contact_address'?>"><i class="far fa-address-card"></i> <span>Contact Address</span></a></li>
			<!-- Top Destinations END -->
		</ul>
	</li>
	<!-- <li class="treeview">
			<a href="<?php echo base_url().'index.php/management/bank_account_details'?>">
			<i class="far fa-university"></i> <span>Bank Account Details</span> </a>
	</li> -->
	
	<!-- 
	<li class="treeview">
			<a href="<?php //echo base_url().'index.php/utilities/deal_sheets'?>">
				<i class="far fa-hand-o-right "></i> <span>Deal Sheets</span>
			</a>
	</li>
	 -->
	<li class="treeview">
		<a href="#">
			<i class="far fa-cogs"></i> 
			<span> Settings </span><i class="far fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
			<li>
				<a href="<?php echo base_url().'index.php/utilities/convenience_fees'?>"><i class="far fa-credit-card"></i>Convenience Fees</a>
			</li>

			<li>
				<a href="<?php echo base_url().'index.php/utilities/manage_promo_code'?>"><i class="far fa-tag"></i>Promo Code</a>
			</li>

			<li class="hide">
				<a href="<?php echo base_url().'index.php/utilities/manage_source'?>"><i class="far fa-database"></i> Manage API</a>
			</li>

			<li>
				<a href="<?php echo base_url().'index.php/utilities/sms_checkpoint'?>"><i class="far fa-envelope"></i> Manage SMS</a>
			</li>

			<?php if(is_domain_user() == false) { // ACCESS TO ONLY PROVAB ADMIN ?>
			<li>
				<a href="<?php echo base_url().'index.php/utilities/module'?>"><i class="far fa-circle"></i> <span>Manage Modules</span>
				</a>
			</li>
			<?php }?>

			<li>
				<a href="<?php echo base_url().'index.php/utilities/currency_converter'?>"><i class="fas fa-rupee-sign"></i> Currency Conversion </a>
			</li>

			<li>
				<a href="<?php echo base_url().'index.php/management/event_logs'?>"><i class="far fa-shield"></i> <span> Event Logs </span></a>
			</li>

			<li>
				<a href="<?php echo base_url().'index.php/utilities/app_settings'?>"><i class="far fa-laptop"></i> Appearance </a>
			</li>

			<li>
				<a href="<?php echo base_url().'index.php/utilities/social_network'?>"><i class="fab fa-facebook-square"></i> Social Networks </a>
			</li>

			<li>
				<a href="<?php echo base_url().'index.php/utilities/social_login'?>"><i class="fab fa-facebook-f"></i> Social Login </a>
			</li>

			<li>
				<a href="<?php echo base_url().'index.php/user/manage_domain'?>">
					<i class="far fa-image"></i> <span>Manage Domain</span>
				</a>
			</li>

			<li>
				<a href="<?php echo base_url()?>index.php/utilities/timeline"><i class="far fa-desktop"></i> <span>Live Events</span></a>
			</li>

			<!-- <li>
				<a href="<?=base_url().'index.php/utilities/trip_calendar'?>"><i class="far fa-calendar"></i> <span>Trip Calendar</span></a>
            </li> -->			
		</ul>
	</li>
</ul>
