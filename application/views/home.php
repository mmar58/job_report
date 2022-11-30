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
            position: relative;
            left: 43.5%;
            font-size: 22px;
        }
        .selected {
            background-color: #b2e0e0;
        }
    </style>
    <script src="<?php echo base_url() ?>assets/js/Chart.js"></script>
</head>

<body>
<h1>Freelancer/Remote Job Report</h1>
<div class="mainDiv">
    <div class="selectTime">Select Time <span id="timeWeek" onclick="changeShowTime(0)">Week</span><span id="timeMonth" onclick="changeShowTime(1)">Month</span><span
                id="timeYear"  onclick="changeShowTime(2)">Year</span></div>
    <div class="report_and_add">
        <canvas id="ReportChart" style="width:100%;height: 50%"></canvas>
        <button>Add Data</button>
    </div>

</div>
<script>
    var timeLabels = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
    var hours = [7, 8, 8, 9, 9, 9, 10];
    var timeSelectDivs = [document.getElementById("timeWeek"), document.getElementById("timeMonth"), document.getElementById("timeYear")]
    var selectedTime=timeSelectDivs[0]
    //Activating selected time
    selectedTime.classList.add("selected")
    var reportChart = new Chart("ReportChart", {
        type: "line",
        data: {
            labels: timeLabels,
            datasets: [{
                backgroundColor: "rgba(110,202,141,1)",
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
</script>
</body>
</html>
