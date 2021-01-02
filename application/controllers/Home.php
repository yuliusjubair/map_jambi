<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	 function __construct() {
        parent::__construct();
        $this->load->model('map_model');
    }

    public function index()
    {
    	$get_data = $this->map_model->get_data();
        $data=array(
        	'content'=>'map',
        	'row' => $get_data
        );
        $this->load->view('template',$data);
    }

    //buat bikin line
    public function draw()
    {
        $data=array('content'=>'draw');
        $this->load->view('template',$data);
    }


    public function show_draw()
    {
    	$get_data = $this->map_model->get_data();
        $data=array(
        	'content'=>'show_draw',
        	'row' => $get_data
        );
        $this->load->view('template',$data);
    }

    public  function get_data_byId($id){
    	$get_data = $this->map_model->get_data_byId($id);
        $output = array(
	    	'data'=>$get_data,
	    );

	    echo json_encode($output);
    }

    public function show_detail($id)
    {
    	$get_data = $this->map_model->get_data_byId($id);
        $data=array(
        	'content'=>'show_detail',
        	'row' => $get_data
        );
        $this->load->view('template',$data);
    }

    public function add_location()
    {
        $data=array(
            'content'=>'add_location',
        );
        $this->load->view('template',$data);
    }

    function add_data(){
        $id = $this->input->post('modal_id');
        $nama_lokasi = $this->input->post('nama_lokasi');
        $alamat = $this->input->post('alamat');
        $keterangan = $this->input->post('keterangan');
        $wp1 = $this->input->post('waypoint1');
        $wp2 = $this->input->post('waypoint2');
        $link_video = $this->input->post('link_video');

        $data = array(
            "nama_lokasi" => $nama_lokasi,
            "alamat" => $alamat,
            "keterangan" => $keterangan,
            "waypoint1" => $wp1,
            "waypoint2" => $wp2,
            "link_video" => $link_video
        );
        $this->db->insert("lokasi_waypoint", $data);
        $id = $this->db->insert_id();
        $this->session->set_flashdata('response',"Data Location Insert Successfully");
        redirect('home/show_detail/'.$id);
    }

    function update_data(){
    	$id = $this->input->post('modal_id');
    	$nama_lokasi = $this->input->post('nama_lokasi');
    	$alamat = $this->input->post('alamat');
    	$keterangan = $this->input->post('keterangan');
    	$wp1 = $this->input->post('waypoint1');
    	$wp2 = $this->input->post('waypoint2');

    	$data = array(
    		"nama_lokasi" => $nama_lokasi,
    		"alamat" => $alamat,
    		"keterangan" => $keterangan,
    		"waypoint1" => $wp1,
    		"waypoint2" => $wp2,
    	);
    	$where = array("id_lokasi"=>$id);
    	$this->db->update("lokasi_waypoint", $data, $where);

        $this->session->set_flashdata('response',"Data Location Update Successfully");
    	redirect('home/show_detail/'.$id);
    }
}
