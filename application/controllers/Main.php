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
        $this->load->database();
        if (!isset($_SESSION['loggedIn'])) {
            redirect('user');
        }
    }

    public function index()
    {
        $data['permissions'] = $this->MainModel->getPermission();
        $data['getSystem'] = $this->MainModel->getSystem();
        $data['pending'] = $this->MainModel->getPending();
        $this->load->view('partials/__header');
        $this->load->view('main/dashboard', $data);
        $this->load->view('partials/__footer');
        $this->load->view('main/ajaxRequest/profile_request');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('user');
    }

    public function accountManagement()
    {
        $permission = $this->MainModel->getPermission();
        $data['department'] = $this->MainModel->getDepartment();
        $data['position'] = $this->MainModel->getPosition();
        $data['branches'] = $this->MainModel->getBranch();
        $data['getPermission'] = $this->MainModel->getPermissionList();
        $data['totalReset'] = $this->db->where('user_status', 'For Reset')->get('users')->num_rows();
        // $data['getForReset'] = $this->MainModel->getForReset();
        // $data['tempPass'] = $this->MainModel->generateRandomString();
        foreach ($permission as $row) {
            if ($row->perm_id == "2") {
                $this->load->view('partials/__header');
                $this->load->view('main/account_management', $data);
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
            if ($account->profile_pic != '')
                $row[] = '<img class="box" src="' . base_url('uploaded_file/profile/') . '' . $account->profile_pic . '" alt="Pofile-Picture">';
            else
                $row[] = '<img class="box" src="' . base_url('assets/img/avatar.jpg') . '" alt="Pofile-Picture">';

            $row[] = $account->generated_id;
            $row[] = $account->user_status;
            $row[] = $account->l_name .', '.$account->f_name.' '.$account->m_name;
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

            if (isset($res->access) && $res->access == 'Yes')
                $row[] = '<span>'.$account->perm_desc.'</span><br>
                          <small><span class="view_sub" id="deleteRow" data-id="'.$account->perm_id.'" data-sub="'.$user.'">View Sub Permissions</span></small>';
            else
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

    public function get_SubPermission()
    {
        $perm_id = $this->uri->segment(3);
        $userID = $this->uri->segment(4);
        $this->db->where('perm_id', $perm_id);
        $list = $this->db->get('sub_permissions')->result();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $account) {
            $no++;
            $row = array();

            $query = $this->db->query("
                SELECT * FROM sub_role_permission WHERE sub_id = '" . $account->sub_id . "'
                AND user_id = '" . $userID . "'
            ");

            $res = $query->row();

            $row[] = $account->sub_details;
            if (isset($res->access) && $res->access == 'Yes') {
                $row[] = '<label class="switch">
							<input type="checkbox" class="action_sub" data-user="' . $userID . '" data-sub="' .$account->sub_id. '" checked>
							<span class="slider round"></span>
					  	  </label><br>ON';
            } else {
                $row[] = '<label class="switch">
                            <input type="checkbox" class="action_sub" data-user="' . $userID . '" data-sub="' .$account->sub_id. '">
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

    public function add_Subpermission()
    {
        $success = '';
        $userID = $this->input->post('userID');
        $permID = $this->input->post('perm_id');
        $subID = $this->input->post('subID');
        $grantPermission = array(
            'user_id' => $userID,
            'sub_id' => $subID,
            // 'perm_id' => $permID,
            'access' => 'Yes',
        );
        if ($this->db->insert('sub_role_permission', $grantPermission))
            $success = 'Success';
        else
            $success = 'Error';
        $output = array(
            'success' => $success,
        );
        echo json_encode($output);
    }

    public function remove_Subpermission()
    {
        $success = '';
        $userID = $this->input->post('userID');
        $permID = $this->input->post('perm_id');
        $subID = $this->input->post('subID');
        $removePermission = array(
            'user_id' => $userID,
            'sub_id' => $subID,
        );
        if ($this->db->delete('sub_role_permission', $removePermission))
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

    public function createPermission()
    {
        $message = '';
        $system = $this->input->post('system_name');
        $this->db->where('perm_desc', $system);
        $exist = $this->db->get('permissions');
        if ($exist->num_rows() > 0) {
            $message = 'Permission exist';
        } else {
            $this->db->insert('permissions', array('perm_desc' => $system));
        }
        $output = array(
            'message' => $message,
        );
        echo json_encode($output);
    }

    public function updateProfile()
    {
        $message = '';
        if (!empty($_FILES['inpFile']['name'])) {
            $config['upload_path'] = 'uploaded_file/profile';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = $_SESSION['loggedIn']['generated_id'] . $_FILES['inpFile']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('inpFile')) {
                $uploadData = $this->upload->data();
                $uploadFile = $uploadData['file_name'];
            } else {
                $uploadFile = '';
            }
        } else {
            $uploadFile = '';
        }
        $updateAccount = array(
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'temp_pass_status' => NULL,
            'user_status' => $this->input->post('password'),
        );
        if ($this->db->where('generated_id', $_SESSION['loggedIn']['generated_id'])->update('users', $updateAccount)) {
            $this->db->where('user_id', $_SESSION['loggedIn']['generated_id'])->update('employee', array('profile_pic' => $uploadFile));
            $message = 'Success';
        }  else {
            $message = '';
        }
        $output = array(
            'message' => $message,
        );
        echo json_encode($output);
    }

    public function saveSubPermission()
    {
        $success = '';
        $insert_data_perm = $this->input->post('data_table');
        for ($i = 0; $i < count($insert_data_perm); $i++) {
            $data[] = array(
                'perm_id' => $this->input->post('permID'),
                'sub_details' => $insert_data_perm[$i]['sub_details'],
            );
            $this->db->insert('sub_permissions', $data[$i]);
            $success = 'Success';
        }
        $output = array(
            'success' => $success,
        );
        echo json_encode($output);
    }

    public function getSubPermission()
    {
        $perm_id = $this->uri->segment(3);
        $this->db->where('perm_id', $perm_id);
        $permission = $this->db->get('sub_permissions')->result();
        $data = array();
        $no = $_POST['start'];
        foreach ($permission as $list) {
            $no++;
            $row = array();

            $row[] = $list->sub_id;
            $row[] = $list->sub_details;

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "data" => $data
        );
        echo json_encode($output);
    }

    public function getDepartment()
    {
        $department = $this->MainModel->getDepartment();
        $data = array();
        $no = $_POST['start'];
        foreach ($department as $list) {
            $no++;
            $row = array();

            $row[] = $list->dept_code;
            $row[] = $list->department;

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "data" => $data
        );
        echo json_encode($output);
    }

    public function getPosition()
    {
        $position = $this->MainModel->getPosition();
        $data = array();
        $no = $_POST['start'];
        foreach ($position as $list) {
            $no++;
            $row = array();

            $row[] = $list->position_code;
            $row[] = $list->position_details;

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "data" => $data
        );
        echo json_encode($output);
    }

    public function getBranch()
    {
        $branch = $this->MainModel->getBranch();
        $data = array();
        $no = $_POST['start'];
        foreach ($branch as $list) {
            $no++;
            $row = array();

            $row[] = $list->branch;
            $row[] = $list->branch_address;

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "data" => $data
        );
        echo json_encode($output);
    }

    public function addBranches()
    {
        $message = '';
        $query = $this->db->query("
                 SELECT * FROM branches WHERE branch='" . $this->input->post('branch') . "'
        ");
        if ($query->num_rows() > 0) {
            $message = 'Branch already exist';
        } else {
            $insertBranch = array(
                'branch' => $this->input->post('branch'),
                'branch_address' => $this->input->post('branch_address')
            );
            $this->db->insert('branches', $insertBranch);
        }
        $output = array(
            'message' => $message,
        );
        echo json_encode($output);
    }
}
