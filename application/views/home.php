
<!DOCTYPE html>
<html lang="en">
<?php $server = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];?>
<head>
    <link href="<?php echo base_url("assets/css/bootstrap5.3.2.min.css") ?>" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Report</title>
    
    <!-- main css -->
    <link href="<?php echo base_url("assets/css/main.css") ?>" rel="stylesheet">
    <link href="<?php echo base_url("assets/css/side.css") ?>" rel="stylesheet">
    <link href="<?php echo base_url("assets/css/popup.css") ?>" rel="stylesheet">
    <script src="<?php echo base_url() ?>assets/js/Chart.js"></script>
    <script src="<?php echo base_url() ?>assets/js/gsap.min.js"></script>
</head>

<body>
<a href="<?php echo "http://". $server;?>/worktime/?dates=<?php echo date("d-m-Y",strtotime("-1 days")).",".date("d-m-Y"); ?>" style="position: absolute;top: 0%;left: 0%" target="_blank" rel="noopener noreferrer">
    Open Worktime
</a>
<h1 class="header">Freelancer/Remote Job Report</h1>
<div><h3 style="text-align: center"><button onclick="window.location.href='<?php echo base_url('home/previousTime');?>'"><</button><span id="weekLabel">12-03-2022 to 12-08-2022</span><button onclick="window.location.href='<?php echo base_url('home/nextTime');?>'">></button></h3></div>

<!--Main Div-->
<div class="mainDiv">
    <div class="containALL"><div>Target <input onchange="HourTargetChanged(this.value)" type="number" style="width: 32px"> Hours</div><div style="
    position: relative;
    top: 2px;
"><b>Total done</b> <span id="doneTime"></span> <b> Earning </b> <span id="Earning1"></span><?php print_r($this->dbcon->GetHourRate("2023-01-22")) ?></div>  </div>

    <div class="selectTime">Select Time <span id="timeWeek" onclick="changeShowTime(0)">Week</span><span id="timeMonth" onclick="changeShowTime(1)">Month</span><span
                id="timeYear"  onclick="changeShowTime(2)">Year</span></div>
    <div class="report_and_add">
        <canvas id="ReportChart" style="width:100%;height: 50%"></canvas>
        <button class="centerInside" onclick="showHideInputDiv('inputForm')">Add Data</button>
    </div>
    <form action="home/uploadData" method="post" id="inputForm" class="centerInside" style="display: none">
        <div class="centerInside">
            <div><h4 onclick="selectedWorkTime()" id="workTimeFormButton" class="selected btn">Work time</h4><h4 onclick="selectedExtraTime()" id="extraTimeFormButton" class="btn">Extra time</h4></div>
        </div>
        <input id="timeInputType" type="text" name="type" style="display: none">
        <div class="centerInside">
            <input id="DateInput" width="10" type="date" name="date">
        </div>
        <div class="centerInside">
            <input width="20" type="number" name="hour">:<input type="number" name="minute">
        </div>
        <input class="centerInside" type="submit">
    </form>
    <div class="containALL">
        <div>Last  Worked Hours - <span id="lasWorkHours"></span><span> <b>Earning</b> </span><span id="Earning2"></span>
        </div>
    </div>
    <div class="report_and_add">
        <canvas id="PreReportChart" style="width:100%;height: 50%"></canvas>
    </div>
