<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function index()
    {
        $data=array('content'=>'map');
        $this->load->view('template',$data);
    }
}
