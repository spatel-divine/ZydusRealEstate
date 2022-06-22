<?php
class Loan extends CI_Controller {

    public function __construct() {
    	 parent::__construct();
    	$this->load->helper(array('form', 'url','security'));
        $this->load->library(array('form_validation','session','upload')); 
        $this->load->model('loan_model');        
        $this->load->model('user_activity_model'); 
        error_reporting(0);  
    }

    public function loan_master(){
    	if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
            $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];
            
            }
              else
        {
                redirect('Login','refresh');
        }

         $role1 = explode(",",$data['roles']);
        if(!in_array("Loan Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Add Loan Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);       
        redirect('Admin/auth_error');
        }

        $data['property'] = $this->loan_model->view_property();
        $data['bank'] = $this->loan_model->view_bank();
        $data['loan_ben'] = $this->loan_model->get_loan_ben();
        $data['loan_type'] = $this->loan_model->view_loan_type();
        $data['lean_property'] = $this->loan_model->view_lean_property();
        $msg = $session_data['username']." ".'Visited Add Loan Page.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
        $this->load->view('loan_master',$this->security->xss_clean($data));
    }

    public function loan_master_insert(){
        if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
            $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];
            
            }
              else
        {
                redirect('Login','refresh');
        }

         $role1 = explode(",",$data['roles']);
        if(!in_array("Loan Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Loan Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);           
        redirect('Admin/auth_error');
        }

        $data['property'] = $this->loan_model->view_property();
        $data['bank'] = $this->loan_model->view_bank();
        $data['loan_ben'] = $this->loan_model->get_loan_ben();
        $data['loan_type'] = $this->loan_model->view_loan_type();
        $data['lean_property'] = $this->loan_model->view_lean_property();

        $this->form_validation->set_rules('property_name','Property Name','required');
        $this->form_validation->set_rules('loan_wih_bank','Loan With Bank','required');
        $this->form_validation->set_rules('loan_officer_name','Loan Officer Name','required');
        $this->form_validation->set_rules('beneficary','Beneficary Name','required');
        $this->form_validation->set_rules('loan_amount','Loan Amount','required');
        $this->form_validation->set_rules('start_date','Start Date','required');
        $this->form_validation->set_rules('end_date','End Date','required');
        $this->form_validation->set_rules('interest_type','Interest Type','required');
        $this->form_validation->set_rules('installment_interest','Installment Interest','required|numeric');
        $this->form_validation->set_rules('installment_amount','Installment Amount','required');
        $this->form_validation->set_rules('total_loan_amount','Total loan Amount','required');
        $this->form_validation->set_rules('payment_date','Payment Day','required');
        $this->form_validation->set_rules('loan_type','Loan Type','required');
        if(empty($_FILES['loan_document']['name'])){

                    $this->form_validation->set_rules('loan_document','Loan Document','required');

        }
         $this->form_validation->set_rules('lean_mark','Lean Mark','required');

         if($this->input->post('lean_mark') == 'Yes'){
             $this->form_validation->set_rules('lean_property_name','Lean Property Name','required');
         }

         $data['prop_data'] = $this->loan_model->get_selected_property($this->input->post('property_name'));

         foreach($data['prop_data'] as $property_data){

            $property_name = $property_data['property_name'];
         }   

         if(!empty($this->loan_model->get_inserted_loan_data($this->input->post('property_name')))){
          $loan_data = $this->loan_model->get_inserted_loan_data($this->input->post('property_name'));

         foreach ($loan_data as $loan) {
          if($loan['property_id'] == $this->input->post('property_name') AND $loan['loan_installment_status'] != 'Fully Paid'){

             $this->session->set_flashdata("check_loan_inserted","Loan Can't Added For Particular Property Because Loan Exist For the Same Property.");

             if(in_array("View Loan List",$role1)) {
                     $msg = $session_data['username']." ".'Try To Insert Loan For'." ".$property_name." ".'But Loan Cannot Added For Particular Property Because Loan Exist For the Same Property.';
                    $this->user_activity_model->add('not_added',$msg,$session_data['username'],$session_data['admin_id']);        
                    redirect("Loan/view_loan_list","refresh",$this->security->xss_clean($data));
             } else {
                $msg = $session_data['username']." ".'Try To Insert Loan For'." ".$property_name." ".'But Loan Cannot Added For Particular Property Because Loan Exist For the Same Property.';
                $this->user_activity_model->add('not_added',$msg,$session_data['username'],$session_data['admin_id']);      
                redirect("Loan/loan_master","refresh",$this->security->xss_clean($data));

             }       

          }
        }
        }

         if($this->form_validation->run() == false)
        {
       
            $this->load->view('loan_master',$this->security->xss_clean($data));
           
        }
        else{

            $loan_document = $_FILES['loan_document']['name'];

            if($loan_document !== ""){

                $loan_document = str_replace(' ', '_', $loan_document);

                                $config['file_name'] =$loan_document;
                                $config['upload_path'] = './assets/images/uploads/loan';
                                $config['allowed_types'] = 'zip|jpeg|jpg|png|pdf|JPEG|JPG|PNG|PDF|rar';
                                $config['max_size'] = '20000';
                                $config['encrypt_name'] = TRUE;
                                $this->load->library('upload', $config);
                                $this->upload->initialize($config);
                                if (!$this->upload->do_upload('loan_document')) {
                                    $error = array('error' => $this->upload->display_errors());
                                    
                                   $this->session->set_flashdata('new_in',2);
                                  $this->load->view("loan_master",$this->security->xss_clean($data));
                                } else {
                                    $data1 = array('upload_data' => $this->upload->data());
                                     $query = $this->loan_model->insertloan($data1['upload_data']['file_name']);
                                     if($this->input->post('lean_mark') == 'Yes'){
                                         $lean_property_id = $this->input->post('lean_property_name');
                                         $this->loan_model->update_loan_lean_status($lean_property_id);
                                     }
                                    $this->session->set_flashdata("insert_loan","Loan Details Added Successfully");
                                    $msg = $session_data['username']." ".'Added Loan For Property Named'." ".$property_name.'.';
                                    $this->user_activity_model->add('added',$msg,$data['username'],$data['admin_id']);
                                    if(in_array("View Loan List",$role1)) {
                                        redirect("Loan/view_loan_list");
                                    } else {
                                         redirect("Loan/loan_master");
                                    }    
            }                    }                

        }


    }


    public function get_loan_officer(){

            if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
            $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];
            
            }
              else
        {
                redirect('Login','refresh');
        }

         $role1 = explode(",",$data['roles']);
        if(!in_array("Loan Master",$role1)) {
        redirect('Admin/auth_error');
        }

        $id = $this->input->post('id',TRUE);
        $data = $this->loan_model->get_loan_officer_with_bank($id);
        echo json_encode($this->security->xss_clean($data));
    }

     public function loan_installments(){
    	if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
            $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];
            
            }
              else
        {
                redirect('Login','refresh');
        }
        $role1 = explode(",",$data['roles']);
        if(!in_array("View Loan Installments",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Loan Installment Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);      
        redirect('Admin/auth_error');
        }

        $data['loan'] = $this->loan_model->view_loan();
        $msg = $session_data['username']." ".'Visited Loan Installment Page.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
    	$this->load->view('installments',$this->security->xss_clean($data));
    }

    public function loan_installment_filter(){

        if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
            $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];
            
            }
              else
        {
                redirect('Login','refresh');
        }
        $role1 = explode(",",$data['roles']);
        if(!in_array("View Loan Installments",$role1)) {
        redirect('Admin/auth_error');
        }

        $data['loan'] = $this->loan_model->view_loan();

         $this->form_validation->set_rules('payment_start_day','Payment Start Day','required');
       $this->form_validation->set_rules('payment_end_day','Payment End Day','required');

        if($this->form_validation->run() == FALSE){

          $this->load->view('installments',$this->security->xss_clean($data));

        }else {

            $payment_start_day=$this->input->post('payment_start_day');
            $payment_end_day=$this->input->post('payment_end_day');

             $query1 = $this->db->join('property_master', 'loan_master.property_id=property_master.property_id');    
             $query1 = $this->db->join('bank_master', 'loan_master.bank_id=bank_master.bank_id');
            $query1 = $this->db->join('loan_officer_master', 'loan_master.loan_officer_id=loan_officer_master.loan_officer_id');
            $this->db->order_by('loan_id','desc');

             $this->db->where("loan_master.payment_date BETWEEN ".$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$payment_start_day))." AND ".$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$payment_end_day))."");

            //$this->db->where('loan_master.payment_date >=', $payment_start_day);
            //$this->db->where('loan_master.payment_date <=', $payment_end_day);

                $query1 = $this->db->get('loan_master');

                $data['loan']  = $query1->result_array();
                $this->load->view('installments',$this->security->xss_clean($data));
        }    
    }

    public function view_loan_list(){
    	if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
            $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];
            
            }
              else
        {
                redirect('Login','refresh');
        }
        $role1 = explode(",",$data['roles']);
        if(!in_array("View Loan List",$role1)) {
        $msg = $session_data['username']." ".'Try To Access View Loan List Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);       
        redirect('Admin/auth_error');
        }
        $data['loan'] = $this->loan_model->view_loan();
        $data['property'] = $this->loan_model->view_property_for_filter();
        $data['bank'] = $this->loan_model->view_bank();
        $data['loan_ben'] = $this->loan_model->get_loan_ben_for_filter();
        $data['loan_type'] = $this->loan_model->view_loan_type();
        $msg = $session_data['username']." ".'Visited View Loan List Page.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
    	$this->load->view('view_loan_list',$this->security->xss_clean($data));
    }

    public function download_uploaded_loan_document(){

        if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
            $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];
            
            }
              else
        {
                redirect('Login','refresh');
        }

        $role1 = explode(",",$data['roles']);
        $loan_id = base64_decode($this->uri->segment(3));
       
        $property_id = $this->loan_model->property_id_detail($loan_id);
        $data['prop_data'] = $this->loan_model->get_selected_property($property_id);
        $data['ln_data'] = $this->loan_model->get_loan_data($loan_id);

        foreach($data['prop_data'] as $prop){

            $property_name = $prop['property_name'];
        }

        foreach($data['ln_data'] as $loan_data){

            $ln_id = $loan_data['loan_id'];
        }

         if(($loan_id == null OR $loan_id == '') OR (!isset($ln_id) OR $ln_id !== $loan_id OR $ln_id == null OR $ln_id == '')){

           show_404();
          exit();
          }

        if(!in_array("View Loan List",$role1)) {
        $msg = $session_data['username']." ".'Try To Download Loan Document for'." ".$property_name." ".'Download Loan Document Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);      
        redirect('Admin/auth_error');
        }

        $property_id_array = explode(",",$this->loan_model->property_id_detail($loan_id));

        $prop_access_array = explode(",",$data['prop_access']);
        $common_access = array_intersect($prop_access_array,$property_id_array);;

        $final_property_access = implode(",",$common_access);
        if($property_id !== $final_property_access){
              $msg = $session_data['username']." ".'Try To Download Loan Document for'." ".$property_name." ".'That Property Access is Not Given to the'." ".$session_data['username'].'.';
              $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
              redirect('Admin/auth_error');
            }

          if(!empty($loan_id)){
            //load download helper
            $this->load->helper('download');
            
            //get file info from database
            $fileInfo = $this->loan_model->download_detail($loan_id);

            $fileInfo1 = base64_decode($fileInfo);
            
            //file path
            $file = file_get_contents(base_url().'assets/images/uploads/loan/'.$fileInfo1);

            $msg = $data['username']." ".'Downloaded Loan Document For'." ".$property_name." ".'Property.';
            $this->user_activity_model->add('download_document',$msg,$data['username'],$data['admin_id']);

            //download file from directory
            force_download($fileInfo1, $file);
            redirect('Loan/view_loan_detail/'.$this->security->xss_clean($loan_id));
        }
    }

    public function loan_filter(){
        if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
            $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];
                        
            }
              else
        {
                redirect('Login','refresh');
        }

        $role1 = explode(",",$data['roles']);
        if(!in_array("View Loan List",$role1)) {
        redirect('Admin/auth_error');
        }

        $data['loan'] = $this->loan_model->view_loan();
        $data['property'] = $this->loan_model->view_property_for_filter();
        //$data['property'] = $this->loan_model->view_property();
        $data['bank'] = $this->loan_model->view_bank();
        $data['loan_ben'] = $this->loan_model->get_loan_ben_for_filter();
        $data['loan_type'] = $this->loan_model->view_loan_type();

       if (empty($_POST['property_id']) && empty($_POST['interest_type']) && empty($_POST['bank_id']) && empty($_POST['loan_beneficary']) && empty($_POST['loan_type_id']))
        {

            $this->session->set_flashdata("select_data","Please Select Any Filter Field For Search");
            redirect('Loan/view_loan_list/',$this->security->xss_clean($data));

            /*$sql = "SELECT pm.*,bm.*,lom.*,lm.* FROM loan_master lm INNER JOIN property_master pm ON pm.property_id = lm.property_id INNER JOIN bank_master bm ON bm.bank_id = lm.bank_id INNER JOIN loan_officer_master lom ON lom.loan_officer_id = lm.loan_officer_id";

            $sql1 = $this->db->query($sql);*/
        }
        else
        {
        	$property_id = $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$_POST['property_id']));
        	$interest_type = $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$_POST['interest_type']));
        	$bank_id = $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$_POST['bank_id']));
        	$loan_beneficary = $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$_POST['loan_beneficary']));
        	$loan_type_id = $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$_POST['loan_type_id']));
            $wheres = array();
            $sql = "SELECT pm.*,bm.*,lom.*,lm.* FROM loan_master lm INNER JOIN property_master pm ON pm.property_id = lm.property_id INNER JOIN bank_master bm ON bm.bank_id = lm.bank_id INNER JOIN loan_officer_master lom ON lom.loan_officer_id = lm.loan_officer_id where ";

            if (isset($_POST['property_id']) and !empty($_POST['property_id']))
            {
                $wheres[] = "lm.property_id like '%{$property_id}%' ";
            } 

            if (isset($_POST['interest_type']) and !empty($_POST['interest_type']))
            {
                $wheres[] = "lm.interest_type = '{$interest_type}'";
            } 

            if (isset($_POST['bank_id']) and !empty($_POST['bank_id']))
            {
                $wheres[] = "lm.bank_id = '{$bank_id}' ";
            } 

            if (isset($_POST['loan_beneficary']) and !empty($_POST['loan_beneficary']))
            {
                $wheres[] = "lm.loan_beneficary = '{$loan_beneficary}' ";
            } 

            if (isset($_POST['loan_type_id']) and !empty($_POST['loan_type_id']))
            {
                $wheres[] = "lm.loan_type_id = '{$loan_type_id}' ";
            } 

            foreach ( $wheres as $where ) 
            {
            $sql .= $where . ' AND ';   //  you may want to make this an OR
              }
             $sql=rtrim($sql, "AND "); 

             $sql1 = $this->db->query($sql);
             if($sql1 == null OR $sql1 == '' OR empty($sql1)){
                $this->load->view('view_loan_list',$this->security->xss_clean($data));
                echo " No Data Found";
             } else {
              $data['loan']  = $sql1->result_array();  

        $this->load->view('view_loan_list',$this->security->xss_clean($data));
             }
             
        }
             

    }

    public function view_loan_detail(){

        if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
            $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];
            
            }
              else
        {
                redirect('Login','refresh');
        }

        $role1 = explode(",",$data['roles']);

        $loan_id = base64_decode($this->uri->segment(3));

        $data['loan']=$this->loan_model->view_loan_detail($loan_id);

         foreach($data['loan'] as $ln_data){

          $property_id = $ln_data['property_id'];
          $property_name = $ln_data['property_name'];
          $ln_id = $ln_data['loan_id'];
        }

         if(($loan_id == null OR $loan_id == '') OR (!isset($ln_id) OR $ln_id !== $loan_id OR $ln_id == null OR $ln_id == '')){

           show_404();
          exit();
          }



        if(!in_array("View Loan List",$role1)) {
        $msg = $session_data['username']." ".'Try To View Loan Data For'." ".$property_name." ".'View Loan Detail Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);        
        redirect('Admin/auth_error');
        }

         $prop_access_array = explode(",",$data['prop_access']);

       $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        $data['lean_loan'] = $this->loan_model->view_lean_loan_detail($loan_id);

        if($property_id == $final_property_access){
                $msg = $data['username']." ".'Viewed Loan Details For'." ".$property_name." ".'Property.';
                $this->user_activity_model->add('viewed',$msg,$data['username'],$data['admin_id']);
                $this->load->view('view_loan_data',$this->security->xss_clean($data));
            } else {
              $msg = $session_data['username']." ".'Try To View Loan Data For'." ".$property_name." ".'That Property Access is Not Given to the'." ".$session_data['username'].'.';
                $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
              redirect('Admin/auth_error');
            }
    }

    public function delete_loan_detail(){
         if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
            $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];
            
            }
              else
        {
                redirect('Login','refresh');
        }
        
          $loan_id = base64_decode($this->uri->segment(3));

          $data['loan']=$this->loan_model->view_loan_detail($loan_id);

         foreach($data['loan'] as $ln_data){
          $property_id = $ln_data['property_id'];  
          $property_name = $ln_data['property_name'];
          $ln_id = $ln_data['loan_id'];
        }

         if(($loan_id == null OR $loan_id == '') OR (!isset($ln_id) OR $ln_id !== $loan_id OR $ln_id == null OR $ln_id == '')){

           show_404();
          exit();
          }


          $role1 = explode(",",$data['roles']);
        if(!in_array("View Loan List",$role1)) {
        $msg = $session_data['username']." ".'Try To Delete Loan For'." ".$property_name." ".'Property.This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);       
        redirect('Admin/auth_error');
        }

        $prop_access_array = explode(",",$data['prop_access']);


       $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
              $msg = $session_data['username']." ".'Try To Delete Loan For'." ".$property_name." ".'Property.This Property Access is Not Given to the'." ".$session_data['username'].'.';
              $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);     
              redirect('Admin/auth_error');
            }



         foreach($data['loan'] as $ln){
          $upload_loan_document = $ln['upload_loan_document'];
          $lean_mark = $ln['lean_mark'];
          $lean_property_id = $ln['lean_property_id'];
        }

              
        $ipath = ('assets/images/uploads/loan/'.base64_decode($upload_loan_document));
        unlink($ipath);

        $data['get_property_count'] = $this->loan_model->get_property_count_for_delete($lean_property_id);

        if($lean_mark == "Yes"){


             if($data['get_property_count'] > 1){


                $this->loan_model->delete_loan_installment($loan_id);
                $this->loan_model->delete_loan($loan_id);
            }

            if($data['get_property_count'] == 1){

                    $this->loan_model->delete_loan_installment($loan_id);
                    $this->loan_model->delete_loan($loan_id);
                    $this->loan_model->update_lean_at_delete($lean_property_id);

            }

        } else {

            $this->loan_model->delete_loan_installment($loan_id);
            $this->loan_model->delete_loan($loan_id);

        }
        $this->session->set_flashdata("delete_loan","Loan Details and Loan Installment Details Deleted successfully.");
        $msg = $data['username']." ".'Deleted Loan Details For'." ".$property_name." ".'Property.';
        $this->user_activity_model->add('deleted',$msg,$data['username'],$data['admin_id']);
        redirect("Loan/view_loan_list","refresh");
    }



    public function loan_type_master(){
    	if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
            $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];
            
            }
              else
        {
                redirect('Login','refresh');
        }

        $role1 = explode(",",$data['roles']);
        if(!in_array("Loan Type Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Loan Type Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);      
        redirect('Admin/auth_error');
        }

        $data['loan_type'] = $this->loan_model->view_loan_type();
        $msg = $session_data['username']." ".'Visited Loan Type Master Page.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']); 
        $this->load->view('loan_type_master',$this->security->xss_clean($data));
    }

    public function loan_type_master_insert(){
        if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
            $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];
            
            }
              else
        {
                redirect('Login','refresh');
        }

        $role1 = explode(",",$data['roles']);
        if(!in_array("Loan Type Master",$role1)) {
         $msg = $session_data['username']." ".'Try To Access Loan Type Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);        
        redirect('Admin/auth_error');
        }

        $data['loan_type'] = $this->loan_model->view_loan_type();

        $this->form_validation->set_rules('loan_type','Loan Type','required');

         if($this->form_validation->run() == false)
        {
       
                $this->load->view('loan_type_master',$this->security->xss_clean($data));
           
        }
        else{

            $query = $this->loan_model->insertloantype();
            $this->session->set_flashdata("loan_type","Loan Type Added Successfully");
             $msg = $data['username']." ".'Added Loan Type Named'." " .$this->input->post('loan_type'). '.';
            $this->user_activity_model->add('added',$msg,$data['username'],$data['admin_id']);
            redirect("Loan/loan_type_master","refresh",$this->security->xss_clean($data));

        }
    }


    public function update_loan_type(){
      if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
            $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];
            
            }
              else
        {
                redirect('Login','refresh');
        }

        $role1 = explode(",",$data['roles']);
        $type = base64_decode($this->uri->segment(3));
       
        $data['loan_type'] = $this->loan_model->loan_type($type);

        foreach($data['loan_type'] as $ln_type){

            $loan_type = $ln_type['loan_type'];
            $loan_type_id = $ln_type['loan_type_id'];
        }

         if(($type == null OR $type == '') OR (!isset($loan_type_id) OR $loan_type_id !== $type OR $loan_type_id == null OR $loan_type_id == '')){

           show_404();
          exit();
          }

        if(!in_array("Loan Type Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Use Update Loan Type Page For'." ".$loan_type." ".'Update Loan Type Page Access is Not Given to the'." ".$session_data['username'].'.'; 
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);          
        redirect('Admin/auth_error');
        }

      $msg = $session_data['username']." ".'Visited Update Loan Type Page For'." ".$loan_type.'.';
      $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
      $this->load->view('update_loan_type',$this->security->xss_clean($data));
    }

    public function update_loan_type_redirect(){
      if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
            $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];
            
            }
              else
        {
                redirect('Login','refresh');
        }

        $role1 = explode(",",$data['roles']);
        $type = base64_decode($this->uri->segment(3));

        $data['loan_type'] = $this->loan_model->loan_type($type);

        foreach($data['loan_type'] as $ln_type){

            $loan_type = $ln_type['loan_type'];
           $loan_type_id = $ln_type['loan_type_id'];
        }

         if(($type == null OR $type == '') OR (!isset($loan_type_id) OR $loan_type_id !== $type OR $loan_type_id == null OR $loan_type_id == '')){

           show_404();
          exit();
          }

        if(!in_array("Loan Type Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Use Update Loan Type Page For'." ".$loan_type." ".'Update Loan Type Page Access is Not Given to the'." ".$session_data['username'].'.'; 
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);      
        redirect('Admin/auth_error');
        }

       $this->form_validation->set_rules('loan_type','Loan Type','required');

         if($this->form_validation->run() == false)
        {
       
                $this->load->view('update_loan_type',$this->security->xss_clean($data));
           
        }
        else{


               $query = $this->loan_model->update_loan_type($type);

               $this->session->set_flashdata("update_loan_type","Loan Type Updated Successfully");
              $msg = $data['username']." ".'Updated'." ".$this->input->post('loan_type'). " ".'Loan Type Details.';
                  $this->user_activity_model->add('updated',$msg,$data['username'],$data['admin_id']);
              redirect('Loan/loan_type_master');

        } 


    }



    public function bank_master(){
    	if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
            $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];
            
            }
              else
        {
                redirect('Login','refresh');
        }

        $role1 = explode(",",$data['roles']);
        if(!in_array("Bank Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Bank Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);		
        redirect('Admin/auth_error');
        }

        $data['bank'] = $this->loan_model->view_bank();
        $msg = $session_data['username']." ".'Visited Bank Master Page.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);   
        $this->load->view('bank_master',$this->security->xss_clean($data));
    }

    public function bank_master_insert(){
        if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
             $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];
            
            }
              else
        {
                redirect('Login','refresh');
        }

        $role1 = explode(",",$data['roles']);
        if(!in_array("Bank Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Bank Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);			
        redirect('Admin/auth_error');
        }

        $data['bank'] = $this->loan_model->view_bank();

        $this->form_validation->set_rules('bank_name','Bank Name','required');
        //$this->form_validation->set_rules('bank_email','Bank Email','required');
        //$this->form_validation->set_rules('bank_contact_number','Bank Contact No','required');
        //$this->form_validation->set_rules('bank_address','Bank Address','required');

         if($this->form_validation->run() == false)
        {
       
            $this->load->view('bank_master',$this->security->xss_clean($data));
           
        }
        else{

            $query = $this->loan_model->insertbank();
            $this->session->set_flashdata("insert_bank","Bank Details Added Successfully");
            $msg = $data['username']." ".'Added Bank Details Named'." " .$this->input->post('bank_name'). '.';
            $this->user_activity_model->add('added',$msg,$data['username'],$data['admin_id']);
            redirect("Loan/bank_master","refresh",$this->security->xss_clean($data));

        }
    }

     public function update_bank_details(){
      if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
            $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];
            
            }
              else
        {
                redirect('Login','refresh');
        }

        $role1 = explode(",",$data['roles']);
        $bank_id = base64_decode($this->uri->segment(3));
        
        $data['bank'] = $this->loan_model->get_bank($bank_id);

        foreach($data['bank'] as $bank_detail){

        	$namebank = $bank_detail['bank_name'];
            $ba_id = $bank_detail['bank_id'];
        }

        if(($bank_id == null OR $bank_id == '') OR (!isset($ba_id) OR $ba_id !== $bank_id OR $ba_id == null OR $ba_id == '')){

           show_404();
          exit();
          }

        if(!in_array("Bank Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Use Update Bank Detail Page For'." ".$namebank." ".'Update Bank Detail Page Access is Not Given to the'." ".$session_data['username'].'.'; 
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 		
        redirect('Admin/auth_error');
        }
       $msg = $session_data['username']." ".'Visited Update Bank Detail Page For'." ".$namebank.'.';
       $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
       $this->load->view('update_bank_details',$this->security->xss_clean($data));
    }

    public function update_bank_details_redirect(){
      if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
            $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];
            
            }
              else
        {
                redirect('Login','refresh');
        }

        $role1 = explode(",",$data['roles']);
        $bank_id = base64_decode($this->uri->segment(3));
        $data['bank'] = $this->loan_model->get_bank($bank_id);

        foreach($data['bank'] as $bank_detail){

        	$namebank = $bank_detail['bank_name'];
            $ba_id = $bank_detail['bank_id'];
        }

        if(($bank_id == null OR $bank_id == '') OR (!isset($ba_id) OR $ba_id !== $bank_id OR $ba_id == null OR $ba_id == '')){

           show_404();
          exit();
          }

        if(!in_array("Bank Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Use Update Bank Detail Page For'." ".$namebank." ".'Update Bank Detail Page Access is Not Given to the'." ".$session_data['username'].'.'; 
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 			
        redirect('Admin/auth_error');
        }

        $this->form_validation->set_rules('bank_name','Bank Name','required');
        //$this->form_validation->set_rules('bank_email','Bank Email','required');
        //$this->form_validation->set_rules('bank_contact_number','Bank Contact No','required');
        //$this->form_validation->set_rules('bank_address','Bank Address','required');

         if($this->form_validation->run() == false)
        {
       
            $this->load->view('update_bank_details',$this->security->xss_clean($data));
           
        }
        else{

               $query = $this->loan_model->update_bank($bank_id);

               $this->session->set_flashdata("update_bank","Bank Details Updated Successfully");
       			$msg = $data['username']." ".'Updated'." ".$this->input->post('bank_name'). " ".'Bank Details.';
                $this->user_activity_model->add('updated',$msg,$data['username'],$data['admin_id']);

              redirect('Loan/bank_master');

        } 


    }

    public function loan_officer_master(){
    	if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
            $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];
            
            }
              else
        {
                redirect('Login','refresh');
        }

        $role1 = explode(",",$data['roles']);
        if(!in_array("Loan Officer Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Loan Officer Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);		
        redirect('Admin/auth_error');
        }

        $data['bank'] = $this->loan_model->view_bank();
        $data['loan_officer'] = $this->loan_model->view_loan_officer();
        $msg = $session_data['username']." ".'Visited Loan Officer Master Page.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);  
         $this->load->view('loan_officer_master',$this->security->xss_clean($data));
    }

    public function loan_officer_master_insert(){
        if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
            $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];
            
            }
              else
        {
                redirect('Login','refresh');
        }

        $role1 = explode(",",$data['roles']);
        if(!in_array("Loan Officer Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Loan Officer Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);		
        redirect('Admin/auth_error');
        }

        $data['bank'] = $this->loan_model->view_bank();
        $data['loan_officer'] = $this->loan_model->view_loan_officer();
        
        $this->form_validation->set_rules('bank_name','Bank Name','required');
        $this->form_validation->set_rules('loan_officer_name','Loan Officer Name','required');
        $this->form_validation->set_rules('loan_officer_contact_number','Loan Officer Contact No','required');

         if($this->form_validation->run() == false)
        {
       
         $this->load->view('loan_officer_master',$this->security->xss_clean($data));
           
        }
        else{

            $query = $this->loan_model->insertloanofficer();
            $this->session->set_flashdata("loan_officer","Loan Officer Details Added Successfully");
            $msg = $data['username']." ".'Added Loan Officer Details Named'." " .$this->input->post('loan_officer_name'). '.';
            $this->user_activity_model->add('added',$msg,$data['username'],$data['admin_id']);
            redirect("Loan/loan_officer_master","refresh",$this->security->xss_clean($data));

        }
    }

     public function update_loan_officer_details(){
      if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
            $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];
            
            }
              else
        {
                redirect('Login','refresh');
        }

        $role1 = explode(",",$data['roles']);

        $officer_id = base64_decode($this->uri->segment(3));
        $data['bank'] = $this->loan_model->view_bank();
        $data['loan_officer'] = $this->loan_model->get_loan_officer($officer_id);

        foreach($data['loan_officer'] as $officer){

        	$officer_name = $officer['loan_officer_name'];
            $loan_officer_id = $officer['loan_officer_id'];
        }

        if(($officer_id == null OR $officer_id == '') OR (!isset($loan_officer_id) OR $loan_officer_id !== $officer_id OR $loan_officer_id == null OR $loan_officer_id == '')){

           show_404();
          exit();
          }

        if(!in_array("Loan Officer Master",$role1)) {
         $msg = $session_data['username']." ".'Try To Use Update Loan Officer Detail Page For'." ".$officer_name." ".'Update Loan Officer Detail Page Access is Not Given to the'." ".$session_data['username'].'.'; 
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 		
        redirect('Admin/auth_error');
        }
       $msg = $session_data['username']." ".'Visited Update Loan Officer Detail Page For'." ".$officer_name.'.';
       $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
       $this->load->view('update_loan_officer_details',$this->security->xss_clean($data));
    }

    public function update_loan_officer_redirect(){
      if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
            $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];
            
            }
              else
        {
                redirect('Login','refresh');
        }

        $role1 = explode(",",$data['roles']);

        $officer_id = base64_decode($this->uri->segment(3));
        $data['bank'] = $this->loan_model->view_bank();
        $data['loan_officer'] = $this->loan_model->get_loan_officer($officer_id);

        foreach($data['loan_officer'] as $officer){

        	$officer_name = $officer['loan_officer_name'];
            $loan_officer_id = $officer['loan_officer_id'];
        }

        if(($officer_id == null OR $officer_id == '') OR (!isset($loan_officer_id) OR $loan_officer_id !== $officer_id OR $loan_officer_id == null OR $loan_officer_id == '')){

           show_404();
          exit();
          }


        if(!in_array("Loan Officer Master",$role1)) {
         $msg = $session_data['username']." ".'Try To Use Update Loan Officer Detail Page For'." ".$officer_name." ".'Update Loan Officer Detail Page Access is Not Given to the'." ".$session_data['username'].'.'; 
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  	
        redirect('Admin/auth_error');
        }

     
        $this->form_validation->set_rules('bank_name','Bank Name','required');
        $this->form_validation->set_rules('loan_officer_name','Loan Officer Name','required');
        $this->form_validation->set_rules('loan_officer_contact_number','Loan Officer Contact No','required');

         if($this->form_validation->run() == false)
        {
       
         $this->load->view('update_loan_officer_details',$this->security->xss_clean($data));
           
        }
        else{
               $query = $this->loan_model->update_loan_officer($officer_id);

               $this->session->set_flashdata("update_loan_officer","Loan Officer Details Updated Successfully");

               $msg = $data['username']." ".'Updated'." ".$this->input->post('loan_officer_name'). " ".'Loan Officer Details.';
               $this->user_activity_model->add('updated',$msg,$data['username'],$data['admin_id']);

              redirect('Loan/loan_officer_master');

        } 


    }

    public function loan_installment_paid(){
        if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
            $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];
            
            }
              else
        {
                redirect('Login','refresh');
        }
        $role1 = explode(",",$data['roles']);

        $loan_id = base64_decode($this->uri->segment(3));

        $data['loan']=$this->loan_model->view_loan_detail($loan_id);

         foreach($data['loan'] as $ln_data){

          $property_name = $ln_data['property_name'];
          $ln_id = $ln_data['loan_id'];
        }

        if(($loan_id == null OR $loan_id == '') OR (!isset($ln_id) OR $ln_id !== $loan_id OR $ln_id == null OR $ln_id == '')){

           show_404();
          exit();
          }


        if(!in_array("View Loan Installments",$role1)) {
        $msg = $session_data['username']." ".'Try to Pay Installment For Loan on'." ".$property_name." ".'That Page Access is Not Given to'." ".$session_data['username'].'.';  
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  	
        redirect('Admin/auth_error');
        }

        $property_id = $this->loan_model->property_id_detail($loan_id);
        $property_id_array = explode(",",$this->loan_model->property_id_detail($loan_id));

        $prop_access_array = explode(",",$data['prop_access']);
        $common_access = array_intersect($prop_access_array,$property_id_array);;

        $final_property_access = implode(",",$common_access);
        if($property_id !== $final_property_access){
        	  $msg = $session_data['username']." ".'Try to Pay Installment For Loan on'." ".$property_name." ".'Which Property Access is Not Given to'." ".$session_data['username'].'.';  
        	  $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);
              redirect('Admin/auth_error');
            }
        if(empty($this->input->post('fully_paid'))){

        	$installments=$this->loan_model->get_loan_installment_detail($loan_id);
	    	$loan = $this->loan_model->get_loan_detail($loan_id);

            $loan_installlment_no = $loan->total_no_installments - 1;

	    	if($installments == $loan_installlment_no){

	    		$this->loan_model->update_loan_paid_detail($loan_id);
                $this->loan_model->add_loan_installment_detail($loan_id);
                if($loan->lean_mark == 'Yes'){
                	$data['get_property_count'] = $this->loan_model->get_property_count($loan->lean_property_id);
                 	if($data['get_property_count'] == 0){
                    	$this->loan_model->update_lean_at_delete($loan->lean_property_id);
                    }	
                }
                $msg = $session_data['username']." ".'Fully Paid the Loan For'." ".$property_name." ".'Property.';  
       		    $this->user_activity_model->add('installment_pay',$msg,$session_data['username'],$session_data['admin_id']); 
	        	$this->session->set_flashdata("loan_fully_installment","Your Loan is Fully Paid");
	    	
	    	}
	    	else{
	    	$this->loan_model->add_loan_installment_detail($loan_id);
	        $this->loan_model->update_loan_data($loan_id);
	        $msg = $session_data['username']." ".'Paid the Loan Installment For'." ".$property_name." ".'Property.';  
       		$this->user_activity_model->add('installment_pay',$msg,$session_data['username'],$session_data['admin_id']); 
	        $this->session->set_flashdata("loan_installment","Loan Installment Paid Successfully");
	    	}	
	        
	    }
	   if(!empty($this->input->post('fully_paid'))){
	    	$installments=$this->loan_model->get_loan_installment_detail($loan_id);
	    	$loan = $this->loan_model->get_loan_detail($loan_id);

            $loan_installlment_no = $loan->total_no_installments - 1;
	    	if($installments == $loan_installlment_no){
	    		$this->loan_model->update_loan_paid_detail($loan_id);
                $this->loan_model->add_loan_installment_detail($loan_id);
                 if($loan->lean_mark == 'Yes'){
                 	$data['get_property_count'] = $this->loan_model->get_property_count($loan->lean_property_id);
                 	if($data['get_property_count'] == 0){
                    	$this->loan_model->update_lean_at_delete($loan->lean_property_id);
                    }	
                }
                $msg = $session_data['username']." ".'Fully Paid  the Loan For'." ".$property_name." ".'Property.';  
       		    $this->user_activity_model->add('installment_pay',$msg,$session_data['username'],$session_data['admin_id']); 
	        	$this->session->set_flashdata("loan_fully_installment","Your Loan is Fully Paid");
	    	}
	    	else{
	    		$this->loan_model->add_loan_installment_detail($loan_id);
	    		$this->loan_model->update_loan_data($loan_id);
	    		$msg = 'Loan Installment is Paid For'." ".$property_name." ".'Property By'." ".$session_data['username'].'.But'." ".$session_data['username']." ".'Try To Fully Paid The Loan For'." ".$property_name." ".'on Which Loan Installments are Remainning';  
       		    $this->user_activity_model->add('installment_pay',$msg,$session_data['username'],$session_data['admin_id']); 
	    		$this->session->set_flashdata("loan_not_fully_installment","Your Loan is Not Fully Paid But Current Installment is Paid");
	    	}
	    }    

        redirect('Loan/loan_installments',"refresh");
    }

    public function view_loan_installments(){
        if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
            $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];
            
            }
              else
        {
                redirect('Login','refresh');
        }

        $role1 = explode(",",$data['roles']);
        $loan_id = base64_decode($this->uri->segment(3));

        $data['loan']=$this->loan_model->view_loan_detail($loan_id);

         foreach($data['loan'] as $ln_data){

          $property_name = $ln_data['property_name'];
          $ln_id = $ln_data['loan_id'];
        }

        if(($loan_id == null OR $loan_id == '') OR (!isset($ln_id) OR $ln_id !== $loan_id OR $ln_id == null OR $ln_id == '')){

           show_404();
          exit();
          }

        if(!in_array("View Loan Installments",$role1)) {
        $msg = $session_data['username']." ".'Try to View Loan Installment Details For Loan of '." ".$property_name." ".'Property'." ".'View Loan Installment Page Access is Not Given to'." ".$session_data['username'].'.'; 
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);	 	
        redirect('Admin/auth_error');
        }

        $property_id = $this->loan_model->property_id_detail($loan_id);
        $property_id_array = explode(",",$this->loan_model->property_id_detail($loan_id));

        $prop_access_array = explode(",",$data['prop_access']);
        $common_access = array_intersect($prop_access_array,$property_id_array);;

        $final_property_access = implode(",",$common_access);
        $data['installments'] =$this->loan_model->view_installment_detail($loan_id);
        if($property_id == $final_property_access){
        	 $msg = $session_data['username']." ".'Visited View Loan Installment Page For'." ".$property_name." ".'Property.';
       		 $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
             $this->load->view('view_loan_installments',$this->security->xss_clean($data));

            } else {
              $msg = $session_data['username']." ".'Try to View Loan Installment Details For Loan of '." ".$property_name." ".'Property'." ".$property_name." ".'That Property Access is Not Given to'." ".$session_data['username'].'.'; 
        	  $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);	 		
              redirect('Admin/auth_error');         
            }


    } 


}    