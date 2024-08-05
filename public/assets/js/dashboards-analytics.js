/**
 * Dashboard Analytics
 */

'use strict';

(function () {
  let cardColor, headingColor, axisColor, shadeColor, borderColor;

  cardColor = config.colors.white;
  headingColor = config.colors.headingColor;
  axisColor = config.colors.axisColor;
  borderColor = config.colors.borderColor;
 
  document.addEventListener('DOMContentLoaded',function(){
    fetch('?controller=dashboard&action=statistical_orders')
    .then(res => res.json())
    .then(function(statisticalOrder){
      const data = Object.values(statisticalOrder.statisticalMonth).map(statistical=> statistical?.total);
      const categories = Object.values(statisticalOrder.statisticalMonth).map(statistical=> 'T '+statistical?.moth);
      TotalRevenue([{'name' : statisticalOrder.year ,'data' : data }],{categories});
      growthChart(statisticalOrder);
      renderOrderStatistics(statisticalOrder)
    })
  })
  // Total Revenue Report Chart - Bar Chart
  // --------------------------------------------------------------------
  function TotalRevenue(series,option = {}){
    const totalRevenueChartEl = document.querySelector('#totalRevenueChart'),
    totalRevenueChartOptions = {
      series:series,
      chart: {
        height: 300,
        stacked: true,
        type: 'bar',
        toolbar: { show: false }
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '33%',
          borderRadius: 12,
          startingShape: 'rounded',
          endingShape: 'rounded'
        }
      },
      colors: [config.colors.primary, config.colors.info],
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth',
        width: 6,
        lineCap: 'round',
        colors: [cardColor]
      },
      legend: {
        show: true,
        horizontalAlign: 'left',
        position: 'top',
        markers: {
          height: 8,
          width: 8,
          radius: 12,
          offsetX: -3
        },
        labels: {
          colors: axisColor
        },
        itemMargin: {
          horizontal: 10
        }
      },
      grid: {
        borderColor: borderColor,
        padding: {
          top: 0,
          bottom: -8,
          left: 20,
          right: 20
        }
      },
      xaxis: {
        categories: option.categories ?? ['t1'],
        labels: {
          style: {
            fontSize: '13px',
            colors: axisColor
          }
        },
        axisTicks: {
          show: false
        },
        axisBorder: {
          show: false
        }
      },
      yaxis: {
        labels: {
          style: {
            fontSize: '13px',
            colors: axisColor
          }
        }
      },
      responsive: [
        {
          breakpoint: 1700,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '32%'
              }
            }
          }
        },
        {
          breakpoint: 1580,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '35%'
              }
            }
          }
        },
        {
          breakpoint: 1440,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '42%'
              }
            }
          }
        },
        {
          breakpoint: 1300,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '48%'
              }
            }
          }
        },
        {
          breakpoint: 1200,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '40%'
              }
            }
          }
        },
        {
          breakpoint: 1040,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 11,
                columnWidth: '48%'
              }
            }
          }
        },
        {
          breakpoint: 991,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '30%'
              }
            }
          }
        },
        {
          breakpoint: 840,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '35%'
              }
            }
          }
        },
        {
          breakpoint: 768,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '28%'
              }
            }
          }
        },
        {
          breakpoint: 640,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '32%'
              }
            }
          }
        },
        {
          breakpoint: 576,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '37%'
              }
            }
          }
        },
        {
          breakpoint: 480,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '45%'
              }
            }
          }
        },
        {
          breakpoint: 420,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '52%'
              }
            }
          }
        },
        {
          breakpoint: 380,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '60%'
              }
            }
          }
        }
      ],
      states: {
        hover: {
          filter: {
            type: 'none'
          }
        },
        active: {
          filter: {
            type: 'none'
          }
        }
      }
    };
  if (typeof totalRevenueChartEl !== undefined && totalRevenueChartEl !== null) {
    const totalRevenueChart = new ApexCharts(totalRevenueChartEl, totalRevenueChartOptions);
    totalRevenueChart.render();
  }
}
  // Growth Chart - Radial Bar Chart
  // --------------------------------------------------------------------
  function growthChart(statisticalOrder){
    document.querySelector('.growthChart-text').innerText = 'cửa hàng  đã tăng '+parseFloat(statisticalOrder.percentage)+'%';
    document.querySelector('.growthChart-info').innerHTML = `
    <div class="d-flex">
        <div class="me-2">
            <span class="badge bg-label-primary p-2"><i class="bx bx-dollar text-primary"></i></span>
        </div>
        <div class="d-flex flex-column">
            <small>danh thu </small>
            <h6 class="mb-0">${statisticalOrder.total_revenue}</h6>
        </div>
    </div>
    <div class="d-flex">
        <div class="me-2">
            <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
        </div>
        <div class="d-flex flex-column">
            <small>sản phẩm</small>
            <h6 class="mb-0">${statisticalOrder.total_product}</h6>
        </div>
    </div>
    `;
    const growthChartEl = document.querySelector('#growthChart'),
    growthChartOptions = {
      series: [ parseFloat(statisticalOrder.percentage)],
      labels: ['tăng trưởng'],
      chart: {
        height: 240,
        type: 'radialBar'
      },
      plotOptions: {
        radialBar: {
          size: 150,
          offsetY: 10,
          startAngle: -150,
          endAngle: 150,
          hollow: {
            size: '55%'
          },
          track: {
            background: cardColor,
            strokeWidth: '100%'
          },
          dataLabels: {
            name: {
              offsetY: 15,
              color: headingColor,
              fontSize: '15px',
              fontWeight: '600',
              fontFamily: 'Public Sans'
            },
            value: {
              offsetY: -25,
              color: headingColor,
              fontSize: '22px',
              fontWeight: '500',
              fontFamily: 'Public Sans'
            }
          }
        }
      },
      colors: [config.colors.primary],
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'dark',
          shadeIntensity: 0.5,
          gradientToColors: [config.colors.primary],
          inverseColors: true,
          opacityFrom: 1,
          opacityTo: 0.6,
          stops: [30, 70, 100]
        }
      },
      stroke: {
        dashArray: 5
      },
      grid: {
        padding: {
          top: -35,
          bottom: -10
        }
      },
      states: {
        hover: {
          filter: {
            type: 'none'
          }
        },
        active: {
          filter: {
            type: 'none'
          }
        }
      }
    };
  if (typeof growthChartEl !== undefined && growthChartEl !== null) {
    const growthChart = new ApexCharts(growthChartEl, growthChartOptions);
    growthChart.render();
  }
}


  // Profit Report Line Chart
  // --------------------------------------------------------------------
  const profileReportChartEl = document.querySelector('#profileReportChart'),
    profileReportChartConfig = {
      chart: {
        height: 80,
        // width: 175,
        type: 'line',
        toolbar: {
          show: false
        },
        dropShadow: {
          enabled: true,
          top: 10,
          left: 5,
          blur: 3,
          color: config.colors.warning,
          opacity: 0.15
        },
        sparkline: {
          enabled: true
        }
      },
      grid: {
        show: false,
        padding: {
          right: 8
        }
      },
      colors: [config.colors.warning],
      dataLabels: {
        enabled: false
      },
      stroke: {
        width: 5,
        curve: 'smooth'
      },
      series: [
        {
          data: [110, 270, 145, 245, 205, 285]
        }
      ],
      xaxis: {
        show: false,
        lines: {
          show: false
        },
        labels: {
          show: false
        },
        axisBorder: {
          show: false
        }
      },
      yaxis: {
        show: false
      }
    };
  if (typeof profileReportChartEl !== undefined && profileReportChartEl !== null) {
    const profileReportChart = new ApexCharts(profileReportChartEl, profileReportChartConfig);
    profileReportChart.render();
  }

  // Order Statistics Chart
  // --------------------------------------------------------------------
 function orderStatisticsChart(series,labels){
  const chartOrderStatistics = document.querySelector('#orderStatisticsChart'),
      orderChartConfig = {
        chart: {
          height: 165,
          width: 130,
          type: 'donut'
        },
        labels: [...labels],
        series: [...series],
        colors: [config.colors.primary, config.colors.secondary, config.colors.info, config.colors.success],
        stroke: {
          width: 5,
          colors: cardColor
        },
        dataLabels: {
          enabled: false,
          formatter: function (val, opt) {
            return parseFloat(val).toFixed(1) + '%';
          }
        },
        legend: {
          show: false
        },
        grid: {
          padding: {
            top: 0,
            bottom: 0,
            right: 15
          }
        },
        plotOptions: {
          pie: {
            donut: {
              size: '75%',
              labels: {
                show: true,
                value: {
                  fontSize: '1.5rem',
                  fontFamily: 'Public Sans',
                  color: headingColor,
                  offsetY: -15,
                  formatter: function (val) {
                    return parseInt(val) + '%';
                  }
                },
                name: {
                  offsetY: 20,
                  fontFamily: 'Public Sans'
                },
                total: {
                  show: true,
                  fontSize: '0.8125rem',
                  color: axisColor,
                  label: 'Weekly',
                  formatter: function (w) {
                    return  w.config.series[0] + '%';
                  }
                }
              }
            }
          }
        }
      };
    if (typeof chartOrderStatistics !== undefined && chartOrderStatistics !== null) {
      const statisticsChart = new ApexCharts(chartOrderStatistics, orderChartConfig);
      statisticsChart.render();
    }
}

  // Income Chart - Area chart
  // --------------------------------------------------------------------
  const incomeChartEl = document.querySelector('#incomeChart'),
    incomeChartConfig = {
      series: [
        {
          data: [24, 21, 30, 22, 42, 26, 35, 29]
        }
      ],
      chart: {
        height: 215,
        parentHeightOffset: 0,
        parentWidthOffset: 0,
        toolbar: {
          show: false
        },
        type: 'area'
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        width: 2,
        curve: 'smooth'
      },
      legend: {
        show: false
      },
      markers: {
        size: 6,
        colors: 'transparent',
        strokeColors: 'transparent',
        strokeWidth: 4,
        discrete: [
          {
            fillColor: config.colors.white,
            seriesIndex: 0,
            dataPointIndex: 7,
            strokeColor: config.colors.primary,
            strokeWidth: 2,
            size: 6,
            radius: 8
          }
        ],
        hover: {
          size: 7
        }
      },
      colors: [config.colors.primary],
      fill: {
        type: 'gradient',
        gradient: {
          shade: shadeColor,
          shadeIntensity: 0.6,
          opacityFrom: 0.5,
          opacityTo: 0.25,
          stops: [0, 95, 100]
        }
      },
      grid: {
        borderColor: borderColor,
        strokeDashArray: 3,
        padding: {
          top: -20,
          bottom: -8,
          left: -10,
          right: 8
        }
      },
      xaxis: {
        categories: ['', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          show: true,
          style: {
            fontSize: '13px',
            colors: axisColor
          }
        }
      },
      yaxis: {
        labels: {
          show: false
        },
        min: 10,
        max: 50,
        tickAmount: 4
      }
    };
  if (typeof incomeChartEl !== undefined && incomeChartEl !== null) {
    const incomeChart = new ApexCharts(incomeChartEl, incomeChartConfig);
    incomeChart.render();
  }

  // Expenses Mini Chart - Radial Chart
  // --------------------------------------------------------------------
  const weeklyExpensesEl = document.querySelector('#expensesOfWeek'),
    weeklyExpensesConfig = {
      series: [65],
      chart: {
        width: 60,
        height: 60,
        type: 'radialBar'
      },
      plotOptions: {
        radialBar: {
          startAngle: 0,
          endAngle: 360,
          strokeWidth: '8',
          hollow: {
            margin: 2,
            size: '45%'
          },
          track: {
            strokeWidth: '50%',
            background: borderColor
          },
          dataLabels: {
            show: true,
            name: {
              show: false
            },
            value: {
              formatter: function (val) {
                return '$' + parseInt(val);
              },
              offsetY: 5,
              color: '#697a8d',
              fontSize: '13px',
              show: true
            }
          }
        }
      },
      fill: {
        type: 'solid',
        colors: config.colors.primary
      },
      stroke: {
        lineCap: 'round'
      },
      grid: {
        padding: {
          top: -10,
          bottom: -15,
          left: -10,
          right: -10
        }
      },
      states: {
        hover: {
          filter: {
            type: 'none'
          }
        },
        active: {
          filter: {
            type: 'none'
          }
        }
      }
    };
  if (typeof weeklyExpensesEl !== undefined && weeklyExpensesEl !== null) {
    const weeklyExpenses = new ApexCharts(weeklyExpensesEl, weeklyExpensesConfig);
    weeklyExpenses.render();
  }
  function renderOrderStatistics(data){
  const number = new Intl.NumberFormat("vi-VN", { style: 'currency', currency: 'VND' })
   const orderStatics = document.querySelector('#order_statistics');
   const renderItems =  Object.values(data.order_products_category).map(categories => `
   <li class="d-flex mb-4 pb-1">
      <div class="avatar flex-shrink-0 me-3">
          <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-mobile-alt"></i></span>
      </div>
      <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
          <div class="me-2">
              <h6 class="mb-0">${categories.category_name}</h6>
              <small class="text-muted">Mobile, Earbuds, TV</small>
          </div>
          <div class="user-progress">
              <small class="fw-semibold">${categories.total_products}</small>
          </div>
      </div>
    </li>
   ` ).join( '\n');
   orderStatics.innerHTML = `
   <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between pb-0">
          <div class="card-title mb-0">
              <h5 class="m-0 me-2">thống kê đơn hàng</h5>
              <small class="text-muted">${ number.format( data.total_revenue)} danh thu</small>
          </div>
          <div class="dropdown">
              <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                  <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                  <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                  <a class="dropdown-item" href="javascript:void(0);">Share</a>
              </div>
          </div>
      </div>
      <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-3">
              <div class="d-flex flex-column align-items-center gap-1">
                  <h2 class="mb-2">${data.total_orders}</h2>
                  <span>tổng đơn hàng</span>
              </div>
              <div id="orderStatisticsChart"></div>
          </div>
          <ul class="p-0 m-0">
            ${renderItems}
          </ul>
      </div>
    </div>
   `;
   const dataSeries = Object.values(data.order_products_category).map((category) => parseFloat(category.percentage));
   const labels = Object.values(data.order_products_category).map(category => category.category_name)
   orderStatisticsChart(dataSeries,labels)
  }
})();
