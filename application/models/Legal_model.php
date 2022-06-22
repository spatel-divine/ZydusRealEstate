<?php
class Legal_model extends CI_Model
{
    public function __construct() {
        $this->load->database();
    }


    public function insertcaseby()
    {
    	 date_default_timezone_set("Asia/Kolkata");
        $data = array(
             
            'case_by_contact_person' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('name'))),
            'case_by_email' => $this->db->escape_str(preg_replace("/[!#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('email'))),
            'case_by_contact_no' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('contact_number'))),
            'case_by_company_name' => $this->db->escape_str(preg_replace("/[!@#$%^*(){}:;<>,.?\|=+]/"," ",$this->input->post('company_name'))),
            'case_by_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
        );
      
            $this->db->insert('case_by_master', $data);
      
    }

    public function view_case_by() {  
        $this->db->order_by('case_by_id','desc');
                $query = $this->db->get('case_by_master');
                return $query->result_array();
        }

        public function case_by($case_by) {  
        $this->db->order_by('case_by_id','desc');
                $query = $this->db->get_where('case_by_master',array('case_by_id' => $this->db->escape_str($case_by)));
                return $query->result_array();
        }

        public function update_case_by($case_by)
    	{

            $data = array(
            'case_by_contact_person' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('name'))),
            'case_by_email' => $this->db->escape_str(preg_replace("/[!#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('email'))),
            'case_by_contact_no' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('contact_number'))),
            'case_by_company_name' => $this->db->escape_str(preg_replace("/[!@#$%^*(){}:;<>,.?\|=+]/"," ",$this->input->post('company_name'))),
            );
            $this->db->where('case_by_id', $this->db->escape_str($case_by));
            return $this->db->update('case_by_master', $data);
        
    	}


         public function insertcaseagainst()
    {
         date_default_timezone_set("Asia/Kolkata");
        $data = array(
             
            'case_against_contact_person' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('name'))),
            'case_against_email' => $this->db->escape_str(preg_replace("/[!#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('email'))),
            'case_against_contact_no' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('contact_number'))),
            'case_against_company_name' => $this->db->escape_str(preg_replace("/[!@#$%^*(){}:;<>,.?\|=+]/"," ",$this->input->post('company_name'))),
            'case_against_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
        );
      
            $this->db->insert('case_against_master', $data);
      
    }

    public function view_case_against() {  
        $this->db->order_by('case_against_id','desc');
                $query = $this->db->get('case_against_master');
                return $query->result_array();
        }

        public function case_against($case_against) {  
        $this->db->order_by('case_against_id','desc');
                $query = $this->db->get_where('case_against_master',array('case_against_id' => $this->db->escape_str($case_against)));
                return $query->result_array();
        }

        public function update_case_against($case_against)
        {

            $data = array(
            'case_against_contact_person' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('name'))),
            'case_against_email' => $this->db->escape_str(preg_replace("/[!#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('email'))),
            'case_against_contact_no' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('contact_number'))),
            'case_against_company_name' => $this->db->escape_str(preg_replace("/[!@#$%^*(){}:;<>,.?\|=+]/"," ",$this->input->post('company_name'))),
            );
            $this->db->where('case_against_id', $this->db->escape_str($case_against));
            return $this->db->update('case_against_master', $data);
        
        }


     public function insertpoilcestation()
     {
         date_default_timezone_set("Asia/Kolkata");
        $data = array(
             
            'police_station_name' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('police_station_name'))),
            'police_station_contact_number' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('contact_number'))),
            'police_station_branch' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('branch'))),
            'police_station_address' => $this->db->escape_str($this->input->post('address')),
            'police_station_state' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('state'))),
            'police_station_city' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('city'))),
            'police_station_pincode' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('pincode'))),
            'police_station_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
        );
      
            $this->db->insert('police_station_master', $data);
      
    }

    public function view_police_station() {  
        $this->db->order_by('police_station_id','desc');
                $query = $this->db->get('police_station_master');
                return $query->result_array();
        }

        public function police_station($police_station) {  
        $this->db->order_by('police_station_id','desc');
                $query = $this->db->get_where('police_station_master',array('police_station_id' => $this->db->escape_str($police_station)));
                return $query->result_array();
        }

        public function update_police_station($police_station)
        {

            $data = array(
            'police_station_name' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('police_station_name'))),
            'police_station_contact_number' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('contact_number'))),
            'police_station_branch' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('branch'))),
            'police_station_address' => $this->db->escape_str($this->input->post('address')),
            'police_station_state' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('state'))),
            'police_station_city' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('city'))),
            'police_station_pincode' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('pincode'))),
            );
            $this->db->where('police_station_id', $this->db->escape_str($police_station));
            return $this->db->update('police_station_master', $data);
        
        }



        public function insertcourtauthority()
     {
         date_default_timezone_set("Asia/Kolkata");
        $data = array(
             
            'legal_court_authority' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('court_authority_name'))),
            'legal_court_authority_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
        );
      
            $this->db->insert('legal_court_authority_master', $data);
      
    }

    public function view_court_authority() {  
        $this->db->order_by('legal_authority_id','desc');
                $query = $this->db->get('legal_court_authority_master');
                return $query->result_array();
        }

        public function court_authority($court_authority) {  
        $this->db->order_by('legal_authority_id','desc');
                $query = $this->db->get_where('legal_court_authority_master',array('legal_authority_id' => $this->db->escape_str($court_authority)));
                return $query->result_array();
        }

        public function update_court_authority($court_authority)
        {

            $data = array(
            'legal_court_authority' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('court_authority_name'))),
            );
            $this->db->where('legal_authority_id', $this->db->escape_str($court_authority));
            return $this->db->update('legal_court_authority_master', $data);
        
        }


    public function insertcasestatus()
     {
         date_default_timezone_set("Asia/Kolkata");
        $data = array(
             
            'case_status' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('case_status'))),
            'case_status_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
        );
      
            $this->db->insert('legal_case_status_master', $data);
      
    }

    public function view_case_status() {  
        $this->db->order_by('case_status_id','desc');
                $query = $this->db->get('legal_case_status_master');
                return $query->result_array();
        }

        public function case_status($case_status) {  
        $this->db->order_by('case_status_id','desc');
                $query = $this->db->get_where('legal_case_status_master',array('case_status_id' => $this->db->escape_str($case_status)));
                return $query->result_array();
        }

        public function update_case_status($case_status)
        {

            $data = array(
            'case_status' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('case_status'))),
            );
            $this->db->where('case_status_id', $this->db->escape_str($case_status));
            return $this->db->update('legal_case_status_master', $data);
        
        }

        public function view_property() {  
        $this->db->order_by('property_id','desc');
        $query = $this->db->join('property_financial_status_master','property_master.financial_status_id = property_financial_status_master.financial_status_id');
              
                $query = $this->db->where('financial_status != "'.$this->db->escape_str("Sold").'"');
                 $query = $this->db->from('property_master');
                $query = $this->db->get();
                return $query->result_array();
        }

        public function get_advocate() {  
        $query1 = $this->db->join('user_type_master', 'user_master.user_type_id=user_type_master.user_type_id');   
        $this->db->order_by('user_id','desc');
                $query1 = $this->db->get_where('user_master',array("user_type"=>$this->db->escape_str("Advocate"),"activation_status"=>$this->db->escape_str("Activated")));
         $results1 = $query1->result_array();
         return $results1;
        }

        public function add_legal($data1,$case_by,$case_against,$advocate_name){

             $registred_date = $this->input->post('registred_date');
           $newsDate = date("Y-m-d", strtotime($registred_date));

           $new_data = base64_encode($data1); 

           date_default_timezone_set("Asia/Kolkata");

            $data = array(
                 
                'property_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('property_name'))),
                'case_number' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('case_number'))),
                'case_by_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$case_by)),
                'case_against_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$case_against)),
                'police_station_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('police_station'))),
                'act_section_applied' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('act_section'))),
                'case_type' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('case_type'))),
                'case_registered_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$newsDate)),
                'advocate_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$advocate_name)),
                'court_authority_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('court_authority'))),
                'case_document_upload' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$new_data)),
                'legal_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
            );

            return $this->db->insert('legal_master', $data);

        }  


        public function add_legal_case_by($data){

          
            return $this->db->insert('legal_case_by_master', $data);

        }  

        public function add_legal_case_against($data){

          
            return $this->db->insert('legal_case_against_master', $data);

        }  

        public function add_legal_advocate($data){

          
            return $this->db->insert('legal_advocate_master', $data);

        }  

        public function get_legal_detail() {
         $this->db->from('legal_master');   
        $this->db->join('property_master', 'legal_master.property_id=property_master.property_id');    
        $this->db->join('police_station_master', 'legal_master.police_station_id=police_station_master.police_station_id');
        $this->db->order_by('legal_id','desc');
        $query1 = $this->db->get();
        return $query1->result_array();

        }

        public function get_legal_case_by_detail() {
         $this->db->from('legal_case_by_master');      
        $this->db->join('case_by_master', 'legal_case_by_master.case_by_id=case_by_master.case_by_id');
        $this->db->join('legal_master', 'legal_case_by_master.legal_id=legal_master.legal_id');
        $this->db->order_by('legal_case_by_id','desc');
        $query1 = $this->db->get();
        return $query1->result_array();

        }

        public function get_legal_case_against_detail() {
         $this->db->from('legal_case_against_master');      
        $this->db->join('case_against_master', 'legal_case_against_master.case_against_id=case_against_master.case_against_id');
        $this->db->join('legal_master', 'legal_case_against_master.legal_id=legal_master.legal_id');
        $this->db->order_by('legal_case_against_id','desc');
        $query1 = $this->db->get();
        return $query1->result_array();

        }

        public function get_legal_advocate_detail() {
         $this->db->from('legal_advocate_master');      
       $this->db->join('user_master', 'legal_advocate_master.advocate_id=user_master.user_id');
        $this->db->join('legal_master', 'legal_advocate_master.legal_id=legal_master.legal_id');
        $this->db->order_by('legal_advocate_id','desc');
        $query1 = $this->db->get();
        return $query1->result_array();

        }

          public function get_legal_data($legal_id) {
        $this->db->join('property_master', 'legal_master.property_id=property_master.property_id');    
        $this->db->join('police_station_master', 'legal_master.police_station_id=police_station_master.police_station_id');
        $this->db->join('legal_court_authority_master', 'legal_master.court_authority_id=legal_court_authority_master.legal_authority_id');
        $this->db->order_by('legal_id','desc');
         $query1 = $this->db->get_where('legal_master',array('legal_id'=>$this->db->escape_str($legal_id)));
        return $query1->result_array();

        }


         public function get_legal_property_data($property) {  
        $this->db->join('police_station_master', 'legal_master.police_station_id=police_station_master.police_station_id');
        $this->db->order_by('legal_id','desc');
         $query1 = $this->db->get_where('legal_master',array('property_id'=>$this->db->escape_str($property)));
        return $query1->result_array();

        }

        public function download_detail($legal_id){
         $query = $this->db->get_where('legal_master',array("legal_id"=>$this->db->escape_str($legal_id)));
            return $query->row()->case_document_upload;
    }

     public function delete_legal($legal_id) {

        $query = $this->db->get_where('hearing_master',array("legal_id"=>$this->db->escape_str($legal_id)));

        $query1 = $this->db->get_where('external_opinion_master',array("legal_id"=>$this->db->escape_str($legal_id)));

        $query3 = $this->db->get_where('legal_master',array("legal_id"=>$this->db->escape_str($legal_id)));

         foreach ($query3->result_array() as $result3) 
            {
                    if($result3['legal_id'] == $legal_id){
                        $ipath2 = ('assets/images/uploads/legal/'.base64_decode($result3['case_document_upload']));
                        unlink($ipath2);
                      
                    }     
            }

             foreach ($query->result_array() as $result) 
            {
                    if($result['legal_id'] == $legal_id){
                        $ipath = ('assets/images/uploads/hearing/'.base64_decode($result['upload_hearing_document']));
                        unlink($ipath);
                      
                    }     
            }

             foreach ($query1->result_array() as $result1) 
            {
                    if($result1['legal_id'] == $legal_id){
                        $ipath1 = ('assets/images/uploads/external_opinion/'.base64_decode($result1['external_opinion_document_upload']));
                        unlink($ipath1);
                    }     
            }

            $this->db->delete('legal_master', array('legal_id' => $legal_id));
            $this->db->delete('hearing_master', array('legal_id' => $legal_id));
            $this->db->delete('external_opinion_master', array('legal_id' => $legal_id));

        }

         public function delete_legal_case_by($legal_id) {

        return $this->db->delete('legal_case_by_master', array('legal_id' => $legal_id)); 
        }

        public function delete_legal_case_against($legal_id) {

        return $this->db->delete('legal_case_against_master', array('legal_id' => $legal_id)); 
        }

        public function delete_legal_advocate($legal_id) {

        return $this->db->delete('legal_advocate_master', array('legal_id' => $legal_id)); 
        }

        public function delete_hearing($hearing_id) {

        return $this->db->delete('hearing_master', array('hearing_id' => $hearing_id)); 
        }

        public function delete_external_opinion($external_opinion_id) {

        return $this->db->delete('external_opinion_master', array('external_opinion_id' => $external_opinion_id)); 
        }

         public function get_case_by_data($legal_id) {  
        $this->db->order_by('legal_case_by_id','desc');
        $query = $this->db->get_where('legal_case_by_master',array('legal_id' => $this->db->escape_str($legal_id)));
        return $query->result_array();
        }

         public function get_case_against_data($legal_id) {  
        $this->db->order_by('legal_case_against_id','desc');
        $query = $this->db->get_where('legal_case_against_master',array('legal_id' => $this->db->escape_str($legal_id)));
        return $query->result_array();
        }

        public function get_advocate_data($legal_id) {  
        $this->db->order_by('legal_advocate_id','desc');
        $query = $this->db->get_where('legal_advocate_master',array('legal_id' => $this->db->escape_str($legal_id)));
        return $query->result_array();
        }

       public function add_hearing($data1){

           $hearing_date = $this->input->post('hearing_date');
           $newhDate = date("Y-m-d", strtotime($hearing_date));

           $next_hearing_date = $this->input->post('next_hearing_date');
           $newnhDate = date("Y-m-d", strtotime($next_hearing_date));

           $new_data = base64_encode($data1); 

           date_default_timezone_set("Asia/Kolkata");

            $data = array(
                 
                'property_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('property_name'))),
                'legal_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('legal_id'))),
                'hearing_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$newhDate)),
                'next_hearing_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$newnhDate)),
                'hearing_case_status' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('case_status'))),
                'upload_hearing_document' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$new_data)),
                'hearing_comments' => $this->db->escape_str($this->input->post('hearing_comment')),
                'hearing_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
            );

            return $this->db->insert('hearing_master', $data);

        }  

        public function view_hearing_list() {  
        $this->db->join('property_master','hearing_master.property_id = property_master.property_id');
        $this->db->join('legal_master','hearing_master.legal_id = legal_master.legal_id');
        $this->db->join('legal_case_status_master','hearing_master.hearing_case_status = legal_case_status_master.case_status_id') ;    
        $this->db->order_by('hearing_id','desc');
                $query = $this->db->get('hearing_master');
                return $query->result_array();
        }

        public function get_inserted_hearing_data($legal_id) {  
        $query = $this->db->join('legal_case_status_master','hearing_master.hearing_case_status = legal_case_status_master.case_status_id') ;    
        $query = $this->db->order_by('hearing_id','desc');
        $query = $this->db->get_where('hearing_master',array('legal_id'=>$this->db->escape_str($legal_id)));
        return $query->result_array();
        }

        public function get_hearing_data($hearing_id) {  
        $query = $this->db->join('property_master','hearing_master.property_id = property_master.property_id'); 
        $query = $this->db->join('legal_master','hearing_master.legal_id = legal_master.legal_id') ;   
        $query = $this->db->join('police_station_master','legal_master.police_station_id = police_station_master.police_station_id') ;  
        $query = $this->db->join('legal_case_status_master','hearing_master.hearing_case_status = legal_case_status_master.case_status_id') ;    
        $query = $this->db->order_by('hearing_id','desc');
        $query = $this->db->get_where('hearing_master',array('hearing_id'=>$this->db->escape_str($hearing_id)));
        return $query->result_array();
        }

         public function hearing_download_detail($hearing_id){
         $query = $this->db->get_where('hearing_master',array("hearing_id"=>$this->db->escape_str($hearing_id)));
            return $query->row()->upload_hearing_document;
        }

        public function update_hearing($hearing_id,$data1){

           $hearing_date = $this->input->post('hearing_date');
           $newhDate = date("Y-m-d", strtotime($hearing_date));

           $next_hearing_date = $this->input->post('next_hearing_date');
           $newnhDate = date("Y-m-d", strtotime($next_hearing_date));

           $new_data = base64_encode($data1); 

            $data = array(
                 
                'hearing_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$newhDate)),
                'next_hearing_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$newnhDate)),
                'hearing_case_status' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('case_status'))),
                'upload_hearing_document' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$new_data)),
                'hearing_comments' => $this->db->escape_str($this->input->post('hearing_comment')),
            );

            $this->db->where('hearing_id', $this->db->escape_str($hearing_id));
            return $this->db->update('hearing_master', $data);


        } 

        public function update_hearing_without_image($hearing_id){

           $hearing_date = $this->input->post('hearing_date');
           $newhDate = date("Y-m-d", strtotime($hearing_date));

           $next_hearing_date = $this->input->post('next_hearing_date');
           $newnhDate = date("Y-m-d", strtotime($next_hearing_date));
           
            $data = array(
                 
                'hearing_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$newhDate)),
                'next_hearing_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$newnhDate)),
                'hearing_case_status' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('case_status'))),
                'hearing_comments' => $this->db->escape_str($this->input->post('hearing_comment')),
            );

            $this->db->where('hearing_id', $this->db->escape_str($hearing_id));
            return $this->db->update('hearing_master', $data);


        } 

         public function view_upcoming_hearing_list() {  
        $this->db->join('property_master','hearing_master.property_id = property_master.property_id');
        $this->db->join('legal_case_status_master','hearing_master.hearing_case_status = legal_case_status_master.case_status_id') ;
        $this->db->join('legal_master','hearing_master.legal_id = legal_master.legal_id') ;    
        $this->db->order_by('hearing_id','desc');
                $query = $this->db->get_where('hearing_master',array('case_status!='=>$this->db->escape_str('Completed')));
                return $query->result_array();
        }

        public function add_external_opinion($data1){


           $new_data = base64_encode($data1); 

           date_default_timezone_set("Asia/Kolkata");

            $data = array(
                 
                'property_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('property_name'))),
                'legal_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('legal_id'))),
                'external_opinion' => $this->db->escape_str($this->input->post('external_opinion')),
                'advocate_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('advocate_name'))),
                'external_opinion_document_upload' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$new_data)),
                'external_opinion_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
            );

            return $this->db->insert('external_opinion_master', $data);

        }  

        public function view_external_opinion_list() {  
        $this->db->join('property_master','external_opinion_master.property_id = property_master.property_id'); 
        $this->db->join('user_master','external_opinion_master.advocate_id = user_master.user_id');  
        $this->db->join('legal_master','external_opinion_master.legal_id = legal_master.legal_id'); 
        $this->db->order_by('external_opinion_id','desc');
                $query = $this->db->get('external_opinion_master');
                return $query->result_array();
        }

        public function get_external_opinion_data($external_opinion_id) {  
        $this->db->join('property_master','external_opinion_master.property_id = property_master.property_id'); 
        $this->db->join('user_master','external_opinion_master.advocate_id = user_master.user_id'); 
        $this->db->join('legal_master','external_opinion_master.legal_id = legal_master.legal_id'); 
        $this->db->order_by('external_opinion_id','desc');
                $query = $this->db->get_where('external_opinion_master',array('external_opinion_id'=>$this->db->escape_str($external_opinion_id)));
                return $query->result_array();
        }

        public function external_opinion_download_detail($external_opinion_id){
         $query = $this->db->get_where('external_opinion_master',array("external_opinion_id"=>$this->db->escape_str($external_opinion_id)));
            return $query->row()->external_opinion_document_upload;
        }

    public function view_property_for_filter() {  
        $this->db->order_by('property_id','desc');
        $query = $this->db->from('property_master');
        $query = $this->db->get();
        return $query->result_array();
    }

     public function get_selected_property($property_id) {  
                $query = $this->db->get_where('property_master',array('property_id'=>$this->db->escape_str($property_id)));
                return $query->result_array();
        }



}    