'use strict';

// Declare app level module which depends on views, and components
angular.module('myApp', [
    'ngRoute',
    'ngResource',
    'cgBusy',
    'myApp.services',
    'ui.bootstrap',
    //'myApp.view1',
    //'myApp.view2',
    'myApp.version',
    'myApp.fileUpload',
    'myApp.records'
]).
config(['$routeProvider', function($routeProvider) {
  $routeProvider
      //.when('/upload', {
      //    templateUrl: 'upload/upload.html',
      //    controller: 'MyCtrl'
      //})
      //.when('/records', {
      //    templateUrl: 'records/records.html',
      //    controller: 'RecordsCtrl'
      //})
      .otherwise({redirectTo: '/records'});
}]);
