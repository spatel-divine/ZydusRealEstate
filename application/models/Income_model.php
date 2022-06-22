<?php
class Income_model extends CI_Model
{
    public function __construct() {
        $this->load->database();
    }

    public function add_income($data1)
    {
        date_default_timezone_set("Asia/Kolkata");

       $income_date = $this->input->post('income_date');
       $new_income_date = date("Y-m-d", strtotime($income_date));

       $new_data = base64_encode($data1); 

       if(!empty($this->input->post('next_recurring_date'))){
           $recurring_date = $this->input->post('next_recurring_date');
           $new_recurring_date = date("Y-m-d", strtotime($recurring_date));
       }
       else{
            $new_recurring_date = "";
       }

        $data = array(
             
            'income_ledger_head' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('ledger_head'))),
            'income_ledger_number' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('ledger_number'))),
            'property_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('property_name'))),
            'income_title' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('income_title'))),
            'income_amount' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('income_amount'))),
            'income_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$new_income_date)),
            'income_type_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('income_type'))),
            'income_source_party' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('party'))),
            'income_invoice_number' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('invoice_number'))),
            'invoice_upload' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$new_data)),
            'tds_percentage' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('tds_percentage'))),
            'gst_percentage' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('gst_percentage'))),
            'received_by' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('received_by'))),
            'recurring_income' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('recurring_income'))),
            'next_recurring_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$new_recurring_date)),
            'income_description' => $this->db->escape_str($this->input->post('income_description')),
            'income_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
        );


           return  $this->db->insert('income_master', $data);


        
    }


    public function view_income() {
       $query1 = $this->db->join('property_master', 'income_master.property_id=property_master.property_id');    
        $query1 = $this->db->join('user_master', 'income_master.income_source_party=user_master.user_id');
        $this->db->order_by('income_id','desc');
                $query1 = $this->db->get('income_master');
                return $query1->result_array();
        }

        public function view_income_detail($income_id){
      
         $query = $this->db->join('property_master', 'income_master.property_id=property_master.property_id');    
       $query = $this->db->join('user_master', 'income_master.income_source_party=user_master.user_id');  
       $query = $this->db->join('income_type_master', 'income_master.income_type_id=income_type_master.income_type_id');  
         
         $query = $this->db->get_where('income_master',array("income_id"=>$this->db->escape_str($income_id)));
            return $query->result_array();
    }

    public function view_income_received_by_detail($income_id){
         
       $query = $this->db->join('user_master','income_master.received_by=user_master.user_id');  
      
         $query = $this->db->get_where('income_master',array("income_id"=>$this->db->escape_str($income_id)));
            return $query->result_array();
    }

     public function download_detail($income_id){
         $query = $this->db->get_where('income_master',array("income_id"=>$this->db->escape_str($income_id)));
            return $query->row()->invoice_upload;
    }

     public function delete_income($income_id) {

        return $this->db->delete('income_master', array('income_id' => $this->db->escape_str($income_id))); 
        }

        public function view_recurring_income() {
       $query1 = $this->db->join('property_master', 'income_master.property_id=property_master.property_id');    
        $query1 = $this->db->join('user_master', 'income_master.income_source_party=user_master.user_id');
        $this->db->order_by('income_id','desc');
                $query1 = $this->db->get_where('income_master',array('recurring_income' => $this->db->escape_str('Yes')));
                return $query1->result_array();
        }

     public function insertincometype()
    {
    	 date_default_timezone_set("Asia/Kolkata");
        $data = array(
             
            'income_type' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('income_type'))),
            'income_type_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
        );
      
            $this->db->insert('income_type_master', $data);
      
    }

    public function view_income_type() {  
        $this->db->order_by('income_type_id','desc');
                $query = $this->db->get('income_type_master');
                return $query->result_array();
        }


        public function income_type($type) {  
        $this->db->order_by('income_type_id','desc');
                $query = $this->db->get_where('income_type_master',array('income_type_id' => $this->db->escape_str($type)));
                return $query->result_array();
        }

        public function update_income_type($type)
    	{

            $data = array(
            'income_type' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('income_type'))),
            );
            $this->db->where('income_type_id', $this->db->escape_str($type));
            return $this->db->update('income_type_master', $data);
        
    	}

        public function view_property() {  
        $this->db->order_by('property_id','desc');
        $query = $this->db->join('property_financial_status_master','property_master.financial_status_id = property_financial_status_master.financial_status_id');
              
                $query = $this->db->where('financial_status != "'.$this->db->escape_str("Sold").'"');
                 $query = $this->db->from('property_master');
                $query = $this->db->get();
                return $query->result_array();
        }

        public function get_income_source_party() {  
        $query1 = $this->db->join('user_type_master', 'user_master.user_type_id=user_type_master.user_type_id');   
        $this->db->order_by('user_id','desc');
                $query1 = $this->db->get_where('user_master',array("user_type"=>$this->db->escape_str("Vendor"),"activation_status"=>$this->db->escape_str("Activated")));
         $results1 = $query1->result_array();
         return $results1;
        }

         public function get_income_source_party_for_filter() {  
        $query1 = $this->db->join('user_type_master', 'user_master.user_type_id=user_type_master.user_type_id');   
        $this->db->order_by('user_id','desc');
                $query1 = $this->db->get_where('user_master',array("user_type"=>$this->db->escape_str("Vendor")));
         $results1 = $query1->result_array();
         return $results1;
        }

         public function get_received_by() {  
        $query1 = $this->db->join('user_type_master', 'user_master.user_type_id=user_type_master.user_type_id');   
        $this->db->order_by('user_id','desc');
                $query1 = $this->db->get_where('user_master',array("user_type"=>$this->db->escape_str("Staff"),"activation_status"=>$this->db->escape_str("Activated")));
         $results1 = $query1->result_array();
         return $results1;
        }

        public function view_property_for_filter() {  
            $this->db->order_by('property_id','desc');
            $query = $this->db->from('property_master');
            $query = $this->db->get();
            return $query->result_array();
        }

}        