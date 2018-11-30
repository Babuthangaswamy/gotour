<?php
Js_Loader::$js[] = array('src' => $GLOBALS['CI']->template->template_js_dir('page_resource/hotel_search.js'), 'defer' => 'defer');
Js_Loader::$js[] = array('src' => $GLOBALS['CI']->template->template_js_dir('page_resource/pax_count.js'), 'defer' => 'defer');
Js_Loader::$js[] = array('src' => JAVASCRIPT_LIBRARY_DIR.'jquery.jsort.0.4.min.js', 'defer' => 'defer');
echo $this->template->isolated_view('share/js/lazy_loader');
foreach ($active_booking_source as $t_k => $t_v) {
	$active_source[] = $t_v['source_id'];
}
$active_source = json_encode($active_source);
?>
<script>
var load_hotels = function(loader, offset, filters){
	offset = offset || 0;
	var url_filters = '';
	if ($.isEmptyObject(filters) == false) {
		url_filters = '&'+($.param({'filters':filters}));
	}
	_lazy_content = $.ajax({
		type: 'GET',
		url: app_base_url+'index.php/ajax/hotel_list/'+offset+'?booking_source=<?=$active_booking_source[0]['source_id']?>&search_id=<?=$hotel_search_params['search_id']?>&op=load'+url_filters,
		async: true,
		cache: true,
		dataType: 'json',
		success: function(res) {
			loader(res);
		}
	});
}

var interval_load = function (res) {
						var dui;
						var r = res;
						dui = setInterval(function(){
									if (typeof(process_result_update) != "undefined" && $.isFunction(process_result_update) == true) {
										clearInterval(dui);
										process_result_update(r);
										ini_result_update(r);
									}
							}, 1);
					};
load_hotels(interval_load);
</script>
<span class="hide">
	<input type="hidden" id="pri_search_id" value='<?=$hotel_search_params['search_id']?>'>
	<input type="hidden" id="pri_active_source" value='<?=$active_source?>'>
	<input type="hidden" id="pri_app_pref_currency" value='<?=$this->currency->get_currency_symbol(get_application_currency_preference())?>'>
</span>
<?php
$data['result'] = $hotel_search_params;
$mini_loading_image = '<div class="text-center loader-image"><img src="'.$GLOBALS['CI']->template->template_images('loader_v3.gif').'" alt="Loading........"/></div>';
$loading_image = '<div class="text-center loader-image"><img src="'.$GLOBALS['CI']->template->template_images('loader_v1.gif').'" alt="Loading........"/></div>';
$template_images = $GLOBALS['CI']->template->template_images();
echo $GLOBALS['CI']->template->isolated_view('hotel/search_panel_summary');
?>
<section class="search-result hotel_search_results">
	<div class="container"  id="page-parent">
	<?php echo $GLOBALS['CI']->template->isolated_view('share/loader/hotel_result_pre_loader',$data);?>
		<div class="resultalls">
			<div class="coleft">
				<div class="flteboxwrp">
					<div class="filtersho">
						<div class="avlhtls"><strong id="filter_records"></strong> <span class="hide"> of <strong id="total_records"><?php echo $mini_loading_image?></strong> </span> Hotels found
						</div>
					</div>
					<div class="fltrboxin">
					<form autocomplete="off">
						<div class="celsrch refine">
								<div class="row">
									<a class="pull-right" id="reset_filters">RESET ALL</a>
								</div>



<div class="chgacc">
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Price</a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
                    <?php echo $mini_loading_image?>
									<div id="price-refine" class="in">
										<div class="price_slider1">
											<div id="core_min_max_slider_values" class="hide">
											<input type="hiden" id="core_minimum_range_value" value="">
											<input type="hiden" id="core_maximum_range_value" value="">
											</div>
											<p id="hotel-price" class="level"></p>
											<div id="price-range" class="" aria-disabled="false"></div>
										</div>
									</div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Star Rating</a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>Bootstrap is a powerful front-end framework for faster and easier web development. It is a collection of CSS and HTML conventions. <a href="https://www.tutorialrepublic.com/twitter-bootstrap-tutorial/" target="_blank">Learn more.</a></p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">3. What is CSS?</a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>CSS stands for Cascading Style Sheet. CSS allows you to specify various style properties for a given HTML element such as colors, backgrounds, fonts etc. <a href="https://www.tutorialrepublic.com/css-tutorial/" target="_blank">Learn more.</a></p>
                </div>
            </div>
        </div>
    </div>
	
