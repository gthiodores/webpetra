<?php
class Data_pastor extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->model('M_user');
    $this->load->model('M_login');
  }

  function index(){
    $s = $this->session->userdata("status");
    $username = $this->session->userdata("username");
    $hak_akses =$this->session->userdata("hak_akses");
    if($s == null || $hak_akses & 0b100 != 0b100 ){
      redirect(base_url());
    } else {
      $data['users'] = $this->M_user->get_all_data('data_pastor');
      $this->load->view('data_pastor_view', $data);
    }
  }

  function tambah(){

    $nama = $this->input->post('nama');
    $ttd = $this->input->post('tanda_tangan');

    $data = array (
      'nm_pastor' => $nama,
      'tanda_tangan' => $ttd
    );

    $this->M_user->insert_data('data_pastor',$data);
    redirect('Data_pastor');
  }

  function edit(){

    $id = $this->input->post('id');
    $where = array('id' => $id);

    $nama = $this->input->post('nama');
    $ttd = $this->input->post('tanda_tangan');

    $data = array (
      'nm_pastor' => $nama,
      'tanda_tangan' => $ttd
    );

    $this->M_user->update_data('data_pastor',$data, $where);
    redirect('Data_user');
  }

  function hapus($id){
    $where = array('id'=>$id);

    $this->M_user->remove_data('data_pastor',$where);

    redirect('Data_pastor');

  }

}
?>
