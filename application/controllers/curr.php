<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Curr extends CI_Controller {
    private $pagesize = 10;
	
    private $rules = array(
        array(
            'field' => 'cnama',
            'label' => 'Country Name :',
            'rules' => 'required|trim|xss_clean|min_length[3]|max_length[100]',
        ),
        array(
            'field' => 'kode',
            'label' => 'Code :',
            'rules' => 'required|trim|xss_clean|max_length[4]',
        ),
        array(
            'field' => 'sym',
            'label' => 'Symbol :',
             'rules' => 'required|trim|xss_clean|max_length[3]',
        )
    );
	
	
	function __construct()
	{
		parent::__construct();
                
				$this->load->model('curr_model');
	}

	function index() {		
		$data['main_view'] = 'welcome_message';
		$this->load->view('template', $data);
    }

    function search_data() {
        if (isset($_POST['descp_msg']) && $_POST['descp_msg'] != NULL) {
            $vDescp = $_POST['descp_msg'];
        }
        else
            $vDescp = '';
		
        if (isset($_POST['pageNumber']) && $_POST['pageNumber'] != NULL) {
            $idoffset = $_POST['pageNumber'] - 1;
        }
        else
            $idoffset=0;

        $this->curr_model->limit =  $this->pagesize;
        $this->curr_model->offset = $idoffset *  $this->pagesize;
        $result['offset'] = $this->curr_model->offset;
        $result['rec'] = $this->curr_model->numRec_page($vDescp);
        $result['query'] = $this->curr_model->listA_page($vDescp);
		//print_r($result);
        $this->load->view('master/curr/curr_view_page', $result);
    }


    ///CRUD FUNCTION
    function addData(){
        $result['type'] = 'insert';
		$result['query']['id'] = '';
        $result['query']['name'] = '';
        $result['query']['simbol'] = '';
		$result['query']['kode'] = '';
        $this->load->view('master/curr/curr_form_page',$result);
    }

    function Data_exec()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->rules);
        $data['success'] = 0;
		
        $_type = $_POST['type'];
		$_ctid = $_POST['unik'];
        $_name = $_POST['cnama'];
        $_simbol = $_POST['sym'];
		$_kode = $_POST['kode'];		
		        
        if ($this->form_validation->run() == FALSE)
        {
            $data['success'] = 3;
            $data['error'] = validation_errors();
            echo json_encode($data);
        }
		else{
		
            if ($_type == 'insert') {
                $qry = $this->curr_model->cekPlu($_ctid);
                if ($qry > 0) {
                    $data['success'] = 2;
                } else {
    				$arrBarangi = array('name' => $_name, 'simbol' => $_simbol, 'kode' => $_kode);
                    $result = $this->curr_model->addData($arrBarangi);
                    if ($result) {
                        $data['success'] = 1;
                    }
                }
            } else {
    			$arrBarangu = array('name' => $_name, 'simbol' => $_simbol, 'kode' => $_kode);
    			$result = $this->curr_model->updtData($_ctid, $arrBarangu);
    			if ($result) {
                    $data['success'] = 1;
                }			
            }
            echo json_encode($data);
        }
    }


    function uptData() {
        $_plu = $_POST['plu'];
        //$_plu = '1';
        $qry=$this->curr_model->selectData($_plu);
        if ($qry):
            $result['type'] = 'update';
            foreach ($qry as $row) :
				$result['query']['id'] = $row->id;
                $result['query']['name'] = $row->name;
                $result['query']['simbol'] = $row->simbol;
				$result['query']['kode'] = $row->kode;                
            endforeach;			
            $result['pagesize'] = $this->pagesize;
			$this->load->view('master/curr/curr_form_page',$result);
        else:
            echo '{status:0}';
        endif;		
    }

    function hapusData_exec(){
        $_plu = $_POST['plu'];		
        $data = 0;
        $result['data']=$data;
        if ($data == 0):
            $result['success'] =  $this->curr_model->deleteData($_plu);
        else:
            $result['success'] =2;
        endif;
        echo json_encode($result);
		
    }

    ///END CRUD FUNCTION
}