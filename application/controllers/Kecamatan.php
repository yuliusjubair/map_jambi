<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kecamatan extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language'));
		$this->load->model('master_model','ion_auth_model', 'kecamatan_model');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->lang->load('auth');
	}
	
	function index() {
		$data=array(
            'content'=>'kecamatan/list_kecamatan',
            // 'row' => $get_data,
        );
        $this->load->view('template',$data);
	}

    public function ajax_list() {
	    $this->load->helper('url');
	    $this->load->model('kecamatan_model');
	    $list = $this->kecamatan_model->get_datatables();
	    
	    $data = array();
	    $no = $_POST['start'];
	    $i=1;
	    foreach ($list as $user) {
	        $no++;
	        $row = array();
	        $row[] = $no;
	        $row[] = $user->nama;
	        $row[] = '<center>
	        <a class="btn btn-md btn-primary" href="javascript:void(0)" title="Edit"
                        onclick="edit('."'".$user->id."'".')">
                        <i class="ace-icon fa fa-pencil bigger-120"></i>Edit</a>
	        <!--a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete"
                        onclick="hapus('."'".$user->id."'".','."'".$user->nama."'".' )">
                        <i class="ace-icon fa fa-refresh bigger-120"></i>Hapus</a-->
                        </center>';
	        
	        $data[] = $row;
	        $i++;
	    }
	    
	    $output = array(
	        "draw" => $_POST['draw'],
	        "recordsTotal" => $i,
	        "recordsFiltered" => $this->kecamatan_model->count_filtered(),
	        "data" => $data,
	    );
	    echo json_encode($output);
	}

	public function ajax_kecamatan_add() {
		$this->load->model('kecamatan_model');
	    date_default_timezone_set('Asia/Jakarta');
	    $group = $this->input->post('modal_groups');
	    $this->_validate($group, 'insert');

	    // $user_id = $this->ion_auth->user()->row()->id;
	    $user_id = "admin";
	    $nama = $this->input->post('nama');
	    $data = array(
	    	"nama" => $nama
	    );
	    $save = $this->kecamatan_model->save($data);
	    
	    if($save > 0){
	        // $save_groups = $this->kecamatan_model->insert_users_groups($save, $group);
	        echo json_encode(array("status" => 200, "message" => 'Berhasil Tambah Data Kecamatan'));
	    }else{
	        echo json_encode(array("status" => 500, "message" => 'Gagal Tambah Data Kecamatan'));
	    }
	}
	
	private function _validate($role, $iu) {
		$this->load->model('kecamatan_model');
	    $data = array();
	    $data['error_string'] = array();
	    $data['inputerror'] = array();
	    $data['status'] = TRUE;

	    if($this->input->post('nama') == '') {
	        $data['inputerror'][] = 'nama';
	        $data['error_string'][] = 'Nama Kecamatan is required';
	        $data['status'] = FALSE;
	    }
	    else{
	        $data['inputerror'][] = 'nama';
	        $data['error_string'][] = '';
	    }
	
	    if($data['status'] == FALSE) {
	        echo json_encode($data);
	        exit();
	    }else{
	        $data['error_string'] = array();
	        $data['inputerror'] = array();
	        $data['status'] = TRUE;
	    }
	}

	public function ajax_edit($id) {
		$this->load->model('kecamatan_model');
		$data = $this->kecamatan_model->get_byid($id);
	    
	    $output = array(
	    	'data'=>$data,
	    );

	    echo json_encode($output);
	}

	public function ajax_kecamatan_update() {
	    date_default_timezone_set('Asia/Jakarta');
	    // $this->_validate();
	    $data = array();
		$id = $this->input->post('modal_id');
		$nama = $this->input->post('nama');
		
	    	$data = array(
				"nama"=>$nama
			);
		
		//print_r($data);die;
		$this->db->where('id',$id);
		$this->db->update('master_kecamatan',$data);
		$data = array('status'=>200,'message'=>'success');
		echo json_encode($data);
	}

	public function ajax_manageusers_delete($id) {
		$this->load->model('kecamatan_model');
        $delete1 =  $this->kecamatan_model->deleteuser_byid($id);
        
        if($delete1){
            echo json_encode(array("status" => 200, "message" => 'Berhasil Delete User'));
        }else{
            echo json_encode(array("status" => NULL, "message" => 'Gagal Delete User'));
        }
    }
}