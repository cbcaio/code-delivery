angular.module('starter.services')
    .service('$cart', ['$localStorage', function ($localStorage) {
        var key = 'cart';
        var cartAux = $localStorage.getObject(key);

        if (!cartAux) {
            initCart();
        }

        this.clear = function () {
            initCart();
        };

        this.get = function () {
            return $localStorage.getObject(key);
        };

        this.getItem = function (index) {
            return this.get().items[index];
        };

        this.addItem = function (item) {
            var cart = this.get();
            var itemAux;
            var exists = false;

            for (var i in cart.items) {
                itemAux = cart.items[i];

                if (itemAux.id == item.id) {
                    itemAux.qtd = item.qtd + itemAux.qtd;
                    itemAux.subtotal = calculateSubTotal(itemAux);
                    exists = true;
                    break;
                }
            }

            if (!exists) {
                item.subtotal = calculateSubTotal(item);
                cart.items.push(item);
            }
            cart.total = getTotal(cart.items);
            $localStorage.setObject(key, cart);
        };

        this.removeItem = function (index) {
            var cart = this.get();
            cart.items.splice(index, 1);
            cart.total = getTotal(cart.items);
            $localStorage.setObject(key, cart);
        };

        this.updateQtd = function (index, qtd) {
            var cart = this.get();
            var itemAux = cart.items[index];

            itemAux.qtd = qtd;
            itemAux.subtotal = calculateSubTotal(itemAux);
            cart.total = getTotal(cart.items);
            $localStorage.setObject(key, cart);

        };

        function calculateSubTotal(item) {
            return item.price * item.qtd;
        }

        function getTotal(items) {
            var sum = 0;
            angular.forEach(items, function (item) {
                sum += item.subtotal;
            });
            return sum;
        }

        function initCart() {
            $localStorage.setObject(key, {
                items: [],
                total: 0
            });
        }
    }]);