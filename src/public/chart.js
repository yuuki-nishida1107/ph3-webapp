"use strict";

// Register the plugin to all charts:
Chart.register(ChartDataLabels);


const bgColors = ["#0345ec", "#0f71bd", "#20bdde", "#3ccefe", "#b29ef3", "#6d46ec", "#4a17ef", "#3105c0"];
const STUDYING_LANGUAGES_DATA = "http://posse-task.anti-pattern.co.jp/1st-work/study_language.json";
  fetch(STUDYING_LANGUAGES_DATA)
    .then((response) => {
      return response.json();
    })
    .then((jsonData) => {
      createLanguagesChart(jsonData);
    });

function createLanguagesChart(jsonData) {

  const convertedLanguageData = Object.keys(jsonData[0]);
  const convertedRatioData = Object.values(jsonData[0]);
  let language_ctx = document
    .getElementById("language_circle")
    .getContext("2d");
  new Chart(language_ctx, {
    type: "doughnut",
    data: {
      labels: convertedLanguageData,
      datasets: [
        {
          datalabels: {
            color: "#ffffff",
            formatter: function (value, context) {
              return value + "%";
            }},
          data:convertedRatioData,
          backgroundColor: bgColors,
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins:{
        legend: {
          position: "bottom", 
          labels:{
            boxWidth:22,
            padding:24,
            usePointStyle:true,
            textAlign:'left',
            font:{
              size:14
            }
          }
        }
      }
    },
  });
};
const STUDYING_CONTENTS_DATA = "http://posse-task.anti-pattern.co.jp/1st-work/study_contents.json";
  fetch(STUDYING_CONTENTS_DATA)
    .then((response) => {
      return response.json();
    })
    .then((jsonData) => {
      createContentsChart(jsonData);
    });
function createContentsChart(jsonData) {
  const createdContentDate =Object.keys(jsonData[0]);
  const createContentRatioDate =Object.values(jsonData[0]);
  let content_ctx = document.getElementById("content_circle").getContext("2d");
  new Chart(content_ctx, {
    type: "doughnut",
    data: {
      labels: createdContentDate,
      datasets: [
        {
          data: createContentRatioDate,
          backgroundColor: bgColors,
          datalabels: {
            color: "#ffffff",
            formatter: function (value, context) {
              return value + "%";
            }},
    }],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: "bottom", 
          labels:{
            boxWidth:22,
            padding:24,
            usePointStyle:true,
            textAlign:'left',
            font:{
              size:14
            }
          }
        }
      },
    },
  });
};


// 棒グラフ

const STUDYING_TIME_DATA = "http://posse-task.anti-pattern.co.jp/1st-work/study_time.json";
fetch(STUDYING_TIME_DATA)
  .then((response) => {
    return response.json();
  })
  .then((jsonData) => {
    createBarChart(jsonData);
  });

function createBarChart(jsonData) {
  const convertedDayData = jsonData.map((d) => {
    return d.day;
  });
  const convertedTimeData = jsonData.map((d) => {
    return d.time;
  });

let ctx = document.getElementById("ex_chart");

var data = {
    labels: convertedDayData,
    datasets: [{
      label:"",
        data: convertedTimeData,
        barPercentage: 0.7,
        backgroundColor: '#1e90ff',
        borderWidth:1,
        borderRadius: 50,
        borderSkipped: false,
    }]
};

var options = {
  maintainAspectRatio: false ,
  responsive: true,
  scales:{
  x:{
    grid: {
      display: false,
      drawBorder: false,
      //borderを消す
    },
    ticks:{
      maxRotation: 0,
      minRotation: 0,
      stepSize:2,
      min:1,
      max:30,
      color: "#97b9d1",
      callback:function(index,value){
        return index%2 !== 0 ? this.getLabelForValue(value) : "";
      }
    }
    },
  y: {
    grid: {
      display: false,
      drawBorder: false,
      //borderを消す
    },
    scaleLabel: {
      display: window.screen.width > 414,
      //省略
  },
    ticks: {
        stepSize:2,
        callback: function(value, index, values) {
            return value + 'h';
        },
        color: "#97b9d1",
    },
    plugins: {
      legend: {
        display: false,
      },
      datalabels: {
        display: false,
      },
    },
}}};

var ex_chart = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: options
});
};


