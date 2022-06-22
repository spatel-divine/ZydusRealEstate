<?php

class Income extends CI_Controller {

    public function __construct() {
    	 parent::__construct();
    	$this->load->helper(array('form', 'url','security'));
        $this->load->library(array('form_validation','session'));         
        $this->load->model('income_model');
        $this->load->model('user_activity_model');
          $this->load->library('upload');
          error_reporting(0);
    }

     public function income_master(){
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

          if(!in_array("Income Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Income Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
          redirect('Admin/auth_error');
          }   

        $data['property'] = $this->income_model->view_property();
        $data['income_type'] = $this->income_model->view_income_type();
        $data['income_source'] = $this->income_model->get_income_source_party();
        $data['recieved_by'] = $this->income_model->get_received_by();
        $msg = $session_data['username']." ".'Visited Income Master Page.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
    	  $this->load->view('income_master',$this->security->xss_clean($data));
    }

     public function income_master_redirect(){
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

          if(!in_array("Income Master",$role1)) {
           $msg = $session_data['username']." ".'Try To Access Income Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);       
          redirect('Admin/auth_error');
          }   

        $data['property'] = $this->income_model->view_property();
        $data['income_type'] = $this->income_model->view_income_type();
        $data['income_source'] = $this->income_model->get_income_source_party();
        $data['recieved_by'] = $this->income_model->get_received_by();

         $this->form_validation->set_rules('ledger_head','Ledger Head','required');
         $this->form_validation->set_rules('ledger_number','Ledger Number','required');
         $this->form_validation->set_rules('property_name','Property Name','required');
         $this->form_validation->set_rules('income_title','Income Title','required');
         $this->form_validation->set_rules('income_amount','Income Amount','required');
         $this->form_validation->set_rules('income_date','Income Date','required');
         $this->form_validation->set_rules('income_type','Income Type','required');
         $this->form_validation->set_rules('party','Income Source Party Name','required');
         $this->form_validation->set_rules('invoice_number','Invoice Number','required');
         $this->form_validation->set_rules('gst_percentage','GST Percentage','required|numeric');
         $this->form_validation->set_rules('tds_percentage','TDS Percentage','required|numeric');
         $this->form_validation->set_rules('received_by','Received By','required');
         $this->form_validation->set_rules('recurring_income','Recurring Income','required');
        

         if (empty($_FILES['invoice_images']['name']))
        {
          $this->form_validation->set_rules('invoice_images', 'Invoice Image', 'required');
        }
        if ($this->input->post('recurring_income') == 'Yes')
        {
          $this->form_validation->set_rules('next_recurring_date', 'Next Recurring Date', 'required');
        }


             if($this->form_validation->run() === FALSE)
            {
      
                $this->load->view('income_master',$this->security->xss_clean($data));
            }
            else{

                     $invoice_image = $_FILES['invoice_images']['name'];

                    if($invoice_image !== ""){

                        $invoice_image = str_replace(' ', '_', $invoice_image);

                            $config['file_name'] =$invoice_image;
                            $config['upload_path'] = './assets/images/uploads/invoice_upload/income';
                            $config['allowed_types'] = 'jpg|jpeg|png|pdf|zip|rar';
                            $config['max_size'] = '20000';
                            //$config['max_width'] = '2048';
                            //$config['max_height'] = '2048';
                            $config['encrypt_name'] = TRUE;
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            if (!$this->upload->do_upload('invoice_images')) {
                                $error = array('error' => $this->upload->display_errors());
                                
                               $this->session->set_flashdata('new_in',2);
                              $this->load->view("income_master",$this->security->xss_clean($data));
                            } else {
                                $data1 = array('upload_data' => $this->upload->data());
                                //$file_name = $upload_data['file_name'];
                               
                                 $this->income_model->add_income($data1['upload_data']['file_name']);
                                 $this->session->set_flashdata("add_income","Income Added Successfully");
                                 $msg = $session_data['username']." ".'Added Income Data For Income Title Named'." ".$this->input->post('income_title')." ".'With Ledger No'." ".$this->input->post('ledger_number');
                                $this->user_activity_model->add('added',$msg,$session_data['username'],$session_data['admin_id']); 
                                if(in_array("View Income List",$role1)) {
                                  redirect("Income/view_income_list");
                                } else {
                                  redirect("Income/income_master");
                                }
                            }

                        }
                    
                }    
        
    }

     public function income_type_master(){
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

          if(!in_array("Income Type Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Income Type Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
          redirect('Admin/auth_error');
          }   

    	$data['income_type'] = $this->income_model->view_income_type();
      $msg = $session_data['username']." ".'Visited Income Type Master Page.';
      $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']); 
      $this->load->view('income_type_master',$this->security->xss_clean($data));
    }

     public function income_type_master_insert(){
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

          if(!in_array("Income Type Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Income Type Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);     
          redirect('Admin/auth_error');
          }   

        $data['income_type'] = $this->income_model->view_income_type();

        $this->form_validation->set_rules('income_type','Income Type','required');

         if($this->form_validation->run() == false)
        {
       
           
            $this->load->view('income_type_master',$this->security->xss_clean($data));


           
        }
        else{

            $query = $this->income_model->insertincometype();
            $this->session->set_flashdata("income_type","Income Type Added Successfully");
            $msg = $data['username']." ".'Added Income Type Named'." " .$this->input->post('income_type'). '.';
            $this->user_activity_model->add('added',$msg,$data['username'],$data['admin_id']);
            redirect("Income/income_type_master","refresh",$this->security->xss_clean($data));

        }
    }

    public function update_income_type(){
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

      $data['income_type'] = $this->income_model->income_type($type);

      foreach($data['income_type'] as $inc_type){

        $type_income = $inc_type['income_type'];
        $income_type_id = $inc_type['income_type_id'];

      }
       if(($type == null OR $type == '') OR (!isset($income_type_id) OR $income_type_id !== $type OR $income_type_id == null OR $income_type_id == '')){

             show_404();
            exit();
          }

          if(!in_array("Income Type Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Use Update Income Type Page For'." ".$type_income." ".'Update Income Type Page Access is Not Given to the'." ".$session_data['username'].'.'; 
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);     
          redirect('Admin/auth_error');
          }   
      $msg = $session_data['username']." ".'Visited Update Income Type Page For'." ".$type_income.'.';
      $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);     
      $this->load->view('update_income_type',$this->security->xss_clean($data));
    }

    public function update_income_type_redirect(){
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

       $data['income_type'] = $this->income_model->income_type($type);

       foreach($data['income_type'] as $inc_type){

        $type_income = $inc_type['income_type'];
        $income_type_id = $inc_type['income_type_id'];

      }
       if(($type == null OR $type == '') OR (!isset($income_type_id) OR $income_type_id !== $type OR $income_type_id == null OR $income_type_id == '')){

             show_404();
            exit();
          }
          if(!in_array("Income Type Master",$role1)) {
           $msg = $session_data['username']." ".'Try To Use Update Income Type Page For'." ".$type_income." ".'Update Income Type Page Access is Not Given to the'." ".$session_data['username'].'.'; 
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);       
          redirect('Admin/auth_error');
          }   

       $this->form_validation->set_rules('income_type','Income Type','required');

         if($this->form_validation->run() == false)
        {
       
           
            $this->load->view('update_income_type',$this->security->xss_clean($data));


           
        }
        else{

               $query = $this->income_model->update_income_type($type);

               $this->session->set_flashdata("update_income_type","Income Type Updated Successfully");
               $msg = $data['username']." ".'Updated'." ".$this->input->post('income_type'). " ".'Income Type.';
               $this->user_activity_model->add('updated',$msg,$data['username'],$data['admin_id']);
               redirect('Income/income_type_master');

        } 


    }

    public function view_income_list(){
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

          if(!in_array("View Income List",$role1)) {
           $msg = $session_data['username']." ".'Try To Access View Income List Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);     
          redirect('Admin/auth_error');
          }   

        $data['income_list'] = $this->income_model->view_income();
        $data['property'] = $this->income_model->view_property_for_filter();
         $data['income_source'] = $this->income_model->get_income_source_party_for_filter();
         $msg = $session_data['username']." ".'Visited View Income List Page.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
    	  $this->load->view('view_income_list',$this->security->xss_clean($data));
    }

     public function filter_income()
    {
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

          if(!in_array("View Income List",$role1)) {
          redirect('Admin/auth_error');
          }   

        //$data['property'] = $this->income_model->view_property();
        $data['property'] = $this->income_model->view_property_for_filter();
         $data['income_source'] = $this->income_model->get_income_source_party_for_filter();
        $date="";
        if(!empty($this->input->post('date'))){
            $date = date("Y-m-d", strtotime($this->input->post('date')));
        }
        $property = $this->input->post('property_name');
        $party = $this->input->post('party');

        if($date !== "" AND $property !== "" AND $party !== ""){
        $query1 = $this->db->join('property_master', 'income_master.property_id=property_master.property_id');    
        $query1 = $this->db->join('user_master', 'income_master.income_source_party=user_master.user_id');
        $this->db->order_by('income_id','desc');
         $query1 = $this->db->get_where('income_master',array('income_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$date)),'income_master.property_id'=>$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$property)),'income_source_party'=>$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$party))));
         $data['income_list']  = $query1->result_array();
         $this->load->view('view_income_list',$this->security->xss_clean($data));
        }

        else if($date !== "" AND $property == "" AND $party == ""){
            $query1 = $this->db->join('property_master', 'income_master.property_id=property_master.property_id');    
        $query1 = $this->db->join('user_master', 'income_master.income_source_party=user_master.user_id');
        $this->db->order_by('income_id','desc');
         $query1 = $this->db->get_where('income_master',array('income_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$date))));
         $data['income_list']  = $query1->result_array();
         $this->load->view('view_income_list',$this->security->xss_clean($data));
        }

        else if($date == "" AND $property !== "" AND $party == ""){
             $query1 = $this->db->join('property_master', 'income_master.property_id=property_master.property_id');    
        $query1 = $this->db->join('user_master', 'income_master.income_source_party=user_master.user_id');
        $this->db->order_by('income_id','desc');
         $query1 = $this->db->get_where('income_master',array('income_master.property_id'=>$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$property))));
         $data['income_list']  = $query1->result_array();
         $this->load->view('view_income_list',$this->security->xss_clean($data));
        }

        else if($date == "" AND $property == "" AND $party !== ""){
             $query1 = $this->db->join('property_master', 'income_master.property_id=property_master.property_id');    
        $query1 = $this->db->join('user_master', 'income_master.income_source_party=user_master.user_id');
        $this->db->order_by('income_id','desc');
         $query1 = $this->db->get_where('income_master',array('income_master.income_source_party'=>$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$party))));
         $data['income_list']  = $query1->result_array();
         $this->load->view('view_income_list',$this->security->xss_clean($data));
        }

        if($date !== "" AND $property !== "" AND $party == ""){
        $query1 = $this->db->join('property_master', 'income_master.property_id=property_master.property_id');    
        $query1 = $this->db->join('user_master', 'income_master.income_source_party=user_master.user_id');
        $this->db->order_by('income_id','desc');
         $query1 = $this->db->get_where('income_master',array('income_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$date)),'income_master.property_id'=>$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$property))));
         $data['income_list']  = $query1->result_array();
         $this->load->view('view_income_list',$this->security->xss_clean($data));
        }

        if($date !== "" AND $property == "" AND $party !== ""){
        $query1 = $this->db->join('property_master', 'income_master.property_id=property_master.property_id');    
        $query1 = $this->db->join('user_master', 'income_master.income_source_party=user_master.user_id');
        $this->db->order_by('income_id','desc');
         $query1 = $this->db->get_where('income_master',array('income_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$date)),'income_source_party'=>$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$party))));
         $data['income_list']  = $query1->result_array();
         $this->load->view('view_income_list',$this->security->xss_clean($data));
        }

        if($date == "" AND $property !== "" AND $party !== ""){
        $query1 = $this->db->join('property_master', 'income_master.property_id=property_master.property_id');    
        $query1 = $this->db->join('user_master', 'income_master.income_source_party=user_master.user_id');
        $this->db->order_by('income_id','desc');
         $query1 = $this->db->get_where('income_master',array('income_master.property_id'=>$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$property)),'income_source_party'=>$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$party))));
         $data['income_list']  = $query1->result_array();
         $this->load->view('view_income_list',$this->security->xss_clean($data));
        } 

        if($date == "" AND $property == "" AND $party == ""){
        $this->session->set_flashdata("select_data","Please Select Any Filter Field For Search");
            redirect('Income/view_income_list/',$this->security->xss_clean($data));
        }

    }

    public function view_income_detail(){

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

        $income_id = base64_decode($this->uri->segment(3));

        $data['income']=$this->income_model->view_income_detail($income_id);

        foreach($data['income'] as $inc){
          $property_id = $inc['property_id'];
          $property_name = $inc['property_name'];
          $income_title = $inc['income_title'];
          $ledger_number = $inc['income_ledger_number'];
          $inc_id = $inc['income_id'];
        }

        if(($income_id == null OR $income_id == '') OR (!isset($inc_id) OR $inc_id !== $income_id OR $inc_id == null OR $inc_id == '')){

             show_404();
            exit();
          }

          if(!in_array("View Income List",$role1)) {
           $msg = $session_data['username']." ".'Try To View Income Details For'." ".$property_name." ".'Property And Income Title Named'." ".$income_title." ".'With Ledger Number'." ".$ledger_number." ". '.This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
          redirect('Admin/auth_error');
          }   


        $prop_access_array = explode(",",$data['prop_access']);
        
        $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
              $msg = $session_data['username']." ".'Try To View Income Details For'." ".$property_name." ".'Property And Income Title Named'." ".$income_title." ".'With Ledger Number'." ".$ledger_number." ". '.This Property is Not Given to the'." ".$session_data['username'].'.';
              $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
              redirect('Admin/auth_error');
            }

        $data['received_by']=$this->income_model->view_income_received_by_detail($income_id);
        if (empty($data['income'])) {
            show_404();
        }
        $msg = $session_data['username']." ".'Viewed Income Details For'." ".$property_name." ".'Property And Income Title Named'." ".$income_title." ".'With Ledger Number'." ".$ledger_number;
        $this->user_activity_model->add('viewed',$msg,$session_data['username'],$session_data['admin_id']);   
        $this->load->view('view_income',$this->security->xss_clean($data));
    }

