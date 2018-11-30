<?php
$___favicon_ico = $GLOBALS ['CI']->template->domain_images('favicon/favicon.ico');
//lib
//mod
//pg
$active_domain_modules = $GLOBALS ['CI']->active_domain_modules;
$master_module_list = $GLOBALS ['CI']->config->item('master_module_list');
if (empty($default_view)) {
    $default_view = $GLOBALS ['CI']->uri->segment(1);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
        <meta name="keywords" content="<?= HEADER_TITLE_SUFFIX ?>, Flights, Hotels, Busses, Packages, Low Cost Flights">
        <meta name="description" content="Flight Bookings, Hotel Bookings, Bus Bookings, Package bookings system.">
        <meta name="author" content="travelomatix">
        <link rel="shortcut icon" href="<?= $___favicon_ico ?>" type="image/x-icon">
        <link rel="icon" href="<?= $___favicon_ico ?>" type="image/x-icon">
        <title><?php echo get_app_message('AL001') . ' ' . HEADER_TITLE_SUFFIX; ?></title>
        <!-- <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&amp;subset=latin-ext" rel="stylesheet"> -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet"> -->
        <link href="https://fonts.googleapis.com/css?family=Ropa+Sans" rel="stylesheet">
        <?php
        // Loading Common CSS and JS
        $GLOBALS ['CI']->current_page->header_css_resource();
        Js_Loader::$css[] = array('href' => $GLOBALS['CI']->template->template_css_dir('front_end.css'), 'media' => 'screen');
        $GLOBALS ['CI']->current_page->header_js_resource();
        echo $GLOBALS ['CI']->current_page->css();
        ?>
        <!-- Custom CSS -->
        <link href="<?php echo $GLOBALS['CI']->template->template_css_dir('media.css'); ?>"	rel="stylesheet" />
        <script>
            var app_base_url = "<?= base_url() ?>";
            var tmpl_img_url = '<?= $GLOBALS['CI']->template->template_images(); ?>';
<?php if (!empty($slideImageJson)) { ?>
                var slideImageJson = '<?php echo base64_encode(json_encode($slideImageJson)); ?>';
                //alert(slideImageJson);
                var tmpl_imgs = JSON.parse(atob(slideImageJson));
<?php } ?>

            var _lazy_content;
        </script>
    </head>
    <body class="<?php echo (isset($body_class) == false ? 'index_page' : $body_class) ?>">
        <div class="allpagewrp">
            <!-- Header Start -->
            <header>
                <div class="section_top">
                    <div class="container">
                        <div class="topalstn">
                            <div class="socila hidesocial">
                                <?php
                                //echo $this->CI->session('phone');
                                $temp = $this->custom_db->single_table_records('social_links');
                                if ($temp ['data'] ['0'] ['status'] == ACTIVE) {
                                    ?>
                                    <a href="<?php echo $temp['data']['0']['url_link']; ?>"><i class="fa fa-facebook"></i></a>
                                <?php } if ($temp ['data'] ['1'] ['status'] == ACTIVE) { ?>
                                    <a href="<?php echo $temp['data']['1']['url_link']; ?>"><i class="fa fa-twitter"></i></a>
                                <?php } if ($temp['data']['2']['status'] == ACTIVE) { ?>
                                    <a href="<?php echo $temp['data']['2']['url_link']; ?>"> <i class="fa fa-google-plus"></i></a>
                                <?php } if ($temp['data']['3']['status'] == ACTIVE) { ?>
                                    <a href="<?php echo $temp['data']['3']['url_link']; ?>"><i class="fa fa-youtube"></i></a>
                                <?php } ?>
                            </div>
                            <div class="toprit">
                                <div class="sectns">
                                    <a class="phnumr" href="tel:<?= $this->entity_domain_phone ?>">
                                        <span class="sprte indnum samestl"></span>
                                        <span class="numhide"><?= $this->entity_domain_phone ?></span>
                                        <div class="fa cliktocl fa-phone"></div>
                                    </a>
                                </div>
                                <div class="sectns">
                                    <a class="mailadrs" href="mailto:<?= $this->entity_domain_mail ?>">
                                        <span class="fa fa-paper-plane"></span>
                                        <?= $this->entity_domain_mail ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="topssec">
                    <div class="container">
                        <div class="bars_menu fa fa-bars menu_brgr"></div>
                        <a class="logo" href="<?= base_url() ?>">
                            <img class="tab_logo" src="<?php echo $GLOBALS['CI']->template->domain_images('mobile_logo.png'); ?>" alt="Logo" /> 
                            <img class="ful_logo" src="<?php echo $GLOBALS['CI']->template->domain_images($GLOBALS['CI']->template->get_domain_logo()); ?>"	alt="" />
                        </a>
                        <div class="menuandall">
                            <div class="sepmenus">
                                <ul class="exploreall">
                                    <?php
                                    //debug($master_module_list);exit;
                                    foreach ($master_module_list as $k => $v) {
                                        if (in_array($k, $active_domain_modules)) {
                                            ?>
                                            <li
                                                class="<?= ((@$default_view == $k || $default_view == $v) ? 'active' : '') ?>"><a
                                                    href="<?php echo base_url() ?>index.php/general/index/<?php echo ($v) ?>?default_view=<?php echo $k ?>">
                                                    <span
                                                        class="sprte cmnexplor <?= module_spirit_img(strtolower($v)) ?>"></span>
                                                    <strong><?php echo ucfirst($v); ?></strong>
                                                </a>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="ritsude">
                                <div class="sidebtn">
                                    <a class="topa logindown">
                                        <div class="reglog">
                                            <div class="userimage">
                                                <?php
                                                if (is_logged_in_user() == true && empty($GLOBALS['CI']->entity_image) == false) {
                                                    $profile_image = $GLOBALS['CI']->template->domain_images($GLOBALS['CI']->entity_image);
                                                } else {
                                                    $profile_image = $GLOBALS['CI']->template->template_images('user.png');
                                                }
                                                ?>
                                                <img src="<?php echo $profile_image; ?>" alt="" />
                                            </div>
                                            <?php if (is_logged_in_user() == false) { ?>
                                                <div class="userorlogin">My Account</div>
                                            <?php } else { ?>
                                                <div class="userorlogin"><?php echo $GLOBALS['CI']->entity_name ?></div>
                                            <?php } ?>
                                            <b class="caret cartdown"></b>
                                        </div>
                                    </a>
                                    <?= $GLOBALS['CI']->template->isolated_view('general/login') ?>
                                </div>
                                <div class="sidebtn flagss">
                                    <a class="topa dropdown-toggle" data-toggle="dropdown">
                                        <div class="reglognorml">
                                            <div class="flag_images">
                                                <?php
                                                $curr = get_application_currency_preference();

                                                echo '<span class="curncy_img sprte ' . strtolower($curr) . '"></span>'
                                                ?>
                                            </div>
                                            <div class="flags">
                                                <?php
                                                echo $curr;
                                                ?>
                                            </div>
                                            <b class="caret cartdown"></b>
                                        </div>
                                    </a>
                                    <ul class="dropdown-menu exploreul explorecntry logdowndiv">
<?= $this->template->isolated_view('utilities/multi_currency') ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Header End -->
            <div class="clearfix"></div>
            <!-- UTILITY NAV For Application MESSAGES START -->
            <div class="container-fluid utility-nav clearfix">
                <!-- ROW --> <?php
                if ($this->session->flashdata('message') != "") {
                    $message = $this->session->flashdata('message');
                    $msg_type = $this->session->flashdata('type');
                    $show_btn = TRUE;
                    if ($this->session->flashdata('override_app_msg') != "") {
                        $override_app_msg = $this->session->flashdata('override_app_msg');
                    } else {
                        $override_app_msg = FALSE;
                    }

                    echo get_message($message, $msg_type, $show_btn, $override_app_msg);
                }
                ?> <!-- /ROW -->
            </div>
            <!-- UTILITY NAV For Application MESSAGES END -->
            <!-- Body Printed Here -->
            <div class="fromtopmargin">
<?= $body ?>
            </div>
            <div class="clearfix"></div>
            <!-- Footer Start -->
            <footer>
                <div class="fstfooter">
                    <div class="container">
                        <div class="reftr">
                            <div class="col-xs-8 nopad fulnine">
                                <div class="col-xs-4 nopad">
                                    <div class="frtbest">
                                      <ul id="accordionfot" class="accordionftr">
                                        <h4 class="ftrhd arimo ">About Us</h4>

                                        <ul class="submenuftr">
                                            <?php
                                            $cond = array(
                                                'page_status' => ACTIVE
                                            );
                                            $cms_data = $this->custom_db->single_table_records('cms_pages', '', $cond);
                                            //debug($cms_data);exit;
                                            foreach ($cms_data ['data'] as $keys => $values) {
                                                if ($keys >= 4) {
                                                    break;
                                                }
                                                //echo '<li class="frteli"><a href="' . base_url () . 'index.php/general/cms/Bottom/' . $values ['page_id'] . '">' . $values ['page_title'] . ' <br> </a></li>';
                                                echo '<li class="frteli"><a href="' . base_url() . 'index.php/'.$values ['page_label'] . '">' . $values ['page_title'] . ' <br> </a></li>';
                                            }
                                            ?>
                                        </ul>


                                        </ul>
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-4 nopad">
                                    <div class="frtbest">
                                    <ul id="accordionfot1" class="accordionftr">
                                        <h4 class="ftrhd arimo ">Quick Links</h4>
                                        <ul class="submenuftr1">
                                            <?php
                                            foreach ($master_module_list as $k => $v) {
                                                if (in_array($k, $active_domain_modules)) {
                                                    ?>
                                                    <li class="frteli"><a href="<?php echo base_url() ?>index.php/general/index/<?php echo ($v) ?>?default_view=<?php echo $k ?>"><?php echo ucfirst($v); ?></a></li>
                                                    </li>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </ul>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-xs-4 nopad">
                                    <div class="frtbest">
                                        <ul id="accordionfot2" class="accordionftr">
                                        <h4 class="ftrhd arimo ">Legal</h4>
                                        <ul class="submenuftr1">
                                            <?php
                                            foreach ($cms_data ['data'] as $keys => $values) {
                                                if ($keys >= 4) {
                                                    //echo '<li class="frteli"><a href="' . base_url () . 'index.php/general/cms/Bottom/' . $values ['page_id'] . '">' . $values ['page_title'] . ' <br> </a></li>';
                                                    echo '<li class="frteli"><a href="' . base_url() . 'index.php/'.$values ['page_label'] . '">' . $values ['page_title'] . ' <br> </a></li>';
                                                }
                                            }
                                            ?>
                                        </ul>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 nopad fulnine">
                                <div class="frtbest centertio">
                                    <h4 class="ftrhd hide">Let's Social</h4>
                                    <ul class="signupfm hide">
                                        <?php
                                        if ($temp ['data'] ['0'] ['status'] == ACTIVE) {
                                            ?>
                                            <li><a href="<?php echo $temp['data']['0']['url_link']; ?>"><i
                                                        class="faftrsoc fa fa-facebook"></i></a></li>
                                            <?php } ?>
<?php if ($temp['data']['1']['status'] == ACTIVE) { ?>
                                            <li><a href="<?php echo $temp['data']['1']['url_link']; ?>"><i
                                                        class="faftrsoc fa fa-twitter"></i></a></li>
                                            <?php } ?>
<?php if ($temp['data']['2']['status'] == ACTIVE) { ?>
                                            <li><a href="<?php echo $temp['data']['2']['url_link']; ?>">
                                                    <i class="faftrsoc fa fa-google-plus"></i></a></li>
                                        <?php } ?>
<?php if ($temp['data']['3']['status'] == ACTIVE) { ?>
                                            <li><a href="<?php echo $temp['data']['3']['url_link']; ?>">
                                                    <i class="faftrsoc fa fa-youtube"></i></a></li>
<?php } ?>
                                    </ul>

                                    <div class="signfomup">
                                        <div class="formbtmns">
                                            <input type="text" name="email" id="exampleInputEmail1" class="form-control ft_subscribe" value="" required="required" placeholder="Enter Your Email">
                                        </div>
                                        <button type="button" class="btn btn_sub subsbtm" onclick="check_newsletter()">Subscribe</button>

                                    </div>

                                    <div class="footrlogo hide">

        <!--<img src="<?php echo $GLOBALS['CI']->template->domain_images('footer_' . $GLOBALS['CI']->template->get_domain_logo()); ?>" alt="" />-->
                                    </div>
                                    <span class="msgNewsLetterSubsc12" style="font-size: 13px; color: red; display: none;"><b>Please Provide Valid Email ID</b></span> <span class="succNewsLetterSubsc" style="font-size: 13px; color: #00aaee; display: none;"><b>Thank you for subscribe.We will be in touch with newsletter feed from now onwards.</b></span> <span class="msgNewsLetterSubsc" style="font-size: 13px; color: red; display: none;"><b>You are already subscribed to Newsletter feed.</b></span> <span class="msgNewsLetterSubsc1" style="font-size: 13px; color: yellow; display: none;"><b>Activated to Newsletter feed.Thank you</b></span> 

                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!-- <button type="button" class="btn btn-warning btn-xs pull-right col-md-3" data-toggle="modal" data-target="#myModal">Offline Payment</button> -->
                </div>
                <div class="clearfix"></div>


                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <form action="<?= base_url() ?>/index.php/general/offline_payment" method="post" name="offline" id="offline_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Offline Payment</h4>
                                </div>
                                <center><span class="text-success offline-msg"></span></center>

                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="usr">Company Name:</label>
                                        <input type="text" class="form-control" id="company_name" name="company_name">
                                    </div>
                                    <div class="form-group">
                                        <label for="usr">Customer Name:</label>
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="usr">Customer Email:</label>
                                        <input type="text" class="form-control" id="email" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="usr">Customer Contact No:</label>
                                        <input type="text" class="form-control" id="phone" name="phone">
                                    </div>
                                    <div class="form-group">
                                        <label for="usr">Amount:</label>
                                        <input type="text" class="form-control" id="amount" name="amount">
                                    </div>
                                    <div class="form-group">
                                        <label for="usr">Remarks:</label>
                                        <textarea class="form-control" rows="5" id="remarks" name="remarks"></textarea>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success btn-offline-pay" >Submit</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>


                <div class="btmfooter">
                    <div class="container">
                        <div class="acceptimg">
                            <img class="img-responsive"
                                 src="<?php echo $GLOBALS['CI']->template->template_images('payment.png'); ?>"
                                 alt="" />
                        </div>
                              <div class="frtbest centertio">
                                    
                                    <ul class="signupfm">
                                        <?php
                                        if ($temp ['data'] ['0'] ['status'] == ACTIVE) {
                                            ?>
                                            <li><a href="<?php echo $temp['data']['0']['url_link']; ?>"><i
                                                        class="faftrsoc fa fa-facebook"></i></a></li>
                                            <?php } ?>
<?php if ($temp['data']['1']['status'] == ACTIVE) { ?>
                                            <li><a href="<?php echo $temp['data']['1']['url_link']; ?>"><i
                                                        class="faftrsoc fa fa-twitter"></i></a></li>
                                            <?php } ?>
<?php if ($temp['data']['2']['status'] == ACTIVE) { ?>
                                            <li><a href="<?php echo $temp['data']['2']['url_link']; ?>">
                                                    <i class="faftrsoc fa fa-google-plus"></i></a></li>
                                        <?php } ?>
<?php if ($temp['data']['3']['status'] == ACTIVE) { ?>
                                            <li><a href="<?php echo $temp['data']['3']['url_link']; ?>">
                                                    <i class="faftrsoc fa fa-youtube"></i></a></li>
<?php } ?>
                                    </ul>

                                    <div class="signfomup hide">
                                        <div class="formbtmns">
                                            <input type="text" name="email" id="exampleInputEmail1" class="form-control ft_subscribe" value="" required="required" placeholder="Enter Your Email">
                                        </div>
                                        <button type="button" class="btn btn_sub subsbtm" onclick="check_newsletter()">Subscribe</button>

                                    </div>

                                    <div class="footrlogo hide">

        <!--<img src="<?php echo $GLOBALS['CI']->template->domain_images('footer_' . $GLOBALS['CI']->template->get_domain_logo()); ?>" alt="" />-->
                                    </div>
                                    <span class="msgNewsLetterSubsc12" style="font-size: 13px; color: red; display: none;"><b>Please Provide Valid Email ID</b></span> <span class="succNewsLetterSubsc" style="font-size: 13px; color: #00aaee; display: none;"><b>Thank you for subscribe.We will be in touch with newsletter feed from now onwards.</b></span> <span class="msgNewsLetterSubsc" style="font-size: 13px; color: red; display: none;"><b>You are already subscribed to Newsletter feed.</b></span> <span class="msgNewsLetterSubsc1" style="font-size: 13px; color: yellow; display: none;"><b>Activated to Newsletter feed.Thank you</b></span> 

                                </div>
                    </div>
                </div>
                <div class="btmfooternw">
                  <div class="container">
                    <div class="copyrit">
                            © 2016 <a href="http://travelomatix.com/">travelomatix.com</a> All rights reserved.
                    </div>
                  </div>
                </div>
            </footer>
            <!-- Footer End -->
        </div>
        <?php
        // Dynamic Loading of all the files needed in the application
        Js_Loader::$js[] = array('src' => $GLOBALS['CI']->template->template_js_dir('page_resource/datepicker.js'), 'defer' => 'defer');
        Provab_Page_Loader::load_core_resource_files();
        $GLOBALS ['CI']->current_page->footer_js_resource();
        echo $GLOBALS ['CI']->current_page->js();
        ?>
        <script	src="<?php echo $GLOBALS['CI']->template->template_js_dir('modernizr.custom.js'); ?>" defer></script>

        <!-- <script>
$(function() {
    var Accordion = function(el, multiple) {
        this.el = el || {};
        this.multiple = multiple || false;

        // Variables privadas
        var links = this.el.find('.link');
        // Evento
        links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
    }

    Accordion.prototype.dropdown = function(e) {
        var $el = e.data.el;
            $this = $(this),
            $next = $this.next();

        $next.slideToggle();
        $this.parent().toggleClass('open');

        if (!e.data.multiple) {
            $el.find('.submenuftr,.submenuftr1,.submenuftr2').not($next).slideUp().parent().removeClass('open');
        };
    }   

    var accordion = new Accordion($('#accordionfot,#accordionfot1,#accordionfot2'), false);
});
</script> -->
    </body>
</html>


