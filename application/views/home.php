<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Report</title>

    <!-- main css -->
    <style>
        h1 {
            text-align: center;
        }

        .mainDiv {
            margin-top: 3%;
        }

        .selectTime {
            position: relative;
            left: 38%;
            cursor: default;
        }

        .selectTime span {
            border: 1px black dotted;
            padding: 5px;
            cursor: pointer;
        }
        .report_and_add{

        }
        .report_and_add button{
            font-size: 22px;
            margin-top: 2%;
        }
        .selected {
            background-color: #b2e0e0;
        }
        form{
            width: fit-content;
            margin: 16px;
            padding: 21px;
            border: 1px solid;
        }
        form div{
            width:fit-content;
        }
        .centerInside{
            position: relative;
            left: 50%;
            transform: translateX(-50%);
        }
        h3 button{
            padding: 2px;
            margin: 5px;
        }
    </style>
    <script src="<?php echo base_url() ?>assets/js/Chart.js"></script>
</head>

<body>
<h1>Freelancer/Remote Job Report</h1>
<div class="mainDiv">
    <div><h3 style="text-align: center"><button onclick="window.location.href='<?php echo base_url('home/previousTime');?>'"><</button><span id="weekLabel">12-03-2022 to 12-08-2022</span><button onclick="window.location.href='<?php echo base_url('home/nextTime');?>'">></button></h3></div>
    <div class="selectTime">Select Time <span id="timeWeek" onclick="changeShowTime(0)">Week</span><span id="timeMonth" onclick="changeShowTime(1)">Month</span><span
                id="timeYear"  onclick="changeShowTime(2)">Year</span></div>
    <div class="report_and_add">
        <canvas id="ReportChart" style="width:100%;height: 50%"></canvas>
        <button class="centerInside" onclick="showHideInputDiv('inputForm')">Add Data</button>
    </div>
    <form action="home/uploadData" method="post" id="inputForm" class="centerInside" style="display: none">
        <div class="centerInside">
            <input id="DateInput" width="10" type="date" name="date">
        </div>
        <div class="centerInside">
            <input width="20" type="number" name="hour">:<input type="number" name="minute">
        </div>
        <input class="centerInside" type="submit">
    </form>
    <?php
    if(!isset($_SESSION['curPos'])){
        $_SESSION['curPos']=0;
    }
    if(!isset($_SESSION['timeview'])){
        $_SESSION['timeview']="week";
    }
    $curDay=date('w');
    if($_SESSION['timeview']=="week"){
        $curDay+= $_SESSION['curPos']*7;
    }

    $startDate=date("Y-m-d",strtotime((-$curDay+1)." days"));
    $endDate=date("Y-m-d",strtotime((6-$curDay+1)." days"));
    $result=$this->dbcon->searchByDate($startDate,$endDate);
    $timeLabels='';
    $hours='';
    foreach ($result as $row){
        $timeLabels.='"'.date("l m-d-Y",strtotime($row['date'])).'",';
        $chour=$row['hour']+$row['minutes']/60;
        $hours.='"'.$chour.'",';
    }

    ?>

</div>
<script>
    var primaryColor="#6eca8d"
    var weekLabel=document.getElementById("weekLabel")

    var timeLabels = [<?php echo $timeLabels;?>];
    var hours = [<?php echo $hours;?>];
    var timeSelectDivs = [document.getElementById("timeWeek"), document.getElementById("timeMonth"), document.getElementById("timeYear")]
    var selectedTime=timeSelectDivs[0]
    //Activating selected time
    selectedTime.classList.add("selected")

    //set primary color before this
    weekLabel.style.color=primaryColor
    weekLabel.innerText="<?php echo $startDate." to ".$endDate?>"
    var reportChart = new Chart("ReportChart", {
        type: "line",
        data: {
            labels: timeLabels,
            datasets: [{
                backgroundColor: primaryColor,
                borderColor: "rgba(0,0,0,0.1)",
                data: hours
            }]
        },
        options: {
            legend: {display: false,}
        }
    });
    console.log(reportChart)
    function changeShowTime(value){
        selectedTime.classList.remove("selected")
        selectedTime=timeSelectDivs[value]
        selectedTime.classList.add("selected")
    }
    function showHideInputDiv(DivId){
        let thisDiv=document.getElementById(DivId)
        if(thisDiv.style.display=="none"){
            let tToday=new Date()
            let tDate=tToday. getFullYear()+'-'+(tToday. getMonth()+1)+'-'+tToday. getDate()
            document.getElementById("DateInput").value=tDate;
            thisDiv.style.display="block"
        }else{
            thisDiv.style.display="none"
        }
    }
</script>
</body>
</html>
