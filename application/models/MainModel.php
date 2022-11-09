<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class MainModel extends CI_Model
{
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

    function getPermission()
    {
        $this->db->where('user_id', $_SESSION['loggedIn']['id']);
        $this->db->order_by('perm_id', 'ASC');
        return $this->db->get('roles_permissions')->result();
    }

    function getPermissionList()
    {
        $this->db->order_by('perm_id', 'ASC');
        return $this->db->get('permissions')->result();
    }

    function getSystem()
    {
        $query = $this->db->query("
                 SELECT * FROM roles_permissions
                 INNER JOIN permissions
                 ON roles_permissions.perm_id = permissions.perm_id
                 WHERE roles_permissions.user_id = '" . $_SESSION['loggedIn']['id'] . "'
        ");
        return $query->result();
    }

    function getPending()
    {
        $this->db->where('ticketing.concern_personID', $_SESSION['loggedIn']['id']);
        $this->db->where('ticketing.concern_status', 'Pending');
        $query = $this->db->get('helpdesk.ticketing');
        return $query->num_rows();
    }

    function getDepartment()
    {
        $query = $this->db->get('department');
        return $query->result();
    }
    function getPosition()
    {
        $query = $this->db->get('position');
        return $query->result();
    }

    function exportAccount()
    {
        $this->db->from('users');
        $this->db->join('employee', 'users.generated_id=employee.user_id', 'left');
        return $this->db->get()->result_array();
    }

    function getForReset()
    {
        $this->db->from('users');
        $this->db->join('employee', 'users.generated_id=employee.user_id', 'left');
        $this->db->where('users.user_status', 'For Reset');
        return $this->db->get()->result();
    }

}
