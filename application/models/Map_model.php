<?php
defined('BASEPATH') or exit('No direct script allowed');

class Map_model extends CI_Model {
    var $tabel = 'lokasi_waypoint';



    function __construct() {

        parent::__construct();

    }



    public function get_menu_parent(){

        $this->db->select("id, keterangan");

        $this->db->from("mst_layanan_customer");

        $this->db->where("parent_id","0");

        $query = $this->db->get();

        return $query->result();

    }

     function get_data_type(){
        $this->db->select("a.nama_ruas_jalan,a.id_lokasi,a.panjang_ruas,a.lebar_ruas,a.type_ruas_id,a.link_video,a.waypoint2, b.nama as nama_kecamatan, c.jenis, c.kode_warna, d.nama as nama_ruas, '' as marker");
        $this->db->from("lokasi_waypoint as a");
        $this->db->join('master_kecamatan as b','a.kecamatan_id = b.id','left');
        $this->db->join('master_jenis_permukaan as c','a.type_id = c.id','left');
        $this->db->join('master_type as d','a.type_ruas_id = d.id','left');
        $this->db->where("a.delete_by =''");
        // $this->db->group_by('a.nama_ruas_jalan');
        $query = $this->db->get();
        $query1 =  $query->result();

        $this->db->select("'' as nama_ruas_jalan,'' as id_lokasi,'' as panjang_ruas,'' as lebar_ruas, '' as type_ruas_id,'' as link_video,waypoint as waypoint2, '' as nama_kecamatan, '' as jenis, b.kode_warna as kode_warna, '' as nama_ruas, '1' as marker");
        $this->db->from("lokasi_kondisi_waypoint as a");
        $this->db->join('master_kondisi as b','a.id_kondisi = b.id','left');
        $query = $this->db->get();
        $query2 = $query->result();

       return array_merge($query1, $query2);
    }

    function get_data_type_search($kecamatan_id, $type_ruas_id, $jenis, $kondisi){
        $this->db->select("a.nama_ruas_jalan,a.id_lokasi,a.panjang_ruas,a.lebar_ruas,a.type_ruas_id,a.link_video,a.waypoint2, b.nama as nama_kecamatan, c.jenis, c.kode_warna, d.nama as nama_ruas, '' as marker, '' as  kondisi");
        $this->db->from("lokasi_waypoint as a");
        $this->db->join('master_kecamatan as b','a.kecamatan_id = b.id','left');
        $this->db->join('master_jenis_permukaan as c','a.type_id = c.id','left');
        $this->db->join('master_type as d','a.type_ruas_id = d.id','left');
        $this->db->where("a.delete_by =''");
        if(!empty($kecamatan_id)){
            $this->db->where('a.kecamatan_id', $kecamatan_id);
        }
        if(!empty($type_ruas_id)){
            $this->db->where('a.type_ruas_id', $type_ruas_id);
        }
        if(!empty($jenis)){
            $this->db->where('a.type_id', $jenis);
        }
        $query = $this->db->get();
        $query1 =  $query->result();

        $this->db->select("'' as nama_ruas_jalan,'' as id_lokasi,'' as panjang_ruas,'' as lebar_ruas, '' as type_ruas_id,'' as link_video,waypoint as waypoint2, '' as nama_kecamatan, '' as jenis, b.kode_warna as kode_warna, '' as nama_ruas, '1' as marker, b.nama as kondisi");
        $this->db->from("lokasi_kondisi_waypoint as a");
        $this->db->join('master_kondisi as b','a.id_kondisi = b.id','left');
        if(!empty($kondisi)){
            $this->db->where('a.id_kondisi', $kondisi);
        }
        $query = $this->db->get();
        $query2 = $query->result();

        return array_merge($query1, $query2);
    }

    function get_data(){
        $this->db->select("a.*, b.nama as nama_kecamatan, c.jenis, c.kode_warna");
        $this->db->from("lokasi_waypoint as a");
        $this->db->join('master_kecamatan as b','a.kecamatan_id = b.id','left');
        $this->db->join('master_jenis_permukaan as c','a.type_id = c.id','left');
        // $this->db->group_by('a.nama_ruas_jalan');
        $this->db->where("a.delete_by =''");
        $query = $this->db->get();
        return $query->result();
    }

    function get_data_jalan(){
        $this->db->select("a.*, b.nama as nama_kecamatan, c.jenis, c.kode_warna");
        $this->db->from("lokasi_waypoint as a");
        $this->db->join('master_kecamatan as b','a.kecamatan_id = b.id','left');
        $this->db->join('master_jenis_permukaan as c','a.type_id = c.id','left');
        $this->db->where('a.type_ruas_id', 3);
        $this->db->where("a.delete_by =''");
        // $this->db->group_by('a.nama_ruas_jalan');
        $query = $this->db->get();
        return $query->result();
    }

    function get_data_jembatan(){
        $this->db->select("a.*, b.nama as nama_kecamatan, c.jenis, c.kode_warna");
        $this->db->from("list_lokasi as a");
        $this->db->join('master_kecamatan as b','a.kecamatan_id = b.id','left');
        $this->db->join('master_jenis_permukaan as c','a.type_id = c.id','left');
        $this->db->where('a.type_ruas_id', 4);
        $this->db->where("a.delete_by =''");
        // $this->db->group_by('a.nama_ruas_jalan');
        $query = $this->db->get();
        return $query->result();
    }


    function get_data_kecamatan(){
        $this->db->select("a.*");
        $this->db->from("master_kecamatan as a");
        // $this->db->limit(4);
        $query = $this->db->get();
        return $query->result();
    }

