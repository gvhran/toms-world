<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class UserModel extends CI_Model
{
    var $users = 'users';
    var $users_order = array('generated_id', 'department', 'created_at', 'is_active', 'profile_pic');
    var $users_search = array('generated_id', 'department', 'is_active', 'l_name', 'f_name', 'position'); //set column field database for datatable searchable just article , description , serial_num, property_num, department are searchable
    var $order = array('id' => 'desc'); // default order

    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function existing_account($email)
    {
        $query = $this->db->where('username', $email)->get('users');
        return $query->num_rows();
    }

    function userCheck($username)
    {
        $query = $this->db->where('username', $username)->get('users');
        return $query->num_rows();
    }

    function getEmployee($username)
    {
        $query = $this->db->where('email', $username)->get('employee');
        return $query->row();
    }

    public function user_check_admin($username, $password)
    {
        $this->db->where('username', $username);
        $res = $this->db->get('users')->row();

        // if(!$res){
        //     return false;
        // }else{
        //     $hash = $res->temp_pass_status;
        //     if($password == $hash)
        //     {
        //         return $res;
        //     }else{
        //         return false;
        //     }
        // }

        if (!$res) {
            return false;
        } else {
            $hash = $res->password;
            if ($this->verify_password_hash($password, $hash)) {
                return $res;
            } else {
                return false;
            }
        }
    }

    private function verify_password_hash($password, $hash)
    {

        return password_verify($password, $hash);
    }

    public function get_accountData()
    {
        $this->_get_accountData_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_accountData_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->users);
        return $this->db->count_all_results();
    }

    private function _get_accountData_query()
    {
        if ($this->input->post('department_filter')) {
            $this->db->where('employee.department', $this->input->post('department_filter'));
        } else if ($this->input->post('position_filter')) {
            $this->db->where('employee.position', $this->input->post('position_filter'));
        }
        $this->db->from($this->users);
        $this->db->join('employee', 'users.generated_id=employee.user_id', 'left');

        $i = 0;
        foreach ($this->users_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {
                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->users_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->user_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function getUserData()
    {
        $this->db->where('id', $_SESSION['loggedIn']['id']);
        $query = $this->db->get('users');
        return $query->row();
    }

    function getEmailAutoreply()
    {
        $this->db->where('email_id', '1');
        $query = $this->db->get('autoreply_credentials');
        return $query->row();
    }
}
