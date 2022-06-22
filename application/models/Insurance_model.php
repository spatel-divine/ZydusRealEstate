<?php
class Insurance_model extends CI_Model
{
    public function __construct() {
        $this->load->database();
    }

    public function add_insurance($insurance_type_id,$policy_owner,$policy_payer,$insurance_beneficiary)
    {

       date_default_timezone_set("Asia/Kolkata");

       $premiumdate = $this->input->post('next_premium_date');
       $newpDate = date("Y-m-d", strtotime($premiumdate));

       $expirydate = $this->input->post('insurance_expiry_date');
       $neweDate = date("Y-m-d", strtotime($expirydate));

        $data = array(
             
            'property_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('property_id'))),
            'insurance_name' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('insurance_name'))),
            'insurance_company_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('insurance_company_id'))),
            'policy_no' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('policy_no'))),
            'insurance_type_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$insurance_type_id)),
            'coverage_amount' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('coverage_amount'))),
            'premium_amount' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('premium_amount'))),
            'contact_agent' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('contact_agent'))),
            'lean_mark' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('lean_mark'))),
            'lean_person_name' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('cp_name'))),
            'lean_amount' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('lean_amount'))),
            'next_premium_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$newpDate)),
            'insurance_expiry_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$neweDate)),
            'policy_owner' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$policy_owner)),
            'policy_payer' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>.?\|=+]/"," ",$policy_payer)),
            'insurance_beneficiary' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$insurance_beneficiary)),
            'ledger_number' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('ledger_number'))),
            'ledger_head' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('ledger_head'))),
            'insurance_renewed' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",0)),
            'insurance_remark' => $this->db->escape_str($this->input->post('insurance_remark')),
            'insurance_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
        );
        

           return  $this->db->insert('insurance_master', $data);


        
    }


