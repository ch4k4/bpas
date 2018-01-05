<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Subsector extends CI_Controller {
    private $pagesize = 10;
	
    private $rules = array(
        array(
            'field' => 'plu',
            'label' => 'Jenis Beban :',
            'rules' => 'required|is_natural_no_zero',
        ),
		array(
            'field' => 'name',
            'label' => 'Nama Beban :',
            'rules' => 'required|trim|xss_clean|min_length[3]|max_length[100]',
        ),
		array(
            'field' => 'desk',
            'label' => 'Deskripsi :',
            'rules' => 'required|trim|xss_clean|min_length[3]|max_length[255]',
        ),
        array(
            'field' => 'coa',
            'label' => 'Sub Sector :',
            'rules' => 'required|trim|xss_clean|min_length[9]|max_length[10]',
        )
    );	
	
	function __construct()
	{
		parent::__construct();                
				$this->load->model('sek_model');
				$this->load->model('subsec_model');
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

        $this->subsec_model->limit =  $this->pagesize;
        $this->subsec_model->offset = $idoffset *  $this->pagesize;
        $result['offset'] = $this->subsec_model->offset;
        $result['rec'] = $this->subsec_model->numRec_page($vDescp);
        $result['query'] = $this->subsec_model->listA_page($vDescp);        
        $this->load->view('master/beban/beban_view_page', $result);
    }
	
	function select_subsec(){
        $id = $this->input->post('sector_id');
        //$id = '2';        
		$result['option_subsec'] = $this->subsec_model->getListA($id);
        $this->load->view('master/subsector/beban',$result);
    }

    ///CRUD FUNCTION
    function addData(){
        $result['type'] = 'insert';
		$result['query']['id'] = '';
        $result['query']['name'] = '';        
        $result['option_sector'] = $this->sek_model->getList();
        $this->load->view('master/beban/beban_form_page',$result);
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
                $qry = $this->subsec_model->cekPlu($_name);
                if ($qry > 0) {
                    $data['success'] = 2;
                } else {                    
    			$arrDatai = array('sector_id' => $_name, 'name' => $_descp);
                    $result = $this->subsec_model->addData($arrDatai);
                    if ($result) {
                        $data['success'] = 1;
                    }
                }
            }
            else {
    			$arrDatau = array('name' => $_descp);
    			$result = $this->subsec_model->updtData($_ctid, $arrDatau);
    			if ($result) {
                    $data['success'] = 1;
                }			
            }
            echo json_encode($data);
        }
    }


    function uptData() {
        $_plu = $_POST['plu'];

        $qry=$this->subsec_model->selectData($_plu);
        if ($qry):
            $result['type'] = 'update';
            foreach ($qry as $row) :
				$result['query']['id'] = $row->id;
                $result['query']['name'] = $row->name;
				$result['query']['desk'] = $row->desk;
                $result['query']['coa'] = $row->coa;
                $result['query']['beban'] = $row->sector_id;                
            endforeach;
            $result['option_sector'] = $this->sek_model->getList();
            $result['pagesize'] = $this->pagesize;
			$this->load->view('master/beban/beban_form_page',$result);
        else:
            echo '{status:0}';
        endif;		
    }

    function hapusData_exec(){
        $_plu = $_POST['plu'];		
        $data = 0;
        $result['data']=$data;
        if ($data == 0):
            $result['success'] =  $this->subsec_model->deleteData($_plu);
        else:
            $result['success'] =2;
        endif;
        echo json_encode($result);
		
    }

    ///END CRUD FUNCTION
}