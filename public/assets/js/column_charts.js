document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById("revenueSourcesChart").getContext("2d");
    new Chart(ctx, {
        type: "bar",
        data: {
            labels: [
                "Consultations",
                "Surgeries",
                "Laboratory",
                "Pharmacy",
                "Room Charges",
                "Other Services",
            ],
            datasets: [
                {
                    label: "Revenue (in thousands)",
                    data: [45, 75, 35, 55, 40, 25],
                    backgroundColor: [
                        "rgba(75, 192, 192, 0.7)",
                        "rgba(54, 162, 235, 0.7)",
                        "rgba(153, 102, 255, 0.7)",
                        "rgba(255, 159, 64, 0.7)",
                        "rgba(255, 99, 132, 0.7)",
                        "rgba(201, 203, 207, 0.7)",
                    ],
                    borderColor: [
                        "rgb(75, 192, 192)",
                        "rgb(54, 162, 235)",
                        "rgb(153, 102, 255)",
                        "rgb(255, 159, 64)",
                        "rgb(255, 99, 132)",
                        "rgb(201, 203, 207)",
                    ],
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: "Revenue (Thousands $)",
                    },
                },
                x: {
                    title: {
                        display: true,
                        text: "Revenue Sources",
                    },
                },
            },
            plugins: {
                legend: {
                    display: false,
                },
                title: {
                    display: true,
                    text: "Hospital Revenue Sources Distribution",
                },
            },
        },
    });
});