public function update_insurance_renewal_detail($insurance_id)
    {

       $premiumdate = $this->input->post('next_renewal_date');
       $newpDate = date("Y-m-d", strtotime($premiumdate));

      if(!empty($this->input->post('insurance_renewed'))){
          $insurance_renewed = '2';
          } else{
            $insurance_renewed = '1';
          }  

            $data = array(
            'policy_no' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('policy_no'))),  
            'next_premium_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$newpDate)),
            'premium_amount' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('premium_amount'))),
            'policy_payer' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>.?\|=+]/"," ",$this->input->post('policy_payer'))),
            'ledger_head' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('ledger_head'))),
            'ledger_number' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('ledger_number'))),
            'insurance_renewed' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$insurance_renewed)),
            );

             if(!empty($this->input->post('insurance_renewed'))){
                   $data =array(

                    'insurance_renewed' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",'2'))
                  ); 
                }
            
            $this->db->where('insurance_id', $this->db->escape_str($insurance_id));
            return $this->db->update('insurance_master', $data);
        
}

     public function insertinsurancetype($id = 0)
    {
    	 date_default_timezone_set("Asia/Kolkata");
        $data = array(
             
            'insurance_type' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('insurance_type'))),
            'insurance_type_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
        );
      
        if ($id == 0) {
            $this->db->insert('insurance_type_master', $data);
			$insert_id = $this->db->insert_id();
			 return  $insert_id;
        }
    }

    public function view_insurance() {
       //$this->db->limit($limit,$start);   
       $query1 = $this->db->join('property_master', 'insurance_master.property_id=property_master.property_id');    
       $query1 = $this->db->join('insurance_company_master', 'insurance_master.insurance_company_id=insurance_company_master.insurance_company_id');  
        $this->db->order_by('insurance_id','desc');
                $query1 = $this->db->get('insurance_master');
                return $query1->result_array();
        }

          public function delete_insurance($insurance_id) {

            $query16 = $this->db->get_where('claim_master',array("insurance_id"=>$this->db->escape_str($insurance_id)));

               foreach($query16->result_array() as $result16){

                if($result16['insurance_id'] == $insurance_id){
                        if(!empty($result16['upload_claim_document'])){
                            $ipath6 = ('assets/images/uploads/claim/'.base64_decode($result16['upload_claim_document']));
                             unlink($ipath6);
                        }    
                          
                }     
            }

            $this->db->delete('insurance_master', array('insurance_id' => $insurance_id)); 
            $this->db->delete('claim_master', array('insurance_id' => $insurance_id)); 
            $this->db->delete('Inc_insurance_type_master', array('insurance_id' => $insurance_id));
            $this->db->delete('Inc_insurance_policy_owner_master', array('insurance_id' => $insurance_id));
            $this->db->delete('Inc_insurance_beneficiary_master', array('insurance_id' => $insurance_id));
            $this->db->delete('insurance_pay_master', array('insurance_id' => $insurance_id));
        }

     public function view_insurance_detail($insurance_id){
      
         $query = $this->db->join('property_master', 'insurance_master.property_id=property_master.property_id');    
       $query = $this->db->join('insurance_company_master', 'insurance_master.insurance_company_id=insurance_company_master.insurance_company_id');  
       $query = $this->db->join('insurance_type_master', 'insurance_master.insurance_type_id=insurance_type_master.insurance_type_id');  
          $query = $this->db->join('user_master', 'insurance_master.contact_agent=user_master.user_id');
          
         $query = $this->db->get_where('insurance_master',array("insurance_id"=>$this->db->escape_str($insurance_id)));
            return $query->result_array();
    }

    public function view_insurance_policy_owner_detail($insurance_id){

            $query =  $this->db->join('insurance_master', 'Inc_insurance_policy_owner_master.insurance_id=insurance_master.insurance_id');
           $query = $this->db->join('user_master', 'Inc_insurance_policy_owner_master.policy_owner_id=user_master.user_id'); 
         $query = $this->db->get_where('Inc_insurance_policy_owner_master',array("Inc_insurance_policy_owner_master.insurance_id"=>$this->db->escape_str($insurance_id)));
            return $query->result_array();
    }

     public function view_insurance_policy_ben_detail($insurance_id){

        $query =  $this->db->join('insurance_master', 'Inc_insurance_beneficiary_master.insurance_id=insurance_master.insurance_id');
        $query = $this->db->join('user_master', 'Inc_insurance_beneficiary_master.insurance_beneficiary_id=user_master.user_id');  
         $query = $this->db->get_where('Inc_insurance_beneficiary_master',array("Inc_insurance_beneficiary_master.insurance_id"=>$this->db->escape_str($insurance_id)));
            return $query->result_array();
    }


    public function view_insurance_type() {
       //$this->db->limit($limit,$start);    
        $this->db->order_by('insurance_type_id','desc');
                $query = $this->db->get('insurance_type_master');
                return $query->result_array();
        }

        public function delete_insurance_type($insurance_type_id) {

        return $this->db->delete('insurance_type_master', array('insurance_type_id' => $insurance_type_id)); 
        //return $this->db->delete('admin_master');
    }

    public function insertinsurancecompany($id = 0)
    {
    	 date_default_timezone_set("Asia/Kolkata");
        $data = array(
             
            'insurance_company' => $this->db->escape_str(preg_replace("/[!@#$%^*(){}:;<>,.?\|=+]/"," ",$this->input->post('insurance_company'))),
            'insurance_company_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
        );
      
        if ($id == 0) {
            $this->db->insert('insurance_company_master', $data);
			$insert_id = $this->db->insert_id();
			 return  $insert_id;
        }
    }

    public function view_insurance_company() {
       //$this->db->limit($limit,$start);    
        $this->db->order_by('insurance_company_id','desc');
                $query = $this->db->get('insurance_company_master');
                return $query->result_array();
        }

        public function delete_insurance_company($insurance_company_id) {

        return $this->db->delete('insurance_company_master', array('insurance_company_id' => $insurance_company_id)); 
        //return $this->db->delete('admin_master');
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

        public function get_property_for_claim() {
       //$this->db->limit($limit,$start);    
        $this->db->order_by('property_master.property_id','desc');
        //$this->db->distinct();
        $this->db->select('DISTINCT(insurance_master.property_id),property_master.property_id,property_master.property_name');
        $query = $this->db->join('insurance_master','property_master.property_id = insurance_master.property_id');
              
                //$query = $this->db->where('financial_status != "Sold"');
                 $query = $this->db->from('property_master');
                $query = $this->db->get();
                return $query->result_array();
        }


        public function view_insurance_data($property) {
        $query = $this->db->join('property_master', 'insurance_master.property_id=property_master.property_id');    
       $query = $this->db->join('insurance_company_master', 'insurance_master.insurance_company_id=insurance_company_master.insurance_company_id');  
       $query = $this->db->join('insurance_type_master', 'insurance_master.insurance_type_id=insurance_type_master.insurance_type_id');  
          $query = $this->db->join('user_master', 'insurance_master.contact_agent=user_master.user_id');
          
         $query = $this->db->get_where('insurance_master',array("insurance_master.property_id"=>$this->db->escape_str($property),'insurance_renewed !=' =>$this->db->escape_str('2')));
            return $query->result_array();
        }

        public function get_claim_data() {
        $query = $this->db->order_by('claim_id','desc');
        $query = $this->db->join('property_master', 'claim_master.property_id=property_master.property_id');
         $query = $this->db->join('insurance_master', 'claim_master.insurance_id=insurance_master.insurance_id'); 
       $query = $this->db->join('insurance_company_master', 'insurance_master.insurance_company_id=insurance_company_master.insurance_company_id');  
       $query = $this->db->join('insurance_type_master', 'insurance_master.insurance_type_id=insurance_type_master.insurance_type_id');  
       $query = $this->db->join('user_master', 'insurance_master.contact_agent=user_master.user_id');         
       $query = $this->db->from('claim_master');
                $query = $this->db->get();
            return $query->result_array();
        }

        public function get_insurance_claim_data($claim_id) {
        $query = $this->db->join('property_master', 'claim_master.property_id=property_master.property_id');
         $query = $this->db->join('insurance_master', 'claim_master.insurance_id=insurance_master.insurance_id'); 
       $query = $this->db->join('insurance_company_master', 'insurance_master.insurance_company_id=insurance_company_master.insurance_company_id');  
       $query = $this->db->join('insurance_type_master', 'insurance_master.insurance_type_id=insurance_type_master.insurance_type_id');  
       $query = $this->db->join('user_master', 'insurance_master.contact_agent=user_master.user_id');         
       $query = $this->db->get_where('claim_master',array('claim_id'=>$this->db->escape_str($claim_id)));
            return $query->result_array();
        }

        public function get_inserted_claim_data($insurance_id) {       
                $query = $this->db->order_by('claim_id','desc');
                $query = $this->db->join('property_master', 'claim_master.property_id=property_master.property_id');
                $query = $this->db->join('insurance_master', 'claim_master.insurance_id=insurance_master.insurance_id');
                $query = $this->db->get_where('claim_master',array('claim_master.insurance_id'=>$this->db->escape_str($insurance_id)));
            return $query->result_array();
        }


 public function get_insurance_company() {
       //$this->db->limit($limit,$start);    
        $this->db->order_by('insurance_company_id','desc');
                $query = $this->db->get('insurance_company_master');
                return $query->result_array();
        }


 public function get_insurance_type() {
       //$this->db->limit($limit,$start);    
        $this->db->order_by('insurance_type_id','desc');
                $query = $this->db->get('insurance_type_master');
                return $query->result_array();
        }


 public function get_contact_agent() {
       //$this->db->limit($limit,$start);    
        $query1 = $this->db->join('user_type_master', 'user_master.user_type_id=user_type_master.user_type_id');   
        $this->db->order_by('user_id','desc');
                $query1 = $this->db->get_where('user_master',array("user_type"=>$this->db->escape_str("Insurance Agent"),"activation_status"=>$this->db->escape_str('Activated')));
         $results1 = $query1->result_array();
         return $results1;
        }


 public function get_policy_owner() {
       //$this->db->limit($limit,$start);    
       $query1 = $this->db->join('user_type_master', 'user_master.user_type_id=user_type_master.user_type_id');   
        $this->db->order_by('user_id','desc');
                $query1 = $this->db->get_where('user_master',array("user_type"=>$this->db->escape_str("Policy Owner"),"activation_status"=>$this->db->escape_str('Activated')));
         $results1 = $query1->result_array();
         return $results1;
        }


 public function get_insurance_ben() {
       //$this->db->limit($limit,$start);    
        $query1 = $this->db->join('user_type_master', 'user_master.user_type_id=user_type_master.user_type_id');   
        $this->db->order_by('user_id','desc');
                $query1 = $this->db->get_where('user_master',array("user_type"=>$this->db->escape_str("Insurance Beneficiary"),"activation_status"=>('Activated')));
         $results1 = $query1->result_array();
         return $results1;
        }

       
     public function insurance_company($company) {  
        $this->db->order_by('insurance_company_id','desc');
                $query = $this->db->get_where('insurance_company_master',array('insurance_company_id' => $this->db->escape_str($company)));
                return $query->result_array();
        }

         public function update_insurance_company($company)
    {

            $data = array(
            'insurance_company' => $this->db->escape_str(preg_replace("/[!@#$%^*(){}:;<>,.?\|=+]/"," ",$this->input->post('insurance_company'))),
            );
            $this->db->where('insurance_company_id', $this->db->escape_str($company));
            return $this->db->update('insurance_company_master', $data);
        
    }

       public function insurance_type($type) {  
        $this->db->order_by('insurance_type_id','desc');
                $query = $this->db->get_where('insurance_type_master',array('insurance_type_id' => $this->db->escape_str($type)));
                return $query->result_array();
        }

         public function update_insurance_type($type)
    {

            $data = array(
            'insurance_type' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('insurance_type'))),
            );
            $this->db->where('insurance_type_id', $this->db->escape_str($type));
            return $this->db->update('insurance_type_master', $data);
        
    }

    public function add_claim($upload_claim){

        $claim_date_launch = $this->input->post('claim_date_launch');
        $newclaimDate = date("Y-m-d", strtotime($claim_date_launch));

         $data = array(
            'insurance_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('insurance_id'))),
            'property_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('property_id'))),
            'damage_remark' => $this->db->escape_str($this->input->post('damage_remark')),
            'claim_date_lunch' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$newclaimDate)),
            'claim_amount' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('claim_amount'))),
            'surveryer_name' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('surveyer_name'))),
            'surveyer_number' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('surveyer_number'))),
            'surveyer_status' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('surveyer_status'))),
            'upload_claim_document' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$upload_claim)),
            'claim_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date("Y-m-d")))
            );
         return  $this->db->insert('claim_master', $data);
    }

    public function download_claim_document($claim_id){
         $query = $this->db->get_where('claim_master',array("claim_id"=>$this->db->escape_str($claim_id)));
            return $query->row()->upload_claim_document;
    }

    public function delete_claim($claim_id) {

        return $this->db->delete('claim_master', array('claim_id' => $claim_id)); 
    }

    public function update_claim($upload_claim,$claim_id){

        $claim_date_launch = $this->input->post('claim_date_launch');
        $newclaimDate = date("Y-m-d", strtotime($claim_date_launch));

         $data = array(
            'damage_remark' => $this->db->escape_str($this->input->post('damage_remark')),
            'claim_date_lunch' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$newclaimDate)),
            'claim_amount' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('claim_amount'))),
            'surveryer_name' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('surveyer_name'))),
            'surveyer_number' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('surveyer_number'))),
            'surveyer_status' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('surveyer_status'))),
            'upload_claim_document' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$upload_claim)),
            );
         $this->db->where('claim_id', $this->db->escape_str($claim_id));
        return $this->db->update('claim_master', $data);
    }

    public function add_insurance_pay_detail($insurance_id)
        {

            $data1 = array(
                'insurance_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$insurance_id)),
                'insurance_amount' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('premium_amount'))),
                'insurance_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
            );

            return $this->db->insert('insurance_pay_master', $data1);



         }

         public function get_insurance_pay_detail($insurance_id) {    
       $this->db->join('insurance_master', 'insurance_pay_master.insurance_id=insurance_master.insurance_id');        
       $this->db->join('property_master', 'insurance_master.property_id=property_master.property_id');    
       $query1 =  $this->db->order_by('insurance_pay_id','desc');
        $query1 = $this->db->get_where('insurance_pay_master',array('insurance_pay_master.insurance_id'=>$this->db->escape_str($insurance_id)));
        return $query1->result_array();

        }

        public function view_property_for_filter() {  
            $this->db->order_by('property_id','desc');
            $query = $this->db->from('property_master');
            $query = $this->db->get();
            return $query->result_array();
        }

        public function add_insurnce_type($data){

          
            return $this->db->insert('Inc_insurance_type_master', $data);

        }  

        public function add_policy_owner($data){

          
            return $this->db->insert('Inc_insurance_policy_owner_master', $data);

        }  

        public function add_insurance_ben($data){

          
            return $this->db->insert('Inc_insurance_beneficiary_master', $data);

        }  

         public function get_insurance_type_detail($insurance_id) {   
        $this->db->join('insurance_master', 'Inc_insurance_type_master.insurance_id=insurance_master.insurance_id');
        $this->db->join('insurance_type_master', 'Inc_insurance_type_master.insurance_type_id=insurance_type_master.insurance_type_id');
        $this->db->order_by('inc_type_id','desc');
        $query1 = $this->db->get_where('Inc_insurance_type_master',array('Inc_insurance_type_master.insurance_id'=>$this->db->escape_str($insurance_id)));
        return $query1->result_array();

        }


}    