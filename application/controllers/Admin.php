<?php

class Admin extends CI_Controller {

    public function __construct() {
    	 parent::__construct();
         $this->load->helper(array('form', 'url','security'));
         $this->load->model('admin_model');
         $this->load->model('user_activity_model');
         $this->load->library(array('form_validation','session','zip'));
         $this->load->library('pagination');
         $this->load->library('upload');
         $this->load->library('user_agent'); 
         error_reporting(0);
    }

    public function auth_error() {
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

        $this->load->view("access_message",$this->security->xss_clean($data));
    }    

    public function dashboard() {
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

        $msg = $session_data['username']." ".'Visited Dashboard.';
         $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);

            $data['total_property'] = $this->admin_model->total_property();
            $data['property_given_on_rent'] = $this->admin_model->property_given_on_rent();
            $data['property_taken_on_rent'] = $this->admin_model->property_taken_on_rent();
            $data['legal_cases'] = $this->admin_model->legal_cases();

           $data['property_count'] = $this->admin_model->property_count();

            $data['insurance_renew_total'] = $this->admin_model->insurance_renew_total();
            $data['installment_payable_total'] = $this->admin_model->installment_payable_total(); 
            $data['rent_payable_total'] = $this->admin_model->rent_payable_total(); 
            $data['insurance_renew_list'] = $this->admin_model->insurance_renew_list();    
            $data['installment_payable_list'] = $this->admin_model->installment_payable_list(); 
            $data['log_details'] = $this->admin_model->get_log_details($session_data['admin_id']);  
            $data['last_log'] =  $this->admin_model->get_last_login_details($session_data['admin_id']);

            $data['lease_own'] = $this->admin_model->get_lease_own_detail();

            // lease own

            foreach($data['lease_own'] as $own){

                $lease_own_id = $own['lease_own_id'];
                $own_start_date = $own['start_date'];
                $own_end_date = $own['end_date'];
                $own_lease_amount = $own['lease_amount'];
                $own_lease_increment_type = $own['lease_increment_type'];
                $own_lease_increment_month = $own['lease_increment_month'];
                $own_lease_increment = $own['lease_increment'];
                $own_lease_increment_status = $own['lease_increment_status'];
                $current_date = date('Y-m-d');

                if($own['lease_increment_date'] !== NULL OR $own['lease_increment_date'] !== ''){

                    $own_lease_increment_date = $own['lease_increment_date'];

                }
                else{

                    $own_lease_increment_date = '' ;
                }

                if($current_date <= $own_end_date){

                    if($own_lease_increment_date == NULL OR $own_lease_increment_date == ''){

                        $month = "+".$own_lease_increment_month."months";

                        $increment_date = date("Y-m-d",strtotime($month, strtotime($own_start_date)));
                        

                        if($increment_date == $current_date AND $own_lease_increment_type == 'Rupees'){

                            $lease_amount = $own_lease_amount + $own_lease_increment;

                            //update query of leaseamount and leaseincrementdate

                            $this->admin_model->update_lease_own_detail($lease_amount,$increment_date,$lease_own_id);

                        }
                        if($increment_date == $current_date AND $own_lease_increment_type == 'Percentage'){

                            $lease_percentage = ($own_lease_amount * $own_lease_increment) / 100;
                            $lease_amount = $own_lease_amount + $lease_percentage;

                            //update query of leaseamount and leaseincrementdate
                            $this->admin_model->update_lease_own_detail($lease_amount,$increment_date,$lease_own_id);

                        }
                       
                    }
                    if($own_lease_increment_date !== NULL OR $own_lease_increment_date !== '' OR !empty($own_lease_increment_date)){

                        if($own_lease_increment_status !== 'Done'){

                            $month = "+".$own_lease_increment_month."months";

                            $increment_date = date("Y-m-d",strtotime($month, strtotime($own_lease_increment_date)));

                             if($increment_date == $current_date AND $own_lease_increment_type == 'Rupees'){

                                $lease_amount = $own_lease_amount + $own_lease_increment;

                                //update query of leaseamount and leaseincrementdate

                                $this->admin_model->update_lease_own_detail($lease_amount,$increment_date,$lease_own_id);

                            }
                            if($increment_date == $current_date AND $own_lease_increment_type == 'Percentage'){

                                $lease_percentage = ($own_lease_amount * $own_lease_increment) / 100;
                                $lease_amount = $own_lease_amount + $lease_percentage;

                                //update query of leaseamount and leaseincrementdate

                                $this->admin_model->update_lease_own_detail($lease_amount,$increment_date,$lease_own_id);

                            }

                        }
                    }
                    

                }
            } 

