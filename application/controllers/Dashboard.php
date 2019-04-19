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
      //Default data = this year mode in query type URL
      if(!parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY)) {
        $year = date("Y");
        $label = array();
        $baptism_count = array();
        for ($i=1; $i <= 12; $i++) {
          if ($i < 10)
            $month = "0".$i;
          else
            $month = $i;
          $time = mktime(0, 0, 0, $month, 1, $year);
          array_push($label, date("F", $time));
          $date = $year ."-" .$month;
          array_push($baptism_count, $this->M_surat->get_baptis_count("data_baptis", $date));
        }
        $data = array(
          'date_type' => 0,
          'label' => $label,
          'count' => $baptism_count
        );
        $this->load->view('dashboard', $data);
      } else {
        //Else fetch data based on the specified date format
        //0 = this year, 1 = this month, xxxx = year[xxxx]
        //e.g ../dashboard?query=0 will look for data that was inputted in this year
        $date_type = $_GET['query'];
        $year = date("Y");
        $label = array();
        $baptism_count = array();
        if ($date_type == '0') {
          for ($i=1; $i <= 12; $i++) {
            if ($i < 10)
              $month = "0".$i;
            else
              $month = $i;
            //Fills label with month names (will be used by graph)
            $time = mktime(0, 0, 0, $month, 1, $year);
            array_push($label, date("F", $time));
            //Fills data with amount of baptism event for the i-st/nd/rd/th month
            $date = $year ."-" .$month;
            array_push($baptism_count, $this->M_surat->get_baptis_count("data_baptis", $date));
          }
        } elseif ($date_type == '1') {
          // TODO: fill data and label with data in a month (0-31/30/29/28)
        } else {
          // TODO: fill data and label with monthly data from xxxx year
        }
        $data = array(
          'date_type' => $date_type,
          'label' => $label,
          'count' => $baptism_count
        );
        $this->load->view('dashboard', $data);
      }
    }
  }

}

?>