<?php
class dashboard extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->model('M_surat');
    $this->load->model('M_login');
  }

  function index()
  {
    //Checks if the user has logged in or not
    $s = $this->session->userdata("status");
    if($s == null){
      redirect(base_url());
    } else{
      //Checks if the URL contains a query e.g ..dashboard?query=..
      //If it doesn't contain any query then load a default data
      //Default data = this year
      if(!isset($_POST['waktu1']))
        $year = date("Y");
      else
        $year = $this->input->post('waktu1');
      $label = array();
      $baptism_count = array();
      for ($i=1; $i <= 12; $i++) {
        //Fills label with month names (will be used by graph)
        $time = mktime(0, 0, 0, $i, 1, $year);
        array_push($label, date("F", $time));

        //Fills data with amount of baptism event for the i-st/nd/rd/th month
        $date = date("Y-m-", $time);
        array_push($baptism_count, $this->M_surat->get_baptis_count("data_baptis", $date));
      }
      $data = array(
        'date_type' => $year,
        'label' => $label,
        'count' => $baptism_count
      );
      $this->load->view('dashboard', $data);
    }
  }

}

?>
