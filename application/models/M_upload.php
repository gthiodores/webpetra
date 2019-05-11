<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class M_upload extends CI_Model {
    public $table = 'data_pastor';
    public $id = 'id';
    public $order = 'DESC';
    function __construct() {
        parent::__construct();
    }

    public function upload_png($filename)
    {
        $this->load->library('upload');
        $config['upload_path']='./uploads/img/ttd/';
        $config['allowed_types'] = 'png';
        $config['max_size']  = '2048000';
        $config['overwrite'] = true;
        $config['file_name'] = $filename;
        $this->upload->initialize($config); // Load konfigurasi uploadnya
        if($this->upload->do_upload($filename)){
        // Lakukan upload dan Cek jika proses upload berhasil
        // Jika berhasil :
          $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
          return $return;
        }
        else{      // Jika gagal :
          $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
          return $return;
        }
    }
    public function delete_png($filename)
    {
        $this->load->library('upload');
        $config['upload_path']='./uploads/img/ttd/';
        $config['allowed_types'] = 'png';
        $config['max_size']  = '2048000';
        $config['overwrite'] = true;
        $config['file_name'] = $filename;
        $this->upload->initialize($config); // Load konfigurasi uploadnya
        //delete file
        $path = $config['upload_path']. $filename;
        unlink($path);
    }
      public function insert_multiple($data){
        $this->db->insert_batch('data_pastor', $data);
      }
}
