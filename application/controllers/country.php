<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Country extends CI_Controller {
    private $pagesize = 10;
	
    private $rules = array(
        array(
            'field' => 'plu',
            'label' => 'Country ID :',
            'rules' => 'required|trim|xss_clean|min_length[1]|max_length[2]',
        ),
        array(
            'field' => 'descp',
            'label' => 'Description :',
            'rules' => 'required|trim|xss_clean|min_length[3]|max_length[100]',
        )
    );	
	
	function __construct()
	{
		parent::__construct();                
				$this->load->model('country_model');                
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

        $this->country_model->limit =  $this->pagesize;
        $this->country_model->offset = $idoffset *  $this->pagesize;
        $result['offset'] = $this->country_model->offset;
        $result['rec'] = $this->country_model->numRec_page($vDescp);
        $result['query'] = $this->country_model->listA_page($vDescp);
        $this->load->view('master/country/country_view_page', $result);
    }    

    ///CRUD FUNCTION
    function addData(){
        $result['type'] = 'insert';
		$result['query']['id'] = '';
        $result['query']['name'] = '';
        $result['query']['descp'] = '';
        $this->load->view('master/country/country_form_page',$result);
    }

    function Data_exec()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->rules);
        $data['success'] = 0;
		
        $_type = $_POST['type'];
		$_ctid = $_POST['ctid'];
        $_name = $_POST['plu'];
        $_descp = $_POST['descp'];		
		
        if ($this->form_validation->run() == FALSE)
        {
            $data['success'] = 3;
            $data['error'] = validation_errors();
            echo json_encode($data);
        }
		else
		{		
            if ($_type == 'insert') {
                $qry = $this->country_model->cekPlu($_name);
                if ($qry > 0) {
                    $data['success'] = 2;
                } else {                    
    				$arrDatai = array('name' => $_name, 'desc' => $_descp);
                    $result = $this->country_model->addData($arrDatai);
                    if ($result) {
                        $data['success'] = 1;
                    }
                }
            }
            else {
    			$arrDatau = array('name' => $_name,'desc' => $_descp);
    			$result = $this->country_model->updtData($_ctid, $arrDatau);
    			if ($result) {
                    $data['success'] = 1;
                }			
            }
            echo json_encode($data);
        }
    }


    function uptData() {
        $_plu = $_POST['plu'];
				
        $qry=$this->country_model->selectData($_plu);
        if ($qry):
            $result['type'] = 'update';
            foreach ($qry as $row) :
				$result['query']['id'] = $row->id;
                $result['query']['name'] = $row->name;
                $result['query']['desc'] = $row->desc;                
            endforeach;			
            $result['pagesize'] = $this->pagesize;
			$this->load->view('master/country/country_form_page',$result);
        else:
            echo '{status:0}';
        endif;		
    }

    function hapusData_exec(){
        $_plu = $_POST['plu'];		
        $data = 0;
        $result['data']=$data;
        if ($data == 0):
            $result['success'] =  $this->country_model->deleteData($_plu);
        else:
            $result['success'] =2;
        endif;
        echo json_encode($result);
		
    }

    ///END CRUD FUNCTION
}

/* End of file barang_ctl */