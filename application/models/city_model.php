<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class City_model extends CI_Model {

    public $limit;
    public $offset;

    function __construct() {
        parent::__construct();
    }

    public function listA() {        
        $query = $this->db->limit($this->limit)
						->get('propinsi');
        return $query->result_array();
    }

    public function listA_page($descp) {
		$query = $this->db->select('a.*, b.desc AS country')
						->from('propinsi AS a')
						->join('country AS b', 'a.country_id=b.id')
                        ->like('propinsi', $descp)                        
                        ->get('', $this->limit, $this->offset);
        return $query->result_array();
    }
    
    function getList($id){
        $result = array();
        $this->db->select('*');
        $this->db->from('propinsi');
        $this->db->where('country_id',$id);
        $this->db->order_by('id','ASC');
        $array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
            $result[0]= '-- Select City --';
            $result[$row->id]= $row->propinsi;
        }
    
        return $result;
    }
    
    public function getCityBy($id) {
        $query = $this->db->select('name')
        ->where('id', $id)
        ->from('propinsi');
        return $query;
    }

     public function numRec() {
        $result = $this->db->from('propinsi');
        return $result->count_all();
    }

    public function numRec_page($descp) {
		$result = $this->db->like('propinsi', $descp)
                        ->from('propinsi')
                        ->count_all_results();
        return $result;
    }


    //CRUD FUNCTION

    public function selectData($plu) {
        $query = $this->db->where('id', $plu)
            ->get('propinsi');
        return $query->result();
    }

    public function cekPLU($plu) {
        $query = $this->db->select('propinsi')
            ->where('propinsi', $plu)
            ->from('propinsi')
            ->count_all_results();
        return $query;
    }

    function addData($arrData) {
        $query = $this->db->insert('propinsi', $arrData);
        return $query;
    }

    function updtData($_ctid,$arrCt) {
        $query = $this->db->where('id', $_ctid)
            ->update('propinsi', $arrCt);
        return $query;
    }


    function deleteData($plu) {
        $this->db->trans_begin();
        $this->db->query('DELETE FROM propinsi WHERE (propinsi.id = "'.$plu.'")');
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