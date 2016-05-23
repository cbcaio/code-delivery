angular.module('starter.controllers')
    .controller('ClientCheckoutSuccessfulController', [
        '$scope', '$state', '$cart',
        function ($scope, $state, $cart) {
            var cart = $cart.get();
            $scope.items = cart.items;
            $scope.total = cart.total;
            $cart.clear();

            $scope.openListOrder = function () {
                $state.go('client.view_orders');
            };

        }]);