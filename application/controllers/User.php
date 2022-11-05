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


	//Back End Process

	public function login_process()
	{
		$success = '';
		$error = '';
		$username = $this->input->post('email');
		$password = $this->input->post('password');

		$session = $this->UserModel->user_check($username, $password);
		if ($session) {
			if ($session->is_active == 'Inactive') {
				$error = '<div class="alert alert-danger">Your account is deactivated.</div>';
			} else {
				$sess_array = array(
					'id' => $session->id,
					'email' => $session->email,
					'name' => $session->name,
					'department' => $session->department,
					'position' => $session->position,
					'generated_id' => $session->generated_id,
					'status' => $session->is_active,
					'access_level' => $session->is_active,
					'photo' => $session->photo,
					'temp_pass' => $session->temp_pass_status,
				);
				$this->session->set_userdata('loggedIn', $sess_array);
				$success = '<div class="alert alert-success">Please wait redirecting...</div>';
			}
		} else {
			$error = '<div class="alert alert-danger">Please check your username and password!</div>';
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

		$tempPass = generateRandomString();
		$exist = $this->UserModel->existing_account($this->input->post('email'));
		if ($exist > 0) {
			$message = 'Account exist';
		} else {
			$date_created = date('Y-m-d H:i:s');
			$generatedID = 'TWPH-' . date('Y') . '-' . rand(10, 1000);

			$insert_account = array(
				'generated_id' => $generatedID,
				'name' => $this->input->post('fullname'),
				'email' => $this->input->post('email_add'),
				'password' => password_hash($tempPass, PASSWORD_DEFAULT),
				'department' => $this->input->post('department'),
				'position' => $this->input->post('position'),
				'is_active' => 'Active',
				'created_at' => $date_created,
				'temp_pass_status' => $tempPass,
			);
			$this->db->insert('users', $insert_account);
		} //end of if else

		$output = array(
			'message' => $message,
		);

		echo json_encode($output);
	}

	
}
