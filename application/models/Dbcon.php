<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Base.php';
class Dbcon extends Base
{
    public function __construct(){
        parent::__construct();
    }
    public function savedata($data){
        if(count($this->getdate($data['date']))>0){
            $this->updateData($data);
        }else{
            $this->db->insert($this->dailywork,$data);
        };
        redirect("home");
    }
    public function getWeeklyData($weekOffset) {
        // Calculate the start and end dates for the requested week
        $startDate = date('Y-m-d', strtotime("monday this week $weekOffset week"));
        $endDate = date('Y-m-d', strtotime("sunday this week $weekOffset week"));
        // Fetch data from the 'dailywork' table
        $this->db->from($this->dailywork);
        $this->db->where('date >=', $startDate);
        $this->db->where('date <=', $endDate);

        $query = $this->db->get();
        return $query->result_array();
    }
    public function  getdate($date){
        $this->db->from($this->dailywork);
        $this->db->where("date",$date);
        return $this->db->get()->result_array();
    }
    public function updateData($data){
        $this->db->where("date",$data['date']);
        $this->db->update($this->dailywork,$data);
    }
    public function searchByDate($startDate,$endDate){
        $this->db->where('date BETWEEN "'. $startDate. '" and "'. $endDate.'"');
        $this->db->order_by("date asc");
        return $this->db->get($this->dailywork)->result_array();
    }
    public function GetHourRate($date){
        $this->db->from("hourrate");
//        $this->db->where("date<'".$date."'");
        $this->db->order_by("date DESC");
        $this->db->limit(1);
        return $this->db->get()->result_array();
    }
    public function GetExtraTime($date){
        $this->db->from($this->dailywork);
        $this->db->where("date",$date);
        return $this->db->get()->result_array();
    }
    public function SetExtraTime($date,$data){
        $this->db->where("date",$date);
        $this->db->update($this->dailywork,$data);
    }
}