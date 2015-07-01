angular.module('myApp.fileUpload', ['ngFileUpload'])

    .config(['$routeProvider', function($routeProvider) {
        $routeProvider.when('/upload', {
            templateUrl: 'upload/upload.html',
            controller: 'MyCtrl'
        });
    }])

    .controller('MyCtrl', ['$scope', 'Upload', '$timeout', '$http', function ($scope, Upload, $timeout, $http) {
        $scope.$watch('files', function () {
            $scope.upload($scope.files);
        });
        $scope.log = '';
        $scope.percent = 0;
        $scope.importable = false;
        $scope.fpath = '';

        $scope.upload = function (files) {
            if (files && files.length) {
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    Upload.upload({
                        //url: 'https://angular-file-upload-cors-srv.appspot.com/upload',
                        url: '/fileupload',
                        fields: {
                            //'username': $scope.username
                        },
                        file: file
                    }).progress(function (evt) {
                        var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
                        $scope.percent = progressPercentage;
                        $scope.log = 'progress: ' + progressPercentage + '% ' +
                        evt.config.file.name + '\n' + $scope.log;
                    }).success(function (data, status, headers, config) {
                        $timeout(function() {
                            $scope.importable = true;
                            $scope.fpath = data.res;
                            console.log(data);
                            $scope.log = 'file: ' + config.file.name + ', Response: ' + JSON.stringify(data) + '\n' + $scope.log;
                        });
                    });
                }
            }
        };

        $scope.import = function() {
            if (!$scope.fpath) {
                alert('invalid file path');
            } else {
                $http.post('/dataImport', {path: $scope.fpath}).success(function(data, status, headers, config) {
                    // this callback will be called asynchronously
                    // when the response is available
                    console.log(data);
                    //alert('done.');
                });
            }
        }
    }]);