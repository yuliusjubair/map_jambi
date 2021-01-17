<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
function secure(){
	$CI =& get_instance();
    $CI->load->library('session');
    $CI->session->set_userdata('redirect_url', current_url() );
    if (!$CI->ion_auth->logged_in()){
        redirect('auth/login', 'refresh');
    }
} 
?>