<!-- Add data selection script -->
    <script>
        var workTimeFormButton=document.getElementById("workTimeFormButton")
        var extraTimeFormButton=document.getElementById("extraTimeFormButton")
        function selectedWorkTime(){
            extraTimeFormButton.classList.remove("selected")
            workTimeFormButton.classList.add("selected")
        }
        function selectedExtraTime(){
            extraTimeFormButton.classList.add("selected")
            workTimeFormButton.classList.remove("selected")
        }
    </script>
    <?php
    $detailedWorkli="";
    $tempWeeklyWorkli="";
    if(!isset($_SESSION['curPos'])){
        $_SESSION['curPos']=0;
    }
    if(!isset($_SESSION['timeview'])){
        $_SESSION['timeview']="week";
    }
    $curDay=date('w');
    ?>

    <?php
    if($_SESSION['timeview']=="week"){
        $curDay+= $_SESSION['curPos']*7;
    }
    $Earning1=0;$Earning2=0;
    $hourRate=0;
    $startDate=date("Y-m-d",strtotime((-$curDay+1)." days"));
    $endDate=date("Y-m-d",strtotime((6-$curDay+1)." days"));
    try{
        $hourRate=$this->dbcon->GetHourRate($startDate)[0]["price"];
    }
    catch (Exception $ex){

    }
    $result=$this->dbcon->searchByDate($startDate,$endDate);
    $timeLabels='';
    $hours='';
    $showHours=0;
    $showMinutes=0;
    $hasTodaysData=false;
    foreach ($result as $row){
        if($row['date']==date("Y-m-d")){
            $hasTodaysData=true;
        }
        $curTimeLabel=date("l m-d-Y",strtotime($row['date']));
        $timeLabels.='"'.$curTimeLabel.'",';
        $showHours+=$row['hour'];
        $showMinutes+=$row['minutes']+$row['extraminutes'];
//        echo $showMinutes."<br>";
        $chour=$row['hour']+($row['minutes']+$row['extraminutes'])/60;
        $hours.='"'.$chour.'",';
        $tempWeeklyWorkli="<li><h4>".$curTimeLabel."(".$row['hour']." h ".($row['minutes']+$row['extraminutes'])." m)</h4><p>".str_replace("\n","<br>",$row["detailedWork"])."</p></li>".$tempWeeklyWorkli;
    }
    $detailedWorkli.=$tempWeeklyWorkli;
    $tempWeeklyWorkli="";
    ?>

    <!--  Saving data for weekly report  -->
    <script>
        var startDate="<?php echo date("m.d.y",strtotime((-$curDay+1)." days"));;?>"
        var endDate="<?php echo date("m.d.y",strtotime((6-$curDay+1)." days"));?>"
    </script>
    <?php
//    $_SESSION['CREATED']=0;
    if (!isset($_SESSION['CREATED'])) {
        $_SESSION['CREATED'] = time();
    }
    else if (time() - $_SESSION['CREATED'] > 60) {
        $_SESSION['CREATED'] = time();
        if($_SESSION['curPos']==0){
            if($hasTodaysData){
                file_get_contents("http://localhost/worktime");
            }
            else{
                file_get_contents("http://localhost/worktime?dates=".date("d-m-Y").",".date("d-m-Y", strtotime("-1 day")));
            }
            redirect(base_url());
        }
    }
    $ExtraHours=(int)($showMinutes/60);
    $showHours+=$ExtraHours;
    $showMinutes-=$ExtraHours*60;
    if($showMinutes<0){
        $showHours-=1;
        $showMinutes=60+$showMinutes;
    }
    $Earning1=$hourRate*$showHours+$hourRate*($showMinutes/60);
    //Second Graph
    $curDay=date('w');
    if($_SESSION['timeview']=="week"){
        $curDay+= ($_SESSION['curPos']+1)*7;
    }
    ?>
    <?php
    $PrestartDate=date("Y-m-d",strtotime((-$curDay+1)." days"));
    $PreendDate=date("Y-m-d",strtotime((6-$curDay+1)." days"));
    $result=$this->dbcon->searchByDate($PrestartDate,$PreendDate);
    $PretimeLabels='';
    $Prehours='';
    $PreshowHours=0;
    $PreshowMinutes=0;
    foreach ($result as $row){
        $curTimeLabel=date("l m-d-Y",strtotime($row['date']));
        $PretimeLabels.='"'.$curTimeLabel.'",';
        $PreshowHours+=$row['hour'];
        $PreshowMinutes+=$row['minutes']+$row['extraminutes'];
        $chour=$row['hour']+($row['minutes']+$row['extraminutes'])/60;
        $Prehours.='"'.$chour.'",';
        $tempWeeklyWorkli="<li><h4>".$curTimeLabel."(".$row['hour']." h ".($row['minutes']+$row['extraminutes'])." m)</h4><p>".str_replace("\n","<br>",$row["detailedWork"])."</p></li>".$tempWeeklyWorkli;
    }
    $detailedWorkli.=$tempWeeklyWorkli;
    $ExtraHours=(int)($PreshowMinutes/60);
    $PreshowHours+=$ExtraHours;
    $PreshowMinutes-=$ExtraHours*60;
    $Earning2=$hourRate*$PreshowHours+$hourRate*($PreshowMinutes/60);
    if($PreshowMinutes<0){
        $PreshowHours--;
        $PreshowMinutes+=60;
    }
    ?>

