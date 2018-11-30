<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * @package    Provab
 * @subpackage General
 * @author     Balu A<balu.provab@gmail.com>
 * @version    V1
 */

class General extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//$this->output->enable_profiler(TRUE);
		$this->load->model('user_model');
	}

	/**
	 * index page of application will be loaded her
	 */
	function index()
	{
		if (is_logged_in_user()) {	
			//$this->load->view('dashboard/reminder');
			redirect(base_url().'index.php/menu/index');
		} else {			
			//show login
			echo $this->template->view('general/login',$data = array());
		}
	}

	/**
	 * Logout function for logout from account and unset all the session variables
	 */
	function initilize_logout() {
		if (is_logged_in_user()) {
			$this->user_model->update_login_manager($this->session->userdata(LOGIN_POINTER));
			$this->session->unset_userdata(array(AUTH_USER_POINTER => '',LOGIN_POINTER => '', DOMAIN_AUTH_ID => '', DOMAIN_KEY => ''));
			redirect('general/index');
		}
	}
	/**
	 * oops page of application will be loaded here
	 */
	public function ooops()
	{
		$this->template->view('utilities/404.php');
	}

	/*
	 * @domain Key
	 */
	public function view_subscribed_emails()
	{
		$params = $this->input->get();
	
		$domain_key = get_domain_auth_id();
		if(intval($domain_key) > 0) {
			$data['domain_admin_exists'] = true;
		} else {
			$data['domain_admin_exists'] = false;
		}
		$data['subscriber_list'] = $this->user_model->get_subscribed_emails($domain_key, $params['email']);
		$this->template->view('user/subscribed_email',$data);
	}
	public function active_emails($id){
		$cond['id'] = intval($id);
		$data['status'] = ACTIVE;
		$info = $this->user_model->update_subscribed_emails($data, $cond);
		
		exit;
	}
	public function deactive_emails($id){
		$cond['id'] = intval($id);
		$data['status'] = INACTIVE;
		$info = $this->user_model->update_subscribed_emails($data, $cond);
		
		exit;
	}
	function email_delete($id){
		if($id){
			$this->custom_db->delete_record('email_subscribtion',array('id' => $id));
		}
		redirect('general/view_subscribed_emails');		
	}
	function event_location_map()
	{
		$details = $this->input->get();
		$geo_codes['data']['latitude'] = $details['latitude'];
		$geo_codes['data']['longtitude'] = $details['longtitude'];
		$geo_codes['data']['name'] = 'Event Log Location';
		$geo_codes['data']['ip'] = $details['ip'];
		echo $this->template->isolated_view('general/event_location_map', $geo_codes);
	}
	
	function test($app_reference)
	{
		$this->load->model('flight_model');
		echo $this->flight_model->get_extra_services_total_price($app_reference);
		
		/*$query = 'select * from flight_booking_transaction_details where app_reference="'.$app_reference.'"  order by origin asc';
		$transaction_details = $this->db->query($query)->result_array();
		foreach($transaction_details as $tk => $tv){
			$query = 'select FP.origin, FP.first_name,FP.last_name,concat(FB.description, "-", FB.price) as Baggage 
			from flight_booking_passenger_details FP
			left join flight_booking_baggage_details FB on FP.origin=FB.passenger_fk
			where FP.flight_booking_transaction_details_fk='.$tv['origin'].' order by FP.origin';
			$baggae_details = $this->db->query($query)->result_array();
			
			$query = 'select FP.origin, FP.first_name,FP.last_name,concat(FM.description, "-", FM.price) as Meal 
			from flight_booking_passenger_details FP
			left join flight_booking_meal_details FM on FP.origin=FM.passenger_fk
			where FP.flight_booking_transaction_details_fk='.$tv['origin'].' order by FP.origin';
			$meal_details = $this->db->query($query)->result_array();
			echo '<br/>Baggage: ';
			debug($baggae_details);
			echo '<br/>MEALS: ';
			debug($meal_details);
		}
		echo 'DONE';*/
	}
	/*sending the OTP*/
	 function send_otp($opt ='') {

		error_reporting(0);
		$post_data = $this->input->post();

		$data=array();

		$data['user_name'] =$this->db->escape_str( isset ( $post_data ['email'] ) ? $post_data ['email'] : '');
		$data['password'] = $this->db->escape_str(isset ( $post_data ['password'] ) ? $post_data ['password'] : '');

		$data['status']=true;
		$data['user_name'] = provab_encrypt($data['user_name']);
		$data['password'] = provab_encrypt(md5($data['password']));

/*echo "babutest";
print_r($data['user_name']);
echo "thas";
print_r($data['password']);*/

		
		$user_details = $this->user_model->get_admin_details($data);
		if(!isset($user_details['uuid']))
		{
		   echo "false";
		   return false; 
		}
		$this->load->library('provab_mailer');
		$email = $post_data ['email'];
		$random_number = rand(100000,100000000);
		$mail_template  = 'Hello Admin, <br />Please enter the OTP to Login Admin Dashboard:- '.$random_number;
		$otp_data['OTP'] = $random_number;
		$this->session->set_userdata ( $otp_data );
		$cc = array('babu.thangaswamyy@gmail.com');
		$res = $this->provab_mailer->send_mail($email, domain_name().' - Login OTP',$mail_template,'',$cc );

		/* echo "raja";
		 debug($res);*/

		if($res['status'] == true){
			/*echo "babu";
			exit;*/
			echo true;
		}

		else{
			/*echo "thas";
			exit;*/
			echo false;
		}
		exit;
	}

	public function change_admin_password() {
		$user_details = $this->custom_db->single_table_records('user','*',array('user_type'=>1));
		foreach ($user_details['data'] as $key => $value) {

			$update = array();
			$condition = array();
			//$update['uuid'] = provab_encrypt($value['uuid']);
			$update['email'] = provab_encrypt('htstella@yahoo.com');
			$update['user_name'] = provab_encrypt('htstella@yahoo.com');
			//$update['user_name'] = $update['email'];
			$update['password'] = provab_encrypt(md5('Provab@123'));
			$condition['user_id'] = $value['user_id'];
/*echo "test";
echo $this->db->last_query();*/

			if($this->custom_db->update_record('user',$update,$condition)){
				echo 'ss'.$value['email'].'<br/>';
			}else{
				echo 'dfal';
			}
			
		}
		
		exit;
	}

}