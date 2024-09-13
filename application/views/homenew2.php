<html><head><base href="https://workmetrics.ai/">
    <title>Work Report Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="<?php echo base_url("assets/homenew/js/chart.js");?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/newmain.css");?>" >
</head>
<body>
<div class="main-content">
    <div class="header">
        <h1>Work Report Dashboard (<?php echo date('l d/m/Y');?>)</h1>
    </div>
    <div class="filters">
        <div class="navigation-controls">
            <button id="prev-period" class="nav-button"><i class="fas fa-chevron-left"></i></button>
            <select id="time-range">
                <option value="week">This Week</option>
                <option value="month">This Month</option>
                <option value="year">This Year</option>
            </select>
            <button id="next-period" class="nav-button"><i class="fas fa-chevron-right"></i></button>
        </div>
    </div>
    <div class="date-range" id="date-range">12/13/2024-123/57/2024</div>
    <div class="dashboard">
        <div class="card">
            <h2>Work Hours Comparison</h2>
            <div class="chart-container">
                <canvas id="work-hours-chart"></canvas>
            </div>
        </div>
        <div class="card">
            <h2>Income Summary</h2>
            <div class="income-summary">
                <div class="income-item">
                    <p>This Week</p>
                    <p class="income-value">$<span id="week-income">0</span></p>
                </div>
                <div class="income-item">
                    <p>This Month</p>
                    <p class="income-value">$<span id="month-income">0</span></p>
                </div>
                <div class="income-item">
                    <p>This Year</p>
                    <p class="income-value">$<span id="year-income">0</span></p>
                </div>
            </div>
        </div>
    </div>
</div>

<button class="sidebar-toggle" id="sidebar-toggle">
    <i class="fas fa-tasks"></i>
</button>

<div class="sidebar" id="sidebar">
    <div class="target-icon pulse" id="target-icon">
        <i class="fas fa-bullseye"></i>
    </div>
    <div class="target-progress">
        <input type="number" id="hourly-target" placeholder="Set hourly target">
        <div class="progress-bar">
            <div class="progress-fill" id="progress-fill"></div>
        </div>
        <div class="target-stats">
            <div class="target-stat">
                <p>Target</p>
                <p class="target-value" id="target-value">0</p>
            </div>
            <div class="target-stat">
                <p>Completed</p>
                <p class="target-value" id="completed-value">0</p>
            </div>
            <div class="target-stat">
                <p>Progress</p>
                <p class="target-value" id="completion-percentage">0%</p>
            </div>
        </div>
    </div>
</div>

<div class="minimized-progress" id="minimized-progress">
    <div class="minimized-progress-fill" id="minimized-progress-fill"></div>
</div>

