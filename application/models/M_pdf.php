<?php
    class M_pdf extends CI_Model
    {
        // Untuk membuat surat
        public function buat_surat($nomor_surat,$nama_penerima,$tempat_lahir,
        $tanggal_lahir,$ayah,$ibu,$hari_baptis,$tgl_baptis,$oleh)
        {
          $data = array (
              'nomor_surat' => $nomor_surat,
              'nama_penerima' => $nama_penerima,
              'tempat_lahir' => $tempat_lahir,
              'tanggal_lahir' => $tanggal_lahir,
              'ayah' =>$ayah,
              'ibu' => $ibu,
              'hari_baptis' => $hari_baptis,
              'tgl_baptis' => $tgl_baptis,
              'oleh' => $oleh
          );
          $this->pdf->filename=$this->convert_slash_to_underscore($nomor_surat).".pdf";
          // $this->pdf->load_view("view_pdf_surat",$data);
          $this->output->set_content_type('application/pdf')->set_output(file_get_contents(
            $this->pdf->load_view("view_pdf_surat",$data)));
        }

        public function hanya_save($nomor_surat,$nama_penerima,$tempat_lahir,
        $tanggal_lahir,$ayah,$ibu,$hari_baptis,$tgl_baptis,$oleh)
        {
          $data = array (
              'nomor_surat' => $nomor_surat,
              'nama_penerima' => $nama_penerima,
              'tempat_lahir' => $tempat_lahir,
              'tanggal_lahir' => $tanggal_lahir,
              'ayah' =>$ayah,
              'ibu' => $ibu,
              'hari_baptis' => $hari_baptis,
              'tgl_baptis' => $tgl_baptis,
              'oleh' => $oleh
          );
          $this->pdf->filename=$this->convert_slash_to_underscore($nomor_surat).".pdf";
          $this->pdf->load_view("view_pdf_surat",$data);
          //return true;
        }
        // untuk menghapus surat
        public function delete_surat($path)
        {
          delete_files($path);
          unlink(str_replace(base_url(),"./",$path));
        }

        // untuk mengubah karakter "/"
        // pada id surat menjadi "_"
        public function convert_slash_to_underscore($str)
        {
          return str_replace("/", "_", $str);
        }

  }
?>
