'use strict';

angular.module('myApp.charts', ['ngRoute', 'highcharts-ng'])

    .config(['$routeProvider', function($routeProvider) {
        $routeProvider.when('/charts', {
            templateUrl: 'charts/charts.html',
            controller: 'ChartsCtrl'
        });
    }])

    .controller('ChartsCtrl', ['$scope', '$http', 'Records', function ($scope,  $http, Records) {

        var getBarConfig = function(data) {
            return {
                options: {
                    //This is the Main Highcharts chart config. Any Highchart options are valid here.
                    //will be overriden by values specified below.
                    chart: {
                        type: 'bar'
                    },
                    tooltip: {
                        style: {
                            padding: 10,
                            fontWeight: 'bold'
                        }
                    }
                },
                //The below properties are watched separately for changes.

                //Series object (optional) - a list of series using normal highcharts series options.
                series: [{
                    name:'人数',
                    data: data
                    //data: [10, 15, 12, 8, 7]
                }],
                    //Title configuration (optional)
                title: {
                    text: 'Hello'
                },
                //Boolean to control showng loading status on chart (optional)
                //Could be a string if you want to show specific loading text.
                loading: false,
                //Configuration for the xAxis (optional). Currently only one x axis can be dynamically controlled.
                //properties currentMin and currentMax provied 2-way binding to the chart's maximimum and minimum
                xAxis: {
                    //currentMin: 0,
                    //currentMax: 20,
                    title: {text: 'values'}
                },
                //Whether to use HighStocks instead of HighCharts (optional). Defaults to false.
                useHighStocks: false,
                //size (optional) if left out the chart will default to size of the div or something sensible.
                size: {
                    width: 400,
                    height: 500
                },
                //function (optional)
                func: function (chart) {
                    //setup some logic for the chart
                }
            }
        };
        //
        var getPieConfig = function(data){
            return {
                options: {
                    chart: {
                        width:500,
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    }
                },

                title: {
                    //text: '男女比例'
                },

                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                series: [{
                    name: "比重",
                    colorByPoint: true,
                    data: data
                }]
            };
        }

        $scope.chartGender = function() {
            Records.chartGender()
                .then(function(res){
                    $scope.genderPie = getPieConfig(res.data);
                });
        };

        $scope.chartMajor = function() {
            Records.chartMajor()
                .then(function(res){
                    //$scope.majorBar = getBarConfig(res.data);
                    $scope.majorPie = getPieConfig(res.data);
                });
        }
        $scope.chartAge = function() {
            Records.chartAge()
                .then(function(res){
                    $scope.ageBar = getBarConfig(res.data);
                });
        }

        $scope.chartGender();
        $scope.chartMajor();
        $scope.chartAge();

    }]);
