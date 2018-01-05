<?php

class Functions {

    function __construct() {
        $this->CI = & get_instance();
    }

    function debug_var($var) {
        echo "<pre>";
        $type = gettype ($var);        
		switch($type) {
			case 'boolean': 
			case 'integer': 
			case 'double': 
            case 'string':
			case 'NULL': echo $var; break;
			case 'object':
			case 'array': print_r($var); break;
			default: echo "unknown type"; break;
		}
		exit();
    }
   
    function delete_image($filename, $path) {
        $path = realpath(APPPATH . $path);        
        if ($filename) {
            if (file_exists($path . "/" . $filename))
                unlink($path . "/" . $filename);
            if (file_exists($path . "/thumb/" . $filename))
                unlink($path . "/thumb/" . $filename);
        }
    }

    function uploaded_image($name, $path, $width = 100, $height = 100) {       
        if (isset($_FILES[$name]['name']) && $_FILES[$name]['name'] != '') {

            $ext = substr(strrchr($_FILES[$name]["name"], '.'), 1);
            $newfilename = "sil_" . md5(date("YmdHis") . "_" . substr($_FILES[$name]["name"], 0, 3)) . "." . $ext;

            $config['upload_path'] = realpath(APPPATH . $path);
            $config['allowed_types'] = 'jpg|JPG|jpeg|JPEG|gif|png';
            $config['max_size'] = '8000';
            $config['encrypt_name'] = TRUE;
            $config['file_name'] = $newfilename;

            $this->CI->load->library('upload', $config);

            if (!$this->CI->upload->do_upload($name)) {
                return array('error' => $this->CI->upload->display_errors());
            } else {
                $image = $this->CI->upload->data();
                //resize image
                $config['image_library'] = 'gd2';
                $config['source_image'] = $image['full_path'];
                $config['create_thumb'] = FALSE;
                $config['new_image'] = realpath(APPPATH . $path);
                $config['maintain_ratio'] = TRUE;
                $config['width'] = $width;
                $config['height'] = $height;

                $this->CI->load->library('image_lib', $config);
                $this->CI->image_lib->resize();

                return array('upload_data' => $this->CI->upload->data());
            }
        }
    }

    function date_format($date, $format = "d M Y") {
		# a. ardiansyah
        $dtime = strtotime($date);
        $ddate = date($format, $dtime);

        return $ddate;
    }
	
	function price_format($string, $mk = "Rp. ", $nol = 2) {
        return $mk . " " . number_format($string, $nol, ",", ".");
    }
	
    function number_format($string) {
        return number_format($string, 0, ",", ".");
    }
    
    function build_message($type = 'info', $msg = '') {
        # a. ardiansyah
        return '
                <div class="alert alert-' . $type . ' fade in alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        ' . $msg . '				
                </div>
		';		
    }
	
	function time_elapsed_string($ptime) {
        if($ptime == '') return '-';
        
        return date('d-m-Y H:i:s', $ptime);
    } 
	
	function get_status() {
		$status = array('1' => 'Activated', '0' => 'Not Activated');
		return $status;
	}

    function get_month($id) {
        $month = array(
                1 => 'Januari',
                2 => 'Februari',
                3 => 'Maret',
                4 => 'April',
                5 => 'Mei',
                6 => 'Juni',
                7 => 'Juli',
                8 => 'Agustus',
                9 => 'September',
                10 => 'Oktober',
                11 => 'November',
                12 => 'Desember'
            );
        return $month[$id];
    }

    function get_label($type, $value) {
        return '<span class="label label-'.$type.'">'.$value.'</span>';        
    }

    function create_thumbs($image) {  

		$config['image_library'] = 'gd2';
        $config['source_image'] = $image['full_path'];
        $config['create_thumb'] = FALSE;
        $config['new_image'] = realpath(APPPATH . '../assets/img/avatar/thumbs');
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 300;
        $config['height'] = 300;

        $this->CI->load->library('image_lib', $config);

        $response = array();
        if($this->CI->image_lib->resize()){
        	$response = array('status' => TRUE, 'data' => $image['file_name']);
        }else{        	
        	$response = array('status' => FALSE, 'data' => $this->image_lib->display_errors());
        }

        return $response;
    }
	
