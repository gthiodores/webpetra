<?php
class Start extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->model('M_surat');
    $this->load->model('M_login');
  }

  function index()
  {
    $s = $this->session->userdata("status");
    if($s == null){
      $this->load->view('login');
    } else {
      $year =  date('y');
      $data['bulan_baptis'] = $this->M_surat->get_data_bulan('data_baptis', $year);
      $this->load->view('dashboard', $data);
    }
  }

  function test()
  {
    $username = $this->session->userdata("username");
    
    $data['hak_akses'] = $this->M_login->get_hak_akses($username);
    $this->load->view('tes', $data);
  }

  function login(){
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $akses ='';

    $where = array(
      'username' => $username,
      'password' => md5($password)
      );

    $cek = $this->M_login->cek_login("data_user",$where)->num_rows();

    if($cek > 0){      
      $akses = $this->M_login->get_hak_akses($username);
      $data_session = array(
        'username' => $username,
        'status' => "login",
        'hak_akses' => $akses
        );
 
      $this->session->set_userdata($data_session);
      $this->session->set_userdata('hak_akses', $this->M_login->get_hak_akses($username));
      redirect(base_url());
 
    }else{
      echo "Username atau password salah !";
      echo "<a href='".base_url()."''>Kembali</Button>";
    }
  }

  function logout(){
    $this->session->sess_destroy();
    redirect(base_url());
  }

}
?>
