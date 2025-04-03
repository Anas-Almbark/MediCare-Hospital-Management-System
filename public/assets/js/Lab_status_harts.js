var ctx = document
    .getElementById("labTestRequestsStatusChart")
    .getContext("2d");
var myChart = new Chart(ctx, {
    type: "doughnut",
    data: {
        labels: ["Cancelled", "Completed", "Pending"],
        datasets: [
            {
                data: document
                    .getElementById("lab-status")
                    .dataset.values.split(","),
                backgroundColor: ["#ef4b4b", "#38cb89", "#f7b731"],
                borderWidth: 0,
                hoverBackgroundColor: ["#ef4b4b", "#38cb89", , "#f7b731"],
            },
        ],
    },
    options: {
        responsive: true,
        legend: {
            position: "bottom",
        },
        cutoutPercentage: 70,
    },
});
