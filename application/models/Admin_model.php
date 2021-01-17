<?php
defined('BASEPATH') or exit('No direct script allowed');

class Admin_model extends CI_Model {
    function __construct() {
        parent::__construct();
        // $this->db = $this->load->database('read', TRUE);
        // $this->db = $this->load->database('cud', TRUE);
    }
    
    var $column_order= array('nama','username');
    var $column_search = array('nama','username');
    var $order = array('nama'=>'asc','username'=>'asc');
    
    var $column_order_groups = array('name','description');
    var $column_search_groups = array('name','description');
    var $order_groups = array('name'=>'asc','description'=>'asc');
    
    var $column_order_musers = array('v_nama','v_username');
    var $column_search_musers = array('v_nama','v_username');
    var $order_musers = array('v_nama'=>'asc','v_username'=>'asc');
    
    private function _get_datatables_query() {
        $this->db->select("au.id, au.nama, au.username, au.created_date")
        ->from("app_users au")
        ->where('au.active',1);
        
        $i = 0;
        foreach ($this->column_search as $item) {
            if($_POST['search']['value']) {
                if($i===0) {
                    $this->db->group_start();
                    $this->db->like('LOWER(' .$item. ')', strtolower($_POST['search']['value']));
                } else {
                    $this->db->or_like('LOWER(' .$item. ')', strtolower($_POST['search']['value']));
                }
                if(count($this->column_search) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }
        
        if(isset($_POST['order'])) {
            $this->db->order_by(
                $this->column_order[$_POST['order']['0']['column']],
                $_POST['order']['0']['dir']);
        } else if(isset($this->order)) {
            $this->db->order_by('nama','asc');
        }
    }
    
    function get_datatables() {
        $this->_get_datatables_query();
        
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
            $query = $this->db->get();
            return $query->result();
    }
    
    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    
   /* function data_users($cari){
        $sql="SELECT *, au.id as id_user  FROM app_users au
                inner join app_users_groups aug on aug.user_id=au.id
                inner join app_groups ag on ag.id=aug.group_id
              WHERE (au.nama) like UPPER('%$cari%') " ;
        $retdb=$this->db->query($sql);
        return $retdb;
    }*/
    
    function data_one_users($id){
        $sql="SELECT * FROM app_users au
                inner join app_users_groups aug on aug.user_id=au.id
                inner join app_groups ag on ag.id=aug.group_id
              WHERE au.id= $id" ;
        $retdb=$this->db->query($sql);
        return $retdb;
    }
    
    function data_groups(){
        $sql="SELECT * FROM app_groups" ;
        $retdb=$this->db->query($sql);
        return $retdb;
    }
    
    public function reset_byid($where, $data) {
        $this->db->update('app_users', $data, $where);
        return $this->db->affected_rows();
    }
    
    private function _get_datatables_query_groups() {
        $this->db->select("name, description, c, r, u, d")
        ->from("app_groups");
        $i = 0;
        foreach ($this->column_search_groups as $item) {
            if($_POST['search']['value']) {
                if($i===0) {
                    $this->db->group_start();
                    $this->db->like('LOWER(' .$item. ')', strtolower($_POST['search']['value']));
                } else {
                    $this->db->or_like('LOWER(' .$item. ')', strtolower($_POST['search']['value']));
                }
                if(count($this->column_search_groups) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }
        
        if(isset($_POST['order'])) {
            $this->db->order_by(
                $this->column_order[$_POST['order']['0']['column']],
                $_POST['order']['0']['dir']);
        } else if(isset($this->order_groups)) {
            $this->db->order_by('name','asc');
        }
    }
    
    function get_datatables_groups()  {
        $this->_get_datatables_query_groups();
        
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
            $query = $this->db->get();
            return $query->result();
    }
    
    function count_filtered_groups() {
        $this->_get_datatables_query_groups();
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function count_all_groups() {
        $this->db->select("name, description, c, r, u, d")
        ->from("app_groups");
        return $this->db->count_all_results();
    }
    
    private function _get_datatables_query_musers() {
        $this->db->select(" * FROM list_manage_user() ");
        $i = 0;
        foreach ($this->column_search_musers as $item) {
            if($_POST['search']['value']) {
                if($i===0) {
                    $this->db->group_start();
                    $this->db->like('LOWER(' .$item. ')', strtolower($_POST['search']['value']));
                } else {
                    $this->db->or_like('LOWER(' .$item. ')', strtolower($_POST['search']['value']));
                }
                if(count($this->column_search_musers) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }
        
        if(isset($_POST['order'])) {
            $this->db->order_by(
                $this->column_order_musers[$_POST['order']['0']['column']],
                $_POST['order']['0']['dir']);
        } else if(isset($this->order_musers)) {
            $this->db->order_by('v_nama','asc');
        }
    }
    
    function get_datatables_musers()  {
        $this->_get_datatables_query_musers();
        
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
            $query = $this->db->get();
            return $query->result();
    }
    
    function count_filtered_musers() {
        $this->_get_datatables_query_musers();
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function count_all_musers() {
        $this->db->select(" * FROM list_manage_user()");
        return $this->db->count_all_results();
    }
    
    public function count_username($username) {
        $sql= "SELECT  * FROM app_users WHERE username='$username'";
        $result = $this->db->query($sql);
        return $result->result();
    }
    
    public function save_users($id, $username,
        $password, $name, $user_id, $mc_id, $ms_id, $groups){
        
        $this->db->trans_start();
            if($password ==''){
                $sql_update_pass = '';
            }else{
                $password = password_hash($password,PASSWORD_DEFAULT);
                $sql_update_pass = "password = '$password', ";
            }
            
            if($id > 0){
                $insert_id = $id;
                $sql_users="UPDATE app_users 
                            SET 
                                username = '$username',
                                $sql_update_pass
                                nama = '$name'
                            WHERE id = $insert_id ";
                $this->db->query($sql_users);   
            }else{
                $sql_users="INSERT INTO app_users(username, password, active,
                    nama)
                VALUES  ('$username', '$password', 1,
                    '$name') ";
                $this->db->query($sql_users);   
    
                $insert_id = $this->db->insert_id();
            }
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return "error";
        } else {
            $this->db->trans_commit();
            return $insert_id;
        }
    }
    
    public function insert_users_groups($user_idx, $groups){
        $this->db->trans_start();
       
        $sql_user_groups="INSERT INTO app_users_groups(user_id, group_id)
                VALUES ($user_idx, $groups)";
        $this->db->query($sql_user_groups);
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return "error";
        } else {
            $this->db->trans_commit();
            return "success";
        }
    }
    
    public function update_users_groups($user_idx, $groups){
        $this->db->trans_start();
        
        $sql_user_groups="UPDATE app_users_groups
                            SET group_id = $groups
                            WHERE user_id = $user_idx";
        $this->db->query($sql_user_groups);
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return "error";
        } else {
            $this->db->trans_commit();
            return "success";
        }
    }
    
    public function getmanageusers_byid($id) {
        $sql="SELECT * FROM list_manage_user()
                WHERE v_user_id=$id" ;
        $retdb = $this->db->query($sql);
        return $retdb;
    }

     public function deleteuser_byid($id) {
        $this->db->where('id', $id);
        return $this->db->delete('app_users');
    }
}
