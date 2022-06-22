<?php

class Lease extends CI_Controller {

    public function __construct() {
    	 parent::__construct();
    	$this->load->helper(array('form', 'url','security'));
      $this->load->library(array('form_validation','session'));   
      $this->load->model('lease_model');    
      $this->load->model('user_activity_model');  
      error_reporting(0);

    }

    public function lease_own(){
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

	        if(!in_array("Rent Payable",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Rent Payable Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);       
	        redirect('Admin/auth_error');
	        }      	

            $data['lessor'] = $this->lease_model->get_lessor();
            $data['property'] = $this->lease_model->get_property_lease_own();
            $data['contract_status'] = $this->lease_model->get_lease_own_contract_status();
            $msg = $session_data['username']." ".'Visited Rent Payable Page.';
            $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
    	      $this->load->view('lease_own',$this->security->xss_clean($data));
    }

    public function lease_own_redirect(){
    

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

	        if(!in_array("Rent Payable",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Rent Payable Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);     
	        redirect('Admin/auth_error');
	        }      

        $data['lessor'] = $this->lease_model->get_lessor();
        $data['property'] = $this->lease_model->get_property_lease_own();
        $data['contract_status'] = $this->lease_model->get_lease_own_contract_status();

         $this->form_validation->set_rules('property_name','Property Name','required');
         $this->form_validation->set_rules('lessor_name[]','Lessor Name','required');
         $this->form_validation->set_rules('start_date','Start Date','required');
         $this->form_validation->set_rules('end_date','End Date','required');

         if($this->input->post('payment_type') == 'Yearly'){
            $this->form_validation->set_rules('payment_date','Payment Date','required');
         }else{
            $this->form_validation->set_rules('payment_date1','Payment Date','required');
         }
         $this->form_validation->set_rules('lease_amount','Lease Amount','required|numeric');
         $this->form_validation->set_rules('increment_type','Lease Increment Type','required');
         $this->form_validation->set_rules('lease_increment','Lease Increment','required|numeric');
         $this->form_validation->set_rules('month_lease_increment','Lease Increment Month','required|numeric|regex_match[/^[0-12]{1,2}$/]');
         $this->form_validation->set_rules('lease_area','Area Taken on Lease','required');
         $this->form_validation->set_rules('unit','Property Unit','required');
         $this->form_validation->set_rules('lease_security_deposit','Lease Security Deposit','required|numeric');
         $this->form_validation->set_rules('lease_contract_status','Lease Contract Status','required');
         $this->form_validation->set_rules('lease_terms','Lease Terms','required');
        

         if (empty($_FILES['lease_contract_upload']['name']))
        {
          $this->form_validation->set_rules('lease_contract_upload', 'Lease Contract Upload', 'required');
        }

        $data['prop_data'] = $this->lease_model->get_selected_property($this->input->post('property_name'));

         foreach($data['prop_data'] as $property_data){

            $property_name = $property_data['property_name'];
         }   

        //Code for Stopping Multiple Entry if Lease is ongoing
         if(!empty($this->lease_model->get_inserted_lease_own_data($this->input->post('property_name')))){
              $lease_own = $this->lease_model->get_inserted_lease_own_data($this->input->post('property_name'));
             foreach ($lease_own as $own) {
              $current_date = date('Y-m-d');
              if($own['property_id'] == $this->input->post('property_name') AND $own['end_date'] >= $current_date){

                 $this->session->set_flashdata("check_lease_own_inserted","Rent Payable Data Can't Added For Particular Property Because Rent Payable Data is  Exists for Same");
                        
                        if(in_array("View Rent Payable List",$role1)) {
                         $msg = $session_data['username']." ".'Try To Insert Rent Payable Data For'." ".$property_name." ".'But Rent Payable Data Cannot Added For Particular Property Because Rent Payable Data is  Exists for Same.';
                        $this->user_activity_model->add('not_added',$msg,$session_data['username'],$session_data['admin_id']);         
                        redirect("Lease/lease_own_report","refresh",$this->security->xss_clean($data));
                      } else {
                        $msg = $session_data['username']." ".'Try To Insert Rent Payable Data For'." ".$property_name." ".'But Rent Payable Data Cannot Added For Particular Property Because Rent Payable Data is  Exists for Same.';
                        $this->user_activity_model->add('not_added',$msg,$session_data['username'],$session_data['admin_id']);   
                        redirect("Lease/lease_own","refresh",$this->security->xss_clean($data));
                      }

              }
            }
        }

        if($this->form_validation->run() === FALSE)
        {
            $this->load->view('lease_own',$this->security->xss_clean($data));
        }
        else{

          if($this->input->post('payment_type') == 'Monthly'){
            $payment_date = $this->input->post('payment_date1');
          }else{
            $payment_date = date("Y-m-d", strtotime($this->input->post('payment_date')));
          }


        	$financial_status = 'Leased';
            $financial_status_id = $this->lease_model->get_property_financial_status($financial_status);

            foreach($financial_status_id as $id){
                $financial_id = $id;
            }

           $lessor_name = '';
                for($i=0 ;$i < count($this->input->post('lessor_name'));$i++){
                    $lessor_name = implode(",",$this->input->post('lessor_name'));
                }


                $lease_contract_upload = $_FILES['lease_contract_upload']['name'];

                    if($lease_contract_upload !== ""){

                        $lease_contract_upload = str_replace(' ', '_', $lease_contract_upload);

                            $config['file_name'] =$lease_contract_upload;
                            $config['upload_path'] = './assets/images/uploads/lease/lease_own';
                            $config['allowed_types'] = 'zip|jpeg|jpg|png|pdf|JPEG|JPG|PNG|PDF|rar';
                            $config['max_size'] = '20000';
                            $config['encrypt_name'] = TRUE;
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            if (!$this->upload->do_upload('lease_contract_upload')) {
                                $error = array('error' => $this->upload->display_errors());
                                
                               $this->session->set_flashdata('new_in',2);
                              $this->load->view("lease_own",$data);
                            } else {
                                $data1 = array('upload_data' => $this->upload->data());
                                //$file_name = $upload_data['file_name'];

                               /* $zip = new ZipArchive;
                                $file = $data1['upload_data']['full_path'];
                                chmod($file,0777);
                                if ($zip->open($file) === TRUE) {
                                        $zip->extractTo('./assets/images/uploads/lease/lease_own');
                                        $zip->close();
                                        //echo 'ok';
                                } else {
                                        //echo 'failed';
                                }*/
                               
                                $this->lease_model->add_lease_own($data1['upload_data']['file_name'],$lessor_name,$financial_id,$payment_date);
                                $insert_id = $this->db->insert_id();
                                $lessor_name1 = array();
                                   for($i=0; $i< count($this->input->post('lessor_name'));$i++){
                                   	  $lessor_name1 = $this->input->post('lessor_name')[$i];
                                   
								            $data = array(              
								                'lease_own_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$insert_id)),
								                'lessor_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$lessor_name1)),
								                'lease_own_lessor_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
								            );					                  

					                    $this->lease_model->add_lease_own_lessor($data);
					                }
					                
                                 $this->session->set_flashdata("add_lease_own","Lease Own Details Added Successfully");
                                 $msg = $session_data['username']." ".'Added Rent Payable Data For Property Named'." ".$property_name.'.';
                                 $this->user_activity_model->add('added',$msg,$session_data['username'],$session_data['admin_id']);
                                if(in_array("View Rent Payable List",$role1)) {
                                  redirect("Lease/lease_own_report");
                                } else {
                                  redirect("Lease/lease_own");
                                }
                            }

                        }
                    
                
        }   
    }

