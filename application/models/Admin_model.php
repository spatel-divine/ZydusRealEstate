<?php

class Admin_model extends CI_Model
{
    public function __construct() 
    {
        $this->load->database();
    }

    public function total_property()
    {
        $query = $this->db->query('SELECT * FROM property_master');
        return $query->result_array();
    }

    public function property_given_on_rent()
    {
       $query = $this->db->query('SELECT * FROM lease_given_master WHERE `financial_status_id` ="'.$this->db->escape_str("4").'" OR `financial_status_id` = "'.$this->db->escape_str("5").'"');
        return $query->result_array();
    }

    public function property_taken_on_rent()
    {
        $query = $this->db->query('SELECT * FROM lease_own_master WHERE `financial_status_id` = "'.$this->db->escape_str("3").'"');
        return $query->result_array();
    }

    public function legal_cases()
    {
        $query = $this->db->query('SELECT * FROM legal_master');
        return $query->result_array();
    }

    public function property_count() 
    {  



      $query_data = $this->db->query('SELECT dt.*,COUNT(c.property_type_id) AS code_count FROM property_master c RIGHT JOIN property_type_master dt on c.property_type_id = dt.property_type_id GROUP BY c.property_type_id'); 

                return $query_data->result_array();


    }

    public function insurance_renew_total()
    {        
        $query = $this->db->query('SELECT * FROM insurance_master WHERE MONTH(next_premium_date) = MONTH(CURRENT_DATE())  AND YEAR(next_premium_date) = YEAR(CURRENT_DATE()) AND (insurance_renewed = "'.$this->db->escape_str(1).'" OR insurance_renewed = "'.$this->db->escape_str(0).'")');
       //$query = $this->db->query('SELECT * FROM insurance_master WHERE MONTH(next_premium_date) = MONTH(CURRENT_DATE()) AND YEAR(next_premium_date) = YEAR(CURRENT_DATE()) AND (insurance_renewed = 1 OR insurance_renewed = 0)');
        return $query->result_array();
    }

    public function installment_payable_total()
    {        
        $query = $this->db->query('SELECT * FROM loan_master WHERE loan_installment_status = "'.$this->db->escape_str("Not Paid").'"');
        return $query->result_array();
    }

    public function rent_payable_total()
    {        
        $query = $this->db->query('SELECT * FROM lease_own_master WHERE lease_payment_status = "'.$this->db->escape_str("Not Paid").'"');
        return $query->result_array();
    }

    public function insurance_renew_list()
    {        
        $query = $this->db->query('SELECT c.*,cc.property_name FROM insurance_master c INNER JOIN property_master cc on c.property_id = cc.property_id WHERE MONTH(c.next_premium_date) = MONTH(CURRENT_DATE()) AND YEAR(c.next_premium_date) = YEAR(CURRENT_DATE()) AND (c.insurance_renewed = "'.$this->db->escape_str(1).'" OR c.insurance_renewed = "'.$this->db->escape_str(0).'") LIMIT 5');
        return $query->result_array();
    }

    public function installment_payable_list()
    {        
        $query = $this->db->query('SELECT c.*,cc.property_name,d.bank_name FROM loan_master c INNER JOIN property_master cc on c.property_id = cc.property_id INNER JOIN bank_master d on c.bank_id = d.bank_id WHERE c.loan_installment_status ="'.$this->db->escape_str("Not Paid").'"');
        return $query->result_array();
    }

            public function get_lease_own_detail() {
        $this->db->select("lease_own_id,lease_own_master.property_id,lessor_name,lease_amount,start_date,end_date,lease_contract_status,lease_increment,lease_increment_month,lease_increment_type,lease_increment_date,payment_date,payment_type,lease_increment_status,lease_payment_status,property_master.property_id,property_name,user_master.user_id,user_master.username"); 
         $this->db->from('lease_own_master');   
        $this->db->join('property_master', 'lease_own_master.property_id=property_master.property_id');    
        $this->db->join('user_master', 'lease_own_master.lessor_name=user_master.user_id');
        $this->db->order_by('lease_own_id','desc');
        $query1 = $this->db->get();
        return $query1->result_array();

        }

        public function get_lease_given_detail() {
        $this->db->select("lease_given_id,lease_given_master.property_id,lessee_name,lease_amount,start_date,end_date,lease_contract_status,payment_date,property_master.property_id,lease_increment,lease_increment_month,lease_increment_type,payment_type,lease_payment_status,lease_increment_status,lease_increment_date,property_name,user_master.user_id,user_master.username"); 
         $this->db->from('lease_given_master');   
        $this->db->join('property_master', 'lease_given_master.property_id=property_master.property_id');    
        $this->db->join('user_master', 'lease_given_master.lessee_name=user_master.user_id');
        $this->db->order_by('lease_given_id','desc');
        $query1 = $this->db->get();
        return $query1->result_array();

        }

