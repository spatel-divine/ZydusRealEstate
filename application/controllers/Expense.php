<?php

class Expense extends CI_Controller {

    public function __construct() {
    	 parent::__construct();
    	$this->load->helper(array('form', 'url','security'));
        $this->load->library(array('form_validation','session','upload'));  
        $this->load->model('expense_model');       
        $this->load->model('user_activity_model');
        error_reporting(0);
    }

     public function expense_master(){
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

          if(!in_array("Expense Master",$role1)) {
           $msg = $session_data['username']." ".'Try To Access Expense Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);     
          redirect('Admin/auth_error');
          }   

        $data['property'] = $this->expense_model->view_property();
        $data['expense_type'] = $this->expense_model->view_expense_type();
         $data['expense_source'] = $this->expense_model->get_expense_source_party();
        $data['paid_by'] = $this->expense_model->get_paid_by();
        $msg = $session_data['username']." ".'Visited Expense Master Page.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
    	  $this->load->view('expense_master',$this->security->xss_clean($data));
    }

    public function expense_master_redirect(){
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

          if(!in_array("Expense Master",$role1)) {
           $msg = $session_data['username']." ".'Try To Access Expense Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);       
          redirect('Admin/auth_error');
          }   

        $data['property'] = $this->expense_model->view_property();
        $data['expense_type'] = $this->expense_model->view_expense_type();
        $data['expense_source'] = $this->expense_model->get_expense_source_party();
        $data['paid_by'] = $this->expense_model->get_paid_by();

         $this->form_validation->set_rules('ledger_head','Ledger Head','required');
         $this->form_validation->set_rules('ledger_number','Ledger Number','required');
         $this->form_validation->set_rules('property_name','Property Name','required');
         $this->form_validation->set_rules('expense_title','Expense Title','required');
         $this->form_validation->set_rules('expense_amount','Expense Amount','required');
         $this->form_validation->set_rules('expense_date','Expense Date','required');
         $this->form_validation->set_rules('expense_type','Expense Type','required');
         $this->form_validation->set_rules('party','Expense Source Party Name','required');
         $this->form_validation->set_rules('invoice_number','Invoice Number','required');
         $this->form_validation->set_rules('gst_percentage','GST Percentage','required|numeric');
         $this->form_validation->set_rules('tds_percentage','TDS Percentage','required|numeric');
         $this->form_validation->set_rules('paid_by','Paid By','required');
         $this->form_validation->set_rules('recurring_expense','Recurring Expense','required');
        

         if (empty($_FILES['invoice_images']['name']))
        {
          $this->form_validation->set_rules('invoice_images', 'Invoice Image', 'required');
        }
        if ($this->input->post('recurring_expense') == 'Yes')
        {
          $this->form_validation->set_rules('next_recurring_date', 'Next Recurring Date', 'required');
        }


             if($this->form_validation->run() === FALSE)
            {
      
                $this->load->view('expense_master',$this->security->xss_clean($data));
            }
            else{

                     $invoice_image = $_FILES['invoice_images']['name'];

                    if($invoice_image !== ""){

                        $invoice_image = str_replace(' ', '_', $invoice_image);

                            $config['file_name'] =$invoice_image;
                            $config['upload_path'] = './assets/images/uploads/invoice_upload/expense';
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
                              $this->load->view("expense_master",$this->security->xss_clean($data));
                            } else {
                                $data1 = array('upload_data' => $this->upload->data());
                                //$file_name = $upload_data['file_name'];
                               
                                 $this->expense_model->add_expense($data1['upload_data']['file_name']);
                                 $this->session->set_flashdata("add_expense","Expense Added Successfully");
                                 $msg = $session_data['username']." ".'Added Expense Data For Expense Title Named'." ".$this->input->post('expense_title')." ".'With Ledger No'." ".$this->input->post('ledger_number');
                                $this->user_activity_model->add('added',$msg,$session_data['username'],$session_data['admin_id']);
                                if(in_array("View Expense List",$role1)) {
                                  redirect("Expense/view_expense_list");
                                } else {
                                  redirect("Expense/expense_master");
                                }
                            }

                        }
                    
                }    
        
    }


     public function expense_type_master(){
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

          if(!in_array("Expense Type Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Expense Type Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
          redirect('Admin/auth_error');
          }   

    	$data['expense_type'] = $this->expense_model->view_expense_type();
      $msg = $session_data['username']." ".'Visited Expense Type Master Page.';
      $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']); 
    	$this->load->view('expense_type_master',$this->security->xss_clean($data));
    }

    public function expense_type_master_insert(){
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

          if(!in_array("Expense Type Master",$role1)) {
           $msg = $session_data['username']." ".'Try To Access Expense Type Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
          redirect('Admin/auth_error');
          }   

        $data['expense_type'] = $this->expense_model->view_expense_type();

        $this->form_validation->set_rules('expense_type','Expense Type','required');

         if($this->form_validation->run() == false)
        {
       
        $this->load->view('expense_type_master',$this->security->xss_clean($data));


           
        }
        else{

            $query = $this->expense_model->insertexpensetype();
            $this->session->set_flashdata("expense_type","Expense Type Added Successfully");
            $msg = $data['username']." ".'Added Expense Type Named'." " .$this->input->post('expense_type'). '.';
            $this->user_activity_model->add('added',$msg,$data['username'],$data['admin_id']);
            redirect("Expense/expense_type_master","refresh",$this->security->xss_clean($data));

        }
    }

    public function update_expense_type(){
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

        
        $data['expense_type'] = $this->expense_model->expense_type($type);

        foreach($data['expense_type'] as $inc_type){

        $type_expense = $inc_type['expense_type'];
        $expense_type_id = $inc_type['expense_type_id'];
      }

       if(($type == null OR $type == '') OR(!isset($expense_type_id) OR $expense_type_id !== $type OR $expense_type_id == null OR $expense_type_id == '')){

             show_404();
            exit();
          }

          if(!in_array("Expense Type Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Use Update Expense Type Page For'." ".$type_expense." ".'Update Expense Type Page Access is Not Given to the'." ".$session_data['username'].'.'; 
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 
          redirect('Admin/auth_error');
          }   
      $msg = $session_data['username']." ".'Visited Update Expense Type Page For'." ".$type_expense.'.';
      $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);      
      $this->load->view('update_expense_type',$this->security->xss_clean($data));
    }

    public function update_expense_type_redirect(){
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
        $data['expense_type'] = $this->expense_model->expense_type($type);

        foreach($data['expense_type'] as $inc_type){

        $type_expense = $inc_type['expense_type'];
        $expense_type_id = $inc_type['expense_type_id'];
      }

       if(($type == null OR $type == '') OR(!isset($expense_type_id) OR $expense_type_id !== $type  OR $expense_type_id == null OR $expense_type_id == '')){

             show_404();
            exit();
          }
          if(!in_array("Expense Type Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Use Update Expense Type Page For'." ".$type_expense." ".'Update Expense Type Page Access is Not Given to the'." ".$session_data['username'].'.'; 
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
          redirect('Admin/auth_error');
          }   

       $this->form_validation->set_rules('expense_type','Expense Type','required');

         if($this->form_validation->run() == false)
        {
       
        $this->load->view('update_expense_type',$this->security->xss_clean($data));


           
        }
        else{

               $query = $this->expense_model->update_expense_type($type);

               $this->session->set_flashdata("update_expense_type","Expense Type Updated Successfully");
               $msg = $data['username']." ".'Updated'." ".$this->input->post('expense_type'). " ".'Expense Type.';
               $this->user_activity_model->add('updated',$msg,$data['username'],$data['admin_id']);
               redirect('Expense/expense_type_master');

        } 


    }


    public function view_expense_list(){
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

          if(!in_array("View Expense List",$role1)) {
           $msg = $session_data['username']." ".'Try To Access View Expense List Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
          redirect('Admin/auth_error');
          }   

        $data['expense_list'] = $this->expense_model->view_expense();
        $data['property'] = $this->expense_model->view_property_for_filter();
        $data['expense_source'] = $this->expense_model->get_expense_source_party_for_filter();
        $msg = $session_data['username']." ".'Visited View Expense List Page.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
    	  $this->load->view('view_expense_list',$this->security->xss_clean($data));
    }

    public function filter_expense()
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

          if(!in_array("View Expense List",$role1)) {
          redirect('Admin/auth_error');
          }   

        //$data['property'] = $this->expense_model->view_property();
        $data['property'] = $this->expense_model->view_property_for_filter();
        $data['expense_source'] = $this->expense_model->get_expense_source_party_for_filter();
        $date="";
        if(!empty($this->input->post('date'))){
            $date = date("Y-m-d", strtotime($this->input->post('date')));
        }
        $property = $this->input->post('property_name');
        $party = $this->input->post('party');

            if($date !== "" AND $property !== "" AND $party !== ""){
         $query1 = $this->db->join('property_master', 'expense_master.property_id=property_master.property_id');    
         $query1 = $this->db->join('user_master', 'expense_master.expense_source_party=user_master.user_id');
         $query1 = $this->db->order_by('expense_id','desc');
         $query1 = $this->db->get_where('expense_master',array('expense_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$date)),'expense_master.property_id'=>$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$property)),'expense_source_party'=>$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$party))));
         $data['expense_list']  = $query1->result_array();
         $this->load->view('view_expense_list',$this->security->xss_clean($data));
        }

        else if($date !== "" AND $property == "" AND $party == ""){
         $query1 = $this->db->join('property_master', 'expense_master.property_id=property_master.property_id');    
         $query1 = $this->db->join('user_master', 'expense_master.expense_source_party=user_master.user_id');
         $query1 = $this->db->order_by('expense_id','desc');
         $query1 = $this->db->get_where('expense_master',array('expense_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$date))));
        $data['expense_list']  = $query1->result_array();
        $this->load->view('view_expense_list',$this->security->xss_clean($data));
        }

        else if($date == "" AND $property !== "" AND $party == ""){
        $query1 = $this->db->join('property_master', 'expense_master.property_id=property_master.property_id');    
         $query1 = $this->db->join('user_master', 'expense_master.expense_source_party=user_master.user_id');
         $query1 = $this->db->order_by('expense_id','desc');
         $query1 = $this->db->get_where('expense_master',array('expense_master.property_id'=>$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$property))));
        $data['expense_list']  = $query1->result_array();
        $this->load->view('view_expense_list',$this->security->xss_clean($data));
        }

        else if($date == "" AND $property == "" AND $party !== ""){
         $query1 = $this->db->join('property_master', 'expense_master.property_id=property_master.property_id');    
         $query1 = $this->db->join('user_master', 'expense_master.expense_source_party=user_master.user_id');
         $query1 = $this->db->order_by('expense_id','desc');
         $query1 = $this->db->get_where('expense_master',array('expense_master.expense_source_party'=>$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$party))));
        $data['expense_list']  = $query1->result_array();
        $this->load->view('view_expense_list',$this->security->xss_clean($data));
        }

        if($date !== "" AND $property !== "" AND $party == ""){
         $query1 = $this->db->join('property_master', 'expense_master.property_id=property_master.property_id');    
         $query1 = $this->db->join('user_master', 'expense_master.expense_source_party=user_master.user_id');
         $query1 = $this->db->order_by('expense_id','desc');
         $query1 = $this->db->get_where('expense_master',array('expense_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$date)),'expense_master.property_id'=>$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$property))));
        $data['expense_list']  = $query1->result_array();
        $this->load->view('view_expense_list',$this->security->xss_clean($data));
        }

        if($date !== "" AND $property == "" AND $party !== ""){
         $query1 = $this->db->join('property_master', 'expense_master.property_id=property_master.property_id');    
         $query1 = $this->db->join('user_master', 'expense_master.expense_source_party=user_master.user_id');
         $query1 = $this->db->order_by('expense_id','desc');
         $query1 = $this->db->get_where('expense_master',array('expense_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$date)),'expense_source_party'=>$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$party))));
        $data['expense_list']  = $query1->result_array();
        $this->load->view('view_expense_list',$this->security->xss_clean($data));
        }

        if($date == "" AND $property !== "" AND $party !== ""){
         $query1 = $this->db->join('property_master', 'expense_master.property_id=property_master.property_id');    
         $query1 = $this->db->join('user_master', 'expense_master.expense_source_party=user_master.user_id');
         $query1 = $this->db->order_by('expense_id','desc');
         $query1 = $this->db->get_where('expense_master',array('expense_master.property_id'=>$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$property)),'expense_source_party'=>$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$party))));
        $data['expense_list']  = $query1->result_array();
        $this->load->view('view_expense_list',$this->security->xss_clean($data));
        }

        if($date == "" AND $property == "" AND $party == ""){
        $this->session->set_flashdata("select_data","Please Select Any Filter Field For Search");
            redirect('Expense/view_expense_list/',$this->security->xss_clean($data));
        }

    }

    public function view_expense_detail(){

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

        $expense_id = base64_decode($this->uri->segment(3));

        $data['expense']=$this->expense_model->view_expense_detail($expense_id);

       foreach($data['expense'] as $expense){
          $property_id = $expense['property_id'];
          $property_name = $expense['property_name'];
          $expense_title = $expense['expense_title'];
          $ledger_number = $expense['expense_ledger_number'];
          $exp_id = $expense['expense_id'];
        }


       if(($expense_id == null OR $expense_id == '') OR(!isset($exp_id) OR $exp_id !== $expense_id OR $exp_id == null OR $exp_id == '')){

             show_404();
            exit();
          }

          if(!in_array("View Expense List",$role1)) {
          $msg = $session_data['username']." ".'Try To View Expense Details For'." ".$property_name." ".'Property And Expense Title Named'." ".$expense_title." ".'With Ledger Number'." ".$ledger_number." ". '.This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);     
          redirect('Admin/auth_error');
          }   

        $prop_access_array = explode(",",$data['prop_access']);
        
        $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
               $msg = $session_data['username']." ".'Try To View Expense Details For'." ".$property_name." ".'Property And Expense Title Named'." ".$expense_title." ".'With Ledger Number'." ".$ledger_number." ". '.This Property Access is Not Given to the'." ".$session_data['username'].'.';
              $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
              redirect('Admin/auth_error');
            }

        $data['paid_by']=$this->expense_model->view_expense_paid_by_detail($expense_id);
          $msg = $session_data['username']." ".'Viewed Expense Details For'." ".$property_name." ".'Property And Expense Title Named'." ".$expense_title." ".'With Ledger Number'." ".$ledger_number;
          $this->user_activity_model->add('viewed',$msg,$session_data['username'],$session_data['admin_id']);  
        $this->load->view('view_expense',$this->security->xss_clean($data));
    }

    public function download_expense_invoice(){

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
        $expense_id = base64_decode($this->uri->segment(3));

        $data['expense']=$this->expense_model->view_expense_detail($expense_id);

        foreach($data['expense'] as $expense){
          $property_id = $expense['property_id'];
          $property_name = $expense['property_name'];
          $expense_title = $expense['expense_title'];
          $ledger_number = $expense['expense_ledger_number'];
          $exp_id = $expense['expense_id'];
        }


       if(($expense_id == null OR $expense_id == '') OR(!isset($exp_id) OR $exp_id !== $expense_id OR $exp_id == null OR $exp_id == '')){

             show_404();
            exit();
          }
          if(!in_array("View Expense List",$role1)) {
          $msg = $session_data['username']." ".'Try To Download Expense Invoice For'." ".$property_name." ".'Property And Expense Title Named'." ".$expense_title." ".'With Ledger Number'." ".$ledger_number." ". '.This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
          redirect('Admin/auth_error');
          }   

         $prop_access_array = explode(",",$data['prop_access']);
        
        $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
              $msg = $session_data['username']." ".'Try To Download Expense Invoice For'." ".$property_name." ".'Property And Expense Title Named'." ".$expense_title." ".'With Ledger Number'." ".$ledger_number." ". '.This Property Access is Not Given to the'." ".$session_data['username'].'.';
              $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
              redirect('Admin/auth_error');
            }

          if(!empty($expense_id)){
            //load download helper
            $this->load->helper('download');
            
            //get file info from database
            $fileInfo = $this->expense_model->download_detail($expense_id);

            $fileInfo1 = base64_decode($fileInfo);
            
            //file path
            $file = file_get_contents(base_url().'assets/images/uploads/invoice_upload/expense/'.$fileInfo1);

            $msg = $session_data['username']." ".'Downloaded Expense Invoice For'." ".$property_name." ".'Property And Expense Title Named'." ".$expense_title." ".'With Ledger Number'." ".$ledger_number;
            $this->user_activity_model->add('download_document',$msg,$session_data['username'],$session_data['admin_id']);   

            //download file from directory
            force_download($fileInfo1, $file);
            redirect('Expense/view_expense_detail/'.$this->security->xss_clean($expense_id));
        }
    }

    public function delete_expense_detail(){

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
        $expense_id = base64_decode($this->uri->segment(3));

        $data['expense']=$this->expense_model->view_expense_detail($expense_id);

         foreach($data['expense'] as $expense){
          $invoice_upload = $expense['invoice_upload'];
          $property_id = $expense['property_id'];
          $property_name = $expense['property_name'];
          $expense_title = $expense['expense_title'];
          $ledger_number = $expense['expense_ledger_number'];
          $exp_id = $expense['expense_id'];
        }


       if(($expense_id == null OR $expense_id == '') OR(!isset($exp_id) OR $exp_id !== $expense_id OR $exp_id == null OR $exp_id == '')){

             show_404();
            exit();
          }
          if(!in_array("View Expense List",$role1)) {
          $msg = $session_data['username']." ".'Try To Delete Expense Details For'." ".$property_name." ".'Property And Expense Title Named'." ".$expense_title." ".'With Ledger Number'." ".$ledger_number." ". '.This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
          redirect('Admin/auth_error');
          }   

         $prop_access_array = explode(",",$data['prop_access']);

        $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
              $msg = $session_data['username']." ".'Try To Delete Expense Details For'." ".$property_name." ".'Property And Expense Title Named'." ".$expense_title." ".'With Ledger Number'." ".$ledger_number." ". '.This Property Access is Not Given to the'." ".$session_data['username'].'.';
              $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
              redirect('Admin/auth_error');
            }

       $ipath = ('assets/images/uploads/invoice_upload/expense/'.base64_decode($invoice_upload));
       unlink($ipath);

        $this->expense_model->delete_expense($expense_id);
        $this->session->set_flashdata("delete_expense","Expense Details Deleted successfully.");
        $msg = $session_data['username']." ".'Deleted Expense Details For'." ".$property_name." ".'Property And Expense Title Named'." ".$expense_title." ".'With Ledger Number'." ".$ledger_number;
        $this->user_activity_model->add('deleted',$msg,$session_data['username'],$session_data['admin_id']);    
        redirect("Expense/view_expense_list","refresh");
    }




    public function recurring_expense_list(){
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

          if(!in_array("Recurring Expense List",$role1)) {
           $msg = $session_data['username']." ".'Try To Access Recurring Expense List Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
          redirect('Admin/auth_error');
          }   

        $data['expense_list'] = $this->expense_model->view_recurring_expense();
        $data['property'] = $this->expense_model->view_property_for_filter();
        $msg = $session_data['username']." ".'Visited Recurring Expense List Page.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
    	  $this->load->view('recurring_expense_list',$this->security->xss_clean($data));
    }

    public function filter_recurring_expense()
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

          if(!in_array("Recurring Expense List",$role1)) {
          redirect('Admin/auth_error');
          }   
          
        //$data['property'] = $this->expense_model->view_property();
        $data['property'] = $this->expense_model->view_property_for_filter();
        $date="";
        if(!empty($this->input->post('date'))){
            $date = date("Y-m-d", strtotime($this->input->post('date')));
        }
        $property = $this->input->post('property_name');
    

        if($date !== "" AND $property !== ""){
        $query1 = $this->db->join('property_master', 'expense_master.property_id=property_master.property_id');       
        $query1 = $this->db->join('user_master', 'expense_master.expense_source_party=user_master.user_id');
        $this->db->order_by('expense_id','desc');
         $query1 = $this->db->get_where('expense_master',array('recurring_expense' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",'Yes')),'next_recurring_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$date)),'expense_master.property_id'=>$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$property))));
         $data['expense_list']  = $query1->result_array();
         $this->load->view('recurring_expense_list',$this->security->xss_clean($data));
        }

        else if($date !== "" AND $property == ""){
          $query1 = $this->db->join('property_master', 'expense_master.property_id=property_master.property_id');       
         $query1 = $this->db->join('user_master', 'expense_master.expense_source_party=user_master.user_id');
        $this->db->order_by('expense_id','desc');
         $query1 = $this->db->get_where('expense_master',array('recurring_expense' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",'Yes')),'next_recurring_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$date))));
         $data['expense_list']  = $query1->result_array();
         $this->load->view('recurring_expense_list',$this->security->xss_clean($data));
        }

        else if($date == "" AND $property !== ""){
          $query1 = $this->db->join('property_master', 'expense_master.property_id=property_master.property_id');        
         $query1 = $this->db->join('user_master', 'expense_master.expense_source_party=user_master.user_id');
       $this->db->order_by('expense_id','desc');
         $query1 = $this->db->get_where('expense_master',array('recurring_expense' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",'Yes')),'expense_master.property_id'=>$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$property))));
         $data['expense_list']  = $query1->result_array();
         $this->load->view('recurring_expense_list',$this->security->xss_clean($data));
        } else {
        $this->session->set_flashdata("select_data","Please Select Any Filter Field For Search");
            redirect('Expense/recurring_expense_list/',$this->security->xss_clean($data));
        }

    }
}    