</div>
<div class="sideDiv">
    <ul class="list-group">
    <?php echo $detailedWorkli;?>
    </ul>
</div>
<div id="weeklyReportPopup" class="top_left-popup">
<!--    Start Main Div  -->
    <div style="margin-top: 8%">
        <input id="workDescriptionInput" onchange="updateShortDescriptionOfWork(this.value)" type="text" style="position: absolute;left: 0;width: 100%" placeholder="Short description of work">
        <p id="weeklyReportOutput" style="padding-top: 30px">Date Range:04.22.24-04.28.24 Short desc of work : Worked on the Journey Creator Total : 17 hours 48 minutes BDT : 6675 USD (from google):60.82</p>
    </div>
<!--    End Main Div  -->
<!--    Top Menu Button Div  -->
    <div class="middle-popup-closeButton">
        <button type="button" data-bs-dismiss="modal">Dollar Rate <span id="DollarRateOutput"></span></button>
        <button onclick="copyToClipBoard()" type="button" class="btn btn-primary" data-bs-dismiss="modal">Copy</button>
        <button onclick="hideWeeklyReport()" type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
    </div>
    <!--   End Top Menu Button Div  -->
</div>
<!--Report Script Ends-->
<script>
    var addDataHeader=document.getElementById("AddDataHeader")
    function showAddDataTime(){
        addDataHeader.innerText="Time";
    }
    function showAddDataTimeLine(){
        addDataHeader.innerText="Timeline"
    }
</script>
<!--Fetch functions are here-->
<script>
    //Starting setting earning
    document.getElementById("Earning1").innerText=<?Php echo $Earning1;?>

    document.getElementById("Earning2").innerText=<?Php echo $Earning2;?>

    function fetchtoday(){
        fetch('http://localhost/job_report/assets/scrap.py')
            .then((data) => console.log(data.text().then((result)=>{console.log(result)})));
    }
    function fetchDays(){
        var data=document.getElementById("syncDays").value
        if(data!=null||data!=""){
            rotateMenu()
            fetch('http://localhost/job_report/assets/scrap.py?days='+data)
                .then((data) => console.log(data.text().then((result)=>{console.log(result)})));
        }else{
            rotateMenu()
            fetchtoday()
        }
    }
</script>
<!--Gsap Animation functions-->
<script>
    var MenuIsHidden=true
    //const {gsap} = require("../../assets/js/gsap.min");

    function rotateMenu(){
        if(MenuIsHidden){
            gsap.to(".menu_button",{rotation:180,duration:.5})
            gsap.to(".menu_div",{right:"0px",duration: .5})
            MenuIsHidden=false
        }
        else{
            gsap.to(".menu_button",{rotation:0,duration:.5})
            gsap.to(".menu_div",{right:"-300px",duration: .5})
            MenuIsHidden=true
        }
        console.log("rotated")

    }