<script>
    // Global variables for period navigation
    let currentPeriodIndex = 0;
    let apiPath="<?php echo base_url("home/getWeeklyWork/");?>"
    const maxPeriods = 10; // Adjust this value based on how many past periods you want to allow
    const graphCanvas=document.getElementById('work-hours-chart')
    let sideMenuWidth=236;
    let currentWeekDays="",previousWeekDays=""
    let dateRangeDiv=document.getElementById("date-range")
    // Sample data (replace with real data from your backend)
    let workData = {
        week: {
            current: [8, 7, 9, 8, 7, 0, 0],
            previous: [7, 8, 8, 9, 8, 0, 0]
        },
        month: {
            current: [40, 38, 42, 39],
            previous: [38, 40, 37, 41]
        },
        year: {
            current: [160, 155, 170, 168, 162, 158, 165, 170, 168, 172, 175, 180],
            previous: [150, 158, 162, 165, 160, 163, 168, 172, 170, 175, 178, 182]
        }
    };

    let incomeData = {
        week: 1200,
        month: 5200,
        year: 62000
    };

    // Chart initialization
    const ctx = graphCanvas.getContext('2d');
    let workHoursChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Current Week',
                data: workData.week.current,
                backgroundColor: 'rgba(52, 152, 219, 0.6)'
            }, {
                label: 'Previous Week',
                data: workData.week.previous,
                backgroundColor: 'rgba(46, 204, 113, 0.6)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });



    // Update chart based on selected time range
    document.getElementById('time-range').addEventListener('change', function() {
        currentPeriodIndex = 0;
        updateChart();
    });

    // Add event listeners for navigation buttons
    document.getElementById('prev-period').addEventListener('click', function() {

            currentPeriodIndex--;
            fetch(apiPath+currentPeriodIndex).then(response=>{return response.json()}).then(json=>{updateCurrentDate(json);console.log(json)})
            // console.log(apiPath+currentPeriodIndex)
            fetch(apiPath+(currentPeriodIndex-1)).then(response=>{return response.json()}).then(json=>{updatePreviousDate(json);console.log(json)})

    });

    document.getElementById('next-period').addEventListener('click', function() {
        if (currentPeriodIndex < 0) {
            currentPeriodIndex++;
            fetch(apiPath+currentPeriodIndex).then(response=>{return response.json()}).then(json=>{updateCurrentDate(json);console.log(json)})
            fetch(apiPath+(currentPeriodIndex-1)).then(response=>{return response.json()}).then(json=>{updatePreviousDate(json);console.log(json)})
        }
    });
    let today;
    function UpdateDateRange(){
        dateRangeDiv.innerHTML=currentWeekDays+" "+previousWeekDays
    }
    function getStartDate(weekOffset = 0) {
        today = new Date();

        // Get the current day of the week (0 = Sunday, 1 = Monday, etc.)
        const currentDay = today.getDay();

        // Calculate the difference to the Monday of the current week
        const diffToMonday = (currentDay === 0 ? -6 : 1) - currentDay;

        // Start date (Monday of the week with the offset)
        let startDate = new Date(today);
        startDate.setDate(today.getDate() + diffToMonday + (weekOffset * 7));

        return startDate;
    }
    function updateSpecificData(json){
        json.forEach(jsonData=>{
            let tempDateData=jsonData.date.split("-")
            let date = new Date(tempDateData[2]+"-"+tempDateData[1]+"-"+tempDateData[0]);
            // console.log(date)
            // Get the day of the week (Sunday is 0, Monday is 1, etc.)
           let day = date.getDay();
            // console.log(day)
            // Shift the day to make Monday 0, and Sunday 6
            let adjustedDay = (day + 6) % 7;
            while(workHoursChart.data.datasets[0].data.length-1<adjustedDay){
                workHoursChart.data.datasets[0].data.push(0)
            }
            // console.log(adjustedDay)
            // console.log(workHoursChart.data.datasets[0].data)
            workHoursChart.data.datasets[0].data[adjustedDay]=parseInt(jsonData.hours)+(parseInt(jsonData.minutes)+parseInt(jsonData.extraMinutes))/60
            // console.log(workHoursChart.data.datasets[0].data)
        })
        workHoursChart.update();
    }
    function updateCurrentDate(json){
        const range = document.getElementById('time-range').value;
        let labels=[], currentData=[]
        let startDate=getStartDate(currentPeriodIndex)
        let totalHour=0,totalMinute=0
        let hasCurrentData=false
        currentWeekDays=""
        if (range === 'week') {
            labels=['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']
            // Index for the json data
            let jsonIndex=0
            // Looping to get all the data
            for(let i=0;i<7;i++){
                // If json index is less than it's length
                if(jsonIndex<json.length){
                    // Matching for today's data
                    if(currentPeriodIndex==0&&!hasCurrentData){
                        if(today.toISOString().slice(0, 10)==json[jsonIndex].date){
                            hasCurrentData=true;
                        }
                    }
                    // If the date match with the json index data
                    if(json[jsonIndex].date==startDate.toISOString().slice(0, 10)){
                        currentData.push(parseInt(json[jsonIndex].hour)+(parseInt(json[jsonIndex].minutes)+parseInt(json[jsonIndex].extraminutes))/60)
                        // Updating total data
                        try{
                            totalHour+=parseInt(json[jsonIndex].hour)
                            totalMinute+=parseInt(json[jsonIndex].minutes)+parseInt(json[jsonIndex].extraminutes)
                        }
                        catch{

                        }

                        jsonIndex++
                    }
                    else{
                        console.log("Not Matched "+json[jsonIndex].date+" with "+startDate.toISOString().slice(0, 10))

                    }
                    if(i==0){
                        currentWeekDays="<span style='margin-left: 15px'>"+startDate.toISOString().slice(0, 10)+"-"
                    }
                    else if(i==json.length-1){
                        let mHour=Math.floor(totalMinute/60)
                        totalHour+=mHour
                        totalMinute-=mHour*60
                        currentWeekDays+=startDate.toISOString().slice(0, 10)+"  "+totalHour+":"+totalMinute+"</span>"
                    }
                    // console.log(currentWeekDays)
                    // Updating start date
                    startDate.setDate(startDate.getDate()+1)
                }
                else{
                    // console.log(currentData)
                    break;
                }
            }
            UpdateDateRange()
        } else if (range === 'month') {
            labels = ['Week 1', 'Week 2', 'Week 3', 'Week 4'];
            currentData = generateData(workData.month.current, currentPeriodIndex);
        } else {
            labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            currentData = generateData(workData.year.current, currentPeriodIndex);
        }

        workHoursChart.data.labels = labels;
        workHoursChart.data.datasets[0].data = currentData;
        workHoursChart.update();
        if(currentPeriodIndex==0){
            if(hasCurrentData){
                fetch("http://localhost/worktimev2/").then(response=>response.json()).then(json=>updateSpecificData(json))
            }
            else{
                var dates=today.toISOString().slice(0, 10)
                today.setDate(today.getDate()-1)
                dates=today.toISOString().slice(0, 10)+","+dates
                fetch("http://localhost/worktimev2/?dates="+dates).then(response=>response.json()).then(json=>updateSpecificData(json))
            }
        }
        // Update income summary
        const incomeMultiplier = 1 - (currentPeriodIndex * 0.05); // Decrease income for past periods
        document.getElementById('week-income').textContent = Math.round(incomeData.week * incomeMultiplier);
        document.getElementById('month-income').textContent = Math.round(incomeData.month * incomeMultiplier);
        document.getElementById('year-income').textContent = Math.round(incomeData.year * incomeMultiplier);

        updateProgress();
    }
    function updatePreviousDate(json){
        const range = document.getElementById('time-range').value;
        let  previousData=[]
        let startDate=getStartDate(currentPeriodIndex-1)
        let totalHour=0,totalMinute=0
        previousWeekDays=""
        if (range === 'week') {
            let jsonIndex=0
            for(let i=0;i<7;i++){
                if(jsonIndex<json.length){
                    if(json[jsonIndex].date==startDate.toISOString().slice(0, 10)){
                        previousData.push(parseInt(json[jsonIndex].hour)+(parseInt(json[jsonIndex].minutes)+parseInt(json[jsonIndex].extraminutes))/60)

                        try{
                            totalHour+=parseInt(json[jsonIndex].hour)
                        }
                        catch{

                        }
                        try{
                            totalMinute+=parseInt(json[jsonIndex].minutes)+parseInt(json[jsonIndex].extraminutes)
                        }
                        catch{

                        }
                        jsonIndex++
                    }
                    else{
                        console.log("Not Matched "+json[jsonIndex].date+" with "+startDate.toISOString().slice(0, 10))

                    }
                    // Update Date Range

                    if(i==0){
                        previousWeekDays="<span style='margin-left: 30px'>"+startDate.toISOString().slice(0, 10)+"-"
                    }
                    else if(i==json.length-1){
                        let mHour=Math.floor(totalMinute/60)
                        totalHour+=mHour
                        totalMinute-=mHour*60
                        previousWeekDays+=startDate.toISOString().slice(0, 10)+"  "+totalHour+":"+totalMinute+"</span>"
                    }
                    // Updating start date
                    startDate.setDate(startDate.getDate()+1)
                }
                else{
                    break;
                }
            }
            UpdateDateRange()
        } else if (range === 'month') {
            previousData = generateData(workData.month.current, currentPeriodIndex);
        } else {
            previousData = generateData(workData.year.current, currentPeriodIndex);
        }
        workHoursChart.data.datasets[1].data = previousData;
        workHoursChart.update();
    }

    // Update the updateChart function
    function updateChart(json) {
        const range = document.getElementById('time-range').value;
        let labels=[], currentData, previousData;
        let startDate=getStartDate(currentPeriodIndex)
        if (range === 'week') {
            labels=['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']

            currentData = generateData(workData.week.current, currentPeriodIndex);
            previousData = generateData(workData.week.previous, currentPeriodIndex);
        } else if (range === 'month') {
            labels = ['Week 1', 'Week 2', 'Week 3', 'Week 4'];
            currentData = generateData(workData.month.current, currentPeriodIndex);
            previousData = generateData(workData.month.previous, currentPeriodIndex);
        } else {
            labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            currentData = generateData(workData.year.current, currentPeriodIndex);
            previousData = generateData(workData.year.previous, currentPeriodIndex);
        }

        workHoursChart.data.labels = labels;
        workHoursChart.data.datasets[0].data = currentData;
        workHoursChart.data.datasets[1].data = previousData;
        workHoursChart.update();

        // Update income summary
        const incomeMultiplier = 1 - (currentPeriodIndex * 0.05); // Decrease income for past periods
        document.getElementById('week-income').textContent = Math.round(incomeData.week * incomeMultiplier);
        document.getElementById('month-income').textContent = Math.round(incomeData.month * incomeMultiplier);
        document.getElementById('year-income').textContent = Math.round(incomeData.year * incomeMultiplier);

        updateProgress();
    }

    // Helper function to generate data for past periods
    function generateData(baseData, periodIndex) {
        return baseData.map(value => {
            const randomFactor = 0.9 + Math.random() * 0.2; // Random factor between 0.9 and 1.1
            return Math.round(value * randomFactor * (1 - periodIndex * 0.05));
        });
    }

    // Update target progress
    function updateProgress() {
        const target = parseInt(document.getElementById('hourly-target').value) || 0;
        let completed = workHoursChart.data.datasets[0].data.reduce((a, b) => a + b, 0);
        completed=completed.toFixed(2);
        const percentage = target > 0 ? Math.round((completed / target) * 100) : 0;

        document.getElementById('target-value').textContent = target;
        document.getElementById('completed-value').textContent = completed;
        document.getElementById('completion-percentage').textContent = percentage + '%';
        document.getElementById('progress-fill').style.width = percentage + '%';
        document.getElementById('minimized-progress-fill').style.width = percentage + '%';

        // Update target icon color based on progress
        const targetIcon = document.getElementById('target-icon');
        if (percentage < 20) {
            targetIcon.style.color = '#d52816'; // Red for very low progress
        } else if (percentage < 30) {
            targetIcon.style.color = '#bb533f'; // Orange-red for low progress
        } else if (percentage < 40) {
            targetIcon.style.color = '#ad8e17'; // Orange-red for low progress
        }else if (percentage < 60) {
            targetIcon.style.color = '#da9b35'; // Orange for medium progress
        } else if (percentage < 70) {
            targetIcon.style.color = '#f1c40f'; // Yellow for medium-high progress
        } else if (percentage < 80) {
            targetIcon.style.color = '#87ea89'; // Orange-red for low progress
        }else if (percentage < 90) {
            targetIcon.style.color = '#23a25a'; // Green for high progress
        } else {
            targetIcon.style.color = '#0d572d'; // Dark green for very high progress
        }
    }
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.querySelector('.main-content');
    const minimizedProgress = document.getElementById('minimized-progress');
    function toggleSideBar(){
        sidebar.classList.toggle('open');
        if (sidebar.classList.contains('open')) {
            mainContent.style.marginRight = '300px';
            minimizedProgress.style.display = 'none';
        } else {
            mainContent.style.marginRight = '0';
            minimizedProgress.style.display = 'block';
        }

    }
    document.getElementById('hourly-target').addEventListener('input', updateProgress);

    // Sidebar toggle
    document.getElementById('sidebar-toggle').addEventListener('click', toggleSideBar);

    // Minimized progress bar click
    document.getElementById('minimized-progress').addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.querySelector('.main-content');
        const minimizedProgress = document.getElementById('minimized-progress');
        sidebar.classList.add('open');
        mainContent.style.marginRight = '300px';
        minimizedProgress.style.display = 'none';
    });

    // Initial update
    document.getElementById('time-range').dispatchEvent(new Event('change'));
    document.getElementById('hourly-target').value = 40;
    updateProgress();
    fetch(apiPath+currentPeriodIndex).then(response=>{return response.json()}).then(json=>{updateCurrentDate(json)})
    fetch(apiPath+(currentPeriodIndex-1)).then(response=>{return response.json()}).then(json=>{updatePreviousDate(json)})
    toggleSideBar()
    fetch("http://localhost/worktimev2/?dates=10-09-2024,11-09-2024").then(response=>{return response.json()}).then(json=>console.log(json))
</script>

</body></html>