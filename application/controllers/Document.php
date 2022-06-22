<?php

class Document extends CI_Controller {

    public function __construct() {
    	 parent::__construct();
    	$this->load->helper(array('form', 'url','security', 'string'));
        $this->load->library(array('form_validation','session','upload','encryption'));         
        $this->load->model('document_model');
        $this->load->model('user_activity_model');
        error_reporting(0);
    }

    public function document_master(){
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
        if(!in_array("Document Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Document Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
        redirect('Admin/auth_error');
        }
         $data['document_type'] = $this->document_model->view_document_type();
         $msg = $session_data['username']." ".'Visited Document Master Page.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
    			$this->load->view('doc_master',$this->security->xss_clean($data));
    	
    }

    public function document_master_insert(){
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
        if(!in_array("Document Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Document Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);     
        redirect('Admin/auth_error');
        }
         $data['document_type'] = $this->document_model->view_document_type();

         $this->form_validation->set_rules('document_name','Document Name','required');
         $this->form_validation->set_rules('document_type','Document Type','required');
         $this->form_validation->set_rules('document_nature','Document Nature','required');
         $this->form_validation->set_rules('document_state','Document State','required');
         $this->form_validation->set_rules('renewal','Document Renewal','required');

          if($this->form_validation->run() === FALSE)
         {

          $this->load->view('doc_master',$this->security->xss_clean($data));
       }
       else{
        $this->document_model->add_document();
        $this->session->set_flashdata("add_document","Document Details Added Successfully");
        $msg = $session_data['username']." ".'Added Document Named'." ".$this->input->post('document_name').'.';
        $this->user_activity_model->add('added',$msg,$data['username'],$data['admin_id']);

          if(in_array("Document Lists",$role1)) {
              redirect('Document/document_list');
          } else {

            redirect('Document/document_master');

          }    
       }  
      
    }

     public function document_list(){
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
        if(!in_array("Document Lists",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Document List Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
        redirect('Admin/auth_error');
        }
        $data['document'] = $this->document_model->view_document();
        $data['document_type'] = $this->document_model->view_document_type();
       
        $msg = $session_data['username']." ".'Visited Document List Page.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);

    	 $this->load->view('doc_lists',$this->security->xss_clean($data));
    }

    public function document_filter(){

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
        if(!in_array("Document Lists",$role1)) {
        redirect('Admin/auth_error');
        }

        $data['document_type'] = $this->document_model->view_document_type();

        if(!empty($this->input->post('document_type'))){

          $document_type = $this->input->post('document_type');

        }else{

            $document_type = "";
        }

        if(!empty($this->input->post('document_nature'))){

            $document_nature = $this->input->post('document_nature');

        } else {

           $document_nature = "";

        }


        if($document_type !== "" AND $document_nature !== ""){

          $query = $this->db->query('SELECT cc.*,dt.*, COUNT(c.document_id) AS code_count FROM upload_document_master c RIGHT JOIN document_master cc on cc.document_id = c.document_id INNER JOIN document_type_master dt on cc.document_type = dt.document_type_id  WHERE cc.document_type = "'.$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$document_type)).'" AND cc.document_nature = "'.$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$document_nature)).'" GROUP BY cc.document_id DESC');
            $data['document'] =  $query->result_array();
            $this->load->view('doc_lists',$this->security->xss_clean($data));

        } elseif($document_type !== "" AND $document_nature == ""){

           $query = $this->db->query('SELECT cc.*,dt.*, COUNT(c.document_id) AS code_count FROM upload_document_master c RIGHT JOIN document_master cc on cc.document_id = c.document_id INNER JOIN document_type_master dt on cc.document_type = dt.document_type_id WHERE cc.document_type = "'.$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$document_type)).'" GROUP BY cc.document_id DESC');
            $data['document'] =  $query->result_array();
            $this->load->view('doc_lists',$this->security->xss_clean($data));

        } elseif($document_type == "" AND $document_nature !== ""){

           $query = $this->db->query('SELECT cc.*,dt.*, COUNT(c.document_id) AS code_count FROM upload_document_master c RIGHT JOIN document_master cc on cc.document_id = c.document_id INNER JOIN document_type_master dt on cc.document_type = dt.document_type_id  WHERE cc.document_nature = "'.$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$document_nature)).'" GROUP BY cc.document_id DESC');
            $data['document'] =  $query->result_array();
            $this->load->view('doc_lists',$this->security->xss_clean($data));                

        } else {

          $this->session->set_flashdata("select_data","Please Select Any Filter Field For Search");
            redirect('Document/document_list/',$this->security->xss_clean($data));

        }


    }


     public function edit_document_detail(){
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
        $document_id = base64_decode($this->uri->segment(3));

        $data['document']=$this->document_model->view_document_detail($document_id);
        foreach($data['document'] as $doc){

          $doc_name = $doc['document_name'];
          $doc_id = $doc['document_id'];
        }

         if(($document_id == null OR $document_id == '') OR (!isset($doc_id) OR $doc_id !== $document_id OR $doc_id == null OR $doc_id == '')){

             show_404();
            exit();
        }
        if(!in_array("Document Lists",$role1)) {
        $msg = $session_data['username']." ".'Try To View Edit Document Data Page For'." ".$doc_name." ".'Edit Document Data Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);     
        redirect('Admin/auth_error');
        }

         $data['document_type'] = $this->document_model->view_document_type();
         $msg = $session_data['username']." ".'Visited Edit Document Data Page For'." ".$doc_name.'.';
       $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
          $this->load->view('edit_document_detail',$this->security->xss_clean($data));


    }

    public function edit_document_detail_redirect(){
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
        $document_id = base64_decode($this->uri->segment(3));

        $data['document']=$this->document_model->view_document_detail($document_id);

         foreach($data['document'] as $doc){

          $doc_name = $doc['document_name'];
         $doc_id = $doc['document_id'];
        }

         if(($document_id == null OR $document_id == '') OR (!isset($doc_id) OR $doc_id !== $document_id OR $doc_id == null OR $doc_id == '')){

             show_404();
            exit();
        }
        if(!in_array("Document Lists",$role1)) {
        $msg = $session_data['username']." ".'Try To View Edit Document Data Page For'." ".$doc_name." ".'Edit Document Data Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
        redirect('Admin/auth_error');
        }

         $data['document_type'] = $this->document_model->view_document_type();

         $this->form_validation->set_rules('document_name','Document Name','required');
         $this->form_validation->set_rules('document_type','Document Type','required');
         $this->form_validation->set_rules('document_nature','Document Nature','required');
         $this->form_validation->set_rules('document_state','Document State','required');
         $this->form_validation->set_rules('renewal','Document Renewal','required');

           if($this->form_validation->run() === FALSE)
         {

          $this->load->view('edit_document_detail',$this->security->xss_clean($data));
       }
       else{

               $query = $this->document_model->update_document($document_id);
               
               $this->session->set_flashdata("document_update","Document Details Updated Successfully");
               $msg = $data['username']." ".'Updated'." ".$this->input->post('document_name'). " ".'Document Details.';
               $this->user_activity_model->add('updated',$msg,$data['username'],$data['admin_id']);
              redirect('Document/document_list');

            }   


    }

        public function delete_document_detail(){
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
        $document_id = base64_decode($this->uri->segment(3));

         $data['document']=$this->document_model->view_document_detail($document_id);

         foreach($data['document'] as $doc){

          $doc_name = $doc['document_name'];
          $doc_id = $doc['document_id'];
        }

         if(($document_id == null OR $document_id == '') OR (!isset($doc_id) OR $doc_id !== $document_id OR $doc_id == null OR $doc_id == '')){

             show_404();
            exit();
        }
        if(!in_array("Document Lists",$role1)) {
        $msg = $session_data['username']." ".'Try To Delete Document Details For'." ".$doc_name." ".'Document List Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
        redirect('Admin/auth_error');
        }

        $this->document_model->delete_document($document_id);

        $this->session->set_flashdata("document_delete","Document Details Deleted successfully.");
        $msg = $data['username']." ".'Deleted Document Details For'." ".$doc_name. '.';
          $this->user_activity_model->add('deleted',$msg,$data['username'],$data['admin_id']);
        redirect("Document/document_list","refresh");
    }


    public function document_type_master(){
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
        if(!in_array("Document Type Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Document Type Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
        redirect('Admin/auth_error');
        }
    	
        $data['document_type'] = $this->document_model->view_document_type();
        $msg = $session_data['username']." ".'Visited Document Type Master Page.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);   
        $this->load->view('doc_type_master',$this->security->xss_clean($data));
    }

    public function document_type_master_insert(){
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
        if(!in_array("Document Type Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Document Type Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);     
        redirect('Admin/auth_error');
        }
      
        $data['document_type'] = $this->document_model->view_document_type();

        $this->form_validation->set_rules('doc_type','Document Type','required');

         if($this->form_validation->run() == false)
        {
       
           
        $this->load->view('doc_type_master',$this->security->xss_clean($data));


           
        }
        else{

            $query = $this->document_model->insertdocumenttype();
            $this->session->set_flashdata("document_type","Document Type Added Successfully");
            $msg = $data['username']." ".'Added Document Type Named'." " .$this->input->post('doc_type'). '.';
            $this->user_activity_model->add('added',$msg,$data['username'],$data['admin_id']);
            redirect("Document/document_type_master","refresh",$data);

        }
    }

     public function update_document_type(){
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

        $data['document_type'] = $this->document_model->document_type($type);

        foreach($data['document_type'] as $doc_type){
          $document_type = $doc_type['document_type'];
          $doc_type_id = $doc_type['document_type_id'];
        }

         if(($type == null OR $type == '') OR (!isset($doc_type_id) OR $doc_type_id !== $type OR $doc_type_id == null OR $doc_type_id == '')){

             show_404();
            exit();
        }

        if(!in_array("Document Type Master",$role1)) {
         $msg = $session_data['username']." ".'Try To Use Update Document Type Page For'." ".$document_type." ".'Update Document Type Page Access is Not Given to the'." ".$session_data['username'].'.'; 
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
        redirect('Admin/auth_error');
        }
          $msg = $session_data['username']." ".'Visited Update Document Type Page For'." ".$document_type.'.';
       $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
          $this->load->view('update_document_type',$this->security->xss_clean($data));
    }

    public function update_document_type_redirect(){
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

        $data['document_type'] = $this->document_model->document_type($type);

         foreach($data['document_type'] as $doc_type){
          $document_type = $doc_type['document_type'];
         $doc_type_id = $doc_type['document_type_id'];
        }

         if(($type == null OR $type == '') OR (!isset($doc_type_id) OR $type !== $doc_type_id OR $doc_type_id == null OR $doc_type_id == '')){

             show_404();
            exit();
        }
        if(!in_array("Document Type Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Use Update Document Type Page For'." ".$document_type." ".'Update Document Type Page Access is Not Given to the'." ".$session_data['username'].'.'; 
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);      
        redirect('Admin/auth_error');
        }

       $this->form_validation->set_rules('doc_type','Document Type','required');

        if($this->form_validation->run() === FALSE)
         {

          $this->load->view('update_document_type',$this->security->xss_clean($data));
       }
       else{

               $query = $this->document_model->update_document_type($type);

               $this->session->set_flashdata("update_document_type","Document Type Updated Successfully");
               $msg = $data['username']." ".'Updated'." ".$this->input->post('doc_type'). " ".'Document Type Details.';
                  $this->user_activity_model->add('updated',$msg,$data['username'],$data['admin_id']);
              redirect('Document/document_type_master');

        } 


    }

    public function document_summary(){
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
        if(!in_array("Document Summary",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Document Summary Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
        redirect('Admin/auth_error');
        }

        //$data['property'] = $this->document_model->view_property();
        $data['property'] = $this->document_model->view_property_for_filter();
       
         $data['document_summary'] = $this->document_model->view_document_summary();
      $msg = $session_data['username']." ".'Visited Document Summary Page.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);     
      $this->load->view('doc_summary',$this->security->xss_clean($data));
    }

    public function upload_document(){
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
        if(!in_array("Document Summary",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Upload Document Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);      
        redirect('Admin/auth_error');
        }

        $data['document'] = $this->document_model->view_document();
         $data['property'] = $this->document_model->view_property();
         $data['document_authority'] = $this->document_model->view_document_authority();
         $msg = $session_data['username']." ".'Visited Document Upload Page.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);  
    	 $this->load->view('upload_document',$this->security->xss_clean($data));
    }

     public function document_detail(){

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
        if(!in_array("Document Summary",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Upload Document Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);        
        redirect('Admin/auth_error');
        }


         $this->form_validation->set_rules('property_name','Property Name','required');
         $this->form_validation->set_rules('document_name','Document Name','required');
         $this->form_validation->set_rules('document_for','Document For','required');
         $this->form_validation->set_rules('document_authority','Document Authority','required');
         $this->form_validation->set_rules('document_number','Document Number','required');
         $this->form_validation->set_rules('registration_date','Registration Date','required');
         $this->form_validation->set_rules('execution_date','Execution Day','required');
         $this->form_validation->set_rules('notification_day','Notification Day','required');
        

         if (empty($_FILES['userfile']['name']))
        {
          $this->form_validation->set_rules('userfile', 'Document Upload', 'required');
        }

        $data['document'] = $this->document_model->view_document();
         $data['property'] = $this->document_model->view_property();
         $data['document_authority'] = $this->document_model->view_document_authority();

         $document_renewal = $this->document_model->get_document_renewal($this->input->post('document_name'));
         
         foreach ($document_renewal as $renew) {
          if($renew['document_renewal'] == 'Yes'){
            $this->form_validation->set_rules('renewal_date','Renewal Date','required');
            }
         }

        /* if(!empty($this->document_model->get_uploaded_document_all_data($this->input->post('property_name')))){
          $uploaded_document = $this->document_model->get_uploaded_document_all_data($this->input->post('property_name'));

         foreach ($uploaded_document as $doc) {
          if($doc['document_id'] == $this->input->post('document_name')){

             $this->session->set_flashdata("check_property_upload","Document Can't Upload Document Exist For the Same.");
                    
                    redirect("Document/document_summary","refresh",$data);

          }
        }
        }*/

              
           if($this->form_validation->run() === FALSE)
            {
      
                $this->load->view('upload_document',$this->security->xss_clean($data));
            }
            else{

                $data['post'] = $this->input->post();


                 $random_string = random_string('alnum', 10);
              if (!is_dir('assets/images/uploads/documents/'.str_replace(' ', '_', $this->input->post('property_name')).$random_string)) {
                    mkdir('assets/images/uploads/documents/' . str_replace(' ', '_', $this->input->post('property_name')).$random_string, 0777, TRUE);
                }
        $ipath = realpath(APPPATH . '../assets/images/uploads/documents/'.str_replace(' ', '_', $this->input->post('property_name').$random_string));
        chmod($ipath,0777);



         $strInputFileName = "userfile";
            $arrFiles = $_FILES;

            $config['upload_path'] = $ipath;
            $config['allowed_types'] = "jpg|png|jpeg|pdf|JPG|PNG|JPEG|PDF|Zip|zip|rar";
            $config['max_size'] = '500000';
            $config['max_width']  = '1024000';
            $config['max_height']  = '768000';

            /*$config['max_size'] = '3072';
            $config['max_width'] = '3000';
            $config['max_height'] = '3000';*/


            $config['file_name'] = $this->getRandomFileName();


            $this->upload->initialize($config);
                if(!$this->upload->do_upload($strInputFileName)) 
                {
                  $error = array('error' => $this->upload->display_errors());
                                        
                  $this->session->set_flashdata('new_in',2);
                   $this->load->view("upload_document",$this->security->xss_clean($data));
                } 
                else 
                {
                    $uploadData = $this->upload->data();
                    //chmod($uploadData,0777);
                    $filename = $uploadData['file_name'];

                    if(!empty($this->input->post('renewal_date'))){
                       $renewal_date = $this->input->post('renewal_date');
                 $newrDate = date("Y-m-d", strtotime($renewal_date));
                    }
                    else{
                      $newrDate = '';
                    }

                    $execution_date = $this->input->post('execution_date');
              $neweDate = date("Y-m-d", strtotime($execution_date));

              $registration_date = $this->input->post('registration_date');
              $newregDate = date("Y-m-d", strtotime($registration_date));

                    $document_data = array(              
                    'property_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('property_name'))),
                    'document_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('document_name'))),
                    'document_for' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('document_for'))),
                    'document_authority_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('document_authority'))),
                    'renewal_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$newrDate)),
                    'document_number' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('document_number'))),
                    'registration_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$newregDate)),
                    'execution_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$neweDate)),
                    'notification_day' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('notification_day'))),
                    'document_upload' => $this->db->escape_str(base64_encode(str_replace(' ', '_', $this->input->post('property_name')).$random_string.'/'.$filename)),
                    'document_uploaded_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
                    );             
                 
                   $this->document_model->upload_document($document_data);

                   $data['document_data'] = $this->document_model->view_document_detail($this->input->post('document_name'));

                   foreach($data['document_data'] as $doc_data){

                    $doc_name = $doc_data['document_name'];
                   }

                   $data['property_data'] = $this->document_model->view_document_summary_property_detail($this->input->post('property_name'));

                   foreach($data['property_data'] as $prop_data){

                    $prop_name = $prop_data['property_name'];
                   }


                    $this->session->set_flashdata("document_upload","Document Uploaded Successfully");
                     $msg = $session_data['username']." ".'Uploaded Document Name'." ".$doc_name." ".'For Property Name'." ".$prop_name.'.';
                     $this->user_activity_model->add('uploaded_document',$msg,$session_data['username'],$session_data['admin_id']);  
                    redirect("Document/document_summary","refresh",$this->security->xss_clean($data));
                   
                }
          }

    }

        private function getRandomFileName()
{
    $random = rand(1, 10000000000000000);
    return hash('sha512', $random.$this->input->post('title') . config_item("encryption_key"));
}

    public function document_authority(){
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
        if(!in_array("Document Authority",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Document Authority Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
        redirect('Admin/auth_error');
        }

        $data['document_authority'] = $this->document_model->view_document_authority();
        $msg = $session_data['username']." ".'Visited Document Authority Page.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
        $this->load->view('document_authority',$this->security->xss_clean($data));
    }

    public function document_authority_insert(){
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
        if(!in_array("Document Authority",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Document Authority Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);     
        redirect('Admin/auth_error');
        }


        $data['document_authority'] = $this->document_model->view_document_authority();

        $this->form_validation->set_rules('document_authority','Document Authority','required');

         if($this->form_validation->run() == false)
        {
     
                $this->load->view('document_authority',$this->security->xss_clean($data));
        }
        else{

            $query = $this->document_model->insertdocumentauthority();
            $this->session->set_flashdata("document_authority","Document Authority Added Successfully");
             $msg = $data['username']." ".'Added Document Authority Named'." ".$this->input->post('document_authority'). '.';
            $this->user_activity_model->add('added',$msg,$data['username'],$data['admin_id']);
            redirect("Document/document_authority","refresh",$data);

        }
    }

    public function update_document_authority(){
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
       $authority = base64_decode($this->uri->segment(3));

       $data['document_authority'] = $this->document_model->document_authority($authority);

       foreach($data['document_authority'] as $doc_auhtority){

        $authority1 = $doc_auhtority['document_authority'];
        $auth_id = $doc_auhtority['document_auth_id'];
       }


        if(($authority == null OR $authority == '') OR (!isset($auth_id) OR $auth_id !== $authority OR $auth_id == null OR $auth_id == '')){

             show_404();
            exit();
        }

        if(!in_array("Document Authority",$role1)) {
        $msg = $session_data['username']." ".'Try To Use Update Document Authority Page For'." ".$authority1." ".'Update Document Authority Page Access is Not Given to the'." ".$session_data['username'].'.'; 
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
        redirect('Admin/auth_error');
        }

       $msg = $session_data['username']." ".'Visited Update Document Authority Page For'." ".$authority1.'.';
       $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
       $this->load->view('update_document_authority',$this->security->xss_clean($data));
    }

    public function update_document_authority_redirect(){
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
       $authority = base64_decode($this->uri->segment(3));
       $data['document_authority'] = $this->document_model->document_authority($authority);

       foreach($data['document_authority'] as $doc_auhtority){

        $authority1 = $doc_auhtority['document_authority'];
       $auth_id = $doc_auhtority['document_auth_id'];
       }


        if(($authority == null OR $authority == '') OR (!isset($auth_id) OR $auth_id !== $authority OR $auth_id == null OR $auth_id == '')){

             show_404();
            exit();
        }
        if(!in_array("Document Authority",$role1)) {
        $msg = $session_data['username']." ".'Try To Use Update Document Authority Page For'." ".$authority1." ".'Update Document Authority Page Access is Not Given to the'." ".$session_data['username'].'.'; 
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);     
        redirect('Admin/auth_error');
        }

       $this->form_validation->set_rules('document_authority','Document Authority','required');

         if($this->form_validation->run() === FALSE)
         {

          $this->load->view('update_document_authority',$this->security->xss_clean($data));
       }
       else{

               $query = $this->document_model->update_document_authority($authority);

               $this->session->set_flashdata("update_document_authority","Document Authority Updated Successfully");
                $msg = $data['username']." ".'Updated'." ".$this->input->post('document_authority'). " ".'Document Authority Details.';
                  $this->user_activity_model->add('updated',$msg,$data['username'],$data['admin_id']);
              redirect('Document/document_authority');

        } 


    }

    public function document_list_renewals(){
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
        if(!in_array("List of Renewals",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Document List Renewal Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
        redirect('Admin/auth_error');
        }


      $data['document_summary'] = $this->document_model->view_document_summary();
      $msg = $session_data['username']." ".'Visited Document List Renewal Page.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']); 
    	$this->load->view('list_renewals',$this->security->xss_clean($data));
    }

    public function document_renewal_filter(){

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
        if(!in_array("List of Renewals",$role1)) {
        redirect('Admin/auth_error');
        }

      $data['document_summary'] = $this->document_model->view_document_summary();

      $renewal_start_date="";
        $renewal_end_date="";
        if(!empty($this->input->post('renewal_start_date'))){
            $renewal_start_date = date("Y-m-d", strtotime($this->input->post('renewal_start_date')));
        }

         if(!empty($this->input->post('renewal_end_date'))){
            $renewal_end_date = date("Y-m-d", strtotime($this->input->post('renewal_end_date')));
        }

        $this->form_validation->set_rules('renewal_start_date','Renewal Start Date','required');
       $this->form_validation->set_rules('renewal_end_date','Renewal End Date','required');

        if($this->form_validation->run() == FALSE){

          $this->load->view('list_renewals',$this->security->xss_clean($data));

        }else {

            $this->db->order_by('upload_document_id','desc');
            $this->db->join('document_master','upload_document_master.document_id = document_master.document_id');
            $this->db->join('property_master','upload_document_master.property_id = property_master.property_id');
            $this->db->join('document_type_master','document_master.document_type = document_type_master.document_type_id');
            $this->db->join('document_authority_master','upload_document_master.document_authority_id = document_authority_master.document_auth_id');

            $this->db->where('upload_document_master.renewal_date >=', $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$renewal_start_date)));
            $this->db->where('upload_document_master.renewal_date <=', $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$renewal_end_date)));

                $query1 = $this->db->get('upload_document_master');

                $data['document_summary']  = $query1->result_array();
                $this->load->view('list_renewals',$this->security->xss_clean($data));

        }

    }

     public function document_summary_filter()
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
        if(!in_array("Document Summary",$role1)) {
        redirect('Admin/auth_error');
        }


       
       //$data['property'] = $this->document_model->view_property();
        $data['property'] = $this->document_model->view_property_for_filter();
       

        $property = $this->input->post('property_name');
        $property_state = "";
        if(!empty($data['property']) AND $property !== ""){
        $property_state = $this->document_model->get_property_state($property)->state;
        $data['fin_status'] = $this->document_model->get_property_finacial_status($property);
        }
        $uploaded_property = "";
        if(!empty($this->document_model->get_uploaded_property($property))){
        	  $uploaded_property = $this->document_model->get_uploaded_property($property);
            foreach($uploaded_property as $upload){
              $property_id = $upload['property_id'];
              $document_id = $upload['document_id'];
            }
            

        }
        else{
               $property_id = '';
              $document_id = '';
            }
      
	      /*if($property == ""){
	      	$data['document_summary'] = $this->document_model->view_document_summary();
	      }	*/

        if($property !== ""){

        $query1 = $this->db->join('document_master','upload_document_master.document_id = document_master.document_id','right');
        $query1 = $this->db->join('property_master','upload_document_master.property_id = property_master.property_id','left');
        $query1 = $this->db->from('upload_document_master');

        $where = "upload_document_master.property_id='".$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$property))."'";

         $this->db->where($where);

         $query1 = $this->db->get();
         $data['document_summary']  = $query1->result_array();

          $query2 = $this->db->join('document_master','upload_document_master.document_id = document_master.document_id','right');
        $query2 = $this->db->join('property_master','upload_document_master.property_id = property_master.property_id','left');
        $query2 = $this->db->from('upload_document_master');
      
       if($property == $property_id){
       	$where = "document_master.document_state = '".$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$property_state))."' AND document_nature='Compulsory' AND upload_document_master.document_id IS NULL OR (upload_document_master.document_id !='".$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$document_id))."' AND upload_document_master.property_id!='".$property_id."' AND document_master.document_state = '".$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$property_state))."') AND (upload_document_master.document_id = document_master.document_id AND document_master.document_nature = '".$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",'Compulsory'))."')";
        $this->db->group_by('document_master.document_name');

       }
       else{
       	$where = "document_master.document_state = '".$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$property_state))."' AND document_nature='Compulsory'";
        $this->db->group_by('document_master.document_name');
       }

         $this->db->where($where);

         $query2 = $this->db->get();
         $data['document_summary1']  = $query2->result_array();
         $this->load->view('doc_summary',$this->security->xss_clean($data));

         } else{
            $this->session->set_flashdata("select_data","Please Select Any Filter Field For Search");
            redirect('Document/document_summary/',$this->security->xss_clean($data));
         }

    }

    public function view_document_summary_data(){

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
          $document_id = base64_decode($this->uri->segment(3));
          
          $property_id = '';

        $data['document_summary']=$this->document_model->view_document_summary_detail($document_id);
         foreach($data['document_summary'] as $doc_sum){

          $property_id = $doc_sum['property_id'];
          $property_name = $doc_sum['property_name'];
           $document_name = $doc_sum['document_name'];
           $doc_id = $doc_sum['upload_document_id'];
        }

         if( ($document_id == null OR $document_id == '') OR (!isset($doc_id) OR $doc_id !== $document_id OR $doc_id == null OR $doc_id == '' ) ) {

             show_404();
            exit();
          }


        if(!in_array("Document Summary",$role1)) {
        $msg = $session_data['username']." ".'Try to Viewed Uploaded Document Details For Document Name'." ".$document_name." ".'For Property Name'." ".$property_name." ".'Document Summary Access is Not Given to'." ".$session_data['username'].'.';  
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);
        redirect('Admin/auth_error');
        }

        $prop_access_array = explode(",",$data['prop_access']);


       $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);
       
        if (empty($data['document_summary'])) {
            show_404();
        }

         if($property_id == $final_property_access){
                $msg = $session_data['username']." ".'Viewed Uploaded Document Details For Document Name'." ".$document_name." ".'For Property Name'." ".$property_name.'.';
                 $this->user_activity_model->add('viewed',$msg,$data['username'],$data['admin_id']);  
                $this->load->view('view_document_summary_data',$this->security->xss_clean($data));
            } else {
              $msg = $session_data['username']." ".'Try to Viewed Uploaded Document Details For Document Name'." ".$document_name." ".'For Property Name'." ".$property_name." ".'That Property Access is Not Given to'." ".$session_data['username'].'.';  
              $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);
              redirect('Admin/auth_error');
            }


    }

    public function download_document(){

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

        $upload_document_id = base64_decode($this->uri->segment(3));

        $data['upload_document'] = $this->document_model->view_document_summary_detail($upload_document_id);

        foreach($data['upload_document'] as $doc_sum){

          $property_name = $doc_sum['property_name'];
           $document_name = $doc_sum['document_name'];
           $doc_id = $doc_sum['upload_document_id'];
        }

         if( ($upload_document_id == null OR $upload_document_id == '') OR (!isset($doc_id) OR $doc_id !== $upload_document_id OR $doc_id == null OR $doc_id == '' ) ) {

             show_404();
            exit();
          }
        if(!in_array("Document Summary",$role1)) {
        $msg = $session_data['username']." ".'Try to Download Uploaded Document Details For Document Name'." ".$document_name." ".'For Property Name'." ".$property_name." ".'Document Download Access is Not Given to'." ".$session_data['username'].'.';  
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 	
        redirect('Admin/auth_error');
        }


        $property_id = $this->document_model->property_id_detail($upload_document_id);
        $property_id_array = explode(",",$this->document_model->property_id_detail($upload_document_id));

        $prop_access_array = explode(",",$data['prop_access']);
        $common_access = array_intersect($prop_access_array,$property_id_array);

        $final_property_access = implode(",",$common_access);
        if($property_id !== $final_property_access){
        	   $msg = $session_data['username']." ".'Try to Download Uploaded Document Details For Document Name'." ".$document_name." ".'For Property Name'." ".$property_name." ".'That Property Access is Not Given to'." ".$session_data['username'].'.'; 
        	   $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);	
              redirect('Admin/auth_error');
            }


          if(!empty($upload_document_id)){

            
            //load download helper
            $this->load->helper('download');

            
            
            //get file info from database
            $fileInfo = $this->document_model->download_detail($upload_document_id);
            $fileInfo1 = base64_decode($fileInfo);
            
            //file path
            $file = file_get_contents(base_url().'assets/images/uploads/documents/'.$fileInfo1);
            $msg = $session_data['username']." ".'Downloaded Uploaded Document Details For Document Name'." ".$document_name." ".'For Property Name'." ".$property_name.'.'; 
            $this->user_activity_model->add('download_document',$msg,$data['username'],$data['admin_id']);
            //download file from directory
            force_download($fileInfo1, $file);
            redirect('Document/view_document_summary_data/'.$this->security->xss_clean($upload_document_id));
        } 
    }

        public function get_document(){

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
        if(!in_array("Document Summary",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Upload Document Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);      	
        redirect('Admin/auth_error');
        }

        $id = $this->input->post('id',TRUE);
        $property_data = $this->document_model->get_property_state($id)->state;
        $data = $this->document_model->get_document_acc_state($property_data);
        echo json_encode($this->security->xss_clean($data));
     
       
    }

     public function get_document_renewal(){

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
        if(!in_array("Document Summary",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Upload Document Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);      	
        redirect('Admin/auth_error');
        }

        $id = $this->input->post('id',TRUE);
        $data = $this->document_model->get_document_renewal($id);
         echo json_encode($this->security->xss_clean($data));
     
       
    }


    public function markrenew()
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
        $upload_document_id = $this->input->post('upload_document_id');

        $data['upload_document'] = $this->document_model->view_document_summary_detail($upload_document_id);

        foreach($data['upload_document'] as $doc_sum){

          $property_name = $doc_sum['property_name'];
           $document_name = $doc_sum['document_name'];
        $doc_id = $doc_sum['upload_document_id'];
        }

         if( ($upload_document_id == null OR $upload_document_id == '') OR (!isset($doc_id) OR $doc_id !== $upload_document_id OR $doc_id == null OR $doc_id == '' ) ) {

             show_404();
            exit();
          }
        if(!in_array("List of Renewals",$role1)) {
 		    $msg = $session_data['username']." ".'Try to Renew Document For Property List of Renewal Page Access is Not Given to'." ".$session_data['username'].'.';  
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 	
        redirect('Admin/auth_error');
        }

        $document_id = $this->input->post('document_id');


        $data['upload_doc_data'] = $this->document_model->view_uploaded_document_detail($document_id);

        $prop_access_array = explode(",",$data['prop_access']);

        foreach($data['upload_doc_data'] as $doc_sum){

          $property_id = $doc_sum['property_id'];
        }

         $property_array = explode(",",$property_id);
         $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

          if($property_id !== $final_property_access){
          	  $msg = $session_data['username']." ".'Try to Renew Document For Property Which Property Access is Not Given to'." ".$session_data['username'].'.';  
       		  $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 		
              redirect('Admin/auth_error');
            }

         $renewal_date = $this->input->post('next_renewal_date');
      $newrDate = date("Y-m-d", strtotime($renewal_date));


        foreach($data['upload_doc_data'] as $doc){

          $renewal_date_db = $doc['renewal_date'];

          if($renewal_date_db == $newrDate){

            $this->session->set_flashdata("document_renewal_fail","Renewal Date is not Same As Old Renewal Date");

              redirect('Document/document_list_renewals');

          } else{
            $document_data = array(              
              'renewal_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$newrDate)),
              'is_renewed' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",'1'))
              );             
           
             $this->document_model->renew_upload_status($document_data,$this->input->post('did'));

             $this->session->set_flashdata("document_renewal_success","Document Renewed Successfully");
              $msg = $session_data['username']." ".'Renewed Document Details For Document Name'." ".$document_name." ".'For Property Name'." ".$property_name.'.';  
       		  $this->user_activity_model->add('mark_renew',$msg,$session_data['username'],$session_data['admin_id']); 
             redirect('Document/document_list_renewals');

          }
      }
          
    }

}    

