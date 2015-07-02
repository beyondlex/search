'use strict';
/* Services */
angular.module('myApp.services', ['ngResource'])
    .factory('Records', ['$resource', '$http',
        function($resource, $http){
            return {

                getRecords: function(_page, _perPage, _params) {
                    return $http.get('/api/records/byInput', {
                        params:{
                            page:_page,
                            perPage:_perPage,
                            params:_params
                        },
                        withCredentials: true
                    });
                },
                getMajors:function(){
                    return $http.get('/api/records/majors', {
                        params:{},
                        withCredentials: true
                    })
                },
                getDegrees:function(){
                    return $http.get('/api/records/degrees', {
                        params:{},
                        withCredentials: true
                    })
                },
                getGrades:function(){
                    return $http.get('/api/records/grades', {
                        params:{},
                        withCredentials: true
                    })
                },

                chartGender:function() {
                    return $http.get('/api/chart/gender');
                },
                chartMajor:function() {
                    return $http.get('/api/chart/major');
                },
                chartAge:function() {
                    return $http.get('/api/chart/age');
                }
            };



            //return $resource('/records/:recordId', {recordId: '@id'}, {
            //    query: {method:'GET', isArray:false}
            //});


            //return $resource('usr/:userId', {userId:'@id'});
            //return $resource('/usr', {}, {
            //    query: {method:'GET', isArray:true}
            //});
        }]);