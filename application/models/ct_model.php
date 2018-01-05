<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ct_model extends CI_Model {

    public $limit;
    public $offset;

    function __construct() {
        parent::__construct();
    }

    public function listCt() {        
        $query = $this->db->limit($this->limit)
						->get('ct_type');
        return $query->result_array();
    }

    public function listCt_page($descp) {
		$query = $this->db->select('*')
						->from('ct_type')
                        ->like('name', $descp)                        
                        ->get('', $this->limit, $this->offset);
        return $query->result_array();
    }
    
    function getList(){
        $result = array();
        $this->db->select('*');
        $this->db->from('ct_type');
        $this->db->order_by('name','ASC');
        $array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
            $result[0]= '-- Select Type --';
            $result[$row->id]= $row->name;
        }
    
        return $result;
    }

     public function numRec() {
        $result = $this->db->from('ct_type');
        return $result->count_all();
    }

    public function numRec_page($descp) {
		$result = $this->db->like('name', $descp)
                        ->from('ct_type')
                        ->count_all_results();
        return $result;
    }


    //CRUD FUNCTION

    public function selectCt($plu) {
        $query = $this->db->where('id', $plu)
            ->get('ct_type');
        return $query->result();
    }

    public function cekPLU($plu) {
        $query = $this->db->select('name')
            ->where('name', $plu)
            ->from('ct_type')
            ->count_all_results();
        return $query;
    }

    function addData($arrData) {
        $query = $this->db->insert('ct_type', $arrData);
        return $query;
    }

    function updtData($_ctid,$arrCt) {
        $query = $this->db->where('id', $_ctid)
            ->update('ct_type', $arrCt);
        return $query;
    }


    function deleteData($plu) {
        $this->db->trans_begin();
        $this->db->query('DELETE FROM ct_type WHERE (ct_type.id = "'.$plu.'")');
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $result = 0;
        }
        else
        {
            $this->db->trans_commit();
            $result =1;
        }
        return $result;
    }

    //END CRUD FUNCTION
}

/* End of file barang_model */