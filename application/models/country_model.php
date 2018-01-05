<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Country_model extends CI_Model {

    public $limit;
    public $offset;

    function __construct() {
        parent::__construct();
    }

    public function listA() {
        //$query = $this->db->limit($this->limit, $this->offset)
        $query = $this->db->limit($this->limit)
						->get('country');
        return $query->result_array();
    }

    public function listA_page($descp) {
		$query = $this->db->select('*')
						->from('country')
                        ->like('desc', $descp)                        
                        ->get('', $this->limit, $this->offset);
        return $query->result_array();
    }
    
    function getList(){
        $result = array();
        $this->db->select('*');
        $this->db->from('country');        
        $this->db->order_by('name','ASC');
        $array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
            $result[0]= '-- Select Country --';
            $result[$row->id]= $row->desc;
        }
    
        return $result;
    }
	
	public function getCountryBy($id) {
        $query = $this->db->select('name')
        ->where('id', $id)
        ->from('country');
        return $query;
    }

     public function numRec() {
        $result = $this->db->from('country');
        return $result->count_all();
    }

    public function numRec_page($descp) {
		$result = $this->db->like('name', $descp)
                        ->from('country')
                        ->count_all_results();
        return $result;
    }


    //CRUD FUNCTION

    public function selectData($plu) {
        $query = $this->db->where('id', $plu)
            ->get('country');
        return $query->result();
    }

    public function cekPLU($plu) {
        $query = $this->db->select('name')
            ->where('name', $plu)
            ->from('country')
            ->count_all_results();
        return $query;
    }

    function addData($arrBarang) {
        $query = $this->db->insert('country', $arrBarang);
        return $query;
    }

    function updtData($_ctid,$arrCt) {
        $query = $this->db->where('id', $_ctid)
            ->update('country', $arrCt);
        return $query;
    }


    function deleteData($plu) {
        $this->db->trans_begin();
        $this->db->query('DELETE FROM country WHERE (country.id = "'.$plu.'")');
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