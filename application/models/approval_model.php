<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Approval_model extends CI_Model {

    public $limit;
    public $offset;

    function __construct() {
        parent::__construct();
    }

    public function listA() {        
        $query = $this->db->limit($this->limit)
						->get('entry');
        return $query->result_array();
    }

    public function listA_page($descp) {
		$query = $this->db->select('a.*, b.name AS jbeban, c.name AS nbeban')
						->from('entry AS a')
						->join('sector AS b', 'a.sector_id=b.id')
						->join('subsec AS c', 'a.subsec_id=c.id')
                        ->like('a.name', $descp)
                        ->order_by('a.dt_input','DESC')
                        ->order_by('a.id','DESC')
						->where('sts','o')
                        ->get('', $this->limit, $this->offset);
        return $query->result_array();
    }    

     public function numRec() {
        $result = $this->db->from('entry');
        return $result->count_all();
    }

    public function numRec_page($descp) {
		$result = $this->db->like('name', $descp)
                        ->from('entry')
						->where('sts','o')
                        ->count_all_results();
        return $result;
    }	
	
    //CRUD FUNCTION

    public function selectData($plu) {
        $query = $this->db->where('id', $plu)
            ->get('entry');
        return $query->result();
    }

    public function cekPLU($plu) {
        $query = $this->db->select('name')
            ->where('name', $plu)
            ->from('entry')
            ->count_all_results();
        return $query;
    }
	
	function updtData($_ctid,$arrCt) {
        $query = $this->db->where('id', $_ctid)
            ->update('entry', $arrCt);
        return $query;
    }

	/*
    function addData($arrData) {
        $query = $this->db->insert('entry', $arrData);
        return $query;
    }

    function deleteData($plu) {
        $this->db->trans_begin();
        $this->db->query('DELETE FROM entry WHERE (entry.id = "'.$plu.'")');
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
	*/
    //END CRUD FUNCTION
}