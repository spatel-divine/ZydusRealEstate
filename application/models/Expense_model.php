<?php
class Expense_model extends CI_Model
{
    public function __construct() {
        $this->load->database();
    }

    public function add_expense($data1)
    {
        date_default_timezone_set("Asia/Kolkata");

       $expense_date = $this->input->post('expense_date');
       $new_expense_date = date("Y-m-d", strtotime($expense_date));

       $new_data = base64_encode($data1); 

       if(!empty($this->input->post('next_recurring_date'))){
           $recurring_date = $this->input->post('next_recurring_date');
           $new_recurring_date = date("Y-m-d", strtotime($recurring_date));
       }
       else{
            $new_recurring_date = "";
       }

        $data = array(
             
            'expense_ledger_head' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('ledger_head'))),
            'expense_ledger_number' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('ledger_number'))),
            'property_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('property_name'))),
            'expense_title' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('expense_title'))),
            'expense_amount' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('expense_amount'))),
            'expense_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$new_expense_date)),
            'expense_type_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('expense_type'))),
            'expense_source_party' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('party'))),
            'expense_invoice_number' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('invoice_number'))),
            'invoice_upload' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$new_data)),
            'tds_percentage' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('tds_percentage'))),
            'gst_percentage' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('gst_percentage'))),
            'paid_by' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('paid_by'))),
            'recurring_expense' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('recurring_expense'))),
            'next_recurring_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$new_recurring_date)),
            'expense_description' => $this->db->escape_str($this->input->post('expense_description')),
            'expense_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
        );


           return  $this->db->insert('expense_master', $data);  
    }

   

	public function view_expense() {
       $query1 = $this->db->join('property_master', 'expense_master.property_id=property_master.property_id');    
        $query1 = $this->db->join('user_master', 'expense_master.expense_source_party=user_master.user_id');
        $this->db->order_by('expense_id','desc');
                $query1 = $this->db->get('expense_master');
                return $query1->result_array();
        }

        public function view_expense_detail($expense_id){
      
         $query = $this->db->join('property_master', 'expense_master.property_id=property_master.property_id');    
       $query = $this->db->join('user_master', 'expense_master.expense_source_party=user_master.user_id');  
       $query = $this->db->join('expense_type_master', 'expense_master.expense_type_id=expense_type_master.expense_type_id');  
         
         $query = $this->db->get_where('expense_master',array("expense_id"=>$this->db->escape_str($expense_id)));
            return $query->result_array();
    }

    public function view_expense_paid_by_detail($expense_id){
         
       $query = $this->db->join('user_master','expense_master.paid_by=user_master.user_id');  
      
         $query = $this->db->get_where('expense_master',array("expense_id"=>$this->db->escape_str($expense_id)));
            return $query->result_array();
    }

     public function download_detail($expense_id){
         $query = $this->db->get_where('expense_master',array("expense_id"=>$this->db->escape_str($expense_id)));
            return $query->row()->invoice_upload;
    }

     public function delete_expense($expense_id) {

        return $this->db->delete('expense_master', array('expense_id' => $this->db->escape_str($expense_id))); 
        }

        public function view_recurring_expense() {
       $query1 = $this->db->join('property_master', 'expense_master.property_id=property_master.property_id');    
        $query1 = $this->db->join('user_master', 'expense_master.expense_source_party=user_master.user_id');
        $this->db->order_by('expense_id','desc');
                $query1 = $this->db->get_where('expense_master',array('recurring_expense' => $this->db->escape_str('Yes')));
                return $query1->result_array();
        }


     public function insertexpensetype()
    {
    	 date_default_timezone_set("Asia/Kolkata");
        $data = array(
             
            'expense_type' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('expense_type'))),
            'expense_type_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
        );
      
            $this->db->insert('expense_type_master', $data);
      
    }

    public function view_expense_type() {  
        $this->db->order_by('expense_type_id','desc');
                $query = $this->db->get('expense_type_master');
                return $query->result_array();
        }


        public function expense_type($type) {  
        $this->db->order_by('expense_type_id','desc');
                $query = $this->db->get_where('expense_type_master',array('expense_type_id' => $this->db->escape_str($type)));
                return $query->result_array();
        }

        public function update_expense_type($type)
    	{

            $data = array(
            'expense_type' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('expense_type'))),
            );
            $this->db->where('expense_type_id', $this->db->escape_str($type));
            return $this->db->update('expense_type_master', $data);
        
    	}

        public function view_property() {  
        $this->db->order_by('property_id','desc');
        $query = $this->db->join('property_financial_status_master','property_master.financial_status_id = property_financial_status_master.financial_status_id');
              
                $query = $this->db->where('financial_status != "'.$this->db->escape_str("Sold").'"');
                 $query = $this->db->from('property_master');
                $query = $this->db->get();
                return $query->result_array();
        }

        public function get_expense_source_party() {  
        $query1 = $this->db->join('user_type_master', 'user_master.user_type_id=user_type_master.user_type_id');   
        $this->db->order_by('user_id','desc');
                $query1 = $this->db->get_where('user_master',array("user_type"=>$this->db->escape_str("Vendor"),"activation_status"=>$this->db->escape_str("Activated")));
         $results1 = $query1->result_array();
         return $results1;
        }

        public function get_expense_source_party_for_filter() {  
        $query1 = $this->db->join('user_type_master', 'user_master.user_type_id=user_type_master.user_type_id');   
        $this->db->order_by('user_id','desc');
                $query1 = $this->db->get_where('user_master',array("user_type"=>$this->db->escape_str("Vendor")));
         $results1 = $query1->result_array();
         return $results1;
        }

         public function get_paid_by() {  
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
