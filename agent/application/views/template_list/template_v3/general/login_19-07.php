<?php
if (isset($login) == false || is_object($login) == false) {
	$login = new Provab_Page_Loader('login');
}
?>




<div class="background_login">
    
    	<div class="loadcity"></div>
    
    	<div class="clodnsun"></div>
        
        <div class="reltivefligtgo">
        	<div class="flitfly"></div>
        </div>

        <div class="clearfix"></div>
        <div class="busrunning">
            <div class="runbus"></div>
            <div class="runbus2"></div>
            <div class="roadd"></div>
        </div>
    </div>



<div class="login-box log_inner">
	<figure class="login_logo">
		<img src="<?php echo $GLOBALS['CI']->template->domain_images($GLOBALS['CI']->template->get_domain_logo())?>" alt="logo"	class="img-responsive center-block">
	</figure>
	<div class="login_body">
		<div class="login_box_msg"><i class="fa fa-power-off"></i> Sign in to continue</div>
		<?php echo $login->generate_form('login', array('email' => '@gmail.com', 'password' => '')); ?>
	</div>
    <center><a href="<?=base_url().'index.php/user/agentRegister' ?>">Create an Account</a></center>
	<div class="panel_footer">
		<?php echo $GLOBALS['CI']->template->isolated_view('general/forgot-password');?>
	</div>
</div>
