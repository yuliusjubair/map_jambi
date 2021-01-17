<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language'));
		$this->load->model('master_model','ion_auth_model', 'admin_model');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->lang->load('auth');
	}
	
	function index() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		} elseif (!$this->ion_auth->is_admin()) {
            return show_error('You must be an administrator to view this page.');
		} else {
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['users'] = $this->ion_auth->users()->result();
			foreach ($this->data['users'] as $k => $user) {
				$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}
			$this->_render_page('auth/index', $this->data);
		}
	}

	function users(){
        // $get_data = $this->admin_model->get_data_jalan();
        $data=array(
            'content'=>'admin/list_users',
            // 'row' => $get_data,
        );
        $this->load->view('template',$data);
    }

    public function ajax_list() {
	    $this->load->helper('url');
	    $this->load->model('admin_model');
	    $list = $this->admin_model->get_datatables();
	    
	    $data = array();
	    $no = $_POST['start'];
	    $i=1;
	    foreach ($list as $user) {
	        $no++;
	        $row = array();
	        $row[] = $no;
	        $row[] = $user->username;
	        $row[] = $user->nama;
	        $row[] = $user->created_date;
	        $row[] = '<center><a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete"
                        onclick="reset_password('."'".$user->id."'".','."'".$user->nama."'".' )">
                        <i class="ace-icon fa fa-refresh bigger-120"></i>Hapus</a></center>';
	        
	        $data[] = $row;
	        $i++;
	    }
	    
	    $output = array(
	        "draw" => $_POST['draw'],
	        "recordsTotal" => $i,
	        "recordsFiltered" => $this->admin_model->count_filtered(),
	        "data" => $data,
	    );
	    echo json_encode($output);
	}

	public function ajax_manageusers_add() {
		$this->load->model('admin_model');
	    date_default_timezone_set('Asia/Jakarta');
	    $group = $this->input->post('modal_groups');
	    $this->_validate($group, 'insert');

	    // $user_id = $this->ion_auth->user()->row()->id;
	    $user_id = "admin";
	    $username = $this->input->post('modal_username');
	    $password = $this->input->post('modal_password');
	    $name = $this->input->post('modal_name');
	    $mc_id = $this->input->post('modal_company');
	    $ms_id = $this->input->post('modal_sektor');
	    
	    $save = $this->admin_model->save_users($id=0, $username,
	        $password, $name, $user_id, $mc_id, $ms_id, $group);
	    
	    if($save > 0){
	        // $save_groups = $this->admin_model->insert_users_groups($save, $group);
	        echo json_encode(array("status" => 200, "message" => 'Berhasil Add User'));
	    }else{
	        echo json_encode(array("status" => 500, "message" => 'Gagal Add User'));
	    }
	}
	
	private function _validate($role, $iu) {
		$this->load->model('admin_model');
	    $data = array();
	    $data['error_string'] = array();
	    $data['inputerror'] = array();
	    $data['status'] = TRUE;

	    if($iu == 'insert'){
    	    if($this->input->post('modal_username') == '') {
    	        $data['inputerror'][] = 'modal_username';
    	        $data['error_string'][] = 'Username is required';
    	        $data['status'] = FALSE;
    	    }else{
    	        $cnt_user = $this->admin_model->count_username($this->input->post('modal_username'));
    	        if(count($cnt_user) > 0){
    	            $data['inputerror'][] = 'modal_username';
    	            $data['error_string'][] = 'Username is already taken';
    	            $data['status'] = FALSE;
    	        }
    	        else{
    	            $data['inputerror'][] = 'modal_username';
    	            $data['error_string'][] = '';
    	        }
    	    }
	    
    	    if($this->input->post('modal_password') == '') {
    	        $data['inputerror'][] = 'modal_password';
    	        $data['error_string'][] = 'Password is required';
    	        $data['status'] = FALSE;
    	    }else{
    	        $l_password =  strlen($this->input->post('modal_password'));
    	        if($l_password < 6){
    	            $data['inputerror'][] = 'modal_password';
    	            $data['error_string'][] = 'minimum password length is 6 characters';
    	            $data['status'] = FALSE;
    	        }
    	        else{
    	            $data['inputerror'][] = 'modal_password';
    	            $data['error_string'][] = '';
    	        }
    	    }
	    }
	    
	    if($this->input->post('modal_name') == '') {
	        $data['inputerror'][] = 'modal_name';
	        $data['error_string'][] = 'Name is required';
	        $data['status'] = FALSE;
	    }
	    else{
	        $data['inputerror'][] = 'modal_name';
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

	public function ajax_manageusers_delete($id) {
		$this->load->model('admin_model');
        $delete1 =  $this->admin_model->deleteuser_byid($id);
        
        if($delete1){
            echo json_encode(array("status" => 200, "message" => 'Berhasil Delete User'));
        }else{
            echo json_encode(array("status" => NULL, "message" => 'Gagal Delete User'));
        }
    }
}