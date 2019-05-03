<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import_excel extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    // load helper dan library
    $this->load->helper(array('form', 'url'));
    $this->load->library('Form_validation');
    $this->load->model('M_pdf');
  }
  public function index($error = NULL)
  {
    $data = array(
      'judul' => set_value('judul'),
      'error' => $error['error'] // ambil parameter error
    );

    $this->load->view('import_excel_view', $data);
  }

  public function proses()
  {
    // validasi judul
    $this->form_validation->set_rules('judul', 'judul', 'trim|required');
    if ($this->form_validation->run() == FALSE) {
      // jika validasi judul gagal
      $this->index();
    } else {
      // config upload
      $config['upload_path'] = './uploads/tmp';
      $config['allowed_types'] = 'xls';
      $config['max_size'] = '16384';
      $this->load->library('upload', $config);
      if ( ! $this->upload->do_upload('gambar')) {
      // jika validasi file gagal, kirim parameter error ke index
        $error = array('error' => $this->upload->display_errors());
        $this->index($error);
      } else {
        // jika berhasil upload ambil data dan masukkan ke database
        $upload_data = $this->upload->data();
        // load library Excell_Reader
        $this->load->library('Excel_reader');
        //tentukan file
        $this->excel_reader->setOutputEncoding('230787');
        $file = $upload_data['full_path'];
        $this->excel_reader->read($file);
        error_reporting(E_ALL ^ E_NOTICE);
        // array data
        $data = $this->excel_reader->sheets[0];
        $dataexcel = Array();
        for ($i = 1; $i <= $data['numRows']; $i++) {
          if ($data['cells'][$i][1] == '')
            break;
          $dataexcel[$i - 1]['nomor'] = $data['cells'][$i][1];
          $dataexcel[$i - 1]['nama'] = $data['cells'][$i][2];
          $dataexcel[$i - 1]['tempat_lahir'] = $data['cells'][$i][3];
          $dataexcel[$i - 1]['tgl_lahir'] = $data['cells'][$i][4];
          $dataexcel[$i - 1]['nm_ayah'] = $data['cells'][$i][5];
          $dataexcel[$i - 1]['nm_ibu'] = $data['cells'][$i][6];
          $dataexcel[$i - 1]['hari_baptis'] = $data['cells'][$i][7];
          $dataexcel[$i - 1]['tgl_baptis'] = $data['cells'][$i][8];
          $dataexcel[$i - 1]['nm_pastor'] = $data['cells'][$i][9];
          $dataexcel[$i - 1]['file_surat'] = $this->M_pdf->convert_slash_to_underscore($dataexcel[$i - 1]['nomor']);
          // $this->M_pdf->buat_surat(
          //   $dataexcel[$i - 1]['nomor'],
          //   $dataexcel[$i - 1]['nama'],
          //   $dataexcel[$i - 1]['tempat_lahir'],
          //   $dataexcel[$i - 1]['tgl_lahir'],
          //   $dataexcel[$i - 1]['nm_ayah'],
          //   $dataexcel[$i - 1]['nm_ibu'],
          //   $dataexcel[$i - 1]['hari_baptis'],
          //   $dataexcel[$i - 1]['tgl_baptis'],
          //   $dataexcel[$i - 1]['nm_pastor']
          // );
        }
        //load model
        $this->load->model('Data_model');
        $this->M_import->loaddata($dataexcel);
        //delete file
        $file = $upload_data['file_name'];
        $path = '.uploads/tmp/' . $file;
        unlink($path);
      }
      //redirect ke halaman awal
      // redirect(site_url('Import_excel'));
    }
  }
}