    public function download_income_invoice(){

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
        $income_id = base64_decode($this->uri->segment(3));

        $data['income']=$this->income_model->view_income_detail($income_id);

        foreach($data['income'] as $inc){
          $property_id = $inc['property_id'];
          $property_name = $inc['property_name'];
          $income_title = $inc['income_title'];
          $ledger_number = $inc['income_ledger_number'];
          $inc_id = $inc['income_id'];
        }

        if(($income_id == null OR $income_id == '') OR (!isset($inc_id) OR $inc_id !== $income_id OR $inc_id == null OR $inc_id == '')){

             show_404();
            exit();
          }

          if(!in_array("View Income List",$role1)) {
           $msg = $session_data['username']." ".'Try To Download Income Document For'." ".$property_name." ".'Property And Income Title Named'." ".$income_title." ".'With Ledger Number'." ".$ledger_number." ". '.Download Income Document Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);     
          redirect('Admin/auth_error');
          }   

         $prop_access_array = explode(",",$data['prop_access']);
        
        $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
              $msg = $session_data['username']." ".'Try To Download Income Document For'." ".$property_name." ".'Property And Income Title Named'." ".$income_title." ".'With Ledger Number'." ".$ledger_number." ". '.This Property Access is Not Given to the'." ".$session_data['username'].'.';
              $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
              redirect('Admin/auth_error');
            }


