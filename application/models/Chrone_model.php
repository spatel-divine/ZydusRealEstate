<?php

class Chrone_model extends CI_Model
{
    public function __construct() 
    {
        $this->load->database();
    }

    public function view_document_renewal_data() {  
        $this->db->order_by('upload_document_id','desc');
        $query = $this->db->get('upload_document_master');
                return $query->result_array();
        }

    public function update_uploaded_document_detail($upload_id)
    {

            $data = array(
            'is_renewed' => 0,
            );
            $this->db->where('upload_document_id', $upload_id);
            return $this->db->update('upload_document_master', $data);
        
        }

}