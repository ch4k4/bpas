<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * barang_ctl
 *
 * Created on Mar 19, 2011, 10:41:15 AM
 */

/**
 *
 * @author agung
 */

class Bank extends CI_Controller {
    private $pagesize = 10;
	
    private $rules = array(
        array(
            'field' => 'plu',
            'label' => 'Bank Group Name :',
            'rules' => 'required|trim|xss_clean|min_length[2]|max_length[255]',
        ),
        array(
            'field' => 'descp',
            'label' => 'Bank Group Code :',
            'rules' => 'required|trim|xss_clean|min_length[2]|max_length[3]',
        )
    );	
	
	function __construct()
	{
		parent::__construct();
                
				$this->load->model('bank_model');
	}

	function index() {
	    
    }

    function search_data() {
        if (isset($_POST['descp_msg']) && $_POST['descp_msg'] != NULL) {
            $vDescp = $_POST['descp_msg'];
        }
        else
            $vDescp = '';
/*
        if (isset($_POST['descp_satuan']) && $_POST['descp_satuan'] != NULL) {
            $vSatuan = $_POST['descp_satuan'];
        }
        else
            $vSatuan = '';
*/
        if (isset($_POST['pageNumber']) && $_POST['pageNumber'] != NULL) {
            $idoffset = $_POST['pageNumber'] - 1;
        }
        else
            $idoffset=0;

        $this->bank_model->limit =  $this->pagesize;
        $this->bank_model->offset = $idoffset *  $this->pagesize;
        $result['offset'] = $this->bank_model->offset;
        $result['rec'] = $this->bank_model->numRec_page($vDescp);
        $result['query'] = $this->bank_model->listData_page($vDescp);
        /*
        echo "<pre>";
        var_dump($result);
        echo "</pre>";
        */
        $this->load->view('master/bank/bank_view_page', $result);
    }


    ///CRUD FUNCTION
    function addData(){
        $result['type'] = 'insert';
        $result['query']['name'] = '';
        $result['query']['kode'] = '';
		$result['query']['id'] = '';
        $this->load->view('master/bank/bank_form_page',$result);
    }

    function data_exec()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->rules);
        $data['success'] = 0;
		
        $_type = $_POST['type'];
        $_plu = $_POST['plu'];
        $_descp = $_POST['descp'];		
		$_unik = $_POST['unik'];
        
        if ($this->form_validation->run() == FALSE)
        {
            $data['success'] = 3;
            $data['error'] = validation_errors();
            echo json_encode($data);
        }
		else
		{
		
            if ($_type == 'insert') {
                $qry = $this->bank_model->cekPlu($_unik);
                if ($qry > 0)
                {
                    $data['success'] = 2;
                }
                else
                {                
    				$arrDatai = array('name' => $_plu, 'kode' => $_descp);
                    $result = $this->bank_model->addData($arrDatai);
                    if ($result) {
                        $data['success'] = 1;
                    }
                }
            }
            else
            {            
    			$arrDatau = array('kode' => $_descp);
    			$result = $this->bank_model->updtData($_unik, $arrDatau);
    			if ($result) {
                    $data['success'] = 1;
                }			
            }
            echo json_encode($data);
        }
    }


    function uptdata() {
        $_plu = $_POST['plu'];
        //$_plu = '26';
        $qry=$this->bank_model->selectData($_plu);
        if ($qry):
            $result['type'] = 'update';
            foreach ($qry as $row) :
                $result['query']['id'] = $row->id;
                $result['query']['name'] = $row->name;
                $result['query']['kode'] = $row->kode;                
            endforeach;			
            $result['pagesize'] = $this->pagesize;
			$this->load->view('master/bank/bank_form_page',$result);
        else:
            echo '{status:0}';
        endif;		
    }

    function hapusdata_exec(){
        $_plu = $_POST['plu'];
        $data = 0;
        $result['data']=$data;
        if ($data == 0):
            $result['success'] =  $this->bank_model->deleteData($_plu);
        else:
            $result['success'] =2;
        endif;
        echo json_encode($result);
    }

    ///END CRUD FUNCTION
}