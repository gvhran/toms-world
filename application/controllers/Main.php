<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Manila');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('UserModel');
        $this->load->model('MainModel');
        // $this->load->model('MainModel');
        $this->load->database();
        if (!isset($_SESSION['loggedIn'])) {
            redirect('user');
        }
    }

    public function index()
    {
        $data['permissions'] = $this->MainModel->getPermission();
        $this->load->view('partials/__header');
        $this->load->view('main/dashboard', $data);
        $this->load->view('partials/__footer');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('user');
    }

    public function accountManagement()
    {
        $permission = $this->MainModel->getPermission();
        foreach ($permission as $row) {
            if ($row->perm_id == "2") {
                $this->load->view('partials/__header');
                $this->load->view('main/account_management');
                $this->load->view('partials/__footer');
                $this->load->view('main/ajaxRequest/account_request');
            }
        }
    }

    //BACK END REQUEST

    public function get_accountData()
    {

        $list = $this->UserModel->get_accountData();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $account) {
            $no++;
            $row = array();

            $row[] = '<button class="btn btn-secondary btn-sm text-white add_permission" id="' . $account->id . '" title="Add Permissions"><i class="bi bi-unlock-fill me-2"></i>Add Permissions</button>';
            if ($account->photo != '')
                $row[] = '<img class="box" src="' . base_url('uploaded_file/profile/') . '' . $account->photo . '" alt="Pofile-Picture">';
            else
                $row[] = '<img class="box" src="' . base_url('assets/img/avatar.jpg') . '" alt="Pofile-Picture">';

            $row[] = $account->email;
            $row[] = $account->name;
            $row[] = $account->department;
            $row[] = $account->position;
            $row[] = date('F j, Y', strtotime($account->created_at));

            if (isset($account->is_active) && $account->is_active == 'Active') {
                $row[] = '<label class="switch">
							  <input type="checkbox" class="account_activation" id="' . $account->id . '" checked>
							  <span class="slider round"></span>
					  	  </label><br>' . $account->is_active . '';
            } else {
                $row[] = '<label class="switch">
						  <input type="checkbox" class="account_activation" id="' . $account->id . '">
						  <span class="slider round"></span>
					  	 </label><br>' . $account->is_active . '';
            }

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->UserModel->count_all(),
            "recordsFiltered" => $this->UserModel->count_filtered(),
            "data" => $data
        );
        echo json_encode($output);
    }

    public function get_Permission()
    {
        $user = $this->uri->segment(3);
        $list = $this->db->get('permissions')->result();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $account) {
            $no++;
            $row = array();

            $query = $this->db->query("
                SELECT * FROM roles_permissions WHERE perm_id = '" . $account->perm_id . "'
                AND user_id = '" . $user . "'
            ");

            $res = $query->row();

            $row[] = $account->perm_desc;
            if (isset($res->access) && $res->access == 'Yes') {
                $row[] = '<label class="switch">
							  <input type="checkbox" class="action_session" id="' . $account->perm_id . '" data-user="' . $user . '" checked>
							  <span class="slider round"></span>
					  	  </label><br>ON';
            } else {
                $row[] = '<label class="switch">
						  <input type="checkbox" class="action_session" id="' . $account->perm_id . '" data-user="' . $user . '">
						  <span class="slider round"></span>
					  	 </label><br>OFF';
            }

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "data" => $data
        );
        echo json_encode($output);
    }

    public function add_permission()
    {
        $success = '';
        $userID = $this->input->post('userID');
        $permID = $this->input->post('perm_id');
        $grantPermission = array(
            'user_id' => $userID,
            'perm_id' => $permID,
            'access' => 'Yes',
        );
        if ($this->db->insert('roles_permissions', $grantPermission))
            $success = 'Success';
        else
            $success = 'Error';
        $output = array(
            'success' => $success,
        );
        echo json_encode($output);
    }

    public function remove_permission()
    {
        $success = '';
        $userID = $this->input->post('userID');
        $permID = $this->input->post('perm_id');
        $removePermission = array(
            'user_id' => $userID,
            'perm_id' => $permID,
        );
        if ($this->db->delete('roles_permissions', $removePermission))
            $success = 'Success';
        else
            $success = 'Error';
        $output = array(
            'success' => $success,
        );
        echo json_encode($output);
    }

    public function account_activated()
    {
        $error = '';
        $date_update = date('Y-m-d H:i:s');
        if ($this->db->where('id', $_POST['userID'])->update('users', array('is_active' => 'Active')))
            $error = 'Success';
        else
            $error = 'Error';
        $output = array(
            'success' => $error,
        );
        echo json_encode($output);
    }

    public function account_deactivated()
    {
        $error = '';
        $date_update = date('Y-m-d H:i:s');
        if ($this->db->where('id', $_POST['userID'])->update('users', array('is_active' => 'Inactive')))
            $error = 'Success';
        else
            $error = 'Error';
        $output = array(
            'success' => $error,
        );
        echo json_encode($output);
    }
}