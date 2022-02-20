(function ($) {
"use strict";
var period=$('#days').val();
$('#days').on('change',()=>{
  period = $('#days').val();
  loadData();
})

var base_url=$("#base_url").val();
var site_url=$("#site_url").val();
var dashboard_static_url=$("#dashboard_static").val();


loadStaticData();
load_perfomace(30);
loadData();
dashboard_order_statics($('#month').val());

$('#perfomace').on('change',function(){

  var period=$('#perfomace').val();
  load_perfomace(period);
});

$('.month').on('click',function(e){
  $('.month').removeClass('active');
  $(this).addClass("active");
  var month=e.currentTarget.dataset.month;
  
  
  $('#orders-month').html(month);
  dashboard_order_statics(month);
});

function dashboard_order_statics(month) {
  var url = $('#dashboard_order_statics').val();
  var gif_url= $('#gif_url').val();
  var html="<img src="+gif_url+">";
  $('#pending_order').html(html);
  $('#completed_order').html(html);
  $('#shipping_order').html(html);
  $('#total_order').html(html);
  $.ajax({
    type: 'get',
    url:url+'/'+month,

    dataType: 'json',
    

    success: function(response){ 
      $('#pending_order').html(response.total_pending);
      $('#completed_order').html(response.total_completed);
      $('#shipping_order').html(response.total_processing);
      $('#total_order').html(response.total_orders);
    }
  })
}

function loadStaticData() {
  var url = dashboard_static_url;
  $.ajax({
    type: 'get',
    url: url,

    dataType: 'json',
    contentType: false,
    cache: false,
    processData:false,

    success: function(response){ 
      $('#total_subscribers').html(response.total_subscribers);
      $('#total_domain_requests').html(response.total_domain_request);
      $('#total_earnings').html(response.total_earnings);
      $('#total_expired_subscriptions').html(response.total_expired);
      $('#sales_of_earnings').html(response.total_earnings_this_year);
      $('#total_sales').html(response.total_order_this_year);
    
      var dates=[];
      var totals=[];

      $.each(response.earnings, function(index, value){
        var dat=value.month+' '+value.year;
        var total=value.total;

        dates.push(dat);
        totals.push(total);
      });

      sales_of_earnings_chart(dates,totals);

      var dates=[];
      var sales=[];

      $.each(response.orders, function(index, value){
        var dat=value.month+' '+value.year;
        var sale=value.orders;

        dates.push(dat);
        sales.push(sale);
      });

       order_chart(dates,sales);
     

      console.log(response)
    }
  })
}

function load_perfomace(period) {

  $('#earning_performance').show();
  var url=$('#dashboard_perfomance').val();
  $.ajax({
    type: 'get',
    url: url+'/'+period,

    dataType: 'json',
    

    success: function(response){ 
      $('#earning_performance').hide();
      var month_year=[];
      var dates=[];
      var totals=[];

      

      if (period != 365) {
        $.each(response, function(index, value){
          var total=value.total;
          var dte=value.date;
          totals.push(total);
          dates.push(dte);
        });
        console.log(dates);
        load_perfomace_chart(dates,totals);
      }
      else{
        $.each(response, function(index, value){
          var month=value.month;
          var total=value.total;

          month_year.push(month);
          totals.push(total);
        });
        load_perfomace_chart(month_year,totals);
      }
      
    }
  })
}
function loadData() {

  $.ajax({
    type: 'get',
    url: base_url+'/admin/dashboard/visitors/'+period,

    dataType: 'json',
    contentType: false,
    cache: false,
    processData:false,

    success: function(response){ 
      analytics_report(response.TotalVisitorsAndPageViews);
      top_browsers(response.TopBrowsers);
      Referrers(response.Referrers);
      TopPages(response.MostVisitedPages);
      $('#new_vistors').html(number_format(response.fetchUserTypes[0].sessions))
      $('#returning_visitor').html(number_format(response.fetchUserTypes[1].sessions))
    }
  })

}
function analytics_report(data) {
  var statistics_chart = document.getElementById("google_analytics").getContext('2d');
  var labels=[];
  var visitors=[];
  var pageViews=[];
  var total_visitors=0;
  var total_page_views=0;
  $.each(data, function(index, value){
    labels.push(value.date);
    visitors.push(value.visitors);
    pageViews.push(value.pageViews);
    var total_visitor = total_visitors+value.visitors;
    total_visitors=total_visitor;
    var total_page_view = total_page_views+value.pageViews;
    total_page_views=total_page_view;
  });

  $('#total_visitors').html(number_format(total_visitors));
  $('#total_page_views').html(number_format(total_page_views));

  var myChart = new Chart(statistics_chart, {
    type: 'line',
    data: {
      labels: labels,
      datasets: [{
        label: 'Visitors',
        data: visitors,
        borderWidth: 5,
        borderColor: '#6777ef',
        backgroundColor: 'transparent',
        pointBackgroundColor: '#fff',
        pointBorderColor: '#6777ef',
        pointRadius: 4
      },
      {
        label: 'PageViews',
        data: pageViews,
        borderWidth: 5,
        borderColor: '#6777ef',
        backgroundColor: 'transparent',
        pointBackgroundColor: '#fff',
        pointBorderColor: '#6777ef',
        pointRadius: 4
      }]
    },
    options: {
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          gridLines: {
            display: false,
            drawBorder: false,
          },
          ticks: {
            stepSize: 150
          }
        }],
        xAxes: [{
          gridLines: {
            color: '#fbfbfb',
            lineWidth: 2
          }
        }]
      },
    }
  });

}


