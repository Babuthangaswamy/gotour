<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * @package    Provab - Provab Application
 * @subpackage Travel Portal
 * @author     Balu A<balu.provab@gmail.com>
 * @version    V2
 */

class Report extends CI_Controller {
	private $current_module;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('bus_model');
		$this->load->model('hotel_model');
		$this->load->model('flight_model');
		$this->load->model('sightseeing_model');
		$this->load->model('transferv1_model');
		$this->load->model('car_model');
		$this->load->model('user_model');
		$this->load->library('booking_data_formatter');
		$this->current_module = $this->config->item('current_module');
//		$this->load->library('export');

	}
	function index()
	{
		redirect('general');
	}

	function monthly_booking_report()
	{
		$this->template->view('report/monthly_booking_report');
	}


	function bus($offset=0)
	{
		$get_data = $this->input->get();
		$condition = array();
		$page_data = array();
		if(valid_array($get_data) == true) {
			//From-Date and To-Date
			$from_date = trim(@$get_data['created_datetime_from']);
			$to_date = trim(@$get_data['created_datetime_to']);
			//Auto swipe date
			if(empty($from_date) == false && empty($to_date) == false)
			{
				$valid_dates = auto_swipe_dates($from_date, $to_date);
				$from_date = $valid_dates['from_date'];
				$to_date = $valid_dates['to_date'];
			}
			if(empty($from_date) == false) {
				$condition[] = array('BD.created_datetime', '>=', $this->db->escape(db_current_datetime($from_date)));
			}
			if(empty($to_date) == false) {
				$condition[] = array('BD.created_datetime', '<=', $this->db->escape(db_current_datetime($to_date)));
			}

			if (empty($get_data['created_by_id']) == false) {
				$condition[] = array('BD.created_by_id', '=', $this->db->escape($get_data['created_by_id']));
			}

			if (empty($get_data['status']) == false && strtolower($get_data['status']) != 'all') {
				$condition[] = array('BD.status', '=', $this->db->escape($get_data['status']));
			}

			if (empty($get_data['phone']) == false) {
				$condition[] = array('BD.phone_number', ' like ', $this->db->escape('%'.$get_data['phone'].'%'));
			}

			if (empty($get_data['email']) == false) {
				$condition[] = array('BD.email', ' like ', $this->db->escape('%'.$get_data['email'].'%'));
			}

			if (empty($get_data['app_reference']) == false) {
				$condition[] = array('BD.app_reference', ' like ', $this->db->escape('%'.$get_data['app_reference'].'%'));
			}
			$page_data['from_date'] = $from_date;
			$page_data['to_date'] = $to_date;
		}
		$total_records = $this->bus_model->booking($condition, true);
		$table_data = $this->bus_model->booking($condition, false, $offset, RECORDS_RANGE_2);
		$table_data = $this->booking_data_formatter->format_bus_booking_data($table_data,$this->current_module);
		$page_data['table_data'] = $table_data['data'];
		/** TABLE PAGINATION */
		$this->load->library('pagination');
		if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['base_url'] = base_url().'index.php/report/bus/';
		$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
		$page_data['total_rows'] = $config['total_rows'] = $total_records;
		$config['per_page'] = RECORDS_RANGE_2;
		$this->pagination->initialize($config);
		/** TABLE PAGINATION */
		$page_data['total_records'] = $config['total_rows'];
		$page_data['customer_email'] = $this->entity_email;
		$page_data['search_params'] = $get_data;
		$page_data['status_options'] = get_enum_list('booking_status_options');
		$this->template->view('report/bus', $page_data);
	}

	function hotel($offset=0)
	{
		$condition = array();
		$get_data = $this->input->get();
		if(valid_array($get_data) == true) {
			//From-Date and To-Date
			$from_date = trim(@$get_data['created_datetime_from']);
			$to_date = trim(@$get_data['created_datetime_to']);
			//Auto swipe date
			if(empty($from_date) == false && empty($to_date) == false)
			{
				$valid_dates = auto_swipe_dates($from_date, $to_date);
				$from_date = $valid_dates['from_date'];
				$to_date = $valid_dates['to_date'];
			}
			if(empty($from_date) == false) {
				$condition[] = array('BD.created_datetime', '>=', $this->db->escape(db_current_datetime($from_date)));
			}
			if(empty($to_date) == false) {
				$condition[] = array('BD.created_datetime', '<=', $this->db->escape(db_current_datetime($to_date)));
			}

			if (empty($get_data['created_by_id']) == false) {
				$condition[] = array('BD.created_by_id', '=', $this->db->escape($get_data['created_by_id']));
			}

			if (empty($get_data['status']) == false && strtolower($get_data['status']) != 'all') {
				$condition[] = array('BD.status', '=', $this->db->escape($get_data['status']));
			}

			if (empty($get_data['phone']) == false) {
				$condition[] = array('BD.phone_number', ' like ', $this->db->escape('%'.$get_data['phone'].'%'));
			}

			if (empty($get_data['email']) == false) {
				$condition[] = array('BD.email', ' like ', $this->db->escape('%'.$get_data['email'].'%'));
			}

			if (empty($get_data['app_reference']) == false) {
				$condition[] = array('BD.app_reference', ' like ', $this->db->escape('%'.$get_data['app_reference'].'%'));
			}
			$page_data['from_date'] = $from_date;
			$page_data['to_date'] = $to_date;
		}
		$total_records = $this->hotel_model->booking($condition, true);
		$table_data = $this->hotel_model->booking($condition, false, $offset, RECORDS_RANGE_2);
		$table_data = $this->booking_data_formatter->format_hotel_booking_data($table_data,$this->current_module);
		$page_data['table_data'] = $table_data['data'];
		$this->load->library('pagination');
		if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['base_url'] = base_url().'index.php/report/hotel/';
		$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
		$page_data['total_rows'] = $config['total_rows'] = $total_records;
		$config['per_page'] = RECORDS_RANGE_2;
		$this->pagination->initialize($config);
		/** TABLE PAGINATION */
		$page_data['total_records'] = $config['total_rows'];
		//debug($page_data);exit;
		$page_data['search_params'] = $get_data;
		$page_data['status_options'] = get_enum_list('booking_status_options');
		$this->template->view('report/hotel', $page_data);
	}

	
	
	
	function b2c_bus_report($offset=0)
	{
		$get_data = $this->input->get();
		$condition = array();
		$page_data = array();

		$filter_data = $this->format_basic_search_filters('bus');
		$page_data['from_date'] = $filter_data['from_date'];
		$page_data['to_date'] = $filter_data['to_date'];
		$condition = $filter_data['filter_condition'];

		//debug($get_data); die;
		/*if(valid_array($get_data) == true) {
			//From-Date and To-Date
			$from_date = trim(@$get_data['created_datetime_from']);
			$to_date = trim(@$get_data['created_datetime_to']);
			//Auto swipe date
			if(empty($from_date) == false && empty($to_date) == false)
			{
				$valid_dates = auto_swipe_dates($from_date, $to_date);
				$from_date = $valid_dates['from_date'];
				$to_date = $valid_dates['to_date'];
			}
			if(empty($from_date) == false) {
				$condition[] = array('BD.created_datetime', '>=', $this->db->escape(db_current_datetime($from_date)));
			}
			if(empty($to_date) == false) {
				$condition[] = array('BD.created_datetime', '<=', $this->db->escape(db_current_datetime($to_date)));
			}
	
			if (empty($get_data['created_by_id']) == false) {
				$condition[] = array('BD.created_by_id', '=', $this->db->escape($get_data['created_by_id']));
			}
	
			if (empty($get_data['status']) == false && strtolower($get_data['status']) != 'all') {
				$condition[] = array('BD.status', '=', $this->db->escape($get_data['status']));
			}
	
			// if (empty($get_data['phone']) == false) {
			// 	$condition[] = array('BD.phone_number', ' like ', $this->db->escape('%'.$get_data['phone'].'%'));
			// }
	
			// if (empty($get_data['email']) == false) {
			// 	$condition[] = array('BD.email', ' like ', $this->db->escape('%'.$get_data['email'].'%'));
			// }
	
			if (empty($get_data['app_reference']) == false) {
				$condition[] = array('BD.app_reference', ' like ', $this->db->escape('%'.$get_data['app_reference'].'%'));
			}
			if (empty($get_data['pnr']) == false) {
				$condition[] = array('BD.pnr', ' like ', $this->db->escape('%'.$get_data['pnr'].'%'));
			}
			$page_data['from_date'] = $from_date;
			$page_data['to_date'] = $to_date;
		}*/
	
		$total_records = $this->bus_model->b2c_bus_report($condition, true);
		$table_data = $this->bus_model->b2c_bus_report($condition, false, $offset, RECORDS_RANGE_2);
		$table_data = $this->booking_data_formatter->format_bus_booking_data($table_data,$this->current_module);
		
		$page_data['table_data'] = $table_data['data'];

		//debug($table_data); exit;

		/** TABLE PAGINATION */
		$this->load->library('pagination');
		if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['base_url'] = base_url().'index.php/report/b2c_bus_report/';
		$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
		$page_data['total_rows'] = $config['total_rows'] = $total_records;
		$config['per_page'] = RECORDS_RANGE_2;
		$this->pagination->initialize($config);
		/** TABLE PAGINATION */
		$page_data['total_records'] = $config['total_rows'];
		$page_data['customer_email'] = $this->entity_email;
		$page_data['search_params'] = $get_data;
		$page_data['status_options'] = get_enum_list('booking_status_options');
		//debug($page_data); die;
		$this->template->view('report/b2c_report_bus', $page_data);
	}
	
	
	function b2b_bus_report($offset=0)
	{
		$get_data = $this->input->get();
		$condition = array();
		$page_data = array();

		$filter_data = $this->format_basic_search_filters('bus');
		$page_data['from_date'] = $filter_data['from_date'];
		$page_data['to_date'] = $filter_data['to_date'];
		$condition = $filter_data['filter_condition'];

		//debug($condition); die;
		$total_records = $this->bus_model->b2b_bus_report($condition, true);
		$table_data = $this->bus_model->b2b_bus_report($condition, false, $offset, RECORDS_RANGE_2);
		$table_data = $this->booking_data_formatter->format_bus_booking_data($table_data,'b2b');
		$page_data['table_data'] = $table_data['data'];
		/** TABLE PAGINATION */
		$this->load->library('pagination');
		if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['base_url'] = base_url().'index.php/report/b2b_bus_report/';
		$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
		$page_data['total_rows'] = $config['total_rows'] = $total_records;
		$config['per_page'] = RECORDS_RANGE_2;
		$this->pagination->initialize($config);
		/** TABLE PAGINATION */
		$page_data['total_records'] = $config['total_rows'];
		$page_data['customer_email'] = $this->entity_email;
		$page_data['search_params'] = $get_data;
		$page_data['status_options'] = get_enum_list('booking_status_options');

		$agent_info = $this->custom_db->single_table_records('user','*',array('user_type'=>B2B_USER,'domain_list_fk'=>get_domain_auth_id()));
		
		$page_data['agent_details'] = magical_converter(array('k' => 'user_id', 'v' => 'agency_name'), $agent_info);

		$this->template->view('report/b2b_report_bus', $page_data);
	}
	
	
	
	function b2b_hotel_report($offset=0)
	{
		$condition = array();
		$get_data = $this->input->get();

		$filter_data = $this->format_basic_search_filters();
		$page_data['from_date'] = $filter_data['from_date'];
		$page_data['to_date'] = $filter_data['to_date'];
		$condition = $filter_data['filter_condition'];
		
		$total_records = $this->hotel_model->b2b_hotel_report($condition, true);
		$table_data = $this->hotel_model->b2b_hotel_report($condition, false, $offset, RECORDS_RANGE_2);
		$table_data = $this->booking_data_formatter->format_hotel_booking_data($table_data, $this->current_module);
		$page_data['table_data'] = $table_data['data'];
		$this->load->library('pagination');
		if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['base_url'] = base_url().'index.php/report/b2b_hotel_report/';
		$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
		$page_data['total_rows'] = $config['total_rows'] = $total_records;
		$config['per_page'] = RECORDS_RANGE_2;
		$this->pagination->initialize($config);
		/** TABLE PAGINATION */
		$page_data['total_records'] = $config['total_rows'];
		//debug($page_data);exit;
		$page_data['search_params'] = $get_data;
		$page_data['status_options'] = get_enum_list('booking_status_options');
		
		$agent_info = $this->custom_db->single_table_records('user','*',array('user_type'=>B2B_USER,'domain_list_fk'=>get_domain_auth_id()));
		
		$page_data['agent_details'] = magical_converter(array('k' => 'user_id', 'v' => 'agency_name'), $agent_info);
		$this->template->view('report/b2b_report_hotel', $page_data);
	}
	
	
	function b2c_hotel_report($offset=0)
	{
		$condition = array();
		$get_data = $this->input->get();

		$filter_data = $this->format_basic_search_filters();
		$page_data['from_date'] = $filter_data['from_date'];
		$page_data['to_date'] = $filter_data['to_date'];
		$condition = $filter_data['filter_condition'];

		/*if(valid_array($get_data) == true) {
			//From-Date and To-Date
			$from_date = trim(@$get_data['created_datetime_from']);
			$to_date = trim(@$get_data['created_datetime_to']);
			//Auto swipe date
			if(empty($from_date) == false && empty($to_date) == false)
			{
				$valid_dates = auto_swipe_dates($from_date, $to_date);
				$from_date = $valid_dates['from_date'];
				$to_date = $valid_dates['to_date'];
			}
			if(empty($from_date) == false) {
				$condition[] = array('BD.created_datetime', '>=', $this->db->escape(db_current_datetime($from_date)));
			}
			if(empty($to_date) == false) {
				$condition[] = array('BD.created_datetime', '<=', $this->db->escape(db_current_datetime($to_date)));
			}
	
			if (empty($get_data['created_by_id']) == false) {
				$condition[] = array('BD.created_by_id', '=', $this->db->escape($get_data['created_by_id']));
			}
	
			if (empty($get_data['status']) == false && strtolower($get_data['status']) != 'all') {
				$condition[] = array('BD.status', '=', $this->db->escape($get_data['status']));
			}
	
			// if (empty($get_data['phone']) == false) {
			// 	$condition[] = array('BD.phone_number', ' like ', $this->db->escape('%'.$get_data['phone'].'%'));
			// }
	
			// if (empty($get_data['email']) == false) {
			// 	$condition[] = array('BD.email', ' like ', $this->db->escape('%'.$get_data['email'].'%'));
			// }
	
			if (empty($get_data['app_reference']) == false) {
				$condition[] = array('BD.app_reference', 'like',$this->db->escape('%'.$get_data['app_reference'].'%'));
			}
			$page_data['from_date'] = $from_date;
			$page_data['to_date'] = $to_date;
		}*/
		//debug($this->session->userdata('id'));die;
		$total_records = $this->hotel_model->b2c_hotel_report($condition, true);	
	//	debug($total_records); die;
		$table_data = $this->hotel_model->b2c_hotel_report($condition, false, $offset, RECORDS_RANGE_2);
			//debug($table_data['data']); exit;
		$table_data = $this->booking_data_formatter->format_hotel_booking_data($table_data,$this->current_module);
		$page_data['table_data'] = $table_data['data'];
		$this->load->library('pagination');
		if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['base_url'] = base_url().'index.php/report/b2c_hotel_report/';
		$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
		$page_data['total_rows'] = $config['total_rows'] = $total_records;
		$config['per_page'] = RECORDS_RANGE_2;
		$this->pagination->initialize($config);
		/** TABLE PAGINATION */
		$page_data['total_records'] = $config['total_rows'];
		//debug($page_data);exit;
		$page_data['search_params'] = $get_data;
		$page_data['status_options'] = get_enum_list('booking_status_options');
		$this->template->view('report/b2c_report_hotel', $page_data);
	}
	/*B2c sightseeing Report*/
	function b2c_activities_report($offset=0)
	{
		$condition = array();
		$get_data = $this->input->get();

		$filter_data = $this->format_basic_search_filters();
		$page_data['from_date'] = $filter_data['from_date'];
		$page_data['to_date'] = $filter_data['to_date'];
		$condition = $filter_data['filter_condition'];

		$total_records = $this->sightseeing_model->b2c_sightseeing_report($condition, true);	
		
	//	debug($total_records); die;
		$table_data = $this->sightseeing_model->b2c_sightseeing_report($condition, false, $offset, RECORDS_RANGE_2);
			//debug($table_data['data']); exit;
		$table_data = $this->booking_data_formatter->format_sightseeing_booking_data($table_data,$this->current_module);
		$page_data['table_data'] = $table_data['data'];
		$this->load->library('pagination');
		if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['base_url'] = base_url().'index.php/report/b2c_sightseeing_report/';
		$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
		$page_data['total_rows'] = $config['total_rows'] = $total_records;
		$config['per_page'] = RECORDS_RANGE_2;
		$this->pagination->initialize($config);
		/** TABLE PAGINATION */
		$page_data['total_records'] = $config['total_rows'];
		//debug($page_data);exit;
		$page_data['search_params'] = $get_data;
		$page_data['status_options'] = get_enum_list('booking_status_options');
		$this->template->view('report/b2c_report_sightseeing', $page_data);
	}
		/**
	 * Sightseeing Report for b2b flight
	 * @param $offset
	 */
	function b2b_activities_report($offset=0)
	{
		$current_user_id = $GLOBALS['CI']->entity_user_id;
		$get_data = $this->input->get();
		$condition = array();
		$filter_data = $this->format_basic_search_filters();
		$page_data['from_date'] = $filter_data['from_date'];
		$page_data['to_date'] = $filter_data['to_date'];
		$condition = $filter_data['filter_condition'];

		$total_records = $this->sightseeing_model->b2b_sightseeing_report($condition, true);
		//echo '<pre>'; print_r($page_data); die;
		$table_data = $this->sightseeing_model->b2b_sightseeing_report($condition, false, $offset, RECORDS_RANGE_2);
		$table_data = $this->booking_data_formatter->format_sightseeing_booking_data($table_data, $this->current_module);
		// debug($table_data);
		// exit;
		$page_data['table_data'] = $table_data['data'];
		
		$this->load->library('pagination');
		if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['base_url'] = base_url().'index.php/report/b2b_sightseeing_report/';
		$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
		$page_data['total_rows'] = $config['total_rows'] = $total_records;
		$config['per_page'] = RECORDS_RANGE_2;
		$this->pagination->initialize($config);
		/** TABLE PAGINATION */
		$page_data['total_records'] = $config['total_rows'];
		$page_data['search_params'] = $get_data;
		$page_data['status_options'] = get_enum_list('booking_status_options');

		$user_cond = [];
		$user_cond [] = array('U.user_type','=',' (', B2B_USER, ')');
		$user_cond [] = array('U.domain_list_fk' , '=' ,get_domain_auth_id());

		//$agent_info['data'] = $this->user_model->b2b_user_list($user_cond,false);

		$agent_info = $this->custom_db->single_table_records('user','*',array('user_type'=>B2B_USER,'domain_list_fk'=>get_domain_auth_id()));

		$page_data['agent_details'] = magical_converter(array('k' => 'user_id', 'v' => 'agency_name'), $agent_info);		
		
		$this->template->view('report/b2b_sightseeing', $page_data);
	}
	/*B2B Transfer Report*/
	function b2b_transfers_report($offset=0){
		$current_user_id = $GLOBALS['CI']->entity_user_id;
		$get_data = $this->input->get();
		$condition = array();
		$filter_data = $this->format_basic_search_filters();
		$page_data['from_date'] = $filter_data['from_date'];
		$page_data['to_date'] = $filter_data['to_date'];
		$condition = $filter_data['filter_condition'];

		$total_records = $this->transferv1_model->b2b_transferv1_report($condition, true);
		//echo '<pre>'; print_r($page_data); die;
		$table_data = $this->transferv1_model->b2b_transferv1_report($condition, false, $offset, RECORDS_RANGE_2);
		$table_data = $this->booking_data_formatter->format_transferv1_booking_data($table_data, $this->current_module);
		// debug($table_data);
		// exit;
		$page_data['table_data'] = $table_data['data'];
		
		$this->load->library('pagination');
		if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['base_url'] = base_url().'index.php/report/b2b_transfers_report/';
		$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
		$page_data['total_rows'] = $config['total_rows'] = $total_records;
		$config['per_page'] = RECORDS_RANGE_2;
		$this->pagination->initialize($config);
		/** TABLE PAGINATION */
		$page_data['total_records'] = $config['total_rows'];
		$page_data['search_params'] = $get_data;
		$page_data['status_options'] = get_enum_list('booking_status_options');

		$user_cond = [];
		$user_cond [] = array('U.user_type','=',' (', B2B_USER, ')');
		$user_cond [] = array('U.domain_list_fk' , '=' ,get_domain_auth_id());

		//$agent_info['data'] = $this->user_model->b2b_user_list($user_cond,false);

		$agent_info = $this->custom_db->single_table_records('user','*',array('user_type'=>B2B_USER,'domain_list_fk'=>get_domain_auth_id()));

		$page_data['agent_details'] = magical_converter(array('k' => 'user_id', 'v' => 'agency_name'), $agent_info);		
		
		$this->template->view('report/b2b_transfer', $page_data);
	}
	/*B2c Transfer Report*/
	function b2c_transfers_report($offset=0)
	{
		$condition = array();
		$get_data = $this->input->get();

		$filter_data = $this->format_basic_search_filters();
		$page_data['from_date'] = $filter_data['from_date'];
		$page_data['to_date'] = $filter_data['to_date'];
		$condition = $filter_data['filter_condition'];

		$total_records = $this->transferv1_model->b2c_transferv1_report($condition, true);	
		
	//	debug($total_records); die;
		$table_data = $this->transferv1_model->b2c_transferv1_report($condition, false, $offset, RECORDS_RANGE_2);
			//debug($table_data['data']); exit;
		$table_data = $this->booking_data_formatter->format_transferv1_booking_data($table_data,$this->current_module);
		$page_data['table_data'] = $table_data['data'];
		$this->load->library('pagination');
		if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['base_url'] = base_url().'index.php/report/b2c_transfers_report/';
		$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
		$page_data['total_rows'] = $config['total_rows'] = $total_records;
		$config['per_page'] = RECORDS_RANGE_2;
		$this->pagination->initialize($config);
		/** TABLE PAGINATION */
		$page_data['total_records'] = $config['total_rows'];
		//debug($page_data);exit;
		$page_data['search_params'] = $get_data;
		$page_data['status_options'] = get_enum_list('booking_status_options');
		$this->template->view('report/b2c_transferv1_report', $page_data);
	}
	/* car reports */
	
	function b2c_car_report($offset=0)
	{
		$get_data = $this->input->get();
        $condition = array();
        $page_data = array();
        $filter_data = $this->format_basic_search_filters('bus');
        $page_data['from_date'] = $filter_data['from_date'];
        $page_data['to_date'] = $filter_data['to_date'];
        $condition = $filter_data['filter_condition'];

        $total_records = $this->car_model->b2c_car_report($condition, true);
   
        $table_data = $this->car_model->b2c_car_report($condition, false, $offset, RECORDS_RANGE_2);
       
        $table_data = $this->booking_data_formatter->format_car_booking_datas($table_data , $this->current_module);
       	// debug($table_data);exit;
       	$page_data['table_data'] = $table_data['data'];
        
        /** TABLE PAGINATION */
        $this->load->library('pagination');
        if (count($_GET) > 0)
            $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['base_url'] = base_url() . 'index.php/report/car/';
        $config['first_url'] = $config['base_url'] . '?' . http_build_query($_GET);
        $page_data['total_rows'] = $config['total_rows'] = $total_records;
        $config['per_page'] = RECORDS_RANGE_2;
        $this->pagination->initialize($config);
        /** TABLE PAGINATION */
        $page_data['total_records'] = $config['total_rows'];
        $page_data['customer_email'] = $this->entity_email;
       $page_data['search_params'] = $get_data;
        $page_data['status_options'] = get_enum_list('booking_status_options');
        $this->template->view('report/b2c_car_report', $page_data);
        

	}
	/* car reports  for B2B*/
	
	function b2b_car_report($offset=0)
	{
		$get_data = $this->input->get();
        $condition = array();
        $page_data = array();
        $filter_data = $this->format_basic_search_filters('bus');
        $page_data['from_date'] = $filter_data['from_date'];
        $page_data['to_date'] = $filter_data['to_date'];
        $condition = $filter_data['filter_condition'];

        $total_records = $this->car_model->b2b_car_report($condition, true);
   
        $table_data = $this->car_model->b2b_car_report($condition, false, $offset, RECORDS_RANGE_2);
       	// echo $this->current_module;exit;
        $table_data = $this->booking_data_formatter->format_car_booking_datas($table_data , $this->current_module);
       	// debug($table_data);exit;
       	$page_data['table_data'] = $table_data['data'];
        
        /** TABLE PAGINATION */
        $this->load->library('pagination');
        if (count($_GET) > 0)
            $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['base_url'] = base_url() . 'index.php/report/car/';
        $config['first_url'] = $config['base_url'] . '?' . http_build_query($_GET);
        $page_data['total_rows'] = $config['total_rows'] = $total_records;
        $config['per_page'] = RECORDS_RANGE_2;
        $this->pagination->initialize($config);
        /** TABLE PAGINATION */
        $page_data['total_records'] = $config['total_rows'];
        $page_data['customer_email'] = $this->entity_email;
       $page_data['search_params'] = $get_data;
        $page_data['status_options'] = get_enum_list('booking_status_options');
        $this->template->view('report/b2c_car_report', $page_data);
        

	}
	
	/**
	 * Flight Report
	 * @param $offset
	 */
	function flight($offset=0)
	{
		$current_user_id = $GLOBALS['CI']->entity_user_id;
		$get_data = $this->input->get();
		$condition = array();
		if(valid_array($get_data) == true) {
			//From-Date and To-Date
			$from_date = trim(@$get_data['created_datetime_from']);
			$to_date = trim(@$get_data['created_datetime_to']);
			//Auto swipe date
			if(empty($from_date) == false && empty($to_date) == false)
			{
				$valid_dates = auto_swipe_dates($from_date, $to_date);
				$from_date = $valid_dates['from_date'];
				$to_date = $valid_dates['to_date'];
			}
			if(empty($from_date) == false) {
				$condition[] = array('BD.created_datetime', '>=', $this->db->escape(db_current_datetime($from_date)));
			}
			if(empty($to_date) == false) {
				$condition[] = array('BD.created_datetime', '<=', $this->db->escape(db_current_datetime($to_date)));
			}

			if (empty($get_data['created_by_id']) == false) {
				$condition[] = array('BD.created_by_id', '=', $this->db->escape($get_data['created_by_id']));
			}

			if (empty($get_data['status']) == false && strtolower($get_data['status']) != 'all') {
				$condition[] = array('BD.status', '=', $this->db->escape($get_data['status']));
			}

			if (empty($get_data['phone']) == false) {
				$condition[] = array('BD.phone', ' like ', $this->db->escape('%'.$get_data['phone'].'%'));
			}

			if (empty($get_data['email']) == false) {
				$condition[] = array('BD.email', ' like ', $this->db->escape('%'.$get_data['email'].'%'));
			}

			if (empty($get_data['app_reference']) == false) {
				$condition[] = array('BD.app_reference', ' like ', $this->db->escape('%'.$get_data['app_reference'].'%'));
			}
			$page_data['from_date'] = $from_date;
			$page_data['to_date'] = $to_date;
		}
		$total_records = $this->flight_model->booking($condition, true);
		$table_data = $this->flight_model->booking($condition, false, $offset, RECORDS_RANGE_2);
		$table_data = $this->booking_data_formatter->format_flight_booking_data($table_data,$this->current_module);
		$page_data['table_data'] = $table_data['data'];
		$this->load->library('pagination');
		if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['base_url'] = base_url().'index.php/report/flight/';
		$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
		$page_data['total_rows'] = $config['total_rows'] = $total_records;
		$config['per_page'] = RECORDS_RANGE_2;
		$this->pagination->initialize($config);
		/** TABLE PAGINATION */
		$page_data['total_records'] = $config['total_rows'];
		$page_data['search_params'] = $get_data;
		$page_data['status_options'] = get_enum_list('booking_status_options');
		$this->template->view('report/airline', $page_data);
	}
	
	/**
	 * Flight Report for b2c flight
	 * @param $offset
	 */
	function b2c_flight_report($offset=0)
	{
		$current_user_id = $GLOBALS['CI']->entity_user_id;
		$get_data = $this->input->get();
		//debug($get_data); die;
		$condition = array();

		$filter_data = $this->format_basic_search_filters();
		$page_data['from_date'] = $filter_data['from_date'];
		$page_data['to_date'] = $filter_data['to_date'];
		$condition = $filter_data['filter_condition'];
		
		//$condition[] = array('U.user_type', '=', B2C_USER, ' OR ', 'BD.created_by_id');
		$total_records = $this->flight_model->b2c_flight_report($condition, true);		
		
		$table_data = $this->flight_model->b2c_flight_report($condition, false, $offset, RECORDS_RANGE_2);
		$table_data = $this->booking_data_formatter->format_flight_booking_data($table_data, 'b2c', false);
		
		//Export report


		$page_data['table_data'] = $table_data['data'];
		$this->load->library('pagination');
		if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['base_url'] = base_url().'index.php/report/b2c_flight_report/';
		$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
		$page_data['total_rows'] = $config['total_rows'] = $total_records;
		$config['per_page'] = RECORDS_RANGE_2;
		$this->pagination->initialize($config);
		/** TABLE PAGINATION */
		$page_data['total_records'] = $config['total_rows'];
		$page_data['search_params'] = $get_data;
		$page_data['status_options'] = get_enum_list('booking_status_options');
		$this->template->view('report/b2c_report_airline', $page_data);
	}
	

	
	/**
	 * Flight Report for b2b flight
	 * @param $offset
	 */
	function b2b_flight_report($offset=0)
	{
		$current_user_id = $GLOBALS['CI']->entity_user_id;
		$get_data = $this->input->get();
		$condition = array();
		$filter_data = $this->format_basic_search_filters();
		$page_data['from_date'] = $filter_data['from_date'];
		$page_data['to_date'] = $filter_data['to_date'];
		$condition = $filter_data['filter_condition'];

		$total_records = $this->flight_model->b2b_flight_report($condition, true);
		//echo '<pre>'; print_r($page_data); die;
		$table_data = $this->flight_model->b2b_flight_report($condition, false, $offset, RECORDS_RANGE_2);
		$table_data = $this->booking_data_formatter->format_flight_booking_data($table_data, $this->current_module);
		$page_data['table_data'] = $table_data['data'];
		
		$this->load->library('pagination');
		if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['base_url'] = base_url().'index.php/report/b2b_flight_report/';
		$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
		$page_data['total_rows'] = $config['total_rows'] = $total_records;
		$config['per_page'] = RECORDS_RANGE_2;
		$this->pagination->initialize($config);
		/** TABLE PAGINATION */
		$page_data['total_records'] = $config['total_rows'];
		$page_data['search_params'] = $get_data;
		$page_data['status_options'] = get_enum_list('booking_status_options');

		$user_cond = [];
		$user_cond [] = array('U.user_type','=',' (', B2B_USER, ')');
		$user_cond [] = array('U.domain_list_fk' , '=' ,get_domain_auth_id());

		//$agent_info['data'] = $this->user_model->b2b_user_list($user_cond,false);

		$agent_info = $this->custom_db->single_table_records('user','*',array('user_type'=>B2B_USER,'domain_list_fk'=>get_domain_auth_id()));

		$page_data['agent_details'] = magical_converter(array('k' => 'user_id', 'v' => 'agency_name'), $agent_info);		
		
		$this->template->view('report/b2b_report_airline', $page_data);
	}
	
	
	function update_flight_booking_details($app_reference, $booking_source)
	{
		load_flight_lib($booking_source);
		$this->flight_lib->update_flight_booking_details($app_reference);
		//FIXME: Return the status
	}
	
	/**
	 * Sagar Wakchaure
	 *Update pnr Details 
	 * @param unknown $app_reference
	 * @param unknown $booking_source
	 * @param unknown $booking_status
	 */
	function update_pnr_details($app_reference, $booking_source,$booking_status)
	{
		load_flight_lib($booking_source);
		$response = $this->flight_lib->update_pnr_details($app_reference);
		$get_pnr_updated_status = $this->flight_model->update_pnr_details($response,$app_reference, $booking_source,$booking_status);
		echo $get_pnr_updated_status;
	}
	
