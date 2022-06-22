<?php
class Lease_model extends CI_Model
{
    public function __construct() {
        $this->load->database();
    }
	public function get_lessor() {  
	        $query1 = $this->db->join('user_type_master', 'user_master.user_type_id=user_type_master.user_type_id');   
	        $this->db->order_by('user_id','desc');
	                $query1 = $this->db->get_where('user_master',array("user_type"=>$this->db->escape_str("Lessor"),"activation_status"=>$this->db->escape_str("Activated")));
	         $results1 = $query1->result_array();
	         return $results1;
	        }

	public function get_property() {
       //$this->db->limit($limit,$start);    
        $this->db->order_by('property_id','desc');
        $query = $this->db->join('property_financial_status_master','property_master.financial_status_id = property_financial_status_master.financial_status_id');
              
                $query = $this->db->where('financial_status != "'.$this->db->escape_str("Sold").'"');
                 $query = $this->db->from('property_master');
                $query = $this->db->get();
                return $query->result_array();
        }

        public function get_property_lease_own() {
       //$this->db->limit($limit,$start);    
        $this->db->order_by('property_id','desc');
        $query = $this->db->join('property_financial_status_master','property_master.financial_status_id = property_financial_status_master.financial_status_id');
              
                $query = $this->db->where('financial_status != "'.$this->db->escape_str("Sold").'" AND financial_status = "'.$this->db->escape_str("Leased").'"');
                 $query = $this->db->from('property_master');
                $query = $this->db->get();
                return $query->result_array();
        }
        
        

        public function get_lesse() {  
        $query1 = $this->db->join('user_type_master', 'user_master.user_type_id=user_type_master.user_type_id');   
        $this->db->order_by('user_id','desc');
                $query1 = $this->db->get_where('user_master',array("user_type"=>$this->db->escape_str("Lesse"),"activation_status"=>$this->db->escape_str("Activated")));
         $results1 = $query1->result_array();
         return $results1;
        }      

