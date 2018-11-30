<?php
/*$image = $banner_images ['data'] [0] ['image'];*/
$active_domain_modules = $this->active_domain_modules;
$default_active_tab = $default_view;
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

//add to js of loader
Js_Loader::$css[] = array('href' => $GLOBALS['CI']->template->template_css_dir('backslider.css'), 'media' => 'screen');
Js_Loader::$css[] = array('href' => $GLOBALS['CI']->template->template_css_dir('owl.carousel.min.css'), 'media' => 'screen');
Js_Loader::$js[] = array('src' => $GLOBALS['CI']->template->template_js_dir('owl.carousel.min.js'), 'defer' => 'defer');
 Js_Loader::$js[] = array('src' => $GLOBALS['CI']->template->template_js_dir('backslider.js'), 'defer' => 'defer');
Js_Loader::$js[] = array('src' => $GLOBALS['CI']->template->template_js_dir('page_resource/index.js'), 'defer' => 'defer');
Js_Loader::$js[] = array('src' => $GLOBALS['CI']->template->template_js_dir('page_resource/pax_count.js'), 'defer' => 'defer');
?>

 <!-- <div class="homepage-video">
    <div class="video-container">
        <video autoplay loop class="fillWidth">
            <source src="<?php echo $GLOBALS['CI']->template->template_images('video/video2.mp4')?>" type="video/mp4" />Your browser does not support the video tag. I suggest you upgrade your browser.
            <source src="<?php echo $GLOBALS['CI']->template->template_images('video/video2.mp4')?>" type="video/webm" />Your browser does not support the video tag. I suggest you upgrade your browser.
        </video>
    </div>
</div> -->

<style type="text/css">
	.topssec { background: rgba(0, 0, 0, 0.4); }
</style>

