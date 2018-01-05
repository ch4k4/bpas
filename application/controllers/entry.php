<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Entry extends CI_Controller {
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
        )/*,
		array(
            'field' => 'desk',
            'label' => 'Deskripsi :',
            'rules' => 'required|trim|xss_clean|min_length[3]|max_length[255]',
        ),
        array(
            'field' => 'coa',
            'label' => 'COA :',
            'rules' => 'required|trim|xss_clean|min_length[9]|max_length[10]',
        )*/
    );	
	
	function __construct()
	{
		parent::__construct();                
				$this->load->model('sek_model');
				$this->load->model('subsec_model');
				$this->load->model('entry_model');
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

        $this->entry_model->limit =  $this->pagesize;
        $this->entry_model->offset = $idoffset *  $this->pagesize;
        $result['offset'] = $this->entry_model->offset;
        $result['rec'] = $this->entry_model->numRec_page($vDescp);
        $result['query'] = $this->entry_model->listA_page($vDescp);        
        $this->load->view('master/entry/entry_view_page', $result);
    }    

    ///CRUD FUNCTION
    function addData(){
        $result['type'] = 'insert';
		$result['query']['id'] = '';
        $result['query']['name'] = '';
		$result['query']['harga'] = '';
        $result['option_sector'] = $this->sek_model->getList();
        $this->load->view('master/entry/entry_form_page',$result);
    }

    function Data_exec()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->rules);
        $data['success'] = 0;
		$path = 'assets/bons/';
		
        $_type = $_POST['type'];
		$_ctid = $_POST['ctid'];
		$_checkin = $_POST['checkin'];		
		$_checkin = date('Y-m-d', strtotime($_checkin));
		$_name = $_POST['name'];
		$_harga = $_POST['harga'];
		$_harga = (int)str_replace(',', '', $_harga);
        $_sector_id = $_POST['plu'];
		$_subsec_id = $_POST['sub'];
		$_status = $_POST['status'];
		//$_bon = $_POST['bon'];
        if ($this->form_validation->run() == FALSE)
        {
            $data['success'] = 3;
            $data['error'] = validation_errors();
            echo json_encode($data);
        }
		else
		{		
            if ($_type == 'insert') {
                //$qry = $this->entry_model->cekPlu($_name);	//==> cek data double
				$qry = $this->entry_model->cekPlu($_ctid);
                if ($qry > 0) {
                    $data['success'] = 2;
                } else {                    
    			$arrDatai = array('dt_input' => $_checkin, 'name' => $_name, 'sector_id' => $_sector_id, 'subsec_id' => $_subsec_id, 'harga' => $_harga, 'sts' => $_status);
                    $result = $this->entry_model->addData($arrDatai);
                    if ($result) {
                        $data['success'] = 1;
                    }
                }
            }
            else {
    			$arrDatau = array('dt_input' => $_checkin, 'name' => $_name, 'harga' => $_harga, 'sts' => $_status);
    			$result = $this->entry_model->updtData($_ctid, $arrDatau);
    			if ($result) {
                    $data['success'] = 1;
                }			
            }
            echo json_encode($data);			
        }
    }

    function uptData() {
        $_plu = $_POST['plu'];

        $qry=$this->entry_model->selectData($_plu);
        if ($qry):
            $result['type'] = 'update';
            foreach ($qry as $row) :
				$result['query']['id'] = $row->id;
				$result['query']['dt_input'] = $row->dt_input;
                $result['query']['name'] = $row->name;				
                $result['query']['sector_id'] = $row->sector_id;
				$result['query']['subsec_id'] = $row->subsec_id;
				$result['query']['harga'] = $row->harga;
				$result['query']['stat'] = $row->sts;
            endforeach;
            $result['option_sector'] = $this->sek_model->getList();
			$result['option_subsec'] = $this->subsec_model->getList();
            $result['pagesize'] = $this->pagesize;
			$this->load->view('master/entry/entry_form_page',$result);
        else:
            echo '{status:0}';
        endif;		
    }

    function hapusData_exec(){
        $_plu = $_POST['plu'];		
        $data = 0;
        $result['data']=$data;
        if ($data == 0):
            $result['success'] =  $this->entry_model->deleteData($_plu);
        else:
            $result['success'] =2;
        endif;
        echo json_encode($result);
		
    }

    ///END CRUD FUNCTION
}