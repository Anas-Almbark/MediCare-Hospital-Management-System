document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('doctorsPerformanceChart').getContext('2d');
    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Dr. Ahmed', 'Dr. Mohammed', 'Dr. Sarah', 'Dr. Fatima', 'Dr. Khalid'],
            datasets: [{
                label: 'Number of Patients',
                backgroundColor: '#3366ff',
                data: [45, 38, 42, 53, 36]
            }, {
                label: 'Satisfaction Rate',
                backgroundColor: '#10b759',
                data: [90, 85, 88, 92, 87]
            }]
        },
        options: {
            responsive: true,
            legend: {
                position: 'bottom'
            },
            title: {
                display: true,
                text: 'Doctors Performance and Patient Satisfaction'
            },
            scales: {
                xAxes: [{
                    stacked: false,
                    ticks: {
                        beginAtZero: true
                    }
                }],
                yAxes: [{
                    stacked: false
                }]
            },
            tooltips: {
                mode: 'index',
                intersect: false
            }
        }
    });
});