<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Base.php';
class dbcon extends Base
{
    public function __construct(){
        parent::__construct();
    }
    public function savedata($data){
        $this->db->insert("data",$data);
    }
    public function  getday($postcode,$town,$region){
        $this->db->from("data");
        if($postcode!=""){
            $_SESSION["postcode"]=$postcode;
            $this->db->where("Postcode",$postcode);
        }
        if($town!=""){
            $_SESSION["town"]=$town;
            $this->db->where("Town",$town);
        }
        if($region!=""){
            $_SESSION["region"]=$region;
            $this->db->where("Region",$region);
        }
        return $this->db->get()->result_array();
    }
    public function Getallusers(){
        $this->db->from("data");
        $result =  $this->db->get()->result_array();
        return $result;
    }
    public function saveuser($userdata){
        $this->db->insert($this->users,$userdata);
    }
    public function deleteuser($userid){
        $this->db->from($this->users);
        $this->db->where('id',$userid);
        $this->db->delete();
    }
    public function updateuser($id,$data){
        $this->db->where('id', $id);
        $this->db->update($this->users, $data);
    }
    public function updateuserbyusername($username,$data){
        $this->db->where('username', $username);
        $this->db->update($this->users, $data);
    }
    public function getuserbyid($id){
        $this->db->from($this->users);
        $this->db->where('id',$id);
        return $this->db->get()->result_array()[0];
    }
    public function getuserbyusername($username){
        $this->db->from($this->users);
        $this->db->where('username',$username);
        return $this->db->get()->result_array()[0];
    }
    public function getusersbytype($user_type){
        $this->db->from($this->users);
        $this->db->where('users_type',$user_type);
        return $this->db->get()->result_array();
    }

    public function Getsallariedusers(){
        $this->db->from($this->users);
        $this->db->where('salary>','0');
        return $this->db->get()->result_array();
    }

    public function addvehicle($data){
        $this->db->insert($this->vehicles,$data);
    }
    public function Getallvehicles(){
        $this->db->from($this->vehicles);
        $result =  $this->db->get()->result_array();
        return $result;
    }
    public function deletevehicles($userid){
        $this->db->from($this->vehicles);
        $this->db->where('id',$userid);
        $this->db->delete();
    }
    public function updatevehicle($id,$data){
        $this->db->where('id', $id);
        $this->db->update($this->vehicles, $data);
    }
    public function getvehiclebyid($id){
        $this->db->from($this->vehicles);
        $this->db->where('id',$id);
        return $this->db->get()->result_array()[0];
    }
    public function Addbooking($data){
        $this->db->insert($this->bookings,$data);
    }
    public function Getallbookings(){
        $this->db->from($this->bookings);
        $result =  $this->db->get()->result_array();
        return $result;
    }
    public function GetallbookingbyOldOrder(){
        $this->db->from($this->bookings);
        $this->db->order_by('starting_date','DESC');
        $result =  $this->db->get()->result_array();
        return $result;
    }
    public function Getbookingbyid($id){
        $this->db->from($this->bookings);
        $this->db->where('id',$id);
        return $this->db->get()->result_array()[0];
    }
    public function Deletebooking($id){
        $this->db->from($this->bookings);
        $this->db->where('id',$id);
        $this->db->delete();
    }
    public function Updatebooking($id,$data){
        $this->db->where('id', $id);
        $this->db->update($this->bookings, $data);
    }
    public function getbookingoverdate($startingdate){
        $this->db->from($this->bookings);
        $this->db->where('starting_date>=',$startingdate);
        return $this->db->get()->result_array();
    }
    public function Addservice($data){
        $this->db->insert($this->services,$data);
    }
    public function Getallservices(){
        $this->db->from($this->services);
        $result =  $this->db->get()->result_array();
        return $result;
    }
    public function Getservicebyid($id){
        $this->db->from($this->services);
        $this->db->where('id',$id);
        return $this->db->get()->result_array()[0];
    }
    public function Deleteservice($id){
        $this->db->from($this->services);
        $this->db->where('id',$id);
        $this->db->delete();
    }
    public function Updateservice($id,$data){
        $this->db->where('id', $id);
        $this->db->update($this->services, $data);
    }
    public function getservicesoverdate($startingdate){
        $this->db->from($this->services);
        $this->db->where('date>=',$startingdate);
        return $this->db->get()->result_array();
    }
    public function getbookingbydate($startingdate,$endingdate){
        $this->db->from($this->bookings);
        $this->db->where('starting_date>=',$startingdate);
        $this->db->where('starting_date<=',$endingdate);
        return $this->db->get()->result_array();
    }

    public function getservicebydate($startingdate,$endingdate){
        $this->db->from($this->services);
        $this->db->where('date>=',$startingdate);
        $this->db->where('date<=',$endingdate);
        return $this->db->get()->result_array();
    }
}