</div>
































								<div class="rangebox">
									<button data-target="#price-refine" data-toggle="collapse" class="collapsebtn refine-header" type="button">
								Price
								</button>
								<?php echo $mini_loading_image?>
									<div id="price-refine" class="in">
										<div class="price_slider1">
											<div id="core_min_max_slider_values" class="hide">
											<input type="hiden" id="core_minimum_range_value" value="">
											<input type="hiden" id="core_maximum_range_value" value="">
											</div>
											<p id="hotel-price" class="level"></p>
											<div id="price-range" class="" aria-disabled="false"></div>
										</div>
									</div>
								</div>

								<div class="septor"></div>

								<div class="rangebox">
								<button data-target="#collapse2" data-toggle="collapse" class="collapsebtn" type="button">
									Star Rating
								</button>
								<div id="collapse2" class="in">
									<div class="boxins marret" id="starCountWrapper">
										<a class="starone toglefil star-wrapper">
											<input class="hidecheck star-filter" type="checkbox" value="1">
											<div class="starin">
												1 <span class="starfa fa fa-star"></span>
												<span class="htlcount">-</span>
											</div>
										</a>
										<a class="starone toglefil star-wrapper">
											<input class="hidecheck star-filter" type="checkbox" value="2">
											<div class="starin">
												2 <span class="starfa fa fa-star"></span>
												<span class="htlcount">-</span>
											</div>
										</a>
										<a class="starone toglefil star-wrapper">
											<input class="hidecheck star-filter" type="checkbox" value="3">
											<div class="starin">
												3 <span class="starfa fa fa-star"></span>
												<span class="htlcount">-</span>
											</div>
										</a>
										<a class="starone toglefil star-wrapper">
											<input class="hidecheck star-filter" type="checkbox" value="4">
											<div class="starin">
												4 <span class="starfa fa fa-star"></span>
												<span class="htlcount">-</span>
											</div>
										</a>
										<a class="starone toglefil star-wrapper">
											<input class="hidecheck star-filter" type="checkbox" value="5">
											<div class="starin">
												5 <span class="starfa fa fa-star"></span>
												<span class="htlcount">-</span>
											</div>
										</a>
									</div>
								</div>
								</div>

								<div class="septor"></div>

								<div class="rangebox">
								<button data-target="#hotelsearch-refine" data-toggle="collapse" class="collapsebtn refine-header" type="button">
									Hotel Name
								</button>
								<div id="hotelsearch-refine" class="in">
									<div class="boxins">
										<div class="relinput">
											<input type="text" class="srchhtl" placeholder="Hotel name" id="hotel-name" />
											<input type="submit" class="srchsmall" id="hotel-name-search-btn" value="" />
										</div>
									</div>
								</div>
								</div>

								<div class="septor"></div>

								<div class="rangebox">
								<button data-target="#collapse2" data-toggle="collapse" class="collapsebtn" type="button">
									Hotel Location
								</button>
								<div id="collapse2" class="in">
									<div class="boxins">
										<ul class="locationul" id="hotel-location-wrapper">
										</ul>
									</div>
								</div>
								</div>

						</div>
						</form>
					</div>
				</div>
			</div>
			<div class="colrit">
			<div class="insidebosc">
			<div class="resultall">
				<div class="filter_tab fa fa-filter"></div>
				<div class="vluendsort">
					<div class="col-xs-5 nopad">
					<div class="nityvalue">
						<label type="button" class="vlulike active filter-hotels-view" for="all-hotels-view">
							<input type="radio" id="all-hotels-view" value="all" class="hide deal-status-filter" name="deal_status[]" checked="checked">
							All Hotels
						</label>
						<label type="button" class="vlulike filter-hotels-view" for="deal-hotels-view">
							<input type="radio" id="deal-hotels-view" value="filter" class="hide deal-status-filter" name="deal_status[]">
							Deal
						</label>
					</div>
					</div>
					<div class="col-xs-7 nopad">
						<div class="filterforallnty" id="top-sort-list-wrapper">
							<div class="topmistyhtl" id="top-sort-list-1">
								<div class="col-xs-12 nopad">
									<div class="insidemyt">
										<ul class="sortul">
											<li class="sortli threonly" data-sort="hn">
												<a class="sorta name-l-2-h asc" data-order="asc"><i class="fa fa-sort-alpha-asc"></i> <strong>Name</strong></a>
												<a class="sorta name-h-2-l hide des" data-order="desc"><i class="fa fa-sort-alpha-desc"></i> <strong>Name</strong></a>
											</li>
											<li class="sortli threonly" data-sort="sr">
												<a class="sorta star-l-2-h asc" data-order="asc"><i class="fa fa-star"></i> <strong>Star</strong></a>
												<a class="sorta star-h-2-l hide  des" data-order="desc"><i class="fa fa-star"></i> <strong>Star</strong></a>
											</li>
											<li class="sortli threonly" data-sort="p">
												<a class="sorta price-l-2-h asc" data-order="asc"><i class="fa fa-tag"></i> <strong>Price</strong></a>
												<a class="sorta price-h-2-l hide  des" data-order="desc"><i class="fa fa-tag"></i> <strong>Price</strong></a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php echo $loading_image;?>
				<div id="hotel_search_result" class="hotel-search-result-panel result_srch_htl">
				</div>
				<div id="npl_img" class="text-center" loaded="true">
					<?='<img src="'.$GLOBALS['CI']->template->template_images('loader_v1.gif').'" alt="Please Wait"/>'?>
				</div>
				<div id="empty_hotel_search_result"  style="display:none">
						<div class="noresultfnd">
							<div class="imagenofnd"><img src="<?=$template_images?>empty.jpg" alt="Empty" /></div>
							<div class="lablfnd">No Result Found!!!</div>
						</div>
				</div>
				<hr class="hr-10">
			</div>
			</div>
			</div>
		</div>
	</div>
	<div id="empty-search-result" class="jumbotron container" style="display:none">
		<h1><i class="fa fa-bed"></i> Oops!</h1>
		<p>No hotels were found in this location today.</p>
		<p>
		Search results change daily based on availability.If you have an urgent requirement, please get in touch with our call center using the contact details mentioned on the home page. They will assist you to the best of their ability.
		</p>
	</div>
</section>

<div class="modal fade bs-example-modal-lg" id="map-box-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Hotel Location Map</h4>
			</div>
			<div class="modal-body">
				<iframe src="" id="map-box-frame" name="map_box_frame" style="height: 500px;width: 850px;">
				</iframe>
			</div>
		</div>
	</div>
</div>

<?php
echo $this->template->isolated_view('share/media/hotel_search');
?>