<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bin_model extends CI_Model {

    public $limit;
    public $offset;

    function __construct() {
        parent::__construct();
    }

    public function listA() {
        //$query = $this->db->limit($this->limit, $this->offset)
        $query = $this->db->limit($this->limit)
						->get('bank_info');
        return $query->result_array();
    }

    public function listA_page($descp) {
		$query = $this->db->select('a.*, b.name AS nmbank')
						->from('bank_info AS a')
						->join('bank_group AS b', 'a.bank_group_kode=b.kode')
                        ->like('a.name', $descp)                        
                        ->get('', $this->limit, $this->offset);
        return $query->result_array();
    }     
	 
     public function numRec() {
        $result = $this->db->from('bank_info');
        return $result->count_all();
    }

    public function numRec_page($descp) {
		$result = $this->db->like('name', $descp)
                        ->from('bank_info')
                        ->count_all_results();
        return $result;
    }


    //CRUD FUNCTION

    public function selectData($plu) {
        $query = $this->db->where('id', $plu)
            ->get('bank_info');
        return $query->result();
    }

    public function cekPLU($plu) {
        $query = $this->db->select('name')
            ->where('name', $plu)
            ->from('bank_info')
            ->count_all_results();
        return $query;
    }

    function addData($arrData) {
        $query = $this->db->insert('bank_info', $arrData);
        return $query;
    }

    function updtData($_ctid,$arrCt) {
        $query = $this->db->where('id', $_ctid)
            ->update('bank_info', $arrCt);
        return $query;
    }


    function deleteData($plu) {
        $this->db->trans_begin();
        $this->db->query('DELETE FROM bank_info WHERE (bank_info.id = "'.$plu.'")');
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