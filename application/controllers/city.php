<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class City extends CI_Controller {
    private $pagesize = 10;
	
    private $rules = array(
        array(
            'field' => 'plu',
            'label' => 'Country :',
            'rules' => 'required|is_natural_no_zero',
        ),
        array(
            'field' => 'descp',
            'label' => 'City : :',
            'rules' => 'required|trim|xss_clean|min_length[3]|max_length[100]',
        )
    );	
	
	function __construct()
	{
		parent::__construct();                
				$this->load->model('country_model');
				$this->load->model('city_model');
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

        $this->city_model->limit =  $this->pagesize;
        $this->city_model->offset = $idoffset *  $this->pagesize;
        $result['offset'] = $this->city_model->offset;
        $result['rec'] = $this->city_model->numRec_page($vDescp);
        $result['query'] = $this->city_model->listA_page($vDescp);
        
        $this->load->view('master/city/city_view_page', $result);
    }
    
    function select_city(){
        $id = $this->input->post('country_id');
        //$id = '2';
        $result['option_city'] = $this->city_model->getList($id);
        $this->load->view('master/city/city',$result);
    }

    ///CRUD FUNCTION
    function addData(){
        $result['type'] = 'insert';
		$result['query']['id'] = '';
        $result['query']['name'] = '';
        $result['query']['descp'] = '';
        $result['option_country'] = $this->country_model->getList();
        $this->load->view('master/city/city_form_page',$result);
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
                $qry = $this->city_model->cekPlu($_name);
                if ($qry > 0) {
                    $data['success'] = 2;
                } else {                    
    				$arrDatai = array('country_id' => $_name, 'propinsi' => $_descp);
                    $result = $this->city_model->addData($arrDatai);
                    if ($result) {
                        $data['success'] = 1;
                    }
                }
            }
            else {
    			$arrDatau = array('country_id' => $_name,'propinsi' => $_descp);
    			$result = $this->city_model->updtData($_ctid, $arrDatau);
    			if ($result) {
                    $data['success'] = 1;
                }			
            }
            echo json_encode($data);
        }
    }


    function uptData() {
        $_plu = $_POST['plu'];
				
        $qry=$this->city_model->selectData($_plu);
        if ($qry):
            $result['type'] = 'update';
            foreach ($qry as $row) :
				$result['query']['id'] = $row->id;
                $result['query']['name'] = $row->propinsi;
                $result['query']['desc'] = $row->country_id;                
            endforeach;
            $result['option_country'] = $this->country_model->getList();
            //$result['option_city'] = $this->city_model->getList($row->country_id);
            $result['pagesize'] = $this->pagesize;
			$this->load->view('master/city/city_form_page',$result);
        else:
            echo '{status:0}';
        endif;		
    }

    function hapusData_exec(){
        $_plu = $_POST['plu'];		
        $data = 0;
        $result['data']=$data;
        if ($data == 0):
            $result['success'] =  $this->city_model->deleteData($_plu);
        else:
            $result['success'] =2;
        endif;
        echo json_encode($result);
		
    }

    ///END CRUD FUNCTION
}