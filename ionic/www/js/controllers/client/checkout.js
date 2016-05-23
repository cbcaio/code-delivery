angular.module('starter.controllers')
    .controller('ClientCheckoutController', [
        '$scope', '$state', '$cart', 'Order', '$ionicLoading', '$ionicPopup',
        function ($scope, $state, $cart, Order, $ionicLoading, $ionicPopup) {
            var cart = $cart.get();

            $scope.items = cart.items;
            $scope.total = cart.total;
            $scope.orders = [];

            $scope.removeItem = function (index) {
                $cart.removeItem(index);
                $scope.items.splice(index, 1);
                $scope.total = $cart.get().total;
            };

            $scope.openProductDetail = function (index) {
                $state.go('client.checkout_item_detail', {index: index});
            };

            $scope.openListProducts = function () {
                $state.go('client.view_products');
            };

            $scope.save = function () {
                var items = angular.copy($scope.items);
                angular.forEach(items, function (item) {
                    item.product_id = item.id;
                });

                $ionicLoading.show({
                    template: "Salvando..."
                });

                Order.save({id: null}, {items: items}, function (data) {
                    $ionicLoading.hide();
                    $state.go('client.checkout_successful', {data : data});
                }, function (responseError) {
                    $ionicLoading.hide();
                    $ionicPopup.alert({
                        title: 'Erro',
                        template: 'Pedido não realizado, tente novamente'
                    });
                });
            };

        }]);