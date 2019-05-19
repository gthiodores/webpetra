<?php

class Data_pembaptisan extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('M_surat');
        $this->load->model('M_login');
        $this->load->model('M_user');
        $this->load->model('M_pdf');
    }

    function index(){
        $s = $this->session->userdata("status");
        $username = $this->session->userdata("username");
        $hak_akses =$this->session->userdata("hak_akses");
        if($s == null || $hak_akses & 0b10 != 0b10){
            redirect(base_url());
        } else {
            $data['dt_baptis'] = $this->M_surat->get_data_sorted('data_baptis');
            $data['pastors'] = $this->M_user->get_field('nm_pastor','data_pastor');
            $this->load->view('data_pembaptisan_view', $data);
        }
    }

    function edit(){

        $id = $this->input->post('id');
        $where = array('nomor' => $id);

        $nomor = $this->input->post('nomor');
        $nama = $this->input->post('nama');
        $tplahir = $this->input->post('tplahir');
        $tglahir = $this->input->post('tglahir');
        $alamat = $this->input->post('alamat');
        $ayah = $this->input->post('ayah');
        $ibu = $this->input->post('ibu');
        $tgbaptis = $this->input->post('tgbaptis');
        $oleh = $this->input->post('oleh');

        $data = array (
            'nomor' => $nomor,
            'nama' => $nama,
            'tempat_lahir' => $tplahir,
            'tgl_lahir' => $tglahir,
            'alamat'=> $alamat,
            'nm_ayah' => $ayah,
            'nm_ibu' => $ibu,
            'tgl_baptis' => $tgbaptis,
            'nm_pastor' => $oleh,
            'file_surat'=> $this->M_pdf->convert_slash_to_underscore($nomor)
        );

        $this->M_surat->update_data('data_baptis',$data, $where);
        $this->M_pdf->buat_surat($nomor,$nama,$tplahir,
        $tglahir,$ayah,$ibu,$hrbaptis,$tgbaptis,$oleh);
        redirect('Data_pembaptisan');
    }

    function hapus(){
        $id = $this->input->post('id');
        $where = array('nomor' => $id);
        $path= base_url("uploads/").$this->M_pdf->convert_slash_to_underscore($id).".pdf";
        $this->M_surat->remove_data('data_baptis',$where);
        $this->M_pdf->delete_surat($path);
        redirect('Data_pembaptisan');

    }



}

?>
