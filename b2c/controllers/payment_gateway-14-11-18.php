<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
/**
 *
 * @package Provab
 * @subpackage Transaction
 * @author Pravinkuamr P <pravinkumar.provab@gmail.com>
 * @version V1
 */
class Payment_Gateway extends CI_Controller {
	/**
	 */
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'module_model' );		
	}

	function test() {
		$ebs_config = $this->config->item ( 'ebs_config' );
	}
	

	/**
	 * Redirection to payment gateway
	 * @param string $app_reference		Unique string to identify every booking - app_reference
	 * @param number $book_origin	Unique origin of booking
	 */
	public function payment($app_reference,$book_origin,$search_id=0){
		//redirect('payment_gateway/demo_booking_blocked');//Blocked the payment gateway temporarly
		//error_reporting(E_ALL);
		//echo "hi";exit;
		$this->load->model('transaction');
		$PG = $this->config->item('active_payment_gateway');

		load_pg_lib ( $PG );
		$pg_record = $this->transaction->read_payment_record($app_reference);
		$req_parms = json_decode($pg_record['request_params'],true);
		$meta_course = $req_parms['productinfo'];

		/*Ak*/
		$temp_book_origin = $book_origin;
		$book_id = $app_reference;

		$temp_booking = $this->module_model->unserialize_temp_booking_record($book_id, $temp_book_origin);
		$token_data_raw = $temp_booking['book_attributes']['token'];

		/*Ak*/

       	//$token_data = $GLOBALS['CI']->session->all_userdata();

		$token_data['token_data']['hotel_price'] = '';
       	
       	$booking_source =  $temp_booking['book_attributes']['token']['booking_source'];//$token_data['token_data']['booking_source'];
       	//load_hotel_lib($booking_source);

       	/*$token =  $token_data['token_data']['token_data'];

       	$raw_hotel_details = $this->hotel_lib->read_token($token);

       	debug($raw_hotel_details); exit;*/

		//Converting Application Payment Amount to Pyment Gateway Currency
		//debug($pg_record);exit;

		$currency_objd = new Currency ( array (
						'module_type' => 'flight',
						'from' => admin_base_currency (),
						'to' => get_application_currency_preference () 
					) );
			$currency_conversion_rate = $currency_objd->transaction_currency_conversion_rate();
			$display_amount = roundoff_number($pg_record['amount']*$currency_conversion_rate);
			$display_curr_symbl = $currency_objd->get_currency_symbol($currency_objd->to_currency);

		$pg_record['amount'] = roundoff_number(($pg_record['amount']*$pg_record['currency_conversion_rate'])*100);
	
               /* if($GLOBALS ['CI']->entity_user_id=="1539")
                {
                    $pg_record['amount']=5;
                }*/
                
		if (empty($pg_record) == false and valid_array($pg_record) == true) {
			$params = json_decode($pg_record['request_params'], true);
			$pg_initialize_data = array (
				'txnid' => $params['txnid'],
				'pgi_amount' => $pg_record['amount'],
				'firstname' => $params['firstname'],
				'email'=>$params['email'],
				'phone'=>$params['phone'],
				'productinfo'=> $params['productinfo']
			);
		} else {
			echo 'Under Construction :payment gatway';
			exit;
		}

		$page_data['session'] = $token_data;
		/*
		echo 'Payment Gateway'. $PG.'--';
		debug($page_data);
		exit;*/
		
		//defined in provab_config.php
		$payment_gateway_status = $this->config->item('enable_payment_gateway');
		if ($payment_gateway_status == true) {

			$this->pg->initialize ( $pg_initialize_data );
			$page_data['pay_data'] = $this->pg->process_payment ($app_reference);

			$page_data['pay_data']['display_amount']=$display_amount;
			$page_data['pay_data']['display_curr_symbol']=$display_curr_symbl;

			//Not to show cache data in browser
			header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
			header("Cache-Control: post-check=0, pre-check=0", false);
			header("Pragma: no-cache");
			// echo $this->template->isolated_view('payment/'.$PG.'/pay', $page_data);
			$this->template->view('payment/'.$PG.'/pay', $page_data);
		} else {
			//directly going to process booking
//			echo 'Booking Can Not Be Done!!!';
//			exit;
			redirect('accomodation/secure_booking/'.$app_reference);
			//redirect('hotel/secure_booking/'.$app_reference.'/'.$book_origin);
			//redirect('bus/secure_booking/'.$app_reference.'/'.$book_origin);
		}
	}

	function validate_stripe($txnid)
	{
		//error_reporting(E_ALL);
		$PG = $this->config->item('active_payment_gateway');
		load_pg_lib ( $PG );

		// error_reporting(E_ALL);
	    $token  = $_POST['stripeToken'];
	    $email = $_POST['stripeEmail'];
	    $token_type = $_POST['stripeTokenType'];
	    $s_url = $_POST['surl'];
	    $f_url = $_POST['furl'];
	    $response = array('email'=> $email,'card'=> $token, 'type' => $token_type);
	    
	   // debug($txnid);
	    $this->load->model('transaction');
	    $txndata = $this->transaction->read_payment_record($txnid);
	    // $PG = $this->config->item('active_payment_gateway');
	    // $data['response'] = $response;
	    // $data['txn'] = $txndata;
	    $txnamt = str_replace('.', '', $txndata['amount']);
	    $txnamt = ($txnamt*100);
	    $data = array(
	    	"amount" => $txnamt,
  			"currency" => $txndata['currency'],
  			"description" => "From Topfly Site",
  			"source" => $token
  			);
	    $charge = $this->pg->create($data);
	  	$txnrequest = json_decode($txndata['request_params']);
	  	$productinfo = $txnrequest->productinfo;

	  	// var_dump($productinfo);
	  	// debug($customer->);

	    if($charge instanceof lib\Charge) {
	    	$response = $charge->__toArray(TRUE);
	    	if($response['paid'] == true){
	   // var_dump($charge instanceof lib\Charge); exit;
	    		$this->session->set_flashdata('transaction_response', $response );
	    	redirect('payment_gateway/'.$s_url.'/'.$productinfo.'/'.$txndata['app_reference'].'/success/');
	    	} else {
	    	redirect('payment_gateway/'.$f_url.'/'.$productinfo.'/'.$txndata['app_reference']);
	    	}
	    } else {
	    	redirect('payment_gateway/'.$f_url.'/'.$productinfo.'/'.$txndata['app_reference']);
	    }
	    // $this->load->view('chargepayment')
	    // echo $this->template->isolated_view('payment/'.$PG.'/chargepayment', $data);
	}


	/* function create($params = null, $options = null)
    {
        return self::_create($params, $options);
    }*/

	/**
	 *
	 */
	function success($product, $book_id, $pg_status) {
	 	$this->load->model('transaction');
		// $product = $_REQUEST ['productinfo'];
		// $book_id = $_REQUEST ['txnid'];
		// $pg_status = $_REQUEST['status'];
		// var_dump($product);
		// var_dump($book_id);
		// var_dump($pg_status);
		// exit;
		// var_dump($response);exit;
		$temp_booking = $this->custom_db->single_table_records ( 'temp_booking', '', array (
				'book_id' => $book_id 
		) );
		/*echo $book_id; echo '<br>';
		debug($temp_booking); die();*/
		// $pg_status = $_REQUEST['status'];
		$pg_record = $this->transaction->read_payment_record($book_id);
		// debug();
		// exit;
		if ($pg_status == 'success' and empty($pg_record) == false and valid_array($pg_record) == true && valid_array ( $temp_booking ['data'] )) {
			//update payment gateway status
			// $d = json_decode($pg_record['request_params']);
			
			$response_params = $this->session->flashdata('transaction_response');
			$this->transaction->update_payment_record_status($book_id, ACCEPTED, $response_params);
			$book_origin = $temp_booking ['data'] ['0'] ['id'];
			switch ($product) {
				case META_AIRLINE_COURSE :
					redirect ( base_url () . 'index.php/flight/process_booking/' . $book_id. '/' . $book_origin );
					break;
				case META_BUS_COURSE :
					redirect ( base_url () . 'index.php/bus/process_booking/' . $book_id . '/' . $book_origin );
					break;
				case META_ACCOMODATION_COURSE :
					redirect ( base_url () . 'index.php/hotel/process_booking/' . $book_id . '/' . $book_origin );
					break;
				case META_HAJJ_UMRAH_PACKAGE:
					redirect ( base_url () . 'index.php/trips/process_booking/' . $book_id . '/' . $book_origin );
					break;
				case META_TRANSFERV1_COURSE:
				    redirect ( base_url () . 'index.php/transferv1/process_booking/' . $book_id . '/' . $book_origin );
					break;
				default :
					redirect ( base_url().'index.php/transaction/cancel' );
					break;
			}
		}
	}

	/**
	 *
	 */
	function cancel($product, $book_id) {
		$this->load->model('transaction');
		/*$product = $_REQUEST ['productinfo'];
		$book_id = $_REQUEST ['txnid'];*/
		$temp_booking = $this->custom_db->single_table_records ( 'temp_booking', '', array (
				'book_id' => $book_id 
		) );
		$pg_record = $this->transaction->read_payment_record($book_id);
		if (empty($pg_record) == false and valid_array($pg_record) == true && valid_array ( $temp_booking ['data'] )) {
			$response_params = $_REQUEST;
			$this->transaction->update_payment_record_status($book_id, DECLINED, $response_params);
			$msg = "Payment Unsuccessful, Please try again.";
			switch ($product) {
				case META_AIRLINE_COURSE :
					redirect ( base_url () . 'index.php/flight/exception?op=booking_exception&notification=' . $msg );
					break;
				case META_BUS_COURSE :
					redirect ( base_url () . 'index.php/bus/exception?op=booking_exception&notification=' . $msg );
					break;
				case META_ACCOMODATION_COURSE :
					redirect ( base_url () . 'index.php/accomodation/exception?op=booking_exception&notification=' . $msg );
					break;
				case META_HAJJ_UMRAH_PACKAGE:
					redirect ( base_url () . 'index.php/trips/exception?op=booking_exception&notification=' . $msg );
					break;				
			}
		}
	}
	public function group_payment($paydata='')
	{
		$payment_data=[];
		if($paydata!=''){
			$payment_data = json_decode(base64_decode($paydata),true);

			$currency_objd = new Currency ( array (
						'module_type' => 'flight',
						'from' => admin_base_currency (),
						'to' => get_application_currency_preference () 
					) );
			$currency_conversion_rate = $currency_objd->transaction_currency_conversion_rate();
			$display_amount = roundoff_number($payment_data['amount']*$currency_conversion_rate);
			$display_curr_symbl = $currency_objd->get_currency_symbol($currency_objd->to_currency);


			$Pg_currency = $this->config->item('payment_gateway_currency');
			$currency_obj = new Currency(array('module_type' => 'hotel', 'from' => admin_base_currency(), 'to' => $Pg_currency));
			$pg_currency_conversion_rate = $currency_obj->payment_gateway_currency_conversion_rate();

			$currency_conversion_rate = $pg_currency_conversion_rate;
			$payment_data['amount'] = roundoff_number($payment_data['amount']*$pg_currency_conversion_rate);

			

			$this->load->model('transaction');

			$PG = $this->config->item('active_payment_gateway');
			load_pg_lib ( $PG );

			$gb_txinid = $payment_data['gb_txinid'];
			$pax_email = $payment_data['email'];
			$phone = $payment_data['mobile_number'];
			$productinfo = $payment_data['module'];
			/*insert payment record*/
			$this->transaction->create_payment_record($gb_txinid, $payment_data['amount'], $payment_data['first_name'], $pax_email, $phone, $productinfo, $convenience_fees=0, $promocode_discount=0, $currency_conversion_rate);
			/*insert payment record*/
			$payment_data['amount'] = ($payment_data['amount']*100);
			$pg_initialize_data = array (
					'txnid' => $gb_txinid,
					'pgi_amount' => $payment_data['amount'],
					'firstname' => $payment_data['first_name'],
					'email'=>$pax_email,
					'phone'=>$payment_data['mobile_number'],
					'productinfo'=> $productinfo
				);

			$payment_gateway_status = $this->config->item('enable_payment_gateway');
			if ($payment_gateway_status == true) {
				$this->pg->initialize ( $pg_initialize_data );
				$page_data['pay_data'] = $this->pg->process_payment ($gb_txinid);
				
				/*change urls*/
				$page_data['pay_data']['surl']='gb_success';//base_url().'index.php/payment_gateway/gb_success';
				$page_data['pay_data']['furl']='gb_cancel';//base_url().'index.php/payment_gateway/gb_cancel';
				$page_data['pay_data']['display_amount']=$display_amount;
				$page_data['pay_data']['display_curr_symbol']=$display_curr_symbl;
				/*change urls*/
				//Not to show cache data in browser
				header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
				header("Cache-Control: post-check=0, pre-check=0", false);
				header("Pragma: no-cache");
				
				$this->template->view('payment/'.$PG.'/pay', $page_data);

			} else {
				echo 'Something went wrong!!';
			}

		}

		
	}
	function gb_success($product, $book_id, $pg_status) {
		$payment_response = json_encode(array('trans_id'=>$book_id,'status'=>'success'),true);
		//$payment_response = json_encode($_REQUEST);
		//$book_id = $_REQUEST ['productId'];
		//$this->custom_db->insert_record('test', array('test' => json_encode($_REQUEST)));
		$this->load->model('transaction');
		$pg_status = 'success';
		if ($pg_status == 'success') {
			//update payment gateway status
			$response_params = $_REQUEST;
			$this->transaction->update_payment_record_status($book_id, ACCEPTED, $response_params);

			$condition = ['app_reference'=>$book_id];
			$update_data = ['payment_response'=>$payment_response,'payment_status'=>$pg_status];

			$pg_record = $this->transaction->read_payment_record($book_id);
			$request_params = json_decode($pg_record['request_params'],true);
			$module = trim($request_params['productinfo']);
			if($module == 'flight'){
				$this->custom_db->update_record ('group_search_flight_history',$update_data, $condition);
			}else if($module == 'hotel'){
				$this->custom_db->update_record ('group_search_hotel_history',$update_data, $condition);
			}
			
			redirect ( base_url () . 'index.php/general/group_booking_success/' . $book_id );
			
		}
	}
	function gb_cancel(){

		$msg="Payment Unsuccessful, Please try again.";

		redirect ( base_url () . 'index.php/trips/exception?op=booking_exception&notification=' . $msg );
	}

	/*Visa module payement*/
	public function visa_payment($origin=0)
	{
		$payment_data=[];
		if($origin>0){

			$visa_data = $this->custom_db->single_table_records('visa_apply','*',array('id'=>$origin));
			$visa_data=  $visa_data['data'][0];


			$currency_objd = new Currency ( array (
						'module_type' => 'flight',
						'from' => admin_base_currency (),
						'to' => get_application_currency_preference () 
					) );
			$currency_conversion_rate = $currency_objd->transaction_currency_conversion_rate();
			$display_amount = roundoff_number($visa_data['visa_fee']*$currency_conversion_rate);
			$display_curr_symbl = $currency_objd->get_currency_symbol($currency_objd->to_currency);


			$Pg_currency = $this->config->item('payment_gateway_currency');
			$currency_obj = new Currency(array('module_type' => 'hotel', 'from' => admin_base_currency(), 'to' => $Pg_currency));
			$pg_currency_conversion_rate = $currency_obj->payment_gateway_currency_conversion_rate();

			$currency_conversion_rate = $pg_currency_conversion_rate;
			$payment_data['amount'] = roundoff_number($payment_data['amount']*$pg_currency_conversion_rate);

			$this->load->model('transaction');

			$PG = $this->config->item('active_payment_gateway');
			load_pg_lib ( $PG );

			$gb_txinid = $visa_data['app_reference'];
			$pax_email = $visa_data['email'];
			$phone = $visa_data['phone_number'];
			$productinfo = 'Visa Processing';
			/*insert payment record*/
			$this->transaction->create_payment_record($gb_txinid, $visa_data['visa_fee'], $visa_data['f_name'], $pax_email, $phone, $productinfo, $convenience_fees=0, $promocode_discount=0, $currency_conversion_rate);
			/*insert payment record*/
			$visa_data['visa_fee'] = ($visa_data['visa_fee']*100);
			$pg_initialize_data = array (
					'txnid' => $gb_txinid,
					'pgi_amount' => $visa_data['visa_fee'],
					'firstname' => $visa_data['f_name'],
					'email'=>$pax_email,
					'phone'=>$visa_data['phone_number'],
					'productinfo'=> $productinfo
				);

			$payment_gateway_status = $this->config->item('enable_payment_gateway');
			if ($payment_gateway_status == true) {
				$this->pg->initialize ( $pg_initialize_data );
				$page_data['pay_data'] = $this->pg->process_payment ($gb_txinid);
				
				/*change urls*/
				$page_data['pay_data']['surl']='visa_success';//base_url().'index.php/payment_gateway/visa_success';
				$page_data['pay_data']['furl']='visa_cancel';//base_url().'index.php/payment_gateway/visa_cancel';
				$page_data['pay_data']['display_amount']=$display_amount;
				$page_data['pay_data']['display_curr_symbol']=$display_curr_symbl;
				/*change urls*/
				//Not to show cache data in browser
				header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
				header("Cache-Control: post-check=0, pre-check=0", false);
				header("Pragma: no-cache");
				$this->template->view('payment/'.$PG.'/pay', $page_data);

			} else {
				echo 'Something went wrong!!';
			}

		}

		
	}

	function visa_success($product, $book_id, $pg_status) {

		$payment_response = json_encode(array('trans_id'=>$book_id,'status'=>'success'),true);
		//$payment_response = json_encode($_REQUEST);
		//$book_id = $_REQUEST ['productId'];
		$this->custom_db->insert_record('test', array('test' => json_encode($_REQUEST)));
		$this->load->model('transaction');
		$pg_status = 'SUCCESS';
		if ($pg_status == 'SUCCESS') {
			//update payment gateway status
			$response_params = $payment_response;
			$this->transaction->update_payment_record_status($book_id, ACCEPTED, $response_params);

			$condition = ['app_reference'=>$book_id];
			$update_data = ['payment_response'=>$payment_response,'payment_status'=>$pg_status];

			$pg_record = $this->transaction->read_payment_record($book_id);
			$request_params = json_decode($pg_record['request_params'],true);
			
			$this->custom_db->update_record ('visa_apply',$update_data, $condition);
			
			
			redirect ( base_url () . 'index.php/general/visa_success/' . $book_id );
			
		}
	}

	function visa_cancel(){
		$msg="Payment Unsuccessful, Please try again.";
		redirect ( base_url () . 'index.php/trips/exception?op=booking_exception&notification=' . $msg ); 
	}
	
	function transaction_log() {
		load_pg_lib ( 'PAYU' );
		echo $this->template->isolated_view ( 'payment/PAYU/pay' );
	}
}
