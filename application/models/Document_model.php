<?php
class Document_model extends CI_Model
{
    public function __construct() {
        $this->load->database();
    }

     public function insertdocumenttype()
    {
    	 date_default_timezone_set("Asia/Kolkata");
        $data = array(
             
            'document_type' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('doc_type'))),
            'document_type_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
        );
      
            $this->db->insert('document_type_master', $data);
      
    }

    public function view_document_type() {  
        $this->db->order_by('document_type_id','desc');
                $query = $this->db->get('document_type_master');
                return $query->result_array();
        }


        public function document_type($type) {  
        $this->db->order_by('document_type_id','desc');
                $query = $this->db->get_where('document_type_master',array('document_type_id' =>$this->db->escape_str($type)));
                return $query->result_array();
        }

        public function update_document_type($type)
    	{

            $data = array(
            'document_type' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('doc_type'))),
            );
            $this->db->where('document_type_id', $this->db->escape_str($type));
            return $this->db->update('document_type_master', $data);
        
    	}


    	public function insertdocumentauthority()
    {
    	 date_default_timezone_set("Asia/Kolkata");
        $data = array(
             
            'document_authority' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('document_authority'))),
            'doc_auth_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
        );
      
            $this->db->insert('document_authority_master', $data);
      
    }

    public function view_document_authority() {  
        $this->db->order_by('document_auth_id','desc');
                $query = $this->db->get('document_authority_master');
                return $query->result_array();
        }


        public function document_authority($authority) {  
        $this->db->order_by('document_auth_id','desc');
                $query = $this->db->get_where('document_authority_master',array('document_auth_id' => $this->db->escape_str($authority)));
                return $query->result_array();
        }

        public function update_document_authority($authority)
    	{

            $data = array(
            'document_authority' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('document_authority'))),
            );
            $this->db->where('document_auth_id', $this->db->escape_str($authority));
            return $this->db->update('document_authority_master', $data);
        
    	}

          public function add_document()
        {
         date_default_timezone_set("Asia/Kolkata");
        $data = array(
            'document_name' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('document_name'))),
            'document_type' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('document_type'))),
            'document_nature' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('document_nature'))),
            'document_state' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('document_state'))),
            'document_renewal' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('renewal'))),
            'document_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
        );
      
            $this->db->insert('document_master', $data);
      
        }

        public function upload_document($document_data)
        {
             return  $this->db->insert('upload_document_master', $document_data);
        }


         public function view_document() {  
            $query = $this->db->query('SELECT cc.*,dt.*, COUNT(c.document_id) AS code_count FROM upload_document_master c RIGHT JOIN document_master cc on cc.document_id = c.document_id INNER JOIN document_type_master dt on cc.document_type = dt.document_type_id GROUP BY cc.document_id DESC');
                return $query->result_array();
        }

          public function view_property() {  
        $this->db->order_by('property_id','desc');
        $query = $this->db->join('property_financial_status_master','property_master.financial_status_id = property_financial_status_master.financial_status_id');
              
                $query = $this->db->where('financial_status != "'.$this->db->escape_str("Sold").'"');
                 $query = $this->db->from('property_master');
                $query = $this->db->get();
                return $query->result_array();
        }

        public function delete_document($document_id) {
            
       $query = $this->db->get_where('upload_document_master',array("document_id"=>$this->db->escape_str($document_id)));

             foreach ($query->result_array() as $result) 
            {
                    if($result['document_id'] == $document_id){
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

            $this->db->delete('upload_document_master', array('document_id' => $document_id));
            $this->db->delete('document_master', array('document_id' => $document_id)); 
        }


        public function view_document_detail($document_id){
      
         //$query = $this->db->join('document_type_master','document_master.document_type = document_type_master.document_type_id');    
         $query = $this->db->get_where('document_master',array("document_id"=>$this->db->escape_str($document_id)));
            return $query->result_array();
    }

    public function update_document($document_id)
    {

            $data = array(
            'document_name' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('document_name'))),
            'document_type' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('document_type'))),
            'document_nature' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('document_nature'))),
            'document_state' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('document_state'))),
            'document_renewal' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('renewal'))),
            );
            $this->db->where('document_id', $this->db->escape_str($document_id));
            return $this->db->update('document_master', $data);
        
    }

      public function view_document_summary() {  
        $this->db->order_by('upload_document_id','desc');
        $this->db->join('document_master','upload_document_master.document_id = document_master.document_id');
        $this->db->join('property_master','upload_document_master.property_id = property_master.property_id');
        $this->db->join('document_type_master','document_master.document_type = document_type_master.document_type_id');
         $this->db->join('document_authority_master','upload_document_master.document_authority_id = document_authority_master.document_auth_id');
                $query = $this->db->get('upload_document_master');
                return $query->result_array();
        }

        public function view_document_summary_detail($document_id) {  
       $this->db->order_by('upload_document_id','desc');
        $this->db->join('document_master','upload_document_master.document_id = document_master.document_id');
        $this->db->join('property_master','upload_document_master.property_id = property_master.property_id');
        $this->db->join('document_authority_master','upload_document_master.document_authority_id = document_authority_master.document_auth_id');
         $query1 = $this->db->get_where('upload_document_master',array('upload_document_id'=>$this->db->escape_str($document_id)));
         return $query1->result_array(); 

     }

      public function view_document_summary_property_detail($property_id) {  
         $query1 = $this->db->get_where('property_master',array('property_id'=>$this->db->escape_str($property_id)));
         return $query1->result_array(); 

     }

      public function view_uploaded_document_detail($document_id) {  
       $this->db->order_by('upload_document_id','desc');
        $this->db->join('document_master','upload_document_master.document_id = document_master.document_id');
        $this->db->join('property_master','upload_document_master.property_id = property_master.property_id');
        $this->db->join('document_authority_master','upload_document_master.document_authority_id = document_authority_master.document_auth_id');
         $query1 = $this->db->get_where('upload_document_master',array('upload_document_master.document_id'=>$this->db->escape_str($document_id)));
         return $query1->result_array(); 

     }

     public function download_detail($upload_document_id){
         $query = $this->db->get_where('upload_document_master',array("upload_document_id"=>$this->db->escape_str($upload_document_id)));
            return $query->row()->document_upload;
    }

    public function property_id_detail($upload_document_id){
         $query = $this->db->get_where('upload_document_master',array("upload_document_id"=>$this->db->escape_str($upload_document_id)));
            return $query->row()->property_id;
    }

    
         public function get_property_state($id) {  
        $this->db->select('state');
             $this->db->from('property_master'); 
             $this->db->where('property_id',$this->db->escape_str($id)) ;
        $this->db->order_by('property_id','desc');
                $query = $this->db->get();
                return $query->row();
        }

        public function get_property_finacial_status($id) {  
        $this->db->join('property_financial_status_master','property_master.financial_status_id = property_financial_status_master.financial_status_id');
             $this->db->from('property_master'); 
             $this->db->where('property_id',$this->db->escape_str($id)) ;
        $this->db->order_by('property_id','desc');
                $query = $this->db->get();
                return $query->result_array();
        }

        public function get_document_acc_state($property_data) {  
        $this->db->order_by('document_id','desc');
        $query = $this->db->get_where('document_master',array('document_state' => $this->db->escape_str($property_data)));
        return $query->result_array();
        }

         public function get_document_renewal($id) {  
        $this->db->select('document_renewal');
             $this->db->from('document_master'); 
             $this->db->where('document_id',$this->db->escape_str($id)) ;
        $this->db->order_by('document_id','desc');
                $query = $this->db->get();
                return $query->result_array();
        }

        public function get_uploaded_property($property) {  
                $this->db->select('property_id,document_id');
                $this->db->from('upload_document_master'); 
                $this->db->where('property_id',$this->db->escape_str($property)) ;
                $this->db->order_by('upload_document_id','desc');
                $query = $this->db->get();
                return $query->result_array();
        }

        public function get_uploaded_document_all_data($property_id) 
        {  
                $this->db->order_by('upload_document_id','desc');
                $query = $this->db->get_where('upload_document_master',array('property_id' => $this->db->escape_str($property_id)));
                return $query->result_array();
        }

        public function renew_upload_status($data,$id)
        {             
                $this->db->where('upload_document_id', $this->db->escape_str($id));
                return $this->db->update('upload_document_master', $data);
        }

        public function view_property_for_filter() {  
            $this->db->order_by('property_id','desc');
            $query = $this->db->from('property_master');
            $query = $this->db->get();
            return $query->result_array();
        }

}