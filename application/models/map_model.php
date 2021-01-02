<?php
defined('BASEPATH') or exit('No direct script allowed');

class map_model extends CI_Model {
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



    function get_data(){
        $this->db->select("a.*");
        $this->db->from("lokasi_waypoint as a");
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



    public function delete($id)

    {

        $query = $this->db->query("DELETE FROM akun WHERE id_akun = '$id'");

        return TRUE;

    }





}

