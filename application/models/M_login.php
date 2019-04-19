<?php
    class M_login extends CI_Model
    {
      //A function to check if the user exists
      function cek_login($table,$where){
        return $this->db->get_where($table,$where);
      }
      function get_hak_akses($username){
        //Simplified method for getting user's access privilege
        $this->db->SELECT('BIN(data_user.hak_akses) AS hak_akses');
        $this->db->FROM('data_user');
        $this->db->WHERE("username", $username);
        return $this->db->get()->row()->hak_akses;
        /** (Old method from ferian)
        *$qry=$this->db->query("SELECT BIN(hak_akses) as hak_akses FROM data_user WHERE username ='$id'");
        *$row = $qry->row();
        *$hak_akses='';
        *
        *if(isset($row)){
        *  $hak_akses = $row->hak_akses;
        *}
        *
        * return $hak_akses;
        */
      }
    }
?>
