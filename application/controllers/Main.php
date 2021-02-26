<?php
  class Main extends CI_Controller {

    public function index(){
      $this->load->view('header');
      $this->load->view('chartjs_view');
      $this->load->view('footer');
    }


    public function chart_url(){
      $data = [];

      $data = array(
        'labels' => ['Boston', 'Worcester', 'Springfield', 'Lowell', 'Cambridge', 'New Bedford'],
        'data' => [
            'population' => [40, 30, 25, 85, 60, 80],
            'backgroundcolor' => ['red','orange','green','violet','blue','cyan']
          ]
      );

      echo json_encode($data);
    }
  }
?>