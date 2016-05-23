angular.module('starter.controllers')
    .controller('ClientViewOrderController', [
        '$scope', '$state', 'Order', '$ionicLoading',
        function ($scope, $state, Order, $ionicLoading) {
            $scope.orders = [];

            $ionicLoading.show({
                template: 'Carregando...'
            });

            Order.query({}, function (data) {
                $scope.orders = data.data;
                $ionicLoading.hide();
            }, function (dataError) {
                $ionicLoading.hide();
            });

        }]);