<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('dbcon');
        $this->load->helper('url');
        $_SESSION['version']='1.04';
    }

	public function index(){

        $this->load->view("home");
	}
    public function uploadData(){
        $date=$_POST['date'];
        $hour=$_POST['hour'];
        $minutes=$_POST['minute'];
        if($hour==null||$hour==""){
            $hour=0;
        }
        if($minutes==null||$minutes==""){
            $minutes=0;
        }
        $report=array(
          "date"=>$date,
            "hour"=>$hour,
            "minutes"=>$minutes
        );
        $this->dbcon->savedata($report);
    }
}