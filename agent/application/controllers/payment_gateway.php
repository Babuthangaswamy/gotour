<?php
if (! defined ( 'BASEPATH' ))
exit ( 'No direct script access allowed' );
/**
 *
 * @package Provab
 * @subpackage Transaction
 * @author Balu A <balu.provab@gmail.com>
 * @version V1
 */
class Payment_Gateway extends CI_Controller {
	/**
	 *
	 */
	public function __construct() {
		parent::__construct ();
		// $this->output->enable_profiler(TRUE);
		$this->load->model ( 'module_model' );
	}

	/**
	 * Redirection to payment gateway
	 * @param string $book_id		Unique string to identify every booking - app_reference
	 * @param number $book_origin	Unique origin of booking
	 */
	public function payment($book_id,$book_origin)
	{
		$this->load->model('transaction');
		$PG = $this->config->item('active_payment_gateway');
		load_pg_lib ( $PG );

		$pg_record = $this->transaction->read_payment_record($book_id);
		// debug($pg_record);exit;
		$temp_booking = $this->custom_db->single_table_records ( 'temp_booking', '', array (
				'book_id' => $book_id 
		) );
		$book_origin = $temp_booking ['data'] ['0'] ['id'];

		if (empty($pg_record) == false and valid_array($pg_record) == true) {
			$params = json_decode($pg_record['request_params'], true);
			/*
			$pg_initialize_data = array (
				'txnid' => $params['txnid'],
				'pgi_amount' => ceil($pg_record['amount']),
				'firstname' => $params['firstname'],
				'email'=>$params['email'],
				'phone'=>$params['phone'],
				'productinfo'=> $params['productinfo']
			);*/
		} else {
			echo 'Under Construction :p';
			exit;
		}
		//defined in provab_config.php
		$payment_gateway_status = $this->config->item('enable_payment_gateway');
		if ($payment_gateway_status == true) {
			/*$this->pg->initialize ( $pg_initialize_data );
			$page_data['pay_data'] = $this->pg->process_payment ();
			//Not to show cache data in browser
			header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
			header("Cache-Control: post-check=0, pre-check=0", false);
			header("Pragma: no-cache");
			echo $this->template->isolated_view('payment/'.$PG.'/pay', $page_data);*/
		} else {
			//directly going to process booking
			$this->redirect_booking($params['productinfo'], $params['txnid'], $book_origin);
		}
	}

	/**
	 *
	 */
	function success() {
		$this->load->model('transaction');
		$product = $_REQUEST ['productinfo'];
		$book_id = $_REQUEST ['txnid'];
		$temp_booking = $this->custom_db->single_table_records ( 'temp_booking', '', array (
				'book_id' => $book_id 
		) );
		$pg_status = $_REQUEST['status'];
		$pg_record = $this->transaction->read_payment_record($book_id);
		if ($pg_status == 'success' and empty($pg_record) == false and valid_array($pg_record) == true && valid_array ( $temp_booking ['data'] )) {
			//update payment gateway status
			$response_params = $_REQUEST;
			$this->transaction->update_payment_record_status($book_id, ACCEPTED, $response_params);
			$book_origin = $temp_booking ['data'] ['0'] ['id'];
			$this->redirect_booking($product, $book_id, $book_origin);

		}
	}

	private function redirect_booking($product, $book_id, $book_origin)
	{
		switch ($product) {
			case META_AIRLINE_COURSE :
				redirect ( base_url () . 'index.php/flight/process_booking/' . $book_id . '/' . $book_origin );
				break;
			case META_BUS_COURSE :
				redirect ( base_url () . 'index.php/bus/process_booking/' . $book_id . '/' . $book_origin );
				break;
			case META_ACCOMODATION_COURSE :
				redirect ( base_url () . 'index.php/hotel/process_booking/' . $book_id . '/' . $book_origin );
				break;
			case META_CAR_COURSE :
				redirect ( base_url () . 'index.php/car/process_booking/' . $book_id . '/' . $book_origin );
				break;
			default :
				redirect ( base_url().'index.php/transaction/cancel' );
				break;
		}
	}

	/**
	 *
	 */
	function cancel() {
		$this->load->model('transaction');
		$product = $_REQUEST ['productinfo'];
		$book_id = $_REQUEST ['txnid'];
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
					redirect ( base_url () . 'index.php/hotel/exception?op=booking_exception&notification=' . $msg );
					break;
			}
		}
	}


	function transaction_log(){
		load_pg_lib('PAYU');
		echo $this->template->isolated_view('payment/PAYU/pay');
	}
}