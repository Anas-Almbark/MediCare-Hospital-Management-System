document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('labTestsPieChart').getContext('2d');
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Blood Test', 'Urine Analysis', 'X-Ray', 'MRI', 'ECG'],
            datasets: [{
                data: [45, 32, 18, 22, 15],
                backgroundColor: ['#10b759', '#fcb32d', '#dc3545', '#3366ff', '#6f42c1']
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Laboratory Tests Distribution by Type'
            },
            legend: {
                position: 'bottom'
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var total = dataset.data.reduce(function(previousValue, currentValue) {
                            return previousValue + currentValue;
                        });
                        var currentValue = dataset.data[tooltipItem.index];
                        var percentage = Math.floor(((currentValue/total) * 100)+0.5);
                        return data.labels[tooltipItem.index] + ': ' + currentValue + ' patients (' + percentage + '%)';
                    }
                }
            }
        }
    });
});