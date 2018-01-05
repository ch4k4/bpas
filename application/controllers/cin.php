<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cin extends CI_Controller {
    private $pagesize = 10;
	
    private $rules = array(
        array(
            'field' => 'plu',
            'label' => 'Counterpart Type :',
            'rules' => 'required|trim|xss_clean|min_length[2]|max_length[255]',
        ),
        array(
            'field' => 'descp',
            'label' => 'Description :',
            'rules' => 'required|trim|xss_clean|min_length[2]|max_length[255]',
        )
    );
	
	
	function __construct()
	{
		parent::__construct();
                
				$this->load->model('cin_model');
				$this->load->model('country_model');
				$this->load->model('city_model');
				$this->load->model('modelan_model');
				$this->load->model('ct_model');
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

        $this->cin_model->limit =  $this->pagesize;
        $this->cin_model->offset = $idoffset *  $this->pagesize;
        $result['offset'] = $this->cin_model->offset;
        $result['rec'] = $this->cin_model->numRec_page($vDescp);
        $result['query'] = $this->cin_model->listCt_page($vDescp);
        //var_dump($result);
        $this->load->view('master/cin/cin_view_page', $result);
        
    }


    ///CRUD FUNCTION
    function addData(){
        $result['type'] = 'insert';
		$result['query']['id'] = '';
        $result['query']['name'] = '';
        $result['query']['descp'] = '';
        $result['option_country'] = $this->country_model->getList();
        $result['option_salut'] = $this->modelan_model->getListSalut();
        $result['option_type'] = $this->ct_model->getList();
        $this->load->view('master/cin/cin_form_page',$result);
    }

    function data_exec()
    {
        /*
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->rules);
        $data['success'] = 0;
		*/
        $_type = $_POST['type'];
		$_ctid = $_POST['ctid'];
        $_name = $_POST['plu'];
        $_descp = $_POST['descp'];
		/*
        if ($this->form_validation->run() == FALSE)
        {
            $data['success'] = 3;
            $data['error'] = validation_errors();
            echo json_encode($data);
        }
		else
		{*/
            if ($_type == 'insert') {
                $qry = $this->cin_model->cekPlu($_name);
                if ($qry > 0) {
                    $data['success'] = 2;
                } else {
    				$arrDatai = array('name' => $_name, 'desc' => $_descp);
                    $result = $this->cin_model->addData($arrDatai);
                    if ($result) {
                        $data['success'] = 1;
                    }
                }
            }
            else
            {
    			$arrDatau = array('name' => $_name,'desc' => $_descp);
    			$result = $this->cin_model->updtData($_ctid, $arrDatau);
    			if ($result) {
                    $data['success'] = 1;
                }			
            }
            echo json_encode($data);
        //}
    }


    function uptdata() {
        $_plu = $_POST['plu'];
				
        $qry=$this->cin_model->selectCt($_plu);
        if ($qry):
            $result['type'] = 'update';
            foreach ($qry as $row) :
				$result['query']['id'] = $row->id;
                $result['query']['name'] = $row->name;
                $result['query']['desc'] = $row->desc;                
            endforeach;			
            $result['pagesize'] = $this->pagesize;
			$this->load->view('master/counterpart/cin_form_page',$result);
        else:
            echo '{status:0}';
        endif;		
    }

    function hapusdata_exec(){
        $_plu = $_POST['plu'];		
        $data = 0;
        $result['data']=$data;
        if ($data == 0):
            $result['success'] =  $this->cin_model->deleteData($_plu);
        else:
            $result['success'] =2;
        endif;
        echo json_encode($result);
		
    }

    ///END CRUD FUNCTION
}