	function download_file($dir, $filename, $mime) {
		// path direktori file yg akan didownload
		# $dir = '/dir/fileku/';	

		// membaca isi file untuk didownload
		header('Content-Description: File Transfer');
		header('Content-Type: "'.$mime.'"');
		header('Content-Disposition: attachment; filename='.basename($filename));
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($filename));
		ob_clean();
		flush();
		readfile($filename);
		exit;
	}

    function create_links($npage=0, $curpage=0, $range=2) {

        $pagination = '';

        $pagination .= '<ul class="pagination pagination-sm separated-square" style="margin: 0;">';        
        $pagination .= '<li class="'.($curpage == 0 ? 'disabled': '').'" onclick="return Document.prev_page()"><a href>&laquo;</li>'; # prev

        # pagination
        $show_page = 0;
        for($i=1; $i <= $npage; $i++) {
            if ((($i >= $curpage - 2) && ($i <= $curpage + 2)) || ($i == 1) || ($i == $npage)) {
                if (($show_page == 1) && ($i != 2))  $pagination .= '<li><a>...</a></li>';
                if (($show_page != ($npage - 1)) && ($i == $npage))  $pagination .= '<li><a>...</a></li>';
                $pagination .= '<li class="' . ($curpage == ($i - 1) ? 'active' : '') . '" onclick="return Document.set_page(' . ($i - 1) .')"><a href>' . $i . '</a></li>';
                $show_page = $i;
            }
        }

        $pagination .= '<li class="' . ($curpage == $npage - 1 ? 'disabled' : '') . '" onclick="return Document.next_page()"><a href>&raquo;</a></li>'; # next
        $pagination .= '</ul>';

        return $pagination;

    }

    function _jumlah_hari($bulan=0, $tahun='') {
        if($bulan < 1 or $bulan > 12) return 0;
        if(!is_numeric($tahun) or strlen($tahun) != 4) return date('Y');
        if($bulan == 2) {
            if(($tahun % 400 == 0) or ($tahun % 4 and $tahun % 100 != 0)) {
                return 29;
            }
        }
        $jumlah_hari = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        return $jumlah_hari[$bulan - 1];
    }


    # all function
    function check_periode($_data, $periode="triwulan") {  

        $data = $this->chunk_value($_data, $periode);

        $results = array(); 
        $master_data = array(
                'triwulan' => array(array(1,2,3), array(4,5,6), array(7,8,9), array(10,11,12)),
                'semester' => array(array(1,2,3,4,5,6), array(7,8,9,10,11,12))
            );

        $loop = ($periode == 'triwulan') ? 4 : 2;   
        
        foreach ($data as $k => $v) {     
            $tmp = array();  
            $bulan = array();
            for ($i=0; $i < $loop; $i++) { 
                if($i > $k) { $tmp[$i+1] = "Belum Ada"; }
                else{    

                    $temp = array();
                    for ($j=0; $j < count($master_data[$periode][$i]); $j++) {  
                        // echo $master_data[$periode][$i][$j].' '.implode(';', $v);
                        if(is_array($v) && in_array($master_data[$periode][$i][$j], $v)) { $temp[$j] = 1; }
                        else { 
                            array_push($bulan, $master_data[$periode][$i][$j]);
                            $temp[$j] = 0;
                        }
                    }
                    
                    if($this->all($temp)) $tmp[$i+1] = "Lengkap";
                    else $tmp[$i+1] = "Tidak Lengkap";
                }
            }
        }

        $results[$periode] = $tmp;
        return $results;
    }

    function all($array) {
        for ($i=0; $i < count($array); $i++) { 
            if($array[$i] == 0) return 0;
        }
        return 1;
    }

    function chunk_value($data, $periode) {
        $temp = array();
        if($periode == "triwulan") {
            foreach($data as $k => $v) {        
                if($v <= 3) { $temp[0][] = $v; }
                if($v <= 6 and count(array_intersect($data, array(4,5,6))) > 0) { $temp[1][] = $v; }
                if($v <= 9 and count(array_intersect($data, array(7,8,9))) > 0) { $temp[2][] = $v; }
                if($v <= 12 and count(array_intersect($data, array(10,11,12))) > 0) { $temp[3][] = $v; }    
            }
        }else if($periode == "semester"){
            foreach($data as $k => $v) {        
                if($v <= 6) { $temp[0][] = $v; }            
                if($v <= 12 and count(array_intersect($data, array(7,8,9,10,11,12))) > 0) { $temp[1][] = $v; }  
            }
        }
        return $temp;
    }

    function get_periode($bulan) {
        if(in_array($bulan, array(1, 2, 3))) {
            return "triwulan 1 (satu)";
        }else if(in_array($bulan, array(4, 5, 6))) {
            return "triwulan 2 (dua)";
        }else if(in_array($bulan, array(7, 8, 9))) {
            return "triwulan 3 (tiga)";
        }else if(in_array($bulan, array(10, 11, 12))) {
            return "triwulan 4 (empat)";
        }
        return "";        
    }

    function parsing_koordinat($data) {

        $koordinat = array();
        $counter = count($data['s_deg']);
        
        # get parameter
        $s_deg = $data['s_deg'];
        $s_squo = $data['s_squo'];
        $s_quo = $data['s_quo'];

        $e_deg = $data['e_deg'];
        $e_squo = $data['e_squo'];
        $e_quo = $data['e_quo'];

        for ($i=0; $i < $counter; $i++) { 
            if($s_deg[$i] != "") {
                $koordinat[] = $s_deg[$i].':'.$s_squo[$i].':'.$s_quo[$i].'/'.$e_deg[$i].':'.$e_squo[$i].':'.$e_quo[$i];
            }
        }

        return serialize($koordinat);
    }
	
	function parsing_jenis_limbah_awal($data) {

        $jenis_limbah_awal = array();
        $counter = count($data['jenis_limbah']);
        
        # get parameter
        $jenis_limbah = $data['jenis_limbah'];
        $jml_ton = $data['jml_ton'];
    
        for ($i=0; $i < $counter; $i++) { 
            if($jenis_limbah[$i] != "") {
                $jenis_limbah_awal[] = $jenis_limbah[$i].':'.$jml_ton[$i];
            }
        }

        return serialize($jenis_limbah_awal);
    }
	
	function parsing_jenis_limbah_tps($data) {

        $jenis_limbah_tps = array();
        $counter = count($data['jenis_limbah']);
        
        # get parameter
        $jenis_limbah = $data['jenis_limbah'];
    
        for ($i=0; $i < $counter; $i++) { 
            if($jenis_limbah[$i] != "") {
                $jenis_limbah_tps[] = $jenis_limbah[$i];
            }
        }

        return serialize($jenis_limbah_tps);
    }

}
