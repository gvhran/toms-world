<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Manila');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->model('UserModel');
		$this->load->database();
	}

	public function index()
	{
		$this->load->view('user/header');
		$this->load->view('user/login');
		$this->load->view('user/footer');
		$this->load->view('user/ajaxRequest/login_request');
	}

	public function register()
	{
		$this->load->view('user/header');
		$this->load->view('user/register');
		$this->load->view('user/footer');
	}

	public function maintenance()
    {
        $this->load->view('underconstruction');
    }



	//Back End Process

	public function login_process()
	{
		$success = '';
		$error = '';
		$username = $this->input->post('email');
		$password = $this->input->post('password');
		$session = $this->UserModel->user_check_admin($username, $password);
		$userCheck = $this->UserModel->userCheck($username);

		if ($userCheck > 0) {
			if ($session) {
				if ($session->is_active == 'Inactive') {
					$error = '<div class="alert alert-danger">Your account is deactivated.</div>';
				} elseif ($session->user_status == 'For Reset') {
					$error = '<div class="alert alert-danger">Your account is for reset.</div>';
				} else {
					$account = $this->UserModel->getEmployee($username);
					$sess_array = array(
						'id' => $session->id,
						'generated_id' => $session->generated_id,
						'status' => $session->is_active,
						'photo' => $session->photo,
						'temp_pass' => $session->temp_pass_status,
						'name' => $account->f_name .' '.$account->l_name,
						'department' => $account->department,
						'position' => $account->position,
						'email' => $account->email,
						'profile_pic' => $account->profile_pic,
					);
					$this->session->set_userdata('loggedIn', $sess_array);
					$success = '<div class="alert alert-success">Please wait redirecting...</div>';
				}
			} else {
				$error = '<div class="alert alert-danger">Invalid password!</div>';
			}
		} else {
			$error = '<div class="alert alert-danger">Invalid username!</div>';
		}
		$output = array(
			'success' => $success,
			'error' => $error,
		);
		echo json_encode($output);
	}

	public function account_register()
	{
		function generateRandomString($length = 6)
		{
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return $randomString;
		}

		$message = '';
		$generatedID = 'TWPH-' . date('Y') . '-' . rand(10, 1000);
		$tempPass = generateRandomString();
		$exist = $this->UserModel->existing_account($generatedID);
		if ($exist > 0) {
			$message = 'Account exist';
		} else {
			$date_created = date('Y-m-d H:i:s');
			
			$insert_account = array(
				'generated_id' => $generatedID,
				'password' => password_hash($tempPass, PASSWORD_DEFAULT),
				'is_active' => 'Active',
				'created_at' => $date_created,
				'temp_pass_status' => $tempPass,
				'user_status' => $tempPass,
			);
			$insertEmployee = array(
				'user_id' => $generatedID,
				'f_name' => $this->input->post('fname'),
				'm_name' => $this->input->post('mname'),
				'l_name' => $this->input->post('lname'),
				'birthday' => $this->input->post('bday'),
				'email' => $this->input->post('email_add'),
				'contact' => $this->input->post('contact_no'),
				'position' => $this->input->post('position'),
				'department' => $this->input->post('department'),
				'branch_store' => $this->input->post('branches'),
			);
			$this->db->insert('users', $insert_account);
			$this->db->insert('employee', $insertEmployee);
		} //end of if else

		$output = array(
			'message' => $message,
		);

		echo json_encode($output);
	}

	public function resetPassword()
	{
		$message = '';
		$user = $this->input->post('user');
		$checkUser = $this->db->where('generated_id', $user)->get('users')->num_rows();
		if ($checkUser > 0) {
			$this->db->where('generated_id', $user)->update('users', array('user_status' => 'For Reset'));
		} else {
			$message = 'Not Found';
		}
		$output = array(
			'message' => $message,
		);
		echo json_encode($output);

	}
}
