<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller
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
    public function getWeeklyWork($weekOffset = 0) {
        // Validate and sanitize the input
        $weekOffset = intval($weekOffset);

        // Call the model to fetch the data
        $result = $this->dbcon->getWeeklyData($weekOffset);

        // Output the result as JSON
        if ($result) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($result));
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'No data found']));
        }
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
    public function GetExtraHour($date){
        $result=$this->dbcon->GetExtraTime($date);
        if(count($result)>0){
            echo $result[0]["extraminutes"];
        }
    }
    public function SetExtraTime(){
        $date=$_GET['date'];
        $extraTime=$_GET['extraTime'];
    }
}