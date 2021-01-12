<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	 function __construct() {
        parent::__construct();
        
        $this->load->model('Map_model');
    }

    public function index()
    {
    	$get_data = $this->map_model->get_data_type();
        $data=array(
        	'content'=>'show_draw',
        	'row' => $get_data
        );
        $this->load->view('template',$data);
    }

    //buat bikin line
    public function draw()
    {
        $master_kecamatan = $this->map_model->get_data_kecamatan();
        $master_jenis = $this->map_model->get_data_jenis();
        $master_kondisi = $this->map_model->get_data_kondisi();
        $master_type = $this->map_model->get_data_type_ruas();
        $master_type_jembatan = $this->map_model->get_data_type_jembatan();
        $master_type_jembatan_detail = $this->map_model->get_data_type_jembatan_detail();
        $get_data = $this->map_model->get_data();
        $data=array(
            'content'=>'draw',
            'row' => $get_data,
            'master_type_jembatan' => $master_type_jembatan,
            'master_type_jembatan_detail' => $master_type_jembatan_detail,
            'master_type' => $master_type,
            'master_kondisi' => $master_kondisi,
            'master_kecamatan' => $master_kecamatan,
            'master_jenis' => $master_jenis
        );
        $this->load->view('template',$data);
    }


    public function show_draw()
    {
    	$get_data = $this->map_model->get_data_type();
        // echo $this->db->last_query();
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
        $master_kecamatan = $this->map_model->get_data_kecamatan();
        $master_jenis = $this->map_model->get_data_jenis();
        $master_kondisi = $this->map_model->get_data_kondisi_by_idloc($id);
        $master_kondisi_jembatan = $this->map_model->get_data_kondisi();
        $master_type_jembatan = $this->map_model->get_data_type_jembatan_by_idloc($id);
        $master_type_jembatan_detail = $this->map_model->get_data_type_jembatan_detail();
        $master_type = $this->map_model->get_data_type_ruas();
        // echo $this->db->last_query();
        $data=array(
        	'content'=>'show_detail',
        	'row' => $get_data,
            'master_kondisi' => $master_kondisi,
            'master_kondisi_jembatan' => $master_kondisi_jembatan,
            'master_kecamatan' => $master_kecamatan,
            'master_jenis' => $master_jenis,
            'master_type_jembatan' => $master_type_jembatan,
            'master_type_jembatan_detail' => $master_type_jembatan_detail,
            'master_type' => $master_type,
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
        $type_ruas = $this->input->post('type_ruas');
        $nama_lokasi = $this->input->post('nama_lokasi');
        $nama_jembatan = $this->input->post('nama_jembatan');
        $kecamatan = $this->input->post('kecamatan');
        $panjang_jenis = str_replace(",", ".", $this->input->post('panjang_jenis'));
        $panjang = str_replace(",", ".", $this->input->post('panjang'));
        $lebar = str_replace(",", ".", $this->input->post('lebar'));
        $jumlah_bentang = str_replace(",", ".", $this->input->post('jumlah_bentang'));
        $type = $this->input->post('type');
        $modal_perimeter_list = $this->input->post('modal_perimeter_list');
        $waypoint2 = $this->input->post('waypoint3');
        // $link_video = $this->input->post('link_video');
        $list = $modal_perimeter_list;
        $list = explode(",", $list);
        // print_r($list);
        /*foreach ($list as $key => $value) {
            if($key%2==0){
            }
        }
        die;*/
        $data = array(
            "type_ruas_id" => $type_ruas,
            "nama_jembatan" => $nama_jembatan,
            "nama_ruas_jalan" => $nama_lokasi,
            "kecamatan_id" => $kecamatan,
            "panjang_ruas" => $panjang,
            "lebar_ruas" => $lebar,
            "jumlah_bentang" => $jumlah_bentang,
            "type_id" => $type,
            "panjang_jenis" => $panjang_jenis,
            "waypoint1" => $modal_perimeter_list,
            "waypoint2" => $waypoint2
        );
        $this->db->insert("lokasi_waypoint", $data);
        $id = $this->db->insert_id();
        if($id){
            $kondisi = $this->input->post('kondisi');
            $persen = $this->input->post('persen');
            $km = $this->input->post('km');
            if(isset($kondisi)):
                for($a=0;$a<count($kondisi);$a++){
                    $data_kondisi = array(
                        "id_lokasi" => $id,
                        "id_kondisi" => $kondisi[$a],
                        "persen" => str_replace(",", ".", $persen[$a]),
                        "km" => str_replace(",", ".", $km[$a]),
                    );
                    $this->db->insert("list_kondisi_map", $data_kondisi);
                }
            endif;

            //add jenis permukaan
            $data_per = array(
                "id_lokasi" => $id,
                "id_type" => $type,
                "panjang" => $panjang_jenis
               );
            $this->db->insert("list_jenis_permukaan_map", $data_per);

            //tipejembatan
            $kondisi_jembatan = $this->input->post('kondisi_jembatan');
            $tipe_detail = $this->input->post('tipe_detail');
            $kondisi_detail = $this->input->post('kondisi_detail');
            if(isset($kondisi_jembatan)):
                for($a=0;$a<count($kondisi_jembatan);$a++){
                    $data_kondisi = array(
                        "id_lokasi" => $id,
                        "id_kondisi" => $kondisi_jembatan[$a],
                        "id_type" => $tipe_detail[$a],
                        "id_kondisi_detail" => $kondisi_detail[$a],
                    );
                    $this->db->insert("list_kondisi_jembatan_map", $data_kondisi);
                }
            endif;

        }
        $this->session->set_flashdata('response',"Data Location Insert Successfully");
        //redirect('home/show_detail/'.$id);
        redirect('home/index/');
    }

    function update_data(){
        set_time_limit(0);
          ini_set('max_execution_time', 0);
          ini_set('memory_limit', '-1');
          ini_set('upload_max_filesize', '1409600M');
          ini_set('post_max_size', '1409600M');
          ini_set('max_input_time', 1360000);

    	$id = $this->input->post('modal_id');
        $type_ruas = $this->input->post('type_ruas');
        $nama_lokasi = $this->input->post('nama_lokasi');
    	$nama_jembatan = $this->input->post('nama_jembatan');
        $kecamatan = $this->input->post('kecamatan');
        $panjang_jenis = str_replace(",", ".", $this->input->post('panjang_jenis'));
        $panjang = str_replace(",", ".", $this->input->post('panjang'));
        $lebar = str_replace(",", ".", $this->input->post('lebar'));
        $type = $this->input->post('type');
        $modal_perimeter_list = $this->input->post('modal_perimeter_list');
        $waypoint2 = $this->input->post('waypoint3');
        $date = date("ymd");
    	$data = array(
            "type_ruas_id" => $type_ruas,
            "nama_jembatan" => $nama_jembatan,
            "nama_ruas_jalan" => $nama_lokasi,
            "kecamatan_id" => $kecamatan,
            "panjang_ruas" => $panjang,
            "lebar_ruas" => $lebar,
            "type_id" => $type,
            "panjang_jenis" => $panjang_jenis,
            "waypoint1" => $modal_perimeter_list,
            "waypoint2" => $waypoint2,
            "link_video" => $date.$_FILES['video']['name']
        );
        if($type_ruas==3){

        	// $where = array("id_lokasi"=>$id);
            $this->db->insert("lokasi_waypoint", $data);
            $idnya = $this->db->insert_id();
        }else{
            $where = array("id_lokasi"=>$id);
            $idnya = $id;
            $this->db->update("lokasi_waypoint", $data, $where);
        }
        // if($this->db->update("lokasi_waypoint", $data, $where)){
    	if($idnya){

            //upload video
                if (isset($_FILES['video']['name']) && $_FILES['video']['name'] != '') {
                    unset($config);
                    
                    $configVideo['upload_path'] = './video';
                    $configVideo['max_size'] = '12000000';
                    $configVideo['allowed_types'] = 'avi|flv|wmv|mp3|mp4';
                    $configVideo['overwrite'] = FALSE;
                    $configVideo['remove_spaces'] = TRUE;
                    $video_name = $date.$_FILES['video']['name'];
                    $configVideo['file_name'] = $video_name;

                    $this->load->library('upload', $configVideo);
                    $this->upload->initialize($configVideo);
                    if(!$this->upload->do_upload('video')) {
                        echo $this->upload->display_errors();
                    }else{
                        $videoDetails = $this->upload->data();
                        $data['video_name']= $configVideo['file_name'];
                        $data['video_detail'] = $videoDetails;
                        //$this->load->view('movie/show', $data);
                    }
                }

         $this->db->query("delete from list_kondisi_map where id_lokasi='$idnya'");   
         $kondisi = $this->input->post('kondisi');
            $persen = $this->input->post('persen');
            $km = $this->input->post('km');
            for($a=0;$a<count($kondisi);$a++){
                $data_kondisi = array(
                    "id_lokasi" => $idnya,
                    "id_kondisi" => $kondisi[$a],
                    "persen" => str_replace(",", ".", $persen[$a]),
                    "km" => str_replace(",", ".", $km[$a]),
                );
                $this->db->insert("list_kondisi_map", $data_kondisi);
            }

        //tipejembatan
            $this->db->query("delete from list_kondisi_jembatan_map where id_lokasi='$idnya'");
            $kondisi_jembatan = $this->input->post('kondisi_jembatan');
            $tipe_detail = $this->input->post('tipe_detail');
            $kondisi_detail = $this->input->post('kondisi_detail');
            if(isset($kondisi_jembatan)):
                for($a=0;$a<count($kondisi_jembatan);$a++){
                    $data_kondisi = array(
                        "id_lokasi" => $id,
                        "id_kondisi" => $kondisi_jembatan[$a],
                        "id_type" => $tipe_detail[$a],
                        "id_kondisi_detail" => $kondisi_detail[$a],
                    );
                    $this->db->insert("list_kondisi_jembatan_map", $data_kondisi);
                }
            endif;

            $cek = $this->db->query("SELECT * FROM list_jenis_permukaan_map where id_lokasi='$id' and id_type='$type'");
            if($cek->num_rows()==0){

                //add jenis permukaan
                $data_per = array(
                    "id_lokasi" => $id,
                    "id_type" => $type,
                    "panjang" => $panjang_jenis
                   );
                $this->db->insert("list_jenis_permukaan_map", $data_per);
                echo json_encode(array("message" => 'Data Update Successfully, Berhasil Input Jenis Permukaan baru'));
            }else{
                $this->db->query("update list_jenis_permukaan_map set panjang='$panjang_jenis' where id_lokasi='$id' and id_type='$type'");    
                echo json_encode(array("message" => 'Data Update Successfully, berhasil update Permukaan'));
            }
        }

        
        
        /*$this->session->set_flashdata('response',"Data Location Update Successfully");
    	redirect('home/show_detail/'.$id);*/
    }

    public function hapus_data($id) {
        $delete1 =  $this->map_model->delete_byId($id);
        if($delete1){
            echo json_encode(array("status" => 200, "message" => 'Berhasil Delete Data Map'));
        }else{
            echo json_encode(array("status" => NULL, "message" => 'Gagal Delete Data'));
        }
    }

    public function show_table()
    {
        $get_data = $this->map_model->get_data_jalan();
        $master_kondisi = $this->map_model->get_data_kondisi();
        $master_jenis = $this->map_model->get_data_jenis();
        $data=array(
            'content'=>'show_table',
            'row' => $get_data,
            'master_kondisi' => $master_kondisi,
            'master_jenis' => $master_jenis
        );
        $this->load->view('template',$data);
    }

    public function show_jembatan()
    {
        $get_data = $this->map_model->get_data_jembatan();
        $master_kondisi = $this->map_model->get_data_kondisi();
        $master_jenis = $this->map_model->get_data_jenis();
        $data=array(
            'content'=>'show_jembatan',
            'row' => $get_data,
            'master_kondisi' => $master_kondisi,
            'master_jenis' => $master_jenis
        );
        $this->load->view('template',$data);
    }
}
