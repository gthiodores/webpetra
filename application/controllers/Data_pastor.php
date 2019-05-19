<?php
class Data_pastor extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->model('M_user');
    $this->load->model('M_login');
    $this->load->model('M_upload');
  }

  function index($error = NULL){
    $s = $this->session->userdata("status");
    $username = $this->session->userdata("username");
    $hak_akses =$this->session->userdata("hak_akses");
    if($s == null || $hak_akses & 0b100 != 0b100 ){
      redirect(base_url());
    } else {
    	$data['error'] = $error; // ambil parameter error
      $data['data_pastor'] = $this->M_user->get_all_data('data_pastor');
      $this->load->view('data_pastor_view', $data);
    }
  }

  function proses(){
  	$id =$this->input->post('id');
    $nama = $this->input->post('nama');
    $filename2 = $nama."-TTD-".$id;
    $filename = "userfile";
  	// config upload
    $data=$this->M_upload->upload_png($filename,$filename2);
    if ($data['result']=='failed') {
    	// jika validasi file gagal, kirim parameter error ke index
      $this->index($data['error']);
    } else{
    	$data['error'] = "<strong>Sukses menyimpan!</strong>";
    	$this->index($data['error']);
    }

  }

  function upload_ttd($id){

    $where = array('id' => $id);
  	$data['pastor'] = $this->M_user->get_result_where('data_pastor',$where);
  	$this->load->view('data_pastor_form_view', $data);
  }

  function tambah(){

    $nama = $this->input->post('nama');

    $data = array (
      'nm_pastor' => $nama
    );

    $this->M_user->insert_data('data_pastor',$data);
    redirect('Data_pastor');
  }

  function edit(){

    $id = $this->input->post('id');
    $where = array('id' => $id);

    $nama = $this->input->post('nama');

    $data = array (
      'nm_pastor' => $nama
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
