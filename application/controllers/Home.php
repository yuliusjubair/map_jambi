<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	 function __construct() {
        parent::__construct();
        
        $this->load->model('Map_model');
        $this->load->helper('general');
    }

    public function index()
    {
        $master_kecamatan = $this->map_model->get_data_kecamatan();
        $master_jenis = $this->map_model->get_data_jenis();
    	$get_data = $this->map_model->get_data_type();
        $master_type = $this->map_model->get_data_type_ruas();
        $kecamatan_id="";
        $type_ruas="";
        $jenis="";
        $kondisi="";
        $kirim=false;
        if($_POST){
            $kecamatan_id = $this->input->post('kecamatan');
            $type_ruas = $this->input->post('type_ruas');
            $jenis = $this->input->post('type');
            $kondisi = $this->input->post('kondisi');
            $get_data = $this->map_model->get_data_type_search($kecamatan_id, $type_ruas, $jenis, $kondisi);
            $kirim=true;
        }
        $data=array(
        	'content'=>'show_draw',
            'master_kecamatan' => $master_kecamatan,
            'master_jenis' => $master_jenis,
            'master_type' => $master_type,
            "kecamatan_id" => $kecamatan_id,
            "type_ruas_id" => $type_ruas,
            "jenis" => $jenis,
            "kondisi" => $kondisi,
        	'row' => $get_data,
            "posting" => $kirim,
            "list_kondisi" => $this->map_model->get_data_kondisi()
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
        secure();
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

    public function show_detail_kondisi($id)
    {
        secure();
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
            'content'=>'show_detail_kondisi',
            'row' => $get_data,
            'master_kondisi' => $master_kondisi,
            'master_kondisi_jembatan' => $master_kondisi_jembatan,
            'master_kecamatan' => $master_kecamatan,
            'master_jenis' => $master_jenis,
            'master_type_jembatan' => $master_type_jembatan,
            'master_type_jembatan_detail' => $master_type_jembatan_detail,
            'list_kondisi' => $this->map_model->get_data_kondisi_bylokasi($id),
            'all_lokasi' => $this->map_model->get_all_lokasi_byId($id)
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
        $nama_lokasi_jembatan = $this->input->post('nama_lokasi_jembatan');

        $nama_jembatan = $this->input->post('nama_jembatan');
        $kecamatan = $this->input->post('kecamatan');
        $panjang_jenis = str_replace(",", ".", $this->input->post('panjang_jenis'));
        
        $panjang = str_replace(",", ".", $this->input->post('panjang'));
        $panjang_jembatan = str_replace(",", ".", $this->input->post('panjang_jembatan'));
        $lebar = str_replace(",", ".", $this->input->post('lebar'));
        $lebar_jembatan = str_replace(",", ".", $this->input->post('lebar_jembatan'));
        
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
        // print_r($_POST);die;
        $data = array(
            "type_ruas_id" => $type_ruas,
            "nama_jembatan" => !empty($nama_jembatan)?$nama_jembatan:'-',
            "nama_ruas_jalan" => ($type_ruas==3)?$nama_lokasi:$nama_lokasi_jembatan,
            "kecamatan_id" => $kecamatan,
            "panjang_ruas" => ($type_ruas==3)?$panjang:$panjang_jembatan,
            "lebar_ruas" => ($type_ruas==3)?$lebar:$lebar_jembatan,
            "jumlah_bentang" => $jumlah_bentang,
            "type_id" => $type,
            "panjang_jenis" => $panjang_jenis,
            "waypoint1" => $modal_perimeter_list,
            "waypoint2" => $waypoint2
        );
        $this->db->insert("list_lokasi", $data);
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
        redirect('index.php/home/index/');
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
            "nama_jembatan" => !empty($nama_jembatan)?$nama_jembatan:'-',
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
            $sql = $this->db->query("select * from list_lokasi where nama_ruas_jalan='".$nama_lokasi."' and kecamatan_id='".$kecamatan."'");
            if($sql->num_rows()==0){
                $this->db->insert("list_lokasi", $data);
            }
        
            // $this->db->insert("lokasi_waypoint", $data);
            // $idnya = $this->db->insert_id();
        }else{
            // $where = array("id_lokasi"=>$id);
            // $idnya = $id;
            // $this->db->update("lokasi_waypoint", $data, $where);
        }
        $where = array("id_lokasi"=>$id);
        $idnya = $id;
        $this->db->update("lokasi_waypoint", $data, $where);
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

            if($type_ruas==3){
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
            }else{
                echo json_encode(array("message" => 'Data Update Successfully'));
            }
        }

        
        
        /*$this->session->set_flashdata('response',"Data Location Update Successfully");
    	redirect('home/show_detail/'.$id);*/
    }

    public function hapus_data($id) {
        // secure();
        if (!$this->ion_auth->logged_in()){
            echo json_encode(array("status" => NULL, "message" => 'Gagal Delete Data, Anda harus Login!'));
        }else{

            $delete1 =  $this->map_model->delete_byId($id);
            if($delete1){
                echo json_encode(array("status" => 200, "message" => 'Berhasil Delete Data Map'));
            }else{
                echo json_encode(array("status" => NULL, "message" => 'Gagal Delete Data'));
            }
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

    public function excel_ruas_jalan()
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
        $this->load->view('excel_ruas_jalan',$data);
    }

    public function excel_jembatan()
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
        $this->load->view('excel_jembatan',$data);
    }

    public function view_jenis_permukaan($id, $id_ruas)
    {
        if($id_ruas==4){
            $get_data = $this->map_model->get_data_jembatan();
        }else{
            $get_data = $this->map_model->get_list_jenis_permukaan_byidlokasi($id);
        }
        if($get_data->num_rows()==0){
            echo "Belum Ada Data";
        }else{
            $row="<table class='table table-bordered'>";
            $row.="<tr><th>No</th>
                    <th>Jenis Permukaan</th>
                    <th>Panjang (Km)</th></tr>";
            $no=0;
            foreach ($get_data->result() as $key => $value) {
                $row.="<tr>";
                $row.="<td>".$no."</td>";
                $row.="<td>".$value->jenis."</td>";
                $row.="<td>".$value->panjang."</td>";
                $row.="</tr>";
                $no++;
            }
            $row.="</table>";
            echo $row;
        }
    }

    public function form_upload_images($id){
        $data['id'] = $id;
        $this->load->view('images/index',$data);
    }

    public function list_images($id){
        $list = $this->map_model->get_images($id);
        $data = array();
        $no =0;
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = "<img src='".base_url()."uploads/image_lokasi3/".$field->file_path."' width='30%'>";
            $row[] = '  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete"
                        onclick=hapus_images("'.$field->id.'","'.$field->file_path.'")>
                        <i class="ace-icon fa fa-refresh"></i>Hapus</a>';
            $data[] = $row;
        }
        
        $output = array(
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_insert_images(){
        $id_lokasi = $this->input->post('id_lokasi');
        if ($_FILES['images']['tmp_name']!='') {
                $file_name1 =$_FILES['images']['name'];
                $file_ext1 =  pathinfo($file_name1, PATHINFO_EXTENSION);
                $file_tmp1= $_FILES['images']['tmp_name'];
                $type1 = pathinfo($file_tmp1, PATHINFO_EXTENSION);
                $data1 = file_get_contents($file_tmp1);
                //$file = 'data:image/'.$type1.';base64,'.base64_encode($data1);
                $file = str_replace(" ", "_", $file_name1);
            }else{
                $file = NULL;
            }
            $this->_do_upload($file);
            $username = $this->session->userdata('username');

            $data = array(
                "id_lokasi"=>$id_lokasi,
                "file_path" => $file,
                "created_by" => $username,
            );
            $this->db->insert('tbl_img_lokasi', $data);
          
            $data = array('status'=>200,'message'=>'success');
            echo json_encode($data);
    }

    private function _do_upload($file) {
        set_time_limit(0);
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        ini_set('max_input_time', 3600);
        
        // if(!is_dir("uploads")) {
        //     mkdir("uploads");
        // }
        
        $config['upload_path']          = 'uploads/image_lokasi3/';
        // if(!is_file($config['upload_path']))
        // {
        //     @mkdir($config['upload_path']);
        //     chmod($config['upload_path'], 777); 
        //     ## this should change the permissions
        // }
        $config['allowed_types']        = 'jpg|jpeg|png|JPG|JPEG|PNG|GIF|gif';
        $config['max_size']             = 2*1024; //set max size allowed in Kilobyte
        $config['file_name']            = $file; //just milisecond timestamp fot unique name
        
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if(!$this->upload->do_upload('images')) {
          
            $data['inputerror'][] = 'images';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    public function hapus_images($id, $filename) {
        $delete1 =  $this->map_model->deleteImages_byId($id);
        if($delete1){
            @unlink("uploads/image_lokasi3/".$filename);
            echo json_encode(array("status" => 200, "message" => 'Berhasil Delete Image'));
        }else{
            echo json_encode(array("status" => NULL, "message" => 'Gagal Delete Data'));
        }
    }

    public function form_link_video($id){
        $data['id'] = $id;
        $this->load->view('link/index',$data);
    }

    public function list_link_video($id){
        $list = $this->map_model->get_link($id);
        $data = array();
        $no =0;
        foreach ($list as $field) {
            $l = explode(" ", $field->link);
            $lv = $l[3];
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $lv;
            $row[] = '  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete"
                        onclick=hapus_link("'.$field->id.'","'.$lv.'")>
                        <i class="ace-icon fa fa-refresh"></i>Hapus</a>';
            $data[] = $row;
        }
        
        $output = array(
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_insert_link(){
        $id_lokasi = $this->input->post('id_lokasi');
        $link = $this->input->post('link');
    
        $username = $this->session->userdata('username');

        $data = array(
            "id_lokasi"=>$id_lokasi,
            "link" => $link,
            "created_by" => $username,
        );
        $this->db->insert('tbl_linkvideo_lokasi', $data);
      
        $data = array('status'=>200,'message'=>'success');
        echo json_encode($data);
    }

    public function hapus_link($id, $filename) {
        $delete1 =  $this->map_model->deleteLink_byId($id);
        if($delete1){
            echo json_encode(array("status" => 200, "message" => 'Berhasil Delete Link Video'));
        }else{
            echo json_encode(array("status" => NULL, "message" => 'Gagal Delete Data'));
        }
    }

    public function view_images($id){
        $data['id'] = $id;
        $data['list'] = $this->map_model->get_images($id);
        $this->load->view('images/view',$data);
    }

    public function view_video($id){
        $data['id'] = $id;
        $data['list'] = $this->map_model->get_link($id);
        $this->load->view('images/video',$data);
    }

    function insert_data_kondisi(){
        set_time_limit(0);
          ini_set('max_execution_time', 0);
          ini_set('memory_limit', '-1');
          ini_set('upload_max_filesize', '1409600M');
          ini_set('post_max_size', '1409600M');
          ini_set('max_input_time', 1360000);

        $id = $this->input->post('modal_id');
        $waypoint2 = $this->input->post('waypoint3');
        $kondisi = $this->input->post('kondisi');
        $type_ruas = $this->input->post('type_ruas');
        if(!empty($id)){

            if($waypoint2==""){
                echo json_encode(array("message" => 'Data Failed, Belum Menentukan Titik Map!'));
                die;
            }

            if($type_ruas==3){
                $cek = $this->db->query("SELECT * FROM lokasi_kondisi_waypoint where id_lokasi='$id' and id_kondisi='$kondisi'");
                if($cek->num_rows()==0){

                    //add jenis permukaan
                    $data_per = array(
                        "id_lokasi" => $id,
                        "id_kondisi" => $kondisi,
                        "waypoint" => $waypoint2
                       );
                    $this->db->insert("lokasi_kondisi_waypoint", $data_per);
                    echo json_encode(array("message" => 'Data Update Successfully, Berhasil Input Kondisi Ruas'));
                }else{
                    $this->db->query("update lokasi_kondisi_waypoint set id_kondisi='$kondisi', waypoint='$waypoint2' where id_lokasi='$id' and id_kondisi='$kondisi'");    
                    echo json_encode(array("message" => 'Data Update Successfully, berhasil update Kondisi Ruas'));
                }
            }else{
                echo json_encode(array("message" => 'Data Update Successfully'));
            }
        }
    }
}
