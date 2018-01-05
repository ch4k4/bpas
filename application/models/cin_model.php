<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cin_model extends CI_Model {

    public $limit;
    public $offset;

    function __construct() {
        parent::__construct();
    }

    public function listCt() {        
        $query = $this->db->limit($this->limit)
						->get('cin');
        return $query->result_array();
    }

    public function listCt_page($descp) {
		$query = $this->db->select('a.*, b.name as tipe')
						->from('cin as a')						
						->join('ct_type AS b', 'a.ct_type_id=b.id')
                        ->like('a.name', $descp)
                        ->or_like('a.kode', $descp)
                        ->get('', $this->limit, $this->offset);
        return $query->result_array();
    }

     public function numRec() {
        $result = $this->db->from('cin');
        return $result->count_all();
    }

    public function numRec_page($descp) {
		$result = $this->db->like('name', $descp)
                        ->from('cin')
                        ->count_all_results();
        return $result;
    }


    //CRUD FUNCTION

    public function selectCt($plu) {
        $query = $this->db->where('id', $plu)
            ->get('cin');
        return $query->result();
    }

    public function cekPLU($plu) {
        $query = $this->db->select('name')
            ->where('name', $plu)
            ->from('cin')
            ->count_all_results();
        return $query;
    }

    function addData($arrData) {
        $query = $this->db->insert('cin', $arrData);
        return $query;
    }

    function updtData($_ctid,$arrCt) {
        $query = $this->db->where('id', $_ctid)
            ->update('cin', $arrCt);
        return $query;
    }


    function deleteData($plu) {
        $this->db->trans_begin();
        $this->db->query('DELETE FROM cin WHERE (cin.id = "'.$plu.'")');
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