        public function update_lease_own_detail($lease_amount,$increment_date,$lease_own_id)
        {

            $data = array(
            'lease_amount' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$lease_amount)),
            'lease_increment_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$increment_date)),
            'lease_increment_status' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ","Done")),
            );
            $this->db->where('lease_own_id', $this->db->escape_str($lease_own_id));
            return $this->db->update('lease_own_master', $data);
        
        }

         public function update_lease_given_detail($lease_amount,$increment_date,$lease_given_id)
        {

            $data = array(
            'lease_amount' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$lease_amount)),
            'lease_increment_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$increment_date)),
            'lease_increment_status' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ","Done")),
            );
            $this->db->where('lease_given_id', $this->db->escape_str($lease_given_id));
            return $this->db->update('lease_given_master', $data);
        
        }

        public function add_role($final_group_id)
        {

            $data = array(
            'username' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('username'))),
            'password' => $this->db->escape_str(base64_encode($this->input->post('password'))),
            'role_name' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('role_name'))),
            'roles' => $this->db->escape_str(preg_replace("/[!@#$%^*(){}:;<>.?\|=+]/"," ",implode(",",$this->input->post('foo[]')))),
            'property_group_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>.?\|=+]/"," ",$final_group_id)),
            'property_access' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>.?\|=+]/"," ",implode(",",$this->input->post('property_name[]')))),
            'role_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
            );
            return $this->db->insert('admin_master', $data);
        
        }

         public function add_pwd_histroy($insert_id)
        {

            $data = array(
            'admin_id' => $this->db->escape_str($insert_id),
            'password' => $this->db->escape_str(base64_encode($this->input->post('password'))),
            'pwd_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
            );
            return $this->db->insert('password_histroy', $data);
        
        }


         public function view_role() {
         //$this->db->from('admin_master');   
        $this->db->order_by('admin_id','desc');
        $query1 = $this->db->get_where("admin_master",array("role_name !="=>"Truncate Data","admin_status"=>"Unblocked"));
        return $query1->result_array();

        }

          public function view_blocked_role() { 
        $this->db->order_by('admin_id','desc');
        $query1 = $this->db->get_where('admin_master',array("admin_status" => $this->db->escape_str("Blocked")));
        return $query1->result_array();

        }

        public function delete_role_detail($admin_id1) {

        //$this->db->delete('user_activity', array('user_id' => $this->db->escape_str($admin_id1)));     
       // $this->db->delete('admin_master', array('admin_id' => $this->db->escape_str($admin_id1))); 

         $data = array(
            'admin_status' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ","Blocked")),
            );
         $this->db->where('admin_id', $this->db->escape_str($admin_id1));
         $this->db->update('admin_master', $data);
       // $this->db->delete('password_histroy', array('admin_id' => $this->db->escape_str($admin_id1))); 

        }

         public function view_role_by_id($admin_id1) {  
        $this->db->order_by('admin_id','desc');
        $query1 = $this->db->get_where('admin_master',array('admin_id'=>$this->db->escape_str($admin_id1)));
        return $query1->result_array();

        }

         public function edit_role($admin_id1,$data)
        {

           /* $data = array(
            'password' => $this->db->escape_str(base64_encode($this->input->post('password'))),
            'role_name' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('role_name'))),
            'roles' => $this->db->escape_str(preg_replace("/[!@#$%^*(){}:;<>.?\|=+]/"," ",implode(",",$this->input->post('foo[]')))),
            'property_group_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>.?\|=+]/"," ",$final_group_id)),
            'property_access' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>.?\|=+]/"," ",implode(",",$this->input->post('property_name[]')))),
            );*/
            $this->db->where('admin_id', $this->db->escape_str($admin_id1));
            return $this->db->update('admin_master', $data);
        
        }

        public function unblock_user($admin_id1)
        {

            $data = array(
            'admin_status' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ","Unblocked")),
            );
            $this->db->where('admin_id', $this->db->escape_str($admin_id1));
            return $this->db->update('admin_master', $data);
        
        }


    
        public function get_property() {
       //$this->db->limit($limit,$start);    
        $this->db->order_by('property_id','desc');
                 $query = $this->db->from('property_master');
                $query = $this->db->get();
                return $query->result_array();
        }

         public function get_property_groups() {   
        $this->db->order_by('property_group_id','desc');
                 $query = $this->db->from('property_group_master');
                $query = $this->db->get();
                return $query->result_array();
        }

        public function get_property_by_group_id($id) { 

        $this->db->order_by('property_id','desc');

        $this->db->select('property_id,property_name,property_group_id');
        $this->db->from('property_master');
        $this->db->where_in('property_group_id', $id);
        $result = $this->db->get();

        return $result->result_array();


        //$query = $this->db->join('proeprty_group_id','proeprty_group_master.property_group_id = property_master.property_group_id');
                //$query = $this->db->get_where_in('property_master',array('property_master.property_group_id' => $id));
                //return $query->result_array();
        }

        public function get_property_according_to_group($property_group_id) { 

        $this->db->order_by('property_id','desc');
        $this->db->select('property_id,property_name,property_group_id');
        $this->db->from('property_master');
        $this->db->where_in('property_group_id', $property_group_id);
        $result = $this->db->get();
        return $result->result_array();
        }

        public function view_log() {
         $this->db->from('user_activity');   
        $this->db->order_by('id','desc');
        $this->db->limit(10);
        $query1 = $this->db->get();
        return $query1->result_array();

        }

        public function get_log_details($admin_id) {
         //$this->db->from('user_activity');   
         $this->db->join('admin_master','user_activity.user_id = admin_master.admin_id');
        $this->db->order_by('id','desc');
        $this->db->limit(10);
        $query1 = $this->db->get_where("user_activity",array('user_id'=>$admin_id));
        return $query1->result_array();

        }

        public function get_last_login_details($admin_id) {
         //$this->db->from('user_activity');   
         $this->db->join('admin_master','user_activity.user_id = admin_master.admin_id');
        $this->db->order_by('id','desc');
        $this->db->limit(1,1);
        $query1 = $this->db->get_where("user_activity",array('user_id'=>$admin_id,'action'=>'logged_in'));
        return $query1->result_array();

        }

}

?>