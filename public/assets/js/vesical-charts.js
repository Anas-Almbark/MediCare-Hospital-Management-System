document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('bedOccupancyChart').getContext('2d');
    var myBarChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
            labels: ['ICU', 'Emergency', 'Pediatric', 'Maternity', 'General'],
            datasets: [{
                label: 'Occupied Beds',
                backgroundColor: '#3366ff',
                data: [18, 12, 15, 9, 25]
            }, {
                label: 'Available Beds',
                backgroundColor: '#10b759',
                data: [2, 8, 5, 11, 15]
            }]
        },
        options: {
            responsive: true,
            legend: {
                position: 'bottom'
            },
            title: {
                display: true,
                text: 'Hospital Bed Occupancy by Department'
            },
            scales: {
                xAxes: [{
                    stacked: true,
                    ticks: {
                        beginAtZero: true
                    }
                }],
                yAxes: [{
                    stacked: true
                }]
            },
            tooltips: {
                mode: 'index',
                intersect: false
            }
        }
    });
});