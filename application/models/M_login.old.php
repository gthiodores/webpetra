<?php
    class M_login extends CI_Model
    {

      function cek_login($table,$where){
        return $this->db->get_where($table,$where);
      }

      function get_hak_akses($id){
        $qry=$this->db->query("SELECT BIN(hak_akses) as hak_akses FROM data_user WHERE username ='$id'");
        $row = $qry->row();
        $hak_akses='';

        if(isset($row)){
          $hak_akses = $row->hak_akses;
        }

        return $hak_akses;
        }

    }
?>
