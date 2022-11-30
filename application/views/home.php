<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/templates/classic/images/" type="image/x-icon">
    <title>Work Report</title>

    <!-- main css -->
    <style>
        h1{
            text-align: center;
        }
        .mainDiv{
            margin-top: 3%;
        }
        .selectTime{
            position: relative;
            left: 45%;
            cursor: default;
        }
        .selectTime span{
            border: 1px black dotted;
            padding: 5px;
            cursor: pointer;
        }
    </style>
<script src="<?php echo base_url() ?>assets/js/Chart.js"></script>
</head>

<body>
    <h1>Freelancer/Remote Job Report</h1>
    <div class="mainDiv">
        <div class="selectTime">Select Time <span>Week</span></div>
        <div>
            <canvas id="ReportChart" style="width:100%;height: 50%"></canvas>
        </div>

    </div>
    <script>
        var xValues = ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"];
        var yValues = [7,8,8,9,9,9,10];

        var reportChart=new Chart("ReportChart", {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: "rgba(110,202,141,1)",
                    borderColor: "rgba(0,0,0,0.1)",
                    data: yValues
                }]
            },
            options:{
                legend: {display: false,}
            }
        });
        console.log(reportChart)
    </script>
</body>
</html>
