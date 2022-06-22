<?php

class Insurance extends CI_Controller {

    public function __construct() {
    	 parent::__construct();
    	$this->load->helper(array('form', 'url','security'));
        $this->load->library(array('form_validation','session'));
        $this->load->model('insurance_model');
        $this->load->library('upload');         
        $this->load->model('user_activity_model'); 
        error_reporting(0);
    }

    public function insurance_master(){
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

          if(!in_array("Insurance Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Insurance Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
          redirect('Admin/auth_error');
          }    

        $data['property'] = $this->insurance_model->get_property();
        $data['insurance_company'] = $this->insurance_model->get_insurance_company();
        $data['insurance_type'] = $this->insurance_model->get_insurance_type();
        $data['contact_agent'] = $this->insurance_model->get_contact_agent();

        $data['policy_owner'] = $this->insurance_model->get_policy_owner();
        $data['insurance_beneficary'] = $this->insurance_model->get_insurance_ben();
        $msg = $session_data['username']." ".'Visited Insurance Master Page.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
      	$this->load->view('insurance_master',$this->security->xss_clean($data));	
    }

    public function insurance_master_insert(){
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

          if(!in_array("Insurance Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Insurance Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
          redirect('Admin/auth_error');
          }    

        $this->form_validation->set_rules('property_id','Property Name','required');
        $this->form_validation->set_rules('insurance_name','Insurance Name','required');
        $this->form_validation->set_rules('insurance_company_id','Insurance Company','required');
        $this->form_validation->set_rules('policy_no','Policy No','required');
        $this->form_validation->set_rules('insurance_type_id[]','Insurance Type','required');
        $this->form_validation->set_rules('coverage_amount','Coverage Amount','required|numeric');
        $this->form_validation->set_rules('premium_amount','Premium Amount','required|numeric');
        $this->form_validation->set_rules('contact_agent','Contact Agent','required');
        $this->form_validation->set_rules('lean_mark','Lean Mark','required');
        $this->form_validation->set_rules('next_premium_date','Next Premium Date','required');
        $this->form_validation->set_rules('insurance_expiry_date','Insurance Expiry Date','required');
        $this->form_validation->set_rules('policy_owner[]','Policy Owner','required');
        $this->form_validation->set_rules('policy_payer','Policy Payer','required');
        $this->form_validation->set_rules('insurance_beneficaries[]','Insurance Beneficaries','required');
        $this->form_validation->set_rules('ledger_head','Ledger Head','required');
        $this->form_validation->set_rules('ledger_number','Ledger Number','required');

        if($this->input->post('lean_mark') == "Yes"){

        $this->form_validation->set_rules('cp_name','Company Name / Person Name','required');
        $this->form_validation->set_rules('lean_amount','Lean Amount','required');

        }

        $data['property'] = $this->insurance_model->get_property();
        $data['insurance_company'] = $this->insurance_model->get_insurance_company();
        $data['insurance_type'] = $this->insurance_model->get_insurance_type();
        $data['contact_agent'] = $this->insurance_model->get_contact_agent();

        $data['policy_owner'] = $this->insurance_model->get_policy_owner();
        $data['insurance_beneficary'] = $this->insurance_model->get_insurance_ben();

         if($this->form_validation->run() === FALSE)
         {

                $this->load->view('insurance_master',$this->security->xss_clean($data));
         }
         else{

                $insurance_type_id = '';
                $policy_owner = '';
                $policy_payer = '';
                $insurance_beneficiary = '';
                for($i=0 ;$i < count($this->input->post('insurance_type_id'));$i++){
                    $insurance_type_id = implode(",",$this->input->post('insurance_type_id'));
                }
                 for($i=0 ;$i < count($this->input->post('policy_owner'));$i++){
                    $policy_owner = implode(",",$this->input->post('policy_owner'));
                }
                for($i=0 ;$i < count($this->input->post('insurance_beneficaries'));$i++){
                    $insurance_beneficiary = implode(",",$this->input->post('insurance_beneficaries'));
                }

             $query = $this->insurance_model->add_insurance($insurance_type_id,$policy_owner,$this->input->post('policy_payer'),$insurance_beneficiary);
             $insert_id = $this->db->insert_id();
              $insurance_type_id1 = array();
              $policy_owner1 = array();
              $insurance_beneficiary1 = array();

              for($i=0; $i< count($this->input->post('insurance_type_id'));$i++){
                                      $insurance_type_id1 = $this->input->post('insurance_type_id')[$i];
                                   
                                            $data = array(              
                                                'insurance_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$insert_id)),
                                                'insurance_type_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$insurance_type_id1)),
                                                'insurance_type_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
                                            );                                    

                    $this->insurance_model->add_insurnce_type($data);
               }

                for($i=0; $i< count($this->input->post('policy_owner'));$i++){
                                      $policy_owner1 = $this->input->post('policy_owner')[$i];
                                   
                                            $data = array(              
                                                'insurance_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$insert_id)),
                                                'policy_owner_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$policy_owner1)),
                                                'policy_owner_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
                                            );                                    

                    $this->insurance_model->add_policy_owner($data);
               }

               for($i=0; $i< count($this->input->post('insurance_beneficaries'));$i++){
                                      $insurance_beneficiary1 = $this->input->post('insurance_beneficaries')[$i];
                                   
                                            $data = array(              
                                                'insurance_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$insert_id)),
                                                'insurance_beneficiary_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$insurance_beneficiary1)),
                                                'insurance_beneficiary_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
                                            );                                    

                    $this->insurance_model->add_insurance_ben($data);
               }


               $this->session->set_flashdata("add_insurance","Insurance Details Added Successfully");
               $msg = $session_data['username']." ".'Added Insurance Data For Insurance Named'." ".$this->input->post('insurance_name')." ".'With Policy No'." ".$this->input->post('policy_no');
               $this->user_activity_model->add('added',$msg,$session_data['username'],$session_data['admin_id']); 
                if(in_array("View Insurance List",$role1)) {
                    redirect("Insurance/view_insurance_list");
                } else {
                    redirect("Insurance/insurance_master");
                }
         }      
    }

    public function view_insurance_list(){
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

          if(!in_array("View Insurance List",$role1)) {
          $msg = $session_data['username']." ".'Try To Access View Insurance List Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
          redirect('Admin/auth_error');
          }    

        $data['insurance'] = $this->insurance_model->view_insurance();
        $data['property'] = $this->insurance_model->view_property_for_filter();
        $data['insurance_company'] = $this->insurance_model->get_insurance_company();
        $data['insurance_type'] = $this->insurance_model->get_insurance_type();
        $data['insurance_beneficary'] = $this->insurance_model->get_insurance_ben();
        $msg = $session_data['username']." ".'Visited View Insurance List Page.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
    	  $this->load->view('view_insurance_list',$this->security->xss_clean($data));
    }

     public function view_insurance_list_filter(){
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

          if(!in_array("View Insurance List",$role1)) {
          redirect('Admin/auth_error');
          }    
          

        $data['insurance'] = $this->insurance_model->view_insurance();
        $data['property'] = $this->insurance_model->view_property_for_filter();
        $data['insurance_company'] = $this->insurance_model->get_insurance_company();
        $data['insurance_type'] = $this->insurance_model->get_insurance_type();
        $data['insurance_beneficary'] = $this->insurance_model->get_insurance_ben();  

        
       //print_r($prop['property_id']);exit();

       // if (empty($_GET['property_id']) && empty($_GET['insurance_company_id']) && empty($_GET['insurance_type_id']) && empty($_GET['insurance_beneficiary']) && empty($_GET['lean_mark']))

        if (empty($_POST['property_id']) && empty($_POST['insurance_company_id']) && empty($_POST['lean_mark']))
        {
           
             $this->session->set_flashdata("select_data","Please Select Any Filter Field For Search");
            redirect('Insurance/view_insurance_list/',$this->security->xss_clean($data));
        } else {
          $property_id = $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$_POST['property_id']));
          $insurance_company_id = $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$_POST['insurance_company_id']));
          $lean_mark = $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$_POST['lean_mark']));
             $wheres = array();
           /* $sql = "SELECT  pm.*,ic.*,lm.*,it.*,ib.* FROM insurance_master lm INNER JOIN property_master pm ON pm.property_id = lm.property_id INNER JOIN insurance_company_master ic ON ic.insurance_company_id = lm.insurance_company_id INNER JOIN Inc_insurance_type_master it ON it.insurance_id = lm.insurance_id  RIGHT JOIN Inc_insurance_beneficiary_master ib ON ib.insurance_id = lm.insurance_id  where ";*/

            $sql = "SELECT  pm.*,ic.*,lm.* FROM insurance_master lm INNER JOIN property_master pm ON pm.property_id = lm.property_id INNER JOIN insurance_company_master ic ON ic.insurance_company_id = lm.insurance_company_id where ";

             if (isset($_POST['property_id']) and !empty($_POST['property_id']))
            {
                $wheres[] = "lm.property_id like '%{$property_id}%' ";
            } 

            if (isset($_POST['insurance_company_id']) and !empty($_POST['insurance_company_id']))
            {
                $wheres[] = "lm.insurance_company_id = '{$insurance_company_id}'";
            } 

            /*if (isset($_GET['insurance_type_id']) and !empty($_GET['insurance_type_id']))
            {
                $wheres[] = "it.insurance_type_id = '{$_GET['insurance_type_id']}' ";
            } */

            /*if (isset($_GET['insurance_beneficiary']) and !empty($_GET['insurance_beneficiary']))
            {
                $wheres[] = "ib.insurance_beneficiary_id = '{$_GET['insurance_beneficiary']}' ";
            } */

            if (isset($_POST['lean_mark']) and !empty($_POST['lean_mark']))
            {
                $wheres[] = "lm.lean_mark = '{$lean_mark}' ";
            } 

            foreach ( $wheres as $where ) 
            {
            $sql .= $where . ' AND ';   //  you may want to make this an OR
              }
             $sql=rtrim($sql, "AND "); 

             $sql1 = $this->db->query($sql);

             if($sql1 == null OR $sql1 == '' OR empty($sql1)){
                $this->load->view('view_insurance_list',$this->security->xss_clean($data));
                echo " No Data Found";
             } else {
              $data['insurance']  = $sql1->result_array();  

            $this->load->view('view_insurance_list',$this->security->xss_clean($data));
             }
        } 
    }

    public function delete_insurance_detail(){

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

          $insurance_id = base64_decode($this->uri->segment(3));

          $data['insurance']=$this->insurance_model->view_insurance_detail($insurance_id);

          foreach($data['insurance'] as $inc){
            $property_id = $inc['property_id'];
            $property_name = $inc['property_name'];
            $insurance_name = $inc['insurance_name'];
            $policy_no = $inc['policy_no'];
            $inc_id = $inc['insurance_id'];
          }


          if(($insurance_id == null OR $insurance_id == '') OR (!isset($inc_id) OR $inc_id !== $insurance_id OR $inc_id == null OR $inc_id == '')){

           show_404();
          exit();
          }

          if(!in_array("View Insurance List",$role1)) {
           $msg = $session_data['username']." ".'Try To Delete Insurance Details For'." ".$property_name." ".'Property And Insurance Named'." ".$insurance_name." ".'With Poilcy No'." ".$policy_no." ". '.This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
          redirect('Admin/auth_error');
          }    

         $prop_access_array = explode(",",$data['prop_access']);
        
        $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
               $msg = $session_data['username']." ".'Try To Delete Insurance Details For'." ".$property_name." ".'Property And Insurance Named'." ".$insurance_name." ".'With Poilcy No'." ".$policy_no." ". '.This Property Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 
              redirect('Admin/auth_error');
            }
        $this->insurance_model->delete_insurance($insurance_id);
        $this->session->set_flashdata("insurance_delete","Insurance Details Deleted successfully.");
         $msg = $session_data['username']." ".'Deleted Insurance Details For'." ".$property_name." ".'Property And Insurance Named'." ".$insurance_name." ".'With Poilcy No'." ".$policy_no;
          $this->user_activity_model->add('deleted',$msg,$session_data['username'],$session_data['admin_id']); 
        redirect("Insurance/view_insurance_list","refresh");
    }

    public function view_insurance_detail(){

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

         $insurance_id = base64_decode($this->uri->segment(3));
        $data['insurance']=$this->insurance_model->view_insurance_detail($insurance_id);
        $data['insurance_type']=$this->insurance_model->get_insurance_type_detail($insurance_id);
         $data['policy_owner']=$this->insurance_model->view_insurance_policy_owner_detail($insurance_id);
          $data['policy_ben']=$this->insurance_model->view_insurance_policy_ben_detail($insurance_id);

          foreach($data['insurance'] as $inc){
            $property_id = $inc['property_id'];
            $property_name = $inc['property_name'];
            $insurance_name = $inc['insurance_name'];
            $policy_no = $inc['policy_no'];
            $inc_id = $inc['insurance_id'];
          }

          if(($insurance_id == null OR $insurance_id == '') OR (!isset($inc_id) OR $inc_id !== $insurance_id OR $inc_id == null OR $inc_id == '')){

             show_404();
             exit();
          }

          if(!in_array("View Insurance List",$role1)) {
           $msg = $session_data['username']." ".'Try To View Insurance Details For'." ".$property_name." ".'Property And Insurance Named'." ".$insurance_name." ".'With Poilcy No'." ".$policy_no." ". '.This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
          redirect('Admin/auth_error');
          }    
          

         $prop_access_array = explode(",",$data['prop_access']);
        
        $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
              $msg = $session_data['username']." ".'Try To View Insurance Details For'." ".$property_name." ".'Property And Insurance Named'." ".$insurance_name." ".'With Poilcy No'." ".$policy_no." ". '.This Property Access is Not Given to the'." ".$session_data['username'].'.';
              $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);
              redirect('Admin/auth_error');
            }

        $msg = $session_data['username']." ".'Viewed Insurance Details For'." ".$property_name." ".'Property And Insurance Named'." ".$insurance_name." ".'With Poilcy No'." ".$policy_no;
          $this->user_activity_model->add('viewed',$msg,$session_data['username'],$session_data['admin_id']);
        $this->load->view('view_insurance',$this->security->xss_clean($data));
    }

  
    public function filter_insurance()
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

          if(!in_array("View Insurance List",$role1)) {
          redirect('Admin/auth_error');
          }    
          

        //$data['property'] = $this->insurance_model->get_property();
        $data['property'] = $this->insurance_model->view_property_for_filter();
        $date="";
        if(!empty($this->input->post('date'))){
            $date = date("Y-m-d", strtotime($this->input->post('date')));
        }
        $property = $this->input->post('property_id');
    

        if($date !== "" AND $property !== ""){
            $query1 = $this->db->join('property_master', 'insurance_master.property_id=property_master.property_id');    
       $query1 = $this->db->join('insurance_company_master', 'insurance_master.insurance_company_id=insurance_company_master.insurance_company_id');  
        $this->db->order_by('insurance_id','desc');
                $query1 = $this->db->get_where('insurance_master',array('next_premium_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$date)),'insurance_master.property_id'=>$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$property))));
               $data['insurance']  = $query1->result_array();
               $this->load->view('insurance_renewal_list',$this->security->xss_clean($data));
        }

        else if($date !== "" AND $property == ""){
            $query1 = $this->db->join('property_master', 'insurance_master.property_id=property_master.property_id');    
       $query1 = $this->db->join('insurance_company_master', 'insurance_master.insurance_company_id=insurance_company_master.insurance_company_id');  
        $this->db->order_by('insurance_id','desc');
                $query1 = $this->db->get_where('insurance_master',array('next_premium_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$date))));
               $data['insurance']  = $query1->result_array();
               $this->load->view('insurance_renewal_list',$this->security->xss_clean($data));
        }

        else if($date == "" AND $property !== ""){
            $query1 = $this->db->join('property_master', 'insurance_master.property_id=property_master.property_id');    
       $query1 = $this->db->join('insurance_company_master', 'insurance_master.insurance_company_id=insurance_company_master.insurance_company_id');  
        $this->db->order_by('insurance_id','desc');
                $query1 = $this->db->get_where('insurance_master',array('insurance_master.property_id'=>$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$property))));
               $data['insurance']  = $query1->result_array();
               $this->load->view('insurance_renewal_list',$this->security->xss_clean($data));
        } else {
          $this->session->set_flashdata("select_data","Please Select Any Filter Field For Search");
            redirect('Insurance/insurance_renewal_list/',$this->security->xss_clean($data));
        }
    }


    public function insurance_renewal_list(){
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

          if(!in_array("List of Renewal",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Insurance Renewal List Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
          redirect('Admin/auth_error');
          }    

        $data['property'] = $this->insurance_model->view_property_for_filter();
        $data['insurance'] = $this->insurance_model->view_insurance();
        $msg = $session_data['username']." ".'Visited Insurance Renewal List Page.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
    	  $this->load->view('insurance_renewal_list',$this->security->xss_clean($data));
    }

        public function claim_master(){
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

          if(!in_array("Claim Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Claim Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
          redirect('Admin/auth_error');
          }   

         $data['property'] = $this->insurance_model->get_property_for_claim();
         $msg = $session_data['username']." ".'Visited Claim Master Page.';
         $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
         $this->load->view('claim_master',$this->security->xss_clean($data));
    }

            public function claim_master_redirect(){
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

          if(!in_array("Claim Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Claim Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
          redirect('Admin/auth_error');
          }   

          $property = $this->input->post('property_name');
          $data['property'] = $this->insurance_model->get_property_for_claim();
          $data['insurance'] = $this->insurance_model->view_insurance_data($property);
         

         if($this->input->post('filter')){
            $property = $this->input->post('property_name');
            $data['property'] = $this->insurance_model->get_property_for_claim();
            $data['insurance'] = $this->insurance_model->view_insurance_data($property);

            $this->load->view('claim_master',$this->security->xss_clean($data));
         } 

          else if($this->input->post('submit')){

            $property = $this->input->post('property_name');
            $data['property'] = $this->insurance_model->get_property_for_claim();
            $data['insurance'] = $this->insurance_model->view_insurance_data($property);

            $this->form_validation->set_rules('property_name','Property Name','required');  
            $this->form_validation->set_rules('insurance_selection','Claim Selction','required');
            $this->form_validation->set_rules('claim_date_launch','Claim Date Launch','required');
            $this->form_validation->set_rules('claim_amount','Claim Amount','required|numeric');

                if(!empty($this->insurance_model->get_inserted_claim_data($this->input->post('insurance_id')))){
                      $claim_data = $this->insurance_model->get_inserted_claim_data($this->input->post('insurance_id'));

                    foreach ($claim_data as $claim) {
                      if($claim['insurance_id'] == $this->input->post('insurance_id') AND $claim['surveyer_status'] == 'Processing' OR $claim['surveyer_status'] == NULL){

                         $this->session->set_flashdata("check_claim_inserted","Claim Can't Added For Particular Insurance For That Data Exist For the Same.");
                          $msg = $session_data['username']." ".'Try To Insert Claim Details For'." ".$claim['property_name']." ".'Property And Insurance Named'." ".$claim['insurance_name']." ".'With Poilcy No'." ".$claim['policy_no']." ". '.But Claim Cannot Added For Particular Insurance Because Claim Data Exist For the Same Insurance.';
                          $this->user_activity_model->add('not_added',$msg,$session_data['username'],$session_data['admin_id']);  

                         if(in_array("View Claim List",$role1)) {
                             redirect("Insurance/view_claim_list","refresh",$this->security->xss_clean($data));
                         } else {

                             redirect("Insurance/claim_master","refresh",$this->security->xss_clean($data));

                         }    

                      }
                    }
               }

                 if($this->form_validation->run() === FALSE)
            { 
              $this->load->view('claim_master',$this->security->xss_clean($data));
            }
            else{

                $upload_claim = '';
                $claim_document = $_FILES['claim_document']['name'];

                if(!empty($_FILES['claim_document']['name']) OR $_FILES['claim_document']['name'] !== ''){

                     $claim_document = str_replace(' ', '_', $claim_document);

                            $config['file_name'] =$claim_document;
                            $config['upload_path'] = './assets/images/uploads/claim';
                            $config['allowed_types'] = 'zip|pdf|jpeg|jpg|png|rar';
                            $config['max_size'] = '20000';
                            $config['encrypt_name'] = TRUE;
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            if (!$this->upload->do_upload('claim_document')) {
                                $error = array('error' => $this->upload->display_errors());
                               $this->session->set_flashdata('new_in',2);
                                $this->load->view('claim_master',$this->security->xss_clean($data));
                            } else {
                                $data1 = array('upload_data' => $this->upload->data());
                                $upload_claim = base64_encode($data1['upload_data']['file_name']);
                                $this->insurance_model->add_claim($upload_claim);

                                $this->session->set_flashdata("add_claim","Claim Details Added Successfully");

                                          if(in_array("View Claim List",$role1)) {
                                  redirect("Insurance/view_claim_list");
                              } else {
                                  redirect("Insurance/claim_master");
                              }   
                              } 
                }  
                if(empty($_FILES['claim_document']['name']) OR $_FILES['claim_document']['name'] == ''){

                    $upload_claim = '';
                    $this->insurance_model->add_claim($upload_claim);

                    $this->session->set_flashdata("add_claim","Claim Details Added Successfully");

                    $claim_data1 = $this->insurance_model->get_inserted_claim_data($this->input->post('insurance_id'));

                    foreach ($claim_data1 as $claim1) {
                      $property_name = $claim1['property_name'];
                      $insurance_name = $claim1['insurance_name'];
                      $policy_no = $claim1['policy_no'];
                    }  

                    $msg = $session_data['username']." ".'Added Claim Details For'." ".$property_name." ".'Property And Insurance Named'." ".$insurance_name." ".'With Poilcy No'." ".$policy_no;
                    $this->user_activity_model->add('added',$msg,$session_data['username'],$session_data['admin_id']); 

                    if(in_array("View Claim List",$role1)) {
                        redirect("Insurance/view_claim_list");
                    } else {
                        redirect("Insurance/claim_master");
                    }
                }

                               

            }    
          }  
        
        else{

             $property = $this->input->post('property_name');
            $data['property'] = $this->insurance_model->get_property();
            $data['insurance'] = $this->insurance_model->view_insurance_data($property);
            $this->load->view("claim_master",$this->security->xss_clean($data));
        }
    }

    public function view_claim_list(){
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

          if(!in_array("View Claim List",$role1)) {
           $msg = $session_data['username']." ".'Try To Access View Claim List Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
          redirect('Admin/auth_error');
          }   

         $data['claim_list'] = $this->insurance_model->get_claim_data();
         $data['property'] = $this->insurance_model->view_property_for_filter();
         $msg = $session_data['username']." ".'Visited View Claim List Page.';
         $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']); 
         $this->load->view('view_claim_list',$this->security->xss_clean($data));
    }

      public function claim_filter(){
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

          if(!in_array("View Claim List",$role1)) {
          redirect('Admin/auth_error');
          }   

         $data['claim_list'] = $this->insurance_model->get_claim_data();
         //$data['property'] = $this->insurance_model->get_property();
         $data['property'] = $this->insurance_model->view_property_for_filter();

        $property_id = $this->input->post('property_id');
        $surveyer_status = $this->input->post('surveyer_status');

         if($property_id !=="" AND $surveyer_status !==""){

            $query = $this->db->order_by('claim_id','desc');
            $query = $this->db->join('property_master', 'claim_master.property_id=property_master.property_id');
            $query = $this->db->join('insurance_master', 'claim_master.insurance_id=insurance_master.insurance_id'); 
            $query = $this->db->join('insurance_company_master', 'insurance_master.insurance_company_id=insurance_company_master.insurance_company_id');  
           $query = $this->db->join('insurance_type_master', 'insurance_master.insurance_type_id=insurance_type_master.insurance_type_id');  
           $query = $this->db->join('user_master', 'insurance_master.contact_agent=user_master.user_id');      
           if($surveyer_status == "Not Assigned Status Yet"){

            $query = $this->db->get_where('claim_master',array('claim_master.property_id'=>$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$property_id)),'claim_master.surveyer_status'=> $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",' '))));

           }else {

            $query = $this->db->get_where('claim_master',array('claim_master.property_id'=>$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$property_id)),'claim_master.surveyer_status'=>$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$surveyer_status))));
            } 

        $data['claim_list'] =  $query->result_array();
        $this->load->view('view_claim_list',$this->security->xss_clean($data)); 
      

         }elseif($property_id !=="" AND $surveyer_status ==""){

            $query = $this->db->order_by('claim_id','desc');
            $query = $this->db->join('property_master', 'claim_master.property_id=property_master.property_id');
            $query = $this->db->join('insurance_master', 'claim_master.insurance_id=insurance_master.insurance_id'); 
            $query = $this->db->join('insurance_company_master', 'insurance_master.insurance_company_id=insurance_company_master.insurance_company_id');  
           $query = $this->db->join('insurance_type_master', 'insurance_master.insurance_type_id=insurance_type_master.insurance_type_id');  
           $query = $this->db->join('user_master', 'insurance_master.contact_agent=user_master.user_id');      
          
            $query = $this->db->get_where('claim_master',array('claim_master.property_id'=>$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$property_id))));

        $data['claim_list'] =  $query->result_array();
        $this->load->view('view_claim_list',$this->security->xss_clean($data));

       
         }elseif($property_id =="" AND $surveyer_status !==""){

            $query = $this->db->order_by('claim_id','desc');
            $query = $this->db->join('property_master', 'claim_master.property_id=property_master.property_id');
            $query = $this->db->join('insurance_master', 'claim_master.insurance_id=insurance_master.insurance_id'); 
            $query = $this->db->join('insurance_company_master', 'insurance_master.insurance_company_id=insurance_company_master.insurance_company_id');  
           $query = $this->db->join('insurance_type_master', 'insurance_master.insurance_type_id=insurance_type_master.insurance_type_id');  
           $query = $this->db->join('user_master', 'insurance_master.contact_agent=user_master.user_id');      
           if($surveyer_status == "Not Assigned Status Yet"){

            $query = $this->db->get_where('claim_master',array('claim_master.surveyer_status'=> $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",' '))));

           }else {

            $query = $this->db->get_where('claim_master',array('claim_master.surveyer_status'=>$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$surveyer_status))));

         }
          $data['claim_list'] =  $query->result_array();
        $this->load->view('view_claim_list',$this->security->xss_clean($data));
        }  else {
             $this->session->set_flashdata("select_data","Please Select Any Filter Field For Search");
             $this->load->view('view_claim_list',$this->security->xss_clean($data));
        }

    }


    public function view_claim_detail(){

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

        $claim_id = base64_decode($this->uri->segment(3));

        $data['claim_list'] = $this->insurance_model->get_insurance_claim_data($claim_id);


         foreach($data['claim_list'] as $inc){
          $property_id = $inc['property_id'];
          $property_name = $inc['property_name'];
          $insurance_name = $inc['insurance_name'];
          $policy_no = $inc['policy_no'];
          $cl_id = $inc['claim_id'];
        }


        if(($claim_id == null OR $claim_id == '') OR (!isset($cl_id) OR $cl_id !== $claim_id OR $cl_id == null OR $cl_id == '')){

           show_404();
          exit();
          }

          if(!in_array("View Claim List",$role1)) {
           $msg = $session_data['username']." ".'Try To View Claim Details For'." ".$property_name." ".'Property And Insurance Named'." ".$insurance_name." ".'With Poilcy No'." ".$policy_no." ". '.This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
          redirect('Admin/auth_error');
          }   

       
          $prop_access_array = explode(",",$data['prop_access']);

        $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
              $msg = $session_data['username']." ".'Try To View Claim Details For'." ".$property_name." ".'Property And Insurance Named'." ".$insurance_name." ".'With Poilcy No'." ".$policy_no." ". '.This Property Access is Not Given to the'." ".$session_data['username'].'.';
              $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);
              redirect('Admin/auth_error');
            }
        $msg = $session_data['username']." ".'Viewed Claim Details For'." ".$property_name." ".'Property And Insurance Named'." ".$insurance_name." ".'With Poilcy No'." ".$policy_no;
        $this->user_activity_model->add('viewed',$msg,$session_data['username'],$session_data['admin_id']);    
        $this->load->view('view_claim_data',$this->security->xss_clean($data));

    }

    public function download_claim_document(){

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
         $claim_id = base64_decode($this->uri->segment(3));

         $data['claim_list']=$this->insurance_model->get_insurance_claim_data($claim_id);


         foreach($data['claim_list'] as $inc){
          $property_id = $inc['property_id'];
          $property_name = $inc['property_name'];
          $insurance_name = $inc['insurance_name'];
          $policy_no = $inc['policy_no'];
          $cl_id = $inc['claim_id'];
        }


        if(($claim_id == null OR $claim_id == '') OR (!isset($cl_id) OR $cl_id !== $claim_id OR $cl_id == null OR $cl_id == '')){

           show_404();
          exit();
          }

          if(!in_array("View Claim List",$role1)) {
           $msg = $session_data['username']." ".'Try To Download Claim Document For'." ".$property_name." ".'Property And Insurance Named'." ".$insurance_name." ".'With Poilcy No'." ".$policy_no." ". '.This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
          redirect('Admin/auth_error');
          }   

         $prop_access_array = explode(",",$data['prop_access']);

        $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
              $msg = $session_data['username']." ".'Try To Download Claim Document For'." ".$property_name." ".'Property And Insurance Named'." ".$insurance_name." ".'With Poilcy No'." ".$policy_no." ". '.This Property Access is Not Given to the'." ".$session_data['username'].'.';
              $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
              redirect('Admin/auth_error');
            }

          if(!empty($claim_id)){
            //load download helper
            $this->load->helper('download');
            
            //get file info from database
            $fileInfo = $this->insurance_model->download_claim_document($claim_id);

            $fileInfo1 = base64_decode($fileInfo);
            
            //file path
            $file = file_get_contents(base_url().'assets/images/uploads/claim/'.$fileInfo1);

            $msg = $session_data['username']." ".'Downloaded Claim Document For'." ".$property_name." ".'Property And Insurance Named'." ".$insurance_name." ".'With Poilcy No'." ".$policy_no;
            $this->user_activity_model->add('download_document',$msg,$session_data['username'],$session_data['admin_id']);  

            //download file from directory
            force_download($fileInfo1, $file);
            redirect('Insurance/view_claim_detail/'.$this->security->xss_clean($claim_id));
        }
    }

    public function delete_claim_detail(){
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
         $claim_id = base64_decode($this->uri->segment(3));

         $data['claim_list'] = $this->insurance_model->get_insurance_claim_data($claim_id);

          foreach($data['claim_list'] as $inc){
          $property_id = $inc['property_id'];
          $property_name = $inc['property_name'];
          $insurance_name = $inc['insurance_name'];
          $policy_no = $inc['policy_no'];
          $cl_id = $inc['claim_id'];
        }


        if(($claim_id == null OR $claim_id == '') OR (!isset($cl_id) OR $cl_id !== $claim_id OR $cl_id == null OR $cl_id == '')){

           show_404();
          exit();
          }

          if(!in_array("View Claim List",$role1)) {
           $msg = $session_data['username']." ".'Try To Delete Claim Details For'." ".$property_name." ".'Property And Insurance Named'." ".$insurance_name." ".'With Poilcy No'." ".$policy_no." ". '.This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
          redirect('Admin/auth_error');
          }   

        $prop_access_array = explode(",",$data['prop_access']);
        
        $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
              $msg = $session_data['username']." ".'Try To Delete Claim Details For'." ".$property_name." ".'Property And Insurance Named'." ".$insurance_name." ".'With Poilcy No'." ".$policy_no." ". '.This Property Access is Not Given to the'." ".$session_data['username'].'.';
              $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
              redirect('Admin/auth_error');
            }

        foreach($data['claim_list'] as $claim){
          $upload_claim_document = $claim['upload_claim_document'];
        }

        if(!empty($upload_claim_document)){
            $ipath = ('assets/images/uploads/claim/'.base64_decode($upload_claim_document));
            unlink($ipath);
        }
        $this->insurance_model->delete_claim($claim_id);
        $this->session->set_flashdata("delete_claim","Claim Details Deleted successfully.");
        $msg = $session_data['username']." ".'Deleted Claim Details For'." ".$property_name." ".'Property And Insurance Named'." ".$insurance_name." ".'With Poilcy No'." ".$policy_no;
          $this->user_activity_model->add('deleted',$msg,$session_data['username'],$session_data['admin_id']);  
        redirect("Insurance/view_claim_list","refresh");
    }

    public function edit_claim_detail(){
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

        $claim_id = base64_decode($this->uri->segment(3)); 

        $data['claim_list'] = $this->insurance_model->get_insurance_claim_data($claim_id);

        foreach($data['claim_list'] as $inc){
          $property_id = $inc['property_id'];
          $property_name = $inc['property_name'];
          $insurance_name = $inc['insurance_name'];
          $policy_no = $inc['policy_no'];
          $cl_id = $inc['claim_id'];
        }


        if(($claim_id == null OR $claim_id == '') OR (!isset($cl_id) OR $cl_id !== $claim_id OR $cl_id == null OR $cl_id == '')){

           show_404();
          exit();
          }

          if(!in_array("View Claim List",$role1)) {
           $msg = $session_data['username']." ".'Try To Use Edit Claim Details Page For'." ".$property_name." ".'Property And Insurance Named'." ".$insurance_name." ".'With Poilcy No'." ".$policy_no." ". '.This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
          redirect('Admin/auth_error');
          }   

          $prop_access_array = explode(",",$data['prop_access']);
        
        $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
              $msg = $session_data['username']." ".'Try To Use Edit Claim Details For'." ".$property_name." ".'Property And Insurance Named'." ".$insurance_name." ".'With Poilcy No'." ".$policy_no." ". '.This Property Access is Not Given to the'." ".$session_data['username'].'.';
              $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);
              redirect('Admin/auth_error');
            }
          $msg = $session_data['username']." ".'Visited Edit Claim Details Page For'." ".$property_name." ".'Property And Insurance Named'." ".$insurance_name." ".'With Poilcy No'." ".$policy_no;
          $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);    
        $this->load->view('edit_claim_detail',$this->security->xss_clean($data));
    }

    public function edit_claim_detail_redirect(){
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

        $claim_id = base64_decode($this->uri->segment(3)); 
 
        $data['claim_list'] = $this->insurance_model->get_insurance_claim_data($claim_id);

        foreach($data['claim_list'] as $inc){
          $property_id = $inc['property_id'];
          $property_name = $inc['property_name'];
          $insurance_name = $inc['insurance_name'];
          $policy_no = $inc['policy_no'];
          $cl_id = $inc['claim_id'];
        }


        if(($claim_id == null OR $claim_id == '') OR (!isset($cl_id) OR $cl_id !== $claim_id OR $cl_id == null OR $cl_id == '')){

           show_404();
          exit();
          }

          if(!in_array("View Claim List",$role1)) {
          $msg = $session_data['username']." ".'Try To Use Edit Claim Details For'." ".$property_name." ".'Property And Insurance Named'." ".$insurance_name." ".'With Poilcy No'." ".$policy_no." ". '.This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
          redirect('Admin/auth_error');
          }   

          $prop_access_array = explode(",",$data['prop_access']);
        
        $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
              $msg = $session_data['username']." ".'Try To Use Edit Claim Details For'." ".$property_name." ".'Property And Insurance Named'." ".$insurance_name." ".'With Poilcy No'." ".$policy_no." ". '.This Property Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);
              redirect('Admin/auth_error');
            }

        $this->form_validation->set_rules('claim_date_launch','Claim Date Launch','required');
        $this->form_validation->set_rules('claim_amount','Claim Amount','required');

        if($this->form_validation->run() === FALSE)
        { 
            $this->load->view('edit_claim_detail',$this->security->xss_clean($data));
        }
        else{

            foreach($data['claim_list'] as $claim){
                $upload_claim_document = $claim['upload_claim_document'];
             }
             $upload_claim = $upload_claim_document;
                $claim_document = $_FILES['claim_document']['name'];

                if(!empty($_FILES['claim_document']['name']) OR $_FILES['claim_document']['name'] !== ''){

                     $claim_document = str_replace(' ', '_', $claim_document);

                            $config['file_name'] =$claim_document;
                            $config['upload_path'] = './assets/images/uploads/claim';
                            $config['allowed_types'] = 'zip|pdf|jpeg|jpg|png|rar';
                            $config['max_size'] = '20000';
                            $config['encrypt_name'] = TRUE;
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            if (!$this->upload->do_upload('claim_document')) {
                                $error = array('error' => $this->upload->display_errors());
                               $this->session->set_flashdata('new_in',2);
                                redirect('Insurance/edit_claim_detail/'.$this->uri->segment(3),$this->security->xss_clean($data));
                            } else {
                                foreach($data['claim_list'] as $claim){
                                    $upload_claim_document = $claim['upload_claim_document'];
                                }

                                if(!empty($upload_claim_document)){
                                    $ipath = ('assets/images/uploads/claim/'.base64_decode($upload_claim_document));
                                    unlink($ipath);
                                }
                                $data1 = array('upload_data' => $this->upload->data());
                                $upload_claim = base64_encode($data1['upload_data']['file_name']);
                              } 
                }  

                                $this->insurance_model->update_claim($upload_claim,$claim_id);

                                $this->session->set_flashdata("update_claim","Claim Details Updated Successfully");
                                $msg = $session_data['username']." ".'Updated Claim Details For'." ".$property_name." ".'Property And Insurance Named'." ".$insurance_name." ".'With Poilcy No'." ".$policy_no;
                                $this->user_activity_model->add('updated',$msg,$session_data['username'],$session_data['admin_id']);  
                                redirect('Insurance/view_claim_list');  
        }    
    }




    public function insurance_edit_renewal_list(){
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

        $insurance_id = base64_decode($this->uri->segment(3));
        $data['insurance']=$this->insurance_model->view_insurance_detail($insurance_id);

         foreach($data['insurance'] as $inc){
          $property_id = $inc['property_id'];
          $property_name = $inc['property_name'];
          $insurance_name = $inc['insurance_name'];
          $policy_no = $inc['policy_no'];
          $inc_id = $inc['insurance_id'];
        }

        if(($insurance_id == null OR $insurance_id == '') OR (!isset($inc_id) OR $inc_id !== $insurance_id OR $inc_id == null OR $inc_id == '')){

           show_404();
          exit();
          }

          if(!in_array("List of Renewal",$role1)) {
           $msg = $session_data['username']." ".'Try To Renew Insurance Details For'." ".$property_name." ".'Property And Insurance Named'." ".$insurance_name." ".'With Poilcy No'." ".$policy_no." ". '.This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
          redirect('Admin/auth_error');
          }   

        $prop_access_array = explode(",",$data['prop_access']);
        
        $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
               $msg = $session_data['username']." ".'Try To Renew Insurance Details For'." ".$property_name." ".'Property And Insurance Named'." ".$insurance_name." ".'With Poilcy No'." ".$policy_no." ". '.This Property Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);
              redirect('Admin/auth_error');
            }

        foreach($data['insurance'] as $inc){
            if($inc['next_premium_date'] == date("Y-m-d", strtotime($this->input->post('next_renewal_date'))) AND empty($this->input->post('insurance_renewed'))){
                $this->session->set_flashdata("insurance_renew_fail","Next Renewal Date is not Same As Old Next Renewal Date");
                 $msg = $session_data['username']." ".'Try To Renew Insurance Details For'." ".$property_name." ".'Property And Insurance Named'." ".$insurance_name." ".'With Poilcy No'." ".$policy_no." ". '.But Next Renewal Date cannot be Same As Old Next Renewal Date.';
                   $this->user_activity_model->add('not_added',$msg,$session_data['username'],$session_data['admin_id']);
            } else {

                $this->insurance_model->update_insurance_renewal_detail($insurance_id);
                $this->insurance_model->add_insurance_pay_detail($insurance_id);
                 if(empty($this->input->post('insurance_renewed'))){
                  $this->session->set_flashdata("insurance_renew","Insurance Renewed Successfully");
                  $msg = $session_data['username']." ".'Renewed Insurance For'." ".$property_name." ".'Property And Insurance Named'." ".$insurance_name." ".'With Poilcy No'." ".$policy_no;
                   $this->user_activity_model->add('insurance_renewed',$msg,$session_data['username'],$session_data['admin_id']);   
                }
               else{
                $this->session->set_flashdata("insurance_close","Insurance Closed Successfully");  
                 $msg = $session_data['username']." ".'Closed Insurance For'." ".$property_name." ".'Property And Insurance Named'." ".$insurance_name." ".'With Poilcy No'." ".$policy_no;
                 $this->user_activity_model->add('insurance_close',$msg,$session_data['username'],$session_data['admin_id']); 
               }

            }
        }

        redirect('Insurance/insurance_renewal_list',"refresh");
    }

    public function insurance_company_master(){
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

          if(!in_array("Insurance Company",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Insurance Company Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
          redirect('Admin/auth_error');
          }   

        $data['insurance_company'] = $this->insurance_model->view_insurance_company();
        $msg = $session_data['username']." ".'Visited Insurance Company Master Page.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']); 
    	  $this->load->view('insurance_company_master',$this->security->xss_clean($data));
    }

    public function insurance_company_master_insert(){
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

          if(!in_array("Insurance Company",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Insurance Company Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
          redirect('Admin/auth_error');
          }   

         $data['insurance_company'] = $this->insurance_model->view_insurance_company();

        $this->form_validation->set_rules('insurance_company','Insurance Company','required');

         if($this->form_validation->run() == false)
        {
       
           
        $this->load->view('insurance_company_master',$this->security->xss_clean($data));


           
        }
        else{

            $query = $this->insurance_model->insertinsurancecompany();
            $this->session->set_flashdata("insurance_company","Insurance Company Added Successfully");
            $msg = $data['username']." ".'Added Insurance Company Named'." " .$this->input->post('insurance_company'). '.';
            $this->user_activity_model->add('added',$msg,$data['username'],$data['admin_id']);
            redirect("Insurance/insurance_company_master","refresh",$this->security->xss_clean($data));

        }
    }

    public function insurance_type_master(){
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

          if(!in_array("Insurance Type",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Insurance Type Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
          redirect('Admin/auth_error');
          }   

        $data['insurance_type'] = $this->insurance_model->view_insurance_type();
        $msg = $session_data['username']." ".'Visited Insurance Type Master Page.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']); 
    	  $this->load->view('insurance_type_master',$this->security->xss_clean($data));
    }

    public function insurance_type_master_insert(){
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

          if(!in_array("Insurance Type",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Insurance Type Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
          redirect('Admin/auth_error');
          }   

         $data['insurance_type'] = $this->insurance_model->view_insurance_type();

        $this->form_validation->set_rules('insurance_type','Insurance Type','required');

         if($this->form_validation->run() == false)
        {
       
           
        $this->load->view('insurance_type_master',$this->security->xss_clean($data));


           
        }
        else{

            $query = $this->insurance_model->insertinsurancetype();
            $this->session->set_flashdata("insurance_type","Insurance Type Added Successfully");
            $msg = $data['username']." ".'Added Insurance Type Named'." " .$this->input->post('insurance_type'). '.';
            $this->user_activity_model->add('added',$msg,$data['username'],$data['admin_id']);
            redirect("Insurance/insurance_type_master","refresh",$this->security->xss_clean($data));

        }
    }

    public function update_insurance_company(){
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

       $company = base64_decode($this->uri->segment(3));

       $data['company'] = $this->insurance_model->insurance_company($company);

       foreach($data['company'] as $company1){
        $company_name = $company1['insurance_company'];
        $inc_company_id = $company1['insurance_company_id'];
       }

       if(($company == null OR $company == '') OR (!isset($inc_company_id) OR $inc_company_id !== $company OR $inc_company_id == null OR $inc_company_id == '')){

           show_404();
          exit();
          }



          if(!in_array("Insurance Company",$role1)) {
          $msg = $session_data['username']." ".'Try To Use Update Insurance Company Page For'." ".$company_name." ".'Update Insurance Company Page Access is Not Given to the'." ".$session_data['username'].'.'; 
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
          redirect('Admin/auth_error');
          }   
        $msg = $session_data['username']." ".'Visited Update Insurance Company Page For'." ".$company_name.'.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);    
        $this->load->view('update_insurance_company',$this->security->xss_clean($data));
    }

    public function update_insurance_company_redirect(){
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

       $company = base64_decode($this->uri->segment(3));
       $data['company'] = $this->insurance_model->insurance_company($company);

       foreach($data['company'] as $company1){
        $company_name = $company1['insurance_company'];
        $inc_company_id = $company1['insurance_company_id'];
       }

       if(($company == null OR $company == '') OR (!isset($inc_company_id) OR $inc_company_id !== $company OR $inc_company_id == null OR $inc_company_id == '')){

           show_404();
          exit();
          }


          if(!in_array("Insurance Company",$role1)) {
          $msg = $session_data['username']." ".'Try To Use Update Insurance Company Page For'." ".$company_name." ".'Update Insurance Company Page Access is Not Given to the'." ".$session_data['username'].'.'; 
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
          redirect('Admin/auth_error');
          }   

        $this->form_validation->set_rules('insurance_company','Insurance Company','required');

         if($this->form_validation->run() == false)
        {
       
           
        $this->load->view('update_insurance_company',$this->security->xss_clean($data));


           
        }
        else{

               $query = $this->insurance_model->update_insurance_company($company);

               $this->session->set_flashdata("update_insurance_company","Insurance Company Updated Successfully");
               $msg = $data['username']." ".'Updated'." ".$this->input->post('insurance_company'). " ".'Insurance Company.';
               $this->user_activity_model->add('updated',$msg,$data['username'],$data['admin_id']);

              redirect('Insurance/insurance_company_master');

            } 


    }


    public function update_insurance_type(){
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
      
       $data['type'] = $this->insurance_model->insurance_type($type);

       foreach($data['type'] as $inc_type){

        $type_inc = $inc_type['insurance_type'];
        $inc_type_id = $inc_type['insurance_type_id'];

       }

         if(($type == null OR $type == '') OR (!isset($inc_type_id) OR $inc_type_id !== $type OR $inc_type_id == null OR $inc_type_id == '')){

           show_404();
          exit();
          }

          if(!in_array("Insurance Type",$role1)) {
          $msg = $session_data['username']." ".'Try To Use Update Insurance Type Page For'." ".$type_inc." ".'Update Insurance Type Page Access is Not Given to the'." ".$session_data['username'].'.'; 
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
          redirect('Admin/auth_error');
          }   
         $msg = $session_data['username']." ".'Visited Update Insurance Type Page For'." ".$type_inc.'.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);  
        $this->load->view('update_insurance_type',$this->security->xss_clean($data));
    }

    public function update_insurance_type_redirect(){
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

          $data['type'] = $this->insurance_model->insurance_type($type);

           foreach($data['type'] as $inc_type){

            $type_inc = $inc_type['insurance_type'];
            $inc_type_id = $inc_type['insurance_type_id'];

       }

         if(($type == null OR $type == '') OR (!isset($inc_type_id) OR $inc_type_id !== $type OR $inc_type_id == null OR $inc_type_id == '')){

           show_404();
          exit();
          }
          if(!in_array("Insurance Type",$role1)) {
          $msg = $session_data['username']." ".'Try To Use Update Insurance Type Page For'." ".$type_inc." ".'Update Insurance Type Page Access is Not Given to the'." ".$session_data['username'].'.'; 
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);     
          redirect('Admin/auth_error');
          }   


      $this->form_validation->set_rules('insurance_type','Insurance Type','required');

         if($this->form_validation->run() == false)
        {
       
           
        $this->load->view('update_insurance_type',$this->security->xss_clean($data));


           
        }
        else{

               $query = $this->insurance_model->update_insurance_type($type);

               $this->session->set_flashdata("update_insurance_type","Insurance Type Updated Successfully");
               $msg = $data['username']." ".'Updated'." ".$this->input->post('insurance_type'). " ".'Insurance Type.';
               $this->user_activity_model->add('updated',$msg,$data['username'],$data['admin_id']);
              redirect('Insurance/insurance_type_master');

            } 


    }

    public function view_insurance_pay_history(){

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

        $insurance_id = base64_decode($this->uri->segment(3));
       
        $data['insurance_installment'] = $this->insurance_model->get_insurance_pay_detail($insurance_id);
        $data['insurance']=$this->insurance_model->view_insurance_detail($insurance_id);


         foreach($data['insurance'] as $inc){
          $property_id = $inc['property_id'];
          $property_name = $inc['property_name'];
          $insurance_name = $inc['insurance_name'];
          $policy_no = $inc['policy_no'];
          $inc_id = $inc['insurance_id'];
        }

         if(($insurance_id == null OR $insurance_id == '') OR (!isset($inc_id) OR $inc_id !== $insurance_id OR $inc_id == null OR $inc_id == '')){

           show_404();
          exit();
          }

          if(!in_array("List of Renewal",$role1)) {
           $msg = $session_data['username']." ".'Try To View Insurance Pay Histroy For'." ".$property_name." ".'Property And Insurance Named'." ".$insurance_name." ".'With Poilcy No'." ".$policy_no." ". '.This Page Access is Not Given to the'." ".$session_data['username'].'.';
          $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
          redirect('Admin/auth_error');
          }   

        $prop_access_array = explode(",",$data['prop_access']);
        
        $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
              $msg = $session_data['username']." ".'Try To View Insurance Pay Histroy For'." ".$property_name." ".'Property And Insurance Named'." ".$insurance_name." ".'With Poilcy No'." ".$policy_no." ". '.This Property Access is Not Given to the'." ".$session_data['username'].'.';
             $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);
              redirect('Admin/auth_error');
            }
         $msg = $session_data['username']." ".'Visited Insurance Pay Histroy For'." ".$property_name." ".'Property And Insurance Named'." ".$insurance_name." ".'With Poilcy No'." ".$policy_no;
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);    
        $this->load->view('view_insurance_pay_history',$this->security->xss_clean($data));

     } 

}    