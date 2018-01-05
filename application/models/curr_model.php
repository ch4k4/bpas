<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Curr_model extends CI_Model {

    public $limit;
    public $offset;

    function __construct() {
        parent::__construct();
    }

    public function listA() {
        //$query = $this->db->limit($this->limit, $this->offset)
        $query = $this->db->limit($this->limit)
						->get('uang');
        return $query->result_array();
    }

    public function listA_page($descp) {
		$query = $this->db->select('*')
						->from('uang')
                        ->like('name', $descp)                        
                        ->get('', $this->limit, $this->offset);
        return $query->result_array();
    }

     public function numRec() {
        $result = $this->db->from('uang');
        return $result->count_all();
    }

    public function numRec_page($descp) {
		$result = $this->db->like('name', $descp)
                        ->from('uang')
                        ->count_all_results();
        return $result;
    }


    //CRUD FUNCTION

    public function selectData($plu) {
        $query = $this->db->where('id', $plu)
            ->get('uang');
        return $query->result();
    }

    public function cekPLU($plu) {
        $query = $this->db->select('name')
            ->where('id', $plu)
            ->from('uang')
            ->count_all_results();
        return $query;
    }

    function addData($arrBarang) {
        $query = $this->db->insert('uang', $arrBarang);
        return $query;
    }

    function updtData($_ctid,$arrCt) {
        $query = $this->db->where('id', $_ctid)
            ->update('uang', $arrCt);
        return $query;
    }


    function deleteData($plu) {
        $this->db->trans_begin();
        $this->db->query('DELETE FROM uang WHERE (uang.id = "'.$plu.'")');
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