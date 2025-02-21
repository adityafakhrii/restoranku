
var chartProfileVisit = new ApexCharts(
  document.querySelector("#chart-profile-visit"),
  {
    annotations: {
      position: "back",
    },
    dataLabels: {
      enabled: false,
    },
    chart: {
      type: "bar",
      height: 300,
    },
    fill: {
      opacity: 1,
    },
    plotOptions: {},
    series: [
      {
        name: "sales",
        data: []
      },
    ],
    colors: "#435ebe",
    xaxis: {
      categories: [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
      ],
    },
  }
)

fetch('/dashboard/sales')
    .then(response => response.json())
    .then(output => {
        chartProfileVisit.updateSeries([{
            name: 'sales',
            data: output
        }]);
    })
    .catch(error => console.error('Error fetching sales data:', error));

chartProfileVisit.render()
