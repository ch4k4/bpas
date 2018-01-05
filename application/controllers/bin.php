<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bin extends CI_Controller {
    private $pagesize = 10;
	/*
    private $rules = array(
        array(
            'field' => 'plu',
            'label' => 'PLU',
            'rules' => 'required|trim|xss_clean|min_length[5]|max_length[5]|is_natural',
        ),
        array(
            'field' => 'descp',
            'label' => 'Nama Barang',
            'rules' => 'required|trim|xss_clean|min_length[3]',
        ),
        array(
            'field' => 'satuan',
            'label' => 'Satuan',
            'rules' => 'trim|xss_clean',
        ),
        array(
            'field' => 'harga',
            'label' => 'Harga',
            'rules' => 'trim|xss_clean|min_length[1]|is_natural',
        )
    );
	*/
	
	function __construct()
	{
		parent::__construct();
				$this->load->model('bin_model');
				$this->load->model('bank_model');
				$this->load->model('country_model');
				$this->load->model('city_model');
				$this->load->model('modelan_model');
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

        $this->bin_model->limit =  $this->pagesize;
        $this->bin_model->offset = $idoffset *  $this->pagesize;
        $result['offset'] = $this->bin_model->offset;
        $result['rec'] = $this->bin_model->numRec_page($vDescp);
        $result['query'] = $this->bin_model->listA_page($vDescp);
        $this->load->view('master/bin/bin_view_page', $result);
    }

    ///CRUD FUNCTION
    function addData(){
        $result['type'] = 'insert';
		$result['query']['id'] = '';
        $result['query']['name'] = '';
        $result['query']['simbol'] = '';
		$result['query']['kode'] = '';
		$result['query']['id'] = '';
        $result['query']['name'] = '';
        $result['query']['simbol'] = '';
		$result['query']['kode'] = '';
		$result['query']['country_id'] = '';
		$result['query']['city_id'] = '';
		$result['query']['zip'] = '';
		$result['query']['telp'] = '';
		$result['query']['fax'] = '';
		$result['query']['cp1'] = '';
		$result['query']['title'] = '';
		$result['query']['cp2'] = '';
		$result['query']['title2'] = '';
		$result['query']['remarks'] = '';
		$result['option_bank'] = $this->bank_model->getBankList();
		$result['option_country'] = $this->country_model->getList();
		$result['option_salut'] = $this->modelan_model->getListSalut();
        $this->load->view('master/bin/bin_form_page',$result);
    }

    function Data_exec()
    {
        //$this->load->library('form_validation');
        //$this->form_validation->set_rules($this->rules);
        $data['success'] = 0;
		$_type = $_POST['type'];
		$_ctid = $_POST['ctid'];
        $_gkode = $_POST['bank_group_kode'];
        $_gid = $_POST['bank_group_id'];
        $_name = $_POST['bank_name'];
        $_kode = $_POST['bank_kode'];
        $_address = $_POST['address'];
        $_country_id = $_POST['country_id'];
        $_city_id = $_POST['city_id'];
        $_zcode = $_POST['zcode'];
        $_cp = $_POST['cp1'];
        $_titl = $_POST['salut_id'];
        $_cp2 = $_POST['cp2'];
        $_titl2 = $_POST['salut_id2'];
        $_telp = $_POST['telp'];
        $_fax = $_POST['fax'];
        $_remarks = $_POST['remarks'];
        /*
        if ($this->form_validation->run() == FALSE)
        {
            $data['success'] = 3;
            $data['error'] = validation_errors();
            echo json_encode($data);
        }
		else{
		*/
        if ($_type == 'insert') {
            $qry = $this->bin_model->cekPlu($_name);
            if ($qry > 0) {
                $data['success'] = 2;
            } else {                
				$arrDatai = array(
				    'bank_group_kode' => $_gid, 'name' => $_name, 'kode' => $_kode,
				    'address' => $_address, 'country_id' => $_country_id, 'city_id' => $_city_id,
				    'zip' => $_zcode, 'cp1' => $_cp, 'titl' => $_titl, 'cp2' => $_cp2, 'titl2' => $_titl2,
				    'telp' => $_telp, 'fax' => $_fax, 'remarks' => $_remarks
				);
					
                $result = $this->bin_model->addData($arrDatai);
                if ($result) {
                    $data['success'] = 1;
                }
            }
        }
        else {
			$arrDatau = array(
			                 'name' => $_name, 'kode' => $_kode, 'address' => $_address,
			     'country_id' => $_country_id, 'city_id' => $_city_id, 'zip' => $_zcode,
			         'cp1' => $_cp, 'titl' => $_titl, 'cp2' => $_cp2, 'titl2' => $_titl2,
				                'telp' => $_telp, 'fax' => $_fax, 'remarks' => $_remarks			    
			);
			$result = $this->bin_model->updtData($_ctid, $arrDatau);
			if ($result) {
                $data['success'] = 1;
            }			
        }
        echo json_encode($data);
        //}
    }


    function uptdata() {
        $_plu = $_POST['plu'];
        //$_plu = '1';
        $qry=$this->bin_model->selectData($_plu);
        if ($qry):
            $result['type'] = 'update';
            foreach ($qry as $row) :
				$result['query']['id'] = $row->id;
                $result['query']['kode'] = $row->kode;
                $result['query']['name'] = $row->name;
				$result['query']['address'] = $row->address;
				$result['query']['country_id'] = $row->country_id;
                $result['query']['city_id'] = $row->city_id;
                $result['query']['zip'] = $row->zip;
				$result['query']['telp'] = $row->telp;
				$result['query']['fax'] = $row->fax;
                $result['query']['cp1'] = $row->cp1;
                $result['query']['title'] = $row->titl;
				$result['query']['cp2'] = $row->cp2;
				$result['query']['title2'] = $row->titl2;
                $result['query']['remarks'] = $row->remarks;
                $result['query']['bank_group_kode'] = $row->bank_group_kode;				                
            endforeach;
			$result['option_bank'] = $this->bank_model->getBankList();
			$result['option_country'] = $this->country_model->getList();
			$result['option_city'] = $this->city_model->getList($row->country_id);
			$result['option_salut'] = $this->modelan_model->getListSalut();
            $result['pagesize'] = $this->pagesize;
			$this->load->view('master/bin/bin_form_page',$result);
        else:
            echo '{status:0}';
        endif;		
    }

    function hapusdata_exec(){
        $_plu = $_POST['plu'];		
        $data = 0;
        $result['data']=$data;
        if ($data == 0):
            $result['success'] =  $this->bin_model->deleteData($_plu);
        else:
            $result['success'] =2;
        endif;
        echo json_encode($result);
		
    }

    ///END CRUD FUNCTION
}