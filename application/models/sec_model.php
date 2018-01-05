<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sec_model extends CI_Model {

    public $limit;
    public $offset;

    function __construct() {
        parent::__construct();
    }

    public function listSec() {
        //$query = $this->db->limit($this->limit, $this->offset)
        $query = $this->db->limit($this->limit)
						->get('sec_type');
        return $query->result_array();
    }

    public function listSec_page($descp) {
		$query = $this->db->select('*')
						->from('sec_type')
                        ->like('name', $descp)                        
                        ->get('', $this->limit, $this->offset);
        return $query->result_array();
    }

     public function numRec() {
        $result = $this->db->from('sec_type');
        return $result->count_all();
    }

    public function numRec_page($descp) {
		$result = $this->db->like('name', $descp)
                        ->from('sec_type')
                        ->count_all_results();
        return $result;
    }
	
	function getSecList(){
		$result = array();
		$this->db->select('*');
		$this->db->from('sec_type');
		$this->db->order_by('name','ASC');
		$array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
            $result[0]= '-- Select Jenis Beban --';
            $result[$row->kode]= $row->name;
        }
        
        return $result;
	}


    //CRUD FUNCTION

    public function selectSec($plu) {
        $query = $this->db->where('id', $plu)
            ->get('sec_type');
        return $query->result();
    }

    public function cekPLU($plu) {
        $query = $this->db->select('name')
            ->where('name', $plu)
            ->from('sec_type')
            ->count_all_results();
        return $query;
    }

    function addData($arrData) {
        $query = $this->db->insert('sec_type', $arrData);
        return $query;
    }

    function updtData($_ctid,$arrCt) {
        $query = $this->db->where('id', $_ctid)
            ->update('sec_type', $arrCt);
        return $query;
    }


    function deleteData($plu) {
        $this->db->trans_begin();
        $this->db->query('DELETE FROM sec_type WHERE (sec_type.id = "'.$plu.'")');
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