            $data['lease_given'] = $this->admin_model->get_lease_given_detail();

            //lease given    

             foreach($data['lease_given'] as $given){

                $lease_given_id = $given['lease_given_id'];
                $given_start_date = $given['start_date'];
                $given_end_date = $given['end_date'];
                $given_lease_amount = $given['lease_amount'];
                $given_lease_increment_type = $given['lease_increment_type'];
                $given_lease_increment_month = $given['lease_increment_month'];
                $given_lease_increment = $given['lease_increment'];
                $given_lease_increment_status = $given['lease_increment_status'];
                $current_date1 = date('Y-m-d');

                if($given['lease_increment_date'] !== NULL OR $given['lease_increment_date'] !== ''){

                    $given_lease_increment_date = $given['lease_increment_date'];

                }
                else{

                    $given_lease_increment_date = '' ;
                }

                if($current_date1 <= $given_end_date){

                    if($given_lease_increment_date == NULL OR $given_lease_increment_date == ''){

                        $month = "+".$given_lease_increment_month."months";

                        $increment_date = date("Y-m-d",strtotime($month, strtotime($given_start_date)));
                        

                        if($increment_date == $current_date AND $given_lease_increment_type == 'Rupees'){

                            $lease_amount = $given_lease_amount + $given_lease_increment;

                            //update query of leaseamount and leaseincrementdate

                            $this->admin_model->update_lease_given_detail($lease_amount,$increment_date,$lease_given_id);

                        }
                        if($increment_date == $current_date AND $given_lease_increment_type == 'Percentage'){

                            $lease_percentage = ($given_lease_amount * $given_lease_increment) / 100;
                            $lease_amount = $given_lease_amount + $lease_percentage;

                            //update query of leaseamount and leaseincrementdate
                            $this->admin_model->update_lease_given_detail($lease_amount,$increment_date,$lease_given_id);

                        }
                       
                    }
                    if($given_lease_increment_date !== NULL OR $given_lease_increment_date !== '' OR !empty($given_lease_increment_date)){

                        if($given_lease_increment_status !== 'Done'){

                            $month = "+".$given_lease_increment_month."months";

                            $increment_date = date("Y-m-d",strtotime($month, strtotime($given_lease_increment_date)));

                             if($increment_date == $current_date AND $given_lease_increment_type == 'Rupees'){

                                $lease_amount = $given_lease_amount + $given_lease_increment;

                                //update query of leaseamount and leaseincrementdate

                                $this->admin_model->update_lease_given_detail($lease_amount,$increment_date,$lease_given_id);

                            }
                            if($increment_date == $current_date AND $given_lease_increment_type == 'Percentage'){

                                $lease_percentage = ($given_lease_amount * $given_lease_increment) / 100;
                                $lease_amount = $given_lease_amount + $lease_percentage;

                                //update query of leaseamount and leaseincrementdate

                                $this->admin_model->update_lease_given_detail($lease_amount,$increment_date,$lease_given_id);

                            }

                        }
                    }
                    

                }
            }     
       	if($session_data['role_name'] !== "Truncate Data"){

       		$this->load->view('dashboard',$this->security->xss_clean($data));
       	} else {
       		$this->load->view('data',$this->security->xss_clean($data));

       	}
        

    }

    public function create_backup(){
			
			$this->load->helper('file');

			//upload folder zip
			
			$dir = FCPATH.'assets/images/uploads';
			$file_name1 = base64_encode('upload-backup_' . date('Y-m-d_H-i'));
			$zip_file = './assets/images/uploads/db_backup/'.$file_name1  . '.zip';

			// Get real path for our folder
			$rootPath = realpath($dir);

			// Initialize archive object
			$zip = new ZipArchive();
			$zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);

			// Create recursive directory iterator
			/** @var SplFileInfo[] $files */
			$files = new RecursiveIteratorIterator(
			    new RecursiveDirectoryIterator($rootPath),
			    RecursiveIteratorIterator::LEAVES_ONLY
			);

			foreach ($files as $name => $file)
			{
			    // Skip directories (they would be added automatically)
			    if (!$file->isDir())
			    {
			        // Get real and relative path for current file
			        $filePath = $file->getRealPath();
			        $relativePath = substr($filePath, strlen($rootPath) + 1);

			        // Add current file to archive
			        $zip->addFile($filePath, $relativePath);
			    }
			}

			// Zip archive will be created only after closing object
			$zip->close();

			//db zip

       		$this->load->dbutil();
       		date_default_timezone_set("Asia/Kolkata");
			$prefs = array('format' => 'zip', 'filename' => 'Database-backup_' . date('Y-m-d_H-i'));
			$backup = $this->dbutil->backup($prefs);

			$file_name = base64_encode('BD-backup_' . date('Y-m-d_H-i'));
           
			write_file('./assets/images/uploads/db_backup/'.$file_name.'.zip', $backup); 

			redirect("Admin/dashboard");

    }

    public function logout() {
        $session_data = $this->session->userdata('logged_in');
        $msg = $session_data['username']." ".'Logged Out From System.';
        $this->user_activity_model->add('logged_out',$msg,$session_data['username'],$session_data['admin_id']); 
        $this->session->sess_destroy();
        setcookie("ci_session", "", time() - 3600);
        $this->load->view('index');
    }

    public function set_roles() {
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

        if(!in_array("Set Roles",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Add Role Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
        redirect('Admin/auth_error');
        }

        $data['property'] = $this->admin_model->get_property();
        $data['property_group'] = $this->admin_model->get_property_groups();
        $msg = $session_data['username']." ".'Visited Add Role Page.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
        $this->load->view('add_roles',$this->security->xss_clean($data));
    }

        public function add_roles() {
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

        if(!in_array("Set Roles",$role1)) {
         $msg = $session_data['username']." ".'Try To Access Add Role Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);     
        redirect('Admin/auth_error');
        }

        $data['property'] = $this->admin_model->get_property();
        $data['property_group'] = $this->admin_model->get_property_groups();
        $group_id =$this->input->post('group_id_append');
        $final_group_id = rtrim($group_id,",");
       // print_r($this->input->post('property_name[]'));
       // die();

         $this->form_validation->set_rules('username','Username','required|is_unique[admin_master.username]');
		 $this->form_validation->set_rules('password','Password','required|min_length[9]|max_length[15]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{9,15}$/]',array('regex_match' => 'Passowrd Must Contain Upper Case,Lower Case,Special Characters and Numerals'));
         $this->form_validation->set_rules('role_name','Role Name','required');
         //$this->form_validation->set_rules('foo[]','Role Selection','required');
         //$this->form_validation->set_rules('property_name[]','Property Selection','required');

         $data['role_names'] = $this->input->post('foo[]');

          if($this->form_validation->run() === FALSE)
        {
            $this->load->view('add_roles',$this->security->xss_clean($data));
        }
        else{

        	$this->admin_model->add_role($final_group_id);
        	$insert_id = $this->db->insert_id();
        	$this->admin_model->add_pwd_histroy($insert_id);
        	$this->session->set_flashdata("add_role","Role Details Added Successfully");
            $msg = $session_data['username']." ".'Created Role For'." ".$this->input->post('username').'.';
            $this->user_activity_model->add('added',$msg,$data['username'],$data['admin_id']);
            if(in_array("View Roles",$role1)) {
            redirect('Admin/view_role');
            } else {

                redirect('Admin/set_roles');

            }
        }	
    }

    public function get_property_by_group(){

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
        if(!in_array("Set Roles",$role1) OR !in_array("View Roles",$role1)) {
        redirect('Admin/auth_error');
        }

        $id = $this->input->post('id',TRUE);
       
        $data = $this->admin_model->get_property_by_group_id($id);
        echo json_encode($this->security->xss_clean($data));
    }


    public function view_role() {
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
        if(!in_array("View Roles",$role1)) {
         $msg = $session_data['username']." ".'Try To Access View Role Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);        
        redirect('Admin/auth_error');
        }

            $data['role1'] = $this->admin_model->view_role();
            $data['property'] = $this->admin_model->get_property();
            $msg = $session_data['username']." ".'Visited View Role Page.';
            $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
            $this->load->view('view_role',$this->security->xss_clean($data));
    }  

     public function blocked_users() {
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
        if(!in_array("Unblocked Users",$role1)) {
         $msg = $session_data['username']." ".'Try To Access Blocked Users Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);        
        redirect('Admin/auth_error');
        }

            $data['role1'] = $this->admin_model->view_blocked_role();
            $msg = $session_data['username']." ".'Visited Blocked Users Page.';
            $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
            $this->load->view('unblocked_users',$this->security->xss_clean($data));
    }  

    public function unblock_user() {
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
        $admin_id1 = base64_decode($this->uri->segment(3));

        $data['role1'] = $this->admin_model->view_role_by_id($admin_id1);

        foreach($data['role1'] as $r){
            $user_name = $r['username'];
            $ad_id = $r['admin_id'];
          }

          if(($admin_id1 == null OR $admin_id1 == '') OR (!isset($ad_id) OR $ad_id !== $admin_id1 OR $ad_id == null OR $ad_id == '')){

             show_404();
            exit();
        }

        if(!in_array("Unblocked Users",$role1)) {
         $msg = $session_data['username']." ".'Try To Unblock User'." ".$user_name." ".'.Unblock User Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);        
        redirect('Admin/auth_error');
        }
            $this->admin_model->unblock_user($admin_id1);
            $this->session->set_flashdata("unblock_user","Unblocked User Successfully.");
            $msg = $session_data['username']." ".'Unblocked User'." ".$user_name.'.';
            $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
            redirect("Admin/blocked_users","refresh");

    }  


        public function delete_role_detail(){
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

          $admin_id1 = base64_decode($this->uri->segment(3));

          $data['role1'] = $this->admin_model->view_role_by_id($admin_id1);

          foreach($data['role1'] as $r){
            $user_name = $r['username'];
            $ad_id = $r['admin_id'];
          }

           if(($admin_id1 == null OR $admin_id1 == '') OR (!isset($ad_id) OR $ad_id !== $admin_id1 OR $ad_id == null OR $ad_id == '')){

             show_404();
            exit();
        }
        if(!in_array("View Roles",$role1)) {
        $msg = $session_data['username']." ".'Try To Delete Role For'." ".$user_name." ".'But Role Delete Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);      
        redirect('Admin/auth_error');
        }


        $this->admin_model->delete_role_detail($admin_id1);
        $this->session->set_flashdata("delete_role","Role Details Blocked successfully. If Want to Unblock this role than go to Unblocked User Section");
        $msg = $data['username']." ".'Deleted Role Details For'." ".$user_name. '.';
        $this->user_activity_model->add('deleted',$msg,$data['username'],$data['admin_id']);
        redirect("Admin/view_role","refresh");
    }

    public function edit_role_detail() {
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


        $admin_id1 = base64_decode($this->uri->segment(3));

        $data['role1'] = $this->admin_model->view_role_by_id($admin_id1);
        $data['property_group'] = $this->admin_model->get_property_groups();

        foreach($data['role1'] as $r){
            $user_name = $r['username'];
           $ad_id = $r['admin_id'];
           $property_group_id = $r['property_group_id'];
          }

        if(($admin_id1 == null OR $admin_id1 == '') OR (!isset($ad_id) OR $ad_id !== $admin_id1 OR $ad_id == null OR $ad_id == '')){

             show_404();
            exit();
        }

        if(!in_array("View Roles",$role1)) {
         $msg = $session_data['username']." ".'Try To View Edit Role Page For'." ".$user_name." ".'But Edit Role Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);      
        redirect('Admin/auth_error');
        }
        $arr1 = explode(",",$property_group_id);
        //$data['property'] = $this->admin_model->get_property();
        $data['property'] = $this->admin_model->get_property_according_to_group($arr1);
        $msg = $session_data['username']." ".'Visited Edit Role Page of'." ".$user_name.'.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
        $this->load->view('edit_role',$this->security->xss_clean($data));
    }     

    public function edit_role_redirect() {
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
          $admin_id1 = base64_decode($this->uri->segment(3));

        $data['role1'] = $this->admin_model->view_role_by_id($admin_id1);
        $data['property_group'] = $this->admin_model->get_property_groups();

        foreach($data['role1'] as $r){
            $user_name = $r['username'];
            $user_pwd = $r['password'];
           $ad_id = $r['admin_id'];
          }

         if(($admin_id1 == null OR $admin_id1 == '') OR (!isset($ad_id) OR $ad_id !== $admin_id1 OR $ad_id == null OR $ad_id == '')){

             show_404();
            exit();
        }
        if(!in_array("View Roles",$role1)) {
         $msg = $session_data['username']." ".'Try To View Edit Role Page For'." ".$user_name." ".'But Edit Role Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);       
        redirect('Admin/auth_error');
        }

       
        $arr1 = explode(",",$property_group_id);
        //$data['property'] = $this->admin_model->get_property();
        $data['property'] = $this->admin_model->get_property_according_to_group($arr1);

        $group_id =$this->input->post('property_group');
        $final_group_id = implode(",",$group_id);

        $property_name_access = '';
         
        if($final_group_id !== null){
            $property_name_access = $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>.?\|=+]/"," ",implode(",",$this->input->post('property_name[]'))));
        } else {
           $property_name_access = '';
        }


        //rtrim($group_id,",");

        $this->form_validation->set_rules('username','Username Name','required');
         $this->form_validation->set_rules('password','Password','required|min_length[9]|max_length[15]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{9,15}$/]',array('regex_match' => 'Passowrd Must Contain Upper Case,Lower Case,Special Characters and Numerals'));
         $this->form_validation->set_rules('role_name','Role Name','required');
         //$this->form_validation->set_rules('foo[]','Role Selection','required');
         //$this->form_validation->set_rules('property_name[]','Property Access','required');

         $data['role_names'] = $this->input->post('foo[]');

          if($this->form_validation->run() === FALSE)
        {
            $this->load->view('edit_role',$this->security->xss_clean($data));
        }
        else{

            if($this->input->post('property_name[]') !== null && $final_group_id !== null){
                    $data = array(
                    'password' => $this->db->escape_str(base64_encode($this->input->post('password'))),
                    'role_name' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('role_name'))),
                    'roles' => $this->db->escape_str(preg_replace("/[!@#$%^*(){}:;<>.?\|=+]/"," ",implode(",",$this->input->post('foo[]')))),
                    'property_group_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>.?\|=+]/"," ",$final_group_id)),
                    'property_access' => $property_name_access,
                    );
                    $this->admin_model->edit_role($admin_id1,$data);
             } else {
                    $data = array(
                'password' => $this->db->escape_str(base64_encode($this->input->post('password'))),
                'role_name' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('role_name'))),
                'roles' => $this->db->escape_str(preg_replace("/[!@#$%^*(){}:;<>.?\|=+]/"," ",implode(",",$this->input->post('foo[]')))),
                'property_group_id' => $final_group_id,
                'property_access' => $property_name_access,
                );
                    //echo "2";
                    //print_r($data);
                    //die();
                $this->admin_model->edit_role($admin_id1,$data);
             }

            if($user_pwd !== base64_encode($this->input->post('password'))){
            	$this->admin_model->add_pwd_histroy($admin_id1);
            }
            $msg = $session_data['username']." ".'Updated Role Details of '." ".$user_name.".";
            $this->user_activity_model->add('updated',$msg,$data['username'],$data['admin_id']);
            $this->session->set_flashdata("edit_role","Role Details Updated Successfully");

            if($data['admin_id'] == $admin_id1){

                $data['admin_data'] = $this->admin_model->view_role_by_id($admin_id1);

            $array_items = array('password' => $session_data["password"], 'role_name' => $session_data["role_name"], 'roles' => $data['roles'], 'prop_access' => $data['prop_access']);

            $this->session->unset_userdata($array_items);
            $sess_array = array();
            foreach ($data['admin_data'] as $row) {
                $sess_array = array(
                    'admin_id' => $row['admin_id'],
                    'username' => $row['username'],
                    'password' => $row['password'],
                    'role_name' => $row['role_name'],
                    'roles' => $row['roles'],
                    'prop_access' => $row['property_access'],
                );

             redirect('Admin/view_role',$this->session->set_userdata('logged_in', $sess_array));
            }
                

            } else {
                redirect('Admin/view_role');
            }
           
        }   
    }  

