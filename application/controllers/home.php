<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('dbcon');
    }

	public function index(){

        $this->load->view("home");
	}
    public function previousTime(){
        $_SESSION['curPos']+=1;
        redirect('');
    }
    public function nextTime(){
        $_SESSION['curPos']-=1;
        redirect('');
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
    //APIs
    public function TargetHour(){

    }
    public function SetPrice(){
        $price=$_GET['price'];
        echo $price;
    }
}