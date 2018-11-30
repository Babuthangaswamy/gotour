<?php
/*
debug($session);
debug($search_data);
debug($pay_data);  exit;*/

/*$hotel_price = $session['token_data']['hotel_price'];
$tax = number_format($session['token_data']['hotel_tax'],2);
$conven_fees = number_format($session['token_data']['conven_fees'],2);

$sub_total = number_format(($hotel_price - $tax),2);

$guest_count = '0';
$adult_count = $child_count = '0';
$check_in_date = date('d', strtotime($search_data['from_date']));
$check_in_month = date('M', strtotime($search_data['from_date']));
$check_in_year = date('Y', strtotime($search_data['from_date']));

$check_out_date = date('d', strtotime($search_data['to_date']));
$check_out_month = date('M', strtotime($search_data['to_date']));
$check_out_year = date('Y', strtotime($search_data['to_date']));

$no_of_nights = $search_data['no_of_nights'];
$room_count = $search_data['room_count'];

for($i=0; $i< count($search_data['adult_config']); $i++)
{
  $adult_count += $search_data['adult_config'][$i];  
}
for($j=0; $j< count($search_data['child_config']); $j++)
{
  $child_count += $search_data['child_config'][$j];
}

$guest_count = $adult_count + $child_count;*/


$key =  $pay_data['apikey'];
$txnid = empty($pay_data['txnid']) ?  rand(000000,99999999999) : $pay_data['txnid'];
$amount = $pay_data['amount'];
$product_info = $pay_data['productinfo'];
$firstname = $pay_data['firstname'];
$phone = empty($pay_data['phone']) ? '' : $pay_data['phone'];
$email = empty($pay_data['email']) ? '' : $pay_data['email'];
$client_id = $pay_data['client_id']; 
$udf1 = empty($pay_data['udf1']) ? "name" : $pay_data['udf1'];
$furl = $pay_data['furl'];
$surl = $pay_data['surl'];
$action = $pay_data['pay_target_url']."?response_type=code&client_id=".$client_id."&scope=read_only";
?>
<html>
<head>

   <script>
    function submitPayuForm() {
      var payForm  = document.forms["payment"];
      payForm.submit();      
    } //onload="submitPayuForm()"
  </script> 
</head>
<body>


<div class="container">
  <div class="col-xs-12 pamentotur">

  <div class="col-xs-8 nopad fullcard full_room_buk">
    <div class="price_htlin">
      <div class="strip_img">
       <span class=""><?php echo $this->lang->line('visa_paywith');?></span>
       <img class="" src="<?php echo $GLOBALS['CI']->template->template_images('social.png'); ?>" alt="" />
      </div>
      <div class="clearfix"></div>
      <ul>
        <li class="baseli hedli hide">
          <ul>
            <li class="wid10 hide">Room</li>
            <li class="wid20">Guest</li>
            <li class="wid20">Price/Night</li>
            <li class="wid20">Extras</li>
            <li class="wid10 hide">Night(s)</li>
            <li class="textrit">Total Price</li>
          </ul>
        </li>
        <li class="baseli secf hide">
          <ul class="responsive_li">
            <li class="wid10 hide"><span class="res_op">Room</span>1</li>
            <li class="wid20">
              <div class="plusic">
                <div class="left adultic fa fa-male"></div>
                <div class="left cunt"><span class="res_op">Guest</span><span class="resrgtfld"><?php echo $guest_count; ?></span></div>
              </div>
            </li>
            <li class="wid20">
              <span class="res_op">Price/Night</span><span class="resrgtfld"><?php echo $session['token_data']['default_currency'].'&nbsp;'.$sub_total; ?></span>
            </li>
            <li class="wid20 cacletooltip">
            <span class="res_op">Extras</span>
              <a class="resrgtfld" data-toggle="tooltip" data-placement="top" title="<?php echo @$session['token_data']['cancellation']; ?>">Cancellation Policy</a>
            </li>
            <li class="wid10 hide"><span class="res_op">Night(s)</span>1</li>
            <li class=" textrit"><span class="res_op">Total Price</span><?php echo @$session['token_data']['default_currency'].'&nbsp;'.@$sub_total; ?></li>
          </ul>
        </li>
        <li class="baselicenter hide">
          <div class="wid80 left textrit txtresponfld">Tax</div>
          <div class="wid20 left textrit"><?php echo $session['token_data']['default_currency'].'&nbsp;'.$tax; ?></div>
        </li> 
        <li class="baselicenter hide">
          <div class="wid80 left textrit txtresponfld">Convenience fee</div>
          <div class="wid20 left textrit"><?php echo $session['token_data']['default_currency'].'&nbsp;'.$conven_fees; ?></div>
        </li>
        <li class="baselicenter hide"></li>
        <li class="baseli price_cet ">
          <div class="bigtext colrdark">
            <span class="grdtol"><?php echo $this->lang->line('visa_grandtotal');?></span>
            <div class="priceflights">
             <strong> <?php echo $pay_data['display_curr_symbol']; ?> </strong>
              <span class="h-p"><?php echo $pay_data['display_amount']; ?></span>
              /-
            </div>
            
          </div>
          <!-- <div class="price_ours">
            
          </div> -->
        </li>
        <li class="pwc">
            <form action="<?php echo base_url(); ?>index.php/payment_gateway/validate_stripe/<?php echo $txnid ?>" method="POST" name="payment">
            <input type="hidden" name="surl" value="<?=$surl?>">
            <input type="hidden" name="furl" value="<?=$furl?>">
              <script
                src="https://checkout.stripe.com/v2/checkout.js" class="stripe-button"
                data-key="<?php echo $key; ?>"
                data-amount="<?php echo $amount; ?>"
                data-name="TopFly"
                data-description="<?php echo $product_info; ?>"
                data-email="<?php echo $email; ?>"
                data-currency="USD"
                data-image="<?php echo $GLOBALS['CI']->template->domain_images($GLOBALS['CI']->template->get_domain_logo()); ?>">
              </script>
            </form>
        </li>
      </ul>
    </div>
  </div>
  <!-- <div class="col-xs-12 nopad">
    <form action="<?php echo base_url(); ?>index.php/payment_gateway/validate_stripe/<?php echo $txnid ?>" method="POST" name="payment">
  <script
    src="https://checkout.stripe.com/v2/checkout.js" class="stripe-button"
    data-key="<?php echo $key; ?>"
    data-amount="<?php echo $amount; ?>"
    data-name="Ga Tours GmbH"
    data-description="<?php echo $product_info; ?>"
    data-email="<?php echo $email; ?>"
    data-currency="AUD"
    data-image="<?php echo $GLOBALS['CI']->template->domain_images($GLOBALS['CI']->template->get_domain_logo()); ?>">
  </script>
</form>
  </div>
   -->
</div>

</div>



</body>
</html>
