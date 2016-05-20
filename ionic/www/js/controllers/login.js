angular
    .module('starter.controllers')
    .controller('LoginController', [
        '$scope', 'OAuth', '$state', '$ionicPopup',
        function ($scope, OAuth, $state, $ionicPopup) {

            $scope.user = {
                username: '',
                password: ''
            };

            $scope.login = function () {
                OAuth.getAccessToken($scope.user).then(
                    function (data) {
                        $state.go('home');
                    }, function (responseError) {
                        $ionicPopup.alert({
                            title: 'Advertencia',
                            template: 'Login e/ou senha inválidos'
                        })
                    });
            };

        }]);