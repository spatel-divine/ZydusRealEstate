<?php
class Legal extends CI_Controller {

    public function __construct() {
    	 parent::__construct();
    	$this->load->helper(array('form', 'url','security'));
        $this->load->library(array('form_validation','session','upload'));  
        $this->load->model('legal_model');       
        $this->load->model('user_activity_model'); 
        error_reporting(0);
    }

    public function legal_master(){
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

          if(!in_array("Legal Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Legal Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
          redirect('Admin/auth_error');
          }  
            $data['property'] = $this->legal_model->view_property();
            $data['case_by'] = $this->legal_model->view_case_by();
            $data['case_against'] = $this->legal_model->view_case_against();
            $data['police_station'] = $this->legal_model->view_police_station();
            $data['court_authority'] = $this->legal_model->view_court_authority();
            $data['advocate'] = $this->legal_model->get_advocate();
            $msg = $session_data['username']." ".'Visited Legal Master Page.';
            $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
            $this->load->view('legal_master',$this->security->xss_clean($data)); 
    }
    public function legal_master_redirect(){
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

          if(!in_array("Legal Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Legal Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
          redirect('Admin/auth_error');
          }     

        $data['property'] = $this->legal_model->view_property();
        $data['case_by'] = $this->legal_model->view_case_by();
		$data['case_against'] = $this->legal_model->view_case_against();
		$data['police_station'] = $this->legal_model->view_police_station();
		$data['court_authority'] = $this->legal_model->view_court_authority();
		$data['advocate'] = $this->legal_model->get_advocate();

		 $this->form_validation->set_rules('property_name','Property Name','required');
		 $this->form_validation->set_rules('case_number','Case Number','required');
         $this->form_validation->set_rules('case_by[]','Case By','required');
         $this->form_validation->set_rules('case_against[]','Case Against','required');
         $this->form_validation->set_rules('police_station','Police Station','required');
         $this->form_validation->set_rules('act_section','Act & Section Applied','required');
         $this->form_validation->set_rules('case_type','Case Type','required');
         $this->form_validation->set_rules('registred_date','Registred Date','required');
         $this->form_validation->set_rules('advocate_name[]','Advocate Name','required');
         $this->form_validation->set_rules('court_authority','Court & Authority','required');

         if (empty($_FILES['case_upload']['name']))
        {
          $this->form_validation->set_rules('case_upload', 'Case Upload', 'required');
        }
        if($this->form_validation->run() === FALSE)
        {
            $this->load->view('legal_master',$this->security->xss_clean($data));
        }
        else{
        	           $case_by = '';
        	           $case_against = '';
        	           $advocate_name = '';
                for($i=0 ;$i < count($this->input->post('case_by'));$i++){
                    $case_by = implode(",",$this->input->post('case_by'));
                }
                 for($i=0 ;$i < count($this->input->post('case_against'));$i++){
                    $case_against = implode(",",$this->input->post('case_against'));
                }
                 for($i=0 ;$i < count($this->input->post('advocate_name'));$i++){
                    $advocate_name = implode(",",$this->input->post('advocate_name'));
                }

                $case_upload = $_FILES['case_upload']['name'];

                    if($case_upload !== ""){

                        $case_upload = str_replace(' ', '_', $case_upload);

                            $config['file_name'] =$case_upload;
                            $config['upload_path'] = './assets/images/uploads/legal';
                            $config['allowed_types'] = 'zip|jpeg|jpg|png|pdf|JPEG|JPG|PNG|PDF|rar';
                            $config['max_size'] = '20000';
                            $config['encrypt_name'] = TRUE;
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            if (!$this->upload->do_upload('case_upload')) {
                                $error = array('error' => $this->upload->display_errors());
                                
                               $this->session->set_flashdata('new_in',2);
                              $this->load->view("legal_master",$this->security->xss_clean($data));
                            } else {
                                $data1 = array('upload_data' => $this->upload->data());
                                //$file_name = $upload_data['file_name'];
                               
                                $this->legal_model->add_legal($data1['upload_data']['file_name'],$case_by,$case_against,$advocate_name);
                                $insert_id = $this->db->insert_id();
                                $case_by1 = array();
                                $case_against1 = array();
                                $advocate_name1 = array();
                                   for($i=0; $i< count($this->input->post('case_by'));$i++){
                                   	  $case_by1 = $this->input->post('case_by')[$i];
                                   
								            $data = array(              
								                'legal_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$insert_id)),
								                'case_by_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$case_by1)),
								                'legal_case_by_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
								            );					                  

					                    $this->legal_model->add_legal_case_by($data);
					                }

					                 for($i=0; $i< count($this->input->post('case_against'));$i++){
                                   	  $case_against1 = $this->input->post('case_against')[$i];
                                   
								            $data = array(              
								                'legal_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$insert_id)),
								                'case_against_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$case_against1)),
								                'legal_case_against_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
								            );					                  

					                    $this->legal_model->add_legal_case_against($data);
					                }
					                
					                for($i=0; $i< count($this->input->post('advocate_name'));$i++){
                                   	  $advocate_name1 = $this->input->post('advocate_name')[$i];
                                   
								            $data = array(              
								                'legal_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$insert_id)),
								                'advocate_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$advocate_name1)),
								                'legal_advocate_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
								            );					                  

					                    $this->legal_model->add_legal_advocate($data);
					                }

                                 $this->session->set_flashdata("insert_legal","Legal Details Added Successfully");
                                 $data['legal_property'] = $this->legal_model->get_selected_property($this->input->post('property_name'));

                                 foreach($data['legal_property'] as $legal_prop){
                                  $property_name_legal = $legal_prop['property_name'];
                                 }
                                $msg = $session_data['username']." ".'Added Legal Data For Property Named'." ".$property_name_legal.'.';
                                $this->user_activity_model->add('added',$msg,$session_data['username'],$session_data['admin_id']); 
                                if(in_array("View Legal Master",$role1)) {
                                  redirect("Legal/view_legal_master");
                                } else {
                                  redirect("Legal/legal_master");
                                }
                            }

                        }
        }
    	
    }

     public function view_legal_master(){
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

          if(!in_array("View Legal Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Access View Legal Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
          redirect('Admin/auth_error');
          }     

         $data['legal'] = $this->legal_model->get_legal_detail();
         $data['case_by'] = $this->legal_model->get_legal_case_by_detail();
         $data['case_against'] = $this->legal_model->get_legal_case_against_detail();
         $data['advocate'] = $this->legal_model->get_legal_advocate_detail();

         //$data['property'] = $this->legal_model->view_property();
         $data['property'] = $this->legal_model->view_property_for_filter();
         $data['court_authority'] = $this->legal_model->view_court_authority();
         $msg = $session_data['username']." ".'Visited View Legal Master Page.';
         $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);

    	   $this->load->view('view_legal_master',$this->security->xss_clean($data));
    }

         public function legal_filter(){
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

          if(!in_array("View Legal Master",$role1)) {
          redirect('Admin/auth_error');
          }    

         $data['legal'] = $this->legal_model->get_legal_detail();
         $data['case_by'] = $this->legal_model->get_legal_case_by_detail();
         $data['case_against'] = $this->legal_model->get_legal_case_against_detail();
         $data['advocate'] = $this->legal_model->get_legal_advocate_detail();

         //$data['property'] = $this->legal_model->view_property();
         $data['property'] = $this->legal_model->view_property_for_filter();
         $data['court_authority'] = $this->legal_model->view_court_authority();

         if (empty($_POST['property_id']) && empty($_POST['case_type']) && empty($_POST['court_authority_id']))
        {
          $this->session->set_flashdata("select_data","Please Select Any Filter Field For Search");
            redirect('Legal/view_legal_master/',$this->security->xss_clean($data));


        } else {

          $property_id = $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$_POST['property_id']));
          $case_type = $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$_POST['case_type']));
          $court_authority_id = $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$_POST['court_authority_id']));

          $wheres = array();
            $sql = "SELECT pm.*,ps.*,lm.* FROM legal_master lm INNER JOIN property_master pm ON pm.property_id = lm.property_id INNER JOIN police_station_master ps ON ps.police_station_id = lm.police_station_id where ";

            if (isset($_POST['property_id']) and !empty($_POST['property_id']))
            {
                $wheres[] = "lm.property_id like '%{$property_id}%' ";
            } 

            if (isset($_POST['case_type']) and !empty($_POST['case_type']))
            {
                $wheres[] = "lm.case_type = '{$case_type}'";
            } 

            if (isset($_POST['court_authority_id']) and !empty($_POST['court_authority_id']))
            {
                $wheres[] = "lm.court_authority_id = '{$court_authority_id}' ";
            } 

            foreach ( $wheres as $where ) 
            {
            $sql .= $where . ' AND ';   //  you may want to make this an OR
              }
             $sql=rtrim($sql, "AND "); 

             $sql1 = $this->db->query($sql);

             $sql1 = $this->db->query($sql);
             if($sql1 == null OR $sql1 == '' OR empty($sql1)){
                $this->load->view('view_legal_master',$this->security->xss_clean($data));
                echo " No Data Found";
             } else {
              $data['legal']  = $sql1->result_array();  

               $this->load->view('view_legal_master',$this->security->xss_clean($data));
             }

        }
    }


    public function view_legal_data(){
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

         $legal_id = base64_decode($this->uri->segment(3));

        $data['legal'] = $this->legal_model->get_legal_data($legal_id);


         foreach($data['legal'] as $l){
          $property_id = $l['property_id'];
          $property_name = $l['property_name'];
          $case_number = $l['case_number'];
          $leg_id = $l['legal_id'];
        }


         if(($legal_id == null OR $legal_id == '') OR (!isset($leg_id) OR $leg_id !== $legal_id OR $leg_id == null OR $leg_id == '')){

           show_404();
          exit();
          }


          if(!in_array("View Legal Master",$role1)) {
          $msg = $session_data['username']." ".'Try To View Legal Data For'." ".$property_name." ".'And Case Number'." ".$case_number." ".'View Legal Detail Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);        
          redirect('Admin/auth_error');
          }    

        $prop_access_array = explode(",",$data['prop_access']);

        $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
              $msg = $session_data['username']." ".'Try To View Legal Data For'." ".$property_name." ".'And Case Number'." ".$case_number." ".'This Property Access is Not Given to the'." ".$session_data['username'].'.';
              $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 
              redirect('Admin/auth_error');
            }

        $data['case_by'] = $this->legal_model->get_legal_case_by_detail();
         $data['case_against'] = $this->legal_model->get_legal_case_against_detail();
         $data['advocate'] = $this->legal_model->get_legal_advocate_detail();
      $msg = $data['username']." ".'Viewed Legal Details For'." ".$property_name." ".'Property And Case Number'." ".$case_number;
      $this->user_activity_model->add('viewed',$msg,$data['username'],$data['admin_id']);    
    	$this->load->view('view_legal_data',$this->security->xss_clean($data));
    }

        public function download_case_document(){

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


        $legal_id = base64_decode($this->uri->segment(3));

         $data['legal'] = $this->legal_model->get_legal_data($legal_id);

        foreach($data['legal'] as $l){
          $property_id = $l['property_id'];
          $property_name = $l['property_name'];
          $case_number = $l['case_number'];
          $leg_id = $l['legal_id'];
        }


         if(($legal_id == null OR $legal_id == '') OR (!isset($leg_id) OR $leg_id !== $legal_id OR $leg_id == null OR $leg_id == '')){

           show_404();
          exit();
          }

          if(!in_array("View Legal Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Download Legal Document for'." ".$property_name." ".'And Case Number'." ".$case_number." ".'Download Legal Document Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
          redirect('Admin/auth_error');
          }    
          
        $prop_access_array = explode(",",$data['prop_access']);
        
        $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
               $msg = $session_data['username']." ".'Try To Download Legal Document for'." ".$property_name." ".'And Case Number'." ".$case_number." ".'This Property Access is Not Given to the'." ".$session_data['username'].'.';
              $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);
              redirect('Admin/auth_error');
            }

        //print_r($user_id);

          if(!empty($legal_id)){
            //load download helper
            $this->load->helper('download');
            
            //get file info from database
            $fileInfo = $this->legal_model->download_detail($legal_id);

            $fileInfo1 = base64_decode($fileInfo);
            
            //file path
            $file = file_get_contents(base_url().'assets/images/uploads/legal/'.$fileInfo1);

            $msg = $data['username']." ".'Downloaded Legal Document For'." ".$property_name." ".'Property And Case Number'." ".$case_number;
            $this->user_activity_model->add('download_document',$msg,$data['username'],$data['admin_id']);

            //download file from directory
            force_download($fileInfo1, $file);
            redirect('Legal/view_legal_data/'.$this->security->xss_clean($legal_id));
        }
    }

    public function delete_legal_detail(){
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

        $legal_id = base64_decode($this->uri->segment(3));

        $data['legal'] = $this->legal_model->get_legal_data($legal_id);


         foreach($data['legal'] as $l){
          $property_id = $l['property_id'];
          $property_name = $l['property_name'];
          $case_number = $l['case_number'];
          $leg_id = $l['legal_id'];
        }


         if(($legal_id == null OR $legal_id == '') OR (!isset($leg_id) OR $leg_id !== $legal_id OR $leg_id == null OR $leg_id == '')){

           show_404();
          exit();
          }

          if(!in_array("View Legal Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Delete Legal Details For'." ".$property_name." ".'Property And Case Number'." ".$case_number.'.This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
          redirect('Admin/auth_error');
          }    

        $prop_access_array = explode(",",$data['prop_access']);

        $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
              $msg = $session_data['username']." ".'Try To Delete Legal Details For'." ".$property_name." ".'Property And Case Number'." ".$case_number.'.This Property Access is Not Given to the'." ".$session_data['username'].'.';
              $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);
              redirect('Admin/auth_error');
            }

        
         $this->legal_model->delete_legal_case_by($legal_id);
         $this->legal_model->delete_legal_case_against($legal_id);
         $this->legal_model->delete_legal_advocate($legal_id);
        $this->legal_model->delete_legal($legal_id);
        
        $this->session->set_flashdata("delete_legal","Legal Details Deleted successfully.");
        $msg = $data['username']." ".'Deleted Legal Details For'." ".$property_name." ".'Property And Case Number'." ".$case_number;
        $this->user_activity_model->add('deleted',$msg,$data['username'],$data['admin_id']);
        redirect("Legal/view_legal_master","refresh");
    }

    public function hearing_master(){
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

          if(!in_array("Hearing Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Hearing Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
          redirect('Admin/auth_error');
          }    

         $data['property'] = $this->legal_model->view_property();
         $data['case_status'] = $this->legal_model->view_case_status();
      $msg = $session_data['username']." ".'Visited Hearing Master Page.';
      $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);   
    	$this->load->view('hearing_master',$this->security->xss_clean($data));
    }



        public function hearing_master_redirect(){

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

          if(!in_array("Hearing Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Hearing Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
          redirect('Admin/auth_error');
          }    

         $property = $this->input->post('property_name');
        //$data['property_id'] = $this->input->post('property_name');
        $data['property'] = $this->legal_model->view_property();
         $data['case_status'] = $this->legal_model->view_case_status();
        $data['legal'] = $this->legal_model->get_legal_property_data($property);
        $data['case_by'] = $this->legal_model->get_legal_case_by_detail();
         $data['case_against'] = $this->legal_model->get_legal_case_against_detail();
         $data['advocate'] = $this->legal_model->get_legal_advocate_detail();

        if($this->input->post('filter')){
        	 $property = $this->input->post('property_name');
        //$data['property_id'] = $this->input->post('property_name');
        $data['property'] = $this->legal_model->view_property();
         $data['case_status'] = $this->legal_model->view_case_status();
        $data['legal'] = $this->legal_model->get_legal_property_data($property);
        $data['case_by'] = $this->legal_model->get_legal_case_by_detail();
         $data['case_against'] = $this->legal_model->get_legal_case_against_detail();
         $data['advocate'] = $this->legal_model->get_legal_advocate_detail();
        $this->load->view('hearing_master',$data);    
        }

        else if($this->input->post('submit')){


        	 //$data['property_id'] = $this->input->post('property_name');

	         $data['property'] = $this->legal_model->view_property();
	         $data['case_status'] = $this->legal_model->view_case_status();

	          $this->form_validation->set_rules('property_name','Property Name','required');	
	          $this->form_validation->set_rules('hearing_date','Hearing Date','required');
	          $this->form_validation->set_rules('next_hearing_date','Next Hearing Date','required');
	          $this->form_validation->set_rules('case_status','Case Status','required');
	          $this->form_validation->set_rules('case_selection','Case Selection','required');

	           if (empty($_FILES['case_upload']['name']))
	        {
	          $this->form_validation->set_rules('case_upload','Case Upload','required');
	        }

            $data['legal_property'] = $this->legal_model->get_legal_data($this->input->post('legal_id'));

            foreach($data['legal_property'] as $legal_prop){
                $property_name_legal = $legal_prop['property_name'];
                $case_number = $legal_prop['case_number'];
            }

	         if(!empty($this->legal_model->get_inserted_hearing_data($this->input->post('legal_id')))){
          $hearing_data = $this->legal_model->get_inserted_hearing_data($this->input->post('legal_id'));

         foreach ($hearing_data as $hearing) {
          if($hearing['legal_id'] == $this->input->post('legal_id') AND $hearing['case_status'] != 'Completed'){

             $this->session->set_flashdata("check_hearing_inserted","Hearing Can't Added For Particular Case For That Data Exist For the Same.");
             $msg = $session_data['username']." ".'Try To Insert Hearing Data For'." ".$property_name_legal." ".'Property And Case Number'. " ".$case_number.'.But Hearing Data Cannot Added For Particular Property Because Hearing Data is  Exists for Same.';
             $this->user_activity_model->add('not_added',$msg,$session_data['username'],$session_data['admin_id']);  
                    
                   if(in_array("View Hearing List",$role1)) {
                    redirect("Legal/view_hearing_list","refresh",$this->security->xss_clean($data));
                  } else {
                    redirect("Legal/hearing_master","refresh",$this->security->xss_clean($data));
                  }

          }
        }
        }


	        if($this->form_validation->run() === FALSE)
	        { 
	          $this->load->view('hearing_master',$this->security->xss_clean($data));
	        }
	        else{

	        	$case_upload = $_FILES['case_upload']['name'];

                    if($case_upload !== ""){

                        $case_upload = str_replace(' ', '_', $case_upload);

                            $config['file_name'] =$case_upload;
                            $config['upload_path'] = './assets/images/uploads/hearing';
                            $config['allowed_types'] = 'zip|pdf|jpeg|jpg|png|rar';
                            $config['max_size'] = '20000';
                            $config['encrypt_name'] = TRUE;
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            if (!$this->upload->do_upload('case_upload')) {
                                $error = array('error' => $this->upload->display_errors());
                                
                               $this->session->set_flashdata('new_in',2);
                              $this->load->view("hearing_master",$this->security->xss_clean($data));
                            } else {
                                $data1 = array('upload_data' => $this->upload->data());
                                $this->legal_model->add_hearing($data1['upload_data']['file_name']);

                                $this->session->set_flashdata("insert_hearing","Hearing Details Added Successfully");
                                 $msg = $session_data['username']." ".'Added Hearing Data For Property Named'." ".$property_name_legal." ".'And Case Number'." ".$case_number;
                                 $this->user_activity_model->add('added',$msg,$session_data['username'],$session_data['admin_id']);
                                if(in_array("View Hearing List",$role1)) {
                                  redirect("Legal/view_hearing_list");
                                } else {
                                  redirect("Legal/hearing_master");
                                }
                              } 

                    }          
	        } 

        }
        else{

        	 //$data['property_id'] = $this->input->post('property_name');

	         $data['property'] = $this->legal_model->view_property();
	         $data['case_status'] = $this->legal_model->view_case_status();


        	$this->load->view("hearing_master",$this->security->xss_clean($data));
        }

        

    }


    public function view_hearing_list(){
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

          if(!in_array("View Hearing List",$role1)) {
           $msg = $session_data['username']." ".'Try To Access View Hearing List Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
          redirect('Admin/auth_error');
          }    

        $data['hearing_list'] = $this->legal_model->view_hearing_list();
        $data['advocate'] = $this->legal_model->get_legal_advocate_detail();
       // $data['property'] = $this->legal_model->view_property();
        $data['property'] = $this->legal_model->view_property_for_filter();
         $data['case_status'] = $this->legal_model->view_case_status();
       $msg = $session_data['username']." ".'Visited View Hearing List Page.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);   
    	$this->load->view('view_hearing_list',$this->security->xss_clean($data));
    }


        public function hearing_filter(){
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

          if(!in_array("View Hearing List",$role1)) {
          redirect('Admin/auth_error');
          }    

        $data['hearing_list'] = $this->legal_model->view_hearing_list();
        $data['advocate'] = $this->legal_model->get_legal_advocate_detail();
        //$data['property'] = $this->legal_model->view_property();
        $data['property'] = $this->legal_model->view_property_for_filter();
         $data['case_status'] = $this->legal_model->view_case_status();

         $property_id = $this->input->post('property_id');
         $case_status_id = $this->input->post('case_status');


         if($property_id !=="" AND $case_status_id !==""){

        $this->db->join('property_master','hearing_master.property_id = property_master.property_id');
        $this->db->join('legal_master','hearing_master.legal_id = legal_master.legal_id');
        $this->db->join('legal_case_status_master','hearing_master.hearing_case_status = legal_case_status_master.case_status_id') ;    
        $this->db->order_by('hearing_id','desc');
         $query = $this->db->get_where('hearing_master',array('hearing_master.property_id'=> $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$property_id)),'hearing_master.hearing_case_status'=>$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$case_status_id))));
          $data['hearing_list'] = $query->result_array();
               $this->load->view('view_hearing_list',$this->security->xss_clean($data));

         } elseif($property_id !=="" AND $case_status_id ==""){

          $this->db->join('property_master','hearing_master.property_id = property_master.property_id');
          $this->db->join('legal_master','hearing_master.legal_id = legal_master.legal_id');
        $this->db->join('legal_case_status_master','hearing_master.hearing_case_status = legal_case_status_master.case_status_id') ;    
        $this->db->order_by('hearing_id','desc');
         $query = $this->db->get_where('hearing_master',array('hearing_master.property_id'=> $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$property_id))));
          $data['hearing_list'] = $query->result_array();
               $this->load->view('view_hearing_list',$this->security->xss_clean($data));

         } elseif($property_id =="" AND $case_status_id !==""){

        $this->db->join('property_master','hearing_master.property_id = property_master.property_id');
        $this->db->join('legal_master','hearing_master.legal_id = legal_master.legal_id');
        $this->db->join('legal_case_status_master','hearing_master.hearing_case_status = legal_case_status_master.case_status_id') ;    
        $this->db->order_by('hearing_id','desc');
         $query = $this->db->get_where('hearing_master',array('hearing_master.hearing_case_status'=>$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$case_status_id))));
          $data['hearing_list'] = $query->result_array();
               $this->load->view('view_hearing_list',$this->security->xss_clean($data));

         }else{

        $this->session->set_flashdata("select_data","Please Select Any Filter Field For Search");
            redirect('Legal/view_hearing_list/',$this->security->xss_clean($data));

         }

    }

    public function view_hearing_data(){
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

         $hearing_id = base64_decode($this->uri->segment(3));
         $data['property'] = $this->legal_model->view_property();
         $data['case_status'] = $this->legal_model->view_case_status();
        $data['legal'] = $this->legal_model->get_legal_property_data($property);
        $data['case_by'] = $this->legal_model->get_legal_case_by_detail();
         $data['case_against'] = $this->legal_model->get_legal_case_against_detail();
         $data['advocate'] = $this->legal_model->get_legal_advocate_detail();
        $data['hearing_data'] = $this->legal_model->get_hearing_data($hearing_id);


         foreach($data['hearing_data'] as $hearing){
          $property_id = $hearing['property_id'];
          $property_name = $hearing['property_name'];
          $case_number = $hearing['case_number'];
          $hear_id = $hearing['hearing_id'];
        }

         if(($hearing_id == null OR $hearing_id == '') OR (!isset($hear_id) OR $hear_id !== $hearing_id OR $hear_id == null OR $hear_id == '')){

           show_404();
          exit();
          }

          if(!in_array("View Hearing List",$role1)) {
          $msg = $session_data['username']." ".'Try To View Hearing Data For'." ".$property_name." ".'And Case Number'." ".$case_number.'.View Hearing Data Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);     
          redirect('Admin/auth_error');
          } 

        $prop_access_array = explode(",",$data['prop_access']);

        $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
              $msg = $session_data['username']." ".'Try To View Hearing Data For'." ".$property_name." ".'And Case Number'." ".$case_number.'.View Hearing Data For That Property Access is Not Given to the'." ".$session_data['username'].'.';
              $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
              redirect('Admin/auth_error');
            }
      $msg = $data['username']." ".'Viewed Hearing Details For'." ".$property_name." ".'Property And Case Number'." ".$case_number.'.';
      $this->user_activity_model->add('viewed',$msg,$data['username'],$data['admin_id']);      
    	$this->load->view('view_hearing_data',$this->security->xss_clean($data));
    }


    public function download_hearing_document(){

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

         $hearing_id = base64_decode($this->uri->segment(3));

         $data['hearing_data'] = $this->legal_model->get_hearing_data($hearing_id);

        foreach($data['hearing_data'] as $hearing){
          $property_id = $hearing['property_id'];
          $property_name = $hearing['property_name'];
          $case_number = $hearing['case_number'];
          $hear_id = $hearing['hearing_id'];
        }

         if(($hearing_id == null OR $hearing_id == '') OR (!isset($hear_id) OR $hear_id !== $hearing_id OR $hear_id == null OR $hear_id == '')){

           show_404();
          exit();
          }

          if(!in_array("View Hearing List",$role1)) {
          $msg = $session_data['username']." ".'Try To Download Hearing Document For'." ".$property_name." ".'And Case Number'." ".$case_number.'.Download Hearing Document Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);      
          redirect('Admin/auth_error');
          }    

        //print_r($user_id);

        $prop_access_array = explode(",",$data['prop_access']);
        
        $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
               $msg = $session_data['username']." ".'Try To Download Hearing Document For'." ".$property_name." ".'And Case Number'." ".$case_number.'.That Property Access is Not Given to the'." ".$session_data['username'].'.';
              $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
              redirect('Admin/auth_error');
            }

          if(!empty($hearing_id)){
            //load download helper
            $this->load->helper('download');
            
            //get file info from database
            $fileInfo = $this->legal_model->hearing_download_detail($hearing_id);

            $fileInfo1 = base64_decode($fileInfo);
            
            //file path
            $file = file_get_contents(base_url().'assets/images/uploads/hearing/'.$fileInfo1);

            $msg = $data['username']." ".'Downloaded Hearing Document For'." ".$property_name." ".'Property And Case Number'." ".$case_number;
            $this->user_activity_model->add('download_document',$msg,$data['username'],$data['admin_id']);

            //download file from directory
            force_download($fileInfo1, $file);
            redirect('Legal/view_hearing_data/'.$this->security->xss_clean($hearing_id));
        }
    }

        public function edit_hearing_details(){
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

        $hearing_id = base64_decode($this->uri->segment(3));
         $data['property'] = $this->legal_model->view_property();
         $data['case_status'] = $this->legal_model->view_case_status();
        $data['legal'] = $this->legal_model->get_legal_property_data($property);
        $data['case_by'] = $this->legal_model->get_legal_case_by_detail();
         $data['case_against'] = $this->legal_model->get_legal_case_against_detail();
         $data['advocate'] = $this->legal_model->get_legal_advocate_detail();
        $data['hearing_data'] = $this->legal_model->get_hearing_data($hearing_id);

         foreach($data['hearing_data'] as $hearing){
          $property_id = $hearing['property_id'];
          $property_name = $hearing['property_name'];
          $case_number = $hearing['case_number'];
          $hear_id = $hearing['hearing_id'];
        }

         if(($hearing_id == null OR $hearing_id == '') OR (!isset($hear_id) OR $hear_id !== $hearing_id OR $hear_id == null OR $hear_id == '')){

           show_404();
          exit();
          }

          if(!in_array("View Hearing List",$role1)) {
          $msg = $session_data['username']." ".'Try To Use Update Hearing Detail Page For'." ".$property_name." ".'Property And Case Number'." ".$case_number.'.Update Hearing Detail Page Access is Not Given to the'." ".$session_data['username'].'.'; 
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
          redirect('Admin/auth_error');
          }    

        $prop_access_array = explode(",",$data['prop_access']);
        
        $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
               $msg = $session_data['username']." ".'Try To Use Update Hearing Detail Page For'." ".$property_name." ".'Property And Case Number'." ".$case_number.'.That Property Access is Not Given to the'." ".$session_data['username'].'.'; 
              $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
              redirect('Admin/auth_error');
            }

       $msg = $session_data['username']." ".'Visited Update Hearing Detail Page For'." ".$property_name." ".'Property And Case Number'." ".$case_number;
       $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);          
    	$this->load->view('edit_hearing_details',$this->security->xss_clean($data));
    }

    public function edit_hearing_details_redirect(){
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

         $hearing_id = base64_decode($this->uri->segment(3));
         $data['property'] = $this->legal_model->view_property();
         $data['case_status'] = $this->legal_model->view_case_status();
        $data['legal'] = $this->legal_model->get_legal_property_data($property);
        $data['case_by'] = $this->legal_model->get_legal_case_by_detail();
        $data['case_against'] = $this->legal_model->get_legal_case_against_detail();
        $data['advocate'] = $this->legal_model->get_legal_advocate_detail();
        $data['hearing_data'] = $this->legal_model->get_hearing_data($hearing_id);

        foreach($data['hearing_data'] as $hearing){
          $property_id = $hearing['property_id'];
          $property_name = $hearing['property_name'];
          $case_number = $hearing['case_number'];
          $hear_id = $hearing['hearing_id'];
        }

         if(($hearing_id == null OR $hearing_id == '') OR (!isset($hear_id) OR $hear_id !== $hearing_id OR $hear_id == null OR $hear_id == '')){

           show_404();
          exit();
          }
          if(!in_array("View Hearing List",$role1)) {
          $msg = $session_data['username']." ".'Try To Use Update Hearing Detail Page For'." ".$property_name." ".'Property And Case Number'." ".$case_number.'.Update Hearing Detail Page Access is Not Given to the'." ".$session_data['username'].'.'; 
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);      
          redirect('Admin/auth_error');
          }    


        $prop_access_array = explode(",",$data['prop_access']);
        
        $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
               $msg = $session_data['username']." ".'Try To Use Update Hearing Detail Page For'." ".$property_name." ".'Property And Case Number'." ".$case_number.'.That Property Access is Not Given to the'." ".$session_data['username'].'.'; 
              $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
              redirect('Admin/auth_error');
            }

	     $this->form_validation->set_rules('hearing_date','Hearing Date','required');
	     $this->form_validation->set_rules('next_hearing_date','Next Hearing Date','required');
	     $this->form_validation->set_rules('case_status','Case Status','required');

	      if($this->form_validation->run() === FALSE)
	        { 
	          $this->load->view('edit_hearing_details',$this->security->xss_clean($data));
	        }
	        else{

	        	$case_upload = $_FILES['case_upload']['name'];

                    if($case_upload !== ""){

                        $case_upload = str_replace(' ', '_', $case_upload);

                            $config['file_name'] =$case_upload;
                            $config['upload_path'] = './assets/images/uploads/hearing';
                            $config['allowed_types'] = 'zip|pdf|jpeg|jpg|png|rar';
                            $config['max_size'] = '20000';
                            $config['encrypt_name'] = TRUE;
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            if (!$this->upload->do_upload('case_upload')) {
                                $error = array('error' => $this->upload->display_errors());
                                
                               $this->session->set_flashdata('new_in',2);
                              redirect("Legal/edit_hearing_details_redirect/".$this->uri->segment(3),$this->security->xss_clean($data));
                            } else {
                                  foreach($data['hearing_data'] as $hearing){
                                    $upload_hearing_document = $hearing['upload_hearing_document'];
                                  }

                                 $ipath = ('assets/images/uploads/hearing/'.base64_decode($upload_hearing_document));
                                 unlink($ipath);
                                $data1 = array('upload_data' => $this->upload->data());
                                $this->legal_model->update_hearing($hearing_id,$data1['upload_data']['file_name']);

                                $this->session->set_flashdata("update_hearing","Hearing Details Updated Successfully");

                                redirect('Legal/view_hearing_list');
                                //$file_name = $upload_data['file_name'];
                              } 

                    }   
                    else{

                    	 $this->legal_model->update_hearing_without_image($hearing_id);

                        $this->session->set_flashdata("update_hearing","Hearing Details Updated Successfully");

                         $msg = $session_data['username']." ".'Updated Hearing Details For'." ".$property_name." ".'Property And Case Number'." ".$case_number;
                         $this->user_activity_model->add('updated',$msg,$session_data['username'],$session_data['admin_id']);   

                        redirect('Legal/view_hearing_list');

                    }      
	        }	

    	
    }

    public function delete_hearing_detail(){
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

         $hearing_id = base64_decode($this->uri->segment(3));
         $data['hearing'] = $this->legal_model->get_hearing_data($hearing_id);

        foreach($data['hearing'] as $hearing){
          $upload_hearing_document = $hearing['upload_hearing_document'];
          $property_id = $hearing['property_id'];
          $property_name = $hearing['property_name'];
          $case_number = $hearing['case_number'];
          $hear_id = $hearing['hearing_id'];
        }

         if(($hearing_id == null OR $hearing_id == '') OR (!isset($hear_id) OR $hear_id !== $hearing_id OR $hear_id == null OR $hear_id == '')){

           show_404();
          exit();
          }

          if(!in_array("View Hearing List",$role1)) {
          $msg = $session_data['username']." ".'Try To Delete Hearing Details For'." ".$property_name." ".'Property And Case Number'." ".$case_number.'.Delete Hearing Detail Page Access is Not Given to the'." ".$session_data['username'].'.'; 
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
          redirect('Admin/auth_error');
          }    

       
        $prop_access_array = explode(",",$data['prop_access']);

        $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
               $msg = $session_data['username']." ".'Try To Delete Hearing Details For'." ".$property_name." ".'Property And Case Number'." ".$case_number.'.This Property Access is Not Given to the'." ".$session_data['username'].'.'; 
              $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
              redirect('Admin/auth_error');
            }

       $ipath = ('assets/images/uploads/hearing/'.base64_decode($upload_hearing_document));
       unlink($ipath);

        $this->legal_model->delete_hearing($hearing_id);
        $this->session->set_flashdata("delete_hearing","Hearing Details Deleted successfully.");
        $msg = $data['username']." ".'Deleted Hearing Details For'." ".$property_name." ".'Property And Case Number'." ".$case_number;
        $this->user_activity_model->add('deleted',$msg,$data['username'],$data['admin_id']);
        redirect("Legal/view_hearing_list","refresh");
    }



    public function upcoming_hearing_master(){
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

          if(!in_array("Upcoming Hearing",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Upcoming Hearing Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);      
          redirect('Admin/auth_error');
          }    

        $data['hearing_list'] = $this->legal_model->view_upcoming_hearing_list();
        $data['advocate'] = $this->legal_model->get_legal_advocate_detail();
       $msg = $session_data['username']." ".'Visited Upcoming Hearing Master Page.';
      $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);    
    	$this->load->view('upcoming_hearing_master',$this->security->xss_clean($data));
    }

    public function filter_upcoming_hearings()
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

          if(!in_array("Upcoming Hearing",$role1)) {
          redirect('Admin/auth_error');
          }    

       $data['hearing_list'] = $this->legal_model->view_upcoming_hearing_list();
        $data['advocate'] = $this->legal_model->get_legal_advocate_detail();
        $upcoming_hearing_start_date="";
        $upcoming_hearing_end_date="";
        if(!empty($this->input->post('upcoming_hearing_start_date'))){
            $upcoming_hearing_start_date = date("Y-m-d", strtotime($this->input->post('upcoming_hearing_start_date')));
        }

         if(!empty($this->input->post('upcoming_hearing_end_date'))){
            $upcoming_hearing_end_date = date("Y-m-d", strtotime($this->input->post('upcoming_hearing_end_date')));
        }
    

        if($upcoming_hearing_start_date !== "" AND $upcoming_hearing_end_date !== ""){
	      	$this->db->join('property_master','hearing_master.property_id = property_master.property_id');
	        $this->db->join('legal_case_status_master','hearing_master.hearing_case_status = legal_case_status_master.case_status_id') ; 
           $this->db->join('legal_master','hearing_master.legal_id = legal_master.legal_id') ;    
	        $this->db->order_by('hearing_id','desc');

	        $this->db->where('hearing_master.hearing_date >=', $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$upcoming_hearing_start_date)));
			$this->db->where('next_hearing_date <=', $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$upcoming_hearing_end_date)));
			$this->db->where('case_status !=',$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",'Completed')));

            $query1 = $this->db->get('hearing_master');

            $data['hearing_list']  = $query1->result_array();
            $this->load->view('upcoming_hearing_master',$this->security->xss_clean($data));
        }

        else if($upcoming_hearing_start_date !== "" AND $upcoming_hearing_end_date == ""){
        	$this->db->join('property_master','hearing_master.property_id = property_master.property_id');
	        $this->db->join('legal_case_status_master','hearing_master.hearing_case_status = legal_case_status_master.case_status_id') ;
           $this->db->join('legal_master','hearing_master.legal_id = legal_master.legal_id') ;     
	        $this->db->order_by('hearing_id','desc');

	        $this->db->where('hearing_master.hearing_date', $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$upcoming_hearing_start_date)));
			$this->db->where('case_status !=',$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",'Completed')));

            $query1 = $this->db->get('hearing_master');

            $data['hearing_list']  = $query1->result_array();
            $this->load->view('upcoming_hearing_master',$this->security->xss_clean($data));
        }

        else if($upcoming_hearing_start_date == "" AND $upcoming_hearing_end_date !== ""){
          	$this->db->join('property_master','hearing_master.property_id = property_master.property_id');
	        $this->db->join('legal_case_status_master','hearing_master.hearing_case_status = legal_case_status_master.case_status_id') ;  
           $this->db->join('legal_master','hearing_master.legal_id = legal_master.legal_id') ;   
	        $this->db->order_by('hearing_id','desc');
			$this->db->where('next_hearing_date', $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$upcoming_hearing_end_date)));
			$this->db->where('case_status !=',$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",'Completed')));

            $query1 = $this->db->get('hearing_master');

            $data['hearing_list']  = $query1->result_array();
            $this->load->view('upcoming_hearing_master',$this->security->xss_clean($data));
        } else {
             $this->session->set_flashdata("select_data","Please Select Any Filter Field For Search");
            redirect('Legal/upcoming_hearing_master/',$this->security->xss_clean($data));
        }

    }


    public function external_opinion_master(){
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

          if(!in_array("External Opinion Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Access External Opinion Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
          redirect('Admin/auth_error');
          }   

         $data['property'] = $this->legal_model->view_property();
         $data['advocate1'] = $this->legal_model->get_advocate();
      $msg = $session_data['username']." ".'Visited External Opinion Master Page.';
      $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);   
    	$this->load->view('external_opinion_master',$this->security->xss_clean($data));
    }

        public function external_opinion_master_redirect(){
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

          if(!in_array("External Opinion Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Access External Opinion Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);     
          redirect('Admin/auth_error');
          }   

         $property = $this->input->post('property_name');
         //$data['property_id'] = $this->input->post('property_name');
         $data['property'] = $this->legal_model->view_property();
         $data['advocate1'] = $this->legal_model->get_advocate();

        $data['legal'] = $this->legal_model->get_legal_property_data($property);
        $data['case_by'] = $this->legal_model->get_legal_case_by_detail();
        $data['case_against'] = $this->legal_model->get_legal_case_against_detail();
        $data['advocate'] = $this->legal_model->get_legal_advocate_detail();

         if($this->input->post('filter')){
        	 $property = $this->input->post('property_name');
        //$data['property_id'] = $this->input->post('property_name');
        $data['property'] = $this->legal_model->view_property();
         $data['case_status'] = $this->legal_model->view_case_status();
        $data['legal'] = $this->legal_model->get_legal_property_data($property);
        $data['case_by'] = $this->legal_model->get_legal_case_by_detail();
         $data['case_against'] = $this->legal_model->get_legal_case_against_detail();
         $data['advocate'] = $this->legal_model->get_legal_advocate_detail();
        
    	$this->load->view('external_opinion_master',$this->security->xss_clean($data));   
        }

        else if($this->input->post('submit')){

        	$this->form_validation->set_rules('property_name','Property Name','required');	
	          $this->form_validation->set_rules('external_opinion','External Opinion','required');
	          $this->form_validation->set_rules('advocate_name','Advocate Name','required');
	          $this->form_validation->set_rules('case_selection','Case Selection','required');

	           if (empty($_FILES['case_upload']['name']))
	        {
	          $this->form_validation->set_rules('case_upload','Document Upload','required');
	        }

	         if($this->form_validation->run() === FALSE)
	        { 
	          $this->load->view('external_opinion_master',$this->security->xss_clean($data));
	        }
	        else{

	        	$case_upload = $_FILES['case_upload']['name'];

                    if($case_upload !== ""){

                        $case_upload = str_replace(' ', '_', $case_upload);

                            $config['file_name'] =$case_upload;
                            $config['upload_path'] = './assets/images/uploads/external_opinion';
                            $config['allowed_types'] = 'zip|pdf|jpeg|jpg|png|rar';
                            $config['max_size'] = '20000';
                            $config['encrypt_name'] = TRUE;
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            if (!$this->upload->do_upload('case_upload')) {
                                $error = array('error' => $this->upload->display_errors());
                                
                               $this->session->set_flashdata('new_in',2);
                              $this->load->view("external_opinion_master",$this->security->xss_clean($data));
                            } else {
                                $data1 = array('upload_data' => $this->upload->data());
                                $this->legal_model->add_external_opinion($data1['upload_data']['file_name']);

                                $this->session->set_flashdata("insert_external_opinion","External Opinion Details Added Successfully");

                                  $data['legal_property'] = $this->legal_model->get_legal_data($this->input->post('legal_id'));

                                foreach($data['legal_property'] as $legal_prop){
                                    $property_name_legal = $legal_prop['property_name'];
                                    $case_number = $legal_prop['case_number'];
                                }

                                $msg = $session_data['username']." ".'Added External Opinion Data For Property Named'." ".$property_name_legal." ".'And Case Number'." ".$case_number;
                                $this->user_activity_model->add('added',$msg,$session_data['username'],$session_data['admin_id']);

                                if(in_array("View External Opinion",$role1)) {
                                  redirect("Legal/view_external_opinion");
                                } else {
                                  redirect("Legal/external_opinion_master");
                                }
                              } 

                    }          
	        }	
        }
        
         else{

         	 $property = $this->input->post('property_name');
	        // $data['property_id'] = $this->input->post('property_name');
	         $data['property'] = $this->legal_model->view_property();
	         $data['advocate1'] = $this->legal_model->get_advocate();

	        $data['legal'] = $this->legal_model->get_legal_property_data($property);
	        $data['case_by'] = $this->legal_model->get_legal_case_by_detail();
	        $data['case_against'] = $this->legal_model->get_legal_case_against_detail();
	        $data['advocate'] = $this->legal_model->get_legal_advocate_detail();
    		$this->load->view('external_opinion_master',$this->security->xss_clean($data));
        }	
    }

     public function view_external_opinion(){
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

          if(!in_array("View External Opinion",$role1)) {
          $msg = $session_data['username']." ".'Try To Access View External Opinion List Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
          redirect('Admin/auth_error');
          }   

        $data['external_opinion'] = $this->legal_model->view_external_opinion_list();
        $data['property'] = $this->legal_model->view_property_for_filter();
        $msg = $session_data['username']." ".'Visited View External Opinion List Page.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
        $this->load->view('view_external_opinion',$this->security->xss_clean($data));
    }

        public function download_external_opinion_document(){

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
        $external_opinion_id = base64_decode($this->uri->segment(3));
       
         $data['external_opinion'] = $this->legal_model->get_external_opinion_data($external_opinion_id);

           foreach($data['external_opinion'] as $opinion){
          $property_id = $opinion['property_id'];
          $property_name = $opinion['property_name'];
          $case_number = $opinion['case_number'];
          $opinion_id = $opinion['external_opinion_id'];
        }

         if(($external_opinion_id == null OR $external_opinion_id == '') OR (!isset($opinion_id) OR $opinion_id !== $external_opinion_id OR $opinion_id == null OR $opinion_id == '')){

           show_404();
          exit();
          }

          if(!in_array("View External Opinion",$role1)) {
           $msg = $session_data['username']." ".'Try To Download External Opinion Document For'." ".$property_name." ".'And Case Number'." ".$case_number.'.Download External Opinion Document Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
          redirect('Admin/auth_error');
          }  

        //print_r($user_id);

         $prop_access_array = explode(",",$data['prop_access']);
        
        $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
              $msg = $session_data['username']." ".'Try To Download External Opinion Document For'." ".$property_name." ".'And Case Number'." ".$case_number.'.This Property Access is Not Given to the'." ".$session_data['username'].'.';
              $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 
              redirect('Admin/auth_error');
            }

          if(!empty($external_opinion_id)){
            //load download helper
            $this->load->helper('download');
            
            //get file info from database
            $fileInfo = $this->legal_model->external_opinion_download_detail($external_opinion_id);

            $fileInfo1 = base64_decode($fileInfo);
            
            //file path
            $file = file_get_contents(base_url().'assets/images/uploads/external_opinion/'.$fileInfo1);

             $msg = $data['username']." ".'Downloaded External Opinion Document For'." ".$property_name." ".'Property And Case Number'." ".$case_number;
            $this->user_activity_model->add('download_document',$msg,$data['username'],$data['admin_id']);


            //download file from directory
            force_download($fileInfo1, $file);
            redirect('Legal/view_external_opinion/');
        }
    }

        public function filter_external_opinions()
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

          if(!in_array("View External Opinion",$role1)) {
          redirect('Admin/auth_error');
          }  

        $data['external_opinion'] = $this->legal_model->view_external_opinion_list();
        //$data['property'] = $this->legal_model->view_property();
        $data['property'] = $this->legal_model->view_property_for_filter();
        $date="";
        $property = "";
        $filter_date = "";
        //print_r($this->input->post('filter_date'));exit();
        if(!empty($this->input->post('filter_date'))){
            $filter_date = date("Y-m-d", strtotime($this->input->post('filter_date')));
        }

        if(!empty($this->input->post('property_name'))){
            $property = $this->input->post('property_name');
        }

        if($filter_date !=="" AND $property !==""){
	      	 $this->db->join('property_master','external_opinion_master.property_id = property_master.property_id'); 
             $this->db->join('user_master','external_opinion_master.advocate_id = user_master.user_id');  
             $this->db->join('legal_master','external_opinion_master.legal_id = legal_master.legal_id'); 
             $this->db->order_by('external_opinion_id','desc');

	         $this->db->where('external_opinion_added_date', $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$filter_date)));
			 $this->db->where('external_opinion_master.property_id',$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$property)));

             $query1 = $this->db->get('external_opinion_master');

             $data['external_opinion']  = $query1->result_array();

        $this->load->view('view_external_opinion',$this->security->xss_clean($data));
        }

        else if($filter_date !=="" AND $property ==""){
        	 $this->db->join('property_master','external_opinion_master.property_id = property_master.property_id'); 
             $this->db->join('user_master','external_opinion_master.advocate_id = user_master.user_id'); 
             $this->db->join('legal_master','external_opinion_master.legal_id = legal_master.legal_id');  
             $this->db->order_by('external_opinion_id','desc');

             $this->db->where('external_opinion_added_date', $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$filter_date)));

             $query1 = $this->db->get('external_opinion_master');

             $data['external_opinion']  = $query1->result_array();

        $this->load->view('view_external_opinion',$this->security->xss_clean($data));
        }

        else if($filter_date =="" AND $property !==""){
             $this->db->join('property_master','external_opinion_master.property_id = property_master.property_id'); 
             $this->db->join('user_master','external_opinion_master.advocate_id = user_master.user_id');  
             $this->db->join('legal_master','external_opinion_master.legal_id = legal_master.legal_id'); 
             $this->db->order_by('external_opinion_id','desc');

             $this->db->where('external_opinion_master.property_id',$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$property)));

             $query1 = $this->db->get('external_opinion_master');

             $data['external_opinion']  = $query1->result_array();
             
        $this->load->view('view_external_opinion',$this->security->xss_clean($data));
        } else {
             $this->session->set_flashdata("select_data","Please Select Any Filter Field For Search");
            redirect('Legal/view_external_opinion/',$this->security->xss_clean($data));
        }

    }

    public function delete_external_opinion_detail(){
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

        $external_opinion_id = base64_decode($this->uri->segment(3));

        $data['external_opinion'] = $this->legal_model->get_external_opinion_data($external_opinion_id);

        foreach($data['external_opinion'] as $opinion){
          $external_opinion_document_upload = $opinion['external_opinion_document_upload'];
          $property_id = $opinion['property_id'];
          $property_name = $opinion['property_name'];
          $case_number = $opinion['case_number'];
          $opinion_id = $opinion['external_opinion_id'];
        }

         if(($external_opinion_id == null OR $external_opinion_id == '') OR (!isset($opinion_id) OR $opinion_id !== $external_opinion_id OR $opinion_id == null OR $opinion_id == '')){

           show_404();
          exit();
          }

          if(!in_array("View External Opinion",$role1)) {
          $msg = $session_data['username']." ".'Try To Delete External Opinion Details For'." ".$property_name." ".'Property And Case Number'." ".$case_number.'.Delete External Opinion Detail Page Access is Not Given to the'." ".$session_data['username'].'.'; 
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
          redirect('Admin/auth_error');
          }  

        $prop_access_array = explode(",",$data['prop_access']);

        $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
               $msg = $session_data['username']." ".'Try To Delete External Opinion Details For'." ".$property_name." ".'Property And Case Number'." ".$case_number.'.This Property Access is Not Given to the'." ".$session_data['username'].'.'; 
              $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);
              redirect('Admin/auth_error');
            }

       $ipath = ('assets/images/uploads/external_opinion/'.base64_decode($external_opinion_document_upload));
       unlink($ipath);

        $this->legal_model->delete_external_opinion($external_opinion_id);
        $this->session->set_flashdata("delete_opinion","External Opinion Details Deleted successfully.");
        $msg = $data['username']." ".'Deleted External Opinion Details For'." ".$property_name." ".'Property And Case Number'." ".$case_number;
        $this->user_activity_model->add('deleted',$msg,$data['username'],$data['admin_id']);
        redirect("Legal/view_external_opinion","refresh");
    }


     public function case_by_master(){
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

          if(!in_array("Case By Master",$role1)) {
           $msg = $session_data['username']." ".'Try To Access Case By Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
          redirect('Admin/auth_error');
          }  

         $data['case_by'] = $this->legal_model->view_case_by();
         $msg = $session_data['username']." ".'Visited Case By Master Page.';
         $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
         $this->load->view('case_by_master',$this->security->xss_clean($data));
    }

    public function case_by_master_insert(){

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

          if(!in_array("Case By Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Case By Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
          redirect('Admin/auth_error');
          }  


         $data['case_by'] = $this->legal_model->view_case_by();

        $this->form_validation->set_rules('name','Contact Person Name','required');
        $this->form_validation->set_rules('email','Email','required|valid_email');
        $this->form_validation->set_rules('contact_number','Contact Number','required');
        $this->form_validation->set_rules('company_name','Company Name','required');

         if($this->form_validation->run() == false)
        {
       
           
          $this->load->view('case_by_master',$this->security->xss_clean($data));


           
        }
        else{

            $query = $this->legal_model->insertcaseby();
            $this->session->set_flashdata("case_by","Case By Details Added Successfully");
            $msg = $data['username']." ".'Added Case By Details Named'." " .$this->input->post('name'). '.';
            $this->user_activity_model->add('added',$msg,$data['username'],$data['admin_id']);
            redirect("Legal/case_by_master","refresh",$this->security->xss_clean($data));

        }
    }


    public function update_case_by(){
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

       $case_by = base64_decode($this->uri->segment(3));
     
       $data['case_by'] = $this->legal_model->case_by($case_by);

       foreach($data['case_by'] as $by){

        $contact_name = $by['case_by_contact_person'];
        $case_by_id = $by['case_by_id'];

       }

         if(($case_by == null OR $case_by == '') OR (!isset($case_by_id) OR $case_by_id !== $case_by OR $case_by_id == null OR $case_by_id == '')){

           show_404();
          exit();
          }

          if(!in_array("Case By Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Use Update Case By Details Page For'." ".$contact_name." ".'Update Case By Detail Page Access is Not Given to the'." ".$session_data['username'].'.'; 
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
          redirect('Admin/auth_error');
          }  
          $msg = $session_data['username']." ".'Visited Update Case By Details Page For'." ".$contact_name.'.';
          $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);   
          $this->load->view('update_case_by',$this->security->xss_clean($data));
    }

    public function update_case_by_redirect(){
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
        $case_by = base64_decode($this->uri->segment(3));

        $data['case_by'] = $this->legal_model->case_by($case_by);

        foreach($data['case_by'] as $by){

        $contact_name = $by['case_by_contact_person'];
        $case_by_id = $by['case_by_id'];

       }

         if(($case_by == null OR $case_by == '') OR (!isset($case_by_id) OR $case_by_id !== $case_by OR $case_by_id == null OR $case_by_id == '')){

           show_404();
          exit();
          }

          if(!in_array("Case By Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Use Update Case By Detail Page For'." ".$contact_name." ".'Update Case By Details Page Access is Not Given to the'." ".$session_data['username'].'.'; 
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
          redirect('Admin/auth_error');
          }  

        $this->form_validation->set_rules('name','Contact Person Name','required');
        $this->form_validation->set_rules('email','Email','required|valid_email');
        $this->form_validation->set_rules('contact_number','Contact Number','required');
        $this->form_validation->set_rules('company_name','Company Name','required');

         if($this->form_validation->run() == false)
        {
       
           
          $this->load->view('update_case_by',$this->security->xss_clean($data));


           
        }
        else{

               $query = $this->legal_model->update_case_by($case_by);

               $this->session->set_flashdata("update_case_by","Case By Details Updated Successfully");
                $msg = $data['username']." ".'Updated'." ".$this->input->post('name'). " ".'Case By Details.';
               $this->user_activity_model->add('updated',$msg,$data['username'],$data['admin_id']);
              redirect('Legal/case_by_master');

        } 


    }

    public function case_against_master(){
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

          if(!in_array("Case Against Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Case Against Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
          redirect('Admin/auth_error');
          }  

        $data['case_against'] = $this->legal_model->view_case_against(); 
         $msg = $session_data['username']." ".'Visited Case Against Master Page.';
         $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']); 
        $this->load->view('case_against_master',$this->security->xss_clean($data));
    }

    public function case_against_master_insert(){
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

          if(!in_array("Case Against Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Case Against Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
          redirect('Admin/auth_error');
          }  

        $data['case_against'] = $this->legal_model->view_case_against();

        $this->form_validation->set_rules('name','Contact Person Name','required');
        $this->form_validation->set_rules('email','Email','required|valid_email');
        $this->form_validation->set_rules('contact_number','Contact Number','required');
        $this->form_validation->set_rules('company_name','Company Name','required');

         if($this->form_validation->run() == false)
        {
       
           
        $this->load->view('case_against_master',$this->security->xss_clean($data));


           
        }
        else{

            $query = $this->legal_model->insertcaseagainst();
            $this->session->set_flashdata("case_against","Case Against Details Added Successfully");
            $msg = $data['username']." ".'Added Case Against Details Named'." " .$this->input->post('name'). '.';
            $this->user_activity_model->add('added',$msg,$data['username'],$data['admin_id']);
            redirect("Legal/case_against_master","refresh",$this->security->xss_clean($data));

        }
    }


    public function update_case_against(){
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

         $case_against = base64_decode($this->uri->segment(3));
         $data['case_against'] = $this->legal_model->case_against($case_against); 

         foreach($data['case_against'] as $against){
          $contact_name = $against['case_against_contact_person'];
          $case_against_id = $against['case_against_id'];

       }

         if(($case_against == null OR $case_against == '') OR (!isset($case_against_id) OR $case_against_id !== $case_against OR $case_against_id == null OR $case_against_id == '')){

           show_404();
          exit();
          }

          if(!in_array("Case Against Master",$role1)) {
           $msg = $session_data['username']." ".'Try To Use Update Case Against Details Page For'." ".$contact_name." ".'Update Case Against Detail Page Access is Not Given to the'." ".$session_data['username'].'.'; 
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
          redirect('Admin/auth_error');
          }  
        $msg = $session_data['username']." ".'Visited Update Case Against Details Page For'." ".$contact_name.'.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
        $this->load->view('update_case_against',$this->security->xss_clean($data));
    }

    public function update_case_against_redirect(){
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

         $case_against = base64_decode($this->uri->segment(3));
         $data['case_against'] = $this->legal_model->case_against($case_against);

          foreach($data['case_against'] as $against){
          $contact_name = $against['case_against_contact_person'];
          $case_against_id = $against['case_against_id'];

       }

         if(($case_against == null OR $case_against == '') OR (!isset($case_against_id) OR $case_against_id !== $case_against OR $case_against_id == null OR $case_against_id == '')){

           show_404();
          exit();
          }

          if(!in_array("Case Against Master",$role1)) {
           $msg = $session_data['username']." ".'Try To Use Update Case Against Details Page For'." ".$contact_name." ".'Update Case Against Detail Page Access is Not Given to the'." ".$session_data['username'].'.'; 
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
          redirect('Admin/auth_error');
          }  

        $this->form_validation->set_rules('name','Contact Person Name','required');
        $this->form_validation->set_rules('email','Email','required|valid_email');
        $this->form_validation->set_rules('contact_number','Contact Number','required');
        $this->form_validation->set_rules('company_name','Company Name','required');

         if($this->form_validation->run() == false)
        {
       
           
        $this->load->view('update_case_against',$this->security->xss_clean($data));


           
        }
        else{
               $query = $this->legal_model->update_case_against($case_against);

               $this->session->set_flashdata("update_case_against","Case Against Details Updated Successfully");
              $msg = $data['username']." ".'Updated'." ".$this->input->post('name'). " ".'Case Against Details.';
              $this->user_activity_model->add('updated',$msg,$data['username'],$data['admin_id']);                           
              redirect('Legal/case_against_master');

        } 


    }

    public function police_station_master(){
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

          if(!in_array("Police Station Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Police Station Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 
          redirect('Admin/auth_error');
          }  

        $data['police_station'] = $this->legal_model->view_police_station();
         $msg = $session_data['username']." ".'Visited Police Station Master Page.';
         $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']); 
        $this->load->view('police_station_master',$this->security->xss_clean($data));
    }

    public function police_station_master_insert(){
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

          if(!in_array("Police Station Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Police Station Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
          redirect('Admin/auth_error');
          }  

        $data['police_station'] = $this->legal_model->view_police_station();

        $this->form_validation->set_rules('police_station_name','Police Station Name','required');
        $this->form_validation->set_rules('contact_number','Contact Number','required');
        $this->form_validation->set_rules('branch','Branch','required');
        $this->form_validation->set_rules('address','Address','required');
        $this->form_validation->set_rules('state','State','required');
        $this->form_validation->set_rules('city','City','required');
        $this->form_validation->set_rules('pincode','Pincode','required');


         if($this->form_validation->run() == false)
        {
       
           
        $this->load->view('police_station_master',$this->security->xss_clean($data));


           
        }
        else{

            $query = $this->legal_model->insertpoilcestation();
            $this->session->set_flashdata("police_station","Police Station Details Added Successfully");
               $msg = $data['username']." ".'Added Police Station Details Named'." " .$this->input->post('police_station_name'). '.';
            $this->user_activity_model->add('added',$msg,$data['username'],$data['admin_id']);  
            redirect("Legal/police_station_master","refresh",$this->security->xss_clean($data));

        }
    }

    public function update_police_station_detail(){
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
        $police_station = base64_decode($this->uri->segment(3));
       $data['police_station'] = $this->legal_model->police_station($police_station);

       foreach($data['police_station'] as $police){
        $contact_name = $police['police_station_name'];
        $police_station_id = $police['police_station_id'];
       }

        if(($police_station == null OR $police_station == '') OR (!isset($police_station_id) OR $police_station_id !== $police_station OR $police_station_id == null OR $police_station_id == '')){

           show_404();
          exit();
          }

          if(!in_array("Police Station Master",$role1)) {
           $msg = $session_data['username']." ".'Try To Use Update Police Station Details Page For'." ".$contact_name." ".'Update Police Station Details Page Access is Not Given to the'." ".$session_data['username'].'.'; 
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
          redirect('Admin/auth_error');
          }  
        
        $msg = $session_data['username']." ".'Visited Update Police Station Details Page For'." ".$contact_name.'.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
        $this->load->view('update_police_station_detail',$this->security->xss_clean($data));
    }

    public function update_police_station_detail_redirect(){
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
       $police_station = base64_decode($this->uri->segment(3));

       $data['police_station'] = $this->legal_model->police_station($police_station);

        foreach($data['police_station'] as $police){
        $contact_name = $police['police_station_name'];
        $police_station_id = $police['police_station_id'];
       }

        if(($police_station == null OR $police_station == '') OR (!isset($police_station_id) OR $police_station_id !== $police_station OR $police_station_id == null OR $police_station_id == '')){

           show_404();
          exit();
          }

          if(!in_array("Police Station Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Use Update Police Station Details Page For'." ".$contact_name." ".'Update Police Station Details Page Access is Not Given to the'." ".$session_data['username'].'.'; 
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
          redirect('Admin/auth_error');
          }  

       $this->form_validation->set_rules('police_station_name','Police Station Name','required');
        $this->form_validation->set_rules('contact_number','Contact Number','required');
        $this->form_validation->set_rules('branch','Branch','required');
        $this->form_validation->set_rules('address','Address','required');
        $this->form_validation->set_rules('state','State','required');
        $this->form_validation->set_rules('city','City','required');
        $this->form_validation->set_rules('pincode','Pincode','required');


         if($this->form_validation->run() == false)
        {
       
           
        $this->load->view('update_police_station_detail',$this->security->xss_clean($data));


           
        }
        else{

               $query = $this->legal_model->update_police_station($police_station);

               $this->session->set_flashdata("update_police_station","Police Station Details Updated Successfully");
               $msg = $data['username']." ".'Updated'." ".$this->input->post('police_station_name'). " ".'Police Station Details.';
               $this->user_activity_model->add('updated',$msg,$data['username'],$data['admin_id']); 
              redirect('Legal/police_station_master');

        } 


    }

    public function court_authority_master(){
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

          if(!in_array("Court & Authority Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Legal Court & Authority Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);
   
          redirect('Admin/auth_error');
          }  

         $data['court_authority'] = $this->legal_model->view_court_authority();
         $msg = $session_data['username']." ".'Visited Legal Court & Authority Master Page.';
         $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);           
         $this->load->view('court_authority_master',$this->security->xss_clean($data));
    }

    public function court_authority_master_insert(){
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

          if(!in_array("Court & Authority Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Legal Court & Authority Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);
  
          redirect('Admin/auth_error');
          }  

         $data['court_authority'] = $this->legal_model->view_court_authority();

        $this->form_validation->set_rules('court_authority_name','Court Authority Name','required');

         if($this->form_validation->run() == false)
        {
       
           
            $this->load->view('court_authority_master',$this->security->xss_clean($data));


           
        }
        else{

            $query = $this->legal_model->insertcourtauthority();
            $this->session->set_flashdata("court_authority","Court Authority Added Successfully");
            $msg = $data['username']." ".'Added Legal Court & Authority Named'." " .$this->input->post('court_authority_name'). '.';
            $this->user_activity_model->add('added',$msg,$data['username'],$data['admin_id']);  
            redirect("Legal/court_authority_master","refresh",$this->security->xss_clean($data));

        }
    }


    public function update_court_authority_detail(){
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
        $court_authority = base64_decode($this->uri->segment(3));
         
        $data['court_authority'] = $this->legal_model->court_authority($court_authority); 

        foreach($data['court_authority'] as $authority){

          $contact_name = $authority['legal_court_authority'];
          $legal_authority_id = $authority['legal_authority_id'];
        }

        if(($court_authority == null OR $court_authority == '') OR (!isset($legal_authority_id) OR $legal_authority_id !== $court_authority OR $legal_authority_id == null OR $legal_authority_id == '')){

           show_404();
          exit();
          }

          if(!in_array("Court & Authority Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Use Update Legal Court & Authority Detail Page For'." ".$contact_name." ".'Update Legal Court & Authority Detail Page Access is Not Given to the'." ".$session_data['username'].'.'; 
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
          redirect('Admin/auth_error');
          }  
       $msg = $session_data['username']." ".'Visited Update Legal Court & Authority Detail Page For'." ".$contact_name.'.';
       $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);   
       $this->load->view('update_court_authority_detail',$this->security->xss_clean($data));

    }

    public function update_court_authority_detail_redirect(){
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
        $court_authority = base64_decode($this->uri->segment(3));
        $data['court_authority'] = $this->legal_model->court_authority($court_authority);

         foreach($data['court_authority'] as $authority){

          $contact_name = $authority['legal_court_authority'];
          $legal_authority_id = $authority['legal_authority_id'];
        }

        if(($court_authority == null OR $court_authority == '') OR (!isset($legal_authority_id) OR $legal_authority_id !== $court_authority OR $legal_authority_id == null OR $legal_authority_id == '')){

           show_404();
          exit();
          }

          if(!in_array("Court & Authority Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Use Update Legal Court & Authority Detail Page For'." ".$contact_name." ".'Update Legal Court & Authority Detail Page Access is Not Given to the'." ".$session_data['username'].'.'; 
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
          redirect('Admin/auth_error');
          }  

       $this->form_validation->set_rules('court_authority_name','Court Authority Name','required');

         if($this->form_validation->run() == false)
        {
       
           
          $this->load->view('update_court_authority_detail',$this->security->xss_clean($data));


           
        }
        else{

               $query = $this->legal_model->update_court_authority($court_authority);

               $this->session->set_flashdata("update_court_authority","Court Authority Updated Successfully");
              $msg = $data['username']." ".'Updated'." ".$this->input->post('court_authority_name'). " ".'Legal Court & Authority Details.';
              $this->user_activity_model->add('updated',$msg,$data['username'],$data['admin_id']);     
              redirect('Legal/court_authority_master');

        } 


    }

    public function case_status_master(){
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

          if(!in_array("Case Status Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Legal Case Status Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
          redirect('Admin/auth_error');
          }  
        
        $data['case_status'] = $this->legal_model->view_case_status();
         $msg = $session_data['username']." ".'Visited Legal Case Status Master Page.';
         $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']); 
        $this->load->view('case_status_master',$this->security->xss_clean($data));
    }

    public function case_status_master_insert(){
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

          if(!in_array("Case Status Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Legal Case Status Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
          redirect('Admin/auth_error');
          }  
        
        $data['case_status'] = $this->legal_model->view_case_status();

        $this->form_validation->set_rules('case_status','Case Status','required');

         if($this->form_validation->run() == false)
        {
       
           
         $this->load->view('case_status_master',$this->security->xss_clean($data));



           
        }
        else{

            $query = $this->legal_model->insertcasestatus();
            $this->session->set_flashdata("case_status","Case Status Added Successfully");
               $msg = $data['username']." ".'Added Legal Case Status Named'." " .$this->input->post('case_status'). '.';
            $this->user_activity_model->add('added',$msg,$data['username'],$data['admin_id']); 
            redirect("Legal/case_status_master","refresh",$this->security->xss_clean($data));

        }
    }

    public function update_case_status(){
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

        $case_status = base64_decode($this->uri->segment(3));
        $data['case_status'] = $this->legal_model->case_status($case_status);

        foreach($data['case_status'] as $case){
          $contact_name = $case['case_status'];
          $case_status_id = $case['case_status_id'];
        }

         if(($case_status == null OR $case_status == '') OR (!isset($case_status_id) OR $case_status_id !== $case_status OR $case_status_id == null OR $case_status_id == '')){

           show_404();
          exit();
          }

          if(!in_array("Case Status Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Use Update Legal Case Status Detail Page For'." ".$contact_name." ".'Update Legal Case Status Detail Page Access is Not Given to the'." ".$session_data['username'].'.'; 
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
          redirect('Admin/auth_error');
          }  
       $msg = $session_data['username']." ".'Visited Update Legal Case Status Details Page For'." ".$contact_name.'.';
       $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);   
       $this->load->view('update_case_status',$this->security->xss_clean($data));
    }

    public function update_case_status_redirect(){
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

       $case_status = base64_decode($this->uri->segment(3));
       $data['case_status'] = $this->legal_model->case_status($case_status);

       foreach($data['case_status'] as $case){
          $contact_name = $case['case_status'];
         $case_status_id = $case['case_status_id'];
        }

         if(($case_status == null OR $case_status == '') OR (!isset($case_status_id) OR $case_status_id !== $case_status OR $case_status_id == null OR $case_status_id == '')){

           show_404();
          exit();
          }

          if(!in_array("Case Status Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Use Update Legal Case Status Detail Page For'." ".$contact_name." ".'Update Legal Case Status Detail Page Access is Not Given to the'." ".$session_data['username'].'.'; 
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
          redirect('Admin/auth_error');
          }  


        $this->form_validation->set_rules('case_status','Case Status','required');

         if($this->form_validation->run() == false)
        {
       
           
         $this->load->view('update_case_status',$this->security->xss_clean($data));



           
        }
        else{

               $query = $this->legal_model->update_case_status($case_status);

               $this->session->set_flashdata("update_case_status","Case Status Updated Successfully");
              $msg = $data['username']." ".'Updated'." ".$this->input->post('case_status'). " ".'Legal Case Status Details.';
               $this->user_activity_model->add('updated',$msg,$data['username'],$data['admin_id']);  
              redirect('Legal/case_status_master');

        } 


    }



   
}    