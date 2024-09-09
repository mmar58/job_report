<html><head>
    <title>WorkMetrics - Advanced Work Report Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="<?php echo base_url("assets/homenew/js/chart.js");?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f4f8;
            display: flex;
        }
        .main-content {
            flex: 1;
            padding: 20px;
            transition: margin-right 0.3s ease-in-out;
        }
        .header {
            background-color: #3498db;
            color: white;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .dashboard {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }
        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 20px;
            flex: 1 1 calc(50% - 10px);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .chart-container {
            position: relative;
            height: 300px;
        }
        .filters {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        select, input {
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #bdc3c7;
            font-size: 14px;
        }
        .income-summary {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .income-item {
            text-align: center;
            background-color: #ecf0f1;
            padding: 15px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }
        .income-item:hover {
            background-color: #d5dbdb;
        }
        .income-value {
            font-size: 24px;
            font-weight: bold;
            color: #2980b9;
        }
        .sidebar {
            width: 300px;
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            position: fixed;
            right: -300px;
            top: 0;
            bottom: 0;
            transition: right 0.3s ease-in-out;
            overflow-y: auto;
        }
        .sidebar.open {
            right: 0;
        }
        .sidebar-toggle {
            position: fixed;
            right: 20px;
            top: 20px;
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            z-index: 1000;
        }
        .target-progress {
            margin-top: 20px;
        }
        .progress-bar {
            width: 100%;
            height: 20px;
            background-color: #34495e;
            border-radius: 10px;
            overflow: hidden;
            margin-top: 10px;
        }
        .progress-fill {
            height: 100%;
            background-color: #2ecc71;
            transition: width 0.5s ease-in-out;
        }
        .target-icon {
            font-size: 48px;
            text-align: center;
            margin-bottom: 20px;
            transition: color 0.5s ease-in-out;
        }
        .target-stats {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }
        .target-stat {
            text-align: center;
        }
        .target-value {
            font-size: 24px;
            font-weight: bold;
            color: #2ecc71;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        .pulse {
            animation: pulse 2s infinite;
        }
        .minimized-progress {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 200px;
            height: 10px;
            background-color: #34495e;
            border-radius: 5px;
            cursor: pointer;
            overflow: hidden;
            z-index: 1000;
        }
        .minimized-progress-fill {
            height: 100%;
            background-color: #2ecc71;
            transition: width 0.5s ease-in-out;
        }
        .date-range {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #2c3e50;
        }
    </style>
</head>
<body>
<div class="main-content">
    <div class="header">
        <h1>WorkMetrics Dashboard</h1>
    </div>
    <div class="filters">
        <select id="time-range">
            <option value="week">This Week</option>
            <option value="month">This Month</option>
            <option value="year">This Year</option>
        </select>
    </div>
    <div class="date-range" id="date-range"></div>
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
    <h2>Target Progress</h2>
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
    // Sample data (replace with real data from your backend)
    const workData = {
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

    const incomeData = {
        week: 1200,
        month: 5200,
        year: 62000
    };

    // Chart initialization
    const ctx = document.getElementById('work-hours-chart').getContext('2d');
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

    // Helper function to format dates
    function formatDate(date) {
        return date.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
    }

    // Update chart based on selected time range
    document.getElementById('time-range').addEventListener('change', function() {
        const range = this.value;
        let labels, currentData, previousData, dateRangeText;
        const today = new Date();

        if (range === 'week') {
            labels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
            currentData = workData.week.current;
            previousData = workData.week.previous;
            const startOfWeek = new Date(today.setDate(today.getDate() - today.getDay() + (today.getDay() === 0 ? -6 : 1)));
            const endOfWeek = new Date(startOfWeek);
            endOfWeek.setDate(endOfWeek.getDate() + 6);
            dateRangeText = `${formatDate(startOfWeek)} - ${formatDate(endOfWeek)}`;
        } else if (range === 'month') {
            labels = ['Week 1', 'Week 2', 'Week 3', 'Week 4'];
            currentData = workData.month.current;
            previousData = workData.month.previous;
            const startOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
            const endOfMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0);
            dateRangeText = `${formatDate(startOfMonth)} - ${formatDate(endOfMonth)}`;
        } else {
            labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            currentData = workData.year.current;
            previousData = workData.year.previous;
            dateRangeText = today.getFullYear().toString();
        }

        document.getElementById('date-range').textContent = dateRangeText;

        workHoursChart.data.labels = labels;
        workHoursChart.data.datasets[0].data = currentData;
        workHoursChart.data.datasets[1].data = previousData;
        workHoursChart.update();

        // Update income summary
        document.getElementById('week-income').textContent = incomeData.week;
        document.getElementById('month-income').textContent = incomeData.month;
        document.getElementById('year-income').textContent = incomeData.year;
    });

    // Update target progress
    function updateProgress() {
        const target = parseInt(document.getElementById('hourly-target').value) || 0;
        const completed = workData.week.current.reduce((a, b) => a + b, 0);
        const percentage = target > 0 ? Math.round((completed / target) * 100) : 0;

        document.getElementById('target-value').textContent = target;
        document.getElementById('completed-value').textContent = completed;
        document.getElementById('completion-percentage').textContent = percentage + '%';
        document.getElementById('progress-fill').style.width = percentage + '%';
        document.getElementById('minimized-progress-fill').style.width = percentage + '%';

        // Update target icon color based on progress
        const targetIcon = document.getElementById('target-icon');
        if (percentage < 33) {
            targetIcon.style.color = '#e74c3c'; // Red for low progress
        } else if (percentage < 66) {
            targetIcon.style.color = '#f39c12'; // Orange for medium progress
        } else {
            targetIcon.style.color = '#2ecc71'; // Green for high progress
        }
    }

    document.getElementById('hourly-target').addEventListener('input', updateProgress);

    // Sidebar toggle
    document.getElementById('sidebar-toggle').addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.querySelector('.main-content');
        const minimizedProgress = document.getElementById('minimized-progress');
        sidebar.classList.toggle('open');
        if (sidebar.classList.contains('open')) {
            mainContent.style.marginRight = '300px';
            minimizedProgress.style.display = 'none';
        } else {
            mainContent.style.marginRight = '0';
            minimizedProgress.style.display = 'block';
        }
    });

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
</script>

</body></html>