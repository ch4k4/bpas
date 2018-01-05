<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * barang_model
 *
 * Created on Feb 21, 2011, 10:57:01 PM
 */

/**
 *
 * @author agung
 */
class Bank_model extends CI_Model {

    public $limit;
    public $offset;

    function __construct() {
        parent::__construct();
    }

    public function listData() {
        $query = $this->db->limit($this->limit, $this->offset)                       
						->get('bank_group');
        return $query->result_array();
    }
	
	function getBankList(){
		$result = array();
		$this->db->select('*');
		$this->db->from('bank_group');
		$this->db->order_by('name','ASC');
		$array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
            $result[0]= '-- Select Bank Group Name --';
            $result[$row->kode]= $row->name;
        }
        
        return $result;
	}
	
	public function getBankBy($id) {
        $query = $this->db->select('name')
            ->where('id', $id)
            ->from('bank_group');
        return $query;
    }

    public function listData_page($descp) {
        //$query = $this->db->select('plu,descp,satuan,harga')
		$query = $this->db->select('*')
                        //->from('barang')
                        //->like('descp', $descp)
                        //->like('satuan', $satuan)
						->from('bank_group')
                        ->like('name', $descp)
                        //->like('kode', $satuan)
                        ->get('', $this->limit, $this->offset);
        return $query->result_array();
    }

     public function numRec() {
        $result = $this->db->from('bank_group');
        return $result->count_all();
    }

    public function numRec_page($descp) {
        /*
		$result = $this->db->like('descp', $descp)
                        ->like('satuan', $satuan)
                        ->from('barang')
						*/
		$result = $this->db->like('name', $descp)                        
                        ->from('bank_group')
                        ->count_all_results();
        return $result;
    }


    //CRUD FUNCTION

    public function selectData($plu) {
        $query = $this->db->where('id', $plu)
            ->get('bank_group');
        return $query->result();
    }

    public function cekPLU($plu) {
        $query = $this->db->select('name')
            ->where('id', $plu)
            ->from('bank_group')
            ->count_all_results();
        return $query;
    }

    function addData($arrData) {
        $query = $this->db->insert('bank_group', $arrData);
        return $query;
    }

    function updtData($plu,$descp) {
        $query = $this->db->where('id', $plu)
            ->update('bank_group', $descp);
        return $query;
    }


    function deleteData($plu) {
        $this->db->trans_begin();
        $this->db->query('DELETE FROM bank_group WHERE (bank_group.id = "'.$plu.'")');
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