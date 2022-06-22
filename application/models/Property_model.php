<?php
class Property_model extends CI_Model
{
    public function __construct() {
        $this->load->database();
    }

    public function insertpropertytype()
    {
    	 date_default_timezone_set("Asia/Kolkata");
        $data = array(
             
            'property_type' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('property_type'))),
            'property_type_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
        );
      
            $this->db->insert('property_type_master', $data);
      
    }

    public function view_property_type() {  
        $this->db->order_by('property_type_id','desc');
                $query = $this->db->get('property_type_master');
                return $query->result_array();
        }


        public function property_type($type) {  
        $this->db->order_by('property_type_id','desc');
                $query = $this->db->get_where('property_type_master',array('property_type_id' => $this->db->escape_str($type)));
                return $query->result_array();
        }

        public function update_property_type($type)
    	{

            $data = array(
            'property_type' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('property_type'))),
            );
            $this->db->where('property_type_id', $this->db->escape_str($type));
            return $this->db->update('property_type_master', $data);
        
    	}


    	public function insertunit()
    	{
    	 date_default_timezone_set("Asia/Kolkata");
        $data = array(
             
            'unit' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('unit'))),
            'unit_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
        );
      
            $this->db->insert('unit_master', $data);
      
    	}

    public function view_unit() {  
        $this->db->order_by('unit_id','desc');
                $query = $this->db->get('unit_master');
                return $query->result_array();
        }


        public function get_unit($unit) {  
        $this->db->order_by('unit_id','desc');
                $query = $this->db->get_where('unit_master',array('unit_id' => $this->db->escape_str($unit)));
                return $query->result_array();
        }

        public function update_unit($unit)
    	{

            $data = array(
            'unit' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('unit'))),
            );
            $this->db->where('unit_id', $this->db->escape_str($unit));
            return $this->db->update('unit_master', $data);
        
    	}

        public function insertlandtype()
        {
         date_default_timezone_set("Asia/Kolkata");
        $data = array(
             
            'land_type' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('land_type'))),
            'land_type_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
        );
      
            $this->db->insert('land_type_master', $data);
      
        }

    public function view_land_type() {  
        $this->db->order_by('land_type_id','desc');
                $query = $this->db->get('land_type_master');
                return $query->result_array();
        }


        public function get_land_type($land_type) {  
        $this->db->order_by('land_type_id','desc');
                $query = $this->db->get_where('land_type_master',array('land_type_id' => $this->db->escape_str($land_type)));
                return $query->result_array();
        }

        public function update_land_type($land_type)
        {

            $data = array(
            'land_Type' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('land_type'))),
            );
            $this->db->where('land_type_id', $this->db->escape_str($land_type));
            return $this->db->update('land_type_master', $data);
        
        }

        public function insertpropertyjurisdiction()
        {
         date_default_timezone_set("Asia/Kolkata");
        $data = array(
             
            'property_jurisdiction' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('property_jurisdiction'))),
            'juri_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
        );
      
            $this->db->insert('property_jurisdiction_master', $data);
      
        }

    public function view_jurisdiction() {  
        $this->db->order_by('jurisdiction_id','desc');
                $query = $this->db->get('property_jurisdiction_master');
                return $query->result_array();
        }


        public function get_property_jurisdiction($jurisdiction_id) {  
        $this->db->order_by('jurisdiction_id','desc');
                $query = $this->db->get_where('property_jurisdiction_master',array('jurisdiction_id' => $this->db->escape_str($jurisdiction_id)));
                return $query->result_array();
        }

        public function update_jurisdiction($jurisdiction_id)
        {

            $data = array(
            'property_jurisdiction' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('property_jurisdiction'))),
            );
            $this->db->where('jurisdiction_id', $this->db->escape_str($jurisdiction_id));
            return $this->db->update('property_jurisdiction_master', $data);
        
        }

        public function insertpropertystatus()
        {
         date_default_timezone_set("Asia/Kolkata");
        $data = array(
             
            'property_status' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('status'))),
            'property_status_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
        );
      
            $this->db->insert('property_status_master', $data);
      
        }

    public function view_property_status() {  
        $this->db->order_by('property_status_id','desc');
                $query = $this->db->get('property_status_master');
                return $query->result_array();
        }


        public function get_property_status($property_status) {  
        $this->db->order_by('property_status_id','desc');
                $query = $this->db->get_where('property_status_master',array('property_status_id' => $this->db->escape_str($property_status)));
                return $query->result_array();
        }

        public function update_property_status($property_status)
        {

            $data = array(
            'property_status' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('status'))),
            );
            $this->db->where('property_status_id', $this->db->escape_str($property_status));
            return $this->db->update('property_status_master', $data);
        
        }

        public function insertfinancialstatus()
        {
         date_default_timezone_set("Asia/Kolkata");
        $data = array(
             
            'financial_status' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('financial_status'))),
            'financial_status_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
        );
      
            $this->db->insert('property_financial_status_master', $data);
      
        }

    public function view_financial_status() {  
        $this->db->order_by('financial_status_id','desc');
                $query = $this->db->get('property_financial_status_master');
                return $query->result_array();
        }


        public function get_financial_status($financial_status) {  
        $this->db->order_by('financial_status_id','desc');
                $query = $this->db->get_where('property_financial_status_master',array('financial_status_id' => $this->db->escape_str($financial_status)));
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

        public function update_financial_status($financial_status)
        {

            $data = array(
            'financial_status' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('financial_status'))),
            );
            $this->db->where('financial_status_id', $this->db->escape_str($financial_status));
            return $this->db->update('property_financial_status_master', $data);
        
        }




        public function insertpropertyfixedexpensetype()
        {
         date_default_timezone_set("Asia/Kolkata");
        $data = array(
             
            'fixed_expense' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('property_fixed_expense_type'))),
            'fixed_expense_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
        );
      
            $this->db->insert('property_fixed_expense_type_master', $data);
      
        }

    public function view_fixed_expense_type() {  
        $this->db->order_by('fixed_expense_id','desc');
                $query = $this->db->get('property_fixed_expense_type_master');
                return $query->result_array();
        }


        public function get_fixed_expense_type($fixed_expense) {  
        $this->db->order_by('fixed_expense_id','desc');
                $query = $this->db->get_where('property_fixed_expense_type_master',array('fixed_expense_id' => $this->db->escape_str($fixed_expense)));
                return $query->result_array();
        }

        public function update_fixed_expense_type($fixed_expense)
        {

            $data = array(
            'fixed_expense' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('property_fixed_expense_type'))),
            );
            $this->db->where('fixed_expense_id', $this->db->escape_str($fixed_expense));
            return $this->db->update('property_fixed_expense_type_master', $data);
        
        }

         public function get_property_controller() {  
        $query1 = $this->db->join('user_type_master', 'user_master.user_type_id=user_type_master.user_type_id');   
        $this->db->order_by('user_id','desc');
                $query1 = $this->db->get_where('user_master',array("user_type"=>$this->db->escape_str("Property Controller"),"activation_status" => $this->db->escape_str("Activated")));
         $results1 = $query1->result_array();
         return $results1;
        }

          public function get_property_controller_for_edit($user_id) {  
        $query1 = $this->db->join('user_type_master', 'user_master.user_type_id=user_type_master.user_type_id');   
        $this->db->order_by('user_id','desc');
        $where = "user_type = 'Property Controller' AND activation_status = 'Activated' OR (user_id  = ".$this->db->escape_str($user_id)." AND activation_status = 'Deactivated')";
        $this->db->where($where);
        $query1 = $this->db->from('user_master');
        $query1 = $this->db->get();
         $results1 = $query1->result_array();
         return $results1;
        }

        public function get_broker() {  
        $query1 = $this->db->join('user_type_master', 'user_master.user_type_id=user_type_master.user_type_id');   
        $this->db->order_by('user_id','desc');
                $query1 = $this->db->get_where('user_master',array("user_type"=>$this->db->escape_str("Broker"),"activation_status" => $this->db->escape_str("Activated")));
         $results1 = $query1->result_array();
         return $results1;
        }

        public function get_broker_for_edit($broker_id) {  
        $query1 = $this->db->join('user_type_master', 'user_master.user_type_id=user_type_master.user_type_id');   
        $this->db->order_by('user_id','desc');
         $where = "user_type = 'Broker' AND activation_status = 'Activated' OR (user_id  = ".$broker_id." AND activation_status = 'Deactivated')";
        $this->db->where($where);
        $query1 = $this->db->from('user_master');
        $query1 = $this->db->get();
         $results1 = $query1->result_array();
         return $results1;
        }


         public function get_lessor() {  
        $query1 = $this->db->join('user_type_master', 'user_master.user_type_id=user_type_master.user_type_id');   
        $this->db->order_by('user_id','desc');
                $query1 = $this->db->get_where('user_master',array("user_type"=>$this->db->escape_str("Lessor"),"activation_status" => $this->db->escape_str("Activated")));
         $results1 = $query1->result_array();
         return $results1;
        }

         public function get_lesse() {  
        $query1 = $this->db->join('user_type_master', 'user_master.user_type_id=user_type_master.user_type_id');   
        $this->db->order_by('user_id','desc');
                $query1 = $this->db->get_where('user_master',array("user_type"=>$this->db->escape_str("Lesse"),"activation_status" => $this->db->escape_str("Activated")));
         $results1 = $query1->result_array();
         return $results1;
        }

         public function get_seller() {  
        $query1 = $this->db->join('user_type_master', 'user_master.user_type_id=user_type_master.user_type_id');   
        $this->db->order_by('user_id','desc');
                $query1 = $this->db->get_where('user_master',array("user_type"=>$this->db->escape_str("Seller"),"activation_status" => $this->db->escape_str("Activated")));
         $results1 = $query1->result_array();
         return $results1;
        }

         public function get_purchaser() {  
        $query1 = $this->db->join('user_type_master', 'user_master.user_type_id=user_type_master.user_type_id');   
        $this->db->order_by('user_id','desc');
                $query1 = $this->db->get_where('user_master',array("user_type"=>$this->db->escape_str("Purchaser"),"activation_status" => $this->db->escape_str("Activated")));
         $results1 = $query1->result_array();
         return $results1;
        }


        public function add_property($property_data){

          
            return $this->db->insert('property_master', $property_data);

        }  

        public function add_property_images($image_data){

          
            return $this->db->insert('property_images_master', $image_data);

        } 

        public function add_broker($broker_data){

          
            return $this->db->insert('broker_master', $broker_data);

        }  

        public function add_seller($seller_data){

          
            return $this->db->insert('seller_master', $seller_data);

        }

        public function add_purchaser($purchaser_data){

          
            return $this->db->insert('purchaser_master', $purchaser_data);

        }     

        public function add_lessee($lessee_data){

          
            return $this->db->insert('lessee_master', $lessee_data);

        }  

        public function add_lessor($lessor_data){

          
            return $this->db->insert('lessor_master', $lessor_data);

        }

        public function add_fixed_expense($expense_data){

          
            return $this->db->insert('property_fixed_expense_master', $expense_data);

        }   

        public function update_prop_access_detail($prop_access_update,$admin_id)
        {

            $data = array(
            'property_access' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>.?\|=+]/"," ",$prop_access_update)),
            );
            $this->db->where('admin_id', $this->db->escape_str($admin_id));
            return $this->db->update('admin_master', $data);
        
        }


        public function get_property_data() {
         $this->db->from('property_master');      
       $this->db->join('property_type_master', 'property_master.property_type_id=property_type_master.property_type_id');
       $this->db->join('property_financial_status_master', 'property_master.financial_status_id=property_financial_status_master.financial_status_id');
       $this->db->join('property_group_master', 'property_master.property_group_id=property_group_master.property_group_id');
        $this->db->order_by('property_id','desc');
        $query1 = $this->db->get();
        return $query1->result_array();

        }

        public function get_property_controller_data($property_id){
             $query1 = $this->db->select('property_id,user_id,username');
            $query1 = $this->db->join('user_master', 'property_master.property_controller_id=user_master.user_id');
            $query1 =  $this->db->order_by('property_id','desc');
        $query1 = $this->db->get_where('property_master',array('property_id'=>$this->db->escape_str($property_id)));
        return $query1->result_array();
        }
        public function get_property($property_id) {      
       $query1 = $this->db->join('property_type_master', 'property_master.property_type_id=property_type_master.property_type_id','left');
       $query1 = $this->db->join('land_type_master', 'property_master.land_type_id=land_type_master.land_type_id','left');
       $query1 = $this->db->join('property_group_master', 'property_master.property_group_id=property_group_master.property_group_id','left');
       //$query1 = $this->db->join('user_master', 'property_master.property_controller_id=user_master.user_id');
       $query1 = $this->db->join('unit_master', 'property_master.unit=unit_master.unit_id','left');
       $query1 = $this->db->join('property_jurisdiction_master', 'property_master.property_juridiction_id=property_jurisdiction_master.jurisdiction_id','left');
       $query1 = $this->db->join('property_status_master', 'property_master.property_status_id=property_status_master.property_status_id','left');
       $query1 =  $this->db->order_by('property_id','desc');
        $query1 = $this->db->get_where('property_master',array('property_id'=>$this->db->escape_str($property_id)));
        return $query1->result_array();

        }

        public function get_broker1($property_id) {      
       $query1 = $this->db->join('property_master', 'broker_master.property_id=property_master.property_id');
        $query1 = $this->db->join('user_master', 'broker_master.broker_name=user_master.user_id');
       $query1 =  $this->db->order_by('broker_id','desc');
        $query1 = $this->db->get_where('broker_master',array('broker_master.property_id'=>$this->db->escape_str($property_id)));
        return $query1->result_array();

        }

        public function get_seller1($property_id) {      
       $query1 = $this->db->join('property_master', 'seller_master.property_id=property_master.property_id');
        $query1 = $this->db->join('user_master', 'seller_master.seller_name=user_master.user_id');
       $query1 =  $this->db->order_by('seller_id','desc');
        $query1 = $this->db->get_where('seller_master',array('seller_master.property_id'=>$this->db->escape_str($property_id)));
        return $query1->result_array();

        }

        public function get_purchaser1($property_id) {      
        $query1 = $this->db->join('property_master', 'purchaser_master.property_id=property_master.property_id');
        $query1 = $this->db->join('user_master', 'purchaser_master.purchaser_name=user_master.user_id');
        $query1 =  $this->db->order_by('purchaser_id','desc');
        $query1 = $this->db->get_where('purchaser_master',array('purchaser_master.property_id'=>$this->db->escape_str($property_id)));
        return $query1->result_array();
        }

        public function get_lessee1($property_id) {      
       $query1 = $this->db->join('property_master', 'lessee_master.property_id=property_master.property_id');
        $query1 = $this->db->join('user_master', 'lessee_master.lessee_name=user_master.user_id');
       $query1 =  $this->db->order_by('lessee_id','desc');
        $query1 = $this->db->get_where('lessee_master',array('lessee_master.property_id'=>$this->db->escape_str($property_id)));
        return $query1->result_array();

        }

        public function get_lessor1($property_id) {      
       $query1 = $this->db->join('property_master', 'lessor_master.property_id=property_master.property_id');
        $query1 = $this->db->join('user_master', 'lessor_master.lessor_name=user_master.user_id');
       $query1 =  $this->db->order_by('lessor_id','desc');
        $query1 = $this->db->get_where('lessor_master',array('lessor_master.property_id'=>$this->db->escape_str($property_id)));
        return $query1->result_array();

        }

        public function get_fixed_expense($property_id) {      
       $query1 = $this->db->join('property_master', 'property_fixed_expense_master.property_id=property_master.property_id');
        $query1 = $this->db->join('property_fixed_expense_type_master', 'property_fixed_expense_master.expense_type_id=property_fixed_expense_type_master.fixed_expense_id');
       $query1 =  $this->db->order_by('property_fixed_expense_master.fixed_expense_id','desc');
        $query1 = $this->db->get_where('property_fixed_expense_master',array('property_fixed_expense_master.property_id'=>$this->db->escape_str($property_id)));
        return $query1->result_array();

        }

        public function get_property_images($property_id) {      
       $query1 = $this->db->join('property_master', 'property_images_master.property_id=property_master.property_id');
       $query1 =  $this->db->order_by('property_images_master.property_image_id','desc');
        $query1 = $this->db->get_where('property_images_master',array('property_images_master.property_id'=>$this->db->escape_str($property_id)));
        return $query1->result_array();

        }

        public function get_property_images_property_id($property_image_id) { 
       $query1 = $this->db->join('property_master', 'property_images_master.property_id=property_master.property_id');      
        $query1 = $this->db->get_where('property_images_master',array('property_image_id'=>$this->db->escape_str($property_image_id)));
        return $query1->result_array();

        }

         public function download_detail($image_id){
         $query = $this->db->get_where('property_images_master',array("property_image_id"=>$this->db->escape_str($image_id)));
            return $query->row()->property_image;

           
    }

     public function image_details($image_id){
         $query = $this->db->get_where('property_images_master',array("property_image_id"=>$this->db->escape_str($image_id)));
            return $query->row()->property_id;
        }

         public function get_image_details($image_id){
         $query = $this->db->get_where('property_images_master',array("property_image_id"=>$this->db->escape_str($image_id)));
            return $query->result_array();
        }


    public function mark_property_sold($property_id,$fin_status)
        {

            $data = array(
            'financial_status_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$fin_status)),    
            'mark_property_as_sold' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",'Yes')),
            'loan_lean_status' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",'No Status'))
            );
            $this->db->where('property_id', $this->db->escape_str($property_id));
            return $this->db->update('property_master', $data);
        
        }

        public function delete_property($property_id) {
            $query = $this->db->get_where('upload_document_master',array("property_id"=>$this->db->escape_str($property_id)));
            $query1 = $this->db->get_where('loan_master',array("property_id"=>$this->db->escape_str($property_id)));
            $query3 = $this->db->get_where('lease_own_master',array("property_id"=>$this->db->escape_str($property_id)));
            $query4 = $this->db->get_where('lease_given_master',array("property_id"=>$this->db->escape_str($property_id)));
            $query9 = $this->db->get_where('hearing_master',array("property_id"=>$this->db->escape_str($property_id)));
            $query10 = $this->db->get_where('external_opinion_master',array("property_id"=>$this->db->escape_str($property_id)));
            $query11 = $this->db->get_where('legal_master',array("property_id"=>$this->db->escape_str($property_id)));
            $query16 = $this->db->get_where('claim_master',array("property_id"=>$this->db->escape_str($property_id)));
            $query17 = $this->db->get_where('income_master',array("property_id"=>$this->db->escape_str($property_id)));
            $query18 = $this->db->get_where('expense_master',array("property_id"=>$this->db->escape_str($property_id)));
            $query19 = $this->db->get_where('insurance_master',array("property_id"=>$this->db->escape_str($property_id)));

            $loan_query = $this->db->get_where('loan_master',array('property_id'=>$this->db->escape_str($property_id)));
              $loan_query_data =  $loan_query->result_array();

              foreach($loan_query_data as $loan_query){

                $lean_id = $loan_query['lean_property_id'];
               // $loan_id1 = $loan_query['loan_id'];

                    if($lean_id !== 0){

                     $loan_query1 = $this->db->get_where('loan_master',array('lean_property_id'=>$this->db->escape_str($lean_id)));
                     $loan_query_data1 =  $loan_query1->num_rows();

                     if($loan_query_data1 == 1){

                         $data = array(
                     
                            'loan_lean_status' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",'No Status')),
                            
                        );


                        $this->db->where('property_id', $this->db->escape_str($lean_id));
                        $this->db->update('property_master', $data);

                     }  

                  }

              }

              foreach ($query->result_array() as $result) 
            {
                    if($result['property_id'] == $property_id){
                        $ipath = ('assets/images/uploads/documents/'.base64_decode($result['document_upload']));                                          
                       $parts = explode('/', $ipath);
                       $directory = 'assets/images/uploads/documents/'.$parts[4];
                           if($parts[4] !== ''){
                             chmod($directory,0777);
                             unlink($ipath);
                             rmdir($directory);
                           }
                      
                    }     
            }

            foreach($query1->result_array() as $result2){

                $loan_id = $result2['loan_id'];

                 if($result2['property_id'] == $property_id){

                  $ipath9 = ('assets/images/uploads/loan/'.base64_decode($result2['upload_loan_document']));
                  if(!empty($result2['upload_loan_document'])){
                    unlink($ipath9);
                  }  

                  $this->db->delete('loan_installment_master', array('loan_id' => $loan_id));
                  
                }


                //$this->db->delete('loan_installment_master', array('loan_id' => $lean_id));

                
            }

            foreach($query3->result_array() as $result3){

                $lease_own_id = $result3['lease_own_id'];


                if($result3['property_id'] == $property_id){
                        $ipath1 = ('assets/images/uploads/lease/lease_own/'.base64_decode($result3['contract_upload']));
                       if(!empty($result3['contract_upload'])){
                         unlink($ipath1);
                       }

            $this->db->delete('lease_own_installment_master', array('lease_own_id' => $lease_own_id));
            $this->db->delete('lease_own_lessor_master', array('lease_own_id' => $lease_own_id));
                      
                }     
            }


             foreach($query4->result_array() as $result4){

                $lease_given_id = $result4['lease_given_id'];

                if($result4['property_id'] == $property_id){
                       if(!empty($result4['contract_upload'])){
                         $ipath2 = ('assets/images/uploads/lease/lease_given/'.base64_decode($result4['contract_upload']));
                         unlink($ipath2);
                       }

                       $this->db->delete('lease_given_lessee_master', array('lease_given_id' => $lease_given_id));
                       $this->db->delete('lease_given_installment_master', array('lease_given_id' => $lease_given_id));
                      
                }     
            }

            foreach($query9->result_array() as $result9){

                if($result9['property_id'] == $property_id){
                        if(!empty($result9['upload_hearing_document'])){
                            $ipath4 = ('assets/images/uploads/hearing/'.base64_decode($result9['upload_hearing_document']));
                            unlink($ipath4);
                        }    
                          
                }     
            }

             foreach($query10->result_array() as $result10){

                if($result10['property_id'] == $property_id){
                        if(!empty($result10['external_opinion_document_upload'])){
                            $ipath5 = ('assets/images/uploads/external_opinion/'.base64_decode($result10['external_opinion_document_upload']));
                            unlink($ipath5);
                        }    
                }          
             }     


            foreach($query11->result_array() as $result11){

                $legal_id = $result11['legal_id'];

                if($result11['property_id'] == $property_id){
                        if(!empty($result11['case_document_upload'])){
                            $ipath3 = ('assets/images/uploads/legal/'.base64_decode($result11['case_document_upload']));
                            unlink($ipath3);
                        } 

            $this->db->delete('legal_advocate_master', array('legal_id' => $legal_id));
            $this->db->delete('legal_case_by_master', array('legal_id' => $legal_id));
            $this->db->delete('legal_case_against_master', array('legal_id' => $legal_id));   
                          
                }     
            }


             foreach($query16->result_array() as $result16){

                if($result16['property_id'] == $property_id){
                        if(!empty($result16['upload_claim_document'])){
                            $ipath6 = ('assets/images/uploads/claim/'.base64_decode($result16['upload_claim_document']));
                             unlink($ipath6);
                        }    
                          
                }     
            }

             foreach($query17->result_array() as $result17){

                if($result17['property_id'] == $property_id){
                        if(!empty($result17['invoice_upload'])){
                            $ipath7 = ('assets/images/uploads/invoice_upload/income/'.base64_decode($result17['invoice_upload']));
                             unlink($ipath7);
                        }    
                          
                }     
            }

             foreach($query18->result_array() as $result18){

                if($result18['property_id'] == $property_id){
                        if(!empty($result18['invoice_upload'])){
                            $ipath8 = ('assets/images/uploads/invoice_upload/expense/'.base64_decode($result18['invoice_upload']));
                             unlink($ipath8);
                        }    
                          
                }     
            }

            foreach($query19->result_array() as $result19){

                $insurance_id = $result19['insurance_id'];

                if($result19['property_id'] == $property_id){

                    $this->db->delete('Inc_insurance_type_master', array('insurance_id' => $insurance_id));
                    $this->db->delete('Inc_insurance_policy_owner_master', array('insurance_id' => $insurance_id));
                    $this->db->delete('Inc_insurance_beneficiary_master', array('insurance_id' => $insurance_id));
                    $this->db->delete('insurance_pay_master', array('insurance_id' => $insurance_id));
                }
            }

            $this->db->delete('property_master', array('property_id' => $property_id));
            $this->db->delete('upload_document_master', array('property_id' => $property_id));
            $this->db->delete('loan_master', array('lean_property_id' => $property_id));
            $this->db->delete('loan_master', array('property_id' => $property_id));
            $this->db->query("DELETE FROM loan_installment_master WHERE loan_id NOT IN (SELECT l.loan_id
                        FROM loan_master l)");

            $this->db->delete('lease_own_master', array('property_id' => $property_id));
            $this->db->delete('lease_given_master', array('property_id' => $property_id));
            $this->db->delete('legal_master', array('property_id' => $property_id));
            $this->db->delete('hearing_master', array('property_id' => $property_id));
            $this->db->delete('external_opinion_master', array('property_id' => $property_id));
            $this->db->delete('insurance_master', array('property_id' => $property_id));
            $this->db->delete('claim_master', array('property_id' => $property_id));
            $this->db->delete('income_master', array('property_id' => $property_id));
            $this->db->delete('expense_master', array('property_id' => $property_id));
        }

         public function delete_property_images($property_id) {

        return $this->db->delete('property_images_master', array('property_id' => $property_id)); 
        }

         public function delete_broker($property_id) {

        return $this->db->delete('broker_master', array('property_id' => $property_id)); 
        }

         public function delete_seller($property_id) {

        return $this->db->delete('seller_master', array('property_id' => $property_id)); 
        }

         public function delete_purchaser($property_id) {

        return $this->db->delete('purchaser_master', array('property_id' => $property_id)); 
        }

         public function delete_lessee($property_id) {

        return $this->db->delete('lessee_master', array('property_id' => $property_id)); 
        }

         public function delete_lessor($property_id) {

        return $this->db->delete('lessor_master', array('property_id' => $property_id)); 
        }

         public function delete_fixed_expense($property_id) {

        return $this->db->delete('property_fixed_expense_master', array('property_id' => $property_id)); 
        }

        public function update_property_access_data($update_data_for_property_access,$admin_id2){

              $data = array(
            'property_access' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>.?\|=+]/"," ",implode(",",$update_data_for_property_access))),
            );
            $this->db->where('admin_id', $this->db->escape_str($admin_id2));
            return $this->db->update('admin_master', $data);

        }

        public function view_role() {
            $this->db->select('admin_id');
         $this->db->from('admin_master');   
        $this->db->order_by('admin_id','desc');
        $query1 = $this->db->get();
        return $query1->result_array();

        }

         public function get_property_access_data($final_merege) {
         $this->db->select('admin_id,property_access');  
        $query1 = $this->db->get_where("admin_master",array('admin_id'=>$this->db->escape_str($final_merege)));
        return $query1->result_array();

        }

         public function update_property($property_data,$property_id)
        {

            $this->db->where('property_id', $this->db->escape_str($property_id));
            return $this->db->update('property_master', $property_data);
        
        }

         public function update_broker($broker_data,$property_id)
        {

            $this->db->where('property_id', $this->db->escape_str($property_id));
            return $this->db->update('broker_master', $broker_data);
        
        }

        public function delete_edit_property_images($property_image_id) {

        return $this->db->delete('property_images_master', array('property_image_id' => $property_image_id)); 
        }

        public function get_sold_financial_status() {  
            $this->db->select('financial_status_id');
             $this->db->from('property_financial_status_master'); 
             $this->db->where('financial_status',$this->db->escape_str('Sold')) ;
        $this->db->order_by('financial_status_id','desc');
                $query = $this->db->get();
                return $query->row();
        }

        public function view_type($type_id) {  
        $this->db->select('property_type');
             $this->db->from('property_type_master'); 
             $this->db->where('property_type_id',$this->db->escape_str($type_id)) ;
        $this->db->order_by('property_type_id','desc');
                $query = $this->db->get();
                return $query->row();
        }

        public function insertpropertygroup()
    {
         date_default_timezone_set("Asia/Kolkata");
        $data = array(
             
            'property_group' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('property_group'))),
            'group_controller' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('group_controller'))),
            'group_address' => $this->input->post('group_address'),
            'property_group_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
        );
      
            $this->db->insert('property_group_master', $data);
      
    }

    public function view_property_group() {  
        $this->db->order_by('property_group_id','desc');
                $query = $this->db->get('property_group_master');
                return $query->result_array();
        }


       public function get_property_group($property_group) {  
        $this->db->order_by('property_group_id','desc');
                $query = $this->db->get_where('property_group_master',array('property_group_id' => $this->db->escape_str($property_group)));
                return $query->result_array();
        }

        public function update_property_group($property_group)
        {

            $data = array(
            'property_group' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('property_group'))),
            'group_controller' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('group_controller'))),
            'group_address' => $this->input->post('group_address'),
            );
            $this->db->where('property_group_id', $this->db->escape_str($property_group));
            return $this->db->update('property_group_master', $data);
        
        }

        public function get_lease_own_detail($property_id) {

        //$query1 = $this->db->query('SELECT lease_own_id,property_id, COUNT(property_id) AS code_count FROM lease_own_master GROUP BY lease_own_id');
        $this->db->select("lease_own_id,property_id"); 
        $this->db->order_by('lease_own_id','desc');
        $query1 = $this->db->get_where('lease_own_master',array('property_id'=>$this->db->escape_str($property_id)));
        return $query1->num_rows();

        }

        public function get_lease_given_detail($property_id) {
        //$query1 = $this->db->query('SELECT lease_given_id,property_id, COUNT(property_id) AS code_count1 FROM lease_given_master GROUP BY lease_given_id');    
        $this->db->select("lease_given_id,lease_given_master.property_id"); 
        $this->db->order_by('lease_given_id','desc');
        $query1 = $this->db->get_where('lease_given_master',array('property_id'=>$this->db->escape_str($property_id)));
        return $query1->num_rows();

        }

         public function view_role_by_id($admin_id1) {  
        $this->db->order_by('admin_id','desc');
        $query1 = $this->db->get_where('admin_master',array('admin_id'=>$this->db->escape_str($admin_id1)));
        return $query1->result_array();

        }


}    