public function log() {
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
        if(!in_array("View Log",$role1)) {
        $msg = $session_data['username']." ".'Try To Access View Log Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
        redirect('Admin/auth_error');
        }

            $msg = $session_data['username']." ".'Visited View Log Page.';
            $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
            $data['log'] = $this->admin_model->view_log();
            $data['role1'] = $this->admin_model->view_role();
            $this->load->view('view_log',$this->security->xss_clean($data));
    }      

    public function filter_log() {

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
        if(!in_array("View Log",$role1)) {   
            redirect('Admin/auth_error');
        }

        $data['log'] = $this->admin_model->view_log();
        $data['role1'] = $this->admin_model->view_role();

        if(!empty($this->input->post('user'))){

          $user = $this->input->post('user');

        }else{

            $user = "";
        }

        if(!empty($this->input->post('date'))){

            $date = date("Y-m-d", strtotime($this->input->post('date')));

        } else {

           $date = "";

        }

          if($user !== "" AND $date !== ""){

            $this->db->from('user_activity');   
            $this->db->order_by('id','desc');
            $this->db->where('user_id',$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$user)));
            $this->db->where('date',$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$date)));
            $query1 = $this->db->get();

        $data['log'] =  $query1->result_array();
        $this->load->view('view_log',$this->security->xss_clean($data));

        } elseif($user !== "" AND $date == ""){

          $this->db->from('user_activity');   
            $this->db->order_by('id','desc');
            $this->db->where('user_id',$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$user)));
            $query1 = $this->db->get();

        $data['log'] =  $query1->result_array();
        $this->load->view('view_log',$this->security->xss_clean($data));

        } elseif($user == "" AND $date !== ""){

           $this->db->from('user_activity');   
            $this->db->order_by('id','desc');
             $this->db->where('date',$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$date)));
            $query1 = $this->db->get();
            
        $data['log'] =  $query1->result_array();
        $this->load->view('view_log',$this->security->xss_clean($data));

        } else {
            $this->session->set_flashdata("select_data","Please Select Any Filter Field For Search");
            redirect('Admin/log/',$this->security->xss_clean($data));
        }

    }   


}    	