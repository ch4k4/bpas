<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Biaya extends CI_Controller {
    private $pagesize = 10;
	
    private $rules = array(
        array(
            'field' => 'sek',
            'label' => 'biaya :',
            'rules' => 'required|trim|xss_clean|min_length[2]|max_length[100]',
            //'rules' => 'required|trim|xss_clean|min_length[2]|max_length[100]|is_natural',
        )        
    );
		
	function __construct()
	{
		parent::__construct();                
				$this->load->model('sek_model');
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

        $this->sek_model->limit =  $this->pagesize;
        $this->sek_model->offset = $idoffset *  $this->pagesize;
        $result['offset'] = $this->sek_model->offset;
        $result['rec'] = $this->sek_model->numRec_page($vDescp);
        $result['query'] = $this->sek_model->listA_page($vDescp);
        $this->load->view('master/biaya/sek_view_page', $result);
    }

    function select_biaya(){
        $id = $this->input->post('biaya_id');
        //$id = '2';
        $result['option_biaya'] = $this->sek_model->getList($id);
        $this->load->view('master/biaya/sector', $result);
    }

    ///CRUD FUNCTION
    function addData(){
        $result['type'] = 'insert';
		$result['query']['id'] = '';
        $result['query']['name'] = '';
        $this->load->view('master/biaya/sek_form_page',$result);
    }

    function data_exec()
    {
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->rules);
        
        $data['success'] = 0;
		
        $_type = $_POST['type'];
		$_ctid = $_POST['ctid'];
        $_name = $_POST['sek'];
        
        if ($this->form_validation->run() == FALSE)
        {
            $data['success'] = 3;
            $data['error'] = validation_errors();
            echo json_encode($data);
        }
		else
		{
		
            if ($_type == 'insert') {
                $qry = $this->sek_model->cekPlu($_name);
                if ($qry > 0) {
                    $data['success'] = 2;
                }
                else
                {
    				$arrDatai = array('name' => $_name);
                    $result = $this->sek_model->addItem($arrDatai);
                    if ($result) {
                        $data['success'] = 1;
                    }
                }
            }
            else
            {
    			$arrDatau = array('name' => $_name);
    			$result = $this->sek_model->updtItem($_ctid, $arrDatau);
    			if ($result) {
                    $data['success'] = 1;
                }			
            }
            echo json_encode($data);
        }
    }


    function uptdata() {
        $_plu = $_POST['plu'];
				
        $qry=$this->sek_model->selectA($_plu);
        if ($qry):
            $result['type'] = 'update';
            foreach ($qry as $row) :
				$result['query']['id'] = $row->id;
                $result['query']['name'] = $row->name;
            endforeach;			
            $result['pagesize'] = $this->pagesize;
			$this->load->view('master/biaya/sek_form_page',$result);
        else:
            echo '{status:0}';
        endif;		
    }

    function hapusdata_exec(){
        $_plu = $_POST['plu'];		
        $data = 0;
        $result['data']=$data;
        if ($data == 0):
            $result['success'] =  $this->sek_model->deleteItem($_plu);
        else:
            $result['success'] =2;
        endif;
        echo json_encode($result);
		
    }

    ///END CRUD FUNCTION
}