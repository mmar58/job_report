<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Base.php';
class dbcon extends Base
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
        $this->db->where("date<='".$date."'");
        $this->db->order_by("date desc");
        $this->db->limit(1);
        return $this->db->get()->result_array();
    }
}