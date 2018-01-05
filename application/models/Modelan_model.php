<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Modelan_model extends CI_Model {

    //public $limit;
    //public $offset;

    function __construct() {
        parent::__construct();
    }

    function getListSalut(){
        $result = array();
        $this->db->select('*');
        $this->db->from('salut');        
        $this->db->order_by('nama','ASC');
        $array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
            $result[0]= '-- Select Title --';
            $result[$row->id]= $row->nama;
        }
    
        return $result;
    }
    
public function getListSalutBy($id) {
        $query = $this->db->select('nama')
            ->where('id', $id)
            ->from('salut');
        return $query;
    }
}