        public function add_lease_own($data1,$lessor_name,$financial_id,$payment_date){

             $start_date = $this->input->post('start_date');
           $newsDate = date("Y-m-d", strtotime($start_date));

           $enddate = $this->input->post('end_date');
           $neweDate = date("Y-m-d", strtotime($enddate));

           $new_data = base64_encode($data1); 

           date_default_timezone_set("Asia/Kolkata");

            $data = array(
                 
                'property_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('property_name'))),
                'lessor_name' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$lessor_name)),
                'start_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$newsDate)),
                'end_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$neweDate)),
                'payment_type' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('payment_type'))),
                'payment_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$payment_date)),
                'lease_amount' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('lease_amount'))),
                'lease_increment_type' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('increment_type'))),
                'lease_increment' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('lease_increment'))),
                'lease_increment_month' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('month_lease_increment'))),
                'area_taken_on_lease' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('lease_area'))),
                'unit' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('unit'))),
                'lease_security_deposit' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('lease_security_deposit'))),
                'lease_contract_status' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('lease_contract_status'))),
                'contract_upload' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$new_data)),
                'lease_terms' => $this->db->escape_str($this->input->post('lease_terms')),
                'lease_remarks' => $this->db->escape_str($this->input->post('lease_remark')),
                'financial_status_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$financial_id)),
                'lease_own_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
            );  

            return $this->db->insert('lease_own_master', $data);

        }  

          public function add_lease_own_lessor($data){

          
            return $this->db->insert('lease_own_lessor_master', $data);

        }  

        public function get_lease_own_detail() {
        $this->db->select("lease_own_id,lease_own_master.property_id,lessor_name,lease_amount,start_date,end_date,lease_contract_status,lease_increment,lease_increment_month,lease_increment_type,payment_date,payment_type,lease_payment_status,property_master.property_id,property_name,user_master.user_id,user_master.username"); 
         $this->db->from('lease_own_master');   
        $this->db->join('property_master', 'lease_own_master.property_id=property_master.property_id');    
        $this->db->join('user_master', 'lease_own_master.lessor_name=user_master.user_id');
        $this->db->order_by('lease_own_id','desc');
        $query1 = $this->db->get();
        return $query1->result_array();

        }

        public function get_lease_own_lessor_detail() {
        $this->db->select("lease_own_master.lease_own_id,lessor_name,user_master.user_id,user_master.username,lease_own_lessor_id,lease_own_lessor_master.lease_own_id,lessor_id"); 
         $this->db->from('lease_own_lessor_master');      
        $this->db->join('user_master', 'lease_own_lessor_master.lessor_id=user_master.user_id');
        $this->db->join('lease_own_master', 'lease_own_lessor_master.lease_own_id=lease_own_master.lease_own_id');
        $this->db->order_by('lease_own_lessor_id','desc');
        $query1 = $this->db->get();
        return $query1->result_array();

        }

        public function delete_lease_own_installment($lease_own_id) {

        return $this->db->delete('lease_own_installment_master', array('lease_own_id' => $lease_own_id)); 
        }

        public function delete_lease_own($lease_own_id) {

        return $this->db->delete('lease_own_master', array('lease_own_id' => $lease_own_id)); 
        }

         public function delete_lease_own_lessor($lease_own_id) {

        return $this->db->delete('lease_own_lessor_master', array('lease_own_id' => $lease_own_id)); 
        }

          public function get_lease_own_data($lease_own_id) {  

        $this->db->select('lease_own_master.*,lease_own_contract_status.*,user_master.user_id,user_master.username,property_master.property_id,property_master.property_name,property_financial_status_master.financial_status_id,property_financial_status_master.financial_status');    
        $this->db->join('property_master', 'lease_own_master.property_id=property_master.property_id');    
        $this->db->join('user_master', 'lease_own_master.lessor_name=user_master.user_id');
        $this->db->join('lease_own_contract_status', 'lease_own_master.lease_contract_status=lease_own_contract_status.lease_own_status_id'); 
         $this->db->join('property_financial_status_master', 'lease_own_master.financial_status_id=property_financial_status_master.financial_status_id');
        $this->db->order_by('lease_own_id','desc');
        $query1 = $this->db->get_where('lease_own_master',array('lease_own_id'=>$this->db->escape_str($lease_own_id)));
        return $query1->result_array();
    }

     public function get_lease_data_for_property($id) {  
        $this->db->order_by('lease_own_id','desc');
        $query1 = $this->db->get_where('lease_own_master',array('lease_own_id'=>$this->db->escape_str($id)));
        return $query1->result_array();
    }

    public function get_inserted_lease_own_data($property_id) {  
        $this->db->order_by('lease_own_id','desc');
        $query1 = $this->db->get_where('lease_own_master',array('property_id'=>$this->db->escape_str($property_id)));
        return $query1->result_array();
    }

    public function get_inserted_lease_given_data($property_id) {  
        $this->db->order_by('lease_given_id','desc');
        $this->db->join('property_master','lease_given_master.property_id = property_master.property_id');
        $query1 = $this->db->get_where('lease_given_master',array('lease_given_master.property_id'=>$this->db->escape_str($property_id)));
        return $query1->result_array();
    }

    public function download_detail($lease_own_id){
         $query = $this->db->get_where('lease_own_master',array("lease_own_id"=>$this->db->escape_str($lease_own_id)));
            return $query->row()->contract_upload;
    }


    public function add_lease_given($data1,$lessee_name,$financial_id,$payment_date){

             $start_date = $this->input->post('start_date');
           $newsDate = date("Y-m-d", strtotime($start_date));

           $enddate = $this->input->post('end_date');
           $neweDate = date("Y-m-d", strtotime($enddate));

           $new_data = base64_encode($data1); 

           date_default_timezone_set("Asia/Kolkata");

            $data = array(
                 
                'property_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('property_name'))),
                'lessee_name' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$lessee_name)),
                'start_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$newsDate)),
                'end_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$neweDate)),
                'payment_type' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('payment_type'))),
                'payment_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$payment_date)),
                'lease_amount' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('lease_amount'))),
                'lease_increment_type' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('increment_type'))),
                'lease_increment' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('lease_increment'))),
                'lease_increment_month' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('month_lease_increment'))),
                'area_given_on_lease' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('lease_area'))),
                'area_given_on_lease_2' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('area_given_on_lease'))),
                'unit' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('unit'))),
                'lease_security_deposit' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('lease_security_deposit'))),
                'lease_contract_status' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('lease_contract_status'))),
                'contract_upload' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$new_data)),
                'lease_terms' => $this->db->escape_str($this->input->post('lease_terms')),
                'lease_remarks' => $this->db->escape_str($this->input->post('lease_remark')),
                'financial_status_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$financial_id)),
                'lease_given_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
            );

            return $this->db->insert('lease_given_master', $data);

        }  

        public function update_remain_property_area($property_id,$remain_area){

            $data = array(

                'rent_receivable_available_unit' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$remain_area))

            );

            $this->db->where('property_id',$this->db->escape_str($property_id));
            return $this->db->update('property_master', $data);
         }   

         public function update_financial_status($property_id,$financial_id){

            $data = array(

                'financial_status_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$financial_id))

            );

            $this->db->where('property_id',$this->db->escape_str($property_id));
            return $this->db->update('property_master', $data);
         }   

          public function update_total_avail_area($property_id,$total_avail_area){

            $data = array(

                'rent_receivable_available_unit' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$total_avail_area))

            );

            $this->db->where('property_id',$this->db->escape_str($property_id));
            return $this->db->update('property_master', $data);
         }   


          public function add_lease_given_lessee($data){

          
            return $this->db->insert('lease_given_lessee_master', $data);

        }  

        public function get_lease_given_detail() {
        $this->db->select("lease_given_id,lease_given_master.property_id,lessee_name,lease_amount,start_date,end_date,lease_contract_status,payment_date,property_master.property_id,property_master.financial_status_id,property_financial_status_master.financial_status_id,lease_increment,property_financial_status_master.financial_status,lease_increment_month,lease_increment_type,payment_type,lease_payment_status,property_name,mark_property_as_sold,user_master.user_id,user_master.username"); 
         $this->db->from('lease_given_master');   
        $this->db->join('property_master', 'lease_given_master.property_id=property_master.property_id');    
        $this->db->join('property_financial_status_master', 'property_master.financial_status_id=property_financial_status_master.financial_status_id');
        $this->db->join('user_master', 'lease_given_master.lessee_name=user_master.user_id');
        $this->db->order_by('lease_given_id','desc');
        $query1 = $this->db->get();
        return $query1->result_array();

        }

        public function get_lease_given_lessee_detail() {
        $this->db->select("lease_given_master.lease_given_id,lessee_name,user_master.user_id,user_master.username,lease_given_lessee_id,lease_given_lessee_master.lease_given_id,lessee_id"); 
         $this->db->from('lease_given_lessee_master');      
        $this->db->join('user_master', 'lease_given_lessee_master.lessee_id=user_master.user_id');
        $this->db->join('lease_given_master', 'lease_given_lessee_master.lease_given_id=lease_given_master.lease_given_id');
        $this->db->order_by('lease_given_lessee_id','desc');
        $query1 = $this->db->get();
        return $query1->result_array();

        }

        public function get_lease_given_data($lease_given_id) {
        $this->db->select('lease_given_master.*,lease_given_contract_status.*,user_master.user_id,user_master.username,property_master.property_id,property_master.property_name,property_financial_status_master.financial_status_id,property_financial_status_master.financial_status,property_master.property_contract,property_master.rent_receivable_available_unit');       
        $this->db->join('property_master', 'lease_given_master.property_id=property_master.property_id');    
        $this->db->join('user_master', 'lease_given_master.lessee_name=user_master.user_id');
          $this->db->join('property_financial_status_master', 'lease_given_master.financial_status_id=property_financial_status_master.financial_status_id');
        $this->db->join('lease_given_contract_status', 'lease_given_master.lease_contract_status=lease_given_contract_status.lease_given_status_id'); 
        $this->db->order_by('lease_given_id','desc');
        $query1 = $this->db->get_where('lease_given_master',array('lease_given_id'=>$this->db->escape_str($lease_given_id)));
        return $query1->result_array();
    }

     public function get_property_count($property_id) {
        $this->db->order_by('lease_given_id','desc');
        $query1 = $this->db->get_where('lease_given_master',array('property_id'=>$this->db->escape_str($property_id)));
        return $query1->num_rows();
    }

    public function download_lease_given_contract_detail($lease_given_id){
         $query = $this->db->get_where('lease_given_master',array("lease_given_id"=>$this->db->escape_str($lease_given_id)));
            return $query->row()->contract_upload;
    }

    public function delete_lease_given($lease_given_id) {

        return $this->db->delete('lease_given_master', array('lease_given_id' => $lease_given_id)); 
        }


     public function delete_lease_given_installment($lease_given_id) {

        return $this->db->delete('lease_given_installment_master', array('lease_given_id' => $lease_given_id)); 
        }

         public function delete_lease_given_lessee($lease_given_id) {

        return $this->db->delete('lease_given_lessee_master', array('lease_given_id' => $lease_given_id)); 
        }
       

        public function rent_payable_status() {   
            $this->db->order_by('lease_own_status_id','desc');
                    $query1 = $this->db->get('lease_own_contract_status');
             $results1 = $query1->result_array();
             return $results1;
            }

             public function rent_receivable_status() {   
            $this->db->order_by('lease_given_status_id','desc');
                    $query1 = $this->db->get('lease_given_contract_status');
             $results1 = $query1->result_array();
             return $results1;
            }

            public function insertrentpayable()
            {
                 date_default_timezone_set("Asia/Kolkata");
                $data = array(
                     
                    'lease_own_status' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('rent_payable_status'))),
                    'lease_own_status_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
                );
              
                    $this->db->insert('lease_own_contract_status', $data);
      
            }

            public function insertrentreceivable()
            {
                 date_default_timezone_set("Asia/Kolkata");
                $data = array(
                     
                    'lease_given_status' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('rent_receivable_status'))),
                    'lease_given_status_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
                );
              
                    $this->db->insert('lease_given_contract_status', $data);
      
            }


        public function rent_payable_data($rent_payable_id) {  
        $this->db->order_by('lease_own_status_id','desc');
                $query = $this->db->get_where('lease_own_contract_status',array('lease_own_status_id' => $this->db->escape_str($rent_payable_id)));
                return $query->result_array();
        }

        public function rent_receivable_data($rent_receivable_id) {  
        $this->db->order_by('lease_given_status_id','desc');
                $query = $this->db->get_where('lease_given_contract_status',array('lease_given_status_id' => $this->db->escape_str($rent_receivable_id)));
                return $query->result_array();
        }

        public function update_rent_payable($rent_payable_id)
        {

            $data = array(
            'lease_own_status' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('rent_payable_status'))),
            );
            $this->db->where('lease_own_status_id', $this->db->escape_str($rent_payable_id));
            return $this->db->update('lease_own_contract_status', $data);
        
        }


        public function update_rent_receivable($rent_receivable_id)
        {

            $data = array(
            'lease_given_status' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('rent_receivable_status'))),
            );
            $this->db->where('lease_given_status_id', $this->db->escape_str($rent_receivable_id));
            return $this->db->update('lease_given_contract_status', $data);
        
        }


            public function get_lease_own_contract_status() {    
            $this->db->order_by('lease_own_status_id','desc');
                    $query1 = $this->db->get('lease_own_contract_status');
             $results1 = $query1->result_array();
             return $results1;
            }

            public function get_property_data($id) {  
        $this->db->select('*');
        $query = $this->db->join('unit_master', 'property_master.unit=unit_master.unit_id');
        $query = $this->db->join('property_financial_status_master', 'property_master.financial_status_id=property_financial_status_master.financial_status_id');
             $this->db->from('property_master'); 
             $this->db->where('property_id',$this->db->escape_str($id)) ;
        $this->db->order_by('property_id','desc');
                $query = $this->db->get();
                return $query->result_array();
        }

        public function get_property_financial_status($financial_status) {  
            $this->db->select('financial_status_id');
             $this->db->from('property_financial_status_master'); 
             $this->db->where('financial_status',$this->db->escape_str($financial_status)) ;
        $this->db->order_by('financial_status_id','desc');
                $query = $this->db->get();
                return $query->row();
        }

        public function get_lessor1($lease_own_id) {      
       $query1 = $this->db->join('lease_own_master', 'lease_own_lessor_master.lease_own_id=lease_own_master.lease_own_id');
        $query1 = $this->db->join('user_master', 'lease_own_lessor_master.lessor_id=user_master.user_id');
       $query1 =  $this->db->order_by('lease_own_lessor_id','desc');
        $query1 = $this->db->get_where('lease_own_lessor_master',array('lease_own_lessor_master.lease_own_id'=>$this->db->escape_str($lease_own_id)));
        return $query1->result_array();

        }

         public function get_lessee1($lease_given_id) {      
       $query1 = $this->db->join('lease_given_master', 'lease_given_lessee_master.lease_given_id=lease_given_master.lease_given_id');
        $query1 = $this->db->join('user_master', 'lease_given_lessee_master.lessee_id=user_master.user_id');
       $query1 =  $this->db->order_by('lease_given_lessee_id','desc');
        $query1 = $this->db->get_where('lease_given_lessee_master',array('lease_given_lessee_master.lease_given_id'=>$this->db->escape_str($lease_given_id)));
        return $query1->result_array();

        }

        public function get_lease_given_contract_status() {    
            $this->db->order_by('lease_given_status_id','desc');
                    $query1 = $this->db->get('lease_given_contract_status');
             $results1 = $query1->result_array();
             return $results1;
        }

        public function add_lease_own_installment_detail($lease_own_id)
        {

            $data1 = array(
                'lease_own_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$lease_own_id)),
                'lease_own_amount' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('lease_amount'))),
                'lease_own_payment_refrence' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){};<>,?\|=+]/"," ",$this->input->post('payment_refrence'))),
                'lease_own_installment_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
            );

            return $this->db->insert('lease_own_installment_master', $data1);



         }

        public function update_lease_own_data($lease_own_id,$payment_date)
        {
            $data = array(
                'payment_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$payment_date)),
                'lease_payment_status' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",'Paid')),
            );

             $this->db->where('lease_own_id', $this->db->escape_str($lease_own_id));
            return $this->db->update('lease_own_master', $data);
        } 


         public function get_lease_own_installment_detail($lease_own_id) {    
       $this->db->join('lease_own_master', 'lease_own_installment_master.lease_own_id=lease_own_master.lease_own_id');        
       $this->db->join('property_master', 'lease_own_master.property_id=property_master.property_id');    
       $query1 =  $this->db->order_by('lease_own_installment_id','desc');
        $query1 = $this->db->get_where('lease_own_installment_master',array('lease_own_installment_master.lease_own_id'=>$this->db->escape_str($lease_own_id)));
        return $query1->result_array();

        }

                public function add_lease_given_installment_detail($lease_given_id)
        {

            $data1 = array(
                'lease_given_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$lease_given_id)),
                'lease_given_amount' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('lease_amount'))),
                'lease_given_payment_refrence' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){};<>,?\|=+]/"," ",$this->input->post('payment_refrence'))),
                'lease_given_installment_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
            );

            return $this->db->insert('lease_given_installment_master', $data1);



         }

        public function update_lease_given_data($lease_given_id,$payment_date)
        {
            $data = array(
                'payment_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$payment_date)),
                'lease_payment_status' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",'Paid')),
            );

             $this->db->where('lease_given_id', $this->db->escape_str($lease_given_id));
            return $this->db->update('lease_given_master', $data);
        } 


         public function get_lease_given_installment_detail($lease_given_id) {    
       $this->db->join('lease_given_master', 'lease_given_installment_master.lease_given_id=lease_given_master.lease_given_id');        
       $this->db->join('property_master', 'lease_given_master.property_id=property_master.property_id');    
       $query1 =  $this->db->order_by('lease_given_installment_id','desc');
        $query1 = $this->db->get_where('lease_given_installment_master',array('lease_given_installment_master.lease_given_id'=>$this->db->escape_str($lease_given_id)));
        return $query1->result_array();

        }

        public function update_property_financial_status($property_id,$financial_id){

            $data = array(
                'financial_status_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$financial_id)),
            );

             $this->db->where('property_id', $this->db->escape_str($property_id));
            return $this->db->update('property_master', $data);

        }

    public function view_property_for_filter() {  
        $this->db->order_by('property_id','desc');
        $query = $this->db->from('property_master');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function get_selected_property($property_id) {    
        $query1 = $this->db->get_where('property_master',array('property_id'=>$this->db->escape_str($property_id)));
        return $query1->result_array();

        }
   

}