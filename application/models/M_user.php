<?php
    class M_user extends CI_Model
    {
        //SELECT * FROM $table WHERE $where
        function get_data_where($table, $where)
        {
          $this->db->where($where);
          return $this->db->get($table);
        }

        //SELECT * FROM $table
        function get_all_user() {
          $sql = 'SELECT username, password, hak_akses FROM data_user';
          $query = $this->db->query($sql);
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

    }
?>