<div class="searcharea">
	<div class="srchinarea">
		<div class="container">
			<div class="captngrp">
				<div id="big1" class="bigcaption">Catch the Spirit!</div>
				<div id="desc" class="smalcaptn">More than 1000+ flights  you can search!</div>
			</div>
		</div>
		<div class="allformst">
			
			<!-- Tab panes -->
			<div class="container inspad">
			<div class="secndblak">
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

						<?php if (is_active_transferv1_module()) { ?>
						<div
							class="tab-pane <?php echo set_default_active_tab(META_TRANSFERV1_COURSE, $default_active_tab)?>"
							id="transferv1">
							<?php echo $GLOBALS['CI']->template->isolated_view('share/transferv1_search')?>
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

						<?php if (is_active_sightseeing_module()) { ?>
						<div
							class="tab-pane <?php echo set_default_active_tab(META_SIGHTSEEING_COURSE, $default_active_tab)?>"
							id="sightseeing">
							<?php echo $GLOBALS['CI']->template->isolated_view('share/sightseeing_search',$holiday_data)?>
						</div>
						<?php } ?>


						
					</div>
				</div>
			</div>

			<div class="tab_border">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs tabstab">
					<?php if (is_active_airline_module()) { ?>
					<li
						class="<?php echo set_default_active_tab(META_AIRLINE_COURSE, $default_active_tab)?>"><a
						href="#flight" role="tab" data-toggle="tab" id="fl_tab">
						<span class="sprte iconcmn"><i class="fal fa-plane"></i></span><label>Flights</label></a></li>
					<?php } ?>
					<?php if (is_active_hotel_module()) { ?>
					<li
						class="<?php echo set_default_active_tab(META_ACCOMODATION_COURSE, $default_active_tab)?>"><a
						href="#hotel" role="tab" data-toggle="tab" id="ht_tab">
						<span class="sprte iconcmn"><i class="fal fa-building"></i></span><label>Hotels</label></a></li>
					<?php } ?>

					<!-- <li class="deals"><a  target="_blank" href="http://travelomatix.com/special-fares-june2018.html"><span class="sprte iconcmn"><strong class="new_deal">New!</strong><i class="fal fa-tags"></i></span><label>Hot Deals!</label></a></li> -->

					<?php if (is_active_bus_module()) { ?>
					<li
						class="<?php echo set_default_active_tab(META_BUS_COURSE, $default_active_tab)?>"><a
						href="#bus" role="tab" data-toggle="tab">
						<span class="sprte iconcmn"><i class="fal fa-bus"></i></span><label>Buses</label></a></li>
					<?php } ?>

					<?php if (is_active_transferv1_module()) { ?>
					<li
						class="<?php echo set_default_active_tab(META_TRANSFERV1_COURSE, $default_active_tab)?>"><a
						href="#transferv1" role="tab" data-toggle="tab" id="tr_tab">
						<span class="sprte iconcmn"><i class="fal fa-taxi"></i></span><label>Ground<br>Transportation</label></a></li>
					<?php } ?>


					<?php if (is_active_car_module()) { ?>
					<li
						class="<?php echo set_default_active_tab(META_CAR_COURSE, $default_active_tab)?>"><a
						href="#car" role="tab" data-toggle="tab">
						<span class="sprte iconcmn"><i class="fal fa-car"></i></span><label>Cars</label></a></li>
					<?php } ?>	

					<?php if (is_active_sightseeing_module()) { ?>
					<li
						class="<?php echo set_default_active_tab(META_SIGHTSEEING_COURSE, $default_active_tab)?>"><a
						href="#sightseeing" role="tab"
						data-toggle="tab" id="ac_tab">
						<span class="sprte iconcmn"><i class="fal fa-binoculars"></i></span><label>Activities</label></a></li>
					<?php } ?>	
								
					<?php if (is_active_package_module()) { ?>
					<li
						class="<?php echo set_default_active_tab(META_PACKAGE_COURSE, $default_active_tab)?>"><a
						href="#holiday" role="tab"
						data-toggle="tab" id="vc_tab">
						<span class="sprte iconcmn"><i class="fal fa-tree"></i></span><label>Vacations</label></a></li>
					<?php } ?>

					
					
				</ul>
			</div>

		</div>
	</div>
	<div class="dot-overlay"></div>
</div>

<div class="clearfix"></div>
<div class="activities clearfix">
	<!-- <img src="<?php echo base_url(); ?>extras/system/template_list/template_v3/images/act_h.png" alt="Image"> -->
	<div class="act_d clearfix">
		<div class="container">
			<div class="pagehdwrap text-center">
				<h5 class="text-uppercase">Discover</h5>
				<h2>Popular Tour Holiday</h2>
			</div>
			<div class="owl-carousel owl-theme act_slide" id="act_slide">
				<div class="item">
					<a href="javascript:void(0);" class="item_in clearfix">
						<div class="item_img clearfix">
							<img src="<?php echo base_url(); ?>extras/system/template_list/template_v3/images/act1.jpg" alt="Image">
							<label>Honeymoon</label>
						</div>
						<div class="item_cont clearfix text-center">
							<small>$ 299 / person</small>
							<h4>Switzerland</h4>
							<h5>5days / 6Nights</h5>
							<div class="star_process clearfix">
								<i class="fa fa-star selected"></i>
								<i class="fa fa-star selected"></i>
								<i class="fa fa-star selected"></i>
								<i class="fa fa-star selected"></i>
								<i class="fa fa-star"></i>
							</div>
						</div>
					</a>
				</div>
				<div class="item">
					<a href="javascript:void(0);" class="item_in clearfix">
						<div class="item_img clearfix">
							<img src="<?php echo base_url(); ?>extras/system/template_list/template_v3/images/act2.jpg" alt="Image">
							<label>Holiday</label>
						</div>
						<div class="item_cont clearfix text-center">
							<small>$ 299 / person</small>
							<h4>Paris World Tour</h4>
							<h5>5days / 6Nights</h5>
							<div class="star_process clearfix">
								<i class="fa fa-star selected"></i>
								<i class="fa fa-star selected"></i>
								<i class="fa fa-star selected"></i>
								<i class="fa fa-star selected"></i>
								<i class="fa fa-star"></i>
							</div>
						</div>
					</a>
				</div>
				<div class="item">
					<a href="javascript:void(0);" class="item_in clearfix">
						<div class="item_img clearfix">
							<img src="<?php echo base_url(); ?>extras/system/template_list/template_v3/images/act3.jpg" alt="Image">
							<label>Family</label>
						</div>
						<div class="item_cont clearfix text-center">
							<small>$ 299 / person</small>
							<h4>Bangkok</h4>
							<h5>5days / 6Nights</h5>
							<div class="star_process clearfix">
								<i class="fa fa-star selected"></i>
								<i class="fa fa-star selected"></i>
								<i class="fa fa-star selected"></i>
								<i class="fa fa-star selected"></i>
								<i class="fa fa-star"></i>
							</div>
						</div>
					</a>
				</div>
				<div class="item">
					<a href="javascript:void(0);" class="item_in clearfix">
						<div class="item_img clearfix">
							<img src="<?php echo base_url(); ?>extras/system/template_list/template_v3/images/act1.jpg" alt="Image">
							<label>Honeymoon</label>
						</div>
						<div class="item_cont clearfix text-center">
							<small>$ 299 / person</small>
							<h4>Switzerland</h4>
							<h5>5days / 6Nights</h5>
							<div class="star_process clearfix">
								<i class="fa fa-star selected"></i>
								<i class="fa fa-star selected"></i>
								<i class="fa fa-star selected"></i>
								<i class="fa fa-star selected"></i>
								<i class="fa fa-star"></i>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- <div class="top_airline">
   <div class="container">
   <?php
	if(in_array('Top Deals',$headings)){?>
   <div class="org_row">
		<div class="pagehdwrap">
			<h2 class="pagehding">Top Deals</h2>
			<span><i class="fal fa-star"></i></span>
		</div>
      <div id="all_deal" class="owl-carousel owlindex3 owl-theme" >
      <?php 
      // debug($promo_code_list);exit;
      if($promo_code_list){?>
      		<?php foreach($promo_code_list as $p_key=>$p_val){

      			?>
      			<?php 
      				$current_date = date('Y-m-d');
      				$expire_date = $p_val['expiry_date'];
      			?>
      		<?php if(strtotime($current_date) < strtotime($expire_date) || $expire_date == '0000-00-00'){
      		?>
         <div class="gridItems">
            <div class="outerfullfuture">
               <div class="thumbnail_deal thumbnail_small_img">
                  <div class="lazyOwl"></div>
                  <img class="" src="<?php echo base_url(); ?>extras/system/template_list/template_v1/images/promocode/<?php echo $p_val['promo_code_image']?>" alt="Lazy Owl Image">
               </div>
               <div class="caption carousel-flight-info deals_info">
                  <div class="deals_info_heading">
                     <h1><?=$p_val['description']?></h1>
                  </div>
                  <div class="deals_info_subheading">
                     <h3>Use Coupon: <?=$p_val['promo_code']?>.</h3>
                  </div>
                  <div class="deals_info_footer">
                     <div class="pull-left validDate">Valid till : <?=date('M d, Y',strtotime($p_val['expiry_date']))?></div>
                     <div class="pull-right viewLink">
                        <a class="" href="" target="_blank">View Details</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
        <?php } ?>
        <?php } ?>
     	<?php } ?>
      </div>
   </div>
   <?php } ?>
</div>
</div> -->
<div class="clearfix"></div>
<?php 
if(in_array( 'Top Hotel Destinations', $headings )) : ?>
<div class="htldeals">
	<!-- <img src="<?php echo base_url(); ?>extras/system/template_list/template_v3/images/hotel_h.png" alt="Image"> -->
	<div class="hotel_d clearfix">
		<div class="container">
		<?php 
		if (in_array ( META_ACCOMODATION_COURSE, $active_domain_modules ) and valid_array ( $top_destination_hotel ) == true) : // TOP DESTINATION
		?>
			<div class="pagehdwrap text-center">
				<!-- <h2 class="pagehding">Top Hotel Destinations</h2>
				<span><i class="fal fa-star"></i></span> -->
				<h5 class="text-uppercase">Stay Comfort</h5>
				<h2>Top Hotels you may search</h2>
			</div>
			<div class="tophtls">
				<div class="grid">
				<div id="hotel_d" class="owl-carousel owlindex2">
					<?php
					//debug($top_destination_hotel);exit;
						// if (in_array ( META_ACCOMODATION_COURSE, $active_domain_modules ) and valid_array ( $top_destination_hotel ) == true) : // TOP DESTINATION
							foreach ( $top_destination_hotel as $tk => $tv ) :
								?>
					<?php if(($tk-0)%10 == 0){?>
					<div class="item">
					<div class="col-sm-12 col-xs-12 htd-wrap">
						<div class="effect-marley figure">
							<img
								class="lazy lazy_loader"
								src="<?php echo $GLOBALS['CI']->template->domain_images($tv['image']); ?>"
								data-src="<?php echo $GLOBALS['CI']->template->domain_images($tv['image']); ?>"
								alt="<?=$tv['city_name']?>" />
							<div class="figcaption">
							<div class="width_70">
								<h3 class="clasdstntion"><?=$tv['city_name']?></h3>
								<p>(<?=$tv['cache_hotels_count']?> Hotels)</p>
								<input type="hidden" class="top_des_id" value="<?php echo $tv['origin']?>">
								<input type="hidden"
									class="top-des-val hand-cursor"
									value="<?=hotel_suggestion_value($tv['city_name'], $tv['country_name'])?>">
								<!-- <a href="#">View more</a> -->
							</div>
							</div>

							<!-- <div class="slider-feature"> 
	                                            <ul class="hotel-feature">
	                                                <li>
	                                                    <div class="tbl-wrp">
	                                                        <div class="text-middle">
	                                                            <div class="tbl-cell">
	                                                                <i class="fal fa-car"></i> <span>CAR PARK</span> 
	                                                            </div>
	                                                        </div>
	                                                    </div>
	                                                </li>
	                                                <li>
	                                                    <div class="tbl-wrp">
	                                                        <div class="text-middle">
	                                                            <div class="tbl-cell">
	                                                                <i class="fal fa-wifi"></i> <span>INTERNET</span>
	                                                            </div>
	                                                        </div>
	                                                    </div>
	                                                </li>
	                                                <li>
	                                                    <div class="tbl-wrp">
	                                                        <div class="text-middle">
	                                                            <div class="tbl-cell">
	                                                                <i class="fal fa-utensils"></i> <span>BREAKFAST</span> 
	                                                            </div>
	                                                        </div>
	                                                    </div> 
	                                                </li>
	                                                <li> 
	                                                    <div class="tbl-wrp">
	                                                        <div class="text-middle">
	                                                            <div class="tbl-cell">
	                                                               <i class="fal fa-dumbbell"></i> <span>FITNESS CENTER</span> 
	                                                            </div>
	                                                        </div>
	                                                    </div>  
	                                                </li>
	                                            </ul>
	                        </div> -->

						</div>
					</div>
					</div>
					<?php } elseif (($tk-6)%10 == 0){ ?>
	                
	                <div class="item">
					<div class="col-sm-12 col-xs-12 htd-wrap">
						<div class="effect-marley figure">
							<img
								class="lazy lazy_loader"
								src="<?php echo $GLOBALS['CI']->template->domain_images($tv['image']); ?>"
								data-src="<?php echo $GLOBALS['CI']->template->domain_images($tv['image']); ?>"
								alt="<?=$tv['city_name']?>" />
							<div class="figcaption">
							<div class="width_70">
								<h3 class="clasdstntion"><?=$tv['city_name']?></h3>
								<p>(<?=rand(99, 500)?> Hotels)</p>
								<input type="hidden" class="top_des_id" value="<?php echo $tv['origin']?>">
								<input type="hidden"
									class="top-des-val hand-cursor"
									value="<?=hotel_suggestion_value($tv['city_name'], $tv['country_name'])?>">
								<!-- <a href="#">View more</a> -->
							</div>
							</div>

							<!-- <div class="slider-feature"> 
	                                            <ul class="hotel-feature">
	                                                <li>
	                                                    <div class="tbl-wrp">
	                                                        <div class="text-middle">
	                                                            <div class="tbl-cell">
	                                                                <i class="fal fa-car"></i> <span>CAR PARK</span> 
	                                                            </div>
	                                                        </div>
	                                                    </div>
	                                                </li>
	                                                <li>
	                                                    <div class="tbl-wrp">
	                                                        <div class="text-middle">
	                                                            <div class="tbl-cell">
	                                                                <i class="fal fa-wifi"></i> <span>INTERNET</span>
	                                                            </div>
	                                                        </div>
	                                                    </div>
	                                                </li>
	                                                <li>
	                                                    <div class="tbl-wrp">
	                                                        <div class="text-middle">
	                                                            <div class="tbl-cell">
	                                                                <i class="fal fa-utensils"></i> <span>BREAKFAST</span> 
	                                                            </div>
	                                                        </div>
	                                                    </div> 
	                                                </li>
	                                                <li> 
	                                                    <div class="tbl-wrp">
	                                                        <div class="text-middle">
	                                                            <div class="tbl-cell">
	                                                               <i class="fal fa-dumbbell"></i> <span>FITNESS CENTER</span> 
	                                                            </div>
	                                                        </div>
	                                                    </div>  
	                                                </li>
	                                            </ul>
	                        </div> -->

							
						</div>
					</div>
					</div>
					<?php } else {?>
					<div class="item">
					<div class="col-sm-12 col-xs-12 htd-wrap">
						<div class="effect-marley figure">
							<img
								class="lazy lazy_loader"
								src="<?php echo $GLOBALS['CI']->template->domain_images($tv['image']); ?>"
								data-src="<?php echo $GLOBALS['CI']->template->domain_images($tv['image']); ?>"
								alt="<?=$tv['city_name']?>" />
							<div class="figcaption">
							<div class="width_70">
								<h3 class="clasdstntion"><?=$tv['city_name']?></h3>
								<p>(<?=rand(99, 500)?> Hotels)</p>
								<input type="hidden" class="top_des_id" value="<?php echo $tv['origin']?>">
								<input type="hidden" class="top-des-val hand-cursor"
									value="<?=hotel_suggestion_value($tv['city_name'], $tv['country_name'])?>">
								<!-- <a href="#">View more</a> -->
							</div>
							</div>

							<!-- <div class="slider-feature"> 
	                                            <ul class="hotel-feature">
	                                                <li>
	                                                    <div class="tbl-wrp">
	                                                        <div class="text-middle">
	                                                            <div class="tbl-cell">
	                                                                <i class="fal fa-car"></i> <span>CAR PARK</span> 
	                                                            </div>
	                                                        </div>
	                                                    </div>
	                                                </li>
	                                                <li>
	                                                    <div class="tbl-wrp">
	                                                        <div class="text-middle">
	                                                            <div class="tbl-cell">
	                                                                <i class="fal fa-wifi"></i> <span>INTERNET</span>
	                                                            </div>
	                                                        </div>
	                                                    </div>
	                                                </li>
	                                                <li>
	                                                    <div class="tbl-wrp">
	                                                        <div class="text-middle">
	                                                            <div class="tbl-cell">
	                                                                <i class="fal fa-utensils"></i> <span>BREAKFAST</span> 
	                                                            </div>
	                                                        </div>
	                                                    </div> 
	                                                </li>
	                                                <li> 
	                                                    <div class="tbl-wrp">
	                                                        <div class="text-middle">
	                                                            <div class="tbl-cell">
	                                                               <i class="fal fa-dumbbell"></i> <span>FITNESS CENTER</span> 
	                                                            </div>
	                                                        </div>
	                                                    </div>  
	                                                </li>
	                                            </ul>
	                        </div> -->

						</div>
					</div>
					</div>
					<?php
						}
						endforeach;
						endif; // TOP DESTINATION
					?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<div class="clearfix"></div>

<?php 
if(in_array( 'Why Choose Us', $headings )) { ?>
<div class="ychoose pagehdwrap">
	<div class="container">
		<div class="col-sm-6">
			<div class="owl-carousel owl-theme chose_slide" id="chose_slide">
				<div class="item">
					<img src="<?=base_url(); ?>extras/system/template_list/template_v3/images/hol_img.png" alt="Image">	
				</div>
				<div class="item">
					<img src="<?=base_url(); ?>extras/system/template_list/template_v3/images/hol_img.png" alt="Image">	
				</div>
				<div class="item">
					<img src="<?=base_url(); ?>extras/system/template_list/template_v3/images/hol_img.png" alt="Image">	
				</div>
			</div>			
		</div>
		<div class="allys col-sm-6">
			<h4 class="text-uppercase">We are the best</h4>
			<h2>Why Choose us?</h2>
		<?php if(isset($features) && valid_array($features)) {
			$key = 1;
			foreach($features['data'] as $feature){
		?>
			<div class="col-xs-12">
				<div class="threey">
					<div class="apritopty"><i class="<?php echo $feature['icon']?>"></i></div>
					<div class="dismany">
				      	<!-- <div class="number"><?php echo '0'.$key;?>.</div> -->
						<div class="hedsprite"><?php echo $feature['title']?></div>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's </p>
					</div>
				</div>
			</div>
			<?php $key++; } } ?>
			
		</div>
	</div>
</div>
 <?php } ?>
<div class="clearfix"></div>

<!-- <?php 
if(in_array( 'Perfect Holidays', $headings )) : ?>
<div class="perhldys">
<div class="container">
		<div class="pagehdwrap">
			<h2 class="pagehding">Perfect Holidays</h2>
			<span><i class="fal fa-star"></i></span>
		</div>

		<div class="retmnus">
		
				<?php
					#debug($top_destination_package);
					#debug($top_destination_package[0]);exit; 
					$k = 0;
					#echo "total".$total;
					while ( @$total > 0 ) {
						?>	
				<div class="col-xs-4 nopad">
					<div class="col-xs-12 nopad">
						<?php for($i=1;$i<=1;$i++) { 
							#echo "kk".$k.'<br/>';
							if(isset($top_destination_package[$k])){
							$package_country = $this->package_model->getCountryName($top_destination_package[$k]->package_country);
							#debug($package_country);
							#echo "sdfsdf ".($k % 2).'<br/>';
							?>
						<div class="topone">
							<div class="inspd2 effect-lexi">
								<div class="imgeht2">
								<div class="dealimg">
									<img
										class="lazy lazy_loader"
										data-src="<? echo $GLOBALS['CI']->template->domain_upload_pckg_images(basename($top_destination_package[$k]->image)); ?>"
										alt="<?php echo $top_destination_package[$k]->package_name; ?>"
										src="<? echo $GLOBALS['CI']->template->domain_upload_pckg_images(basename($top_destination_package[$k]->image)); ?>"
										/>
								</div>
									<?php if(($k % 2) == 0) {?>
									<div class="absint2 absintcol1 ">
										<?php } else {?>
										<div class="absint2 absintcol2 ">
											<?php } ?>
											<div class="absinn">
												<div class="smilebig2">
												
													<h3><?php echo $top_destination_package[$k]->package_name; ?> </h3>
													
													<h4><?php echo $top_destination_package[$k]->package_city;?>, <?php echo $package_country->name; ?></h4>
													
												</div>
												<div class="clearfix"></div>
												
											</div>
										</div>
									</div>

									<figcaption>	
									<div class="deal_txt">
                                       
                                       <div class="col-xs-6 nopad">
                                         <img class="star_rat" src="<?php echo $GLOBALS['CI']->template->template_images('star_rating.png')?>" alt="">
                                         <h4 class="deal_price"><span>Starting at</span> <strong> <?php echo $currency_obj->get_currency_symbol($currency_obj->to_currency); ?> </strong> <?php echo isset($top_destination_package[$k]->price)?get_converted_currency_value ( $currency_obj->force_currency_conversion ( $top_destination_package[$k]->price ) ):0; ?></h4>
                                         </div>

                                          <div class="col-xs-6 nopad">
                                          <h4><?php echo isset($top_destination_package[$k]->duration)?($top_destination_package[$k]->duration-1):0; ?> Nights / <?php echo isset($top_destination_package[$k]->duration)?$top_destination_package[$k]->duration:0; ?> Days</h4> 
                                       <a class="package_dets_btn" href="<?=base_url().'index.php/tours/details/'.$top_destination_package[$k]->package_id?>">
												View details
												</a>  
									      </div>			
                                         </div>
                                     </figcaption>

								</div>
							</div>
							<?php } $k++ ;	} $total = $total-2;
								?>
						</div>
					</div>
					<?php }?>
				</div>
			
		</div>
</div>
</div>
<?php endif; ?>
<div class="clearfix"></div> -->
<!-- <?php 
if(in_array( 'Tour Style', $headings )) : ?>
<div class="intersting_facts">
        <div class="container">
            <div class="pagehdwrap">
            <h2 class="pagehding">Tour Style</h2>
            <p>“The journey not the arrival matters”</p>
             <span><i class="fal fa-star"></i></span>    
            </div>
           
            <div id="owl-demo3" class="owl-carousel owlindex3 tour_style">
            <?php if(isset($tour_styles)){
            	foreach($tour_styles['data'] as $style){
            	
            ?>
                <div class="item col-md-12 nopadding activity-search">
                	   
                        <input type="hidden" class="destination_id" name="destination_id" value="<?php echo $style['destination_id'];?>">
                        <input type="hidden" class="destination_name" name="destination_name" value="<?php echo $style['destination_name'];?>">

                         <input type="hidden" class="category_id" name="category_id" value="<?php echo $style['category_id'];?>">

                    <div class="i_facts">
                        <img src="<?= $GLOBALS['CI']->template->domain_tour_style_images($style['image']); ?>" alt="">
                     
                        <span><?php echo $style['category_name']?></span>
                    </div>
                </div>
                <?php } } ?>


            </div> 
        </div>
    </div>
 <?php endif; ?>
<div class="clearfix"></div>
<?php 
if(in_array( 'Top Airlines', $headings )) : ?>
			
			<div class="topAirlineOut">
				<div class="container">
						<div class="pagehdwrap">
							<h2 class="pagehding">Top Airlines</h2>
							<span><i class="fal fa-star"></i></span>
						</div>
						<div class="airlinecosmic">
							<div id="TopAirLine" class="owlindex2 owl-carousel owl-theme">
							<?php if(isset($top_airlines)){
								
								foreach($top_airlines['data'] as $airline){
								
								?>
								<div class="item">
									<div class="airlinepart" style="line-height: 100px !important;">
										<img src="<?php echo $GLOBALS['CI']->template->domain_top_airline_images($airline["logo"]); ?>" alt="">  
										<span class="airlin_name"><?php echo $airline['airline_name']?></span>  
									</div>
								</div>
								<?php } }?>
							
							</div>
						</div>
					</div>
				</div>
 <?php endif; ?>
				<div class="clearfix"></div> -->


<div class="spl clearfix">
	<div class="activities clearfix">
		<!-- <img src="<?php echo base_url(); ?>extras/system/template_list/template_v3/images/dest_act.jpg" alt="Image"> -->
		<div class="act_d clearfix">
			<div class="container">
				<div class="pagehdwrap text-center">
					<h5 class="text-uppercase">Attractions</h5>
					<h2>Choose your Activity</h2>
				</div>
				<div class="attr clearfix">
					<div class="col-md-3 col-sm-3 attr_div nopad">
						<a href="javascript:void(0);" class="attr_in clearfix">
							<img src="<?php echo base_url(); ?>extras/system/template_list/template_v3/images/dest1.jpg" alt="Image">
							<h5 class="text-uppercase text-center">London</h5>
						</a>
					</div>
					<div class="col-md-3 col-sm-3 attr_div nopad">
						<a href="javascript:void(0);" class="attr_in clearfix">
							<img src="<?php echo base_url(); ?>extras/system/template_list/template_v3/images/dest2.jpg" alt="Image">
							<h5 class="text-uppercase text-center">Thailand</h5>
						</a>
					</div>
					<div class="col-md-3 col-sm-3 attr_div nopad">
						<a href="javascript:void(0);" class="attr_in clearfix">
							<img src="<?php echo base_url(); ?>extras/system/template_list/template_v3/images/dest3.jpg" alt="Image">
							<h5 class="text-uppercase text-center">California</h5>
						</a>
					</div>
					<div class="col-md-3 col-sm-3 attr_div nopad">
						<a href="javascript:void(0);" class="attr_in clearfix">
							<img src="<?php echo base_url(); ?>extras/system/template_list/template_v3/images/dest4.jpg" alt="Image">
							<h5 class="text-uppercase text-center">India</h5>
						</a>
					</div>
					<div class="col-md-3 col-sm-3 attr_div nopad">
						<a href="javascript:void(0);" class="attr_in clearfix">
							<img src="<?php echo base_url(); ?>extras/system/template_list/template_v3/images/dest5.jpg" alt="Image">
							<h5 class="text-uppercase text-center">Indonesia</h5>
						</a>
					</div>
					<div class="col-md-3 col-sm-3 attr_div nopad">
						<a href="javascript:void(0);" class="attr_in clearfix">
							<img src="<?php echo base_url(); ?>extras/system/template_list/template_v3/images/dest6.jpg" alt="Image">
							<h5 class="text-uppercase text-center">Greece</h5>
						</a>
					</div>
					<div class="col-md-6 col-sm-6 attr_div nopad">
						<a href="javascript:void(0);" class="attr_in clearfix">
							<img src="<?php echo base_url(); ?>extras/system/template_list/template_v3/images/dest7.jpg" alt="Image">
							<h5 class="text-uppercase text-center">Portugal</h5>
						</a>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="spl_head clearfix text-center">
				<h5 class="text-uppercase">Discover</h5>
				<h3>Our Special Offers</h3>
			</div>
			<div class="owl-carousel owl-theme spl_slide" id="spl_slide">
				<div class="item">
						<img src="<?=base_url(); ?>extras/system/template_list/template_v3/images/spl1.jpg" alt="Image">	
					</div>
					<div class="item">
						<img src="<?=base_url(); ?>extras/system/template_list/template_v3/images/spl2.jpg" alt="Image">	
					</div>
					<div class="item">
						<img src="<?=base_url(); ?>extras/system/template_list/template_v3/images/spl1.jpg" alt="Image">	
					</div>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>

<div class="customer_section hide">
<div class="customer_pattern pagehdwrap">
<h2 class="pagehding">Our Customer Says</h2>
<span></span>
<div class="container">
    <div class="col-md-12">
      <div class="carousel slide" data-ride="carousel" id="quote-carousel">

<!-- Bottom Carousel Indicators -->
<ol class="carousel-indicators">
  <li data-target="#quote-carousel" data-slide-to="0" class="active"></li>
  <li data-target="#quote-carousel" data-slide-to="1"></li>
 </ol>
        
<div class="carousel-inner">
<!-- Quote 1 -->
<div class="item active">
	<div class="testimonial-content">
	<div class="testimonial-icon">
	<i class="fa fa-quote-left"></i>
	</div>
	<div class="row">
	<div class="col-sm-12">
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sed diam eget risus varius blandit sit amet non magna. Etiam porta sem malesuada magna mollis euismod. Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida at eget metus.</p>
	<small><strong>Vulputate M., Dolor</strong></small>
	</div>
	</div>
	</div>
  
</div>

<!-- Quote 2 -->
<div class="item">

<div class="testimonial-content">
	<div class="testimonial-icon">
	<i class="fa fa-quote-left"></i>
	</div>
	<div class="row">
	<div class="col-sm-12">
	<p>&ldquo;Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Aenean lacinia bibendum nulla sed consectetur. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.&rdquo;</p>
      <small><strong>Fringilla A., Vulputate Sit</strong></small>
	</div>
	</div>
	</div>
</div>
</div>
        

      </div>                          
    </div>
</div>
</div>
</div>



<?=$this->template->isolated_view('share/js/lazy_loader')?>

<script>
    $(document).ready(function() {
        var owl3 = $("#owl-demo3");

        owl3.owlCarousel({      
            itemsCustom : [
                [0, 1],
                [450, 2],
                [551, 3],
                [700, 4],
                [1000, 5],
                [1200, 6],
                [1400, 6],
                [1600, 6]
            ],
            navigation : false

        });
        $("#chose_slide").owlCarousel({ 
		    navigation : false, // Show next and prev buttons
		    slideSpeed : 300,
		    paginationSpeed : 400,
		    autoPlay: true,
		    singleItem:true
	  	});
	  	$("#spl_slide").owlCarousel({ 
	      	autoPlay: 3000, //Set AutoPlay to 3 seconds	 
	      	items : 2,
	      	itemsDesktop : [1199,3],
	      	pagination: false,
	      	navigation: true,
	      	navigationText: ['<i class="fa fa-long-arrow-left"></i>','<i class="fa fa-long-arrow-right"></i>'],
	      	itemsDesktopSmall : [979,3]	 
	  	});
	  	$("#hotel_d").owlCarousel({ 
	      	// autoPlay: 3000, //Set AutoPlay to 3 seconds	 
	      	items : 4,
	      	itemsDesktop : [1199,3],
	      	pagination: false,
	      	navigation: true,
	      	navigationText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
	      	itemsDesktopSmall : [979,3]	 
	  	});
	  	$("#act_slide").owlCarousel({ 
	      	// autoPlay: 3000, //Set AutoPlay to 3 seconds	 
	      	items : 3,
	      	itemsDesktop : [1199,3],
	      	pagination: true,
	      	navigation: true,
	      	navigationText: ['<i class="fa fa-long-arrow-left"></i>','<i class="fa fa-long-arrow-right"></i>'],
	      	itemsDesktopSmall : [979,3]	 
	  	});
	  	$("#fl_tab").click(function(){
	  		$(".searcharea").css('background-image','url("<?php base_url(); ?>extras/system/template_list/template_v3/images/fl_bg.jpg")');
	  	});
	  	$("#ht_tab").click(function(){
	  		$(".searcharea").css('background-image','url("<?php base_url(); ?>extras/system/template_list/template_v3/images/ht_bg.jpg")');
	  	});
	  	$("#tr_tab").click(function(){
	  		$(".searcharea").css('background-image','url("<?php base_url(); ?>extras/system/template_list/template_v3/images/tr_bg.jpg")');
	  	});
	  	$("#ac_tab").click(function(){
	  		$(".searcharea").css('background-image','url("<?php base_url(); ?>extras/system/template_list/template_v3/images/ac_bg.jpg")');
	  	});
	  	$("#vc_tab").click(function(){
	  		$(".searcharea").css('background-image','url("<?php base_url(); ?>extras/system/template_list/template_v3/images/vc_bg.jpg")');
	  	});
    });
</script>