</script>
<!--End Gsap Animation functions-->
<!--Setting Data Starts-->
<script>
    var primaryColor="#6eca8d"
    var weekLabel=document.getElementById("weekLabel")

    var timeLabels = [<?php echo $timeLabels;?>];
    var hours = [<?php echo $hours;?>];
    //Second graph
    var PretimeLabels = [<?php echo $PretimeLabels;?>];
    var Prehours = [<?php echo $Prehours;?>];
    var doneTime=document.getElementById(("doneTime"))
    var timeSelectDivs = [document.getElementById("timeWeek"), document.getElementById("timeMonth"), document.getElementById("timeYear")]
    var selectedTime=timeSelectDivs[0]
    //Activating selected time
    selectedTime.classList.add("selected")
    document.getElementById("lasWorkHours").innerText=" <?php if($PreshowHours>0){
        echo $PreshowHours." hours ";
    }
        if($PreshowMinutes>0){
            echo $PreshowMinutes." minutes ";
        }?>"

    doneTime.innerText="<?php if($showHours>0){
        echo $showHours." hours ";
    }
        if($showMinutes>0){
            echo $showMinutes." minutes ";
        }?>"
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
            }],
        },
        options: {
            legend: {display: false,},
        }
    });
    var PrereportChart = new Chart("PreReportChart", {
        type: "line",
        data: {
            labels: PretimeLabels,
            datasets: [{
                backgroundColor: primaryColor,
                borderColor: "rgba(0,0,0,0.1)",
                data: Prehours
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
            let tDate=tToday. getFullYear()+'-'+(formatInTwoDecimal(tToday. getMonth()+1))+'-'+formatInTwoDecimal(tToday. getDate())
            console.log(tDate)
            document.getElementById("DateInput").value=tDate;
            thisDiv.style.display="block"
        }else{
            thisDiv.style.display="none"
        }
    }
    function formatInTwoDecimal(number) {
        if (number == 0) {
            return "00"
        }
        else if (number > 9) {
            return number + ""
        }
        else {
            return "0" + number
        }
    }
    function HourTargetChanged(targetHour){
        console.log(targetHour)
    }
</script>
<!--Setting Data Ends-->
<!--Week report script-->
<!--Declaring local storage vars to save data-->
<script>
    var dollarRateCommand="DollarRate", workDescriptionCommand="WorkDescription"
</script>
<script>
    var dateRange="Date Range : "+startDate+"-"+endDate
    var shortDescriptionOfWork="Short desc of work : "
    var dollarRate=0
    console.log(dateRange)
    var weeklyReport=""
    var weeklyReportOutput=document.getElementById("weeklyReportOutput")
    var dollarRateOutput=document.getElementById("DollarRateOutput")
    //Show functions
    var weeklyReportPopup=document.getElementById("weeklyReportPopup")
    function  updateShortDescriptionOfWork(text){
        shortDescriptionOfWork="Short desc of work : "+text
        localStorage.setItem(workDescriptionCommand,text)
        createWeeklyReport()
    }
    function createWeeklyReport(){
        weeklyReport=dateRange+". "+shortDescriptionOfWork;
        //Adding time
        weeklyReport+=" "+"Total : "+"<?php if($showHours>0){
            echo $showHours." hours ";
        }
            if($showMinutes>0){
                echo $showMinutes." minutes ";
            }?>"
        //Adding BDT
        weeklyReport+="BDT : <?Php echo $Earning1;?>"
        //Adding USD
        weeklyReport+=" USD (from google) : "+(<?Php echo $Earning1;?>/dollarRate)
            dollarRateOutput.innerText=dollarRate
        weeklyReportOutput.innerText=weeklyReport
    }
    function copyToClipBoard(){
        navigator.clipboard.writeText(weeklyReport);
    }
    function updateDataFromLocalStorage(){
        var localStorageDollarRate=localStorage.getItem(dollarRateCommand)
        if(localStorageDollarRate!=null&&localStorageDollarRate!=""){
            dollarRate=parseFloat(localStorageDollarRate)
            var localStorageWorkDescription=localStorage.getItem(workDescriptionCommand)
            if(localStorageWorkDescription!=null&&localStorageWorkDescription!=""){
                document.getElementById("workDescriptionInput").value=localStorageWorkDescription
                shortDescriptionOfWork="Short desc of work : "+localStorageWorkDescription
            }
            createWeeklyReport()
        }
    }
    updateDataFromLocalStorage()
    fetch("http://www.geoplugin.net/json.gp?ip=103.205.134.44").then(result=>{ return result.json()}).then(json=>{dollarRate=json["geoplugin_currencyConverter"];localStorage.setItem(dollarRateCommand,dollarRate+"");createWeeklyReport()})

    function showWeeklyReport(){
        weeklyReportPopup.style.display=""
        // Get dollar rate code
    }
    function hideWeeklyReport(){
        weeklyReportPopup.style.display="none"
    }

</script>
<!---->
</body>
</html>
