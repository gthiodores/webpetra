<?php
    class M_surat extends CI_Model
    {
        //SELECT * FROM $table WHERE $where
        function get_data_where($table, $where)
        {
          $this->db->where($where);
          return $this->db->get($table);
        }

        //SELECT * FROM $table
        function get_data_all($table) {
          $query = $this->db->get($table);
          return $query->result();
        }

        function insert_data($table, $data) {
          $this->db->insert($table, $data);
        }

        function remove_data($table, $where)
        {
          $this->db->where($where);
          $this->db->delete($table);
        }

        function update_data($table, $data, $where)
        {
          $this->db->where($where);
          $this->db->update($table, $data);
        }

        function get_nama_hari($nomor){
          $hari = array(0 => 'Minggu', 1=>'Senin', 2=>'Selassa', 3=>'Rabu', 4=>'Kamis', 5=>'Jumat', 6=>'Sabtu');
          foreach ($hari as $key => $value) {
            if ($key==$nomor){
              return $value;
            } else {
              return 'Nomor hari tidak valid';
            }
          }

        }

        // Tambah angka 0 didepan $val
        // Contoh, 
        // kalau $val = 3 fungsi akan return 003
        // kalau $val = 44 fungsi akan return 044
        // dst.
        function addZero($val){
            $len=strlen($val);
            if($len<3){
                for($i=0;$i<3-$len;$i++){
                    $val = "0".$val;
                }
            }
            return $val;
        }

        function romawi($num){
          // Nomor bulan ke angka romawi
          $romawi = array("X"=>"10","IX"=>"9","V"=>"5","IV"=>"4","I"=>"1");
          $num_romawi="";
          while($num<>0){
              foreach($romawi as $key => $value){
                  if($num-$value>=0){
                      $num-=$value;
                      $num_romawi=$num_romawi.$key;
                  }
              }
          }
          return $num_romawi;
        }

        // Ambil bulan pada nomor surat,
        // ambil banyak surat pada bulan dan tahun yang sama
        // ubah bulan dari angka romawi ke angka biasa
        // urutkan bulan
        // return array(bulan => banyak_surat)
        function get_data_bulan($table, $year){
          if(strlen($year)>2){
            $year = substr($year, 2,4);
          }
          $sql = "SELECT LEFT(RIGHT(nomor,LENGTH(nomor)-10),LENGTH(RIGHT(nomor,LENGTH(nomor)-10))-3) as bulan, 
            COUNT(LEFT(RIGHT(nomor,LENGTH(nomor)-10),LENGTH(RIGHT(nomor,LENGTH(nomor)-10))-3)) as jumlah 
            FROM `$table` 
            WHERE nomor LIKE '%$year' 
            GROUP BY LEFT(RIGHT(nomor,LENGTH(nomor)-10),LENGTH(RIGHT(nomor,LENGTH(nomor)-10))-3)";
          $query = $this->db->query($sql);
          $res = $query->result();

          $bulan = array();
          if ($query->num_rows() > 0){
            foreach ($res as $value) {
              $nmr_bln = $this->reverse_romawi($value->bulan);
              // $dateObj   = DateTime::createFromFormat('!m', $nmr_bln);
              // $nm_bln = $dateObj->format('F');
              $bulan[$nmr_bln] = $value->jumlah;
            }
          }

          ksort($bulan);
          return $bulan;
        }

        function reverse_romawi($num_romawi){
          // angka romawi ke angka biasa
          $romawi = array("X"=>"10","IX"=>"9","V"=>"5","IV"=>"4","I"=>"1");
          $num_romawi = strtoupper($num_romawi);
          $len=strlen($num_romawi);
          $num=0;
          foreach ($romawi as $key => $value) {
              while (strpos($num_romawi, $key) === 0) {
                  $num += $value;
                  $num_romawi = substr($num_romawi, strlen($key));
              }
          }
          return $num;
        }

    }
?>
