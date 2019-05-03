<?php
class Data_user extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->model('M_user');
    $this->load->model('M_login');
  }

  function index(){
    $s = $this->session->userdata("status");
    $username = $this->session->userdata("username");
    $hak_akses =$this->session->userdata("hak_akses");
    if($s == null || $hak_akses & 1 != 1){
      redirect(base_url());
    } else {
      $data['users'] = $this->M_user->get_all_data('data_user');
      $this->load->view('data_user_view', $data);
    }
  }

  function tambah(){

    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $hak_akses = $this->input->post('hak_akses');

    $data = array (
      'username' => $username,
      'password' => md5($password),
      'hak_akses' => $hak_akses
      );

    $this->M_user->insert_data('data_user',$data);
    redirect('Data_user');
  }

  function edit(){

    $id = $this->input->post('id');
    $where = array('username' => $id);
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $hak_akses = $this->input->post('hak_akses');


    $data = array (
      'username' => $username,
    
      'hak_akses' => $hak_akses
    ); 

    if ($password != ""){
        $data['password'] = md5($password);
    }

    $this->M_user->update_data('data_user',$data, $where);
    redirect('Data_user');
  }

  function hapus($id){
    $where = array('username'=>$id);

    $this->M_user->remove_data('data_user',$where);

    redirect('Data_user');

  }

}
?>
