<?php
class Surat_baptis extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->model('M_surat');
    $this->load->model('M_user');
    $this->load->model('M_pdf');
  }

  function index(){
    $s = $this->session->userdata("status");
    if($s == null){
      redirect(base_url());
    } else {
      $in = $this->session->flashdata('in');
      if ($in != null){
        $data['dt_edit'] = $in;
        echo 'haha';
      }
      $data['nomor'] = $this->get_nomor_surat();
      $data['pastors'] = $this->M_user->get_field('nm_pastor','data_pastor');
      $this->load->view('surat_baptis_view',$data);
    }
  }

  function simpan(){
    $nomor = $this->input->post('nomor');
    $nama = $this->input->post('nama');
    $t4_lahir = $this->input->post('tempat_lahir');
    $tgl_lahir = $this->input->post('tanggal_lahir');
    $alamat = $this->input->post('alamat');
    $ayah = $this->input->post('nama_ayah');
    $ibu = $this->input->post('nama_ibu');
    $tgl_baptis = $this->input->post('tanggal_baptis');
    $oleh = $this->input->post('oleh');

    $data = array (
      'nomor' => $nomor,
      'nama' => $nama,
      'tempat_lahir' => $t4_lahir,
      'tgl_lahir' => $tgl_lahir,
      'alamat' => $alamat,
      'nm_ayah' => $ayah,
      'nm_ibu' => $ibu,
      'tgl_baptis' => $tgl_baptis,
      'nm_pastor' => $oleh,
      'file_surat'=>$this->M_pdf->convert_slash_to_underscore($nomor)
    );


    $this->M_surat->insert_data('data_baptis', $data);

    $this->session->set_flashdata('data_array', $data);
    redirect('Surat_baptis/pdf/');
  }

  function pdf(){
    $data = $this->session->flashdata('data_array');

    $this->M_pdf->buat_surat($data['nomor'],$data['nama'],$data['tempat_lahir'],
      $data['tgl_lahir'],$data['alamat'],$data['nm_ayah'],$data['nm_ibu'],//$data['hari_baptis'],
      $data['tgl_baptis'],$data['nm_pastor']);

    $this->session->unset_userdata("dataArr");
  }

  function edit(){
    $id = $this->input->post('id');
    $where = array('nomor' => $id);

    $nomor = $this->input->post('nomor');
    $nama = $this->input->post('nama');
    $t4_lahir = $this->input->post('tempat_lahir');
    $tgl_lahir = $this->input->post('tanggal_lahir');
    $alamat = $this->input->post('alamat');
    $ayah = $this->input->post('nama_ayah');
    $ibu = $this->input->post('nama_ibu');
    $tgl_baptis = $this->input->post('tanggal_baptis');
    $oleh = $this->input->post('oleh');

    $data = array (
      'nomor' => $nomor,
      'nama' => $nama,
      'tempat_lahir' => $t4_lahir,
      'tgl_lahir' => $tgl_lahir,
      'alamat' => $alamat,
      'nm_ayah' => $ayah,
      'nm_ibu' => $ibu,
      'tgl_baptis' => $tgl_baptis,
      'nm_pastor' => $oleh,
      'file_surat'=>$this->M_pdf->convert_slash_to_underscore($nomor)
      );

    $this->M_surat->update_data('data_baptis', $data, $where);
    redirect('Surat_baptis');
  }

  function get_nomor_surat(){

    $bulan = date("m");
    $bulan_romawi = $this->M_surat->romawi($bulan);
    // format nomor
    // contoh ====> 001/GPT/A/III/19
    //              [Nomor]/GPT/A/[bulan]/[tahun]
    $year = date('y');
    $format_nomor = "/GPT/A/".$bulan_romawi."/".$year;
    // Auto Nomor
    // nomor mulai dari 1 untuk tahun berbeda
    $nomor = 1;
    $nomor = $this->M_surat->addZero($nomor);
    $found = true;
    while($found){
        $sql="SELECT nomor FROM data_baptis WHERE nomor LIKE '$nomor%' AND nomor LIKE '%$year'";
        $res = $this->db->query($sql);
        if($res->num_rows() > 0){
            $nomor= $nomor + 1;
            $nomor = $this->M_surat->addZero($nomor);
        } else {
            $found = false;
        }
    }
    $nomor = $this->M_surat->addZero($nomor).$format_nomor;
    return $nomor;
  }

  public function tampilkan_surat($filename="thefile")
  {
    //////// Cek jika file pdf ada atau tidak,
    //////// jika tidak, buat file pdfnya
    $file = "./uploads/".$filename.".pdf";
    if (!(file_exists($file))) {
      $res=$this->M_surat->get_data_where("data_baptis",
      array('file_surat' => $filename))->result_array();
      $row=$res[0];
      $this->M_pdf->hanya_save($row['nomor'],$row['nama'],$row['tempat_lahir'],
      $row['tgl_lahir'],$row['alamat'],$row['nm_ayah'],$row['nm_ibu'],
      $row['tgl_baptis'],$row['nm_pastor']);
    }
    ///////
    $this->pdf->filename=$filename.".pdf";
    $this->output->set_content_type('application/pdf')->set_output(file_get_contents(
      base_url()."uploads/".$filename.".pdf"));
  }
  public function download_surat($filename)
  {
    $filepath="./uploads/".$filename.".pdf";

    // jika file sudah ada, hapus
    if ((file_exists($filepath))){
        $this->M_pdf->delete_surat($filepath);
    } 

    // buat surat baru
    $res=$this->M_surat->get_data_where("data_baptis", 
      array('file_surat' => $filename))->result_array();
    $row=$res[0];
    $this->M_pdf->hanya_save($row['nomor'],$row['nama'],$row['tempat_lahir'],
    $row['tgl_lahir'],$row['alamat'],$row['nm_ayah'],$row['nm_ibu'],
    $row['tgl_baptis'],$row['nm_pastor']);
    redirect($filepath);
  }
}
?>
