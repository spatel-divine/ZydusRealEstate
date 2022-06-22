<?php
class User_activity_model extends CI_Model {

    public function __construct() 
    {
        $this->load->database();
    }
    
    /**
     * Adds identifier information to the insert query
     * 
     * @param string $action
     * @param string $msg
     * @return void
     */
    public function add($action, $msg,$username,$admin_id) {

        date_default_timezone_set("Asia/Kolkata");
        $data = array(
            'user_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$admin_id)),
            'username' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$username)),
            'ip' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->ip_address())),
            'action' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$action)),
            'message' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>?\|=+]/"," ",$msg)),
            'date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d'))),
            'time' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){};<>,.?\|=+]/"," ",date('h:i:sA')))
        );
        $this->db->insert('user_activity', $data);
    }

}

?>