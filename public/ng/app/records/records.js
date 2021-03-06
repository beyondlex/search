'use strict';

angular.module('myApp.records', ['ngRoute', 'ui-rangeSlider'])

    .config(['$routeProvider', function($routeProvider) {
        $routeProvider.when('/records', {
            templateUrl: 'records/records.html',
            controller: 'RecordsCtrl'
        });
    }])

    //.controller('RecordsCtrl', ['$scope', '$http', 'Records', function ($scope,  $http, Records) {
    //    console.log('rec');
    //}]);
    .controller('RecordsCtrl', ['$scope', '$http', 'Records', function ($scope,  $http, Records) {



        $scope.currentPage = 1;     //当前页
        $scope.itemsPerPage = 10;   //每页记录数
        $scope.totalItems = 0;      //总记录数
        $scope.pending = false;     //加载数据ing


        $scope.inputAgeFrom = 3;    //年龄from
        $scope.inputAgeTo = 100;    //年龄to



        //搜索参数
        $scope.getSearchParams = function() {
            return {
                "inputDegree":$scope.inputDegree,
                "inputMajor":$scope.inputMajor,
                "inputGrade":$scope.inputGrade,
                "inputGender":$scope.inputGender,
                "inputAgeFrom":$scope.inputAgeFrom,
                "inputAgeTo":$scope.inputAgeTo
            }
        }

        //直接搜索
        $scope.search = function () {
            $scope.pending = true;

            $scope.searchAction();

        }

        //通过<input>的Enter事件搜索
        $scope.searchByInput = function($e) {

            if ($e.keyCode != 13) return;

            $scope.searchAction();
        }

        //搜索
        $scope.searchAction = function() {
            $scope.pending = true;
            //调用service进行搜索
            $scope.busy = Records.getRecords($scope.currentPage, $scope.itemsPerPage, $scope.getSearchParams())
                .then(function (res) {
                    //将搜索结果放到变量上
                    $scope.records = res.data;
                    $scope.totalItems = res.data.total;
                    $scope.pending = false;

                }, function() {
                    $scope.pending = false;
                }
            );
        }

        //定义scope下的方法，方法内部调用service读取数据，然后将结果放到scope下的变量 majors
        $scope.getMajors = function() {
            Records.getMajors()
                .then(function(res){
                    $scope.majors = res.data;
                }
            );
        }
        $scope.getDegrees = function() {
            Records.getDegrees()
                .then(function(res){
                    $scope.degrees = res.data;
                }
            );
        }
        $scope.getGrades = function() {
            Records.getGrades()
                .then(function(res){
                    $scope.grades = res.data;
                }
            );
        }

        $scope.search();

        $scope.getMajors();
        $scope.getDegrees();
        $scope.getGrades();


    }])
    .filter('age', function() {
        return function (input) {
            return '年龄：'+input;
        }
    })
;
