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

    function getOngoing()
    {
        $this->db->where('ticketing.concern_personID', $_SESSION['loggedIn']['id']);
        $this->db->where('ticketing.concern_status', 'Ongoing');
        $query = $this->db->get('helpdesk.ticketing');
        return $query->num_rows();
    }

    function getFinish()
    {
        $this->db->where('ticketing.concern_personID', $_SESSION['loggedIn']['id']);
        $this->db->where('ticketing.concern_status', 'Done');
        $query = $this->db->get('helpdesk.ticketing');
        return $query->num_rows();
    }
}
