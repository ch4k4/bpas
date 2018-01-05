<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subsec_model extends CI_Model {

    public $limit;
    public $offset;

    function __construct() {
        parent::__construct();
    }

    public function listA() {        
        $query = $this->db->limit($this->limit)
						->get('subsec');
        return $query->result_array();
    }

    public function listA_page($descp) {
		$query = $this->db->select('a.*, b.name AS jbeban')
						->from('subsec AS a')
						->join('sector AS b', 'a.sector_id=b.id')
                        ->like('a.name', $descp)
                        ->order_by('b.id','ASC')
                        ->order_by('a.id','ASC')
                        ->get('', $this->limit, $this->offset);
        return $query->result_array();
    }    

     public function numRec() {
        $result = $this->db->from('subsec');
        return $result->count_all();
    }

    public function numRec_page($descp) {
		$result = $this->db->like('name', $descp)
                        ->from('subsec')
                        ->count_all_results();
        return $result;
    }
	
	function getList(){
        $result = array();
        $this->db->select('*');
        $this->db->from('subsec');
        $this->db->order_by('id','ASC');
        $array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
            $result[0]= '-- Select Beban --';
            $result[$row->id]= $row->name;
        }
    
        return $result;
    }

	function getListA($id){
        $result = array();
        $this->db->select('*');
        $this->db->from('subsec');
        $this->db->where('sector_id',$id);
        $this->db->order_by('id','ASC');
        $array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
            $result[0]= '-- Select Beban --';
            $result[$row->id]= $row->name;
        }
    
        return $result;
    }
	
    //CRUD FUNCTION

    public function selectData($plu) {
        $query = $this->db->where('id', $plu)
            ->get('subsec');
        return $query->result();
    }

    public function cekPLU($plu) {
        $query = $this->db->select('name')
            ->where('name', $plu)
            ->from('subsec')
            ->count_all_results();
        return $query;
    }

    function addData($arrData) {
        $query = $this->db->insert('subsec', $arrData);
        return $query;
    }

    function updtData($_ctid,$arrCt) {
        $query = $this->db->where('id', $_ctid)
            ->update('subsec', $arrCt);
        return $query;
    }


    function deleteData($plu) {
        $this->db->trans_begin();
        $this->db->query('DELETE FROM subsec WHERE (subsec.id = "'.$plu.'")');
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