function Referrers(data) {
  $('#refs').html('');
  $.each(data, function(index, value){
    var html='<div class="mb-4"> <div class="text-small float-right font-weight-bold text-muted">'+number_format(value.pageViews)+'</div><div class="font-weight-bold mb-1">'+value.url+'</div></div><hr>';
    
    $('#refs').append(html);
  });
}

function top_browsers(data) {
  $('#browsers').html('');
  $.each(data, function(index, value){
    var browser_name=value.browser;
    if (browser_name=='Edge') {
      var browser_name='internet-explorer';
    }
    var html=' <div class="col text-center"> <div class="browser browser-'+lower(browser_name)+'"></div><div class="mt-2 font-weight-bold">'+value.browser+'</div><div class="text-muted text-small"><span class="text-primary"></span> '+number_format(value.sessions)+'</div></div>';
    $('#browsers').append(html);
    if (index==4) {
      return false;
    }
  });
}

function TopPages(data) {
  $('#table-body').html('');
  $.each(data, function(index, value){
    var index=index+1;

    
    var html='<div class="mb-4"> <div class="text-small float-right font-weight-bold text-muted">'+number_format(value.pageViews)+' (Views)</div><div class="font-weight-bold mb-1"><a href="'+site_url+value.url+'" target="_blank" draggable="false">'+value.pageTitle+'</a></div></div>';
    $('#table-body').append(html);
    
  });
}

function lower(str) {
  var str= str.toLowerCase();
  var str=str.replace(' ',str);
  return str;
}


function number_format(number) {
  var num= new Intl.NumberFormat( { maximumSignificantDigits: 3 }).format(number);
  return num;
}




var ctx = document.getElementById("myChart").getContext('2d');

function load_perfomace_chart(dates,totals) {
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: dates,
      datasets: [{
        label: 'Total Amount',
        data: totals,
        borderWidth: 2,
        backgroundColor: 'rgba(63,82,227,.8)',
        borderWidth: 0,
        borderColor: 'transparent',
        pointBorderWidth: 0,
        pointRadius: 3.5,
        pointBackgroundColor: 'transparent',
        pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
      }]
    },
    options: {
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          gridLines: {
         
          drawBorder: false,
          color: '#f2f2f2',
      },
      ticks: {
        beginAtZero: true,
        stepSize: 1500,
        callback: function(value, index, values) {
          return  value;
        }
      }
  }],
    xAxes: [{
      gridLines: {
        display: false,
        tickMarkLength: 15,
      }
    }]
  },
  }
  });
}


var balance_chart = document.getElementById("sales_of_earnings_chart").getContext('2d');

var balance_chart_bg_color = balance_chart.createLinearGradient(0, 0, 0, 70);
balance_chart_bg_color.addColorStop(0, 'rgba(63,82,227,.2)');
balance_chart_bg_color.addColorStop(1, 'rgba(63,82,227,0)');

function sales_of_earnings_chart(dates,totals) {
  

  

  var myChart = new Chart(balance_chart, {
    type: 'line',
    data: {
      labels: dates,
      datasets: [{
        label: 'Total Amount',
        data: totals,
        backgroundColor: balance_chart_bg_color,
        borderWidth: 3,
        borderColor: 'rgba(63,82,227,1)',
        pointBorderWidth: 0,
        pointBorderColor: 'transparent',
        pointRadius: 3,
        pointBackgroundColor: 'transparent',
        pointHoverBackgroundColor: 'rgba(63,82,227,1)',
      }]
    },
    options: {
      layout: {
        padding: {
          bottom: -1,
          left: -1
        }
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          gridLines: {
            display: false,
            drawBorder: false,
          },
          ticks: {
            beginAtZero: true,
            display: false
          }
        }],
        xAxes: [{
          gridLines: {
            drawBorder: false,
            display: false,
          },
          ticks: {
            display: false
          }
        }]
      },
    }
  });

}


var order_chart_obj = document.getElementById("total_sales_chart").getContext('2d');

var sales_chart_bg_color = order_chart_obj.createLinearGradient(0, 0, 0, 80);
balance_chart_bg_color.addColorStop(0, 'rgba(63,82,227,.2)');
balance_chart_bg_color.addColorStop(1, 'rgba(63,82,227,0)');

function order_chart(dates,sales) {

  var myChart = new Chart(order_chart_obj, {
    type: 'line',
    data: {
      labels: dates,
      datasets: [{
        label: 'Orders',
        data: sales,
        borderWidth: 2,
        backgroundColor: balance_chart_bg_color,
        borderWidth: 3,
        borderColor: 'rgba(63,82,227,1)',
        pointBorderWidth: 0,
        pointBorderColor: 'transparent',
        pointRadius: 3,
        pointBackgroundColor: 'transparent',
        pointHoverBackgroundColor: 'rgba(63,82,227,1)',
      }]
    },
    options: {
      layout: {
        padding: {
          bottom: -1,
          left: -1
        }
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          gridLines: {
            display: false,
            drawBorder: false,
          },
          ticks: {
            beginAtZero: true,
            display: false
          }
        }],
        xAxes: [{
          gridLines: {
            drawBorder: false,
            display: false,
          },
          ticks: {
            display: false
          }
        }]
      },
    }
  }); 
}

})(jQuery); 