          if(!empty($income_id)){
            //load download helper
            $this->load->helper('download');
            
            //get file info from database
            $fileInfo = $this->income_model->download_detail($income_id);

            $fileInfo1 = base64_decode($fileInfo);
            
            //file path
            $file = file_get_contents(base_url().'assets/images/uploads/invoice_upload/income/'.$fileInfo1);

            $msg = $session_data['username']." ".'Downloaded Income Document For'." ".$property_name." ".'Property And Income Title Named'." ".$income_title." ".'With Ledger Number'." ".$ledger_number;
            $this->user_activity_model->add('download_document',$msg,$session_data['username'],$session_data['admin_id']);   

            //download file from directory
            force_download($fileInfo1, $file);
            redirect('Income/view_income_detail/'.$this->security->xss_clean($income_id));
        }
    }

    public function delete_income_detail(){
      
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

        $income_id = base64_decode($this->uri->segment(3));

        $data['income']=$this->income_model->view_income_detail($income_id);

        foreach($data['income'] as $income){
          $invoice_upload = $income['invoice_upload'];
          $property_id = $income['property_id'];
          $property_name = $income['property_name'];
          $income_title = $income['income_title'];
          $ledger_number = $income['income_ledger_number'];
          $inc_id = $income['income_id'];
        }

        if(($income_id == null OR $income_id == '') OR (!isset($inc_id) OR $inc_id !== $income_id OR $inc_id == null OR $inc_id == '')){

             show_404();
            exit();
          }

          if(!in_array("View Income List",$role1)) {
           $msg = $session_data['username']." ".'Try To Delete Income Details For'." ".$property_name." ".'Property And Income Title Named'." ".$income_title." ".'With Ledger Number'." ".$ledger_number." ". '.Delete Income Detail Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);       
          redirect('Admin/auth_error');
          }   
        
        if (empty($income_id)) {
            show_404();
        }


         $prop_access_array = explode(",",$data['prop_access']);

        $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
              $msg = $session_data['username']." ".'Try To Delete Income Details For'." ".$property_name." ".'Property And Income Title Named'." ".$income_title." ".'With Ledger Number'." ".$ledger_number." ". '.This Property Access is Not Given to the'." ".$session_data['username'].'.';
              $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 
              redirect('Admin/auth_error');
            }

       $ipath = ('assets/images/uploads/invoice_upload/income/'.base64_decode($invoice_upload));
       unlink($ipath);

        $this->income_model->delete_income($income_id);
        $this->session->set_flashdata("delete_income","Income Details Deleted successfully.");
        $msg = $session_data['username']." ".'Deleted Income Details For'." ".$property_name." ".'Property And Income Title Named'." ".$income_title." ".'With Ledger Number'." ".$ledger_number;
        $this->user_activity_model->add('deleted',$msg,$session_data['username'],$session_data['admin_id']); 
        redirect("Income/view_income_list","refresh");
    }



    public function recurring_income_list(){
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

          if(!in_array("Recurring Income List",$role1)) {
           $msg = $session_data['username']." ".'Try To Access Recurring Income List Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);     
          redirect('Admin/auth_error');
          }   

         $data['income_list'] = $this->income_model->view_recurring_income();
         $data['property'] = $this->income_model->view_property_for_filter();
         $msg = $session_data['username']." ".'Visited Recurring Income List Page.';
         $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
    	   $this->load->view('recurring_income_list',$this->security->xss_clean($data));
    }

    public function filter_recurring_income()
    {
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

          if(!in_array("Recurring Income List",$role1)) {
          redirect('Admin/auth_error');
          }  
          
        //$data['property'] = $this->income_model->view_property();
        $data['property'] = $this->income_model->view_property_for_filter();
        $date="";
        if(!empty($this->input->post('date'))){
            $date = date("Y-m-d", strtotime($this->input->post('date')));
        }
        $property = $this->input->post('property_name');
    

        if($date !== "" AND $property !== ""){
        $query1 = $this->db->join('property_master', 'income_master.property_id=property_master.property_id');    
        $query1 = $this->db->join('user_master', 'income_master.income_source_party=user_master.user_id');
        $this->db->order_by('income_id','desc');
         $query1 = $this->db->get_where('income_master',array('recurring_income' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",'Yes')),'next_recurring_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$date)),'income_master.property_id'=>$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$property))));
         $data['income_list']  = $query1->result_array();
         $this->load->view('recurring_income_list',$this->security->xss_clean($data));

        }

        else if($date !== "" AND $property == ""){
            $query1 = $this->db->join('property_master', 'income_master.property_id=property_master.property_id');    
        $query1 = $this->db->join('user_master', 'income_master.income_source_party=user_master.user_id');
        $this->db->order_by('income_id','desc');
         $query1 = $this->db->get_where('income_master',array('recurring_income' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",'Yes')),'next_recurring_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$date))));
         $data['income_list']  = $query1->result_array();
         $this->load->view('recurring_income_list',$this->security->xss_clean($data));

        }

        else if($date == "" AND $property !== ""){
             $query1 = $this->db->join('property_master', 'income_master.property_id=property_master.property_id');    
        $query1 = $this->db->join('user_master', 'income_master.income_source_party=user_master.user_id');
        $this->db->order_by('income_id','desc');
         $query1 = $this->db->get_where('income_master',array('recurring_income' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",'Yes')),'income_master.property_id'=>$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$property))));
         $data['income_list']  = $query1->result_array();
         $this->load->view('recurring_income_list',$this->security->xss_clean($data));

        }
        else {
        $this->session->set_flashdata("select_data","Please Select Any Filter Field For Search");
            redirect('Income/recurring_income_list/',$this->security->xss_clean($data));
        }

        
    }
}    