function package()
	{
		echo '<h4>Under Working</h4>';
	}
	
	function b2b_package_report()
	{
		echo '<h4>Under Working</h4>';
	}
	
	function b2c_package_report()
	{
		echo '<h4>Under Working</h4>';
	}

	private function format_basic_search_filters($module='')
	{
		$get_data = $this->input->get();


		if(valid_array($get_data) == true) {
			$filter_condition = array();
			//From-Date and To-Date
			$from_date = trim(@$get_data['created_datetime_from']);
			$to_date = trim(@$get_data['created_datetime_to']);
			//Auto swipe date
			if(empty($from_date) == false && empty($to_date) == false)
			{
				$valid_dates = auto_swipe_dates($from_date, $to_date);
				$from_date = $valid_dates['from_date'];
				$to_date = $valid_dates['to_date'];
			}
			if(empty($from_date) == false) {
				$filter_condition[] = array('BD.created_datetime', '>=', $this->db->escape(db_current_datetime($from_date)));
			}
			if(empty($to_date) == false) {
				$filter_condition[] = array('BD.created_datetime', '<=', $this->db->escape(db_current_datetime($to_date)));
			}
	
			/*if (empty($get_data['created_by_id']) == false) {
				$filter_condition[] = array('BD.created_by_id', '=', $this->db->escape($get_data['created_by_id']));
			}*/
			
			if (empty($get_data['created_by_id']) == false && strtolower($get_data['created_by_id'])!='all') {
				$filter_condition[] = array('BD.created_by_id', '=', $this->db->escape($get_data['created_by_id']));
			}
	
			if (empty($get_data['status']) == false && strtolower($get_data['status']) != 'all') {
				$filter_condition[] = array('BD.status', '=', $this->db->escape($get_data['status']));
			}
		
			/*if (empty($get_data['phone']) == false) {
				$filter_condition[] = array('BD.phone', ' like ', $this->db->escape('%'.$get_data['phone'].'%'));
			}
	
			if (empty($get_data['email']) == false) {
				$filter_condition[] = array('BD.email', ' like ', $this->db->escape('%'.$get_data['email'].'%'));
			}*/
			
			if($module == 'bus'){
					if (empty($get_data['pnr']) == false) {
					$filter_condition[] = array('BD.pnr', ' like ', $this->db->escape('%'.$get_data['pnr'].'%'));
				}
			}else{
				if (empty($get_data['pnr']) == false) {
					$filter_condition[] = array('BT.pnr', ' like ', $this->db->escape('%'.$get_data['pnr'].'%'));
				}
			}
			
	
			if (empty($get_data['app_reference']) == false) {
				$filter_condition[] = array('BD.app_reference', ' like ', $this->db->escape('%'.$get_data['app_reference'].'%'));
			}
			
			$page_data['from_date'] = $from_date;
			$page_data['to_date'] = $to_date;

			//Today's Booking Data
			if(isset($get_data['today_booking_data']) == true && empty($get_data['today_booking_data']) == false) {
				$filter_condition[] = array('DATE(BD.created_datetime)', '=', '"'.date('Y-m-d').'"');
			}
			//Last day Booking Data
			if(isset($get_data['last_day_booking_data']) == true && empty($get_data['last_day_booking_data']) == false) {
				$filter_condition[] = array('DATE(BD.created_datetime)', '=', '"'.trim($get_data['last_day_booking_data']).'"');
			}
			//Previous Booking Data: last 3 days, 7 days, 15 days, 1 month and 3 month
			if(isset($get_data['prev_booking_data']) == true && empty($get_data['prev_booking_data']) == false) {
				$filter_condition[] = array('DATE(BD.created_datetime)', '>=', '"'.trim($get_data['prev_booking_data']).'"');
			}
			
			return array('filter_condition' => $filter_condition, 'from_date' => $from_date, 'to_date' => $to_date);
		}
	}
	# Get Pending Refund
    function cancellation_queue($offset = 0) {
    	error_reporting(0);
    	$this->load->model('flight_model');
        $get_data = $this->input->get();
        $condition = array();
        $cancel_data=array();
        $CancelQueue=array();
        $status="BOOKING_CANCELLED";
        $from_date ="2017-12-01";
        $to_date = date("Y-m-d");
        if (empty($from_date) == false) {
            $filter_condition[] = array('DATE(BD.created_datetime)', '>=', $this->db->escape(db_current_datetime($from_date)));
        }
        if (empty($to_date) == false) {
            $filter_condition[] = array('DATE(BD.created_datetime)', '<=', $this->db->escape(db_current_datetime($to_date)));
        }
        $filter_data=  array('filter_condition' => $filter_condition);
       	$condition = $filter_data['filter_condition'];
        
        $page_data['table_data'] = $this->flight_model->booking_cancel($condition, false, $offset, 5000);
        // debug($page_data['table_data']);exit;
        $cancellation_details = $this->booking_data_formatter->format_flight_booking_data($page_data['table_data'], $this->current_module);
      	// debug($cancellation_details);exit;
        $transaction_Details=array();
        $Appreference=array();
        foreach($cancellation_details['data']['booking_details_app'] as $key=>$value)
        {  
            foreach($value['booking_transaction_details'] as $k=>$val) {
             
                foreach($val['booking_customer_details'] as $j=>$data)
                {

                	
                	if(isset($data['cancellation_details'])){
                	
                		if($data['cancellation_details']['refund_status']=="INPROGRESS")
                  		{
                        	$Appreference[]=$data['app_reference'];
                  		}
                	}
                
                }
             }
          
        } 
       $result = array_unique($Appreference);
      
       foreach($result as $finalkey=>$final_data)
       {
          $CancelQueue[]= $cancellation_details['data']['booking_details_app'][$final_data];
       }
       // debug($CancelQueue);exit;
       $cancel_data['CancelQueue']=$CancelQueue;
       $this->template->view('report/cancellation_queue', $cancel_data);
    }
	public function get_customer_details($app_reference,$booking_source,$booking_status, $module)
	{

        if($module == 'flight'){
        	$booking_details = $this->flight_model->get_booking_details($app_reference, $booking_source, $booking_status);
		}
		else if($module == 'hotel'){
			$booking_details = $this->hotel_model->get_booking_details($app_reference, $booking_source, $booking_status);
	
		}
		else if($module == 'bus'){
			$booking_details = $this->bus_model->get_booking_details($app_reference, $booking_source, $booking_status);
	
		}
		// debug($booking_details);exit;
		$booking_details['module'] = $module;
       
            if($booking_details['status'] == SUCCESS_STATUS && valid_array($booking_details['data']) ==true){
				$response['data'] = get_compressed_output(
				$this->template->isolated_view('report/customer_details',
						array('customer_details' => $booking_details,)));
			}

        $this->output_compressed_data($response); 
        
	}
	private function output_compressed_data($data)
	{	
	
            ini_set('always_populate_raw_post_data', '-1');
            
	   while (ob_get_level() > 0) { ob_end_clean() ; }
	   ob_start("ob_gzhandler");
	   ini_set("memory_limit", "-1");set_time_limit(0);
	   header('Content-type:application/json');
	   
		echo json_encode($data);
	    ob_end_flush();
	   exit;
	}
}


