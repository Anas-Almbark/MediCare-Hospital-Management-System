document.addEventListener("DOMContentLoaded", function () {
    var ctx = document
        .getElementById("genderDistributionChart")
        .getContext("2d");
    var genderChart = new Chart(ctx, {
        type: "pie",
        data: {
            labels: ["Other", "Female", "Male"],
            datasets: [
                {
                    backgroundColor: ["#ddd", "#ff66b3", "#3366ff"],
                    data: document
                        .getElementById("gender-distribution")
                        .dataset.values.split(","),
                },
            ],
        },
        options: {
            responsive: true,
            legend: {
                position: "bottom",
            },
            title: {
                display: true,
                text: "Patient Gender Distribution",
            },
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var total = dataset.data.reduce(function (
                            previousValue,
                            currentValue
                        ) {
                            return previousValue + currentValue;
                        });
                        var currentValue = dataset.data[tooltipItem.index];
                        var percentage = Math.floor(
                            (currentValue / total) * 100 + 0.5
                        );
                        return (
                            data.labels[tooltipItem.index] +
                            ": " +
                            currentValue +
                            " (" +
                            percentage +
                            "%)"
                        );
                    },
                },
            },
        },
    });
});
