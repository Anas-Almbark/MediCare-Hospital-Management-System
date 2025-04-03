document.addEventListener("DOMContentLoaded", function () {
    let bg_color = [];
    let pattern = "123456789ABCDEF";
    let helper = "";
    for (
        let i = 0;
        i <
        document.getElementById("lab-tests").dataset.tests.split(",").length;
        i++
    ) {
        helper = "";
        for (let i = 0; i < 6; i++) {
            helper += pattern.charAt(
                Math.floor(Math.random() * pattern.length)
            );
        }
        bg_color.push(`#${helper}`);
    }
    var ctx = document.getElementById("labTestsPieChart").getContext("2d");
    var myPieChart = new Chart(ctx, {
        type: "pie",
        data: {
            labels: document
                .getElementById("lab-tests")
                .dataset.tests.split(","),
            datasets: [
                {
                    data: document
                        .getElementById("lab-tests")
                        .dataset.values.split(","),
                    backgroundColor: bg_color,
                },
            ],
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: "Laboratory Tests Distribution by Type",
            },
            legend: {
                position: "bottom",
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
                            " patients (" +
                            percentage +
                            "%)"
                        );
                    },
                },
            },
        },
    });
});
