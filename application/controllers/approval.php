<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Approval extends CI_Controller {
    private $pagesize = 10;
	
    private $rules = array(
		/*
        array(
            'field' => 'plu',
            'label' => 'Jenis Beban :',
            'rules' => 'required|is_natural_no_zero',
        ),
		array(
            'field' => 'name',
            'label' => 'Nama Beban :',
            'rules' => 'required|trim|xss_clean|min_length[3]|max_length[100]',
        )
		*/
    );	
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('approval_model');
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

        $this->approval_model->limit =  $this->pagesize;
        $this->approval_model->offset = $idoffset *  $this->pagesize;
        $result['offset'] = $this->approval_model->offset;
        $result['rec'] = $this->approval_model->numRec_page($vDescp);
        $result['query'] = $this->approval_model->listA_page($vDescp);        
        $this->load->view('master/approval/approval_view_page', $result);
    }    

    ///CRUD FUNCTION	
    
    function Data_exec()
    {
		if ($this->ion_auth->logged_in())
	    {
	        $id = $this->session->userdata('user_id');
	        $level = $this->ion_auth->get_users_groups($id)->row('id');
	        if ($level==NULL){
	            $data['level'] = '4';
	        } else {
	            $data['level'] = $level;
	        }
	        if(isset($_POST['chk'])=="")
			{
				echo'At least one checkbox Must be Selected !!!';				
			}
			else
			{
				$chk = $_POST['chk'];
				//print_r ($chk);
				$chkcount = count($chk);
				//echo $chkcount;			
				for($i=0; $i<$chkcount; $i++)
				{
					$_ctid = $chk[$i];
					//echo $id;
					$arrDatau = array('sts' => 'A');
					$result = $this->approval_model->updtData($_ctid, $arrDatau);			
				}
				if ($result) {
						$data['success'] = 1;
						redirect('approval','refresh');
				}
			}
	    }else{
	        redirect('Login','refresh');
	    }
		redirect('approval','refresh');
		//echo json_encode($data);
    }
    ///END CRUD FUNCTION
}