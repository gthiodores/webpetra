<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class M_import extends CI_Model {
    public $table = 'gpetra';
    public $id = 'data_baptis';
    public $order = 'DESC';
    function __construct() {
        parent::__construct();
    }
    //ini untuk memasukkan kedalam tabel pegawai
    function loaddata($dataarray) {
        for ($i = 0; $i < count($dataarray); $i++) {
            $data = array(
                'nomor' => $dataarray[$i]['nomor'],
                'nama' => $dataarray[$i]['nama'],
                'tempat_lahir' => $dataarray[$i]['tempat_lahir'],
                'tgl_lahir' => $dataarray[$i]['tgl_lahir'],
                'nm_ayah' => $dataarray[$i]['nm_ayah'],
                'nm_ibu' => $dataarray[$i]['nm_ibu'],
                'hari_baptis' => $dataarray[$i]['hari_baptis'],
                'tgl_baptis' => $dataarray[$i]['tgl_baptis'],
                'nm_pastor' => $dataarray[$i]['nm_pastor'],
                'file_surat' => $dataarray[$i]['file_surat']
            );
            //ini untuk menambahkan apakah dalam tabel sudah ada data yang sama
            //apabila data sudah ada maka data di-skip
            // saya contohkan kalau ada data nama yang sama maka data tidak dimasukkan
            $this->db->where('nomor', $this->input->post('nomor'));
            if ($cek) {
                $this->db->insert($this->table, $data);
            }
        }