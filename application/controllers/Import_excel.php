<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import_excel extends CI_Controller
{
  private $filename='userfile';
  function __construct()
  {
    parent::__construct();
    // load helper dan library
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->load->model('M_import');
    $this->load->model('M_pdf');
  }
  
  public function index($error = NULL)
  {
    $data = array(
      'judul' => set_value('judul'),
      'error' => $error // ambil parameter error
    );

    $this->load->view('import_excel_view', $data);
  }

  public function proses()
  {
    if (FALSE) {
      // jika validasi judul gagal
      die("error");
    } else {
      // config upload
      $data=$this->M_import->upload_file($this->filename);

      if ($data['result']=='failed') {
      // jika validasi file gagal, kirim parameter error ke index
        $this->index($data['error']);
      } else {
        $this->import();
      }
      //redirect ke halaman awal
      // redirect(site_url('Import_excel'));
    }
  }
  public function import(){
    // Load plugin PHPExcel nya
    include APPPATH.'third_party/PHPExcel/PHPExcel.php';
    $excelreader = new PHPExcel_Reader_Excel2007();
    $loadexcel = $excelreader->load('./uploads/excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
    $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

    // Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
    $data = array();
    $numrow = 1;
  //  $anu= false;
    foreach($sheet as $row){
    // Cek $numrow apakah lebih dari 1
    // Artinya karena baris pertama adalah nama-nama kolom
    // Jadi dilewat saja, tidak usah diimport
      if($numrow > 1){        // Kita push (add) array data ke variabel data
        array_push($data, array(
          'nomor'=>$row['A'], // Insert data nis dari kolom A di excel
          'nama'=>$row['B'], // Insert data nama dari kolom B di excel
          'tempat_lahir'=>$row['C'], // Insert data jenis kelamin dari kolom C di excel
          'tgl_lahir'=>$this->formatTanggal($row['D']), // Insert data alamat dari kolom D di excel
          'nm_ayah'=>$row['E'], // Insert data alamat dari kolom E di excel
          'nm_ibu'=>$row['F'], // Insert data alamat dari kolom F di excel
          'hari_baptis'=>$this->formatHari($row['G']), // Insert data alamat dari kolom G di excel
          'tgl_baptis'=>$this->formatTanggal($row['H']), // Insert data alamat dari kolom H di excel
          'nm_pastor'=>$row['I'], // Insert data alamat dari kolom I di excel
          'file_surat'=>$this->M_import->convert_slash_to_underscore($row['A']) // Insert data alamat dari kolom J di excel
        ));
        // $anu=$this->M_pdf->hanya_save($row['A'],$row['B'],$row['C'],$row['D'],$row['E'],$row['F'],$row['G'],
        // $row['H'],$row['I']);
        //
      }
      $numrow++; // Tambah 1 setiap kali looping
    }    // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
    $this->M_import->insert_multiple($data);
    redirect("Data_pembaptisan"); // Redirect ke halaman awal (ke controller fungsi index)
  }

  private function formatHari($hari){
    if((strtoupper($hari) == "MINGGU") || (strtoupper($hari) == "SUNDAY")){
      return 0;
    } else if((strtoupper($hari) == "SENIN") || (strtoupper($hari) == "MONDAY")){
      return 1;
    } else if((strtoupper($hari) == "SELASA") || (strtoupper($hari) == "TUESDAY")){
      return 2;
    } else if((strtoupper($hari) == "RABU") || (strtoupper($hari) == "WEDNESDAY")){
      return 3;
    } else if((strtoupper($hari) == "KAMIS") || (strtoupper($hari) == "THURSDAY")){
      return 4;
    } else if((strtoupper($hari) == "JUMAT") || (strtoupper($hari) == "FRIDAY")){
      return 5;
    } else if((strtoupper($hari) == "SABTU") || (strtoupper($hari) == "SATURDAY")){
      return 6;
    } else{
      return 0;
    }
  }

  private function formatTanggal($tanggal){
    $time = strtotime($tanggal);

    $newformat = date('Y-m-d',$time);

    return $newformat;
  }


}