    function get_data_jenis(){
        $this->db->select("a.*");
        $this->db->from("master_jenis_permukaan as a");
        // $this->db->limit(4);
        $query = $this->db->get();
        return $query->result();
    }

    function get_data_jenis_join(){
        $this->db->select("b.type_id, a.id, a.jenis");
        $this->db->from("master_jenis_permukaan as a");
        $this->db->join("lokasi_waypoint as b","a.id = b.type_id","left");
        $query = $this->db->get();
        return $query->result();
    }

    function get_data_kondisi(){
        $this->db->select("a.*");
        $this->db->from("master_kondisi as a");
        // $this->db->limit(4);
        $query = $this->db->get();
        return $query->result();
    }

    function get_data_type_ruas(){
        $this->db->select("a.*");
        $this->db->from("master_type as a");
        // $this->db->limit(4);
        $query = $this->db->get();
        return $query->result();
    }

    function get_data_kondisi_by_idloc($id){
        $this->db->select("a.nama, a.id, b.persen, b.km");
        $this->db->from("master_kondisi as a");
        $this->db->join("list_kondisi_map as b","b.id_kondisi = a.id", "left");
        $this->db->where("b.id_lokasi",$id);
        $query = $this->db->get();
        return $query->result();
    }

    function get_data_type_jembatan(){
        $this->db->select("a.*");
        $this->db->from("master_type_jembatan as a");
        // $this->db->limit(4);
        $query = $this->db->get();
        return $query->result();
    }

    function get_data_type_jembatan_by_idloc($id){
        $this->db->select("a.nama, a.id, b.id_type, b.id_kondisi_detail");
        $this->db->from("master_type_jembatan as a");
        $this->db->join("list_kondisi_jembatan_map as b","b.id_kondisi = a.id", "left");
        $this->db->where("b.id_lokasi",$id);
        // $this->db->limit(4);
        $query = $this->db->get();
        return $query->result();
    }

    function get_data_type_jembatan_detail(){
        $this->db->select("a.*");
        $this->db->from("master_type_detail_jembatan as a");
        // $this->db->limit(4);
        $query = $this->db->get();
        return $query->result();
    }

    function get_data_byId($id){
        $this->db->select("a.*");
        $this->db->from("lokasi_waypoint as a");
        $this->db->where("id_lokasi", $id);
        $query = $this->db->get();
        return $query->row();
    }

    function jumlah_user() {

        $jumlah = $this->db->get_where($this->tabel, array('level_akun' => '2'));

        $j = $jumlah->num_rows();

        return $j;

    }

    public function update($where, $data)

    {

        $this->db->update($this->table, $data, $where);

        //return $this->db->affected_rows();

    }



    public function get_by_id($id)

    {

        $jumlah = $this->db->get_where($this->tabel, array('id_akun' => $id));

         $j = $jumlah->row();

        return $j;

    }



    public function delete_byId($id)

    {
        $tgl=date('Y-m-d');
        // $query = $this->db->query("DELETE FROM lokasi_waypoint WHERE id_lokasi = '$id'");
        $query = $this->db->query("Update lokasi_waypoint set delete_date='$tgl', delete_by='by user' WHERE id_lokasi = '$id'");		$query = $this->db->query("Update list_lokasi set delete_date='$tgl', delete_by='by user' WHERE id_lokasi = '$id'");

        return TRUE;

    }


    public function get_list_jenis_permukaan_byidlokasi($id_lokasi){
        $sql = $this->db->query("SELECT m.jenis, l.panjang from list_jenis_permukaan_map as l
        JOIN master_jenis_permukaan as m on m.id = l.id_type
        where l.id_lokasi='$id_lokasi'");
        return $sql;
    }

    function get_images($id_lokasi){
        $this->db->select("a.file_path, a.id_lokasi, a.id");
        $this->db->from("tbl_img_lokasi as a");
        $this->db->join('lokasi_waypoint as b','a.id_lokasi = b.id_lokasi','left');
        $this->db->where('a.id_lokasi', $id_lokasi);
        $this->db->order_by('a.id desc');
        $query = $this->db->get();
        return $query->result();
    }

    function deleteImages_byId($id){
        return $this->db->query("DELETE FROM tbl_img_lokasi WHERE id=?", $id);
    }

    function get_link($id_lokasi){
        $this->db->select("a.link, a.id_lokasi, a.id");
        $this->db->from("tbl_linkvideo_lokasi as a");
        $this->db->join('lokasi_waypoint as b','a.id_lokasi = b.id_lokasi','left');
        $this->db->where('a.id_lokasi', $id_lokasi);
        $this->db->order_by('a.id desc');
        $query = $this->db->get();
        return $query->result();
    }

    function deleteLink_byId($id){
        return $this->db->query("DELETE FROM tbl_linkvideo_lokasi WHERE id=?", $id);
    }

     function get_data_kondisi_bylokasi($id){
        $this->db->select("a.*, b.nama");
        $this->db->from("lokasi_kondisi_waypoint as a");
        $this->db->join('master_kondisi as b','a.id_kondisi = b.id','left');
        $this->db->where("id_lokasi", $id);
        $query = $this->db->get();
        return $query->result();
    }

    function get_all_lokasi_byId($id_lokasi){
        $sql = "SELECT waypoint2 as waypoint, waypoint1, type_ruas_id, 'black' as kode_warna from lokasi_waypoint where id_lokasi='$id_lokasi'
        UNION 
            SELECT waypoint, waypoint as waypoint1, '3' as type_ruas_id, kode_warna from lokasi_kondisi_waypoint 
            LEFT JOIN master_kondisi ON master_kondisi.id = lokasi_kondisi_waypoint.id_kondisi
            where id_lokasi='$id_lokasi'
        ";

        return $this->db->query($sql)->result();
    }

}

