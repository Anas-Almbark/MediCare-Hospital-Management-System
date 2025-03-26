var ctx = document
    .getElementById("labTestRequestsStatusChart")
    .getContext("2d");
var myChart = new Chart(ctx, {
    type: "doughnut",
    data: {
        labels: ["Pending", "Completed", "Cancelled"],
        datasets: [
            {
                data: [30, 50, 20],
                backgroundColor: ["#f7b731", "#38cb89", "#ef4b4b"],
                borderWidth: 0,
                hoverBackgroundColor: ["#f7b731", "#38cb89", "#ef4b4b"],
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
