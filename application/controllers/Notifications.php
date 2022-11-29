<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notifications extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Manila');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('MainModel');
        $this->load->database();
    }

    public function getNotif()
    {
        $output = '';
        $userID = $_SESSION['loggedIn']['id'];
        if (isset($_POST['view'])) {
            if ($_POST["view"] != '') {
                $this->db->where('user_id', $_SESSION['loggedIn']['id']);
                $this->db->where('seen_status', '0');
                $this->db->update('notification', array('seen_status' => '1'));
            }

            $query = $this->db->query("
                        SELECT *
                        FROM notification WHERE user_id='" . $userID . "' AND seen_status='0'
                        ORDER BY notif_id DESC LIMIT 5
                        ");

            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {

                    $this->db->where('emp_id', $row->added_by_userID);
                    $query = $this->db->get('employee');
                    $res = $query->row();
                    $date_created = date('D M j, Y g:i a', strtotime($row->date_added));
                    
                    if ($userID == $row->added_by_userID) {
                        $added_by = 'You are';
                    } else {
                        $added_by = $row->added_by;
                    }

                    $output .= '
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <img class="box me-2" src="' . base_url('uploaded_file/profile/') . '' . $res->profile_pic . '" alt="Pofile-Picture">
                            <div>
                                <h4>' . $added_by . '</h4>
                                <p>' . $row->notif_message . '</p>
                                <p>' . $date_created . '</p>
                            </div>
                        </li>
                    ';
                }
            } else {
                $output .= '<li class="dropdown-header">
                                No Notification Found
                            </li>';
            }

            $status_query  = $this->db->query("
                        SELECT *
                        FROM notification WHERE user_id='" . $userID . "' AND seen_status='0'
                        ");
            $count = $status_query->num_rows();

            $data = array(
                'notification' => $output,
                'unseen_notification'  => $count
            );
            echo json_encode($data);
        } // end of first if
    }
}