     public function lease_own_installment(){
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

	        if(!in_array("Rent Payable Installments",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Rent Payable Installment Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);        
	        redirect('Admin/auth_error');
	        }      
      $data['lease_own'] = $this->lease_model->get_lease_own_detail();  
      $msg = $session_data['username']." ".'Visited Rent Payable Installment Page.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
    	$this->load->view('lease_own_installment',$this->security->xss_clean($data));
    }

    public function rent_payable_installment_filter(){

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

	        if(!in_array("Rent Payable Installments",$role1)) {
	        redirect('Admin/auth_error');
	        }      


        $data['lease_own'] = $this->lease_model->get_lease_own_detail(); 

    	 if($this->input->post('payment_type') == 'Monthly'){

    	 	 $this->form_validation->set_rules('payment_start_day','Payment Start Day','required');
       		 $this->form_validation->set_rules('payment_end_day','Payment End Day','required');

       		 if($this->form_validation->run() == FALSE){

       		 	$this->load->view('lease_own_installment',$this->security->xss_clean($data));

       		 } else {


	            //$payment_start_day = $this->input->post('payment_start_day');
	            //$payment_end_day = $this->input->post('payment_end_day');

              if($this->input->post('payment_start_day') <= '09'){

                  $payment_start_day = substr($this->input->post('payment_start_day'), 1); 

              } else {

                $payment_start_day = $this->input->post('payment_start_day'); 
              }

               if($this->input->post('payment_end_day') <= '09'){

                  $payment_end_day = substr($this->input->post('payment_end_day'), 1); 

              } else {

                $payment_end_day = $this->input->post('payment_end_day'); 
              }

	            $this->db->select("lease_own_id,lease_own_master.property_id,lessor_name,lease_amount,start_date,end_date,lease_contract_status,lease_increment,lease_increment_month,lease_increment_type,payment_date,payment_type,lease_payment_status,property_master.property_id,property_name,user_master.user_id,user_master.username"); 
		         $this->db->from('lease_own_master');   
		        $this->db->join('property_master', 'lease_own_master.property_id=property_master.property_id');    
		        $this->db->join('user_master', 'lease_own_master.lessor_name=user_master.user_id');
		        $this->db->order_by('lease_own_id','desc');		        
            $this->db->where("lease_own_master.payment_date BETWEEN ".$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$payment_start_day))." AND ".$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$payment_end_day))."");
            $this->db->where('lease_own_master.payment_type', $this->db->escape_str("Monthly"));

		        $query1 = $this->db->get('');

                $data['lease_own']  = $query1->result_array();


	            $this->load->view('lease_own_installment',$this->security->xss_clean($data));


       		 }
          }else{

          	$this->form_validation->set_rules('payment_start_day1','Payment Start Date','required');
       		$this->form_validation->set_rules('payment_end_day1','Payment End Date','required');

       		 if($this->form_validation->run() == FALSE){

       		 	$this->load->view('lease_own_installment',$this->security->xss_clean($data));

       		 } else { 	

		            $payment_start_day1 = date("Y-m-d", strtotime($this->input->post('payment_start_day1')));
		            $payment_end_day1= date("Y-m-d", strtotime($this->input->post('payment_end_day1')));

		            $this->db->select("lease_own_id,lease_own_master.property_id,lessor_name,lease_amount,start_date,end_date,lease_contract_status,lease_increment,lease_increment_month,lease_increment_type,payment_date,payment_type,lease_payment_status,property_master.property_id,property_name,user_master.user_id,user_master.username"); 
			        $this->db->from('lease_own_master');   
			        $this->db->join('property_master', 'lease_own_master.property_id=property_master.property_id');    
			        $this->db->join('user_master', 'lease_own_master.lessor_name=user_master.user_id');
			        $this->db->order_by('lease_own_id','desc');

			        $this->db->where('lease_own_master.payment_date >=', $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$payment_start_day1)));
                    $this->db->where('lease_own_master.payment_date <=', $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$payment_end_day1)));
                    $this->db->where('lease_own_master.payment_type', $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ","Yearly")));


			        $query1 = $this->db->get('');

                    $data['lease_own']  = $query1->result_array();

		            $this->load->view('lease_own_installment',$this->security->xss_clean($data));

		        }   
           } 

    }


     public function lease_own_installment_paid(){

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

         $lease_own_id = base64_decode($this->uri->segment(3));
         
        $data['lease_own'] = $this->lease_model->get_lease_own_data($lease_own_id);
        $prop_access_array = explode(",",$data['prop_access']);

        foreach($data['lease_own'] as $own){
          $contract_upload = $own['contract_upload'];
          $property_id = $own['property_id'];
          $property_name = $own['property_name'];
          $own_lease_id = $own['lease_own_id'];
        }

         if(($lease_own_id == null OR $lease_own_id == '') OR (!isset($own_lease_id) OR $own_lease_id !== $lease_own_id OR $own_lease_id == null OR $own_lease_id == '')){

           show_404();
          exit();
          }

	        if(!in_array("Rent Payable Installments",$role1)) {

          $msg = $session_data['username']." ".'Try to Pay Installment For Rent Payable on'." ".$property_name." ".'Property.That Page Access is Not Given to'." ".$session_data['username'].'.';  
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  

	        redirect('Admin/auth_error');
	        }      

         $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
              $msg = $session_data['username']." ".'Try to Pay Installment For Rent Payable on'." ".$property_name." ".'Property.Which Property Access is Not Given to'." ".$session_data['username'].'.';  
              $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);

              redirect('Admin/auth_error');
            }

        if($this->input->post('payment_type') == 'Monthly'){
            $payment_date = $this->input->post('payment_date1');
          }else{
            $payment_date = date("Y-m-d", strtotime($this->input->post('payment_date')));
           
            $lease_own_id = $this->input->post('lease_own_id');
            $data['lease_own'] = $this->lease_model->get_lease_own_data($lease_own_id);

            foreach($data['lease_own'] as $own){

              if($own['payment_date'] == $payment_date){

                $this->session->set_flashdata("installment_pay_fail","Payment Date is not Same As Old Payment Date");
                $msg = $session_data['username']." ".'Try to Pay the Rent Payable Installment For'." ".$property_name." ".'Property.But Installment cannot be Paid because Payment Date cannot be Same As Old Payment Date';  
                $this->user_activity_model->add('installment_not_paid',$msg,$session_data['username'],$session_data['admin_id']); 
                redirect("Lease/lease_own_installment","refresh");

              }

            }
         }  


        $this->lease_model->add_lease_own_installment_detail($lease_own_id);
        $this->lease_model->update_lease_own_data($lease_own_id,$payment_date);
        $this->session->set_flashdata("lease_own_installment","Rent Payable Installment Paid Successfully");
        $msg = $session_data['username']." ".'Paid the Rent Payable Installment For'." ".$property_name." ".'Property.';  
        $this->user_activity_model->add('installment_pay',$msg,$session_data['username'],$session_data['admin_id']); 
        redirect('Lease/lease_own_installment',"refresh");

     } 

     public function view_lease_own_installments_history(){

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

         $lease_own_id = base64_decode($this->uri->segment(3));
        $data['lease_own_installments'] = $this->lease_model->get_lease_own_installment_detail($lease_own_id);
        $data['lease_own'] = $this->lease_model->get_lease_own_data($lease_own_id);

        foreach($data['lease_own'] as $lease_own){

          $property_name = $lease_own['property_name'];
          $own_lease_id = $lease_own['lease_own_id'];

        }

         if(($lease_own_id == null OR $lease_own_id == '') OR (!isset($own_lease_id) OR $own_lease_id !== $lease_own_id OR $own_lease_id == null OR $own_lease_id == '')){

           show_404();
          exit();
          }

	        if(!in_array("Rent Payable Installments",$role1)) {
          $msg = $session_data['username']." ".'Try to View Rent Payable Installment Details For'." ".$property_name." ".'Property.View Rent Payable Installment Page Access is Not Given to'." ".$session_data['username'].'.'; 
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);      
	        redirect('Admin/auth_error');
	        }      


        $prop_access_array = explode(",",$data['prop_access']);

       foreach($data['lease_own'] as $own){
          $property_id = $own['property_id'];
          $contract_upload = $own['contract_upload'];
          
        }

         $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
              $msg = $session_data['username']." ".'Try to View Rent Payable Installment Details For'." ".$property_name." ".'Property.That Property Access is Not Given to'." ".$session_data['username'].'.'; 
              $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
              redirect('Admin/auth_error');
            }
        $msg = $session_data['username']." ".'Visited View Rent Payable Installment Details Page For'." ".$property_name." ".'Property.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);    
        $this->load->view('view_lease_own_installments',$this->security->xss_clean($data));

     } 

    public function lease_own_report(){
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

	        if(!in_array("View Rent Payable List",$role1)) {
          $msg = $session_data['username']." ".'Try To Access View Rent Payable List Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
	        redirect('Admin/auth_error');
	        }      

        $data['lease_own'] = $this->lease_model->get_lease_own_detail();
         $data['lease_own_lessor'] = $this->lease_model->get_lease_own_lessor_detail();
        //$data['property'] = $this->lease_model->get_property();
         $data['property'] = $this->lease_model->view_property_for_filter();
         $msg = $session_data['username']." ".'Visited View Rent Payable List Page.';
         $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
    	   $this->load->view('lease_own_report',$this->security->xss_clean($data));
    }

    public function delete_lease_own_detail(){
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

         $lease_own_id = base64_decode($this->uri->segment(3));

         $data['lease_own'] = $this->lease_model->get_lease_own_data($lease_own_id);

         foreach($data['lease_own'] as $own){
          $contract_upload = $own['contract_upload'];
          $property_id = $own['property_id'];
          $property_name = $own['property_name'];
          $own_lease_id = $own['lease_own_id'];

        }

         if(($lease_own_id == null OR $lease_own_id == '') OR (!isset($own_lease_id) OR $own_lease_id !== $lease_own_id OR $own_lease_id == null OR $own_lease_id == '')){

           show_404();
          exit();
          }


	        if(!in_array("View Rent Payable List",$role1)) {
          $msg = $session_data['username']." ".'Try To Delete Rent Payable Details For'." ".$property_name." ".'Property.This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);     
	        redirect('Admin/auth_error');
	        }      

        $prop_access_array = explode(",",$data['prop_access']);

         $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
              $msg = $session_data['username']." ".'Try To Delete Rent Payable Details For'." ".$property_name." ".'Property.This Property Access is Not Given to the'." ".$session_data['username'].'.';
              $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 
              redirect('Admin/auth_error');
            }

       $ipath = ('assets/images/uploads/lease/lease_own/'.base64_decode($contract_upload));
       unlink($ipath);
       $this->lease_model->delete_lease_own_installment($lease_own_id);
        $this->lease_model->delete_lease_own_lessor($lease_own_id);
        $this->lease_model->delete_lease_own($lease_own_id);
        $this->session->set_flashdata("delete_lease_own","Lease Own Details Deleted successfully.");
        $msg = $data['username']." ".'Deleted Rent Payable Details For'." ".$property_name." ".'Property.';
        $this->user_activity_model->add('deleted',$msg,$data['username'],$data['admin_id']);
        redirect("Lease/lease_own_report","refresh");
    }

    public function filter_lease_own()
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

	        if(!in_array("View Rent Payable List",$role1)) {
	        redirect('Admin/auth_error');
	        }      

         $data['lease_own'] = $this->lease_model->get_lease_own_detail();
          $data['lease_own_lessor'] = $this->lease_model->get_lease_own_lessor_detail();
          //$data['property'] = $this->lease_model->get_property();
          $data['property'] = $this->lease_model->view_property_for_filter();
        $date="";
        if(!empty($this->input->post('date'))){
            $date = date("Y-m-d", strtotime($this->input->post('date')));
        }
        $property = $this->input->post('property_name');

        if($property !== ""){
          $query1 = $this->db->join('property_master', 'lease_own_master.property_id=property_master.property_id');    
        $this->db->order_by('lease_own_id','desc');
         $query1 = $this->db->get_where('lease_own_master',array('lease_own_master.property_id'=>$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$property))));
         $data['lease_own']  = $query1->result_array();
         $this->load->view('lease_own_report',$this->security->xss_clean($data));

        } else {
          $this->session->set_flashdata("select_data","Please Select Any Filter Field For Search");
            redirect('Lease/lease_own_report/',$this->security->xss_clean($data));
        }  
    }

    public function view_lease_own_data(){
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

        $lease_own_id = base64_decode($this->uri->segment(3));
        $data['lease_own'] = $this->lease_model->get_lease_own_data($lease_own_id);


        foreach($data['lease_own'] as $own){
          $property_id = $own['property_id'];
          $property_name = $own['property_name'];
          $own_lease_id = $own['lease_own_id'];

        }

         if(($lease_own_id == null OR $lease_own_id == '') OR (!isset($own_lease_id) OR $own_lease_id !== $lease_own_id OR $own_lease_id == null OR $own_lease_id == '')){

           show_404();
          exit();
          }

	        if(!in_array("View Rent Payable List",$role1)) {
          $msg = $session_data['username']." ".'Try To View Rent Payable Data For'." ".$property_name." ".'View Rent Payable Detail Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);      
	        redirect('Admin/auth_error');
	        }      

         $prop_access_array = explode(",",$data['prop_access']);

         $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
              $msg = $session_data['username']." ".'Try To View Rent Payable Data For'." ".$property_name." ".'This Property Access is Not Given to the'." ".$session_data['username'].'.';
              $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
              redirect('Admin/auth_error');
            }
         $data['lease_own_lessor'] = $this->lease_model->get_lease_own_lessor_detail();
      $msg = $data['username']." ".'Viewed Rent Payable Details For'." ".$property_name." ".'Property.';
      $this->user_activity_model->add('viewed',$msg,$data['username'],$data['admin_id']);  
    	$this->load->view('view_lease_own_data',$this->security->xss_clean($data));
    }

    public function download_lease_own_contract(){

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

        $lease_own_id = base64_decode($this->uri->segment(3));
        $data['lease_own'] = $this->lease_model->get_lease_own_data($lease_own_id);

         foreach($data['lease_own'] as $own){
          $property_id = $own['property_id'];
          $property_name = $own['property_name'];
          $own_lease_id = $own['lease_own_id'];

        }

         if(($lease_own_id == null OR $lease_own_id == '') OR (!isset($own_lease_id) OR $own_lease_id !== $lease_own_id OR $own_lease_id == null OR $own_lease_id == '')){

           show_404();
          exit();
          }

	        if(!in_array("View Rent Payable List",$role1)) {

          $msg = $session_data['username']." ".'Try To Download Rent Payable Document for'." ".$property_name." ".'Download Rent Payable Document Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  

	        redirect('Admin/auth_error');
	        }      

        $prop_access_array = explode(",",$data['prop_access']);

         $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){

              $msg = $session_data['username']." ".'Try To Download Rent Payable Document for'." ".$property_name." ".'This Property Access is Not Given to the'." ".$session_data['username'].'.';
              $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 
              redirect('Admin/auth_error');
            }

          if(!empty($lease_own_id)){
            //load download helper
            $this->load->helper('download');
            
            //get file info from database
            $fileInfo = $this->lease_model->download_detail($lease_own_id);

            $fileInfo1 = base64_decode($fileInfo);
            
            //file path
            $file = file_get_contents(base_url().'assets/images/uploads/lease/lease_own/'.$fileInfo1);

            $msg = $data['username']." ".'Downloaded Rent Payable Document For'." ".$property_name." ".'Property.';
            $this->user_activity_model->add('download_document',$msg,$data['username'],$data['admin_id']);

            //download file from directory
            force_download($fileInfo1, $file);
            redirect('Lease/view_lease_own_data/'.$this->security->xss_clean($lease_own_id));
        }
    }

    public function lease_given(){
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

	        if(!in_array("Rent Receivable",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Rent Receivable Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
	        redirect('Admin/auth_error');
	        }      

         $data['lesse'] = $this->lease_model->get_lesse();
        $data['property'] = $this->lease_model->get_property();
        $data['contract_status'] = $this->lease_model->get_lease_given_contract_status();
      $msg = $session_data['username']." ".'Visited Rent Receivable Page.';
      $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);  
    	$this->load->view('lease_given',$this->security->xss_clean($data));
    }

    public function lease_given_redirect(){
    

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

	        if(!in_array("Rent Receivable",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Rent Receivable Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);      
	        redirect('Admin/auth_error');
	        }      
	        

        $data['lesse'] = $this->lease_model->get_lesse();
        $data['property'] = $this->lease_model->get_property();
        $data['contract_status'] = $this->lease_model->get_lease_given_contract_status();

         $this->form_validation->set_rules('property_name','Propert Name','required');
         $this->form_validation->set_rules('lessee_name[]','Lessee Name','required');
         $this->form_validation->set_rules('start_date','Start Date','required');
         $this->form_validation->set_rules('end_date','End Date','required');
          if($this->input->post('payment_type') == 'Yearly'){
            $this->form_validation->set_rules('payment_date','Payment Date','required');
         }else{
            $this->form_validation->set_rules('payment_date1','Payment Date','required');
         }
         $this->form_validation->set_rules('lease_amount','Lease Amount','required|numeric');
         $this->form_validation->set_rules('increment_type','Lease Increment Type','required');
         $this->form_validation->set_rules('lease_increment','Lease Increment','required|numeric');
         $this->form_validation->set_rules('month_lease_increment','Lease Increment Month','required|numeric|regex_match[/^[0-12]{1,2}$/]');
         $this->form_validation->set_rules('lease_area','Total Area Available For Lease','required');
         $this->form_validation->set_rules('area_given_on_lease','Area Given on Lease','required|numeric');
         $this->form_validation->set_rules('unit','Unit','required');
         $this->form_validation->set_rules('lease_security_deposit','Lease Security Deposit','required|numeric');
         $this->form_validation->set_rules('lease_contract_status','Lease Contract Status','required');
         $this->form_validation->set_rules('lease_terms','Lease Terms','required');
        

         if (empty($_FILES['lease_contract_upload']['name']))
        {
          $this->form_validation->set_rules('lease_contract_upload', 'Lease Contract Upload', 'required');
        }

         $data['prop_data'] = $this->lease_model->get_selected_property($this->input->post('property_name'));

         foreach($data['prop_data'] as $property_data){

            $property_name = $property_data['property_name'];
         }   

         //Code for Stopping Multiple Entry if Lease is ongoing
         if(!empty($this->lease_model->get_inserted_lease_given_data($this->input->post('property_name')))){
              $lease_given = $this->lease_model->get_inserted_lease_given_data($this->input->post('property_name'));
             foreach ($lease_given as $own) {
              $current_date = date('Y-m-d');
              if(($own['property_id'] == $this->input->post('property_name') AND $own['rent_receivable_available_unit'] == 0.00)){

                 $this->session->set_flashdata("check_lease_given_inserted","Rent Receivable Can't Added For Particular Property Because No Area is Available for Assign");
                        
                   if(in_array("View Rent Receivable List",$role1)) {
                      $msg = $session_data['username']." ".'Try To Insert Rent Receivable Data For'." ".$property_name." ".'But Rent Receivable Data Cannot Added For Particular Property Because No Area is Available for Assign for That Property.';
                      $this->user_activity_model->add('not_added',$msg,$session_data['username'],$session_data['admin_id']); 
                      redirect("Lease/lease_given_report","refresh",$this->security->xss_clean($data));
                    } else {
                      $msg = $session_data['username']." ".'Try To Insert Rent Receivable Data For'." ".$property_name." ".'But Rent Receivable Data Cannot Added For Particular Property Because No Area is Available for Assign for That Property.';
                      $this->user_activity_model->add('not_added',$msg,$session_data['username'],$session_data['admin_id']);
                      redirect("Lease/lease_given","refresh",$this->security->xss_clean($data));
                    }

              }
            }
        }

        if($this->form_validation->run() === FALSE)
        {
            $this->load->view('lease_given',$this->security->xss_clean($data));
        }
        else{

            if($this->input->post('payment_type') == 'Monthly'){
            $payment_date = $this->input->post('payment_date1');
          }else{
            $payment_date = date("Y-m-d", strtotime($this->input->post('payment_date')));
          }

        	$property_data = $this->lease_model->get_property_data($this->input->post('property_name'));
        		foreach($property_data as $property){
	        		if($property['financial_status'] == 'Purchased' || $property['financial_status'] == 'Purchased - Leased Given'){
	        		$financial_status = 'Purchased - Leased Given';
	            	$financial_status_id = $this->lease_model->get_property_financial_status($financial_status);
		            	foreach($financial_status_id as $id){
		               		 $financial_id = $id;
		            	}
		            }	
        	

	        	if($property['financial_status'] == 'Leased' || $property['financial_status'] == 'Leased - Subleased'){
					$financial_status = 'Leased - Subleased';
	            	$financial_status_id = $this->lease_model->get_property_financial_status($financial_status);
	            		foreach($financial_status_id as $id){
		               		 $financial_id = $id;
		            	}
	        	}
        	
        	}

           $lessee_name = '';
                for($i=0 ;$i < count($this->input->post('lessee_name'));$i++){
                    $lessee_name = implode(",",$this->input->post('lessee_name'));
                }


                $lease_contract_upload = $_FILES['lease_contract_upload']['name'];

                    if($lease_contract_upload !== ""){

                        $lease_contract_upload = str_replace(' ', '_', $lease_contract_upload);

                            $config['file_name'] =$lease_contract_upload;
                            $config['upload_path'] = './assets/images/uploads/lease/lease_given';
                            $config['allowed_types'] = 'zip|jpeg|jpg|png|pdf|JPEG|JPG|PNG|PDF|rar';
                            $config['max_size'] = '20000';
                            $config['encrypt_name'] = TRUE;
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            if (!$this->upload->do_upload('lease_contract_upload')) {
                                $error = array('error' => $this->upload->display_errors());
                                
                               $this->session->set_flashdata('new_in',2);
                               $data['lesse'] = $this->lease_model->get_lesse();
                              $this->load->view("lease_given",$this->security->xss_clean($data));
                            } else {
                                $data1 = array('upload_data' => $this->upload->data());
                                //$file_name = $upload_data['file_name'];

                               /* $zip = new ZipArchive;
                                $file = $data1['upload_data']['full_path'];
                                chmod($file,0777);
                                if ($zip->open($file) === TRUE) {
                                        $zip->extractTo('./assets/images/uploads/lease/lease_given');
                                        $zip->close();
                                        //echo 'ok';
                                } else {
                                        //echo 'failed';
                                }*/

                                $total_avail_area = $this->input->post('lease_area');
                                $total_given_area = $this->input->post('area_given_on_lease');

                                $remain_area = $total_avail_area - $total_given_area;

                                $this->lease_model->add_lease_given($data1['upload_data']['file_name'],$lessee_name,$financial_id,$payment_date);
                                $insert_id = $this->db->insert_id();
                                $this->lease_model->update_remain_property_area($this->input->post('property_name'),$remain_area);
                                $lessee_name1 = array();
                                   for($i=0; $i< count($this->input->post('lessee_name'));$i++){
                                   	  $lessee_name1 = $this->input->post('lessee_name')[$i];
                                   
								            $data = array(              
								                'lease_given_id' =>  $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$insert_id)),
								                'lessee_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$lessee_name1)),
								                'lease_given_lessee_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
								            );					                  

					                    $this->lease_model->add_lease_given_lessee($data);
					                }

                                $this->lease_model->update_property_financial_status($this->input->post('property_name'),$financial_id);
					                
                                 $this->session->set_flashdata("add_lease_given","Lease Given Details Added Successfully");
                                 $msg = $session_data['username']." ".'Added Rent Receivable Data For Property Named'." ".$property_name.'.';
                                 $this->user_activity_model->add('added',$msg,$session_data['username'],$session_data['admin_id']);
                                if(in_array("View Rent Receivable List",$role1)) {
                                  redirect("Lease/lease_given_report");
                                } else {
                                  redirect("Lease/lease_given");
                                }
                            }

                        }
                    
                
        }   
    }

    public function lease_given_installment(){
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

	        if(!in_array("Rent Receivable Installments",$role1)) {

          $msg = $session_data['username']." ".'Try To Access Rent Receivable Installment Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
	        redirect('Admin/auth_error');
	        }      
	        

       $data['lease_given'] = $this->lease_model->get_lease_given_detail(); 
       $msg = $session_data['username']." ".'Visited Rent Receivable Installment Page.';
       $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']); 
    	$this->load->view('lease_given_installment',$this->security->xss_clean($data));
    }

     public function rent_receivable_installment_filter(){

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

	        if(!in_array("Rent Receivable Installments",$role1)) {
	        redirect('Admin/auth_error');
	        }     


        $data['lease_given'] = $this->lease_model->get_lease_given_detail();  

    	 if($this->input->post('payment_type') == 'Monthly'){

    	 	 $this->form_validation->set_rules('payment_start_day','Payment Start Day','required');
       		 $this->form_validation->set_rules('payment_end_day','Payment End Day','required');

       		 if($this->form_validation->run() == FALSE){

       		 	$this->load->view('lease_given_installment',$this->security->xss_clean($data));

       		    } else {

	            if($this->input->post('payment_start_day') <= '09'){

                 $payment_start_day = substr($this->input->post('payment_start_day'), 1); 

              } else {

                $payment_start_day = $this->input->post('payment_start_day'); 

              }

               if($this->input->post('payment_end_day') <= '09'){

                  $payment_end_day = substr($this->input->post('payment_end_day'), 1); 

              } else {

                $payment_end_day = $this->input->post('payment_end_day'); 
              }

	            $this->db->select("lease_given_id,lease_given_master.property_id,lessee_name,lease_amount,start_date,end_date,lease_contract_status,payment_date,property_master.property_id,property_master.financial_status_id,property_financial_status_master.financial_status_id,lease_increment,property_financial_status_master.financial_status,lease_increment_month,lease_increment_type,payment_type,lease_payment_status,property_name,user_master.user_id,user_master.username,property_master.mark_property_as_sold"); 
		          $this->db->from('lease_given_master');   
		          $this->db->join('property_master', 'lease_given_master.property_id=property_master.property_id');    
		          $this->db->join('property_financial_status_master', 'property_master.financial_status_id=property_financial_status_master.financial_status_id');
		          $this->db->join('user_master', 'lease_given_master.lessee_name=user_master.user_id');
		          $this->db->order_by('lease_given_id','desc');
              $this->db->where('lease_given_master.payment_date BETWEEN '.$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$payment_start_day)).' AND '.$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$payment_end_day)).'');
              $this->db->where('lease_given_master.payment_type', $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ","Monthly")));

		          $query1 = $this->db->get('');

              $data['lease_given']  = $query1->result_array();


	            $this->load->view('lease_given_installment',$this->security->xss_clean($data));


       		 }
          }else{

          	$this->form_validation->set_rules('payment_start_day1','Payment Start Date','required');
       		$this->form_validation->set_rules('payment_end_day1','Payment End Date','required');

       		 if($this->form_validation->run() == FALSE){

       		 	$this->load->view('lease_given_installment',$this->security->xss_clean($data));

       		 } else { 	

		            $payment_start_day1 = date("Y-m-d", strtotime($this->input->post('payment_start_day1')));
		            $payment_end_day1= date("Y-m-d", strtotime($this->input->post('payment_end_day1')));

		            $this->db->select("lease_given_id,lease_given_master.property_id,lessee_name,lease_amount,start_date,end_date,lease_contract_status,payment_date,property_master.property_id,property_master.financial_status_id,property_financial_status_master.financial_status_id,lease_increment,property_financial_status_master.financial_status,lease_increment_month,lease_increment_type,payment_type,lease_payment_status,property_name,user_master.user_id,user_master.username,property_master.mark_property_as_sold"); 
			         $this->db->from('lease_given_master');   
			        $this->db->join('property_master', 'lease_given_master.property_id=property_master.property_id');    
			        $this->db->join('property_financial_status_master', 'property_master.financial_status_id=property_financial_status_master.financial_status_id');
			        $this->db->join('user_master', 'lease_given_master.lessee_name=user_master.user_id');
			        $this->db->order_by('lease_given_id','desc');
			        $this->db->where('lease_given_master.payment_date >=', $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$payment_start_day1)));
                    $this->db->where('lease_given_master.payment_date <=', $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$payment_end_day1)));
                    $this->db->where('lease_given_master.payment_type', $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ","Yearly")));


			        $query1 = $this->db->get('');

                    $data['lease_given']  = $query1->result_array();

		           $this->load->view('lease_given_installment',$this->security->xss_clean($data));

		        }   
           } 

    }

    public function lease_given_installment_paid(){

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

        $lease_given_id = base64_decode($this->uri->segment(3));
        $data['lease_given'] = $this->lease_model->get_lease_given_data($lease_given_id);

        foreach($data['lease_given'] as $own){
          $property_id = $own['property_id'];
          $property_name = $own['property_name'];
          $given_lease_id = $own['lease_given_id'];

        }

         if(($lease_given_id == null OR $lease_given_id == '') OR (!isset($given_lease_id) OR $given_lease_id !== $lease_given_id OR $given_lease_id == null OR $given_lease_id == '')){

           show_404();
          exit();
          }

	        if(!in_array("Rent Receivable Installments",$role1)) {

          $msg = $session_data['username']." ".'Try to Pay Installment For Rent Receivable on'." ".$property_name." ".'Property.That Page Access is Not Given to'." ".$session_data['username'].'.';  
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
	        redirect('Admin/auth_error');
	        }     

        $prop_access_array = explode(",",$data['prop_access']);

         $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
              $msg = $session_data['username']." ".'Try to Pay Installment For Rent Receivable on'." ".$property_name." ".'Property.Which Property Access is Not Given to'." ".$session_data['username'].'.';  
              $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);
              redirect('Admin/auth_error');
            }

       // print_r($_POST);

        if($this->input->post('payment_type') == 'Monthly'){
            $payment_date = $this->input->post('payment_date1');
          }else{
            $payment_date = date("Y-m-d", strtotime($this->input->post('payment_date')));

            $lease_given_id = $this->input->post('lease_given_id');
            $data['lease_given'] = $this->lease_model->get_lease_given_data($lease_given_id);

            foreach($data['lease_given'] as $given){

              if($given['payment_date'] == $payment_date){

                $this->session->set_flashdata("installment_pay_fail","Payment Date is not Same As Old Payment Date");
                $msg = $session_data['username']." ".'Try to Pay the Rent Receivable Installment For'." ".$property_name." ".'Property.But Installment cannot be Paid because Payment Date cannot be Same As Old Payment Date';  
                $this->user_activity_model->add('installment_not_paid',$msg,$session_data['username'],$session_data['admin_id']); 
                redirect("Lease/lease_given_installment","refresh");
              }
            }    
          }


        $this->lease_model->add_lease_given_installment_detail($lease_given_id);
        $this->lease_model->update_lease_given_data($lease_given_id,$payment_date);
        $this->session->set_flashdata("lease_given_installment","Rent Receivable Installment Paid Successfully");
        $msg = $session_data['username']." ".'Paid the Rent Receivable Installment For'." ".$property_name." ".'Property.';  
        $this->user_activity_model->add('installment_pay',$msg,$session_data['username'],$session_data['admin_id']); 
        redirect('Lease/lease_given_installment',"refresh");

     } 

     public function view_lease_given_installments_history(){

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

        $lease_given_id = base64_decode($this->uri->segment(3));

        $data['lease_given_installments'] = $this->lease_model->get_lease_given_installment_detail($lease_given_id);
        $data['lease_given'] = $this->lease_model->get_lease_given_data($lease_given_id);

        foreach($data['lease_given'] as $own){
          $property_id = $own['property_id'];
          $property_name = $own['property_name'];
          $given_lease_id = $own['lease_given_id'];

        }

         if(($lease_given_id == null OR $lease_given_id == '') OR (!isset($given_lease_id) OR $given_lease_id !== $lease_given_id OR $given_lease_id == null OR $given_lease_id == '')){

           show_404();
          exit();
          }

	        if(!in_array("Rent Receivable Installments",$role1)) {
          $msg = $session_data['username']." ".'Try to View Rent Receivable Installment Details For'." ".$property_name." ".'Property.View Rent Receivable Installment Page Access is Not Given to'." ".$session_data['username'].'.'; 
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
	        redirect('Admin/auth_error');
	        }     


        $prop_access_array = explode(",",$data['prop_access']);


         $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
              $msg = $session_data['username']." ".'Try to View Rent Receivable Installment Details For'." ".$property_name." ".'Property.That Property Access is Not Given to'." ".$session_data['username'].'.'; 
              $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
              redirect('Admin/auth_error');
            }
         $msg = $session_data['username']." ".'Visited View Rent Receivable Installment Details Page For'." ".$property_name." ".'Property.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);        
        $this->load->view('view_lease_given_installments',$this->security->xss_clean($data));

     } 


    public function lease_given_report(){
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

	        if(!in_array("View Rent Receivable List",$role1)) {
          $msg = $session_data['username']." ".'Try To Access View Rent Receivable List Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
	        redirect('Admin/auth_error');
	        }     

        $data['lease_given'] = $this->lease_model->get_lease_given_detail();
         $data['lease_given_lessee'] = $this->lease_model->get_lease_given_lessee_detail();
         $data['property'] = $this->lease_model->view_property_for_filter();
         $msg = $session_data['username']." ".'Visited View Rent Receivable List Page.';
         $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
    	   $this->load->view('lease_given_report',$this->security->xss_clean($data));
    }

    public function filter_lease_given()
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

	        if(!in_array("View Rent Receivable List",$role1)) {
	        redirect('Admin/auth_error');
	        }     

        $data['lease_given'] = $this->lease_model->get_lease_given_detail();
         $data['lease_given_lessee'] = $this->lease_model->get_lease_given_lessee_detail();
        //$data['property'] = $this->lease_model->get_property();
         $data['property'] = $this->lease_model->view_property_for_filter();
        $date="";
        if(!empty($this->input->post('date'))){
            $date = date("Y-m-d", strtotime($this->input->post('date')));
        }
        $property = $this->input->post('property_name');

        if($property !== ""){
          $query1 = $this->db->join('property_master', 'lease_given_master.property_id=property_master.property_id');    
        $this->db->order_by('lease_given_id','desc');
         $query1 = $this->db->get_where('lease_given_master',array('lease_given_master.property_id'=>$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$property))));
         $data['lease_given']  = $query1->result_array();
         $this->load->view('lease_given_report',$this->security->xss_clean($data));
        } else{
          $this->session->set_flashdata("select_data","Please Select Any Filter Field For Search");
            redirect('Lease/lease_given_report/',$this->security->xss_clean($data));
        }

    }

    public function view_lease_given_data(){
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

        $lease_given_id = base64_decode($this->uri->segment(3));

        $data['lease_given'] = $this->lease_model->get_lease_given_data($lease_given_id);

       foreach($data['lease_given'] as $own){
          $property_id = $own['property_id'];
          $property_name = $own['property_name'];
          $given_lease_id = $own['lease_given_id'];

        }

         if(($lease_given_id == null OR $lease_given_id == '') OR (!isset($given_lease_id) OR $given_lease_id !== $lease_given_id OR $given_lease_id == null OR $given_lease_id == '')){

           show_404();
          exit();
          }
	        if(!in_array("View Rent Receivable List",$role1)) {

          $msg = $session_data['username']." ".'Try To View Rent Receivable Data For'." ".$property_name." ".'View Rent Receivable Detail Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
	        redirect('Admin/auth_error');
	        }     

         $prop_access_array = explode(",",$data['prop_access']);

         $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
               $msg = $session_data['username']." ".'Try To View Rent Receivable Data For'." ".$property_name." ".'This Property Access is Not Given to the'." ".$session_data['username'].'.';
              $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);
              redirect('Admin/auth_error');
            }

         $data['lease_given_lessee'] = $this->lease_model->get_lease_given_lessee_detail();
      $msg = $data['username']." ".'Viewed Rent Receivable Details For'." ".$property_name." ".'Property.';
      $this->user_activity_model->add('viewed',$msg,$data['username'],$data['admin_id']);    
    	$this->load->view('view_lease_given_data',$this->security->xss_clean($data));
    }

    public function download_lease_given_contract(){

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

        $lease_given_id = base64_decode($this->uri->segment(3));
 
        $data['lease_given'] = $this->lease_model->get_lease_given_data($lease_given_id);
       

        foreach($data['lease_given'] as $own){
          $property_id = $own['property_id'];
          $property_name = $own['property_name'];
          $given_lease_id = $own['lease_given_id'];

        }

         if(($lease_given_id == null OR $lease_given_id == '') OR (!isset($given_lease_id) OR $given_lease_id !== $lease_given_id OR $given_lease_id == null OR $given_lease_id == '')){

           show_404();
          exit();
          }
	        if(!in_array("View Rent Receivable List",$role1)) {
          $msg = $session_data['username']." ".'Try To Download Rent Receivable Document for'." ".$property_name." ".'Download Rent Receivable Document Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
	        redirect('Admin/auth_error');
	        }    

        $prop_access_array = explode(",",$data['prop_access']);

        $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
              $msg = $session_data['username']." ".'Try To Download Rent Receivable Document for'." ".$property_name." ".'This Property Access is Not Given to the'." ".$session_data['username'].'.';
              $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 
              redirect('Admin/auth_error');
            }

          if(!empty($lease_given_id)){
            //load download helper
            $this->load->helper('download');
            
            //get file info from database
            $fileInfo = $this->lease_model->download_lease_given_contract_detail($lease_given_id);

            $fileInfo1 = base64_decode($fileInfo);
            
            //file path
            $file = file_get_contents(base_url().'assets/images/uploads/lease/lease_given/'.$fileInfo1);

            $msg = $data['username']." ".'Downloaded Rent Receivable Document For'." ".$property_name." ".'Property.';
            $this->user_activity_model->add('download_document',$msg,$data['username'],$data['admin_id']);

            //download file from directory
            force_download($fileInfo1, $file);
            redirect('Lease/view_lease_given_data/'.$this->security->xss_clean($lease_given_id));
        }
    }

     public function delete_lease_given_detail(){
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

        $lease_given_id = base64_decode($this->uri->segment(3));

        $data['lease_given'] = $this->lease_model->get_lease_given_data($lease_given_id);

        foreach($data['lease_given'] as $given){
          $contract_upload = $given['contract_upload'];
          $property_id = $given['property_id'];
          $property_contract = $given['property_contract'];
          $property_name = $given['property_name'];
          $given_lease_id = $given['lease_given_id'];

        }

         if(($lease_given_id == null OR $lease_given_id == '') OR (!isset($given_lease_id) OR $given_lease_id !== $lease_given_id OR $given_lease_id == null OR $given_lease_id == '')){

           show_404();
          exit();
          }

	        if(!in_array("View Rent Receivable List",$role1)) {
           $msg = $session_data['username']." ".'Try To Delete Rent Receivable Details For'." ".$property_name." ".'Property.This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
	        redirect('Admin/auth_error');
	        }     
     
        $prop_access_array = explode(",",$data['prop_access']);


        $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
              $msg = $session_data['username']." ".'Try To Delete Rent Receivable Details For'." ".$property_name." ".'Property.This Property Access is Not Given to the'." ".$session_data['username'].'.';
              $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);
              redirect('Admin/auth_error');
            }

        $total_avail_area = $given['area_given_on_lease_2'] + $given['rent_receivable_available_unit'];

       $ipath = ('assets/images/uploads/lease/lease_given/'.base64_decode($contract_upload));
       unlink($ipath);
       $this->lease_model->delete_lease_given_installment($lease_given_id);
        $this->lease_model->delete_lease_given_lessee($lease_given_id);
        $this->lease_model->delete_lease_given($lease_given_id);

         $this->lease_model->update_total_avail_area($property_id,$total_avail_area);

         $data['get_property_count'] = $this->lease_model->get_property_count($property_id);

          if($data['get_property_count'] == 0){

          if($property_contract == 'Lease'){

             $financial_status = 'Leased';
            $financial_status_id = $this->lease_model->get_property_financial_status($financial_status);
            foreach($financial_status_id as $id){
                $financial_id = $id;
            }
            $this->lease_model->update_financial_status($property_id,$financial_id);

          } else {

            $financial_status = 'Purchased';
            $financial_status_id = $this->lease_model->get_property_financial_status($financial_status);
            foreach($financial_status_id as $id){
                $financial_id = $id;
            }
            $this->lease_model->update_financial_status($property_id,$financial_id);
          }
        }

        $this->session->set_flashdata("delete_lease_given","Lease Given Details Deleted successfully.");
        $msg = $data['username']." ".'Deleted Rent Receivable Details For'." ".$property_name." ".'Property.';
        $this->user_activity_model->add('deleted',$msg,$data['username'],$data['admin_id']);
        redirect("Lease/lease_given_report","refresh");
    }

    public function rent_payable_contract_status(){

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

	        if(!in_array("Rent Payable Contract Status Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Rent Payable Contract Status Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
	        redirect('Admin/auth_error');
	        }     

      $data['rent_payable'] = $this->lease_model->rent_payable_status();
      $msg = $session_data['username']." ".'Visited Rent Payable Contract Status Master Page.';
      $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
      $this->load->view('rent_payable_contract_status',$this->security->xss_clean($data));

    }

        public function rent_payable_contract_status_insert(){

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

	        if(!in_array("Rent Payable Contract Status Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Rent Payable Contract Status Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
	        redirect('Admin/auth_error');
	        }    

      $data['rent_payable'] = $this->lease_model->rent_payable_status();

      $this->form_validation->set_rules('rent_payable_status','Contract Status','required'); 

       if($this->form_validation->run() == false)
        {
       
           
                 
          $this->load->view('rent_payable_contract_status',$this->security->xss_clean($data));


           
        }
        else{

            $query = $this->lease_model->insertrentpayable();
            $this->session->set_flashdata("rent_payable","Contract Status Added Successfully");
            $msg = $data['username']." ".'Added Rent Payable Contract Status Named'." " .$this->input->post('rent_payable_status'). '.';
            $this->user_activity_model->add('added',$msg,$data['username'],$data['admin_id']);
            redirect("Lease/rent_payable_contract_status","refresh",$this->security->xss_clean($data));

        }


    }

    public function rent_receivable_contract_status(){

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

	        if(!in_array("Rent Receivable Contract Status Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Rent Receivable Contract Status Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
	        redirect('Admin/auth_error');
	        }    

      $data['rent_receivable'] = $this->lease_model->rent_receivable_status();
      $msg = $session_data['username']." ".'Visited Rent Receivable Contract Status Master Page.';
      $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);   
      $this->load->view('rent_receivable_contract_status',$this->security->xss_clean($data));

    }

    public function rent_receivable_contract_status_insert(){

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

	        if(!in_array("Rent Receivable Contract Status Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Rent Receivable Contract Status Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
	        redirect('Admin/auth_error');
	        }    

      $data['rent_receivable'] = $this->lease_model->rent_receivable_status();

            $this->form_validation->set_rules('rent_receivable_status','Contract Status','required');   


       if($this->form_validation->run() == false)
        {
       
           
                 
                $this->load->view('rent_receivable_contract_status',$this->security->xss_clean($data));


           
        }
        else{

            $query = $this->lease_model->insertrentreceivable();
            $this->session->set_flashdata("rent_receivable","Contract Status Added Successfully");
            $msg = $data['username']." ".'Added Rent Receivable Contract Status Named'." " .$this->input->post('rent_receivable_status'). '.';
            $this->user_activity_model->add('added',$msg,$data['username'],$data['admin_id']);
            redirect("Lease/rent_receivable_contract_status","refresh",$this->security->xss_clean($data));

        }


    }

    public function rent_payable_status_edit(){

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

         $rent_payable_id = base64_decode($this->uri->segment(3));
         
         $data['rent_payable'] = $this->lease_model->rent_payable_data($rent_payable_id);

         foreach($data['rent_payable'] as $payable){

          $payable_status = $payable['lease_own_status'];
          $lease_own_status_id = $payable['lease_own_status_id'];

         }

          if(($rent_payable_id == null OR $rent_payable_id == '') OR (!isset($lease_own_status_id) OR $lease_own_status_id !== $rent_payable_id OR $lease_own_status_id == null OR $lease_own_status_id == '')){

           show_404();
          exit();
          }

	        if(!in_array("Rent Payable Contract Status Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Use Update Rent Payable Contract Status Detail Page For'." ".$payable_status." ".'Update Rent Payable Contract Status Detail Page Access is Not Given to the'." ".$session_data['username'].'.'; 
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
	        redirect('Admin/auth_error');
	        }    
      $msg = $session_data['username']." ".'Visited Update Rent Payable Contract Status Detail Page For'." ".$payable_status.'.';
       $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);    
      $this->load->view('edit_rent_payable_contract_status',$this->security->xss_clean($data));

    }

        public function rent_payable_status_edit_redirect(){

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

        $rent_payable_id = base64_decode($this->uri->segment(3));

        $data['rent_payable'] = $this->lease_model->rent_payable_data($rent_payable_id);

         foreach($data['rent_payable'] as $payable){

          $payable_status = $payable['lease_own_status'];
          $lease_own_status_id = $payable['lease_own_status_id'];

         }

          if(($rent_payable_id == null OR $rent_payable_id == '') OR (!isset($lease_own_status_id) OR $lease_own_status_id !== $rent_payable_id OR $lease_own_status_id == null OR $lease_own_status_id == '')){

           show_404();
          exit();
          }

	        if(!in_array("Rent Payable Contract Status Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Use Update Rent Payable Contract Status Detail Page For'." ".$payable_status." ".'Update Rent Payable Contract Status Detail Page Access is Not Given to the'." ".$session_data['username'].'.'; 
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
	        redirect('Admin/auth_error');
	        }    

        $this->form_validation->set_rules('rent_payable_status','Contract Status','required'); 

       if($this->form_validation->run() == false)
        {
       
           
                 
          $this->load->view('edit_rent_payable_contract_status',$this->security->xss_clean($data));


           
        }
        else{

            $query = $this->lease_model->update_rent_payable($rent_payable_id);
            $this->session->set_flashdata("update_rent_payable","Contract Status Updated Successfully");
            $msg = $data['username']." ".'Updated'." ".$this->input->post('rent_payable_status'). " ".'Rent Payable Contract Status Detail.';
            $this->user_activity_model->add('updated',$msg,$data['username'],$data['admin_id']);
            redirect("Lease/rent_payable_contract_status","refresh",$this->security->xss_clean($data));

        }

    }

    public function rent_receivable_status_edit(){

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

       $rent_receivable_id = base64_decode($this->uri->segment(3));

       $data['rent_receivable'] = $this->lease_model->rent_receivable_data($rent_receivable_id);

       foreach($data['rent_receivable'] as $recivable){

        $recivable_status = $recivable['lease_given_status'];
        $lease_given_status_id = $recivable['lease_given_status_id'];

         }

          if(($rent_receivable_id == null OR $rent_receivable_id == '') OR (!isset($lease_given_status_id) OR $lease_given_status_id !== $rent_receivable_id OR $lease_given_status_id == null OR $lease_given_status_id == '')){

           show_404();
          exit();
          }
	        if(!in_array("Rent Receivable Contract Status Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Use Update Rent Receivable Contract Status Detail Page For'." ".$recivable_status." ".'Update Rent Receivable Contract Status Detail Page Access is Not Given to the'." ".$session_data['username'].'.'; 
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
	        redirect('Admin/auth_error');
	        }    
      $msg = $session_data['username']." ".'Visited Update Rent Receivable Contract Status Detail Page For'." ".$recivable_status.'.';
      $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);      
      $this->load->view('edit_rent_receivable_contract_status',$this->security->xss_clean($data));
      
    }

    public function rent_receivable_status_edit_redirect(){

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

        $rent_receivable_id = base64_decode($this->uri->segment(3));

       $data['rent_receivable'] = $this->lease_model->rent_receivable_data($rent_receivable_id);

       foreach($data['rent_receivable'] as $recivable){

        $recivable_status = $recivable['lease_given_status'];
        $lease_given_status_id = $recivable['lease_given_status_id'];

         }

          if(($rent_receivable_id == null OR $rent_receivable_id == '') OR (!isset($lease_given_status_id) OR $lease_given_status_id !== $rent_receivable_id OR $lease_given_status_id == null OR $lease_given_status_id == '')){

           show_404();
          exit();
          }

	        if(!in_array("Rent Receivable Contract Status Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Use Update Rent Receivable Contract Status Detail Page For'." ".$recivable_status." ".'Update Rent Receivable Contract Status Detail Page Access is Not Given to the'." ".$session_data['username'].'.'; 
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
	        redirect('Admin/auth_error');
	        }    

       $this->form_validation->set_rules('rent_receivable_status','Contract Status','required');   

        if($this->form_validation->run() == false)
        {
       
           
                 
               
          $this->load->view('edit_rent_receivable_contract_status',$this->security->xss_clean($data));


           
        }
        else{

            $query = $this->lease_model->update_rent_receivable($rent_receivable_id);
            $this->session->set_flashdata("update_rent_receivable","Contract Status Updated Successfully");
            $msg = $data['username']." ".'Updated'." ".$this->input->post('rent_receivable_status'). " ".'Rent Receivable Contract Status Detail.';
            $this->user_activity_model->add('updated',$msg,$data['username'],$data['admin_id']);
            redirect("Lease/rent_receivable_contract_status","refresh",$this->security->xss_clean($data));

        }
      
    }

    public function get_lease_area(){

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

	        if(!in_array("Rent Payable",$role1)) {
	        redirect('Admin/auth_error');
	        }    


          $id = $this->input->post('id',TRUE);

          $property_data = $this->lease_model->get_property_data($id);
          echo json_encode($this->security->xss_clean($property_data));

    }

        public function get_lease_given_area(){

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

	        if(!in_array("Rent Receivable",$role1)) {
	        redirect('Admin/auth_error');
	        }    


          $id = $this->input->post('id',TRUE);

          $property_data = $this->lease_model->get_property_data($id);
          echo json_encode($this->security->xss_clean($property_data));

    }
}    