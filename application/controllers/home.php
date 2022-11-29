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
    public function search(){
        $postcode=$_POST["postcode"];
        $town=$_POST["town"];
        $region=$_POST["region"];
        $_SESSION["searchdata"]=$this->dbcon->getday($postcode,$town,$region);
        redirect("home");
    }
    public function do_upload()
    {
        $tmpName = $_FILES['userfile']['tmp_name'];

        $csvAsArray = array_map('str_getcsv', file($tmpName));


        for($i=1;$i<count($csvAsArray);$i++) {
            $monday = 0;
            $tuesday = 0;
            $wednesday = 0;
            $thursday = 0;
            $friday = 0;
            if ($csvAsArray[$i][6] == "YES") {
                $monday = 1;
            }
            if ($csvAsArray[$i][7] == "YES") {
                $tuesday = 1;
            }
            if ($csvAsArray[$i][8] == "YES") {
                $wednesday = 1;
            }
            if ($csvAsArray[$i][9] == "YES") {
                $thursday = 1;
            }
            if ($csvAsArray[$i][10] == "YES") {
                $friday = 1;
            }
            $upload_data = array(
                "Postcode" => $csvAsArray[$i][0],
                "Town" => $csvAsArray[$i][1],
                "Region" => $csvAsArray[$i][2],
                "SupplierName" => $csvAsArray[$i][3],
                "Monday" => $monday,
                "Tuesday" => $tuesday,
                "Wednesday" => $wednesday,
                "Thursday" => $thursday,
                "Friday" => $friday

            );
            $this->dbcon->savedata($upload_data);
            $_SESSION['uploaded']="yes";
            redirect("home");
        }
    }

}