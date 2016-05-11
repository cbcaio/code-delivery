angular
    .module('starter.controllers2', [])
    .controller('HomeController', [
        '$scope', '$state', '$cookies', '$http',
        function ($scope, $state, $cookies, $http) {
            $scope.user = $cookies.getObject('token');

            $http({
                method: 'GET',
                url: 'http://code-delivery.dev:8000/api/authenticated',
                headers: {
                    'Authorization': 'Bearer ' + $cookies.getObject('token').access_token,
                    'Accept': 'application/json'
                }
            }).then(function successCallback(response) {
                $scope.loggedUser = response;
            }, function errorCallback(response) {
                $scope.error = response;
            });

        }]);