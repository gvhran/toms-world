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
						'name' => $account->f_name . ' ' . $account->l_name,
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

		$emailCredentials = $this->UserModel->getEmailAutoreply();
		$config = array(
			'protocol' => $emailCredentials->protocol,
			'smtp_host' => $emailCredentials->smtp_host,
			'smtp_port' => $emailCredentials->smtp_port,
			'smtp_user' => $emailCredentials->smtp_user, // change it to yours
			'smtp_pass' => $emailCredentials->smtp_pass, // change it to yours
			'mailtype' => $emailCredentials->mailtype,
			'charset' => $emailCredentials->charset,
			'wordwrap' => $emailCredentials->wordwrap
		);
		$this->load->library('email', $config);

		$message = '';
		$body = '';
		$error = '';
		$generatedID = 'TWPH-' . date('Y') . '-' . rand(10, 1000);
		$email = $this->input->post('email_add');
		$tempPass = generateRandomString();
		$exist = $this->UserModel->existing_account($email);
		if ($exist > 0) {
			$message = 'Account exist';
		} else {
			$date_created = date('Y-m-d H:i:s');

			$insert_account = array(
				'generated_id' => $generatedID,
				'username' => $email,
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
				'area_name' => $this->input->post('area'),
			);
			$body = '
				Dear '.$this->input->post('fname').',<br><br>
				Greetings!<br><br>

				<b>ACCOUNT CREDENTIALS:</b><br>
				<b>Username:</b> '.$email.'<br>
				<b>Password:</b> '.$tempPass.'<br><br><br>

				<hr>
				<br><br>
				Thank You.<br>
				<b>Toms World Philippines</b><br><br>
				*** This is a system generated message. <b>DO NOT REPLY TO THIS EMAIL. ***</b>
			';
			$this->email->set_newline("\r\n");
			$this->email->from($emailCredentials->smtp_user);
			$this->email->to($email);
			$this->email->subject('ACCOUNT CREDENTIALS');
			$this->email->message($body);
			if($this->email->send()) {
				$this->db->insert('users', $insert_account);
				$this->db->insert('employee', $insertEmployee);
			}else{
				$error = 'NotSent';
			}
		} //end of if else

		$output = array(
			'message' => $message,
			'error' => $error,
		);

		echo json_encode($output);
	}

	public function resetPassword()
	{
		$message = '';
		$user = $this->input->post('user');
		$checkUser = $this->db->where('username', $user)->get('users')->num_rows();
		if ($checkUser > 0) {
			$this->db->where('username', $user)->update('users', array('user_status' => 'For Reset'));
		} else {
			$message = 'Not Found';
		}
		$output = array(
			'message' => $message,
		);
		echo json_encode($output);
	}
}
