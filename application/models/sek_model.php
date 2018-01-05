<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sek_model extends CI_Model {

    public $limit;
    public $offset;

    function __construct() {
        parent::__construct();
    }

    public function listA() {
        //$query = $this->db->limit($this->limit, $this->offset)
        $query = $this->db->limit($this->limit)
						->get('sector');
        return $query->result_array();
    }

    public function listA_page($descp) {
		$query = $this->db->select('*')
						->from('sector')
                        ->like('name', $descp)                        
                        ->get('', $this->limit, $this->offset);
        return $query->result_array();
    }    
    
    function getList(){
        $result = array();
        $this->db->select('*');
        $this->db->from('sector');
        $this->db->order_by('id','ASC');
        $array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
            $result[0]= '-- Select Sector --';
            $result[$row->id]= $row->name;
        }
    
        return $result;
    }
    
     public function numRec() {
        $result = $this->db->from('sector');
        return $result->count_all();
    }

    public function numRec_page($descp) {
		$result = $this->db->like('name', $descp)
                        ->from('sector')
                        ->count_all_results();
        return $result;
    }


    //CRUD FUNCTION

    public function selectA($plu) {
        $query = $this->db->where('id', $plu)
            ->get('sector');
        return $query->result();
    }

    public function cekPLU($plu) {
        $query = $this->db->select('name')
            ->where('name', $plu)
            ->from('sector')
            ->count_all_results();
        return $query;
    }

    function addItem($arrBarang) {
        $query = $this->db->insert('sector', $arrBarang);
        return $query;
    }

    function updtItem($_ctid,$arrCt) {
        $query = $this->db->where('id', $_ctid)
            ->update('sector', $arrCt);
        return $query;
    }


    function deleteItem($plu) {
        $this->db->trans_begin();
        $this->db->query('DELETE FROM sector WHERE (sector.id = "'.$plu.'")');
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