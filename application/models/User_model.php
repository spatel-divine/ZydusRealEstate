<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class User_model extends CI_Model
{
    public function __construct() {
        $this->load->database();
    }

    
   public function insertusertype($id = 0)
    {
        $data = array(
             
            'user_type' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('user_type'))),
        );
      
        if ($id == 0) {
            $this->db->insert('user_type_master', $data);
			$insert_id = $this->db->insert_id();
			 return  $insert_id;
        }
    }


   
     public function add_user()
    {

     
       date_default_timezone_set("Asia/Kolkata");
       //preg_replace('/[^A-Za-z0-9\-]/', '', $string);
       $data = array(
             
            'user_type_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('user_type'))),
            'username' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('username'))),
            'email' => $this->db->escape_str(preg_replace("/[!#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('email'))),
            'mobileno' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('mobileno'))),
            'address' => $this->db->escape_str($this->input->post('address')),
            'company_name' => $this->db->escape_str(preg_replace("/[!@#$%^*(){}:;<>,.?\|=+]/"," ",$this->input->post('comapny_name'))),
            'city' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('city'))),
            'state' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('state'))),
            'pincode' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('pincode'))),
            'gst_number' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('gst_number'))),
            'date_added' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
        );

           return  $this->db->insert('user_master', $data);


        
    }

    public function upload_user_document($user_id,$pancard_image,$adharcard_image,$pancard_no,$adharcard_no)
    {

       $data = array(
             
            'pancard_no' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$pancard_no)),
            'pancard_image' => $this->db->escape_str($pancard_image),
            'adharcard_no' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$adharcard_no)),
            'adharcard_image' => $this->db->escape_str($adharcard_image),
        );

          $this->db->where('user_id', $this->db->escape_str($user_id));
          return $this->db->update('user_master', $data);


        
    }


   public function update_user($user_id)
    {
            $data = array(
            'user_type_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('user_type'))),
            'username' =>$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('username'))),
            'email' => $this->db->escape_str(preg_replace("/[!#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('email'))),
            'mobileno' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('mobileno'))),
            'address' => $this->db->escape_str($this->input->post('address')),
            'company_name' => $this->db->escape_str(preg_replace("/[!@#$%^*(){}:;<>,.?\|=+]/"," ",$this->input->post('company_name'))),
            'city' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('city'))),
            'state' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('state'))),
            'pincode' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('pincode'))),
            'gst_number' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('gst_number'))),
            );
            
            $this->db->where('user_id', $this->db->escape_str($user_id));
            return $this->db->update('user_master', $data);
        
    }
         public function view_user_type() {
       //$this->db->limit($limit,$start);    
        $this->db->order_by('user_type_id','desc');
                $query = $this->db->get('user_type_master');
                return $query->result_array();
        }

           public function get_user_type($user_type_id) {  
        $this->db->order_by('user_type_id','desc');
                $query = $this->db->get_where('user_type_master',array('user_type_id' => $this->db->escape_str($user_type_id)));
                return $query->result_array();
        }


         public function view_user() {
       $query1 = $this->db->join('user_type_master', 'user_master.user_type_id=user_type_master.user_type_id');   
        $this->db->order_by('user_id','desc');
                $query1 = $this->db->get_where('user_master',array('activation_status' => $this->db->escape_str('Activated')));
         $results1 = $query1->result_array();
         return $results1;
        }

    public function delete_user($user_type_id) {

        return $this->db->delete('user_type_master', array('user_type_id' => $user_type_id)); 
    }

      public function delete_user_detail($user_id) {

        //return $this->db->delete('user_master', array('user_id' => $user_id)); 

         $data = array(
            'activation_status' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ","Deactivated")),
            );
         $this->db->where('user_id', $this->db->escape_str($user_id));
        return $this->db->update('user_master', $data);
    }

    public function view_user_detail($user_id){
        $query = $this->db->join('user_type_master', 'user_master.user_type_id=user_type_master.user_type_id'); 
         $query = $this->db->get_where('user_master',array("user_id"=>$this->db->escape_str($user_id)));
            return $query->result_array();
    }

      public function download_detail($user_id){
         $query = $this->db->get_where('user_master',array("user_id"=>$this->db->escape_str($user_id)));
            return $query->row()->pancard_image;
    }

     public function download_detail_adhar($user_id){
         $query = $this->db->get_where('user_master',array("user_id"=>$this->db->escape_str($user_id)));
            return $query->row()->adharcard_image;
    }



    public function logon($username, $password) {
        $this->db->select('*');
        $this->db->from('admin_master');
        $this->db->where('username', $this->db->escape_str($username));
        $this->db->where('password', $this->db->escape_str($password));
        $this->db->where('admin_status', $this->db->escape_str("UnBlocked"));
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

     public function get_user_data($username) {
        $this->db->select('*');
        $this->db->from('admin_master');
        $this->db->where('username', $this->db->escape_str($username));
        $this->db->limit(1);

        $query = $this->db->get();
         return $query->result_array();
    }

    public function get_user_data1($user_id) {
        $this->db->select('*');
        $this->db->from('admin_master');
        $this->db->where('admin_id', $this->db->escape_str($user_id));
        $query = $this->db->get();
         return $query->result_array();
    }


       public function update_user_status($admin_id1)
        {

            $data = array(
            'admin_status' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",'Blocked')),
            );
            $this->db->where('admin_id', $this->db->escape_str($admin_id1));
            return $this->db->update('admin_master', $data);
        
        }


     public function update_user_type($user_type_id)
    {

            $data = array(
            'user_type' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('user_type'))),
            );
            $this->db->where('user_type_id', $this->db->escape_str($user_type_id));
            return $this->db->update('user_type_master', $data);
        
    }

      public function view_password_by_id($admin_id1) {  
        $this->db->order_by('admin_id','desc');
        $this->db->limit(1);
        $query1 = $this->db->get_where('password_histroy',array('admin_id'=>$this->db->escape_str($admin_id1)));
        return $query1->result_array();

        }

        public function view_password_for_change_pwd($user_id) {  
        $this->db->order_by('pwd_histroy_id','desc');
        $this->db->select('password');
        $this->db->limit(5);
        $query1 = $this->db->get_where('password_histroy',array('admin_id'=>$this->db->escape_str($user_id)));
        return $query1->result_array();

        }

        public function add_pwd_histroy($user_id)
        {

            $data = array(
            'admin_id' => $this->db->escape_str($user_id),
            'password' => $this->db->escape_str(base64_encode($this->input->post('conf_password'))),
            'pwd_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
            );
            return $this->db->insert('password_histroy', $data);
        
        }

         public function update_password($user_id)
        {

            $data = array(
            'password' => $this->db->escape_str(base64_encode($this->input->post('conf_password')))
            );
            $this->db->where('admin_id', $this->db->escape_str($user_id));
            return $this->db->update('admin_master', $data);
        
        }

        public function add_faq()
    {

     
       date_default_timezone_set("Asia/Kolkata");
       $data = array(
             
            'faq_title' => $this->db->escape_str(preg_replace("/[!@#$%^*(){};<>,\|=+]/"," ",$this->input->post('faq_title'))),
            'faq_description' => $this->input->post('faq_description'),
            'faq_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
        );

           return  $this->db->insert('faq_master', $data);


        
    }

      public function view_faq() {
       //$this->db->limit($limit,$start);    
        $this->db->order_by('faq_id','desc');
                $query = $this->db->get('faq_master');
                return $query->result_array();
        }

 
}    