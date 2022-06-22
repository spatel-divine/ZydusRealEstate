<?php
class Loan_model extends CI_Model
{
    public function __construct() {
        $this->load->database();
    }


    public function insertloantype()
    {
    	 date_default_timezone_set("Asia/Kolkata");
        $data = array(
             
            'loan_type' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('loan_type'))),
            'loan_type_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
        );
      
            $this->db->insert('loan_type_master', $data);
      
    }

    public function view_loan_type() {  
        $this->db->order_by('loan_type_id','desc');
                $query = $this->db->get('loan_type_master');
                return $query->result_array();
        }


        public function loan_type($type) {  
        $this->db->order_by('loan_type_id','desc');
                $query = $this->db->get_where('loan_type_master',array('loan_type_id' => $this->db->escape_str($type)));
                return $query->result_array();
        }

        public function update_loan_type($type)
    	{

            $data = array(
            'loan_type' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('loan_type'))),
            );
            $this->db->where('loan_type_id', $this->db->escape_str($type));
            return $this->db->update('loan_type_master', $data);
        
    	}

 	  public function insertbank()
   	{
    	 date_default_timezone_set("Asia/Kolkata");
        $data = array(
             
            'bank_name' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('bank_name'))),
            'bank_email' => $this->db->escape_str(preg_replace("/[!#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('bank_email'))),
            'bank_contact_no' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('bank_contact_number'))),
            'bank_address' => $this->db->escape_str($this->input->post('bank_address')),
            'bank_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
        );
      
            $this->db->insert('bank_master', $data);
      
    }

    public function view_bank() {  
        $this->db->order_by('bank_id','desc');
                $query = $this->db->get('bank_master');
                return $query->result_array();
        }


        public function get_bank($bank_id) {  
        $this->db->order_by('bank_id','desc');
                $query = $this->db->get_where('bank_master',array('bank_id' => $this->db->escape_str($bank_id)));
                return $query->result_array();
        }

        public function update_bank($bank_id)
    	{

            $data = array(
            'bank_name' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('bank_name'))),
            'bank_email' => $this->db->escape_str(preg_replace("/[!#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('bank_email'))),
            'bank_contact_no' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('bank_contact_number'))),
            'bank_address' => $this->db->escape_str($this->input->post('bank_address')),
            );
            $this->db->where('bank_id', $this->db->escape_str($bank_id));
            return $this->db->update('bank_master', $data);
        
    	}


    public function insertloanofficer()
   	{
    	 date_default_timezone_set("Asia/Kolkata");
        $data = array(
             
            'bank_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('bank_name'))),
            'loan_officer_name' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('loan_officer_name'))),
            'loan_officer_contact' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('loan_officer_contact_number'))),
            'loan_officer_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
        );
      
            $this->db->insert('loan_officer_master', $data);
      
    }

    public function view_loan_officer() {  
        $this->db->order_by('loan_officer_id','desc');
         $query = $this->db->join('bank_master','loan_officer_master.bank_id = bank_master.bank_id');
                $query = $this->db->get('loan_officer_master');
                return $query->result_array();
        }


        public function get_loan_officer($officer_id) {  
        $this->db->order_by('loan_officer_id','desc');
        $query = $this->db->join('bank_master','loan_officer_master.bank_id = bank_master.bank_id');
                $query = $this->db->get_where('loan_officer_master',array('loan_officer_id' => $this->db->escape_str($officer_id)));
                return $query->result_array();
        }

        public function update_loan_officer($officer_id)
    	{

            $data = array(
           'bank_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('bank_name'))),
           'loan_officer_name' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('loan_officer_name'))),
           'loan_officer_contact' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('loan_officer_contact_number'))),
            );
            $this->db->where('loan_officer_id', $this->db->escape_str($officer_id));
            return $this->db->update('loan_officer_master', $data);
        
    	}

          public function view_property() {  
        $this->db->order_by('property_id','desc');
        $query = $this->db->join('property_financial_status_master','property_master.financial_status_id = property_financial_status_master.financial_status_id');
              
                $query = $this->db->where('financial_status != "'.$this->db->escape_str("Sold").'"');
                 $query = $this->db->from('property_master');
                $query = $this->db->get();
                return $query->result_array();
        }

         public function get_selected_property($property_id) {  
                $query = $this->db->get_where('property_master',array('property_id'=>$this->db->escape_str($property_id)));
                return $query->result_array();
        }


        public function view_lean_property() {  
        $this->db->order_by('property_id','desc');
        $query = $this->db->join('property_financial_status_master','property_master.financial_status_id = property_financial_status_master.financial_status_id');
              
                $query = $this->db->where('financial_status != "'.$this->db->escape_str("Sold").'"');
                $query = $this->db->where('property_contract = "'.$this->db->escape_str("Buy").'"');
                 $query = $this->db->from('property_master');
                $query = $this->db->get();
                return $query->result_array();
        }

        public function get_loan_ben() {  
        $query1 = $this->db->join('user_type_master', 'user_master.user_type_id=user_type_master.user_type_id');   
        $this->db->order_by('user_id','desc');
                $query1 = $this->db->get_where('user_master',array("user_type"=>$this->db->escape_str("Loan Beneficiary"),"activation_status"=>$this->db->escape_str("Activated")));
         $results1 = $query1->result_array();
         return $results1;
        }

        public function get_loan_ben_for_filter() {  
        $query1 = $this->db->join('user_type_master', 'user_master.user_type_id=user_type_master.user_type_id');   
        $this->db->order_by('user_id','desc');
                $query1 = $this->db->get_where('user_master',array("user_type"=>$this->db->escape_str("Loan Beneficiary")));
         $results1 = $query1->result_array();
         return $results1;
        }


        public function get_loan_officer_with_bank($id) {  
        $this->db->order_by('loan_officer_id','desc');
        $query = $this->db->join('bank_master','loan_officer_master.bank_id = bank_master.bank_id');
                $query = $this->db->get_where('loan_officer_master',array('loan_officer_master.bank_id' => $this->db->escape_str($id)));
                return $query->result_array();
        }

        public function insertloan($data1)
        {

           date_default_timezone_set("Asia/Kolkata");

           $start_date = $this->input->post('start_date');
           $newsDate = date("Y-m-d", strtotime($start_date));

           $enddate = $this->input->post('end_date');
           $neweDate = date("Y-m-d", strtotime($enddate));

           $payment_day = $this->input->post('payment_date');
    		$date=date('Y-m-'.$payment_day);
            $date11 = date('Y-m-d',strtotime($date. ' - 15 days'));
    		$reminder_day1 = date('d',strtotime($date11));
    		$diff = abs($reminder_day1 - $payment_day);

    		if($diff == '15')
    		{
    			$date1 = date('Y-m-d',strtotime($date. ' - 15 days'));
    			$reminder_day = date('d',strtotime($date1));	
    		}
    		else{
    			$date1 = date('Y-m-d',strtotime($date. ' - 16 days'));
    		    $reminder_day = date('d',strtotime($date1));
    		}

             $new_data = base64_encode($data1); 


            $data = array(
                 
                'property_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('property_name'))),
                'bank_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('loan_wih_bank'))),
                'loan_officer_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('loan_officer_name'))),
                'loan_beneficary' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('beneficary'))),
                'loan_amount' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('loan_amount'))),
                'start_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$newsDate)),
                'end_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$neweDate)),
                'interest_type' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('interest_type'))),
                'installment_interest' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('installment_interest'))),
                'installment_amount' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('installment_amount'))),
                'total_loan_amount' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('total_loan_amount'))),
                'payment_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('payment_date'))),
                'reminder_day' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$reminder_day)),
                'total_no_installments' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('total_no_installments'))),
                'loan_type_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('loan_type'))),
                'lean_mark' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('lean_mark'))),
                'lean_property_id' => $this->db->escape_str($this->input->post(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",'lean_property_name'))),
                'loan_remark' => $this->db->escape_str($this->input->post('remark')),
                'upload_loan_document' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$new_data)),
                'loan_installment_status' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",'Not Paid')),
                'loan_added_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
            );
            

               return  $this->db->insert('loan_master', $data);


        
        }

           public function update_loan_lean_status($lean_property_id)
    {
       
            $data = array(
                 
                'loan_lean_status' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",'Lean Mark')),
                
            );

            $this->db->where('property_id', $this->db->escape_str($lean_property_id));
            return $this->db->update('property_master', $data);
    }

     public function update_lean_at_delete($lean_property_id)
    {
       
            $data = array(
                 
                'loan_lean_status' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",'No Status')),
                
            );

            $this->db->where('property_id', $this->db->escape_str($lean_property_id));
            return $this->db->update('property_master', $data);
    }

        public function view_loan() { 
       $query1 = $this->db->join('property_master', 'loan_master.property_id=property_master.property_id');    
     $query1 = $this->db->join('bank_master', 'loan_master.bank_id=bank_master.bank_id');
     $query1 = $this->db->join('loan_officer_master', 'loan_master.loan_officer_id=loan_officer_master.loan_officer_id');
        $this->db->order_by('loan_id','desc');
                $query1 = $this->db->get('loan_master');
                return $query1->result_array();
        }

         public function view_loan_detail($loan_id){
      
          $query1 = $this->db->join('property_master', 'loan_master.property_id=property_master.property_id');    
     $query1 = $this->db->join('bank_master', 'loan_master.bank_id=bank_master.bank_id');
     $query1 = $this->db->join('loan_officer_master', 'loan_master.loan_officer_id=loan_officer_master.loan_officer_id');  
          $query = $this->db->join('user_master', 'loan_master.loan_beneficary=user_master.user_id');
           $query1 = $this->db->join('loan_type_master', 'loan_master.loan_type_id=loan_type_master.loan_type_id');
         $query = $this->db->get_where('loan_master',array("loan_id"=>$this->db->escape_str($loan_id)));
            return $query->result_array();
    }

     public function view_lean_loan_detail($loan_id){
      
          $query1 = $this->db->join('property_master', 'loan_master.lean_property_id=property_master.property_id');    
             $query = $this->db->get_where('loan_master',array("loan_id"=>$this->db->escape_str($loan_id),"lean_mark"=>$this->db->escape_str("Yes")));
            return $query->result_array();
    }

    public function delete_loan($loan_id) {

        return $this->db->delete('loan_master', array('loan_id' => $loan_id)); 
        }

         public function delete_loan_installment($loan_id) {

        return $this->db->delete('loan_installment_master', array('loan_id' => $loan_id)); 
        }


   public function update_loan($loan_id)
    {
        $start_date = $this->input->post('start_date');
           $newsDate = date("Y-m-d", strtotime($start_date));

           $enddate = $this->input->post('end_date');
           $neweDate = date("Y-m-d", strtotime($enddate));

           $payment_day = $this->input->post('payment_date');
    		$date=date('Y-m-'.$payment_day);
            $date11 = date('Y-m-d',strtotime($date. ' - 15 days'));
    		$reminder_day1 = date('d',strtotime($date11));
    		$diff = abs($reminder_day1 - $payment_day);

    		if($diff == '15')
    		{
    			$date1 = date('Y-m-d',strtotime($date. ' - 15 days'));
    			$reminder_day = date('d',strtotime($date1));	
    		}
    		else{
    			$date1 = date('Y-m-d',strtotime($date. ' - 16 days'));
    		    $reminder_day = date('d',strtotime($date1));
    		}
            $data = array(
                 
                'property_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('property_name'))),
                'bank_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('loan_wih_bank'))),
                'loan_officer_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('loan_officer_name'))),
                'loan_beneficary' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('beneficary'))),
                'loan_amount' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('loan_amount'))),
                'start_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$newsDate)),
                'end_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$neweDate)),
                'interest_type' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('interest_type'))),
                'installment_interest' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('installment_interest'))),
                'installment_amount' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('installment_amount'))),
                'total_loan_amount' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('total_loan_amount'))),
                'payment_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('payment_date'))),
                 'reminder_day' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$reminder_day)),
                'loan_type_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('loan_type'))),
                'loan_remark' => $this->db->escape_str($this->input->post('remark')),
            );

            $this->db->where('loan_id', $this->db->escape_str($loan_id));
            return $this->db->update('loan_master', $data);
    }


    public function get_loan_installment_detail($loan_id) {    
        $this->db->order_by('loan_installment_id','desc');
                $query1 = $this->db->get_where('loan_installment_master',array('loan_id' => $this->db->escape_str($loan_id)));
                return $query1->num_rows();
        }

        public function get_loan_detail($loan_id) {     
        $this->db->order_by('loan_id','desc');
                 $query1 = $this->db->select('total_no_installments,lean_mark,lean_property_id');
                $query1 = $this->db->get_where('loan_master',array('loan_id' => $this->db->escape_str($loan_id)));
                return $query1->row();
        }

        public function add_loan_installment_detail($loan_id)
    {

            date_default_timezone_set("Asia/Kolkata");

            $data1 = array(
                'loan_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$loan_id)),
                'installment_amount' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('installment_amount'))),
                'payment_reference' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){};<>,?\|=+]/"," ",$this->input->post('payment_refrence'))),
                'loan_installment_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
            );

            return $this->db->insert('loan_installment_master', $data1);



    }

    public function update_loan_data($loan_id)
    {

           $payment_day = $this->input->post('next_renewal_date');
    		$date=date('Y-m-'.$payment_day);
            $date11 = date('Y-m-d',strtotime($date. ' - 15 days'));
    		$reminder_day1 = date('d',strtotime($date11));
    		$diff = abs($reminder_day1 - $payment_day);

    		if($diff == '15')
    		{
    			$date1 = date('Y-m-d',strtotime($date. ' - 15 days'));
    			$reminder_day = date('d',strtotime($date1));	
    		}
    		else{
    			$date1 = date('Y-m-d',strtotime($date. ' - 16 days'));
    		    $reminder_day = date('d',strtotime($date1));
    		}

            $data = array(
                'payment_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('next_renewal_date'))),
                'reminder_day' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$reminder_day)),
                'loan_installment_status' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",'Paid')),
                'loan_remark' => $this->db->escape_str($this->input->post('remark')),
            );

            $this->db->where('loan_id', $this->db->escape_str($loan_id));
            return $this->db->update('loan_master', $data);

    }

    public function update_loan_paid_detail($loan_id)
    {

            $data = array(
                'loan_installment_status' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",'Fully Paid')),
            );

            $this->db->where('loan_id', $this->db->escape_str($loan_id));
            return $this->db->update('loan_master', $data);


    }

    public function view_installment_detail($loan_id) {  
     $query1 = $this->db->join('loan_master', 'loan_installment_master.loan_id=loan_master.loan_id');    
      $query1 = $this->db->join('property_master', 'loan_master.property_id=property_master.property_id');   
        $this->db->order_by('loan_installment_id','desc');
                $query1 = $this->db->get_where('loan_installment_master',array('loan_installment_master.loan_id' => $this->db->escape_str($loan_id)));
                return $query1->result_array();
        }

        public function get_inserted_loan_data($property_id) {  
        $this->db->order_by('loan_id','desc');
                $query = $this->db->get_where('loan_master',array('property_id' => $this->db->escape_str($property_id)));
                return $query->result_array();
        }

          public function get_inserted_loan_data_edit($loan_id) {  


                  $this->db->order_by('loan_id','desc');

                  $query = $this->db->query("SELECT property_id,loan_installment_status from loan_master WHERE loan_id != '".$this->db->escape_str($loan_id)."'  ORDER BY loan_id");

                return $query->result_array();
        }

    public function view_property_for_filter() {  
        $this->db->order_by('property_id','desc');
        $query = $this->db->from('property_master');
        $query = $this->db->get();
        return $query->result_array();
    }

     public function download_detail($loan_id){
         $query = $this->db->get_where('loan_master',array("loan_id"=>$this->db->escape_str($loan_id)));
            return $query->row()->upload_loan_document;
    }

    public function property_id_detail($loan_id){
         $query = $this->db->get_where('loan_master',array("loan_id"=>$this->db->escape_str($loan_id)));
            return $query->row()->property_id;
    }

    public function get_loan_data($loan_id){
         $query = $this->db->get_where('loan_master',array("loan_id"=>$this->db->escape_str($loan_id)));
            return $query->result_array();
    }

     public function get_property_count($lean_property_id) {
        $this->db->order_by('loan_id','desc');
        $query1 = $this->db->get_where('loan_master',array('lean_property_id'=>$this->db->escape_str($lean_property_id),'loan_installment_status !='=>$this->db->escape_str('Fully Paid')));
        return $query1->num_rows();
    }

    public function get_property_count_for_delete($lean_property_id) {
        $this->db->order_by('loan_id','desc');
        $query1 = $this->db->get_where('loan_master',array('lean_property_id'=>$this->db->escape_str($lean_property_id)));
        return $query1->num_rows();
    }




}